<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Kendaraan;
use App\Models\AreaParkir;
use App\Models\Tarif;
use App\Models\LogAktivitas;
use Carbon\Carbon;

class PetugasController extends Controller
{
    public function transaksi()
    {
        $transaksiAktif = Transaksi::with(['kendaraan', 'area', 'user'])
            ->where('status', 'masuk')
            ->orderBy('id_parkir', 'desc')
            ->get();

        // Sinkronisasi otomatis jumlah 'terisi' setiap area berdasarkan kendaraan yang sedang terparkir
        $areas = AreaParkir::all();
        foreach ($areas as $area) {
            $jumlahTerparkir = Transaksi::where('id_area', $area->id_area)
                ->where('status', 'masuk')
                ->count();

            if ($area->terisi != $jumlahTerparkir) {
                $area->update(['terisi' => $jumlahTerparkir]);
            }
        }

        // Ambil daftar kendaraan terdaftar & tarif untuk pencarian otomatis
        $kendaraans = Kendaraan::orderBy('plat_nomor', 'asc')->get();
        $tarifs = Tarif::all()->keyBy(function ($item) {
            return strtolower($item->jenis_kendaraan);
        });

        return view('petugas.transaksi', compact('transaksiAktif', 'areas', 'kendaraans', 'tarifs'));
    }

    public function masukParkir(Request $request)
    {
        $request->validate([
            'plat_nomor' => 'required',
            'id_area'    => 'required'
        ]);

        $plat = strtoupper(trim($request->plat_nomor));

        // 1. Cari kendaraan yang sudah terdaftar di Data Kendaraan (Admin)
        $kendaraan = Kendaraan::whereRaw('UPPER(plat_nomor) = ?', [$plat])->first();

        if (!$kendaraan) {
            return back()->withErrors([
                'plat_nomor' => 'Plat nomor ' . $plat . ' belum terdaftar di Data Kendaraan! Silakan hubungi Admin untuk mendaftarkannya.'
            ])->withInput();
        }

        // 2. Cek apakah kendaraan ini saat ini masih berstatus terparkir
        $cekAktif = Transaksi::where('id_kendaraan', $kendaraan->id_kendaraan)
            ->where('status', 'masuk')
            ->first();

        if ($cekAktif) {
            return back()->withErrors([
                'plat_nomor' => 'Kendaraan dengan plat ' . $plat . ' saat ini masih terparkir di dalam area!'
            ])->withInput();
        }

        // 3. Cek ketersediaan sisa slot pada area parkir yang dipilih
        $area = AreaParkir::findOrFail($request->id_area);
        $jumlahTerparkir = Transaksi::where('id_area', $area->id_area)
            ->where('status', 'masuk')
            ->count();
        $sisaSlot = $area->kapasitas - $jumlahTerparkir;

        if ($sisaSlot <= 0) {
            return back()->withErrors([
                'id_area' => 'Area parkir ' . $area->nama_area . ' sudah penuh (Sisa 0 slot)!'
            ])->withInput();
        }

        // 4. Buat Transaksi Parkir Masuk
        Transaksi::create([
            'id_kendaraan' => $kendaraan->id_kendaraan,
            'id_area'      => $area->id_area,
            'id_user'      => auth()->id(),
            'waktu_masuk'  => Carbon::now(),
            'status'       => 'masuk'
        ]);

        // 5. Sinkronisasi ulang kolom terisi pada database
        $area->update(['terisi' => $jumlahTerparkir + 1]);

        // 6. Catat Log Aktivitas
        LogAktivitas::create([
            'id_user'         => auth()->id(),
            'aktivitas'       => 'Input Kendaraan Masuk Plat: ' . $plat . ' (' . strtoupper($kendaraan->jenis_kendaraan) . ') di Area: ' . $area->nama_area,
            'waktu_aktivitas' => Carbon::now()
        ]);

        return redirect()->route('petugas.transaksi')->with('success', 'Kendaraan ' . $plat . ' berhasil masuk parkir.');
    }

    public function keluarParkir($id)
    {
        $transaksi = Transaksi::with(['kendaraan', 'area'])->findOrFail($id);
        
        $waktuMasuk = Carbon::parse($transaksi->waktu_masuk);
        $waktuKeluar = Carbon::now();

        $totalMenit = $waktuMasuk->diffInMinutes($waktuKeluar);
        $durasiJam = (int) ceil($totalMenit / 60);
        if ($durasiJam < 1) {
            $durasiJam = 1;
        }

        $jenisKendaraan = strtolower($transaksi->kendaraan->jenis_kendaraan ?? 'motor');
        $tarif = Tarif::whereRaw('LOWER(jenis_kendaraan) = ?', [$jenisKendaraan])->first();
        
        $biayaPerJam = $tarif ? $tarif->tarif_per_jam : 2000;
        $totalBiaya = $durasiJam * $biayaPerJam;

        $transaksi->update([
            'waktu_keluar' => $waktuKeluar,
            'durasi_jam'   => $durasiJam,
            'biaya_total'  => $totalBiaya,
            'status'       => 'keluar'
        ]);

        if ($transaksi->area) {
            $jumlahTerparkir = Transaksi::where('id_area', $transaksi->area->id_area)
                ->where('status', 'masuk')
                ->count();
            $transaksi->area->update(['terisi' => $jumlahTerparkir]);
        }

        LogAktivitas::create([
            'id_user'         => auth()->id(),
            'aktivitas'       => 'Memproses Transaksi Keluar Plat: ' . ($transaksi->kendaraan->plat_nomor ?? '-') . ' (Durasi: ' . $durasiJam . ' Jam, Biaya: Rp ' . number_format($totalBiaya, 0, ',', '.') . ')',
            'waktu_aktivitas' => Carbon::now()
        ]);

        return redirect()->route('petugas.struk', $transaksi->id_parkir)->with('success', 'Transaksi keluar berhasil diproses.');
    }

    public function struk($id = null)
    {
        if ($id) {
            $transaksi = Transaksi::with(['kendaraan', 'area', 'user'])->find($id);
        } else {
            $transaksi = Transaksi::with(['kendaraan', 'area', 'user'])
                ->where('status', 'keluar')
                ->orderBy('id_parkir', 'desc')
                ->first();
        }

        return view('petugas.struk', compact('transaksi'));
    }
}
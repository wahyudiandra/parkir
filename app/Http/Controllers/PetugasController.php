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

        $areas = AreaParkir::all();
        $tarifs = Tarif::all();

        return view('petugas.transaksi', compact('transaksiAktif', 'areas', 'tarifs'));
    }

    public function masukParkir(Request $request)
    {
        $request->validate([
            'plat_nomor'      => 'required',
            'jenis_kendaraan' => 'required',
            'id_area'         => 'required'
        ]);

        $plat = strtoupper($request->plat_nomor);

        // Cari atau buat kendaraan
        $kendaraan = Kendaraan::firstOrCreate(
            ['plat_nomor' => $plat],
            [
                'jenis_kendaraan' => $request->jenis_kendaraan,
                'warna'           => '-',
                'pemilik'         => 'Umum',
                'id_user'         => auth()->id()
            ]
        );

        // Buat Transaksi Parkir Masuk
        $transaksi = Transaksi::create([
            'id_kendaraan' => $kendaraan->id_kendaraan,
            'id_area'      => $request->id_area,
            'id_user'      => auth()->id(),
            'waktu_masuk'  => Carbon::now(),
            'status'       => 'masuk'
        ]);

        // Update kuota terisi pada area parkir
        $area = AreaParkir::find($request->id_area);
        if ($area) {
            $area->increment('terisi');
        }

        // CATAT LOG AKTIVITAS
        LogAktivitas::create([
            'id_user'         => auth()->id(),
            'aktivitas'       => 'Input Kendaraan Masuk Plat: ' . $plat . ' di Area: ' . ($area->nama_area ?? 'Parkir'),
            'waktu_aktivitas' => Carbon::now()
        ]);

        return redirect()->route('petugas.transaksi')->with('success', 'Kendaraan berhasil masuk parkir.');
    }

    public function keluarParkir($id)
    {
        $transaksi = Transaksi::with(['kendaraan', 'area'])->findOrFail($id);
        
        $waktuMasuk = Carbon::parse($transaksi->waktu_masuk);
        $waktuKeluar = Carbon::now();

        // Hitung total menit parkir
        $totalMenit = $waktuMasuk->diffInMinutes($waktuKeluar);

        // Pembulatan ke atas dalam hitungan jam (misal 1 jam 5 menit dihitung 2 jam)
        $durasiJam = (int) ceil($totalMenit / 60);
        if ($durasiJam < 1) {
            $durasiJam = 1; // Minimal hitungan 1 jam
        }

        // Cari tarif per jam berdasarkan jenis kendaraan
        $jenisKendaraan = strtolower($transaksi->kendaraan->jenis_kendaraan ?? 'motor');
        $tarif = Tarif::whereRaw('LOWER(jenis_kendaraan) = ?', [$jenisKendaraan])->first();
        
        $biayaPerJam = $tarif ? $tarif->tarif_per_jam : 2000;
        $totalBiaya = $durasiJam * $biayaPerJam;

        // Update data transaksi
        $transaksi->update([
            'waktu_keluar' => $waktuKeluar,
            'durasi_jam'   => $durasiJam,
            'biaya_total'  => $totalBiaya,
            'status'       => 'keluar'
        ]);

        // Kurangi kuota terisi pada area parkir
        if ($transaksi->area && $transaksi->area->terisi > 0) {
            $transaksi->area->decrement('terisi');
        }

        // CATAT LOG AKTIVITAS
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
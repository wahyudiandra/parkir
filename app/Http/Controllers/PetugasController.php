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

        // Sinkronisasi otomatis jumlah slot terisi di setiap area
        $areas = AreaParkir::all();
        foreach ($areas as $area) {
            $jumlahTerparkir = Transaksi::where('id_area', $area->id_area)
                ->where('status', 'masuk')
                ->count();

            if ($area->terisi != $jumlahTerparkir) {
                $area->update(['terisi' => $jumlahTerparkir]);
            }
        }

        // Ambil data master kendaraan (Admin) dan daftar tarif
        $kendaraans = Kendaraan::orderBy('plat_nomor', 'asc')->get();
        $listTarif  = Tarif::orderBy('jenis_kendaraan', 'asc')->get();
        $tarifs     = $listTarif->keyBy(function ($item) {
            return strtolower($item->jenis_kendaraan);
        });

        return view('petugas.transaksi', compact('transaksiAktif', 'areas', 'kendaraans', 'tarifs', 'listTarif'));
    }

    public function masukParkir(Request $request)
    {
        $request->validate([
            'plat_nomor' => 'required',
            'id_area'    => 'required'
        ]);

        $plat = strtoupper(trim($request->plat_nomor));

        // 1. Cek apakah plat nomor sudah terdaftar di Data Kendaraan (Admin)
        $kendaraan = Kendaraan::whereRaw('UPPER(plat_nomor) = ?', [$plat])->first();

        // 2. Cek apakah kendaraan dengan plat ini sedang terparkir (baik terdaftar maupun manual)
        $cekAktif = Transaksi::where('status', 'masuk')
            ->where(function ($query) use ($kendaraan, $plat) {
                if ($kendaraan) {
                    $query->where('id_kendaraan', $kendaraan->id_kendaraan);
                } else {
                    $query->whereRaw('UPPER(plat_manual) = ?', [$plat]);
                }
            })
            ->first();

        if ($cekAktif) {
            return back()->withErrors([
                'plat_nomor' => 'Kendaraan dengan plat ' . $plat . ' saat ini masih terparkir di dalam area!'
            ])->withInput();
        }

        // 3. Cek ketersediaan sisa slot pada area parkir
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

        if ($kendaraan) {
            // JALUR TERDAFTAR (Data Admin -> Tarif Murah)
            Transaksi::create([
                'id_kendaraan' => $kendaraan->id_kendaraan,
                'id_area'      => $area->id_area,
                'id_user'      => auth()->id(),
                'jenis_input'  => 'terdaftar',
                'waktu_masuk'  => Carbon::now(),
                'status'       => 'masuk'
            ]);

            $jenisLog = $kendaraan->jenis_kendaraan;
            $pesanSukses = 'Kendaraan ' . $plat . ' berhasil masuk — Data Admin (Tarif Murah).';
            $jenisInputLog = 'TERDAFTAR';
        } else {
            // JALUR MANUAL (TIDAK dimasukkan ke Data Kendaraan Admin -> Tarif Lebih Mahal)
            $request->validate([
                'jenis_kendaraan' => 'required'
            ], [
                'jenis_kendaraan.required' => 'Plat nomor belum terdaftar. Silakan pilih Jenis Kendaraan untuk input manual!'
            ]);

            $jenisManual   = strtoupper(trim($request->jenis_kendaraan));
            $warnaManual   = $request->warna ? trim($request->warna) : '-';
            $pemilikManual = $request->pemilik ? trim($request->pemilik) : 'Umum';

            Transaksi::create([
                'id_kendaraan'   => null,
                'plat_manual'    => $plat,
                'jenis_manual'   => $jenisManual,
                'warna_manual'   => $warnaManual,
                'pemilik_manual' => $pemilikManual,
                'id_area'        => $area->id_area,
                'id_user'        => auth()->id(),
                'jenis_input'    => 'manual',
                'waktu_masuk'    => Carbon::now(),
                'status'         => 'masuk'
            ]);

            $jenisLog = $jenisManual;
            $pesanSukses = 'Kendaraan ' . $plat . ' berhasil masuk — Input Manual (Tarif Umum).';
            $jenisInputLog = 'MANUAL';
        }

        $area->update(['terisi' => $jumlahTerparkir + 1]);

        LogAktivitas::create([
            'id_user'         => auth()->id(),
            'aktivitas'       => 'Input Masuk [' . $jenisInputLog . '] Plat: ' . $plat . ' (' . $jenisLog . ') di ' . $area->nama_area,
            'waktu_aktivitas' => Carbon::now()
        ]);

        return redirect()->route('petugas.transaksi')->with('success', $pesanSukses);
    }

    public function keluarParkir($id)
    {
        $transaksi = Transaksi::with(['kendaraan', 'area'])->findOrFail($id);
        
        $waktuMasuk  = Carbon::parse($transaksi->waktu_masuk);
        $waktuKeluar = Carbon::now();

        $totalMenit = $waktuMasuk->diffInMinutes($waktuKeluar);
        $durasiJam  = (int) ceil($totalMenit / 60);
        if ($durasiJam < 1) {
            $durasiJam = 1;
        }

        // Ambil jenis kendaraan dari relasi tb_kendaraan (terdaftar) atau kolom jenis_manual (manual)
        $jenisKendaraan = strtolower($transaksi->kendaraan->jenis_kendaraan ?? $transaksi->jenis_manual ?? 'motor');
        $platNomor      = $transaksi->kendaraan->plat_nomor ?? $transaksi->plat_manual ?? '-';

        $tarif = Tarif::whereRaw('LOWER(jenis_kendaraan) = ?', [$jenisKendaraan])->first();
        $tarifDasar = $tarif ? $tarif->tarif_per_jam : 2000;

        // Pembeda Tarif: Terdaftar (Murah) vs Manual (+Rp 1.000/jam lebih mahal)
        if ($transaksi->jenis_input === 'manual') {
            $biayaPerJam = $tarifDasar + 1000;
        } else {
            $biayaPerJam = $tarifDasar;
        }

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
            'aktivitas'       => 'Keluar [' . strtoupper($transaksi->jenis_input) . '] Plat: ' . $platNomor . ' (Durasi: ' . $durasiJam . ' Jam, Total: Rp ' . number_format($totalBiaya, 0, ',', '.') . ')',
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
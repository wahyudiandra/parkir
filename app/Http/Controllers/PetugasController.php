<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Kendaraan;
use App\Models\Tarif;
use App\Models\AreaParkir;

class PetugasController extends Controller
{
    public function transaksi()
    {
        $transaksiAktif = Transaksi::with(['kendaraan', 'tarif', 'area'])
                            ->where('status', 'masuk')
                            ->orderBy('id_parkir', 'desc')
                            ->get();

        $areas = AreaParkir::all();
        $tarifs = Tarif::all();
        $kendaraans = Kendaraan::all();

        return view('petugas.transaksi', compact('transaksiAktif', 'areas', 'tarifs', 'kendaraans'));
    }

    public function masukParkir(Request $request)
    {
        $request->validate([
            'plat_nomor' => 'required',
            'jenis_kendaraan' => 'required',
            'id_area' => 'required'
        ]);

        $platNomor = strtoupper($request->plat_nomor);

        // Cari atau buat kendaraan terdaftar
        $kendaraan = Kendaraan::firstOrCreate(
            ['plat_nomor' => $platNomor],
            [
                'jenis_kendaraan' => $request->jenis_kendaraan,
                'pemilik' => 'Umum',
                'id_user' => auth()->id()
            ]
        );

        // Cari tarif berdasarkan jenis kendaraan
        $tarif = Tarif::where('jenis_kendaraan', $request->jenis_kendaraan)->first();

        // Buat Transaksi Masuk
        Transaksi::create([
            'id_kendaraan' => $kendaraan->id_kendaraan,
            'waktu_masuk'  => now(),
            'id_tarif'     => $tarif ? $tarif->id_tarif : null,
            'status'       => 'masuk',
            'id_user'      => auth()->id(),
            'id_area'      => $request->id_area
        ]);

        // Tambah jumlah kendaraan terisi di area parkir
        $area = AreaParkir::find($request->id_area);
        if ($area) {
            $area->increment('terisi');
        }

        return redirect()->route('petugas.transaksi')->with('success', 'Kendaraan berhasil masuk parkir.');
    }

    public function keluarParkir(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $waktuMasuk = \Carbon\Carbon::parse($transaksi->waktu_masuk);
        $waktuKeluar = now();

        // Hitung durasi (minimal 1 jam)
        $durasiJam = ceil($waktuMasuk->diffInMinutes($waktuKeluar) / 60);
        if ($durasiJam < 1) $durasiJam = 1;

        $tarifPerJam = $transaksi->tarif ? $transaksi->tarif->tarif_per_jam : 2000;
        $totalBiaya = $durasiJam * $tarifPerJam;

        $transaksi->update([
            'waktu_keluar' => $waktuKeluar,
            'durasi_jam'   => $durasiJam,
            'biaya_total'  => $totalBiaya,
            'status'       => 'keluar'
        ]);

        // Kurangi jumlah kendaraan terisi di area parkir
        $area = AreaParkir::find($transaksi->id_area);
        if ($area && $area->terisi > 0) {
            $area->decrement('terisi');
        }

        return redirect()->route('petugas.struk', $transaksi->id_parkir);
    }

    public function struk($id = null)
    {
        if ($id) {
            $transaksi = Transaksi::with(['kendaraan', 'tarif', 'user', 'area'])->find($id);
        } else {
            $transaksi = Transaksi::with(['kendaraan', 'tarif', 'user', 'area'])
                        ->where('status', 'keluar')
                        ->latest('updated_at')
                        ->first();
        }

        return view('petugas.struk', compact('transaksi'));
    }
}
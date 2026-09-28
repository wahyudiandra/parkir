<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\AreaParkir;
use App\Models\TarifParkir;
use App\Models\ActivityLog;
use Carbon\Carbon;

class parkirController extends Controller
{
    // Transaksi Masuk & Cetak Struk (Petugas)
    public function transaksiMasuk(Request $request)
    {
        $request->validate([
            'plat_nomor' => 'required',
            'tarif_parkir_id' => 'required',
            'area_parkir_id' => 'required',
        ]);

        $transaksi = Transaksi::create([
            'kode_tiket' => 'TRX-' . strtoupper(uniqid()),
            'plat_nomor' => strtoupper($request->plat_nomor),
            'tarif_parkir_id' => $request->tarif_parkir_id,
            'area_parkir_id' => $request->area_parkir_id,
            'petugas_id' => auth()->id(),
            'waktu_masuk' => now(),
            'status' => 'masuk',
        ]);

        AreaParkir::find($request->area_parkir_id)->increment('terisi');

        return redirect()->route('petugas.struk', $transaksi->id);
    }

    // Transaksi Keluar (Petugas)
    public function transaksiKeluar(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $waktuMasuk = Carbon::parse($transaksi->waktu_masuk);
        $waktuKeluar = now();
        
        $durasiJam = max(1, $waktuMasuk->diffInHours($waktuKeluar));
        $totalBayar = $durasiJam * $transaksi->tarif->tarif_per_jam;

        $transaksi->update([
            'waktu_keluar' => $waktuKeluar,
            'total_bayar' => $totalBayar,
            'status' => 'keluar'
        ]);

        AreaParkir::find($transaksi->area_parkir_id)->decrement('terisi');

        return redirect()->back()->with('success', 'Transaksi Selesai');
    }

    // Rekap Transaksi Sesuai Waktu (Owner)
    public function rekapOwner(Request $request)
    {
        $query = Transaksi::with(['tarif', 'petugas'])->where('status', 'keluar');

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereBetween('waktu_keluar', [$request->tanggal_mulai, $request->tanggal_selesai]);
        }

        $rekap = $query->get();
        $totalPendapatan = $rekap->sum('total_bayar');

        return view('owner.rekap', compact('rekap', 'totalPendapatan'));
    }
}

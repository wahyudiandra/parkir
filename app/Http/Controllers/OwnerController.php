<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Carbon\Carbon;

class OwnerController extends Controller
{
    public function rekap(Request $request)
    {
        $now = Carbon::now('Asia/Jakarta');

        // 1. Rekap Hari Ini (Dari jam 00:00:00 sampai 23:59:59 hari ini)
        $queryHariIni = Transaksi::where('status', 'keluar')
            ->whereBetween('waktu_keluar', [
                $now->copy()->startOfDay()->format('Y-m-d H:i:s'),
                $now->copy()->endOfDay()->format('Y-m-d H:i:s')
            ]);
        $pendapatanHariIni = (int) $queryHariIni->sum('biaya_total');
        $transaksiHariIni = $queryHariIni->count();

        // 2. Rekap 7 Hari Terakhir
        $query7Hari = Transaksi::where('status', 'keluar')
            ->whereBetween('waktu_keluar', [
                $now->copy()->subDays(6)->startOfDay()->format('Y-m-d H:i:s'),
                $now->copy()->endOfDay()->format('Y-m-d H:i:s')
            ]);
        $pendapatan7Hari = (int) $query7Hari->sum('biaya_total');
        $transaksi7Hari = $query7Hari->count();

        // 3. Rekap Bulan Ini (Tanggal 1 bulan ini sampai hari ini)
        $queryBulanIni = Transaksi::where('status', 'keluar')
            ->whereBetween('waktu_keluar', [
                $now->copy()->startOfMonth()->startOfDay()->format('Y-m-d H:i:s'),
                $now->copy()->endOfDay()->format('Y-m-d H:i:s')
            ]);
        $pendapatanBulanIni = (int) $queryBulanIni->sum('biaya_total');
        $transaksiBulanIni = $queryBulanIni->count();

        // 4. Filter Rekap Kustom & Tabel Riwayat Transaksi
        $tglAwal = $request->input('tgl_awal');
        $tglAkhir = $request->input('tgl_akhir');

        $query = Transaksi::with(['kendaraan', 'area', 'user'])
            ->where('status', 'keluar');

        if ($tglAwal && $tglAkhir) {
            $query->whereBetween('waktu_keluar', [
                Carbon::parse($tglAwal)->startOfDay()->format('Y-m-d H:i:s'),
                Carbon::parse($tglAkhir)->endOfDay()->format('Y-m-d H:i:s')
            ]);
        } elseif ($tglAwal) {
            $query->where('waktu_keluar', '>=', Carbon::parse($tglAwal)->startOfDay()->format('Y-m-d H:i:s'));
        } elseif ($tglAkhir) {
            $query->where('waktu_keluar', '<=', Carbon::parse($tglAkhir)->endOfDay()->format('Y-m-d H:i:s'));
        }

        $transaksis = $query->orderBy('waktu_keluar', 'desc')->get();
        $totalPendapatanFilter = (int) $transaksis->sum('biaya_total');

        return view('owner.rekap', compact(
            'pendapatanHariIni',
            'transaksiHariIni',
            'pendapatan7Hari',
            'transaksi7Hari',
            'pendapatanBulanIni',
            'transaksiBulanIni',
            'transaksis',
            'totalPendapatanFilter',
            'tglAwal',
            'tglAkhir'
        ));
    }
}
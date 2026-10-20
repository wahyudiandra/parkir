<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class OwnerController extends Controller
{
    public function rekap() {
        $transaksis = Transaksi::with(['kendaraan', 'area', 'user', 'tarif'])
            ->where('status', 'keluar')
            ->latest()
            ->get();

        $totalPendapatan = $transaksis->sum('biaya_total');
        $totalSelesai = $transaksis->count();

        return view('owner.rekap', compact('transaksis', 'totalPendapatan', 'totalSelesai'));
    }
}
@extends('layout.app')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-white">Rekap Transaksi Parkir</h1>
        <div class="flex space-x-3">
            <input type="date" class="bg-slate-800 border border-slate-700 rounded-lg px-3 py-2 text-sm text-white">
            <input type="date" class="bg-slate-800 border border-slate-700 rounded-lg px-3 py-2 text-sm text-white">
            <button class="bg-emerald-600 px-4 py-2 rounded-lg text-sm font-semibold text-white hover:bg-emerald-500">Filter</button>
        </div>
    </div>

    <div class="bg-slate-800 border border-slate-700 p-6 rounded-2xl max-w-sm">
        <p class="text-slate-400 text-sm">Total Pendapatan</p>
        <p class="text-3xl font-extrabold text-emerald-400 mt-1">Rp 150.000</p>
    </div>

    <div class="bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden shadow-xl">
        <table class="w-full text-left text-sm text-slate-300">
            <thead class="bg-slate-700/50 text-slate-400 uppercase text-xs">
                <tr>
                    <th class="p-4">Kode Tiket</th>
                    <th class="p-4">Plat Nomor</th>
                    <th class="p-4">Waktu Masuk</th>
                    <th class="p-4">Waktu Keluar</th>
                    <th class="p-4">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700">
                <tr class="hover:bg-slate-700/30">
                    <td class="p-4 font-mono text-indigo-400">TRX-982134</td>
                    <td class="p-4 font-bold">B 1234 ABC</td>
                    <td class="p-4">2026-09-22 08:00</td>
                    <td class="p-4">2026-09-22 10:15</td>
                    <td class="p-4 text-emerald-400 font-semibold">Rp 15.000</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
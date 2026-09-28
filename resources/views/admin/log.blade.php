@extends('layout.app')

@section('content')
<div class="space-y-6">
    <h1 class="text-2xl font-bold text-white">Log Aktivitas Sistem</h1>

    <div class="bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden shadow-xl">
        <table class="w-full text-left text-sm text-slate-300">
            <thead class="bg-slate-700/50 text-slate-400 uppercase text-xs">
                <tr>
                    <th class="p-4">Waktu</th>
                    <th class="p-4">User</th>
                    <th class="p-4">Aktivitas</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700">
                <tr class="hover:bg-slate-700/30">
                    <td class="p-4 font-mono text-xs text-slate-400">2026-09-22 10:15:22</td>
                    <td class="p-4 font-medium text-indigo-400">Petugas Shift A</td>
                    <td class="p-4">Memproses transaksi keluar tiket TRX-982134</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
@extends('layout.app')

@section('content')
<div class="space-y-6">
    <h1 class="text-2xl font-bold text-white">Daftar Kendaraan Terdaftar</h1>

    <div class="bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden shadow-xl">
        <table class="w-full text-left text-sm text-slate-300">
            <thead class="bg-slate-700/50 text-slate-400 uppercase text-xs">
                <tr>
                    <th class="p-4">Plat Nomor</th>
                    <th class="p-4">Jenis Kendaraan</th>
                    <th class="p-4">Pemilik / Member</th>
                    <th class="p-4">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700">
                <tr class="hover:bg-slate-700/30">
                    <td class="p-4 font-bold">B 1234 ABC</td>
                    <td class="p-4">Mobil</td>
                    <td class="p-4">Umum</td>
                    <td class="p-4"><span class="bg-emerald-500/10 text-emerald-400 text-xs px-2.5 py-1 rounded-full">Di dalam</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
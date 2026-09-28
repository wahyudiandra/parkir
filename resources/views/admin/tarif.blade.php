@extends('layout.app')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-white">Kelola Tarif Parkir</h1>
        <button class="bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold px-4 py-2 rounded-lg">+ Tambah Tarif</button>
    </div>

    <div class="bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden shadow-xl">
        <table class="w-full text-left text-sm text-slate-300">
            <thead class="bg-slate-700/50 text-slate-400 uppercase text-xs">
                <tr>
                    <th class="p-4">Jenis Kendaraan</th>
                    <th class="p-4">Tarif 1 Jam Pertama</th>
                    <th class="p-4">Tarif Jam Berikutnya</th>
                    <th class="p-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700">
                <tr class="hover:bg-slate-700/30">
                    <td class="p-4 font-semibold">Motor</td>
                    <td class="p-4">Rp 2.000</td>
                    <td class="p-4">Rp 1.000 / Jam</td>
                    <td class="p-4 space-x-2">
                        <button class="text-xs bg-slate-700 hover:bg-slate-600 px-3 py-1.5 rounded">Edit</button>
                    </td>
                </tr>
                <tr class="hover:bg-slate-700/30">
                    <td class="p-4 font-semibold">Mobil</td>
                    <td class="p-4">Rp 5.000</td>
                    <td class="p-4">Rp 3.000 / Jam</td>
                    <td class="p-4 space-x-2">
                        <button class="text-xs bg-slate-700 hover:bg-slate-600 px-3 py-1.5 rounded">Edit</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
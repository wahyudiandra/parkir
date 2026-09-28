@extends('layout.app')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-white">Kelola Area Parkir</h1>
        <button class="bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold px-4 py-2 rounded-lg">+ Tambah Area</button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-slate-800 border border-slate-700 p-6 rounded-2xl">
            <h3 class="text-lg font-bold text-indigo-400">Lantai 1 - Area A</h3>
            <p class="text-slate-400 text-sm mt-1">Kapasitas: 50 Kendaraan</p>
            <div class="mt-4 pt-4 border-t border-slate-700 flex justify-between items-center">
                <span class="text-xs bg-emerald-500/20 text-emerald-400 px-2.5 py-1 rounded">Tersedia: 12</span>
                <button class="text-xs bg-slate-700 hover:bg-slate-600 px-3 py-1.5 rounded">Edit</button>
            </div>
        </div>
        <div class="bg-slate-800 border border-slate-700 p-6 rounded-2xl">
            <h3 class="text-lg font-bold text-indigo-400">Lantai 1 - Area B</h3>
            <p class="text-slate-400 text-sm mt-1">Kapasitas: 30 Kendaraan</p>
            <div class="mt-4 pt-4 border-t border-slate-700 flex justify-between items-center">
                <span class="text-xs bg-yellow-500/20 text-yellow-400 px-2.5 py-1 rounded">Penuh</span>
                <button class="text-xs bg-slate-700 hover:bg-slate-600 px-3 py-1.5 rounded">Edit</button>
            </div>
        </div>
    </div>
</div>
@endsection
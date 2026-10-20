@extends('layout.app')

@section('content')
<div class="space-y-6">
    <h1 class="text-3xl font-bold text-white">Dashboard Admin</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total User -->
        <div class="bg-slate-800/80 border border-slate-700/60 p-6 rounded-2xl shadow-xl space-y-2">
            <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">TOTAL USER</span>
            <div class="text-4xl font-extrabold text-indigo-400">{{ $totalUser }}</div>
        </div>

        <!-- Tarif Parkir Active -->
        <div class="bg-slate-800/80 border border-slate-700/60 p-6 rounded-2xl shadow-xl space-y-2">
            <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">TARIF PARKIR ACTIVE</span>
            <div class="text-4xl font-extrabold text-emerald-400">{{ $totalTarif }} Jenis</div>
        </div>

        <!-- Total Area Parkir -->
        <div class="bg-slate-800/80 border border-slate-700/60 p-6 rounded-2xl shadow-xl space-y-2">
            <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">TOTAL AREA PARKIR</span>
            <div class="text-4xl font-extrabold text-amber-400">{{ $totalArea }} Area</div>
        </div>

        <!-- Kendaraan Terparkir -->
        <div class="bg-slate-800/80 border border-slate-700/60 p-6 rounded-2xl shadow-xl space-y-2">
            <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">KENDARAAN TERPARKIR</span>
            <div class="text-4xl font-extrabold text-sky-400">{{ $kendaraanTerparkir }} Unit</div>
        </div>
    </div>
</div>
@endsection
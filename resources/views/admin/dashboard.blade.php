@extends('layout.app')

@section('content')
<div class="space-y-6">
    <h1 class="text-2xl font-bold text-white">Dashboard Admin</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-slate-800 border border-slate-700 p-5 rounded-2xl">
            <p class="text-xs text-slate-400 uppercase font-semibold">Total User</p>
            <p class="text-3xl font-extrabold text-indigo-400 mt-2">12</p>
        </div>
        <div class="bg-slate-800 border border-slate-700 p-5 rounded-2xl">
            <p class="text-xs text-slate-400 uppercase font-semibold">Tarif Parkir Active</p>
            <p class="text-3xl font-extrabold text-emerald-400 mt-2">3 Jenis</p>
        </div>
        <div class="bg-slate-800 border border-slate-700 p-5 rounded-2xl">
            <p class="text-xs text-slate-400 uppercase font-semibold">Total Area Parkir</p>
            <p class="text-3xl font-extrabold text-yellow-400 mt-2">5 Area</p>
        </div>
        <div class="bg-slate-800 border border-slate-700 p-5 rounded-2xl">
            <p class="text-xs text-slate-400 uppercase font-semibold">Kendaraan Terparkir</p>
            <p class="text-3xl font-extrabold text-sky-400 mt-2">48 Unit</p>
        </div>
    </div>
</div>
@endsection
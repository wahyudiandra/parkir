@extends('layout.app')

@section('content')
<div class="max-w-md mx-auto bg-slate-800 border border-slate-700 p-6 rounded-2xl shadow-2xl text-center space-y-4">
    <h2 class="text-xl font-bold text-indigo-400 tracking-wider">STRUK PARKIR</h2>
    <p class="text-xs text-slate-400">PARKIR.IO - Lokasi Mall Utama</p>

    <div class="bg-slate-900/60 p-4 rounded-xl border border-slate-700 text-left text-xs space-y-2 font-mono">
        <div class="flex justify-between"><span class="text-slate-400">Kode Tiket:</span> <span class="text-indigo-300 font-bold">TRX-982134</span></div>
        <div class="flex justify-between"><span class="text-slate-400">Plat Nomor:</span> <span class="text-white font-bold">B 1234 ABC</span></div>
        <div class="flex justify-between"><span class="text-slate-400">Waktu Masuk:</span> <span class="text-slate-300">2026-09-22 08:00</span></div>
        <div class="flex justify-between"><span class="text-slate-400">Area:</span> <span class="text-slate-300">Lantai 1 - A</span></div>
    </div>

    <button onclick="window.print()" class="w-full py-2.5 bg-slate-700 hover:bg-slate-600 text-white font-medium rounded-lg text-sm transition">
        Cetak Struk (Print)
    </button>
</div>
@endsection
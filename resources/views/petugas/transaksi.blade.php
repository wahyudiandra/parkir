@extends('layout.app')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-white">Input Transaksi Parkir</h1>
        <a href="{{ route('petugas.struk') }}" class="bg-indigo-600 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-indigo-500">Lihat Struk Terakhir</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Form Masuk -->
        <div class="bg-slate-800 border border-slate-700 p-6 rounded-2xl shadow-lg">
            <h2 class="text-lg font-bold text-indigo-400 mb-4">Kendaraan Masuk</h2>
            <form class="space-y-4">
                <div>
                    <label class="block text-xs font-medium text-slate-400 mb-1">Plat Nomor</label>
                    <input type="text" placeholder="Contoh: B 1234 ABC" class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2.5 text-white uppercase focus:outline-none focus:border-indigo-500">
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-400 mb-1">Jenis Kendaraan</label>
                    <select class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-indigo-500">
                        <option>Mobil</option>
                        <option>Motor</option>
                    </select>
                </div>
                <button type="button" class="w-full py-3 bg-indigo-600 hover:bg-indigo-500 rounded-lg font-semibold text-white transition">
                    Cetak Tiket Masuk
                </button>
            </form>
        </div>

        <!-- Form Keluar -->
        <div class="bg-slate-800 border border-slate-700 p-6 rounded-2xl shadow-lg">
            <h2 class="text-lg font-bold text-emerald-400 mb-4">Kendaraan Keluar</h2>
            <form class="space-y-4">
                <div>
                    <label class="block text-xs font-medium text-slate-400 mb-1">Cari Kode Tiket</label>
                    <input type="text" placeholder="TRX-XXXXXX" class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2.5 text-white uppercase focus:outline-none focus:border-emerald-500">
                </div>
                <button type="button" class="w-full py-3 bg-emerald-600 hover:bg-emerald-500 rounded-lg font-semibold text-white transition">
                    Proses & Bayar
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
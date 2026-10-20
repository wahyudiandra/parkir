@extends('layout.app')

@section('content')
<div class="max-w-md mx-auto space-y-6">
    <div class="flex justify-between items-center print:hidden">
        <h1 class="text-2xl font-bold text-white">Struk Pembayaran</h1>
        @if($transaksi)
            <button onclick="window.print()" class="bg-indigo-600 hover:bg-indigo-500 text-white font-semibold px-4 py-2 rounded-lg text-sm">
                Cetak Struk
            </button>
        @endif
    </div>

    @if(!$transaksi)
        <div class="bg-slate-800 border border-slate-700 rounded-2xl p-8 text-center space-y-3">
            <p class="text-slate-400 text-sm">Belum ada transaksi parkir yang selesai/keluar untuk dicetak.</p>
            <a href="{{ route('petugas.transaksi') }}" class="inline-block bg-indigo-600 hover:bg-indigo-500 text-white text-xs px-4 py-2 rounded-lg font-semibold">
                Kembali ke Transaksi
            </a>
        </div>
    @else
        <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 space-y-6 shadow-2xl text-slate-200">
            <div class="text-center space-y-1">
                <h2 class="text-2xl font-black text-white">PARKIR.IO</h2>
                <p class="text-xs text-slate-400">Struk Pembayaran Parkir Resmi</p>
            </div>

            <div class="border-t border-b border-slate-700 py-4 space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-slate-400">ID Parkir:</span>
                    <span class="font-bold text-white">#TRX-{{ $transaksi->id_parkir }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400">Plat Nomor:</span>
                    <span class="font-bold text-white uppercase">{{ $transaksi->kendaraan->plat_nomor ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400">Jenis Kendaraan:</span>
                    <span class="font-semibold text-indigo-400 uppercase">{{ $transaksi->kendaraan->jenis_kendaraan ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400">Area Parkir:</span>
                    <span class="text-slate-200">{{ $transaksi->area->nama_area ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400">Petugas:</span>
                    <span class="text-slate-200">{{ $transaksi->user->nama_lengkap ?? 'Petugas' }}</span>
                </div>
            </div>

            <div class="space-y-2 text-sm">
                <div class="flex justify-between text-xs text-slate-400">
                    <span>Waktu Masuk:</span>
                    <span>{{ $transaksi->waktu_masuk }}</span>
                </div>
                <div class="flex justify-between text-xs text-slate-400">
                    <span>Waktu Keluar:</span>
                    <span>{{ $transaksi->waktu_keluar ?? '-' }}</span>
                </div>
                <div class="flex justify-between text-xs text-slate-400">
                    <span>Durasi:</span>
                    <span>{{ $transaksi->durasi_jam ?? 1 }} Jam</span>
                </div>
            </div>

            <div class="border-t border-slate-700 pt-4 flex justify-between items-center">
                <span class="font-bold text-slate-300">Total Biaya:</span>
                <span class="text-2xl font-black text-emerald-400">Rp {{ number_format($transaksi->biaya_total ?? 0, 0, ',', '.') }}</span>
            </div>

            <p class="text-center text-[10px] text-slate-500 pt-2">Terima kasih atas kunjungan Anda!</p>
        </div>
    @endif
</div>
@endsection
@extends('layout.app')

@section('content')
<style>
    @media print {
        /* Sembunyikan seluruh elemen halaman saat mode cetak */
        body * {
            visibility: hidden;
        }

        /* Tampilkan hanya kartu struk pembayaran beserta seluruh isinya */
        #area-struk,
        #area-struk * {
            visibility: visible;
        }

        /* Posisikan struk di tengah atas kertas dengan ukuran proporsional struk */
        #area-struk {
            position: fixed;
            left: 50%;
            top: 20px;
            transform: translateX(-50%);
            width: 360px;
            max-width: 100%;
            background: #ffffff !important;
            color: #0f172a !important;
            border: 2px dashed #94a3b8 !important;
            box-shadow: none !important;
            padding: 24px !important;
            margin: 0 !important;
        }

        /* Pastikan seluruh teks terlihat tajam di atas kertas putih */
        #area-struk h2,
        #area-struk span,
        #area-struk p,
        #area-struk div {
            color: #0f172a !important;
        }

        #area-struk .text-indigo-400 {
            color: #4f46e5 !important;
        }

        #area-struk .text-emerald-400 {
            color: #059669 !important;
        }

        #area-struk .text-amber-400 {
            color: #d97706 !important;
        }

        #area-struk .border-slate-700 {
            border-color: #cbd5e1 !important;
        }
    }
</style>

<div class="max-w-lg mx-auto space-y-6">
    <!-- Header Halaman -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">Struk Pembayaran</h1>
            <p class="text-xs text-slate-400">Bukti pembayaran parkir kendaraan keluar</p>
        </div>
        @if($transaksi)
        <button onclick="window.print()" class="bg-indigo-600 hover:bg-indigo-500 text-white font-bold px-4 py-2 rounded-lg text-xs uppercase tracking-wider flex items-center gap-2 shadow-lg shadow-indigo-600/30 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
            </svg>
            Cetak Struk
        </button>
        @endif
    </div>

    @if(session('success'))
        <div class="bg-emerald-500/20 border border-emerald-500 text-emerald-300 p-4 rounded-xl text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if($transaksi)
    <!-- KARTU STRUK PEMBAYARAN (Hanya bagian ini yang akan tercetak) -->
    <div id="area-struk" class="bg-slate-800 border border-slate-700 rounded-2xl p-6 sm:p-8 shadow-2xl space-y-6">
        <!-- Kop Struk -->
        <div class="text-center border-b border-dashed border-slate-700 pb-5 space-y-1">
            <h2 class="text-2xl font-extrabold tracking-widest text-white">PARKIR.IO</h2>
            <p class="text-xs text-slate-400">Struk Pembayaran Parkir Resmi</p>
        </div>

        <!-- Detail Informasi Kendaraan & Petugas -->
        <div class="space-y-3 text-sm border-b border-dashed border-slate-700 pb-5">
            <div class="flex justify-between">
                <span class="text-slate-400">ID Parkir:</span>
                <span class="font-mono font-bold text-white">#TRX-{{ $transaksi->id_parkir }}</span>
            </div>
            <div class="flex justify-between">
                 <span class="text-slate-400">Plat Nomor:</span>
                <span class="font-bold text-white uppercase">{{ $transaksi->kendaraan->plat_nomor ?? $transaksi->plat_manual ?? '-' }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-400">Jenis Kendaraan:</span>
                <span class="font-bold text-indigo-400 uppercase">{{ $transaksi->kendaraan->jenis_kendaraan ?? $transaksi->jenis_manual ?? '-' }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-400">Area Parkir:</span>
                <span class="text-slate-200">{{ $transaksi->area->nama_area ?? '-' }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-400">Kategori Tarif:</span>
                <span class="font-bold uppercase {{ ($transaksi->jenis_input ?? 'terdaftar') === 'manual' ? 'text-amber-400' : 'text-emerald-400' }}">
                    {{ ($transaksi->jenis_input ?? 'terdaftar') === 'manual' ? 'Manual (Umum)' : 'Terdaftar (Member)' }}
                </span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-400">Petugas:</span>
                <span class="text-slate-200">{{ $transaksi->user->nama_lengkap ?? ($transaksi->user->username ?? '-') }}</span>
            </div>
        </div>

        <!-- Detail Waktu & Durasi -->
        <div class="space-y-3 text-sm border-b border-dashed border-slate-700 pb-5">
            <div class="flex justify-between">
                <span class="text-slate-400">Waktu Masuk:</span>
                <span class="font-mono text-xs text-slate-300">{{ $transaksi->waktu_masuk }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-400">Waktu Keluar:</span>
                <span class="font-mono text-xs text-slate-300">{{ $transaksi->waktu_keluar }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-400">Durasi:</span>
                <span class="font-semibold text-slate-200">{{ $transaksi->durasi_jam ?? 1 }} Jam</span>
            </div>
        </div>

        <!-- Total Biaya -->
        <div class="flex items-center justify-between pt-1">
            <span class="text-base font-bold text-white">Total Biaya:</span>
            <span class="text-2xl font-extrabold text-emerald-400">
                Rp {{ number_format($transaksi->biaya_total ?? 0, 0, ',', '.') }}
            </span>
        </div>

        <!-- Footer Struk -->
        <div class="text-center pt-4 border-t border-dashed border-slate-700">
            <p class="text-[11px] text-slate-500">Terima kasih atas kunjungan Anda!</p>
        </div>
    </div>

    <div class="text-center">
        <a href="{{ route('petugas.transaksi') }}" class="text-xs font-semibold text-indigo-400 hover:text-indigo-300">
            &larr; Kembali ke Transaksi Parkir
        </a>
    </div>
    @else
    <div class="bg-slate-800 border border-slate-700 rounded-2xl p-8 text-center text-slate-400 text-sm">
        Belum ada data transaksi keluar yang dapat dicetak.
    </div>
    @endif
</div>
@endsection
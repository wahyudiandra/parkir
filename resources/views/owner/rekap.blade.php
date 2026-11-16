@extends('layout.app')

@section('content')
<style>
    @media print {
        /* Sembunyikan semua elemen di halaman saat mode cetak */
        body * {
            visibility: hidden;
        }

        /* Tampilkan hanya area Laporan Pendapatan Parkir dan isinya */
        #laporan-periode,
        #laporan-periode * {
            visibility: visible;
        }

        /* Posisikan laporan di pojok kiri atas kertas cetak */
        #laporan-periode {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            background: #ffffff !important;
            color: #0f172a !important;
            border: 2px solid #cbd5e1 !important;
            box-shadow: none !important;
            padding: 24px !important;
            margin: 0 !important;
        }

        /* Sesuaikan warna teks dan tabel agar tajam saat dicetak hitam-putih maupun warna */
        #laporan-periode h2 {
            color: #0f172a !important;
        }
        #laporan-periode p,
        #laporan-periode td {
            color: #334155 !important;
        }
        #laporan-periode span.text-indigo-400 {
            color: #4f46e5 !important;
        }
        #laporan-periode td.text-emerald-400 {
            color: #059669 !important;
        }
        #laporan-periode table,
        #laporan-periode tr,
        #laporan-periode td {
            background: #ffffff !important;
            border-color: #cbd5e1 !important;
        }

        /* Sembunyikan tombol cetak saat proses print */
        .no-print {
            display: none !important;
        }
    }
</style>

<div class="space-y-6">
    <!-- Header Halaman -->
    <div>
        <h1 class="text-2xl font-bold text-white">Rekap Pendapatan & Transaksi</h1>
        <p class="text-xs text-slate-400">Ringkasan pendapatan parkir harian, mingguan, bulanan, dan filter kustom</p>
    </div>

    <!-- Grid Utama: Kartu Ringkasan (Kiri) & Filter Kustom (Kanan) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Kolom Kiri (2/3 lebar): Kartu Hari Ini, 7 Hari Terakhir, dan Bulan Ini -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Baris Atas: Hari Ini & 7 Hari Terakhir -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Kartu: Hari Ini -->
                <div class="bg-gradient-to-br from-emerald-600 to-emerald-700 rounded-2xl p-6 text-white shadow-xl relative overflow-hidden">
                    <div class="relative z-10">
                        <span class="text-xs font-bold uppercase tracking-wider text-emerald-100">Hari Ini</span>
                        <div class="text-3xl font-extrabold mt-2">
                            Rp {{ number_format($pendapatanHariIni ?? 0, 0, ',', '.') }}
                        </div>
                        <div class="mt-4 inline-flex items-center gap-1.5 bg-emerald-800/50 border border-emerald-400/30 px-3 py-1 rounded-lg text-xs font-semibold text-emerald-100">
                            <span>{{ $transaksiHariIni ?? 0 }} Transaksi</span>
                        </div>
                    </div>
                    <svg class="w-20 h-20 text-emerald-900/30 absolute -right-2 -bottom-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>

                <!-- Kartu: 7 Hari Terakhir -->
                <div class="bg-gradient-to-br from-purple-600 to-indigo-700 rounded-2xl p-6 text-white shadow-xl relative overflow-hidden">
                    <div class="relative z-10">
                        <span class="text-xs font-bold uppercase tracking-wider text-purple-100">7 Hari Terakhir</span>
                        <div class="text-3xl font-extrabold mt-2">
                            Rp {{ number_format($pendapatan7Hari ?? 0, 0, ',', '.') }}
                        </div>
                        <div class="mt-4 inline-flex items-center gap-1.5 bg-purple-900/50 border border-purple-400/30 px-3 py-1 rounded-lg text-xs font-semibold text-purple-100">
                            <span>{{ $transaksi7Hari ?? 0 }} Transaksi</span>
                        </div>
                    </div>
                    <svg class="w-20 h-20 text-purple-950/30 absolute -right-2 -bottom-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>

            </div>

            <!-- Baris Bawah: Total Pendapatan Bulan Ini -->
            <div class="bg-gradient-to-r from-sky-600 to-blue-700 rounded-2xl p-6 text-white shadow-xl relative overflow-hidden">
                <div class="relative z-10">
                    <span class="text-xs font-bold uppercase tracking-wider text-sky-100">Total Pendapatan Bulan Ini</span>
                    <div class="text-4xl font-extrabold mt-2">
                        Rp {{ number_format($pendapatanBulanIni ?? 0, 0, ',', '.') }}
                    </div>
                    <p class="text-xs text-sky-100/90 mt-3 flex items-center gap-1.5">
                        <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Akumulasi {{ $transaksiBulanIni ?? 0 }} transaksi dari tanggal 1 bulan berjalan.</span>
                    </p>
                </div>
                <svg class="w-28 h-28 text-blue-950/30 absolute right-4 bottom-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
            </div>

        </div>

        <!-- Kolom Kanan (1/3 lebar): Filter Rekap Kustom & Catatan -->
        <div class="space-y-4">
            <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 shadow-xl">
                <h2 class="text-sm font-bold text-white flex items-center gap-2 mb-4">
                    <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                    </svg>
                    Filter Rekap Kustom
                </h2>

                <form action="{{ route('owner.rekap') }}" method="GET" class="space-y-4">
                    <div>
                        <label class="block text-[11px] font-bold uppercase text-slate-400 mb-1">Dari Tanggal</label>
                        <input type="date" name="tgl_awal" value="{{ $tglAwal ?? '' }}" class="w-full bg-slate-700 border border-slate-600 text-white rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-indigo-500">
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold uppercase text-slate-400 mb-1">Sampai Tanggal</label>
                        <input type="date" name="tgl_akhir" value="{{ $tglAkhir ?? '' }}" class="w-full bg-slate-700 border border-slate-600 text-white rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-indigo-500">
                    </div>

                    <div class="pt-1 space-y-2">
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-2.5 px-4 rounded-lg text-xs uppercase tracking-wider transition-colors flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Lihat Rekap Sekarang
                        </button>

                        @if($tglAwal || $tglAkhir)
                            <a href="{{ route('owner.rekap') }}" class="block w-full text-center bg-slate-700 hover:bg-slate-600 text-slate-300 font-semibold py-2 rounded-lg text-xs">
                                Reset Filter
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Box Catatan -->
            <div class="bg-amber-500/10 border border-amber-500/30 rounded-xl p-4 text-xs text-amber-300 leading-relaxed">
                <strong>Catatan:</strong> Data yang tampil hanya mencakup kendaraan yang statusnya sudah <strong>Keluar</strong> dan pembayaran telah selesai.
            </div>
        </div>

    </div>

    <!-- PANEL HASIL LAPORAN PENDAPATAN PARKIR (Hanya bagian ini yang akan tercetak) -->
    @if($tglAwal || $tglAkhir)
    <div id="laporan-periode" class="bg-slate-800 border-2 border-indigo-500/50 rounded-2xl p-6 sm:p-8 shadow-2xl space-y-6">
        <!-- Judul & Periode Laporan -->
        <div class="text-center space-y-1 border-b border-slate-700 pb-5">
            <h2 class="text-xl sm:text-2xl font-extrabold tracking-wide text-white uppercase">
                LAPORAN PENDAPATAN PARKIR
            </h2>
            <p class="text-xs sm:text-sm font-semibold text-slate-400">
                Periode: 
                <span class="text-indigo-400">
                    {{ $tglAwal ? \Carbon\Carbon::parse($tglAwal)->format('d M Y') : 'Awal' }} 
                    - 
                    {{ $tglAkhir ? \Carbon\Carbon::parse($tglAkhir)->format('d M Y') : 'Sekarang' }}
                </span>
            </p>
        </div>

        <!-- Tabel Ringkasan Unit & Total Pendapatan -->
        <div class="max-w-3xl mx-auto overflow-hidden rounded-xl border border-slate-700">
            <table class="w-full text-sm">
                <tbody class="divide-y divide-slate-700 bg-slate-800/80">
                    <tr>
                        <td class="p-4 sm:px-6 font-bold text-slate-300">Jumlah Kendaraan Keluar</td>
                        <td class="p-4 sm:px-6 text-right font-semibold text-slate-200">{{ $transaksis->count() }} Unit</td>
                    </tr>
                    <tr class="bg-slate-700/30">
                        <td class="p-4 sm:px-6 font-bold text-slate-300">Total Pendapatan</td>
                        <td class="p-4 sm:px-6 text-right font-extrabold text-lg text-emerald-400">
                            Rp {{ number_format($totalPendapatanFilter ?? 0, 0, ',', '.') }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Tombol Cetak Laporan -->
        <div class="flex justify-center no-print">
            <button onclick="window.print()" class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold px-5 py-2.5 rounded-lg text-xs uppercase tracking-wider flex items-center gap-2 transition-colors shadow-lg shadow-emerald-600/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Cetak Laporan Periode Ini
            </button>
        </div>
    </div>
    @endif

    <!-- Tabel Rincian Riwayat Transaksi -->
    <div class="bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden shadow-xl">
        <div class="p-4 bg-slate-700/30 border-b border-slate-700 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div>
                <h2 class="text-sm font-bold text-white uppercase tracking-wider">
                    {{ ($tglAwal || $tglAkhir) ? 'Rincian Transaksi Sesuai Periode' : 'Semua Riwayat Transaksi Keluar' }}
                </h2>
            </div>
            <div class="text-sm font-semibold text-slate-300">
                Total Periode Ini: <span class="text-emerald-400 font-extrabold text-base">Rp {{ number_format($totalPendapatanFilter ?? 0, 0, ',', '.') }}</span>
            </div>
        </div>

        <table class="w-full text-left text-sm text-slate-300">
            <thead class="bg-slate-700/50 text-slate-400 uppercase text-xs">
                <tr>
                    <th class="p-4">KODE TIKET</th>
                    <th class="p-4">PLAT NOMOR</th>
                    <th class="p-4">WAKTU MASUK</th>
                    <th class="p-4">WAKTU KELUAR</th>
                    <th class="p-4 text-right">TOTAL</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700">
                @forelse($transaksis as $t)
                <tr class="hover:bg-slate-700/30">
                    <td class="p-4 font-mono font-medium text-indigo-400">TRX-{{ str_pad($t->id_parkir, 6, '0', STR_PAD_LEFT) }}</td>
                    <td class="p-4 font-bold text-white uppercase">{{ $t->kendaraan->plat_nomor ?? '-' }}</td>
                    <td class="p-4 text-xs font-mono text-slate-400">{{ $t->waktu_masuk }}</td>
                    <td class="p-4 text-xs font-mono text-slate-400">{{ $t->waktu_keluar }}</td>
                    <td class="p-4 text-right font-bold text-emerald-400">Rp {{ number_format($t->biaya_total, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-slate-500">Tidak ada riwayat transaksi parkir pada periode ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
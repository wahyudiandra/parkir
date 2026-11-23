@extends('layout.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-white">Transaksi Parkir (Petugas)</h1>
            <p class="text-xs text-slate-400">Input kendaraan masuk (otomatis data admin / manual baru) dan proses transaksi keluar</p>
        </div>
        <button onclick="bukaModalMasuk()" class="bg-indigo-600 hover:bg-indigo-500 text-white font-semibold px-4 py-2.5 rounded-lg text-sm shadow-lg shadow-indigo-600/30 transition-colors">
            + Input Parkir Masuk
        </button>
    </div>

    @if(session('success'))
        <div class="bg-emerald-500/20 border border-emerald-500 text-emerald-300 p-4 rounded-xl text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-rose-500/20 border border-rose-500 text-rose-300 p-4 rounded-xl text-sm">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Tabel Kendaraan Terparkir (Aktif) -->
    <div class="bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden shadow-xl">
        <div class="p-4 bg-slate-700/30 border-b border-slate-700 flex justify-between items-center">
            <h2 class="text-sm font-bold text-white uppercase tracking-wider">Kendaraan Sedang Terparkir</h2>
            <span class="text-xs bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 px-3 py-1 rounded-full font-semibold">
                Total Terparkir: {{ $transaksiAktif->count() }} Kendaraan
            </span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-300">
                <thead class="bg-slate-700/50 text-slate-400 uppercase text-xs">
                    <tr>
                        <th class="p-4">PLAT NOMOR</th>
                        <th class="p-4">JENIS KENDARAAN</th>
                        <th class="p-4">KATEGORI TARIF</th>
                        <th class="p-4">AREA PARKIR</th>
                        <th class="p-4">WAKTU MASUK</th>
                        <th class="p-4 text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    @forelse($transaksiAktif as $t)
                    <tr class="hover:bg-slate-700/30">
                        <<td class="p-4 font-bold text-white uppercase">{{ $t->kendaraan->plat_nomor ?? $t->plat_manual ?? '-' }}</td>
                        <td class="p-4 uppercase font-semibold text-indigo-400">{{ $t->kendaraan->jenis_kendaraan ?? $t->jenis_manual ?? '-' }}</td>
                        <td class="p-4">
                            @if($t->jenis_input === 'manual')
                                <span class="bg-amber-500/20 text-amber-300 border border-amber-500/40 text-xs px-2.5 py-1 rounded-full font-bold">
                                    MANUAL (+Rp 1.000/Jam)
                                </span>
                            @else
                                <span class="bg-emerald-500/20 text-emerald-300 border border-emerald-500/40 text-xs px-2.5 py-1 rounded-full font-bold">
                                    TERDAFTAR (Murah)
                                </span>
                            @endif
                        </td>
                        <td class="p-4 text-slate-300">{{ $t->area->nama_area ?? '-' }}</td>
                        <td class="p-4 text-xs font-mono text-slate-400">{{ $t->waktu_masuk }}</td>
                        <td class="p-4 text-center">
                            <form action="{{ route('petugas.transaksi.keluar', $t->id_parkir) }}" method="POST" onsubmit="return confirm('Proses kendaraan keluar dan cetak struk?')">
                                @csrf
                                <button type="submit" class="bg-emerald-600 hover:bg-emerald-500 text-white text-xs px-3 py-1.5 rounded font-bold shadow-lg shadow-emerald-600/20">
                                    Proses Keluar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-4 text-center text-slate-500">Belum ada kendaraan yang sedang terparkir.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Input Parkir Masuk (Otomatis Data Admin & Input Manual Baru) -->
<div id="modalMasuk" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
    <div class="bg-slate-800 border border-slate-700 rounded-2xl max-w-md w-full p-6 space-y-4 shadow-2xl">
        <div>
            <h2 class="text-xl font-bold text-white">Input Kendaraan Masuk</h2>
            <p class="text-xs text-slate-400 mt-0.5">Cari plat nomor terdaftar atau ketik plat baru untuk input manual</p>
        </div>

        <form action="{{ route('petugas.transaksi.masuk') }}" method="POST" class="space-y-4">
            @csrf
            
            <!-- Pencarian / Input Plat Nomor -->
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Cari Plat Nomor Terdaftar / Baru</label>
                <input 
                    type="text" 
                    id="input_plat_nomor" 
                    name="plat_nomor" 
                    list="daftar_plat" 
                    placeholder="KETIK ATAU PILIH PLAT NOMOR..." 
                    autocomplete="off"
                    oninput="cekDataKendaraan(this.value)"
                    required 
                    class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2.5 text-white text-sm uppercase font-semibold focus:outline-none focus:border-indigo-500"
                >
                <datalist id="daftar_plat">
                    @foreach($kendaraans as $k)
                        <option value="{{ strtoupper($k->plat_nomor) }}">
                            {{ strtoupper($k->jenis_kendaraan) }} - {{ $k->pemilik ?? 'Terdaftar' }}
                        </option>
                    @endforeach
                </datalist>
            </div>

            <!-- Kotak Info Otomatis / Form Input Manual -->
            <div class="bg-slate-900/70 border border-slate-700 rounded-xl p-3.5 text-xs space-y-2">
                <div id="status_pencarian" class="text-slate-400 italic">
                    Ketik plat nomor untuk memuat jenis kendaraan dan tarif otomatis...
                </div>

                <!-- Tampilan Jika Terdaftar di Admin (Tarif Murah) -->
                <div id="detail_kendaraan" class="hidden space-y-1.5">
                    <div class="flex items-center justify-between pb-1 border-b border-slate-700/70">
                        <span class="text-emerald-400 font-semibold">✓ Data Admin (Tarif Murah)</span>
                        <span id="auto_jenis" class="font-bold text-indigo-400 uppercase">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">Pemilik / Warna:</span>
                        <span id="auto_pemilik" class="text-slate-200">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">Tarif Berlaku:</span>
                        <span id="auto_tarif" class="font-bold text-emerald-400">-</span>
                    </div>
                </div>

                <!-- Tampilan Jika Tidak Terdaftar (Input Manual - Tarif Lebih Mahal) -->
                <div id="form_manual_baru" class="hidden space-y-3">
                    <div class="text-amber-400 font-semibold">
                        ! Plat belum terdaftar — Input Manual (Tarif +Rp 1.000/Jam):
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-300 mb-1">Jenis Kendaraan <span class="text-rose-400">*</span></label>
                        <select id="select_jenis_manual" name="jenis_kendaraan" class="w-full bg-slate-700 border border-slate-600 rounded-lg px-3 py-2 text-white text-xs uppercase focus:outline-none focus:border-amber-500">
                            <option value="" disabled selected>-- Pilih Jenis Kendaraan --</option>
                            @foreach($listTarif as $t)
                                <option value="{{ $t->jenis_kendaraan }}">
                                    {{ strtoupper($t->jenis_kendaraan) }} — Rp {{ number_format($t->tarif_per_jam + 1000, 0, ',', '.') }}/Jam (Tarif Manual)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block text-xs font-medium text-slate-400 mb-1">Warna (Opsional)</label>
                            <input type="text" name="warna" placeholder="Hitam / Putih" class="w-full bg-slate-700 border border-slate-600 rounded-lg px-3 py-1.5 text-white text-xs focus:outline-none focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-400 mb-1">Pemilik (Opsional)</label>
                            <input type="text" name="pemilik" placeholder="Umum" class="w-full bg-slate-700 border border-slate-600 rounded-lg px-3 py-1.5 text-white text-xs focus:outline-none focus:border-indigo-500">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pilihan Area Parkir -->
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Area Parkir</label>
                <select name="id_area" required class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2.5 text-white text-sm focus:outline-none focus:border-indigo-500">
                    <option value="" disabled selected>-- Pilih Area Parkir --</option>
                    @foreach($areas as $ar)
                        @php
                            $sisaSlot = max(0, $ar->kapasitas - $ar->terisi);
                        @endphp
                        <option value="{{ $ar->id_area }}" {{ $sisaSlot == 0 ? 'disabled' : '' }}>
                            {{ $ar->nama_area }} — Terisi: {{ $ar->terisi }}/{{ $ar->kapasitas }} (Sisa: {{ $sisaSlot }} Slot) {{ $sisaSlot == 0 ? '[PENUH]' : '' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex space-x-2 pt-2">
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-2.5 rounded-lg text-sm transition-colors">
                    Simpan Transaksi
                </button>
                <button type="button" onclick="document.getElementById('modalMasuk').classList.add('hidden')" class="w-full bg-slate-700 hover:bg-slate-600 text-slate-300 font-semibold py-2.5 rounded-lg text-sm">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const dataKendaraan = @json($kendaraans);
    const dataTarif = @json($tarifs);

    function bukaModalMasuk() {
        document.getElementById('input_plat_nomor').value = '';
        document.getElementById('detail_kendaraan').classList.add('hidden');
        document.getElementById('form_manual_baru').classList.add('hidden');
        document.getElementById('select_jenis_manual').required = false;
        document.getElementById('status_pencarian').classList.remove('hidden');
        document.getElementById('modalMasuk').classList.remove('hidden');
        setTimeout(() => document.getElementById('input_plat_nomor').focus(), 100);
    }

    function cekDataKendaraan(inputVal) {
        const platCari = inputVal.trim().toUpperCase();
        const statusEl = document.getElementById('status_pencarian');
        const detailEl = document.getElementById('detail_kendaraan');
        const manualEl = document.getElementById('form_manual_baru');
        const selectJenis = document.getElementById('select_jenis_manual');

        if (!platCari) {
            detailEl.classList.add('hidden');
            manualEl.classList.add('hidden');
            selectJenis.required = false;
            statusEl.classList.remove('hidden');
            return;
        }

        const ditemukan = dataKendaraan.find(item => item.plat_nomor.toUpperCase() === platCari);

        if (ditemukan) {
            const jenisKey = (ditemukan.jenis_kendaraan || '').toLowerCase();
            const tarifObj = dataTarif[jenisKey];
            const nominalMurah = tarifObj ? Number(tarifObj.tarif_per_jam).toLocaleString('id-ID') : '2.000';

            document.getElementById('auto_jenis').textContent = ditemukan.jenis_kendaraan;
            document.getElementById('auto_pemilik').textContent = (ditemukan.pemilik || 'Terdaftar') + ' (' + (ditemukan.warna || '-') + ')';
            document.getElementById('auto_tarif').textContent = 'Rp ' + nominalMurah + ' / Jam (Tarif Murah)';

            statusEl.classList.add('hidden');
            manualEl.classList.add('hidden');
            selectJenis.required = false;
            detailEl.classList.remove('hidden');
        } else {
            statusEl.classList.add('hidden');
            detailEl.classList.add('hidden');
            manualEl.classList.remove('hidden');
            selectJenis.required = true;
        }
    }
</script>
@endsection
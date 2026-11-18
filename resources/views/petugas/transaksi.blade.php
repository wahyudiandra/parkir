@extends('layout.app')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-white">Transaksi Parkir (Petugas)</h1>
            <p class="text-xs text-slate-400">Input kendaraan masuk dan proses transaksi keluar</p>
        </div>
        <button onclick="bukaModalMasuk()" class="bg-indigo-600 hover:bg-indigo-500 text-white font-semibold px-4 py-2 rounded-lg text-sm shadow-lg shadow-indigo-600/30 transition-colors">
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
        <table class="w-full text-left text-sm text-slate-300">
            <thead class="bg-slate-700/50 text-slate-400 uppercase text-xs">
                <tr>
                    <th class="p-4">PLAT NOMOR</th>
                    <th class="p-4">JENIS KENDARAAN</th>
                    <th class="p-4">AREA PARKIR</th>
                    <th class="p-4">WAKTU MASUK</th>
                    <th class="p-4 text-center">AKSI</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700">
                @forelse($transaksiAktif as $t)
                <tr class="hover:bg-slate-700/30">
                    <td class="p-4 font-bold text-white uppercase">{{ $t->kendaraan->plat_nomor ?? '-' }}</td>
                    <td class="p-4 uppercase font-semibold text-indigo-400">{{ $t->kendaraan->jenis_kendaraan ?? '-' }}</td>
                    <td class="p-4 text-slate-300">{{ $t->area->nama_area ?? '-' }}</td>
                    <td class="p-4 text-xs font-mono text-slate-400">{{ $t->waktu_masuk }}</td>
                    <td class="p-4 text-center">
                        <form action="{{ route('petugas.transaksi.keluar', $t->id_parkir) }}" method="POST" onsubmit="return confirm('Proses kendaraan keluar dan cetak struk?')">
                            @csrf
                            <button type="submit" class="bg-emerald-600 hover:bg-emerald-500 text-white text-xs px-3 py-1.5 rounded font-bold shadow-lg shadow-emerald-600/30">
                                Proses Keluar
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-slate-500">Belum ada kendaraan yang sedang terparkir.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Input Parkir Masuk (Pencarian Plat Otomatis) -->
<div id="modalMasuk" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
    <div class="bg-slate-800 border border-slate-700 rounded-2xl max-w-md w-full p-6 space-y-4 shadow-2xl">
        <div>
            <h2 class="text-xl font-bold text-white">Input Kendaraan Masuk</h2>
            <p class="text-xs text-slate-400 mt-0.5">Cari plat nomor terdaftar dan tentukan area parkir</p>
        </div>

        <form action="{{ route('petugas.transaksi.masuk') }}" method="POST" class="space-y-4">
            @csrf
            
            <!-- Pencarian Plat Nomor -->
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Cari Plat Nomor Terdaftar</label>
                <input 
                    type="text" 
                    id="input_plat_nomor" 
                    name="plat_nomor" 
                    list="daftar_plat" 
                    placeholder="Ketik atau pilih plat nomor..." 
                    autocomplete="off"
                    oninput="cekDataKendaraan(this.value)"
                    required 
                    class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2.5 text-white text-sm uppercase font-semibold focus:outline-none focus:border-indigo-500"
                >
                <datalist id="daftar_plat">
                    @foreach($kendaraans as $k)
                        <option value="{{ strtoupper($k->plat_nomor) }}">
                            {{ strtoupper($k->jenis_kendaraan) }} - {{ $k->pemilik ?? 'Umum' }}
                        </option>
                    @endforeach
                </datalist>
            </div>

            <!-- Kotak Info Otomatis (Jenis Kendaraan, Pemilik & Tarif) -->
            <div id="info_kendaraan_box" class="bg-slate-900/70 border border-slate-700 rounded-xl p-3.5 text-xs space-y-2">
                <div id="status_pencarian" class="text-slate-400 italic">
                    Ketik plat nomor untuk memuat jenis kendaraan dan tarif otomatis...
                </div>

                <div id="detail_kendaraan" class="hidden space-y-1.5">
                    <div class="flex justify-between">
                        <span class="text-slate-400">Jenis Kendaraan:</span>
                        <span id="auto_jenis" class="font-bold text-indigo-400 uppercase">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">Pemilik / Warna:</span>
                        <span id="auto_pemilik" class="text-slate-200">-</span>
                    </div>
                    <div class="flex justify-between pt-1 border-t border-slate-700/70">
                        <span class="text-slate-400">Tarif Berlaku:</span>
                        <span id="auto_tarif" class="font-bold text-emerald-400">-</span>
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
                <button type="submit" id="btn_simpan_masuk" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-2.5 rounded-lg text-sm transition-colors">
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
    // Data kendaraan & tarif dari database
    const dataKendaraan = @json($kendaraans);
    const dataTarif = @json($tarifs);

    function bukaModalMasuk() {
        document.getElementById('input_plat_nomor').value = '';
        document.getElementById('detail_kendaraan').classList.add('hidden');
        document.getElementById('status_pencarian').classList.remove('hidden');
        document.getElementById('status_pencarian').innerHTML = 'Ketik plat nomor untuk memuat jenis kendaraan dan tarif otomatis...';
        document.getElementById('status_pencarian').className = 'text-slate-400 italic';
        document.getElementById('modalMasuk').classList.remove('hidden');
        setTimeout(() => document.getElementById('input_plat_nomor').focus(), 100);
    }

    function cekDataKendaraan(inputVal) {
        const platCari = inputVal.trim().toUpperCase();
        const statusEl = document.getElementById('status_pencarian');
        const detailEl = document.getElementById('detail_kendaraan');

        if (!platCari) {
            detailEl.classList.add('hidden');
            statusEl.classList.remove('hidden');
            statusEl.innerHTML = 'Ketik plat nomor untuk memuat jenis kendaraan dan tarif otomatis...';
            statusEl.className = 'text-slate-400 italic';
            return;
        }

        const ditemukan = dataKendaraan.find(item => item.plat_nomor.toUpperCase() === platCari);

        if (ditemukan) {
            const jenisKey = (ditemukan.jenis_kendaraan || '').toLowerCase();
            const tarifObj = dataTarif[jenisKey];
            const nominalTarif = tarifObj ? Number(tarifObj.tarif_per_jam).toLocaleString('id-ID') : '2.000';

            document.getElementById('auto_jenis').textContent = ditemukan.jenis_kendaraan;
            document.getElementById('auto_pemilik').textContent = (ditemukan.pemilik || 'Umum') + ' (' + (ditemukan.warna || '-') + ')';
            document.getElementById('auto_tarif').textContent = 'Rp ' + nominalTarif + ' / Jam';

            statusEl.classList.add('hidden');
            detailEl.classList.remove('hidden');
        } else {
            detailEl.classList.add('hidden');
            statusEl.classList.remove('hidden');
            statusEl.innerHTML = 'Plat nomor belum terdaftar di Data Kendaraan (Admin).';
            statusEl.className = 'text-rose-400 font-medium';
        }
    }
</script>
@endsection
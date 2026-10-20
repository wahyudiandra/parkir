@extends('layout.app')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-white">Transaksi Parkir Active</h1>
        <button onclick="document.getElementById('modalMasuk').classList.remove('hidden')" class="bg-indigo-600 hover:bg-indigo-500 text-white font-semibold px-4 py-2 rounded-lg text-sm">
            + Input Kendaraan Masuk
        </button>
    </div>

    @if(session('success'))
        <div class="bg-emerald-500/20 border border-emerald-500 text-emerald-300 p-4 rounded-xl text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden shadow-xl">
        <table class="w-full text-left text-sm text-slate-300">
            <thead class="bg-slate-700/50 text-slate-400 uppercase text-xs">
                <tr>
                    <th class="p-4">PLAT NOMOR</th>
                    <th class="p-4">JENIS</th>
                    <th class="p-4">AREA</th>
                    <th class="p-4">WAKTU MASUK</th>
                    <th class="p-4 text-center">AKSI</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700">
                @forelse($transaksiAktif as $t)
                <tr class="hover:bg-slate-700/30">
                    <td class="p-4 font-bold text-white uppercase">{{ $t->kendaraan->plat_nomor ?? '-' }}</td>
                    <td class="p-4 font-semibold text-indigo-400 uppercase">{{ $t->kendaraan->jenis_kendaraan ?? '-' }}</td>
                    <td class="p-4 text-slate-300">{{ $t->area->nama_area ?? '-' }}</td>
                    <td class="p-4 text-slate-400">{{ $t->waktu_masuk }}</td>
                    <td class="p-4 text-center">
                        <form action="{{ route('petugas.transaksi.keluar', $t->id_parkir) }}" method="POST" class="inline" onsubmit="return confirm('Proses keluar parkir dan cetak struk?')">
                            @csrf
                            <button type="submit" class="bg-emerald-600 hover:bg-emerald-500 text-white text-xs px-3 py-1.5 rounded font-semibold">Proses Keluar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-slate-500">Belum ada kendaraan yang sedang parkir.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Input Kendaraan Masuk -->
<div id="modalMasuk" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
    <div class="bg-slate-800 border border-slate-700 rounded-2xl max-w-md w-full p-6 space-y-4">
        <h2 class="text-xl font-bold text-white">Kendaraan Masuk Parkir</h2>
        <form action="{{ route('petugas.transaksi.masuk') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Plat Nomor</label>
                <input type="text" name="plat_nomor" placeholder="B 1234 ABC" required class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm uppercase">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Jenis Kendaraan</label>
                <select name="jenis_kendaraan" required class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm">
                    <option value="" disabled selected>-- Pilih Jenis Kendaraan --</option>
                    <option value="motor">Motor</option>
                    <option value="mobil">Mobil</option>
                    <option value="lainnya">Lainnya</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Area Parkir</label>
                <select name="id_area" required class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm">
                    <option value="" disabled selected>-- Pilih Area Parkir --</option>
                    @foreach($areas as $area)
                        <option value="{{ $area->id_area }}">{{ $area->nama_area }} (Sisa: {{ $area->kapasitas - $area->terisi }} Slot)</option>
                    @endforeach
                </select>
            </div>
            <div class="flex space-x-2 pt-2">
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-2 rounded-lg text-sm">Simpan Masuk</button>
                <button type="button" onclick="document.getElementById('modalMasuk').classList.add('hidden')" class="w-full bg-slate-700 hover:bg-slate-600 text-slate-300 font-semibold py-2 rounded-lg text-sm">Batal</button>
            </div>
        </form>
    </div>
</div>
@endsection
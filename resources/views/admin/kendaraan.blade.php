@extends('layout.app')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-white">Kelola Kendaraan Terdaftar</h1>
        <button onclick="document.getElementById('modalTambah').classList.remove('hidden')" class="bg-indigo-600 hover:bg-indigo-500 text-white font-semibold px-4 py-2 rounded-lg text-sm">
            + Tambah Kendaraan
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
                    <th class="p-4">JENIS KENDARAAN</th>
                    <th class="p-4">WARNA / PEMILIK</th>
                    <th class="p-4 text-center">AKSI</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700">
                @forelse($kendaraans as $k)
                <tr class="hover:bg-slate-700/30">
                    <td class="p-4 font-bold text-white uppercase">{{ $k->plat_nomor }}</td>
                    <td class="p-4 font-semibold text-indigo-400 uppercase">{{ $k->jenis_kendaraan }}</td>
                    <td class="p-4 text-xs text-slate-400">{{ $k->warna ?? '-' }} / {{ $k->pemilik ?? 'Umum' }}</td>
                    <td class="p-4 text-center space-x-2">
                        <form action="{{ route('admin.kendaraan.delete', $k->id_kendaraan) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kendaraan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-rose-600/80 hover:bg-rose-600 text-white text-xs px-3 py-1.5 rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-slate-500">Belum ada data kendaraan terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Kendaraan -->
<div id="modalTambah" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
    <div class="bg-slate-800 border border-slate-700 rounded-2xl max-w-md w-full p-6 space-y-4">
        <h2 class="text-xl font-bold text-white">Tambah Kendaraan Baru</h2>
        <form action="{{ route('admin.kendaraan.store') }}" method="POST" class="space-y-4">
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
                <label class="block text-xs font-medium text-slate-400 mb-1">Warna (Opsional)</label>
                <input type="text" name="warna" placeholder="Hitam" class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Nama Pemilik</label>
                <input type="text" name="pemilik" placeholder="Nama Pemilik / Umum" required class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm">
            </div>
            <div class="flex space-x-2 pt-2">
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-2 rounded-lg text-sm">Simpan</button>
                <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')" class="w-full bg-slate-700 hover:bg-slate-600 text-slate-300 font-semibold py-2 rounded-lg text-sm">Batal</button>
            </div>
        </form>
    </div>
</div>
@endsection
@extends('layout.app')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-white">Kelola Data Kendaraan</h1>
            <p class="text-xs text-slate-400">Daftar kendaraan terdaftar untuk transaksi parkir cepat</p>
        </div>
        <button onclick="document.getElementById('modalTambah').classList.remove('hidden')" class="bg-indigo-600 hover:bg-indigo-500 text-white font-semibold px-4 py-2 rounded-lg text-sm shadow-lg shadow-indigo-600/30 transition-colors">
            + Tambah Kendaraan
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

    <div class="bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden shadow-xl">
        <table class="w-full text-left text-sm text-slate-300">
            <thead class="bg-slate-700/50 text-slate-400 uppercase text-xs">
                <tr>
                    <th class="p-4">PLAT NOMOR</th>
                    <th class="p-4">JENIS KENDARAAN</th>
                    <th class="p-4">WARNA</th>
                    <th class="p-4">PEMILIK</th>
                    <th class="p-4 text-center">AKSI</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700">
                @forelse($kendaraans as $k)
                <tr class="hover:bg-slate-700/30">
                    <td class="p-4 font-bold text-white uppercase">{{ $k->plat_nomor }}</td>
                    <td class="p-4 font-semibold text-indigo-400 uppercase">{{ $k->jenis_kendaraan }}</td>
                    <td class="p-4 text-slate-300">{{ $k->warna ?? '-' }}</td>
                    <td class="p-4 text-slate-300">{{ $k->pemilik ?? 'Umum' }}</td>
                    <td class="p-4 text-center space-x-2">
                        <button onclick="editKendaraan({{ json_encode($k) }})" class="bg-amber-600/80 hover:bg-amber-600 text-white text-xs px-3 py-1.5 rounded font-semibold">
                            Edit
                        </button>
                        <form action="{{ route('admin.kendaraan.delete', $k->id_kendaraan) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data kendaraan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-rose-600/80 hover:bg-rose-600 text-white text-xs px-3 py-1.5 rounded font-semibold">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-slate-500">Belum ada data kendaraan terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Kendaraan -->
<div id="modalTambah" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
    <div class="bg-slate-800 border border-slate-700 rounded-2xl max-w-md w-full p-6 space-y-4 shadow-2xl">
        <h2 class="text-xl font-bold text-white">Tambah Kendaraan Baru</h2>
        <form action="{{ route('admin.kendaraan.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Plat Nomor</label>
                <input type="text" name="plat_nomor" placeholder="B 1234 ABC" required class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm uppercase">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Jenis Kendaraan</label>
                <select name="jenis_kendaraan" required class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm uppercase">
                    <option value="" disabled selected>-- Pilih Jenis Kendaraan --</option>
                    @foreach($tarifs as $tf)
                        <option value="{{ strtoupper($tf->jenis_kendaraan) }}">
                            {{ strtoupper($tf->jenis_kendaraan) }} (Rp {{ number_format($tf->tarif_per_jam, 0, ',', '.') }}/jam)
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Warna</label>
                <input type="text" name="warna" placeholder="Hitam / Putih / Merah" class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Nama Pemilik</label>
                <input type="text" name="pemilik" placeholder="Umum / Nama Pemilik" class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm">
            </div>
            <div class="flex space-x-2 pt-2">
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-2 rounded-lg text-sm">Simpan</button>
                <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')" class="w-full bg-slate-700 hover:bg-slate-600 text-slate-300 font-semibold py-2 rounded-lg text-sm">Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Kendaraan -->
<div id="modalEdit" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
    <div class="bg-slate-800 border border-slate-700 rounded-2xl max-w-md w-full p-6 space-y-4 shadow-2xl">
        <h2 class="text-xl font-bold text-white">Edit Data Kendaraan</h2>
        <form id="formEdit" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Plat Nomor</label>
                <input type="text" id="edit_plat_nomor" name="plat_nomor" required class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm uppercase">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Jenis Kendaraan</label>
                <select id="edit_jenis_kendaraan" name="jenis_kendaraan" required class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm uppercase">
                    @foreach($tarifs as $tf)
                        <option value="{{ strtoupper($tf->jenis_kendaraan) }}">
                            {{ strtoupper($tf->jenis_kendaraan) }} (Rp {{ number_format($tf->tarif_per_jam, 0, ',', '.') }}/jam)
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Warna</label>
                <input type="text" id="edit_warna" name="warna" class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Nama Pemilik</label>
                <input type="text" id="edit_pemilik" name="pemilik" class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm">
            </div>
            <div class="flex space-x-2 pt-2">
                <button type="submit" class="w-full bg-amber-600 hover:bg-amber-500 text-white font-semibold py-2 rounded-lg text-sm">Update Kendaraan</button>
                <button type="button" onclick="document.getElementById('modalEdit').classList.add('hidden')" class="w-full bg-slate-700 hover:bg-slate-600 text-slate-300 font-semibold py-2 rounded-lg text-sm">Batal</button>
            </div>
        </form>
    </div>
</div>

<script>
    function editKendaraan(kendaraan) {
        document.getElementById('formEdit').action = '/admin/kendaraan/' + kendaraan.id_kendaraan;
        document.getElementById('edit_plat_nomor').value = kendaraan.plat_nomor;
        document.getElementById('edit_jenis_kendaraan').value = (kendaraan.jenis_kendaraan || '').toUpperCase();
        document.getElementById('edit_warna').value = kendaraan.warna || '-';
        document.getElementById('edit_pemilik').value = kendaraan.pemilik || 'Umum';
        document.getElementById('modalEdit').classList.remove('hidden');
    }
</script>
@endsection
@extends('layout.app')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-white">Kelola Area Parkir</h1>
        <button onclick="document.getElementById('modalTambah').classList.remove('hidden')" class="bg-indigo-600 hover:bg-indigo-500 text-white font-semibold px-4 py-2 rounded-lg text-sm">
            + Tambah Area Parkir
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
                    <th class="p-4">NAMA AREA</th>
                    <th class="p-4">KAPASITAS</th>
                    <th class="p-4">TERISI</th>
                    <th class="p-4 text-center">AKSI</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700">
                @forelse($areas as $a)
                <tr class="hover:bg-slate-700/30">
                    <td class="p-4 font-semibold text-white uppercase">{{ $a->nama_area }}</td>
                    <td class="p-4 text-slate-300">{{ $a->kapasitas }} Slot</td>
                    <td class="p-4 font-bold text-indigo-400">{{ $a->terisi }} Slot</td>
                    <td class="p-4 text-center space-x-2">
                        <!-- Tombol Edit -->
                        <button onclick="editArea({{ json_encode($a) }})" class="bg-amber-600/80 hover:bg-amber-600 text-white text-xs px-3 py-1.5 rounded font-semibold">
                            Edit
                        </button>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('admin.area.delete', $a->id_area) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus area parkir ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-rose-600/80 hover:bg-rose-600 text-white text-xs px-3 py-1.5 rounded font-semibold">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-slate-500">Belum ada data area parkir.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Area -->
<div id="modalTambah" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
    <div class="bg-slate-800 border border-slate-700 rounded-2xl max-w-md w-full p-6 space-y-4">
        <h2 class="text-xl font-bold text-white">Tambah Area Parkir</h2>
        <form action="{{ route('admin.area.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Nama Area</label>
                <input type="text" name="nama_area" placeholder="Lantai 1 Area A" required class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Kapasitas (Slot)</label>
                <input type="number" name="kapasitas" placeholder="50" required class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm">
            </div>
            <div class="flex space-x-2 pt-2">
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-2 rounded-lg text-sm">Simpan</button>
                <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')" class="w-full bg-slate-700 hover:bg-slate-600 text-slate-300 font-semibold py-2 rounded-lg text-sm">Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Area -->
<div id="modalEdit" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
    <div class="bg-slate-800 border border-slate-700 rounded-2xl max-w-md w-full p-6 space-y-4">
        <h2 class="text-xl font-bold text-white">Edit Area Parkir</h2>
        <form id="formEdit" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Nama Area</label>
                <input type="text" id="edit_nama_area" name="nama_area" required class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Kapasitas (Slot)</label>
                <input type="number" id="edit_kapasitas" name="kapasitas" required class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm">
            </div>
            <div class="flex space-x-2 pt-2">
                <button type="submit" class="w-full bg-amber-600 hover:bg-amber-500 text-white font-semibold py-2 rounded-lg text-sm">Update Area</button>
                <button type="button" onclick="document.getElementById('modalEdit').classList.add('hidden')" class="w-full bg-slate-700 hover:bg-slate-600 text-slate-300 font-semibold py-2 rounded-lg text-sm">Batal</button>
            </div>
        </form>
    </div>
</div>

<script>
    function editArea(area) {
        document.getElementById('formEdit').action = '/admin/area/' + area.id_area;
        document.getElementById('edit_nama_area').value = area.nama_area;
        document.getElementById('edit_kapasitas').value = area.kapasitas;
        document.getElementById('modalEdit').classList.remove('hidden');
    }
</script>
@endsection
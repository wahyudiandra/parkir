@extends('layout.app')

@section('content')
<div class="space-y-6">
    <!-- Alert Success -->
    @if(session('success'))
        <div class="bg-emerald-500/20 border border-emerald-500 text-emerald-300 p-4 rounded-xl text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-white">Kelola Tarif Parkir</h1>
        <button onclick="toggleModal('modalTambah')" class="bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold px-4 py-2 rounded-lg cursor-pointer">
            + Tambah Tarif
        </button>
    </div>

    <!-- Tabel Data Tarif -->
    <div class="bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden shadow-xl">
        <table class="w-full text-left text-sm text-slate-300">
            <thead class="bg-slate-700/50 text-slate-400 uppercase text-xs">
                <tr>
                    <th class="p-4">JENIS KENDARAAN</th>
                    <th class="p-4">TARIF 1 JAM PERTAMA</th>
                    <th class="p-4">TARIF JAM BERIKUTNYA</th>
                    <th class="p-4 text-center">AKSI</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700">
                @forelse($tarifs as $t)
                <tr class="hover:bg-slate-700/30">
                    <td class="p-4 font-semibold text-white">{{ $t->jenis_kendaraan }}</td>
                    <td class="p-4">Rp {{ number_format($t->tarif_pertama, 0, ',', '.') }}</td>
                    <td class="p-4">Rp {{ number_format($t->tarif_berikutnya, 0, ',', '.') }} / Jam</td>
                    <td class="p-4 text-center space-x-2">
                        <!-- Tombol Edit -->
                        <button type="button" onclick="editTarif('{{ $t->id }}', '{{ $t->jenis_kendaraan }}', '{{ $t->tarif_pertama }}', '{{ $t->tarif_berikutnya }}')" class="text-xs bg-slate-700 hover:bg-slate-600 px-3 py-1.5 rounded text-white cursor-pointer">
                            Edit
                        </button>

                        <!-- Form Hapus -->
                        <form action="{{ route('admin.tarif.delete', $t->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tarif ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs bg-red-500/20 hover:bg-red-500 text-red-300 hover:text-white px-3 py-1.5 rounded transition cursor-pointer">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-slate-500">Belum ada data tarif parkir.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Tarif -->
<div id="modalTambah" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
    <div class="bg-slate-800 border border-slate-700 p-6 rounded-2xl w-full max-w-md space-y-4">
        <h2 class="text-lg font-bold text-white">Tambah Tarif Parkir</h2>
        <form action="{{ route('admin.tarif.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Jenis Kendaraan</label>
                <input type="text" name="jenis_kendaraan" placeholder="Misal: Motor, Mobil" required class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Tarif 1 Jam Pertama (Rp)</label>
                <input type="number" name="tarif_pertama" placeholder="2000" required class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Tarif Jam Berikutnya (Rp)</label>
                <input type="number" name="tarif_berikutnya" placeholder="1000" required class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm">
            </div>
            <div class="flex justify-end space-x-2 pt-2">
                <button type="button" onclick="toggleModal('modalTambah')" class="px-4 py-2 bg-slate-700 text-slate-300 rounded-lg text-sm">Batal</button>
                <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-lg text-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Tarif -->
<div id="modalEdit" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
    <div class="bg-slate-800 border border-slate-700 p-6 rounded-2xl w-full max-w-md space-y-4">
        <h2 class="text-lg font-bold text-white">Edit Tarif Parkir</h2>
        <form id="formEditTarif" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Jenis Kendaraan</label>
                <input type="text" id="edit_jenis_kendaraan" name="jenis_kendaraan" required class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Tarif 1 Jam Pertama (Rp)</label>
                <input type="number" id="edit_tarif_pertama" name="tarif_pertama" required class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Tarif Jam Berikutnya (Rp)</label>
                <input type="number" id="edit_tarif_berikutnya" name="tarif_berikutnya" required class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm">
            </div>
            <div class="flex justify-end space-x-2 pt-2">
                <button type="button" onclick="toggleModal('modalEdit')" class="px-4 py-2 bg-slate-700 text-slate-300 rounded-lg text-sm">Batal</button>
                <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-500 text-white font-semibold rounded-lg text-sm">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleModal(id) {
        const modal = document.getElementById(id);
        modal.classList.toggle('hidden');
    }

    function editTarif(id, jenis, pertama, berikutnya) {
        document.getElementById('formEditTarif').action = '/admin/tarif/' + id;
        document.getElementById('edit_jenis_kendaraan').value = jenis;
        document.getElementById('edit_tarif_pertama').value = pertama;
        document.getElementById('edit_tarif_berikutnya').value = berikutnya;
        
        toggleModal('modalEdit');
    }
</script>
@endsection
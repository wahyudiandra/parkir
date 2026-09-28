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
        <h1 class="text-2xl font-bold text-white">Manajemen User (CRUD Real)</h1>
        <button onclick="toggleModal('modalTambah')" class="bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold px-4 py-2 rounded-lg cursor-pointer">
            + Tambah User
        </button>
    </div>

    <!-- Tabel Data User -->
    <div class="bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden shadow-xl">
        <table class="w-full text-left text-sm text-slate-300">
            <thead class="bg-slate-700/50 text-slate-400 uppercase text-xs">
                <tr>
                    <th class="p-4">Nama</th>
                    <th class="p-4">Email</th>
                    <th class="p-4">Role</th>
                    <th class="p-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700">
                @forelse($users as $u)
                <tr class="hover:bg-slate-700/30">
                    <td class="p-4 font-semibold text-white">{{ $u->name }}</td>
                    <td class="p-4">{{ $u->email }}</td>
                    <td class="p-4">
                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold 
                            @if(strtolower($u->role) == 'admin') bg-indigo-500/10 text-indigo-400 border border-indigo-500/20
                            @elseif(strtolower($u->role) == 'petugas') bg-sky-500/10 text-sky-400 border border-sky-500/20
                            @else bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 @endif">
                            {{ strtoupper($u->role) }}
                        </span>
                    </td>
                    <td class="p-4 text-center space-x-2">
                        <!-- Tombol Edit -->
                        <button type="button" onclick="editUser('{{ $u->id }}', '{{ $u->name }}', '{{ $u->email }}', '{{ $u->role }}')" class="text-xs bg-slate-700 hover:bg-slate-600 px-3 py-1.5 rounded text-white cursor-pointer">
                            Edit
                        </button>

                        <!-- Form Hapus -->
                        <form action="{{ route('admin.users.delete', $u->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
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
                    <td colspan="4" class="p-4 text-center text-slate-500">Belum ada data user.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah User -->
<div id="modalTambah" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
    <div class="bg-slate-800 border border-slate-700 p-6 rounded-2xl w-full max-w-md space-y-4">
        <h2 class="text-lg font-bold text-white">Tambah User Baru</h2>
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Nama Lengkap</label>
                <input type="text" name="name" required class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Email</label>
                <input type="email" name="email" required class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Role Access</label>
                <select name="role" required class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm">
                    <option value="admin">Admin</option>
                    <option value="petugas">Petugas</option>
                    <option value="owner">Owner</option>
                </select>
            </div>
            <div class="flex justify-end space-x-2 pt-2">
                <button type="button" onclick="toggleModal('modalTambah')" class="px-4 py-2 bg-slate-700 text-slate-300 rounded-lg text-sm">Batal</button>
                <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-lg text-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit User -->
<div id="modalEdit" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
    <div class="bg-slate-800 border border-slate-700 p-6 rounded-2xl w-full max-w-md space-y-4">
        <h2 class="text-lg font-bold text-white">Edit User</h2>
        <form id="formEdit" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Nama Lengkap</label>
                <input type="text" id="edit_name" name="name" required class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Email</label>
                <input type="email" id="edit_email" name="email" required class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Role Access</label>
                <select id="edit_role" name="role" required class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm">
                    <option value="admin">Admin</option>
                    <option value="petugas">Petugas</option>
                    <option value="owner">Owner</option>
                </select>
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

    function editUser(id, name, email, role) {
        document.getElementById('formEdit').action = '/admin/users/' + id;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_email').value = email;
        
        // Konversi nilai role ke huruf kecil agar otomatis terpilih di tag <select>
        document.getElementById('edit_role').value = role.toLowerCase();
        
        toggleModal('modalEdit');
    }
</script>
@endsection
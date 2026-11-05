@extends('layout.app')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-white">Kelola User / Pengguna</h1>
        <button onclick="document.getElementById('modalTambah').classList.remove('hidden')" class="bg-indigo-600 hover:bg-indigo-500 text-white font-semibold px-4 py-2 rounded-lg text-sm">
            + Tambah User
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
                    <th class="p-4">NAMA LENGKAP</th>
                    <th class="p-4">USERNAME</th>
                    <th class="p-4">ROLE</th>
                    <th class="p-4 text-center">AKSI</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700">
                @forelse($users as $u)
                <tr class="hover:bg-slate-700/30">
                    <td class="p-4 font-semibold text-white">{{ $u->nama_lengkap }}</td>
                    <td class="p-4 text-slate-400">{{ $u->username }}</td>
                    <td class="p-4">
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold uppercase
                            {{ $u->role === 'admin' ? 'bg-indigo-500/20 text-indigo-400 border border-indigo-500/30' : '' }}
                            {{ $u->role === 'petugas' ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30' : '' }}
                            {{ $u->role === 'owner' ? 'bg-amber-500/20 text-amber-400 border border-amber-500/30' : '' }}">
                            {{ $u->role }}
                        </span>
                    </td>
                    <td class="p-4 text-center space-x-2">
                        <!-- Tombol Edit -->
                        <button onclick="editUser({{ json_encode($u) }})" class="bg-amber-600/80 hover:bg-amber-600 text-white text-xs px-3 py-1.5 rounded font-semibold">
                            Edit
                        </button>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('admin.users.delete', $u->id_user) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-rose-600/80 hover:bg-rose-600 text-white text-xs px-3 py-1.5 rounded font-semibold">Hapus</button>
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
    <div class="bg-slate-800 border border-slate-700 rounded-2xl max-w-md w-full p-6 space-y-4">
        <h2 class="text-xl font-bold text-white">Tambah User Baru</h2>
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" required class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Username</label>
                <input type="text" name="username" placeholder="username" required class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Password</label>
                <div class="relative">
                    <input type="password" id="tambahPassword" name="password" placeholder="••••••••" required class="w-full bg-slate-700 border border-slate-600 rounded-lg pl-4 pr-10 py-2 text-white text-sm focus:outline-none focus:border-indigo-500">
                    <button type="button" onclick="togglePassword('tambahPassword', 'tambahEyeIcon')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-white">
                        <svg id="tambahEyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Role</label>
                <select name="role" required class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm">
                    <option value="" disabled selected>-- Pilih Role --</option>
                    <option value="admin">Admin</option>
                    <option value="petugas">Petugas</option>
                    <option value="owner">Owner</option>
                </select>
            </div>
            <div class="flex space-x-2 pt-2">
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-2 rounded-lg text-sm">Simpan</button>
                <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')" class="w-full bg-slate-700 hover:bg-slate-600 text-slate-300 font-semibold py-2 rounded-lg text-sm">Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit User -->
<div id="modalEdit" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden flex items-center justify-center p-4 z-50">
    <div class="bg-slate-800 border border-slate-700 rounded-2xl max-w-md w-full p-6 space-y-4">
        <h2 class="text-xl font-bold text-white">Edit Data User</h2>
        <form id="formEdit" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Nama Lengkap</label>
                <input type="text" id="edit_nama_lengkap" name="nama_lengkap" required class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Username</label>
                <input type="text" id="edit_username" name="username" required class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Password Baru (Opsional)</label>
                <div class="relative">
                    <input type="password" id="editPassword" name="password" placeholder="Kosongkan jika tidak diubah" class="w-full bg-slate-700 border border-slate-600 rounded-lg pl-4 pr-10 py-2 text-white text-sm focus:outline-none focus:border-indigo-500">
                    <button type="button" onclick="togglePassword('editPassword', 'editEyeIcon')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-white">
                        <svg id="editEyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Role</label>
                <select id="edit_role" name="role" required class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm">
                    <option value="admin">Admin</option>
                    <option value="petugas">Petugas</option>
                    <option value="owner">Owner</option>
                </select>
            </div>
            <div class="flex space-x-2 pt-2">
                <button type="submit" class="w-full bg-amber-600 hover:bg-amber-500 text-white font-semibold py-2 rounded-lg text-sm">Update User</button>
                <button type="button" onclick="document.getElementById('modalEdit').classList.add('hidden')" class="w-full bg-slate-700 hover:bg-slate-600 text-slate-300 font-semibold py-2 rounded-lg text-sm">Batal</button>
            </div>
        </form>
    </div>
</div>

<script>
    function editUser(user) {
        document.getElementById('formEdit').action = '/admin/users/' + user.id_user;
        document.getElementById('edit_nama_lengkap').value = user.nama_lengkap;
        document.getElementById('edit_username').value = user.username;
        document.getElementById('edit_role').value = user.role;
        document.getElementById('modalEdit').classList.remove('hidden');
    }

    function togglePassword(inputId, eyeIconId) {
        const input = document.getElementById(inputId);
        const eye = document.getElementById(eyeIconId);
        if (input.type === 'password') {
            input.type = 'text';
            eye.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a8.959 8.959 0 013.674-.823c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21M3 3l18 18" />`;
        } else {
            input.type = 'password';
            eye.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
        }
    }
</script>
@endsection
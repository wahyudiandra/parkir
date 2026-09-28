@extends('layout.app')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-white">Manajemen User (CRUD)</h1>
        <button class="bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold px-4 py-2 rounded-lg">+ Tambah User</button>
    </div>

    <div class="bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden shadow-xl">
        <table class="w-full text-left text-sm text-slate-300">
            <thead class="bg-slate-700/50 text-slate-400 uppercase text-xs">
                <tr>
                    <th class="p-4">Nama</th>
                    <th class="p-4">Email</th>
                    <th class="p-4">Role</th>
                    <th class="p-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700">
                <tr class="hover:bg-slate-700/30">
                    <td class="p-4 font-semibold">Admin Utama</td>
                    <td class="p-4">admin@gmail.com</td>
                    <td class="p-4"><span class="bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 text-xs px-2.5 py-1 rounded-full">Admin</span></td>
                    <td class="p-4 space-x-2">
                        <button class="text-xs bg-slate-700 hover:bg-slate-600 px-3 py-1.5 rounded">Edit</button>
                        <button class="text-xs bg-red-500/20 hover:bg-red-500 text-red-300 px-3 py-1.5 rounded">Hapus</button>
                    </td>
                </tr>
                <tr class="hover:bg-slate-700/30">
                    <td class="p-4 font-semibold">Petugas Shift A</td>
                    <td class="p-4">petugas@gmail.com</td>
                    <td class="p-4"><span class="bg-sky-500/10 text-sky-400 border border-sky-500/20 text-xs px-2.5 py-1 rounded-full">Petugas</span></td>
                    <td class="p-4 space-x-2">
                        <button class="text-xs bg-slate-700 hover:bg-slate-600 px-3 py-1.5 rounded">Edit</button>
                        <button class="text-xs bg-red-500/20 hover:bg-red-500 text-red-300 px-3 py-1.5 rounded">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
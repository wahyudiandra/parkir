@extends('layout.app')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-white">Log Aktivitas Sistem</h1>
        <p class="text-xs text-slate-400">Catatan riwayat tindakan pengguna di dalam sistem</p>
    </div>

    <div class="bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden shadow-xl">
        <table class="w-full text-left text-sm text-slate-300">
            <thead class="bg-slate-700/50 text-slate-400 uppercase text-xs">
                <tr>
                    <th class="p-4">WAKTU</th>
                    <th class="p-4">USER</th>
                    <th class="p-4">AKTIVITAS</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700">
                @forelse($logs as $l)
                <tr class="hover:bg-slate-700/30">
                    <td class="p-4 text-xs text-slate-400 font-mono">{{ $l->waktu ?? $l->created_at }}</td>
                    <td class="p-4 font-semibold text-indigo-400">
                        {{ $l->user->nama_lengkap ?? ($l->user->username ?? 'Sistem') }}
                    </td>
                    <td class="p-4 text-slate-200">{{ $l->aktivitas }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="p-4 text-center text-slate-500">Belum ada riwayat aktivitas sistem.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
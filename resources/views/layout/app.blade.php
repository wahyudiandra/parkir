<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parkir Modern App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex">

    <!-- Sidebar Navigation -->
    <aside class="w-64 bg-slate-800/90 border-r border-slate-700/60 p-6 flex flex-col justify-between hidden md:flex min-h-screen">
        <div class="space-y-6">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center font-black text-xl text-white shadow-lg shadow-indigo-500/30">P</div>
                <span class="font-black text-xl tracking-wider text-white">PARKIR.IO</span>
            </div>

            <!-- Role Badge -->
            <div class="bg-slate-700/40 border border-slate-700 rounded-xl p-3 text-xs">
                <span class="text-slate-400 block mb-0.5">User Role:</span>
                <span class="font-bold uppercase text-indigo-400">{{ auth()->user()->role ?? 'GUEST' }}</span>
            </div>

            <!-- Navigasi Menu Admin -->
            @if(auth()->check() && auth()->user()->role === 'admin')
            <div class="space-y-1">
                <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400 px-3 block mb-2">NAVIGASI ADMIN</span>
                
                <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-700/50 hover:text-white transition">
                    Dashboard
                </a>
                <a href="{{ route('admin.users') }}" class="block px-3 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-700/50 hover:text-white transition">
                    Kelola User
                </a>
                <a href="{{ route('admin.tarif') }}" class="block px-3 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-700/50 hover:text-white transition">
                    Tarif Parkir
                </a>
                <a href="{{ route('admin.area') }}" class="block px-3 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-700/50 hover:text-white transition">
                    Area Parkir
                </a>
                <a href="{{ route('admin.kendaraan') }}" class="block px-3 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-700/50 hover:text-white transition">
                    Data Kendaraan
                </a>
                <a href="{{ route('admin.log') }}" class="block px-3 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-700/50 hover:text-white transition">
                    Log Aktivitas
                </a>
            </div>
            @endif

            <!-- Navigasi Menu Petugas -->
            @if(auth()->check() && auth()->user()->role === 'petugas')
            <div class="space-y-1">
                <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400 px-3 block mb-2">NAVIGASI PETUGAS</span>
                <a href="{{ route('petugas.transaksi') }}" class="block px-3 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-700/50 hover:text-white transition">
                    Transaksi Parkir
                </a>
                <a href="{{ route('petugas.struk') }}" class="block px-3 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-700/50 hover:text-white transition">
                    Cetak Struk
                </a>
            </div>
            @endif

            <!-- Navigasi Menu Owner -->
            @if(auth()->check() && auth()->user()->role === 'owner')
            <div class="space-y-1">
                <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400 px-3 block mb-2">NAVIGASI OWNER</span>
                <a href="{{ route('owner.rekap') }}" class="block px-3 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-700/50 hover:text-white transition">
                    Rekap Laporan
                </a>
            </div>
            @endif
        </div>

        <!-- Logout Button -->
        <form action="{{ route('logout') }}" method="POST" class="pt-6 border-t border-slate-700/60">
            @csrf
            <button type="submit" class="w-full bg-rose-500/10 hover:bg-rose-500/20 border border-rose-500/30 text-rose-400 font-semibold py-2.5 rounded-xl text-sm transition">
                Logout
            </button>
        </form>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-y-auto">
        @yield('content')
    </main>

</body>
</html>
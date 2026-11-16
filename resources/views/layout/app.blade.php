<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PARKIR.IO - Sistem Manajemen Parkir</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-200 font-sans antialiased h-screen flex flex-col overflow-hidden">

    <!-- 1. TOPBAR / HEADER UTAMA (Tetap / Sticky di atas) -->
    <header class="bg-slate-800 border-b border-slate-700 h-16 px-6 flex items-center justify-between shrink-0 z-30 shadow-md">
        <!-- Logo Aplikasi -->
        <div class="flex items-center space-x-3">
            <div class="w-9 h-9 bg-indigo-600 rounded-xl flex items-center justify-center font-extrabold text-white text-lg shadow-lg shadow-indigo-600/30">
                P
            </div>
            <span class="text-xl font-extrabold tracking-wider text-white">PARKIR.IO</span>
        </div>

        <!-- Info Username, Role & Tombol Logout -->
        @auth
        <div class="flex items-center space-x-4">
            <div class="text-right hidden sm:block">
                <div class="text-sm font-bold text-white leading-tight">
                    {{ auth()->user()->nama_lengkap ?? auth()->user()->username }}
                </div>
                <div class="text-[11px] font-bold uppercase tracking-wider text-indigo-400">
                    Role: {{ auth()->user()->role }}
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-rose-600/20 hover:bg-rose-600 text-rose-400 hover:text-white border border-rose-500/40 px-4 py-2 rounded-lg text-xs font-bold transition-all duration-200">
                    Logout
                </button>
            </form>
        </div>
        @endauth
    </header>

    <!-- 2. BODY WRAPPER (Sidebar Dinamis + Area Konten) -->
    <div class="flex flex-1 overflow-hidden">
        
        <!-- SIDEBAR DINAMIS (Tetap di sisi kiri) -->
        @auth
        <aside class="w-64 bg-slate-800/90 border-r border-slate-700 flex flex-col justify-between shrink-0 overflow-y-auto">
            <div class="p-4 space-y-6">
                
                <!-- Navigasi Jika Role: ADMIN -->
                @if(auth()->user()->role === 'admin')
                <div>
                    <p class="px-3 text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-3">Navigasi Admin</p>
                    <nav class="space-y-1">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('admin.users') }}" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.users*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
                            Data User
                        </a>
                        <a href="{{ route('admin.tarif') }}" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.tarif*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
                            Data Tarif Parkir
                        </a>
                        <a href="{{ route('admin.area') }}" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.area*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
                            Data Area Parkir
                        </a>
                        <a href="{{ route('admin.kendaraan') }}" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.kendaraan*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
                            Data Kendaraan
                        </a>
                        <a href="{{ route('admin.log') }}" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.log*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
                            Log Aktivitas
                        </a>
                    </nav>
                </div>
                @endif

                <!-- Navigasi Jika Role: PETUGAS -->
                @if(auth()->user()->role === 'petugas')
                <div>
                    <p class="px-3 text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-3">Navigasi Petugas</p>
                    <nav class="space-y-1">
                        <a href="{{ route('petugas.transaksi') }}" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('petugas.transaksi*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
                            Transaksi Parkir
                        </a>
                        <a href="{{ route('petugas.struk') }}" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('petugas.struk*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
                            Cetak Struk
                        </a>
                    </nav>
                </div>
                @endif

                <!-- Navigasi Jika Role: OWNER -->
                @if(auth()->user()->role === 'owner')
                <div>
                    <p class="px-3 text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-3">Navigasi Owner</p>
                    <nav class="space-y-1">
                        <a href="{{ route('owner.rekap') }}" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('owner.rekap*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
                            Laporan Transaksi
                        </a>
                    </nav>
                </div>
                @endif

            </div>
        </aside>
        @endauth

        <!-- CONTENT AREA (Hanya bagian ini yang akan scroll saat data panjang) -->
        <main class="flex-1 overflow-y-auto p-6 bg-slate-900">
            <div class="max-w-7xl mx-auto">
                @yield('content')
            </div>
        </main>

    </div>

    <!-- 3. FOOTER (Tetap / Sticky di bawah saat halaman digulir ke atas maupun ke bawah) -->
    <footer class="bg-slate-800 border-t border-slate-700 py-3 px-6 text-center text-xs text-slate-400 shrink-0 z-30">
        <div class="flex flex-col sm:flex-row items-center justify-between max-w-7xl mx-auto gap-2">
            <span>&copy; {{ date('Y') }} <strong class="text-white">Wahyu diandra saputra</strong></span>
            <span class="text-slate-500">PARKIR.IO &bull; Sistem Manajemen Parkir </span>
        </div>
    </footer>

</body>
</html>
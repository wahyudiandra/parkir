<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parkir Modern App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-100 font-sans antialiased">
    <div class="min-h-screen flex">
        <!-- Sidebar Navigation -->
        <aside class="w-64 bg-slate-800 border-r border-slate-700 p-6 flex flex-col justify-between">
            <div>
                <div class="flex items-center space-x-3 mb-8">
                    <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center font-bold text-xl">P</div>
                    <span class="text-xl font-bold tracking-wider">PARKIR.IO</span>
                </div>
                
                <nav class="space-y-1 text-sm">
                    @auth
                        <div class="px-3 py-2 text-xs font-semibold text-slate-400 bg-slate-700/40 rounded-lg mb-3">
                            User: <span class="text-indigo-400 font-bold uppercase">{{ auth()->user()->role }}</span>
                        </div>

                        <!-- Menu Admin -->
                        @if(auth()->user()->role == 'admin')
                            <p class="text-xs font-semibold text-slate-500 uppercase px-3 mb-2">Navigasi Admin</p>
                            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-lg hover:bg-slate-700 text-slate-300">Dashboard</a>
                            <a href="{{ route('admin.users') }}" class="block px-3 py-2 rounded-lg hover:bg-slate-700 text-slate-300">CRUD User</a>
                            <a href="{{ route('admin.tarif') }}" class="block px-3 py-2 rounded-lg hover:bg-slate-700 text-slate-300">CRUD Tarif Parkir</a>
                            <a href="{{ route('admin.area') }}" class="block px-3 py-2 rounded-lg hover:bg-slate-700 text-slate-300">CRUD Area Parkir</a>
                            <a href="{{ route('admin.kendaraan') }}" class="block px-3 py-2 rounded-lg hover:bg-slate-700 text-slate-300">CRUD Kendaraan</a>
                            <a href="{{ route('admin.log') }}" class="block px-3 py-2 rounded-lg hover:bg-slate-700 text-slate-300">Log Aktivitas</a>
                        @endif

                        <!-- Menu Petugas -->
                        @if(auth()->user()->role == 'petugas')
                            <p class="text-xs font-semibold text-slate-500 uppercase px-3 mb-2">Navigasi Petugas</p>
                            <a href="{{ route('petugas.transaksi') }}" class="block px-3 py-2 rounded-lg hover:bg-slate-700 text-slate-300">Input Transaksi</a>
                            <a href="{{ route('petugas.struk') }}" class="block px-3 py-2 rounded-lg hover:bg-slate-700 text-slate-300">Cetak Struk</a>
                        @endif

                        <!-- Menu Owner -->
                        @if(auth()->user()->role == 'owner')
                            <p class="text-xs font-semibold text-slate-500 uppercase px-3 mb-2">Navigasi Owner</p>
                            <a href="{{ route('owner.rekap') }}" class="block px-3 py-2 rounded-lg bg-emerald-600/20 text-emerald-400 font-medium">Rekap Laporan</a>
                        @endif
                    @endauth
                </nav>
            </div>

            <!-- Logout -->
            <form action="{{ route('logout') }}" method="POST" class="pt-4 border-t border-slate-700">
                @csrf
                <button type="submit" class="w-full py-2 bg-red-500/10 text-red-400 border border-red-500/20 rounded-lg hover:bg-red-500 hover:text-white transition text-sm font-medium">
                    Logout
                </button>
            </form>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8 overflow-y-auto">
            @yield('content')
        </main>
    </div>
</body>
</html>
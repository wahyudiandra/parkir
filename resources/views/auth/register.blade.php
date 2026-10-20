<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun - PARKIR.IO</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center p-4">
    <div class="bg-slate-800 border border-slate-700 rounded-3xl p-8 max-w-md w-full space-y-6 shadow-2xl">
        <div class="text-center space-y-2">
            <h1 class="text-3xl font-black text-indigo-500 tracking-wider">PARKIR.IO</h1>
            <p class="text-xs text-slate-400">Buat akun baru untuk mengakses sistem</p>
        </div>

        @if($errors->any())
            <div class="bg-rose-500/20 border border-rose-500 text-rose-300 p-3 rounded-xl text-xs">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" placeholder="Nama Lengkap" required class="w-full bg-slate-700 border border-slate-600 rounded-xl px-4 py-2.5 text-white text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Username</label>
                <input type="text" name="username" value="{{ old('username') }}" placeholder="username" required class="w-full bg-slate-700 border border-slate-600 rounded-xl px-4 py-2.5 text-white text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="email@domain.com" required class="w-full bg-slate-700 border border-slate-600 rounded-xl px-4 py-2.5 text-white text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Password</label>
                <input type="password" name="password" placeholder="••••••••" required class="w-full bg-slate-700 border border-slate-600 rounded-xl px-4 py-2.5 text-white text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Role Akun</label>
                <select name="role" required class="w-full bg-slate-700 border border-slate-600 rounded-xl px-4 py-2.5 text-white text-sm focus:outline-none focus:border-indigo-500">
                    <option value="" disabled selected>-- Pilih Role Akun --</option>
                    <option value="petugas">Petugas Parkir</option>
                    <option value="admin">Administrator</option>
                    <option value="owner">Pemilik / Owner</option>
                </select>
            </div>
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-3 rounded-xl text-sm transition shadow-lg shadow-indigo-500/30">
                Daftar Sekarang
            </button>
        </form>

        <p class="text-center text-xs text-slate-400">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="text-indigo-400 font-semibold hover:underline">Login di sini</a>
        </p>
    </div>
</body>
</html>
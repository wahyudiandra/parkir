<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PARKIR.IO</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center p-4">
    <div class="bg-slate-800 border border-slate-700 rounded-3xl p-8 max-w-md w-full space-y-6 shadow-2xl">
        <div class="text-center space-y-2">
            <h1 class="text-3xl font-black text-indigo-500 tracking-wider">PARKIR.IO</h1>
            <p class="text-xs text-slate-400">Silakan masuk ke akun Anda</p>
        </div>

        @if(session('success'))
            <div class="bg-emerald-500/20 border border-emerald-500 text-emerald-300 p-3 rounded-xl text-xs text-center">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->has('login_error'))
            <div class="bg-rose-500/20 border border-rose-500 text-rose-300 p-3 rounded-xl text-xs text-center">
                {{ $errors->first('login_error') }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Email / Username</label>
                <input type="text" name="email" value="{{ old('email') }}" placeholder="admin@gmail.com" required class="w-full bg-slate-700 border border-slate-600 rounded-xl px-4 py-2.5 text-white text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Password</label>
                <input type="password" name="password" placeholder="••••••••" required class="w-full bg-slate-700 border border-slate-600 rounded-xl px-4 py-2.5 text-white text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-3 rounded-xl text-sm transition shadow-lg shadow-indigo-500/30">
                Masuk
            </button>
        </form>

        <p class="text-center text-xs text-slate-400">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="text-indigo-400 font-semibold hover:underline">Daftar Akun Baru</a>
        </p>
    </div>
</body>
</html>
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
                <input type="text" name="email" value="{{ old('email') }}" placeholder="Email / Username" required class="w-full bg-slate-700 border border-slate-600 rounded-xl px-4 py-2.5 text-white text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">Password</label>
                <div class="relative">
                    <input type="password" id="loginPassword" name="password" placeholder="••••••••" required class="w-full bg-slate-700 border border-slate-600 rounded-xl pl-4 pr-10 py-2.5 text-white text-sm focus:outline-none focus:border-indigo-500">
                    <button type="button" onclick="togglePassword('loginPassword', 'eyeIcon')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-white">
                        <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
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

    <script>
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
</body>
</html>
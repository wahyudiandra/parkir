<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PARKIR.IO</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-100 flex items-center justify-center min-h-screen">
    <div class="bg-slate-800 p-8 rounded-2xl border border-slate-700 w-full max-w-md shadow-2xl">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-indigo-500 tracking-wider">PARKIR.IO</h1>
            <p class="text-sm text-slate-400 mt-2">Silakan masuk ke akun Anda</p>
        </div>

        <!-- FORM LOGIN -->
        <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
            @csrf
            
            <div>
                <label class="block text-xs font-medium text-slate-300 mb-1.5">Email</label>
                <input type="email" name="email" required placeholder="admin@gmail.com / petugas@gmail.com / owner@gmail.com" class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-indigo-500 text-sm">
            </div>

            <div>
                <label class="block text-xs font-medium text-slate-300 mb-1.5">Password</label>
                <input type="password" name="password" required placeholder="••••••••" class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-indigo-500 text-sm">
            </div>

            <!-- TOMBOL TYPE SUBMIT -->
            <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-500 font-semibold text-white rounded-lg transition text-sm shadow-lg cursor-pointer">
                Masuk
            </button>
        </form>
    </div>
</body>
</html>
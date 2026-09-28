<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;

// --- 1. LOGIN & LOGOUT ---
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $email = strtolower($request->email);

    // Tentukan Role Berdasarkan Email
    if (str_contains($email, 'admin')) {
        $role = 'admin';
        $redirectRoute = 'admin.dashboard';
    } elseif (str_contains($email, 'owner')) {
        $role = 'owner';
        $redirectRoute = 'owner.rekap';
    } else {
        $role = 'petugas';
        $redirectRoute = 'petugas.transaksi';
    }

    // Buat/ambil user dari database SQLite agar session bertahan
    $user = User::firstOrCreate(
        ['email' => $email],
        [
            'name' => ucfirst($role),
            'password' => bcrypt('password'),
            'role' => $role
        ]
    );

    // Update role jika user sudah ada namun role beda
    if ($user->role !== $role) {
        $user->role = $role;
        $user->save();
    }

    // Login dan simpan Session
    auth()->login($user, true);
    $request->session()->regenerate();

    return redirect()->route($redirectRoute);
})->name('login.post');

Route::post('/logout', function (Request $request) {
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');


// --- 2. HALAMAN ADMIN ---
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () { return view('admin.dashboard'); })->name('admin.dashboard');
    Route::get('/users', function () { return view('admin.users'); })->name('admin.users');
    Route::get('/tarif', function () { return view('admin.tarif'); })->name('admin.tarif');
    Route::get('/area', function () { return view('admin.area'); })->name('admin.area');
    Route::get('/kendaraan', function () { return view('admin.kendaraan'); })->name('admin.kendaraan');
    Route::get('/log', function () { return view('admin.log'); })->name('admin.log');
});


// --- 3. HALAMAN PETUGAS ---
Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->group(function () {
    Route::get('/transaksi', function () { return view('petugas.transaksi'); })->name('petugas.transaksi');
    Route::get('/struk', function () { return view('petugas.struk'); })->name('petugas.struk');
});


// --- 4. HALAMAN OWNER ---
Route::middleware(['auth', 'role:owner'])->prefix('owner')->group(function () {
    Route::get('/rekap', function () { return view('owner.rekap'); })->name('owner.rekap');
});
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\AdminController;

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

    $user = User::where('email', $email)->first();

    if (!$user) {
        if (str_contains($email, 'admin')) {
            $role = 'admin';
        } elseif (str_contains($email, 'owner')) {
            $role = 'owner';
        } else {
            $role = 'petugas';
        }

        $user = User::create([
            'email' => $email,
            'name' => ucfirst($role),
            'password' => bcrypt('password'),
            'role' => $role
        ]);
    }

    if ($user->role === 'admin') {
        $redirectRoute = 'admin.dashboard';
    } elseif ($user->role === 'owner') {
        $redirectRoute = 'owner.rekap';
    } else {
        $redirectRoute = 'petugas.transaksi';
    }

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


// --- 2. HALAMAN ADMIN (TERHUBUNG KE CONTROLLER) ---
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // CRUD User
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

    // CRUD Tarif
    Route::get('/tarif', [AdminController::class, 'tarif'])->name('admin.tarif');
    Route::post('/tarif', [AdminController::class, 'storeTarif'])->name('admin.tarif.store');
    Route::put('/tarif/{id}', [AdminController::class, 'updateTarif'])->name('admin.tarif.update');
    Route::delete('/tarif/{id}', [AdminController::class, 'deleteTarif'])->name('admin.tarif.delete');

    // Menu Admin Lainnya
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
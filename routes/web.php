<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\OwnerController;

// --- 1. AUTHENTICATION & REGISTRATION ---
Route::get('/', function () { return view('auth.login'); });
Route::get('/login', function () { return view('auth.login'); })->name('login');

Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required',
        'password' => 'required',
    ]);

    $input = strtolower($request->email);

    // Cari user di database berdasarkan username atau email
    $user = User::where('username', $input)
                ->orWhere('email', $input)
                ->first();

    // Jika user tidak ditemukan ATAU password salah
    if (!$user || !Hash::check($request->password, $user->password)) {
        return back()->withErrors(['login_error' => 'Email/Username atau password salah!'])->withInput();
    }

    // Arahkan sesuai role user
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

// Route Registrasi
Route::get('/register', function () { return view('auth.register'); })->name('register');
Route::post('/register', function (Request $request) {
    $request->validate([
        'nama_lengkap' => 'required|string|max:50',
        'username'     => 'required|string|max:50|unique:tb_user,username',
        'email'        => 'required|email|unique:tb_user,email',
        'password'     => 'required|min:4',
        'role'         => 'required'
    ]);

    User::create([
        'nama_lengkap' => $request->nama_lengkap,
        'username'     => strtolower($request->username),
        'email'        => strtolower($request->email),
        'password'     => Hash::make($request->password),
        'role'         => $request->role,
        'status_aktif' => 1
    ]);

    return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login dengan akun Anda.');
})->name('register.post');

Route::post('/logout', function (Request $request) {
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');

// --- 2. HALAMAN ADMIN ---
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

    // CRUD Area Parkir
    Route::get('/area', [AdminController::class, 'area'])->name('admin.area');
    Route::post('/area', [AdminController::class, 'storeArea'])->name('admin.area.store');
    Route::put('/area/{id}', [AdminController::class, 'updateArea'])->name('admin.area.update');
    Route::delete('/area/{id}', [AdminController::class, 'deleteArea'])->name('admin.area.delete');

    // CRUD Kendaraan
    Route::get('/kendaraan', [AdminController::class, 'kendaraan'])->name('admin.kendaraan');
    Route::post('/kendaraan', [AdminController::class, 'storeKendaraan'])->name('admin.kendaraan.store');
    Route::put('/kendaraan/{id}', [AdminController::class, 'updateKendaraan'])->name('admin.kendaraan.update');
    Route::delete('/kendaraan/{id}', [AdminController::class, 'deleteKendaraan'])->name('admin.kendaraan.delete');

    // Log Aktivitas
    Route::get('/log', [AdminController::class, 'log'])->name('admin.log');
});

// --- 3. HALAMAN PETUGAS ---
Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->group(function () {
    Route::get('/transaksi', [PetugasController::class, 'transaksi'])->name('petugas.transaksi');
    Route::post('/transaksi/masuk', [PetugasController::class, 'masukParkir'])->name('petugas.transaksi.masuk');
    Route::post('/transaksi/keluar/{id}', [PetugasController::class, 'keluarParkir'])->name('petugas.transaksi.keluar');
    Route::get('/struk/{id?}', [PetugasController::class, 'struk'])->name('petugas.struk');
});

// --- 4. HALAMAN OWNER ---
Route::middleware(['auth', 'role:owner'])->prefix('owner')->group(function () {
    Route::get('/rekap', [OwnerController::class, 'rekap'])->name('owner.rekap');
});
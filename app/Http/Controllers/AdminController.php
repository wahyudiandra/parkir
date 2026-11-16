<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Tarif;
use App\Models\AreaParkir;
use App\Models\Kendaraan;
use App\Models\Transaksi;
use App\Models\LogAktivitas;
use Carbon\Carbon;

class AdminController extends Controller
{
    // --- DASHBOARD ADMIN ---
    public function dashboard()
    {
        $totalUser = User::count();
        $totalTarif = Tarif::count();
        $totalArea = AreaParkir::count();
        $totalKendaraan = Kendaraan::count();
        
        $kendaraanTerparkir = Transaksi::where('status', 'masuk')->count();

        return view('admin.dashboard', compact('totalUser', 'totalTarif', 'totalArea', 'totalKendaraan', 'kendaraanTerparkir'));
    }

    // --- KELOLA USER ---
    public function users()
    {
        $users = User::orderBy('id_user', 'desc')->get();
        return view('admin.users', compact('users'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'username'     => 'required|unique:tb_user,username',
            'password'     => 'required',
            'role'         => 'required'
        ]);

        $username = strtolower(trim($request->username));

        $user = User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username'     => $username,
            'email'        => $username . '@gmail.com',
            'password'     => Hash::make($request->password),
            'role'         => $request->role,
            'status_aktif' => 1
        ]);

        LogAktivitas::create([
            'id_user'         => auth()->id(),
            'aktivitas'       => 'Menambahkan User Baru: ' . $user->username . ' (' . strtoupper($user->role) . ')',
            'waktu_aktivitas' => Carbon::now()
        ]);

        return redirect()->route('admin.users')->with('success', 'User berhasil ditambahkan.');
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nama_lengkap' => 'required',
            'username'     => 'required|unique:tb_user,username,' . $id . ',id_user',
            'role'         => 'required'
        ]);

        $username = strtolower(trim($request->username));

        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'username'     => $username,
            'email'        => $username . '@gmail.com', // Update email agar selaras dengan username baru
            'role'         => $request->role,
        ];

        // Jika form password diisi, enkripsi dan perbarui password
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        LogAktivitas::create([
            'id_user'         => auth()->id(),
            'aktivitas'       => 'Mengubah Data User: ' . $user->username,
            'waktu_aktivitas' => Carbon::now()
        ]);

        return redirect()->route('admin.users')->with('success', 'Data user berhasil diperbarui.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $username = $user->username;
        $user->delete();

        LogAktivitas::create([
            'id_user'         => auth()->id(),
            'aktivitas'       => 'Menghapus User: ' . $username,
            'waktu_aktivitas' => Carbon::now()
        ]);

        return redirect()->route('admin.users')->with('success', 'User berhasil dihapus!');
    }

    // --- KELOLA TARIF ---
    public function tarif()
    {
        $tarifs = Tarif::all();
        return view('admin.tarif', compact('tarifs'));
    }

    public function storeTarif(Request $request)
    {
        $request->validate([
            'jenis_kendaraan' => 'required',
            'tarif_per_jam'   => 'required|numeric'
        ]);

        Tarif::create([
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'tarif_per_jam'   => $request->tarif_per_jam
        ]);

        LogAktivitas::create([
            'id_user'         => auth()->id(),
            'aktivitas'       => 'Menambahkan Tarif Parkir Jenis: ' . strtoupper($request->jenis_kendaraan),
            'waktu_aktivitas' => Carbon::now()
        ]);

        return redirect()->route('admin.tarif')->with('success', 'Tarif berhasil ditambahkan.');
    }

    public function updateTarif(Request $request, $id)
    {
        $tarif = Tarif::findOrFail($id);

        $request->validate([
            'jenis_kendaraan' => 'required',
            'tarif_per_jam'   => 'required|numeric'
        ]);

        $tarif->update([
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'tarif_per_jam'   => $request->tarif_per_jam
        ]);

        LogAktivitas::create([
            'id_user'         => auth()->id(),
            'aktivitas'       => 'Mengubah Tarif Parkir Jenis: ' . strtoupper($request->jenis_kendaraan),
            'waktu_aktivitas' => Carbon::now()
        ]);

        return redirect()->route('admin.tarif')->with('success', 'Tarif berhasil diperbarui.');
    }

    public function deleteTarif($id)
    {
        $tarif = Tarif::findOrFail($id);
        $jenis = $tarif->jenis_kendaraan;
        $tarif->delete();

        LogAktivitas::create([
            'id_user'         => auth()->id(),
            'aktivitas'       => 'Menghapus Tarif Parkir Jenis: ' . strtoupper($jenis),
            'waktu_aktivitas' => Carbon::now()
        ]);

        return redirect()->route('admin.tarif')->with('success', 'Tarif berhasil dihapus.');
    }

    // --- KELOLA AREA PARKIR ---
    public function area()
    {
        $areas = AreaParkir::all();
        return view('admin.area', compact('areas'));
    }

    public function storeArea(Request $request)
    {
        $request->validate([
            'nama_area' => 'required',
            'kapasitas' => 'required|numeric'
        ]);

        AreaParkir::create([
            'nama_area' => $request->nama_area,
            'kapasitas' => $request->kapasitas,
            'terisi'    => 0
        ]);

        LogAktivitas::create([
            'id_user'         => auth()->id(),
            'aktivitas'       => 'Menambahkan Area Parkir Baru: ' . $request->nama_area,
            'waktu_aktivitas' => Carbon::now()
        ]);

        return redirect()->route('admin.area')->with('success', 'Area parkir berhasil ditambahkan.');
    }

    public function updateArea(Request $request, $id)
    {
        $area = AreaParkir::findOrFail($id);

        $request->validate([
            'nama_area' => 'required',
            'kapasitas' => 'required|numeric'
        ]);

        $area->update([
            'nama_area' => $request->nama_area,
            'kapasitas' => $request->kapasitas,
        ]);

        LogAktivitas::create([
            'id_user'         => auth()->id(),
            'aktivitas'       => 'Mengubah Area Parkir: ' . $request->nama_area,
            'waktu_aktivitas' => Carbon::now()
        ]);

        return redirect()->route('admin.area')->with('success', 'Area parkir berhasil diperbarui.');
    }

    public function deleteArea($id)
    {
        $area = AreaParkir::findOrFail($id);
        $namaArea = $area->nama_area;
        $area->delete();

        LogAktivitas::create([
            'id_user'         => auth()->id(),
            'aktivitas'       => 'Menghapus Area Parkir: ' . $namaArea,
            'waktu_aktivitas' => Carbon::now()
        ]);

        return redirect()->route('admin.area')->with('success', 'Area parkir berhasil dihapus.');
    }

    // --- KELOLA KENDARAAN ---
    public function kendaraan()
    {
        $kendaraans = Kendaraan::all();
        return view('admin.kendaraan', compact('kendaraans'));
    }

    public function storeKendaraan(Request $request)
    {
        $request->validate([
            'plat_nomor'      => 'required',
            'jenis_kendaraan' => 'required'
        ]);

        Kendaraan::create([
            'plat_nomor'      => strtoupper($request->plat_nomor),
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'warna'           => $request->warna ?? '-',
            'pemilik'         => $request->pemilik ?? 'Umum',
            'id_user'         => auth()->id()
        ]);

        LogAktivitas::create([
            'id_user'         => auth()->id(),
            'aktivitas'       => 'Menambahkan Kendaraan Terdaftar Plat: ' . strtoupper($request->plat_nomor),
            'waktu_aktivitas' => Carbon::now()
        ]);

        return redirect()->route('admin.kendaraan')->with('success', 'Kendaraan berhasil ditambahkan.');
    }

    public function updateKendaraan(Request $request, $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        $request->validate([
            'plat_nomor'      => 'required',
            'jenis_kendaraan' => 'required'
        ]);

        $kendaraan->update([
            'plat_nomor'      => strtoupper($request->plat_nomor),
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'warna'           => $request->warna ?? '-',
            'pemilik'         => $request->pemilik ?? 'Umum'
        ]);

        LogAktivitas::create([
            'id_user'         => auth()->id(),
            'aktivitas'       => 'Mengubah Data Kendaraan Plat: ' . strtoupper($request->plat_nomor),
            'waktu_aktivitas' => Carbon::now()
        ]);

        return redirect()->route('admin.kendaraan')->with('success', 'Data kendaraan berhasil diperbarui.');
    }

    public function deleteKendaraan($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $plat = $kendaraan->plat_nomor;
        $kendaraan->delete();

        LogAktivitas::create([
            'id_user'         => auth()->id(),
            'aktivitas'       => 'Menghapus Data Kendaraan Plat: ' . $plat,
            'waktu_aktivitas' => Carbon::now()
        ]);

        return redirect()->route('admin.kendaraan')->with('success', 'Data kendaraan berhasil dihapus.');
    }

    // --- LOG AKTIVITAS ---
    public function log()
    {
        $logs = LogAktivitas::with('user')->orderBy('id_log', 'desc')->get();
        return view('admin.log', compact('logs'));
    }
}
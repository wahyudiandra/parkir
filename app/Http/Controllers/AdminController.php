<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tarif;
use App\Models\AreaParkir;
use App\Models\Kendaraan;
use App\Models\Transaksi;
use App\Models\LogAktivitas;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUser = User::count();
        $totalTarif = Tarif::count();
        $totalArea = AreaParkir::count();
        $kendaraanTerparkir = Transaksi::where('status', 'masuk')->count();

        return view('admin.dashboard', compact('totalUser', 'totalTarif', 'totalArea', 'kendaraanTerparkir'));
    }

    // --- CRUD USER ---
    public function users() {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function storeUser(Request $request) {
        $request->validate([
            'nama_lengkap' => 'required',
            'username'     => 'required|unique:tb_user,username',
            'role'         => 'required'
        ]);

        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username'     => strtolower($request->username),
            'email'        => $request->email ?? strtolower($request->username) . '@gmail.com',
            'password'     => bcrypt('password'),
            'role'         => strtolower($request->role),
            'status_aktif' => 1
        ]);

        return redirect()->back()->with('success', 'User berhasil ditambahkan!');
    }

    public function updateUser(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->update([
            'nama_lengkap' => $request->nama_lengkap,
            'username'     => strtolower($request->username),
            'role'         => strtolower($request->role)
        ]);

        return redirect()->back()->with('success', 'User berhasil diperbarui!');
    }

    public function deleteUser($id) {
        User::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'User berhasil dihapus!');
    }

    // --- CRUD TARIF ---
    public function tarif() {
        $tarifs = Tarif::all();
        return view('admin.tarif', compact('tarifs'));
    }

    public function storeTarif(Request $request) {
        $request->validate([
            'jenis_kendaraan' => 'required',
            'tarif_per_jam'   => 'required|numeric',
        ]);

        Tarif::create([
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'tarif_per_jam'   => $request->tarif_per_jam
        ]);

        return redirect()->back()->with('success', 'Tarif berhasil ditambahkan!');
    }

    public function updateTarif(Request $request, $id) {
        $tarif = Tarif::findOrFail($id);
        $tarif->update([
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'tarif_per_jam'   => $request->tarif_per_jam
        ]);

        return redirect()->back()->with('success', 'Tarif berhasil diperbarui!');
    }

    public function deleteTarif($id) {
        Tarif::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Tarif berhasil dihapus!');
    }

    // --- CRUD AREA PARKIR ---
    public function area() {
        $areas = AreaParkir::all();
        return view('admin.area', compact('areas'));
    }

    public function storeArea(Request $request) {
        $request->validate([
            'nama_area' => 'required',
            'kapasitas' => 'required|numeric'
        ]);

        AreaParkir::create([
            'nama_area' => $request->nama_area,
            'kapasitas' => $request->kapasitas,
            'terisi'    => 0
        ]);

        return redirect()->back()->with('success', 'Area parkir berhasil ditambahkan!');
    }

    public function updateArea(Request $request, $id) {
        $area = AreaParkir::findOrFail($id);
        $area->update([
            'nama_area' => $request->nama_area,
            'kapasitas' => $request->kapasitas
        ]);

        return redirect()->back()->with('success', 'Area parkir berhasil diperbarui!');
    }

    public function deleteArea($id) {
        AreaParkir::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Area parkir berhasil dihapus!');
    }

    // --- CRUD KENDARAAN ---
    public function kendaraan() {
        $kendaraans = Kendaraan::with('user')->get();
        $tarifs = Tarif::all();
        return view('admin.kendaraan', compact('kendaraans', 'tarifs'));
    }

    public function storeKendaraan(Request $request) {
        $request->validate([
            'plat_nomor'      => 'required|unique:tb_kendaraan,plat_nomor',
            'jenis_kendaraan' => 'required'
        ]);

        Kendaraan::create([
            'plat_nomor'      => strtoupper($request->plat_nomor),
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'warna'           => $request->warna ?? '-',
            'pemilik'         => $request->pemilik ?? 'Umum',
            'id_user'         => auth()->user()->id_user ?? null
        ]);

        return redirect()->back()->with('success', 'Kendaraan berhasil ditambahkan!');
    }

    public function updateKendaraan(Request $request, $id) {
        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->update([
            'plat_nomor'      => strtoupper($request->plat_nomor),
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'warna'           => $request->warna ?? '-',
            'pemilik'         => $request->pemilik
        ]);

        return redirect()->back()->with('success', 'Kendaraan berhasil diperbarui!');
    }

    public function deleteKendaraan($id) {
        Kendaraan::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Kendaraan berhasil dihapus!');
    }

    // --- LOG AKTIVITAS ---
    public function log() {
        $logs = LogAktivitas::with('user')->latest()->get();
        return view('admin.log', compact('logs'));
    }
}
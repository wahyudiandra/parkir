<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tarif;

class AdminController extends Controller
{
    // --- USER MANAGEMENT ---
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role'  => 'required|string'
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => strtolower($request->email),
            'password' => bcrypt('password'),
            'role'     => strtolower($request->role)
        ]);

        return redirect()->back()->with('success', 'User berhasil ditambahkan!');
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role'  => 'required|string'
        ]);

        $user = User::findOrFail($id);
        $user->name  = $request->name;
        $user->email = strtolower($request->email);
        $user->role  = strtolower($request->role);
        $user->save();

        return redirect()->back()->with('success', 'User berhasil diperbarui!');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus!');
    }

    // --- TARIF MANAGEMENT ---
    public function tarif()
    {
        $tarifs = Tarif::all();
        return view('admin.tarif', compact('tarifs'));
    }

    public function storeTarif(Request $request)
    {
        $request->validate([
            'jenis_kendaraan' => 'required|string',
            'tarif_pertama'   => 'required|numeric',
            'tarif_berikutnya'=> 'required|numeric',
        ]);

        Tarif::create([
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'tarif_pertama'   => $request->tarif_pertama,
            'tarif_berikutnya' => $request->tarif_berikutnya,
        ]);

        return redirect()->back()->with('success', 'Tarif berhasil ditambahkan!');
    }

    public function updateTarif(Request $request, $id)
    {
        $request->validate([
            'jenis_kendaraan' => 'required|string',
            'tarif_pertama'   => 'required|numeric',
            'tarif_berikutnya'=> 'required|numeric',
        ]);

        $tarif = Tarif::findOrFail($id);
        $tarif->update([
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'tarif_pertama'   => $request->tarif_pertama,
            'tarif_berikutnya' => $request->tarif_berikutnya,
        ]);

        return redirect()->back()->with('success', 'Tarif berhasil diperbarui!');
    }

    public function deleteTarif($id)
    {
        $tarif = Tarif::findOrFail($id);
        $tarif->delete();

        return redirect()->back()->with('success', 'Tarif berhasil dihapus!');
    }
}
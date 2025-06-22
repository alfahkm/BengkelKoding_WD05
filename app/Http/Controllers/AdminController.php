<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Form login admin
    public function formLogin()
    {
        return view('layouts.admin_login'); // Asumsi view ini sudah ada atau user bisa buat sendiri
    }

    // Proses login admin
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->intended('/admin/dashboard');
            } else {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Anda bukan admin.',
                ])->onlyInput('email');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // Logout admin
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }

    // Daftar pasien (CRUD pasien)
    public function indexPasien()
    {
        $pasiens = User::where('role', 'pasien')->get();
        return view('layouts.admin.list_pasien', compact('pasiens'));
    }

    public function createPasien()
    {
        return view('layouts.admin.add_pasien');
    }

    public function storePasien(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pasien',
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('admin.pasien.index')->with('success', 'Pasien berhasil ditambahkan.');
    }

    public function editPasien($id)
    {
        $pasien = User::findOrFail($id);
        return view('layouts.admin.edit_pasien', compact('pasien'));
    }

    public function updatePasien(Request $request, $id)
    {
        $pasien = User::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$pasien->id,
            'password' => 'nullable|string|min:8|confirmed',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
        ]);

        $pasien->nama = $request->nama;
        $pasien->email = $request->email;
        if ($request->filled('password')) {
            $pasien->password = Hash::make($request->password);
        }
        $pasien->alamat = $request->alamat;
        $pasien->no_hp = $request->no_hp;
        $pasien->save();

        return redirect()->route('admin.pasien.index')->with('success', 'Pasien berhasil diperbarui.');
    }

    public function destroyPasien($id)
    {
        $pasien = User::findOrFail($id);
        $pasien->delete();

        return redirect()->route('admin.pasien.index')->with('success', 'Pasien berhasil dihapus.');
    }

    // Update data dokter
    public function indexDokter()
    {
        $dokters = User::where('role', 'dokter')->get();
        return view('layouts.admin.list_dokter', compact('dokters'));
    }

    public function editDokter($id)
    {
        $dokter = User::findOrFail($id);
        return view('layouts.admin.edit_dokter', compact('dokter'));
    }

    public function updateDokter(Request $request, $id)
    {
        $dokter = User::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$dokter->id,
            'password' => 'nullable|string|min:8|confirmed',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
        ]);

        $dokter->nama = $request->nama;
        $dokter->email = $request->email;
        if ($request->filled('password')) {
            $dokter->password = Hash::make($request->password);
        }
        $dokter->alamat = $request->alamat;
        $dokter->no_hp = $request->no_hp;
        $dokter->save();

        return redirect()->route('admin.dokter.index')->with('success', 'Dokter berhasil diperbarui.');
    }
}

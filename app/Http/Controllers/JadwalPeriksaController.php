<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalPeriksa;

class JadwalPeriksaController extends Controller
{
    public function index()
    {
        $jadwals = JadwalPeriksa::all();
        return view('layouts.admin.list_jadwal', compact('jadwals'));
    }

    public function create()
    {
        $dokters = \App\Models\User::where('role', 'dokter')->get();
        return view('layouts.admin.add_jadwal', compact('dokters'));
    }

    // Other CRUD methods can be added here as needed

    public function store(Request $request)
    {
        $request->validate([
            'id_dokter' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        \App\Models\JadwalPeriksa::create([
            'id_poli' => null, // karena form tidak ada input poli, set null atau sesuaikan jika ada logika lain
            'id_dokter' => $request->id_dokter,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'waktu' => $request->jam_mulai . ' - ' . $request->jam_selesai,
        ]);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }
}

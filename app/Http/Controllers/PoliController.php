<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\poli;

class PoliController extends Controller
{
    public function index()
    {
        $polis = poli::all();
        return view('layouts.admin.list_poli', compact('polis'));
    }

    public function create()
    {
        return view('layouts.admin.add_poli');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        poli::create([
            'nama_poli' => $request->nama_poli,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.poli.index')->with('success', 'Poli berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $poli = poli::findOrFail($id);
        return view('layouts.admin.edit_poli', compact('poli'));
    }

    public function update(Request $request, $id)
    {
        $poli = poli::findOrFail($id);

        $request->validate([
            'nama_poli' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $poli->nama_poli = $request->nama_poli;
        $poli->deskripsi = $request->deskripsi;
        $poli->save();

        return redirect()->route('admin.poli.index')->with('success', 'Poli berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $poli = poli::findOrFail($id);
        $poli->delete();

        return redirect()->route('admin.poli.index')->with('success', 'Poli berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\periksa;

use App\Models\Poli;

class DokterController extends Controller
{
    public function index()
    {
        $dokters = User::where('role', 'dokter')->get();
        $polis = Poli::all();
        return view('layouts.dashboard', compact('dokters', 'polis'));
    }
    public function byDokter(Request $request)
    {
        // Get doctors and examination history for display
        $dokters = User::where('role', 'dokter')->get();
        $periksas = Periksa::with('dokter', 'pasien')
            ->where('id_pasien', auth()->user()->id)
            ->get();
        $polis = Poli::all();

        // Only process form submission for POST requests
        if ($request->isMethod('post')) {
            $request->validate([
                'id_poli' => 'required|exists:polis,id',
                'id_dokter' => 'required|exists:users,id',
                'tgl_periksa' => 'required|date',
            ]);

            // Create new examination record
            Periksa::create([
                'id_pasien' => auth()->user()->id,
                'id_poli' => $request->id_poli,
                'id_dokter' => $request->id_dokter,
                'tgl_periksa' => $request->tgl_periksa, // You can change this if needed
                'catatan' => $request->catatan ?? 'N/A',
                'biaya_periksa' => $request->biaya_periksa !== 'N/A' ? $request->biaya_periksa : null,

                'status' => 'Menunggu' // Add status if it's in your model
            ]);

            return redirect()->route('periksa.byDokter')
                ->with('success', 'Berhasil memilih Dokter');
        }

        // Display the view with current data
        return view('layouts.list_dokter', compact('dokters', 'periksas', 'polis'));
    }
}

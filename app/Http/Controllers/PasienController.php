<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Obat;
use App\Models\periksa;

use App\Models\Antrian;
use App\Models\Poli;
use App\Models\User as UserModel;

class PasienController extends Controller
{
    public function pasien()
    {
        // Ambil dokter yang sedang login
        $dokter = auth()->user(); // Mendapatkan data user yang sedang login

        // Pastikan yang login adalah dokter
        if ($dokter->role !== 'dokter') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai dokter.');
        }

        // Ambil semua pemeriksaan yang dilakukan oleh dokter yang sedang login
        $periksas = Periksa::with(['pasien', 'dokter'])
            ->where('id_dokter', $dokter->id)  // Mengambil pemeriksaan berdasarkan id dokter yang login
            ->get();

        return view('layouts.pemeriksaan', compact('periksas'));
    }

    // Fungsi verifikasi pasien berdasarkan nomor KTP
    public function verifikasiKTP(Request $request)
    {
        $request->validate([
            'ktp' => 'required|string|exists:users,ktp',
        ]);

        $user = User::where('ktp', $request->ktp)->first();

        if ($user) {
            return response()->json([
                'status' => 'success',
                'message' => 'Pasien terverifikasi',
                'data' => $user,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Pasien tidak ditemukan',
            ], 404);
        }
    }

    // Fungsi untuk mendaftar ke poli, memilih dokter, dan mendapatkan nomor antrian
    public function daftarPoli(Request $request)
    {
        $request->validate([
            'id_poli' => 'required|exists:polis,id',
            'id_dokter' => 'required|exists:users,id',
            'tanggal' => 'required|date',
        ]);

        $id_pasien = auth()->user()->id;
        $id_poli = $request->id_poli;
        $id_dokter = $request->id_dokter;
        $tanggal = $request->tanggal;

        // Generate nomor antrian berdasarkan poli dan tanggal
        $nomor_antrian_terakhir = Antrian::where('id_poli', $id_poli)
            ->where('tanggal', $tanggal)
            ->max('nomor_antrian');

        $nomor_antrian_baru = $nomor_antrian_terakhir ? $nomor_antrian_terakhir + 1 : 1;

        // Simpan data antrian
        $antrian = Antrian::create([
            'id_pasien' => $id_pasien,
            'id_poli' => $id_poli,
            'id_dokter' => $id_dokter,
            'tanggal' => $tanggal,
            'nomor_antrian' => $nomor_antrian_baru,
        ]);

        // Ambil nama poli dan dokter untuk ditampilkan
        $poli = Poli::find($id_poli);
        $dokter = User::find($id_dokter);

        // Simpan data nomor antrian dan info lain ke session
        session([
            'nomor_antrian' => $nomor_antrian_baru,
            'poli_name' => $poli ? $poli->nama_poli : '',
            'dokter_name' => $dokter ? $dokter->name : '',
            'tanggal' => $tanggal,
        ]);

        return redirect()->route('pasien.nomor_antrian');
    }

    // Fungsi untuk menampilkan daftar poli untuk pasien
    public function listPoli()
    {
        $polis = Poli::all();
        return response()->json([
            'status' => 'success',
            'data' => $polis,
        ]);
    }





    public function edit($id)
    {
        // Pastikan ambil data periksa beserta relasinya
        $periksa = Periksa::with(['pasien', 'dokter', 'detailPeriksa.obat'])->findOrFail($id);
        $obats = Obat::all();

        // Biaya pemeriksaan
        $biayaPeriksa = $periksa->biaya_periksa ?? 0;

        // Hitung total harga obat
        $totalHargaObat = 0;
        foreach ($periksa->detailPeriksa as $detail) {
            if ($detail->obat) {
                $totalHargaObat += $detail->obat->harga;
            }
        }

        // Total harga = biaya periksa + total harga obat
        $totalHarga = $biayaPeriksa + $totalHargaObat;
        // Siapkan array ID obat yang dipilih untuk pre-select di form
        $selectedObatIds = [];
        foreach ($periksa->detailPeriksa as $detail) {
            if ($detail->obat) {
                $selectedObatIds[] = $detail->obat->id;
            }
        }

        return view('layouts.edit_periksa', compact('periksa', 'obats', 'totalHarga'));
    }

    public function create()
    {
        return view('admin_add_pasien_full');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_rm' => 'required|unique:users,no_rm',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'nullable|string',
            'tanggal_lahir' => 'required|date',
        ]);

        $user = new User();
        $user->no_rm = $request->no_rm;
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->no_hp = $request->no_hp;
        $user->alamat = $request->alamat;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->role = 'pasien';
        $user->save();

        return redirect()->route('admin.pasien.index')->with('success', 'Pasien berhasil ditambahkan.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'catatan' => 'required|string',
            'obat_ids' => 'required|array',
        ]);

        $periksa = Periksa::findOrFail($id);

        $periksa->tgl_periksa = $request->tanggal;
        $periksa->catatan = $request->catatan;
        $periksa->status = 'Diperiksa';

        // Sinkronisasi relasi obat (pastikan relasi many-to-many sudah didefinisikan di model)
        $periksa->obats()->sync($request->obat_ids);

        // Hitung biaya periksa otomatis
        $periksa->biaya_periksa = $periksa->hitungBiayaPeriksa();

        $periksa->save();

        return redirect()->route('pasien.index')->with('success', 'Data pemeriksaan berhasil diperbarui.');
    }
}
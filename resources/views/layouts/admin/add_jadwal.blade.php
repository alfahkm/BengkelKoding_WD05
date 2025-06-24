@extends('layouts.admin.dashboard')

@section('content')
<div class="container mx-auto mt-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Tambah Jadwal Periksa Baru</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.jadwal.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label for="id_dokter" class="block mb-2 font-semibold">Dokter</label>
            <select id="id_dokter" name="id_dokter" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Pilih Dokter</option>
                @foreach ($dokters as $dokter)
                    <option value="{{ $dokter->id }}" {{ old('id_dokter') == $dokter->id ? 'selected' : '' }}>
                        {{ $dokter->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="tanggal" class="block mb-2 font-semibold">Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label for="jam_mulai" class="block mb-2 font-semibold">Jam Mulai</label>
            <input type="time" id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai') }}" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label for="jam_selesai" class="block mb-2 font-semibold">Jam Selesai</label>
            <input type="time" id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai') }}" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="space-x-4">
            <button type="submit" class="bg-blue-600 text-white font-semibold px-6 py-2 rounded hover:bg-blue-700 transition">Simpan</button>
            <a href="{{ route('admin.jadwal.index') }}" class="inline-block bg-gray-400 text-white font-semibold px-6 py-2 rounded hover:bg-gray-500 transition">Batal</a>
        </div>
    </form>
</div>
@endsection

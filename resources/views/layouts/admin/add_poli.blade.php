@extends('layouts.admin.dashboard')

@section('content')
<div class="container mx-auto mt-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Tambah Poli Baru</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.poli.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label for="nama_poli" class="block mb-2 font-semibold">Nama Poli</label>
            <input type="text" id="nama_poli" name="nama_poli" value="{{ old('nama_poli') }}" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label for="deskripsi" class="block mb-2 font-semibold">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="space-x-4">
            <button type="submit" class="bg-blue-600 text-white font-semibold px-6 py-2 rounded hover:bg-blue-700 transition">Simpan</button>
            <a href="{{ route('admin.poli.index') }}" class="inline-block bg-gray-400 text-white font-semibold px-6 py-2 rounded hover:bg-gray-500 transition">Batal</a>
        </div>
    </form>
</div>
@endsection

@extends('layouts.admin.dashboard')

@section('content')
<div class="container">
    <h1>Tambah Pasien Baru</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.pasien.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="no_rm">Nomor Rekam Medis (No RM)</label>
            <input type="text" class="form-control" id="no_rm" name="no_rm" value="{{ old('no_rm') }}" required>
        </div>
        <div class="form-group">
            <label for="nama_pasien">Nama Pasien</label>
            <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" value="{{ old('nama_pasien') }}" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat">{{ old('alamat') }}</textarea>
        </div>

        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        <a href="{{ route('admin.pasien.index') }}" class="btn btn-secondary mt-3">Batal</a>
    </form>
</div>
@endsection

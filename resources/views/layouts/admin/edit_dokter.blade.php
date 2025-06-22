@extends('layouts.admin.dashboard')

@section('content')
<div class="container">
    <h1>Edit Dokter</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.dokter.update', $dokter->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_dokter">Nama Dokter</label>
            <input type="text" class="form-control" id="nama_dokter" name="nama_dokter" value="{{ old('nama_dokter', $dokter->nama_dokter) }}" required>
        </div>

        <div class="form-group">
            <label for="spesialis">Spesialis</label>
            <input type="text" class="form-control" id="spesialis" name="spesialis" value="{{ old('spesialis', $dokter->spesialis) }}" required>
        </div>

        <div class="form-group">
            <label for="no_hp">No HP</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp', $dokter->no_hp) }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
        <a href="{{ route('admin.dokter.index') }}" class="btn btn-secondary mt-3">Batal</a>
    </form>
</div>
@endsection

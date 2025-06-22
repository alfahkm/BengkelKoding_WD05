@extends('layouts.admin.dashboard')

@section('content')
<div class="container">
    <h1>Edit Poli</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.poli.update', $poli->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_poli">Nama Poli</label>
            <input type="text" class="form-control" id="nama_poli" name="nama_poli" value="{{ old('nama_poli', $poli->nama_poli) }}" required>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi">{{ old('deskripsi', $poli->deskripsi) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
        <a href="{{ route('admin.poli.index') }}" class="btn btn-secondary mt-3">Batal</a>
    </form>
</div>
@endsection

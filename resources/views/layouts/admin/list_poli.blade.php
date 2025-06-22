@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h1>Daftar Poli</h1>
    <a href="{{ route('admin.poli.create') }}" class="btn btn-primary mb-3">Tambah Poli</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Poli</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($polis as $poli)
            <tr>
                <td>{{ $poli->nama_poli }}</td>
                <td>{{ $poli->deskripsi }}</td>
                <td>
                    <a href="{{ route('admin.poli.edit', $poli->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.poli.destroy', $poli->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus poli ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

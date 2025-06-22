@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h1>Dashboard Admin</h1>
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Manajemen Pasien</h5>
                    <p class="card-text">Kelola data pasien.</p>
                    <a href="{{ route('admin.pasien.index') }}" class="btn btn-light">Kelola Pasien</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Manajemen Dokter</h5>
                    <p class="card-text">Kelola data dokter.</p>
                    <a href="{{ route('admin.dokter.index') }}" class="btn btn-light">Kelola Dokter</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Manajemen Poli</h5>
                    <p class="card-text">Kelola data poli.</p>
                    <a href="{{ route('admin.poli.index') }}" class="btn btn-light">Kelola Poli</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Manajemen Obat</h5>
                    <p class="card-text">Kelola data obat.</p>
                    <a href="{{ route('obat.index') }}" class="btn btn-light">Kelola Obat</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">Manajemen Jadwal Periksa</h5>
                    <p class="card-text">Kelola jadwal periksa dokter.</p>
                    <a href="{{ route('admin.jadwal.index') }}" class="btn btn-light">Kelola Jadwal</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

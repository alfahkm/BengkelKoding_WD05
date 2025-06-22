@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h2>Nomor Antrian Anda</h2>
    @if(session('nomor_antrian'))
        <div class="alert alert-success">
            <p>Terima kasih telah mendaftar ke poli.</p>
            <p>Nomor antrian Anda adalah: <strong>{{ session('nomor_antrian') }}</strong></p>
            <p>Poli: {{ session('poli_name') }}</p>
            <p>Dokter: {{ session('dokter_name') }}</p>
            <p>Tanggal: {{ session('tanggal') }}</p>
        </div>
    @else
        <div class="alert alert-warning">
            <p>Nomor antrian belum tersedia.</p>
        </div>
    @endif
    <a href="{{ url('/') }}" class="btn btn-primary">Kembali ke Beranda</a>
</div>
@endsection

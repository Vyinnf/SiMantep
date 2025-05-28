{{-- filepath: resources/views/dosen/dashboard.blade.php --}}
@extends('layouts.dosen')
@section('title', 'Dashboard Dosen')

@section('content')
{{-- <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Selamat datang, {{ Auth::user()->name }} 👋</h2>
    <span class="text-muted">Hari ini: {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
</div> --}}

<div class="row g-3 mb-4">
    {{-- Kartu Ringkasan --}}
    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <i class="bi bi-person-lines-fill fs-1 text-primary"></i>
                <h5 class="card-title mt-2">Pendaftaran</h5>
                <p class="card-text">Total: <strong>{{ $totalPendaftaran }}</strong></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <i class="bi bi-journal-check fs-1 text-success"></i>
                <h5 class="card-title mt-2">Laporan Masuk</h5>
                <p class="card-text">Perlu Dicek: <strong>{{ $totalLaporan }}</strong></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <i class="bi bi-people fs-1 text-warning"></i>
                <h5 class="card-title mt-2">Mahasiswa Bimbingan</h5>
                <p class="card-text">Aktif: <strong>{{ $totalMahasiswa }}</strong></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <i class="bi bi-bell fs-1 text-danger"></i>
                <h5 class="card-title mt-2">Notifikasi</h5>
                <p class="card-text">Baru: <strong>{{ $totalNotifikasi }}</strong></p>
            </div>
        </div>
    </div>
</div>

@endsection

{{-- filepath: resources/views/admin/dashboard-custom.blade.php --}}
@extends('layouts.admin')
@section('title', 'Dashboard Admin')

@section('content')
<h2 class="mb-4 text-center">Dashboard Statistik Admin</h2>
<div class="dashboard-grid">
    <div class="dashboard-card mahasiswa">
        <i class="mdi mdi-account-multiple"></i>
        <div class="label">Mahasiswa</div>
        <div class="value">{{ $totalMahasiswa ?? 0 }}</div>
    </div>
    <div class="dashboard-card dosen">
        <i class="mdi mdi-account-star"></i>
        <div class="label">Dosen</div>
        <div class="value">{{ $totalDosen ?? 0 }}</div>
    </div>
    <div class="dashboard-card pendaftaran">
        <i class="mdi mdi-file-document-box"></i>
        <div class="label">Pendaftaran PKL</div>
        <div class="value">{{ $totalPendaftaran ?? 0 }}</div>
    </div>
    <div class="dashboard-card notifikasi">
        <i class="mdi mdi-bell-ring"></i>
        <div class="label">Notifikasi</div>
        <div class="value">{{ $totalNotifikasi ?? 0 }}</div>
    </div>
</div>
@endsection

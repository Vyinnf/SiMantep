{{-- filepath: resources/views/admin/dashboard-custom.blade.php --}}
@extends('layouts.admin')
@section('title', 'Dashboard Admin')

@section('content')
<h2 class="mb-4">Dashboard Statistik</h2>
<div class="row g-4">
    <div class="col-md-6 col-12">
        <div class="card card-rounded card-square text-center shadow-sm mb-4" style="border-top: 4px solid #2563eb;">
            <div class="card-body d-flex flex-column justify-content-center align-items-center h-100">
                <i class="mdi mdi-account-multiple" style="font-size:2.5rem;color:#2563eb"></i>
                <div class="mt-2 mb-1" style="font-size:1.1rem;font-weight:600;">Mahasiswa</div>
                <div style="font-size:2rem;font-weight:700;">{{ $totalMahasiswa ?? 0 }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="card card-rounded card-square text-center shadow-sm mb-4" style="border-top: 4px solid #6ea8fe;">
            <div class="card-body d-flex flex-column justify-content-center align-items-center h-100">
                <i class="mdi mdi-account-star" style="font-size:2.5rem;color:#6ea8fe"></i>
                <div class="mt-2 mb-1" style="font-size:1.1rem;font-weight:600;">Dosen</div>
                <div style="font-size:2rem;font-weight:700;">{{ $totalDosen ?? 0 }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="card card-rounded card-square text-center shadow-sm" style="border-top: 4px solid #facc15;">
            <div class="card-body d-flex flex-column justify-content-center align-items-center h-100">
                <i class="mdi mdi-file-document-box" style="font-size:2.5rem;color:#facc15"></i>
                <div class="mt-2 mb-1" style="font-size:1.1rem;font-weight:600;">Pendaftaran PKL</div>
                <div style="font-size:2rem;font-weight:700;">{{ $totalPendaftaran ?? 0 }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="card card-rounded card-square text-center shadow-sm" style="border-top: 4px solid #e11d48;">
            <div class="card-body d-flex flex-column justify-content-center align-items-center h-100">
                <i class="mdi mdi-bell-ring" style="font-size:2.5rem;color:#e11d48"></i>
                <div class="mt-2 mb-1" style="font-size:1.1rem;font-weight:600;">Notifikasi</div>
                <div style="font-size:2rem;font-weight:700;">{{ $totalNotifikasi ?? 0 }}</div>
            </div>
        </div>
    </div>
</div>
@endsection

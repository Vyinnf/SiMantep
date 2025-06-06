@extends('layouts.dosen')
@section('title', 'Dashboard Dosen')

@section('content')
<div class="welcome-section d-flex flex-column flex-md-row justify-content-between align-items-center mb-5 p-4">
    <h2 class="fw-bold mb-3 mb-md-0">Selamat datang, Anjing 👋</h2>
    <span class="text-muted">Hari ini: <span id="current-date"></span> | <span id="current-time"></span></span>
</div>

<div class="row g-4 mb-5">
    <!-- Summary Cards -->
    <div class="col-md-6 col-lg-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <i class="bi bi-journal-check fs-1 text-success"></i>
                <h5 class="card-title mt-3">Laporan Masuk</h5>
                <p class="card-text">Perlu Dicek: <strong>{{ $totalLaporan }}</strong></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <i class="bi bi-people fs-1 text-warning"></i>
                <h5 class="card-title mt-3">Mahasiswa Bimbingan</h5>
                <p class="card-text">Aktif: <strong>{{ $totalMahasiswa }}</strong></p>
            </div>
        </div>
    </div>
    {{-- <div class="col-md-6 col-lg-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <i class="bi bi-bell fs-1 text-danger"></i>
                <h5 class="card-title mt-3">Notifikasi</h5>
                <p class="card-text">Baru: <strong>{{ $totalNotifikasi }}</strong></p>
            </div>
        </div>
    </div> --}}
</div>

<div class="row g-4">
    <!-- Weather and Holidays Section -->
    <div class="col-lg-6">
        <div class="card shadow-sm border-0 weather-card">
            <div class="card-body">
                <h5 class="card-title mb-4">Cuaca Real-Time</h5>
                <div class="d-flex flex-column flex-md-row gap-4">
                    <div class="weather-item flex-fill">
                        <h6 class="fw-bold text-primary">Jakarta</h6>
                        <p class="mb-1"><i class="bi bi-thermometer-half"></i> <span id="jakarta-temp">--°C</span></p>
                        <p class="mb-1"><i class="bi bi-cloud"></i> <span id="jakarta-condition">--</span></p>
                        <p class="mb-0"><i class="bi bi-droplet"></i> Kelembapan: <span id="jakarta-humidity">--%</span></p>
                    </div>
                    <div class="weather-item flex-fill">
                        <h6 class="fw-bold text-primary">Sumenep</h6>
                        <p class="mb-1"><i class="bi bi-thermometer-half"></i> <span id="sumenep-temp">--°C</span></p>
                        <p class="mb-1"><i class="bi bi-cloud"></i> <span id="sumenep-condition">--</span></p>
                        <p class="mb-0"><i class="bi bi-droplet"></i> Kelembapan: <span id="sumenep-humidity">--%</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card shadow-sm border-0 holiday-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <button class="btn btn-sm btn-outline-primary" id="prevMonth"><i class="bi bi-chevron-left"></i></button>
                    <h5 class="card-title mb-0" id="calendar-month-year">Hari Libur Nasional 2025</h5>
                    <button class="btn btn-sm btn-outline-primary" id="nextMonth"><i class="bi bi-chevron-right"></i></button>
                </div>
                <div id="calendar-container" class="calendar-grid">
                    </div>
                <div class="mt-3">
                    <h6 class="text-primary mb-2">Hari Libur Nasional:</h6>
                    <ul class="list-unstyled small holiday-legend">
                        </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

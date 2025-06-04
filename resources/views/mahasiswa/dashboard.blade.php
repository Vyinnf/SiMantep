@extends('mahasiswa.side') {{-- Ini adalah file LAYOUT UTAMA Anda --}}

@section('title', 'Dashboard Mahasiswa')

@section('content')
    <div class="page-header">
        @php
            $namaPengguna = auth()->user()->mahasiswa->nama ?? auth()->user()->name;
        @endphp
        <h3 class="page-title">Selamat Datang, {{ $namaPengguna }}! 👋</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-7 col-xl-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Bimbingan Hari Ini</h4>
                    <p class="text-muted">Halaman ini akan menampilkan bimbingan/revisi dari dosen
                        pembimbing Anda masing-masing.</p>
                    <div class="d-flex flex-wrap mb-5">
                         <p class="text-center w-100 mt-4 text-muted">
                            <i class="mdi mdi-chart-bar mdi-48px"></i><br>
                            Data grafik bimbingan akan ditampilkan di sini.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom untuk Status Pendaftaran PKL --}}
        <div class="col-lg-5 col-xl-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Status Pendaftaran PKL</h4>
                </div>
                <div class="card-body p-0">
                    @if (isset($pendaftaran) && $pendaftaran)
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Tanggal Pengajuan:</strong>
                                <span class="float-end">{{ $pendaftaran->created_at->format('d M Y') }}</span>
                            </li>
                            <li class="list-group-item">
                                <strong>Status:</strong>
                                <span class="float-end">
                                    @if ($pendaftaran->status == 'pending')
                                        <span class="badge bg-warning text-dark">Menunggu Verifikasi</span>
                                    @elseif ($pendaftaran->status == 'diterima' || $pendaftaran->status == 'diterima')
                                        <span class="badge bg-success">Diterima</span>
                                    @elseif ($pendaftaran->status == 'ditolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($pendaftaran->status ?: 'Belum Ada Status') }}</span>
                                    @endif
                                </span>
                            </li>
                            <li class="list-group-item">
                                <strong>Instansi:</strong>
                                <span class="float-end text-end" style="max-width: 60%;">
                                    @if ($pendaftaran->instansi)
                                        {{ $pendaftaran->instansi->nama_instansi }}
                                    @elseif($pendaftaran->nama_instansi_manual)
                                        {{ $pendaftaran->nama_instansi_manual }} <small class="text-muted d-block">(Manual - Menunggu Persetujuan)</small>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </span>
                            </li>
                            @if ($pendaftaran->status == 'diterima' || $pendaftaran->status == 'approved')
                                <li class="list-group-item">
                                    <strong>Periode PKL:</strong>
                                    <span class="float-end">
                                        @if ($pendaftaran->tanggal_mulai && $pendaftaran->tanggal_selesai)
                                            {{ \Carbon\Carbon::parse($pendaftaran->tanggal_mulai)->format('d M Y') }} -
                                            {{ \Carbon\Carbon::parse($pendaftaran->tanggal_selesai)->format('d M Y') }}
                                        @else
                                            <span class="text-danger">Belum diatur</span>
                                        @endif
                                    </span>
                                </li>
                            @endif
                            <li class="list-group-item">
                                <strong>Dosen Pembimbing:</strong>
                                <span class="float-end">
                                @if ($pendaftaran->dosen)
                                    {{ $pendaftaran->dosen->name }}
                                @else
                                    <span class="text-danger">Belum ditetapkan</span>
                                @endif
                                </span>
                            </li>
                        </ul>
                    @else
                        <div class="alert alert-info m-3 text-center"> {{-- Menggunakan alert-info dan styling sedikit berbeda --}}
                            <i class="mdi mdi-information-outline mdi-24px d-block mb-2"></i>
                            Anda belum melakukan pendaftaran PKL atau data tidak ditemukan.
                            <a href="{{ route('mahasiswa.pendaftaran') }}" class="btn btn-sm btn-primary mt-3 d-block">
                                <i class="mdi mdi-file-document-edit-outline"></i> Daftar PKL Sekarang
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Anda bisa menambahkan baris atau komponen lain di sini sesuai kebutuhan dashboard --}}
    {{-- Contoh: Notifikasi terbaru, Pengumuman, dll. --}}

@endsection

@push('scripts')
    {{-- Jika Anda menggunakan chart (misalnya Chart.js) untuk <canvas id="order-chart"></canvas> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
    {{-- <script>
        // document.addEventListener('DOMContentLoaded', function () {
        //     if (document.getElementById('order-chart')) {
        //         const ctx = document.getElementById('order-chart').getContext('2d');
        //         const orderChart = new Chart(ctx, {
        //             type: 'line', // atau 'bar', 'pie', dll.
        //             data: {
        //                 labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'], // Contoh label
        //                 datasets: [{
        //                     label: 'Jumlah Bimbingan',
        //                     data: [5, 7, 3, 5, 2, 3, 8], // Contoh data
        //                     borderColor: 'var(--primary-color)',
        //                     backgroundColor: 'rgba(var(--primary-color-rgb), 0.1)',
        //                     tension: 0.3,
        //                     fill: true,
        //                 }]
        //             },
        //             options: {
        //                 responsive: true,
        //                 maintainAspectRatio: false,
        //                 scales: {
        //                     y: {
        //                         beginAtZero: true
        //                     }
        //                 }
        //             }
        //         });
        //     }
        // });
    </script> --}}
@endpush

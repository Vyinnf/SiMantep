@extends('mahasiswa.side') {{-- Menggunakan layout utama Anda: mahasiswa/dashboard.blade.php --}}

@section('title', 'Upload Laporan Magang') {{-- Judul spesifik untuk halaman ini --}}

@push('styles')
    {{-- Jika ada CSS spesifik untuk halaman ini, tambahkan di sini --}}
    <style>
        .form-upload-card {
            max-width: 600px;
            margin: auto;
        }
    </style>
@endpush

@section('content')
    <div class="page-header">
        <h3 class="page-title">Upload Laporan Magang</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('mahasiswa.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Upload Laporan</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card form-upload-card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Formulir Upload Laporan</h4>
                </div>
                <div class="card-body">
                    @if (session('upload_success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('upload_success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('upload_error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('upload_error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (isset($laporanMagang) && $laporanMagang)
                        <div class="alert alert-info">
                            <h5 class="alert-heading">Informasi Laporan Terunggah</h5>
                            <p>Anda telah mengunggah laporan pada: {{ \Carbon\Carbon::parse($laporanMagang->updated_at)->format('d M Y, H:i') }}</p>
                            <p>Nama File: <a href="{{ asset('storage/' . $laporanMagang->file) }}" target="_blank">{{ basename($laporanMagang->file) }}</a></p>
                            <hr>
                            <p class="mb-0">Jika Anda ingin mengganti laporan, silakan upload file baru di bawah ini. File lama akan tergantikan.</p>
                        </div>
                    @else
                         <div class="alert alert-warning">
                            <p class="mb-0">Anda belum mengunggah laporan magang. Silakan gunakan formulir di bawah untuk mengunggah.</p>
                        </div>
                    @endif

                    {{-- Menggunakan route('mahasiswa.laporan') untuk action form --}}
                    <form action="{{ route('mahasiswa.laporan') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                        @csrf
                        <div class="mb-3">
                            <label for="laporan" class="form-label">
                                <i class="mdi mdi-file-pdf-box"></i> File Laporan (Format: PDF, Maks: 10MB)
                            </label>
                            <input type="file" class="form-control @error('laporan') is-invalid @enderror" id="laporan" name="laporan" accept="application/pdf" required>
                            @error('laporan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div id="file-preview" class="mt-2"></div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="judul_laporan" class="form-label">
                                <i class="mdi mdi-format-title"></i> Judul Laporan
                            </label>
                            <input type="text" class="form-control @error('judul_laporan') is-invalid @enderror" id="judul_laporan" name="judul_laporan" placeholder="Masukkan judul laporan magang Anda" value="{{ old('judul_laporan', $laporanMagang->judul ?? '') }}" required>
                            @error('judul_laporan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- <div class="form-group mb-4">
                            <label for="deskripsi_laporan" class="form-label">
                                <i class="mdi mdi-text-subject"></i> Deskripsi Singkat (Opsional)
                            </label>
                            <textarea class="form-control @error('deskripsi_laporan') is-invalid @enderror" id="deskripsi_laporan" name="deskripsi_laporan" rows="3" placeholder="Berikan deskripsi singkat mengenai laporan Anda...">{{ old('deskripsi_laporan', $laporanMagang->deskripsi ?? '') }}</textarea>
                            @error('deskripsi_laporan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="mdi mdi-upload"></i>
                            {{ (isset($laporanMagang) && $laporanMagang) ? 'Upload & Ganti Laporan' : 'Upload Laporan' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const laporanInput = document.getElementById('laporan');
            const filePreview = document.getElementById('file-preview');

            if (laporanInput) {
                laporanInput.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    if (file) {
                        if (file.type === "application/pdf") {
                            filePreview.innerHTML = `<p class="text-muted small">File terpilih: <strong>${file.name}</strong> (${(file.size / 1024 / 1024).toFixed(2)} MB)</p>`;
                        } else {
                            filePreview.innerHTML = `<p class="text-danger small">Format file tidak valid. Harap pilih file PDF.</p>`;
                            laporanInput.value = ''; // Kosongkan input file
                        }
                    } else {
                        filePreview.innerHTML = '';
                    }
                });
            }
        });
    </script>
@endpush

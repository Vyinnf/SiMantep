@extends('mahasiswa.side') {{-- Menggunakan layout utama Anda: mahasiswa/dashboard.blade.php --}}

@section('title', 'Pendaftaran PKL Mahasiswa') {{-- Judul spesifik untuk halaman ini --}}


@section('content')

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

    <div class="page-header">
        <h3 class="page-title">Formulir Pendaftaran PKL</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('mahasiswa.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pendaftaran PKL</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card form-pendaftaran-card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Isi Data Pendaftaran</h4>
                </div>
                <div class="card-body">
                    {{-- Pesan session 'success' dan 'error' sudah ditangani oleh layout utama --}}
                    {{-- Tapi, menampilkan semua error validasi '$errors->any()' di sini sangat berguna --}}
                    @if ($errors->any())
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Periksa kembali isian Anda:</strong>
                            <ul class="mb-0 mt-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('mahasiswa.pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nama Mahasiswa</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->mahasiswa->nama ?? auth()->user()->name }}" readonly>
                            {{-- Jika nama mahasiswa dari tabel mahasiswa, pastikan $mahasiswa->nama tersedia --}}
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="{{ auth()->user()->email }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim"
                                value="{{ old('nim', auth()->user()->mahasiswa->nim ?? '') }}" required>
                            @error('nim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="prodi" class="form-label">Program Studi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('prodi') is-invalid @enderror" id="prodi" name="prodi"
                                value="{{ old('prodi', auth()->user()->mahasiswa->prodi ?? '') }}" required>
                            @error('prodi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="semester" class="form-label">Semester <span class="text-danger">*</span></label>
                            <input type="number" min="1" max="14" class="form-control @error('semester') is-invalid @enderror" id="semester" name="semester"
                                value="{{ old('semester', auth()->user()->mahasiswa->semester ?? '') }}" required>
                            @error('semester')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="alamat_mahasiswa" class="form-label">Alamat Mahasiswa <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('alamat_mahasiswa') is-invalid @enderror" id="alamat_mahasiswa" name="alamat_mahasiswa"
                                value="{{ old('alamat_mahasiswa', auth()->user()->mahasiswa->alamat ?? '') }}" required>
                            @error('alamat_mahasiswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No HP/WA <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp"
                                value="{{ old('no_hp', auth()->user()->mahasiswa->no_hp ?? '') }}" placeholder="Contoh: 081234567890" required>
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4">
                        <h5 class="mb-3">Detail Rencana PKL</h5>

                        <div class="mb-3">
                            <label for="judul_pkl" class="form-label">Judul/Topik PKL <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('judul_pkl') is-invalid @enderror" id="judul_pkl" name="judul_pkl"
                                value="{{ old('judul_pkl') }}" placeholder="Masukkan judul atau topik PKL yang diajukan" required>
                            @error('judul_pkl')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="instansi_id" class="form-label">Instansi Tujuan PKL <span class="text-danger">*</span></label>
                            <select class="form-select @error('instansi_id') is-invalid @enderror" id="instansi_id" name="instansi_id" required>
                                <option value="" selected disabled>-- Pilih Instansi --</option>
                                @if(isset($instansiList) && $instansiList->count() > 0)
                                    @foreach ($instansiList as $instansi)
                                        <option value="{{ $instansi->id }}"
                                            {{ old('instansi_id') == $instansi->id ? 'selected' : '' }}>
                                            {{ $instansi->nama_instansi }}
                                        </option>
                                    @endforeach
                                @endif
                                <option value="other" {{ old('instansi_id') == 'other' ? 'selected' : '' }}>
                                    Lainnya / Belum Terdaftar
                                </option>
                            </select>
                             @error('instansi_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="manual-instansi" class="border p-3 rounded mb-3" style="display: {{ old('instansi_id') == 'other' ? 'block' : 'none' }};">
                             <h6 class="mb-3">Detail Instansi (Baru)</h6>
                            <div class="mb-3">
                                <label for="nama_instansi_manual" class="form-label">Nama Instansi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_instansi_manual') is-invalid @enderror" id="nama_instansi_manual" name="nama_instansi_manual"
                                    value="{{ old('nama_instansi_manual') }}" {{ old('instansi_id') == 'other' ? '' : 'disabled' }}>
                                @error('nama_instansi_manual')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="alamat_instansi_manual" class="form-label">Alamat Instansi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('alamat_instansi_manual') is-invalid @enderror" id="alamat_instansi_manual" name="alamat_instansi_manual"
                                    value="{{ old('alamat_instansi_manual') }}" {{ old('instansi_id') == 'other' ? '' : 'disabled' }}>
                                @error('alamat_instansi_manual')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="mb-3">
                            <label for="surat_pengantar" class="form-label">Upload Surat Pengantar dari Kampus (PDF, Maks: 2MB) <span class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('surat_pengantar') is-invalid @enderror" id="surat_pengantar" name="surat_pengantar" accept="application/pdf" required>
                            @error('surat_pengantar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}


                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="mdi mdi-send"></i> Ajukan Pendaftaran PKL
                            </button>
                        </div>
                    </form>

                    {{-- Tombol kembali ini opsional karena sudah ada di sidebar --}}
                    {{-- <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-link w-100 mt-3">← Kembali ke Dashboard</a> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- Bootstrap JS sudah dimuat oleh layout utama, jadi tidak perlu link CDN di sini --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectInstansi = document.getElementById('instansi_id');
            const manualInstansiSection = document.getElementById('manual-instansi');
            const namaInstansiManualInput = document.getElementById('nama_instansi_manual');
            const alamatInstansiManualInput = document.getElementById('alamat_instansi_manual');

            function toggleManualInstansiFields(show) {
                if (show) {
                    manualInstansiSection.style.display = 'block';
                    namaInstansiManualInput.disabled = false;
                    namaInstansiManualInput.required = true; // Menjadikan wajib jika 'other' dipilih
                    alamatInstansiManualInput.disabled = false;
                    alamatInstansiManualInput.required = true; // Menjadikan wajib jika 'other' dipilih
                } else {
                    manualInstansiSection.style.display = 'none';
                    namaInstansiManualInput.disabled = true;
                    namaInstansiManualInput.required = false;
                    namaInstansiManualInput.value = ''; // Kosongkan field jika disembunyikan
                    alamatInstansiManualInput.disabled = true;
                    alamatInstansiManualInput.required = false;
                    alamatInstansiManualInput.value = ''; // Kosongkan field jika disembunyikan
                }
            }

            // Initial check when the page loads (e.g., after validation error)
            if (selectInstansi) {
                toggleManualInstansiFields(selectInstansi.value === 'other');

                selectInstansi.addEventListener('change', function () {
                    toggleManualInstansiFields(this.value === 'other');
                });
            }
        });
    </script>
@endpush

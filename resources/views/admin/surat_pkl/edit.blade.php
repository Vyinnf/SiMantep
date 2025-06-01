@extends('layouts.admin')

@section('title', 'Edit Data Surat PKL')

@section('content')
    <div class="page-header-container mb-4">
        <h2 class="page-title mb-0">Edit Surat PKL untuk: {{ $suratPkl->mahasiswa->name ?? 'N/A' }}</h2>
        <a href="{{ route('admin.surat.pkl.index') }}" class="btn btn-outline-dark">
            <i class="mdi mdi-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="card shadow-sm border-0 form-card">
        <div class="card-body">
            <form action="{{ route('admin.surat.pkl.update', $suratPkl->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="user_id" class="form-label">Mahasiswa</label>
                        <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                            <option value="">-- Pilih Mahasiswa --</option>
                            @foreach($mahasiswas as $mahasiswa)
                                <option value="{{ $mahasiswa->id }}" {{ old('user_id', $suratPkl->user_id) == $mahasiswa->id ? 'selected' : '' }}>
                                    {{ $mahasiswa->name }} ({{ $mahasiswa->mahasiswa->nim ?? ($mahasiswa->nim ?? 'NIM tidak ada') }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="instansi_id" class="form-label">Instansi Tujuan</label>
                        <select class="form-control @error('instansi_id') is-invalid @enderror" id="instansi_id" name="instansi_id" required>
                            <option value="">-- Pilih Instansi --</option>
                            @foreach($instansis as $instansi)
                                <option value="{{ $instansi->id }}" {{ old('instansi_id', $suratPkl->instansi_id) == $instansi->id ? 'selected' : '' }}>
                                    {{ $instansi->nama_instansi }}
                                </option>
                            @endforeach
                        </select>
                        @error('instansi_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_mulai_pkl" class="form-label">Tanggal Mulai PKL</label>
                        <input type="date" class="form-control @error('tanggal_mulai_pkl') is-invalid @enderror" id="tanggal_mulai_pkl" name="tanggal_mulai_pkl" value="{{ old('tanggal_mulai_pkl', $suratPkl->tanggal_mulai_pkl->format('Y-m-d')) }}" required>
                        @error('tanggal_mulai_pkl')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tanggal_selesai_pkl" class="form-label">Tanggal Selesai PKL</label>
                        <input type="date" class="form-control @error('tanggal_selesai_pkl') is-invalid @enderror" id="tanggal_selesai_pkl" name="tanggal_selesai_pkl" value="{{ old('tanggal_selesai_pkl', $suratPkl->tanggal_selesai_pkl->format('Y-m-d')) }}" required>
                        @error('tanggal_selesai_pkl')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="posisi_atau_judul_pkl" class="form-label">Posisi / Judul PKL (Opsional)</label>
                    <input type="text" class="form-control @error('posisi_atau_judul_pkl') is-invalid @enderror" id="posisi_atau_judul_pkl" name="posisi_atau_judul_pkl" value="{{ old('posisi_atau_judul_pkl', $suratPkl->posisi_atau_judul_pkl) }}" placeholder="Contoh: Web Developer Intern, Analisis Sistem XYZ">
                    @error('posisi_atau_judul_pkl')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nomor_surat" class="form-label">Nomor Surat</label>
                    <input type="text" class="form-control @error('nomor_surat') is-invalid @enderror" id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat', $suratPkl->nomor_surat) }}" placeholder="Contoh: 123/UNIV/KM/SPKL/VI/2025">
                    @error('nomor_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status_surat" class="form-label">Status Surat</label>
                    <select class="form-control @error('status_surat') is-invalid @enderror" id="status_surat" name="status_surat" required>
                        <option value="diajukan" {{ old('status_surat', $suratPkl->status_surat) == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                        <option value="diproses" {{ old('status_surat', $suratPkl->status_surat) == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai_dibuat" {{ old('status_surat', $suratPkl->status_surat) == 'selesai_dibuat' ? 'selected' : '' }}>Selesai Dibuat</option>
                        <option value="diambil" {{ old('status_surat', $suratPkl->status_surat) == 'diambil' ? 'selected' : '' }}>Sudah Diambil</option>
                        <option value="ditolak" {{ old('status_surat', $suratPkl->status_surat) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                    @error('status_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="file_surat" class="form-label">Unggah File Surat (PDF/DOC/DOCX, Max: 5MB)</label>
                    <input type="file" class="form-control @error('file_surat') is-invalid @enderror" id="file_surat" name="file_surat">
                    @if($suratPkl->file_surat_path)
                        <small class="form-text text-muted">File saat ini: <a href="{{ Storage::url($suratPkl->file_surat_path) }}" target="_blank">{{ basename($suratPkl->file_surat_path) }}</a></small>
                    @endif
                    @error('file_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="catatan_admin" class="form-label">Catatan Admin (Opsional)</label>
                    <textarea class="form-control @error('catatan_admin') is-invalid @enderror" id="catatan_admin" name="catatan_admin" rows="3">{{ old('catatan_admin', $suratPkl->catatan_admin) }}</textarea>
                    @error('catatan_admin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="mdi mdi-content-save-edit"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
{{-- CSS untuk select2/datepicker jika digunakan --}}
@endpush

@push('scripts')
{{-- JS untuk select2/datepicker jika digunakan --}}
@endpush

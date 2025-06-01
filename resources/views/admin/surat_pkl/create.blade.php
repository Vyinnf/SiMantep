@extends('layouts.admin')

@section('title', 'Buat Pengajuan Surat PKL Baru')

@section('content')
    <div class="page-header-container mb-4">
        <h2 class="page-title mb-0">Buat Pengajuan Surat PKL</h2>
        <a href="{{ route('admin.surat.pkl.index') }}" class="btn btn-outline-dark">
            <i class="mdi mdi-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="card shadow-sm border-0 form-card">
        <div class="card-body">
            <form action="{{ route('admin.surat.pkl.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="user_id" class="form-label">Mahasiswa</label>
                        <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                            <option value="">-- Pilih Mahasiswa --</option>
                            @foreach($mahasiswas as $mahasiswa)
                                <option value="{{ $mahasiswa->id }}" {{ old('user_id') == $mahasiswa->id ? 'selected' : '' }}>
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
                                <option value="{{ $instansi->id }}" {{ old('instansi_id') == $instansi->id ? 'selected' : '' }}>
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
                        <input type="date" class="form-control @error('tanggal_mulai_pkl') is-invalid @enderror" id="tanggal_mulai_pkl" name="tanggal_mulai_pkl" value="{{ old('tanggal_mulai_pkl') }}" required>
                        @error('tanggal_mulai_pkl')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tanggal_selesai_pkl" class="form-label">Tanggal Selesai PKL</label>
                        <input type="date" class="form-control @error('tanggal_selesai_pkl') is-invalid @enderror" id="tanggal_selesai_pkl" name="tanggal_selesai_pkl" value="{{ old('tanggal_selesai_pkl') }}" required>
                        @error('tanggal_selesai_pkl')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="posisi_atau_judul_pkl" class="form-label">Posisi / Judul PKL (Opsional)</label>
                    <input type="text" class="form-control @error('posisi_atau_judul_pkl') is-invalid @enderror" id="posisi_atau_judul_pkl" name="posisi_atau_judul_pkl" value="{{ old('posisi_atau_judul_pkl') }}" placeholder="Contoh: Web Developer Intern, Analisis Sistem XYZ">
                    @error('posisi_atau_judul_pkl')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nomor_surat" class="form-label">Nomor Surat (Opsional, bisa diisi nanti)</label>
                    <input type="text" class="form-control @error('nomor_surat') is-invalid @enderror" id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat') }}" placeholder="Contoh: 123/UNIV/KM/SPKL/VI/2025">
                    @error('nomor_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="mdi mdi-content-save"></i> Simpan Pengajuan Surat
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
{{-- Jika menggunakan select2 atau datepicker kustom, tambahkan CSS-nya di sini --}}
@endpush

@push('scripts')
{{-- Jika menggunakan select2 atau datepicker kustom, tambahkan JS-nya di sini --}}
{{-- <script>
    // Contoh untuk Select2
    // $(document).ready(function() {
    //     $('#user_id, #instansi_id').select2({
    //         theme: "bootstrap-5" // Atau tema lain yang sesuai
    //     });
    // });
</script> --}}
@endpush

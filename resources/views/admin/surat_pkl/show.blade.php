@extends('layouts.admin')

@section('title', 'Detail Surat PKL')

@section('content')
    <div class="page-header-container mb-4">
        <h2 class="page-title mb-0">Detail Surat PKL: {{ $suratPkl->mahasiswa->name ?? 'N/A' }}</h2>
        <div class="action-bar ms-auto">
            <a href="{{ route('admin.surat.pkl.edit', $suratPkl->id) }}" class="btn btn-info">
                <i class="mdi mdi-pencil"></i> Edit Surat
            </a>
            <a href="{{ route('admin.surat.pkl.index') }}" class="btn btn-outline-dark">
                <i class="mdi mdi-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>
    </div>

    <div class="card shadow-sm border-0 detail-card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="detail-section-title">Informasi Mahasiswa</h5>
                    <p><strong>Nama:</strong> {{ $suratPkl->mahasiswa->name ?? 'N/A' }}</p>
                    <p><strong>NIM:</strong> {{ $suratPkl->mahasiswa->mahasiswa->nim ?? ($suratPkl->mahasiswa->nim ?? '-') }}</p>
                    {{-- Tambahkan detail mahasiswa lain jika perlu --}}
                </div>
                <div class="col-md-6">
                    <h5 class="detail-section-title">Informasi Instansi</h5>
                    <p><strong>Nama Instansi:</strong> {{ $suratPkl->instansi->nama_instansi ?? 'N/A' }}</p>
                    <p><strong>Alamat Instansi:</strong> {{ $suratPkl->instansi->alamat ?? 'N/A' }}</p>
                </div>
            </div>
            <hr class="my-4">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="detail-section-title">Detail PKL</h5>
                    <p><strong>Tanggal Mulai:</strong> {{ $suratPkl->tanggal_mulai_pkl->isoFormat('D MMMM YYYY') }}</p>
                    <p><strong>Tanggal Selesai:</strong> {{ $suratPkl->tanggal_selesai_pkl->isoFormat('D MMMM YYYY') }}</p>
                    <p><strong>Posisi/Judul:</strong> {{ $suratPkl->posisi_atau_judul_pkl ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <h5 class="detail-section-title">Status & Dokumen</h5>
                    <p><strong>Nomor Surat:</strong> {{ $suratPkl->nomor_surat ?? '-' }}</p>
                    <p><strong>Status Surat:</strong>
                        @if($suratPkl->status_surat == 'selesai_dibuat')
                            <span class="badge bg-success">{{ Str::ucfirst(str_replace('_', ' ', $suratPkl->status_surat)) }}</span>
                        @elseif($suratPkl->status_surat == 'diproses')
                            <span class="badge bg-info text-dark">{{ Str::ucfirst($suratPkl->status_surat) }}</span>
                        @else
                            <span class="badge bg-secondary">{{ Str::ucfirst(str_replace('_', ' ', $suratPkl->status_surat)) }}</span>
                        @endif
                    </p>
                    <p><strong>Tanggal Dibuat/Disetujui:</strong> {{ $suratPkl->tanggal_disetujui_atau_dibuat ? $suratPkl->tanggal_disetujui_atau_dibuat->isoFormat('D MMMM YYYY, HH:mm') : '-' }}</p>
                    @if($suratPkl->file_surat_path)
                        <p><strong>File Surat:</strong>
                            <a href="{{ route('admin.surat.pkl.download', $suratPkl->id) }}" class="btn btn-primary btn-sm">
                                <i class="mdi mdi-download-outline"></i> Download File
                            </a>
                        </p>
                    @else
                        <p><strong>File Surat:</strong> <span class="text-muted">Belum diunggah/dibuat.</span></p>
                    @endif
                </div>
            </div>
            @if($suratPkl->catatan_admin)
            <hr class="my-4">
            <div>
                <h5 class="detail-section-title">Catatan Admin</h5>
                <p>{{ $suratPkl->catatan_admin }}</p>
            </div>
            @endif
        </div>
    </div>
@endsection

{{-- filepath: resources/views/dosen/laporan-detail.blade.php --}}
@extends('layouts.dosen')
@section('title', 'Detail Laporan Mahasiswa')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Detail Laporan Mahasiswa</h3>
    <div class="card">
        <div class="card-body">
            <h5>{{ $laporan->judul }}</h5>
            <p><b>Nama:</b> {{ $laporan->mahasiswa->user->name ?? '-' }}</p>
            <p><b>NIM:</b> {{ $laporan->mahasiswa->nim ?? '-' }}</p>
            <p><b>Status:</b> <span class="badge bg-warning text-dark">{{ ucfirst($laporan->status) }}</span></p>
            <hr>
            <a href="{{ asset('storage/laporan/' . $laporan->file) }}" target="_blank" class="btn btn-primary mb-3">
                <i class="bi bi-file-earmark-arrow-down"></i> Download Laporan
            </a>
            <form method="POST" action="{{ route('dosen.laporan.revisi', $laporan->id) }}" class="mb-2">
                @csrf
                <div class="mb-2">
                    <label for="komentar" class="form-label">Komentar/Revisi</label>
                    <textarea name="komentar" id="komentar" class="form-control" rows="2" required></textarea>
                </div>
                <button type="submit" class="btn btn-warning">Kembalikan untuk Revisi</button>
            </form>
            <form method="POST" action="{{ route('dosen.laporan.terima', $laporan->id) }}">
                @csrf
                <button type="submit" class="btn btn-success">Terima Laporan</button>
            </form>
            <a href="{{ route('dosen.laporan') }}" class="btn btn-outline-dark mt-3">Kembali</a>
        </div>
    </div>
</div>
@endsection

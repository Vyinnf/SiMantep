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
            <p><b>Status:</b>
                @if ($laporan->status === 'diterima')
                    <span class="badge bg-success">{{ ucfirst($laporan->status) }}</span>
                @elseif ($laporan->status === 'revisi')
                    <span class="badge bg-danger">{{ ucfirst($laporan->status) }}</span>
                @else
                    <span class="badge bg-warning text-dark">{{ ucfirst($laporan->status) }}</span>
                @endif
            </p>

            @if ($laporan->status === 'revisi' && $laporan->komentar)
                <div class="alert alert-danger">
                    <strong>Catatan Revisi:</strong> {{ $laporan->komentar }}
                </div>
            @endif

            <hr>
            <a href="{{ asset('storage/' . $laporan->file) }}" target="_blank" class="btn btn-primary mb-3">
                <i class="bi bi-file-earmark-arrow-down"></i> Download Laporan
            </a>

            {{-- Tampilkan form hanya jika status masih diajukan --}}
            @if ($laporan->status === 'diajukan')
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
            @else
                <div class="alert alert-info mt-3">Laporan ini sudah <strong>{{ $laporan->status }}</strong>.</div>
            @endif

            <a href="{{ route('dosen.laporan') }}" class="btn btn-outline-dark mt-3">Kembali</a>
        </div>
    </div>
</div>
@endsection

{{-- filepath: resources/views/dosen/laporan.blade.php --}}
@extends('layouts.dosen')
@section('title', 'Koreksi & Revisi Laporan')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Koreksi & Revisi Laporan Mahasiswa</h3>
    @if($laporan->isEmpty())
        <div class="alert alert-info">Tidak ada laporan yang perlu dikoreksi.</div>
    @else
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Mahasiswa</th>
                    <th>NIM</th>
                    <th>Judul Laporan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                    <th>Komentar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($laporan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ optional(optional($item->mahasiswa)->user)->name ?? '-' }}</td>
                    <td>{{ optional($item->mahasiswa)->nim ?? '-' }}</td>
                    <td>{{ $item->judul ?? '-' }}</td>
                    <td><span class="badge bg-warning text-dark">{{ ucfirst($item->status) }}</span></td>
                    <td><a href="{{ route('dosen.laporan.show', $item->id) }}" class="btn btn-info btn-sm">Detail & Koreksi</a></td>
                    <td>{{ $item->komentar ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection

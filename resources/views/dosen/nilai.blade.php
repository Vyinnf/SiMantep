{{-- filepath: resources/views/dosen/nilai.blade.php --}}
@extends('layouts.dosen')
@section('title', 'Upload Nilai Mahasiswa')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Upload Nilai Mahasiswa PKL</h3>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($mahasiswa->isEmpty())
        <div class="alert alert-info">Tidak ada mahasiswa yang siap dinilai.</div>
    @else
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Judul PKL</th>
                    <th>Nilai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mahasiswa as $mhs)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $mhs->user->name ?? '-' }}</td>
                    <td>{{ $mhs->nim }}</td>
                    <td>{{ $mhs->judul_pkl ?? '-' }}</td>
                    <td>
                        @if($mhs->nilai !== null)
                            <span class="badge bg-success">{{ $mhs->nilai }}</span>
                        @else
                            <span class="badge bg-secondary">Belum dinilai</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('dosen.nilai.store', $mhs->id) }}" method="POST" class="d-flex gap-2 align-items-center">
                            @csrf
                            <input type="number" name="nilai" class="form-control form-control-sm" min="0" max="100" value="{{ $mhs->nilai }}" style="width:90px;" required>
                            <button type="submit" class="btn btn-primary btn-sm">Upload</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection

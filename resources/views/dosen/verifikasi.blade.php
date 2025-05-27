{{-- filepath: resources/views/dosen/verifikasi.blade.php --}}
@extends('layouts.dosen')
@section('title', 'Verifikasi Pendaftaran PKL')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Verifikasi Pendaftaran Mahasiswa PKL</h3>
    @if($pendaftaran->isEmpty())
        <div class="alert alert-info">Tidak ada pendaftaran yang perlu diverifikasi.</div>
    @else
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Mahasiswa</th>
                    <th>NIM</th>
                    <th>Judul PKL</th>
                    <th>Tanggal Daftar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pendaftaran as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ optional(optional($item->mahasiswa)->user)->name ?? '-' }}</td>
                    <td>{{ optional($item->mahasiswa)->nim ?? '-' }}</td>
                    <td>{{ $item->judul_pkl ?? '-' }}</td>
                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                    <td>
                        <span class="badge bg-warning text-dark">{{ ucfirst($item->status) }}</span>
                    </td>
                    <td>
                        <form action="{{ route('dosen.verifikasi.update', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" name="status" value="diterima" class="btn btn-success btn-sm">Terima</button>
                            <button type="submit" name="status" value="ditolak" class="btn btn-danger btn-sm">Tolak</button>
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

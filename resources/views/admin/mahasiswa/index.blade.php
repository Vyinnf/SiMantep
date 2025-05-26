{{-- filepath: resources/views/admin/mahasiswa/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Data Mahasiswa')
@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <h2>Data Mahasiswa</h2>
    <div class="action-bar" style="margin-bottom: 18px; display: flex; gap: 8px;">
        <a href="#" class="btn btn-outline-dark" onclick="window.print();return false;">
            <i class="bi bi-printer"></i> Print
        </a>
        <div class="dropdown">
            <button class="btn btn-primary text-white dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-download"></i> Export
            </button>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" href="{{ route('admin.mahasiswa.export', ['type' => 'excel']) }}">
                        <i class="bi bi-file-earmark-excel"></i> Export Excel
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('admin.mahasiswa.export', ['type' => 'pdf']) }}">
                        <i class="bi bi-file-earmark-pdf"></i> Export PDF
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <table class="table-mahasiswa">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>NIM</th>
                <th>Semester</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mahasiswa as $mhs)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $mhs->user->name ?? '-' }}</td>
                    <td>{{ $mhs->user->email ?? '-' }}</td>
                    <td>{{ $mhs->nim }}</td>
                    <td>{{ $mhs->semester }}</td>
                    <td>{{ $mhs->alamat }}</td>
                    <td>
                        <a href="{{ route('admin.mahasiswa.show', $mhs->id) }}" class="btn btn-info btn-sm">Detail</a>
                        <form action="{{ route('admin.mahasiswa.destroy', $mhs->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data mahasiswa.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection

@extends('layouts.admin')

@section('title', 'Data Dosen')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="mdi mdi-check-circle-outline alert-icon"></i>
            <span>{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="page-header-container mb-4">
        <h2 class="page-title mb-0">Data Dosen</h2>
        <div class="action-bar ms-auto">
            <a href="{{ route('admin.dosen.create') }}" class="btn btn-primary">
                <i class="mdi mdi-plus-circle-outline"></i> Tambah Dosen
            </a>
        </div>
    </div>

    <div class="card shadow-sm border-0 data-table-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table data-table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>NIDN</th>
                            <th>Jabatan Fungsional</th>
                            <th style="width: 20%; text-align: center;">Aksi</th> {{-- Lebar disesuaikan untuk 2 tombol --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dosen as $item) {{-- Menggunakan $item agar konsisten dengan HTML awal Anda --}}
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->user->name ?? ($item->nama_dosen ?? $item->name ?? '-') }}</td>
                            <td>{{ $item->user->email ?? ($item->email ?? '-') }}</td>
                            <td>{{ $item->nidn ?? '-'}}</td>
                            <td>{{ $item->jabatan_fungsional ?? '-'}}</td>
                            <td class="text-center">
                                <a href="{{-- route('admin.dosen.edit', $item->id) --}}" class="btn btn-info btn-sm" title="Edit">
                                    <i class="mdi mdi-pencil"></i> Edit
                                </a>
                                <form action="{{-- route('admin.dosen.destroy', $item->id) --}}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data dosen ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                        <i class="mdi mdi-delete"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center data-empty-message">
                                Tidak ada data dosen.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

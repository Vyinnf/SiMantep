@extends('layouts.admin')

@section('title', 'Manajemen Instansi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Manajemen Instansi</h4>
    <a href="{{ route('admin.instansi.create') }}" class="btn btn-primary">
        <i class="mdi mdi-plus-circle"></i> Tambah Instansi
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Instansi</th>
                        <th>Alamat</th>
                        <th>Kontak</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($instansi as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_instansi }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->kontak }}</td>
                        <td>
                            <a href="{{ route('admin.instansi.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                <i class="mdi mdi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.instansi.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus instansi ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data instansi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

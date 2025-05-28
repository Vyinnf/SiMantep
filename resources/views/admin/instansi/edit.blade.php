@extends('layouts.admin')

@section('content')
<div class="container">
    <h4 class="mb-4">Edit Instansi</h4>

    <form action="{{ route('admin.instansi.update', $instansi->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Instansi</label>
            <input type="text" name="nama" class="form-control" value="{{ $instansi->nama }}" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat Instansi</label>
            <textarea name="alamat" class="form-control" rows="3" required>{{ $instansi->alamat }}</textarea>
        </div>
        <div class="mb-3">
            <label for="kontak" class="form-label">Kontak</label>
            <input type="text" name="kontak" class="form-control" value="{{ $instansi->kontak }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.instansi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

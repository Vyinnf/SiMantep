@extends('layouts.admin')

@section('content')

    <div class="container">
        <h4 class="mb-4">Tambah Instansi</h4>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.instansi.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama_instansi" class="form-label">Nama Instansi</label>
                <input type="text" name="nama_instansi" class="form-control" required value="{{ old('nama_instansi') }}">

            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat Instansi</label>
                <textarea name="alamat" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="kontak" class="form-label">Kontak</label>
                <input type="text" name="kontak" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            {{-- <a href="{{ route('admin.instansi.index') }}" class="btn btn-secondary">Kembali</a> --}}
        </form>
    </div>
@endsection

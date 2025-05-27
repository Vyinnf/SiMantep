{{-- filepath: resources/views/admin/tambah-dosen.blade.php --}}
@extends('layouts.admin')
@section('title', 'Tambah Akun Dosen')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-4 text-center">Tambah Akun Dosen</h4>
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('admin.dosen.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Dosen</label>
                            <input type="text" class="form-control" id="name" name="name" required
                                value="{{ old('name') }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Dosen</label>
                            <input type="email" class="form-control" id="email" name="email" required
                                value="{{ old('email') }}">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Tambah Dosen</button>
                            <button type="reset" class="btn btn-outline-dark w-100">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

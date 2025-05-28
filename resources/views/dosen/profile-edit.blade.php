{{-- filepath: resources/views/dosen/profile-edit.blade.php --}}
@extends('layouts.dosen')
@section('title', 'Edit Profil Dosen')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="fw-bold mb-3 text-center">Edit Profil Dosen</h4>
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
                        <form method="POST" action="{{ route('dosen.profile.update') }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', Auth::user()->name) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', Auth::user()->email) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="nip" class="form-label">NIP</label>
                                <input type="nip" class="form-control" id="nip" name="nip"
                                    value="{{ old('nip', Auth::user()->nip ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">Jenis Kelamin</label>
                                {{-- <input type="gender" class="form-control" id="gender" name="gender"
                                    value="{{ old('gender', Auth::user()->gender ?? '') }}"> --}}
                                <select class="form-select" aria-label="Default select example" name="gender"
                                    id="gender" required">
                                    <option value="Laki-laki" {{ Auth::user()->gender == 'Laki-laki' ? 'selected' : '' }}>Laki Laki</option>
                                    <option value="Perempuan" {{ Auth::user()->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">No. Hp</label>
                                <input type="phone_number" class="form-control" id="phone_number" name="phone_number"
                                    value="{{ old('phone_number', Auth::user()->phone_number ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat</label>
                                <input type="address" class="form-control" id="address" name="address"
                                    value="{{ old('address', Auth::user()->address ?? '') }}">
                            </div>
                            {{-- Tambahkan field lain jika ada, misal NIP, No HP --}}
                            <div class="d-flex gap-2 justify-content-end">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <a href="{{ route('dosen.profile') }}" class="btn btn-outline-dark">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

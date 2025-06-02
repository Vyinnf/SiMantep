@extends('layouts.admin')

@section('title', 'Tambah Akun Admin Baru')

@section('content')
    <div class="page-header-container mb-4">
        <h2 class="page-title mb-0">Tambah Akun Admin Baru</h2>
        <a href="{{ route('admin.akun.index') }}" class="btn btn-outline-dark">
            <i class="mdi mdi-arrow-left"></i> Kembali ke Daftar Akun
        </a>
    </div>

    <div class="card shadow-sm border-0 form-card">
        <div class="card-body">
            <form action="{{ route('admin.akun.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Alamat Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="new-password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="role" class="form-label">Peran (Role) <span class="text-danger">*</span></label>
                    <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required>
                        <option value="" disabled {{ old('role') ? '' : 'selected' }}>-- Pilih Peran --</option>
                        @if(isset($roles) && count($roles) > 0)
                            @foreach($roles as $roleValue)
                                <option value="{{ $roleValue }}" {{ old('role') == $roleValue ? 'selected' : '' }}>
                                    {{ Str::ucfirst($roleValue) }}
                                </option>
                            @endforeach
                        @else
                            {{-- Fallback jika $roles tidak terdefinisi atau kosong, meskipun seharusnya dikirim dari controller --}}
                            <option value="admin">Admin</option>
                            <option value="superadmin">Superadmin</option>
                        @endif
                    </select>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Contoh jika Anda menambahkan field is_active
                <div class="mb-4 form-check">
                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Aktifkan Akun</label>
                </div>
                --}}

                <div class="d-flex justify-content-end pt-3 border-top-form-footer">
                    <a href="{{ route('admin.akun.index') }}" class="btn btn-outline-dark me-2">
                        <i class="mdi mdi-cancel"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="mdi mdi-content-save-outline"></i> Simpan Akun Admin
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection


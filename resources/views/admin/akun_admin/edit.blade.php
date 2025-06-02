@extends('layouts.admin')

@section('title', 'Edit Akun Admin: ' . $user->name)

@section('content')
    <div class="page-header-container mb-4">
        <h2 class="page-title mb-0">Edit Akun Admin: <span class="text-highlight">{{ $user->name }}</span></h2>
        <a href="{{ route('admin.akun.index') }}" class="btn btn-outline-dark">
            <i class="mdi mdi-arrow-left"></i> Kembali ke Daftar Akun
        </a>
    </div>

    <div class="card shadow-sm border-0 form-card">
        <div class="card-body">
            <form action="{{ route('admin.akun.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Alamat Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru (Opsional)</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" autocomplete="new-password">
                    <small class="form-text text-muted-custom">Kosongkan jika tidak ingin mengubah password.</small>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
                </div>

                <div class="mb-4">
                    <label for="role" class="form-label">Peran (Role) <span class="text-danger">*</span></label>
                    <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required
                        {{-- Logika disable jika user saat ini mencoba mengubah role dirinya yang superadmin, atau admin biasa mencoba mengubah superadmin --}}
                        {{ ($user->id === Auth::id() && $user->role === 'superadmin') || (Auth::user()->role !== 'superadmin' && $user->role === 'superadmin' && $user->id !== Auth::id()) ? 'disabled' : '' }}>
                        <option value="" disabled>-- Pilih Peran --</option>
                        @if(isset($roles) && count($roles) > 0)
                            @foreach($roles as $roleValue)
                                <option value="{{ $roleValue }}" {{ old('role', $user->role) == $roleValue ? 'selected' : '' }}>
                                    {{ Str::ucfirst($roleValue) }}
                                </option>
                            @endforeach
                        @else
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="superadmin" {{ old('role', $user->role) == 'superadmin' ? 'selected' : '' }}>Superadmin</option>
                        @endif
                    </select>
                    {{-- Jika role di-disable, kirim nilai hidden agar tidak hilang saat update --}}
                    @if(($user->id === Auth::id() && $user->role === 'superadmin') || (Auth::user()->role !== 'superadmin' && $user->role === 'superadmin' && $user->id !== Auth::id()))
                        <input type="hidden" name="role" value="{{ $user->role }}">
                        <small class="form-text text-muted-custom">Peran Superadmin tidak dapat diubah atau hanya oleh Superadmin lain.</small>
                    @endif
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Contoh jika Anda menambahkan field is_active
                <div class="mb-4 form-check">
                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', $user->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Akun Aktif</label>
                </div>
                --}}

                <div class="d-flex justify-content-end pt-3 border-top-form-footer">
                    <a href="{{ route('admin.akun.index') }}" class="btn btn-outline-dark me-2">
                        <i class="mdi mdi-cancel"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="mdi mdi-content-save-edit-outline"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection


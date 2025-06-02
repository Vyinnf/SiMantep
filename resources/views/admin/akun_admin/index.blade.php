@extends('layouts.admin')

@section('title', 'Manajemen Akun Admin')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="mdi mdi-check-circle-outline alert-icon"></i>
            <span>{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="mdi mdi-alert-circle-outline alert-icon"></i>
            <span>{{ session('error') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="page-header-container mb-4">
        <h2 class="page-title mb-0">Manajemen Akun Admin</h2>
        <div class="action-bar ms-auto">
            {{-- Anda bisa menambahkan kondisi di sini jika hanya superadmin yang boleh menambah --}}
            {{-- @if(Auth::user()->role == 'superadmin') --}}
            <a href="{{ route('admin.akun.create') }}" class="btn btn-primary">
                <i class="mdi mdi-account-plus-outline"></i> Tambah Akun Admin
            </a>
            {{-- @endif --}}
        </div>
    </div>

    {{-- Form Pencarian (Opsional) --}}
    <div class="card shadow-sm border-0 data-table-card mb-4">
        <div class="card-body p-3">
            <form action="{{ route('admin.akun.index') }}" method="GET">
                <div class="input-group search-bar">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama atau email..." value="{{ request('search') }}">
                    <button class="btn btn-outline-dark" type="submit" title="Cari">
                        <i class="mdi mdi-magnify"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>


    <div class="card shadow-sm border-0 data-table-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table data-table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 5%;" class="text-center">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th style="width: 15%;" class="text-center">Role</th>
                            {{-- <th style="width: 10%; text-align:center;">Status Aktif</th> --}}
                            <th style="width: 20%; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($adminAccounts as $account)
                        <tr>
                            <td class="text-center">{{ $loop->iteration + $adminAccounts->firstItem() - 1 }}</td>
                            <td>{{ $account->name }}</td>
                            <td>{{ $account->email }}</td>
                            <td class="text-center">
                                <span class="badge {{ $account->role == 'superadmin' ? 'bg-danger' : 'bg-info' }} text-uppercase">
                                    {{ $account->role }}
                                </span>
                            </td>
                            {{-- <td class="text-center">
                                @if($account->is_active ?? true)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Tidak Aktif</span>
                                @endif
                            </td> --}}
                            <td class="text-center action-buttons">
                                {{-- Logika untuk mencegah edit/hapus akun yang tidak semestinya --}}
                                {{-- Misalnya, hanya superadmin yang bisa edit superadmin lain, atau tidak bisa edit diri sendiri --}}
                                @if(Auth::user()->can('update', $account) || Auth::id() === $account->id) {{-- Contoh Gate/Policy --}}
                                    <button type="button" class="btn btn-info btn-sm"
                                            data-bs-toggle="offcanvas"
                                            data-bs-target="#offcanvasEditAdmin{{ $account->id }}"
                                            aria-controls="offcanvasEditAdmin{{ $account->id }}"
                                            title="Edit Akun {{ $account->name }}">
                                        <i class="mdi mdi-account-edit-outline"></i> Edit
                                    </button>
                                @else
                                    <button type="button" class="btn btn-info btn-sm" disabled title="Tidak ada hak akses">
                                        <i class="mdi mdi-account-edit-outline"></i> Edit
                                    </button>
                                @endif

                                @if(Auth::id() !== $account->id && (Auth::user()->can('delete', $account))) {{-- Contoh Gate/Policy --}}
                                    <form action="{{ route('admin.akun.destroy', $account->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus akun admin \'{{ $account->name }}\'? Tindakan ini tidak dapat diurungkan.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus Akun {{ $account->name }}">
                                            <i class="mdi mdi-delete-outline"></i> Hapus
                                        </button>
                                    </form>
                                @else
                                    <button type="submit" class="btn btn-danger btn-sm" disabled title="{{ Auth::id() === $account->id ? 'Tidak bisa hapus diri sendiri' : 'Tidak ada hak akses' }}">
                                        <i class="mdi mdi-delete-outline"></i> Hapus
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center data-empty-message">
                                Tidak ada data akun admin yang ditemukan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($adminAccounts->hasPages())
                <div class="mt-4 d-flex justify-content-center">
                    {{ $adminAccounts->appends(request()->query())->links() }} {{-- Tambah appends agar filter pencarian tetap saat paginasi --}}
                </div>
            @endif
        </div>
    </div>

    {{-- Offcanvas untuk Edit Akun Admin (Satu Offcanvas, konten diisi via JS jika datanya banyak) --}}
    {{-- ATAU jika ingin per baris seperti sebelumnya, uncomment dan loop @foreach ($adminAccounts as $account) di sini --}}
    @foreach ($adminAccounts as $account)
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEditAdmin{{ $account->id }}" aria-labelledby="offcanvasEditAdminLabel{{ $account->id }}">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasEditAdminLabel{{ $account->id }}">Edit Akun: {{ $account->name }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form action="{{ route('admin.akun.update', $account->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="edit_name_{{ $account->id }}" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="edit_name_{{ $account->id }}" name="name" value="{{ old('name', $account->name) }}" required>
                </div>
                <div class="mb-3">
                    <label for="edit_email_{{ $account->id }}" class="form-label">Alamat Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="edit_email_{{ $account->id }}" name="email" value="{{ old('email', $account->email) }}" required>
                </div>
                <div class="mb-3">
                    <label for="edit_password_{{ $account->id }}" class="form-label">Password Baru (Opsional)</label>
                    <input type="password" class="form-control" id="edit_password_{{ $account->id }}" name="password" autocomplete="new-password">
                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                </div>
                <div class="mb-3">
                    <label for="edit_password_confirmation_{{ $account->id }}" class="form-label">Konfirmasi Password Baru</label>
                    <input type="password" class="form-control" id="edit_password_confirmation_{{ $account->id }}" name="password_confirmation" autocomplete="new-password">
                </div>
                <div class="mb-3">
                    <label for="edit_role_{{ $account->id }}" class="form-label">Peran (Role) <span class="text-danger">*</span></label>
                    <select class="form-control" id="edit_role_{{ $account->id }}" name="role" required {{ ($account->id === Auth::id() && $account->role === 'superadmin') || (Auth::user()->role !== 'superadmin' && $account->role === 'superadmin') ? 'disabled' : '' }}>
                        {{-- Asumsi $roles ('admin', 'superadmin') dikirim dari controller --}}
                        @php $availableRoles = ['admin', 'superadmin']; @endphp
                        @foreach($availableRoles as $roleValue)
                            <option value="{{ $roleValue }}" {{ old('role', $account->role) == $roleValue ? 'selected' : '' }}>{{ Str::ucfirst($roleValue) }}</option>
                        @endforeach
                    </select>
                    @if(($account->id === Auth::id() && $account->role === 'superadmin') || (Auth::user()->role !== 'superadmin' && $account->role === 'superadmin'))
                        <input type="hidden" name="role" value="{{ $account->role }}">
                        <small class="form-text text-muted">Peran Superadmin tidak dapat diubah atau hanya oleh Superadmin lain.</small>
                    @endif
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="mdi mdi-content-save-edit-outline"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endforeach
@endsection

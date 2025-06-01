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

    <div class="page-header-container mb-4">
        <h2 class="page-title mb-0">Manajemen Akun Admin</h2>
        <div class="action-bar ms-auto">
            <a href="{{-- route('admin.akun.create') --}}#" class="btn btn-primary">
                <i class="mdi mdi-account-plus-outline"></i> Tambah Akun Admin
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
                            <th>Nama Admin</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Terakhir Login</th>
                            <th style="width: 15%; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @forelse ($adminAccounts as $account) --}}
                        <tr>
                            <td class="text-center">{{-- $loop->iteration --}}1</td>
                            <td>Administrator Utama</td>
                            <td>admin@example.com</td>
                            <td><span class="badge" style="background-color: var(--accent-secondary); color: var(--text-on-accent);">Super Admin</span></td>
                            <td>01 Juni 2025, 01:00</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-info btn-sm" title="Edit Role">
                                    <i class="mdi mdi-shield-edit-outline"></i> Edit
                                </a>
                                {{-- Tombol Hapus mungkin perlu konfirmasi ekstra hati-hati --}}
                            </td>
                        </tr>
                        {{-- @empty --}}
                        <tr>
                            <td colspan="6" class="text-center data-empty-message">
                                Tidak ada data akun admin.
                            </td>
                        </tr>
                        {{-- @endforelse --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

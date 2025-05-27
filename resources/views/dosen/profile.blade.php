{{-- filepath: resources/views/dosen/profile.blade.php --}}
@extends('layouts.dosen')
@section('title', 'Profil Dosen')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <img src="{{ asset('assets-admin/img/profile-default.png') }}" alt="Foto Profil" class="rounded-circle mb-3" width="90" height="90">
                    <h4 class="fw-bold mb-1">{{ Auth::user()->name }}</h4>
                    <div class="text-muted mb-3">{{ Auth::user()->email }}</div>
                    <table class="table table-borderless mb-4 text-start">
                        <tr>
                            <th style="width: 120px;">Nama</th>
                            <td>{{ Auth::user()->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ Auth::user()->email }}</td>
                        </tr>
                        {{-- Tambahkan data lain jika ada, misal NIP, No HP, dsb --}}
                    </table>
                    <a href="{{ route('dosen.profile.edit') }}" class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Edit Profil
                    </a>
                    <a href="{{ route('dosen.dashboard') }}" class="btn btn-outline-dark ms-2">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

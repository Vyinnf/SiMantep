<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Dosen</title>
    <link rel="stylesheet" href="{{ asset('assets-admin/css/admin-dosen.css') }}">
</head>
<body>
    <div class="container">

        @extends('layouts.admin')
        @section('title', 'Data Dosen')
        @section('content')
        <h2>Data Dosen</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dosen as $dsn)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $dsn->name }}</td>
                    <td>{{ $dsn->email }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">Tidak ada data dosen.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        @endsection
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Dosen</title>
    <link rel="stylesheet" href="{{ asset('assets-admin/css/vertical-layout-light/style.css') }}">
</head>
<body>
    <div class="container">
        <h2>Data Dosen</h2>
        <a href="{{ route('admin.dosen.create') }}" class="btn btn-primary" style="margin-bottom: 15px;">Tambah Dosen</a>
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
    </div>
</body>
</html>

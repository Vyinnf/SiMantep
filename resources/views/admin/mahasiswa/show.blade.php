<!-- filepath: c:\laragon\www\Project Sistem PKL\laravel\resources\views\admin\mahasiswa\show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Mahasiswa</title>
    <link rel="stylesheet" href="{{ asset('assets-admin/css/admin-show-mhs.css') }}">
</head>
<body>
    <div class="detail-box">
        <div class="detail-title">Detail Mahasiswa</div>
        <table class="detail-table">
            <tr>
                <td>Nama</td>
                <td>{{ $mahasiswa->user->name ?? '-' }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $mahasiswa->user->email ?? '-' }}</td>
            </tr>
            @if(isset($mahasiswa->nim))
            <tr>
                <td>NIM</td>
                <td>{{ $mahasiswa->nim }}</td>
            </tr>
            @endif
            @if(isset($mahasiswa->prodi))
            <tr>
                <td>Prodi</td>
                <td>{{ $mahasiswa->prodi }}</td>
            </tr>
            @endif
            @if(isset($mahasiswa->angkatan))
            <tr>
                <td>Angkatan</td>
                <td>{{ $mahasiswa->angkatan }}</td>
            </tr>
            @endif
            @if(isset($mahasiswa->semester))
            <tr>
                <td>Semester</td>
                <td>{{ $mahasiswa->semester }}</td>
            </tr>
            @endif
            @if(isset($mahasiswa->alamat))
            <tr>
                <td>Alamat</td>
                <td>{{ $mahasiswa->alamat }}</td>
            </tr>
            @endif
        </table>
        <a href="{{ route('admin.mahasiswa.index') }}" class="btn-back">Kembali</a>
    </div>
</body>
</html>

<!-- filepath: c:\laragon\www\Project Sistem PKL\laravel\resources\views\admin\mahasiswa\show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Mahasiswa</title>
    <link rel="stylesheet" href="{{ asset('assets-admin/css/admin-mhs.css') }}">
    <style>
        .detail-box {
            max-width: 500px;
            margin: 40px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
            padding: 32px 24px;
        }
        .detail-title {
            text-align: center;
            margin-bottom: 24px;
            color: #2563eb;
            font-size: 1.5rem;
            font-weight: 600;
        }
        .detail-table {
            width: 100%;
            border-collapse: collapse;
        }
        .detail-table td {
            padding: 10px 8px;
            border-bottom: 1px solid #eee;
        }
        .detail-table td:first-child {
            font-weight: 500;
            color: #444;
            width: 40%;
        }
        .btn-back {
            display: inline-block;
            margin-top: 24px;
            background: #2563eb;
            color: #fff;
            padding: 8px 22px;
            border-radius: 4px;
            text-decoration: none;
            transition: background 0.2s;
        }
        .btn-back:hover {
            background: #1746a0;
        }
    </style>
</head>
<body>
    <div class="detail-box">
        <div class="detail-title">Detail Mahasiswa</div>
        <table class="detail-table">
            <tr>
                <td>Nama</td>
                <td>{{ $mahasiswa->name }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $mahasiswa->email }}</td>
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
        </table>
        <a href="{{ route('admin.mahasiswa.index') }}" class="btn-back">Kembali</a>
    </div>
</body>
</html>

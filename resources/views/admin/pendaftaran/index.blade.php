<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pendaftaran PKL</title>
    <link rel="stylesheet" href="{{ asset('assets-admin/css/vertical-layout-light/style.css') }}">
</head>
<body>
    <div class="container">
        <h2>Daftar Pendaftaran PKL Mahasiswa</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Prodi</th>
                    <th>Tanggal Daftar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendaftaran as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->mahasiswa->nim ?? '-' }}</td>
                    <td>{{ $item->mahasiswa->name ?? '-' }}</td>
                    <td>{{ $item->mahasiswa->prodi ?? '-' }}</td>
                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                    <td>
                        @if($item->status == 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($item->status == 'verified')
                            <span class="badge bg-success">Terverifikasi</span>
                        @elseif($item->status == 'rejected')
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>
                    <td>
                        @if($item->status == 'pending')
                        <form action="{{ route('admin.pendaftaran.verifikasi', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Verifikasi</button>
                        </form>
                        <form action="{{ route('admin.pendaftaran.tolak', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                        </form>
                        @else
                        <span>-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada pendaftaran PKL.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>

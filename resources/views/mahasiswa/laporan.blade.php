<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Upload Laporan Magang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/laporan.css') }}" rel="stylesheet">
</head>
<body>
    <div class="form-upload">
        <h3 class="form-title text-center">Upload Laporan Magang</h3>
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="laporan" class="form-label">File Laporan (PDF)</label>
                <input type="file" class="form-control" id="laporan" name="laporan" accept="application/pdf" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Upload</button>
        </form>
        <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-link w-100 mt-3">← Kembali ke Dashboard</a>
    </div>
</body>
</html>

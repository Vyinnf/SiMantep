<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pendaftaran PKL Mahasiswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/pendaftaran.css') }}" rel="stylesheet">
</head>
<body>
    <div class="form-pendaftaran">
        <h3 class="form-title text-center">Formulir Pendaftaran PKL</h3>
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Mahasiswa</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ auth()->user()->name }}" readonly>
            </div>
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim" value="{{ auth()->user()->mahasiswa->nim ?? '' }}" readonly>
            </div>
            <div class="mb-3">
                <label for="instansi" class="form-label">Instansi Tujuan PKL</label>
                <input type="text" class="form-control" id="instansi" name="instansi" required>
            </div>
            <div class="mb-3">
                <label for="alamat_instansi" class="form-label">Alamat Instansi</label>
                <input type="text" class="form-control" id="alamat_instansi" name="alamat_instansi" required>
            </div>
            <div class="mb-3">
                <label for="dokumen" class="form-label">Upload Dokumen Persyaratan (PDF)</label>
                <input type="file" class="form-control" id="dokumen" name="dokumen" accept="application/pdf" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Daftar PKL</button>
        </form>
        <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-link w-100 mt-3">← Kembali ke Dashboard</a>
    </div>
</body>
</html>

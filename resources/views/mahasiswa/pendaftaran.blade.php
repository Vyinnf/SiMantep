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
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Periksa kembali isian Anda:</strong>
            <ul class="mb-0 mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="form-pendaftaran">
        <h3 class="form-title text-center">Formulir Pendaftaran PKL</h3>
        <form action="{{ route('mahasiswa.pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Mahasiswa</label>
                <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" value="{{ auth()->user()->email }}" readonly>
            </div>

            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim"
                    value="{{ old('nim', auth()->user()->mahasiswa->nim ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label for="prodi" class="form-label">Program Studi</label>
                <input type="text" class="form-control" id="prodi" name="prodi"
                    value="{{ old('prodi', auth()->user()->mahasiswa->prodi ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label for="semester" class="form-label">Semester</label>
                <input type="number" min="1" max="14" class="form-control" id="semester" name="semester"
                    value="{{ old('semester', auth()->user()->mahasiswa->semester ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label for="alamat_mahasiswa" class="form-label">Alamat Mahasiswa</label>
                <input type="text" class="form-control" id="alamat_mahasiswa" name="alamat_mahasiswa"
                    value="{{ old('alamat_mahasiswa', auth()->user()->mahasiswa->alamat ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label for="no_hp" class="form-label">No HP/WA</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp"
                    value="{{ old('no_hp', auth()->user()->mahasiswa->no_hp ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label for="judul_pkl" class="form-label">Judul PKL</label>
                <input type="text" class="form-control" id="judul_pkl" name="judul_pkl"
                    value="{{ old('judul_pkl') }}" required>
            </div>

            <div class="mb-3">
                <label for="instansi_id" class="form-label">Instansi Tujuan PKL</label>
                <select class="form-select" id="instansi_id" name="instansi_id" required>
                    <option value="" selected disabled>-- Pilih Instansi --</option>
                    @foreach ($instansiList as $instansi)
                        <option value="{{ $instansi->id }}"
                            {{ old('instansi_id') == $instansi->id ? 'selected' : '' }}>
                            {{ $instansi->nama_instansi }}
                        </option>
                    @endforeach
                    <option value="other" {{ old('instansi_id') == 'other' ? 'selected' : '' }}>
                        Lainnya / Belum Terdaftar
                    </option>
                </select>
            </div>

            <!-- Bagian manual (muncul jika 'other') -->
            <div id="manual-instansi" style="display: none;">
                <div class="mb-3">
                    <label for="nama_instansi_manual" class="form-label">Nama Instansi (Manual)</label>
                    <input type="text" class="form-control" id="nama_instansi_manual" name="nama_instansi_manual"
                        value="{{ old('nama_instansi_manual') }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="alamat_instansi_manual" class="form-label">Alamat Instansi (Manual)</label>
                    <input type="text" class="form-control" id="alamat_instansi_manual" name="alamat_instansi_manual"
                        value="{{ old('alamat_instansi_manual') }}" disabled>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Daftar PKL</button>
        </form>

        <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-link w-100 mt-3">← Kembali ke Dashboard</a>
    </div>  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const select = document.getElementById('instansi_id');
            const manualSection = document.getElementById('manual-instansi');
            const namaManual = document.getElementById('nama_instansi_manual');
            const alamatManual = document.getElementById('alamat_instansi_manual');

            function toggleManualInstansi(value) {
                const isManual = value === 'other';
                manualSection.style.display = isManual ? 'block' : 'none';
                namaManual.disabled = !isManual;
                alamatManual.disabled = !isManual;
            }

            // Saat load halaman, cek old value
            toggleManualInstansi(select.value);

            // Saat user mengganti pilihan
            select.addEventListener('change', function () {
                toggleManualInstansi(this.value);
            });
        });
    </script>
</body>

</html>

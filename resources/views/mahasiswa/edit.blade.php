@extends('mahasiswa.side') {{-- Menggunakan layout utama Anda: mahasiswa/dashboard.blade.php --}}

@section('title', 'Edit Profil Mahasiswa') {{-- Judul spesifik untuk halaman ini --}}

@section('content')
    <div class="page-header">
        <h3 class="page-title">Edit Profil Mahasiswa</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('mahasiswa.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Profil</li>
            </ol>
        </nav>
    </div>

    <form class="forms-sample" method="POST" action="{{ route('mahasiswa.profil.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Formulir Data Diri</h4>
                    </div>
                    <div class="card-body">

                        {{-- Foto --}}
                        <div class="form-group mb-3"> {{-- Menambahkan margin-bottom --}}
                            <label for="foto" class="form-label"><i class="fa fa-image"></i> Foto Profil</label>
                            <div class="mb-2">
                                <img id="preview"
                                    src="{{ $mahasiswa->foto ? asset('uploads/foto/' . $mahasiswa->foto) : 'https://placehold.co/100x100/EBF4FF/76839A?text=Foto' }}"
                                    width="100" height="100" alt="Preview Foto Profil" style="object-fit: cover; border-radius: 8px;"> {{-- Sedikit pembulatan pada preview --}}
                            </div>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" {{-- Menggunakan form-control untuk styling Bootstrap 5 --}}
                                id="foto" name="foto" onchange="previewFoto()">
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Nama --}}
                        <div class="form-group mb-3">
                            <label for="nama" class="form-label"><i class="fa fa-user"></i> Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                name="nama" placeholder="Masukkan nama lengkap"
                                value="{{ old('nama', $mahasiswa->nama ?? '') }}">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="form-group mb-3">
                            <label for="email" class="form-label"><i class="fa fa-envelope"></i> Email</label>
                            <input type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                id="email"
                                name="email"
                                placeholder="Masukkan email"
                                value="{{ old('email', $mahasiswa->user->email ?? $mahasiswa->email ?? '') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- NIM --}}
                        <div class="form-group mb-3">
                            <label for="nim" class="form-label"><i class="fa fa-id-card"></i> NIM</label>
                            <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim"
                                name="nim" placeholder="Masukkan NIM" value="{{ old('nim', $mahasiswa->nim ?? '') }}">
                            @error('nim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Semester --}}
                        <div class="form-group mb-3">
                            <label for="semester" class="form-label"><i class="fa fa-layer-group"></i> Semester</label>
                            <select class="form-select @error('semester') is-invalid @enderror" id="semester" name="semester">
                                @for ($i = 1; $i <= 14; $i++)
                                    <option value="{{ $i }}"
                                        {{ old('semester', $mahasiswa->semester ?? '') == $i ? 'selected' : '' }}>
                                        Semester {{ $i }}
                                    </option>
                                @endfor
                            </select>
                            @error('semester')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Prodi --}}
                        <div class="form-group mb-3">
                            <label for="prodi" class="form-label"><i class="fa fa-graduation-cap"></i> Program Studi</label>
                            <input type="text" class="form-control @error('prodi') is-invalid @enderror" id="prodi"
                                name="prodi" placeholder="Masukkan nama prodi"
                                value="{{ old('prodi', $mahasiswa->prodi ?? '') }}">
                            @error('prodi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tempat Lahir --}}
                        <div class="form-group mb-3">
                            <label for="tempat_lahir" class="form-label"><i class="fa fa-map-marker-alt"></i> Tempat Lahir</label>
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                id="tempat_lahir" name="tempat_lahir" placeholder="Masukkan tempat lahir"
                                value="{{ old('tempat_lahir', $mahasiswa->tempat_lahir ?? '') }}">
                            @error('tempat_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tanggal Lahir --}}
                        <div class="form-group mb-3">
                            <label for="tanggal_lahir" class="form-label"><i class="fa fa-calendar-alt"></i> Tanggal Lahir</label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $mahasiswa->tanggal_lahir ? \Carbon\Carbon::parse($mahasiswa->tanggal_lahir)->format('Y-m-d') : '') }}">
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Alamat --}}
                        <div class="form-group mb-3">
                            <label for="alamat" class="form-label"><i class="fa fa-home"></i> Alamat Lengkap</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3"
                                placeholder="Masukkan alamat lengkap">{{ old('alamat', $mahasiswa->alamat ?? '') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tombol --}}
                        <div class="form-actions mt-4 pt-3 border-top">
                            <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-secondary me-2">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                            <button type="reset" class="btn btn-light me-2">
                                <i class="fa fa-rotate-left"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Simpan Perubahan
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    {{-- JS spesifik untuk halaman edit profil --}}
    <script src="{{ asset('assets/js/edit.js') }}"></script> {{-- Pastikan file ini ada dan sesuai --}}
    <script>
        function previewFoto() {
            const fotoInput = document.querySelector('#foto');
            const previewImage = document.querySelector('#preview');

            if (fotoInput.files && fotoInput.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                }
                reader.readAsDataURL(fotoInput.files[0]);
                previewImage.style.display = 'block';
            } else {
                // Jika tidak ada file yang dipilih (misalnya setelah reset atau pembatalan)
                // Kembalikan ke gambar default jika ada, atau sembunyikan jika tidak ada gambar awal
                // Untuk contoh ini, kita anggap ada gambar awal dari $mahasiswa->foto
                // atau placeholder, jadi kita tidak melakukan apa-apa agar gambar awal tetap.
                // Jika ingin kembali ke placeholder saat input file dikosongkan:
                // previewImage.src = 'https://placehold.co/100x100/EBF4FF/76839A?text=Foto';
            }
        }

        // Panggil previewFoto jika ada file yang sudah terpilih (misalnya saat validasi gagal dan halaman reload)
        // Ini mungkin tidak diperlukan jika old('foto') tidak mengembalikan path file,
        // karena browser security mencegah pre-filling input file.
        // Namun, event listener 'change' pada input file sudah cukup.
    </script>
@endpush

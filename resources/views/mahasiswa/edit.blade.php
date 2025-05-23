{{-- data mahasiswa --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/edit.css') }}">

{{-- Alert success & error --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<form class="forms-sample" method="POST" action="{{ route('mahasiswa.profil.update') }}" enctype="multipart/form-data">
    @csrf
    <h4 class="card-title"><span>Data Diri Mahasiswa</span></h4>

    <div class="row mt-4">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    {{-- Foto --}}
                    <div class="form-group">
                        <label for="foto"><i class="fa fa-image"></i> Foto Profil</label>
                        <div class="mb-2">
                            <img id="preview"
                                src="{{ $mahasiswa->foto ? asset('uploads/foto/' . $mahasiswa->foto) : 'https://via.placeholder.com/100' }}"
                                width="100" height="100" alt="">
                        </div>
                        <input type="file" class="form-control-file @error('foto') is-invalid @enderror"
                            id="foto" name="foto" onchange="previewFoto()">
                        @error('foto')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nama --}}
                    <div class="form-group">
                        <label for="nama"><i class="fa fa-user"></i> Nama Lengkap</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                            name="nama" placeholder="Masukkan nama lengkap"
                            value="{{ old('nama', $mahasiswa->nama ?? '') }}">
                        @error('nama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="form-group">
                        <label for="email"><i class="fa fa-envelope"></i> Email</label>
                        <input type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            id="email"
                            name="email"
                            placeholder="Masukkan email"
                            value="{{ old('email', $mahasiswa->user->email ?? $mahasiswa->email ?? '') }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- NIM --}}
                    <div class="form-group">
                        <label for="nim"><i class="fa fa-id-card"></i> NIM</label>
                        <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim"
                            name="nim" placeholder="Masukkan NIM" value="{{ old('nim', $mahasiswa->nim ?? '') }}">
                        @error('nim')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Semester --}}
                    <div class="form-group">
                        <label for="semester"><i class="fa fa-layer-group"></i> Semester</label>
                        <select class="form-control @error('semester') is-invalid @enderror" id="semester"
                            name="semester">
                            @for ($i = 1; $i <= 14; $i++)
                                <option value="{{ $i }}"
                                    {{ old('semester', $mahasiswa->semester ?? '') == $i ? 'selected' : '' }}>
                                    Semester {{ $i }}
                                </option>
                            @endfor
                        </select>
                        @error('semester')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Prodi --}}
                    <div class="form-group">
                        <label for="prodi"><i class="fa fa-graduation-cap"></i> Program Studi</label>
                        <input type="text" class="form-control @error('prodi') is-invalid @enderror" id="prodi"
                            name="prodi" placeholder="Masukkan nama prodi"
                            value="{{ old('prodi', $mahasiswa->prodi ?? '') }}">
                        @error('prodi')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tempat Lahir --}}
                    <div class="form-group">
                        <label for="tempat_lahir"><i class="fa fa-map-marker-alt"></i> Tempat Lahir</label>
                        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                            id="tempat_lahir" name="tempat_lahir" placeholder="Masukkan tempat lahir"
                            value="{{ old('tempat_lahir', $tempat_lahir ?? '') }}">
                        @error('tempat_lahir')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div class="form-group">
                        <label for="tanggal_lahir"><i class="fa fa-calendar-alt"></i> Tanggal Lahir</label>
                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                            id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $tanggal_lahir ?? '') }}">
                        @error('tanggal_lahir')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Alamat --}}
                    <div class="form-group">
                        <label for="alamat"><i class="fa fa-home"></i> Alamat Lengkap</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3"
                            placeholder="Masukkan alamat lengkap">{{ old('alamat', $mahasiswa->alamat ?? '') }}</textarea>
                        @error('alamat')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tombol --}}
                    <div class="form-actions mt-3">
                        <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                        <button type="reset" class="btn btn-light">
                            <i class="fa fa-rotate-left"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>

<script src="{{ asset('assets/js/edit.js') }}"></script>
{{-- end data mahasiswa --}}


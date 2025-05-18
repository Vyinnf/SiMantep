{{-- data mahasiswa --}}
<<<<<<< HEAD
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
=======
<link rel="stylesheet" href="{{ asset('assets/css/mahasiswa-profile.css') }}">

<form method="POST" action="{{ route('mahasiswa.profil.update') }}" enctype="multipart/form-data">
>>>>>>> df707fc1da2876c670583d3cb7b9652617e088d4
    @csrf
    <div class="row mt-4">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
<<<<<<< HEAD
                    <h4 class="card-title"><span>Data Diri Mahasiswa</span></h4>

                    {{-- Foto --}}
                    <div class="form-group">
                        <label for="foto">Foto Profil</label>
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
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                            name="nama" placeholder="Masukkan nama lengkap"
                            value="{{ old('nama', $mahasiswa->nama ?? '') }}">
                        @error('nama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Email --}}
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" placeholder="Masukkan email"
                            value="{{ old('email', $mahasiswa->user->email ?? ($mahasiswa->email ?? '')) }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- NIM --}}
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim"
                            name="nim" placeholder="Masukkan NIM" value="{{ old('nim', $mahasiswa->nim ?? '') }}">
                        @error('nim')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Semester --}}
                    <div class="form-group">
                        <label for="semester">Semester</label>
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
                        <label for="prodi">Program Studi</label>
                        <input type="text" class="form-control @error('prodi') is-invalid @enderror" id="prodi"
                            name="prodi" placeholder="Masukkan nama prodi"
                            value="{{ old('prodi', $mahasiswa->prodi ?? '') }}">
                        @error('prodi')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tempat Lahir --}}
                    <div class="form-group">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                            id="tempat_lahir" name="tempat_lahir" placeholder="Masukkan tempat lahir"
                            value="{{ old('tempat_lahir', $tempat ?? '') }}">
                        @error('tempat_lahir')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                            id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $tanggal ?? '') }}">
                        @error('tanggal_lahir')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Alamat --}}
                    <div class="form-group">
                        <label for="alamat">Alamat Lengkap</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3"
                            placeholder="Masukkan alamat lengkap">{{ old('alamat', $mahasiswa->alamat ?? '') }}</textarea>
                        @error('alamat')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tombol --}}
                    <div class="form-actions mt-3">
                        <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-secondary">Back</a>
                        <button type="reset" class="btn btn-light">Reset</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
=======
                    <h4 class="card-title">Form Data Diri Mahasiswa</h4>
                    <form class="forms-sample" method="POST" action="{{ route('mahasiswa.profil.update') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <!-- Foto -->
                        <div class="form-group">
                            <label for="foto">Foto Profil</label>
                            <div class="input-wrapper">
                                <input type="file" class="form-control-file" id="foto" name="foto">
                            </div>
                        </div>
                        <!-- Nama -->
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <div class="input-wrapper">
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Masukkan nama lengkap">
                            </div>
                        </div>
                        <!-- NIM -->
                        <div class="form-group">
                            <label for="nim">NIM</label>
                            <div class="input-wrapper">
                                <input type="text" class="form-control" id="nim" name="nim"
                                    placeholder="Masukkan NIM">
                            </div>
                        </div>
                        <!-- Semester -->
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <div class="input-wrapper">
                                <select class="form-control" id="semester" name="semester">
                                    @for ($i = 1; $i <= 14; $i++)
                                        <option value="{{ $i }}">Semester {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <!-- Prodi -->
                        <div class="form-group">
                            <label for="prodi">Program Studi</label>
                            <div class="input-wrapper">
                                <input type="text" class="form-control" id="prodi" name="prodi"
                                    placeholder="Masukkan nama prodi">
                            </div>
                        </div>
                        <!-- Tempat Lahir -->
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <div class="input-wrapper">
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                    placeholder="Contoh: Sumenep">
                            </div>
                        </div>
                        <!-- Tanggal Lahir -->
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <div class="input-wrapper">
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                            </div>
                        </div>
                        <!-- Alamat -->
                        <div class="form-group">
                            <label for="alamat">Alamat Lengkap</label>
                            <div class="input-wrapper">
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap"></textarea>
                            </div>
                        </div>
                        <div class="button-center">
                            <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                            <button class="btn btn-light" type="reset">Reset</button>
                            <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </form>
>>>>>>> df707fc1da2876c670583d3cb7b9652617e088d4
                </div>
            </div>
        </div>
    </div>
<<<<<<< HEAD
</form>
{{-- end data mahasiswa --}}

<script src="{{ asset('assets/js/edit.js') }}"></script>
=======
    {{-- end data mahasiswa --}}
>>>>>>> df707fc1da2876c670583d3cb7b9652617e088d4

{{-- data mahasiswa --}}
<link rel="stylesheet" href="{{ asset('assets/css/mahasiswa-profile.css') }}">

<form method="POST" action="{{ route('mahasiswa.profil.update') }}" enctype="multipart/form-data">
    @csrf
    <div class="row mt-4">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
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
                </div>
            </div>
        </div>
    </div>
    {{-- end data mahasiswa --}}

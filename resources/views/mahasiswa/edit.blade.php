{{-- data mahasiswa --}}
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
                        <input type="file" class="form-control-file" id="foto" name="foto">
                    </div>
                    <!-- Nama -->
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            placeholder="Masukkan nama lengkap">
                    </div>
                    <!-- NIM -->
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim"
                            placeholder="Masukkan NIM">
                    </div>
                    <!-- Semester -->
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select class="form-control" id="semester" name="semester">
                            @for ($i = 1; $i <= 14; $i++)
                                <option value="{{ $i }}">Semester
                                    {{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <!-- Prodi -->
                    <div class="form-group">
                        <label for="prodi">Program Studi</label>
                        <input type="text" class="form-control" id="prodi" name="prodi"
                            placeholder="Masukkan nama prodi">
                    </div>
                    <!-- Tempat Tanggal Lahir -->
                    <div class="form-group">
                        <label for="ttl">Tempat, Tanggal Lahir</label>
                        <input type="text" class="form-control" id="ttl" name="ttl"
                            placeholder="Contoh: Sumenep, 01 Januari 2004">
                    </div>
                    <!-- Alamat -->
                    <div class="form-group">
                        <label for="alamat">Alamat Lengkap</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap"></textarea>
                    </div>
                    <!-- Tombol Simpan -->
                    <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                    <button class="btn btn-light" type="reset">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- end data mahasiswa --}}


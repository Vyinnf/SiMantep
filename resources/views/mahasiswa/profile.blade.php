<!-- filepath: resources/views/mahasiswa/profil.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Profil Mahasiswa</h2>
    <p>Nama: {{ $mahasiswa->nama }}</p>
    <p>NIM: {{ $mahasiswa->nim }}</p>
</div>
@endsection

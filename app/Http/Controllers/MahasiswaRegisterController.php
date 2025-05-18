<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register-mahasiswa');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'email.unique' => 'Email sudah digunakan, silakan gunakan email lain.'
        ]);

        // Simpan ke tabel users
        $user = User::create([
            'name'     => $request->nama,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Simpan ke tabel mahasiswas, user_id otomatis dari $user->id
        Mahasiswa::create([
            'user_id'       => $user->id,
            'nama'          => $request->nama,
            'email'         => $request->email,
            'nim'           => '-', // default jika belum ada input
            'semester'      => 1,   // default semester 1
            'prodi'         => '-', // default jika belum ada input
            'tempat_lahir'  => '-',
            'tanggal_lahir' => now(), // atau null jika boleh kosong
            'alamat'        => '-',
            'foto'          => null,
        ]);

        return redirect()->route('mahasiswa.login')->with('success', 'Akun berhasil dibuat!');
    }
}

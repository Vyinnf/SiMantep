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
            'email'    => 'required|email|unique:mahasiswas,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Simpan ke database
        Mahasiswa::create([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('mahasiswa.login.form')->with('success', 'Registrasi berhasil, silakan login.');
    }
}

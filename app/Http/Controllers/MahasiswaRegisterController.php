<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaRegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email|unique:mahasiswas,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->nama,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Mahasiswa::create([
            'user_id'  => $user->id,
            'nama'     => $request->nama,
            'email'    => $request->email,
        ]);

        return redirect()->route('mahasiswa.login')->with('success', 'Akun berhasil dibuat!');
    }
}

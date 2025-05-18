<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login-mahasiswa');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials)) {
            // Berhasil login
            return redirect()->intended('/mahasiswa/dashboard');
        }

        // Gagal login
        return back()->with('error', 'Email atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::guard('mahasiswa')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login/mahasiswa')->with('status', "Anda telah logout");
    }
}

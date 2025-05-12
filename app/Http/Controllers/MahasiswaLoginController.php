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
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Coba login menggunakan guard 'mahasiswa'
        if (
            Auth::guard('mahasiswa')->attempt([
                'email' => $request->email,
                'password' => $request->password,
            ])
        ) {
            $request->session()->regenerate(); // Hindari session fixation
            return redirect()->route('mahasiswa.dashboard')->with('success', 'Login berhasil');
        }

        // Jika gagal login
        return back()
            ->withErrors([
                'email' => 'Email atau password salah.',
            ])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('mahasiswa')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login/mahasiswa')->with('status', "Anda telah logout");
    }
}

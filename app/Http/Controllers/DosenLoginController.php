<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.dosen-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Ganti 'dosen' dengan guard atau logic sesuai kebutuhan Anda
        if (Auth::attempt($credentials)) {
            return redirect()->route('dosen.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('dosen.login');
    }
}

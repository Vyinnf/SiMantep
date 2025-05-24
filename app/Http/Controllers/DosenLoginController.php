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

        // Gunakan guard 'dosen' agar mengambil data dari tabel dosens
        if (Auth::guard('dosen')->attempt($credentials, $request->remember)) {
            return redirect()->route('dosen.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::guard('dosen')->logout();
        return redirect()->route('dosen.login');
    }
}

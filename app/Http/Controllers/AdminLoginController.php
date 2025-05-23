<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    // menampilkan form login untuk admin
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // proses login admin
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials, $request->remember)) {
            // Redirect ke dashboard admin dengan session success
            return redirect()->route('admin.dashboard')->with('success', 'Login berhasil! Selamat datang di Dashboard Admin.');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email', 'remember'));
    }

    // Logout admin
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}

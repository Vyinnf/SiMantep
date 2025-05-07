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

        if (Auth::attemp (['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('home')->with('success', 'Login successful');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput($request->only('email'));
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login/mahasiswa');
    }
}

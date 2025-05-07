<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\MahasiswaLoginController;
use App\Http\Controllers\MahasiswaRegisterController;
use App\Http\Controllers\ForgotPasswordController;

Route::get('/', function () {
    return view('home');
});

// auth
Route::get('/login/mahasiswa', function () {
    return view('auth.login-mahasiswa');
})->name ('mahasiswa.login');

Route::get('/register/mahasiswa', function () {
    return view('auth.register-mahasiswa');
})->name ('mahasiswa.register');

// login
Route::get('/login/mahasiswa', [MahasiswaLoginController::class, 'showLoginForm'])->name('mahasiswa.login.form');
Route::post('/login/mahasiswa', [MahasiswaLoginController::class, 'login'])->name('mahasiswa.login');
Route::post('/logout/mahasiswa', [MahasiswaLoginController::class, 'logout'])->name('mahasiswa.logout');

// register
Route::get('/register/mahasiswa', [MahasiswaRegisterController::class, 'showRegistrationForm'])->name('mahasiswa.register');
Route::post('/register/mahasiswa', [MahasiswaRegisterController::class, 'register'])->name('mahasiswa.register.submit');

// forgot password
Route::get('/lupa-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/lupa-password', [ForgotPasswordController::class, 'sendResetLilnkEmail'])->name('password.email');

// Mengirim email reset password
Route::post('/lupa-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->name('password.email');
<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MahasiswaLoginController;
use App\Http\Controllers\MahasiswaRegisterController;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// halaman home
Route::get('/', function () {
    return view('home');
});

// auth mahasiswa (login, register)

// login
Route::get('/login/mahasiswa', [MahasiswaLoginController::class, 'showloginForm'])->name('mahasiswa.login');
Route::get('/login/mahasiswa', [MahasiswaLoginController::class, 'showLoginForm'])->name('mahasiswa.login.form');
Route::post('/login/mahasiswa', [MahasiswaLoginController::class, 'login'])->name('mahasiswa.login');
Route::post('/logout/mahasiswa', [MahasiswaLoginController::class, 'logout'])->name('mahasiswa.logout');

// register
Route::get('/register/mahasiswa', function () {
    return view('auth.register-mahasiswa');
})->name ('mahasiswa.register');
Route::get('/register/mahasiswa', [MahasiswaRegisterController::class, 'showRegistrationForm'])->name('mahasiswa.register');
Route::post('/register/mahasiswa', [MahasiswaRegisterController::class, 'register'])->name('mahasiswa.register.submit');

// route dashboard mahasiswa
Route::middleware(['auth:mahasiswa'])->group(function () {
    Route::get('/mahasiswa/dashboard', function () {
        return view('mahasiswa.dashboard');
    })->name('mahasiswa.dashboard');
});

// Form lupa password
Route::get('/lupa-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/lupa-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/forgot-password/{token}', function (Request $request, string $token) {
    return view('auth.forgot-password', [
        'token' => $token,
        'email' => $request->email
    ]);
})->name('password.reset');

Route::post('/forgot-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->password = Hash::make($password);
            $user->save();
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('mahasiswa.login.form')->with('success', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->name('password.update');

// Data mahasiswa
Route::middleware(['auth:mahasiswa'])->group(function () {
    Route::get('/mahasiswa/profil', [MahasiswaController::class, 'editProfil'])->name('mahasiswa.profil.edit');
    Route::post('/mahasiswa/profil/update', [MahasiswaController::class, 'updateProfil'])->name('mahasiswa.profil.update');
});
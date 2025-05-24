<?php

use App\Http\Controllers\DosenLoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MahasiswaLoginController;
use App\Http\Controllers\MahasiswaRegisterController;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

// halaman home
Route::get('/', function () {
    return view('home');
});

// ============ AUTH MAHASISWA ============
// Login
Route::get('/login/mahasiswa', [MahasiswaLoginController::class, 'showLoginForm'])->name('mahasiswa.login');
Route::post('/login/mahasiswa', [MahasiswaLoginController::class, 'login'])->name('mahasiswa.login.submit');
Route::post('/logout/mahasiswa', [MahasiswaLoginController::class, 'logout'])->name('mahasiswa.logout');

// Register
Route::get('/register/mahasiswa', [MahasiswaRegisterController::class, 'showRegistrationForm'])->name('mahasiswa.register');
Route::post('/register/mahasiswa', [MahasiswaRegisterController::class, 'register'])->name('mahasiswa.register.submit');

// Form lupa password
Route::get('/lupa-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/lupa-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/forgot-password/{token}', function (Request $request, string $token) {
    return view('auth.forgot-password', [
        'token' => $token,
        'email' => $request->email,
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
        ? redirect()->route('mahasiswa.login')->with('success', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->name('password.update');

// ============ ROUTE KHUSUS MAHASISWA ============

Route::middleware(['auth'])->group(function () {
    // Dashboard Mahasiswa
    Route::get('/mahasiswa/dashboard', function () {
        return view('mahasiswa.dashboard');
    })->name('mahasiswa.dashboard');

    // Profil Mahasiswa
    Route::get('/mahasiswa/profil', [MahasiswaController::class, 'editProfil'])->name('mahasiswa.profil.edit');
    Route::post('/mahasiswa/profil/update', [MahasiswaController::class, 'update'])->name('mahasiswa.profil.update');

    // Melihat profile mahasiswa
    Route::get('/mahasiswa/profile', [MahasiswaController::class, 'show'])->name('mahasiswa.profile.show');

    // Route untuk halaman/form pendaftaran PKL
    Route::get('/mahasiswa/pendaftaran', function () {
        return view('mahasiswa.pendaftaran');
    })->name('mahasiswa.pendaftaran');

    // Route upload laporan magang
    Route::get('/mahasiswa/laporan', function () {
        return view('mahasiswa.laporan');
    })->name('mahasiswa.laporan');
});

// Redirect route
Route::get('/login', function () {
    return redirect('/mahasiswa/dashboard');
})->name('login');

// ============ ROUTE KHUSUS DOSEN ============
Route::get('/dosen/dashboard', function () {
    return view('dosen.dashboard');
})->name('dosen.dashboard')->middleware('auth:dosen');

// ============ VIEW LOGIN DOSEN ===========
Route::get('/login/dosen', [DosenLoginController::class, 'showLoginForm'])->name('dosen.login');
Route::post('/login/dosen', [DosenLoginController::class, 'login'])->name('dosen.login.submit');
Route::post('/logout/dosen', [DosenLoginController::class, 'logout'])->name('dosen.logout');

// ============ AUTH ADMIN ============
Route::get('login-admin', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('login-admin', [AdminLoginController::class, 'login'])->name('admin.login.submit');
Route::post('logout-admin', [AdminLoginController::class, 'logout'])->name('admin.logout');

// Admin Dashboard
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard')->middleware('auth:admin');

// Data Mahasiswa (Admin)
Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('/mahasiswa', [AdminController::class, 'indexMahasiswa'])->name('admin.mahasiswa.index');
    Route::get('/mahasiswa/{id}', [AdminController::class, 'showMahasiswa'])->name('admin.mahasiswa.show');
    Route::get('/mahasiswa/{id}/edit', [AdminController::class, 'editMahasiswa'])->name('admin.mahasiswa.edit');
    Route::put('/mahasiswa/{id}', [AdminController::class, 'updateMahasiswa'])->name('admin.mahasiswa.update');
    Route::delete('/mahasiswa/{id}', [AdminController::class, 'destroyMahasiswa'])->name('admin.mahasiswa.destroy');

    Route::get('/dosen', [AdminController::class, 'indexDosen'])->name('admin.dosen.index');
    Route::get('/dosen/create', function () {
        return view('admin.tambah-dosen');
    })->name('admin.dosen.create');
    Route::post('/dosen/store', [AdminController::class, 'storeDosen'])->name('admin.dosen.store');

    Route::get('/pendaftaran', [AdminController::class, 'indexPendaftaran'])->name('admin.pendaftaran.index');
    Route::post('/pendaftaran/{id}/verifikasi', [AdminController::class, 'verifikasiPendaftaran'])->name('admin.pendaftaran.verifikasi');
    Route::post('/pendaftaran/{id}/tolak', [AdminController::class, 'tolakPendaftaran'])->name('admin.pendaftaran.tolak');
});

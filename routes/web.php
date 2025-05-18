<?php
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
});

// Redirect route
Route::get('/login', function () {
    return redirect('/mahasiswa/dashboard');
})->name('login');


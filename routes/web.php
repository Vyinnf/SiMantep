<?php

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\Admin\AkunAdminController;
use App\Http\Controllers\Admin\AdminNotifikasiController;
use App\Http\Controllers\Admin\InstansiController;
use App\Http\Controllers\Admin\PengajuanInstansiController;
use App\Http\Controllers\Admin\SuratPklController;

use App\Http\Controllers\DosenDashboardController;
use App\Http\Controllers\DosenVerifikasiController;
use App\Http\Controllers\DosenProfileController;
use App\Http\Controllers\DosenMahasiswaController;
use App\Http\Controllers\DosenLaporanController;
use App\Http\Controllers\DosenNilaiController;
use App\Http\Controllers\DosenNotifikasiController;
use App\Http\Controllers\DosenLoginController;

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MahasiswaLoginController;
use App\Http\Controllers\MahasiswaRegisterController;

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\Notifications\PendaftaranBaruNotification;

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

    $status = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
        $user->password = Hash::make($password);
        $user->save();
    });

    return $status === Password::PASSWORD_RESET ? redirect()->route('mahasiswa.login')->with('success', __($status)) : back()->withErrors(['email' => [__($status)]]);
})->name('password.update');

// ============ ROUTE KHUSUS MAHASISWA ============

Route::middleware(['auth'])->group(function () {

    Route::get('/mahasiswa/dashboard', [PendaftaranController::class, 'dashboard'])->name('mahasiswa.dashboard');

    // Profil Mahasiswa
    Route::get('/mahasiswa/profil', [MahasiswaController::class, 'editProfil'])->name('mahasiswa.profil.edit');
    Route::post('/mahasiswa/profil/update', [MahasiswaController::class, 'update'])->name('mahasiswa.profil.update');

    // Melihat profile mahasiswa
    Route::get('/mahasiswa/profile', [MahasiswaController::class, 'show'])->name('mahasiswa.profile.show');

    Route::get('/mahasiswa/pendaftaran', [PendaftaranController::class, 'create'])->name('mahasiswa.pendaftaran');
    Route::post('/mahasiswa/pendaftaran', [PendaftaranController::class, 'store'])->name('mahasiswa.pendaftaran.store');

    // Route::get('/mahasiswa/pendaftaran/{id}', [PendaftaranController::class, 'show'])->name('mahasiswa.pendaftaran');

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
})
    ->name('dosen.dashboard')
    ->middleware('auth:dosen');

// ============ VIEW LOGIN DOSEN ===========
Route::get('/login/dosen', [DosenLoginController::class, 'showLoginForm'])->name('dosen.login');
Route::post('/login/dosen', [DosenLoginController::class, 'login'])->name('dosen.login.submit');
Route::post('/logout/dosen', [DosenLoginController::class, 'logout'])->name('dosen.logout');

// Fitur-fitur khusus dosen
Route::get('dashboard', [DosenDashboardController::class, 'index'])->name('dosen.dashboard');
Route::middleware(['auth:dosen'])
    ->prefix('dosen')
    ->group(function () {
        Route::get('profile', [DosenProfileController::class, 'show'])->name('dosen.profile');
        Route::get('profile/edit', [DosenProfileController::class, 'edit'])->name('dosen.profile.edit');
        Route::put('profile', [DosenProfileController::class, 'update'])->name('dosen.profile.update');
    });

Route::middleware(['auth:dosen'])
    ->prefix('dosen')
    ->group(function () {
        Route::get('dashboard', [DosenDashboardController::class, 'index'])->name('dosen.dashboard');
        Route::get('verifikasi', [DosenVerifikasiController::class, 'index'])->name('dosen.verifikasi');
    });

Route::middleware(['auth:dosen'])
    ->prefix('dosen')
    ->group(function () {
        Route::put('verifikasi/{id}', [DosenVerifikasiController::class, 'update'])->name('dosen.verifikasi.update');
    });

Route::middleware(['auth:dosen'])
    ->prefix('dosen')
    ->group(function () {
        Route::get('mahasiswa', [DosenMahasiswaController::class, 'index'])->name('dosen.mahasiswa');

    });

Route::middleware(['auth:dosen'])
    ->prefix('dosen')
    ->group(function () {
        // ...
        Route::get('laporan', [DosenLaporanController::class, 'index'])->name('dosen.laporan');
        Route::get('laporan/{id}', [DosenLaporanController::class, 'show'])->name('dosen.laporan.show');
        Route::post('laporan/{id}/revisi', [DosenLaporanController::class, 'revisi'])->name('dosen.laporan.revisi');
        Route::post('laporan/{id}/terima', [DosenLaporanController::class, 'terima'])->name('dosen.laporan.terima');
    });

Route::middleware(['auth:dosen'])
    ->prefix('dosen')
    ->group(function () {
        // ...
        Route::get('nilai', [DosenNilaiController::class, 'index'])->name('dosen.nilai');
        Route::post('nilai/{id}', [DosenNilaiController::class, 'store'])->name('dosen.nilai.store');
    });

Route::middleware(['auth:dosen'])
    ->prefix('dosen')
    ->group(function () {
        // ...
        Route::get('notifikasi', [DosenNotifikasiController::class, 'index'])->name('dosen.notifikasi');
    });

// ============ AUTH ADMIN ============
Route::get('login-admin', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('login-admin', [AdminLoginController::class, 'login'])->name('admin.login.submit');
Route::post('logout-admin', [AdminLoginController::class, 'logout'])->name('admin.logout');

// Admin Dashboard
Route::get('/admin/dashboard', [AdminController::class, 'dashboardCustom'])->name('admin.dashboard');

// Data Mahasiswa (Admin)
Route::middleware('auth:admin')
    ->prefix('admin')
    ->group(function () {
        Route::get('/mahasiswa', [AdminController::class, 'indexMahasiswa'])->name('admin.mahasiswa.index');
        Route::get('/mahasiswa/{id}', [AdminController::class, 'showMahasiswa'])->name('admin.mahasiswa.show');
        Route::get('/mahasiswa/{id}/edit', [AdminController::class, 'editMahasiswa'])->name('admin.mahasiswa.edit');
        Route::put('/mahasiswa/{id}', [AdminController::class, 'updateMahasiswa'])->name('admin.mahasiswa.update');
        Route::delete('/mahasiswa/{id}', [AdminController::class, 'destroyMahasiswa'])->name('admin.mahasiswa.destroy');
        Route::get('/mahasiswa/export', [AdminController::class, 'exportMahasiswa'])->name('admin.mahasiswa.export');

        Route::get('/dosen', [AdminController::class, 'indexDosen'])->name('admin.dosen.index');
        Route::get('/dosen/create', function () {
            return view('admin.tambah-dosen');
        })->name('admin.dosen.create');
        Route::post('/dosen/store', [AdminController::class, 'storeDosen'])->name('admin.dosen.store');

        Route::get('/pendaftaran', [AdminController::class, 'indexPendaftaran'])->name('admin.pendaftaran.index');
        Route::post('/pendaftaran/{id}/verifikasi', [AdminController::class, 'verifikasiPendaftaran'])->name('admin.pendaftaran.verifikasi');
        Route::post('/pendaftaran/{id}/tolak', [AdminController::class, 'tolakPendaftaran'])->name('admin.pendaftaran.tolak');

        Route::get('/notifications', [AdminNotifikasiController::class, 'index'])->name('admin.notifications.index');
        Route::put('/notifications/{id}/read', [AdminNotifikasiController::class, 'markAsRead'])->name('admin.notifications.markAsRead');
        Route::delete('/notifications/{id}', [AdminNotifikasiController::class, 'destroy'])->name('admin.notifications.destroy');
    });

Route::middleware('auth:admin')
    ->prefix('admin')
    ->group(function () {
        Route::get('/instansi', [InstansiController::class, 'index'])->name('admin.instansi.index');
        Route::get('/instansi/create', [InstansiController::class, 'create'])->name('admin.instansi.create');
        Route::post('/instansi', [InstansiController::class, 'store'])->name('admin.instansi.store');
        Route::get('/instansi/{id}/edit', [InstansiController::class, 'edit'])->name('admin.instansi.edit');
        Route::put('/instansi/{id}', [InstansiController::class, 'update'])->name('admin.instansi.update');
        Route::delete('/instansi/{id}', [InstansiController::class, 'destroy'])->name('admin.instansi.destroy');
        Route::post('/admin/pendaftaran/{id}/assign-dosen', [PendaftaranController::class, 'assignDosen'])->name('admin.pendaftaran.assignDosen');
    });

// Pengajuan Instansi
Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth:admin')
    ->group(function () {
        Route::prefix('instansi-diminta')
            ->name('instansi.diminta.')
            ->group(function () {
                Route::get('/', [PengajuanInstansiController::class, 'index'])->name('index');
                Route::post('/{pengajuanInstansi}/approve', [PengajuanInstansiController::class, 'approve'])->name('approve');
                Route::post('/{pengajuanInstansi}/reject', [PengajuanInstansiController::class, 'reject'])->name('reject');
                Route::delete('/{pengajuanInstansi}', [PengajuanInstansiController::class, 'destroy'])->name('destroy');
            });
        Route::prefix('surat-pkl')
            ->name('surat.pkl.')
            ->group(function () {
                Route::get('/', [SuratPklController::class, 'index'])->name('index');
                Route::get('/create', [SuratPklController::class, 'create'])->name('create');
                Route::post('/', [SuratPklController::class, 'store'])->name('store');
                Route::get('/{suratPkl}', [SuratPklController::class, 'show'])->name('show'); // Tambahkan show jika perlu
                Route::get('/{suratPkl}/edit', [SuratPklController::class, 'edit'])->name('edit');
                Route::put('/{suratPkl}', [SuratPklController::class, 'update'])->name('update');
                Route::delete('/{suratPkl}', [SuratPklController::class, 'destroy'])->name('destroy');
                Route::get('/{suratPkl}/download', [SuratPklController::class, 'download'])->name('download');
            });

        Route::prefix('akun')
            ->name('akun.')
            ->group(function () {
                Route::get('/', [AkunAdminController::class, 'index'])->name('index');
                Route::get('/create', [AkunAdminController::class, 'create'])->name('create');
                Route::post('/', [AkunAdminController::class, 'store'])->name('store');
                Route::get('/{admin}/edit', [AkunAdminController::class, 'edit'])->name('edit'); // Parameter jadi {admin}
                Route::put('/{admin}', [AkunAdminController::class, 'update'])->name('update'); // Parameter jadi {admin}
                Route::delete('/{admin}', [AkunAdminController::class, 'destroy'])->name('destroy'); // Parameter jadi {admin}
            });
    });

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthSocialiteController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use App\Http\Controllers\PasienController;

Route::get('/', function () {
    return view('layouts.login_selection');
});
Route::get('/email', function () {
    return view('layouts.emailverification');
});

Route::get('/profile', function () {
    return view('layouts.profile');
});

Route::get('/editprofile', function () {
    return view('layouts.editProfile');
});
Route::get('/list-dokter', [DokterController::class, 'byDokter'])->name('periksa.byDokter');
Route::post('/list-dokter', [DokterController::class, 'byDokter']);




Route::get('/login', [AuthController::class, 'form'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'formRegister'])->name('daftar');
Route::post('/register', [RegisterController::class, 'register']);
Route::middleware(['auth', 'role:dokter,admin'])->group(function () {
    Route::get('/obat', [ObatController::class, 'index'])->name('obat.index');
    Route::get('/list-obat', [ObatController::class, 'obat'])->name('obat.index');
    Route::get('/obat/{id}/edit', [ObatController::class, 'edit'])->name('obat.edit');
    Route::put('/obat/{id}', [ObatController::class, 'update'])->name('obat.update');
    Route::post('/obat', [ObatController::class, 'store'])->name('obat.store');
    Route::get('/obat/create', [ObatController::class, 'create'])->name('obat.create');
    Route::get('/dokter', [DokterController::class, 'index'])->name('dokter.index');
    Route::get('/periksa', [PasienController::class, 'pasien'])->name('pasien.index');
    Route::get('/edit_periksa/{id}/edit', [PasienController::class, 'edit'])->name('pasien.edit');
    Route::put('/edit_periksa/{id}', [PasienController::class, 'update'])->name('pasien.update');

    Route::delete('/obat/{id}', [ObatController::class, 'destroy'])->name('obat.destroy');
});

Route::middleware(['auth', 'role:pasien'])->group(function () {
    Route::get('/dokter', [DokterController::class, 'index'])->name('dokter.index');
    Route::get('/periksa/dokter', [DokterController::class, 'byDokter'])->name('periksa.byDokter');
    Route::post('/periksa/dokter', [DokterController::class, 'byDokter']);
});


#Sign In with Google
Route::get(
    '/auth/redirect',
    [AuthSocialiteController::class, 'redirect']
);
Route::get(
    '/auth/{google}/callback',
    [AuthSocialiteController::class, 'callback']
);


#Forgot Password
Route::get('/forgot-password', function () {
    return view('layouts.recovery_password');
})->middleware('guest')->name('password.request');
Route::post('/forgot-password', [ResetPasswordController::class, 'verifyEmail'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetPassword'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'UpdatePassword'])->middleware('guest')->name('password.update');

#edit profile
Route::put('/updateProfile', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::middleware(['auth'])->group(function () {
    Route::post('/upload-cover-photo', [ProfileController::class, 'uploadCoverPhoto'])->name('upload.cover.photo');
});

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\JadwalPeriksaController;

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'formLogin'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login']);
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/dashboard', function () {
            return view('layouts.admin.dashboard');
        })->name('admin.dashboard');

        // CRUD Pasien
        Route::get('/pasien', [AdminController::class, 'indexPasien'])->name('admin.pasien.index');
        Route::get('/pasien/create', [AdminController::class, 'createPasien'])->name('admin.pasien.create');
        Route::post('/pasien', [AdminController::class, 'storePasien'])->name('admin.pasien.store');
        Route::get('/pasien/{id}/edit', [AdminController::class, 'editPasien'])->name('admin.pasien.edit');
        Route::put('/pasien/{id}', [AdminController::class, 'updatePasien'])->name('admin.pasien.update');
        Route::delete('/pasien/{id}', [AdminController::class, 'destroyPasien'])->name('admin.pasien.destroy');

        // Update Dokter
        Route::get('/dokter', [AdminController::class, 'indexDokter'])->name('admin.dokter.index');
        Route::get('/dokter/{id}/edit', [AdminController::class, 'editDokter'])->name('admin.dokter.edit');
        Route::put('/dokter/{id}', [AdminController::class, 'updateDokter'])->name('admin.dokter.update');

        // CRUD Poli
        Route::get('/poli', [PoliController::class, 'index'])->name('admin.poli.index');
        Route::get('/poli/create', [PoliController::class, 'create'])->name('admin.poli.create');
        Route::post('/poli', [PoliController::class, 'store'])->name('admin.poli.store');
        Route::get('/poli/{id}/edit', [PoliController::class, 'edit'])->name('admin.poli.edit');
        Route::put('/poli/{id}', [PoliController::class, 'update'])->name('admin.poli.update');
        Route::delete('/poli/{id}', [PoliController::class, 'destroy'])->name('admin.poli.destroy');

        // CRUD Jadwal Periksa
        Route::get('/jadwal', [JadwalPeriksaController::class, 'index'])->name('admin.jadwal.index');
        Route::get('/jadwal/create', [JadwalPeriksaController::class, 'create'])->name('admin.jadwal.create');
        Route::post('/jadwal', [JadwalPeriksaController::class, 'store'])->name('admin.jadwal.store');
        Route::get('/jadwal/{id}/edit', [JadwalPeriksaController::class, 'edit'])->name('admin.jadwal.edit');
        Route::put('/jadwal/{id}', [JadwalPeriksaController::class, 'update'])->name('admin.jadwal.update');
        Route::delete('/jadwal/{id}', [JadwalPeriksaController::class, 'destroy'])->name('admin.jadwal.destroy');
    });
});

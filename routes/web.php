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
    return view('layouts.login');
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
Route::get('/list-dokter', function () {
    $dokters = User::where('role', 'dokter')->get();
    return view('layouts.list_dokter', compact('dokters'));
});




Route::get('/login', [AuthController::class, 'form'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'formRegister'])->name('daftar');
Route::post('/register', [RegisterController::class, 'register']);
Route::middleware(['auth', 'role:dokter'])->group(function () {
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
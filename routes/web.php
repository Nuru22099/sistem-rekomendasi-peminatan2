
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MahasiswaController;

//HALAMAN UTAMA

Route::get('/', function () {

    if (!auth()->check()) {
        return redirect()->route('login');
    }

    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('mahasiswa.dashboard');

});

// ROUTE LOGIN

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'show'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.proses');

});

// ROUTE LOGOUT

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


//ROUTE ADMIN

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // DASHBOARD
        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('dashboard');


        // DATA MAHASISWA
        Route::get('/mahasiswa', [AdminController::class, 'mahasiswa'])
            ->name('mahasiswa');

        Route::post('/mahasiswa', [AdminController::class, 'simpanMahasiswa'])
            ->name('mahasiswa.simpan');

        Route::put('/mahasiswa/{mahasiswa}', [AdminController::class, 'updateMahasiswa'])
            ->name('mahasiswa.update');

        Route::delete('/mahasiswa/{mahasiswa}', [AdminController::class, 'hapusMahasiswa'])
            ->name('mahasiswa.hapus');


        // DATA MATA KULIAH
        Route::get('/mata-kuliah', [AdminController::class, 'mataKuliah'])
            ->name('mk');

        Route::post('/mata-kuliah', [AdminController::class, 'simpanMk'])
            ->name('mk.simpan');

        Route::put('/mata-kuliah/{mataKuliah}', [AdminController::class, 'updateMK'])
            ->name('mk.update');

        Route::delete('/mata-kuliah/{mataKuliah}', [AdminController::class, 'hapusMk'])
            ->name('mk.hapus');


        // DATA PEMINATAN
        Route::get('/peminatan', [AdminController::class, 'peminatan'])
            ->name('peminatan');

        Route::post('/peminatan', [AdminController::class, 'simpanPeminatan'])
            ->name('peminatan.simpan');

        Route::put('/peminatan/{peminatan}', [AdminController::class, 'updatePeminatan'])
            ->name('peminatan.update');

        Route::delete('/peminatan/{peminatan}', [AdminController::class, 'hapusPeminatan'])
            ->name('peminatan.hapus');


        // HASIL REKOMENDASI
        Route::get('/rekomendasi', [AdminController::class, 'rekomendasi'])
            ->name('rekomendasi');


        // LAPORAN
        Route::get('/laporan', [AdminController::class, 'laporan'])
            ->name('laporan');

    });

// ROUTE MAHASISWA

Route::middleware(['auth', 'role:mahasiswa'])
    ->prefix('mahasiswa')
    ->name('mahasiswa.')
    ->group(function () {

        // DASHBOARD
        Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])
            ->name('dashboard');


        // PILIHAN MATA KULIAH
        Route::get('/penilaian', [MahasiswaController::class, 'form'])
            ->name('penilaian');

        Route::post('/penilaian', [MahasiswaController::class, 'simpan'])
            ->name('penilaian.simpan');


        // HASIL REKOMENDASI
        Route::get('/hasil', [MahasiswaController::class, 'hasil'])
            ->name('hasil');

    });

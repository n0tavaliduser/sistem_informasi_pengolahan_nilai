<?php

use App\Http\Controllers\RuangKelasController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::middleware(Authenticate::class)->prefix('manajemen-kelas')->group(function () {
    Route::get('/daftar-kelas', [RuangKelasController::class, 'daftarKelas'])->name('manajemen-kelas.daftar-kelas');
    Route::get('/ruang-kelas/{jadwal}', [RuangKelasController::class, 'ruangKelas'])->name('manajemen-kelas.ruang-kelas');
}); 
<?php

use App\Http\Controllers\NilaiController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::middleware(Authenticate::class)->prefix('manajemen-nilai')->group(function () {
    Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai.index');
    Route::post('/nilai', [NilaiController::class, 'store'])->name('nilai.store');
    Route::patch('/nilai/{nilai}', [NilaiController::class, 'update'])->name('nilai.update');
    Route::delete('/nilai/{nilai}', [NilaiController::class, 'destroy'])->name('nilai.destroy');

    // Action
    Route::get('/nilai/{kelas}/ranking', [NilaiController::class, 'ranking'])->name('nilai.ranking');
    Route::get('/nilai/{siswa}/cetak', [NilaiController::class, 'cetak'])->name('nilai.cetak');
    Route::get('/nilai/{kelas}/rekap', [NilaiController::class, 'rekapByKelas'])->name('nilai.rekap-by-kelas');
    Route::get('/nilai/{kelas}/cetak-by-kelas', [NilaiController::class, 'cetakByKelas'])->name('nilai.cetak-by-kelas');
});
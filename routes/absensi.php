<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::middleware(Authenticate::class)->group(function () {
    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::get('/absensi/{mata_pelajaran}/{kelas}/{jadwal}/show', [AbsensiController::class, 'show'])->name('absensi.show');
    Route::post('/absensi/{siswa}/{jadwal}', [AbsensiController::class, 'store'])->name('absensi.store');
    Route::get('/absensi/rekap', [AbsensiController::class, 'rekap'])->name('absensi.rekap');

    // Action
    Route::get('/absensi/{kelas}/{mata_pelajaran}/cetak', [AbsensiController::class, 'cetak'])->name('absensi.cetak');
});
<?php

use App\Http\Controllers\TugasController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::middleware(Authenticate::class)->prefix('manajemen-tugas')->group(function () {
    Route::get('/tugas', [TugasController::class, 'index'])->name('tugas.index');
    Route::post('/tugas', [TugasController::class, 'store'])->name('tugas.store');
    Route::get('/tugas/{tugas}/show', [TugasController::class, 'show'])->name('tugas.show');
    Route::get('/tugas/{jadwal}/{tugas}', [TugasController::class, 'edit'])->name('tugas.edit');
    Route::patch('/tugas/{tugas}', [TugasController::class, 'update'])->name('tugas.update');
    Route::delete('/tugas/{tugas}', [TugasController::class, 'destroy'])->name('tugas.destroy');

    // action
    Route::get('/tugas/status/{tugas}/tutup', [TugasController::class, 'tutupTugas'])->name('tugas.close-tugas');
    Route::get('/tugas/status/{tugas}/buka', [TugasController::class, 'bukaTugas'])->name('tugas.open-tugas');
    Route::get('/tugas/download/{tugas}/files', [TugasController::class, 'downloadFile'])->name('tugas.download-file');
    Route::get('/rekap-nilai', [TugasController::class, 'rekapNilai'])->name('tugas.rekap-nilai');
});
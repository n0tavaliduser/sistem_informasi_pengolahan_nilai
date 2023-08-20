<?php

use App\Http\Controllers\TugasController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::middleware(Authenticate::class)->prefix('manajemen-tugas')->group(function () {
    Route::post('/tugas/{jadwal}', [TugasController::class, 'store'])->name('tugas.store');
    Route::get('/tugas/{tugas}/show', [TugasController::class, 'show'])->name('tugas.show');
    Route::get('/tugas/{jadwal}/{tugas}', [TugasController::class, 'edit'])->name('tugas.edit');
    Route::patch('/tugas/{tugas}', [TugasController::class, 'update'])->name('tugas.update');
    Route::delete('/tugas/{tugas}', [TugasController::class, 'destroy'])->name('tugas.destroy');

    // action
    Route::get('/tutup-tugas/{tugas}', [TugasController::class, 'tutupTugas'])->name('tugas.close-tugas');
    Route::get('/buka-tugas/{tugas}', [TugasController::class, 'bukaTugas'])->name('tugas.open-tugas');
});

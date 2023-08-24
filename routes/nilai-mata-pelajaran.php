<?php

use App\Http\Controllers\NilaiMataPelajaranController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::middleware(Authenticate::class)->prefix('manajemen-nilai')->group(function () {
    Route::get('/nilai-mata-pelajaran', [NilaiMataPelajaranController::class, 'index'])->name('nilai-mata-pelajaran.index');
    Route::post('/nilai-mata-pelajaran', [NilaiMataPelajaranController::class, 'store'])->name('nilai-mata-pelajaran.store');
    Route::patch('/nilai-mata-pelajaran/{nilai_mata_pelajaran}', [NilaiMataPelajaranController::class, 'update'])->name('nilai-mata-pelajaran.update');
    Route::delete('/nilai-mata-pelajaran/{nilai_mata_pelajaran}', [NilaiMataPelajaranController::class, 'destroy'])->name('nilai-mata-pelajaran.destroy');
});
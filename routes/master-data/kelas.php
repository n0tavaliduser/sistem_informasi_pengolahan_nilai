<?php

use App\Http\Controllers\KelasController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::middleware(Authenticate::class)->group(function () {
    Route::get('/kelas', [KelasController::class, 'index'])->name('master-data.kelas.index');
    Route::get('/kelas/create', [KelasController::class, 'create'])->name('master-data.kelas.create');
    Route::post('/kelas', [KelasController::class, 'store'])->name('master-data.kelas.store');
    Route::get('/kelas/{kelas}/edit', [KelasController::class, 'edit'])->name('master-data.kelas.edit');
    Route::patch('/kelas/{kelas}', [KelasController::class, 'update'])->name('master-data.kelas.update');
    Route::delete('/kelas/{kelas}', [KelasController::class, 'destroy'])->name('master-data.kelas.destroy');
});
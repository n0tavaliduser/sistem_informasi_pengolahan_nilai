<?php

use App\Http\Controllers\SiswaController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::middleware(Authenticate::class)->group(function () {
    Route::get('/siswa', [SiswaController::class, 'index'])->name('master-data.siswa.index');
    Route::get('/siswa/create', [SiswaController::class, 'create'])->name('master-data.siswa.create');
    Route::post('/siswa', [SiswaController::class, 'store'])->name('master-data.siswa.store');
    Route::get('/siswa/{siswa}/edit', [SiswaController::class, 'edit'])->name('master-data.siswa.edit');
    Route::patch('/siswa/{siswa}', [SiswaController::class, 'update'])->name('master-data.siswa.update');
    Route::delete('/siswa/{siswa}', [SiswaController::class, 'destroy'])->name('master-data.siswa.destroy');
});
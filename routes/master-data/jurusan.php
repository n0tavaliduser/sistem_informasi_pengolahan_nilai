<?php

use App\Http\Controllers\JurusanController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::middleware(Authenticate::class)->group(function () {
    Route::get('/jurusan', [JurusanController::class, 'index'])->name('master-data.jurusan.index');
    Route::post('/jurusan', [JurusanController::class, 'store'])->name('master-data.jurusan.store');
    Route::patch('/jurusan/{jurusan}', [JurusanController::class, 'update'])->name('master-data.jurusan.update');
    Route::delete('/jurusan/{jurusan}', [JurusanController::class, 'destroy'])->name('master-data.jurusan.destroy');
});
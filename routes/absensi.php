<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::middleware(Authenticate::class)->group(function () {
    Route::post('/absensi/{siswa}/{jadwal}', [AbsensiController::class, 'store'])->name('absensi.store');
});
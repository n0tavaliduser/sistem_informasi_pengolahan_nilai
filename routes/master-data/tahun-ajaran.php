<?php

use App\Http\Controllers\TahunAjaranController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::middleware(Authenticate::class)->group(function () {
    Route::get('/tahun-ajaran', [TahunAjaranController::class, 'index'])->name('master-data.tahun-ajaran.index');
    Route::get('/tahun-ajaran/create', [TahunAjaranController::class, 'create'])->name('master-data.tahun-ajaran.create');
    Route::post('/tahun-ajaran', [TahunAjaranController::class, 'store'])->name('master-data.tahun-ajaran.store');
    Route::get('/tahun-ajaran/{tahun_ajaran}/edit', [TahunAjaranController::class, 'edit'])->name('master-data.tahun-ajaran.edit');
    Route::patch('/tahun-ajaran/{tahun_ajaran}', [TahunAjaranController::class, 'update'])->name('master-data.tahun-ajaran.update');
    Route::delete('/tahun-ajaran/{tahun_ajaran}', [TahunAjaranController::class, 'destroy'])->name('master-data.tahun-ajaran.destroy');
});
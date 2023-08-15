<?php

use App\Http\Controllers\MataPelajaranController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::middleware(Authenticate::class)->group(function () { 
    Route::get('/mata-pelajaran', [MataPelajaranController::class, 'index'])->name('master-data.mata-pelajaran.index');
    Route::post('/mata-pelajaran', [MataPelajaranController::class, 'store'])->name('master-data.mata-pelajaran.store');
    Route::patch('/mata-pelajaran/{mata_pelajaran}', [MataPelajaranController::class, 'update'])->name('master-data.mata-pelajaran.update');
    Route::delete('/mata-pelajaran/{mata_pelajaran}', [MataPelajaranController::class, 'destroy'])->name('master-data.mata-pelajaran.destroy');
});
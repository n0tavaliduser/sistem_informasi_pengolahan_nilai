<?php

use App\Http\Controllers\PengumpulanTugasController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::middleware(Authenticate::class)->group(function () {
    Route::post('/pengumpulan-tugas/{tugas}', [PengumpulanTugasController::class, 'store'])->name('pengumpulan-tugas.store');
    Route::patch('/pengumpulan-tugas/{pengumpulan_tugas}', [PengumpulanTugasController::class, 'update'])->name('pengumpulan-tugas.update');
    Route::delete('/pengumpulan-tugas/{pengumpulan_tugas}', [PengumpulanTugasController::class, 'destroy'])->name('pengumpulan-tugas.destroy');

    // action
    Route::get('/penumpulan_tugas/download/{pengumpulan_tugas}', [PengumpulanTugasController::class, 'downloadFile'])->name('pengumpulan-tugas.download-file');
});
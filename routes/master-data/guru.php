<?php

use App\Http\Controllers\GuruController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::middleware(Authenticate::class)->group(function () {
    Route::get('/guru', [GuruController::class, 'index'])->name('master-data.guru.index');
    Route::get('/guru/create', [GuruController::class, 'create'])->name('master-data.guru.create');
    Route::post('/guru', [GuruController::class, 'store'])->name('master-data.guru.store');
    Route::get('/guru/{guru}', [GuruController::class, 'show'])->name('master-data.guru.show');
    Route::get('/guru/{guru}/edit', [GuruController::class, 'edit'])->name('master-data.guru.edit');
    Route::patch('/guru/{guru}', [GuruController::class, 'update'])->name('master-data.guru.update');
    Route::delete('/guru/{guru}', [GuruController::class, 'destroy'])->name('master-data.guru.destroy');

    // action
    Route::get('/guru/{guru}/reset-password', [GuruController::class, 'resetPassword'])->name('master-data.guru.reset-password');
});
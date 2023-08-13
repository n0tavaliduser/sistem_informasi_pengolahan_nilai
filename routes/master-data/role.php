<?php

use App\Http\Controllers\RoleController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::middleware(Authenticate::class)->group(function () {
    Route::get('/role', [RoleController::class, 'index'])->name('master-data.role.index');
    Route::post('/role', [RoleController::class, 'store'])->name('master-data.role.store');
    Route::patch('/role/{role}', [RoleController::class, 'update'])->name('master-data.role.update');
    Route::delete('/role/{role}', [RoleController::class, 'destroy'])->name('master-data.role.destroy');
});
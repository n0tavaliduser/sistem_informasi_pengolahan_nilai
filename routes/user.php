<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::middleware(Authenticate::class)->group(function () {
    Route::get('/my-profile', [UserController::class, 'profile'])->name('user.my-profile');
    
    Route::get('/my-profile/{siswa}/edit-siswa', [UserController::class, 'editSiswaProfile'])->name('user.edit-siswa-profile');
    Route::get('/my-profile/{guru}/edit-guru', [UserController::class, 'editGuruProfile'])->name('user.edit-guru-profile');

    Route::patch('/my-profile/{siswa}/update-siswa', [UserController::class, 'updateSiswaProfile'])->name('user.update-siswa-profile');
    Route::patch('/my-profile/{guru}/update-guru', [UserController::class, 'updateGuruProfile'])->name('user.update-guru-profile');

    Route::patch('/change-password/{user}', [UserController::class, 'changePassword'])->name('user.change-password');
    Route::patch('/change-profile-picture/{user}', [UserController::class, 'changeProfilePic'])->name('user.change-profile-pic');
});
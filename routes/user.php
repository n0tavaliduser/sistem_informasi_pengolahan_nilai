<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::middleware(Authenticate::class)->group(function () {
    Route::get('/my-profile', [UserController::class, 'profile'])->name('user.my-profile');
    Route::patch('/change-password/{user}', [UserController::class, 'changePassword'])->name('user.change-password');
    Route::patch('/change-profile-picture/{user}', [UserController::class, 'changeProfilePic'])->name('user.change-profile-pic');
});
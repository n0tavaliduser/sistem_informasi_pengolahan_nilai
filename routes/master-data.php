<?php

use Illuminate\Support\Facades\Route;

Route::prefix('master-data')->group(function () { 
    require __DIR__ . '/master-data/jurusan.php';
    require __DIR__ . '/master-data/role.php';
    require __DIR__ . '/master-data/mata-pelajaran.php';
});
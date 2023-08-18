<?php

use Illuminate\Support\Facades\Route;

Route::prefix('master-data')->group(function () { 
    require __DIR__ . '/master-data/jurusan.php';
    require __DIR__ . '/master-data/role.php';
    require __DIR__ . '/master-data/mata-pelajaran.php';
    require __DIR__ . '/master-data/guru.php';
    require __DIR__ . '/master-data/tahun-ajaran.php';
    require __DIR__ . '/master-data/kelas.php';
    require __DIR__ . '/master-data/siswa.php';
});
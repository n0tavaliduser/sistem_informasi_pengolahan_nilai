<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

// master data routes
require __DIR__ . '/master-data.php';

// other routes
require __DIR__ . '/jadwal-pelajaran.php';
require __DIR__ . '/tugas.php';
require __DIR__ . '/absensi.php';
require __DIR__ . '/pengumpulan-tugas.php';
require __DIR__ . '/materi.php';
require __DIR__ . '/nilai.php';
require __DIR__ . '/user.php';
require __DIR__ . '/nilai-mata-pelajaran.php';

// classroom management routes
require __DIR__ . '/classroom-managerment.php';
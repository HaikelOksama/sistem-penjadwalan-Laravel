<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\MatakuliahController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(DosenController::class)->group(function () {
    Route::get('/dosen', 'index')->name('dosen.index');
    Route::get('/dosen/baru', 'create')->name('dosen.create');
    Route::post('/dosen', 'store')->name('dosen.store');
});

Route::controller(MatakuliahController::class)->group(function () {
    Route::get('/matakuliah', 'index')->name('matakuliah.index');
    Route::get('/matakuliah/baru', 'create')->name('matakuliah.create');
    Route::post('/matakuliah', 'store')->name('matakuliah.store');
});

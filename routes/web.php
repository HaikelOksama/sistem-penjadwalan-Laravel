<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\PerkuliahanController;
use App\Http\Controllers\RuangKelasController;
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

Route::controller(RuangKelasController::class)->group(function () {
    Route::get('/ruangkelas', 'index')->name('ruangkelas.index');
    Route::get('/ruangkelas/baru', 'create')->name('ruangkelas.create');
    Route::post('/ruangkelas', 'store')->name('ruangkelas.store');
});

Route::controller(PerkuliahanController::class)->group(function () {
    Route::get('/perkuliahan', 'index')->name('perkuliahan.index');
    Route::get('/perkuliahan/baru', 'create')->name('perkuliahan.create');
    Route::post('/perkuliahan', 'store')->name('perkuliahan.store');
});

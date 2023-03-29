<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\PerkuliahanController;
use App\Http\Controllers\RuangKelasController;
use App\Http\Livewire\Dosen\DosenIndex;
use App\Http\Livewire\Home;
use App\Http\Livewire\Matakuliah\MatakuliahIndex;
use App\Http\Livewire\Perkuliahan\AvailableTime;
use App\Http\Livewire\Perkuliahan\PerkuliahanCreate;
use App\Http\Livewire\Perkuliahan\PerkuliahanIndex;
use App\Http\Livewire\Perkuliahan\PerkuliahanRuangan;
use App\Http\Livewire\Ruangkelas\RuangkelasIndex;
use App\Models\Matakuliah;
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

Route::get('/', Home::class)->name('index');

Route::prefix('dosen')->group(function () {
    Route::get('/', DosenIndex::class)->name('dosen.index');
    // Route::get('/dosen/baru', 'create')->name('dosen.create');
    // Route::post('/dosen', 'store')->name('dosen.store');
    // Route::put('/dosen', 'update')->name('dosen.update');
});

Route::prefix('matakuliah')->group(function () {
    Route::get('/', MatakuliahIndex::class)->name('matakuliah.index');
    // Route::get('/matakuliah/baru', 'create')->name('matakuliah.create');
    // Route::post('/matakuliah', 'store')->name('matakuliah.store');
});

Route::prefix('ruangkelas')->group(function () {
    Route::get('/',RuangkelasIndex::class)->name('ruangkelas.index');
    // Route::get('/ruangkelas/baru', 'create')->name('ruangkelas.create');
    // Route::post('/ruangkelas', 'store')->name('ruangkelas.store');
});

Route::prefix('perkuliahan')->group(function () {
    Route::get('/', PerkuliahanIndex::class)->name('perkuliahan.index');
    Route::get('show', PerkuliahanRuangan::class)->name('availableTime.show');
    // Route::get('show', AvailableTime::class)->name('availableTime.show');
    Route::get('baru', PerkuliahanCreate::class)->name('perkuliahan.create');
    // Route::post('/perkuliahan', 'store')->name('perkuliahan.store');
});

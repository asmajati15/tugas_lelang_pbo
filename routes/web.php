<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LelangController;

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

// Route::resource('/masyarakat', MasyarakatController::class);
Route::get('/masyarakat', [MasyarakatController::class, 'index'])->name('masyarakat.index');
Route::post('/masyarakat', [MasyarakatController::class, 'store'])->name('masyarakat.store');
Route::put('/masyarakat/{masyarakat}', [MasyarakatController::class, 'update'])->name('masyarakat.update');
Route::delete('/masyarakat/{masyarakat}', [MasyarakatController::class, 'destroy'])->name('masyarakat.destroy');
// Route::resource('/barang', BarangController::class);
Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
Route::put('/barang/{barang}', [BarangController::class, 'update'])->name('barang.update');
Route::delete('/barang/{barang}', [BarangController::class, 'destroy'])->name('barang.destroy');
Route::get('/lelang', [LeLangController::class, 'index'])->name('lelang.index');
Route::post('/lelang', [LeLangController::class, 'newBids'])->name('lelang.store');

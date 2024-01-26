<?php

use App\Http\Controllers\StafController;
use App\Http\Controllers\AsatidController;
use App\Http\Controllers\AsatidlistController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UmumController;
use App\Http\Controllers\KelulusanController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PendaftaranController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::middleware(['auth'])->group(function () {

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//STAF
// Index Page
Route::get('/staf', [StafController::class, 'index'])->name('staf.index');
// Create and Store
Route::post('/staf', [StafController::class, 'store'])->name('staf.store');
// Update
Route::put('/staf{staf}', [StafController::class, 'update'])->name('staf.update');
// Delete
Route::delete('/staf/{staf}', [StafController::class, 'destroy'])->name('staf.destroy');

//ASATID
// Index Page
Route::get('/asatid', [AsatidController::class, 'index'])->name('asatid.index');
// Create and Store
Route::post('/asatid', [AsatidController::class, 'store'])->name('asatid.store');
// Update
Route::put('/asatid{asatid}', [AsatidController::class, 'update'])->name('asatid.update');
// Delete
Route::delete('/asatid/{asatid}', [AsatidController::class, 'destroy'])->name('asatid.destroy');

//LIST ASATID
// Index Page
Route::get('/asatidlist', [AsatidlistController::class, 'index'])->name('asatidlist.index');
// Create and Store
Route::post('/asatidlist', [AsatidlistController::class, 'store'])->name('asatidlist.store');
// Update
Route::put('/asatidlist{asatidlist}', [AsatidlistController::class, 'update'])->name('asatidlist.update');
// Delete
Route::delete('/asatidlist/{asatidlist}', [AsatidlistController::class, 'destroy'])->name('asatidlist.destroy');

//MAPEL
// Index Page
Route::get('/mapel', [MapelController::class, 'index'])->name('mapel.index');
// Create and Store
Route::post('/mapel', [MapelController::class, 'store'])->name('mapel.store');
// Update
Route::put('/mapel{mapel}', [MapelController::class, 'update'])->name('mapel.update');
// Delete
Route::delete('/mapel/{mapel}', [MapelController::class, 'destroy'])->name('mapel.destroy');

//KATEGORI
// Index Page
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
// Create and Store
Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
// Update
Route::put('/kategori{kategori}', [KategoriController::class, 'update'])->name('kategori.update');
// Delete
Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

//PENGUMUMAN UMUM
// Index Page
Route::get('/umum', [UmumController::class, 'index'])->name('umum.index');
// Create and Store
Route::post('/umum', [UmumController::class, 'store'])->name('umum.store');
// Update
Route::put('/umum{umum}', [UmumController::class, 'update'])->name('umum.update');
// Delete
Route::delete('/umum/{umum}', [UmumController::class, 'destroy'])->name('umum.destroy');

//PENGUMUMAN KELULUSAN
// Index Page
Route::get('/kelulusan', [KelulusanController::class, 'index'])->name('kelulusan.index');
// Create and Store
Route::post('/kelulusan', [KelulusanController::class, 'store'])->name('kelulusan.store');
// Update
Route::put('/kelulusan{kelulusan}', [KelulusanController::class, 'update'])->name('kelulusan.update');
// Delete
Route::delete('/kelulusan/{kelulusan}', [KelulusanController::class, 'destroy'])->name('kelulusan.destroy');


// PENDAFTARAN
Route::resource('/pendaftaran', PendaftaranController::class);

// GALLERY
Route::resource('gallery', GalleryController::class);

// berita
Route::resource('berita', BeritaController::class);

});

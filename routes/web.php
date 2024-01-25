<?php

use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\StafController;
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


// PENDAFTARAN
Route::resource('/pendaftaran', PendaftaranController::class);

// GALLERY
Route::resource('gallery', GalleryController::class);

});

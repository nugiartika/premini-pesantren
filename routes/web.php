<?php

use App\Http\Controllers\StafController;
use App\Http\Controllers\AsatidController;
use App\Http\Controllers\AsatidlistController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UmumController;
use App\Http\Controllers\KelulusanController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\KlssantriController;
use App\Http\Controllers\GallerieController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\SyahriahController;
use App\Http\Controllers\UserdashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
// Route::middleware(['auth'])->group(function () {

Route::resource('staf', StafController::class);
Route::resource('asatid', AsatidController::class);
Route::resource('asatidlist', AsatidlistController::class);
Route::resource('mapel', MapelController::class);
Route::resource('kategori', KategoriController::class);
Route::resource('umum', UmumController::class);
Route::resource('kelulusan', KelulusanController::class);
Route::resource('santri', SantriController::class);
Route::resource('gallerie', GallerieController::class);
Route::resource('/klssantri', KlssantriController::class);
Route::resource('/syahriah', SyahriahController::class);
Route::resource('/pendaftaran', PendaftaranController::class);
Route::resource('/berita', BeritaController::class);


    Route::middleware('admin')->group(function(){
        Route::resource('dashboard', DashboardController::class);

        Route::get('admin', function(){

        })->name('admin');

    });

Route::middleware(['user'])->group(function () {
    Route::get('user', function () {
        return 'INI CUMA BISA DIAKSES OLEH USER';
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');// });





// });


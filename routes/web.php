<?php

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AsatidlistController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\KlssantriController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KelulusanController;
use App\Http\Controllers\GallerieController;
use App\Http\Controllers\PendaftaranController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;



Route::get('', [WelcomeController::class, 'index']);
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

Auth::routes(['verify'=>true]);
Route::middleware(['auth'])->group(function () {
            Route::middleware('admin')->group(function(){
            Route::resource('dashboard', DashboardController::class);
            Route::resource('asatidlist', AsatidlistController::class);
            Route::resource('mapel', MapelController::class);
            Route::resource('santri', SantriController::class);
            Route::resource('klssantri', KlssantriController::class);
            Route::resource('kategori', KategoriController::class);
            Route::resource('kelulusan', KelulusanController::class);
            Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
            Route::put('/pendaftaran{pendaftaran}', [PendaftaranController::class, 'update'])->name('pendaftaran.update');
            Route::delete('/pendaftaran/{pendaftaran}', [PendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');
            Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
            Route::get('/berita/create', [BeritaController::class, 'create'])->name('berita.create');
            Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
            Route::get('/berita/{berita}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
            Route::put('/berita/{berita}', [BeritaController::class, 'update'])->name('berita.update');
            Route::delete('/berita/{berita}', [BeritaController::class, 'destroy'])->name('berita.destroy');
            });


            Route::middleware('asatid')->group(function(){
            });
            Route::middleware('santri')->group(function(){
            });

            Route::resource('kelulusan', KelulusanController::class);
            Route::resource('gallerie', GallerieController::class);
            Route::resource('home', HomeController::class);
});

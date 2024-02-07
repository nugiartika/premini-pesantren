<?php

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StafController;
use App\Http\Controllers\AsatidlistController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KelulusanController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\KlssantriController;
use App\Http\Controllers\GallerieController;
use App\Http\Controllers\PendaftaranController;
use App\Models\pendaftaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\staf;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;



Route::get('', [WelcomeController::class, 'index']);
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/email/verify', 'App\Http\Controllers\Auth\VerificationController@show')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'App\Http\Controllers\Auth\VerificationController@verify')->name('verification.verify');
    Route::post('/email/resend', 'App\Http\Controllers\Auth\VerificationController@resend')->name('verification.resend');

        Route::middleware('admin')->group(function(){
            Route::resource('dashboard', DashboardController::class);
            Route::resource('staf', StafController::class);
            Route::resource('asatidlist', AsatidlistController::class);
            Route::resource('mapel', MapelController::class);
            Route::resource('kategori', KategoriController::class);
            Route::resource('santri', SantriController::class);
            Route::resource('klssantri', KlssantriController::class);
            Route::resource('kelulusan', KelulusanController::class);
            Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
            Route::put('/pendaftaran{pendaftaran}', [PendaftaranController::class, 'update'])->name('pendaftaran.update');
            Route::delete('/pendaftaran/{pendaftaran}', [PendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');
        });

            Route::middleware('staf')->group(function(){
            });

            Route::middleware('asatidlist')->group(function(){
            Route::resource('kelulusan', KelulusanController::class);
            });

            Route::middleware('santri')->group(function(){
            Route::resource('kelulusan', KelulusanController::class);
            });

            Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
            Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
            Route::put('/berita{berita}', [BeritaController::class, 'update'])->name('berita.update');
            Route::delete('/berita/{berita}', [BeritaController::class, 'destroy'])->name('berita.destroy');
            Route::resource('gallerie', GallerieController::class);
            Route::resource('home', HomeController::class);

});

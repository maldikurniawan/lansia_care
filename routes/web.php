<?php

use App\Http\Controllers\AktivitasController;
use App\Http\Controllers\DakesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    // return view('welcome');
    return view('landingPage.hero');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/after-register', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::resource('dakes', DakesController::class);
    Route::resource('dokumen', DokumenController::class);
    Route::resource('aktivitas', AktivitasController::class);
    Route::resource('konsultasi', KonsultasiController::class);
    Route::resource('user', UserController::class);
    Route::get('/dokumen-download/{filename}', [DokumenController::class, 'download'])->name('dokumen-download');
    Route::get('aktivitas-pdf', [AktivitasController::class, 'aktivitasPDF']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

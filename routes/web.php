<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DaftarIsuController;
use App\Http\Controllers\DashboardController;
Use App\Http\Controllers\DashboardLegislatifController;
Use App\Http\Controllers\DashboardPartaiController;
use App\Http\Controllers\InfoPolitikController;
use App\Http\Controllers\RekapitulasiController;

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

// KASIH MIDDLEWARE 'auth' KALO ROUTES NYA DI AUTHENTICATED

// AUTH ROUTES
Route::get('/login', [AuthController::class, 'loginView'])->name('login')->middleware('guest');
Route::get('/register', [AuthController::class, 'registerView'])->name('register');
Route::post('/register-action', [AuthController::class, 'registerAction'])->name('register_action');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// DASHBOARD ROUTES / HOME
Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

//Dashboard Routes
// Legislatif
Route::resource("/dashboard/legislatif", DashboardLegislatifController::class)->middleware("auth");

//Partai
Route::resource("/dashboard/partai", DashboardPartaiController::class)->middleware("auth");

//Info Politik Routes
Route::controller(InfoPolitikController::class)->middleware('auth')->group(function () {
    Route::get('/infoPolitik/daftarIsu', 'daftarIsuView');
    Route::get('/infoPolitik/rekapitulasi', 'rekapitulasiView');
    Route::get('/infoPolitik/berita', 'beritaView');
});

Route::controller(DaftarIsuController::class)->middleware('auth')->group(function(){
    Route::post('/postDaftarisu', 'store');
});

Route::controller(RekapitulasiController::class)->middleware('auth')->group(function(){
    Route::post('/postRekapitulasi', 'store');
});

Route::controller(BeritaController::class)->middleware('auth')->group(function(){
    Route::post('/postBerita', 'store');
});

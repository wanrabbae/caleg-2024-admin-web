<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InfoPolitikController;
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

// KASIH MIDDLEWARE 'auth' KALO ROUTES NYA DI AUTHENTICATED

// AUTH ROUTES
Route::get('/login', [AuthController::class, 'loginView'])->name('login')->middleware('guest');
Route::get('/register', [AuthController::class, 'registerView'])->name('register');
Route::post('/register-action', [AuthController::class, 'registerAction'])->name('register_action');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// DASHBOARD ROUTES / HOME
Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

//Dashboard Routes / Legislatif
Route::get("/dashboard/legislatif", [DashboardController::class, "legislatifView"]);
Route::get("/dashboard/partai", [DashboardController::class, "partaiView"]);

//Info Politik Routes

Route::controller(InfoPolitikController::class)->middleware('auth')->group(function () {
    Route::get('/infoPolitik/daftarIsu', 'daftarIsuView');
    Route::get('/infoPolitik/rekapitulasi', 'rekapitulasiView');
    Route::get('/infoPolitik/berita', 'beritaView');
});

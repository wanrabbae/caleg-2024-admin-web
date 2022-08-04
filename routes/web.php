<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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

// AUTH ROUTES
Route::get('/login', [AuthController::class, 'loginView'])->name('login');
Route::get('/register', [AuthController::class, 'registerView'])->name('register');

// DASHBOARD ROUTES / HOME
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

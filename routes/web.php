<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DaftarIsuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardLegislatifController;
use App\Http\Controllers\DashboardPartaiController;
use App\Http\Controllers\DashboardMedsosController;
use App\Http\Controllers\DataSurveyController;
use App\Http\Controllers\RekapitulasiController;
use App\Http\Controllers\RelawanController;
use App\Http\Controllers\VariableController;
use App\Http\Controllers\SaksiDaftarController;
use App\Http\Controllers\SaksiMonitoringController;

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

//  DASHBOARD ROUTES / HOME
Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// AUTH ROUTES
Route::get('/login', [AuthController::class, 'loginView'])->name('login')->middleware('guest');
Route::get('/register', [AuthController::class, 'registerView'])->name('register');
Route::post('/register-action', [AuthController::class, 'registerAction'])->name('register_action');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


// Route::get('/', ['middleware' => 'auth', 'uses' => 'DashboardController@index']);

//Dashboard Routes
Route::resource("/dashboard/legislatif", DashboardLegislatifController::class)->middleware("auth");
Route::resource("/dashboard/partai", DashboardPartaiController::class)->middleware("auth");
Route::resource('/dashboard/medsos', DashboardMedsosController::class)->parameters(["medsos" => "medsos"])->middleware("auth");

//Info Politik Routes
Route::resource("/infoPolitik/daftarIsu", DaftarIsuController::class)->middleware('auth');
Route::resource('/infoPolitik/rekapitulasi', RekapitulasiController::class)->middleware('auth');
Route::resource("/infoPolitik/berita", BeritaController::class)->parameters(["berita" => "berita"])->middleware('auth');

//Survey Routes
Route::resource('/survey/inputSurvey', DataSurveyController::class)->middleware('auth');
Route::resource('/survey/HasilSurvey', VariableController::class)->middleware('auth');

//Data Saksi Routes
Route::resource("/saksi/daftar", SaksiDaftarController::class)->middleware("auth");
Route::resource("/saksi/monitoring", SaksiMonitoringController::class)->middleware("auth");

// Route::get('/infoPolitik/berita/publish/{news:id_news}/{aktif}', function() {

// });
// Route::get('');

// RELAWAN ROUTES (KALO CONFLICT SAMA ROUTE LAIN, BISA TARO INI DI PALING BAWAH)
Route::prefix('/relawan')->middleware('auth')->group(function () {
    Route::get('/', [RelawanController::class, 'index'])->name('relawan');
    Route::post('/', [RelawanController::class, 'store'])->name('relawan-store');
    Route::get('/{id}', [RelawanController::class, 'show'])->name('relawan-show');
    Route::put('/{id}', [RelawanController::class, 'update'])->name('relawan-update');
    Route::delete('/{id}', [RelawanController::class, 'delete'])->name('relawan-delete');
});

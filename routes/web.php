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
use App\Http\Controllers\DPTController;
use App\Http\Controllers\RekapitulasiController;
use App\Http\Controllers\RelawanController;
use App\Http\Controllers\VariableController;
use App\Http\Controllers\SaksiDaftarController;
use App\Http\Controllers\SaksiMonitoringController;
use App\Http\Controllers\SimpatisanController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\EmailBlasController;
use App\Http\Controllers\WaBlasController;
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
// Route::put("/infoPolitik/berita/{id_news}", [BeritaController::class, "update"])->middleware("auth");
Route::resource("/infoPolitik/berita", BeritaController::class)->parameters(["berita" => "berita"])->middleware('auth');

Route::get('/infoPolitik/berita/publish/{id}/{aktif}', [BeritaController::class, 'publish']);
Route::get('/infoPolitik/berita/unpublish/{id}/{aktif}', [BeritaController::class, 'unpublish']);

//Survey Routes
Route::resource('/survey/inputSurvey', DataSurveyController::class)->middleware('auth');
Route::resource('/survey/HasilSurvey', VariableController::class)->middleware('auth');

//Data Saksi Routes
Route::get("/saksi/daftar/{nik}", [SaksiDaftarController::class, "show"])->middleware("auth");
Route::put("/saksi/daftar/{nik}", [SaksiDaftarController::class, "update"])->middleware("auth");
Route::delete("/saksi/daftar/{nik}", [SaksiDaftarController::class, "destroy"])->middleware("auth");
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


// ROUTES REKAP DATA SIMPATISAN
Route::prefix('/program')->middleware('auth')->group(function () {
    Route::get('/', [SimpatisanController::class, 'index'])->name('simpatisan');
    Route::post('/', [SimpatisanController::class, 'store'])->name('simpatisan-store');
    Route::get('/{id}', [SimpatisanController::class, 'show'])->name('simpatisan-show');
    Route::put('/{id}', [SimpatisanController::class, 'update'])->name('simpatisan-update');
    Route::delete('/{id}', [SimpatisanController::class, 'delete'])->name('simpatisan-delete');
});

// ROUTES REKAP DATA DPT / PEMILIH
// Route::prefix('/pemilih')->middleware('auth')->group(function () {
//     Route::get('/', [DptController::class, 'index'])->name('pemilih');
//     Route::post('/', [DptController::class, 'store'])->name('pemilih-store');
//     Route::get('/{id}', [DptController::class, 'show'])->name('pemilih-show');
//     Route::put('/{id}', [DptController::class, 'update'])->name('pemilih-update');
//     Route::delete('/{id}', [DptController::class, 'delete'])->name('pemilih-delete');
// });
Route::prefix('dpt')->middleware('auth')->group(function () {
    Route::get('/', [DPTController::class, 'index'])->name('dpt');
    Route::post('/', [DPTController::class, 'store'])->name('dpt-store');
    Route::get('/{id}', [DPTController::class, 'show'])->name('dpt-show');
    Route::put('/{id}', [DPTController::class, 'update'])->name('dpt-update');
    Route::delete('/{id}', [DPTController::class, 'delete'])->name('dpt-delete');
});

// // ROUTES REKAP DATA DPT MANUAL
// Route::prefix('/agenda')->middleware('auth')->group(function () {
//     Route::get('/', [DptManualController::class, 'index'])->name('agenda');
//     Route::post('/', [DptManualController::class, 'store'])->name('agenda-store');
//     Route::get('/{id}', [DptManualController::class, 'show'])->name('agenda-show');
//     Route::put('/{id}', [DptManualController::class, 'update'])->name('agenda-update');
//     Route::delete('/{id}', [DptManualController::class, 'delete'])->name('agenda-delete');
// });

// ROUTES REKAP DATA TABULASI SUARA
Route::prefix('/suara')->middleware('auth')->group(function () {
    Route::get('/', [TabulasiSuaraController::class, 'index'])->name('suara');
    Route::post('/', [TabulasiSuaraController::class, 'store'])->name('suara-store');
    Route::get('/{id}', [TabulasiSuaraController::class, 'show'])->name('suara-show');
    Route::put('/{id}', [TabulasiSuaraController::class, 'update'])->name('suara-update');
    Route::delete('/{id}', [TabulasiSuaraController::class, 'delete'])->name('suara-delete');
});


Route::resource("/agenda", AgendaController::class)->middleware("auth");

// ROUTES WA BLAS
Route::prefix('whatsapp')->middleware('auth')->group(function () {
    Route::get('/', [WaBlasController::class, 'index'])->name('wa');
    // Route::post('/', [WaBlasController::class, 'store'])->name('wa-store');
    // Route::get('/{id}', [WaBlasController::class, 'show'])->name('wa-show');
    // Route::put('/{id}', [WaBlasController::class, 'update'])->name('wa-update');
    // Route::delete('/{id}', [WaBlasController::class, 'delete'])->name('wa-delete');
});

// ROUTES EMAIL BLAS
Route::prefix('email')->middleware('auth')->group(function () {
    Route::get('/', [EmailBlasController::class, 'index'])->name('email');
    // Route::post('/', [WaBlasController::class, 'store'])->name('email-store');
    // Route::get('/{id}', [WaBlasController::class, 'show'])->name('email-show');
    // Route::put('/{id}', [WaBlasController::class, 'update'])->name('email-update');
    // Route::delete('/{id}', [WaBlasController::class, 'delete'])->name('email-delete');
});

// ROUTE DOCUMENTATION
Route::get('/documentation', [DocumentationController::class, 'index'])->middleware('auth');

// Backup Route
Route::get('/backup', [BackupController::class, 'index'])->middleware('auth');
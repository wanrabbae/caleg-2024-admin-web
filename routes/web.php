<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CalegController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DaftarIsuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardLegislatifController;
use App\Http\Controllers\DashboardPartaiController;
use App\Http\Controllers\DashboardMedsosController;
use App\Http\Controllers\DataSurveyController;
use App\Http\Controllers\DptController;
use App\Http\Controllers\ResetController;
// use App\Http\Controllers\RekapitulasiController;
use App\Http\Controllers\RelawanController;
use App\Http\Controllers\VariableController;
use App\Http\Controllers\SaksiDaftarController;
use App\Http\Controllers\SaksiMonitoringController;
use App\Http\Controllers\SimpatisanController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\EmailBlasController;
use App\Http\Controllers\WaBlasController;
use App\Http\Controllers\ConfigController;

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
Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware("auth:web,caleg");
// AUTH ROUTES
Route::get('/login', [AuthController::class, 'loginView'])
    ->name('login')
    ->middleware('guest');
Route::get('/register', [AuthController::class, 'registerView'])->name('register');
Route::post('/register-action', [AuthController::class, 'registerAction'])->name('register_action');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth:web,caleg');
Route::post('/update', [AuthController::class, 'update'])->middleware('auth:web,caleg');

// Admin Login
Route::get("/administrator", [AdminController::class, "index"])->name("administrator")->middleware("guest");
Route::post('/administrator', [AdminController::class, 'authenticate'])->name('authenticate');

Route::get("/me", [ProfileController::class, "index"])->middleware("auth:web,caleg");

Route::get("/setting", [SettingController::class, "index"])->middleware("auth:web,caleg");
Route::put("/setting/{id}", [SettingController::class, "update"])->middleware("auth:web,caleg");
// Caleg Routes
Route::resource('/caleg', CalegController::class)->middleware('auth');

//Dashboard Routes
Route::resource('/dashboard/legislatif', DashboardLegislatifController::class)->middleware('auth:web,caleg');
Route::resource('/dashboard/partai', DashboardPartaiController::class)->middleware('auth:web,caleg');
Route::resource('/dashboard/medsos', DashboardMedsosController::class)
    ->parameters(['medsos' => 'medsos'])
    ->middleware('auth:web,caleg');

//Info Politik Routes
Route::resource('/infoPolitik/daftarIsu', DaftarIsuController::class)->middleware('auth:web,caleg');
Route::get("/infoPolitik/daftarIsu/relawan/{id}", [DaftarIsuController::class, "relawan"])->middleware("auth:web,caleg");
Route::resource('/infoPolitik/berita', BeritaController::class)
    ->parameters(['berita' => 'berita'])
    ->middleware('auth:web,caleg');

Route::get('/infoPolitik/berita/publish/{id}/{aktif}', [BeritaController::class, 'publish'])->middleware("auth:web,caleg");
Route::get('/infoPolitik/berita/unpublish/{id}/{aktif}', [BeritaController::class, 'unpublish'])->middleware("auth:web,caleg");

//Survey Routes
Route::resource('/survey/inputSurvey', DataSurveyController::class)->middleware('auth:web,caleg');
Route::resource('/survey/HasilSurvey', VariableController::class)->middleware('auth:web,caleg');

//Data Saksi Routes
Route::get('/saksi/daftar/{daftar_saksi:id}', [SaksiDaftarController::class, 'show'])->middleware('auth:web,caleg');
Route::put('/saksi/daftar/{daftar_saksi:id}', [SaksiDaftarController::class, 'update'])->middleware('auth:web,caleg');
Route::delete('/saksi/daftar/{daftar_saksi:id}', [SaksiDaftarController::class, 'destroy'])->middleware('auth:web,caleg');
Route::resource('/saksi/daftar', SaksiDaftarController::class)->middleware('auth:web,caleg');
Route::resource('/saksi/monitoring', SaksiMonitoringController::class)->middleware('auth:web,caleg');

// RELAWAN ROUTES (KALO CONFLICT SAMA ROUTE LAIN, BISA TARO INI DI PALING BAWAH)
Route::prefix('/team')
    ->middleware('auth:web,caleg')
    ->group(function () {
        Route::get('/', [TeamController::class, 'index'])->name('team');
        Route::post('/', [TeamController::class, 'store'])->name('team-store');
        Route::get('/{id}', [TeamController::class, 'show'])->name('team-show');
        Route::put('/{id}', [TeamController::class, 'update'])->name('team-update');
        Route::delete('/{id}', [TeamController::class, 'delete'])->name('team-delete');
        route::get("/upline/{id}", [TeamController::class, "upline"])->name("team-upline");
    });

// ROUTES REKAP DATA SIMPATISAN
Route::prefix('/program')
    ->middleware('auth:web,caleg')
    ->group(function () {
        Route::get('/', [SimpatisanController::class, 'index'])->name('simpatisan');
        Route::post('/', [SimpatisanController::class, 'store'])->name('simpatisan-store');
        Route::get('/{id}', [SimpatisanController::class, 'show'])->name('simpatisan-show');
        Route::put('/{id}', [SimpatisanController::class, 'update'])->name('simpatisan-update');
        Route::delete('/{id}', [SimpatisanController::class, 'delete'])->name('simpatisan-delete');
    });

Route::prefix('dpt')
    ->middleware("auth")
    ->group(function () {
        Route::get('/', [DPTController::class, 'index'])->name('dpt');
        Route::get('/export', [DPTController::class, 'store'])->name('dpt-store');
        Route::post('/import', [DPTController::class, 'update'])->name('dpt-update');
        Route::get('/fetch', [DPTController::class, 'fetch'])->name('dpt-fetch');
        Route::get('/{id}', [DPTController::class, 'show'])->name('dpt-show');
        Route::put('/{id}', [DPTController::class, 'update'])->name('dpt-update');
        Route::delete('/{id}', [DPTController::class, 'delete'])->name('dpt-delete');
    });

Route::resource('/agenda', AgendaController::class)->middleware('auth:web,caleg');

//Route team Relawan
Route::get("/relawan", [RelawanController::class, "index"])->middleware("auth:web,caleg");

// ROUTES WA BLAS
Route::prefix('whatsapp')
    ->middleware('auth:web,caleg')
    ->group(function () {
        Route::get('/', [WaBlasController::class, 'index'])->name('wa');
        Route::post("/send", [WaBlasController::class, "send"])->name("wa-send");
        Route::get("/{relawan:id_relawan}", [WaBlasController::class, "show"])->name("wa-show");
        // Route::post('/', [WaBlasController::class, 'store'])->name('wa-store');
        // Route::get('/{id}', [WaBlasController::class, 'show'])->name('wa-show');
        // Route::put('/{id}', [WaBlasController::class, 'update'])->name('wa-update');
        // Route::delete('/{id}', [WaBlasController::class, 'delete'])->name('wa-delete');
    });
    
    // ROUTES EMAIL BLAS
    Route::prefix('email')
    ->middleware('auth:web,caleg')
    ->group(function () {
        Route::get('/', [EmailBlasController::class, 'index'])->name('email');
        Route::post("/send", [EmailBlasController::class, "send"])->name("email-send");
        Route::get("/{relawan:id_relawan}", [EmailBlasController::class, "show"])->name("email-show");
        // Route::post('/', [WaBlasController::class, 'store'])->name('email-store');
        // Route::get('/{id}', [WaBlasController::class, 'show'])->name('email-show');
        // Route::put('/{id}', [WaBlasController::class, 'update'])->name('email-update');
        // Route::delete('/{id}', [WaBlasController::class, 'delete'])->name('email-delete');
    });

Route::prefix("config")->middleware("auth:web,caleg")->group(function() {
    Route::get("/", [ConfigController::class, "index"]);
    Route::post("/", [ConfigController::class, "update"]);
});

// ROUTE DOCUMENTATION
Route::get('/documentation', [DocumentationController::class, 'index'])->middleware('auth:web,caleg');

// Backup Route
Route::get('/backup', [BackupController::class, 'index'])->middleware('auth');
Route::get('/backup/create', [BackupController::class, 'store'])->middleware('auth');
Route::delete('/backup/{i}', [BackupController::class, 'delete'])->middleware('auth');

Route::get("/reset", [ResetController::class, "index"])->middleware("guest");
Route::post("/reset", [ResetController::class, "send"])->middleware("guest");

Route::get("/resetpassword", [ResetPasswordController::class, "index"])->middleware("guest");
Route::post("/resetpassword", [ResetPasswordController::class, "update"])->middleware("guest");

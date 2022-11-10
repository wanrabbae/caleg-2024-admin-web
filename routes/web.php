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
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\InvoiceController;

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
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth:web,caleg');

// Admin Login
Route::get("/administrator", [AdminController::class, "index"])->name("administrator")->middleware("guest");
Route::post('/administrator', [AdminController::class, 'authenticate'])->name('authenticate')->middleware("guest");

Route::get("/me", [ProfileController::class, "index"])->middleware("auth:web,caleg");

Route::get("/setting", [SettingController::class, "index"])->middleware("auth:web,caleg");
Route::put("/setting/{id}", [SettingController::class, "update"])->middleware("auth:web,caleg");
// Caleg Routes
Route::resource('/caleg', CalegController::class)->middleware('auth');

//Dashboard Routes
Route::resource('/dashboard/legislatif', DashboardLegislatifController::class)->middleware('auth:web');
Route::post("/dashboard/provinsi", [DashboardLegislatifController::class, "provinsi"]);
Route::post("/dashboard/kabupaten", [DashboardLegislatifController::class, "kabupaten"]);
Route::post("/dashboard/dapil", [DashboardLegislatifController::class, "dapil"]);
Route::resource('/dashboard/partai', DashboardPartaiController::class)->middleware('auth:web');
Route::resource('/dashboard/medsos', DashboardMedsosController::class)
    ->parameters(['medsos' => 'medsos'])
    ->middleware(['auth:web,caleg', "level:basic,gold,platinum"]);

Route::resource("/desa", DesaController::class)->middleware("auth:web");
Route::resource("/kecamatan", KecamatanController::class)->middleware("auth:web");
Route::resource("/kabupaten", KabupatenController::class)->middleware("auth:web");
Route::resource("/provinsi", ProvinceController::class)->middleware("auth:web");

//Info Politik Routes
Route::resource('/infoPolitik/daftarIsu', DaftarIsuController::class)->middleware(['auth:web,caleg', "level:basic,gold,platinum"]);
Route::resource('/infoPolitik/berita', BeritaController::class)
    ->parameters(['berita' => 'berita'])
    ->middleware(['auth:web,caleg', "level:basic,gold,platinum"]);

//Survey Routes
Route::resource('/survey/inputSurvey', DataSurveyController::class)->middleware(["auth:web,caleg",'level:gold,platinum']);
Route::resource('/survey/VariableSurvey', VariableController::class)->middleware(['auth:web,caleg', "level:gold,platinum"]);
Route::post("/survey/HasilSurvey", [DataSurveyController::class, "show"])->middleware(['auth:web,caleg', "level:gold,platinum"]);

//Data Saksi Routes
Route::put('/saksi/daftar/{daftar_saksi:id}', [SaksiDaftarController::class, 'update'])->middleware(["auth:web,caleg",'level:gold,platinum']);
Route::delete('/saksi/daftar/{daftar_saksi:id}', [SaksiDaftarController::class, 'destroy'])->middleware(["auth:web,caleg",'level:gold,platinum']);
Route::resource('/saksi/daftar', SaksiDaftarController::class)->middleware(['auth:web,caleg', "level:gold,platinum"]);
Route::resource('/saksi/monitoring', SaksiMonitoringController::class)->middleware(['auth:web,caleg', "level:gold,platinum"]);

// RELAWAN ROUTES (KALO CONFLICT SAMA ROUTE LAIN, BISA TARO INI DI PALING BAWAH)
Route::prefix('/team')
    ->middleware(['auth:web,caleg', "level:basic,gold,platinum"])
    ->group(function () {
        Route::get('/', [TeamController::class, 'index'])->name('team');
        Route::post('/', [TeamController::class, 'store'])->name('team-store');
        Route::put('/{id}', [TeamController::class, 'update'])->name('team-update');
        Route::delete('/{id}', [TeamController::class, 'delete'])->name('team-delete');
        Route::get("/upline/{id}", [TeamController::class, "upline"])->name("team-upline");
        Route::post("/laporan", [TeamController::class, "report"])->name("team-report");
    });

// ROUTES REKAP DATA SIMPATISAN
Route::prefix('/program')
    ->middleware(['auth:web,caleg', "level:basic,gold,platinum"])
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
        Route::get('/', [DptController::class, 'index'])->name('dpt');
        Route::get('/export', [DptController::class, 'store'])->name('dpt-store');
        Route::post('/import', [DptController::class, 'update'])->name('dpt-update');
        Route::get('/fetch', [DptController::class, 'fetch'])->name('dpt-fetch');
        Route::post('/', [DptController::class, 'show'])->name('dpt-show');
        Route::put('/{id}', [DptController::class, 'update'])->name('dpt-update');
        Route::delete('/{id}', [DptController::class, 'delete'])->name('dpt-delete');
    });

Route::resource('/agenda', AgendaController::class)->middleware(['auth:web,caleg', "level:basic,gold,platinum"]);

//Route team Relawan
Route::get("/relawan", [RelawanController::class, "index"])->middleware(['auth:web,caleg', "level:basic,gold,platinum"]);

// ROUTES WA BLAS
Route::prefix('/whatsapp')
    ->middleware(['auth:caleg', "level:platinum"])
    ->group(function () {
        Route::get('/', [WaBlasController::class, 'index'])->name('wa');
        Route::post("/send", [WaBlasController::class, "send"])->name("wa-send");
        // Route::post("/no", [WaBlasController::class, "sendNum"])->name("wa-sendNum");
        // Route::post('/', [WaBlasController::class, 'store'])->name('wa-store');
        // Route::get('/{id}', [WaBlasController::class, 'show'])->name('wa-show');
        // Route::put('/{id}', [WaBlasController::class, 'update'])->name('wa-update');
        // Route::delete('/{id}', [WaBlasController::class, 'delete'])->name('wa-delete');
    });
    
    // ROUTES EMAIL BLAS
    Route::prefix('/email')
    ->middleware(['auth:caleg', "level:platinum"])
    ->group(function () {
        Route::get('/', [EmailBlasController::class, 'index'])->name('email');
        Route::post("/send", [EmailBlasController::class, "send"])->name("email-send");
        Route::get("/{relawan:id_relawan}", [EmailBlasController::class, "show"])->name("email-show");
        // Route::post('/', [WaBlasController::class, 'store'])->name('email-store');
        // Route::get('/{id}', [WaBlasController::class, 'show'])->name('email-show');
        // Route::put('/{id}', [WaBlasController::class, 'update'])->name('email-update');
        // Route::delete('/{id}', [WaBlasController::class, 'delete'])->name('email-delete');
    });

Route::prefix("/configBlas")->middleware(['auth:caleg', "level:platinum"])->group(function() {
    Route::get("/", [ConfigController::class, "index"]);
    Route::post("/", [ConfigController::class, "update"]);
});

Route::prefix("/rekening")->middleware(['auth:web,caleg', "level:platinum"])->group(function() {
    Route::get("/", [RekeningController::class, "index"]);
    Route::post("/", [RekeningController::class, "store"]);
    Route::get("/{rk_bank:id_bank}", [RekeningController::class, "show"]);
    Route::put("/{rk_bank:id_bank}", [RekeningController::class, "update"]);
    Route::delete("/{rk_bank:id_bank}", [RekeningController::class, "destroy"]);
});

Route::prefix("/ewallet")->middleware(['auth:web,caleg', "level:platinum"])->group(function() {
    Route::get("/", [WalletController::class, "index"]);
    Route::post("/", [WalletController::class, "store"]);
    Route::get("/{rk_wallet:id_wallet}", [WalletController::class, "show"]);
    Route::put("/{rk_wallet:id_wallet}", [WalletController::class, "update"]);
    Route::delete("/{rk_wallet:id_wallet}", [WalletController::class, "destroy"]);
});

Route::prefix("/kategori")->middleware(['auth:web,caleg', "level:platinum"])->group(function() {
    Route::get("/", [CategoryController::class, "index"]);
    Route::post("/", [CategoryController::class, "store"]);
    Route::get("/{rk_kategori:id_kategori}", [CategoryController::class, "show"]);
    Route::put("/{rk_kategori:id_kategori}", [CategoryController::class, "update"]);
    Route::delete("/{rk_kategori:id_kategori}", [CategoryController::class, "destroy"]);
});

Route::prefix("/transaksi")->middleware(['auth:web,caleg', "level:platinum"])->group(function() {
    Route::get("/", [TransaksiController::class, "index"]);
    Route::post("/", [TransaksiController::class, "store"]);
    Route::put("/{rk_transaksi:id_transaksi}", [TransaksiController::class, "update"]);
    Route::delete("/{rk_transaksi:id_transaksi}", [TransaksiController::class, "destroy"]);
});

Route::prefix("/laporan")->middleware(['auth:web,caleg', "level:platinum"])->group(function() {
    Route::post("/", [ReportController::class, "index"]);
});

Route::resource("/invoices", InvoiceController::class)->middleware("auth:web");
Route::post("invoices/show", [InvoiceController::class, "show"])->middleware("auth:web");

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

Route::get("/aktivasi", [AuthController::class, "activate"])->middleware("guest");

Route::post("/invoice", [AuthController::class, "invoice"])->middleware("guest");

//Chart
Route::post('/getChart', [DPTController::class, 'getChart'])->middleware(['auth:web,caleg']);
Route::post("/getChartRelawan", [RelawanController::class, "fetch"])->middleware(['auth:web,caleg']);
Route::post("/getChartSuara", [CalegController::class, "fetch"])->middleware(['auth:web,caleg']);
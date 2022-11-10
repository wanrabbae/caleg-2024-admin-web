<?php

use App\Http\Controllers\AgendaCtrl;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\CalegCtrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DptController;
use App\Http\Controllers\DptCtrl;
use App\Http\Controllers\HasilSurveyCtrl;
use App\Http\Controllers\KabupatenCtrl;
use App\Http\Controllers\ProgramCtrl;
use App\Http\Controllers\UserCtrl;
use App\Http\Controllers\IsuCtrl;
use App\Http\Controllers\RelawanController;
use App\Http\Controllers\SaksiCtrl;
use App\Http\Controllers\SaksiMonitoringController;
use App\Http\Controllers\SurveyCtrl;
use App\Http\Controllers\VariableCtrl;
use App\Http\Controllers\KecamatanCtrl;
use App\Http\Controllers\SuaraCtrl;
use App\Http\Controllers\CalegController;



/*
//Route Galery API
// Route::get('getGalery', [GaleryCtrl::class, 'index']);

// // Route::login('relawanLogin', [UserCtrl::class, 'login']);
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("requestInquery", [ApiController::class, "requestInquery"]);
Route::get("getPaymentMethod", [ApiController::class, "getPaymentMethod"]);
Route::post("requestCallback", [ApiController::class, "paymentCallback"]);

Route::post("referalCheck", [ApiController::class, "referalCheck"]);
Route::post("register", [ApiController::class, "register"]);
Route::post("login", [ApiController::class, "login"]);

// Route::get("getKabupaten", [ApiController::class, "getKabupaten"]);
// Route::get("getKecamatan", [ApiController::class, "getKecamatan"]);
Route::get("getDesa", [ApiController::class, "getDesa"]);

//Route Caleg API
Route::post("getCaleg", [CalegCtrl::class, "index",]);
Route::post('postCaleg', [CalegCtrl::class, "createCaleg"]);
Route::post('updateCaleg/{caleg:id}', [CalegCtrl::class, "updateCaleg"]);
Route::post('deleteCaleg/{caleg:id}', [CalegCtrl::class, "deleteCaleg"]);

//Route Program API
Route::get('getProgram', [ProgramCtrl::class, 'index']);
Route::post('postProgram', [ProgramCtrl::class, 'store']);
Route::post('updateProgram/{program:id}', [ProgramCtrl::class, 'update']);
Route::post('deleteProgram/{program:id}', [ProgramCtrl::class, 'destroy']);

//Route DPT API
Route::get('getDPT', [DptCtrl::class, 'index']);
// Route::get('dptRegion', [DptCtrl::class, 'callRegion']);

//Route Survey API
Route::get('getSurvey', [SurveyCtrl::class, 'getSurvey']);
Route::post('postHasil', [HasilSurveyCtrl::class, 'store']);


//Route Variable API
Route::get('getVariabel', [VariableCtrl::class, 'getVariabel']);
Route::post('postVariabel', [VariableCtrl::class, 'store']);
Route::post('updateVariabel/{variabel:id}', [VariableCtrl::class, 'update']);
Route::post('deleteVariabel/{variabel:id}', [VariableCtrl::class, 'destroy']);

//Route Kecamatan API
Route::get('getKecamatan', [KecamatanCtrl::class, 'getKecamatan']);
Route::get('getKecamatan-2', [KecamatanCtrl::class, 'getKecamatan2']);
Route::post('postKecamatan', [KecamatanCtrl::class, 'store']);
Route::post('updateKecamatan/{kecamatan:id_kecamatan}', [KecamatanCtrl::class, 'update']);
Route::post('deleteKecamatan/{kecamatan:id_kecamatan}', [KecamatanCtrl::class, 'destroy']);

//Route Daftar Isu API
Route::get('getIsu', [IsuCtrl::class, 'getIsu']);
Route::post('postIsu', [IsuCtrl::class, 'store']);

//Route Kabupaten API
Route::get('getKabupaten', [KabupatenCtrl::class, 'getKabupaten']);
Route::get('getKabupaten-2', [KabupatenCtrl::class, 'getKabupaten2']);
Route::get('getProvinsi', [ApiController::class, 'getProvinsi']);

//Route User API
Route::get('getTps', [UserCtrl::class, 'getTps']);
Route::get('getRelawan', [UserCtrl::class, 'getRelawan']);
Route::get('qrCode', [UserCtrl::class, 'getQR']);
Route::post("updateLoyal/{relawan:id}", [UserCtrl::class, 'updateRelawan']);
Route::post("updateProfile/{relawan:id}", [UserCtrl::class, 'addProfile']);
Route::get('getProfile', [UserCtrl::class, 'getProfile']);

//Route Saksi API
Route::post('postSaksi', [SaksiCtrl::class, 'postSaksi']);

//Route Simpatisan API
Route::get('getSimpatisan', [UserCtrl::class, 'getSimpatisan']);

//Route Medsos API
Route::get('getMedsos', [ApiController::class, 'getMedsos']);

//Route News API
Route::get('getNews', [ApiController::class, 'getberita']);

//Route SUara Api
Route::post('postSuara', [SuaraCtrl::class, 'store']);

//Route Simpatisa Api
Route::get('getSimpatisan', [ApiController::class, 'getSimpatisan']);

//Route Agenda Api
Route::get('getAgenda', [AgendaCtrl::class, 'index']);
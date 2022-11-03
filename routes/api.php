<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\CalegCtrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DPTController;
use App\Http\Controllers\DptCtrl;
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
use App\Http\Controllers\TeamController;
use App\Http\Controllers\CalegController;
use App\Http\Controllers\SuaraCtrl;

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

// Route::get('/getChart', [DPTController::class, 'getChart']);
// Route::get("/getChartDesa", [SaksiMonitoringController::class, "fetch"]);


Route::post("requestInquery", [ApiController::class, "requestInquery"]);
Route::get("getPaymentMethod", [ApiController::class, "getPaymentMethod"]);

Route::post("register", [ApiController::class, "register"]);
Route::post("login", [ApiController::class, "login"]);

// Route::get("getKabupaten", [ApiController::class, "getKabupaten"]);
// Route::get("getKecamatan", [ApiController::class, "getKecamatan"]);
Route::get("getDesa", [ApiController::class, "getDesa"]);

// Diagram Data
Route::post('/getChart', [DPTController::class, 'getChart']);
Route::post("/getChartDesa", [SaksiMonitoringController::class, "fetch"]);
Route::post("/getChartRelawan", [RelawanController::class, "fetch"]);
Route::post("/getChartSuara", [CalegController::class, "fetch"]);
Route::post("/getChartUpline", [TeamController::class, "fetch"]);

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
Route::post('postSurvey', [SurveyCtrl::class, 'store']);
Route::post('updateSurvey/{survey:id}', [SurveyCtrl::class, 'update']);
Route::post('deleteSurvey/{survey:id}', [SurveyCtrl::class, 'destroy']);

//Route Variable API
Route::get('getVariabel', [VariableCtrl::class, 'getVariabel']);
Route::post('postVariabel', [VariableCtrl::class, 'store']);
Route::post('updateVariabel/{variabel:id}', [VariableCtrl::class, 'update']);
Route::post('deleteVariabel/{variabel:id}', [VariableCtrl::class, 'destroy']);

//Route Kecamatan API
Route::get('getKecamatan', [KecamatanCtrl::class, 'getKecamatan']);
Route::post('postKecamatan', [KecamatanCtrl::class, 'store']);
Route::post('updateKecamatan/{kecamatan:id_kecamatan}', [KecamatanCtrl::class, 'update']);
Route::post('deleteKecamatan/{kecamatan:id_kecamatan}', [KecamatanCtrl::class, 'destroy']);

//Route Daftar Isu API
Route::get('getIsu', [IsuCtrl::class, 'getIsu']);
Route::post('postIsu', [IsuCtrl::class, 'store']);

//Route Kabupaten API
Route::get('getKabupaten', [KabupatenCtrl::class, 'getKabupaten']);

//Route User API
Route::get('getRelawan', [UserCtrl::class, 'index']);

//Route Saksi API
Route::post('postSaksi', [SaksiCtrl::class, 'postSaksi']);

//Route Simpatisan API
Route::get('getSimpatisan', [UserCtrl::class, 'getSimpatisan']);

//Route Medsos API
Route::get('getMedsos', [ApiController::class, 'getMedsos']);

Route::post('postSuara', [SuaraCtrl::class, 'store']);
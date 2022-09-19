<?php


use App\Http\Controllers\ApiController;
use App\Http\Controllers\CalegCtrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DPTController;
use App\Http\Controllers\ProgramCtrl;
use App\Http\Controllers\RelawanController;
use App\Http\Controllers\SaksiMonitoringController;
use App\Models\Program;

/*
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
Route::get('/getChart', [DPTController::class, 'getChart']);
Route::get("/getChartDesa", [SaksiMonitoringController::class, "fetch"]);


Route::post("requestInquery", [ApiController::class, "requestInquery"]);
Route::get("getPaymentMethod", [ApiController::class, "getPaymentMethod"]);
Route::get("getGalery", [ApiController::class, "getGalery"]);
Route::get("getVariabel", [ApiController::class, "getVariabel"]);
Route::get("getSurvey", [ApiController::class, "getSurvey"]);
Route::post("login", [ApiController::class, "login"]);

Route::get("getKabupaten", [ApiController::class, "getKabupaten"]);
Route::get("getKecamatan", [ApiController::class, "getKecamatan"]);
Route::get("getDesa", [ApiController::class, "getDesa"]);

// Diagram Data
Route::get('/getChart/{id}', [DPTController::class, 'getChart']);
Route::get("/getChartDesa/{id}", [SaksiMonitoringController::class, "fetch"]);
Route::get("/getChartRelawan/{id}", [RelawanController::class, "fetch"]);

//Route Caleg API
Route::get("getCaleg", [CalegCtrl::class, "index",]);
Route::post('postCaleg', [CalegCtrl::class, "createCaleg"]);
Route::post('updateCaleg/{caleg:id}', [CalegCtrl::class, "updateCaleg"]);
Route::post('deleteCaleg/{caleg:id}', [CalegCtrl::class, "deleteCaleg"]);

//Route Program API
Route::get('getProgram', [ProgramCtrl::class, 'index']);
Route::post('postProgram', [ProgramCtrl::class, 'store']);
Route::post('updateProgram/{program:id}', [ProgramCtrl::class, 'update']);
Route::post('deleteProgram/{program:id}', [ProgramCtrl::class, 'destroy']);

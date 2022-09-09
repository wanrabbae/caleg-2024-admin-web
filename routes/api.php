<?php


use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DPTController;
use App\Http\Controllers\RelawanController;
use App\Http\Controllers\SaksiMonitoringController;


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

Route::get("getCaleg", [ApiController::class, "getCaleg",]);
Route::get("getProgram", [ApiController::class, "getProgram",]);
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
Route::get("/getChartDesa", [SaksiMonitoringController::class, "fetch"]);
Route::get("/getChartRelawan", [RelawanController::class, "fetch"]);

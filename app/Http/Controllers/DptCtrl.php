<?php

namespace App\Http\Controllers;

use App\Models\Rk_pemilih;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class DptCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Rk_pemilih::orderBy('id_pemilih', 'ASC')->get();
        if(!Rk_pemilih::where("nik", request("nik"))->first()){
            return response()->json(['message' => 0], 500 );
        }
        return response()->json(["message" => 1, "data" => $data], 200);
    }

//    public function checkDpt(Request $request)
//    {
//         // $check = Rk_pemilih::where("nik", $request->nik)->first();
//         if(!Rk_pemilih::where("nik", request("nik"))->first()){
//             return response()->json(['message' => "Error, There no Relawan with NIK $request->nik"], 500 );
//         }
//         return response()->json(["message" => "Success, This NIK has data"]);
//    }
}

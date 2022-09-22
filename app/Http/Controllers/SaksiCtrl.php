<?php

namespace App\Http\Controllers;
use App\Models\Daftar_Saksi;
use App\Models\Relawan;
use Illuminate\Http\Request;

class SaksiCtrl extends Controller
{
   public function postSaksi(Request $request)
   {
        $data = $request->validate([
            "nama_relawan" => "required|max:255|unique:saksi,id_caleg",
            "id_caleg" => "required"
        ]);

        if(!Relawan::where("nama_relawan", $request->nama_relawan)->first()){
            return response()->json(['message' => "Error, There no Relawan with  $request->nama_relawan"], 400);
        }
        if(!Relawan::where("id_caleg", $request->id_caleg)->where("nama_relawan", $request->nama_relawan)->first()){
            return response()->json(['message' => "Error, There no Relawan with  $request->nama_relawan"], 400);
        }

        if (Daftar_Saksi::create($data)) {
            return response()->json(['message' => "Success Create Saksi with NIK $request->nama_relawan", 'data' => $data ], 201);
        }
        return response()->json(['message' => "Error, Can't Create Saksi with NIK $request->nama_relawan"], 200);
   }
}

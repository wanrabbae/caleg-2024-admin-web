<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
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
        $id_desa = Desa::find(request("id_desa"));
        $data = Rk_pemilih::where('nik', request("nik"))->get();
        if(!Rk_pemilih::where("nik", request("nik"))->get()){
            return response()->json(['message' => 0], 500 );
        }
        return response()->json(['message' => 1,'region' => Desa::with("kecamatan.kabupaten")->where("id_desa", $id_desa->id_desa)->get(), 'data_dpt' => $data], 200);
    }

    // public function callRegion(Request $request)
    // {
    //     $id_desa = Desa::find(request("id_desa"));

    //     return response()->json(Desa::with("kecamatan.kabupaten")->where("id_desa", $id_desa->id_desa)->get(), 200);
    // }
}

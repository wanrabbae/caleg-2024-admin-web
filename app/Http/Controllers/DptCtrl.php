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
        $data = Rk_pemilih::where('nik', request("nik"))->get();
        if(!Rk_pemilih::where("nik", request("nik"))->get()){
            return response()->json(['message' => 0], 500 );
        }
        return response()->json(["message" => 1, "data" => $data], 200);
    }

    public function callRegion(Request $request)
    {
        $rows =
        $dpt = Rk_pemilih::where('id_pemilih', $request->id_pemilih)->first();
        $desa = Desa::where('id_desa', $rows->id_desa)->first();
        $kecamatan = Kecamatan::where('id_kecamatan', $desa->id_kecamatan)->first();
        $kabupaten = Kabupaten::where('id_kabupaten', $kecamatan->id_kabupaten)->first();
        $dpt['desa'] = $desa;
        $dpt['kecamatan'] = $kecamatan;
        $dpt['kabupaten'] = $kabupaten;

        return response()->json(['message' => 1, 'data' => $dpt], 200, );
    }
}

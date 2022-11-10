<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Relawan;
use App\Models\Monitoring_Saksi;
use App\Models\Suara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SuaraCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Monitoring_Saksi::where("id_relawan", $request->id_relawan)->where("tps", $request->tps)->first()) {
            return response()->json(["message" => "Gagal"], 403);
        }

        $data = $request->validate([
            "id_relawan" => "required",
            "suara_caleg" => "required",
            "suara_partai" => "required",
            "bukti" => "required|image",
            "tps" => "required",
            "id_caleg" => "required"
        ]);

        $relawan = Relawan::find($data["id_relawan"]);
        $data["bukti"] = $request->file("bukti")->store("/images", "public_path");
        $data["id_desa"] = $relawan->id_desa;
        $data["id_partai"] = $relawan->caleg->id_partai;

        if (Monitoring_Saksi::create($data)) {
            return response()->json(["message" => "Berhasil"], 200);
        }
        return response()->json(["message" => "Gagal"], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Suara  $suara
     * @return \Illuminate\Http\Response
     */
    public function show(Suara $suara)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suara  $suara
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suara $suara)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suara  $suara
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suara $suara)
    {
        //
    }
}

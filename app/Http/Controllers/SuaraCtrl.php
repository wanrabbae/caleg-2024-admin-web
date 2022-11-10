<?php

namespace App\Http\Controllers;

use DB;
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
        $validator = Validator::make($request->all(), [
            "id_relawan" => "required",
            "suara_caleg" => "required",
            "suara_partai" => "required"
        ], [
            "id_relawan.required" => "Id Relawan Harus diisi !!",
            "suara_caleg.required" => "Suara Caleg Harus diisi !!",
            "suara_partai.required" => "Suara Partai Harus diisi !!",
        ]);

        if($validator->fails()){
            return response()->json(["message" => $validator->errors()], 400);
        }

        $fileName = $request->file('bukti')->getClientOriginalName();

        $data = Suara::insert([
            "id_relawan" => request("id_relawan"),
            "total_suara" =>request("suara_caleg") + request("suara_partai"),
            "suara_caleg" => request("suara_caleg"),
            "suara_partai" => request("suara_partai"),
            "bukti" => $request->file('bukti')->storeAs("images", $fileName, "public_path")
        ]);

        return response()->json(["message" => "data suara berhasil dibuat", "data" => $data], 201);
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

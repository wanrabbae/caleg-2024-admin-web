<?php

namespace App\Http\Controllers;

use App\Models\Daftar_Isu;
use Illuminate\Http\Request;

class IsuCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIsu(Request $request)
    {
        $isu = Daftar_Isu::where("id_relawan", $request->id_relawan)->orderBy("id_isu", "ASC")->get();

        return response()->json(['message' => 'get Data Isu', 'data_isu' => $isu], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $images = [];
        foreach ($request->file("images") as $img) {
            error_log($img->getClientOriginalName());
        }
        return;
        $data = $request->validate([
            "id_caleg" => "required",
            "jenis" => "required",
            "dampak" => "required",
            "tanggal" => "required|date",
            "id_kecamatan" => "required",
            "id_relawan" => "required",
            "keterangan" => "required",
            "images" => "required|image|max:6000"
        ]);

        // return $data["images"]->getClientOriginalName();

       return $images;
        // $data["images"] = $request->file("images")->store("/images", "public_path");


        if (Daftar_Isu::create($data)) {
            // return back()->with("success", "Success Create New Issue");
            return response()->json(['message' => 1,'data_isu' => $data], 200);
        }
        // return back()->with("error", "Error When Creating New Issue");
        return response()->json(['message' => 0], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Daftar_Isu  $daftar_Isu
     * @return \Illuminate\Http\Response
     */
    public function show(Daftar_Isu $daftar_Isu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Daftar_Isu  $daftar_Isu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Daftar_Isu $daftar_Isu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Daftar_Isu  $daftar_Isu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Daftar_Isu $daftar_Isu)
    {
        //
    }
}

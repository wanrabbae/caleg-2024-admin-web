<?php

namespace App\Http\Controllers;

use App\Models\Daftar_Isu;
use Illuminate\Support\Facades\Validator;
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
        $data = $request->validate([
            "id_caleg" => "required",
            "judul_isu" => "required",
            "jenis" => "required",
            "dampak" => "required",
            "tanggal" => "required|date",
            "id_kecamatan" => "required",
            "id_relawan" => "required",
            "keterangan" => "required",
        ]);

        $imagesArr = [];


        foreach ($request->file("images") as $img) {
            $validator = Validator::make(["images" => $img], ["images" => "required|image|mimes:png,jpg,jpeg|max:6000"]);
            if (!$validator->fails()) {
                    $fileName = $img->getClientOriginalName();
                    $img->storeAs("image", $fileName, "public_path");
                    array_push($imagesArr, $fileName);
                }
        }
        // return $imagesArr;
        // $data[$imagesArr];
        $data["images"] = json_encode($imagesArr);

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

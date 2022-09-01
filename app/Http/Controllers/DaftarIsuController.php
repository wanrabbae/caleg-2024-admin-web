<?php

namespace App\Http\Controllers;

use App\Models\Daftar_Isu;
use Illuminate\Http\Request;

class DaftarIsuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("data.daftarIsu", [
            "title" => "Daftar Isu",
            "dataArr" => Daftar_Isu::all()
    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function show(Kecamatan $kecamatan, $id_kecamatan)
    {
        return response()->json(Kecamatan::find($id_kecamatan));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kecamatan $kecamatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Daftar_Isu $daftar_Isu)
    {
        // return $daftar_Isu;
        // if ($request->has("tanggapi")) {
        //     if (Daftar_Isu::where("id_isu", $daftar_Isu->id_isu)->update(["tanggapi" => date("Y-m-d")])) {
        //         return back()->with("success", "Berhasil Ditanggapi");
        //     }
        //     return back()->with("error", "Error, Gagal Menanggapi");
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kecamatan $kecamatan, $id_kecamatan)
    {
    }
}

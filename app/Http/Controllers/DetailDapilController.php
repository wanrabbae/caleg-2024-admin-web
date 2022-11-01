<?php

namespace App\Http\Controllers;

use App\Models\Detail_Dapil;
use App\Models\Provinsi;
use App\Models\Dapil;
use Illuminate\Http\Request;

class DetailDapilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("residences.detail", [
            "title" => "Detail Dapil",
            "dataArr" => Detail_Dapil::with("dapil")->get(),
            "provinsi" => Provinsi::all(),
            "dapil" => Dapil::all()
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
        $data = $request->validate([
            "id_dapil" => "required",
            "id_kabupaten" => "required",
            "id_provinsi" => "required"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Detail_Dapil  $detail_Dapil
     * @return \Illuminate\Http\Response
     */
    public function show(Detail_Dapil $detail_Dapil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Detail_Dapil  $detail_Dapil
     * @return \Illuminate\Http\Response
     */
    public function edit(Detail_Dapil $detail_Dapil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Detail_Dapil  $detail_Dapil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detail_Dapil $detail_Dapil)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Detail_Dapil  $detail_Dapil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Detail_Dapil $detail_Dapil)
    {
        //
    }
}

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
        $isu = Daftar_Isu::where();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

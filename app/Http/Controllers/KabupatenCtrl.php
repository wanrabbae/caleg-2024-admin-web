<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use Illuminate\Http\Request;

class KabupatenCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getKabupaten()
    {
        $kabupaten = Kabupaten::where('dapil', request('dapil'))->where('id_provinsi', request('id_provinsi'))->with("caleg")->orderBy('id_kabupaten', 'ASC')->get();

        return response()->json(['kabupaten' => $kabupaten]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getKabupaten2()
    {
        $data = Kabupaten::where('id_provinsi', request('id_provinsi'))->with('kecamatan')->orderBy('id_kabupaten', 'ASC')->get();
        
        return response()->json(['kabupaten' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kabupaten  $kabupaten
     * @return \Illuminate\Http\Response
     */
    public function show(Kabupaten $kabupaten)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kabupaten  $kabupaten
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kabupaten $kabupaten)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kabupaten  $kabupaten
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kabupaten $kabupaten)
    {
        //
    }
}

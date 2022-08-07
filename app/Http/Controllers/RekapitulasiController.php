<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class RekapitulasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('data.rekapitulasi',[
            'title' => 'Rekapitulasi Page',
            'data' => Desa::all(),
            'kecamatan' => Kecamatan::all()
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
            'nama_desa' => 'required|unique:desa',
            'type' => 'required|unique:desa',
            'dpt' => 'required|integer',
            'tps' => 'required|integer',
            'suara' => 'required|integer',
            'id_kecamatan' => 'required'
        ]);

        if(Desa::create($data)){
            return back()->with('success', "Success Create Data Rekapitulasi");
        }

        return back()->with('error', "Failed Create Data Rekapitulasi");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function show(Desa $desa, $id_desa)
    {
        return response()->json(Desa::find($id_desa));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function edit(Desa $desa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Desa $desa, $id_desa)
    {
        $data= $request->validate([
            'nama_desa' => 'required|unique:desa',
            'type' => 'required|max:100',
            'dpt' => 'required|integer',
            'tps' => 'required|integer',
            'suara' => 'required|integer',
            'id_kecamatan' => 'required'
        ]);

        if(Desa::where('id_desa', $id_desa)->update($data)){
            return redirect('/infoPolitik/rekapitulasi')->with('success', "Success Update Data Rekapitulasi Desa $desa->nama_desa");
        }

        return redirect('/infoPolitik/rekapitulasi')->with('error', "Failed Update Data Rekapitulasi Desa $desa->nama_desa");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Desa $desa, $id_desa)
    {
        if(Desa::where('id_desa', $id_desa)->delete()){
            return back()->with('success', "Success Deleting Data Rekapitulasi Desa $desa->nama_desa");
       }

       return back()->with('error', "Failed Deleting Data Rekapitulasi Desa $desa->nama_desa");
    }
}

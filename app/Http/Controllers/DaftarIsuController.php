<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
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
        return view('data.daftarIsu',[
            'title' => 'Daftar Isu Page',
            'data' => Kecamatan::all(),
            'datas' => Kabupaten::all()
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
        $data =  $request->validate([
            'nama_kecamatan' => 'required|unique:kecamatan',
            'wilayah' => 'required|unique:kecamatan',
            'id_kabupaten' => 'required'
        ]);

        if(Kecamatan::create($data)){
            return back()->with('success', "Success Create Data Daftar Isu");
        }

        return back()->with('error', "Failed Create Data Daftar Isu");
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
    public function update(Request $request, Kecamatan $kecamatan, $id_kecamatan)
    {
        $data = $request->validate([
            'nama_kecamatan' => 'required|unique:kecamatan',
            'wilayah' => 'required|unique:kecamatan',
            'id_kabupaten' => 'required',
        ]);

        if(Kecamatan::where('id_kecamatan', $id_kecamatan)->update($data)){
            return redirect('/infoPolitik/daftarIsu')->with('success', "Success Update Data Daftar Isu Kecamatan $kecamatan->nama_kecamatan");
        }

        return redirect('/infoPolitik/daftarIsu')->with('error', "Failed Update Data Daftar Isu Kecamatan $kecamatan->nama_kecamatan");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kecamatan $kecamatan, $id_kecamatan)
    {
       if(Kecamatan::where('id_kecamatan', $id_kecamatan)->delete()){
            return back()->with('success', "Success Deleting Daftar Isu Kecamatan $kecamatan->nama_kecamatan");
       }

       return back()->with('error', "Failed Deleting Daftar Isu Kecamatan $kecamatan->nama_kecamatan");
    }
}

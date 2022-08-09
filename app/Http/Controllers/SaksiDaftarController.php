<?php

namespace App\Http\Controllers;

use App\Models\Daftar_Saksi;
use Illuminate\Http\Request;

class SaksiDaftarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("saksi.daftar", [
            "title" => "Daftar Saksi",
            "dataArr" => Daftar_Saksi::all()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Daftar_Saksi  $daftar_Saksi
     * @return \Illuminate\Http\Response
     */
    public function show($nik)
    {
        return response()->json(Daftar_saksi::where("nik", $nik)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Daftar_Saksi  $daftar_Saksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Daftar_Saksi $daftar_Saksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Daftar_Saksi  $daftar_Saksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Daftar_Saksi $daftar_Saksi)
    {
        dd(Daftar_Saksi::where("nik", $daftar_Saksi->nik)->first(), $request->nik);
        $data = $request->validate([
            "nik" => "required|max:255|unique:saksi"
    ]);

        if (Daftar_Saksi::where("nik", $request->nik)->update($data)) {
            return redirect("/saksi/daftar")->with("success", "Success Update $request->nik");
        }

        return back()->with("error", "Error, Can't Update $request->nik");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Daftar_Saksi  $daftar_Saksi
     * @return \Illuminate\Http\Response
     */
    public function destroy($nik)
    {
        if (Daftar_Saksi::where("nik", $nik)->delete()) {
            return back()->with("success", "Success Delete Saksi");
        }

        return back()->with("error", "Error, Can't Delete Saksi");
    }
}

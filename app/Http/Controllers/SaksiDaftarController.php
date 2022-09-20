<?php

namespace App\Http\Controllers;

use App\Models\Daftar_Saksi;
use App\Models\Relawan;
use App\Models\Caleg;
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
            "dataArr" => auth("web")->check() ? Daftar_Saksi::all() : Daftar_Saksi::where("id_caleg", auth()->user()->id_caleg)->get(),
            "caleg" => Caleg::all()
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
        if (auth("caleg")->check()) {
            $request["id_caleg"] = auth()->user()->id_caleg;
        }

        $data = $request->validate([
            "nik" => "required|max:255|unique:saksi,id_caleg",
            "id_caleg" => "required"
    ]);

    if (auth("web")->check()) {  
        if (!Relawan::where("nik", $request->nik)->first()) {
            return back()->with("error", "Error, There no Relawan with NIK $request->nik");
        }
    } else {
        if (!Relawan::where("id_caleg", auth()->user()->id_caleg)->where("nik", $request->nik)->first()) {
            return back()->with("error", "Error, There no Relawan with NIK $request->nik");
        }
    }

    if (Daftar_Saksi::create($data)) {
        return redirect("/saksi/daftar")->with("success", "Success Create Saksi with NIK $request->nik");
    }

        return back()->with("error", "Error, Can't Create Saksi with NIK $request->nik");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Daftar_Saksi  $daftar_Saksi
     * @return \Illuminate\Http\Response
     */
    public function show($nik)
    {
        return response()->json(Relawan::where("nik", $nik)->first());
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
    public function update(Request $request, $nik)
    {
        if (auth("caleg")->check()) {
            $request["id_caleg"] = auth()->user()->id_caleg;
        }

        $data = $request->validate([
            "nik" => "required|max:255|unique:saksi,id_caleg",
            "id_caleg" => "required"
    ]);


    if (auth("web")->check()) {
        if (!Relawan::where("nik", $request->nik)->first()) {
            return back()->with("error", "Error, There no Relawan with NIK $request->nik");
        }
        if (Daftar_Saksi::where("nik", $nik)->update($data)) {
            return redirect("/saksi/daftar")->with("success", "Success Update $nik");
        }
            return back()->with("error", "Error, Can't Update $nik");
    } else {
        if (!Relawan::where("id_caleg", auth()->user()->id_caleg)->where("nik", $request->nik)->first()) {
            return back()->with("error", "Error, There no Relawan with NIK $request->nik");
        }
        if (Daftar_Saksi::where("id_caleg", auth()->user()->id_caleg)->where("nik", $nik)->update($data)) {
            return redirect("/saksi/daftar")->with("success", "Success Update $nik");
        }
            return back()->with("error", "Error, Can't Update $nik");
        }
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

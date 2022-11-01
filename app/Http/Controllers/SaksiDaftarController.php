<?php

namespace App\Http\Controllers;

use Helper;
use App\Models\Daftar_Saksi;
use App\Models\Relawan;
use App\Models\Caleg;
use App\Models\Hasil_Survey;
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
        if (Helper::RequestCheck(request()->all())) {
            return back()->with("error", "Karakter Ilegal Ditemukan");
        };

        return view("saksi.daftar", [
            "title" => "Daftar Saksi",
            "dataArr" => auth("web")->check() ? Daftar_Saksi::with("relawan")->search(request("search"))->paginate(request("paginate") ?? 10)->withQueryString() : Daftar_Saksi::with("relawan")->where("id_caleg", auth()->user()->id_caleg)->search(request("search"))->paginate(request("paginate") ?? 10)->withQueryString(),
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
     * @param  \App\Models\Daftar_Saksi  $daftar_Saksi
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
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
    public function update(Request $request, $id)
    {
        
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Daftar_Saksi  $daftar_Saksi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}

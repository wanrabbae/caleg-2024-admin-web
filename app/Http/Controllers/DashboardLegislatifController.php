<?php

namespace App\Http\Controllers;

use App\Models\Legislatif;
use Illuminate\Http\Request;

class DashboardLegislatifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("dashboard.legislatif.legislatif", [
            "title" => "Legislatif Page",
            "dataArr" => Legislatif::all()
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
            "nama_legislatif" => "required|max:255|unique:legislatif"
    ]);

        if (Legislatif::create($request->only('nama_legislatif'))) {
            return back()->with("success", "Success Create New Legislatif");
        }
        
        return back()->with("error", "Error, Can't Create New Legislatif");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Legislatif  $legislatif
     * @return \Illuminate\Http\Response
     */
    public function show(Legislatif $legislatif)
    {
        return response()->json($legislatif);   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Legislatif  $legislatif
     * @return \Illuminate\Http\Response
     */
    public function edit(Legislatif $legislatif)
    {
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Legislatif  $legislatif
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Legislatif $legislatif)
    {
        $rules = [];

        if ($request->nama_legislatif !== $legislatif->nama_legislatif) {
            $rules["nama_legislatif"] = "required|max:255|unique:legislatif";
        }

        $data = $request->validate($rules);

        if (Legislatif::where("id_legislatif", $legislatif->id_legislatif)->update($data)) {
            return redirect("/dashboard/legislatif")->with("success", "Success Update $legislatif->nama_legislatif");
        }

        return back()->with("error", "Error, Can't Update $legislatif->nama_legislatif");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Legislatif  $legislatif
     * @return \Illuminate\Http\Response
     */
    public function destroy(Legislatif $legislatif)
    {
        if (Legislatif::destroy($legislatif->id_legislatif)) {
            return back()->with("success", "Success Delete $legislatif->nama_legislatif Legislatif");
        }

        return back()->with("error", "Error, Can't Delete $legislatif->nama_legislatif Legislatif");
    }
}

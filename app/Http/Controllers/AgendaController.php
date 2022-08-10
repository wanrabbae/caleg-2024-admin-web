<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("rekap.dpt_manual", [
            "title" => "Halaman Agenda",
            "dataArr" => Agenda::all()
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
            "nama_agenda" => "max:255|required|unique:agenda",
            "tanggal" => "required",
            "jam" => "required",
            "lokasi" => "required|max:255"
    ]);

        $data["id_caleg"] = auth()->user()->id_users;
    
        if (Agenda::create($data)) {
            return back()->with("success", "Success Create New Agenda");
        }
        return back()->with("error", "Error, Can't Create New Agenda");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function show(Agenda $agenda)
    {
        return response()->json($agenda->makeHidden(["id_agenda", "id_caleg"]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function edit(Agenda $agenda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agenda $agenda)
    {
        $rules = [
            "tanggal" => "required",
            "jam" => "required",
            "lokasi" => "required|max:255"
        ];

        if ($request->nama_agenda != $agenda->nama_agenda) {
            $rules["nama_agenda"] = "max:255|required|unique:agenda";
        }

        $data = $request->validate($rules);

        $data["id_caleg"] = auth()->user()->id_users;
        
        if (Agenda::where("id_agenda", $agenda->id_agenda)->update($data)) {
            return back()->with("success", "Success Edit $agenda->nama_agenda Agenda");
        }
        return back()->with("error", "Error, Can't Edit $agenda->nama_agenda Agenda");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agenda $agenda)
    {
        if (Agenda::destroy($agenda->id_agenda)) {
            return back()->with("success", "Success delete $agenda->nama_agenda Agenda");
        }
        return back()->with("error", "Error, Can't delete $agenda->nama_agenda Agenda");
    }
}

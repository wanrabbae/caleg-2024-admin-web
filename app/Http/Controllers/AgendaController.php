<?php

namespace App\Http\Controllers;

use App\Models\Caleg;
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
        return view("rekap.agenda", [
            "title" => "Halaman Agenda",
            "dataArr" => auth("web")->check() ? Agenda::all() : Agenda::where("id_caleg", auth()->user()->id_caleg)->get(),
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
        // dd($request);
        $data = $request->validate([
            "nama_agenda" => "max:255|required",
            "tanggal" => "required",
            "jam" => "required",
            "lokasi" => "required|max:255",
            "id_caleg" => "required",
            "jenis" => "required"
        ]);

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
        if (auth("caleg")->check()) {
            $request["id_caleg"] = auth()->user()->id_caleg;
        }

        $rules = [
            "nama_agenda" => "max:255|required",
            "tanggal" => "required",
            "jam" => "required",
            "lokasi" => "required|max:255",
            "id_caleg" => "required"
        ];

        if($request->has('status')){
            if(Agenda::where('id_agenda', $agenda->id_agenda)->update(["status" => $request->status])){
                return back()->with('success', 'Success Updating Status');
            }

            return back()->with('error', 'Failed Updating Status');
        }

        if($request->has('jenis')){
            if(Agenda::where('id_agenda', $agenda->id_agenda)->update(["jenis" => $request->jenis])){
                return back()->with('success', 'Success Updating Jenis Agenda');
            }
            return back()->with('error', 'Failed Updating jenis Agenda');
        }

        $data = $request->validate($rules);

        if (Agenda::find($agenda->id_agenda)->update($data)) {
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

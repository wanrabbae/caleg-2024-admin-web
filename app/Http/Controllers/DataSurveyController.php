<?php

namespace App\Http\Controllers;

use App\Models\Caleg;
use App\Models\Survey;
use App\Models\Variabel;
use Illuminate\Http\Request;

class DataSurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('data.survey', [
            'title' => 'Data Survey Page',
            'data' => Survey::all(),
            'caleg' => Caleg::all(),
            'variabel' => Variabel::all()
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
            'nama_survey' => 'required|unique:survey',
            'mulai_tanggal' => 'required|date',
            'sampai_tanggal' => 'required|date',
            'id_caleg' => 'required',
            'id_variabel' => 'required',
        ]);

        if(Survey::create($data)){
            return back()->with('success', 'Success Create Data Survey');
        }
        return back()->with('error', 'Failed Create Data Survey');
    }

    /**
     * Display the specified resource.
     *
     * @param   Survey $survey
     * @return \Illuminate\Http\Response
     */
    public function show(Survey $survey,$id_survey)
    {
    return response()->json(Survey::find($id_survey));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id_survey )
    {
        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_survey)
    {
        if(Survey::where('id_survey', $id_survey)->delete()){
            return back()->with('success', 'Success Deleting Data Survey');
        }
        return back()->with('error', 'failed Deleting Data Survey');
    }
}

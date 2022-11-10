<?php

namespace App\Http\Controllers;

use App\Models\Hasil_Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HasilSurveyCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data = $request->validate([
        //     "id_survey" => "required",
        //     "id_relawan" => "required",
        //     "jawaban" => "required"
        // ]);

        $data = $request->all();

        if(Hasil_Survey::insert($data)){
            return response()->json(["message" => "berhasil", "data" => $data], 200);
        }
        return response()->json(["message" => "gagal"], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hasil_Survey  $hasil_Survey
     * @return \Illuminate\Http\Response
     */
    public function show(Hasil_Survey $hasil_Survey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hasil_Survey  $hasil_Survey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hasil_Survey $hasil_Survey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hasil_Survey  $hasil_Survey
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hasil_Survey $hasil_Survey)
    {
        //
    }
}

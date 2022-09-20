<?php

namespace App\Http\Controllers;

use App\Models\Variabel;
use Illuminate\Http\Request;

class VariableCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getVariabel()
    {
        $variable = Variabel::orderBy("id_variabel", "ASC")->get();

        return response()->json(["variable" => $variable]);
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

        $rule = [
            'nama_variabel' => 'required|unique:variabel',
            "id_caleg" => "required"
        ];

        $data = $request->validate($rule);

        if(Variabel::create($data)){
            // return back()->with('success', 'Success Create Data Variable');
            return response()->json(['message' => 1, 'data' => $data], 201);
        }
        // return back()->with('success', 'Failed Create Data Variable');
        return response()->json(['message' => 0], 500, );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        if (auth("caleg")->check()) {
            $request["id_caleg"] = auth()->user()->id_caleg;
        }

       $rule = [];

        if ($request->nama_variable !== Variabel::find($id)->nama_variabel) {
            $rule["nama_variabel"] = "required|unique:variabel";
        }

       $data = $request->validate($rule);

       if(Variabel::find($id)->update($data)){
            // return redirect('/survey/HasilSurvey')->with('success', "Success Update Variabel $variabel->nama_variabel");
            return response()->json(['message' => 1, 'data' => $data], 200, );
       }
        //return redirect('/survey/HasilSurvey')->with('error', "Failed Update Variabel $variabel->nama_variabel");
        return response()->json(['message' => 0], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Variabel::where('id_variabel', $id)->delete()){
            // return back()->with('success', "Success Deleting Data Variable");
            return response()->json(['message' => 1], 200, );
        }
        // return back()->with('error', "Failed Deleting Data Variable");
        return response()->json(['message' => 0], 500);
    }
}

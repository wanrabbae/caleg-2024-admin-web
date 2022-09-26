<?php

namespace App\Http\Controllers;
use App\Models\Caleg;
use App\Models\Relawan;
use App\Models\Variabel;
use Illuminate\Http\Request;

class VariableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('data.variable', [
            'title' => 'Variable Survey Page',
            "caleg" => Caleg::all(),
            'data' => auth("web")->check() ? Variabel::all() : Variabel::with("caleg")->where("id_caleg", auth()->user()->id_caleg)->get()
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

        $rule = [
            'nama_variabel' => 'required|unique:variabel',
            "id_caleg" => "required"
        ];

        $data = $request->validate($rule);

        if(Variabel::create($data)){
            return back()->with('success', 'Success Create Data Variable');
        }

        return back()->with('success', 'Failed Create Data Variable');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Variabel  $variabel
     * @return \Illuminate\Http\Response
     */
    public function show(Variabel $variabel, $id_variabel)
    {
        return response()->json(Variabel::find($id_variabel));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Variabel  $variabel
     * @return \Illuminate\Http\Response
     */
    public function edit(Variabel $variabel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Variabel  $variabel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Variabel $variabel,$id_variabel)
    {
        if (auth("caleg")->check()) {
            $request["id_caleg"] = auth()->user()->id_caleg;
        }

       $rule = [];

        if ($request->nama_variable !== Variabel::find($id_variabel)->nama_variabel) {
            $rule["nama_variabel"] = "required|unique:variabel";
        }

       $data = $request->validate($rule);

       if(Variabel::find($id_variabel)->update($data)){
            return redirect('/survey/HasilSurvey')->with('success', "Success Update Variabel $variabel->nama_variabel");
       }
       return redirect('/survey/HasilSurvey')->with('error', "Failed Update Variabel $variabel->nama_variabel");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Variabel  $variabel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Variabel $variabel, $id_variabel)
    {
        if(Variabel::where('id_variabel', $id_variabel)->delete()){
            return back()->with('success', "Success Deleting Data Variable");
        }
        return back()->with('error', "Failed Deleting Data Variable");
    }
}

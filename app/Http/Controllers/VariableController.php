<?php

namespace App\Http\Controllers;

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
            'title' => 'Hasil Survey Page',
            'data' => Variabel::all()
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
    public function update(Request $request, Variabel $variabel)
    {
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Variabel  $variabel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Variabel $variabel)
    {
        //
    }
}

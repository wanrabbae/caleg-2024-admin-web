<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\RequestStack;

class ProgramCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $program = Program::where("id_caleg", $request->id_caleg)->orderBy('id_program', 'ASC')->get();

        return response()->json([
            "program" => $program,
        ],);
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
            "judul_program" => "required|max:255",
            "id_caleg" => "required",
            "deskripsi" => "required",
            "foto" => "image|max:2048|required"
        ]);

        $data["foto"] = $request->file("foto")->store("/images", "public_path");

        if (Program::create($data)) {
            // return back()->with("success", "Success Create New Program");
            return response()->json(['message' => 'Success Create New Program', 'data' => $data], 201);
        }
        return response()->json(['message' => 'Error When Creating New Program'], 500);
        // return back()->with("error", "Error, Can't Create New Program");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $program = Program::find($id);

        if (auth("caleg")->check()) {
            $request["id_caleg"] = auth()->user()->id_caleg;
        }

        $rules = [
            "deskripsi" => "required",
            "foto" => "image|max:2048",
            "id_caleg" => "required"
        ];

        if ($request->judul_program !== $program->judul_program) {
            $rules["judul_program"] = "required";
        }

        $data = $request->validate($rules);

        if ($request->hasFile("foto")) {
            File::delete($program->foto);
            $data["foto"] = $request->file("foto")->store("/images", "public_path");
        }

        if ($program->update($data)) {
            // return back()->with("success", "Success Update Program");
            return response()->json(['message' => 'Success Update Program', 'data' => $data ], 200 );
        }
        // return back()->with("error", "Error, Can't Update Program");
        return response()->json(['message' => "Error, Can't Update Program"], 400, );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $program = Program::find($id);

        if ($program->delete()) {
            File::delete($program->foto);
            // return back()->with("success", "Success Delete Program");
            return response()->json(['message' => 'Success Delete Program'], 200 );
        }
        // return back()->with("error", "Error, Can't Delete Program");
        return response()->json(['message' => "Error, Can't Delete Program"], 400 );

    }
}

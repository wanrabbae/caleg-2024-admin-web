<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SimpatisanController extends Controller
{
    public function index()
    {
        return view('rekap.simpatisan', [
            'program' => Program::all(),
            'title' => 'Program'
        ]);
    }

    public function show($id)
    {
        return response()->json(Program::find($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "judul_program" => "required|max:255",
            "deskripsi" => "required",
            "foto" => "image|max:2048|required"
        ]);

        $data["foto"] = $request->file("foto")->store("/image");
        $data["id_caleg"] = auth()->user()->id_users;

        if (Program::create($data)) {
            return back()->with("success", "Success Create New Program");
        }

        return back()->with("error", "Error, Can't Create New Program");
    }

    public function delete($id)
    {
        $program = Program::find($id);
        if ($program->delete()) {
            Storage::delete($program->foto);
            return back()->with("success", "Success Delete Program");
        }
        return back()->with("error", "Error, Can't Delete Program");
    }

    public function update(Request $request, $id)
    {
        $program = Program::find($id);
        $rules = [
            "deskripsi" => "required",
            "foto" => "image|max:2048"
        ];

        if ($request->judul_program !== $program->judul_program) {
            $rules["judul_program"] = "required";
        }
    
        $data = $request->validate($rules);

        if ($request->hasFile("foto")) {
            Storage::delete($program->foto);
            $data["foto"] = $request->file("foto")->store("/image");
        }

        if ($program->update($data)) {
            return back()->with("success", "Success Update Program");
        }
        return back()->with("error", "Error, Can't Update Program");
    }
}

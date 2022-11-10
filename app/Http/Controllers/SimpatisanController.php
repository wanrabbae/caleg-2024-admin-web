<?php

namespace App\Http\Controllers;

use Helper;
use App\Models\Program;
use App\Models\Caleg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SimpatisanController extends Controller
{
    public function index()
    {
        if (Helper::RequestCheck(request()->all())) {
            return back()->with("error", "Karakter Ilegal Ditemukan");
        };

        return view('rekap.simpatisan', [
            "program" => auth("web")->check() ? Program::search(request("search"))->paginate(request("paginate") ?? 10)->withQueryString() : Program::where("id_caleg", auth()->user()->id_caleg)->search(request("search"))->paginate(request("paginate") ?? 10)->withQueryString(),
            'title' => 'Program',
            "caleg" => Caleg::all(),
        ]);
    }

    public function show($id)
    {
        //
    }

    public function store(Request $request)
    {
        if ($request->has("getData") && $request->getData) {
            $data = Program::find($request->data);
            if (auth("caleg")->check()) {
                $this->authorize("all-caleg", $data);
            }
            return response()->json($data, 200);
        }

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
            return back()->with("success", "Success Create New Program");
        }

        return back()->with("error", "Error, Can't Create New Program");
    }

    public function delete($id)
    {
        $program = Program::find($id);
        
        if (auth("caleg")->check()) {
            $this->authorize("all-caleg", $program);
        }

        if ($program->delete()) {
            Storage::disk("public_path")->delete($program->foto);
            return back()->with("success", "Success Delete Program");
        }
        return back()->with("error", "Error, Can't Delete Program");
    }

    public function update(Request $request, $id)
    {
        $program = Program::find($id);

        if (auth("caleg")->check()) {
            $this->authorize("all-caleg", $program);
        }

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
            Storage::disk("public_path")->delete($program->foto);
            $data["foto"] = $request->file("foto")->store("/images", "public_path");
        }

        if ($program->update($data)) {
            return back()->with("success", "Success Update Program");
        }
        return back()->with("error", "Error, Can't Update Program");
    }
}

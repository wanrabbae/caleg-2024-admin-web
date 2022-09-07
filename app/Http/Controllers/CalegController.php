<?php

namespace App\Http\Controllers;

use App\Models\Caleg;
use App\Models\Legislatif;
use App\Models\Partai;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class CalegController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("caleg.index", [
            "title" => "Caleg Page",
            "dataArr" => Caleg::all(),
            "legislatif" => Legislatif::all(),
            "partai" => Partai::all()
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
            "nama_caleg" => "required|max:255",
            "nama_lengkap" => "required|max:255",
            "id_legislatif" => "required",
            "alamat" => "required|max:255",
            "no_hp" => "required|max:20|min:10|unique:caleg",
            "email" => "required|email:dns|max:100|unique:caleg",
            "id_partai" => "required",
            "aktif" => "required",
            "username" => "required|unique:caleg|max:30",
            "password" => "required|min:4",
            "foto" => "required|file|image|max:5120"
        ]);


        $data["foto"] = $request->file("foto")->store("/image");
        $data["password"] = bcrypt($data["password"]);

        if (Caleg::create($data)) {
            return back()->with("success", "Success Create New Caleg");
        }
        return back()->with("erorr", "Error When Creating New Caleg");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Caleg  $caleg
     * @return \Illuminate\Http\Response
     */
    public function show(Caleg $caleg)
    {
        return response()->json($caleg);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Caleg  $caleg
     * @return \Illuminate\Http\Response
     */
    public function edit(Caleg $caleg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Caleg  $caleg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Caleg $caleg)
    {
        $rules = [
            "nama_caleg" => "required|max:255",
            "nama_lengkap" => "required|max:255",
            "id_legislatif" => "required",
            "alamat" => "required|max:255",
            "id_partai" => "required",
            "aktif" => "required",
            "foto" => "file|image|max:5120"
        ];

        if ($request->no_hp !== $caleg->no_hp) {
            $rules["no_hp"] = "required|max:20|min:10|unique:caleg";
        }

        if ($request->email !== $caleg->email) {
            $rules["email"] = "required|email:dns|max:100|unique:caleg";
        }

        if ($request->username !== $caleg->username) {
            $rules["username"] = "required|unique:caleg|max:30";
        }

        if ($request->password) {
            $rules["password"] = "min:4|max:255|required";
        }
        
        $data = $request->validate($rules);

        if ($request->has("foto")) {
            if (Storage::exists($caleg->foto)) {
                Storage::delete($caleg->foto);
            }
            $data["foto"] = $request->file("foto")->store("/image");
        }
        
        if ($request->password) {
            $data["password"] = bcrypt($request->password);
        }

        if (Caleg::find($caleg->id_caleg)->update($data)) {
            return back()->with("success", "Success Update Caleg");
        }
        return back()->with("erorr", "Error When Updating Caleg");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Caleg  $caleg
     * @return \Illuminate\Http\Response
     */
    public function destroy(Caleg $caleg)
    {
        if (Caleg::destroy($caleg->id_caleg)) {
            Storage::delete($caleg->foto);
            return back()->with("success", "Success Delete $caleg->nama_caleg");
        }
        return back()->with("error", "Error When Deleting $caleg->nama_caleg Caleg");
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Caleg;
use App\Models\Partai;
use App\Models\Legislatif;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("setting.index", [
            "title" => "Setting Profile",
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Caleg  $caleg
     * @return \Illuminate\Http\Response
     */
    public function show(Caleg $caleg)
    {
        //
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
    public function update(Request $request, $id)
    {
        if (auth("caleg")->check()) {
        $caleg = Caleg::find($id);
        $rules = [
            "nama_caleg" => "required|max:255",
            "nama_lengkap" => "required|max:255",
            "id_legislatif" => "required",
            "alamat" => "required|max:255",
            "id_partai" => "required",
            "foto" => "file|image|max:5120"
        ];


        if ($request->no_hp != $caleg->no_hp) {
            $rules["no_hp"] = "required|max:20|min:10|unique:caleg";
        }

        if ($request->email != $caleg->email) {
            $rules["email"] = "required|email|max:100|unique:caleg";
        }

        if ($request->username != $caleg->username) {
            $rules["username"] = "required|unique:caleg|max:30";
        }

        if ($request->password) {
            $rules["password"] = "min:4|max:255|required";
        }

        $data = $request->validate($rules);

        if ($request->has("foto")) {
            if (File::exists($caleg->foto)) {
                File::delete($caleg->foto);
            }
            $data["foto"] = $request->file("foto")->store("/images", "public_path");
        }
        
        if ($request->password) {
            $data["password"] = bcrypt($request->password);
        }

        if (Caleg::find($caleg->id_caleg)->update($data)) {
            return back()->with("success", "Success Update Profile");
        }
        return back()->with("erorr", "Error When Updating Profile");

        } else {

        $user = User::find($id);
        $rules = [
            "nama_lengkap" => "required|max:255",
            "foto_user" => "file|image|max:5120"
        ];


        if ($request->no_telp != $user->no_telp) {
            $rules["no_telp"] = "required|max:20|min:10|unique:users";
        }

        if ($request->email != $user->email) {
            $rules["email"] = "required|email|max:100|unique:users";
        }

        if ($request->username != $user->username) {
            $rules["username"] = "required|unique:users|max:30";
        }

        if ($request->password) {
            $rules["password"] = "min:4|max:255|required";
        }

        $data = $request->validate($rules);

        if ($request->has("foto_user")) {
            if (File::exists($user->foto_user)) {
                File::delete($user->foto_user);
            }
            $data["foto_user"] = $request->file("foto_user")->store("/images", "public_path");
        }
        
        if ($request->password) {
            $data["password"] = bcrypt($request->password);
        }

        if (User::find($user->id_users)->update($data)) {
            return back()->with("success", "Success Update Profile");
        }
        return back()->with("erorr", "Error When Updating Profile");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Caleg  $caleg
     * @return \Illuminate\Http\Response
     */
    public function destroy(Caleg $caleg)
    {
        //
    }
}

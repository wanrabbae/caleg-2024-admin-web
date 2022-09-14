<?php

namespace App\Http\Controllers;

use App\Models\Caleg;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function index() {
        $data = request("user") == "caleg" ? Caleg::where("reset_token", request("token"))->first() : User::where("reset_token", request("token"))->first();
        if (request("token") != $data->reset_token) {
            return redirect("login")->with("error", "Token Tidak Sama!");
        }

        $data["user"] = request("user");
        
        return view("mail.reset", [
            "data" => $data
        ]);
    }

    public function update(Request $request) {
        $data = $request->validate([
            "email" => "required",
            "password" => "required|min:4|max:255"
        ]);

        $data["password"] = bcrypt($data["password"]);

        $user = $request->user == "caleg" ? Caleg::where("email", $data["email"])->update(["password" => $data["password"], "reset_token" => Str::random(60)]) : User::where("email", $data["email"])->update(["password" => $data["password"], "reset_token" => Str::random(60)]);

        if ($user) {
            return redirect($request->user == "admin" ? "administrator" : "login")->with("success", "Berhasil Mengubah Pasword, Silahkan Login");
        }
        
        return redirect($request->user == "admin" ? "administrator" : "login")->with("error", "Error Saat Mengubah Password");
    }
}

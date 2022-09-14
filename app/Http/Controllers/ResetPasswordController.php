<?php

namespace App\Http\Controllers;

use App\Models\Caleg;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function index() {
        $caleg = Caleg::where("reset_token", request("token"))->first();
        if (request("token") != $caleg->reset_token) {
            return redirect("login")->with("error", "Token Tidak Sama!");
        }
        
        return view("mail.reset", [
            "data" => $caleg
        ]);
    }

    public function update(Request $request) {
        $data = $request->validate([
            "email" => "required",
            "password" => "required|min:4|max:255"
        ]);

        $data["password"] = bcrypt($data["password"]);

        if (Caleg::where("email", $data["email"])->update(["password" => $data["password"]])) {
            return redirect("login")->with("success", "Berhasil Mengubah Pasword, Silahkan Login");
        }
        return redirect("login")->with("error", "Error Saat Mengubah Password");
    }
}

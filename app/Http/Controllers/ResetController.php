<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\Models\Caleg;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class ResetController extends Controller
{
    public function index() {
        return view("mail.index");
    }

    public function send(Request $request) {    
        $request->validate([
            "email" => "required|email"
        ]);

        $account = "";
        
        if (Caleg::where("email", $request->email)->first()) {
            Caleg::where("email", $request->email)->update(["reset_token" => Str::random(60)]);
            $account = Caleg::where("email", $request->email)->first();
            $account["user"] = "caleg";
        }
   
        if (User::where("email", $request->email)->first()) {
            User::where("email", $request->email)->update(["reset_token" => Str::random(60)]);
            $account = User::where("email", $request->email)->first();
            $account["user"] = "admin";
        }

        if (!$account) {
            return back()->with("error", "Akun Tidak Ditemukan!");
        }

        Mail::to($request->email)->send(new ResetPassword($account));
        
        return redirect("/login")->with("success", "Berhasil Mengirimkan Link Ke Email Anda");
    }
}

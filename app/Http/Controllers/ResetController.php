<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\Models\Caleg;
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

        if (!Caleg::where("email", $request->email)->first()) {
            return back()->with("error", "Email tidak ditemukan");
        }

        Mail::to($request->email)->send(new ResetPassword(Caleg::where("email", $request->email)->first()));
        return back()->with("success", "Berhasil Mengirimkan Link Ke Email Anda");
    }

    public function reset() {
        return view("mail.reset", [
            ""
        ]);
    }
}

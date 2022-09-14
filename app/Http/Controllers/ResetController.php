<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
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

        Mail::to($request->email)->send(new ResetPassword());
        return back()->with("success", "Berhasil Mengirimkan Link Ke Email Anda");
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Relawan;
use App\Mail\MailBlas;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class EmailBlasController extends Controller
{
    public function index()
    {
        return view('promotions.email', [
            'relawan' => auth("web")->check() ? Relawan::all() : Relawan::with("desa.kecamatan")->where("id_caleg", auth()->user()->id_caleg)->get(),
            'title' => 'Email Blas'
        ]);
    }

    public function send(Request $request) {
        $request->validate([
            "email" => "required",
            "pesan" => "required"
    ]);

    foreach (explode(",", $request->email[0]) as $email) {
        Mail::to($email)->send(new MailBlas($request->pesan));
    };
    
    return back();

    }

    public function show($id) {
        return response()->json(Relawan::find($id), 200);
    }
}

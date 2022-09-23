<?php

namespace App\Http\Controllers;

use App\Models\Relawan;
use App\Mail\MailBlas;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
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

    Config::set('mail.mailers.blas.username', auth()->user()->config->email);
    Config::set('mail.mailers.blas.password', auth()->user()->config->password);
    Config::set('mail.mailers.blas.from.address', auth()->user()->config->email);
    Config::set('mail.mailers.blas.from.name', auth()->user()->nama_caleg);


    foreach (explode(",", $request->email[0]) as $email) {
        if (!Mail::mailer("blas")->to($email)->send(new MailBlas($request->pesan))) {
            return back()->with("error", "Gagal Mengirimkan Pesan");
        }
    };
    return back()->with("success", "Berhasil Mengirimkan Pesan");
    }

    public function show($id) {
        return response()->json(Relawan::find($id), 200);
    }
}

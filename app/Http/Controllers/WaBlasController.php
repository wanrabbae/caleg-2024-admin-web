<?php

namespace App\Http\Controllers;

use App\Models\Relawan;
use Illuminate\Http\Request;

class WaBlasController extends Controller
{
    public function index()
    {
        return view('promotions.wa', [
            'relawan' => auth("web")->check() ? Relawan::with(["desa.kecamatan"])->get() : Relawan::with(["desa.kecamatan"])->where("id_caleg", auth()->user()->id_caleg)->get(),
            'title' => 'WhatsApp Blas'
        ]);
    }

    public function send(Request $request) {
        $request->validate([
            "no_hp" => "required",
            "pesan" => "required",
        ]);

        foreach (explode(",", $request->no_hp[0]) as $nomor) {
        $api_key   = auth()->user()->config->API_KEY; // API KEY Anda
        $id_device = auth()->user()->config->device_id; // ID DEVICE yang di SCAN (Sebagai pengirim)
        $url   = 'https://api.watsap.id/send-message'; // URL API
        $pesan = $request->pesan; // Pesan Yang Dikirim

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);  
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 0); // batas waktu response
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_POST, 1);

        $data_post = [
        'id_device' => $id_device,
        'api-key' => $api_key,
        "no_hp" => $nomor,
        'pesan'   => $pesan
        ];
            
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data_post));
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $response = curl_exec($curl);
        curl_close($curl);
    }

    $check = json_decode($response, true)["kode"];

    if ($check != "200") {
        return back()->with("error", "Gagal Mengirimkan Pesan (Kode :" . $check . ")");
    }
    return back()->with("success", "Berhasil Mengirimkan Pesan");
    }

    public function show($id) {
        return response()->json(Relawan::find($id), 200);
    }
}

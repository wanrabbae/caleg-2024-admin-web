<?php

namespace App\Http\Controllers;

use App\Models\Rk_transaksi;
use App\Models\Rk_kategori;
use App\Models\Caleg;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request) {
        $data = $request->validate([
            "type" => "required",
            "start" => "required|date",
            "end" => "required|date",
        ]);

        $transaksi;
        
        if ($data["type"] == "jurnal") {
            $transaksi = Rk_transaksi::with("kategori")->whereBetween("tgl_transaksi", [
                $data["start"], $data["end"]
            ])->orderBy("tgl_transaksi")->get();
        };

        if ($data["type"] == "neraca") {
            $transaksi = Rk_kategori::all();
            foreach ($transaksi as $i => $item1) {
                $dataTransaksi = Rk_transaksi::where("id_kategori", $item1->id_kategori)->get();
                if ($dataTransaksi->count() != 0) {
                    foreach ($dataTransaksi as $item2) {
                        $transaksi[$i]["jumlah"] += $item2->jumlah;
                    }
                }
            }
        }

        return view("laporan." . $data["type"], [
            "transaksi" => $transaksi,
            "foto" => Caleg::with("partai")->find(auth()->user()->id_caleg)->partai->logo,
            "start" => $data["start"],
            "end" => $data["end"]
        ]);
    }
}

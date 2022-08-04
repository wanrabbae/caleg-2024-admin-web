<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class InfoPolitikController extends Controller
{
    public function daftarIsuView(){
        return view('data.daftarIsu');
    }

    public function rekapitulasiView(){
        return view('data.rekapitulasi');
    }

    public function beritaView(){
        return view('data.berita');
    }

}

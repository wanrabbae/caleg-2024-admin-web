<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\News;
use Illuminate\Http\Request;

class InfoPolitikController extends Controller
{
    public function daftarIsuView()
    {
        return view('data.daftarIsu', [
            'title' => 'Daftar Isu Page',
            'data' => Kecamatan::all()
        ]);
    }

    public function rekapitulasiView()
    {
        return view('data.rekapitulasi', [
            'title' => 'Rekapitulasi Page',
            'data' => Desa::all(),
        ]);
    }

    public function beritaView()
    {
        return view('data.berita', [
            'title' => 'News Page',
            'data' => News::all()
        ]);
    }
}

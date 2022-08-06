<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;

class DaftarIsuController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'nama_kecamatan' => 'required',
            'wilayah' => 'required|unique:kecamatan',
            'id_kabupaten' => 'required'
        ]);

        if(Kecamatan::create($data)){
            return back()->with('success', 'Success Create Daftar Isu');
        }

        return back()->with('error', 'Failed Create Daftar Isu');
    }

    public function delete($id_kecamatan){
        if(Kecamatan::where('id_kecamatan', $id_kecamatan)->delete()){
            return back()->with('success', "Success Delete Data Kecamatan");
        }

        return back()->with('Error', "Failed Delete Data Kecamatan");
    }
}

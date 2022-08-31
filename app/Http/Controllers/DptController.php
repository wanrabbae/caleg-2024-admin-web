<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Rk_pemilih;
use App\Models\Rk_pemilih_2;
use App\Models\User;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class DptController extends Controller
{
    public function index()
    {
        return view('rekap.dpt', [
            'title' => 'DPT / Pemilih Page',
            'datas' => Rk_pemilih::with('desa')->get(),
            'desas' => Desa::all(),
            'users' => User::all(),
        ]);
    }

    public function show($id)
    {
        return response()->json(Rk_pemilih::find($id));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'nik' => 'required|max:100|unique:rk_pemilih',
            'nama' => 'required|max:100',
            'tempat_lahir' => 'required|max:50',
            'tgl_lahir' => 'required|date',
            // 'tgl_data' => 'required|date|after_or_equal:today',
            'jk' => 'required|max:10',
            'tps' => 'required|integer',
            'id_desa' => 'required|max:4',
            'relawan' => 'required',
            'saksi' => 'required',
            'id_users' => 'required|max:4',
        ]);

        if (Rk_pemilih::create($data) && Rk_pemilih_2::create($data)) {
            return back()->with('success', 'Success Create New Data DPT');
        }
        return back()->with('error', "Error, Can't Create New Data DPT");
    }
    public function update(Request $request, $id)
    {
        $pemilih = Rk_pemilih::find($id);
        $data = $request->validate([
            'nik' => 'max:100',
            'nama' => 'max:100',
            'tempat_lahir' => 'max:50',
            'tgl_lahir' => 'date',
            // 'tgl_data' => 'date|after_or_equal:today',
            'jk' => 'max:10',
            'tps' => 'integer',
            'id_desa' => 'max:4',
            'relawan' => 'required',
            'saksi' => 'required',
            'id_users' => 'required',
        ]);

        if ($pemilih->update($data) && Rk_pemilih_2::find($id)->update($data)) {
            return back()->with('success', 'Success Update New Data DPT');
        }
        return back()->with('error', "Error, Can't Update New Data DPT");
    }
    public function delete($id)
    {
        if (Rk_pemilih::destroy($id) && Rk_pemilih_2::destroy($id)) {
            return back()->with('success', 'Success Delete Data DPT');
        }
        return back()->with('error', "Error, Can't Delete Data DPT");
    }

    public function getChart()
    {
        $pemilih = Rk_pemilih::with("desa.kecamatan")->get();
        $myArr = [];
        $found = true;

        foreach ($pemilih as $data) {
            for ($i = 0; $i < count($myArr); $i++) {
                if (in_array($data->desa->kecamatan->nama_kecamatan, $myArr[$i])) {
                    $data->jk == "Laki-Laki" ? $myArr[$i][1]++ : $myArr[$i][2]++;
                    $found = false;
                    break;
                }
            }
            if ($found) {
                array_push($myArr, [$data->desa->kecamatan->nama_kecamatan, $data->jk == "Laki-Laki" ? 1 : 0, $data->jk == "Perempuan" ? 1 : 0]);
            }
            $found = true;
        }

        return response()->json($myArr);
    }
}

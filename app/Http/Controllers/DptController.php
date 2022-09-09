<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Caleg;
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
            'datas' => auth("web")->check() ? Rk_pemilih::with(["caleg", "desa"])->get() : Rk_pemilih::with('desa')->where("id_caleg", auth()->user()->id_caleg)->get(),
            'desas' => Desa::all(),
            'users' => User::all(),
            "caleg" => Caleg::all()
        ]);
    }

    public function show($id)
    {
        return response()->json(Rk_pemilih::find($id));
    }
    public function store(Request $request)
    {
        if (auth("caleg")->check()) {
            $request["id_caleg"] = auth()->user()->id_caleg;
        }

        $data = $request->validate([
            'nik' => 'required|max:100|unique:rk_pemilih',
            "id_caleg" => "required",
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
        if (auth("caleg")->check()) {
            $request["id_caleg"] = auth()->user()->id_caleg;
        }
        
        $rules = [
            "id_caleg" => "required",
            'nama' => 'required|max:100',
            'tempat_lahir' => 'required|max:50',
            'tgl_lahir' => 'required|date',
            // 'tgl_data' => 'required|date|after_or_equal:today',
            'jk' => 'required|max:10',
            'tps' => 'required|integer',
            'id_desa' => 'required|max:4',
            'relawan' => 'required',
            'saksi' => 'required',
            'id_users' => 'required',
    ];

        if ($request->nik !== $pemilih->nik) {
            $rules["nik"] = "required|unique:rk_pemilih";
        }

        $data = $request->validate($rules);

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

    public function getChart($id)
    {
        $pemilih = $id == 0 ? Rk_pemilih::with("desa.kecamatan")->get() : Rk_pemilih::with("desa.kecamatan")->where("id_caleg", $id)->get();
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

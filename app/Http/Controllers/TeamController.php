<?php

namespace App\Http\Controllers;

use Helper;
use App\Models\Caleg;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Daftar_Saksi;
use App\Models\Relawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class TeamController extends Controller
{
    public function index()
    {
        if (Helper::RequestCheck(request()->all())) {
            return back()->with("error", "Karakter Ilegal Ditemukan");
        };

        return view('relawan.index', [
            'title' => 'Halaman Team Relawan',
            "data" => auth("web")->check() ? Relawan::with(["caleg", "desa.kecamatan"])->search(request("search"))->paginate(request("paginate") ?? 10)->withQueryString() : Relawan::with(['caleg', 'desa.kecamatan'])->where("id_caleg", auth()->user()->id_caleg)->search(request("search"))->paginate(request("paginate") ?? 10)->withQueryString(),
            'desa' => Desa::all(['id_desa', 'nama_desa']),
            'caleg' => Caleg::all(['id_caleg', 'nama_caleg']),
        ]);
    }

    public function report(Request $request)
    {
        $request->validate([
            "jabatan" => "required"
        ]);
    
        if (!$request->jabatan || !count($request->jabatan)) {
            return back()->with("error", "Pilih Salah Satu Kriteria Laporan");
    
        }

        return view("relawan.report", [
            "title" => "Laporan Relawan " . auth()->user()->nama_caleg,
            "foto" => Caleg::with("partai")->find(auth()->user()->id_caleg)->partai->logo,
            "data" => Relawan::with("desa.kecamatan")->where("id_caleg", auth()->user()->id_caleg)->whereJabatan($request->jabatan)->get()
        ]);

    }

    public function store(Request $request)
    {
        if ($request->has("getData") && $request->getData) {
            $data = Relawan::with("desa")->find($request->data);
            if (auth("caleg")->check()) {
                $this->authorize("all-caleg", $data);
            }
            return response()->json($data, 200);
        }
        
        if ($request->has("getTps") && $request->getTps) {
            $desa = Relawan::find($request->data);
            
            if (auth("caleg")->check()) {
                $this->authorize("all-caleg", $desa);
            }
            
            $tps = Desa::find($desa->id_desa);
            $relawanTps = Relawan::where("id_desa", $desa->id_desa)->where("id_caleg", $desa->id_caleg)->get(["tps"]);
            $checkTps = [];
            foreach ($relawanTps as $data) {
                if ($data->tps) {
                    array_push($checkTps, $data->tps);
                }
            }

            $checkTps = explode(",", implode(",", $checkTps));
            
            if ($tps->tps != 0) {
                $text = "";
                for ($i = 1; $i < $tps->tps + 1; $i++) {
                    if (!in_array($i, $checkTps)) {
                        $text .= "<div class='form-check'>
                            <input class='form-check-input' type='checkbox' name='tps[]' value='$i' id='tps$i'>
                            <label class='form-check-label' for='tps$i'>
                                $i
                                </label>
                                </div>";
                            }
                        }
                } else {
                $text = "<h6 class='text-center'> Tidak Ada TPS Pada Desa $tps->nama_desa</h6>";
            }
            return response()->json([$tps->nama_desa, $text], 200);
        }
        
        if (auth("caleg")->check()) {
            $request["id_caleg"] = auth()->user()->id_caleg;
        }
        $data = $request->validate([
            "nik" => "required|unique:relawan",
            "nama_relawan" => "required|max:255",
            "jk" => "required",
            "id_desa" => "required",
            "id_caleg" => "required",
            "status" => "required",
            "loyalis" => "required",
            "status" => "required",
            "no_hp" => "required|min:11",
            "email" => "required|email:dns|max:255|unique:relawan",
            "username" => "required|max:255|unique:relawan",
            "password" => "required|max:255|min:3",
            "foto_ktp" => "image|max:2048|required"
        ]);

        $data['foto_ktp'] = $request->file("foto_ktp")->store("/images", "public_path");
        $data['password'] = bcrypt($data['password']);
        $data['referal'] = Str::random(3) . random_int(10, 99) . "5" . Str::random(1) .  Relawan::where("id_relawan", $request->id_relawan)->first() + 1;

        if (Relawan::create($data)) {
            return back()->with("success", "Success Create New Relawan");
        }

        return back()->with("error", "Error, Can't Create New Relawan");
    }

    public function delete($id)
    {
        $relawan = Relawan::find($id);
        if (auth("caleg")->check()) {
            $this->authorize("all-caleg", $relawan);
        }
        if ($relawan->delete()) {
            Storage::disk("public_path")->delete($relawan->foto_ktp);
            return back()->with("success", "Success Delete Relawan");
        }
        return back()->with("error", "Error, Can't Delete Relawan");
    }

    public function update(Request $request, $id)
    {
        $relawan = Relawan::find($id);

        if (auth("caleg")->check()) {
            $this->authorize("all-caleg", $relawan);
        }
        
        if (auth("caleg")->check()) {
            $request["id_caleg"] = auth()->user()->id_caleg;
        }

        if ($request->has('loyalis')) {
            if ($request->loyalis == $relawan->loyalis) {
                return back()->with("success", "Tidak ada yang diubah");
            }

            if ($relawan->update(["loyalis" => $request->loyalis])) {
                return back()->with("success", "Success Update Loyalis");
            }
            return back()->with("error", "Error, Can't Update Loyalis");
        }

        if ($request->has("saksi")) {
            if ($request->saksi == "N") {
                $request->validate([
                    "tps" => "required"
                ]);
            }

            if ($relawan->update(["saksi" => $request->saksi == "Y" ? "N" : "Y"])) {
                if ($request->saksi == "Y") {
                    $relawan->update(["tps" => null]);
                    Daftar_Saksi::where('id_relawan', $id)->delete();
                    return back()->with("success", "Success Change Saksi");
                }

                $relawan->update(["tps" => implode(",", $request->tps)]);

                if (Daftar_Saksi::create(["id_relawan" => $id, "id_caleg" => auth("caleg")->check() ? auth()->user()->id_caleg : $relawan->id_caleg])) {
                    return back()->with("success", "Success Upload Saksi");
                }
            }
            
            return back()->with("error", "Error When Update TPS");
        }

        if ($request->has("jabatan")) {
            if ($request->jabatan == $relawan->jabatan) {
                return back()->with("success", "Tidak ada yang diubah");
            }

            if (
                $request->jabatan == 1
                && 
                Relawan::with("desa")->where("id_desa", $request->desa)->where("jabatan", $request->jabatan)->first()
                )
            {
                return back()->with("error", "Jabatan untuk daerah ini sudah diambil oleh orang lain!");
            }

            if ($request->jabatan == 2 && gettype(Relawan::with("desa.kecamatan")->get()->filter(function($value, $i) use ($relawan) {
                    return $value->desa->kecamatan->nama_kecamatan == $relawan->desa->kecamatan->nama_kecamatan;
                })->search(function($value, $i) use ($request) {
                    return $value->jabatan == $request->jabatan;
                })) == "integer") {
                return back()->with("error", "Jabatan untuk daerah ini sudah diambil oleh orang lain!");
                }
            
            if ($relawan->update(["jabatan" => $request->jabatan])) {
                return back()->with("success", "Success Update Jabatan");
            }
            return back()->with("error", "Error, Can't Update Jabatan");
        }

        if ($request->has("blokir")) {
            if ($relawan->update(["blokir" => $request->blokir == "Y" ? "N" : "Y"])) {
                return back()->with("success", "Success Update Block Status");
            }
            return back()->with("error", "Error, Can't Update Block status");

        }

        $rules = [
            "nama_relawan" => "required|max:255",
            "jk" => "required",
            "id_desa" => "required",
            "id_caleg" => "required",
            "status" => "required",
            "username" => "required|max:255",
            "foto_ktp" => "image|max:2048"
    ];

    if ($request->nik !== $relawan->nik) {
        $rules["nik"] = "required|unique:relawan";
    }

    if ($request->email !== $relawan->email) {
        $rules["email"] = "email|max:255|required|unique:relawan";
    }

    if ($request->no_hp !== $relawan->no_hp) {
        $rules["no_hp"] = "max:255|min:11|required|unique:relawan";
    }

    $data = $request->validate($rules);
    
    if ($request->hasFile("foto_ktp")) {
        Storage::disk("public_path")->delete($relawan->foto_ktp);
        $data['foto_ktp'] = $request->file("foto_ktp")->store("/images", "public_path");
    }

    if ($request->password) {
        $data["password"] = bcrypt($request->password);
    }

    if ($relawan->update($data)) {
        return back()->with("success", "Success Update Relawan");
    }
    return back()->with("error", "Error, Can't Update Relawan");
    }

   public function upline(Request $request) {
        $request->validate([
            "id" => "required"
        ]);
        
        if (auth("caleg")->check()) {
            $data = Relawan::find($request->id);
            $this->authorize("all-caleg", $data);
        }
        
        return view("relawan.upline", [
            "title" => "Upline " . Relawan::find($request->id)->nama_relawan,
            "data" => Relawan::with(["caleg", "desa"])->where("upline", $request->id)->get()
        ]);
    }

    public function fetch(Request $request) {
        if ($request->has("getData") && $request->getData) {
            $data = [];
            
            return response()->json($data, 200);
        }    
    }
}
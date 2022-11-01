<?php

namespace App\Http\Controllers;

use Helper;
use App\Models\Daftar_Isu;
use App\Models\Caleg;
use App\Models\Relawan;
use App\Models\Kecamatan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use ZipArchive;

class DaftarIsuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->has("download")) {
            if (auth("caleg")->check()) {
               $data = Daftar_Isu::find(request("download"));
               $this->authorize("all-caleg", $data);
           }
            $data = json_decode(Daftar_Isu::where("id_isu", request("download"))->first()->images);
            if (count($data) > 0) {
                $zip = new ZipArchive;
                $fileName = "images.zip";
                if (Storage::disk("public_path")->exists($fileName)) {
                    Storage::disk("public_path")->delete($fileName);
                }

                if ($zip->open(public_path($fileName), ZipArchive::CREATE) == TRUE) {
                    foreach ($data as $img) {
                        $zip->addFile("images/$img", basename($img));
                    }
                }

                $zip->close();

                return Storage::disk("public_path")->download($fileName);
            } else {
                return Storage::disk("public_path")->download("images/$data[0]");
            }
        }

        if (Helper::RequestCheck(request()->all())) {
            return back()->with("error", "Karakter Ilegal Ditemukan");
        };

        return view("data.daftarIsu", [
            "title" => "Daftar Isu",
            "dataArr" => auth("web")->check() ? Daftar_Isu::with(["relawan", "caleg", "kecamatan"])->search(request("search"))->paginate(request("paginate") ?? 10)->withQueryString() : Daftar_Isu::with(["relawan", "kecamatan"])->where("id_caleg", auth()->user()->id_caleg)->search(request("search"))->paginate(request("paginate") ?? 10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has("getData") && $request->getData) {
            $data = Daftar_Isu::find($request->data);
            if (auth("caleg")->check()) {
                $this->authorize("all-caleg", $data);
            }
            return response()->json($data, 200);
        }
        /*if (auth("caleg")->check()) {
            $request["id_caleg"] = auth()->user()->id_caleg;
        }

        $data = $request->validate([
            "id_caleg" => "required",
            "jenis" => "required",
            "dampak" => "required",
            "tanggal" => "required|date",
            "id_kecamatan" => "required",
            "id_relawan" => "required",
            "keterangan" => "required"
        ]);

        if (Daftar_Isu::create($data)) {
            return back()->with("success", "Success Create New Issue");
        }
        return back()->with("error", "Error When Creating New Issue");*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function show(Daftar_Isu $daftar_Isu, $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kecamatan $kecamatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Daftar_Isu $daftar_Isu, $id)
    {
        if (auth("caleg")->check()) {
            $isu = Daftar_Isu::find($id);
            $this->authorize("all-caleg", $isu);
        }

         if ($request->has("btn_tanggapan")) {
            $request->validate([
                "btn_tanggapan" => "required"
            ]);

             if (Daftar_Isu::find($id)->update(["tanggapan" => $request->btn_tanggapan])) {
                Daftar_Isu::find($id)->update(["tanggapi" => now()->toDateString()]);
                return back()->with("success", "Successfully responded");
             }
             return back()->with("error", "Error, Error when responding");
         }

         if ($request->has("unrespond")) {
            if (Daftar_Isu::find($id)->update(["tanggapi" => "N"])) {
                Daftar_Isu::find($id)->update(["tanggapan" => "Belum Di Tanggapi"]);
                return back()->with("success", "Successfully unresponded");
             }
             return back()->with("error", "Error, Error when responding");
         }

        $data = $request->validate([
            //"jenis" => "required",
            //"dampak" => "required",
            //"tanggal" => "required|date",
            //"id_kecamatan" => "required",
            "keterangan" => "required",
            //"tanggapan" => "required",
        ]);

        if (Daftar_Isu::find($id)->update($data)) {
                return back()->with("success", "Success Update Berita");
             }
             return back()->with("error", "Error, Error When Updating Berita");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Daftar_Isu $daftar_Isu, $id)
    {
        $isu = Daftar_Isu::find($id);
        if (auth("caleg")->check()) {
            $this->authorize("all-caleg", $isu);
        }
        if ($isu->delete()) {
            foreach (json_decode($isu->images) as $isuImg) {
                File::delete("images/$isuImg");
            }
            return back()->with('success','Success Delete Daftar Isu');
        }
        return back()->with('error','Error When Deleting Daftar Isu');

    }
}

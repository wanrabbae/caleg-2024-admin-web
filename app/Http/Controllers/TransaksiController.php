<?php

namespace App\Http\Controllers;

use Helper;
use App\Models\Rk_transaksi;
use App\Models\Rk_kategori;
use App\Models\Rk_bank;
use App\Models\Rk_wallet;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Helper::RequestCheck(request()->all())) {
            return back()->with("error", "Karakter Ilegal Ditemukan");
        };

        return view("finance.transaksi", [
            "title" => "Transaksi Page",
            "dataArr" => Rk_transaksi::with("kategori", "wallet", "bank")->where("id_caleg", auth()->user()->id_caleg)->search(request("search"))->paginate(request("paginate") ?? 10)->withQueryString()
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

    /*
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has("getData") && $request->getData) {
            $data = Rk_transaksi::find($request->data);
            if (auth("caleg")->check()) {
                $this->authorize("all-caleg", $data);
            }
            return response()->json($data, 200);
        }

        if ($request->has("getMedia") && $request->getMedia) {
            if ($request->media == "bank") {
                if (auth("caleg")->check()) {
                    $this->authorize("all-caleg", Rk_bank::where("id_caleg", $request->id)->first());                    
                }
                return response()->json(Rk_bank::where("id_caleg", $request->id)->get(), 200);
            }
            
            if ($request->media == "wallet") {
                if (auth("caleg")->check()) {
                    $this->authorize("all-caleg", Rk_wallet::where("id_caleg", $request->id)->first());                    
                }
                return response()->json(Rk_wallet::where("id_caleg", $request->id)->get(), 200);
            }
            
            if ($request->media == "pemasukan") {
                if (auth("caleg")->check()) {
                    $this->authorize("all-caleg", Rk_kategori::where("jenis_transaksi", "Pemasukan")->where("id_caleg", $request->id)->first());
                }
                return response()->json(Rk_kategori::where("jenis_transaksi", "Pemasukan")->where("id_caleg", $request->id)->get(), 200);
            }

            if ($request->media == "pengeluaran") {
                if (auth("caleg")->check()) {
                    $this->authorize("all-caleg", Rk_kategori::where("jenis_transaksi", "Pengeluaran")->where("id_caleg", $request->id)->first());
                }
                return response()->json(Rk_kategori::where("jenis_transaksi", "Pengeluaran")->where("id_caleg", $request->id)->get(), 200);
            }
        }

        if (auth("caleg")->check()) {
            $request["id_caleg"] = auth()->user()->id_caleg;
        }

        $data = $request->validate([
            "tgl_transaksi" => "date|required",
            "media" => "required",
            "nama_media" => "required",
            "jenis_transaksi" => "required",
            "id_kategori" => "required",
            "jumlah" => "required|numeric",
            "deskripsi" => "required|max:255",
            "id_caleg" => "required"
        ]);

        if ($data["media"] == "Bank") {
            $data["id_bank"] = $request->nama_media;
        } else {
            $data["id_wallet"] = $request->nama_media;
        }

    if (Rk_transaksi::create(collect($data)->except(["media", "jenis_transaksi"])->toArray())) {
        return back()->with("success", "Success Create New Transaksi");
    }
    return back()->with("error", "Error When Creating New Transaksi");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rk_transaksi  $rk_transaksi
     * @return \Illuminate\Http\Response
     */
    public function show($data)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rk_transaksi  $rk_transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Rk_transaksi $rk_transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rk_transaksi  $rk_transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rk_transaksi $rk_transaksi)
    {
        if (auth("caleg")->check()) {
            $this->authorize("all-caleg", $rk_transaksi);
        }

        if (auth("caleg")->check()) {
            $request["id_caleg"] = auth()->user()->id_caleg;
        }

        $rule = [
            "tgl_transaksi" => "date|required",
            "jumlah" => "required|numeric",
            "deskripsi" => "required|max:255",
            "id_caleg" => "required"
        ];
        
        if ($request->media != "") {
            $rule["nama_media"] = "required";
        }
        
        if ($request->jenis_transaksi != "") {
            $rule["id_kategori"] = "required";
        }
            
        $data = $request->validate($rule);
        
        if (array_key_exists("media", $request->all())) {
            if ($request["media"] != "") {
                if ($request["media"] == "Bank") {
                    $data["id_bank"] = $request->nama_media;
                    $data["id_wallet"] = null;
                } else {
                    $data["id_bank"] = null;
                    $data["id_wallet"] = $request->nama_media;
                }
            }
        }

        if ($rk_transaksi->update($data)) {
        return back()->with("success", "Success Update Transaksi");
    }
    return back()->with("error", "Error When Updating Transaksi");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rk_transaksi  $rk_transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rk_transaksi $rk_transaksi)
    {
        if (auth("caleg")->check()) {
            $this->authorize("all-caleg", $rk_transaksi);
        }
        
        if ($rk_transaksi->delete()) {
            return back()->with("success", "Success Delete Transaksi");
        }
        return back()->with("error", "Error When Deleting Transaksi");
    }
}

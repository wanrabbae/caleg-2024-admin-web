<?php

namespace App\Http\Controllers;

use Helper;
use App\Models\Rk_kategori;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        
            return view("finance.kategori", [
                "title" => "Finance Kategori Page",
                "dataArr" => Rk_kategori::where("id_caleg", auth()->user()->id_caleg)->search(request("search"))->paginate(request("paginate") ?? 10)->withQueryString()
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
                $data = Rk_kategori::find($request->data);
                if (auth("caleg")->check()) {
                    $this->authorize("all-caleg", $data);
                }
                return response()->json($data, 200);
            }

            if (auth("caleg")->check()) {
                $request["id_caleg"] = auth()->user()->id_caleg;
            }

            $data = $request->validate([
                "kode_kategori" => "required|max:6",
                "nama_kategori" => "required|max:255",
                "jenis_transaksi" => "required",
                "id_caleg" => "required"
            ]);

            if (Rk_kategori::create($data)) {
                return back()->with("success", "Success Create New Category");
            }
            return back()->with("error", "Error When Creating New Category");
        }

        /**
         * Display the specified resource.
         *
         * @param  \App\Models\Rk_kategori  $rk_kategori
         * @return \Illuminate\Http\Response
         */
        public function show(Rk_kategori $rk_kategori)
        {
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  \App\Models\Rk_kategori  $rk_kategori
         * @return \Illuminate\Http\Response
         */
        public function edit(Rk_kategori $rk_kategori)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \App\Models\Rk_kategori  $rk_kategori
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, Rk_kategori $rk_kategori)
        {
            if (auth("caleg")->check()) {
                $this->authorize("all-caleg", $rk_kategori);
            }

            $data = $request->validate([
                "kode_kategori" => "required|max:6",
                "nama_kategori" => "required|max:255",
                "jenis_transaksi" => "required",
            ]);

            if ($rk_kategori->update($data)) {
                return back()->with("success", "Success Update Category");
            }
            return back()->with("error", "Error When Updating Category");
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Models\Rk_kategori  $rk_kategori
         * @return \Illuminate\Http\Response
         */
        public function destroy(Rk_kategori $rk_kategori)
        {
            if (auth("caleg")->check()) {
                $this->authorize("all-caleg", $rk_kategori);
            }
            
            if ($rk_kategori->delete()) {
                return back()->with("success", "Success Delete Category");
            }
            return back()->with("error", "Error When Deleting Category");
        }
    }

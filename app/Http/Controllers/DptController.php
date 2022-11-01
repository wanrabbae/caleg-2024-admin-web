<?php

namespace App\Http\Controllers;

use Helper;
use App\Models\Desa;
use App\Models\Caleg;
use App\Models\Rk_pemilih;
use App\Models\Rk_pemilih_2;
use App\Models\Monitoring_Saksi;
use App\Models\User;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Box\Spout\Common\Entity\Row;
use Illuminate\Support\Facades\File;

class DptController extends Controller
{
    public function index()
    {
        if (Helper::RequestCheck(request()->all())) {
            return back()->with("error", "Karakter Ilegal Ditemukan");
        };

        return view('rekap.dpt', [
            'title' => 'DPT / Pemilih Page',
            'datas' => Rk_pemilih::with("desa.kecamatan")->search(request("search"))->paginate(request("paginate") ?? 10)->withQueryString(),
            'desas' => Desa::all(),
        ]);
    }

    public function show(Request $request)
    {
        if ($request->has("getData") && $request->getData) {
            return response()->json(Rk_pemilih::find($request->data), 200);
        }
    }

    public function store() {
    $data = Rk_pemilih::all();

    $writer = WriterEntityFactory::createXLSXWriter();
    $writer->openToBrowser("caleg.xlsx");

    $title = [
        "id_pemilih",
        "nik",
        "nama",
        "tempat_lahir",
        "tgl_lahir",
        "jk",
        "id_desa",
        "tgl_data",
    ];

    $row = WriterEntityFactory::createRowFromArray($title);
    $writer->addRow($row);

    foreach ($data as $value) {
        $row = WriterEntityFactory::createRowFromArray([
            $value->id_pemilih,
            $value->nik,
            $value->nama,
            $value->tempat_lahir,
            $value->tgl_lahir,
            $value->jk,
            $value->id_desa,
            $value->tgl_data
        ]);
        $writer->addRow($row);
    };

    $writer->close();
    }

    public function update(Request $request) {
        $request->validate([
            "dpt" => "file|required|mimes:xlsx,csv"
        ]);

        if ($request->has("dpt")) {
            $reader = ReaderEntityFactory::createXLSXReader();
            $reader->open($request->file("dpt"));
            $arr = [];
            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $i => $row) {
                        if ($i != 1) {
                        $cells = $row->getCells();
                        array_push($arr,
                        [
                            "id_pemilih" => $cells[0]->getValue(),
                            "nik" => $cells[1]->getValue(),
                            "nama" => $cells[2]->getValue(),
                            "tempat_lahir" => $cells[3]->getValue(),
                            "tgl_lahir" => $cells[4]->getValue(),
                            "jk" => $cells[5]->getValue(),
                            "id_desa" => $cells[6]->getValue(),
                            "tgl_data" => $cells[7]->getValue()
                        ]
                        );
                    }
                }
            }
        }

        $reader->close();
        $dpt = Rk_pemilih::all();
        $dpt2 = Rk_pemilih_2::all();
        Rk_pemilih::truncate();
        Rk_pemilih_2::truncate();
        if (Rk_pemilih::insert($arr)) {
            Rk_pemilih_2::insert($arr);
            return back()->with("success", "Data DPT berhasil di impor, silahkan tunggu hingga proses impor selesai. Mungkin akan memakan banyak waktu jika terdapat data yang banyak");
        }
        Rk_pemilih::insert($dpt);
        Rk_pemilih_2::insert($dpt2);
        return back()->with("error", "Error Saat Mengimpor DPT");

    }

    /*public function store(Request $request)
    {
        if (auth("caleg")->check()) {
            $request["id_caleg"] = auth()->user()->id_caleg;
        }

        $data = $request->validate([
            'nik' => 'required|max:100|unique:rk_pemilih,id_caleg',
            "id_caleg" => "required",
            'nama' => 'required|max:100',
            'tempat_lahir' => 'required|max:50',
            'tgl_lahir' => 'required|date',
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
    }*/

    /*public function update(Request $request, $id)
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
            'jk' => 'required|max:10',
            'tps' => 'required|integer',
            'id_desa' => 'required|max:4',
            'relawan' => 'required',
            'saksi' => 'required',
            'id_users' => 'required',
    ];

        if ($request->nik !== $pemilih->nik) {
            $rules["nik"] = "required|unique:rk_pemilih,id_caleg";
        }

        $data = $request->validate($rules);

        if ($pemilih->update($data) && Rk_pemilih_2::find($id)->update($data)) {
            return back()->with('success', 'Success Update New Data DPT');
        }
        return back()->with('error', "Error, Can't Update New Data DPT");
    }*/

    public function delete($id)
    {
        if (Rk_pemilih::destroy($id) && Rk_pemilih_2::destroy($id)) {
            return back()->with('success', 'Success Delete Data DPT');
        }
        return back()->with('error', "Error, Can't Delete Data DPT");
    }

    public function getChart(Request $request)
    {
        if ($request->has("getData") && $request->getData) {
            $arr = $request->data == 0 ? Monitoring_Saksi::all() : Monitoring_Saksi::where("id_caleg", $request->data)->get();
            $data = [];
            $found = true;

        foreach ($arr as $arr) {
            for ($i = 0; $i < count($data); $i++) {
                if (in_array($arr->desa->kecamatan->nama_kecamatan, $data[$i])) {
                    $data[$i][1] += $arr->suara_2024;
                    $data[$i][2] += $arr->suara_2019;
                    $found = false;
                    break;
                }
            }
            if ($found) {
                array_push($data, [$arr->desa->kecamatan->nama_kecamatan, $arr->suara_2024, $arr->suara_2019]);
            }
            $found = true;
        }
        return response()->json($data, 200);
    }
    }
}

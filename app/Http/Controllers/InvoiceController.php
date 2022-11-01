<?php

namespace App\Http\Controllers;

use Helper;
use App\Models\Invoice;
use App\Models\Caleg;
use Illuminate\Http\Request;

class InvoiceController extends Controller
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

        return view("invoice.index", [
            "title" => "Invoice Page",
            "data" => Invoice::with("caleg")->search(request("search"))->paginate(request("paginate") ?? 10)->withQueryString(),
            "caleg" => Caleg::whereDemo("Y")->get()
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
            return response()->json(Invoice::find($request->data), 200);
        }

        $data = $request->validate([
            "id_caleg" => "required|unique:invoice"
        ]);

        $data["no_invoice"] = "JG" . now()->format("Y") . $data["id_caleg"];
        
        if (Invoice::create($data)) {
            return back()->with("success", "Success Creating New Invoice");
        }
        return back()->with("error", "Error When Creating Invoice");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = $request->validate([
            "id_caleg" => "required"
        ]);

        $invoice = Invoice::where("id_caleg", $data["id_caleg"])->first();
        
        if ($invoice->caleg->level == "Basic") {
            $harga = 500000;
        }

        if ($invoice->caleg->level == "Gold") {
            $harga = 1000000;
        }

        if ($invoice->caleg->level == "Platinum") {
            $harga = 2000000;
        }

        $total = $harga . $invoice->caleg->id_caleg;
        $total = number_format($total,2,',','.');
        $harga = number_format($harga,2,',','.');

        return view("invoice." . request("type"), [
                "data" => $invoice,
                "harga" => $harga,
                "total" => $total,
                "tanggal" => $invoice->tanggal_bayar
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        if ($request->has("tanggal_bayar")) {
            if ($request->tanggal_bayar == "N") {
                $invoice->update(["tanggal_bayar" => date("Y-m-d h:m:s")]);
                Caleg::find($invoice->id_caleg)->update(["demo" => "N", "aktif" => "Y"]);
                return back()->with("success", "Success Change Status");
            } else {
                $invoice->update(["tanggal_bayar" => null]);
                Caleg::find($invoice->id_caleg)->update(["demo" => "Y", "aktif" => "Y"]);
                return back()->with("success", "Success Change Status");
            }
        }

        $rules = [];
        
        if ($request->id_caleg != $invoice->id_caleg) {
            $rules["id_caleg"] = "required|unique:invoice";
        }

        $data = $request->validate($rules);

        $data["no_invoice"] = "JG" . now()->format("Y") . $data["id_caleg"];

        if ($invoice->update($data)) {
            return back()->with("success", "Success Updating Invoice");            
        }
        return back()->with("error", "Error When Updating Invoice");            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        if($invoice->delete()){
            return back()->with('success', 'Success Deleting Invoice');
        }
        return back()->with('error', 'Failed Deleting Invoice');
    }
}

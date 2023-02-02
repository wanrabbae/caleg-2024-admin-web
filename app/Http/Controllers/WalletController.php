<?php

namespace App\Http\Controllers;

use Helper;
use App\Models\Rk_wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
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

        return view('finance.ewallet', [
            'title' => 'E-Wallet Page',
            'dataArr' => Rk_wallet::where('id_caleg', auth()->user()->id_caleg)->search(request("search"))->paginate(request("paginate") ?? 10)->withQueryString()
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
            $data = Rk_wallet::find($request->data);
            if (auth("caleg")->check()) {
                $this->authorize("all-caleg", $data);
            }

            return response()->json($data, 200);
        }
        
        $walletRules = 'required|numeric|unique:rk_wallet';

        if (auth('caleg')->check()) {
            $request['id_caleg'] = auth()->user()->id_caleg;
        }

        $findWallet = Rk_wallet::where('id_caleg', auth()->user()->id_caleg)->first();

        if ($findWallet) {
            if ($findWallet->nomor_wallet == $request->nomor_wallet) {
                $walletRules = 'required|numeric';
            }
        }

        $data = $request->validate([
            'nama_wallet' => 'required|max:255',
            'nomor_wallet' => $walletRules,
            'pemilik_wallet' => 'required|max:255',
            'id_caleg' => 'required',
        ]);

        if (Rk_wallet::create($data)) {
            return back()->with('success', 'Success Create New Wallet');
        }
        return back()->with('error', 'Error When Creating New Wallet');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rk_wallet  $rk_wallet
     * @return \Illuminate\Http\Response
     */
    public function show(Rk_wallet $rk_wallet)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rk_wallet  $rk_wallet
     * @return \Illuminate\Http\Response
     */
    public function edit(Rk_wallet $rk_wallet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rk_wallet  $rk_wallet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rk_wallet $rk_wallet)
    {
        if (auth("caleg")->check()) {
            $this->authorize("all-caleg", $rk_wallet);
        }
        
        $walletRules = 'required|numeric|unique:rk_wallet';

        if (auth('caleg')->check()) {
            $request['id_caleg'] = auth()->user()->id_caleg;
        }

        $findWallet = Rk_wallet::where('id_caleg', auth()->user()->id_caleg)->first();

        if ($findWallet) {
            if ($findWallet->nomor_wallet == $request->nomor_wallet) {
                $walletRules = 'required|numeric';
            }
        }

        $data = $request->validate([
            'nama_wallet' => 'required|max:255',
            'nomor_wallet' => $walletRules,
            'pemilik_wallet' => 'required|max:255',
            'id_caleg' => 'required',
        ]);

        if ($rk_wallet->update($data)) {
            return back()->with('success', 'Success Create New Wallet');
        }
        return back()->with('error', 'Error When Creating New Wallet');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rk_wallet  $rk_wallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rk_wallet $rk_wallet)
    {
        if (auth("caleg")->check()) {
            $this->authorize("all-caleg", $rk_wallet);
        }
        
        if ($rk_wallet->delete()) {
            return back()->with('success', 'Success Delete Wallet');
        }
        return back()->with('error', 'Error When Deleting Wallet');
    }
}

<?php

namespace App\Http\Controllers;

use Helper;
use App\Models\Caleg;
use App\Models\News;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
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

        return view('data.berita',[
            'title' => 'Berita Page',
            'data' => auth("web")->check() ? News::search(request("search"))->paginate(request("paginate") ?? 10)->withQueryString() : News::where("id_caleg", auth()->user()->id_caleg)->search(request("search"))->paginate(request("paginate") ?? 10)->withQueryString(),
            'caleg' => Caleg::all(),
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
            $data = News::find($request->data);
            if (auth("caleg")->check()) {
                $this->authorize("all-caleg", $data);
            }
            return response()->json($data, 200);
        }

        if (auth("caleg")->check()) {
            $request["id_caleg"] = auth()->user()->id_caleg;
        }

        $data = $request->validate([
            'judul' => 'required',
            'isi_berita' => 'required',
            'tgl_publish' =>  'required|date',
            'id_caleg' => 'required',
            'gambar' => 'required|image|file|max:5000',
        ]);

         if($request->file('gambar')){
            $data['gambar'] = $request->file('gambar')->store('/images', "public_path");
        }

        if(News::create($data)){
            return back()->with('success', "Success Create New Data News");
        }
        return back()->with('error', "Failed Create New Data News");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news, $id_news)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news, $id_news)
    {
        if (auth("caleg")->check()) {
            $data = News::find($id_news);
            $this->authorize("all-caleg", $data);
        }

        if ($request->publish) {
            if(News::where('id_news', $id_news)->update(["aktif" => $request->publish])){
                return redirect('/infoPolitik/berita')->with('success', 'Success Updating Data News');
            }

            return redirect('/infoPolitik/berita')->with('error', 'Failed Updating Data News');
        }

        if (auth("caleg")->check()) {
            $request["id_caleg"] = auth()->user()->id_caleg;
        }

        $rules = [
            'isi_berita' => 'required',
            'tgl_publish' =>  'required|date',
            'id_caleg' => 'required',
            'gambar' => 'image|file|max:5000',
        ];

        if ($request->judul !== News::find($id_news)->judul) {
            $rules["judul"] = "required";
        }

        $data = $request->validate($rules);

        $img = News::firstWhere("id_news", $id_news)->gambar;

        if($request->file('gambar')){
            Storage::disk("public_path")->delete($img);
            $data["gambar"] = $request->file("gambar")->store('/images', "public_path");
        }

        if(News::where('id_news', $id_news)->update($data)){
            return redirect('/infoPolitik/berita')->with('success', 'Success Updating Data News');
        }
        return redirect('/infoPolitik/berita')->with('error', 'Failed Updating Data News');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news, $id_news)
    {
        if (auth("caleg")->check()) {
            $data = News::find($id_news);
            $this->authorize("all-caleg", $data);
        }
        
        $img = News::firstWhere("id_news", $id_news)->gambar;
        if(News::where('id_news', $id_news)->delete()){
            Storage::disk("public_path")->delete($img);
            return back()->with('success', "Success Deleting Data News");
        }
       return back()->with('error', "Failed Deleting Data News");
    }
}

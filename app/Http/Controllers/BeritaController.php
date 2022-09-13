<?php

namespace App\Http\Controllers;

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
        return view('data.berita',[
            'title' => 'Berita Page',
            'data' => auth("web")->check() ? News::all() : News::where("id_caleg", auth()->user()->id_caleg)->get(),
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
        return response()->json(News::find($id_news));
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
            File::delete($img);
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
        $img = News::firstWhere("id_news", $id_news)->gambar;
        if(News::where('id_news', $id_news)->delete()){
            File::delete($img);
            return back()->with('success', "Success Deleting Data News");
        }
       return back()->with('error', "Failed Deleting Data News");
    }

    public function publish($id_news){

        $aktif = News::firstWhere("id_news", $id_news)->aktif;
        $judul = News::firstWhere("id_news", $id_news)->judul;

        if($aktif == "Y"){
            if(News::where("id_news", $id_news)->update($aktif === "N")){
                News::where("id_news", $id_news)->delete($aktif);
            }
            return redirect('/infoPolitik/berita')->with('success', "Success Publish Berita $judul");
        }
        return redirect('/infoPolitik/berita')->with('error', "Failed Publish Berita $judul");
    }

}

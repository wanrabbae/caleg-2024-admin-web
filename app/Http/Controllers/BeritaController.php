<?php

namespace App\Http\Controllers;

use App\Models\Caleg;
use App\Models\News;
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
            'data' => News::all(),
            'caleg' => Caleg::all()
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
        $data = $request->validate([
            'judul' => 'required|unique:news',
            'isi_berita' => 'required|max:255',
            'tgl_publish' =>  'required|date',
            'id_caleg' => 'required',
            'gambar' => 'required|image|file|max:5000',
            'aktif' => 'required'
        ]);

         if($request->file('gambar')){
            $data['gambar'] = $request->file('gambar')->store('/images');
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

        } else {
            $rules = [
                'judul' => 'unique:news',
                'isi_berita' => 'max:255',
                'tgl_publish' =>  'date',
                'id_caleg' => 'required',
                'gambar' => 'image|file|max:5000',
                'aktif' => 'required'
            ];
            
            
        $data = $request->validate($rules);

        $img = News::firstWhere("id_news", $id_news)->gambar;
        
        if($request->file('gambar')){
            Storage::delete($img);
            $data["gambar"] = $request->file("gambar")->store('/images');
        }
        
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
            Storage::delete($img);
            return back()->with('success', "Success Deleting Data News");
        }
       return back()->with('error', "Failed Deleting Data News");
    }
}

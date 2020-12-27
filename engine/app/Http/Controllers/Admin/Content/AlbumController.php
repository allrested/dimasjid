<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\Album;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Balai;
use Auth;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 1){
            $albums = Album::all();
        }else{
            $id_balai = Auth::user()->id_balai;
            $albums = Album::where('id_balai', $id_balai)->get();
        }

        return view('admin.album.index',compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $balais = Balai::all();
        return view('admin.album.form', compact('balais'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $album = Album::create($request->all());
        return redirect()->route('album.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        $balais = Balai::all();
        return view('admin.album.form',compact('album', 'balais'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        $album->update($request->all());
        return redirect()->route('album.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        $album->delete();
        return redirect()->route('album.index');
    }

    public function listGallery($id)
    {
        $galleries = Gallery::where('id_album', $id)->get();
        $album = Album::find($id);
        return view('admin.gallery.index', compact('galleries','album'));
    }

    public function createGallery($id)
    {
        $album = Album::find($id);
        return view('admin.gallery.form', compact('album'));
    }


}

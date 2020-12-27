<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\Album;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{

    public function index()
    {
        $galleries = Gallery::where('id_bidang', 0)->get();    
        return view('admin.content.gallery.index', compact('galleries'));
    }


    public function create()
    {
        return view('admin.content.gallery.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|array',
            'image' => 'required|array'
        ]);

        if ($request->has('image')) {
            if (!empty($request->image)) {
                foreach ($request->image as $key => $data) {
                    
                    if(!in_array($data->getClientOriginalExtension() ,['jpg','png','jpeg','svg'])) 
                        return redirect()->back()->with('error','Format file tidak sesuai (jpg,png,jpeg,svg)');
                    try {
                        $input['title'] = $request->title[$key];
                        $imageName = str_replace(' ', '-', $input['title']) . '_' . rand() . '.' . $data->getClientOriginalExtension();
                        $data->storeAs('gallery', $imageName, 'public_uploads');
                        $input['image'] = $imageName;
                        $input['id_album'] = 100;
                        $input['id_bidang'] = 0;
                        $input['is_public'] = 1;
                        
                        Gallery::create($input);
                    } catch (\Throwable $th) {
                        break;
                        return redirect()->back()->with('error','Server error,'.$th);
                    }
                    
                }
            }
        }

        return redirect()->to('admin/gallery')->with('info', 'Galeri berhasil ditambahkan.');
    }


    public function show()
    {
        //
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.content.gallery.form', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $input = $request->all();
        if ($request->has('image')) {
            if (!empty($request->image)) {
                foreach ($request->image as $key => $data) {
                    
                    if(!in_array($data->getClientOriginalExtension() ,['jpg','png','jpeg','svg'])) 
                        return redirect()->back()->with('error','Format file tidak sesuai (jpg,png,jpeg,svg)');
                    try {
                        $input['title'] = $request->title[$key];
                        $imageName = str_replace(' ', '-', $input['title']) . '_' . rand() . '.' . $data->getClientOriginalExtension();
                        $data->storeAs('gallery', $imageName, 'public_uploads');
                        $input['image'] = $imageName;
                        
                    } catch (\Throwable $th) {
                        break;
                        return redirect()->back()->with('error','Server error,'.$th);
                    }
                    
                }
            }
        }

        try {
            $input['title'] = $input['title'][0];
            $gallery->update($input);
            return redirect()->route('gallery.index')->with('info', 'Galeri berhasil diupdate.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Server error,'.$th);
        }
        
    }

    public function destroy(Gallery $gallery)
    {
        try {
            $id = $gallery->id_album;
            $gallery->delete();
            return redirect()->route('gallery.index')->with('info', 'Galeri berhasil dihapus.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Server error,'.$th);
        }
        
    }
}

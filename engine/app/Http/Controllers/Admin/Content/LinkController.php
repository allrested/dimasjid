<?php

namespace App\Http\Controllers\Admin\Content;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Link;

class LinkController extends Controller
{
    public function index()
    {
        $links = Link::orderBy('id', 'DESC')->get();
        return view('admin.content.link.index', compact('links'));
    }

    public function store(Request $request)
    {
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*/';

        $request->validate([
            'nama' => 'required|max:191',
            'link' => 'required|max:191|regex:'.$regex, 
        ]);

        $input = $request->all();    
        if ($request->has('image')) {
            $extension = $request->file('image')->extension();
            if(!in_array($extension ,['jpg','png','jpeg','svg'])) 
                return redirect()->back()->with('error','Format file tidak sesuai (jpg,png,jpeg,svg)');

            $imageName = str_replace(' ', '-', $request['nama']) . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('link', $imageName, 'public_uploads');
            $input['icon'] = $imageName;
        }

        try {
            Link::create($input);
            return redirect()->route('links.index')->with('info', 'Link berhasil dibuat');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Server error,'.$th);
        }

        

    }

    public function update(Request $request, $id)
    {
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*/';

        $request->validate([
            'nama' => 'required|max:191',
            'link' => 'required|max:191|regex:'.$regex, 
        ]);

        $link = Link::where('id', $id);

        $input = $request->except(['_token', '_method']);

        if ($request->has('image')) {
            if(!in_array($extension ,['jpg','png','jpeg','svg'])) 
                return redirect()->back()->with('error','Format file tidak sesuai (jpg,png,jpeg,svg)');

            $imageName = str_replace(' ', '-', $request['nama']) . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('link', $imageName, 'public_uploads');
            $input['icon'] = $imageName;
        }
        unset($input['image']);
        
        try {
            $link->update($input);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('Server error,', $th);
        }
        
        return redirect()->route('links.index')->with('info', 'Link berhasil diupdate');
    }

    public function destroy($id)
    {
        try {
            $link = Link::find($id);
            $link->delete();
    
            return redirect()->route('links.index')->with('info', 'Link berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('Server error,', $th);
        }
       
    }
}

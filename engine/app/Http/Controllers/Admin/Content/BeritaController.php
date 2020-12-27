<?php

namespace App\Http\Controllers\Admin\Content;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    private $category = [
        'Kajian',
        'Berita'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beritas = Berita::all();
        return view('admin.content.berita.index', compact('beritas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('admin.content.berita.form', [
            'users' => $users,
            'category' => $this->category
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //If the user is balai, the news status will be pending
        $request->validate([
            'title' => 'required|max:191',
            'content' => 'required',
            'category' => 'required',
            'id_user' => 'sometimes|exists:users,id',
        ]);

        if(auth()->user()->role == 1)
        {
            $request->merge([
                'status' => 1,
                'id_user' => auth()->user()->id,
            ]);
        }else
        {
            $request->merge([
                'status' => 0,
                'id_user' => auth()->user()->id,
            ]);
        }

        $input = $request->all();
        $input['slug'] = Str::slug($request->title, '-');

        if ($request->has('image')) {

            $extension = $request->file('image')->extension();
            if(!in_array($extension ,['jpg','png','jpeg','svg'])) 
                return redirect()->back()->with('error','Format file tidak sesuai (jpg,png,jpeg,svg)');

            $imageName = str_replace(' ', '-', $request['title']). '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('berita', $imageName, 'public_uploads');
            $input['image'] = $imageName;
        }else{
            $input['image'] = 'logo.png';
        }

        try {
            $berita = Berita::create($input);
            $berita->slug = $berita->id . '-' .$berita->slug;
            $berita->save();
            return redirect()->route('berita.index')->with('info', 'Berita berhasil dibuat');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Server error'.$th);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function show(Berita $berita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  id   $berita id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->role == 1) {
            $users = User::all();
        } else {
            $users = '';
        }
        $berita = Berita::find($id);
        return view('admin.content.berita.form', [
            'berita' => $berita,
            'users' => $users,
            'category' => $this->category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:191',
            'content' => 'required',
            'category' => 'required',
            'id_user' => 'sometimes|exists:users,id',
        ]);

        $berita = Berita::find($id);
        $input = $request->all();

        if ($request->has('image')) {

            $extension = $request->file('image')->extension();
            if(!in_array($extension ,['jpg','png','jpeg','svg'])) 
                return redirect()->back()->with('error','Format file tidak sesuai (jpg,png,jpeg,svg)');

            if($berita->image != 'logo.png'){
                Storage::disk('public_uploads')->delete('berita/' . $berita->image);
            }
                        
            $imageName = str_replace(' ', '-', $request['title']). '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('berita', $imageName, 'public_uploads');
            $input['image'] = $imageName;
        }

        try {
            $berita->update($input);
            return redirect()->route('berita.index')->with('info', 'Berita berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Server error,'.$th);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $berita = Berita::find($id);
            $berita->delete();
            return redirect()->route('berita.index');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Server error,'.$th);
        }
        
    }

    /**
     * Approve News by Superadmin
     *
     * @param  id  id berita
     * @return \Illuminate\Http\Response
     */
    public function approve($id){
        $berita = Berita::find($id);
        $berita->status = 'approved';
        $berita->save();
        return redirect()->route('berita.index');
    }
}

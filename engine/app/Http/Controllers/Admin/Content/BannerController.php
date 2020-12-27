<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::get();
        return view('admin.content.banner.index',compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.banner.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:191',
            'caption' => 'required|max:191',
            'status' => ['required', Rule::in([0,1])],
        ]);

        $input = $request->all();
    
        if ($request->has('image')) {
            $extension = $request->file('image')->extension();
           
            if(!in_array($extension ,['jpg','png','jpeg','svg'])) 
                return redirect()->back()->with('error','Format file tidak sesuai (jpg,png,jpeg,svg)');

            $imageName = str_replace(' ', '-', $request['title']). '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('banner', $imageName, 'public_uploads');
            $input['image'] = $imageName;
            
            
        }
        
        try {
            $banner = Banner::create($input);
            return redirect()->route('banner.index');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Server error,'.$th);
        }
       
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        $banner = Banner::find($banner->id);
        return view('admin.content.banner.form',compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'required|max:191',
            'caption' => 'required|max:191',
            'status' => ['required', Rule::in([1,2])],
        ]);

        $input = $request->all();

        if ($request->has('image')) {
            $extension = $request->file('image')->extension();
           
            if(!in_array($extension ,['jpg','png','jpeg','svg'])) 
                return redirect()->back()->with('error','Format file tidak sesuai (jpg,png,jpeg,svg)');
                
            try {
                Storage::disk('public_uploads')->delete('banner/'.$request->image);            

                $imageName = str_replace(' ', '-', $request['title']). '.' . $request->image->getClientOriginalExtension();
                $request->image->storeAs('banner', $imageName, 'public_uploads');
                $input['image'] = $imageName;
            } catch (\Throwable $th) {
                return redirect()->back()->with('error','Server error,'.$th);
            }
        }

        try {
            $banner->update($input);
            return redirect()->route('banner.index');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Server error,'.$th);
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        try {
            $banner->delete();
            return redirect()->route('banner.index');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Server error,'.$th);
        }
        
    }
}

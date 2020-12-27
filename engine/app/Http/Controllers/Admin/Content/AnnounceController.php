<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\Announce;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnnounceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announces = Announce::all();
        return view('admin.content.announce.index',compact('announces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.announce.form');
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
            'caption' => 'required'
        ]);

        try {
            $input = $request->all();
            Announce::create($input);
            return redirect()->route('announce.index');

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
    public function edit(Announce $announce)
    {
        return view('admin.content.announce.form',compact('announce'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Announce $announce)
    {
        $request->validate([
            'title' => 'required|max:191',
            'caption' => 'required'
        ]);

        try {
            $input = $request->all();
            if($request->has('id_balais')){
                $input['id_balais'] = implode(', ', $request->id_balais);
            }
            $announce->update($input);
            return redirect()->route('announce.index');

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
    public function destroy(Announce $announce)
    {
        $announce->delete();
        return redirect()->route('announce.index');
    }
}

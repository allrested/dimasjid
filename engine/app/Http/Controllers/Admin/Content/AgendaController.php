<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\Agenda;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role == 1) {
            $agendas = Agenda::where('id_bidang',0)->get();
        } else {
            $agendas = auth()->user()->agenda()->get();
        }
        return view('admin.content.agenda.index',compact('agendas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.agenda.form');
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
            'tanggal' => 'required',
            'jam' => 'required',
            'jam_end' => 'required',
            'tanggal_end' => 'required',
            'title' => 'required|max:191',
            'location' => 'required|max:191'
        ]);

        $datetime = date('Y-m-d H:i:s', strtotime("$request->tanggal $request->jam"));
        $datetime_end = date('Y-m-d H:i:s', strtotime("$request->tanggal_end $request->jam_end"));

        $request->merge([
            'time_start' => $datetime,
            'id_user' => auth()->user()->id,
            'id_bidang' => 0,
            'time_end' => $datetime_end
        ]);

        $request->replace($request->except(['tanggal','jam', 'jam_end','tanggal_end']));
        $input = $request->all();

        if ($request->has('banner_img')) {
            $extension = $request->file('banner_img')->extension();
            if(!in_array($extension ,['jpg','png','jpeg','svg'])) 
                return redirect()->back()->with('error','Format file tidak sesuai (jpg,png,jpeg,svg)');

            $imageName = str_replace(' ', '-', $request['title']). '.' . $request->banner_img->getClientOriginalExtension();
            $request->banner_img->storeAs('agenda', $imageName, 'public_uploads');
            $input['banner_img'] = $imageName;
        }else{
            $input['banner_img'] = 'logo.png';
        }

        try {
            $agenda = Agenda::create($input);
            return redirect()->route('agenda.index')->with('info', 'Agenda berhasil dibuat');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Server error,'.$th);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function show(Agenda $agenda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function edit(Agenda $agenda)
    {
        $agenda = Agenda::find($agenda->id);
        return view('admin.content.agenda.form',compact('agenda'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agenda $agenda)
    {

        $request->validate([
            'tanggal' => 'required',
            'jam' => 'required',
            'jam_end' => 'required',
            'tanggal_end' => 'required',
            'title' => 'required|max:191',
            'location' => 'required|max:191'
        ]);

        $agenda= Agenda::find($agenda->id);

        $datetime = date('Y-m-d H:i:s', strtotime("$request->tanggal $request->jam"));
        $datetime_end = date('Y-m-d H:i:s', strtotime("$request->tanggal $request->jam_end"));
        $request->merge([
            'time_start' => $datetime,
            'id_user' => auth()->user()->id,
            'time_end' => $datetime_end
        ]);

        try {
            $request->replace($request->except(['tanggal', 'jam', 'jam_end','tanggal_end','tanggal_start']));
            $agenda->update($request->except('banner_img'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Server error update,'.$th);
        }

        

        if ($request->has('banner_img')) {
            
            $extension = $request->file('banner_img')->extension();
            if(!in_array($extension ,['jpg','png','jpeg','svg'])) 
                return redirect()->back()->with('error','Format file tidak sesuai (jpg,png,jpeg,svg)');

            if ($agenda->banner_img != 'logo.png') {
                Storage::disk('public_uploads')->delete('agenda/' . $agenda->banner_img);
            }  

            try {
                $imageName = str_replace(' ', '-', $request['title']). '.' . $request->banner_img->getClientOriginalExtension();
                $request->banner_img->storeAs('agenda', $imageName, 'public_uploads');
                $agenda->banner_img = $imageName;
                $agenda->save();
            } catch (\Throwable $th) {
                return redirect()->back()->with('error','Server error update,'.$th);
            }
            
            
        }

        return redirect()->route('agenda.index')->with('info', 'Agenda berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agenda $agenda)
    {
        try {
            $agenda->delete();
            return redirect()->route('agenda.index');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Server error update,'.$th);
        }
        
    }

    
}

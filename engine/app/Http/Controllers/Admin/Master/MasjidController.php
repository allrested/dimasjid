<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Masjid;
use App\Models\Wilayah;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class MasjidController extends Controller
{
    public function index()
    {
        $masjid = Masjid::where('status', 1)->get();
        $daerah = Array();
        return view('admin.master.masjid', compact('masjid', 'daerah'));
    }

    public function dataAjax(Request $request)
    {
    	$data = [];

        if($request->has('q')){
            $search = $request->q;
            $data =Wilayah::select("kode","nama")
            		->where('nama','ILIKE',"%$search%")->whereRaw('LENGTH(kode) < 9')
            		->get();
        }
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255'
        ]);

        $input = $request->all();
        
        try {
            
            $masjid = Masjid::create($input);
            return redirect()->back()->with('info', 'Masjid Berhasil Ditambahkan!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Server error,'.$th);
        }
    }

    public function destroy($id)
    {
        try {
            Masjid::find($id)->delete();
            return redirect()->back()->with('info', 'Data Masjid Berhasil Dihapus');
        } catch (\Throwable $th) {
           return redirect()->back()->with('error', 'Server error,'.$th);
        }
       
    }

    public function show($id)
    {
        $akun = Masjid::find($id);
        return response()->json($akun);
    }

    public function update(Request $request, $id)
    {
        try {
            $akun = Masjid::where('id', $id);

            $input = $request->except(['_token', '_method']);

            $akun->update($input);

            return redirect()->route('masjid.index')->with('info', 'Data ' . $request->nama .' berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Server error,'.$th);
        }
    }

}

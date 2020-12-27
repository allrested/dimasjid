<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Akun;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class AkunController extends Controller
{
    public function index()
    {
        $akun = Akun::orderBy('kode')->get();
        return view('admin.master.akun', compact('akun'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255'
        ]);

        $input = $request->all();
        
        try {
            if ($request->has('kode')) {
                $input['kode_dasar'] = $request['kode'];
                if($input['parent'] != 0){
                    $parent = Akun::find($input['parent']);
                    $input['kode'] = $parent->kode.".".$request['kode'];
                }            
            }
            
            $akun = Akun::create($input);
            return redirect()->back()->with('info', 'Akun Berhasil Ditambahkan!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Server error,'.$th);
        }
    }

    public function destroy($id)
    {
        try {
            Akun::find($id)->delete();
            return redirect()->back()->with('info', 'Akun Berhasil Dihapus');
        } catch (\Throwable $th) {
           return redirect()->back()->with('error', 'Server error,'.$th);
        }
       
    }

    public function show($id)
    {
        $akun = Akun::find($id);
        return response()->json($akun);
    }

    public function update(Request $request, $id)
    {
        try {
            $akun = Akun::where('id', $id);

            $input = $request->except(['_token', '_method']);
            if ($request->has('kode')) {
                $input['kode_dasar'] = $request['kode'];
                if($input['parent'] != 0){
                    $parent = Akun::find($input['parent']);
                    $input['kode'] = $parent->kode.".".$request['kode'];
                }            
            }
            $akun->update($input);

            return redirect()->route('akun.index')->with('info', 'Akun ' . $request->nama .' berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Server error,'.$th);
        }
        
    }

}

<?php

namespace App\Http\Controllers\Admin\Content;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\InformasiPublik;

class InformasiPublikController extends Controller
{
    public function index()
    {
        $informasi = InformasiPublik::orderBy('created_at','desc')->get();
        return view('admin.content.informasi-publik.index',compact('informasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:191',
            'deskripsi' => 'required'
        ]);

        $input = $request->all();

        if ($request->has('file')) {
            $fileName = str_replace(' ', '-', $request['judul']) . '.' . $request->file->getClientOriginalExtension();
            $request->file->storeAs('informasi_publik', $fileName, 'public_uploads');
            $input['file'] = $fileName;            
        }

        try {
            $laporan = InformasiPublik::create($input);
            return redirect()->back()->with('info', 'Informasi Publik Berhasil Ditambahkan!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Server error,'.$th);
        }

        
    }

    public function destroy($id)
    {
        try {
            InformasiPublik::find($id)->delete();
            return redirect()->back()->with('info', 'Informasi Publik Berhasil Dihapus');
        } catch (\Throwable $th) {
           return redirect()->back()->with('error', 'Server error,'.$th);
        }
       
    }
}

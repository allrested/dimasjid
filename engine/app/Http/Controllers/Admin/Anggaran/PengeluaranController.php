<?php

namespace App\Http\Controllers\Admin\Anggaran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Akun;
use App\Models\Anggaran;
use App\Models\Masjid;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class PengeluaranController extends Controller
{
    public function index()
    {
        $akun = Akun::whereRaw('LENGTH(kode) > 8')
        ->where(function ($query) {
            $query->where('kode', 'LIKE' , "5%");                  
        })->get();
        if (auth()->user()->role == 1 ){
            $anggaran = Anggaran::whereNull('deleted_at')->whereHas('accounts', function (Builder $query) {
                $query->where('kode', 'LIKE' , "5%"); 
            })->get();
            $masjid = Masjid::all();
        }else{
            $anggaran = Anggaran::whereNull('deleted_at')->where('masjid',auth()->user()->is_superuser)
            ->whereHas('accounts', function (Builder $query) {
                $query->where('kode', 'LIKE' , "5%"); 
            })->get();
            $masjid = Masjid::where('id',auth()->user()->is_superuser)->get();
        }
        return view('admin.anggaran.pengeluaran', compact('anggaran','akun', 'masjid'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required|max:255'
        ]);

        $input = $request->all();
        
        try {
            $anggaran = Anggaran::create($input);
            return redirect()->back()->with('info', 'Data Berhasil Ditambahkan!');
        } catch (\Throwable $th) {
            \Log::error( $th );
            return redirect()->back()->with('error', 'Server error,'.$th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            Anggaran::find($id)->delete();
            return redirect()->back()->with('info', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
           return redirect()->back()->with('error', 'Server error,'.$th->getMessage());
        }
       
    }

    public function show($id)
    {
        $anggaran = Anggaran::find($id);
        return response()->json($anggaran);
    }

    public function update(Request $request, $id)
    {
        try {
            $anggaran = Anggaran::where('id', $id);

            $input = $request->except(['_token', '_method']);

            $anggaran->update($input);

            return redirect()->route('anggaran.pengeluaran.index')->with('info', 'Data ' . $request->deskripsi .' berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Server error,'.$th->getMessage());
        }
        
    }

}

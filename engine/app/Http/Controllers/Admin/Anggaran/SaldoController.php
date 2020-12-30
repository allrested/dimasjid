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

class SaldoController extends Controller
{
    public function index()
    {
        $tahun = Anggaran::selectRaw('EXTRACT(YEAR FROM created_at) as year')->distinct()->get();
        return view('admin.anggaran.saldo', compact('tahun'));
    }

    public function dataMasjid(Request $request)
    {
    	$data = [];
        $data = Masjid::select("id","nama", "wilayah");
        if (auth()->user()->role != 1 ){
            $data = $data->where('id',auth()->user()->is_superuser);
        }
        if($request->has('q')){
            $search = $request->q;
            $data = $data->where('nama','ILIKE',"%$search%")->get();
        }else{
            $data = $data->take('6')->get();
        }
        return response()->json($data);
    }

    public function dataAkun(Request $request)
    {
    	$data = [];
        $data = Akun::select("id","kode","nama");
        $data = $data->where(function ($query) {
            $query->where('kode', 'NOT LIKE' , "4%")->where('kode', 'NOT LIKE' , "5%");                  
        });
        if($request->has('q')){
            $search = $request->q;
            $data = $data->where(function ($query) use ($search) {
                $query->where('kode','ILIKE',"$search%")->orWhere('nama','ILIKE',"%$search%");                  
            });
        }
        $data = $data->orderby('kode')->get();
        return response()->json($data);
    }

    public function getAll(Request $request){
        $anggaran = Anggaran::select();
        $anggaran->whereNull('deleted_at');
        $anggaran->whereHas('accounts', function (Builder $query) {
            $query->where('kode', 'NOT LIKE' , "4%")->where('kode', 'NOT LIKE' , "5%"); 
        });
        
        if (auth()->user()->role != 1 ){
            $anggaran->where('masjid',auth()->user()->is_superuser);
        }else{
            if($request->has('masjid')){
                $masjid = $request->masjid;
                if(!empty($masjid)){
                    $anggaran->where('masjid',$masjid);
                }
            }    
        }

        if($request->has('tahun')){
            $year = $request->tahun;
            if(!empty($year)){
                $anggaran->whereBetween('created_at',[$year.'-01-01',$year.'-12-31']);
            }
        }
        
        return DataTables::of($anggaran)
        ->filter(function ($query) use ($request) {
            if ($request->has('search') && ! is_null($request->get('search')['value']) ) {
                $kode = $request->get('search')['value'];
                if(!empty($kode)){
                    return $query->orWhereHas('accounts', function (Builder $q) use($kode)  {
                        $q->where('kode', 'LIKE' , "%$kode%"); 
                    });
                }
            }
        }, true)
        ->editColumn('created_at',function($row){
            return \Carbon\Carbon::parse($row->created_at)->isoFormat('LL');
        })->editColumn('deskripsi',function($row){
            if(is_null($row->deskripsi)){
                return "-";
            }else{
                return $row->deskripsi;
            }
        })->editColumn('jumlah',function($row){
            if(empty($row->jumlah)){
                return 0;
            }else{
                return number_format($row->jumlah, 0);
            }
        })->editColumn('kode',function($row){
            if(is_null($row->accounts)){
                return "-";
            }else{
                return $row->accounts->kode;
            }
        })
        ->addColumn('action', function ($row) {
            return "<a href='#' class='btn btn-primary btnEdit' title='Edit' data-id='$row->id'><i class='dripicons-pencil'></i></button></a>
                    <a href='#' class='btn btn-danger btnDelete' data-toggle='tooltip' data-placement='top' title='Delete' data-id='$row->id'>
                    <i class='dripicons-trash'></i></button></a>";
        })->rawColumns(['action','created_at','kode'])
        ->make(true);
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
            $anggaran = Anggaran::find($id);
            $status = $anggaran->delete();
            if($status){
                return 1;
            }else{
                return 0;
            }
            //return redirect()->back()->with('info', 'Data Berhasil Dihapus');
        } catch (\Throwable $th) {
            return 0;
           //return redirect()->back()->with('error', 'Server error,'.$th->getMessage());
        }
       
    }

    public function show($id)
    {
        $anggaran = DB::table('anggarans AS saldo')->selectRaw('saldo.*, (SELECT nama||\' - \'||wilayah FROM masjids WHERE masjids.id=masjid) AS nama_masjid, (SELECT kode||\' - \'||nama FROM accounts WHERE accounts.id=account) AS nama_akun')->find($id);
        return response()->json($anggaran);
    }

    public function update(Request $request, $id)
    {
        try {
            $anggaran = Anggaran::where('id', $id);

            $input = $request->except(['_token', '_method']);

            $anggaran->update($input);

            return redirect()->route('anggaran.saldo.index')->with('info', 'Data ' . $request->deskripsi .' berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Server error,'.$th->getMessage());
        }
        
    }

}

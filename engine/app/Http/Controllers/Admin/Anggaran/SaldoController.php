<?php

namespace App\Http\Controllers\Admin\Anggaran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Akun;
use App\Models\Anggaran;
use App\Models\Masjid;
use Yajra\DataTables\Facades\DataTables;
use App\Exports\NeracaExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use DB;

class SaldoController extends Controller
{
    public function index()
    {
        $akun = Akun::where(function ($query) {
            $query->where('kode', 'NOT LIKE' , "4%")->where('kode', 'NOT LIKE' , "5%");                  
        })->get();
        if (auth()->user()->role == 1 ){
            $masjid = Masjid::all();
        }else{
            $masjid = Masjid::where('id',auth()->user()->is_superuser)->get();
        }
        return view('admin.anggaran.saldo', compact('akun', 'masjid'));
    }
    public function getAll(Request $request){
        $anggaran = Anggaran::select();
        $anggaran->whereNull('deleted_at')->whereHas('accounts', function (Builder $query) {
            $query->where('kode', 'NOT LIKE' , "4%")->where('kode', 'NOT LIKE' , "5%"); 
        });
        if (auth()->user()->role != 1 ){
            $anggaran->where('masjid',auth()->user()->is_superuser);
        }
        
        if($request->has('tahun')){
            $year = $request->tahun;
            if(!empty($year)){
                $anggaran->whereBetween('created_at',[$year.'-01-01',$year.'-12-31']);
            }
        }
        
        return DataTables::of($anggaran)
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
        $anggaran = Anggaran::find($id);
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

    public function printNeraca(Request $request){
        $data['filters'] = '';
        $masjid = 2;
        $year = \Carbon\Carbon::now()->format('Y');
        $akun = DB::table('accounts AS acc')->selectRaw("kode, nama, (SELECT COALESCE(SUM(jumlah),0) FROM anggarans LEFT JOIN accounts ON anggarans.account=accounts.id WHERE accounts.kode LIKE acc.kode||'%' AND masjid=$masjid AND EXTRACT(YEAR FROM anggarans.created_at) = '$year') AS jumlah");
        $data['filters'] .= "Periode ".$year;
        $data['akun'] = $akun->whereRaw('LENGTH(kode) < 8')->where('kode', 'NOT LIKE' , "4%")->where('kode', 'NOT LIKE' , "5%")->orderBy('kode')->get();
        $data['masjid'] = 'Masjid Alfurqon'; 
        if($request->is_pdf == 1){
            return view('admin.laporan.neraca',$data);
        }
        return Excel::download(new NeracaExport($request), "Laporan Neraca Periode $year.xlsx");
    }

}

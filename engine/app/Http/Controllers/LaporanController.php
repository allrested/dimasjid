<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\NeracaExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use DB;

class LaporanController extends Controller
{
    public function print(Request $request){
        $data['filters'] = '';
        $masjid = $request->masjid;
        $tipe = $request->tipe;
        if(empty($tipe)){
            $tipe = "neraca";
        }
        $year = $request->tahun;
        if(empty($year)){
            $year = \Carbon\Carbon::now()->format('Y');
        }
        $akun = DB::table('accounts AS acc')->selectRaw("kode, nama, (SELECT COALESCE(SUM(jumlah),0) FROM anggarans LEFT JOIN accounts ON anggarans.account=accounts.id WHERE accounts.kode LIKE acc.kode||'%' AND masjid=$masjid AND EXTRACT(YEAR FROM anggarans.created_at) = '$year') AS jumlah");
        $data['filters'] .= "Periode ".$year;
        $data['masjid'] = '';
        if($masjid){
            $data['masjid'] = DB::table('masjids')->find($masjid);
        }
        if(empty($data['masjid'])){
            return view('admin.laporan.gagal',$data);
        }
        switch ($tipe) {
            case "neraca":
              $data['akun'] = $akun->whereRaw('LENGTH(kode) < 8')->where('kode', 'NOT LIKE' , "4%")->where('kode', 'NOT LIKE' , "5%")->orderBy('kode')->get();
              break;
            case "operasional":
              $data['akun'] = $akun->whereRaw('LENGTH(kode) < 8')->where(function ($query) {
                $query->where('kode', 'LIKE' , "4%")->orWhere('kode', 'LIKE' , "5%");                  
            })->orderBy('kode')->get();
              break;
            case "calk":
              return Excel::download(new NeracaExport($request), "Laporan Keuangan Periode $year.xlsx");
              break;
            case "penerimaan":
              return Excel::download(new NeracaExport($request), "Buku Kas Penerimaan Periode $year.xlsx");
              break;
            case "pengeluaran":
              return Excel::download(new NeracaExport($request), "Buku Kas Pengeluaran Periode $year.xlsx");
              break;
            case "periode":
              return Excel::download(new NeracaExport($request), "Buku Kas Harian Periode $year.xlsx");
              break;
            default:
              $data['akun'] = $akun->whereRaw('LENGTH(kode) < 8')->where('kode', 'NOT LIKE' , "4%")->where('kode', 'NOT LIKE' , "5%")->orderBy('kode')->get();
          }
        if($request->is_pdf == 1){
            return view('admin.laporan.'.$tipe,$data);
        }
        switch ($tipe) {
            case "neraca":
              return Excel::download(new NeracaExport($request), "Laporan Neraca Periode $year.xlsx");
              break;
            case "operasional":
              return Excel::download(new NeracaExport($request), "Laporan Operasional Periode $year.xlsx");
              break;
            case "calk":
              return Excel::download(new NeracaExport($request), "Laporan Keuangan Periode $year.xlsx");
              break;
            case "penerimaan":
              return Excel::download(new NeracaExport($request), "Buku Kas Penerimaan Periode $year.xlsx");
              break;
            case "pengeluaran":
              return Excel::download(new NeracaExport($request), "Buku Kas Pengeluaran Periode $year.xlsx");
              break;
            case "periode":
              return Excel::download(new NeracaExport($request), "Buku Kas Harian Periode $year.xlsx");
              break;
            default:
              return Excel::download(new NeracaExport($request), "Laporan Neraca Periode $year.xlsx");
          }
    }
}

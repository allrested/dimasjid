<?php

namespace App\Exports;

use DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
class NeracaExport implements FromView, ShouldAutoSize, WithEvents
{
    use Exportable;
    public function __construct(Request $request){
        $this->request = $request;
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getColumnDimension('A')->setWidth(5);
                $request = $this->request;
                $masjid = $request->masjid;
                $year = $request->tahun;
                if(empty($year)){
                    $year = \Carbon\Carbon::now()->format('Y');
                }
                $akun = DB::table('accounts AS acc')->selectRaw("kode, nama, (SELECT COALESCE(SUM(jumlah),0) FROM anggarans LEFT JOIN accounts ON anggarans.account=accounts.id WHERE accounts.kode LIKE acc.kode||'%' AND masjid=$masjid AND EXTRACT(YEAR FROM anggarans.created_at) = '$year') AS jumlah");
                $akun = $akun->whereRaw('LENGTH(kode) < 8')->where('kode', 'NOT LIKE' , "4%")->where('kode', 'NOT LIKE' , "5%")->orderBy('kode');
                $event->sheet->styleCells(
                    'A4:C4',
                    [
                        'font' => ['bold' => true],
                    ]
                );
                $count = $akun->get()->count();
                $cellContent = "A4:C".($count+4);
                $event->sheet->styleCells(
                    $cellContent,
                    [
                        'borders' => [
                            'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
                        ]
                    ]
                );
            }
        ];
    }
    public function view(): View
    {
        $request = $this->request;
        $data['filters'] = '';
        $request = $this->request;
        $masjid = $request->masjid;
        $year = $request->tahun;
        if(empty($year)){
            $year = \Carbon\Carbon::now()->format('Y');
        }
        $akun = DB::table('accounts AS acc')->selectRaw("kode, nama, (SELECT COALESCE(SUM(jumlah),0) FROM anggarans LEFT JOIN accounts ON anggarans.account=accounts.id WHERE accounts.kode LIKE acc.kode||'%' AND masjid=$masjid AND EXTRACT(YEAR FROM anggarans.created_at) = '$year') AS jumlah");
        $data['filters'] .= "Periode ".$year;
        $data['akun'] = $akun->whereRaw('LENGTH(kode) < 8')->where('kode', 'NOT LIKE' , "4%")->where('kode', 'NOT LIKE' , "5%")->orderBy('kode')->get();
        $data['masjid'] = '';
        if($masjid){
            $data['masjid'] = DB::table('masjids')->find($masjid);
        }
        if(empty($data['masjid'])){
            return view('admin.laporan.gagal',$data);
        }
        return view('admin.laporan.neraca',$data);
    }
}

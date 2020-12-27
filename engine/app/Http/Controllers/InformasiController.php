<?php

namespace App\Http\Controllers;

use App\Models\InformasiPublik;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    public function informasi()
    {
        $informasi = InformasiPublik::orderBy('created_at','desc')->get();
        return view('front.informasi.informasi',compact('informasi'));
    }

    public function detail_informasi()
    {
        return view('front.informasi.detail_informasi');
    }
}

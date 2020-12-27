<?php

namespace App\Http\Controllers;

use App\Models\KontakKami;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        return view('front.kontak');
    }

    public function store(Request $request)
    {           
        $request->validate([
            'nama' => 'required|max:191',
            'email' => 'required|email',
            'komentar' => 'required'
        ]);

     try {
        KontakKami::create($request->all());        
        return redirect()->back()->with('info', 'Terima Kasih. Pesan anda telah kami terima');
     } catch (\Throwable $th) {
        return redirect()->back()->with('error', 'Server bermasalah, silahkan coba lagi');
     }
        
    }
}

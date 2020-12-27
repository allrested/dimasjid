<?php

namespace App\Http\Controllers\Admin\Content;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KontakKami;

class KontakKamiController extends Controller
{
    public function index(){
        $kontak = KontakKami::all();
        return view('admin.content.kontak.index', compact('kontak'));
    }
}

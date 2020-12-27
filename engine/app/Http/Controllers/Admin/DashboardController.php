<?php

namespace App\Http\Controllers\Admin;

use Auth;

use App\Models\Announce;
use App\Models\Agenda;
use App\Models\Balai;
use App\Models\Berita;
// use App\Models\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class DashboardController extends Controller
{
    public function index(){

        $data['c_agenda'] = Agenda::count();
        $data['c_berita'] = Berita::count();
        $data['announces'] = Announce::all();

        // dd($data);

        return view('admin.dashboard', $data);
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Announce;
use App\Models\Banner;
use App\Models\Gallery;
use App\Models\Agenda;
use App\Models\Link;
use App\Models\Video;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index($masjid = "SISTAMAS")
    {
        $data['agendas'] = Agenda::whereMonth('time_start', Carbon::now()->month)->orderBy('time_start', 'DESC')->take(4)->get();
        $data['banners'] = Banner::where('status', 1)->get();
        $data['announces'] = Announce::all();
        $data['videos'] = Video::orderBy('created_at', 'DESC')->take(4)->get();
        $data['links'] = Link::all();
        $data['galleries'] = Gallery::where('id_bidang',0)->orderBy('created_at', 'DESC')->take(10)->get();
        
        return view('front.home')->with($data);
    }
}

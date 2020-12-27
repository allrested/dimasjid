<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        $agendas = Agenda::whereMonth('time_start', Carbon::now()->month)->orderBy('time_start', 'DESC')->paginate(6);        
        return view('front.agenda.agenda', compact('agendas'));
    }
    public function show($id)
    {   
        $agenda = Agenda::where('id',$id)->first();
        $terbaru = Agenda::where('id_bidang',$agenda->id_bidang)->get();
        return view('front.agenda.detail_agenda',compact('agenda','terbaru'));
    }
}

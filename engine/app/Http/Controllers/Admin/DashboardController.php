<?php

namespace App\Http\Controllers\Admin;

use Auth;

use App\Models\Announce;
use App\Models\Agenda;
use App\Models\Masjid;
use App\Models\Berita;
use App\Models\User;
use App\Models\Anggaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class DashboardController extends Controller
{
    public function index(){
        if (auth()->user()->role == 1 ){
            $data['c_agenda'] = Agenda::count();
            $data['c_berita'] = Berita::count();
            $data['c_masjid'] = Masjid::where('status',1)->get()->count();
            $data['c_penerimaan'] = Anggaran::whereNull('deleted_at')->whereHas('accounts', function (Builder $query) {
                $query->where('status', '=' , 1); 
            })->get()->sum('jumlah');
            $data['c_pengeluaran'] = Anggaran::whereNull('deleted_at')->whereHas('accounts', function (Builder $query) {
                $query->where('status', '=' , 2); 
            })->get()->sum('jumlah');
            $data['c_user'] = User::where('is_active',1)->get()->count();
            $data['announces'] = Announce::all();
            return view('admin.dashboard', $data);
        }else{
            $data['c_agenda'] = Agenda::count();
            $data['c_berita'] = Berita::count();
            $data['c_announce'] = Announce::count();
            $data['c_penerimaan'] = Anggaran::whereNull('deleted_at')->where('masjid',auth()->user()->is_superuser)->whereHas('accounts', function (Builder $query) {
                $query->where('status', '=' , 1); 
            })->get()->sum('jumlah');
            $data['c_pengeluaran'] = Anggaran::whereNull('deleted_at')->where('masjid',auth()->user()->is_superuser)->whereHas('accounts', function (Builder $query) {
                $query->where('status', '=' , 2); 
            })->get()->sum('jumlah');
            $data['c_user'] = User::where('is_active',1)->where('is_superuser',auth()->user()->is_superuser)->get()->count();
            $data['announces'] = Announce::all();
            return view('admin.dashboard_user', $data);
        }
        
    }
}

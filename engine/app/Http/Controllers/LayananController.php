<?php

namespace App\Http\Controllers;

use Hash;
use App\Models\Masjid;
use App\Models\Wilayah;
use App\Models\User;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function layanan()
    {
        return view('front.layanan.layanan');
    }

    public function daftarMasjid(Request $req)
    {
        $masjid = $req->only('wilayah', 'kode', 'nama', 'alamat');
        $masjid['status'] = 0;
        $id = Masjid::create($masjid)->id;

        $user = $req->only('name', 'email');
        $user['role'] = 2;
        $user['is_superuser'] = $id;
        $user['is_active'] = 0;
        $user['password'] = Hash::make('sistamas');
        $query = User::create($user);
        return redirect('layanan')->with('info', 'Permintaan berhasil dikirim.');
    }

    public function dataAjax(Request $request)
    {
    	$data = [];

        if($request->has('q')){
            $search = $request->q;
            $data =Wilayah::select("kode","nama")
            		->where('nama','ILIKE',"%$search%")->whereRaw('LENGTH(kode) < 9')
            		->get();
        }
        return response()->json($data);
    }
}

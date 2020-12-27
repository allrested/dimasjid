<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Comment;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function berita()
    {
        $data['beritas'] = Berita::orderBy('id', 'DESC')->paginate(9);
        return view('front.berita.berita', $data);
    }

    public function detail_berita($slug)
    {
        $data['berita'] = Berita::where('slug', $slug)->first();        
        $data['comments'] = $data['berita']->comments()->get();        
        $data['related'] = Berita::where('category', $data['berita']->category)->whereNotIn('id', [$data['berita']->id])->take(2)->get();
        $data['terbaru'] = Berita::orderBy('id', 'DESC')->whereNotIn('id', [$data['berita']->id])->take(5)->get();
        return view('front.berita.detail_berita', $data);
    }

    public function add_comments(Request $request)
    {
        try {
            $status = Comment::create($request->all());
            if($status){
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }
}

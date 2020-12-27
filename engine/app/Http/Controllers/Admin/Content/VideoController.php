<?php

namespace App\Http\Controllers\Admin\Content;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::orderBy('id', 'DESC')->get();
        return view('admin.content.video.index', compact('videos'));
    }

    public function store(Request $request)
    {
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*/';

        $request->validate([
            'judul' => 'required|max:255',
            'link' => 'required|regex:'.$regex 
        ]);

        try {
            $input = $request->all();
            parse_str(parse_url($input['link'], PHP_URL_QUERY), $query);
            $input['link'] = "https://www.youtube.com/embed/" . $query['v'];
            Video::create($input);
            return redirect()->route('videos.index')->with('info', 'Video berhasil dibuat');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Server error,'.$th);
        }
        
    }

    public function update(Request $request, $id)
    {
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*/';

        $request->validate([
            'judul' => 'required|max:255',
            'link' => 'required|regex:'.$regex 
        ]);
        
        try {
            $video = Video::where('id', $id);

            $input = $request->except(['_token', '_method']);

            $video->update($input);

            return redirect()->route('videos.index')->with('info', 'Video berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Server error,'.$th);
        }
        
    }

    public function destroy($id)
    {
        try {
            $video = Video::find($id);
            $video->delete();
    
            return redirect()->route('videos.index')->with('info', 'Video berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Server error,'.$th);
        }
       
    }
}

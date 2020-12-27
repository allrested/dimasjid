<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = [
        'full_name',
        'email',
        'content',
        'id_berita'
    ];  

    public function berita()
    {
        return $this->belongsTo('App\Models\Berita', 'id_berita');
    }
}

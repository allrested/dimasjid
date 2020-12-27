<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = "beritas";
    protected $fillable = [
        'id_user',
        'title',
        'slug',
        'content',
        'category',
        'image',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user', 'id');
    }
    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'id_berita', 'id');
    }
}

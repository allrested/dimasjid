<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'galleries';
    protected $guarded = [
        "id"
    ];

    public function bidangutama()
    {
        return $this->belongsTo('App\Models\BidangUtama');
    }
}

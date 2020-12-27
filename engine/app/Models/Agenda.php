<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    
    protected $dates = ['time_start','time_end'];
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function bidangutama()
    {
        return $this->belongsTo('App\Models\BidangUtama', 'id_bidang');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Masjid extends Model
{
    protected $table = "masjids";
    protected $primaryKey = "id";
    protected $guarded = ['id'];

    public function daerah()
    {
        return $this->hasOne('App\Models\Wilayah','nama','wilayah');
    }
}

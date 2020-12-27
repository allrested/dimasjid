<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anggaran extends Model
{
    use SoftDeletes;
    protected $table = "anggarans";
    protected $primaryKey = "id";
    protected $guarded = ['id'];
	protected $dates = ['created_at','updated_at','deleted_at'];
    
    public function accounts()
    {
        return $this->hasOne('App\Models\Akun','id','account');
    }
    public function masjids()
    {
        return $this->hasOne('App\Models\Masjid','id','masjid');
    }
}

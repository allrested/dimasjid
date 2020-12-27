<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Sosmed extends Model
{
    protected $table="sosmeds";
    protected $guarded = ['id'];

    public function setPassword($value){
        $this->attributes['password'] = Crypt::encrypt($value);
    }

    public function getPassword(){
        return Crypt::decrypt($this->attributes['password']);            
    }
}

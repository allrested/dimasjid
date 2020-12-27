<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Urusan extends Model
{
    protected $table = "urusan";
    protected $primaryKey = "id";
    protected $fillable = [
        'kode_urusan',
        'nama_urusan',
        'tahun'
    ];
}

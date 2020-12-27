<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    protected $table = "accounts";
    protected $primaryKey = "id";
    protected $guarded = ['id'];

}

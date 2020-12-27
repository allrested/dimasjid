<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SyncApi extends Model
{
    protected $table="sync_api_schedule";
    protected $guarded = ['id'];
}

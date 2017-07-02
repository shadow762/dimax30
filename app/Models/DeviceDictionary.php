<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceDictionary extends Model
{
    protected $fillable = ['brend', 'type', 'model'];

    public $timestamps = false;
}
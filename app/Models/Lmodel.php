<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lmodel extends Model
{
    public function brend() {
        return $this->belongsTo('App\Models\Brend');
    }
    public function type() {
        return $this->belongsTo('App\Models\Type');
    }
}
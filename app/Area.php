<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $guarded = [];

    public function district(){
    	return $this->belongsTo(\App\District::class);
    }
}

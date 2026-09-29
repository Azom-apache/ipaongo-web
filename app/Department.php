<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $guarded = [];

    public function profiles(){
    	return $this->hasMany(\App\Profile::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    // each image might belongs to an user
    public function addedBy()
    {
        return $this->belongsTo('App\Product','product_id');
    }
}

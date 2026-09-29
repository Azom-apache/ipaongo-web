<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $guarded = [];

    // /**
    //  * The attributes that should be cast to native types.
    //  *
    //  * @var array
    //  */
    // protected $casts = [
    //     'hassize' => 'boolean',
    //     'hascolor' => 'boolean',
    //     'brand_id' => 'integer',
    //     'category_id' => 'integer',
    //     'order' => 'integer',
    //     'addedby_id' => 'integer',
    //     'editedby_id' => 'integer',
    // ];


    // each product might have many product images
    public function images()
    {
        return $this->hasMany(Image::class,'product_id');
    }

    // each product might belongs to an user
    public function product()
    {
        return $this->belongsTo('App\Product','product_id');
    }

    // each product might belongs to an user
    public function addedBy()
    {
        return $this->belongsTo('App\User','addedby_id');
    }

    public function editedBy()
    {
        return $this->belongsTo('App\User','editedby_id');
    }

}

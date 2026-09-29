<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'qty' => 'integer'
    ];

    //each orderitem might have one parent product
    public function product() {
        return $this->belongsTo('App\Product', 'product_id');
    }
}

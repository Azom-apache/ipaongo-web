<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{

    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'rating' => 'float',
        'helpful' => 'boolean',
        'review' => 'string',
        'product_id' => 'integer',
        'user_id' => 'integer',
    ];


    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    // each product might belongs to an user
    public function postedBy()
    {
        return $this->belongsTo('App\User','user_id');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{

    protected $guarded = [];

    public static function getBrands()
    {
        return static::orderBy('order')
        ->get();
    }

    //each brand might have products
    public function products() {
        return $this->hasMany('App\Product', 'brand_id');
    }

    // each category might belongs to an user
    public function addedBy()
    {
        return $this->belongsTo('App\User','addedby_id');
    }

    public function editedBy()
    {
        return $this->belongsTo('App\User','editedby_id');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class News extends Model
{
	protected $guarded = [];

    // each courses might belongs to an user
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

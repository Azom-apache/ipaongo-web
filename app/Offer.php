<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'display_after' => 'integer',
        'type' => 'integer',
        'addedby_id' => 'integer',
        'editedby_id' => 'integer',
    ];

    public function getCategory() {
        return $this->belongsTo('App\Category','display_after','id');
    }


    public function addedBy()
    {
        return $this->belongsTo('App\User','addedby_id');
    }

    public function editedBy()
    {
        return $this->belongsTo('App\User','editedby_id');
    }
}

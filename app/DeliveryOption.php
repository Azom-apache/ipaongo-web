<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryOption extends Model
{
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'region', 'area', 'addedby_id', 'editedby_id'
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'cash_on_delivery' => 'boolean',
    ];

    public function addedBy()
    {
        return $this->belongsTo('App\User','addedby_id');
    }

    public function editedBy()
    {
        return $this->belongsTo('App\User','editedby_id');
    }
}

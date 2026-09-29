<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{

    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
        'question' => 'string',
        'answer' => 'string',
        'product_id' => 'integer',
        'askby_id' => 'integer',
        'ansby_id' => 'integer',
    ];


    public function product() {
        return $this->belongsTo(Product::class);
    }

    // each product might belongs to an user
    public function askBy()
    {
        return $this->belongsTo('App\User','askby_id');
    }
    // each product might belongs to an user
    public function ansBy()
    {
        return $this->belongsTo('App\User','ansby_id');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    protected $appends = ['full_url','update_url','edit_url','invoice_url','destroy_url','created_date','order_item_codes'];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $with = ['editedBy','orderBy'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'pending_at',
        'confirmed_at',
        'shipped_at',
        'delivered_at',
        'cancelled_at',
        'returned_at'
    ];


    // each category might belongs to an user
    public function orderBy()
    {
        return $this->belongsTo('App\User','orderby_id');
    }

    public function editedBy()
    {
        return $this->belongsTo('App\User','editedby_id');
    }
    public function orderItems() {
        return $this->hasMany('App\OrderItem', 'order_id');
    }

    /**
     * Get the route url.
     *
     * @param  string  $value
     * @return string
     */
    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function getFullUrlAttribute()
    {
        return route('admin.orders.show',$this->id);
    }

    public function getUpdateUrlAttribute()
    {
        return route('admin.orders.update',$this->id);
    }
    public function getEditUrlAttribute()
    {
        return route('admin.orders.edit',$this->id);
    }

    public function getInvoiceUrlAttribute()
    {
        return route('admin.orders.print',$this->id);
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->format('d-m-Y h:i A');
    }
    public function getDestroyUrlAttribute()
    {
        return route('admin.orders.destroy',$this->id);
    }

    public function getOrderItemCodesAttribute()
    {
        return $this->orderItems->implode('code', ', ');
    }


    public function deliveryAddress()
    {
        return $this->belongsTo(DeliveryOption::class,'delivery_options_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'subcat_id',
        'subsubcat_id',
        'project_name',
        'subcat_name',
        'subsubcat_name',
        'budget',
        'quantity',
        'usd',
        'donor_name',
        'address',
        'country',
        'email',
        'contact',
        'image',
        'tran_id',
        'payment_status',
        'payment_currency',
        'paid_amount',
        'val_id',
        'bank_tran_id',
        'card_type',
        'card_no',
        'card_issuer',
        'payment_message',
        'paid_at',
        'donated_at'
    ];

    protected $casts = [
        'budget' => 'decimal:2',
        'usd' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'donated_at' => 'datetime',
        'paid_at' => 'datetime',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function subcat()
    {
        return $this->belongsTo(Project::class, 'subcat_id');
    }

    public function subsubcat()
    {
        return $this->belongsTo(Project::class, 'subsubcat_id');
    }
}

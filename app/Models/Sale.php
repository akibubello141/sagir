<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'cashier_id',
        'customer_id',
        'total_amount',
        'payment_method',
        'part_payment',
    ];

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

   
}
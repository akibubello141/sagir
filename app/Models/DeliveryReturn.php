<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryReturn extends Model
{
    //
    protected $fillable = [
        'delivery_load_id',
        'product_id',
        'quantity',
        'reason',
        'remarks',
        'cash_collected',
        'expected_amount',
        'difference',
        'cashier_id'
    ];

    public function deliveryLoad()
    {
        return $this->belongsTo(
            DeliveryLoad::class
        );
    }

    public function product()
    {
        return $this->belongsTo(
            Product::class
        );
    }
}

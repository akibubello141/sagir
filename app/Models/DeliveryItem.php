<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryItem extends Model
{
    //
    protected $fillable = [
        'delivery_load_id',
        'product_id',
        'quantity_loaded'
    ];

    public function deliveryLoad()
    {
        return $this->belongsTo(DeliveryLoad::class);
    }
}

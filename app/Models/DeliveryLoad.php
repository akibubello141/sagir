<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryLoad extends Model
{
    //
    protected $fillable = [
        'driver_id',
        'supervisor_id',
        'delivery_date',
        'status'
    ];

        public function driver()
    {
        return $this->belongsTo(
            Driver::class
        );
    }

    public function deliveryItems()
    {
        return $this->hasMany(
            DeliveryItem::class
        );
    }
}

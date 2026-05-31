<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryReturn extends Model
{
    //
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

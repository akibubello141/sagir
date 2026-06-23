<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class production_records extends Model
{
    //
     protected $fillable = [
        'poducer_name',
        'supervisor_id',
        'product_id',
        'quantity_produced',
        'damaged_quantity',
        'returned_quantity',
        'shifting',
    ];

    public function product()
    {
        return $this->belongsTo(
            Product::class
        );
    }
}

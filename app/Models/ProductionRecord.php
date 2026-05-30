<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductionRecord extends Model
{
    //
    protected $fillable = [
        'supervisor_id',
        'product_id',
        'quantity_produced',
        'damaged_quantity',
        'returned_quantity',
    ];

}

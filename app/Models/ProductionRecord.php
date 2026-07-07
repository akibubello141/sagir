<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductionRecord extends Model
{
    //
    protected $fillable = [
        'production_site',
        'producer_name',
        'product_id',
        'kg_collected',
        'kg_used',
        'kg_left',
        'bags_per_kg',
        'quantity_produced',
        'damaged_quantity',
        'returned_quantity',
        'shifting',
        'remarks',
        'supervisor_id',
        'production_date'
    ];

     public function product()
{
    return $this->belongsTo(Product::class);
}

}

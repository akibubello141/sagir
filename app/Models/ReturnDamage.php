<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnDamage extends Model
{
    //
     protected $fillable = [
        'product_id',
        'returned_by',
        'type',
        'quantity',
        'reason',
        'supervisor_id',
        'record_date'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

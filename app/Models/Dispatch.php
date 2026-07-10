<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dispatch extends Model
{
    protected $fillable = [
        'product_id',
        'supervisor_id',
        'vehicle',
        'driver_name',
        'production_site',
        'shifting', 
        'dispatch_date',
        'quantity_made',
        'quantity_produced',
        'quantity_dispatched',
        'linkage',
        'refill',
        'quantity_left',
        'remarks'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }
}

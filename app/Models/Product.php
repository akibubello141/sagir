<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'stock_quantity',
        'low_stock_limit',
    ];

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }
}
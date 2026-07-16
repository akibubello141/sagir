<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashierSale extends Model
{
    //
    protected $fillable = [
    'vehicle',
    'bags_sold',
    'total_amount',
    'linkages',
    'linkage_amount',
    'plus',
    'plus_amount',
    'vehicle_fuel',
    'vehicle_exp',
    'credit',
    'transfer',
    'paid_credit',
    'special_exp1',
    'special_exp2',
    'gross',
    'total_balance',
    'cashier_id',
    'sales_date',
    'product_id',
    'customer_id'
];

    public function customer()
        {
            return $this->belongsTo(Customer::class);
        }
     public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

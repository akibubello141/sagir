<?php

namespace App\Http\Controllers\cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ReturnDamage;

class ReturnDamageController extends Controller
{
    //
     // RETURN & DAMAGE

    public function returns()
    {
        $products = Product::all();

        $records = ReturnDamage::latest()->get();

        return view(
            'cashier.returns',
            compact('products', 'records')
        );
    }

        public function storeReturn(Request $request)
    {
        ReturnDamage::create([
            'product_id' => $request->product_id,
            'returned_by' => $request->returned_by,
            'type' => $request->type,
            'quantity' => $request->quantity,
            'reason' => $request->reason,
            'supervisor_id' => auth()->id(),
            'record_date' => now(),
        ]);

        return back()->with(
            'success',
            'Record saved successfully'
        );
    }
}

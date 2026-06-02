<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DeliveryLoad;
use App\Models\DeliveryItem;
use App\Models\Product;
use App\Models\DeliveryReturn;

class DeliveryReturnController extends Controller
{
    //Show Return Form

            public function create()
        {
            $deliveries = DeliveryLoad::with('driver')
                ->where('status','pending')
                ->get();

            return view(
                'cashier.driver-return',
                compact('deliveries')
            );
        }

        //Save Return
                public function store(Request $request)
        {
            $delivery = DeliveryLoad::findOrFail($request->delivery_load_id);


            $item = DeliveryItem::where('delivery_load_id',$delivery->id)->first();

            $product = Product::findOrFail($item->product_id);

            request()->validate([
                'quantity_returned' => 'required|numeric|min:0|max:' . $item->quantity_loaded,
                'cash_collected' => 'required|numeric|min:0',
                'remarks' => 'nullable|string|max:255',
            ]);

            $sold = $item->quantity_loaded - $request->quantity_returned;

            $expected = $sold *  $product->price;

            $difference =$request->cash_collected - $expected;

            DeliveryReturn::create(['delivery_load_id' =>$delivery->id,'product_id' =>$product->id,'quantity_returned' =>$request->quantity_returned,'cash_collected' =>$request->cash_collected,'expected_amount' =>$expected,'difference' =>$difference,'cashier_id' => auth()->user()->id,'remarks' =>$request->remarks
            ]);

            // Add returned stock back

            $product->increment(
                'stock_quantity',
                $request->quantity_returned
            );

            $delivery->update([
                'status' => 'completed'
            ]);

            return back()->with(
                'success',
                'Driver return recorded successfully'
            );
        }
}

<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Driver;
use App\Models\DeliveryLoad;
use App\Models\DeliveryItem;

class DeliveryController extends Controller
{
    public function create()
    {
        $products = Product::all();
        $drivers = Driver::all();

        return view(
            'supervisor.load-products',
            compact(
                'products',
                'drivers'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'driver_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail(
            $request->product_id
        );

        if (
            $request->quantity >
            $product->stock_quantity
        ) {
            return back()->with(
                'error',
                'Insufficient stock available.'
            );
        }

        $delivery = DeliveryLoad::create([
            'driver_id' => $request->driver_id,
            'supervisor_id' => auth()->id(),
            'delivery_date' => now(),
            'status' => 'pending'
        ]);

        DeliveryItem::create([
            'delivery_load_id' => $delivery->id,
            'product_id' => $request->product_id,
            'quantity_loaded' => $request->quantity
        ]);

        // Reduce stock
        $product->decrement(
            'stock_quantity',
            $request->quantity
        );

        return redirect()
            ->back()
            ->with(
                'success',
                'Product loaded successfully.'
            );
    }

    //delivary history, update status, etc. can be added here
            public function history()
        {
            $loads = DeliveryLoad::with(
                'driver'
            )->latest()->get();

            return view(
                'supervisor.delivery-history',
                compact('loads')
            );
        }
}
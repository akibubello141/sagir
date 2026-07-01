<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\ProductionRecord;


class StockController extends Controller
{
    //
    // STOCK PAGE
    public function stock()
    {
        $products = Product::all();

        return view(
            'cashier.stock',
            compact('products')
        );
    }

    // ADD STOCK
    public function addStock(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        $product->increment(
            'stock_quantity',
            $request->quantity
        );

        StockMovement::create([
            'product_id' => $request->product_id,
            'type' => 'in',
            'quantity' => $request->quantity,
            'note' => 'Stock Added',
            'user_id' => auth()->id(),
        ]);

        return back()->with(
            'success',
            'Stock added successfully'
        );
    }

    // PRODUCTION PAGE
    public function production(Request $request)
    {

       $query = ProductionRecord::query();

        // Search by Date
      

         if ($request->sales_date && $request->sales_date1) {

             $query->whereBetween('production_date', [
                $request->sales_date ,
                $request->sales_date1
            ]);
        }

        // Search by producer
        if ($request->filled('producer')) {
            $query->where('producer_name', 'like', '%' . $request->producer . '%');
        }

        // Search by product
        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        // Search by schedule
        if ($request->filled('shifting')) {
            $query->where('shifting', $request->shifting);
        }
    

        $productions = $query
            ->latest()
            ->paginate($request->per_page ?? 10)
            ->withQueryString();        


        $producers = ProductionRecord::all();
        $products = product::all();
        $totalProduction = ProductionRecord::sum('quantity_produced');


        return view(
            'cashier.production',
            compact(
             
                'totalProduction',
                'productions',
                'producers',
                'products'
            )
        );
    }

    // SAVE PRODUCTION
    public function saveProduction(Request $request)
    {
        ProductionRecord::create([
            'producer_name' => $request->producer_name,
            'product_id' => $request->product_id,
            'quantity_produced' => $request->quantity_produced,
            'damaged_quantity' => $request->damaged_quantity,
            'returned_quantity' => $request->returned_quantity,
            'shifting' => $request->shifting,
            'supervisor_id' => auth()->id(),
            'production_date' => now(),
        ]);

        // increase stock
        Product::where(
            'id',
            $request->product_id
        )->increment(
            'stock_quantity',
            $request->quantity_produced
        );

        return back()->with(
            'success',
            'Production recorded'
        );
    }

    // CASHIER ACTIVITIES
    public function cashierActivities()
    {
        $sales = Sale::with('customer')
            ->latest()
            ->get();

        return view(
            'supervisor.cashier-activities',
            compact('sales')
        );
    }

    // CORRECTIONS
    public function corrections()
    {
        $corrections = SaleCorrection::latest()->get();

        return view(
            'supervisor.corrections',
            compact('corrections')
        );
    }

    // APPROVE CORRECTION
    public function approveCorrection($id)
    {
        $correction = SaleCorrection::findOrFail($id);

        $correction->update([
            'status' => 'approved',
            'approved_by' => auth()->id(),
        ]);

        return back()->with(
            'success',
            'Correction approved'
        );
    }

}

<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use App\Models\ProductionRecord;
use App\Models\StockMovement;
use App\Models\SaleCorrection;

class SupervisorController extends Controller
{
    public function dashboard()
    {
        $products = Product::count();

        $todaySales = Sale::whereDate(
            'created_at',
            today()
        )->sum('total_amount');

        $lowStock = Product::whereColumn(
            'stock_quantity',
            '<=',
            'low_stock_limit'
        )->count();

        return view(
            'supervisor.dashboard',
            compact(
                'products',
                'todaySales',
                'lowStock'
            )
        );
    }

    // STOCK PAGE
    public function stock()
    {
        $products = Product::all();

        return view(
            'supervisor.stock',
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
    public function production()
    {
        $products = Product::all();

        $records = ProductionRecord::latest()->get();

        return view(
            'supervisor.production',
            compact('products', 'records')
        );
    }

    // SAVE PRODUCTION
    public function saveProduction(Request $request)
    {
        ProductionRecord::create([
            'product_id' => $request->product_id,
            'quantity_produced' => $request->quantity_produced,
            'damaged_quantity' => $request->damaged_quantity,
            'returned_quantity' => $request->returned_quantity,
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
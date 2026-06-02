<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use App\Models\ProductionRecord;
use App\Models\StockMovement;
use App\Models\SaleCorrection;
use App\Models\ReturnDamage;

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

        $totalDrivers = \App\Models\Driver::count();

        return view(
            'supervisor.dashboard',
            compact(
                'products',
                'todaySales',
                'lowStock',
                'totalDrivers'
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

    //report
    public function report()
{
    // TOTAL PRODUCTION
    $totalProduction = \App\Models\ProductionRecord::sum(
        'quantity_produced'
    );

    // TOTAL DAMAGED
    $damagedProducts = \App\Models\ProductionRecord::sum(
        'damaged_quantity'
    );

    // TOTAL RETURNS
    $returnedProducts = \App\Models\ProductionRecord::sum(
        'returned_quantity'
    );

    // STOCK IN
    $stockIn = \App\Models\StockMovement::where(
        'type',
        'in'
    )->sum('quantity');

    // STOCK OUT
    $stockOut = \App\Models\StockMovement::where(
        'type',
        'out'
    )->sum('quantity');

    // LOW STOCK PRODUCTS
    $lowStockProducts = \App\Models\Product::whereColumn(
        'stock_quantity',
        '<=',
        'low_stock_limit'
    )->get();

    // CASHIER SALES
    $cashierSales = \App\Models\Sale::latest()
        ->take(10)
        ->get();

    // RECENT PRODUCTIONS
    $recentProductions = \App\Models\ProductionRecord::latest()
        ->take(10)
        ->get();

    return view(
        'supervisor.report',
        compact(
            'totalProduction',
            'damagedProducts',
            'returnedProducts',
            'stockIn',
            'stockOut',
            'lowStockProducts',
            'cashierSales',
            'recentProductions'
        )
    );
}

// RETURN & DAMAGE

    public function returns()
    {
        $products = Product::all();

        $records = ReturnDamage::latest()->get();

        return view(
            'supervisor.returns',
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
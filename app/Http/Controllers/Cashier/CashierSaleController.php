<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\CashierSale;
use App\Models\Product;
use App\Models\Customer;
use App\Models\ProductionRecord;


class CashierSaleController extends Controller
{
    
    //
    public function show()
    {
      //  $cashierSales = CashierSale::with('Product')->whereDate('sales_date', today())->latest()->get();
        $cashierSales = CashierSale::with('product','customer')
        ->latest()
        ->whereDate('sales_date', today())
        ->paginate(request('per_page', 10))
        ->withQueryString();

        return view('cashier.daily-sales', compact('cashierSales'));

    }
    public function store(Request $request)
    {
       
            

        $expenses =
        $request->linkage_amount +
        $request->plus_amount+
        $request->vehicle_fuel +
        $request->vehicle_exp +
        $request->credit +
        $request->transfer +
        $request->special_exp1 +
        $request->special_exp2;

        $balance =$request->total_amount + $request->paid_credit - $expenses;
        $gross = $request->transfer + $balance;

        CashierSale::create([
            'customer_id' => $request->vehicle,
            'bags_sold' => $request->bags_sold,
            'total_amount' => $request->total_amount,
            'linkages' => $request->linkages,
            'linkage_amount' => $request->linkage_amount,
            'plus' => $request->plus,
            'plus_amount' => $request->plus_amount,
            'vehicle_fuel' => $request->vehicle_fuel,
            'vehicle_exp' => $request->vehicle_exp,
            'credit' => $request->credit,
            'transfer' => $request->transfer,
            'paid_credit' => $request->paid_credit,
            'special_exp1' => $request->special_exp1,
            'special_exp2' => $request->special_exp2,
            'gross' => $gross,
            'total_balance' => $balance,
            'cashier_id' => auth()->id(),
            'sales_date' => $request->sales_date,
            'product_id' => $request->product_id,
        ]);


        // increase stock
                Product::where(
                    'id',
                    $request->product_id
                )->decrement(
                    'stock_quantity',
                    $request->bags_sold
                );

        return back()->with('success', 'Sales saved successfully');
    }

    public function edit($id){
        $cashierSales = CashierSale::with('product','customer')->findOrFail($id);
        $customers = Customer::all();

        return view('cashier.edit-sale', compact('cashierSales', 'customers'));
    }

    public function update(Request $request, $id)
        {
            $cashierSale = CashierSale::findOrFail($id);

                $expenses =
            $request->linkage_amount +
            $request->plus_amount+
            $request->vehicle_fuel +
            $request->vehicle_exp +
            $request->credit +
            $request->transfer +
            $request->special_exp1 +
            $request->special_exp2;

            $balance =$request->total_amount + $request->paid_credit - $expenses;
            $gross = $request->transfer + $balance;

            $cashierSale->update([
                'customer_id' => $request->customer_id,
                'bags_sold' => $request->bags_sold,
                'total_amount' => $request->total_amount,
                'linkages' => $request->linkages,
                'linkage_amount' => $request->linkage_amount,
                'plus' => $request->plus,
                'plus_amount' => $request->plus_amount,
                'vehicle_fuel' => $request->vehicle_fuel,
                'vehicle_exp' => $request->vehicle_exp,
                'credit' => $request->credit,
                'transfer' => $request->transfer,
                'paid_credit' => $request->paid_credit,
                'special_exp1' => $request->special_exp1,
                'special_exp2' => $request->special_exp2,
                'gross' => $gross,
                'total_balance' => $balance,
                'cashier_id' => auth()->id(),
                'sales_date' => $request->sales_date,
                'product_id' => $request->product_id,
                ]);

            return back()->with('success', 'Sales updated successfully');
        }

    public function credit()
    {
        $cashierSales = CashierSale::with('product','customer')
            ->whereColumn('paid_credit', '!=', 'credit')
            ->latest()
            ->paginate(request('per_page', 10))
            ->withQueryString();

        return view('cashier.credit', compact('cashierSales'));

    }

    public function report(Request $request)
    {
        $query = CashierSale::with('product','customer');

        // Search by Date
        if ($request->filled('sales_date')) {
            $query->whereDate('sales_date', $request->sales_date);
        }

        // Search by Customer
        if ($request->filled('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }

        // Search by Product
        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        $cashierSales = $query
            ->latest()
            ->paginate($request->per_page ?? 10)
            ->withQueryString();


        $products = Product::orderBy('name')->get();
        $customers = Customer::orderBy('name')->get();

        return view('cashier.report', compact(
            'cashierSales',
            'products',
            'customers'
        ));
    }


    //stock

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

       $query = ProductionRecord::with('product');

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
    
         // Search by PRODUCTION SITE
        if ($request->filled('production_site')) {
            $query->where('production_site', $request->production_site);
        }
    

        $productions = $query
            ->latest()
            ->paginate($request->per_page ?? 10)
            ->withQueryString();        


        $producers = ProductionRecord::all();
        $products = Product::all();
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

            'production_site' => $request->production_site,
            'producer_name' => $request->producer_name,
            'product_id' => $request->product_id,

            'kg_collected' => $request->kg_collected,
            'kg_used' => $request->kg_used,
            'kg_left' => $request->kg_collected - $request->kg_used,

            'bags_per_kg' => $request->bags_per_kg,
            'quantity_produced' => $request->kg_used * $request->bags_per_kg,

            'damaged_quantity' => $request->damaged_quantity,
            'returned_quantity' => $request->returned_quantity,

            'shifting' => $request->shifting,
            'supervisor_id' => auth()->id(),
            'production_date' => now(),
            'remarks' => $request->remarks,
        ]);

        // increase stock
        Product::where(
            'id',
            $request->product_id
        )->increment(
            'stock_quantity',
            $request->kg_used * $request->bags_per_kg
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

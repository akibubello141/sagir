<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CashierSale;
use App\Models\Product;
use App\Models\Customer;

class CashierSaleController extends Controller
{
    
    //
    public function show()
    {
      //  $cashierSales = CashierSale::with('Product')->whereDate('sales_date', today())->latest()->get();
        $cashierSales = CashierSale::with('product')
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
            'vehicle' => $request->vehicle,
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
        $cashierSales = CashierSale::with('Product')->findOrFail($id);
        $customers = Customer::all();

        return view('cashier.edit-sale', compact('cashierSales', 'customers'));
    }

    public function update(Request $request, $id)
        {
            $cashierSale = CashierSale::findOrFail($id);

            $cashierSale->update([
                'vehicle' => $request->vehicle,
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
        }

    public function credit()
    {
        $cashierSales = CashierSale::with('product')
            ->whereColumn('paid_credit', '!=', 'credit')
            ->latest()
            ->paginate(request('per_page', 10))
            ->withQueryString();

        return view('cashier.credit', compact('cashierSales'));

    }

    public function report(Request $request)
    {
        $query = CashierSale::with('product');

        // Search by Date
        if ($request->filled('sales_date')) {
            $query->whereDate('sales_date', $request->sales_date);
        }

        // Search by Vehicle
        if ($request->filled('vehicle')) {
            $query->where('vehicle', 'like', '%' . $request->vehicle . '%');
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

        return view('cashier.report', compact(
            'cashierSales',
            'products',
        ));
    }


    //MANAGER ACTIVITIES
}

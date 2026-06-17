<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Customer;
use App\Models\DeliveryLoad;


class SaleController extends Controller
{
    public function dashboard()
    {
        $todaySales = Sale::with('items.product')->whereDate('created_at', today())->sum('total_amount');

        $products = Product::all();
        $customers = Customer::count('id');
        $deliveryCount = DeliveryLoad::where('status', 'pending')->count();
        $todayAmont = SaleItem::whereDate('created_at', today())->sum('subtotal');


        return view('cashier.dashboard', compact('todaySales','products','customers','deliveryCount','todayAmont'));
    }

    public function index()
    {
        $products = Product::all();
        $customers = Customer::all();

        return view('cashier.sales', compact('products', 'customers'));
    }

    public function store(Request $request)
    {
        $sale = Sale::create([
            'cashier_id' => auth()->id(),
            'customer_id' => $request->customer_id,
            'total_amount' => $request->total_amount,
            'payment_method' => $request->payment_method,
        ]);

        foreach ($request->products as $item) {

            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $item['id'],
                'quantity' => $item['qty'],
                'price' => $item['price'],
                'subtotal' => $item['qty'] * $item['price'],
            ]);

            Product::where('id', $item['id'])
                ->decrement('stock_quantity', $item['qty']);
        }

        return redirect('/cashier/receipt/' . $sale->id);
    }

    public function receipt($id)
    {
        $sale = Sale::with('items.product', 'customer')->findOrFail($id);
        
        $total = $sale->items->sum('subtotal');
        return view('cashier.receipt', compact('sale', 'total'));
    }

    public function dailySales()
    {
        $sales = Sale::with('items.product', 'customer')->whereDate('created_at', today())->latest()->get();

        $total = $sales->sum(function ($sale) {
            return $sale->items->sum('subtotal');
        });

        return view('cashier.daily-sales', compact('sales', 'total'));
    }

    //report
    public function report()
{
    // DAILY SALES
    $dailySales = \App\Models\Sale::whereDate(
        'created_at',
        today()
    )->sum('total_amount');

    // WEEKLY SALES
    $weeklySales = \App\Models\Sale::whereBetween(
        'created_at',
        [now()->startOfWeek(), now()->endOfWeek()]
    )->sum('total_amount');

    // MONTHLY SALES
    $monthlySales = \App\Models\Sale::whereMonth(
        'created_at',
        now()->month
    )->sum('total_amount');

    // TOTAL SALES COUNT
    $totalTransactions = \App\Models\Sale::count();

    // PAYMENT SUMMARY
    $cashSales = \App\Models\Sale::where(
        'payment_method',
        'cash'
    )->sum('total_amount');

    $transferSales = \App\Models\Sale::where(
        'payment_method',
        'transfer'
    )->sum('total_amount');

    $posSales = \App\Models\Sale::where(
        'payment_method',
        'pos'
    )->sum('total_amount');

    // RECENT SALES
    $recentSales = \App\Models\Sale::latest()
        ->take(10)
        ->get();

    return view(
        'cashier.report',
        compact(
            'dailySales',
            'weeklySales',
            'monthlySales',
            'totalTransactions',
            'cashSales',
            'transferSales',
            'posSales',
            'recentSales'
        )
    );
}

//credit sales
public function credit()
{
    $creditSales = Sale::with('items.product', 'customer')
        ->where('payment_method', 'credit')
        ->latest()
        ->get();
        $total = $creditSales->sum(function ($sale) {
            return $sale->items->sum('subtotal');
        });

    return view('cashier.credit', compact('creditSales', 'total'));
}

//update payment method for credit sales
public function updatePaymentMethod(Request $request, $id)
{
    $sale = Sale::findOrFail($id);
    $sale->update(['payment_method' => $request->payment_method]);  
    return redirect()->back()->with('success', 'Payment method updated successfully.');

}


}
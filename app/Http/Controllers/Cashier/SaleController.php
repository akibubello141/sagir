<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Customer;
use App\Models\CashierSale;


class SaleController extends Controller
{
    public function dashboard()
    {

        $products = Product::all();
        $customers = Customer::count('id');
        $todaySales = CashierSale::whereDate('sales_date', today())->sum('bags_sold');



        return view('cashier.dashboard', compact('todaySales','products','customers'));
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
    $dailySales =Sale::whereDate(
        'created_at',
        today()
    )->sum('total_amount');

    // WEEKLY SALES
    $weeklySales = Sale::whereBetween(
        'created_at',
        [now()->startOfWeek(), now()->endOfWeek()]
    )->sum('total_amount');

    // MONTHLY SALES
    $monthlySales =Sale::whereMonth(
        'created_at',
        now()->month
    )->sum('total_amount');

    // TOTAL SALES COUNT
    $totalTransactions = Sale::count();

    // PAYMENT SUMMARY
    $cashSales = Sale::where(
        'payment_method',
        'cash'
    )->sum('total_amount');

    $transferSales = Sale::where(
        'payment_method',
        'transfer'
    )->sum('total_amount');

    $posSales = Sale::where(
        'payment_method',
        'pos'
    )->sum('total_amount');

    $creditSales = Sale::where(
        'payment_method',
        'credit'
    )->sum('total_amount');

    // RECENT SALES
    $recentSales = Sale::latest()
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
            'creditSales',
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
            return $sale->items->sum('subtotal') - $sale->part_payment;
        });

    return view('cashier.credit', compact('creditSales', 'total'));
}

//update payment method for credit sales
public function updatePaymentMethod(Request $request, $id)
{
    $sale = Sale::findOrFail($id);

    $part_payment = $request->old_payment + $request->new_payment;
    $amount = $request->amount;


    if($amount == $part_payment){
        $payment_method = $request->payment_method;
        
    }else{
        $payment_method = 'credit';
    }


    $sale->update([
        'payment_method' => $payment_method,
        'part_payment'  => $part_payment,
        ]);  
    return redirect()->back()->with('success', 'Payment method updated successfully.');

}


}
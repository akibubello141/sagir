<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Customer;

class SaleController extends Controller
{
    public function dashboard()
    {
        $todaySales = Sale::whereDate('created_at', today())->sum('total_amount');

        $products = Product::all();
        $customers = Customer::count('id');

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

        return view('cashier.receipt', compact('sale'));
    }

    public function dailySales()
    {
        $sales = Sale::whereDate('created_at', today())->latest()->get();


        return view('cashier.daily-sales', compact('sales'));
    }
}
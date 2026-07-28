<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CashierSale;
use App\Models\Dispatch;
use App\Models\Expense;
use App\Models\Product;
use App\Models\ProductionRecord;

class PrintController extends Controller
{
    public function sales(Request $request)
    {
        $sales = CashierSale::with(['customer','product'])
            ->latest()
            ->get();

        return view('manager.print.sales', compact('sales'));
    }

    public function production(Request $request)
    {
        $productions = ProductionRecord::with('product')
            ->latest()
            ->get();

        return view('manager.print.production', compact('productions'));
    }

    public function dispatch(Request $request)
    {
        $dispatches = Dispatch::with('product')
            ->latest()
            ->get();

        return view('manager.print.dispatch', compact('dispatches'));
    }

    public function expenses(Request $request)
    {
        $expenses = Expense::latest()->get();

        return view('manager.print.expenses', compact('expenses'));
    }

    public function stock()
    {
        $products = Product::all();

        return view('manager.print.stock', compact('products'));
    }
}
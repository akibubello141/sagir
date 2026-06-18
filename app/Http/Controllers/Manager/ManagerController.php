<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DeliveryReturn;

use App\Models\User;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Expense;
use App\Models\SystemSetting;
use App\Models\ProductionRecord;
use App\Models\SaleItem;
use App\Models\Staff;



class ManagerController extends Controller
{
    // DASHBOARD
  public function  dash()
    {
        // TOTAL SALES
        $totalSales = Sale::sum('total_amount');

        // TOTAL EXPENSES
        $totalExpenses = Expense::sum('amount');

        // PROFIT
        $profit = $totalSales - $totalExpenses;

        // TOTAL PRODUCTS
        $products = Product::count();

        // TOTAL USERS
        $users = User::count();
        // TOTAL PRODUCTION
        $production = ProductionRecord::sum(
            'quantity_produced'
        );

        // MONTHLY SALES
        $monthlySales = Sale::selectRaw(
            'MONTH(created_at) as month,
            SUM(total_amount) as total'
        )
        ->groupBy('month')
        ->get();

        // MONTHLY EXPENSES
        $monthlyExpenses = Expense::selectRaw(
            'MONTH(created_at) as month,
            SUM(amount) as total'
        )
        ->groupBy('month')
        ->get();

        // PRODUCT SALES
        $productSales = Product::withCount(
            'saleItems'
        )->get();

        // BEST SELLING
        $bestSelling = Product::withCount(
            'saleItems'
        )
        ->orderBy('sale_items_count', 'desc')
        ->first();

         return view(
            'manager.dash',
            compact(
                'totalSales',
                'totalExpenses',
                'profit',
                'products',
                'users',
                'production',
                'monthlySales',
                'monthlyExpenses',
                'productSales',
                'bestSelling'
            )
        );
    }


    // EXPENSES PAGE
    public function expenses()
    {
        $expenses = Expense::latest()->get();

        return view(
            'manager.expenses',
            compact('expenses')
        );
    }

    // SAVE EXPENSE
    public function saveExpense(Request $request)
    {
        Expense::create([
            'title' => $request->title,
            'amount' => $request->amount,
            'description' => $request->description,
            'expense_date' => $request->expense_date,
        ]);

        return back()->with(
            'success',
            'Expense added'
        );
    }

    // SETTINGS PAGE
    public function settings()
    {
        $settings = SystemSetting::first();

        return view(
            'manager.settings',
            compact('settings')
        );
    }

    // SAVE SETTINGS
    public function saveSettings(Request $request)
    {
        SystemSetting::updateOrCreate(
            ['id' => 1],
            [
                'company_name' => $request->company_name,
                'company_phone' => $request->company_phone,
                'company_email' => $request->company_email,
                'company_address' => $request->company_address,
            ]
        );

        return back()->with(
            'success',
            'Settings updated'
        );
    }

    // BACKUP DATABASE
    public function backup()
    {
        $fileName = 'backup-' . now()->format('Y-m-d') . '.sql';

        return response()->download(
            database_path($fileName)
        );
    }

    public function report(Request $request)
    {
        $query = Sale::query();

        if ($request->start_date && $request->end_date) {

            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }

        $sales = $query->latest()->get();

        $totalSales = $sales->sum('total_amount');

        $totalExpenses = Expense::when(
            $request->start_date,
            function ($q) use ($request) {
                return $q->whereBetween(
                    'expense_date',
                    [
                        $request->start_date,
                        $request->end_date
                    ]
                );
            }
        )->sum('amount');

        $totalProduction = ProductionRecord::when(
            $request->start_date,
            function ($q) use ($request) {
                return $q->whereBetween(
                    'production_date',
                    [
                        $request->start_date,
                        $request->end_date
                    ]
                );
            }
        )->sum('quantity_produced');

        $profit = $totalSales - $totalExpenses;

        return view(
            'manager.report',
            compact(
                'sales',
                'totalSales',
                'totalExpenses',
                'profit',
                'totalProduction'
            )
        );
    }

    // DRIVER RETURNS REPORT
        public function driverReport()
        {
            $reports = DeliveryReturn::with([
                'deliveryLoad.driver',
                'product'
            ])
            ->latest()
            ->get();

            return view(
                'manager.driver-report',
                compact('reports')
            );
        }

     


}
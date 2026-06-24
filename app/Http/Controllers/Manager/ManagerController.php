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
        $totalSales = SaleItem::sum('subtotal');

        // TOTAL SALES CREDIT
         $creditSales = Sale::with('items.product', 'customer')->where('payment_method', 'credit')
        ->latest()
        ->get();
        $totalCredit = $creditSales->sum(function ($sale) {
            return $sale->items->sum('subtotal') - $sale->part_payment;
        });


        // TOTAL EXPENSES
        $totalExpenses = Expense::sum('amount');

        // PROFIT
        $profit = $totalSales - $totalExpenses - $totalCredit;

        // TOTAL PRODUCTS
        $products = Product::count();

        // TOTAL USERS
        $users = User::count();
        // TOTAL PRODUCTION
        $production = ProductionRecord::sum(
            'quantity_produced'
        );
        //TOTAL STAFFS

        $staffs = Staff::count();

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
                'bestSelling',
                'totalCredit',
                'staffs'
            )
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
        $saleQuery = Sale::query()->where('payment_method', 'credit');
        $productionQuery = ProductionRecord::query();
        $expensesQuery = Expense::query();

        if ($request->start_date && $request->end_date) {

            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
           $saleQuery->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
             $productionQuery->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
             $expensesQuery->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }

        $sales = $query->latest()->get();
        $credit = $saleQuery->latest()->get();
        $productions = $productionQuery->latest()->get();
        $expenses = $expensesQuery->latest()->get();

        $totalSales = $sales->sum('total_amount');
        $totalCredit = $credit->sum('total_amount');
        $partPayment = $credit->sum('part_payment');
        $remainingCredit = $totalCredit - $partPayment;

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

        $profit = $totalSales - $totalExpenses - $remainingCredit;

        return view(
            'manager.report',
            compact(
                'sales',
                'totalSales',
                'totalExpenses',
                'profit',
                'totalProduction',
                'remainingCredit',
                'productions',
                'expenses'
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
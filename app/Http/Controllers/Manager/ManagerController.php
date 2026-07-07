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
use App\Models\CashierSale;




class ManagerController extends Controller
{
    // DASHBOARD
  public function  dash()
    {
       
        // MONTHLY Bags Sold
        $monthlyBagsSold = CashierSale::selectRaw('
        MONTH(created_at) as month_number,
        MONTHNAME(created_at) as month_name,
        SUM(bags_sold) as total
        ')
        ->groupBy('month_number', 'month_name')
        ->orderBy('month_number')
        ->get();

         // MONTHLY Amount
        $monthlyAmount = CashierSale::selectRaw('
        MONTH(created_at) as month_number,
        MONTHNAME(created_at) as month_name,
        SUM(total_amount) as total
        ')
        ->groupBy('month_number', 'month_name')
        ->orderBy('month_number')
        ->get();

        // MONTHLY Linkage
        $monthlyLinkages = CashierSale::selectRaw('
        MONTH(created_at) as month_number,
        MONTHNAME(created_at) as month_name,
        SUM(linkages) as total
        ')
        ->groupBy('month_number', 'month_name')
        ->orderBy('month_number')
        ->get();

        // MONTHLY Linkage Amount
        $monthlyLinkageAmounts = CashierSale::selectRaw('
        MONTH(created_at) as month_number,
        MONTHNAME(created_at) as month_name,
        SUM(linkage_amount) as total
        ')
        ->groupBy('month_number', 'month_name')
        ->orderBy('month_number')
        ->get();

        // MONTHLY Plus
        $monthlyPlus = CashierSale::selectRaw('
        MONTH(created_at) as month_number,
        MONTHNAME(created_at) as month_name,
        SUM(plus) as total
        ')
        ->groupBy('month_number', 'month_name')
        ->orderBy('month_number')
        ->get();

         // MONTHLY Plus Amount
        $monthlyPlusAmount = CashierSale::selectRaw('
        MONTH(created_at) as month_number,
        MONTHNAME(created_at) as month_name,
        SUM(plus_amount) as total
        ')
        ->groupBy('month_number', 'month_name')
        ->orderBy('month_number')
        ->get();

         // MONTHLY Vehicle Fuel
        $monthlyFuel = CashierSale::selectRaw('
        MONTH(created_at) as month_number,
        MONTHNAME(created_at) as month_name,
        SUM(vehicle_fuel) as total
        ')
        ->groupBy('month_number', 'month_name')
        ->orderBy('month_number')
        ->get();

        // MONTHLY Vehicle expen
        $monthlyVehicleExp = CashierSale::selectRaw('
        MONTH(created_at) as month_number,
        MONTHNAME(created_at) as month_name,
        SUM(vehicle_exp) as total
        ')
        ->groupBy('month_number', 'month_name')
        ->orderBy('month_number')
        ->get();

        // MONTHLY CREDIT
         $monthlyCredit = CashierSale::selectRaw('
            MONTH(created_at) as month_number,
            MONTHNAME(created_at) as month_name,
            SUM(credit) as total
            ')
            ->groupBy('month_number', 'month_name')
            ->orderBy('month_number')
            ->get();

             // MONTHLY TRANSFER
         $monthlyTransfer = CashierSale::selectRaw('
            MONTH(created_at) as month_number,
            MONTHNAME(created_at) as month_name,
            SUM(transfer) as total
            ')
            ->groupBy('month_number', 'month_name')
            ->orderBy('month_number')
            ->get();
            // MONTHLY Paid Credit
         $monthlyPaidCredit = CashierSale::selectRaw('
            MONTH(created_at) as month_number,
            MONTHNAME(created_at) as month_name,
            SUM(paid_credit) as total
            ')
            ->groupBy('month_number', 'month_name')
            ->orderBy('month_number')
            ->get();

            // MONTHLY Special Exp1
         $monthlySpecialExp1 = CashierSale::selectRaw('
            MONTH(created_at) as month_number,
            MONTHNAME(created_at) as month_name,
            SUM(special_exp1) as total
            ')
            ->groupBy('month_number', 'month_name')
            ->orderBy('month_number')
            ->get();

            // MONTHLY Special Exp2
         $monthlySpecialExp2 = CashierSale::selectRaw('
            MONTH(created_at) as month_number,
            MONTHNAME(created_at) as month_name,
            SUM(special_exp2) as total
            ')
            ->groupBy('month_number', 'month_name')
            ->orderBy('month_number')
            ->get();

            // MONTHLY Total GROSS
         $monthlyGross = CashierSale::selectRaw('
            MONTH(created_at) as month_number,
            MONTHNAME(created_at) as month_name,
            SUM(gross) as total
            ')
            ->groupBy('month_number', 'month_name')
            ->orderBy('month_number')
            ->get();

            // MONTHLY TOTAL BALANCE
         $monthlyTotalBalance = CashierSale::selectRaw('
            MONTH(created_at) as month_number,
            MONTHNAME(created_at) as month_name,
            SUM(total_balance) as total
            ')
            ->groupBy('month_number', 'month_name')
            ->orderBy('month_number')
            ->get();

         // MONTHLY Bags Produce
        $monthlyBagsProduce = ProductionRecord::selectRaw('
        MONTH(created_at) as month_number,
        MONTHNAME(created_at) as month_name,
        SUM(quantity_produced) as total
        ')
        ->groupBy('month_number', 'month_name')
        ->orderBy('month_number')
        ->get();

        

       
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



        // PRODUCT SALES
        $productSales = CashierSale::selectRaw('
            product_id,
            SUM(bags_sold) as total_bags_sold,
            SUM(total_amount) as total_sales_amount
        ');

        // BEST SELLING PRODUCTS
        $bestSelling = CashierSale::with('product')->selectRaw('
            product_id,
            SUM(bags_sold) as total_bags_sold,
            SUM(total_amount) as total_sales_amount
        ')
        ->groupBy('product_id')
        ->orderByDesc('total_bags_sold')
        ->limit(5)
        ->get();

        //BEST BUYING CUSTOMERS
        $bestBuyingCustomers = CashierSale::with('customer')->selectRaw('
            customer_id,
            SUM(bags_sold) as total_bags_sold,
            SUM(total_amount) as total_sales_amount
        ')
        ->groupBy('customer_id')
        ->orderByDesc('total_bags_sold')
        ->limit(5)
        ->get();

         return view(
            'manager.dash',
            compact(
                'products',
                'users',
                'production',
                'monthlyBagsSold',
                'monthlyAmount',
                'monthlyLinkages',
                'monthlyLinkageAmounts',
                'monthlyPlus',
                'monthlyPlusAmount',
                'monthlyFuel',
                'monthlyVehicleExp',
                'monthlyCredit',
                'monthlyTransfer',
                'monthlyPaidCredit',
                'monthlySpecialExp1',
                'monthlySpecialExp2',
                'monthlyGross',
                'monthlyTotalBalance',
                'monthlyBagsProduce',               
                
                'productSales',
                'bestSelling',
                'bestBuyingCustomers',
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


     


}
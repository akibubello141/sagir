<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CashierSale;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\DeliveryReturn;
use App\Models\User;
use App\Models\Expense;
use App\Models\SystemSetting;
use App\Models\ProductionRecord;
use App\Models\SaleItem;
use App\Models\Staff;


class ReportController extends Controller
{
    //SALES REPORT
     public function saleReport(Request $request)
    {
        $query = CashierSale::with('product','customer');

        // Search by Date
        if ($request->filled('sales_date') && $request->filled('sales_date1')) {
            $query->whereBetween('sales_date', [
                $request->sales_date,
                $request->sales_date1]);
        }

         if ($request->start_date && $request->end_date) {

             $query->whereBetween('created_at', [
                $request->start_date,
                $request->end_date 
            ]);
        }

        // Search by Vehicle
        if ($request->filled('customer_id')) {
            $query->where('customer_id', 'like', '%' . $request->customer_id . '%');
        }

        // Search by Product
        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }

    

    

        $cashierSales = $query
            ->latest()
            ->paginate($request->per_page ?? 10)
            ->withQueryString();


            $totals = (clone $query)->selectRaw('
                SUM(bags_sold) as bags_sold,
                SUM(total_amount) as total_amount,
                SUM(linkages) as linkages,
                SUM(linkage_amount) as linkage_amount,
                SUM(plus) as plus,
                SUM(plus_amount) as plus_amount,
                SUM(vehicle_fuel) as vehicle_fuel,
                SUM(vehicle_exp) as vehicle_exp,
                SUM(credit) as credit,
                SUM(transfer) as transfer,
                SUM(paid_credit) as paid_credit,
                SUM(special_exp1) as special_exp1,
                SUM(special_exp2) as special_exp2,
                SUM(total_balance) as total_balance,
                SUM(gross) as gross
            ')->first();

        $products = Product::orderBy('name')->get();
        $vehicles = Customer::orderBy('name')->get();

        return view('manager.sale-report', compact(
            'cashierSales',
            'products',
            'vehicles',
            'totals'
        ));
    }

    //PRODUCTION REPORT
     public function productionReport(Request $request)
    {
  
        $query = ProductionRecord::query();

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
    

        // Search by production site
        if ($request->filled('production_site')) {
            $query->where('production_site', $request->production_site);
        }

        $productions = $query
            ->latest()
            ->paginate($request->per_page ?? 10)
            ->withQueryString();        


        $producers = ProductionRecord::all();
        $products = product::all();
        $totalProduction = ProductionRecord::sum('quantity_produced');


        return view(
            'manager.production-report',
            compact(
             
                'totalProduction',
                'productions',
                'producers',
                'products'
            )
        );
    }

}

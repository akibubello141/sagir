<?php

namespace App\Http\Controllers\cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dispatch;
use App\Models\Product;


class dispatchController extends Controller
{
    //
    public function index(Request $request)
    {
        // $dispatches = Dispatch::all();
        // $products = product::all();
        // return view('cashier.dispatch', compact('dispatches', 'products'));

         $query = Dispatch::with('Product');

        // Search by Date
      

         if ($request->sales_date && $request->sales_date1) {

             $query->whereBetween('dispatch_date', [
                $request->sales_date ,
                $request->sales_date1
            ]);
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
    

        $dispatches = $query
            ->latest()
            ->paginate($request->per_page ?? 10)
            ->withQueryString();        


        $products = Product::all();
        $totalProduction = Dispatch::count('id');


        return view(
            'cashier.dispatch',
            compact(
             
                'totalProduction',
                'dispatches',
                'products'
            )
        );
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'product_id' => 'required',
        //     'quantity_dispatched' => 'required|numeric',
        //     'dispatch_date' => 'required|date',
        //     'shifting' => 'required',
        //     'production_site' => 'required',
        // ]);

         Dispatch::create([

            'product_id' => $request->product_id,

            'supervisor_id' => auth()->id(),

            'production_site' => $request->production_site,

            'shifting' => $request->shifting,

            'dispatch_date' => now(),

            'quantity_made' => $request->quantity_made ?? 0,

            'quantity_produced' => $request->quantity_produced ?? 0,

            'quantity_dispatched' => $request->quantity_dispatched,

            'linkage' => $request->linkage ?? 0,

            'refill' => $request->refill ?? 0,

            'quantity_left' => $request->quantity_left ?? 0,

        ]);

        return redirect()->back()
            ->with('success', 'Dispatch record created successfully.');
    }
}

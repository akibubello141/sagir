<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //   // PRODUCTS PAGE
        public function product()
        {
            $products = Product::latest()->get();

            return view(
                'manager.product',
                compact('products')
            );
        }

        // SAVE PRODUCT
        public function saveProduct(Request $request)
        {
            Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'stock_quantity' => $request->stock_quantity,
                'low_stock_limit' => $request->lower_stock_quantity,
            ]);

            return back()->with('success', 'Product added');
        }

        // EDIT PRODUCT
        public function editProduct($id)
        {
            $product = Product::findOrFail($id);

            return view('manager.edit_product', compact('product'));
        }

        //UPDATE PRODUCT
        public function updateproduct(Request $request, $id)
        {
            $product = product::findOrFail($id);
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'stock_quantity' => $request->stock_quantity,
                'low_stock_limit' => $request->lower_stock_quantity,
            ]);

            $products = Product::latest()->get();

            return view(
                'manager.product',
                compact('products')
            );
        }


        // DELETE PRODUCT
        public function deleteproduct($id)
        {
            $product=product::findOrfail($id);
            $product->delete();    
           $products = Product::latest()->get();

            return view(
                'manager.product',
                compact('products')
            );
        }
}

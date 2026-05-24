<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashierController extends Controller
{
        public function newSell() {
            return view('cashier.new-sell');
        })->middleware('auth');

        public function sellHistory() {
            return view('cashier.sell-history');
        })

        public function receipt() {
            return view('cashier.receipt');
        })->middleware('auth');

        public function products() {
            return view('cashier.products');
        })->middleware('auth');

        public function dashboard() {
            return view('cashier.dashboard');
        })->middleware('auth');
}

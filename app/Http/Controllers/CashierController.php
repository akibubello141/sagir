<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function newSell() {
        return view('cashier.new-sell');
    }

    public function sellHistory() {
        return view('cashier.sell-history');
    }

    public function receipt() {
        return view('cashier.receipt');
    }

    public function products() {
        return view('cashier.products');
    }

    public function dashboard() {
        return view('cashier.dashboard');
    }
}

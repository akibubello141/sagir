<?php

namespace App\Http\Controllers\cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;

class ExpensesController extends Controller
{
    //
    // EXPENSES PAGE
    public function expenses()
    {
        $expenses = Expense::latest()->get();

        return view(
            'cashier.expenses',
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

}

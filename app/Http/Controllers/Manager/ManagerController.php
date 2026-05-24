<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Expense;
use App\Models\SystemSetting;
use App\Models\ProductionRecord;
use App\Models\SaleItem;


class ManagerController extends Controller
{
    // DASHBOARD
    public function dashboard()
    {
        $totalSales = Sale::sum('total_amount');

        $totalExpenses = Expense::sum('amount');

        $profit = $totalSales - $totalExpenses;

        $products = Product::count();

        $users = User::count();

        $production = ProductionRecord::sum(
            'quantity_produced'
        );

        $bestSelling = Product::withCount('saleItems')
            ->orderBy('sale_items_count', 'desc')
            ->first();

        return view(
            'manager.dashboard',
            compact(
                'totalSales',
                'totalExpenses',
                'profit',
                'products',
                'users',
                'production',
                'bestSelling'
            )
        );
    }

    // USERS PAGE
    public function users()
    {
        $users = User::latest()->get();

        return view(
            'manager.users',
            compact('users')
        );
    }

    // CREATE USER
    public function saveUser(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return back()->with(
            'success',
            'User created successfully'
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
}
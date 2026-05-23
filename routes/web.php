<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\CashierController;


Route::get('/', function () {
    return view('welcome');
});
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::view('/dashboard/cashier', 'dashboard.cashier');
Route::view('/dashboard/supervisor', 'dashboard.supervisor');
Route::view('/dashboard/manager', 'dashboard.manager');

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/dashboard/cashier/new-sell', function () {
    return view('cashier.new-sell');
})->middleware('auth');

Route::get('/dashboard/cashier/sell-history', function () {
    return view('cashier.sell-history');
})->middleware('auth');

Route::get('/dashboard/cashier/receipt', function () {
    return view('cashier.receipt');
})->middleware('auth');

Route::get('/dashboard/cashier/products', function () {
    return view('cashier.products');
})->middleware('auth');

//supervisor
Route::get('/supervisor/products', [SupervisorController::CLass, 'products']);
Route::get('/supervisor/drivers', [SupervisorController::class, 'drivers']);
Route::get('/supervisor/maintenances', [SupervisorController::class, 'maintenences']);
Route::get('/supervisor/reports', [SupervisorController::Class, 'reports'])->name('reports');

    Route::middleware(['auth'])->group(function () {

        Route::middleware('role:supervisor')->group(function () {

            Route::get('/supervisor/products', [SupervisorController::class, 'index']);

            Route::post('/supervisor/products', [SupervisorController::class, 'store']);

        });

    });

//cashier
use App\Http\Controllers\Cashier\SaleController;
use App\Http\Controllers\Cashier\CustomerController;

Route::middleware(['auth', 'role:cashier'])->group(function () {

    Route::get('/cashier/dashboard', [SaleController::class, 'dashboard']);

    // SALES
    Route::get('/cashier/sales', [SaleController::class, 'index']);
    Route::post('/cashier/sales/store', [SaleController::class, 'store']);

    // RECEIPT
    Route::get('/cashier/receipt/{id}', [SaleController::class, 'receipt']);

    // DAILY SALES
    Route::get('/cashier/daily-sales', [SaleController::class, 'dailySales']);

    // CUSTOMERS
    Route::get('/cashier/customers', [CustomerController::class, 'index']);
    Route::post('/cashier/customers/store', [CustomerController::class, 'store']);
});

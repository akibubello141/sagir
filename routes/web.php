<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\supervisor\SupervisorController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\Cashier\SaleController;
use App\Http\Controllers\Cashier\CustomerController;



Route::get('/', function () {
    return view('welcome');
});
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::view('/cashier/dashboard', 'cashier.dashboard');
Route::view('/supervisor/dashboard', 'supervisor.dashboard');
Route::view('/manager/dashboard ', 'manager.dashboard');

Route::get('/logout', [AuthController::class, 'logout']);



//supervisor

    Route::middleware([
        'auth',
        'role:supervisor'
    ])->group(function () {

        Route::get(
            '/supervisor/dashboard',
            [SupervisorController::class, 'dashboard']
        );

        Route::get(
            '/supervisor/stock',
            [SupervisorController::class, 'stock']
        );

        Route::post(
            '/supervisor/add-stock',
            [SupervisorController::class, 'addStock']
        );

        Route::get(
            '/supervisor/production',
            [SupervisorController::class, 'production']
        );

        Route::post(
            '/supervisor/save-production',
            [SupervisorController::class, 'saveProduction']
        );

        Route::get(
            '/supervisor/cashier-activities',
            [SupervisorController::class, 'cashierActivities']
        );

        Route::get(
            '/supervisor/corrections',
            [SupervisorController::class, 'corrections']
        );

        Route::post(
            '/supervisor/correction/{id}',
            [SupervisorController::class, 'approveCorrection']
        );

    });

//cashier
Route::get('/dashboard/cashier/new-sell', [CashierController::class, 'newSell'])->middleware('auth');
Route::get('/cashier/dashboard', [CashierController::class, 'dashboard'])->middleware('auth');    

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



//manager

Route::middleware([
    'auth',
    'role:manager'
])->group(function () {

    Route::get(
        '/manager/dashboard',
        [ManagerController::class, 'dashboard']
    );

    // USERS
    Route::get(
        '/manager/users',
        [ManagerController::class, 'users']
    );

    //Edit user
    Route::get(
        '/manager/edit-user/{id}',
        [ManagerController::class, 'editUser']
    );

    //Update user
   // Route::post(
     //   '/manager/update-user/{id}',
       // [ManagerController::class, 'updateUser']
    //);

    //delete user
    Route::get(
        '/manager/delete-user/{id}',
        [ManagerController::class, 'deleteUser']
    );

    //save user
    Route::post(
        '/manager/save-user',
        [ManagerController::class, 'saveUser']
    );

    // EXPENSES
    Route::get(
        '/manager/expenses',
        [ManagerController::class, 'expenses']
    );

    Route::post(
        '/manager/save-expense',
        [ManagerController::class, 'saveExpense']
    );

    // SETTINGS
    Route::get(
        '/manager/settings',
        [ManagerController::class, 'settings']
    );

    Route::post(
        '/manager/save-settings',
        [ManagerController::class, 'saveSettings']
    );

    // BACKUP
    Route::get(
        '/manager/backup',
        [ManagerController::class, 'backup']
    );

});

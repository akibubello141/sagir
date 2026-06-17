<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\supervisor\SupervisorController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\Cashier\SaleController;
use App\Http\Controllers\Cashier\CustomerController;
use App\Http\Controllers\Supervisor\DeliveryController;
use App\Http\Controllers\Cashier\DeliveryReturnController;




Route::get('/', function () {
    return view('welcome');
});
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::view('/cashier/dashboard', 'cashier.dashboard');
Route::view('/supervisor/dashboard', 'supervisor.dashboard');
Route::view('/manager/dash', 'manager.dash');

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

        // REPORT
        Route::get(
        '/supervisor/report',
        [SupervisorController::class, 'report']
    );

    // RETURN DAMAGE
        Route::get(
        '/supervisor/returns',
        [SupervisorController::class, 'returns']
    );

    Route::post(
        '/supervisor/returns/store',
        [SupervisorController::class, 'storeReturn']
    );

    // DRIVER

            Route::middleware(['auth'])->group(function () {

            Route::get(
                '/supervisor/load-products',
                [DeliveryController::class, 'create']
            );

            Route::post(
                '/supervisor/load-products',
                [DeliveryController::class, 'store']
            );

        });

        //DELIVERY HISTORY
                    Route::get(
            '/supervisor/delivery-history',
            [DeliveryController::class,'history']
            );

            Route::get(
                '/supervisor/add-driver',
                [DeliveryController::class,'driver']
            );
            //add drivder
            Route::post(
                '/supervisor/storedriver',
                [DeliveryController::class,'storeDriver']
            );

            //delete driver
            Route::get(
                '/supervisor/delete-driver/{id}',
                [DeliveryController::class,'deleteDriver']
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

    // REPORT
    Route::get('/cashier/report',[SaleController::class, 'report']
    );

    //DELIVARY RETURNS
    Route::get('/cashier/driver-return',[DeliveryReturnController::class,'create']
    );

    Route::post('/cashier/driver-return',[DeliveryReturnController::class,'store']
    );

    //CREDIT SALES
    Route::get('/cashier/credit',[SaleController::class,'credit']
    );

    //update payment method for credit sales
    Route::post('/cashier/credit/update-payment-method/{id}', [SaleController::class, 'updatePaymentMethod'])->name('cashier.credit.updatePaymentMethod');  
});



//manager
Route::middleware(['auth','role:manager'])->group(function () {

    Route::get(
        '/manager/dashboard',
        [ManagerController::class, 'dashboard']
    );

    Route::get(
        '/manager/dash',
        [ManagerController::class, 'dash']
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
    Route::post(
        '/manager/update-user/{id}',
        [ManagerController::class, 'updateUser']
    );

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

    //report
    Route::get(
    '/manager/report',
    [ManagerController::class, 'report'])->name('manager.report');

    //DRIVER RETURNS
    Route::get(
    '/manager/driver-report',
    [ManagerController::class, 'driverReport'])->name('manager.driver.report');

    // PRODUCTS
    Route::get(
        '/manager/product',
        [ManagerController::class, 'product']
    );

    Route::post(
        '/manager/save-product',
        [ManagerController::class, 'saveProduct']
     );

     Route::get(
        '/manager/edit_product/{id}',
        [ManagerController::class, 'editProduct']
     );

     Route::post(
        '/manager/update_product/{id}', 
        [ManagerController::class, 'updateproduct']
    );

    Route::get(
        '/manager/delete_product/{id}',
        [ManagerController::class, 'deleteproduct']
    );

});

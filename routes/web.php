<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\supervisor\SupervisorController;
use App\Http\Controllers\Supervisor\DeliveryController;


use App\Http\Controllers\CashierController;
use App\Http\Controllers\Cashier\SaleController;
use App\Http\Controllers\Cashier\CustomerController;
use App\Http\Controllers\Cashier\DeliveryReturnController;
use App\http\Controllers\cashier\ExpensesController;

use App\Http\Controllers\Manager\StaffController;
use App\Http\Controllers\Manager\ProductController;
use App\Http\Controllers\Manager\UserController;
use App\Http\Controllers\Manager\ManagerController;




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

   Route::name('cashier.')
    ->prefix('cashier')
    ->group(function () {
        //expenses
        Route::prefix('expenses')
        ->name('expenses.')
        ->group(function () {    
            Route::get('/',[ExpensesController::class, 'expenses'])->name('index');
            Route::post('save',[ExpensesController::class, 'saveExpense'])->name('save');

          });

    });
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
    Route::get('/manager/report',[ManagerController::class, 'report'])->name('manager.report');

    //DRIVER RETURNS
    Route::get('/manager/driver-report',[ManagerController::class, 'driverReport'])->name('manager.driver.report');

   
    Route::name('manager.')
    ->prefix('manager')
    ->group(function () {

          // users routes
          Route::prefix('users')
          ->name('users.')
          ->group(function () {
              Route::get('/', [UserController::class, 'users'])->name('index');
              Route::get('/edit/{id}', [UserController::class, 'editUser'])->name('edit');
              Route::post('/update/{id}', [UserController::class, 'updateUser'])->name('update');
              Route::get('/delete/{id}', [UserController::class, 'deleteUser'])->name('delete');
              Route::post('/save', [UserController::class, 'saveUser'])->name('save');
          });

        // products routes
        Route::prefix('products')
        ->name('products.')
        ->group(function () {
            Route::get('/', [ProductController::class, 'product'])->name('index');
            Route::post('/save', [ProductController::class, 'saveProduct'])->name('save');
            Route::get('/edit/{id}', [ProductController::class, 'editProduct'])->name('edit');
            Route::post('/update/{id}', [ProductController::class, 'updateProduct'])->name('update');
            Route::get('/delete/{id}', [ProductController::class, 'deleteProduct'])->name('delete');
        });

        // staff routes
        Route::prefix('staff')
        ->name('staff.')
        ->group(function () {
            Route::get('/', [StaffController::class, 'staff'])->name('index');
            Route::post('/save', [StaffController::class, 'save'])->name('save');
            Route::get('/edit/{id}', [StaffController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [StaffController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [StaffController::class, 'delete'])->name('delete');    
        });
    });

});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\Cashier\CashierSaleController;
use App\Http\Controllers\Cashier\DispatchController;
use App\Http\Controllers\Cashier\SaleController;
use App\Http\Controllers\Cashier\CustomerController;

use App\Http\Controllers\Manager\StaffController;
use App\Http\Controllers\Manager\ProductController;
use App\Http\Controllers\Manager\UserController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\Manager\ReportController;
use App\Http\Controllers\Manager\PrintController;





Route::get('/', function () {
    return view('login');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::view('/cashier/dashboard', 'cashier.dashboard');
Route::view('/supervisor/dashboard', 'supervisor.dashboard');
Route::view('/manager/dash', 'manager.dash');
Route::get('/logout', [AuthController::class, 'logout']);


//cashier
Route::middleware(['auth', 'role:cashier'])->group(function () {

    Route::get('/cashier/dashboard', [SaleController::class, 'dashboard']);

    // SALES
    Route::get('/cashier/sales', [SaleController::class, 'index']);
    Route::post('/cashier/sales/store', [SaleController::class, 'store']);

    // RECEIPT
    Route::get('/cashier/receipt/{id}', [SaleController::class, 'receipt']);

    // DAILY SALES
    Route::get('/cashier/daily-sales', [SaleController::class, 'dailySales']);

    //CREDIT SALES
    Route::get('/cashier/credit',[SaleController::class,'credit']);

    //update payment method for credit sales
    Route::post('/cashier/credit/update-payment-method/{id}', [SaleController::class, 'updatePaymentMethod'])->name('cashier.credit.updatePaymentMethod');  

   Route::name('cashier.')
    ->prefix('cashier')
    ->group(function () {

        //customers
        Route::prefix('customer')
        ->name('customer.')
        ->group(function(){
            Route::get('/',[CustomerController::class,'show'])->name('index');
            Route::post('/save',[CustomerController::class,'store'])->name('store');
            Route::get('/edit/{id}',[CustomerController::class,'edit'])->name('edit');
            Route::post('/update/{id}',[CustomerController::class,'update'])->name('update');
            Route::get('/delete/{id}',[CustomerController::class,'delete'])->name('delete');
        });
       
        //stock
        Route::prefix('stock')
        ->name('stock.')
        ->group(function(){
            Route::get('/',[CashierSaleController::class,'stock'])->name('index');
            Route::post('/add',[CashierSaleController::class,'addStock'])->name('add');
        });
        //production
        Route::prefix('production')
        ->name('production.')
        ->group(function(){
            Route::get('/',[CashierSaleController::class,'production'])->name('index');
            Route::post('/save',[CashierSaleController::class,'saveProduction'])->name('save');
        });

         //CASHIER SALE
        Route::prefix('driver')
        ->name('driver.')
        ->group(function(){
            Route::get('/',[CashierSaleController::class,'show'])->name('index');
            Route::post('/save',[CashierSaleController::class,'store'])->name('save');
            Route::get('/edit/{id}',[CashierSaleController::class,'edit'])->name('edit');
            Route::post('/update/{id}',[CashierSaleController::class,'update'])->name('update');
            Route::get('/credit',[CashierSaleController::class,'credit'])->name('credit');
            Route::get('/report',[CashierSaleController::class,'report'])->name('report');
            });

        Route::prefix('dispatch')
        ->name('dispatch.')
        ->group(function(){
            Route::get('/',[DispatchController::class,'index'])->name('index');
            Route::post('/save',[DispatchController::class,'store'])->name('save');
            Route::get('/edit/{id}',[DispatchController::class,'edit'])->name('edit');
            Route::post('/update/{id}',[DispatchController::class,'update'])->name('update');
            Route::get('/delete/{id}',[DispatchController::class,'delete'])->name('delete');
        });

    });
});



//manager
Route::middleware(['auth','role:manager'])->group(function () {

    Route::get('/manager/dash',[ManagerController::class, 'dash']);

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

         // REPORT
        Route::prefix('report')
        ->name('report.')
        ->group(function () {
            Route::get('/sale', [ReportController::class, 'saleReport'])->name('sale');
            Route::get('/production',[ReportController::class,'productionReport'])->name('production');
            Route::get('/dispatch',[ReportController::class,'dispatchReport'])->name('dispatch');
        });

        //Print
        Route::prefix('print')
        ->name('print.')
        ->group(function () {
            Route::get('/print/sales',[PrintController::class,'sales'])->name('sales');
            Route::get('/print/production',[PrintController::class,'production'])->name('production');
            Route::get('/print/dispatch',[PrintController::class,'dispatch'])->name('dispatch');
            Route::get('/print/expenses',[PrintController::class,'expenses'])->name('expenses');
            Route::get('/print/stock',[PrintController::class,'stock'])->name('stock');

        });
    });

});

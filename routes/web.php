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

//cashier

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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


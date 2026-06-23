@extends('layouts.app')

@section('sidebar')
    <!-- Sidebar -->
        <div class="col-md-2 sidebar p-3 bg-blue" id="sidebar">

            <h3 class="text-center mb-4">
                <!-- LOGO -->
            <img src="{{ asset('images/logo.jpeg') }}" class="logo logo-icon" alt="Logo" style="width: 100px; height: 50px;">
            </h3>

            <a href="/cashier/dashboard">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <a href="/cashier/sales">
                <i class="bi bi-cart"></i> New Sale
            </a>

            <a href="/cashier/credit">
                <i class="bi bi-credit-card"></i> Credit Sales
            </a>

            <a href="{{ route('cashier.returns.index') }}">
                <i class="bi bi-arrow-return-left"></i> Returns & Damages
            </a>

            <a href="{{ route('cashier.customer.index') }}">
                 <i class="bi bi-person"></i> Drivers
            </a>

            <a href="{{ route('cashier.expenses.index') }}">
                <i class="bi bi-cash-stack"></i> Expenses
            </a>

            <a href="{{ route('cashier.production.index') }}">
                <i class="bi bi-box"></i> Productions
            </a>

            <a href="{{ route('cashier.stock.index') }}">
                 <i class="bi bi-box-seam"></i> Stock Management        
            </a>

            <a href="/cashier/daily-sales">
                 <i class="bi bi-bar-chart"></i> Daily Sales
            </a>
            <a href="/cashier/report">
                 <i class="bi bi-bar-chart"></i> Sales Report
            </a>
    
            <a href="/logout">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>

        </div>
@endsection
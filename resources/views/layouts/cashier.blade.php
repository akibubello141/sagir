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

            <a href="/cashier/driver-return">
                 <i class="bi bi-truck"></i> Driver Returns
            </a>

            <a href="/cashier/customers">
                <i class="bi bi-person"></i> Customers
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
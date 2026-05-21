@extends('layouts.app')

@section('sidebar')
    <!-- Sidebar -->
        <div class="col-md-2 sidebar p-3 bg-blue" id="sidebar">

            <h3 class="text-center mb-4">
                <!-- LOGO -->
            <img src="{{ asset('images/logo.jpeg') }}" class="logo logo-icon" alt="Logo" style="width: 100px; height: 50px;">
            </h3>

            <a href="/dashboard/cashier">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <a href="/dashboard/cashier/sales">
                <i class="bi bi-cart"></i> New Sale
            </a>

            <a href="/dashboard/cashier/driver">
                <i class="bi bi-truck"></i> Driver
            </a>

             <a href="/dashboard/cashier/products">
                <i class="bi bi-box-seam"></i> Products
            </a>

            <a href="/dashboard/cashier/sales-history">
                <i class="bi bi-clock-history"></i> Sales History
            </a>

            <a href="/dashboard/cashier/customers">
                <i class="bi bi-person"></i> Customers
            </a>

            <a href="/dashboard/cashier/reports">
                <i class="bi bi-bar-chart"></i> Reports
            </a>

            <a href="/logout">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>

        </div>
@endsection
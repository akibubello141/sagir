@extends('layouts.app')

@section('sidebar')
    <!-- Sidebar -->
        <div class="col-md-2 sidebar p-3 bg-blue" id="sidebar">

            <h3 class="text-center mb-4">
                <!-- LOGO -->
            <img src="{{ asset('images/logo.jpeg') }}" class="logo logo-icon" alt="Logo" style="width: 100px; height: 50px;">
            </h3>

            <a href="/manager/dash">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <a href="/manager/expenses">
                <i class="bi bi-cart"></i> Expenses
            </a>

            <a href="/manager/users">
                <i class="bi bi-truck"></i> Users
            </a>

            <a href="/manager/product">
                <i class="bi bi-box-seam"></i> Products
            </a>
            
            <a href="/manager/staff">
                <i class="bi bi-person"></i> Staff
            </a>

             <a href="/manager/settings">
                <i class="bi bi-box-seam"></i> Settings
            </a>

            <a href="/manager/driver-report">
                <i class="bi bi-bar-chart"></i> Driver Report
            </a>

            <a href="/manager/report">
                <i class="bi bi-bar-chart"></i> Reports
            </a>

            <a href="/logout">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>

        </div>
@endsection
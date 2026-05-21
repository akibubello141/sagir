@extends('layouts.app')

@section('sidebar')
    <!-- Sidebar -->
        <div class="col-md-2 sidebar p-3 blue-140" id="sidebar">

            <h3 class="text-center mb-4">
                <!-- LOGO -->
            <img src="{{ asset('images/logo.jpeg') }}" class="logo logo-icon" alt="Logo" style="width: 100px; height: 50px;">
            </h3>

            <a href="/dashboard/supervisor">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <a href="/supervisor/drivers">
                <i class="bi bi-truck"></i> Driver
            </a>

             <a href="/supervisor/products">
                <i class="bi bi-box-seam"></i> Products
            </a>

            <a href="/supervisor/maintenances">
                <i class="bi bi-wrench"></i> Maintenance
            </a>

            <a href="/supervisor/reports">
                <i class="bi bi-bar-chart"></i> Reports
            </a>

            <a href="/logout">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>

        </div>
@endsection
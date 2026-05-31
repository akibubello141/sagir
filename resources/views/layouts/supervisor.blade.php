@extends('layouts.app')

@section('sidebar')
    <!-- Sidebar -->
        <div class="col-md-2 sidebar p-3 blue-140" id="sidebar">

            <h3 class="text-center mb-4">
                <!-- LOGO -->
            <img src="{{ asset('images/logo.jpeg') }}" class="logo logo-icon" alt="Logo" style="width: 100px; height: 50px;">
            </h3>

            <a href="/supervisor/dashboard">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <a href="#">
                <i class="bi bi-truck"></i> Driver
            </a>

            <a href="/supervisor/load-products">
                <i class="bi bi-truck"></i> Load Products
            </a>

            <a href="/supervisor/delivery-history">
                <i class="bi bi-truck"></i> Delivery History
            </a>

             <a href="/supervisor/stock">
                <i class="bi bi-box-seam"></i> Products
            </a>
            <a href="/supervisor/returns">
                <i class="bi bi-arrow-return-left"></i> Returns & Damages
            </a>
            <a href="/supervisor/report">
                <i class="bi bi-bar-chart"></i> Reports
            </a>

            <a href="/logout">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>

        </div>
@endsection
@extends('layouts.supervisor')
@section('title', 'Supervisor Dashboard')
@section('content')
<div class="row">
        <!-- Content -->
        <div class="col-md-10 p-3 content">
                
        <!-- Cards -->
            <div class="row g-3">

                <div class="col-6 col-md-3">
                    <div class="card card-box p-3 text-center">
                        <i class="bi bi-cash-stack fs-1 text-primary"></i>
                        <h5 class="mt-2">₦120,000</h5>
                        <small>Today's Sales</small>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="card card-box p-3 text-center">
                        <i class="bi bi-cart-check fs-1 text-success"></i>
                        <h5 class="mt-2">85</h5>
                        <small>Total Orders</small>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="card card-box p-3 text-center">
                        <i class="bi bi-people fs-1 text-warning"></i>
                        <h5 class="mt-2">40</h5>
                        <small>Customers</small>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="card card-box p-3 text-center">
                        <i class="bi bi-box-seam fs-1 text-danger"></i>
                        <h5 class="mt-2">120</h5>
                        <small>Products</small>
                    </div>
                </div>

            </div>
        </div>
</div> 
@endsection

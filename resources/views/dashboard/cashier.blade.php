@extends('layouts.cashier')
@section('title', 'Dashboard')
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

            <!-- Recent Sales -->
            <div class="card card-box mt-4 p-3">

                <h5 class="mb-3">Recent Sales</h5>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">

                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>John</td>
                                <td>₦5,000</td>
                                <td>
                                    <span class="badge bg-success">
                                        Paid
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>Amina</td>
                                <td>₦12,000</td>
                                <td>
                                    <span class="badge bg-success">
                                        Paid
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td>David</td>
                                <td>₦7,500</td>
                                <td>
                                    <span class="badge bg-warning text-dark">
                                        Pending
                                    </span>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>

            </div>

        </div>
    </div>
@endsection
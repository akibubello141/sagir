@extends('layouts.supervisor')

@section('content')

<div class="container-fluid">

<h2 class="mb-4">Supervisor Dashboard</h2>

<div class="row">

    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5>Total Products</h5>
                <h2>{{ $products }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5>Today's Sales</h5>
                <h2>₦{{ number_format($todaySales,2) }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h5>Low Stock</h5>
                <h2>{{ $lowStock }}</h2>
            </div>
        </div>
    </div>

</div>

</div>

@endsection
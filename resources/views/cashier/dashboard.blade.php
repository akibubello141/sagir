@extends('layouts.cashier')

@section('content')

<div class="container-fluid">

    <h2 class="mb-4">Cashier Dashboard</h2>

    <div class="row">

        <div class="col-md-4">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <h5>Today's Sales</h5>
                    <h2>₦{{ number_format($todaySales,2) }}</h2>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
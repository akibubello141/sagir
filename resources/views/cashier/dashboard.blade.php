@extends('layouts.cashier')


@section('content')

<div class="container-fluid">

    <h2 class="mb-4">Cashier Dashboard</h2>

    <div class="row">

        <div class="col-md-3 p-2">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <h5>Today's Sales</h5>
                    <h2>₦{{ number_format($todayAmont,2) }}</h2>
                </div>
            </div>
        </div>

         <div class="col-md-3 p-2">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    <h5>Customers</h5>
                    <h2>{{ $customers }}</h2>
                </div>
            </div>
        </div>

     @foreach($products as $product)

        <div class="col-md-3 p-2">
            <div class="card bg-warning text-white shadow">
                <div class="card-body ">
                    <h5>{{ $product->name }} (<strong>{{ $product->stock_quantity }}</strong>)</h5>
                    <h2>₦{{ number_format($product->price, 2) }}</h2>
                </div>
            </div>
        </div>

         @endforeach

           <div class="col-md-3 p-2">
            <div class="card bg-danger text-white shadow">
                <div class="card-body">
                    <h5>Credit</h5>
                    <h2>₦{{number_format($totalCredit, 2) }}</h2>
                </div>
            </div>
        </div>


    </div>

</div>

@endsection
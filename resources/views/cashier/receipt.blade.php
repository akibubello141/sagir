@extends('layouts.cashier')

@section('content')

<div class="container">

<div class="card">

<div class="card-body">
    <span class="text-center d-block mb-3">
        <img src="{{ asset('images/logo.jpeg') }}" alt="Store Logo" style="max-width: 100px;">
    </span>
    <h2 class="text-center">SALES RECEIPT</h2>


    <hr>
    <table>
        <tr>
            <td><strong>Receipt ID:</strong></td>
            <td>{{ $sale->id }}</td>
        </tr>
        <tr>
            <td><strong>Customer:</strong></td>
            <td>{{ $sale->customer->name ?? 'Walk-in Customer' }}</td>
        </tr>
        <tr>
            <td><strong>Payment Method:</strong></td>
            <td>{{ strtoupper($sale->payment_method) }}</td>
        </tr>
        <tr>
            <td><strong>Date:</strong></td>
            <td>{{ date('F j, Y, g:i A', strtotime($sale->created_at)) }}</td>
        </tr>
    </table>
    
    <table class="table table-bordered">

        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>

        <tbody>

            @foreach($sale->items as $item)

            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>₦{{ $item->price }}</td>
                <td>₦{{ $item->subtotal }}</td>
            </tr>

            @endforeach

        </tbody>

    </table>

    <h3 class="text-end">
        Total: ₦{{ number_format($total,2) }}
    </h3>

    <button onclick="window.print()" class="btn btn-dark">
        Print Receipt
    </button>

</div>

</div>

</div>

@endsection
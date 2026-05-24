@extends('layouts.cashier')

@section('content')

<div class="container">

<div class="card">

<div class="card-body">

    <h2 class="text-center">SALES RECEIPT</h2>

    <hr>

    <p><strong>Receipt ID:</strong> {{ $sale->id }}</p>

    <p><strong>Customer:</strong>
        {{ $sale->customer->name ?? 'Walk-in Customer' }}
    </p>

    <p><strong>Payment:</strong>
        {{ strtoupper($sale->payment_method) }}
    </p>

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
        Total: ₦{{ number_format($sale->total_amount,2) }}
    </h3>

    <button onclick="window.print()" class="btn btn-dark">
        Print Receipt
    </button>

</div>

</div>

</div>

@endsection
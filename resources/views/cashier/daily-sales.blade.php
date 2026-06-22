@extends('layouts.cashier')

@section('content')
<form method="GET" action="{{ route('manager.report') }}">
    <div class="row mb-3">

        <div class="col-md-4">
            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Search Driver, Product, Customer..."
                   value="{{ request('search') }}">
        </div>

        <div class="col-md-2">
            <button type="submit"
                    class="btn btn-primary">
                Search
            </button>
        </div>

    </div>
</form>

<h3>Daily Sales</h3>

<table class="table table-bordered">

<thead>
<tr>
    <th>Customer</th>
    <th>Quantity</th>
    <th>Total</th>
    <th>Payment</th>
    <th>Date</th>
    <th>Action</th>
</tr>
</thead>

<tbody>

@foreach($sales as $sale)

<tr>
    <td>{{ $sale->customer->name ?? 'Walk-in Customer' }}</td>
    <td>{{ $sale->items->sum('quantity') }}</td>
    <td>₦{{ number_format($sale->items->sum('subtotal'), 2) }}</td>
    <td>{{ strtoupper($sale->payment_method) }}</td>
    <td>{{ $sale->created_at }}</td>
    <td><a href="/cashier/receipt/{{ $sale->id }}">Print</a></td>
</tr>

@endforeach

</tbody>

</table>
    <h3 class="text-end">
        Total: ₦{{ number_format($total,2) }}
    </h3>
@endsection
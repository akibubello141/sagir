@extends('layouts.cashier')

@section('content')

<h3>Daily Sales</h3>

<table class="table table-bordered">

<thead>
<tr>
    <th>Amount</th>
    <th>Payment</th>
    <th>Date</th>
    <th>Receipt</th>
    <th>Action</th>
</tr>
</thead>

<tbody>

@foreach($sales as $sale)

<tr>
    <td>₦{{ $sale->total_amount }}</td>
    <td>{{ strtoupper($sale->payment_method) }}</td>
    <td>{{ $sale->created_at }}</td>
    <td>#{{ $sale->id }}</td>
    <td><a href="/cashier/receipt/{{ $sale->id }}">Print</a></td>
</tr>

@endforeach

</tbody>

</table>

@endsection
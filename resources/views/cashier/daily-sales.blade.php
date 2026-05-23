@extends('layouts.app')

@section('content')

<h3>Daily Sales</h3>

<table class="table table-bordered">

<thead>
<tr>
    <th>Receipt</th>
    <th>Amount</th>
    <th>Payment</th>
    <th>Date</th>
</tr>
</thead>

<tbody>

@foreach($sales as $sale)

<tr>
    <td>#{{ $sale->id }}</td>
    <td>₦{{ $sale->total_amount }}</td>
    <td>{{ strtoupper($sale->payment_method) }}</td>
    <td>{{ $sale->created_at }}</td>
</tr>

@endforeach

</tbody>

</table>

@endsection
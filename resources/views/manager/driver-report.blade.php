@extends('layouts.manager')

@section('content')

<div class="container-fluid">

<div class="d-flex justify-content-between mb-4">

<h2>Driver Delivery Report</h2>

<button
onclick="window.print()"
class="btn btn-dark">

Print Report

</button>

</div>

<div class="row mb-4">

<div class="col-md-3">

<div class="card bg-success text-white">

<div class="card-body">

<h5>Total Cash</h5>

<h3>
₦{{ number_format(
$reports->sum('cash_collected'),
2
) }}
</h3>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card bg-primary text-white">

<div class="card-body">

<h5>Expected Revenue</h5>

<h3>
₦{{ number_format(
$reports->sum('expected_amount'),
2
) }}
</h3>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card bg-danger text-white">

<div class="card-body">

<h5>Total Shortage</h5>

<h3>
₦{{ number_format(
$reports->where(
'difference',
'<',
0
)->sum('difference') * -1,
2
) }}
</h3>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card bg-warning">

<div class="card-body">

<h5>Total Returns</h5>

<h3>
{{ $reports->sum(
'quantity_returned'
) }}
</h3>

</div>

</div>

</div>

</div>

<table class="table table-bordered table-striped">

<thead>

<tr>

<th>Driver</th>
<th>Product</th>
<th>Loaded</th>
<th>Returned</th>
<th>Sold</th>
<th>Expected</th>
<th>Cash Collected</th>
<th>Difference</th>
<th>Date</th>

</tr>

</thead>

<tbody>

@foreach($reports as $report)

@php

$loaded =
$report->deliveryLoad
->items
->first()
->quantity_loaded ?? 0;

$sold =
$loaded -
$report->quantity_returned;

@endphp

<tr>

<td>
{{ $report->deliveryLoad->driver->name }}
</td>

<td>
{{ $report->product->name }}
</td>

<td>
{{ $loaded }}
</td>

<td>
{{ $report->quantity_returned }}
</td>

<td>
{{ $sold }}
</td>

<td>
₦{{ number_format($report->expected_amount,2) }}
</td>

<td>
₦{{ number_format($report->cash_collected,2) }}
</td>

<td>

@if($report->difference < 0)

<span class="badge bg-danger">

₦{{ number_format(abs($report->difference),2) }}
Shortage

</span>

@elseif($report->difference > 0)

<span class="badge bg-success">

₦{{ number_format($report->difference,2) }}
Excess

</span>

@else

<span class="badge bg-primary">

Balanced

</span>

@endif

</td>

<td>
{{ $report->created_at->format('d-m-Y') }}
</td>

</tr>

@endforeach

</tbody>

</table>

</div>

@endsection
@extends('layouts.supervisor')

@section('content')

<div class="container-fluid">

<div class="d-flex justify-content-between mb-4">

<h2>Supervisor Report</h2>

<button
onclick="window.print()"
class="btn btn-dark">

Print Report

</button>

</div>

<!-- SUMMARY -->

<div class="row">

<div class="col-md-3">
<div class="card bg-primary text-white">
<div class="card-body">

<h5>Total Production</h5>

<h3>{{ $totalProduction }}</h3>

</div>
</div>
</div>

<div class="col-md-3">
<div class="card bg-danger text-white">
<div class="card-body">

<h5>Damaged Products</h5>

<h3>{{ $damagedProducts }}</h3>

</div>
</div>
</div>

<div class="col-md-3">
<div class="card bg-warning text-dark">
<div class="card-body">

<h5>Returned Products</h5>

<h3>{{ $returnedProducts }}</h3>

</div>
</div>
</div>

<div class="col-md-3">
<div class="card bg-success text-white">
<div class="card-body">

<h5>Stock In</h5>

<h3>{{ $stockIn }}</h3>

</div>
</div>
</div>

</div>

<!-- SECOND ROW -->

<div class="row mt-4">

<div class="col-md-6">
<div class="card">
<div class="card-body">

<h4>Low Stock Products</h4>

<table class="table table-bordered">

<tr>
<th>Product</th>
<th>Stock</th>
<th>Status</th>
</tr>

@foreach($lowStockProducts as $product)

<tr>

<td>{{ $product->name }}</td>

<td>{{ $product->stock_quantity }}</td>

<td>
<span class="badge bg-danger">
Low Stock
</span>
</td>

</tr>

@endforeach

</table>

</div>
</div>
</div>

<div class="col-md-6">
<div class="card">
<div class="card-body">

<h4>Stock Summary</h4>

<table class="table table-bordered">

<tr>
<th>Stock In</th>
<th>Stock Out</th>
</tr>

<tr>
<td>{{ $stockIn }}</td>
<td>{{ $stockOut }}</td>
</tr>

</table>

</div>
</div>
</div>

</div>

<!-- RECENT PRODUCTIONS -->

<div class="card mt-4">

<div class="card-body">

<h4>Recent Productions</h4>

<table class="table table-bordered">

<thead>

<tr>
<th>Product</th>
<th>Produced</th>
<th>Damaged</th>
<th>Returned</th>
<th>Date</th>
</tr>

</thead>

<tbody>

@foreach($recentProductions as $record)

<tr>

<td>{{ $record->product->name ?? '' }}</td>

<td>{{ $record->quantity_produced }}</td>

<td>{{ $record->damaged_quantity }}</td>

<td>{{ $record->returned_quantity }}</td>

<td>{{ $record->created_at }}</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

<!-- CASHIER ACTIVITIES -->

<div class="card mt-4">

<div class="card-body">

<h4>Recent Cashier Sales</h4>

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

@foreach($cashierSales as $sale)

<tr>

<td>#{{ $sale->id }}</td>

<td>
₦{{ number_format($sale->total_amount,2) }}
</td>

<td>
{{ strtoupper($sale->payment_method) }}
</td>

<td>
{{ $sale->created_at }}
</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

<!-- CHARTS -->

<div class="row mt-4">

<div class="col-md-6">
<div class="card">
<div class="card-body">

<h4>Damage vs Returns</h4>

<canvas id="damageChart"></canvas>

</div>
</div>
</div>

<div class="col-md-6">
<div class="card">
<div class="card-body">

<h4>Stock Movement</h4>

<canvas id="stockChart"></canvas>

</div>
</div>
</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

new Chart(
document.getElementById('damageChart'),
{
type:'pie',
data:{
labels:[
'Damaged',
'Returned'
],
datasets:[{
data:[
{{ $damagedProducts }},
{{ $returnedProducts }}
]
}]
}
});

new Chart(
document.getElementById('stockChart'),
{
type:'bar',
data:{
labels:[
'Stock In',
'Stock Out'
],
datasets:[{
data:[
{{ $stockIn }},
{{ $stockOut }}
]
}]
}
});

</script>

@endsection
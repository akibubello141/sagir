@extends('layouts.cashier')

@section('content')

<div class="container-fluid">

<div class="d-flex justify-content-between mb-4">

<h2>Cashier Report</h2>

<button
onclick="window.print()"
class="btn btn-dark">

Print Report

</button>

</div>

<!-- SUMMARY CARDS -->

<div class="row">

<div class="col-md-3">
<div class="card bg-primary text-white">
<div class="card-body">

<h5>Daily Sales</h5>

<h3>₦{{ number_format($dailySales,2) }}</h3>

</div>
</div>
</div>

<div class="col-md-3">
<div class="card bg-success text-white">
<div class="card-body">

<h5>Weekly Sales</h5>

<h3>₦{{ number_format($weeklySales,2) }}</h3>

</div>
</div>
</div>

<div class="col-md-3">
<div class="card bg-warning text-dark">
<div class="card-body">

<h5>Monthly Sales</h5>

<h3>₦{{ number_format($monthlySales,2) }}</h3>

</div>
</div>
</div>

<div class="col-md-3">
<div class="card bg-danger text-white">
<div class="card-body">

<h5>Total Transactions</h5>

<h3>{{ $totalTransactions }}</h3>

</div>
</div>
</div>

</div>

<!-- PAYMENT SUMMARY -->

<div class="row mt-4">

<div class="col-md-4">
<div class="card">
<div class="card-body text-center">

<h5>Cash Payments</h5>

<h2>₦{{ number_format($cashSales,2) }}</h2>

</div>
</div>
</div>

<div class="col-md-4">
<div class="card">
<div class="card-body text-center">

<h5>Transfer Payments</h5>

<h2>₦{{ number_format($transferSales,2) }}</h2>

</div>
</div>
</div>

<div class="col-md-4">
<div class="card">
<div class="card-body text-center">

<h5>POS Payments</h5>

<h2>₦{{ number_format($posSales,2) }}</h2>

</div>
</div>
</div>

</div>

<!-- RECENT SALES -->

<div class="card mt-4">

<div class="card-body">

<h4>Recent Sales</h4>

<table class="table table-bordered">

<thead>

<tr>
<th>Receipt ID</th>
<th>Amount</th>
<th>Payment</th>
<th>Date</th>
</tr>

</thead>

<tbody>

@foreach($recentSales as $sale)

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

</div>


//chart
<div class="card mt-4">
<div class="card-body">

<h4>Payment Chart</h4>

<canvas id="paymentChart"></canvas>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

new Chart(
document.getElementById('paymentChart'),
{
type:'pie',
data:{
labels:[
'Cash',
'Transfer',
'POS'
],
datasets:[{
data:[
{{ $cashSales }},
{{ $transferSales }},
{{ $posSales }}
]
}]
}
});

</script>
@endsection
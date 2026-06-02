@extends('layouts.manager')

@section('content')

<div class="container-fluid">

<div class="d-flex justify-content-between mb-4">

<h2>Manager Report</h2>

<button
onclick="window.print()"
class="btn btn-dark">

Print Report

</button>

</div>



<!-- SEARCH FORM -->

<div class="card mb-4">

<div class="card-body">

<form method="GET"
action="{{ route('manager.report') }}">

<div class="row">

<div class="col-md-4">

<label>Start Date</label>

<input
type="date"
name="start_date"
value="{{ request('start_date') }}"
class="form-control">

</div>

<div class="col-md-4">

<label>End Date</label>

<input
type="date"
name="end_date"
value="{{ request('end_date') }}"
class="form-control">

</div>

<div class="col-md-4">

<label>&nbsp;</label>

<button
type="submit"
class="btn btn-primary w-100">

Search Report

</button>

</div>

</div>

</form>

</div>

</div>

<!-- SUMMARY -->

<div class="row">

<div class="col-md-3">

<div class="card bg-success text-white">

<div class="card-body">

<h5>Total Sales</h5>

<h3>
₦{{ number_format($totalSales,2) }}
</h3>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card bg-danger text-white">

<div class="card-body">

<h5>Total Expenses</h5>

<h3>
₦{{ number_format($totalExpenses,2) }}
</h3>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card bg-primary text-white">

<div class="card-body">

<h5>Profit</h5>

<h3>
₦{{ number_format($profit,2) }}
</h3>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card bg-warning">

<div class="card-body">

<h5>Production</h5>

<h3>
{{ number_format($totalProduction) }}
</h3>

</div>

</div>

</div>

</div>

<!-- SALES TABLE -->

<div class="card mt-4">

<div class="card-body">

<h4>Sales Transactions</h4>

<table class="table table-bordered">

<thead>

<tr>

<th>ID</th>
<th>Amount</th>
<th>Payment</th>
<th>Date</th>

</tr>

</thead>

<tbody>

@forelse($sales as $sale)

<tr>

<td>{{ $sale->id }}</td>

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

@empty

<tr>

<td colspan="4"
class="text-center">

No Records Found

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>

</div>

@endsection
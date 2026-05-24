@extends('layouts.manager')

@section('content')

<div class="container-fluid">

<h2 class="mb-4">Manager Dashboard</h2>

<div class="row">

<div class="col-md-3">
<div class="card bg-success text-white">
<div class="card-body">
<h5>Total Sales</h5>
<h2>₦{{ number_format($totalSales,2) }}</h2>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card bg-danger text-white">
<div class="card-body">
<h5>Total Expenses</h5>
<h2>₦{{ number_format($totalExpenses,2) }}</h2>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card bg-primary text-white">
<div class="card-body">
<h5>Profit</h5>
<h2>₦{{ number_format($profit,2) }}</h2>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card bg-dark text-white">
<div class="card-body">
<h5>Total Users</h5>
<h2>{{ $users }}</h2>
</div>
</div>
</div>

</div>

<div class="row mt-4">

<div class="col-md-6">
<div class="card">
<div class="card-body">

<h5>Production Total</h5>

<h2>{{ $production }}</h2>

</div>
</div>
</div>

<div class="col-md-6">
<div class="card">
<div class="card-body">

<h5>Best Selling Product</h5>

<h2>
{{ $bestSelling->name ?? 'No Data' }}
</h2>

</div>
</div>
</div>

</div>

</div>

@endsection
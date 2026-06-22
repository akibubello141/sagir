@extends('layouts.cashier')

@section('content')

<div class="container">

<h3>Returned & Damaged Products</h3>

<form method="POST"
action="{{ route('cashier.returns.store') }}">

@csrf

<div class="row">

<div class="col-md-4">
<label>Product</label>

<select
name="product_id"
class="form-control">

@foreach($products as $product)

<option value="{{ $product->id }}">
{{ $product->name }}
</option>

@endforeach

</select>
</div>

<div class="col-md-4">
<label>Returned By</label>

<input
type="text"
name="returned_by"
class="form-control"
placeholder="Driver, Customer, Distributor">
</div>

<div class="col-md-4">
<label>Type</label>

<select
name="type"
class="form-control">

<option value="returned">
Returned
</option>

<option value="damaged">
Damaged
</option>

</select>
</div>

</div>

<div class="row mt-3">

<div class="col-md-3">
<label>Quantity</label>

<input
type="number"
name="quantity"
class="form-control">
</div>

<div class="col-md-9">
<label>Reason</label>

<textarea
name="reason"
class="form-control"></textarea>
</div>

</div>

<button
class="btn btn-primary mt-3">

Save Record

</button>

</form>

<hr>

<table class="table table-bordered">

<thead>

<tr>
<th>Date</th>
<th>Product</th>
<th>Type</th>
<th>Quantity</th>
<th>Returned By</th>
<th>Reason</th>
</tr>

</thead>

<tbody>

@foreach($records as $record)

<tr>

<td>{{ $record->record_date }}</td>

<td>{{ $record->product->name }}</td>

<td>{{ ucfirst($record->type) }}</td>

<td>{{ $record->quantity }}</td>

<td>{{ $record->returned_by }}</td>

<td>{{ $record->reason }}</td>

</tr>

@endforeach

</tbody>

</table>

</div>

@endsection
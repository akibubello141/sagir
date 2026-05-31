@extends('layouts.app')

@section('content')

<div class="container">

<h3>Driver Return Entry</h3>

@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

<form method="POST"
action="/cashier/driver-return">

@csrf

<div class="mb-3">

<label>Delivery</label>

<select
name="delivery_load_id"
class="form-control"
required>

<option value="">
Select Delivery
</option>

@foreach($deliveries as $delivery)

<option value="{{ $delivery->id }}">
Delivery #{{ $delivery->id }}
-
{{ $delivery->driver->name }}
</option>

@endforeach

</select>

</div>

<div class="mb-3">

<label>Quantity Returned</label>

<input
type="number"
name="quantity_returned"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Cash Collected (₦)</label>

<input
type="number"
step="0.01"
name="cash_collected"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Remarks</label>

<textarea
name="remarks"
class="form-control"></textarea>

</div>

<button
class="btn btn-success">

Submit Return

</button>

</form>

</div>

@endsection
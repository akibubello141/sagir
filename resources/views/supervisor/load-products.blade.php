@extends('layouts.supervisor')

@section('content')

<div class="container">

<h3>Load Products to Driver</h3>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form method="POST"
action="/supervisor/load-products">

@csrf

<div class="row">

<div class="col-md-4">

<label>Driver</label>

<select
name="driver_id"
class="form-control"
required>

<option value="">
Select Driver
</option>

@foreach($drivers as $driver)

<option value="{{ $driver->id }}">
{{ $driver->name }}
</option>

@endforeach

</select>

</div>

<div class="col-md-4">

<label>Product</label>

<select
name="product_id"
class="form-control"
required>

<option value="">
Select Product
</option>

@foreach($products as $product)

<option value="{{ $product->id }}">
{{ $product->name }}
(Stock:
{{ $product->stock_quantity }})
</option>

@endforeach

</select>

</div>

<div class="col-md-4">

<label>Quantity</label>

<input
type="number"
name="quantity"
class="form-control"
required>

</div>

</div>

<button
type="submit"
class="btn btn-primary mt-3">

Load Product

</button>

</form>

</div>

@endsection
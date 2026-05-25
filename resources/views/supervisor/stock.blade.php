@extends('layouts.supervisor')

@section('content')

<h3>Stock Management</h3>

<table class="table table-bordered">

<tr>
    <th>Product</th>
    <th>Stock</th>
    <th>Add Stock</th>
    <th>Action</th>
</tr>

@foreach($products as $product)

<tr>

<td>{{ $product->name }}</td>

<td>{{ $product->stock_quantity }}</td>

<td>

<form method="POST" action="/supervisor/add-stock">

@csrf

<input type="hidden"
name="product_id"
value="{{ $product->id }}">

<input type="number"
name="quantity"
class="form-control mb-2"
placeholder="Enter Quantity">

<button class="btn btn-success">
Add Stock
</button>

</form>

</td>
<td><i class="fas fa-edit">Edit</i>
    <br><i class="fas fa-trash">Delete</i></td>

</tr>

@endforeach

</table>

@endsection
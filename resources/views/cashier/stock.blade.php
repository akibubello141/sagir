@extends('layouts.cashier')

@section('content')

<h3>Stock Management</h3>

<table class="table table-bordered">

    <tr>
        <th>Product</th>
        <th>Stock</th>
        <th>Add Stock</th>
    </tr>

    @foreach($products as $product)

    <tr>
        <td>{{ $product->name }}</td>
        <td>{{ $product->stock_quantity }}</td>
        <td>
        <form method="POST" action="{{ route('cashier.stock.add') }}">

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

    </tr>

    @endforeach

</table>

@endsection
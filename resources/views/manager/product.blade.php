@extends('layouts.manager')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Product Management</h3>

        <!-- Add Product Button -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
            + Add Product
        </button>
    </div>

      @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

<table class="table table-bordered">

<tr>
<th>Name</th>
<th>Price</th>
<th>Stock Quantity</th>
<th>Lower Stock Quantity</th>
<th>Actions</th>
</tr>

@foreach($products as $product)

<tr>
<td>{{ $product->name }}</td>
<td>{{ $product->price }}</td>
<td>{{ $product->stock_quantity }}</td>
<td>{{ $product->low_stock_limit }}</td>
<td>
    <a href="/manager/edit_product/{{ $product->id }}" class="btn btn-sm btn-outline-primary">Edit</a>
    <a href="/manager/delete_product/{{ $product->id }}" class="btn btn-sm btn-outline-danger">Delete</a>
</td>
</tr>

@endforeach

</table>

<!-- 🟢 ADD PRODUCT MODAL -->
<div class="modal fade" id="addProductModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <form method="POST" action="/manager/save-product">
        @csrf

        <div class="modal-header">
          <h5 class="modal-title">Add New Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

            <div class="mb-2">
                <label>Product Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Price</label>
                <input type="number" name="price" class="form-control" step="0.01" required>
            </div>

            <div class="mb-2">
                <label>Stock Quantity</label>
                <input type="number" name="stock_quantity" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Lower Stock Quantity</label>
                <input type="number" name="lower_stock_quantity" class="form-control" required>
            </div>

        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class="btn btn-primary">Save Produc</button>
        </div>

      </form>

    </div>
  </div>
</div>

@endsection
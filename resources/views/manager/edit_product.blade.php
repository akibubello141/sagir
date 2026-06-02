@extends('layouts.manager')
@section('content')
<!-- 🟢 ADD PRODUCT MODAL -->


      <form method="POST" action="/manager/update_product/{{ $product->id }}">
        @csrf

        <div class="modal-header">
          <h5 class="modal-title">Add New Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

            <div class="mb-2">
                <label>Product Name</label>
                <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
            </div>

            <div class="mb-2">
                <label>Price</label>
                <input type="number" name="price" class="form-control" step="0.01" value="{{ $product->price }}" required>
            </div>

            <div class="mb-2">
                <label>Stock Quantity</label>
                <input type="number" name="stock_quantity" class="form-control" value="{{ $product->stock_quantity }}" required>
            </div>

            <div class="mb-2">
                <label>Lower Stock Quantity</label>
                <input type="number" name="lower_stock_quantity" class="form-control" value="{{ $product->low_stock_limit }}" required>
            </div>

        </div>

        <div class="modal-footer justify-content-between">
          <button class="btn btn-primary">Save Produc</button>
        </div>

      </form>

@endsection
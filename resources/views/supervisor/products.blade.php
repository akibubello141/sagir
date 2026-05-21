@extends('layouts.supervisor')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Product Management</h3>

        <!-- Add Product Button -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
            + Add Product
        </button>
    </div>

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- PRODUCTS TABLE -->
    <div class="card shadow-sm">
        <div class="card-body table-responsive">

            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Price (₦)</th>
                        <th>Stock</th>
                        <th>Low Stock Alert</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($products as $key => $product)
                    <tr>

                        <td>{{ $key + 1 }}</td>
                        <td>{{ $product->name }}</td>
                        <td>₦{{ $product->price }}</td>
                        <td>{{ $product->stock_quantity }}</td>
                        <td>{{ $product->low_stock_limit }}</td>

                        <!-- LOW STOCK WARNING -->
                        <td>
                            @if($product->stock_quantity <= $product->low_stock_limit)
                                <span class="badge bg-danger">Low Stock</span>
                            @else
                                <span class="badge bg-success">In Stock</span>
                            @endif
                        </td>

                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>

</div>

---

<!-- 🟢 ADD PRODUCT MODAL -->
<div class="modal fade" id="addProductModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <form method="POST" action="/supervisor/products">
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
                <input type="number" name="price" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Stock Quantity</label>
                <input type="number" name="stock_quantity" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Low Stock Limit</label>
                <input type="number" name="low_stock_limit" class="form-control" value="10">
            </div>

        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class="btn btn-primary">Save Product</button>
        </div>

      </form>

    </div>
  </div>
</div>

@endsection
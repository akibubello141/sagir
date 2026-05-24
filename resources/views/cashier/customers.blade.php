@extends('layouts.cashier')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Product Management</h3>

        <!-- Add Product Button -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
            + Add Customer
        </button>
    </div>

<table class="table table-bordered">

<tr>
    <th>Name</th>
    <th>Phone</th>
    <th>Address</th>
</tr>

@foreach($customers as $customer)

<tr>
    <td>{{ $customer->name }}</td>
    <td>{{ $customer->phone }}</td>
    <td>{{ $customer->address }}</td>
</tr>

@endforeach

</table>

<!-- 🟢 ADD CUSTOMER MODAL -->
<div class="modal fade" id="addCustomerModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <form method="POST" action="/cashier/save-customer">
        @csrf

        <div class="modal-header">
          <h5 class="modal-title">Add New Customer</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

            <div class="mb-2">
                <label>Full Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Address</label>
                <input type="text" name="address" class="form-control" required>
            </div>

        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class="btn btn-primary">Save Customer</button>
        </div>

      </form>

    </div>
  </div>
</div>

@endsection
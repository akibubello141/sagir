@extends('layouts.cashier')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Driver Management</h3>

        <!-- Add Product Button -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
            + Add Driver
        </button>
    </div>

<table class="table table-bordered">

<tr>
    <th>Name</th>
    <th>Phone</th>
    <th>Address</th>
    <th>Vehicle Number</th>
    <th>Actions</th>
</tr>

@foreach($customer as $customer)

<tr>
    <td>{{ $customer->name }}</td>
    <td>{{ $customer->phone }}</td>
    <td>{{ $customer->address }}</td>
    <td>{{ $customer->vehicle_number }}</td>
    <td><a href="{{ route('cashier.customer.delete', ['id' => $customer->id]) }}" class="btn btn-sm btn-outline-danger">delete</a><a href="{{ route('cashier.customer.edit', ['id' => $customer->id]) }}" class="btn btn-sm btn-outline-primary">Edit</a>
    </td>
</tr>

@endforeach

</table>

<!-- 🟢 ADD CUSTOMER MODAL -->
<div class="modal fade" id="addCustomerModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <form method="POST" action="{{ route('cashier.customer.store') }}">
        @csrf

        <div class="modal-header">
          <h5 class="modal-title">Add New Driver</h5>
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
            <div class="mb-2">
                <label>Vehicle Number</label>
                <input type="text" name="vehicle_number" class="form-control" required>
            </div>
  
        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class="btn btn-primary">Save Driver</button>
        </div>

      </form>

    </div>
  </div>
</div>

@endsection
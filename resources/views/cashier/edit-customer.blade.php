@extends('layouts.cashier')

@section('content')
  <div class="container mt-4">

      <form method="POST" action="{{ route('cashier.customer.update', ['id' => $customer->id]) }}">
        @csrf

        <div class="modal-header">
          <h5 class="modal-title">Edit Driver</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

            <div class="mb-2">
                <label>Full Name</label>
                <input type="text" name="name" class="form-control" value="{{ $customer->name }}" required>
            </div>

            <div class="mb-2">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ $customer->phone }}" required>
            </div>

            <div class="mb-2">
                <label>Address</label>
                <input type="text" name="address" class="form-control" value="{{ $customer->address }}" required>
            </div>
            <div class="mb-2">
                <label>Vehicle Number</label>
                <input type="text" name="vehicle_number" class="form-control" value="{{ $customer->vehicle_number }}" required>
            </div>
  
        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class="btn btn-primary">Save Driver</button>
        </div>

      </form>

    </div>

@endsection
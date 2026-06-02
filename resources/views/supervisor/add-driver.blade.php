@extends('layouts.supervisor')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Driver Management</h3>

        <!-- Add Driver Button -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDriverModal">
            + Add Driver
        </button>
    </div>

<table class="table table-bordered">

<tr>
    <th>Name</th>
    <th>Phone</th>
    <th>Vehicle Number</th>
    <th>Actions</th>
</tr>

@foreach($drivers as $driver)

<tr>
    <td>{{ $driver->name }}</td>
    <td>{{ $driver->phone }}</td>
    <td>{{ $driver->vehicle_number }}</td>
    <td><a href="/supervisor/delete-driver/{{ $driver->id }}" class="btn btn-sm btn-outline-danger">delete</a></td>
</tr>

@endforeach

</table>

<!-- 🟢 ADD DRIVER MODAL -->
<div class="modal fade" id="addDriverModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <form method="POST" action="/supervisor/storedriver">
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
                <label>Vehicle Number</label>
                <input type="text" name="vehicle_number" class="form-control" placeholder="Eg: ABC-123" required>
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
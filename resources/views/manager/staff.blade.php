@extends('layouts.manager')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Staff Management</h3>

        <!-- Add Staff Button -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
            + Add Staff
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
<th>Email</th>
<th>Phone</th>
<th>Role</th>
<th>Address</th>
<th>Action</th>
</tr>

@foreach($staff as $staff)

<tr>
<td>{{ $staff->name }}</td>
<td>{{ $staff->email }}</td>
<td>{{ $staff->phone }}</td>
<td>{{ strtoupper($staff->role) }}</td>
<td>{{ $staff->address }}</td>
<td>
  <a href="{{ route('manager.staff.edit', ['id' => $staff->id]) }}" class="btn btn-sm btn-outline-warning">edit</a>
  <a href="{{ route('manager.staff.delete', ['id' => $staff->id]) }}" class="btn btn-sm btn-outline-danger">Delete</a>
</td>
</tr>

@endforeach

</table>

<!-- 🟢 ADD Staff MODAL -->
<div class="modal fade" id="addUserModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

    <form method="POST" action="{{ route('manager.staff.save') }}">
        @csrf

        <div class="modal-header">
          <h5 class="modal-title">Add New Staff</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

            <div class="mb-2">
                <label>Full Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-2">
               <label for="role">Role</label>
               <input type="text" name="role" class="form-control" required>
            </div>

            <div class="mb-2">
              <label for="phone">Phone</label>
              <input type="text" name="phone" class="form-control">
            </div>

             <div>
              <label for="address">Address</label>
              <input type="text" name="address" class="form-control">
             </div>

        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class="btn btn-primary">Save Staff</button>
        </div>

      </form>

    </div>
  </div>
</div>

@endsection
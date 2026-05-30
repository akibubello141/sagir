@extends('layouts.manager')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Product Management</h3>

        <!-- Add Product Button -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
            + Add User
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
<th>Role</th>
<th>Action</th>
</tr>

@foreach($users as $user)

<tr>
<td>{{ $user->name }}</td>
<td>{{ $user->email }}</td>
<td>{{ strtoupper($user->role) }}</td>
<td><a href="/manager/delete-user/{{ $user->id }}" class="btn btn-sm btn-outline-danger">Delete</a>
</td>
</tr>

@endforeach

</table>

<!-- 🟢 ADD USER MODAL -->
<div class="modal fade" id="addUserModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <form method="POST" action="/manager/save-user">
        @csrf

        <div class="modal-header">
          <h5 class="modal-title">Add New User</h5>
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
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Role</label>
                <select name="role" class="form-control" required>
                    <option value="cashier">CASHIER</option>
                    <option value="supervisor">SUPERVISOR</option>
                    <option value="manager">MANAGER</option>
                </select>
            </div>

        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class="btn btn-primary">Save User</button>
        </div>

      </form>

    </div>
  </div>
</div>

@endsection
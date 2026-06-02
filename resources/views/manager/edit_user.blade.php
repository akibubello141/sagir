@extends('layouts.manager')
@section('content')


    <div class="container md-3 card">

        <h3>Edit User</h3>

         @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
    
      <form method="POST" action="/manager/update-user/{{ $user->id }}">
        @csrf

        <div class="modal-body">

            <div class="mb-2">
                <label>Full Name</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
            </div>

            <div class="mb-2">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
            </div>

            <div class="mb-2">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current password">
            </div>

            <div class="mb-2">
                <label>Role</label>
                <select name="role" class="form-control" required>
                    <option value="CASHIER" {{ $user->role === 'CASHIER' ? 'selected' : '' }}>CASHIER</option>
                    <option value="SUPERVISOR" {{ $user->role === 'SUPERVISOR' ? 'selected' : '' }}>SUPERVISOR</option>
                    <option value="MANAGER" {{ $user->role === 'MANAGER' ? 'selected' : '' }}>MANAGER</option>
                </select>
            </div>

        </div>

        <div class="modal-footer justify-content-between">
          <button class="btn btn-primary center">Save User</button>
        </div>

      </form>

    </div>


@endsection
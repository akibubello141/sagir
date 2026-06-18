@extends('layouts.manager')
@section('content')


    <div class="container md-3 card">

        <h3>Edit Staff</h3>

         @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
    
      <form method="POST" action="{{ route('manager.staff.update', ['id' => $staff->id]) }}">
        @csrf

        <div class="modal-body">

            <div class="mb-2">
                <label>Full Name</label>
                <input type="text" name="name" class="form-control" value="{{ $staff->name }}" required>
            </div>

            <div class="mb-2">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $staff->email }}" required>
            </div>

             <div class="mb-2">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ $staff->phone }}" required>

            <div class="mb-2">
                <label>Role</label>
                <input type="text" name="role" class="form-control" value="{{ $staff->role }}" required>
            </div>

             <div class="mb-2">
                <label>Address</label>
                <input type="text" name="address" class="form-control" value="{{ $staff->address }}" required>
            </div>


        </div>

        <div class="modal-footer justify-content-between">
          <button class="btn btn-primary center">Save Staff</button>
        </div>

      </form>

    </div>


@endsection
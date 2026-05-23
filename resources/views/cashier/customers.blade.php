@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">

    <h3>Customers</h3>

    <button class="btn btn-primary"
    data-bs-toggle="modal"
    data-bs-target="#customerModal">
        Add Customer
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

@endsection
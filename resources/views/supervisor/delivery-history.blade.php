@extends('layouts.supervisor')

@section('content')
<table class="table table-bordered">

<tr>
<th>ID</th>
<th>Driver</th>
<th>Date</th>
<th>Status</th>
</tr>

@foreach($loads as $load)

<tr>

<td>{{ $load->id }}</td>

<td>{{ $load->driver->name }}</td>

<td>{{ $load->delivery_date }}</td>

<td>{{ $load->status }}</td>

</tr>

@endforeach

</table>

@endsection
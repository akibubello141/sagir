@extends('layouts.manager')

@section('content')

<h3>Add User</h3>

<form method="POST" action="/manager/save-user">

@csrf

<input
type="text"
name="name"
placeholder="User Name"
class="form-control mb-2">

<input
type="email"
name="email"
placeholder="Email"
class="form-control mb-2">

<input
type="password"
name="password"
placeholder="Password"
class="form-control mb-2">

<select
name="role"
class="form-control mb-2">

<option value="user">User</option>
<option value="admin">Admin</option>

</select>

<button class="btn btn-success">
Add User
</button>

</form>

@endsection
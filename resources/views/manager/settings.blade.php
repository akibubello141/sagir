@extends('layouts.manager')

@section('content')

<h3>System Settings</h3>

<form method="POST" action="/manager/save-settings">

@csrf

<input
type="text"
name="company_name"
value="{{ $settings->company_name ?? '' }}"
placeholder="Company Name"
class="form-control mb-2">

<input
type="text"
name="company_phone"
value="{{ $settings->company_phone ?? '' }}"
placeholder="Phone"
class="form-control mb-2">

<input
type="email"
name="company_email"
value="{{ $settings->company_email ?? '' }}"
placeholder="Email"
class="form-control mb-2">

<textarea
name="company_address"
class="form-control mb-2"
placeholder="Address">{{ $settings->company_address ?? '' }}</textarea>

<button class="btn btn-primary">
Save Settings
</button>

</form>

@endsection
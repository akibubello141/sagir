@extends('layouts.manager')

@section('content')

<h3>Expenses</h3>

<form method="POST" action="/manager/save-expense">

@csrf

<input
type="text"
name="title"
placeholder="Expense Title"
class="form-control mb-2">

<input
type="number"
name="amount"
placeholder="Amount"
class="form-control mb-2">

<textarea
name="description"
class="form-control mb-2"
placeholder="Description"></textarea>

<input
type="date"
name="expense_date"
class="form-control mb-2">

<button class="btn btn-success">
Save Expense
</button>

</form>

@endsection
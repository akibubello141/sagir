@extends('layouts.cashier')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Expenses</h3>

        <!-- Add Expense Button -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
            + Add Expense
        </button>
    </div>

      @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

<table class="table table-bordered">
    <thead>
        <tr class="table-secondary">
            <th>Title</th>
            <th>Amount</th>
            <th>Description</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($expenses as $expense)
        <tr class="table-light">
            <td>{{ $expense->title }}</td>
            <td>₦{{ number_format($expense->amount, 2) }}</td>
            <td>{{ $expense->description }}</td>
            <td>{{ $expense->expense_date }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<h2>Expense Total: ₦{{ number_format($expenses->sum('amount'), 2) }}</h2>

<!-- 🟢 ADD USER MODAL -->
<div class="modal fade" id="addUserModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <form method="POST" action="{{ route('cashier.expenses.save') }}">
        @csrf

        <div class="modal-header">
          <h5 class="modal-title">Add New Expense</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

            <div class="mb-2">
                <label>Expense Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Amount</label>
                <input type="number" name="amount" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Description</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>

            <div class="mb-2">
                <label>Date</label>
                <input type="date" name="expense_date" class="form-control" required>
            </div>

        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class="btn btn-primary">Save Expense</button>
        </div>

      </form>

    </div>
  </div>
</div>

@endsection
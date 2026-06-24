@extends('layouts.manager')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between mb-4">
        <h2>Manager Report</h2>
        <button onclick="window.print()" class="btn btn-dark"> Print Report</button>
    </div>

    <!-- SEARCH FORM -->

    <div class="card mb-4">

        <div class="card-body">

            <form method="GET" action="{{ route('manager.report') }}">

                <div class="row">
                    <div class="col-md-4">
                        <label>Start Date</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label>End Date</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}"class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-primary w-100">Search Report</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- SUMMARY -->

    <div class="row">

        <div class="col-md-3 p-2">
            <a href="#sales" class="a" style="text-decoration:none;">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5>Total Sales</h5>
                        <h3>₦{{ number_format($totalSales,2) }}</h3>
                    </div>
                </div>
            </a>
        </div>

        
            <div class="col-md-3 p-2">
                <a href="#expenses" class="a" style="text-decoration:none;">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <h5>Total Expenses</h5>
                            <h3>₦{{ number_format($totalExpenses,2) }}</h3>
                        </div>
                    </div>
                 </a>
            </div>
       

        <div class="col-md p-2">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Remaining Amount</h5>
                    <h3>₦{{ number_format($profit,2) }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 p-2">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Credit</h5>
                    <h3>₦{{ number_format($remainingCredit,2) }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 p-2">
            <a href="#production" class="a" style="text-decoration:none;">
                <div class="card bg-warning">
                    <div class="card-body">
                        <h5>Production</h5>
                        <h3>{{ number_format($totalProduction) }}</h3>
                    </div>
                </div>
            </a>
        </div>
    </div>

        <!-- SALES TABLE -->

    <div class="card mt-4">

        <div class="card-body">

            <h4 id ="sales">Sales Transactions</h4>

            <table class="table table-bordered">

                <thead>

                    <tr class="table-secondary">

                        <th>ID</th>
                        <th>Amount</th>
                        <th>Payment</th>
                        <th>Date</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($sales as $sale)

                    <tr>

                        <td>{{ $sale->id }}</td>
                        <td>₦{{ number_format($sale->total_amount,2) }}</td>
                        <td>{{ strtoupper($sale->payment_method) }}</td>
                        <td>{{ $sale->created_at }}</td>

                    </tr>

                    @empty

                    <tr>

                        colspan="4" class="text-center">No Records Found</td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

       <!-- PRODUCTION TABLE -->

    <div class="card mt-4">

        <div class="card-body">

            <h4 id="production">Productions</h4>

            <table class="table table-bordered">

                <thead>

                    <tr class="table-secondary">

                         <th>Producer Name</th>
                        <th>product</th>
                        <th>Quantity Produced</th>
                        <th>Damaged Quantity</th>
                        <th>Shifting</th>
                        <th>Date</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($productions as $production)

                    <tr>
                        <td>{{ $production->producer_name}}</td>
                        <td>products</td>
                        <td>{{ $production->quantity_produced }}</td>
                        <td>{{ $production->damaged_quantity }}</td>
                        <td>{{ $production->shifting}}</td>
                        <td>{{ $production->production_date}}</td>
                    </tr>

                    @empty

                    <tr>

                        colspan="4" class="text-center">No Records Found</td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

     <!-- EXPENSES TABLE -->

    <div class="card mt-4">

        <div class="card-body">

            <h4 id="expenses">Expenses</h4>

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

                    @forelse($expenses as $expense)

                   <tr class="table-light">
                        <td>{{ $expense->title }}</td>
                        <td>₦{{ number_format($expense->amount, 2) }}</td>
                        <td>{{ $expense->description }}</td>
                        <td>{{ $expense->expense_date }}</td>
                    </tr>

                    @empty

                    <tr>

                        colspan="4" class="text-center">No Records Found</td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


</div>

@endsection
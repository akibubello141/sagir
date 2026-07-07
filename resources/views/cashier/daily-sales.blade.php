@extends('layouts.cashier')

@section('content')
<div class="container-fluid">


<!-- Top Controls -->
<div class="row mb-3">
    <div class="col-md-6">
        <form method="GET" class="d-flex align-items-center">
            <label class="me-2 fw-bold">Show:</label>

            <select name="per_page"
                    onchange="this.form.submit()"
                    class="form-select w-auto">

                <option value="10" {{ request('per_page',10)==10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ request('per_page')==25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ request('per_page')==50 ? 'selected' : '' }}>50</option>
                <option value="100" {{ request('per_page')==100 ? 'selected' : '' }}>100</option>

            </select>

            <span class="ms-3">
                Total Records: {{ $cashierSales->total() }}
            </span>
        </form>
    </div>
</div>

<!-- Table -->
<div class="table-responsive">

    <table class="table table-bordered table-striped table-hover">

        <thead class="table-primary">

            <tr>
                <th>VEHICLE</th>
                <th>PRODUCT</th>
                <th>BAGS SOLD</th>
                <th>TOTAL AMOUNT</th>
                <th>LINKAGES</th>
                <th>LINKAGE AMOUNT</th>
                <th>PLUS</th>
                <th>PLUS AMOUNT</th>
                <th>VEHICLE FUEL</th>
                <th>VEHICLE EXP</th>
                <th>CREDIT</th>
                <th>TRANSFER</th>
                <th>PAID CREDIT</th>
                <th>SPECIAL EXP1</th>
                <th>SPECIAL EXP2</th>
                <th>ACTION</th>
            </tr>

        </thead>

        <tbody>

            @foreach($cashierSales as $cashierSale)

            <tr>
                <td>{{ $cashierSale->customer?->name ?? 'NULL' }}</td>
                <td>{{ $cashierSale->product?->name ?? 'NULL' }}</td>
                <td>{{ $cashierSale->bags_sold }}</td>
                <td>{{ number_format($cashierSale->total_amount,2) }}</td>
                <td>{{ $cashierSale->linkages }}</td>
                <td>{{ number_format($cashierSale->linkage_amount,2) }}</td>
                <td>{{ $cashierSale->plus }}</td>
                <td>{{ number_format($cashierSale->plus_amount,2) }}</td>
                <td>{{ number_format($cashierSale->vehicle_fuel,2) }}</td>
                <td>{{ number_format($cashierSale->vehicle_exp,2) }}</td>
                <td>{{ number_format($cashierSale->credit,2) }}</td>
                <td>{{ number_format($cashierSale->transfer,2) }}</td>
                <td>{{ number_format($cashierSale->paid_credit,2) }}</td>
                <td>{{ number_format($cashierSale->special_exp1,2) }}</td>
                <td>{{ number_format($cashierSale->special_exp2,2) }}</td>
                <td>
                    <a href="{{ route('cashier.driver.edit',$cashierSale->id) }}"
                       class="btn btn-sm btn-primary">
                        Edit
                    </a>
                </td>
            </tr>

            @endforeach

        </tbody>

    </table>

</div>

<!-- Pagination -->
<div class="d-flex justify-content-center mt-3">
    {{ $cashierSales->links() }}
</div>


</div>
@endsection
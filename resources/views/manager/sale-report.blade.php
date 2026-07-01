@extends('layouts.manager')

@section('content')
<div class="container-fluid">


<!-- Top Controls -->
 <div class="row mb-3"></div>
<div class="row mb-3">
        <form method="GET" class="row mb-3">

        <div class="col-md-2">
            <input type="date"
                name="sales_date"
                value="{{ request('sales_date') }}"
                class="form-control">
        </div>

          <div class="col-md-2">
            <input type="date"
                name="sales_date1"
                value="{{ request('sales_date1') }}"
                class="form-control">
        </div>

        <div class="col-md-2">
            <select name="vehicle" class="form-control">
                <option value="">All Vehicle</option>

                @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->vehicle }}"
                        {{ request('vehicle') == $vehicle->vehicle ? 'selected' : '' }}>
                        {{ $vehicle->vehicle }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <select name="product_id" class="form-control">
                <option value="">All Products</option>

                @foreach($products as $product)
                    <option value="{{ $product->id }}"
                        {{ request('product_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <select name="per_page"
                    class="form-control">
                <option value="10">10 Records</option>
                <option value="25">25 Records</option>
                <option value="50">50 Records</option>
                <option value="100">100 Records</option>
            </select>
        </div>

        <div class="col-md-1">
            <button class="btn btn-primary w-100">
                Search
            </button>
        </div>

    </form>
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
                <th>TOTAL BAL</th>
                <th>GROSS</th>
                <th>DATE</th>
            </tr>

        </thead>

        <tbody>

            @foreach($cashierSales as $cashierSale)

            <tr>
                <td>{{ $cashierSale->vehicle }}</td>
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
                <td>{{ number_format($cashierSale->total_balance,2) }}</td>
                <td>{{ number_format($cashierSale->gross,2) }}</td>
                <td>{{ $cashierSale->sales_date }}</td>
                
            </tr>

            @endforeach
            <tr class="table-primary" style="font: size 24px;">
                <th colspan="2">GRAND TOTAL:</th>
                <th>{{ number_format($totals->bags_sold, 2) }}</th>
                <th>{{ number_format($totals->total_amount, 2) }}</th>
                <th>{{ number_format($totals->linkages, 2) }}</th>
                <th>{{ number_format($totals->linkage_amount, 2) }}</th>
                <th>{{ number_format($totals->plus, 2) }}</th>
                <th>{{ number_format($totals->plus_amount, 2) }}</th>
                <th>{{ number_format($totals->vehicle_fuel, 2) }}</th>
                <th>{{ number_format($totals->vehicle_exp, 2) }}</th>
                <th>{{ number_format($totals->credit, 2) }}</th>
                <th>{{ number_format($totals->transfer, 2) }}</th>
                <th>{{ number_format($totals->paid_credit, 2) }}</th>
                <th>{{ number_format($totals->special_exp1, 2) }}</th>
                <th>{{ number_format($totals->special_exp2, 2) }}</th>
                <th>{{ number_format($totals->total_balance, 2) }}</th>
                <th>{{ number_format($totals->gross, 2) }}</th>
                <th></th>
            </tr>

        </tbody>

    </table>

</div>

<!-- Pagination -->
<div class="d-flex justify-content-center mt-3">
    {{ $cashierSales->links() }}
</div>


</div>
@endsection
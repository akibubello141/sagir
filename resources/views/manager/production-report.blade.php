@extends('layouts.manager')

@section('content')
<div class="container-fluid">


<!-- Top Controls -->
 <div class="row mb-3">
     <div class="row">

        <div class="col-md-5 p-2">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>PRODUCTION</h5>
                    <h2>{{number_format($totalProduction,2)}}
                    </h2>
                </div>
            </div>
        </div>
 </div>
<div class="row mb-3">
        <form method="GET" class="row mb-3">

        <div class="col-md-1">
            <input type="date"
                name="sales_date"
                value="{{ request('sales_date') }}"
                class="form-control">
        </div>

          <div class="col-md-1">
            <input type="date"
                name="sales_date1"
                value="{{ request('sales_date1') }}"
                class="form-control">
        </div>

        <div class="col-md-2">
            <select name="producer" class="form-control">
                <option value="">All Vehicle</option>

                @foreach($producers as $producer)
                    <option value="{{ $producer->producer_name }}"
                        {{ request('producer') == $producer->producer_name ? 'selected' : '' }}>
                        {{ $producer->producer_name }}
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
            <select name="production_site" id="production_site" class="form-control">
                <option value="">All Sites</option>
                <option value="Shingai Site">Shingai Site</option>
                <option value="Main Site">Main Site</option>
            </select>
        </div>
    
        <div class="col-md-2">
            <select name="shifting" class="form-control">
                <option value="">All Vehicle</option>
                <option value="Morning">Morning</option>
                <option value="Afternoon">Afternoon</option>
            </select>
        </div>

        <div class="col-md-1">
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
                Total Records: {{ $productions->total() }}
            </span>
        </form>
    </div>
</div>

<!-- Table -->
<div class="table-responsive">

    <table class="table table-bordered table-striped table-hover">

        <thead class="table-primary">

            <tr>
                <th>NAMES</th>
                <th>PRODUCT</th>
                <th>PRODUCTION SITE</th>
                <th>KG COLLECTED</th>
                <th>KG USED</th>
                <th>KG LEFT</th>
                <th>BAGS PER KG</th>
                <th>QUANTITY PRODUCED</th>
                <th>DAMAGE QUANTITY</th>
                <th>SHIFTING</th>
                <th>DATE</th>
            </tr>

        </thead>

        <tbody>

            @foreach($productions as $production)

            <tr>
                 <td>{{ $production->producer_name }}</td>
                <td>{{ $production->product->name }}</td>
                <td>{{ $production->production_site }}</td>
                <td>{{ $production->kg_collected }}</td>
                <td>{{ $production->kg_used }}</td>
                <td>{{ $production->kg_left }}</td>
                <td>{{ $production->bags_per_kg }}</td>
                <td>{{ $production->quantity_produced }}</td>
                <td>{{ number_format($production->damaged_quantity,2) }}</td>
                <td>{{ $production->shifting }}</td>
                <td>{{ $production->production_date }}</td>          
            </tr>

            @endforeach
        </tbody>
            @php
            $total_kg_collected = $productions->sum('kg_collected');
            $total_kg_used = $productions->sum('kg_used');
            $total_kg_left = $productions->sum('kg_left');
            $total_bags_per_kg = $productions->sum('bags_per_kg');
            $total_quantity_produced = $productions->sum('quantity_produced');
            $total_damaged_quantity = $productions->sum('damaged_quantity');
            @endphp
        <tfoot>
             <tr class="table-primary" style="font: size 24px;">
                <th colspan="3">GRAND TOTAL:</th>
                <th>{{ number_format($total_kg_collected, 2) }}</th>
                <th>{{ number_format($total_kg_used, 2) }}</th>
                <th>{{ number_format($total_kg_left, 2) }}</th>
                <th>{{ number_format($total_bags_per_kg, 2) }}</th>
                <th>{{ number_format($total_quantity_produced, 2) }}</th>
                <th>{{ number_format($total_damaged_quantity, 2) }}</th>
                <th colspan="2"></th>
            </tr>
        </tfoot>
           
    </table>

</div>

<!-- Pagination -->
<div class="d-flex justify-content-center mt-3">
    {{ $productions->links() }}
</div>


</div>
@endsection
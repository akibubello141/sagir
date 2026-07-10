@extends('layouts.manager')

@section('content')
<div class="container-fluid">

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
                <option value="">All Shifts</option>
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
                Total Records: {{ $dispatches->total() }}
            </span>
        </form>
    </div>
</div>

<!-- Table -->
<div class="table-responsive">

    <table class="table table-bordered table-striped table-hover">

        <thead class="table-primary">

            <tr>
                <th>PRODUCT</th>
                <th>PRODUCTION SITE</th>
                <th>SHIFTING</th>
                <th>QUANTITY MADE</th>
                <th>QUANTITY PRODUCE</th>
                <th>QUANTITY DISPATCHED</th>
                <th>LINKAGE</th>
                <th>REFILL</th>
                <th>QUANTITY LEFT</th>
                <th> DISPATCH DATE</th>
            </tr>

        </thead>

        <tbody>

            @foreach($dispatches as $dispatch)

            <tr>
                <td>{{ $dispatch->product->name }}</td>
                <td>{{ $dispatch->production_site }}</td>
                <td>{{ $dispatch->shifting }}</td>
                <td>{{ $dispatch->quantity_made }}</td>
                <td>{{ $dispatch->quantity_produced }}</td>   
                <td>{{ $dispatch->quantity_dispatched }}</td>
                <td>{{ $dispatch->linkage }}</td>
                <td>{{ $dispatch->refill }}</td>
                <td>{{ $dispatch->quantity_left }}</td>
                <td>{{ $dispatch->dispatch_date }}</td>         
            </tr>

            @endforeach
        </tbody>
            @php
            $quantity_made = $dispatches->sum('quantity_made');
            $quantity_produced = $dispatches->sum('quantity_produced');
            $quantity_dispatched = $dispatches->sum('quantity_dispatched');
            $linkage = $dispatches->sum('linkage');
            $refill = $dispatches->sum('refill');
            $quantity_left = $dispatches->sum('quantity_left');
            @endphp
        <tfoot>
             <tr class="table-primary" style="font: size 24px;">
                <th colspan="3">GRAND TOTAL:</th>
                <th>{{ number_format($quantity_made, 2) }}</th>
                <th>{{ number_format($quantity_produced, 2) }}</th>
                <th>{{ number_format($quantity_dispatched, 2) }}</th>
                <th>{{ number_format($linkage, 2) }}</th>
                <th>{{ number_format($refill, 2) }}</th>
                <th>{{ number_format($quantity_left, 2) }}</th>
            </tr>
        </tfoot>
           
    </table>

</div>

<!-- Pagination -->
<div class="d-flex justify-content-center mt-3">
    {{ $dispatches->links() }}
</div>


</div>


<!-- 🟢 ADD Production MODAL -->
<div class="modal fade" id="addCustomerModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

        <form method="POST" action="{{ route('cashier.dispatch.save') }}">

            @csrf

            <div class="modal-header">
                <h5 class="modal-title">Add New Dispatch</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

             <div class="modal-body">


                    <div class="mb-2">
                        <label for="product_id" class="form-label">Product</label>
                        <select name="product_id" id="product_id" class="form-control">
                            @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>

                     <div class=" mb-2">
                        <label>QUANTITY MADE</label>
                        <input type="number" step="0.01"
                            id="quantity_made"
                            name="quantity_made"
                            class="form-control"
                            required>
                    </div>

                    <div class=" mb-2">
                        <label>QUANTITY PRODUCED</label>
                        <input type="number" step="0.01"
                            id="quantity_produced"
                            name="quantity_produced"
                            class="form-control"
                            required>
                    </div>
                    <div class=" mb-2">
                        <label>QUANTITY DISPATCHED</label>
                        <input type="number" step="0.01"
                            id="quantity_dispatched"
                            name="quantity_dispatched"
                            class="form-control"
                            required>
                    </div>

                    <div class=" mb-2">
                        <label>LINKAGE</label>
                        <input type="number" step="0.01"
                            id="linkage"
                            name="linkage"
                            class="form-control"
                            required>
                    </div>

                    <div class=" mb-2">
                        <label>REFILL</label>
                        <input type="number" step="0.01"
                            id="refill"
                            name="refill"
                            class="form-control"
                            required>
                    </div>

                    <div class=" mb-2">
                        <label>QUANTITY LEFT</label>
                        <input type="number" step="0.01"
                            id="quantity_left"
                            name="quantity_left"
                            class="form-control"
                            required>
                    </div>

                    


                    <div class="mb-2">
                        <label for="production_site" class="form-label">PRODUCTION SITE</label>
                        <select name="production_site" id="production_site" class="form-control">
                            <option value="Shingai Site">Shingai Site</option>
                            <option value="Main Site">Main Site</option>
                        </select>
                    </div>

                     <div class="mb-2">
                        <label for="shifting" class="form-label">SHIFTING</label>
                        <select name="shifting" id="shifting" class="form-control">
                            <option value="Morning">Morning</option>
                            <option value="Afternoon">Afternoon</option>
                        </select>
                    </div>
                    
                
                    <div class="modal-footer">
                    <button class="btn btn-primary">Save Dispatch</button>
                    </div>
                </div>
        </form>

    </div>
  </div>
</div
@endsection
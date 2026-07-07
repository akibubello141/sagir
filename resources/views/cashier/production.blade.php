@extends('layouts.cashier')

@section('content')
<div class="container-fluid">


<!-- Top Controls -->
 <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Production Management</h3>

        <!-- Add Production Button -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
            + Add Production
        </button>
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
                <option value="">All Producers</option>

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


<!-- 🟢 ADD Production MODAL -->
<div class="modal fade" id="addCustomerModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

        <form method="POST" action="{{ route('cashier.production.save') }}">

            @csrf

            <div class="modal-header">
                <h5 class="modal-title">Add New Production</h5>
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
                        <label>KG Collected</label>
                        <input type="number" step="0.01"
                            id="kg_collected"
                            name="kg_collected"
                            class="form-control"
                            oninput="calculateProduction()">
                    </div>

                    <div class=" mb-2">
                        <label>KG Used</label>
                        <input type="number" step="0.01"
                            id="kg_used"
                            name="kg_used"
                            class="form-control"
                            oninput="calculateProduction()">
                    </div>

                    <div class=" mb-2">
                        <label>KG Left</label>
                        <input type="number"
                            id="kg_left"
                            name="kg_left"
                            class="form-control"
                            readonly>
                    </div>

                    <div class=" mb-2">
                        <label>No. of Bags Per KG</label>
                        <input type="number"
                            id="bags_per_kg"
                            name="bags_per_kg"
                            class="form-control"
                            oninput="calculateProduction()">
                    </div>

                    <div class=" mb-2">
                        <label>Total Bags Produced</label>
                        <input type="number"
                            id="total_bags_produced"
                            name="total_bags_produced"
                            class="form-control"
                            readonly>
                    </div>

                    <div class="mb-2">
                        <label for="damaged_quantity" class="form-label">Damaged Quantity</label>
                        <input type="number" name="damaged_quantity" id="damaged_quantity" class="form-control">
                        <input type="number" hidden name="returned_quantity" id="returned_quantity" value="0" class="form-control">
                    </div>

                    <div class="mb-2">
                        <label for="production_site" class="form-label">Production Site</label>
                        <select name="production_site" id="production_site" class="form-control">
                            <option value="Shingai Site">Shingai Site</option>
                            <option value="Main Site">Main Site</option>
                        </select>
                    </div>

                     <div class="mb-2">
                        <label for="shifting" class="form-label">Shifting</label>
                        <select name="shifting" id="shifting" class="form-control">
                            <option value="Morning">Morning</option>
                            <option value="Afternoon">Afternoon</option>
                        </select>
                    </div>
                    
                     <div class="mb-2">
                        <label for="producer_name" class="form-label"> Producer Name</label>
                        <input type="text" name="producer_name" id="producer_name" class="form-control">
                    </div>

                    <div class="mb-2">
                        <label for="remarks" class="form-label">Remarks</label>
                        <textarea name="remarks" id="remarks" class="form-control"></textarea>
                    </div>

                    <div class="modal-footer">
                    <button class="btn btn-primary">Save Driver</button>
                    </div>
                </div>
        </form>

    </div>
  </div>
</div>
<script>
    function calculateProduction(){

    let collected = parseFloat(document.getElementById('kg_collected').value) || 0;
    let used = parseFloat(document.getElementById('kg_used').value) || 0;
    let bagsPerKg = parseFloat(document.getElementById('bags_per_kg').value) || 0;

    document.getElementById('kg_left').value = collected - used;

    document.getElementById('total_bags_produced').value =
        used * bagsPerKg;
}
</script>
@endsection
@extends('layouts.cashier')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Production Management</h3>

        <!-- Add Production Button -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
            + Add Production
        </button>
    </div>

<table class="table table-bordered">

<tr>
    <th>Producer Name</th>
    <th>product</th>
    <th>Quantity Produced</th>
    <th>Damaged Quantity</th>
    <th>Shifting</th>
    <th>Date</th>
</tr>

 @foreach($records as $record)

    <tr>
        <td>{{ $record->producer_name}}</td>
        <td>products</td>
        <td>{{ $record->quantity_produced }}</td>
        <td>{{ $record->damaged_quantity }}</td>
        <td>{{ $record->shifting}}</td>
        <td>{{ $record->production_date}}</td>
    </tr>

    @endforeach

</table>

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
        
                    <div class="mb-2">
                        <label for="quantity_produced" class="form-label">Quantity Produced</label>
                        <input type="number" name="quantity_produced" id="quantity_produced" class="form-control">
                    </div>

                    <div class="mb-2">
                        <label for="damaged_quantity" class="form-label">Damaged Quantity</label>
                        <input type="number" name="damaged_quantity" id="damaged_quantity" class="form-control">
                        <input type="number" hidden name="returned_quantity" id="returned_quantity" value="0" class="form-control">
                    </div>

                    <div class="mb-2">
                        <label for="shifting" class="form-label">Shifting</label>
                        <select name="shifting" id="shifting" class="form-control">
                            <option value="Morning">Morning</option>
                            <option value="Aferternoon">Afternoon</option>
                        </select>
                    </div>
                    
                     <div class="mb-2">
                        <label for="producer_name" class="form-label"> Producer Name</label>
                        <input type="text" name="producer_name" id="producer_name" class="form-control">
                    </div>

                    <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Save Driver</button>
                    </div>
                </div>
        </form>

    </div>
  </div>
</div>

@endsection
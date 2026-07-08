@extends('layouts.cashier')

@section('content')

<div class="container">

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            Daily Sales Entry

            @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
        </div>

        <div class="card-body">

            <form method="POST" action="{{ route('cashier.driver.save') }}">
                @csrf

                <div class="row">

                    <div class="col-md-3 mb-3">
                        <label>Date</label>
                        <input type="date" name="sales_date" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Vehicle</label>
                        <select name="vehicle" id="" class="form-control">
                            <option value="0">Select Driver</option>
                            @foreach($customers as $customer)
                            <option value="{{$customer->id}}">{{ $customer->name}}</option>
                            @endforeach
                        </select>
                       
                    </div>

                     <div class="col-md-3">
                        <label>Enter Product</label>
                        <select name="product_id" id="" class="form-control">
                            <option value="0" >Select Product</option>
                            @foreach($products as $product)
                            <option value="{{$product->id}}" data-id="{{ $product->price }}">{{ $product->name}}|Price:{{$product->price }}|Stock:{{ $product->stock_quantity }}</option>
                            @endforeach
                        </select>
                       
                    </div>

                     <div class="col-md-3">
                        <label>Enter Price</label>
                        <input type="number" id="product_amount"  class="form-control" placeholder="Enter price">
                    </div>

                    <div class="col-md-3">
                        <label>No of Bags Sold</label>
                        <input type="number" name="bags_sold" value="0" id="bags_sold" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label>Total Amount</label>
                        <input type="number" name="total_amount" value="0" id="total_amount" class="form-control" readonly>
                    </div>

                    <div class="col-md-3">
                        <label>Linkages</label>
                        <input type="number" name = "linkages" value="0" id="linkages" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label>Linkage Amount</label>
                        <input type="number" name = "linkage_amount" value="0" id="linkage_amount" class="form-control" readonly>
                    </div>

                    <div class="col-md-3">
                        <label>Plus</label>
                        <input type="number" name = "plus" value="0" id="plus" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label>Plus Amount</label>
                        <input type="number" name = "plus_amount" value="0" id="plus_amount" class="form-control" readonly>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Vehicle Fuel</label>
                        <input type="number" step="0.01" name="vehicle_fuel" value="0" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Vehicle Exp</label>
                        <input type="number" step="0.01" name="vehicle_exp"  value="0" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Credit</label>
                        <input type="number" step="0.01" name="credit" value="0" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Transfer</label>
                        <input type="number" step="0.01" name="transfer" value="0" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Paid Credit</label>
                        <input type="number" step="0.01" value="0" name="paid_credit" value="0" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Special Exp 1</label>
                        <input type="number" step="0.01" name="special_exp1" value="0" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Special Exp 2</label>
                        <input type="number" step="0.01" name="special_exp2" value="0" class="form-control">
                    </div>


                </div>

                <button class="btn btn-success">
                    Save Sales
                </button>

            </form>

        </div>
    </div>

</div>
<script>
function calculateAmounts() {

    let price = Number(document.getElementById('product_amount').value)|| 0;

    let bagsSold = parseFloat(document.getElementById('bags_sold').value) || 0;
    let linkages = parseFloat(document.getElementById('linkages').value) || 0;
    let plus = parseFloat(document.getElementById('plus').value) || 0;
    

    document.getElementById('total_amount').value =
        bagsSold * price;

    document.getElementById('linkage_amount').value =
        linkages * price;

    document.getElementById('plus_amount').value =
        plus * price;
}

document.getElementById('product_amount')
    .addEventListener('input', calculateAmounts);

document.getElementById('bags_sold')
    .addEventListener('input', calculateAmounts);

document.getElementById('linkages')
    .addEventListener('input', calculateAmounts);

document.getElementById('plus')
    .addEventListener('input', calculateAmounts);
</script>

@endsection
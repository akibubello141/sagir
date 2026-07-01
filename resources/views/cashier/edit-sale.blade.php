@extends('layouts.cashier')

@section('content')

<div class="container">

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            Daily Sales Entry
        </div>

        <div class="card-body">

            <form method="POST" action="{{ route('cashier.driver.update', ['id' => $cashierSales->id]) }}">
                @csrf

                <div class="row">

                    <div class="col-md-3 mb-3">
                        <label>Date</label>
                        <input type="text" name="sales_date" value="{{ $cashierSales->sales_date}}"class="form-control" readonly>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Vehicle</label>
                        <input type="text" name = "vehicle" value="{{ $cashierSales->vehicle}}" class="form-control" readonly>
                       
                    </div>

                     <div class="col-md-3">
                        <select name="product_id" id="" class="form-control">
                            <option value="{{$cashierSales->product->id}}">{{ $cashierSales->product->name}}|Stock:{{ $cashierSales->product->stock_quantity }}</option>
                        </select>
                        <input type="number" id="product_amount" value="{{ $cashierSales->product->price}}" class="form-control" placeholder="Enter price" readonly>
                    </div>

                    <div class="col-md-3">
                        <label>No of Bags Sold</label>
                        <input type="number" name="bags_sold" value="{{$cashierSales->bags_sold}}" id="bags_sold" class="form-control" readonly>
                    </div>

                    <div class="col-md-3">
                        <label>Total Amount</label>
                        <input type="number" name="total_amount" value="{{$cashierSales->total_amount}}" id="total_amount" class="form-control" readonly>
                    </div>

                    <div class="col-md-3">
                        <label>Linkages</label>
                        <input type="number" name = "linkages" value="{{$cashierSales->linkages}}" id="linkages" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label>Linkage Amount</label>
                        <input type="number" name = "linkage_amount" value="{{$cashierSales->linkage_amount}}" id="linkage_amount" class="form-control" readonly>
                    </div>

                    <div class="col-md-3">
                        <label>Plus</label>
                        <input type="number" name = "plus" value="{{$cashierSales->plus}}" id="plus" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label>Plus Amount</label>
                        <input type="number" name = "plus_amount" value="{{$cashierSales->plus_amount}}" id="plus_amount" class="form-control" readonly>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Vehicle Fuel</label>
                        <input type="number" step="0.01" name="vehicle_fuel" value="{{$cashierSales->vehicle_fuel}}" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Vehicle Exp</label>
                        <input type="number" step="0.01" name="vehicle_exp"  value="{{$cashierSales->vehicle_exp}}" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Credit</label>
                        <input type="number" step="0.01" name="credit" value="{{$cashierSales->credit}}" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Transfer</label>
                        <input type="number" step="0.01" name="transfer" value="{{$cashierSales->transfer}}" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Paid Credit</label>
                        <input type="number" step="0.01" name="paid_credit" value="{{$cashierSales->paid_credit}}" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Special Exp 1</label>
                        <input type="number" step="0.01" name="special_exp1" value="{{$cashierSales->special_exp1}}" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>Special Exp 2</label>
                        <input type="number" step="0.01" name="special_exp2" value="{{$cashierSales->special_exp2}}" class="form-control">
                    </div>


                </div>

                <button class="btn btn-success">
                    Update Sales
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
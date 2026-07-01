@extends('layouts.cashier')

@section('content')


<table class="table">
    <tr class="Secondary_table">
        <th>VEHICLE</th>
        <th>product</th>
        <th>BAGS SOLD</th>
        <th>TOTAL AMOUNT</th>
        <th>LINKAGES</th>
        <th>LINKAGE AMOUNT</th>
        <th>PLUS</th>
        <th>PLUS AMOUNT</th>
        <th>VEHICLES FUEL</th>
        <th>VEHICLE EXP</th>
        <th>CREDIT</th>
        <th>TRANSFER</th>
        <th>PAID CREDIT</th>
        <th>SPECIAL EXP1</th>
        <th>SPECIAL EXP2</th>
        <th>TOTAL BAL</th>
        <th>GROSS</th>
        <th>DATE</th>
        <th>Action</th>
    </tr>

    @foreach($cashierSales as $cashierSale)

    <tr>
        <td>{{ $cashierSale->vehicle}}</td>
        <td>{{ $cashierSale->product->name ?? 'NuLL' }}</td>
        <td>{{ $cashierSale->bags_sold }}</td>
        <td>{{ $cashierSale->total_amount }}</td>
        <td>{{ $cashierSale->linkages}}</td>
        <td>{{ $cashierSale->linkage_amount}}</td>
        <td>{{ $cashierSale->plus}}</td>
        <td>{{ $cashierSale->plus_amount }}</td>
        <td>{{ $cashierSale->vehicle_fuel }}</td>
        <td>{{ $cashierSale->vehicle_exp}}</td>
        <td>{{ $cashierSale->credit}}</td>
        <td>{{ $cashierSale->transfer }}</td>
        <td>{{ $cashierSale->paid_credit }}</td>
        <td>{{ $cashierSale->special_exp1}}</td>
        <td>{{ $cashierSale->special_exp2}}</td>
        <td>{{ $cashierSale->total_balance}}</td>
        <td>{{ $cashierSale->gross}}</td>
        <td>{{ $cashierSale->sales_date}}</td>
        <td>
            <a href="{{ route('cashier.driver.edit', ['id' => $cashierSale->id]) }}" class="btn btn-sm btn-outline-primary">Edit</a>
        </td>
    </tr>

    @endforeach
</table>

@endsection


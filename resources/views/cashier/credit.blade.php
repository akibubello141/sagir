@extends('layouts.cashier')

@section('content')

<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Credit Sales</h2>

   
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sale ID</th>
                    <th>Customer</th>
                    <th>Total Amount</th>
                    <th>Date</th>
                    <th>Method</th>
                    <th>Action</th>
                </tr>
            </thead>
             @if($creditSales->isEmpty())
            <p>No credit sales found.</p>
            @else
            <tbody>
                @foreach($creditSales as $sale)
                    <tr>
                        <td>{{ $sale->id }}</td>
                        <td>{{ $sale->customer ? $sale->customer->name : 'N/A' }}</td>
                        <td>${{ number_format($sale->items->sum('subtotal'), 2) }}</td>
                        <td>{{ $sale->created_at->format('Y-m-d H:i') }}</td>
                        <form action="{{ route('cashier.credit.updatePaymentMethod', $sale->id) }}" method="post">
                            @csrf
                                <td>
                                <select name="payment_method" required class="form-control">
                                    <option value="cash">Cash</option>
                                    <option value="transfer">Transfer</option>
                                    <option value="pos">POS</option>
                                    <option value="credit" selected>Credit</option>
                                </select></td>
                            <td><button class="btn btn-primary">Pay</button></td>
                        </form>
                        
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
 <h3 class="text-end">
        Total: ₦{{ number_format($total,2) }}
    </h3>

@endsection
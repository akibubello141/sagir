@extends('layouts.cashier')

@section('content')

<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Credit Sales</h2>

   
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-3 px-4 border-b">Sale ID</th>
                    <th class="py-3 px-4 border-b">Customer</th>
                    <th class="py-3 px-4 border-b">Total Amount</th>
                    <th class="py-3 px-4 border-b">Date</th>
                    <th class="py-3 px-4 border-b">Method</th>
                    <th class="py-3 px-4 border-b">Action</th>
                </tr>
            </thead>
             @if($creditSales->isEmpty())
            <p>No credit sales found.</p>
            @else
            <tbody>
                @foreach($creditSales as $sale)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $sale->id }}</td>
                        <td class="py-2 px-4 border-b">{{ $sale->customer ? $sale->customer->name : 'N/A' }}</td>
                        <td class="py-2 px-4 border-b">${{ number_format($sale->total_amount, 2) }}</td>
                        <td class="py-2 px-4 border-b">{{ $sale->created_at->format('Y-m-d H:i') }}</td>
                        <form action="{{ route('cashier.credit.updatePaymentMethod', $sale->id) }}" method="post">
                            @csrf
                                <td class="py-2 px-4 border-b">
                                <select name="payment_method" required class="form-control">
                                    <option value="cash">Cash</option>
                                    <option value="transfer">Transfer</option>
                                    <option value="pos">POS</option>
                                    <option value="credit" selected>Credit</option>
                                </select></td>
                            <td class="py-2 px-4 border-b"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded bn-primary">Pay</button></td>
                        </form>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection
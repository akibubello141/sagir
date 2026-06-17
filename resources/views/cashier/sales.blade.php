@extends('layouts.cashier')

@section('content')

<div class="container-fluid">

<div class="row">

    <!-- PRODUCTS -->
    <div class="col-md-8">

        <h3>Products</h3>

        <div class="row">

            @foreach($products as $product)

            <div class="col-md-4">
                <div class="card p-3 mb-3 shadow-sm">

                    <h5>{{ $product->name }}</h5>

                    <p>₦{{ $product->price }}</p>

                    <p>
                        Stock:
                        <strong>{{ $product->stock_quantity }}</strong>
                    </p>

                    <button
                        class="btn btn-primary addToCart"
                        data-id="{{ $product->id }}"
                        data-name="{{ $product->name }}"
                        data-price="{{ $product->price }}"
                    >
                        Add
                    </button>

                </div>
            </div>

            @endforeach

        </div>

    </div>

    <!-- CART -->
    <div class="col-md-4">

        <div class="card shadow">

            <div class="card-body">

                <h4>Cart</h4>

                <form method="POST" action="/cashier/sales/store">

                    @csrf

                    <div class="mb-2">
                        <label>Customer</label>

                        <select name="customer_id" class="form-control">

                            <option value="">Walk-in Customer</option>

                            @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">
                                {{ $customer->name }}
                            </option>
                            @endforeach

                        </select>
                    </div>

                    <div id="cartItems"></div>

                    <h3 class="mt-3">
                        Total: ₦<span id="grandTotal">0</span>
                    </h3>

                    <input type="hidden" name="total_amount" id="totalInput">

                    <div class="mb-2">
                        <label>Payment Method</label>

                        <select name="payment_method" class="form-control">
                            <option value="cash">Cash</option>
                            <option value="transfer">Transfer</option>
                            <option value="pos">POS</option>
                        </select>
                    </div>

                    <button class="btn btn-success w-100 mt-3">
                        Complete Sale
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

</div>

<script>

let cart = [];
let total = 0;

document.querySelectorAll('.addToCart').forEach(button => {

    button.addEventListener('click', function(){

        let id = this.dataset.id;
        let name = this.dataset.name;
        let price = parseFloat(this.dataset.price);

        cart.push({
            id:id,
            name:name,
            price:price,
            qty:1
        });

        renderCart();
    });

});

function renderCart()
{
    let cartBox = document.getElementById('cartItems');

    cartBox.innerHTML = '';

    total = 0;

    cart.forEach((item,index)=>{

        total += item.price * item.qty;

        cartBox.innerHTML += `
            <div class="border p-2 mb-2">

                <strong>${item.name}</strong>

                <br>

                ₦${item.price}

                <input type="hidden"
                name="products[${index}][id]"
                value="${item.id}">

                <input type="hidden"
                name="products[${index}][price]"
                value="${item.price}">

                Qty:
                <input
                type="number"
                name="products[${index}][qty]"
                value="${item.qty}"
                min="1"
                class="form-control">

            </div>
        `;
    });

    document.getElementById('grandTotal').innerText = total;

    document.getElementById('totalInput').value = total;
}
</script>

@endsection
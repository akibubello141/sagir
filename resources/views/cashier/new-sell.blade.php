<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Sale - POS System</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body{
            background:#f5f6fa;
        }

        .card-box{
            border:none;
            border-radius:15px;
            box-shadow:0 2px 10px rgba(0,0,0,0.1);
        }

        .product-card{
            cursor:pointer;
            transition:0.3s;
        }

        .product-card:hover{
            transform:scale(1.03);
        }

        .product-img{
            height:120px;
            object-fit:cover;
            border-radius:10px;
        }

        .cart-table td{
            vertical-align:middle;
        }

        .total-box{
            background:#0d6efd;
            color:white;
            border-radius:15px;
        }

        @media(max-width:768px){
            .product-img{
                height:90px;
            }
        }
    </style>
</head>
<body>

<div class="container-fluid p-3">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3>
            <i class="bi bi-cart-plus"></i>
            New Sale
        </h3>

        <a href="#" class="btn btn-primary">
            <i class="bi bi-arrow-left"></i>
            Dashboard
        </a>

    </div>

    <div class="row">

        <!-- Products -->
        <div class="col-lg-8">

            <!-- Search -->
            <div class="card card-box p-3 mb-3">

                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-search"></i>
                    </span>

                    <input type="text"
                           class="form-control"
                           placeholder="Search product...">
                </div>

            </div>

            <!-- Product List -->
            <div class="row g-3">

                <!-- Product -->
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card card-box product-card p-2 text-center"
                         onclick="addToCart('Coca Cola', 500)">

                        <img src="https://via.placeholder.com/150"
                             class="img-fluid product-img mb-2">

                        <h6>Coca Cola</h6>
                        <p class="text-primary fw-bold">₦500</p>

                        <button class="btn btn-sm btn-primary w-100">
                            Add
                        </button>

                    </div>
                </div>

                <!-- Product -->
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card card-box product-card p-2 text-center"
                         onclick="addToCart('Fanta', 400)">

                        <img src="https://via.placeholder.com/150"
                             class="img-fluid product-img mb-2">

                        <h6>Fanta</h6>
                        <p class="text-success fw-bold">₦400</p>

                        <button class="btn btn-sm btn-success w-100">
                            Add
                        </button>

                    </div>
                </div>

                <!-- Product -->
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card card-box product-card p-2 text-center"
                         onclick="addToCart('Biscuit', 300)">

                        <img src="https://via.placeholder.com/150"
                             class="img-fluid product-img mb-2">

                        <h6>Biscuit</h6>
                        <p class="text-danger fw-bold">₦300</p>

                        <button class="btn btn-sm btn-danger w-100">
                            Add
                        </button>

                    </div>
                </div>

            </div>

        </div>

        <!-- Cart -->
        <div class="col-lg-4 mt-4 mt-lg-0">

            <div class="card card-box p-3">

                <h5 class="mb-3">
                    <i class="bi bi-cart"></i>
                    Cart
                </h5>

                <div class="table-responsive">

                    <table class="table cart-table">

                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody id="cartBody">

                        </tbody>

                    </table>

                </div>

                <!-- Total -->
                <div class="total-box p-3 mt-3">

                    <div class="d-flex justify-content-between">
                        <h5>Total</h5>
                        <h4 id="totalAmount">₦0</h4>
                    </div>

                </div>

                <!-- Payment -->
                <div class="mt-3">

                    <label class="form-label">Payment Method</label>

                    <select class="form-select">
                        <option>Cash</option>
                        <option>Transfer</option>
                        <option>POS</option>
                    </select>

                </div>

                <!-- Buttons -->
                <div class="d-grid gap-2 mt-4">

                    <button class="btn btn-success btn-lg">
                        <i class="bi bi-check-circle"></i>
                        Complete Sale
                    </button>

                    <button class="btn btn-danger">
                        <i class="bi bi-trash"></i>
                        Clear Cart
                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

    let total = 0;

    function addToCart(name, price){

        let table = document.getElementById('cartBody');

        let row = `
            <tr>
                <td>${name}</td>
                <td>1</td>
                <td>₦${price}</td>
                <td>
                    <button class="btn btn-sm btn-danger">
                        <i class="bi bi-x"></i>
                    </button>
                </td>
            </tr>
        `;

        table.innerHTML += row;

        total += price;

        document.getElementById('totalAmount').innerHTML = '₦' + total;
    }

</script>

</body>
</html>
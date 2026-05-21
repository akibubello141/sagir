<div>
    <!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->
</div>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales History</title>

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

        .top-header{
            background:white;
            padding:15px;
            border-radius:15px;
            box-shadow:0 2px 10px rgba(0,0,0,0.1);
        }

        .badge-paid{
            background:#198754;
        }

        .badge-pending{
            background:#ffc107;
            color:black;
        }

        .table td{
            vertical-align:middle;
        }

        @media(max-width:768px){

            .mobile-hide{
                display:none;
            }

            .table{
                font-size:13px;
            }
        }
    </style>
</head>
<body>

<div class="container-fluid p-3">

    <!-- Header -->
    <div class="top-header d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="m-0">
                <i class="bi bi-clock-history"></i>
                Sales History
            </h4>
        </div>

        <a href="#" class="btn btn-primary">
            <i class="bi bi-arrow-left"></i>
            Dashboard
        </a>

    </div>

    <!-- Summary Cards -->
    <div class="row g-3 mb-4">

        <div class="col-6 col-md-3">
            <div class="card card-box p-3 text-center">
                <i class="bi bi-cash-stack fs-1 text-primary"></i>
                <h5 class="mt-2">₦450,000</h5>
                <small>Total Sales</small>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card card-box p-3 text-center">
                <i class="bi bi-cart-check fs-1 text-success"></i>
                <h5 class="mt-2">120</h5>
                <small>Total Orders</small>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card card-box p-3 text-center">
                <i class="bi bi-calendar-day fs-1 text-warning"></i>
                <h5 class="mt-2">25</h5>
                <small>Today's Orders</small>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card card-box p-3 text-center">
                <i class="bi bi-people fs-1 text-danger"></i>
                <h5 class="mt-2">80</h5>
                <small>Customers</small>
            </div>
        </div>

    </div>

    <!-- Search and Filter -->
    <div class="card card-box p-3 mb-4">

        <div class="row g-2">

            <div class="col-md-4">
                <input type="text"
                       class="form-control"
                       placeholder="Search customer or invoice">
            </div>

            <div class="col-md-3">
                <input type="date"
                       class="form-control">
            </div>

            <div class="col-md-3">
                <select class="form-select">
                    <option>All Status</option>
                    <option>Paid</option>
                    <option>Pending</option>
                </select>
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary w-100">
                    <i class="bi bi-search"></i>
                    Search
                </button>
            </div>

        </div>

    </div>

    <!-- Sales Table -->
    <div class="card card-box p-3">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h5 class="m-0">
                Recent Sales
            </h5>

            <button class="btn btn-success">
                <i class="bi bi-download"></i>
                Export
            </button>

        </div>

        <div class="table-responsive">

            <table class="table table-hover table-bordered align-middle">

                <thead class="table-primary">

                    <tr>
                        <th>#</th>
                        <th>Invoice</th>
                        <th>Customer</th>
                        <th class="mobile-hide">Cashier</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th class="mobile-hide">Date</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody>

                    <tr>
                        <td>1</td>
                        <td>INV-1001</td>
                        <td>John Doe</td>
                        <td class="mobile-hide">Aliyu</td>
                        <td>₦15,000</td>
                        <td>
                            <span class="badge badge-paid">
                                Paid
                            </span>
                        </td>
                        <td class="mobile-hide">21 May 2026</td>
                        <td>
                            <button class="btn btn-sm btn-primary">
                                <i class="bi bi-eye"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>INV-1002</td>
                        <td>Amina Musa</td>
                        <td class="mobile-hide">Bello</td>
                        <td>₦8,500</td>
                        <td>
                            <span class="badge badge-pending">
                                Pending
                            </span>
                        </td>
                        <td class="mobile-hide">21 May 2026</td>
                        <td>
                            <button class="btn btn-sm btn-primary">
                                <i class="bi bi-eye"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>3</td>
                        <td>INV-1003</td>
                        <td>David</td>
                        <td class="mobile-hide">Usman</td>
                        <td>₦20,000</td>
                        <td>
                            <span class="badge badge-paid">
                                Paid
                            </span>
                        </td>
                        <td class="mobile-hide">20 May 2026</td>
                        <td>
                            <button class="btn btn-sm btn-primary">
                                <i class="bi bi-eye"></i>
                            </button>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-end mt-3">

            <nav>
                <ul class="pagination">

                    <li class="page-item disabled">
                        <a class="page-link">Previous</a>
                    </li>

                    <li class="page-item active">
                        <a class="page-link">1</a>
                    </li>

                    <li class="page-item">
                        <a class="page-link">2</a>
                    </li>

                    <li class="page-item">
                        <a class="page-link">Next</a>
                    </li>

                </ul>
            </nav>

        </div>

    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body{
            background:#f5f6fa;
        }

        .receipt-card{
            max-width:500px;
            margin:auto;
            border:none;
            border-radius:20px;
            box-shadow:0 2px 15px rgba(0,0,0,0.1);
        }

        .receipt-header{
            background:#0d6efd;
            color:white;
            border-radius:20px 20px 0 0;
            padding:20px;
            text-align:center;
        }

        .receipt-body{
            padding:20px;
        }

        .receipt-footer{
            text-align:center;
            padding:15px;
            font-size:14px;
            color:#666;
        }

        .table td{
            vertical-align:middle;
        }

        .total-box{
            background:#f1f3f5;
            padding:15px;
            border-radius:10px;
        }

        @media print{

            .no-print{
                display:none;
            }

            body{
                background:white;
            }

            .receipt-card{
                box-shadow:none;
            }
        }
    </style>
</head>
<body>

<div class="container py-4">

    <div class="card receipt-card">

        <!-- Header -->
        <div class="receipt-header">

            <h3>
                <i class="bi bi-receipt"></i>
                SAGIR INTERPRESS NIGERIA LTD
            </h3>

            <p class="mb-0">
                POS SALES RECEIPT
            </p>

        </div>

        <!-- Body -->
        <div class="receipt-body">

            <!-- Company Info -->
            <div class="text-center mb-4">

                <small>
                    No. 6 Birnin Kebbi Road, Sokoto <br>
                    Phone: 08162463010
                </small>

            </div>

            <!-- Receipt Details -->
            <div class="row mb-3">

                <div class="col-6">
                    <strong>Invoice:</strong><br>
                    INV-1001
                </div>

                <div class="col-6 text-end">
                    <strong>Date:</strong><br>
                    21 May 2026
                </div>

            </div>

            <div class="mb-3">
                <strong>Cashier:</strong> Aliyu
            </div>

            <div class="mb-4">
                <strong>Customer:</strong> John Doe
            </div>

            <!-- Items Table -->
            <div class="table-responsive">

                <table class="table table-bordered">

                    <thead class="table-primary">

                        <tr>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>

                    </thead>

                    <tbody>

                        <tr>
                            <td>Coca Cola</td>
                            <td>2</td>
                            <td>₦500</td>
                            <td>₦1,000</td>
                        </tr>

                        <tr>
                            <td>Biscuit</td>
                            <td>3</td>
                            <td>₦300</td>
                            <td>₦900</td>
                        </tr>

                        <tr>
                            <td>Fanta</td>
                            <td>1</td>
                            <td>₦400</td>
                            <td>₦400</td>
                        </tr>

                    </tbody>

                </table>

            </div>

            <!-- Total -->
            <div class="total-box mt-4">

                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal:</span>
                    <strong>₦2,300</strong>
                </div>

                <div class="d-flex justify-content-between mb-2">
                    <span>Discount:</span>
                    <strong>₦0</strong>
                </div>

                <div class="d-flex justify-content-between mb-2">
                    <span>VAT:</span>
                    <strong>₦0</strong>
                </div>

                <hr>

                <div class="d-flex justify-content-between">
                    <h5>Total:</h5>
                    <h4 class="text-primary">
                        ₦2,300
                    </h4>
                </div>

            </div>

            <!-- Payment -->
            <div class="mt-4">

                <div class="d-flex justify-content-between">
                    <span>Payment Method:</span>
                    <strong>Cash</strong>
                </div>

                <div class="d-flex justify-content-between">
                    <span>Status:</span>
                    <span class="badge bg-success">
                        Paid
                    </span>
                </div>

            </div>

            <!-- Buttons -->
            <div class="d-grid gap-2 mt-4 no-print">

                <button onclick="window.print()"
                        class="btn btn-primary btn-lg">

                    <i class="bi bi-printer"></i>
                    Print Receipt

                </button>

                <button class="btn btn-success">

                    <i class="bi bi-download"></i>
                    Download PDF

                </button>

                <a href="#"
                   class="btn btn-secondary">

                    <i class="bi bi-arrow-left"></i>
                    Back

                </a>

            </div>

        </div>

        <!-- Footer -->
        <div class="receipt-footer">

            Thank you for your purchase <br>
            Powered by Sagir Interpress Nigeria Ltd

        </div>

    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
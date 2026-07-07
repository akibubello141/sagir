@extends('layouts.manager')

@section('content')

<div class="container-fluid">

    <h2 class="mb-4">Manager Monthly Sales</h2>

    <div class="row">

        <div class="col-md-3 p-2">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Bags Sold</h5>
                    <h2>@foreach($monthlyBagsSold as $sold)
                            <p>
                                {{ $sold->month_name }} :
                                NO.{{ number_format($sold->total, 1) }}
                            </p>
                        @endforeach
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 p-2">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5>Total Amount</h5>
                    <h2>@foreach($monthlyAmount as $amount)
                            <p>
                                {{ $amount->month_name }} :
                                ₦{{ number_format($amount->total, 2) }}
                            </p>
                        @endforeach
                    </h2>
                </div>
            </div>
        </div>

         <div class="col-md-3 p-2">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Total Linkages</h5>
                    <h2>@foreach($monthlyLinkages as $linkage)
                            <p>
                                {{ $linkage->month_name }} :
                                ₦{{ number_format($linkage->total, 2) }}
                            </p>
                        @endforeach
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 p-2">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5>Total Linkage Amount</h5>
                    <h2>@foreach($monthlyLinkageAmounts as $linkageAmount)
                            <p>
                                {{ $linkageAmount->month_name }} :
                                ₦{{ number_format($linkageAmount->total, 2) }}
                            </p>
                        @endforeach
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 p-2">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Total Plus</h5>
                    <h2>@foreach($monthlyPlus as $plus)
                            <p>
                                {{ $plus->month_name }} :
                                ₦{{ number_format($plus->total, 2) }}
                            </p>
                        @endforeach
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 p-2">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5>Total Plus Amount</h5>
                    <h2>@foreach($monthlyPlusAmount as $plusAmount)
                            <p>
                                {{ $plusAmount->month_name }} :
                                ₦{{ number_format($plusAmount->total, 2) }}
                            </p>
                        @endforeach
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 p-2">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5>Total Vehicle Amount</h5>
                    <h2>@foreach($monthlyFuel as $fuel)
                            <p>
                                {{ $fuel->month_name }} :
                                ₦{{ number_format($fuel->total, 2) }}
                            </p>
                        @endforeach
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 p-2">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5>Total Vehicle Exp</h5>
                    <h2>@foreach($monthlyVehicleExp as $vExp)
                            <p>
                                {{ $vExp->month_name }} :
                                ₦{{ number_format($vExp->total, 2) }}
                            </p>
                        @endforeach
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 p-2">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5>Total Credit</h5>
                    <h2>@foreach($monthlyCredit as $credit)
                            <p>
                                {{ $credit->month_name }} :
                                ₦{{ number_format($credit->total, 2) }}
                            </p>
                        @endforeach
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 p-2">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Total Transfer</h5>
                    <h2>@foreach($monthlyTransfer as $transfer)
                            <p>
                                {{ $transfer->month_name }} :
                                ₦{{ number_format($transfer->total, 2) }}
                            </p>
                        @endforeach
                    </h2>
                </div>
            </div>
        </div>

         <div class="col-md-3 p-2">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Total Paid Credit</h5>
                    <h2>@foreach($monthlyPaidCredit as $PaidCredit)
                            <p>
                                {{ $PaidCredit->month_name }} :
                                ₦{{ number_format($PaidCredit->total, 2) }}
                            </p>
                        @endforeach
                    </h2>
                </div>
            </div>
        </div>

         <div class="col-md-3 p-2">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5>Total Special Exp1</h5>
                    <h2>@foreach($monthlySpecialExp1 as $specialExp1)
                            <p>
                                {{ $specialExp1->month_name }} :
                                ₦{{ number_format($specialExp1->total, 2) }}
                            </p>
                        @endforeach
                    </h2>
                </div>
            </div>
        </div>

         <div class="col-md-3 p-2">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5>Total Special Exp2</h5>
                    <h2>@foreach($monthlySpecialExp2 as $specialExp2)
                            <p>
                                {{ $specialExp2->month_name }} :
                                ₦{{ number_format($specialExp2->total, 2) }}
                            </p>
                        @endforeach
                    </h2>
                </div>
            </div>
        </div>

         <div class="col-md-3 p-2">
            <div class="card bg-dark text-white">
                <div class="card-body">
                    <h5>Total Balance</h5>
                    <h2>@foreach($monthlyTotalBalance as $totalBalance)
                            <p>
                                {{ $totalBalance->month_name }} :
                                ₦{{ number_format($totalBalance->total, 2) }}
                            </p>
                        @endforeach
                    </h2>
                </div>
            </div>
        </div>

         <div class="col-md-3 p-2">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Total Gross</h5>
                    <h2>@foreach($monthlyGross as $gross)
                            <p>
                                {{ $gross->month_name }} :
                                ₦{{ number_format($gross->total, 2) }}
                            </p>
                        @endforeach
                    </h2>
                </div>
            </div>
        </div>


    <div class="row mt-4">

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5>Staffs</h5>
                    <h2>{{ $staffs }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5>Best Selling Vehicle</h5>
                    <h2>@foreach($bestBuyingCustomers as $item)
                            {{ $item->customer?->name }}
                            {{ $item->total_bags_sold }}<br />
                        @endforeach</h2>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5>Production Total</h5>
                    <h2>{{ $production }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5>Best Selling Product</h5>
                    <h2>@foreach($bestSelling as $item)
                            {{ $item->product?->name }}
                            {{ $item->total_bags_sold }}<br />
                        @endforeach</h2>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
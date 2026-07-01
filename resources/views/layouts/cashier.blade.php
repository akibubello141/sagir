@extends('layouts.app')

@section('title')

CASHIER
@endsection

@section('sidebar')
   
<nav class="navbar navbar-expand-lg navbar-white bg-white">
    <div class="container-fluid">

        <a class="navbar-brand p-2" href="#">
            <img src="{{ asset('images/logo.jpeg') }}"
                 width="80"
                 height="50"
                 alt="Logo">
                 <span class="p-2">@yield('title')</span>
           
        </a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav me-auto">
                

                <li class="nav-item">
                    <a class="nav-link" href="/cashier/dashboard">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/cashier/sales">
                        New Sale
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cashier.driver.credit') }}">
                        Credit Sales
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cashier.driver.index') }}">
                        Daily Sales
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cashier.customer.index') }}">
                        Drivers
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cashier.production.index') }}">
                        Productions
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('cashier.driver.report')}}">
                        Reports
                    </a>
                </li>

            </ul>

            <ul class="navbar-nav">
                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle"
                       href="#"
                       data-bs-toggle="dropdown">

                        {{ Auth::user()->name }}
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">

                        <li>
                             <a href="/logout" class="dropdown-item">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </a>
                        </li>
                        

                    </ul>

                </li>
            </ul>

        </div>

    </div>
</nav>
@endsection
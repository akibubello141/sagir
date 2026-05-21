<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sagir Interpress Login</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            background:#f5f7fb;
            font-family:Arial, sans-serif;
        }

        .main-container{
            min-height:100vh;
        }

        /* LEFT PANEL */

        .left-panel{
            background:linear-gradient(180deg,#003f88,#0056b3);
            color:white;
            padding:40px 30px;
            position:relative;
            overflow:hidden;
        }

        .left-panel::before{
            content:'';
            position:absolute;
            width:350px;
            height:350px;
            background:rgba(255,255,255,0.08);
            border-radius:50%;
            top:-100px;
            right:-120px;
        }

        .left-panel::after{
            content:'';
            position:absolute;
            width:300px;
            height:300px;
            background:#ffd60a;
            border-radius:50%;
            bottom:-150px;
            left:-100px;
            opacity:0.2;
        }

        .logo{
            width:180px;
            background:white;
            padding:10px;
            border-radius:20px;
            display:block;
            margin:auto;
            position:relative;
            z-index:2;
        }

        .company-title{
            text-align:center;
            margin-top:30px;
            font-weight:bold;
            font-size:35px;
            position:relative;
            z-index:2;
        }

        .company-text{
            text-align:center;
            font-size:18px;
            margin-top:15px;
            opacity:0.9;
            line-height:1.8;
            position:relative;
            z-index:2;
        }

        .product-section{
            margin-top:40px;
            position:relative;
            z-index:2;
        }

        .product-card{
            background:rgba(255,255,255,0.1);
            border-radius:20px;
            padding:20px;
            text-align:center;
            margin-bottom:20px;
            transition:0.3s;
        }

        .product-card:hover{
            background:rgba(255,255,255,0.2);
            transform:translateY(-5px);
        }

        .product-icon{
            font-size:40px;
            margin-bottom:10px;
        }

        /* RIGHT PANEL */

        .right-panel{
            display:flex;
            justify-content:center;
            align-items:center;
            padding:30px 20px;
        }

        .login-card{
            width:100%;
            max-width:450px;
            background:white;
            border-radius:25px;
            padding:35px 25px;
            box-shadow:0 10px 30px rgba(0,0,0,0.08);
        }

        .login-title{
            font-size:35px;
            color:#003f88;
            font-weight:bold;
        }

        .login-subtitle{
            color:#777;
            margin-bottom:30px;
        }

        .form-control{
            height:55px;
            border-radius:12px;
        }

        .input-group-text{
            border-radius:12px 0 0 12px;
            background:white;
        }

        .btn-login{
            height:55px;
            border-radius:12px;
            background:#0056b3;
            border:none;
            font-size:18px;
            font-weight:bold;
        }

        .btn-login:hover{
            background:#003f88;
        }

        .footer-text{
            margin-top:25px;
            color:#888;
            text-align:center;
        }

        /* MOBILE DESIGN */

        @media(max-width:991px){

            .left-panel{
                padding:30px 20px;
            }

            .company-title{
                font-size:28px;
            }

            .company-text{
                font-size:16px;
            }

            .logo{
                width:150px;
            }

            .login-card{
                margin-top:-30px;
                border-radius:25px 25px 0 0;
            }

        }

        @media(max-width:576px){

            .company-title{
                font-size:24px;
            }

            .company-text{
                font-size:15px;
            }

            .login-title{
                font-size:28px;
            }

            .login-card{
                padding:30px 20px;
            }

        }

    </style>

</head>
<body>

<div class="container-fluid">

    <div class="row main-container">

        <!-- LEFT PANEL -->
        <div class="col-lg-6 left-panel d-flex flex-column justify-content-center">

            <!-- LOGO -->
            <img src="{{ asset('images/logo.jpeg') }}" class="logo" alt="Logo">

            <!-- TITLE -->
            <h1 class="company-title">
                Sagir Interpress Nigeria Ltd
            </h1>

            <!-- TEXT -->
            <p class="company-text">
                Production & Sales Management System
                for Pure Water, Bottle Water & Yoghurt
            </p>

            <!-- PRODUCTS -->
            <div class="row product-section">

                <div class="col-4">
                    <div class="product-card">
                        <i class="bi bi-droplet-fill product-icon"></i>
                        <h6>Pure Water</h6>
                    </div>
                </div>

                <div class="col-4">
                    <div class="product-card">
                        <i class="bi bi-cup-straw product-icon"></i>
                        <h6>Bottle Water</h6>
                    </div>
                </div>

                <div class="col-4">
                    <div class="product-card">
                        <i class="bi bi-bucket-fill product-icon"></i>
                        <h6>Yoghurt</h6>
                    </div>
                </div>

            </div>

        </div>

        <!-- RIGHT PANEL -->
        <div class="col-lg-6 right-panel">

            <div class="login-card">

                <div class="text-center">

                    <h1 class="login-title">
                        Welcome Back
                    </h1>

                    <p class="login-subtitle">
                        Login to continue
                    </p>

                </div>

                <!-- FORM -->
                <form action="{{ route('login') }}" method="POST">

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- EMAIL -->
                    <div class="mb-4">

                        <label class="form-label fw-bold">
                            Email Address
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-envelope"></i>
                            </span>

                            @csrf
                            <input 
                                type="email"
                                class="form-control"
                                placeholder="Enter email"
                                name="email"
                                value="{{ old('email') }}"
                            >

                        </div>

                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-4">

                        <label class="form-label fw-bold">
                            Password
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="bi bi-lock"></i>
                            </span>

                            @csrf
                            <input 
                                type="password"
                                class="form-control"
                                placeholder="Enter password"
                                name="password"
                                value="{{ old('password') }}"
                            >

                        </div>

                    </div>

                    <!-- REMEMBER -->
                    <div class="d-flex justify-content-between mb-4">

                        <div class="form-check">

                            <input 
                                type="checkbox"
                                class="form-check-input"
                                id="remember"
                            >

                            <label 
                                class="form-check-label"
                                for="remember"
                            >
                                Remember Me
                            </label>

                        </div>

                        <a href="#" class="text-decoration-none">
                            Forgot Password?
                        </a>

                    </div>

                    <!-- BUTTON -->
                    <button class="btn btn-primary w-100 btn-login">

                        <i class="bi bi-box-arrow-in-right"></i>
                        Login

                    </button>

                </form>

                <!-- FOOTER -->
                <div class="footer-text">

                    © 2026 Sagir Interpress Nigeria Ltd

                </div>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
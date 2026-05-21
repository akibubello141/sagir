<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body{
            background:#f5f6fa;
        }

        .sidebar{
            min-height:100vh;
            background:#0056b3;
            color:white;
        }

        .sidebar a{
            color:white;
            text-decoration:none;
            display:block;
            padding:12px;
            border-radius:8px;
            margin-bottom:5px;
        }

        .sidebar a:hover{
            background:rgba(255,255,255,0.2);
        }

        .card-box{
            border:none;
            border-radius:15px;
            box-shadow:0 2px 10px rgba(0,0,0,0.1);
        }

        .topbar{
            background:white;
            padding:15px;
            border-radius:15px;
            box-shadow:0 2px 10px rgba(0,0,0,0.1);
        }

        .mobile-menu{
            display:none;
        }

        @media(max-width:768px){

            .sidebar{
                position:fixed;
                width:250px;
                left:-260px;
                top:0;
                z-index:1000;
                transition:0.3s;
                background-color:#0056b3;
            }

            .sidebar.show{
                left:0;
            }

            .mobile-menu{
                display:block;
            }

            .content{
                width:100%;
            }
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        @yield('sidebar')

        <!-- Content -->
        <div class="col-md-10 p-3 content">
            <!-- Topbar -->
            <div class="topbar d-flex justify-content-between align-items-center mb-4">

                <button class="btn btn-primary mobile-menu" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </button>

                <h4 class="m-0">@yield('title')</h4>

                <div>
                    <span class="fw-bold">Welcome, {{ auth()->user()->name }}</span>
                    </span>
                </div>

            </div>
        
        @yield('content')

        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function toggleSidebar(){
        document.getElementById('sidebar').classList.toggle('show');
    }
</script>

</body>
</html>
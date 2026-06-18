<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Bootstrap -->
    
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


<script>
    function toggleSidebar(){
        document.getElementById('sidebar').classList.toggle('show');
    }
</script>

</body>
</html>
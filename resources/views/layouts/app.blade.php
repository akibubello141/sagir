<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('images/logo.jpeg') }}" /> 
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Bootstrap -->

    
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <!--  -->
        @yield('sidebar')              
        
        @yield('content')
    </div>
</div>


<script>
    function toggleSidebar(){
        document.getElementById('sidebar').classList.toggle('show');
    }
</script>

</body>
</html>
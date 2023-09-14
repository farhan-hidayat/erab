<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title')</title>
    <link href="/assets/logo.png" rel="icon">

    <!-- General CSS Files -->
    @include('includes.header')
    <!-- CSS Libraries -->
    @stack('prepend-style')
    <!-- Template CSS -->
    @include('includes.style')
    @stack('addon-style')
</head>

<body>
    @include('sweetalert::alert')
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            @include('includes.navbar')
            <div class="main-sidebar sidebar-style-2">
                @include('includes.sidebar')
            </div>

            <!-- Main Content -->
            @yield('content')
            @include('includes.footer')
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="/assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    @stack('prepend-script')
    <!-- Template JS File -->
    @include('includes.script')
    <!-- Page Specific JS File -->
    @stack('addon-script')
</body>

</html>

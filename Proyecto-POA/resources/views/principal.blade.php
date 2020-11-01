<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>UPV | POA</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS compialdos -->
    <link rel="stylesheet" href="css/plantilla.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        /* .main-header { background-color: #6C757D !important } */
        .main-sidebar { background-color: #242424 !important }
        /* .main-footer { background-color: #6C757D !important } */
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- app vue js -->
        <div id="app">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                    <strong class="navbar">BIENVENIDO</strong>
                </ul>
                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    @if (Auth::guest())
                        <div class="navbar info">
                            <a class="d-block">
                            <i class="fas fa-cog fa-lg"></i>
                                Sin Sesión
                            </a>
                        </div>
                    @else
                        <div class="navbar info">
                            <a class="d-block">
                            <i class="fas fa-cog fa-spin fa-lg"></i>
                            {{ Auth::user()->alias }}
                            </a>
                        </div>
                    @endif
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-secondary elevation-4">
                <!-- Brand Logo -->
                <a href="#" class="brand-link">
                <img src="img/upvlogo1.png" alt="UPV Logo" class="brand-image img-circle elevation-2"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">UPV POA</span>
                </a>
                
                <!-- Sidebar -->
                @include('plantilla.sidebar')
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
            @yield('contenido')
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- ./app vue js -->
        
        <footer class="main-footer">
            <strong>Universidad Politécnica de Victoria | <a href="http://www.upvictoria.edu.mx/">www.upvictoria.edu.mx</a> |
                2020</strong>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- JS compilados -->
    <script src="js/app.js"></script>
    <script src="js/plantilla.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
</body>

</html>
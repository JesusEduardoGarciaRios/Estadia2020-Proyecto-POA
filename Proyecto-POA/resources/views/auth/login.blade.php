<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="css/plantilla.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="/main"><b>UPV</b>POA</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Ingresa para empezar tu sesión</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input placeholder="Email@upv.edu.mx" id="email" type="email" pattern=".+@upv.edu.mx" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="input-group mb-3">
                        <input placeholder="Usuario" id="usuario" type="usuario" class="form-control" name="usuario" value="{{ old('usuarios') }}" required autocomplete="usuario" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div> -->
                    <div class="input-group mb-3">
                        <input placeholder="Contraseña" id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <small>
                            <strong>Una o ambas credenciales no coinciden con nuestros registros.</strong>
                        </small>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-dark btn-block">Ingresar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <!-- <hr> -->
                <!-- <div class="row"> 
                    <p>¿No tienes una cuenta?</p>&nbsp;
                    <a href="" class="text-center">Regístrate.</a>
                </div> -->
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="js/plantilla.js"></script>
</body>

</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Informasi Keanggotan GYM</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('cssadmin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('cssadmin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('cssadmin/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page" style="background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(0,126,70,1) 35%, rgba(0,212,255,1) 100%);">
    <div class="login-box">
        
        <div class="login-logo">
            <small>Tiger GYM</small><br />
            <a href="#" style="color: white">Sistem Keanggotan</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">silahkan login ke sistem</p>

                @if (session('pesaninfo'))
                    <div class="row">
                        <div class="col-md-12">
                            {!! session('pesaninfo') !!}
                        </div>
                    </div>
                @endif

                <form enctype="multipart/form-data" method="post" action='{{ url("admin/auth/actlogin") }}'>
                
                    @csrf

                    <div class="input-group mb-3">
                        <input type="text" name="useradmin" class="form-control" placeholder="Masukkan username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" name="password" class="form-control" placeholder="Masukkan password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Log In</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('cssadmin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('cssadmin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('cssadmin/dist/js/adminlte.min.js') }}"></script>
</body>

</html>

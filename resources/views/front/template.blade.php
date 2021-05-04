<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>E-Commerce Pasar Ikan Pengambengan</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('cssfront/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- Lightbox-->
    <link rel="stylesheet" href="{{ asset('cssfront/vendor/lightbox2/css/lightbox.min.css') }}">
    <!-- Range slider-->
    <link rel="stylesheet" href="{{ asset('cssfront/vendor/nouislider/nouislider.min.css') }}">
    <!-- Bootstrap select-->
    <link rel="stylesheet" href="{{ asset('cssfront/vendor/bootstrap-select/css/bootstrap-select.min.css') }}">
    <!-- Owl Carousel-->
    <link rel="stylesheet" href="{{ asset('cssfront/vendor/owl.carousel2/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cssfront/vendor/owl.carousel2/assets/owl.theme.default.css') }}">
    <!-- Google fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;400;700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@300;400;800&amp;display=swap">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ asset('cssfront/css/style.default.css') }}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ asset('cssfront/css/custom.css') }}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('cssfront/img/favicon.png') }}">

    @stack('stylecss')

    <style>
        .readonly
        {
            pointer-events: none;
        }
    </style>
</head>

<body>

    <div class="page-holder">
        <header class="header bg-white">
            <div class="container px-0 px-lg-3">
                <nav class="navbar navbar-expand-lg navbar-light py-3 px-lg-0"><a class="navbar-brand" href="index.html"><span class="font-weight-bold text-uppercase text-dark">Pengambengan Market</span></a>
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item"><a class="nav-link active" href="{{ url('/') }}">Home</a></li>
                            <li class="nav-item"><a class="nav-link active" href="{{ url('/nelayan') }}">Nelayan</a></li>
                            <li class="nav-item"><a class="nav-link active" href="{{ url('/item') }}">Item</a></li>
                            @if(session('userpelanggan') == '')
                                <li class="nav-item"><a class="nav-link active" href="{{ url('/auth/registrasi') }}">Registrasi</a></li>
                            @else
                                <li class="nav-item"><a class="nav-link active" href="{{ url('/auth/profile') }}">Profile</a></li>
                                <li class="nav-item"><a class="nav-link active" href="{{ url('/transaksi') }}">Transaksi</a></li>
                            @endif
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            @if(session('userpelanggan') == '')
                                <li class="nav-item"><a class="nav-link" href="{{ url('/auth/login') }}"> <i class="fas fa-user-alt mr-1 text-gray"></i>Login</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ url('/auth/registrasi') }}"> <i class="fas fa-user-plus mr-1 text-gray"></i>Registrasi</a></li>
                            @else
                                <li class="nav-item"><a class="nav-link" href="{{ url('/cart') }}"> <i class="fas fa-dolly-flatbed mr-1 text-gray"></i>Cart ({{ App\Lib\Csql::getTotalItemInCart() }})</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ url('/auth/actlogout') }}"> <i class="fas fa-sign-out mr-1 text-gray"></i>Log Out</a></li>
                            @endif
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
    </div>

    @yield('content')


    <footer class="bg-dark text-white mt-3">
        <div class="container py-4">
            <div class="border-top pt-4" style="border-color: #1d1d1d !important">
                <div class="row">
                    <div class="col-lg-6">
                        <p class="small text-muted mb-0">&copy; {{ date('Y') }} Sistem oleh Rusli.</p>
                    </div>
                    <div class="col-lg-6 text-lg-right">
                        <p class="small text-muted mb-0">Template designed by <a class="text-white reset-anchor" href="https://bootstraptemple.com/p/bootstrap-ecommerce">Bootstrap Temple</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- javascript -->
    <script src="{{ asset('cssfront/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('cssfront/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('cssfront/vendor/lightbox2/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('cssfront/vendor/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('cssfront/vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('cssfront/vendor/owl.carousel2/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('cssfront/vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js') }}"></script>
    <script src="{{ asset('cssfront/js/front.js') }}"></script>

    <!-- Date Picker -->
    <link href="{{ asset('cssadmin/plugins/datepicker/jquery.datetimepicker.css') }}" rel="stylesheet">
    <script src="{{ asset('cssadmin/plugins/datepicker/jquery.datetimepicker.full.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        // ------------------------------------------------------- //
        //   Inject SVG Sprite - 
        //   see more here 
        //   https://css-tricks.com/ajaxing-svg-sprite/
        // ------------------------------------------------------ //
        function injectSvgSprite(path) {
        
            var ajax = new XMLHttpRequest();
            ajax.open("GET", path, true);
            ajax.send();
            ajax.onload = function(e) {
                var div = document.createElement("div");
                div.className = 'd-none';
                div.innerHTML = ajax.responseText;
                document.body.insertBefore(div, document.body.childNodes[0]);
            }
        }
        // this is set to BootstrapTemple website as you cannot 
        // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
        // while using file:// protocol
        // pls don't forget to change to your domain :)
        injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg'); 
        
      </script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    @stack('scripts')

</body>

</html>

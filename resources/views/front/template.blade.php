<!DOCTYPE HTML>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tiger GYM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Website Template by freehtml5.co" />
    <meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
    <meta name="author" content="freehtml5.co" />

    <!-- 
    //////////////////////////////////////////////////////

    FREE HTML5 TEMPLATE 
    DESIGNED & DEVELOPED by FreeHTML5.co
        
    Website:        http://freehtml5.co/
    Email:          info@freehtml5.co
    Twitter:        http://twitter.com/fh5co
    Facebook:       https://www.facebook.com/fh5co

    //////////////////////////////////////////////////////
     -->

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <meta property="og:description" content=""/>
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,700,800" rel="stylesheet">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="{{ asset('cssfront/css/animate.css') }}">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="{{ asset('cssfront/css/icomoon.css') }}">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="{{ asset('cssfront/css/bootstrap.css') }}">

    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('cssfront/css/magnific-popup.css') }}">

    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="{{ asset('cssfront/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cssfront/css/owl.theme.default.min.css') }}">

    <!-- Theme style  -->
    <link rel="stylesheet" href="{{ asset('cssfront/css/style.css') }}">

    <!-- Font  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    @stack('stylecss')

    <!-- Modernizr JS -->
    <script src="{{ asset('cssfront/js/modernizr-2.6.2.min.js') }}"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="js/respond.min.js"></script>
    <![endif]-->

    </head>
    <body>
        
    <div class="fh5co-loader"></div>
    
    <div id="page">
        <nav class="fh5co-nav" role="navigation">
            <div class="top">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 text-right">
                            <p class="num">Call: +01 123 456 7890</p>
                            <ul class="fh5co-social">
                                @if(empty(session('kodeanggota')))
                                    <li><a href='{{ url("auth/login") }}' style="color: white;">Login</a></li>
                                    <li><a href='{{ url("auth/registrasi") }}' style="color: white;">Registrasi</a></li>
                                @else
                                    <li><a href='{{ url("auth/profile") }}' style="color: white;">({{ session('useranggota') }}) Profile</a></li>
                                    <li><a href='{{ url("auth/logout") }}' style="color: white;">Log Out</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="top-menu">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-2">
                            <div id="fh5co-logo"><a href="index.html">TIGER GYM<span>.</span></a></div>
                        </div>
                        <div class="col-xs-10 text-right menu-1">
                            <ul>
                                <li><a href='{{ url("dashboard") }}'>Home</a></li>
                                <li><a href='{{ url("alatgym/list") }}'>Alat Gym</a></li>
                                <li><a href='{{ url("informasi/list") }}'>Informasi</a></li>

                                @if(empty(session('kodeanggota')))
                                    <li><a href='{{ url("auth/registrasi") }}'>Registrasi</a></li>
                                    <li><a href='{{ url("auth/login") }}'>Login</a></li>
                                @else
                                    <li><a href='{{ url("auth/kartuanggota") }}'>Kartu Anggota</a></li>
                                    <li><a href='{{ url("pembayaran/list") }}'>Pembayaran</a></li>
                                    <li><a href='{{ url("kunjungan/list") }}'>Kunjungan</a></li>
                                    
                                @endif

                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>
        </nav>

        @yield('content')

    <!-- <footer id="fh5co-footer" class="fh5co-bg" style="background-image: url(images/img_bg_1.jpg);" role="contentinfo">
        <div class="overlay"></div>
        <div class="container">
            <div class="row row-pb-md">
                <div class="col-md-4 fh5co-widget">
                    <h3>A Little About Stamina.</h3>
                    <p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
                    <p><a class="btn btn-primary" href="#">Become A Member</a></p>
                </div>
                <div class="col-md-8">
                    <h3>Classes</h3>
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <ul class="fh5co-footer-links">
                            <li><a href="#">Cardio</a></li>
                            <li><a href="#">Body Building</a></li>
                            <li><a href="#">Yoga</a></li>
                            <li><a href="#">Boxing</a></li>
                            <li><a href="#">Running</a></li>
                        </ul>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <ul class="fh5co-footer-links">
                            <li><a href="#">Boxing</a></li>
                            <li><a href="#">Martial Arts</a></li>
                            <li><a href="#">Karate</a></li>
                            <li><a href="#">Kungfu</a></li>
                            <li><a href="#">Basketball</a></li>
                        </ul>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <ul class="fh5co-footer-links">
                            <li><a href="#">Badminton</a></li>
                            <li><a href="#">Body Building</a></li>
                            <li><a href="#">Teams</a></li>
                            <li><a href="#">Advertise</a></li>
                            <li><a href="#">API</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row copyright">
                <div class="col-md-12 text-center">
                    <p>
                        <small class="block">&copy; 2016 Free HTML5. All Rights Reserved.</small> 
                        <small class="block">Designed by <a href="http://freehtml5.co/" target="_blank">FreeHTML5.co</a> Demo Images: <a href="http://unsplash.co/" target="_blank">Unsplash</a></small>
                    </p>
                    <p>
                        <ul class="fh5co-social-icons">
                            <li><a href="#"><i class="icon-twitter"></i></a></li>
                            <li><a href="#"><i class="icon-facebook"></i></a></li>
                            <li><a href="#"><i class="icon-linkedin"></i></a></li>
                            <li><a href="#"><i class="icon-dribbble"></i></a></li>
                        </ul>
                    </p>
                </div>
            </div>

        </div>
    </footer> -->
    </div>

    <div class="gototop js-top">
        <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- jQuery -->
    <script src="{{ asset('cssfront/js/jquery.min.js') }}"></script>
    <!-- jQuery Easing -->
    <script src="{{ asset('cssfront/js/jquery.easing.1.3.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('cssfront/js/bootstrap.min.js') }}"></script>
    <!-- Waypoints -->
    <script src="{{ asset('cssfront/js/jquery.waypoints.min.js') }}"></script>
    <!-- Stellar Parallax -->
    <script src="{{ asset('cssfront/js/jquery.stellar.min.js') }}"></script>
    <!-- Carousel -->
    <script src="{{ asset('cssfront/js/owl.carousel.min.js') }}"></script>
    <!-- countTo -->
    <script src="{{ asset('cssfront/js/jquery.countTo.js') }}"></script>
    <!-- Magnific Popup -->
    <script src="{{ asset('cssfront/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('cssfront/js/magnific-popup-options.js') }}"></script>
    <!-- Main -->
    <script src="{{ asset('cssfront/js/main.js') }}"></script>

    <!-- Date Picker -->
    <link href="{{ asset('cssadmin/plugins/datepicker/jquery.datetimepicker.css') }}" rel="stylesheet">
    <script src="{{ asset('cssadmin/plugins/datepicker/jquery.datetimepicker.full.js') }}"></script>
    
    @stack('scripts')

    </body>
</html>


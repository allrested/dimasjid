<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <title>SISTAMAS </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SISTAMAS " />
    <meta name="keywords" content="Sistamas, Akuntansi" />
    <meta name="author" content="buildme.id" />
    <meta name="Version" content="1.0" />
    
    <!-- favicon -->    
    <link rel="shortcut icon" href="{{asset('assets-front')}}/images/logo.png">
    <!-- Bootstrap -->
    <link href="{{ asset('assets-front') }}/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets-front') }}/js/jquery.min.js"></script>
    <!-- Icons -->
    <link href="{{ asset('assets-front') }}/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Magnific -->
    <link href="{{ asset('assets-front') }}/css/magnific-popup.css" rel="stylesheet" type="text/css" />
    <!-- Slider -->
    <link rel="stylesheet" href="{{ asset('assets-front') }}/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="{{ asset('assets-front') }}/css/owl.theme.default.min.css" />
    <!-- FLEXSLIDER -->
    <link href="{{ asset('assets-front') }}/css/flexslider.css" rel="stylesheet" type="text/css" />
    <!-- Main Css -->
    <link href="{{ asset('assets-front') }}/css/style.css" rel="stylesheet" type="text/css" id="theme-opt" />
    <link href="{{ asset('assets-front') }}/css/custom-style.css" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets-front') }}/css/colors/default.css" rel="stylesheet" id="color-opt">
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-back') }}/js/DataTables/datatables.min.css" />

    @stack('css')

</head>

<body>
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div>
    </div>
    <!-- Loader -->

    <!-- Navbar STart -->
    <header id="topnav" class="defaultscroll sticky bg-white shadow-sm">
        <div class="container">
            <!-- Logo container-->
            <div>
                <a class="logo" href="{{ url('/') }}">
                    <img src="{{ asset('assets-front') }}/images/logo.png" alt="" width="100px">
                </a>

            </div>
            <div class="buy-button">
                <a href="{{ url('/login') }}" class="btn btn-primary">Masuk</a>
            </div>
            <!--end login button-->
            <!-- End Logo container-->
            <div class="menu-extras">
                <div class="menu-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </div>
            </div>

            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">
                    <li><a href="{{ url('/') }}">Beranda</a></li>
                    <li><a href="{{ url('layanan') }}">Layanan</a></li>
                    <li><a href="{{ url('informasi') }}">Informasi</a></li>
                    <li><a href="{{ url('berita') }}">Berita</a></li>
                    <li><a href="{{ url('kontak_kami') }}">Kontak Kami</a></li>

                </ul>
                <!--end navigation menu-->
                <div class="buy-menu-btn d-none">
                    <a href="{{ url('login') }}" class="btn btn-primary">Masuk</a>
                </div>
                <!--end login button-->
            </div>
            <!--end navigation-->
        </div>
        <!--end container-->
    </header>
    <!--end header-->
    <!-- Navbar End -->

    @yield('content')

    <footer class="footer footer-bar">
        <div class="container text-center">
            <div class="row align-items-center">
                <div class="col-sm-8">
                    <div class="text-sm-left">
                        <p class="mb-0">© 2020 SISTAMAS</p>
                    </div>
                </div>
                <div class="col-sm-4">
                  <p>Created with <i class="mdi mdi-heart text-danger"></i> in <a
                                href="#" class="text-success"></a>bandung</p>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </footer>
    <!--end footer-->
    <!-- Footer End -->

    <!-- javascript -->
    <script src="{{ asset('assets-front') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets-front') }}/js/jquery.easing.min.js"></script>
    <script src="{{ asset('assets-front') }}/js/scrollspy.min.js"></script>
    <!-- Magnific Popup -->
    <script src="{{ asset('assets-front') }}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('assets-front') }}/js/magnific.init.js"></script>
    <!-- SLIDER -->
    <script src="{{ asset('assets-front') }}/js/owl.carousel.min.js"></script>
    <script src="{{ asset('assets-front') }}/js/owl.init.js"></script>
    <!--FLEX SLIDER-->
    <script src="{{ asset('assets-front') }}/js/jquery.flexslider-min.js"></script>
    <script src="{{ asset('assets-front') }}/js/flexslider.init.js"></script>
    <!-- Counter -->
    <script src="{{ asset('assets-front') }}/js/counter.init.js"></script>
    <!-- Switcher -->
    <script src="{{ asset('assets-front') }}/js/switcher.js"></script>
    <!-- Main Js -->
    <script src="{{ asset('assets-front') }}/js/app.js"></script>
    <!-- DataTables -->
    <script src="{{ asset('assets-back') }}/js/DataTables/datatables.min.js"></script>
    <script src="{{ asset('assets-back') }}/js/DataTables/dataTables-config.js"></script>
    @stack('custom-script')

</body>

</html>

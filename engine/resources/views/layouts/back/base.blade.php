<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="buildme.id">
    <meta name="description" content="SISTAMAS">

@hasSection('page_title')
    <title>@yield('page_title')</title>
@else
    <title> SISTAMAS</title>
@endif


    <!--Bootstrap v4.3.1-->
    <link href="{{ asset('assets-back') }}/css/bootstrap.min.css" rel="stylesheet">
    <script src="{{ asset('assets-back') }}/js/jquery-3.4.1.min.js"></script>
    <!-- Font-awesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-back') }}/css/font-awesome/all.css">
    <!--dripicons -->
    <link href="{{ asset('assets-back') }}/css/dripicons.css" rel="stylesheet">
    <!-- fullcalendar -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-back') }}/css/fullcalendar.min.css">
    <!-- perfect-scrollbar -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-back') }}/css/perfect-scrollbar.css">
    <!-- bootstrap-select -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-back') }}/css/bootstrap-select.min.css">
    <!-- bootstrap-tour -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-back') }}/css/bootstrap-tour-standalone.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-back') }}/js/DataTables/datatables.min.css" />
    <!-- Custom -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-back') }}/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-back') }}/css/custom.css">
    <link rel="stylesheet" type="text/css" href="{{asset('lib/sweetalert/sweetalert.min.css')}}">
    <link href="{{asset('assets-back')}}/summernote/dist/summernote-lite.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-back') }}/css/select2-bootstrap.css">
    <link rel="stylesheet" href="{{asset('assets-back')}}/dropify/dist/css/dropify.css">
    <!-- Favicon -->
    <!-- <link rel="apple-touch-icon-precomposed" sizes="57x57"
        href="{{asset('assets-front')}}/images/apple-touch-icon-57x57.png" /> -->
    <link rel="shortcut icon" href="{{asset('assets-front')}}/images/logo.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- datetime-picker -->
    <script src="{{ asset('assets-back') }}/js/popper.js"></script> 
    <script src="{{ asset('assets-back') }}/js/moment.min.js"></script>
    <script src="{{ asset('assets-back') }}/js/bootstrap-datetimepicker.min.js"></script>
    <script src="{{ asset('assets-back') }}/js/collapse.js"></script>
    <script src="{{ asset('assets-back') }}/js/transition.js"></script>

    @stack('custom_script')
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<style>
    /* table td:not(:last-child) {
        border-right: 0.5px solid #ccc
    } */

</style>
<body id="day-mode">
    <div class="preloader">
        <img src="{{asset('assets-back/img/preload.gif')}}" alt="">
        <h6 id="preloader-text">Memperbarui data..</h6>
    </div>
    <div class="wrapper">
        <!-- Side navigation -->
        @include('layouts.back.sidebar')
        <!-- Main Content -->
        <!-- Content Wrapper -->
        <main class="contentWrapper container-fluid">
            <!-- Top navigation -->
            <nav id="top-nav">
                <div class="sideNavToggle"><i class="dripicons-align-justify"></i></div>
                <a class="logo-mobile" href="{{ url('/admin')}}"><img src="{{ asset('assets-front') }}/images/logo.png"
                        alt="Logo"></a>
                <div margin-top="1%" class="user-profile dropdown show">
                    <a class="dropdown-toggle" href="index.html#" data-display="static" data-toggle="dropdown"
                        role="button" aria-haspopup="true" aria-expanded="false">
                        <img src="{{asset('assets-back')}}/img/dummy-pic.png" alt="User image">
                        <i class="user-icon-m dripicons-user"></i>
                        <span class="dropdown-arrow dripicons-chevron-down"></span>
                    </a>
                    <div class="dropdown-menu animated zoomIn">
                        <div class="dropdown-menu-wrapper">
                            {{-- <a class="dropdown-item" href="{{ route('users.edit', Auth::user()->id )}}"><i
                                    class="dripicons-user"></i> Profile</a> --}}
                            <a class="dropdown-item" href="{{route('logout')}}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                    class="dripicons-exit">
                                </i> Sign out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </div>
                <p class="user-name">
                    {{auth()->user()->name}}
                    <span class="user-position">
                        @if (auth()->user()->role == 1)
                        Super Administrator
                        @elseif(auth()->user()->role == 2)
                        DKM
                        @else
                        Pengguna
                        @endif
                    </span>
                </p>
                <ul class="nav-icons">
                    <li class="nav-calendar dropdown">
                        <a class="dropdown-toggle" data-display="static" href="{{ route('agenda.index')}}"
                            aria-expanded="false">
                            <i class="dripicons-calendar"></i>
                        </a>
                    </li>
                    <li class="nav-messages dropdown">
                        <a class="dropdown-toggle" data-display="static" href="{{ route('announce.index')}}"
                            aria-expanded="false">
                            <i class="dripicons-message"></i>
                        </a>
                    </li>
                </ul>

            </nav><!-- end #top-nav -->

            <div class="container">
                @yield('content')
            </div>

            <footer id="footer">
                <div class="row">
                    <div class="col-md-6">
                        Copyright &copy; 2020<a href="#"></a>
                    </div>
                    <div class="r-footer col-md-6"><a href="#">Terms of use</a> | <a href="#">Privacy
                            Policy</a></div>
                </div>
            </footer><!-- end #footer -->
        </main><!-- end .contentWrapper -->
    </div> <!-- end .wrapper -->

    
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('assets-back') }}/js/bootstrap.min.js"></script>
    <!-- perfect-scrollbar -->
    <script src="{{ asset('assets-back') }}/js/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('assets-back') }}/js/perfect-scrollbar-config.js"></script>
    <!-- bootstrap-select -->
    <script src="{{ asset('assets-back') }}/js/bootstrap-select.min.js"></script>

    <!-- bootstrap-tour -->
    <script src="{{ asset('assets-back') }}/js/bootstrap-tour-standalone.min.js"></script>
    <script src="{{ asset('assets-back') }}/js/bootstrap-tour-config.js"></script>

    <!-- DataTables -->
    <script src="{{ asset('assets-back') }}/js/DataTables/datatables.min.js"></script>
    <script src="{{ asset('assets-back') }}/js/DataTables/dataTables-config.js"></script>
    <!--Custom script -->
    <script src="{{ asset('assets-back') }}/js/script.js"></script>
    <!-- Sweetalert -->
    <script src="{{ asset('lib/sweetalert/sweetalert.min.js') }}"></script>    
    <!-- Summernote -->
    <script src="{{asset('assets-back')}}/summernote/dist/summernote-lite.min.js"></script>
    <script src="{{asset('assets-back')}}/dropify/dist/js/dropify.min.js"></script>
    @stack('custom-scripts')
    <script>
    $('.under-development').on('click',function (e){        
            e.preventDefault();
            Swal.fire(
                'Mohon Maaf',            
                'Fitur Masih Dalam Tahap Pengembangan.',
                'warning'
            ); 
        });
</script>
</body>

</html>

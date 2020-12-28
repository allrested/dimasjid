<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
@hasSection('page_title')
    <title>@yield('page_title')</title>
@else
    <title> SISTAMAS</title>
@endif
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SISTAMAS " />
    <meta name="keywords" content="Sistamas, Akuntansi" />
    <meta name="author" content="buildme.id" />
    <meta name="Version" content="1.0" />
    <!-- favicon -->    
    <link rel="shortcut icon" href="{{asset('assets-front')}}/images/logo.png">
    <!-- Bootstrap -->
    <link href="{{ asset('assets-front') }}/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons -->
    <link href="{{ asset('assets-front') }}/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Main Css -->
    <link href="{{ asset('assets-front') }}/css/style.css" rel="stylesheet" type="text/css" id="theme-opt" />
    <link href="{{ asset('assets-front') }}/css/custom-style.css" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets-front') }}/css/colors/default.css" rel="stylesheet" id="color-opt">

    @stack('css')

</head>

<body>
    @yield('content')

    <!-- javascript -->
    <script src="{{ asset('assets-front') }}/js/jquery.min.js"></script>
    <script src="{{ asset('assets-front') }}/js/bootstrap.bundle.min.js"></script>
    @stack('custom-script')
</body>

</html>

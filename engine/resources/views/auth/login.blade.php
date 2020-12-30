<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="buildme.id">
    <meta name="description" content="Panel Login">

	<title>Portal SISTAMAS</title>

	<link rel="shortcut icon" href="{{asset('assets-front')}}/images/logo.png">
	<!--Bootstrap v4.3.1-->
	<link href="{{asset('assets-back')}}/css/bootstrap.min.css" rel="stylesheet">

	<!-- Font-awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<!--dripicons -->
	<link href="{{asset('assets-back')}}/css/dripicons.css" rel="stylesheet">
	
	<!-- Custom -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets-back')}}/css/style.css">



	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<div class="wrapper">
		<main class="container-fluid">
			<div class="login-wrapper row">
				<div class="login-l col-lg-4">			

					
	
                    <form action="{{ route('login') }}" class="login-form" autocomplete="on" method="post">
						@csrf
						<a href="{{ url('/')}}"><img src="{{ asset('assets-front') }}/images/logo.png" width="200px" alt="logo" class="mb-3"></a>

						@include('include.alert')

						<p>Masukan Email dan Password anda</p>

						<div class="txtb">
							<input type="text" required="" name="email">
							<span data-placeholder="Email"></span>
						</div>
						<div class="txtb">
							<input type="password" required="" name="password">
							<span data-placeholder="Password"></span>
						</div>
						<div class="login-form-footer">
							<a href="{{ url('forgot_pass') }}">Lupa Kata Sandi?</a>
							<input type="submit" class="logbtn" value="Masuk">
						</div>						
					</form>
				</div>
				<div class="login-r col-lg-8">
					<div class="login-message">
						<p><span></span> SISTAMAS <span>Aplikasi Akuntansi Masa Kini</span></p>
					</div>
				</div>
			</div>
		</main>
	</div> <!-- end .wrapper -->

	<script src="{{asset('assets-back')}}/js/jquery-3.4.1.min.js"></script>
	<script src="{{asset('assets-back')}}/js/popper.js"></script>
	<script src="{{asset('assets-back')}}/js/moment.min.js"></script>
  	<!-- Include all compiled plugins (below), or include individual files as needed -->
  	<script src="{{asset('assets-back')}}/js/bootstrap.min.js"></script>

	<!--Custom script -->
	<script src="{{asset('assets-back')}}/js/script.js"></script>
</body>
</html>

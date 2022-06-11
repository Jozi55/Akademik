<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login Page</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{asset('dist/img/icon.png')}}"/>
<!--===============================================================================================-->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" href="{{ asset('plugins/Linearicons-Free/icon-font.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('dist/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('dist/css/main.css') }}">
<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url({{asset('dist/img/bg.jpg')}});">
					<span class="login100-form-title-1">
						Sistem Informasi Akademik <br> SD Negeri 3 Dencarik
					</span>
				</div>

                @if ($message = Session::get('error'))
				<div class="alert alert-danger alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button> 
					<strong>{{ $message }}</strong>
				</div>
				@endif

				<form class="login100-form" action="{{route('postlogin')}}" method="POST">
                    @csrf
					<div class="wrap-input100 m-b-26">
						<span class="label-input100">Email</span>
						<input class="input100" type="text" name="email" placeholder="Masukkan email" required>
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 m-b-18">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pass" placeholder="Masukkan password" required>
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Login
						</button>
					</div>
				</form>
                <div>
                    {{-- <center><a href="https://id.pngtree.com/free-backgrounds">foto latar belakang gratis dari id.pngtree.com</a></center> --}}
                </div>
			</div>
		</div>
	</div>
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('plugins/popper/popper.js') }}"></script>
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('dist/js/main.js')}}"></script>

</body>
</html>
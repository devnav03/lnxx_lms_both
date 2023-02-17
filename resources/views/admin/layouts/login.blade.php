<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>

		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
		<meta name="description" content="{{ config('app.name', 'Dashboard') }} - ">
		<meta name="author" content="{{ config('app.name', 'Dashboard') }}">
		<meta name="keywords" content="">

		<!-- Favicon -->
		<link rel="icon" href="{{ asset('img/favicon.png')}}" type="image/x-icon"/>

		<meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Dashboard') }}</title>

		<!-- Bootstrap css-->
		 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

		<!-- Icons css-->
		<link href="{{ asset('plugins/web-fonts/icons.css') }}" rel="stylesheet"/>
		<link href="{{ asset('plugins/web-fonts/font-awesome/font-awesome.min.css') }}" rel="stylesheet">
		<link href="{{ asset('plugins/web-fonts/plugin.css') }}" rel="stylesheet"/>

		<!-- Style css-->
		<link href="{{ asset('css/style.css') }}" rel="stylesheet">

	</head>

	<body class="ltr main-body leftmenu error-1">

		<!-- Loader -->
		<div id="global-loader">
			<img src="{{ asset(config('app.images.loader'))}}" class="loader-img" alt="Loader">
		</div>
		<!-- End Loader -->

		<!-- Page -->
		<div class="page main-signin-wrapper">

			<!-- Row -->
			<div class="row signpages text-center">
				<div class="col-md-12">
					<div class="card">

    <div class="row row-sm">
    <div class="col-lg-6 col-xl-5 d-none d-lg-block text-center bg-primary details">
        <div class="mt-5 pt-4 p-2 pos-absolute">
       <!--  <img src="{{ asset(config('app.images.logo_small_url'))}}" class="header-brand-img mb-4" alt="logo"> -->
            <div class="clearfix"></div>
            <div class="clearfix"></div>
            <img src="{{ asset('img/logo.jpeg') }}" class="ht-100 mb-0" style="margin-top: 45px;" alt="user">
           <h5 class="mt-4 text-white"><!-- Create Your Account --></h5> 
            <span style="color: #63cac6;" class="tx-white-6 tx-13 mb-5 mt-xl-0">To get full user information, kindly sign in.</span>
        </div>
    </div>
    <div class="col-lg-6 col-xl-7 col-xs-12 col-sm-12 login_form ">
        <div class="main-container container-fluid">
            <div class="row row-sm">
                <div class="card-body mt-2 mb-2">
                    <div class="clearfix"></div>
                    {!! Form::open(['url' => 'admin/login', 'method' => 'post', 'class' => '']) !!} 
                     @include('admin.layouts.messages')
                    {{ csrf_field() }}
                        <h5 class="text-start mb-2 mb-4">Sign in to your account</h5>
                        <div class="form-group text-start">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group text-start">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group text-start">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        <button type="submit" class="btn ripple btn-main-primary btn-block">Sign In</button>
                    {!! Form::close() !!}
                    <div class="text-start mt-5 ms-0"> 
                        <div class="mb-1">@if (Route::has('password.request'))<a href="{{ route('password.request') }}">Forgot password?</a>@endif</div>
                       <!--  <div>Don't have an account? <a href="#">Register Here</a></div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


					</div>
				</div>
			</div>
			<!-- End Row -->

		</div>
		<!-- End Page -->

		<!-- Jquery js-->
		<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

		<!-- Bootstrap js-->
		<script src="{{ asset('plugins/bootstrap/js/popper.min.js') }}"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

		<!-- Select2 js-->
		<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
		<script src="{{ asset('js/select2.js') }}"></script>

		<!-- Perfect-scrollbar js -->
		<script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

		<!-- Color Theme js -->
		<script src="{{ asset('js/themeColors.js') }}"></script>

		<!-- Custom js -->
		<script src="{{ asset('js/custom.js') }}"></script>

<style type="text/css">
.alert.alert-danger {
    background: transparent;
    padding: 0px;
    border: 0px;
    margin: 0px;
    text-align: left;
    margin-bottom: 20px;
}   
.alert {
    padding: 0px;
}
.btn-main-primary {
    color: #ffffff;
    background-color: #63cac6;
    border-color: #63cac6;
}
.btn-main-primary:hover {
    color: #ffffff;
    background-color: #b3e59e;
    border-color: #b3e59e;
}
.signpages .details:before {
    background: #fff;
}
.form-control {
    color: #000 !important;
}
</style>
</body>
</html>
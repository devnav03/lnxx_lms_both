@extends('frontend.layouts.app')
@section('content')

<section class="sign_up">
<div class="container">
<div class="row">
<div class="col-md-8 mx-auto">
<div class="row">
<div class="col-md-6 sign_up_content">
<h3>Welcome back to Lnxx</h3>
<h5>Login to continue your account</h5>
<div style="text-align:center">
<img src="{!! asset('assets/frontend/images/Artboard_158.png')  !!}" style="padding-bottom: 20px; max-width: 300px;" class="img-responsive">
</div>
<!-- <ul>
<li>
<div class="row">
<div class="col-md-2">
<img src="{!! asset('assets/frontend/images/sign_img.png')  !!}" class="img-responsive">
</div>
<div class="col-md-10">
<h4>Lorem ipsum</h4>
<p>Lorem ipsum dolor sit amet, consectetur elit.</p>
</div>
</div>
</li>

<li>
<div class="row">
<div class="col-md-2">
<img src="{!! asset('assets/frontend/images/sign_img.png')  !!}" class="img-responsive">
</div>
<div class="col-md-10">
<h4>Lorem ipsum</h4>
<p>Lorem ipsum dolor sit amet, consectetur elit.</p>
</div>
</div>
</li>

<li>
<div class="row">
<div class="col-md-2">
<img src="{!! asset('assets/frontend/images/sign_img.png')  !!}" class="img-responsive">
</div>
<div class="col-md-10">
<h4>Lorem ipsum</h4>
<p>Lorem ipsum dolor sit amet, consectetur elit.</p>
</div>
</div>
</li>

<li>
<div class="row">
<div class="col-md-2">
<img src="{!! asset('assets/frontend/images/sign_img.png')  !!}" class="img-responsive">
</div>
<div class="col-md-10">
<h4>Lorem ipsum</h4>
<p>Lorem ipsum dolor sit amet, consectetur elit.</p>
</div>
</div>
</li>


</ul> -->


</div>
<div class="col-md-6 sign_up_field">
<a href="{{ route('home') }}"><img src="{!! asset('assets/frontend/images/cross.png') !!}" class="home-cross"></a>
<h3>Sign In</h3>
<p>Please enter the 6-digit OTP verification code</p>
<form action="{{ route('log-in') }}" method="post">
{{ csrf_field() }}	
<div class="form-group mob_input">
	<input type="number" name="login_otp" class="form-control" required="true" placeholder="Enter OTP">
	<img src="{!! asset('assets/frontend/images/otp.png')  !!}" alt="logo" class="input-img">
	<div class="valid_no"></div>
	<div class="not_verify" style="color: #f00; font-size: 12px; padding-top: 2px;"></div>
	<div class="otp_verify" style="color: green; font-size: 12px; padding-top: 2px;"></div>
	<div class="otp_email" style="color:green; font-size: 14px;">OTP sent successfully on your registered {{ $username }}</div>
	<input type="hidden" name="id" value="{{ $id }}">
	<div class="already_exist" style="color:#f00; font-size: 14px;"></div> 
	@if($errors->has('login_otp'))
       <span class="text-danger">{{$errors->first('login_otp')}}</span>
    @endif
    @if(session()->has('otp_not_match'))
	<div class="errors_otp" style="color: #f00; font-size: 12px; padding-top: 2px;">Invalid OTP</div>
	@endif
</div>
<div class="btn-box" style="text-align: center;">
<button class="btn">Sign In</button>
</div>
</form>

</div>

</div>


</div>
</div>

</div>
</div>
</section>


























@endsection
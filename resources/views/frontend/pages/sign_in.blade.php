@extends('frontend.layouts.app')
@section('content')

<section class="sign_up">
<div class="container">
<div class="row">
<div class="col-md-8 mx-auto">
<div class="row">
<div class="col-md-6 sign_up_content">
<h3>Welcome Back!</h3>
<h5>Login to continue.</h5>
<div style="text-align:center">
<img src="{!! asset('assets/frontend/images/Artboard_158.png')  !!}" style="padding-bottom: 20px; max-width: 300px;" class="img-responsive">
</div>
</div>
<div class="col-md-6 sign_up_field">
<a href="{{ route('home') }}"><img src="{!! asset('assets/frontend/images/cross.png') !!}" class="home-cross"></a>
<h3>Sign In</h3>
<p>To proceed, enter your mobile number</p>

@if(session()->has('username_mobile_not_exist'))
<p style="color: #f00;margin-bottom: 25px;">Entered mobile no. not registered not with us</p>
@endif
@if(session()->has('username_email_not_exist'))
<p style="color: #f00;margin-bottom: 25px;">Entered email not registered not with us</p>
@endif

<form action="{{ route('enter-login-otp') }}" method="post">
{{ csrf_field() }}	
<div class="form-group mob_input">
	<input type="text" class="form-control" required="true" placeholder="Enter Mobile / Email" name="username">
	<img src="{!! asset('assets/frontend/images/mobile_register.png')  !!}" alt="logo" class="input-img">
	@if($errors->has('username'))
       <span class="text-danger">{{$errors->first('username')}}</span>
    @endif 
</div>

<div class="btn-box" style="text-align: center;">
<button class="btn">Sign In</button>
<p style="margin-bottom: 0px; margin-top: 15px;">Or</p>
<p><a style="margin-top: 10px;" href="{{ route('sign_up') }}">Create New Account</a></p>
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
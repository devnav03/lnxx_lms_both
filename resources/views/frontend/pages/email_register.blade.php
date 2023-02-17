@extends('frontend.layouts.app')
@section('content')

<section class="sign_up">
<div class="container">
<div class="row">
<div class="col-md-8 mx-auto">
<div class="row">
<div class="col-md-6 sign_up_content">
<h3>Start your journey with Lnxx </h3>	
<!-- <h5>Create new account</h5> -->
<div style="text-align:center">
<img src="{!! asset('assets/frontend/images/Artboard_5.png')  !!}" style="padding-bottom: 20px; max-width: 300px;" class="img-responsive">
</div>

</div>
<div class="col-md-6 sign_up_field">
<!-- <a href="{{ route('home') }}"><img src="{!! asset('assets/frontend/images/cross.png') !!}" class="home-cross"></a> -->
<h3>Register your Email ID</h3>
<p>Please enter your email id.</p>
<form action="{{ route('email-otp') }}" method="post">
{{ csrf_field() }}	
<div class="form-group mob_input">
	<input type="email" class="form-control" required="true" maxlength="65" placeholder="Enter email id" name="email">
	<img src="{!! asset('assets/frontend/images/email.png')  !!}" alt="logo" class="input-img">
	<div class="valid_no">Enter your valid email id</div>
	<input type="hidden" name="mobile" value="{{ $mobile }}">
	<input type="hidden" name="salutation" value="{{ $salutation }}">
	<input type="hidden" name="name" value="{{ $name }}">
	<input type="hidden" name="middle_name" value="{{ $middle_name }}">
	<input type="hidden" name="last_name" value="{{ $last_name }}">
	<div class="already_exist" style="color:#f00; font-size: 14px;"></div> 
	@if($errors->has('email'))
       <span class="text-danger">{{$errors->first('email')}}</span>
    @endif
</div>
<div class="btn-box" style="text-align: center;">
<button class="btn">Next</button>
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
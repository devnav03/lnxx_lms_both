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
<h3>Create New Account</h3>
<p>Please enter your OTP.</p>
<form action="{{ route('upload-emirates-id') }}" method="post">
{{ csrf_field() }}	
<div class="form-group mob_input">
	<input type="number" name="otp_code" class="form-control" required="true" placeholder="Enter OTP">
	<img src="{!! asset('assets/frontend/images/otp.png')  !!}" alt="logo" class="input-img">
	<div class="valid_no"></div>
	<div class="not_verify" style="color: #f00; font-size: 12px; padding-top: 2px;"></div>
	<div class="otp_verify" style="color: green; font-size: 12px; padding-top: 2px;"></div>
	<div class="otp_email" style="color:green; font-size: 14px;">Please enter the OTP sent on the Email ID you gave us.</div>
	<input type="hidden" name="mobile" value="{{ $mobile }}">
	<input type="hidden" name="email" value="{{ $email }}">
	<input type="hidden" name="salutation" value="{{ $salutation }}">
	<input type="hidden" name="name" value="{{ $name }}">
	<input type="hidden" name="middle_name" value="{{ $middle_name }}">
	<input type="hidden" name="last_name" value="{{ $last_name }}">
	<div class="already_exist" style="color:#f00; font-size: 14px;"></div> 
	@if($errors->has('otp_code'))
       <span class="text-danger">{{$errors->first('otp_code')}}</span>
    @endif
    @if(session()->has('otp_not_match'))
	<div class="errors_otp" style="color: #f00; font-size: 12px; padding-top: 2px;">Invalid OTP</div>
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
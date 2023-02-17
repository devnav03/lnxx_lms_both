@extends('frontend.layouts.app')
@section('content')

<section class="sign_up">
<div class="container">
<div class="row">
<div class="col-md-8 mx-auto">
<div class="row">
<div class="col-md-6 sign_up_content">
<h3>Start your journey with Lnxx </h3>
<h5>Create new account</h5>
<div style="text-align:center">
<img src="{!! asset('assets/frontend/images/Artboard_5.png')  !!}" style="padding-bottom: 20px;" class="img-responsive">
</div>
</div>
<div class="col-md-6 sign_up_field">
<!-- <a href="{{ route('home') }}"><img src="{!! asset('assets/frontend/images/cross.png') !!}" class="home-cross"></a> -->	
<h3>Create New Account</h3>
<p>Let's get you started!</p>
<form action="{{ route('register-email') }}" class="sn_form" method="post">
{{ csrf_field() }}
<div class="row">	
	<div class="col-md-3">
	  <select name="salutation" class="form-control" style="padding-left: 4px;" required="true">
	    <option value="Mr.">Mr.</option>
	    <option value="Mrs.">Mrs.</option>
	    <option value="Miss.">Miss</option>
	    <option value="Dr.">Dr.</option>
	    <option value="Prof.">Prof.</option>
	    <option value="Rev.">Rev.</option>
	    <option value="Other">Other</option>
	  </select>
	</div>
    <div class="col-md-9">
		<div class="form-group">
			<input type="text" class="form-control" maxlength="16" style="padding-left: 10px;" required="true" placeholder="First name*" name="name">
			@if($errors->has('name'))
		       <span class="text-danger">{{$errors->first('name')}}</span>
		    @endif
		</div>
    </div>

    <div class="col-md-6">
		<div class="form-group">
			<input type="text" class="form-control" maxlength="16" style="padding-left: 10px;" placeholder="Middle name" name="middle_name">
			@if($errors->has('middle_name'))
		       <span class="text-danger">{{$errors->first('middle_name')}}</span>
		    @endif
		</div>
    </div>
    <div class="col-md-6">
		<div class="form-group">
			<input type="text" class="form-control" maxlength="16" style="padding-left: 10px;" required="true" placeholder="Last name*" name="last_name">
			@if($errors->has('last_name'))
		       <span class="text-danger">{{$errors->first('last_name')}}</span>
		    @endif
		</div>
    </div>

</div>
<div class="form-group mob_input">
	<input type="number" id="phone" style="padding-left: 55px;" class="form-control" required="true" placeholder="Enter mobile number*" name="mobile">
	<span style="position: absolute; top: 12px; font-size: 14px; left: 20px;">+971</span>
   <!--  <div id="recaptcha-container"></div> -->
	<!-- <input type="number" onKeyPress="if(this.value.length==9) return false;" class="form-control" required="true" placeholder="Enter mobile number*" name="mobile"> -->
    
   

	<img src="{!! asset('assets/frontend/images/mobile_register.png')  !!}" alt="logo" class="input-img">
	<div class="valid_no" style="color: #888;"><!-- Enter your 9-digit mobile number-otp --></div>
	@if($errors->has('mobile'))
       <span class="text-danger">{{$errors->first('mobile')}}</span>
    @endif
   <div id="recaptha-container" style="margin-top: 12px;"></div>

<!-- 	<button type="button" class="btn btn-info" onclick="otpSend();">Send OTP</button>  -->

</div>

<div class="form-group mob_input otp_field" style="margin-top: 25px; display: none;">
	<input type="number" class="form-control" required="true" id="number-otp" maxlength="6" placeholder="Enter OTP*" name="otp">
	<img src="{!! asset('assets/frontend/images/otp.png')  !!}" alt="logo" class="input-img">
	<div class="otp_lab">Please enter the OTP sent on your mobile number</div>
	<div class="not_verify" style="color: #f00; font-size: 12px; padding-top: 2px;"></div>
	<div class="otp_verify" style="color: green; font-size: 12px; padding-top: 2px;"></div>

	@if(session()->has('otp_not_match'))
	<div class="errors_otp" style="color: #f00; font-size: 12px; padding-top: 2px;">Invalid OTP</div>
	@endif
	<!-- <div class="alert alert-danger hide" id="error-message"></div>
    <div class="alert alert-success hide" id="sent-message"></div> -->
</div>
<input type="hidden" name="verify" value="0" id="verify">
<div class="already_exist" style="color: #f00; font-size: 12px; padding-top: 2px;"></div>
<!-- <div class="otp_sent" style="color: green; font-size: 12px; padding-top: 2px;"></div>  -->
<div id="error" style="color: #f00;font-size: 12px; padding-top: 2px;display: none;"></div>
<div id="sentMessage" style="color: green;font-size: 12px; padding-top: 2px;display: none;"></div>
<div id="sucessMessage" style="color: green;font-size: 12px; padding-top: 2px;display: none;"></div>

<!-- <div class="form-group">
<p><input type="checkbox" required="true" value="1" name="terms_conditions"> I accept the <a href="#">Terms and Conditions</a></p>
</div> -->

<div class="btn-box" style="text-align: center;">
 <a onclick="sendCode();" class="sent_otp" style="background: #60B392; color: #fff; margin: 0 auto; font-size: 14px; cursor: pointer; width: 106px; border-radius: 25px; padding: 10px 15px;">Send OTP</a>	
<a onclick="verifyCode();" class="verify_otp" style="background: #60B392; color: #fff; margin: 0 auto; font-size: 14px; cursor: pointer; width: 120px; border-radius: 25px; padding: 10px 15px;display: none;">Verify Code</a>

<button class="btn" id="elementID" disabled="disabled" style="display: none;">Next</button>
<p style="margin-bottom: 0px; margin-top: 15px;">Or</p>
<p style="font-size: 16px">Already have an account? <a style="margin-top: 10px;display: inline; font-size: 16px;" href="{{ route('sign-in') }}">Sign In</a></p>
</div>
</form>

</div>

</div>


</div>
</div>

</div>
</div>
</section>


<style type="text/css">
@media(min-width: 1024px){
.sign_up .col-md-8 {
    margin-top: 70px;
}

}

</style>


@endsection
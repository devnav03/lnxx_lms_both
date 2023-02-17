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
<h3>Upload Your Photograph</h3>
<!-- <p style="margin-bottom: 10px;">Please upload your profile image.</p> -->
<form action="{{ route('save-profile-image') }}" enctype="multipart/form-data" method="post">
{{ csrf_field() }}	
<label style="font-size: 14px;">Upload your photo <span style="font-size: 13px;"> (allowed file types (*.jpg, *.jpeg, *.png only) with maximum size 2mb.)*</span></label>
<div class="form-group emirates_front">
	<!-- <input type="file" accept="image/png, image/jpg, image/jpeg" required="true" class="upload_file" id="imgInp" name="profile_image"> -->
	<!-- <img src="{!! asset('assets/frontend/images/upload_image.png') !!}" id="blah" class="img-responsive"> -->
    <input type="hidden" required="true" class="image-tag" id="image" name="profile_image">

	<div id="my_camera"></div> 
  
    <a onclick="take_snapshot();" style="background: #5EB495; padding: 10px 20px; color: #fff; border-radius: 10px; margin-bottom: 17px;margin-bottom: 8px; display: inline-block;cursor: pointer;">Take a Picture Now!</a> 
    <div id="results"><!-- Your captured image will appear here... --></div>
<!-- 	@if($errors->has('profile_image'))
        <span class="text-danger">{{$errors->first('profile_image')}}</span>
    @endif -->
</div>
<div class="form-group">
<!-- <p style="margin-bottom: 10px;font-size: 12px;margin-top: -11px;">This will help you get a higher credit<br> You can skip this step and upload it later as well.</p> -->	
<div class="terms_conditions_box">
<p style="font-size: 13px; font-weight: normal; margin-bottom: 6px;"><b style="font-size: 14px;">Read Terms and Conditions</b></p>
<div class="terms_conditions_con">
{!! $content->terms_conditions !!}
</div>
<p style="margin-bottom: 5px;font-size: 13px;"><input type="checkbox" style="margin-top: 1px;" required="true" value="1" name="terms_conditions"> I accept the <a href="#" style="font-size: 13px;">Terms and Conditions</a></p>
</div>

</div> 

<div class="btn-box" style="text-align: center;">
<button class="btn" disabled="disabled">Submit</button>
<!-- <p style="margin-bottom: 0px;"><a href="{{ route('save-profile-image') }}">Skip for now</a></p> -->
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
.terms_conditions_con p {
	font-weight: normal;
    font-size: 13px;
    text-align: justify;
    margin-bottom: 10px;
}	

</style>

@endsection
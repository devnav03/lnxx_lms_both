@extends('frontend.layouts.app')
@section('content')
@php
$temp_id = \Session::get('temp_id');
@endphp
<section class="sign_up upload_emr">
<div class="container">
<div class="row">
<div class="col-md-8 mx-auto">
<div class="row">
<div class="col-md-6 sign_up_content">
<h3>Start your journey with Lnxx</h3> 
<!-- <h5>Create new account</h5> -->
<div style="text-align:center">
<img src="{!! asset('assets/frontend/images/Artboard_5.png')  !!}" style="padding-bottom: 20px; margin-top: 40px;" class="img-responsive">
</div>
</div>
<div class="col-md-6 sign_up_field">
<!-- <a href="{{ route('home') }}"><img src="{!! asset('assets/frontend/images/cross.png') !!}" class="home-cross"></a> -->
<h3>Create New Account</h3>
<p>Please upload your Emirates ID.</p>
<form action="{{ route('emirates-id-verification') }}" enctype="multipart/form-data" method="post">
{{ csrf_field() }}	
<label style="font-size: 14px;">Enter 15 digits of your Emirates ID*</label>
    <div class="form-group">
      <input name="eid_number" style="max-width: 327px;" pattern="\d*" class="form-control" maxlength="15" minlength="15"  value="{{ old('eid_number') }}" required="true" type="text">
      @if($errors->has('eid_number'))
      <span class="text-danger">{{$errors->first('eid_number')}}</span>
      @endif
    </div>
<label class="sh_emid" style="font-size: 14px;max-width: 350px; display: none;">Upload front photo of Emirates id <span style="font-size: 13px;">(allowed file types (*.jpg, *.jpeg, *.png only) with maximum size 2mb.)</span></label>
<div class="form-group emirates_front sh_emid" style="display: none;">
	<input type="file" accept="image/png, image/jpg, image/jpeg" class="upload_file" required="true" id="imgInp" name="emirates_id_front">
	<img src="{!! asset('assets/frontend/images/upload_image.png') !!}" id="blah" class="img-responsive">
	@if($errors->has('emirates_id_front'))
        <span class="text-danger">{{$errors->first('emirates_id_front')}}</span>
    @endif
</div>
<label class="sh_emid" style="font-size: 14px;max-width: 350px;display: none;">Upload back photo of Emirates id <span style="font-size: 13px;">(allowed file types (*.jpg, *.jpeg, *.png only) with maximum size 2mb.)</span></label>
<div class="form-group emirates_front sh_emid" style="display: none;">
	<input type="file" accept="image/png, image/jpg, image/jpeg" class="upload_file" required="true" id="imgInp1" name="emirates_id_back">
	<img src="{!! asset('assets/frontend/images/upload_image.png') !!}" id="blah1" class="img-responsive">
	  @if($errors->has('emirates_id_back'))
       <span class="text-danger">{{$errors->first('emirates_id_back')}}</span>
    @endif
</div>

<input type="hidden" value="{{ $temp_id }}" name="temp_id">
<!-- <p style="font-size: 11px;" class="hide_text">This will help you get higher credit</br>
You can skip this step and verify it later as well.</p> -->
<div class="btn-box" style="text-align: center;">
<button class="btn">Next</button>
<p style="margin-bottom: 0px;"><a style="color: #ddd; font-size: 14px;" href="{{ route('upload-profile-image') }}">Skip for now</a></p>
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
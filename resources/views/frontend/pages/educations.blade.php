@extends('frontend.layouts.app')
@section('content')

<section class="personal_details edu_dt">
<div class="container">  
<div class="row">  
<div class="col-md-7">
<div class="personal_details_box">
<h1 class="app_form_head">Application Form</h1>
<h2 style="margin-bottom: 20px;">Education Details</h2>
<!-- <h6>Please enter your information to check the Offer.</h6> -->

<form action="{{ route('save-education-details') }}" method="post">
{{ csrf_field() }}  

<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Qualification</label>
      <input name="education" class="form-control" @if($result) value="{{ $result->education }}" @else value="{{ old('education') }}" @endif type="text" required="true">
      @if($errors->has('education'))
      <span class="text-danger">{{$errors->first('education')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Primary School</label>
      <input name="primary_school" class="form-control" @if($result) value="{{ $result->primary_school }}" @else value="{{ old('primary_school') }}" @endif type="text" required="true">
      @if($errors->has('primary_school'))
      <span class="text-danger">{{$errors->first('primary_school')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">High School</label>
      <input name="high_school" class="form-control" @if($result) value="{{ $result->high_school }}" @else value="{{ old('high_school') }}" @endif type="text">
      @if($errors->has('high_school'))
      <span class="text-danger">{{$errors->first('high_school')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Graduate</label>
      <input name="graduate" class="form-control" @if($result) value="{{ $result->graduate }}" @else value="{{ old('graduate') }}" @endif type="text">
      @if($errors->has('graduate'))
      <span class="text-danger">{{$errors->first('graduate')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Postgraduate</label>
      <input name="postgraduate" class="form-control" @if($result) value="{{ $result->postgraduate }}" @else value="{{ old('postgraduate') }}" @endif type="text">
      @if($errors->has('postgraduate'))
      <span class="text-danger">{{$errors->first('postgraduate')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Others</label>
      <input name="others" class="form-control" @if($result) value="{{ $result->others }}" @else value="{{ old('others') }}" @endif type="text">
      @if($errors->has('others'))
      <span class="text-danger">{{$errors->first('others')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12 text-center">
    <a href="{{ route('address-details') }}" class="back_btn">Back</a> &nbsp;&nbsp;
    <button type="submit">Proceed</button>
  </div>
</div>
</form>
</div>
</div>
<div class="col-md-5">
  <div class="service-step">
    <h3>All fields marked with an asterisk (*) are mandatory.</h3>
  </div>
  <div class="service-step">
    <h3>Complete and accurate information helps us bring you the best products suited to you at the fastest pace!</h3>
  </div>
</div>

</div>
</div>
</section>


@endsection    
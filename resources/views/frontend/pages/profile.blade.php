@extends('frontend.layouts.app')
@section('content')

<section class="profile">
<div class="container">  
<div class="row">  
<div class="col-md-10 offset-md-1">
<div class="profile-box">
 @if(session()->has('profile_update'))
      <div class="alert alert-success" role="alert">Your profile has been successfully updated</div>
 @endif 
<form action="{{ route('profile-update') }}" enctype="multipart/form-data" method="POST">
  {{ csrf_field() }}
<div class="row">  
<div class="col-md-3">
  @if($user->profile_image)
  <img class="p_img" id="blah" src="{!! asset($user->profile_image) !!}" alt="">
  @else
  <img src="{!! asset('assets/frontend/images/user_profile.png')  !!}" id="blah" class="p_img">
  @endif
  <input type="file" accept="image/png, image/jpeg, image/png" class="mgn20" id="imgInp" name="profile_image"> 
</div>
<div class="col-md-9">
<div class="row">  
<div class="col-md-6">
<label>Name</label>  
<input type="text" value="{{ $user->name }}" name="name" required="true" class="form-control">
@if ($errors->has('name'))
<span class="text-danger">{{$errors->first('name')}}</span>
@endif
</div>
<div class="col-md-6 mgn20">
<label>Email</label>  
<input type="email" value="{{ $user->email }}" name="email" required="true" class="form-control" readonly="">
@if ($errors->has('email'))
<span class="text-danger">{{$errors->first('email')}}</span>
@endif
</div>

<div class="col-md-6 mgn20">
<label>Mobile</label>  
<input type="number" value="{{ $user->mobile }}" name="mobile" required="true" class="form-control" readonly="">
@if ($errors->has('mobile'))
<span class="text-danger">{{$errors->first('mobile')}}</span>
@endif
</div>

<div class="col-md-6 mgn20">
<label>Gender</label>  
<select name="gender" class="form-control" required="true">
  <option value="Male" @if($user->gender == 'Male') selected @endif>Male</option>
  <option value="Female" @if($user->gender == 'Female') selected @endif>Female</option>
  <option value="Other" @if($user->gender == 'Other') selected @endif>Other</option>
</select>
@if($errors->has('gender'))
  <span class="text-danger">{{$errors->first('gender')}}</span>
@endif
</div>
<div class="col-md-6 mgn20">
<label>DOB</label>  
@if($user->date_of_birth)
<input type="text" onfocus="(this.type='date')" max="2004-08-01" value="{{ date('d M, Y', strtotime($user->date_of_birth)) }}" name="date_of_birth" required="true" class="form-control">
@else
<input type="text" onfocus="(this.type='date')" placeholder="Enter your date of birth*" max="2004-08-01" value="{{ old('mobile') }}" name="date_of_birth" required="true" class="form-control">
@endif

@if ($errors->has('date_of_birth'))
<span class="text-danger">{{$errors->first('date_of_birth')}}</span>
@endif
</div> 

<div class="col-md-6 submit_field">
    <input type="submit" name="submit" value="Update">
</div>
 
</div>
</div>
</div>

</div>
</form>
</div>
</div>
</div>
</div>
</section>


@endsection    
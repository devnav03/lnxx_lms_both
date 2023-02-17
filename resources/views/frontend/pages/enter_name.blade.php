@extends('frontend.layouts.app')
@section('content')

<section class="sign_up">
<div class="container">
<div class="row">
<div class="col-md-8 mx-auto">
<div class="row">
<div class="col-md-6 sign_up_content">
<h3>Lorem ipsum</h3>
<h5>Lorem ipsum dolor sit amet elit.</h5>
<ul>
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


</ul>


</div>
<div class="col-md-6 sign_up_field">
<a href="{{ route('home') }}"><img src="{!! asset('assets/frontend/images/cross.png') !!}" class="home-cross"></a>
<h3>Sign Up</h3>
<p>Please enter your correct information.</p>
<form action="{{ route('user-register') }}" method="post">
{{ csrf_field() }}	
<div class="form-group mob_input">
	<input type="text" class="form-control" required="true" placeholder="Name" name="name">
	<img src="{!! asset('assets/frontend/images/name.png')  !!}" style="top: 14px;" alt="name" class="input-img">
	<div class="valid_no">Enter your full name</div>
	<input type="hidden" name="mobile" value="{{ $mobile }}">
	<input type="hidden" name="email" value="{{ $email }}">
	<div class="already_exist" style="color:#f00; font-size: 14px;"></div> 
	@if($errors->has('name'))
       <span class="text-danger">{{$errors->first('name')}}</span>
    @endif
</div>
<div class="btn-box" style="text-align: center;">
<button class="btn">Done</button>
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
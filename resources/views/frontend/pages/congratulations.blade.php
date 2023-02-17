@extends('frontend.layouts.app')
@section('content')
<section class="sign_up">
<section class="congratulations">
<div class="container">
<div class="row">
<div class="col-md-8 mx-auto">
<div class="row">
<div class="col-md-6 sign_up_field mx-auto" style="text-align: center; margin-top: 70px;
    border-radius: 15px; box-shadow: 1px 1px 24px #ddd;">
<div style="text-align: center;"><img src="{!! asset('assets/frontend/images/lnxx_logo.png') !!}" style="max-height: 40px; margin-top: 25px;" alt="logo" class="img-responsive"></div>
<h3 style="margin-top: 16px; font-weight: 600;">Congratulations!</h3>
<p style="margin-top: 10px; margin-bottom: 20px;">Your Lnxx ID is: lnxx{{$user_id}}</p>
<!-- <p>()</p> -->
<a href="{{ route('user-dashboard') }}" style="background: #5EB495; color: #fff; padding: 11px 23px; font-size: 15px; font-weight: 500; border-radius: 9px;">Continue</a>
</div>
</div>
</div>
</div>
</div>
</section>

</section>
























@endsection
@extends('admin.layouts.admin')
@php
    $route  = \Route::currentRouteName();    
@endphp
@section('content')

<div class="container cong_sec">
<div class="cong-box">
<img src="{!! asset('assets/frontend/images/cong_star.png') !!}" style="margin-top: 30px;
    margin-bottom: 30px;" alt="star" class="img-responsive"> 
<h3>Congratulations</h3>
<p style="margin-top: 15px; line-height: 28px;font-size: 16px;">You have successfully completed first step.<br><br> Now you are just a few steps away.</p>
</div>
<a class="continue-application" href="#">Continue to your application</a><br>
<a class="do-it-later" data-toggle="modal" data-target="#exampleModal" href="#">I will do it later</a>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="padding-bottom: 20px;">
      <div class="modal-header" style="border: 0px; padding: 0px; padding-right: 15px;">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: 10px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p style="font-size: 16px; margin-bottom: 25px;">Your application is not yet completed.<br> Do you want to continue?</p>
        <a href="#" style="border: 1px solid #333; padding: 6px 15px; color: #000; font-size: 16px; font-weight: 500;">Yes</a>&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="#" data-dismiss="modal" onclick="continueLater();" style="border: 1px solid #333; padding: 6px 15px; color: #000; font-size: 16px; font-weight: 500;">No, I will continue later</a>
    
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>

<section class="slider_background" style="padding: 20px 0 60px 0; text-align: center; display: none;">
<div class="container"> 
<img src="{!! asset('assets/frontend/images/thanku_img.png')  !!}" style="width: auto; max-height: 250px; " alt="logo" class="img-responsive"> 
<h2>Your application has been saved in draft</h2>
@if($ref_id)
@foreach($ref_id as $ref)
<h5 style="font-size: 16px;margin-bottom: 30px;color: green;">{{ $ref['line'] }}</h5>
@endforeach
@endif

<a style="background: #000; color: #fff; padding: 10px 35px;  border-radius: 10px; margin-top: 3px; display: inline-block;  margin-bottom: 10px;" href="{{ route('view-save-personal', $user_id) }}">Go to dashboard</a>

</div>
</section>


@if(session()->has('already_refer_friend'))
@php
$refer_email = \Session::get('refer_email');
$refer_name = \Session::get('refer_name');
$refer_mobile = \Session::get('refer_mobile');
@endphp
@else 
@php
$refer_email = '';
$refer_name = '';
$refer_mobile = '';
@endphp
@endif

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Refer a Friend</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -9px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if(session()->has('already_refer_friend'))
          <p style="color: #f00;">Oops, you referred someone who was already registered.</p>
        @endif
        @if(session()->has('refer_friend'))
          <p style="color: green;">Invitation sent successfully</p>
        @endif

        <form method="post" action="{{ route('refers') }}">
          <div class="form-group">
            <label class="sub-label">Name*</label>
            <input name="name" class="form-control" value="{{ $refer_name }}" required="true" type="text">
            @if($errors->has('name'))
            <span class="text-danger">{{$errors->first('name')}}</span>
            @endif
          </div>
          
          <div class="form-group">
            <label class="sub-label">Mobile Number*</label>
            <input name="mobile" class="form-control" value="{{ $refer_mobile }}" required="true" type="number">
            @if($errors->has('mobile'))
            <span class="text-danger">{{$errors->first('mobile')}}</span>
            @endif
          </div>
          {{ csrf_field() }}  
          
          <div class="form-group">
            <label class="sub-label">Email ID*</label>
            <input name="email" class="form-control" value="{{ $refer_email }}" required="true" type="email">
            @if($errors->has('email'))
            <span class="text-danger">{{$errors->first('email')}}</span>
            @endif
          </div>
          <div class="col-md-12 text-center">
            <button class="ref_btn" type="submit">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div> 

<script type="text/javascript">
  
  function continueLater(){
    $(".cong_sec").hide();
    $(".slider_background").show(); 
  }

</script>

<style type="text/css">
.cong-box {
    background: url(../../assets/frontend/images/cong_back.png);
    background-repeat: no-repeat;
    margin: 0 auto;
    max-width: 335px;
    background-size: 100%;
    padding: 30px;
    text-align: center;
    color: #fff;
    margin-top: 60px;
    padding-bottom: 100px;
}
.continue-application {
    margin: 0 auto;
    background: #0e140a;
    color: #fff;
    max-width: 335px;
    display: block;
    text-align: center;
    margin-top: 0px;
    padding: 11px 0px;
    font-weight: 400;
    font-size: 15px;
}
.do-it-later {
    max-width: 415px;
    display: block;
    margin: 0 auto;
    text-align: center;
    color: #555;
}





</style>


@endsection    
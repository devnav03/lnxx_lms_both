@extends('frontend.layouts.app')
@section('content')

<section class="personal_details">
<div class="container">  
<div class="row">  
<div class="col-md-7">
<div class="personal_details_box cm_dt">
<h1 class="app_form_head">Application Form</h1>   
<h2 style="margin-bottom: 15px;">Upload Video</h2>
<h4 style="font-size: 18px;">Kindly start uttering this sentence for video KYC.</h4>
<p style="line-height: 24px;">My name is {{\Auth::user()->name}} {{\Auth::user()->middle_name}} {{\Auth::user()->last_name}}. I have applied for financial products through JCBL and provided them with my information as asked for. I authorize JCBL to have my application processed. This is my emirates ID. My EID number is {{\Auth::user()->eid_number}} .<br><br>
<b><i>Instructions:</i></b> Display the front and back of your Emirate ID card while speaking these words out loud.</p>
<div id="container">

    <video id="gum" style="width: 64%; margin-left: 18%;" playsinline autoplay muted></video>
    <video style="width: 64%; margin-left: 18%;display: none;" id="recorded" playsinline loop></video>

    <div style="text-align: center;">
        <span id="start" style="margin-top: 10px;cursor: pointer;" class="btn btn-danger">Start camera</span>
        <span id="record" style="color: #fff;background: #5EB495;margin-top: 10px;cursor: pointer;" class="btn" disabled>Start Recording</span>
        <span id="play" style="color: #fff;background: #5EB495; display: none;margin-top: 10px;cursor: pointer;" class="btn" disabled>Play</span>
        <span id="download" style="color: #fff;background: #5EB495; display: none;margin-top: 10px;cursor: pointer;" class="btn" disabled>Upload</span>
        <p style="text-align: center; margin-top: 20px;"><a href="{{ route('consent-approval') }}" id="skip" style="color: #ddd; font-size: 14px;">Skip & Submit</a></p>
    </div>

    <div>
         <select style="opacity: 0;" id="codecPreferences" disabled></select>
    </div>
        <input style="opacity: 0;" type="checkbox" id="echoCancellation">
    <div>
        <span id="errorMsg"></span>
    </div>  
</div>

<form action="#" enctype="multipart/form-data" method="post">
{{ csrf_field() }}  
 <span id="start2"></span>

<div class="row">
  <div class="col-md-6">

</div>
</div>
</form>

</div>

</div>

<div class="col-md-5">
  <div class="service-step" style="margin-top: 0px;  border: 0px;">
    <img src="{!! asset('assets/frontend/images/video_record.png') !!}" style="max-width: 83%;" class="img-responsive const_vid_img">
    
  </div>

</div>

</div>
</div>
</section>


@endsection    
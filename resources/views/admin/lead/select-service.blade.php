@extends('admin.layouts.admin')
@php
    $route  = \Route::currentRouteName();    
@endphp
@section('content')
<section class="cus_dashboard">
<div class="container">  
<div class="row"> 
<div class="col-md-9">
@if(session()->has('profile_update_message'))
    <p style="color: green;margin-bottom: 10px;">Your profile has been successfully updated</p>
@endif
@if(session()->has('app_submit'))
  <p style="color: green;margin-bottom: 10px;">Your application has been submitted successfully</p>
@endif
@if(count($relations) != 0)
<div class="lorem_dashboard">
  <h2 class="rel_head" style="font-size: 25px;margin-top: 25px;">Relations</h2>
  <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
  <ul style="padding: 0px;list-style: none;">
    @foreach($relations as $relation)
    <li>
        <div class="service-sel">
          <h5 style="font-size: 17px;font-weight: 500; margin-bottom: 0px;">{{ $relation->name }}</h5>
          <p style="font-size: 14px;margin-bottom: 0px;">Status: @if($relation->status == 0)<span style="font-size: 14px; color: #5EB495;"> Pending </span>@endif </p>
          <p style="font-size: 14px;margin-bottom: 0px;">Reference No: #{{ $relation->ref_id }} </p>
          <p style="font-size: 14px;">Applied at: {!! date('d M, Y', strtotime($relation->created_at)) !!}</p>
        </div>
    </li>
    @endforeach
  </ul>
</div>
@endif

@if(count($service) != 0)
<div class="our_assistance ser_dt">
<h2 style="font-size: 22px; margin-top: 25px; margin-bottom: 15px;">Select Products</h2>
<form action="{{ route('admin.personal-details', $id) }}" class="personal_details_box" method="post">
{{ csrf_field() }}  

<div class="row">
  <div class="col-md-12">
    @if(session()->has('select_service'))
      <p style="color: #f00;margin-bottom: 10px;">Kindly select a service</p>
    @endif
    <input type="hidden" name="page" value="service">
    <input type="hidden" name="user_id" value="{{ $id }}">
  <ul style="padding: 0px;list-style: none;">
@php
$button = 1;
@endphp    
  @foreach($service as $service)
@php
$services = get_service_status_agent($service->id, $id);
$button += $services;
@endphp

    <li>
      <label class="ser_label" for="{{ $service->url }}" style="width: 100%;"> 
      <input id="{{ $service->url }}" @if($services == 1) checked="" @else @if($service->id == 1 || $service->id == 3) checked="" @endif   @endif type="checkbox" value="{{ $service->id }}" class="ser_chk" style="float: left;width: 20px; height: 20px; margin-top: 3px;" onChange="Selectser(this.value);" name="service[]"/>
        <div class="service-sel" style="float: left;">
            <!-- <img src="{!! asset($service->image) !!}" alt="img"> -->
          <h5 style="margin-top: 2px; margin-left: 10px;font-weight: normal; font-size: 16px;">{{ $service->name }}</h5>
        </div>
      </label>
    </li>
    @endforeach
  </ul>
  </div>

  <div class="col-md-12">
  <!--  <a href="{{ route('address-details') }}" class="back_btn">Back</a> &nbsp;&nbsp; -->
    <button type="submit" id="elementID" style="margin-top: 0px; background: #000; color: #fff; padding: 8px 25px;margin-bottom: 30px;">Proceed</button>
  </div>
</div>
</form>
</div>
@endif


</div>

</div>
</div>
</section>
  

<script type="text/javascript">
function Selectser() {
  var service_id = [];
    $('input.ser_chk[type=checkbox]').each(function () {
        if (this.checked)
          service_id.push($(this).val());
    });
  if(service_id != ''){
    $('#elementID').removeAttr('disabled');
    document.getElementById("elementID").style.background = "#000";
  } else {
    $('#elementID').attr('disabled','disabled');
    document.getElementById("elementID").style.background = "rgba(9, 15, 5, 0.5)";
  }
}
</script>

@stop
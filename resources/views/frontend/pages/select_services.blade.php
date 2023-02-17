@extends('frontend.layouts.app')
@section('content')

<section class="personal_details ser_dt">
<div class="container">  
<div class="row">  
<div class="col-md-7">
<div class="personal_details_box">
<h2>Select Services</h2>
<h6>You can select multiple products from the below list</h6>

<form action="{{ route('thank-you') }}" method="post">
{{ csrf_field() }}  

<div class="row">
  <div class="col-md-12">

    @if(session()->has('select_service'))
      <p style="color: #f00;margin-bottom: 10px;">Kindly select a service</p>
    @endif
    <input type="hidden" name="page" value="service">

    <div class="blog-slider owl-theme owl-carousel">  
    @foreach($service as $service)
@php
$services = get_service_status($service->id);
@endphp

    <div>
      <input @if($services == 1) checked="" @endif id="{{ $service->url }}" type="checkbox" value="{{ $service->id }}" name="service[]"/>
      <label class="ser_label" for="{{ $service->url }}"> 
        <div class="service-sel @if($services == 1) active_ser @endif">
          <h5>{{ $service->name }}</h5>
          <img src="{!! asset($service->image) !!}" alt="img">
        </div>
      </label>
    </div>
    @endforeach
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
    <h3>Services is only a few step away from you</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
  </div>

  <div class="service-step">
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    <h3>Get money in just a step way*</h3>
    <p style="border-top: 1px solid rgba(0, 0, 0, 0.5);padding-top: 30px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Risus dis adipiscing ac, consectetur quis aenean. Semper viverra maecenas pharetra tristique tempus platea elit viverra. Proin mauris suspendisse risus sem. In diam odio commodo, sodales tellus convallis tortor. Neque amet eget amet morbi ac at habitant. Enim eget aliquam tempus duis amet. Sed amet sed bibendum ullamcorper. Nam bibendum eu magna in in eget ullamcorper ultrices. Faucibus gravida tristique erat quam tincidunt tincidunt ut morbi.</p>
  </div>

</div>

</div>
</div>
</section>


@endsection    
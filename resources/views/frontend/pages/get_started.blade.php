@extends('frontend.layouts.app')
@section('content')

<script type="text/javascript">
const cfg = {
  type: 'bar',
  data: {
    datasets: [{
      data: [20, 10],
    }],
    labels: ['a', 'b']
  }
}


const config = {
  type: 'line',
  data: data,
};

const labels = Utils.months({count: 7});
const data = {
  labels: labels,
  datasets: [{
    label: 'My First Dataset',
    data: [65, 59, 80, 81, 56, 55, 40],
    fill: false,
    borderColor: 'rgb(75, 192, 192)',
    tension: 0.1
  }]
};

const plugin = { /* plugin implementation */ };

// chart1 and chart2 use "plugin"
const chart1 = new Chart(ctx, {
    plugins: [plugin]
});

const chart2 = new Chart(ctx, {
    plugins: [plugin]
});

// chart3 doesn't use "plugin"
const chart3 = new Chart(ctx, {});
 


</script>
<div id="chartAreaBorder"></div>

<section class="banner">
<div class="container">
<div class="row">
	<div class="col-md-6">
		<h3><span>Your Partner for Life!</span>  <br>One-Stop, Full Function, Holistic Experience! <br><span>For all your Financial Needs!</span></h3>
		<div class="row">
			<div class="col-md-4">
			    <img src="{!! asset('assets/frontend/images/found_qr_code.png')  !!}" alt="scan" class="img-responsive">
			</div>
			<div class="col-md-8">
			   <h4>Download the Lnxx mobile app.</h4>
			   <p>Get exclusive offers & enjoy a seamless experience.</p>
			</div>
		</div>
	</div>
</div>

<section class="continue_index">
<!-- <div class="container">	 -->
<!-- <h3>Start your journey</h3> -->
<div class="row">	
<div class="col-md-10 offset-md-1">	
<div class="row">
<div class="col-md-6 pdr50">	
<a href="{{ route('customer-menu') }}">	
<div class="con-box">
<h4>Enroll as customer</h4>
<p>Seamless Experience. Great offers!</p>
<a class="con_btn" href="{{ route('customer-menu') }}">
<img src="{!! asset('assets/frontend/images/rectangle.png')  !!}" class="pre_hover">
<img src="{!! asset('assets/frontend/images/Rectangle_right.png')  !!}" class="af_hover">
</a>
</div>
</a>
</div>

<div class="col-md-6 pdl50">
<a href="{{ route('agent-menu') }}">	
<div class="con-box">
<h4>Become an agent</h4>
<p>Join us on a Professionally Rewarding journey!</p>
<a class="con_btn" href="{{ route('agent-menu') }}">
<img src="{!! asset('assets/frontend/images/rectangle.png')  !!}" class="pre_hover">
<img src="{!! asset('assets/frontend/images/Rectangle_right.png')  !!}" class="af_hover">
</a>
</div>
</a>
</div>
</div>
</div>
</div>
<!-- </div> -->
</section>

</div>
<div class="abs_banner_img">
	<div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
	    <div class="carousel-inner">
	    	@php
               $k = 0;
	    	@endphp
	    	@foreach($smallSliders as $smallSlider)
	    	@php
               $k++;
	    	@endphp
		    <div class="carousel-item @if($k == 1) active @endif ">
		        <img alt="Lnxx introduction image" src="{!! asset($smallSlider->image)  !!}" class="img-responsive ">
		    </div>
		    @endforeach
	    </div>
			<!-- <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
			</a> -->
	</div>
</div>


</section>

<div class="logo_back">
<div class="container">
<div class="sec_banner_sec">
<div class="row">
<div class="col-md-6">
<div class="row">
<div class="col-md-4">
<div class="banner-one">
<h5>100K+</h5>
<p><img src="{!! asset('assets/frontend/images/download-icon.png')  !!}"> Download</p>
</div>
</div>
<div class="col-md-4">
<div class="banner-two">
<h5>15K+</h5>
<p><img src="{!! asset('assets/frontend/images/active_user.png')  !!}"> Active User</p>
</div>
</div>
<div class="col-md-4">
<div class="banner-three">
<h5>4.4</h5>
<p><img src="{!! asset('assets/frontend/images/star.png')  !!}"> App Rating</p>
</div>
</div>
</div>
</div>
<div class="col-md-6">
<img src="{!! asset('assets/frontend/images/lnxx-credit-cards-in-hands.png') !!}" class="img-responsive img_sec_pol">
<img src="{!! asset('assets/frontend/images/lnxx-dhriam-in-hands.png') !!}" class="img-responsive img_sec_card">
</div>
</div>
</div>
</div>

<section class="about_index" id="About">
<div class="container">	
<div class="row">	
<div class="col-md-5">	
<h3>Our Services</h3>
<div class="service-box">
	<div class="row">	
		@foreach($services as $service)
		<div class="col-md-6 mx-auto" style="text-align: center; margin-top: 10px;">	
			<img src="{!! asset($service->blue_icon)  !!}" style="max-height: 58px;" class="ser_img">
			<h4 style="margin-top: 10px;">{{ $service->name }}</h4>
		</div>
		@endforeach
	</div>
</div>

</div>
<div class="col-md-7">	
<h2>About</h2>
<h5>Lnxx - The next generation Digital Neobank!</h5> 
<p>Lnxx is a digital online financial services platform offering a holistic end-to-end one-stop full function relationship experience to its customers!</p>
<p>Offering simple and fast processes for a wide range of financial products and services across Corporate, SME, SMB, Self Employed and Individual Loans,  Credit Cards and Insurance), Lnxx provides an end to end model that is built on a data driven, analytics & AI based recommendation engine. </p>
<p>Lnxx’s online marketplace platform integrates with the financial institutions’ (FI) systems for real-time processing and online approvals to customers. Its online customer interface riding on the platform includes processing using demographic, social, behavioural and psychographic variables along with seamless origination, assessment and fulfilment for financial products on a real time mode for customers. It leverages technology & data together with advanced analytics for faster and more reliable decisioning.</p>
<a href="#">Learn More</a>
</div>
</div>
</div>
</section>
</div>

<section class="lorem_ipsum_index" style="display: none;">
<div class="container">	
<div class="row">	
<div class="col-md-5">	
<h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Amet sapien iaculis nunc auctor elementum. </h3>

</div>
<div class="col-md-7">
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
</div>
</div>
</div>
</section>

<section class="lorem_index" style="display: none;">
<div class="container">	
<div class="row">	
<div class="col-md-5">	
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Bibendum volutpat senectus id fusce congue. Nulla nunc integer mauris platea velit venenatis, euismod sed. Egestas duis aliquam pulvinar phasellus faucibus tempus. </p>

</div>
<div class="col-md-7">
<img src="{!! asset('assets/frontend/images/Card_ser.png')  !!}" class="img-responsive">
</div>
</div>
</div>
</section>

<section class="lnxx-partners" style="margin-top: 80px;">
<div class="container">
<h2>Our Partners</h2>   
<p>Great Partners, Great Products!</p>
<div class="row">
@foreach($banks as $bank)	
<div class="col-md-2">
<img src="{!! asset($bank->image)  !!}" class="img-responsive">
</div>
@endforeach
</div>
</div>
</section>

<section class="testimonials" style="border-top: 1px solid; margin-top: 75px;">
<div class="container"> 
<h2>Testimonials</h2>
<div class="testimonials-slider owl-theme owl-carousel">
@foreach($testimonials as $testimonial)	
<div class="item">
<div class="testimonials-slide">
<img src="{!! asset($testimonial->image)  !!}" class="img-responsive text-center"> 
<h4>{{ $testimonial->title }}</h4>
<p>{!! $testimonial->comment !!}</p>
</div>
</div>
@endforeach
</div>
</section>


@endsection
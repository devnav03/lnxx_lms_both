@extends('frontend.layouts.app')
@section('content')
@php   
$user_base = \Session::get('user_base');
if(empty($user_base)){
$user_base = 'Customer';
}
@endphp
@if($user_base == 'Customer')

<section class="slider">
	<div class="main-slider owl-theme owl-carousel">    
        @foreach($sliders as $slider)
		<div class="item">
		   @if(\Auth::check()) @if($slider->link) <a href="{{ $slider->link }}"> @else <a href="#">   @endif  @else  <a href="{{ route('sign-in') }}"> @endif <img src="{!! asset($slider->image)  !!}" alt="slider" class="img-responsive"> </a>
		</div>
        @endforeach 
	</div>
</section>  

<div class="logo_back">     
<section class="product-index">
<div class="container">
<h2><span>Bringing you the</span> our Products</h2>    
<div class="product-slider row owl-theme owl-carousel">
@foreach($services as $service)
<div class="col-md-12">
@if(\Auth::check())
<div class="item">
	<h3>{{ $service->name }}</h3>
	<img src="{!! asset($service->blue_icon) !!}" class="img-responsive">
</div>
@else
<a href="{{ route('sign-in') }}">
<div class="item">
	<h3>{{ $service->name }}</h3>
	<img src="{!! asset($service->blue_icon)  !!}" class="img-responsive">
</div>
</a>
@endif
</div>
@endforeach
</div>
</div>
</section>

<section class="lnxx-work">
<div class="container">
<h2>How does <span>lnxx</span> work?</h2>
<div class="row">
<div class="col-md-6">
<img src="{!! asset('assets/frontend/images/about_usimg.jpg')  !!}" class="img-responsive">
</div>
<div class="col-md-5">
<h3>New generation digital Neobank that integrates products/services from multiple providers, improving and simplifying customer experiences based on the insights using data.</h3>
<p>To be a leading financial services player that focuses on the needs of the resident UAE SME/Small Business and Consumer Mass Market/Mass Affluent population, including the migrant workforce, through an empowered platform that provides access to a host of financial services and related products for their best interest through an open architecture system by riding on the existing rail road provides by multiple banks, financial services institutions, ecommerce organizations, etc.<!--  both in UAE as well as through linkages with banks in respective home countries for additional products relevant to the ethnically diverse UAE population. --></p>
@if(\Auth::check())
<a href="{{ route('sign-in') }}">Get Started</a>
@else
<a href="#">Get Started</a>
@endif
</div>

</div>
</div>
</section>
</div>

<div class="logo_back"> 
<section class="lnxx-app">
<div class="container">
<div class="row">
<div class="col-md-6">
<h2>Get the Lnxx app</h2>
<h3>Get control of all your loan needs anywhere, anytime</h3>
<ul>
<li>Compare different bank policies</li>
<li>Apply your loan application</li>
<li>Track your loan application status on the go</li>
<li>Download your loan with a single tap</li>
</ul>
<p style="margin-bottom: 4px;">Download our app from</p>
<div class="row" style="margin-bottom: 30px;">
<div class="col-md-3">
<a href="#"><img src="{!! asset('assets/frontend/images/app_store.png')  !!}" class="img-responsive"></a>
</div>
<div class="col-md-3">
<a href="#"><img src="{!! asset('assets/frontend/images/google_play.png')  !!}" class="img-responsive"></a>
</div>
</div>

<div class="row">
<div class="col-md-3">
<img src="{!! asset('assets/frontend/images/found_qr_code.png')  !!}" alt="scan" class="img-responsive">
</div>
<div class="col-md-6">
   <h4>Download the Lnxx mobile app.</h4>
   <p class="app_des">Get exclusive offers & enjoy a seamless experience.</p>
</div>
</div>
</div>
<div class="col-md-6">
<img src="{!! asset('assets/frontend/images/lnxx_app.png')  !!}" class="img-responsive">
</div>
</div>
</div>
</section>
</div>

<section class="lnxx-partners">
<div class="container">
<h2>Our Partners</h2>   
<p>We collaborate with the biggest and best names in banking and<br> finance to bring you relevant items at competitive prices.</p>
<div class="row">
@foreach($banks as $bank)	
<div class="col-md-2">
<img src="{!! asset($bank->image)  !!}" class="img-responsive">
</div>
@endforeach

</div>
</div>
</section>

<div class="logo_back">
<section class="blog-articles">
<div class="container">
<h2>Blogs & Article</h2>
<div class="blog-slider row owl-theme owl-carousel">  
<div class="col-md-12">
<div class="row">
<div class="col-md-5">
<a href="#"><img src="{!! asset('assets/frontend/images/blog_dt.png')  !!}" class="img-responsive"></a>
</div>
<div class="col-md-7">
<h4>Article Headline</h4>
<p>Lorem ipsum dolor sitamet, consectetur adipiscing elit. Iaculis Lorem</p>
<a href="#">Read More <img src="{!! asset('assets/frontend/images/right_arrow.png')  !!}" class="img-responsive"> </a>
</div>
</div>
</div>
</div>
</div>
</section>
</section>


<section class="testimonials" style="border-top: 1px solid; margin-top: 75px;">
<div class="container"> 
    <h2>Testimonial</h2>
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
</div>

<section class="blog-articles" style="background: #EFF2F0; padding: 60px 0;">
<div class="container">
<h2>News & Article</h2>
<div class="blog-slider row owl-theme owl-carousel">  
<div class="col-md-12">
<div class="row">
<div class="col-md-5">
<a href="#"><img src="{!! asset('assets/frontend/images/blog_dt.png')  !!}" class="img-responsive"></a>
</div>
<div class="col-md-7">
<h4>Article Headline</h4>
<p>Lorem ipsum dolor sitamet, consectetur adipiscing elit. Iaculis Lorem</p>
<a href="#">Read More <img src="{!! asset('assets/frontend/images/right_arrow.png')  !!}" class="img-responsive"> </a>
</div>
</div>
</div>
</div>
</div>
</section>

@else

<section class="agent_banner">
<div class="container">	
<div class="row">
<div class="col-md-6">
<h2>Become a part of one of the UAE's leading general bank service providers.</h2>
<p>Our broad range of industry sectors</p>
<div class="row">	
		<div class="col-md-4">	
			<img src="{!! asset('assets/frontend/images/agent_pro.png')  !!}" class="ser_img">
			<h4>Lorem Ipsum</h4>
		</div>
		<div class="col-md-4">	
			<img src="{!! asset('assets/frontend/images/agent_pro.png')  !!}" class="ser_img">
			<h4>Lorem Ipsum</h4>
		</div>
		<div class="col-md-4">	
			<img src="{!! asset('assets/frontend/images/agent_pro.png')  !!}" class="ser_img">
			<h4>Lorem Ipsum</h4>
		</div>
		<div class="col-md-4">	
			<img src="{!! asset('assets/frontend/images/agent_pro.png')  !!}" class="ser_img">
			<h4>Lorem Ipsum</h4>
		</div>
		<div class="col-md-4">	
			<img src="{!! asset('assets/frontend/images/agent_pro.png')  !!}" class="ser_img">
			<h4>Lorem Ipsum</h4>
		</div>
		<div class="col-md-4">	
			<img src="{!! asset('assets/frontend/images/agent_pro.png')  !!}" class="ser_img">
			<h4>Lorem Ipsum</h4>
		</div>
	</div>
</div>
<div class="col-md-1"></div>
<div class="col-md-5">
<form method="post">
<div class="row">
<div class="col-md-3">
	<select name="salutation" class="form-control" required="true">
		<option value="Mr.">Mr.</option>
		<option value="Mrs.">Mrs.</option>
		<option value="Miss.">Miss</option>
		<option value="Dr.">Dr.</option>
		<option value="Prof.">Prof.</option>
		<option value="Rev.">Rev.</option>
		<option value="Other">Other</option>
	</select>
</div>
<div class="col-md-9">
	<div class="form-group">
		<input name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter your full name*" type="text" pattern="(?=^.{2,25}$)(?![.\n])(?=.*[a-zA-Z]).*$" required="true">
		@if($errors->has('name'))
			<span class="text-danger">{{$errors->first('name')}}</span>
		@endif
	</div>
</div>
<div class="col-md-12">
	<div class="form-group mob_input">
		<input name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter your email address*" type="email" required="true">
		<img src="{!! asset('assets/frontend/images/home_email.png')  !!}" class="input-img">
		@if($errors->has('email'))
			<span class="text-danger">{{$errors->first('email')}}</span>
		@endif
	</div>
</div>
<div class="col-md-12">
	<div class="form-group mob_input">
		<input name="date_of_birth" value="{{ old('date_of_birth') }}" onfocus="(this.type='date')" class="form-control" placeholder="Enter your DOB*" type="text" required="true">
		<img src="{!! asset('assets/frontend/images/dob.png')  !!}" class="input-img">
		@if($errors->has('date_of_birth'))
		    <span class="text-danger">{{$errors->first('date_of_birth')}}</span>
		@endif
	</div>
</div>
<div class="col-md-12">
<div class="form-group mob_input">
    <input name="mobile" class="form-control" value="{{ old('mobile') }}" placeholder="Enter your Mobile number*" type="number" required="true">
    <img src="{!! asset('assets/frontend/images/home_mob.png')  !!}" class="input-img">
    @if($errors->has('date_of_birth'))
		<span class="text-danger">{{$errors->first('date_of_birth')}}</span>
	@endif
</div>
</div>
<div class="col-md-12">
	<div class="form-group mob_input">
	    <p><input name="conditions" type="checkbox" required="true"> <span>By proceeding, you agree to the <a href="#">Terms and Conditions</a><span></p>
	</div>
</div>
<div class="col-md-12 text-center">
<button type="submit">Proceed</button>
</div>
</div>
</form>

</div>

</div>
</div>
</section>

<div class="logo_back">    
<section class="lnxx-work agent">
<div class="container">
<h2><span>Bringing you the</span> Best Products</h2>  
<div class="row">
<div class="col-md-6">
<img src="{!! asset('assets/frontend/images/about_usimg.jpg')  !!}" class="img-responsive">
</div>
<div class="col-md-5">
<h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit</h3>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
<a href="#">Get Started</a>
</div>

</div>
</div>
</section>

<section class="product-index agent">
<div class="container">
<h2>How does <span>lnxx</span> work?</h2> 
<div class="row">
<div class="col-md-4">
	<div class="loan-box">
		<div class="row">	
			<div class="col-md-9">	
			    <h3>Personal Loan</h3>
			</div>
			<div class="col-md-3">	
			    <img src="{!! asset('assets/frontend/images/demo_box.png')  !!}" class="img-responsive">
			</div>
		</div>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Iaculis in pellentesque amet in facilisi faucibus donec tincidunt.</p>
	</div>
</div>
<div class="col-md-4">
	<div class="loan-box">
		<div class="row">	
			<div class="col-md-9">	
			    <h3>Home Loan</h3>
			</div>
			<div class="col-md-3">	
			    <img src="{!! asset('assets/frontend/images/demo_box.png')  !!}" class="img-responsive">
			</div>
		</div>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Iaculis in pellentesque amet in facilisi faucibus donec tincidunt.</p>
	</div>
</div>
<div class="col-md-4">
	<div class="loan-box">
		<div class="row">	
			<div class="col-md-9">	
			    <h3>Credit Card</h3>
			</div>
			<div class="col-md-3">	
			    <img src="{!! asset('assets/frontend/images/demo_box.png')  !!}" class="img-responsive">
			</div>
		</div>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Iaculis in pellentesque amet in facilisi faucibus donec tincidunt.</p>
	</div>
</div>
<div class="col-md-4">
	<div class="loan-box">
		<div class="row">	
			<div class="col-md-9">	
			    <h3>Business Loan</h3>
			</div>
			<div class="col-md-3">	
			    <img src="{!! asset('assets/frontend/images/demo_box.png')  !!}" class="img-responsive">
			</div>
		</div>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Iaculis in pellentesque amet in facilisi faucibus donec tincidunt.</p>
	</div>
</div>
<div class="col-md-4">
	<div class="loan-box">
		<div class="row">	
			<div class="col-md-9">	
			    <h3>Property Loan</h3>
			</div>
			<div class="col-md-3">	
			    <img src="{!! asset('assets/frontend/images/demo_box.png')  !!}" class="img-responsive">
			</div>
		</div>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Iaculis in pellentesque amet in facilisi faucibus donec tincidunt.</p>
	</div>
</div>
<div class="col-md-4">
	<div class="loan-box">
		<div class="row">	
			<div class="col-md-9">	
			    <h3>Personal Loan</h3>
			</div>
			<div class="col-md-3">	
			    <img src="{!! asset('assets/frontend/images/demo_box.png')  !!}" class="img-responsive">
			</div>
		</div>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Iaculis in pellentesque amet in facilisi faucibus donec tincidunt.</p>
	</div>
</div>
</div>
</div>
</section>
<section class="lnxx_agent">
<div class="container">	
<div class="row">
<div class="col-md-6">
<h2>Who is the Lnxx agent ?</h2>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis morbi cras sed mi quis ut. Tincidunt fermentum at purus commodo lacus, at turpis integer. Aliquam viverra et dictum ac sit. Aenean nascetur dapibus cras mattis ut nam adipiscing congue. Odio lacinia dolor, sed quis urna amet. Facilisis gravida eu phasellus nunc massa quis cras iaculis. Facilisis faucibus eu sed aliquet euismod. Eu tempus, velit sed fusce pharetra. Nec nam posuere nunc, posuere lacus arcu lobortis.</p>
</div>
</div>
</div>
</section>
</div>

<section class="become_agent">
<div class="container"> 
<div class="row"> 	
<div class="col-md-6"> 	
<h2>Who can become an agent?</h2>

</div>
<div class="col-md-6"> 	
	<ul>
		<li>Chek if you have completed 18 years of age and above</li>
		<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
		<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
		<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
		<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
		<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
	</ul>
</div>
</div>

<div class="row"> 	
<div class="col-md-4">
	<div class="agent_box">
		<img src="{!! asset('assets/frontend/images/profile.png')  !!}" class="img-responsive text-center">
		<h4>Name</h4>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nisi quisque leo mi nibh. Fermentum turpis id nullam arcu, massa dignissim dis felis, dictum. Tristique sagittis lobortis neque iaculis pellentesque sagittis, pellentesque amet a. At aliquet vel nibh id gravida natoque tempor. Eget tristique sem nunc, velit magna sed. Pellentesque tellus tortor massa sem elit.</p>
	</div>
</div>
<div class="col-md-4">
	<div class="agent_box">
		<img src="{!! asset('assets/frontend/images/profile.png')  !!}" class="img-responsive text-center">
		<h4>Name</h4>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nisi quisque leo mi nibh. Fermentum turpis id nullam arcu, massa dignissim dis felis, dictum. Tristique sagittis lobortis neque iaculis pellentesque sagittis, pellentesque amet a. At aliquet vel nibh id gravida natoque tempor. Eget tristique sem nunc, velit magna sed. Pellentesque tellus tortor massa sem elit.</p>
	</div>
</div>
<div class="col-md-4">
	<div class="agent_box">
		<img src="{!! asset('assets/frontend/images/profile.png')  !!}" class="img-responsive text-center">
		<h4>Name</h4>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nisi quisque leo mi nibh. Fermentum turpis id nullam arcu, massa dignissim dis felis, dictum. Tristique sagittis lobortis neque iaculis pellentesque sagittis, pellentesque amet a. At aliquet vel nibh id gravida natoque tempor. Eget tristique sem nunc, velit magna sed. Pellentesque tellus tortor massa sem elit.</p>
	</div>
</div>
</div>


</div>
</section>


<div class="logo_back">
<section class="testimonials" style="margin-top: 20px;">
<div class="container"> 
<h2>Testimonial</h2>
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
</div>
</section>


<section class="blog-articles" style="background: #EFF2F0; padding: 60px 0;">
<div class="container">
<h2>News & Article</h2>
<div class="blog-slider row owl-theme owl-carousel">  
<div class="col-md-12">
<div class="row">
<div class="col-md-5">
<a href="#"><img src="{!! asset('assets/frontend/images/blog_dt.png')  !!}" class="img-responsive"></a>
</div>
<div class="col-md-7">
<h4>Article Headline</h4>
<p>Lorem ipsum dolor sitamet, consectetur adipiscing elit. Iaculis Lorem</p>
<a href="#">Read More <img src="{!! asset('assets/frontend/images/right_arrow.png')  !!}" class="img-responsive"> </a>
</div>
</div>
</div>
</div>
</div>
</section>
</div>
@endif


@endsection
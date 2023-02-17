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
<!-- <h5>Offering you our best products from top UAE's banks</h5>    --> 
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
<a id="abouttag"></a>
<section class="lnxx-work">
<div class="container">
<h2>About <span>lnxx</span></h2>
<div class="row">
<div class="col-md-6">
<img src="{!! asset('assets/frontend/images/about_usimg.jpg')  !!}" class="img-responsive">
</div>
<div class="col-md-5">
<h3>Lnxx - Your digital banking partner for Life!</h3>
<p>Come with us on a journey of options and opportunities! Lnxx offers you simple and fast processes for a wide range of financial products and services. Whether you are a salaried individual, a large corporate or a small business we get you the best products, serving you with an end to end model that is built on a data driven, analytics & AI based technology platform! </p>
@if(\Auth::check())
<a href="{{ route('sign-in') }}">Get Started</a>
@else
<a href="sign-in">Get Started</a>
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
<h2>Get the lnxx app</h2>
<h3>Get control of your financing needs - anywhere and anytime!</h3>
<ul>
<li>Latest Offers</li>
<li>Seamless application process</li>
<li>Track your application on the go</li>
<li>Refer and earn!</li>
</ul>
<p style="margin-bottom: 4px;">Download lnxx app from</p>
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
   <h4>Download the lnxx mobile app.</h4>
   <p class="app_des">Options & Opportunities!</p>
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

<div class="logo_back">
<section class="blog-articles">
<div class="container">
<h2>Blogs & Articles</h2>
<div class="blog-slider row owl-theme owl-carousel"> 
@foreach($blogs_articles as $blogs_article)
<div class="col-md-12">
	<div class="col-img" style="max-height: 125px;overflow: hidden;">
	<a href="{{ route('article', $blogs_article->url) }}"><img src="{!! asset($blogs_article->image)  !!}" class="img-responsive"></a>
	</div>
	<div class="col-con" style="margin-top: 20px;">
	<h4 style="font-weight: 600;font-size: 14px;line-height: 20px;margin-bottom: 5px;">{{ \Illuminate\Support\Str::limit($blogs_article->title ?? '',35,' ...') }}</h4>
	<p>{{ $blogs_article->short_description }}</p>
	<a style="color: #5EB495;" href="{{ route('article', $blogs_article->url) }}">Read More <img src="{!! asset('assets/frontend/images/right_arrow.png')  !!}" style="width: 20px;display: inline; margin-left: 4px;" class="img-responsive"> </a>
	</div>	
</div>
@endforeach
</div>
</div>
</section>
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
</div>

<section class="blog-articles" style="background: #EFF2F0; padding: 60px 0;">
<div class="container">
<h2>News & Articles</h2>
<div class="blog-slider row owl-theme owl-carousel">  
@foreach($news_articles as $news_article)
<div class="col-md-12">
<div class="col-img" style="max-height: 125px;overflow: hidden;">
<a href="{{ route('article', $blogs_article->url) }}"><img src="{!! asset($news_article->image)  !!}" class="img-responsive"></a>
</div>
<div class="col-con" style="margin-top: 20px;">
<h4>{{ \Illuminate\Support\Str::limit($news_article->title ?? '',35,' ...') }}</h4>
<p>{{ $blogs_article->short_description }}</p>
<a style="color: #5EB495;" href="{{ route('article', $blogs_article->url) }}">Read More <img src="{!! asset('assets/frontend/images/right_arrow.png')  !!}" style="width: 20px;display: inline; margin-left: 4px;" class="img-responsive"> </a>
</div>
</div>
@endforeach
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
@if(session()->has('resume_submit'))
<img src="{!! asset('assets/frontend/images/agent_check.png')  !!}" style="margin: 0 auto; display: block; width: 100px;margin-top: 50px;">
<h5 style="line-height: 40px; font-weight: 700; font-size: 22px; margin-top: 20px; color: #fff; text-align: center;">Your job application has been received successfully. Thank you for applying!</h5>
@else
<form method="post" enctype="multipart/form-data" action="{{ route('agent-apply') }}">
{{ csrf_field() }} 	
<!-- <h3 style="text-align: center;color: #fff;font-weight: 800; margin-bottom: 20px;">Agent Information Form</h3> -->

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
		<input name="first_name" class="form-control" value="{{ old('first_name') }}" placeholder="First Name*" type="text" pattern="(?=^.{2,25}$)(?![.\n])(?=.*[a-zA-Z]).*$" required="true">
		@if($errors->has('first_name'))
			<span class="text-danger">{{$errors->first('first_name')}}</span>
		@endif
	</div>
</div>
<div class="col-md-6">
	<div class="form-group mob_input">
		<input name="middle_name" class="form-control" value="{{ old('middle_name') }}" placeholder="Middle Name" type="text" pattern="(?=^.{2,25}$)(?![.\n])(?=.*[a-zA-Z]).*$">
		@if($errors->has('middle_name'))
			<span class="text-danger">{{$errors->first('middle_name')}}</span>
		@endif
	</div>
</div>
<div class="col-md-6">
	<div class="form-group mob_input">
		<input name="last_name" class="form-control" value="{{ old('last_name') }}" placeholder="Last Name*" type="text" pattern="(?=^.{2,25}$)(?![.\n])(?=.*[a-zA-Z]).*$" required="true">
		@if($errors->has('last_name'))
			<span class="text-danger">{{$errors->first('last_name')}}</span>
		@endif
	</div>
</div>
<div class="col-md-12">
	<div class="form-group mob_input">
		<input name="email" class="form-control" value="{{ old('email') }}" placeholder="Email*" type="email" required="true">
		<!-- <img src="{!! asset('assets/frontend/images/home_email.png')  !!}" class="input-img"> -->
		@if($errors->has('email'))
			<span class="text-danger">{{$errors->first('email')}}</span>
		@endif
	</div>
</div>
<div class="col-md-12">
	<div class="form-group mob_input">
	    <input name="mobile" class="form-control" value="{{ old('mobile') }}" placeholder="Mobile*" type="number" required="true">
	    <!-- <img src="{!! asset('assets/frontend/images/home_mob.png')  !!}" class="input-img"> -->
	    @if($errors->has('mobile'))
			<span class="text-danger">{{$errors->first('mobile')}}</span>
		@endif
	</div>
</div>
<div class="col-md-12">
	<div class="form-group mob_input">
		<input name="date_of_birth" readonly="readonly" value="{{ old('date_of_birth') }}" id="my_date_picker_dob" class="form-control" placeholder="DOB*" type="text" required="true">
		@if($errors->has('date_of_birth'))
		    <span class="text-danger">{{$errors->first('date_of_birth')}}</span>
		@endif
	</div>
</div>
<!-- <div class="col-md-6">
    <select name="gender" class="form-control" required="true">
	    <option value="">Select Gender*</option>	
	    <option value="Male">Male</option>
	    <option value="Female">Female</option>
	    <option value="Other">Other</option>
    </select>
    @if($errors->has('gender'))
    <span class="text-danger">{{$errors->first('gender')}}</span>
    @endif
</div> -->
<!-- <div class="col-md-12">
    <div class="form-group">
      <select name="nationality" onChange="ChangeCountry(this);" class="form-control" required="true">
        <option value="">Select Nationality*</option>
        @foreach($countries as $country)
          <option value="{{ $country->id }}">{{ $country->country_name }}</option>
        @endforeach
      </select>
      @if($errors->has('nationality'))
      <span class="text-danger">{{$errors->first('nationality')}}</span>
      @endif
    </div>
</div> -->
<!-- <div class="col-md-6">
	<div class="form-group mob_input">
		<input name="passport_number" value="{{ old('passport_number') }}" class="form-control" placeholder="Passport Number*" type="text" required="true">
		@if($errors->has('passport_number'))
		    <span class="text-danger">{{$errors->first('passport_number')}}</span>
		@endif
	</div>
</div> -->
<!-- <div class="col-md-6">
	<div class="form-group mob_input">
		<input name="passport_expiry_date" value="{{ old('passport_expiry_date') }}" id="my_date_picker" class="form-control" placeholder="Passport Expiry Date*" type="text" readonly="readonly" required="true">
		@if($errors->has('passport_expiry_date'))
		    <span class="text-danger">{{$errors->first('passport_expiry_date')}}</span>
		@endif
	</div>
</div> -->
<!-- <div class="col-md-6">
	<div class="form-group mob_input">
		<input name="emirates_id_number" value="{{ old('emirates_id_number') }}" pattern="\d*" maxlength="15" minlength="15" class="form-control" placeholder="Emirates ID Number*" type="text" required="true">
		@if($errors->has('emirates_id_number'))
		    <span class="text-danger">{{$errors->first('emirates_id_number')}}</span>
		@endif
	</div>
</div> -->
<!-- <div class="col-md-6">
	<div class="form-group mob_input">
		<input name="emirates_expire_date" value="{{ old('emirates_expire_date') }}" id="emirates_expire_date" readonly="readonly" class="form-control" placeholder="Emirates ID Expire Date*" type="text" required="true">
		@if($errors->has('emirates_expire_date'))
		    <span class="text-danger">{{$errors->first('emirates_expire_date')}}</span>
		@endif
	</div>
</div> -->



<div class="col-md-12">
	<div class="form-group mob_input">
		<label style="width:100%; font-size: 13px; color: #fff; margin-bottom: 0px;">Attach Your Resume*</label>
		<input name="resume" type="file" accept="image/png, image/jpg, image/jpeg, application/pdf, .doc, .docx" required="true">
		@if($errors->has('resume'))
		    <span class="text-danger">{{$errors->first('resume')}}</span>
		@endif
	</div>
</div>
<div class="col-md-12">
	<div class="form-group mob_input">
	<label><input style="float: left;width: 19px; height: 19px; margin-right: 10px;" name="conditions" type="checkbox" required="true"> <span>By proceeding, you agree to the <a href="#">Terms and Conditions</a><span></label>
	</div>
</div>
<div class="col-md-12 text-center">
    <button type="submit">Proceed</button>
</div>

</div>
	
<!-- <div class="col-md-6">
	<div class="form-group mob_input">
		<select name="education" class="form-control" required="true">
			<option value="">Highest Level Of Education*</option>	
			<option value="10th">10th</option>
			<option value="12th">12th</option>
			<option value="Graduation">Graduation</option>
			<option value="Post Graduation">Post Graduation</option>
			<option value="Diploma / Certifications">Diploma / Certifications</option>
			<option value="Doctorate">Doctorate</option>
		</select>
		@if($errors->has('education'))
		    <span class="text-danger">{{$errors->first('education')}}</span>
		@endif
	</div>
</div> -->

<!-- <div class="col-md-6">
	<div class="form-group mob_input">
		<input name="collage_name" value="{{ old('collage_name') }}" class="form-control" placeholder="Name of Collage / Institution / University*" type="text" required="true">
		@if($errors->has('collage_name'))
		    <span class="text-danger">{{$errors->first('collage_name')}}</span>
		@endif
	</div>
</div> -->

<!-- <div class="col-md-6">
	<div class="form-group mob_input">
		<select name="country_studied_in" class="form-control" required="true">
        <option value="">Country Studied In*</option>
        @foreach($countries as $country)
          <option value="{{ $country->id }}">{{ $country->country_name }}</option>
        @endforeach
      </select>
		@if($errors->has('country_studied_in'))
		    <span class="text-danger">{{$errors->first('country_studied_in')}}</span>
		@endif
	</div>
</div> -->
<!-- <div class="col-md-6">
	<div class="form-group mob_input">
		<input name="percentage_cgpa" value="{{ old('percentage_cgpa') }}" maxlength="5" class="form-control" placeholder="Percentage / CGP*" type="text" required="true">
		@if($errors->has('percentage_cgpa'))
		    <span class="text-danger">{{$errors->first('percentage_cgpa')}}</span>
		@endif
	</div>
</div> -->
<!-- <div class="col-md-6">
	<div class="form-group mob_input">
		<input name="course_completion_date" value="{{ old('course_completion_date') }}" id="date_of_joining" class="form-control" placeholder="Course Date Completion Date*" type="text" readonly="readonly" required="true">
		@if($errors->has('course_completion_date'))
		    <span class="text-danger">{{$errors->first('course_completion_date')}}</span>
		@endif
	</div>
</div> -->
<!-- <div class="col-md-6">
	<div class="form-group mob_input">
		<input name="diploma_certifications" value="{{ old('diploma_certifications') }}" class="form-control" placeholder="Diploma / Certifications*" type="text" required="true">
		@if($errors->has('diploma_certifications'))
		    <span class="text-danger">{{$errors->first('diploma_certifications')}}</span>
		@endif
	</div>
</div> -->

<!-- <div class="col-md-6">
	<div class="form-group mob_input">
		<select name="duration_of_course" class="form-control" required="true">
			<option value="">Duration of Course ( in Years)*</option>	
			<option value="6 Months">6 Months</option>
			<option value="1 Year">1 Year</option>
			<option value="2 Years">2 Years</option>
			<option value="3 Years">3 Years</option>
			<option value="4 Years">4 Years</option>
			<option value="5 Years">5 Years</option>
		</select>
		@if($errors->has('duration_of_course'))
		    <span class="text-danger">{{$errors->first('duration_of_course')}}</span>
		@endif
	</div>
</div> -->
<!-- 
<div class="col-md-6">
	<div class="form-group mob_input">
		<label style="font-size: 13px; color: #fff; margin-bottom: 0px;">Upload Education Document*</label>
		<input name="education_document" accept="image/png, image/jpg, image/jpeg, application/pdf" type="file" required="true">
		@if($errors->has('education_document'))
		    <span class="text-danger">{{$errors->first('education_document')}}</span>
		@endif
	</div>
</div> -->

<!-- <div class="col-md-6">
	<div class="form-group mob_input">
		<input name="current_position" value="{{ old('current_position') }}" class="form-control" placeholder="Current Position" type="text">
		@if($errors->has('current_position'))
		    <span class="text-danger">{{$errors->first('current_position')}}</span>
		@endif
	</div>
</div>

<div class="col-md-6">
	<div class="form-group mob_input">
		<input name="current_employer_name" value="{{ old('current_employer_name') }}" class="form-control" placeholder="Current Employer Name" type="text">
		@if($errors->has('current_employer_name'))
		    <span class="text-danger">{{$errors->first('current_employer_name')}}</span>
		@endif
	</div>
</div> -->
<!-- <div class="col-md-6">
	<div class="form-group mob_input">
		<input name="notice_period" value="{{ old('notice_period') }}" class="form-control" placeholder="Notice Period" type="text">
		@if($errors->has('notice_period'))
		    <span class="text-danger">{{$errors->first('notice_period')}}</span>
		@endif
	</div>
</div>
<div class="col-md-6">
	<div class="form-group mob_input">
		<input name="current_salary" value="{{ old('current_salary') }}" pattern="\d*" maxlength="6" class="form-control" placeholder="Current Salary (In AED)" type="text">
		@if($errors->has('current_salary'))
		    <span class="text-danger">{{$errors->first('current_salary')}}</span>
		@endif
	</div>
</div> -->
<!-- <div class="col-md-6">
	<div class="form-group mob_input">
		<input name="expected_salary" value="{{ old('expected_salary') }}" pattern="\d*" maxlength="6" class="form-control" required="true" placeholder="Expected Salary (In AED)*" type="text">
		@if($errors->has('expected_salary'))
		    <span class="text-danger">{{$errors->first('expected_salary')}}</span>
		@endif
	</div>
</div> -->



<!-- <div class="col-md-6"> </div> -->
</form>
@endif
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
<h2>Who is the lnxx agent ?</h2>
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
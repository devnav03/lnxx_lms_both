@php
    $route  = \Route::currentRouteName();    
@endphp
  
<section class="header">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="logo">
          <a href="#"><img src="{!! asset('assets/frontend/images/lnxx_logo.svg')  !!}" alt="logo" class="img-responsive"> </a>
        </div>
      </div>
      <div class="col-md-9">
        <ul>
          <li><a href="{{ route('home') }}">Home</a></li>
          <li><a href="#About">About</a></li>
          <li><a href="#">Products</a></li>
          <li><a href="#">App Reviews</a></li>
          <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
          @if(\Auth::check())
           @if((\Auth::user()->user_type) == 2)
              <li class="user-menu"><a style="color: #929292 !important;" href="{{ route('my-profile') }}">Welcome, {{ \Auth::user()->name }} <img src="{!! asset('assets/frontend/images/user_white_icon.png')  !!}"> </a>
              <ul class="sub-menu">
                <li><a href="{{ route('user-dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('my-profile') }}">Profile</a></li>
                <li><a href="{{ route('user-logout') }}">Sign out</a></li>
              </ul>
              </li>
            @endif
          @else
          <li><a href="#">Sign In</a>
            <ul class="sub-menu">
              <li><a href="{{ route('sign-in') }}">Customer</a>
              <li><a href="#">Agent</a>
            </ul>
          </li>
          @endif

          <li><a href="#"><img src="{!! asset('assets/frontend/images/download.png')  !!}" alt="download" class="img-responsive"></a></li>
        </ul>
        <span style="font-size:30px;cursor:pointer" class="openNavbtn" onclick="openNav()">&#9776;</span>
        <div id="mySidenav" class="sidenav">
          <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
          <a href="{{ route('home') }}">Home</a>
          <a href="#About">About</a>
          <a href="#">Products</a>
          <a href="#">App Reviews</a>
          <a href="{{ route('contact-us') }}">Contact Us</a>
          <a href="{{ route('sign-in') }}">Sign In</a>
        </div>


      </div>
    </div>
  </div>
</section>








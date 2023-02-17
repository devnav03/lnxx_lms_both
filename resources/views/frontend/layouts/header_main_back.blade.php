@php
$route  = \Route::currentRouteName();    
$user_base = \Session::get('user_base');
if(empty($user_base)){
$user_base = 'Customer';
}
@endphp

@if($route == 'user-dashboard' || $route == 'personal-details' || $route == 'cm-details' || $route == 'product-requested' || $route == 'address-details' || $route ==  'select-services' || $route == 'thank-you' || $route == 'record-video' || $route == 'consent-approval' || $route == 'preference' || $route == 'consent') 

<header class="header dashboard-header">
  <div class="container">
    <div class="row">
      <div class="col-md-1"> 
        <div class="logo-main">
          <a href="{{ route('home') }}"><img src="{!! asset('assets/frontend/images/white_logo.png')  !!}" alt="logo" class="img-responsive"> </a>
        </div> 
      </div>
      <div class="col-md-6">
   <!--      <ul class="left_menu">
          <li><a href="#">About Us</a></li>
          <li><a href="#">Products</a></li>
          @if($user_base == 'Agent')
          <li><a href="#">Career</a></li>
          @endif
          <li><a href="#">Reach Us</a></li>
        </ul> -->
      </div>
      <div class="col-md-5">
        <ul class="right_login">
          <!-- <li><a href="#">English <img src="{!! asset('assets/frontend/images/dropdown.png') !!}"></a></li> -->
        @if(\Auth::check())
            @if((\Auth::user()->user_type) == 2)
              <li class="user-menu"><a href="{{ route('my-profile') }}">Welcome, {{ \Auth::user()->name }} <img src="{!! asset('assets/frontend/images/user_white_icon.png')  !!}"> </a>
              <ul class="sub-menu">
                <li><a href="{{ route('user-dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('my-profile') }}">Profile</a></li>
                <li><a href="{{ route('user-logout') }}">Sign out</a></li>
              </ul>
              </li>
            @endif
        @else
          @if($user_base == 'Customer')
          <li><a href="{{ route('sign-in') }}">Sign In</a></li>
          <li><a href="{{ route('agent-menu') }}">Agent <img src="{!! asset('assets/frontend/images/agent_icon.png')  !!}" style="width: 13px; margin-left: 5px;"></a></li>
          @else
           <li><a href="{{ route('sign-in') }}">Sign In</a></li>
          <li><a href="{{ route('customer-menu') }}">Customer <img src="{!! asset('assets/frontend/images/agent_icon.png')  !!}" style="width: 13px; margin-left: 5px;"></a></li>
          @endif
        @endif
        </ul>
      </div>
    </div>
  </div>
</header>


@else

<header class="header @if($user_base == 'Agent') agent_header @endif @if($route == 'my-profile') agent_header @endif">
  <div class="container">
    <div class="row">
      <div class="col-md-1"> 
        <div class="logo-main">
          <a href="{{ route('home') }}"><img src="{!! asset('assets/frontend/images/lnxx_logo.png')  !!}" alt="logo" class="img-responsive"> </a>
        </div> 
        <span style="font-size:30px;cursor:pointer" class="openNavbtn" onclick="openNav()">&#9776;</span>
        <div id="mySidenav" class="sidenav">
          <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
          <a href="#About">About</a>
          <a href="#">Products</a>
          @if($user_base == 'Agent')
          <a href="#">Career</a>
          @endif
          <a href="{{ route('contact-us') }}">Contact Us</a>
     
          @if(\Auth::check())
            @if((\Auth::user()->user_type) == 2)
              <!-- <li class="user-menu"><a href="{{ route('my-profile') }}"> {{ \Auth::user()->name }}</a> -->
             <!--  <ul class="sub-menu"> -->
              <a href="{{ route('user-dashboard') }}">Dashboard</a>
              <a href="{{ route('my-profile') }}">Profile</a>
              <a href="{{ route('user-logout') }}">Sign out</a>
              <!-- </ul>
              </li> -->
            @endif
        @else
          @if($user_base == 'Customer')
          <li><a href="{{ route('sign-in') }}">Sign In</a></li>
          <li><a href="{{ route('agent-menu') }}">Agent <img src="{!! asset('assets/frontend/images/agent_icon.png')  !!}" style="width: 13px; margin-left: 5px;"></a></li>
          @else
           <li><a href="{{ route('sign-in') }}">Sign In</a></li>
          <li><a href="{{ route('customer-menu') }}">Customer <img src="{!! asset('assets/frontend/images/agent_icon.png')  !!}" style="width: 13px; margin-left: 5px;"></a></li>
          @endif
        @endif




        </div>
      </div>
      <div class="col-md-6">
        <ul class="left_menu">
          <li><a href="#">About Us</a></li>
          <li><a href="#">Products</a></li>
          @if($user_base == 'Agent')
          <li><a href="#">Career</a></li>
          @endif
          <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
        </ul>
      </div>
      <div class="col-md-5">
        <ul class="right_login">
          <li><a href="#">English <img src="{!! asset('assets/frontend/images/dropdown.png') !!}"></a></li>
        @if(\Auth::check())
            @if((\Auth::user()->user_type) == 2)
              <li class="user-menu"><a href="{{ route('my-profile') }}"><img src="{!! asset('assets/frontend/images/login_icon.png')  !!}"> {{ \Auth::user()->name }}</a>
              <ul class="sub-menu">
                <li><a href="{{ route('user-dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('my-profile') }}">Profile</a></li>
                <li><a href="{{ route('user-logout') }}">Sign out</a></li>
              </ul>
              </li>
            @endif
        @else
          @if($user_base == 'Customer')
          <li><a href="{{ route('sign-in') }}">Sign In</a></li>
          <li><a href="{{ route('agent-menu') }}">Agent <img src="{!! asset('assets/frontend/images/agent_icon.png')  !!}" style="width: 13px; margin-left: 5px;"></a></li>
          @else
           <li><a href="{{ route('sign-in') }}">Sign In</a></li>
          <li><a href="{{ route('customer-menu') }}">Customer <img src="{!! asset('assets/frontend/images/agent_icon.png')  !!}" style="width: 13px; margin-left: 5px;"></a></li>
          @endif
        @endif
        </ul>
      </div>
    </div>
  </div>
</header>

@endif 







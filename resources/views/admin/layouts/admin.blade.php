<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>

		<meta charset="utf-8"> 
		<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
		<meta name="description" content="{{ config('app.name', 'Dashboard') }} - ">
		<meta name="author" content="{{ config('app.name', 'Dashboard') }}">
		<meta name="keywords" content="">
		<!-- Favicon -->
		<link rel="icon" href="{{ asset('img/favicon.png')}}" type="image/x-icon"/>
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Dashboard') }}</title>
		<!-- Bootstrap css-->
		<link  id="style" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"/>
		<!-- Icons css-->
		<link href="{{ asset('plugins/web-fonts/icons.css') }}" rel="stylesheet"/>
		<link href="{{ asset('plugins/web-fonts/font-awesome/font-awesome.min.css') }}" rel="stylesheet">
		<link href="{{ asset('plugins/web-fonts/plugin.css') }}" rel="stylesheet"/>
		<!-- Style css-->
		<link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <!-- Select2 css-->
        <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet">
        <!-- Mutipleselect css-->
        <link rel="stylesheet" href="{{ asset('plugins/multipleselect/multiple-select.css') }}">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
        <!-- Internal Daterangepicker css-->
        <link href="{{asset('plugins/bootstrap-daterangepicker/daterangepicker.css')}}">
        <!-- Internal TelephoneInput css-->
        <link rel="stylesheet" href="{{asset('plugins/telephoneinput/telephoneinput.css')}}">
        <!-- <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/daterangepicker/daterangepicker.css"> -->


        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <style>
select.minimal {
background-image:
  linear-gradient(45deg, transparent 50%, gray 50%),
  linear-gradient(135deg, gray 50%, transparent 50%),
  linear-gradient(to right, #ccc, #ccc);
background-position:
  calc(100% - 20px) calc(1em + 2px),
  calc(100% - 15px) calc(1em + 2px),
  calc(100% - 2.5em) 0.5em;
background-size:
  5px 5px,
  5px 5px,
  1px 1.5em;
background-repeat: no-repeat;
}
</style>

	</head>

	<body class="ltr main-body leftmenu">
         <!-- jquery -->
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <!-- toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

<!-- Loader -->
<div id="global-loader">
    <img src="{{ asset(config('app.images.loader'))}}" class="loader-img" alt="Loader">
</div>
<!-- End Loader -->


<!-- Page -->
<div class="page">
    <!-- Main Header-->
    <div class="main-header side-header sticky">
        <div class="main-container container-fluid">
            <div class="main-header-left">
                <a class="main-header-menu-icon" href="javascript:void(0)" id="mainSidebarToggle"><span></span></a>
                <div class="hor-logo">
                    <a class="main-logo" href="index.html">
                        <img src="{{ asset('img/lnxx_logo.png')}}" class="header-brand-img desktop-logo" alt="logo">
                        <img src="{{ asset('img/lnxx_logo.png')}}" class="header-brand-img desktop-logo-dark" alt="logo">
                    </a>
                </div>
            </div>
     
            <div class="main-header-right">
                <button class="navbar-toggler navresponsive-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i>
                </button>
                <div
                    class="navbar navbar-expand-lg  nav nav-item  navbar-nav-right responsive-navbar navbar-dark  ">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                        <div class="d-flex order-lg-2 ms-auto">
                            <!-- Search -->
                            <div class="dropdown header-search">
                                <a class="nav-link icon header-search">
                                    <i class="fe fe-search header-icons"></i>
                                </a>
                                <div class="dropdown-menu">
                                    <div class="main-form-search p-2">
                                        <div class="input-group">
                                            <div class="input-group-btn search-panel">
                                                <select class="form-control select2">
                                                    <option label="All categories">
                                                    </option>
                                                    <option value="IT Projects">
                                                        IT Projects
                                                    </option>
                                                    <option value="Business Case">
                                                        Business Case
                                                    </option>
                                                    <option value="Microsoft Project">
                                                        Microsoft Project
                                                    </option>
                                                    <option value="Risk Management">
                                                        Risk Management
                                                    </option>
                                                    <option value="Team Building">
                                                        Team Building
                                                    </option>
                                                </select>
                                            </div>
                                            <input type="search" class="form-control"
                                                placeholder="Search for anything...">
                                            <button class="btn search-btn"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" class="feather feather-search">
                                                    <circle cx="11" cy="11" r="8"></circle>
                                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                                </svg></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="dropdown ">
                                <a class="nav-link icon full-screen-link">
                                    <i class="fe fe-maximize fullscreen-button fullscreen header-icons"></i>
                                    <i class="fe fe-minimize fullscreen-button exit-fullscreen header-icons"></i>
                                </a>
                            </div>
                            <!-- Full screen -->
                            <!-- Notification -->
                            <?php $cDate = \DB::SELECT("SELECT count(id) as note_count FROM `leads` where f_date > (NOW() - interval 3 day) OR f_date > (NOW() + interval 3 day) OR f_date = (NOW())")[0]->note_count; ?>
                            <?php $get_note_data = DB::SELECT("SELECT * FROM `leads` where f_date > (NOW() - interval 3 day) OR f_date > (NOW() + interval 3 day) OR f_date = (NOW())"); ?>
                            @if($cDate > 0)
                            <div class="dropdown main-header-notification">
                                <a class="nav-link icon" href="">
                                    <i class="fe fe-bell header-icons"></i>
                                    <span class="badge bg-danger nav-link-badge">{{$cDate}}</span>
                                </a>
                               <div class="dropdown-menu">

                                    <div class="main-notification-list">
                                        @foreach($get_note_data as $get_note_data)
                                        <div class="media new">
                                            <div class="media-body">
                                                <p>Follow Up<strong> {{$get_note_data->name}} </strong> for {{$get_note_data->product}} </p>
                                                <span>{{$get_note_data->f_date}} </span>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="dropdown-footer">
                                        <a href="javascript:void(0)">View All Notifications</a>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <!-- Notification -->
                            <!-- Messages -->
                          <!--   <div class="main-header-notification">
                                <a class="nav-link icon" href="chat.html">
                                    <i class="fe fe-message-square header-icons"></i>
                                    <span class="badge bg-success nav-link-badge">6</span>
                                </a>
                            </div> -->
                            <!-- Messages -->
                            <!-- Profile -->
                            <div class="dropdown main-profile-menu">
                                <a class="d-flex" href="javascript:void(0)">
                                    <span class="main-img-user"><img alt="avatar"
                                            src="{{ asset(config('app.images.profile'))}}"></span>
                                </a>
                                <div class="dropdown-menu">
                                    <div class="header-navheading">
                                        <h6 class="main-notification-title">{{ Auth::user()->name }}</h6>
                        
                                    </div>
                          
                                    <a class="dropdown-item" href="{!! route('setting.manage-account') !!}">
                                        <i class="fe fe-settings"></i> Change Password </a>
                                   <!--  <a class="dropdown-item" href="profile.html">
                                        <i class="fe fe-compass"></i> Activity
                                    </a> -->
                                    <a class="dropdown-item" href="{{ route('logout-admin') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fe fe-power"></i> Sign Out
                                    </a>
                                    <form id="logout-form" action="{{ route('logout-admin') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                      
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Header-->

    <!-- Sidemenu -->
        @include('admin.layouts.togelsidebar')
    <!-- End Sidemenu -->

    <!-- Main Content-->
    <div class="main-content side-content pt-0">

        <div class="main-container container-fluid">
            <div class="inner-body">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- End Main Content-->

    <!-- Main Footer-->
    <div class="main-footer text-center noPrint">
        <div class="container">
            <div class="row row-sm">
                <div class="col-md-12">
                    <span>Copyright © 2022 <a href="javascript:void(0)">{{ config('app.name', 'Dashboard') }}</a>.  Designed by <a href="#">Samtech Infonet</a>  All rights reserved.</span>
                </div>
            </div>
        </div>
    </div>
    <!--End Footer-->

    <!-- Sidebar -->
        @include('admin.layouts.sidebar')
    <!-- End Sidebar -->

</div>
<!-- End Page -->
		<!-- Back-to-top -->
        <a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>
        <script src="{{ asset('js/jquery2.0.3.min.js') }}"></script> 
        <script src="{{ asset('js/skycons.js') }}"></script>
        <script src="{{ asset('js/raphael-min.js') }}"></script>
        <script src="{{ asset('js/morris.js') }}"></script>

        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap js-->
        <script src="{{ asset('plugins/bootstrap/js/popper.min.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
        <!-- Internal Chart.Bundle js-->
        <script src="{{ asset('plugins/chart.js/Chart.bundle.min.js') }}"></script>
        <!-- Peity js-->
        <script src="{{ asset('plugins/peity/jquery.peity.min.js') }}"></script>
        <!-- Select2 js-->
        <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
        <script src="{{ asset('js/select2.js') }}"></script>
        <!-- Perfect-scrollbar js -->
        <script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <!-- Sidemenu js -->
        <script src="{{ asset('plugins/sidemenu/sidemenu.js') }}"></script>
        <!-- Sidebar js -->
        <script src="{{ asset('plugins/sidebar/sidebar.js') }}"></script>
        <!-- Internal Morris js -->
        <script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
        <script src="{{ asset('plugins/morris.js/morris.min.js') }}"></script>
        <!-- Circle Progress js-->
        <script src="{{ asset('js/circle-progress.min.js') }}"></script>
        <script src="{{ asset('js/chart-circle.js') }}"></script>
        <!-- Internal Dashboard js-->
        <script src="{{ asset('js/index.js') }}"></script>
        <!-- Color Theme js -->
        <script src="{{ asset('js/themeColors.js') }}"></script>
        <!-- Sticky js -->
        <script src="{{ asset('js/sticky.js') }}"></script>
        <!-- Custom js -->
        <script src="{{ asset('js/custom.js') }}"></script>
        <script src="{{ asset('js/template.js') }}"></script>
        <script src="{{ asset('plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap-daterangepicker/moment.min.js') }}"></script>
        <script src="{{ asset('plugins/daterangepicker.js') }}"></script>
        <script src="{{ asset('plugins/telephoneinput/telephoneinput.js') }}"></script>
		<script src="{{ asset('plugins/telephoneinput/inttelephoneinput.js') }}"></script>
        @if(Auth()->user()->user_type == 1)
        <script>
            function sendvalue(emp_id,emp_id1) {
                $.ajax({
                    type:'GET',
                    url:"{{url('admin/send-value')}}",
                    data:{emp_id:emp_id,emp_id1:emp_id1},
                    success:function(xhr){
                        location.reload();
                    }
                }); 
            }
        </script>
        @elseif(Auth()->user()->user_type == 3)
        <script>
            function sendvalue(emp_id,emp_id1) {
                $.ajax({
                    type:'GET',
                    url:"{{url('agent/send-value')}}",
                    data:{emp_id:emp_id,emp_id1:emp_id1},
                    success:function(xhr){
                        location.reload();
                    }
                }); 
            }
        </script>
        @elseif(Auth()->user()->user_type == 4)
        <script>
            function sendvalue(emp_id,emp_id1) {
                $.ajax({
                    type:'GET',
                    url:"{{url('employee/send-value')}}",
                    data:{emp_id:emp_id,emp_id1:emp_id1},
                    success:function(xhr){
                        location.reload();
                    }
                }); 
            }
        </script>
        @endif
        
	</body>
</html>
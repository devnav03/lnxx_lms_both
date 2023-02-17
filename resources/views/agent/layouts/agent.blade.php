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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</head>

	<body class="ltr main-body leftmenu">

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
                    <a class="main-logo" href="/">
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
                            <?php $user_id =  \Auth::id(); $cDate = \DB::SELECT("SELECT count(id) as note_count FROM `leads` where f_date > (NOW() - interval 3 day) OR f_date > (NOW() + interval 3 day) OR f_date = (NOW()) AND alloted_to = $user_id")[0]->note_count; ?>
                            <div class="dropdown main-header-notification">
                                <a class="nav-link icon" href="">
                                    <i class="fe fe-bell header-icons"></i>
                                    <span class="badge bg-danger nav-link-badge">{{$cDate}}</span>
                                </a>
                      
                            </div>
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
                                    <a class="dropdown-item" href="{!! route('setting.manage-account-agent') !!}">
                                        <i class="fe fe-settings"></i> Change Password </a>
                                    <a class="dropdown-item" href="{{ route('user-logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fe fe-power"></i> Sign Out</a>
                                    <form id="logout-form" action="{{ route('user-logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                            <!-- Profile -->
                            <!-- Sidebar -->
                           <!--  <div class="dropdown  header-settings">
                                <a href="javascript:void(0)" class="nav-link icon" data-bs-toggle="sidebar-right"
                                    data-bs-target=".sidebar-right">
                                    <i class="fe fe-align-right header-icons"></i>
                                </a>
                            </div> -->
                            <!-- Sidebar -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Header-->
    <!-- Sidemenu -->
        @include('agent.layouts.togelsidebar')
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
    <div class="main-footer text-center">
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
        @include('agent.layouts.sidebar')
    <!-- End Sidebar -->
</div>
<!-- End Page -->
		<!-- Back-to-top -->
        <a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>
        <!-- Jquery js-->
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
        <script>
            function sendstatus(status, lead_id) {
                $.ajax({
                    type:'GET',
                    url:"{{route('agent.send_status')}}",
                    data:{status:status,lead_id:lead_id},
                    success:function(xhr){
                        location.reload();
                    }
                }); 
            }
        </script>
        <script>
           function runtimeinput(note, lead_id){
            $.ajax({
                    type:'GET',
                    url:"{{route('agent.runtime-note')}}",
                    data:{note:note, lead_id:lead_id},
                });     
           }
        </script>
        <script>
           function runtimefdate(date, lead_id){
            $.ajax({
                    type:'GET',
                    url:"{{route('agent.runtime-date')}}",
                    data:{date:date, lead_id:lead_id},
                });     
           }
        </script>
        <!-- <script>
            function ajax_send(id) {
                $.ajax({
                    type:'GET',
                    url:"{{url('ajax_send')}}",
                    data:{id:id},
                    success:function(xhr){
                        if(xhr.status==200){
                            // alert(xhr.data.saturation);
                            $('#exampleInputname').text(xhr.data.saturation + xhr.data.name);
                            $('#exampleInputemail').text(xhr.data.email);
                            $('#exampleInputMobile').text(xhr.data.number);
                            $('#exampleInputProduct').text(xhr.data.product);
                            $('#exampleInputref').text(xhr.data.reference);
                            $('#exampleInputstatus').html("<select class='form-control' aria-label='Default select example'><option selected>Please Select</option><option value='New'>New</option><option value='Pending'>Pending</option><option value='Closed'>Closed</option><option value='Un-Closed'>Un-Closed</option></select>");
                        }
                    }
                }); 
            }
        </script> -->
	</body>
</html>
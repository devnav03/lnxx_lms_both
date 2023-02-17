<div class="sticky">
        <div class="main-menu main-sidebar main-sidebar-sticky side-menu">
            <div class="main-sidebar-header main-container-1 active">
                <div class="sidemenu-logo">
                    <a class="main-logo" href="{{ route('dashboard') }}">
                        <img src="{{ asset('img/lnxx_logo.png')}}" class="header-brand-img desktop-logo" alt="logo">
                        <img src="{{ asset('img/lnxx_logo.png')}}" class="header-brand-img icon-logo" alt="logo">
                        <img src="{{ asset('img/lnxx_logo.png')}}" class="header-brand-img desktop-logo theme-logo" alt="logo">
                        <img src="{{ asset('img/lnxx_logo.png')}}" class="header-brand-img icon-logo theme-logo" alt="logo">
                    </a>
                </div>
                <div class="main-sidebar-body main-body-1">
                    <div class="slide-left disabled" id="slide-left"><i class="fe fe-chevron-left"></i></div>
                    <ul class="menu-nav nav">
                        <li class="nav-header"><span class="nav-label">Employee Dashboard</span></li>
                        <li class="nav-item {{ (request()->is('employee/dashboard')) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('employee.dashboard') }}">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-home sidemenu-icon menu-icon"></i>
                                <span class="sidemenu-label">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link with-sub" href="javascript:void(0)">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-user sidemenu-icon menu-icon "></i>
                                <span class="sidemenu-label">Lead Management</span>
                                <!-- <span class="badge bg-danger side-badge">5</span> -->
                            </a>
                            <ul class="nav-sub">
                                <?php 
                                $authid = auth()->user()->id;  
                                $new_count = \DB::Select("SELECT COUNT(id) as new_count FROM `leads` where lead_status = 'OPEN' AND alloted_to = $authid")[0]->new_count; 
                                $close_count = \DB::Select("SELECT COUNT(id) as close_count FROM `leads` where lead_status = 'CLOSE' AND alloted_to = $authid ")[0]->close_count; 
                                ?>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{route('leads.add_leads')}}">Add Leads</a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{route('leads.open_leads')}}">Open Leads<span class="badge bg-primary side-badge">{{$new_count}}</span></a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{route('leads.closed_leads')}}">Closed Leads<span class="badge bg-success side-badge">{{$close_count}}</span></a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{route('emp-lead-tracking')}}">Lead Tracking</a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{route('employee.leads.social')}}">Social Lead Capturing</a></li>
                            </ul>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link with-sub" href="javascript:void(0)">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-shopping-cart-full sidemenu-icon menu-icon "></i>
                                <span class="sidemenu-label">Masters</span>
                                <i class="angle fe fe-chevron-right"></i>
                            </a>
                            <ul class="nav-sub">
                                <li class="side-menu-label1"><a href="javascript:void(0)">Masters</a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('services.index') }}">Services</a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('banks.index') }}">Banks</a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('testimonials.index') }}">Testimonials</a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('sliders.index') }}">Sliders</a></li> 
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('company.index') }}">Company</a></li> 
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('landing-sliders.index') }}">Landing Page Sliders</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link with-sub" href="javascript:void(0)">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-zoom-in sidemenu-icon menu-icon "></i>
                                <span class="sidemenu-label">LMS</span>
                            </a> -->
                           <!--  <ul class="nav-sub">
                                <li class="side-menu-label1"><a href="javascript:void(0)">Onboarding</a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('customer') }}">Customers</a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="#">Agents</a></li>
                            </ul> -->
                        <!-- </li> -->
                        <!-- <li class="nav-item">
                            <a class="nav-link with-sub" href="javascript:void(0)">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-light-bulb sidemenu-icon menu-icon "></i>
                                <span class="sidemenu-label">HRMS</span>
                            </a> -->
                           <!--  <ul class="nav-sub">
                                <li class="side-menu-label1"><a href="javascript:void(0)">Onboarding</a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('customer') }}">Customers</a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="#">Agents</a></li>
                            </ul> -->
                        <!-- </li> -->
                        <!-- <li class="nav-item">
                            <a class="nav-link with-sub" href="javascript:void(0)">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-money sidemenu-icon menu-icon "></i>
                                <span class="sidemenu-label">Bank Communication</span>
                            </a> -->
                           <!--  <ul class="nav-sub">
                                <li class="side-menu-label1"><a href="javascript:void(0)">Onboarding</a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('customer') }}">Customers</a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="#">Agents</a></li>
                            </ul> -->
                        <!-- </li> -->

                        <!-- <li class="nav-item">
                            <a class="nav-link with-sub" href="javascript:void(0)">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-settings sidemenu-icon menu-icon "></i>
                                <span class="sidemenu-label">Operational</span>
                            </a> -->
                           <!--  <ul class="nav-sub">
                                <li class="side-menu-label1"><a href="javascript:void(0)">Onboarding</a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('customer') }}">Customers</a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="#">Agents</a></li>
                            </ul> -->
                        <!-- </li>

                        <li class="nav-item">
                            <a class="nav-link with-sub" href="javascript:void(0)">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-rss-alt sidemenu-icon menu-icon "></i>
                                <span class="sidemenu-label">Campaign</span>
                            </a> -->
                           <!--  <ul class="nav-sub">
                                <li class="side-menu-label1"><a href="javascript:void(0)">Onboarding</a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('customer') }}">Customers</a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="#">Agents</a></li>
                            </ul> -->
                        <!-- </li>

                        <li class="nav-item">
                            <a class="nav-link with-sub" href="javascript:void(0)">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-email sidemenu-icon menu-icon "></i>
                                <span class="sidemenu-label">Email Campaign</span>
                            </a> -->
                           <!--  <ul class="nav-sub">
                                <li class="side-menu-label1"><a href="javascript:void(0)">Onboarding</a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('customer') }}">Customers</a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="#">Agents</a></li>
                            </ul> -->
                        <!-- </li> -->
                        <!-- <li class="nav-item">
                            <a class="nav-link with-sub" href="{{route('employee.index')}}">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-user sidemenu-icon menu-icon "></i>
                                <span class="sidemenu-label">Add Employee</span>
                            </a> -->
                           <!--  <ul class="nav-sub">
                                <li class="side-menu-label1"><a href="javascript:void(0)">Onboarding</a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('customer') }}">Customers</a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="#">Agents</a></li>
                            </ul> -->
                        <!-- </li> -->


                        
  


                        
                        <li class="nav-item"><a href="{{ route('logout-employee') }}" class="nav-link with-sub"> <i class="ti-power-off sidemenu-icon menu-icon "></i><span class="sidemenu-label">Log Out</span></a></li>
                          
                        
                    </ul>
                <div class="slide-right" id="slide-right"><i class="fe fe-chevron-right"></i></div>
            </div>
        </div>
    </div>
</div>
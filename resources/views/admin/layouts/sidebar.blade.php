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

                            @if(auth()->user()->user_type == 3)
                            <li class="nav-header"><span class="nav-label">Agent Dashboard</li>
                            @elseif(auth()->user()->user_type == 4)
                                <li class="nav-header"><span class="nav-label">Employee Dashboard</li>
                            @elseif(auth()->user()->user_type == 1)
                                <li class="nav-header"><span class="nav-label">Dashboard</li>
                            @elseif(auth()->user()->user_type == 5)
                                <li class="nav-header"><span class="nav-label">Manager Dashboard</li>
                            @endif

                       <!--  <li class="nav-header"><span class="nav-label">Dashboard</span></li> -->
                       @if(auth()->user()->user_type == 1)
                        <li class="nav-item {{ (request()->is('admin/dashboard')) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('dashboard') }}">
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
                                <span class="sidemenu-label">Application Request</span>
                            <i class="angle fe fe-chevron-right"></i>
                            </a>
                            <ul class="nav-sub">
                                <li class="side-menu-label1"><a href="javascript:void(0)">Onboarding</a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('applications.index') }}">Applications</a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('customer') }}">Customers</a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('agent-request.index') }}">Agents</a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('refers.index') }}">Refers</a></li>
                            </ul>
                        </li>
                        @endif
                        @if(auth()->user()->user_type == 1)
                        <li class="nav-item">
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
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('card-type.index') }}">Card Type</a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('testimonials.index') }}">Testimonials</a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('sliders.index') }}">Sliders</a></li> 
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('company.index') }}">Company</a></li> 
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('landing-sliders.index') }}">Landing Page Sliders</a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('blogs.index') }}">Blogs</a></li>
                            </ul>
                        </li>
                        @endif
                        @if(auth()->user()->user_type == 1)
                        <li class="nav-item">
                            <a class="nav-link with-sub" href="javascript:void(0)">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-settings sidemenu-icon menu-icon "></i>
                                <span class="sidemenu-label">Recommendation Rules</span>
                            <i class="angle fe fe-chevron-right"></i>
                            </a>
                            <ul class="nav-sub">
                                <li class="side-menu-label1"><a href="javascript:void(0)">Recommendation Rules</a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('credit-card-engines.index') }}">Credit Card Engine</a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="#">Personal Loan Engine</a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="#">Business Loan Engine</a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="#">Mortgage Loan Engine</a></li>
                            </ul>
                        </li>
                        @endif
          
                            @if(auth()->user()->user_type == 3)
                                <li class="nav-item {{ (request()->is('agent/dashboard')) ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('agent.dashboard') }}">
                                        <span class="shape1"></span>
                                        <span class="shape2"></span>
                                        <i class="ti-home sidemenu-icon menu-icon"></i>
                                        <span class="sidemenu-label">Dashboard</span>
                                    </a>
                                </li>
                            @elseif(auth()->user()->user_type == 4)
                                <li class="nav-item {{ (request()->is('employee/dashboard')) ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('employee.dashboard') }}">
                                        <span class="shape1"></span>
                                        <span class="shape2"></span>
                                        <i class="ti-home sidemenu-icon menu-icon"></i>
                                        <span class="sidemenu-label">Dashboard</span>
                                    </a>
                                </li>
                            @elseif(auth()->user()->user_type == 1)
                          <!--       <li class="nav-item {{ (request()->is('admin/dashboard')) ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('dashboard') }}">
                                        <span class="shape1"></span>
                                        <span class="shape2"></span>
                                        <i class="ti-home sidemenu-icon menu-icon"></i>
                                        <span class="sidemenu-label">Dashboard</span>
                                    </a>
                                </li> -->
                            @elseif(auth()->user()->user_type == 4)
                                <li class="nav-item {{ (request()->is('manager/dashboard')) ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('dashboard') }}">
                                        <span class="shape1"></span>
                                        <span class="shape2"></span>
                                        <i class="ti-home sidemenu-icon menu-icon"></i>
                                        <span class="sidemenu-label">Dashboard</span>
                                    </a>
                                </li>
                            @endif
                            @if(auth()->user()->user_type == 1)
                               <!--  <li class="nav-item">
                                    <a class="nav-link with-sub" href="javascript:void(0)">
                                        <span class="shape1"></span>
                                        <span class="shape2"></span>
                                        <i class="ti-user sidemenu-icon menu-icon "></i>
                                        <span class="sidemenu-label">Application Request</span>
                                    </a>
                                    <ul class="nav-sub">
                                        <li class="side-menu-label1"><a href="javascript:void(0)">Onboarding</a></li>
                                        <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('applications.index') }}">Applications</a></li>
                                        <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('customer') }}">Customers</a></li>
                                        <li class="nav-sub-item"><a class="nav-sub-link" href="#">Agents</a></li>
                                    </ul>
                                </li> -->
                            @endif
                            
                            <li class="nav-item">
                                    <a class="nav-link with-sub" href="javascript:void(0)">
                                        <span class="shape1"></span>
                                        <span class="shape2"></span>
                                        <i class="ti-zoom-in sidemenu-icon menu-icon "></i>
                                        <span class="sidemenu-label">LMS</span>
                                        <i class="angle fe fe-chevron-right"></i>
                                    </a>
                                    <ul class="nav-sub">
                                        @if(auth()->user()->user_type == 1)
                                            <?php
                                            $new_count = \DB::Select("SELECT COUNT(id) as new_count FROM `leads` where 'lead_status' != 'CLOSE'")[0]->new_count; 
                                            $close_count = \DB::Select("SELECT COUNT(id) as close_count FROM `leads` where lead_status = 'CLOSE'")[0]->close_count; 
                                            $lead_list_count = \DB::Select("SELECT COUNT(id) as lead_list_count FROM `leads` where lead_status = 'OPEN' AND alloted_to IS NUll")[0]->lead_list_count; 
                                            $assign_lead_list_count = \DB::Select("SELECT COUNT(id) as lead_list_count FROM `leads` where lead_status != 'CLOSE' AND alloted_to IS NOT NUll")[0]->lead_list_count; 
                                            ?> 
                                            <li class="nav-sub-item"><a class="nav-sub-link" href="{{route('lead.create')}}">Add New Lead</a></li>
                                            <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('lead.index') }}">Unassigned Lead List<span class="badge bg-danger side-badge">{{$lead_list_count}}</span></a></li>
                                            <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('leads.lead_assign_leads') }}">Assigned Lead List<span class="badge bg-warning side-badge">{{$assign_lead_list_count}}</span></a></li>
                                            <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('leads.lead_assign_automatic_leads') }}">Automatic Leads Distribution</a></li>
                                            <li class="nav-sub-item"><a class="nav-sub-link" href="{{route('admin-lead-tracking')}}">Lead Tracking</a></li>
                                            <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('leads.lead_open_leads') }}">All Leads<span class="badge bg-primary side-badge">{{$new_count}}</span></a></li>
                                            <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('leads.lead_close_leads') }}">Reports<span class="badge bg-success side-badge">{{$close_count}}</span></a></li>
                                            <li class="nav-sub-item"><a class="nav-sub-link" href="{{ url('admin/social_form_setting') }}">Socail Form Setting</a></li>
                                            <!-- <li class="nav-sub-item"><a class="nav-sub-link" href="#">Agents</a></li> -->
                                        @elseif(auth()->user()->user_type == 3)
                                            <?php  
                                            $authid = auth()->user()->id; 
                                            $new_count = \DB::Select("SELECT COUNT(id) as new_count FROM `leads` where lead_status = 'OPEN' AND alloted_to = $authid")[0]->new_count; 
                                            $close_count = \DB::Select("SELECT COUNT(id) as close_count FROM `leads` where lead_status = 'CLOSE' AND alloted_to = $authid ")[0]->close_count; 
                                            ?>
                                            <li class="nav-sub-item"><a class="nav-sub-link" href="{{route('agent.leads.add_leads')}}">Add Leads</a></li>
                                            <li class="nav-sub-item"><a class="nav-sub-link" href="{{route('agent.leads.open_leads')}}">Assign Leads<span class="badge bg-primary side-badge">{{$new_count}}</span></a></li>
                                            <li class="nav-sub-item"><a class="nav-sub-link" href="{{route('agent.leads.closed_leads')}}">Reports<span class="badge bg-success side-badge">{{$close_count}}</span></a></li>
                                            <li class="nav-sub-item"><a class="nav-sub-link" href="{{route('agent-lead-tracking')}}">Lead Tracking</a></li>
                                            <li class="nav-sub-item"><a class="nav-sub-link" href="{{route('agent.leads.social')}}">Social Lead Capturing</a></li>
                                        @elseif(auth()->user()->user_type == 4)
                                            <?php 
                                            $authid = auth()->user()->id;  
                                            $new_count = \DB::Select("SELECT COUNT(id) as new_count FROM `leads` where lead_status = 'OPEN' AND alloted_to = $authid")[0]->new_count; 
                                            $close_count = \DB::Select("SELECT COUNT(id) as close_count FROM `leads` where lead_status = 'CLOSE' AND alloted_to = $authid ")[0]->close_count; 
                                            ?>
                                            <li class="nav-sub-item"><a class="nav-sub-link" href="{{route('leads.add_leads')}}">Add Leads</a></li>
                                            <li class="nav-sub-item"><a class="nav-sub-link" href="{{route('leads.open_leads')}}">Assign Leads<span class="badge bg-primary side-badge">{{$new_count}}</span></a></li>
                                            <li class="nav-sub-item"><a class="nav-sub-link" href="{{route('leads.closed_leads')}}">Reports<span class="badge bg-success side-badge">{{$close_count}}</span></a></li>
                                            <li class="nav-sub-item"><a class="nav-sub-link" href="{{route('emp-lead-tracking')}}">Lead Tracking</a></li>
                                            <li class="nav-sub-item"><a class="nav-sub-link" href="{{route('employee.leads.social')}}">Social Lead Capturing</a></li>
                                        @elseif(auth()->user()->user_type == 5)
                                            <?php 
                                            $authid = auth()->user()->id;  
                                            $new_count = \DB::Select("SELECT COUNT(id) as new_count FROM `leads` where lead_status = 'OPEN' AND alloted_to = $authid")[0]->new_count; 
                                            $close_count = \DB::Select("SELECT COUNT(id) as close_count FROM `leads` where lead_status = 'CLOSE' AND alloted_to = $authid ")[0]->close_count; 
                                            ?>
                                            <li class="nav-sub-item"><a class="nav-sub-link" href="{{route('manager.leads.add_leads')}}">Add Leads</a></li>
                                            <li class="nav-sub-item"><a class="nav-sub-link" href="{{route('manager.leads.open_leads')}}">Assign Leads<span class="badge bg-primary side-badge">{{$new_count}}</span></a></li>
                                            <li class="nav-sub-item"><a class="nav-sub-link" href="{{route('manager.leads.closed_leads')}}">Reports<span class="badge bg-success side-badge">{{$close_count}}</span></a></li>
                                            <li class="nav-sub-item"><a class="nav-sub-link" href="{{route('manager-lead-tracking')}}">Lead Tracking</a></li>
                                            <li class="nav-sub-item"><a class="nav-sub-link" href="{{route('employee.leads.social')}}">Social Lead Capturing</a></li>
                                        @endif
                                    </ul>
                            </li>
                            @if(auth()->user()->user_type == 5 || auth()->user()->user_type == 1)
                          <!--   <li class="nav-item">
                                    <a class="nav-link with-sub" href="javascript:void(0)">
                                        <span class="shape1"></span>
                                        <span class="shape2"></span>
                                        <i class="ti-user sidemenu-icon menu-icon "></i>
                                        <span class="sidemenu-label">Employees</span>
                                        <i class="angle fe fe-chevron-right"></i>
                                    </a>
                                    <ul class="nav-sub">
                                        
                                            <li class="nav-sub-item"><a class="nav-sub-link" href="{{route('manager.employees')}}">Employees</a></li>
                                        
                                    </ul>
                            </li> -->
                            @endif
                            @if(auth()->user()->user_type == 1)
                                <li class="nav-item">
                                    <a class="nav-link with-sub" href="javascript:void(0)">
                                        <span class="shape1"></span>
                                        <span class="shape2"></span>
                                        <i class="ti-light-bulb sidemenu-icon menu-icon "></i>
                                        <span class="sidemenu-label">HRMS</span>
                                    </a>
                                <!--  <ul class="nav-sub">
                                        <li class="side-menu-label1"><a href="javascript:void(0)">Onboarding</a></li>
                                        <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('customer') }}">Customers</a></li>
                                        <li class="nav-sub-item"><a class="nav-sub-link" href="#">Agents</a></li>
                                    </ul> -->
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link with-sub" href="javascript:void(0)">
                                        <span class="shape1"></span>
                                        <span class="shape2"></span>
                                        <i class="ti-money sidemenu-icon menu-icon "></i>
                                        <span class="sidemenu-label">Bank Communication</span>
                                    </a>
                                <!--  <ul class="nav-sub">
                                        <li class="side-menu-label1"><a href="javascript:void(0)">Onboarding</a></li>
                                        <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('customer') }}">Customers</a></li>
                                        <li class="nav-sub-item"><a class="nav-sub-link" href="#">Agents</a></li>
                                    </ul> -->
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link with-sub" href="javascript:void(0)">
                                        <span class="shape1"></span>
                                        <span class="shape2"></span>
                                        <i class="ti-settings sidemenu-icon menu-icon "></i>
                                        <span class="sidemenu-label">Operational</span>
                                    </a>
                                <!--  <ul class="nav-sub">
                                        <li class="side-menu-label1"><a href="javascript:void(0)">Onboarding</a></li>
                                        <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('customer') }}">Customers</a></li>
                                        <li class="nav-sub-item"><a class="nav-sub-link" href="#">Agents</a></li>
                                    </ul> -->
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link with-sub" href="javascript:void(0)">
                                        <span class="shape1"></span>
                                        <span class="shape2"></span>
                                        <i class="ti-rss-alt sidemenu-icon menu-icon "></i>
                                        <span class="sidemenu-label">Campaign</span>
                                    </a>
                                <!--  <ul class="nav-sub">
                                        <li class="side-menu-label1"><a href="javascript:void(0)">Onboarding</a></li>
                                        <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('customer') }}">Customers</a></li>
                                        <li class="nav-sub-item"><a class="nav-sub-link" href="#">Agents</a></li>
                                    </ul> -->
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link with-sub" href="javascript:void(0)">
                                        <span class="shape1"></span>
                                        <span class="shape2"></span>
                                        <i class="ti-email sidemenu-icon menu-icon "></i>
                                        <span class="sidemenu-label">Email Campaign</span>
                                    </a>
                                
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link with-sub" href="javascript:void(0)">
                                        <span class="shape1"></span>
                                        <span class="shape2"></span>
                                        <i class="ti-rss-alt sidemenu-icon menu-icon "></i>
                                        <span class="sidemenu-label">Manage Leads</span>
                                    </a> -->
                                    <!-- <ul class="nav-sub">
                                        <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('lead.index') }}">Uploaded Leads List</a></li>
                                        <li class="nav-sub-item"><a class="nav-sub-link" href="#">Agents</a></li>
                                    </ul> -->
                                <!-- </li> -->
                                    <li class="nav-item">
                                        <a class="nav-link with-sub" href="{{route('employee.index')}}">
                                            <span class="shape1"></span>
                                            <span class="shape2"></span>
                                            <i class="ti-user sidemenu-icon menu-icon "></i>
                                            <span class="sidemenu-label">Add Employee</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link with-sub" href="{{ route('contact-enquiry.index') }}">
                                            <span class="shape1"></span>
                                            <span class="shape2"></span>
                                            <i class="ti-email sidemenu-icon menu-icon "></i>
                                            <span class="sidemenu-label">Contact Enquiry</span>
                                        </a>
                                    </li>                     
                                    <li class="nav-item"><a href="{{ route('logout-admin') }}" class="nav-link with-sub"> <i class="ti-power-off sidemenu-icon menu-icon "></i><span class="sidemenu-label">Log Out</span></a></li>
                          @endif
                        
                    </ul>
                <div class="slide-right" id="slide-right"><i class="fe fe-chevron-right"></i></div>
            </div>
        </div>
    </div>
</div>
@extends('admin.layouts.admin')
@section('css')
<!-- tables -->
<link rel="stylesheet" type="text/css" href="{!! asset('css/table-style.css') !!}" />
<!-- //tables -->
@endsection
@section('content')

<style>
.track .step {
    -webkit-box-flex: 1;
    -ms-flex-positive: 1;
    flex-grow: 1;
    width: 25%;
    margin-top: -18px;
    text-align: center;
    position: relative
}

.track .step.active:before {
    background: #FF5722
}

.track .step::before {
    height: 7px;
    position: absolute;
    content: "";
    width: 100%;
    left: 0;
    top: 18px
}

.track .step.active .icon {
    background: #ee5435;
    color: #fff
}

.track .icon {
    display: inline-block;
    width: 40px;
    height: 40px;
    line-height: 40px;
    position: relative;
    border-radius: 100%;
    background: #ddd
}

.track .step.active .text {
    font-weight: 400;
    color: #000
}
</style>

<style>
.nav-tabs .nav-link.active {
    color: #fff;
    background-color: #A7ADAA;
    border-color: #A7ADAA;
    color: #fff;
    font-weight: 500;
    letter-spacing: -0.1px;
    border-radius: 10px 10px 0px 0px;
}

.nav-tabs .nav-link+.nav-link {
    margin-left: 3px;
    border-width: thin;
    border-color: #A7ADAA;
    background-color: #ECECEC;
    border-radius: 10px 10px 0px 0px;
}

.nav-fill .nav-item {
    border-width: thin;
    border-color: #A7ADAA;
    background-color: #ECECEC;
    border-radius: 10px 10px 0px 0px;
}

.nav-tabs .nav-link:hover,
.nav-tabs .nav-link:focus {
    background-color: #A7ADAA;
    color: #ffffff !important;
}
</style>

<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      
<div class="agile-grids">
    <div class="grids">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">Lead Tracking</h1>

                <div class="agile-tables">
                    <div class="w3l-table-info">
                        {{-- for message rendering --}}
                        @include('employee.layouts.messages')
                        <div class="panel panel-default">

                            <div class="row row-sm" style="display: none;">
                                <div class="col-lg-12 col-md-12">
                                    <div class="card custom-card">
                                        <div class="card-body">
                                            <div class = "panel-body row">
                                                <div class="col-md-8">
                                                    <h6 class="main-content-label mb-1">Lead Live Stat</h6>
                                                </div>
                                                <div class="col-md-4">
                                                <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                                    <i class="fa fa-calendar"></i>&nbsp;
                                                    <span></span> <i class="fa fa-caret-down"></i>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="panel-body row">
                                                <div class="col-md-12" style="margin-top: 15px;">
                                                    <div class="row">
                                                    <div id="columnchart_material"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-sm">
                                <div class="col-lg-12 col-md-12">
                                    <div class="card custom-card">
                                    <div class="card-body"><div>
                                        <h6 class="main-content-label mb-1">Lead Tracking System</h6>
                                            </div>
                                            <div class="panel-body row">
                                                <div class="col-md-12" style="margin-top: 15px;">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <ul class="nav nav-pills nav-fill">
                                                                <li class="nav-item">
                                                                    <p style="margin-bottom: 0px;" class="nav-link bg-primary text-white" aria-current="page" href="#">Open Leads</p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <ul class="nav nav-pills nav-fill">
                                                                <li class="nav-item">
                                                                    <p style="margin-bottom: 0px;" class="nav-link bg-success text-white" aria-current="page" href="#">In Progress</p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <ul class="nav nav-pills nav-fill">
                                                                <li class="nav-item">
                                                                    <p style="margin-bottom: 0px;" class="nav-link bg-warning text-white" aria-current="page" href="#">Reminder</p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-body row">
                                                <div class="col-md-12" style="margin-top: 15px;">
                                                    <div class="row">
                                                        <div class="col-md-4">

                                                            <div id="data-wrapper"
                                                                style="height:400px;overflow-y: scroll;">
                                                                <!-- Results -->
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div id="data-wrapper1"
                                                                style="height:400px;overflow-y: scroll;">
                                                                <!-- Results -->
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div id="data-wrapper2"
                                                                style="height:400px;overflow-y: scroll;">
                                                                <!-- Results -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width: 1300px;">
        <div class="modal-content">
            <div class="modal-header" style="width: 1300px; height: 70px; left: 0px; top: 0px; background: #F3F0F1;">
                <img src="{{asset('img/logo-black.png')}}" alt="logo">
                <div class="row" style="display: contents;">
                    <div class="col" style="margin-top: 16px;">
                        <p style="margin-top: 8px; font-size: 17px; font-weight: 600;">Lead Detail <!-- <br><span style="weight:700; font-size:16px;"><b id="name1"></b></span> --></p>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="height: 104px; margin: 25px 0px -45px 25px; background:#fff;">
                <div class="row" style="margin-right: 0px; margin-left: 0px;">
                    <div class="col-md-1" style="line-height:5.6px; margin-top: 5px;">
                        <p style="weight:700; font-size:15px;"><b>Salutation</b></p>
                        <p style="weight:400; font-size:15px;" id="sat"></p>
                    </div>
                    <div class="col-md-4" style="line-height:1.6px;">
                        <p style="weight:700; font-size:16px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="9" height="14" viewBox="0 0 9 14" fill="none"><path d="M7.60083 0.994376L1.19 0.0129304C0.8925 -0.034085 0.589167 0.0481919 0.361667 0.24213C0.134167 0.441945 0 0.729915 0 1.02964V13.4123C0 13.7355 0.2625 14 0.583333 14H2.47917V10.9146C2.47917 10.3446 2.93417 9.88616 3.5 9.88616H4.95833C5.52417 9.88616 5.97917 10.3446 5.97917 10.9146V14H8.45833V2.01108C8.45833 1.50567 8.09667 1.07665 7.60083 0.994376ZM3.20833 8.56385H2.33333C2.09183 8.56385 1.89583 8.36638 1.89583 8.12308C1.89583 7.87978 2.09183 7.68231 2.33333 7.68231H3.20833C3.44983 7.68231 3.64583 7.87978 3.64583 8.12308C3.64583 8.36638 3.44983 8.56385 3.20833 8.56385ZM3.20833 6.80077H2.33333C2.09183 6.80077 1.89583 6.60331 1.89583 6.36C1.89583 6.1167 2.09183 5.91923 2.33333 5.91923H3.20833C3.44983 5.91923 3.64583 6.1167 3.64583 6.36C3.64583 6.60331 3.44983 6.80077 3.20833 6.80077ZM3.20833 5.0377H2.33333C2.09183 5.0377 1.89583 4.84023 1.89583 4.59693C1.89583 4.35362 2.09183 4.15616 2.33333 4.15616H3.20833C3.44983 4.15616 3.64583 4.35362 3.64583 4.59693C3.64583 4.84023 3.44983 5.0377 3.20833 5.0377ZM3.20833 3.27462H2.33333C2.09183 3.27462 1.89583 3.07716 1.89583 2.83385C1.89583 2.59055 2.09183 2.39308 2.33333 2.39308H3.20833C3.44983 2.39308 3.64583 2.59055 3.64583 2.83385C3.64583 3.07716 3.44983 3.27462 3.20833 3.27462ZM6.125 8.56385H5.25C5.0085 8.56385 4.8125 8.36638 4.8125 8.12308C4.8125 7.87978 5.0085 7.68231 5.25 7.68231H6.125C6.3665 7.68231 6.5625 7.87978 6.5625 8.12308C6.5625 8.36638 6.3665 8.56385 6.125 8.56385ZM6.125 6.80077H5.25C5.0085 6.80077 4.8125 6.60331 4.8125 6.36C4.8125 6.1167 5.0085 5.91923 5.25 5.91923H6.125C6.3665 5.91923 6.5625 6.1167 6.5625 6.36C6.5625 6.60331 6.3665 6.80077 6.125 6.80077ZM6.125 5.0377H5.25C5.0085 5.0377 4.8125 4.84023 4.8125 4.59693C4.8125 4.35362 5.0085 4.15616 5.25 4.15616H6.125C6.3665 4.15616 6.5625 4.35362 6.5625 4.59693C6.5625 4.84023 6.3665 5.0377 6.125 5.0377ZM6.125 3.27462H5.25C5.0085 3.27462 4.8125 3.07716 4.8125 2.83385C4.8125 2.59055 5.0085 2.39308 5.25 2.39308H6.125C6.3665 2.39308 6.5625 2.59055 6.5625 2.83385C6.5625 3.07716 6.3665 3.27462 6.125 3.27462Z" fill="#3A3A3A" />
                            </svg> <b>Name</b>
                        </p>
                        <p style="weight:400; font-size:15px;" id="name2"></p>
                    </div>
                    <div class="col-md-3" style="line-height:1.6px;">
                        <p style="weight:700; font-size:15px;">
                            <svg width="12" height="16" viewBox="0 0 20 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg"> <path d="M18 0H2C0.9 0 0.00999999 0.9 0.00999999 2L0 14C0 15.1 0.9 16 2 16H18C19.1 16 20 15.1 20 14V2C20 0.9 19.1 0 18 0ZM18 4L10 9L2 4V2L10 7L18 2V4Z"
                                    fill="#3A3A3A" />
                            </svg> <b>Email</b>
                        </p>
                        <p style="weight:400; font-size:15px;" id="email1"></p>
                    </div>
                    <div class="col-md-2" style="line-height:10px;">
                    <p style="weight:700; font-size:15px;">
                    <svg width="12" height="12" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.23 9.62889C12.2733 9.62889 11.3478 9.47333 10.4844 9.19333C10.3492 9.14749 10.2038 9.14068 10.0648 9.1737C9.92588 9.20671 9.79906 9.27821 9.69889 9.38L8.47778 10.9122C6.27667 9.86222 4.21556 7.87889 3.11889 5.6L4.63556 4.30889C4.84556 4.09111 4.90778 3.78778 4.82222 3.51556C4.53444 2.65222 4.38667 1.72667 4.38667 0.77C4.38667 0.35 4.03667 0 3.61667 0H0.925556C0.505556 0 0 0.186667 0 0.77C0 7.99556 6.01222 14 13.23 14C13.7822 14 14 13.51 14 13.0822V10.3989C14 9.97889 13.65 9.62889 13.23 9.62889Z" fill="#3A3A3A" /></svg> 
                    <b>Phone</b>
                    </p>
                    <p style="weight:400; font-size:15px;" id="number1"></p>
                    </div>
                    <div class="col-md-2" style="line-height:1.6px;">
                        <p style="weight:700; font-size:15px;">
                        <svg width="11" height="15" viewBox="0 0 11 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.4116 5.82905H0.416484C0.186281 5.82905 0 6.01528 0 6.24539C0 6.4755 0.186281 6.66173 0.416484 6.66173H1.04902L4.1647 10.5549V13.7399C4.1647 13.97 4.35098 14.1562 4.58119 14.1562H6.24708C6.47728 14.1562 6.66356 13.97 6.66356 13.7399V10.5549L9.77925 6.66173H10.4118C10.642 6.66173 10.8283 6.4755 10.8283 6.24539C10.8281 6.01528 10.6418 5.82905 10.4116 5.82905ZM6.66347 1.24908C6.66347 0.560297 6.10303 0 5.41406 0C4.72509 0 4.16466 0.560297 4.16466 1.24908C4.16466 1.93786 4.72509 2.49816 5.41406 2.49816C6.10303 2.49816 6.66347 1.93786 6.66347 1.24908ZM3.74817 4.99631H7.07991C7.31011 4.99631 7.49639 4.81008 7.49639 4.57997V3.74723C7.49639 3.05845 6.93595 2.49816 6.24698 2.49816H5.41406H4.58114C3.89217 2.49816 3.33173 3.05845 3.33173 3.74723V4.57997C3.33173 4.81008 3.51802 4.99631 3.74817 4.99631ZM1.78786 4.87434C1.95052 5.037 2.21409 5.037 2.37675 4.87434C2.53941 4.71173 2.53941 4.44825 2.37675 4.28559L1.54383 3.45286C1.38112 3.2902 1.11759 3.2902 0.954937 3.45286C0.792281 3.61552 0.792281 3.87895 0.954937 4.04161L1.78786 4.87434ZM9.04027 4.87434L9.87319 4.04161C10.0358 3.87895 10.0358 3.61552 9.87319 3.45286C9.71048 3.2902 9.44695 3.2902 9.2843 3.45286L8.45137 4.28559C8.28872 4.44825 8.28872 4.71173 8.45137 4.87434C8.61403 5.037 8.87756 5.037 9.04027 4.87434Z" fill="#3A3A3A" /></svg> <b>Lead Owner</b>
                        </p>
                        <p style="weight:400; font-size:15px;" id="lead_owner1"></p>
                    </div>
                </div>
            </div>
            <span class="border-top"></span>
            <div style="height: 104px; margin: 0px 0px 0px 0px; border-width:; background:#fff;">
                <div class="col-12 grid-margin stretch-card">
                    <div class="" id="employee_details">
                        <div class="card-header emp_head_h" style="border-color: #fff!important;">
                            <div class="row" id="status_bar">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <span style="margin-top:-40px; margin-bottom:40px;" class="border-top"></span>

            <div class="modal-body" style="margin-top:-45px;">
                <div class="row">
                    <div class="col-8 grid-margin stretch-card">
                        <div class="card" id="employee_details">
                            <div class="card-header emp_head_h" style="padding-top: 10px;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <nav>
                                            <div style="margin-bottom: 12px;" class="nav nav-tabs nav-fill" id="nav-tab"
                                                role="tablist">
                                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                                                    href="#nav-personal-details" role="tab"
                                                    aria-controls="nav-personal-details" aria-selected="true">Personal
                                                    Details</a>
                                                <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab"
                                                    href="#nav-home" role="tab" aria-controls="nav-home"
                                                    aria-selected="true">Lead
                                                    Info</a>
                                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab"
                                                    href="#nav-profile" role="tab" aria-controls="nav-profile"
                                                    aria-selected="false">Segmentation </a>
                                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab"
                                                    href="#nav-contact" role="tab" aria-controls="nav-contact"
                                                    aria-selected="false">Follow up</a>
                                                <a class="nav-item nav-link" id="nav-send-mail" data-toggle="tab"
                                                    href="#nav-mail" role="tab" aria-controls="nav-contact"
                                                    aria-selected="false">Mail</a>
                                            </div>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <section id="tabs" class="project-tab">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="tab-content" id="nav-tabContent">
                                                        <div class="tab-pane fade show active" id="nav-personal-details"
                                                            role="tabpanel" aria-labelledby="nav-personal-details-tab">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <div class="form-group">
                                                                    <label><b>First Name</b></label>
                                                                    <input class="form-control" id="m_name">
                                                                    <input type="hidden" id="m_id">
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-4">
                                                                <div class="form-group">
                                                                <label><b>Middle Name</b></label>
                                                                <input class="form-control" id="mi_name">
                                                                </div>
                                                                </div>

                                                                <div class="col-sm-4">
                                                                <div class="form-group">
                                                                <label><b>Last Name</b></label>
                                                                <input class="form-control" id="ml_name">
                                                                </div>
                                                                </div>

                                                                <div class="col-sm-4">
                                                                    <div class="form-group">
                                                                    <label><b>Mobile</b></label>
                                                                    <input class="form-control" id="m_number">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group">
                                                                        <label><b>Email</b></label>
                                                                        <input class="form-control" id="m_email">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label><b>Description</b></label>
                                                                        <input class="form-control" id="m_description">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-1">
                                                                        <div class="form-group">
                                                                            <button type="submit" onclick="submit_personal_details();"
                                                                                class="btn btn-success">Save</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group" id="view-application-form">
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-1"></div>
                                                                    <div class="col-sm-2">
                                                                        <div id="employement">
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <div id="video">
        
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <div id="consent-form">

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade show" id="nav-home" role="tabpanel"
                                                            aria-labelledby="nav-home-tab">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label><b>Lead Owner</b></label>
                                                                        <input class="form-control" id="m_leadowner"
                                                                            disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label><b>Created By</b></label>
                                                                        <input class="form-control" id="m_uploadedby"
                                                                            disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label><b>Uploaded At</b></label>
                                                                        <input class="form-control" id="m_created_at"
                                                                            disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                                            aria-labelledby="nav-profile-tab">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label><b>Lead Product Type</b></label>
                                                                        <input class="form-control" type="text"
                                                                            id="m_Lead_product_type" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label><b>Lead Source Type</b></label>
                                                                        <input type="text" class="form-control"
                                                                            id="m_source" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label><b>Lead Reference Id</b></label>
                                                                        <input class="form-control" id="m_reference"
                                                                            disabled>
                                                                    </div>
                                                                </div>
                                                                <!-- <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label><b>Description</b></label>
                                                                        <input class="form-control"
                                                                            id="m_3_description">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <button type="submit"
                                                                            class="btn btn-success">Save</button>
                                                                    </div>
                                                                </div> -->
                                                            </div>
                                                        </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label><b>Reason for Follow-Up</b></label>
                                <select type="text" id="fol_region_follow" name="region_follow" class="form-control minimal">
                                <?php $regions = \DB::table('lead_regions')->get();?>
                                <option>Please Select</option>
                                @foreach($regions as $regions)
                                    <option value="{{$regions->name}}">{{$regions->name}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group">
                                                                        <label><b>Date</b></label>
                                                                        <?php $min_date = date('Y-m-d'); ?>
                                                                        <input type="date" id="fol_date" min="{{$min_date}}" name="date"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group">
                                                                        <label><b>Time</b></label>
                                                                        <input type="time" id="fol_time" name="time"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label><b>Description</b></label>
                                                                        <textarea type="text" id="fol_note" name="note"
                                                                            class="form-control"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <div class="btn-group">
                                                                            <button class="btn btn-success btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                Save As
                                                                            </button>
                                                                            <div class="dropdown-menu">
                                                                                <?php $status = \DB::table('status_master')->get();?>
                                                                                @foreach($status as $status)
                                                                                <div>
                                                                                    <a type="button" style="color:black;" onclick="follow_up_sub('{{$status->name}}')" >{{$status->name}}</a> 
                                                                                </div>  
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="nav-mail" role="tabpanel"
                                                            aria-labelledby="nav-send-mail">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <div class="form-group">
                                                                        <label><b>To</b></label>
                                                                        <input type="email" id="m_e_email" name="email_to"
                                                                            class="form-control" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="form-group">
                                                                        <label><b>Select a predefined template from the
                                                                                list below.</b></label>
                                                                        <select type="text" name="region_follow"
                                                                            class="form-control minimal">
                                                                            <option>Template 1</option>
                                                                            <option>Template 2</option>
                                                                            <option>Template 3</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group">
                                                                        <label><b>Subject</b></label>
                                                                        <input type="text" name="mail_subject"
                                                                            class="form-control"
                                                                            placeholder="Enter Mail Subject">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="form-group">
                                                                        <label><b>Bcc</b></label>
                                                                        <input type="text" name="mail_subject"
                                                                            class="form-control"
                                                                            placeholder="Enter Mail Subject">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label>Message</label>
                                                                        <textarea type="hidden" id="description"
                                                                            name="description"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <button onclick="send_mail()" type="submit"
                                                                            class="btn btn-success">Send</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 grid-margin stretch-card">
                        <div class="card casedetails" id="employee_details">
                            <div class="card-header emp_head_h" style="padding-top: 8px;">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h5 class="">Case Details</h5>
                                    </div>
                                    <div class="col-md-2">
                                        <img id="output" />
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                        <div id="data-wrapper4" style="height:230px;overflow-y: scroll;">
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card maildetails" style="display:none" id="employee_details">
                            <div class="card-header emp_head_h">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h5 class="">Mail History</h5>
                                    </div>
                                    <div class="col-md-2">
                                        <img id="output" />
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div id="data-wrapper5" style="height:230px;overflow-y: scroll;">
                                                <!-- Results -->
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    
#data-wrapper h5.card-header,
#data-wrapper1 h5.card-header,
#data-wrapper2 h5.card-header {
    padding-top: 10px;
    padding-bottom: 10px;
    text-transform: capitalize;
    font-weight: normal;
    font-size: 16px;
}
#data-wrapper .card-body,
#data-wrapper1 .card-body,
#data-wrapper2 .card-body {
    padding-top: 10px;
    padding-bottom: 10px;
}
#data-wrapper .card,
#data-wrapper1 .card,
#data-wrapper2 .card{
    margin-bottom: 12px;
}
#data-wrapper .card p,
#data-wrapper1 .card p,
#data-wrapper2 .card p{
    margin-bottom: 8px;
}
#data-wrapper .card button,
#data-wrapper1 .card button,
#data-wrapper2 .card button {
    padding: 5px 15px;
    min-height: 20px;
}
#data-wrapper h5.card-title,
#data-wrapper1 h5.card-title,
#data-wrapper2 h5.card-title {
    font-weight: normal;
    font-size: 15px;
}


</style>

<script>
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'Open', 'Inprocess', 'Reminder'],
          ['2014', 1000, 400, 200],
          ['2015', 1170, 460, 250],
          ['2016', 660, 1120, 300],
          ['2017', 1030, 540, 350],
          ['2017', 1030, 540, 350],
          ['2017', 1030, 540, 350],
          ['2017', 1030, 540, 350],
          ['2017', 1030, 540, 350],
          ['2017', 1030, 540, 350],
          ['2017', 1030, 540, 350],
        ]);

        var options = {
          chart: {
            title: 'Leads Performance',
            subtitle: 'Opens, Inprocess, and Reminders',
          },
          series: {
            0: { color: '#6259CA' },
            1: { color: '#19B159' },
            2: { color: '#FF9B21' },
          },
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    //   var options = {
    //     legend: 'none',
    //       series: {
    //         0: { color: '#6259CA' },
    //         1: { color: '#19B159' },
    //         2: { color: '#FF9B21' },
    //       },
    //     }
</script>
 @if(Auth()->user()->user_type == 1)
<script type="text/javascript">
function onboard(id){
        swal({
            title: "Are you sure?",
            // text: "Do you want to change status "+msg,
            text: "Do you want to On-Board",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, On-Board Lead!",
            closeOnConfirm: true
            }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: "GET",
                    url: "{{route('onboard.user.details')}}",
                    data: {
                        'id': id,
                    },
                    success: function(response) {
                        if (response.status == 200) {
                            toastr.options.timeOut = 1500;
                            toastr.success('Lead On-Boarded Succesfully');
                            window.open("<?php echo route('get-started'); ?>/admin/view-save-personal/"+response.get_last_id);
                            $("#view-application-form").html('<a type="button" onclick="onboard('+id+');" href="#" class="btn btn-success">On-boarded Customer</a>');
                        }else{
                            toastr.options.timeOut = 1500;
                            toastr.error('This Email ID and Mobile No is already exists');
                        }
                    }
                });
            }
        });
    }
</script>
@endif

    @if(Auth()->user()->user_type == 1)
    <script>
    CKEDITOR.replace('description');
    </script>
    <script>
    $(window).on('load', function() {
        infinteLoadMore(1);
    });
    </script>
    <script>
    var page = 1;
    $('#data-wrapper').scroll(function() {
        if ($('#data-wrapper').scrollTop() + $('#data-wrapper').height() <= $(document).height()) {
            page++;
            infinteLoadMore(page);
        }
    });
    </script>
    <script>
    function infinteLoadMore(page) {
        $.ajax({
                url: "{{url('admin/admin-lead/tracking-open')}}?page=" + page,
                datatype: "html",
                type: "get",
                beforeSend: function() {
                    $('.auto-load').show();
                    $('.priloder_ajax').show();
                }
            })
            .done(function(response) {
                if (response.length == 0) {
                    $('.auto-load').html("We don't have more data to display :(");
                    return;
                }
                $('.auto-load').hide();
                $("#data-wrapper").append(response);
                var html = '<div class="priloder_ajax' + page + '">' +
                    '<div class="d-flex justify-content-center">' +
                    '<div class="spinner-grow text-primary" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>' +
                    '</div></div>';
                $("#data-wrapper").append(html);
                setTimeout(function() {
                    $('.priloder_ajax' + page).hide();
                }, 2000);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
    </script>
    <script>
    $(window).on('load', function() {
        infinteLoadMore1(1);
    });
    </script>
    <script>
    var page = 1;
    $('#data-wrapper1').scroll(function() {
        if ($('#data-wrapper1').scrollTop() + $('#data-wrapper1').height() <= $(document).height()) {
            page++;
            infinteLoadMore1(page);
        }
    });
    </script>
    <script>
    function infinteLoadMore1(page) {
        $.ajax({
                url: "{{url('admin/admin-lead/tracking-inprocess')}}?page=" + page,
                datatype: "html",
                type: "get",
                beforeSend: function() {
                    $('.auto-load').show();
                    $('.priloder_ajax').show();
                }
            })
            .done(function(response) {
                if (response.length == 0) {
                    $('.auto-load').html("We don't have more data to display :(");
                    return;
                }
                $('.auto-load').hide();

                $("#data-wrapper1").append(response);
                var html = '<div class="priloder_ajax' + page + '">' +
                    '<div class="d-flex justify-content-center">' +
                    '<div class="spinner-grow text-success" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>' +
                    '</div></div>';
                $("#data-wrapper1").append(html);
                setTimeout(function() {
                    $('.priloder_ajax' + page).hide();
                }, 2000);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
    </script>
    <script>
    $(window).on('load', function() {
        infinteLoadMore2(1);
    });
    </script>
    <script>
    var page = 1;
    $('#data-wrapper2').scroll(function() {
        if ($('#data-wrapper2').scrollTop() + $('#data-wrapper2').height() >= $(document).height()) {
            page++;
            infinteLoadMore2(page);
        }
    });
    </script>
    <script>
    function infinteLoadMore2(page) {
        $.ajax({
                url: "{{url('admin/admin-lead/tracking-reminder')}}?page=" + page,
                datatype: "html",
                type: "get",
                beforeSend: function() {
                    $('.auto-load').show();
                    $('.priloder_ajax').show();
                }
            })
            .done(function(response) {
                if (response.length == 0) {
                    $('.auto-load').html("We don't have more data to display :(");
                    return;
                }
                $('.auto-load').hide();
                $("#data-wrapper2").append(response);
                var html = '<div class="priloder_ajax' + page + '">' +
                    '<div class="d-flex justify-content-center">' +
                    '<div class="spinner-grow text-warning" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>' +
                    '</div></div>';
                $("#data-wrapper2").append(html);
                setTimeout(function() {
                    $('.priloder_ajax' + page).hide();
                }, 2000);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
    </script>

    <script>
    function get_popup(id) {
        viewcase(id);
        viewmails(id);
        $.ajax({
                type: 'GET',
                url: "{{url('admin/admin-lead/popup')}}",
                data: {
                    id: id
                },
            })
            .done(function(xhr) {
                if (xhr.status == 200) {

                    $("#m_id").val(xhr.responce.id);
                    $("#sat").html(xhr.responce.saturation);
                    $("#m_name").val(xhr.responce.name);
                    $("#mi_name").val(xhr.responce.mname);
                    $("#ml_name").val(xhr.responce.lname);
                    $("#name1").html(xhr.responce.name);
                    $("#name2").html(xhr.responce.name);
                    $("#m_email").val(xhr.responce.email);
                    $("#m_e_email").val(xhr.responce.email);
                    $("#m_description").val(xhr.responce.note);

                    $("#email1").html('<a href="mailto:' + xhr.responce.email + '">' + xhr.responce.email + '</a>');
                    $("#m_number").val(xhr.responce.number);
                    $("#number1").html('<a href="tel:' + xhr.responce.number + '">' + xhr.responce.number + '</a>');

                    $("#m_source").val(xhr.responce.source);
                    $("#source").val(xhr.responce.source);
                    $("#m_Lead_product_type").val(xhr.responce.product);
                    $("#m_reference").val(xhr.responce.reference);

                    $("#f_date").html(xhr.responce.f_date);

                    $("#m_leadowner").val(xhr.getuser.name);
                    $("#lead_owner1").html(xhr.getuser.name);

                    $("#m_uploadedby").val(xhr.getupload.name);


                    $("#m_created_at").val(xhr.responce.createdat);


                    $("#m_createdat").val(xhr.responce.createdat);
                    $("#updated").html(xhr.responce.updated_at);
                    $("#product").html(xhr.responce.product);

                    $("#source").html(xhr.responce.source);
                    $("#reference").html(xhr.responce.reference);

                    if (xhr.responce.lead_status == 'OPEN') {
                        $("#view-application-form").html('');
                        $("#status_bar").html(
                            '<div class="col-sm-1"><div class="form-group"><p style="weight:400; font-size:20px;"><b>Status:</b></p></div></div><div class="col-sm-2" style="z-index:22"><div style="width:155px; height:30px; background-color:#3D6AD6; position:relative; border-radius: 15px 0px 0px 15px;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px;"><h6 style="margin: -8px 0px 0px -115px; color: #fff!important;font-size: 12px;">Open</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #3D6AD6;position:absolute;right: -20px;"></div></div></div><div class="col-sm-2" style="margin-left:-49px; z-index:11"><div onclick="send_in_process_status(' + xhr.responce.id + ')" class="linkstatus" style="cursor:pointer; width:155px; height:30px; background-color:#A7ADAA; position:relative;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px;"><h6 style="margin: -8px 0px 0px -125px; color: #fff!important;font-size: 12px;">In Proccess</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #A7ADAA;position:absolute;right: -20px;"></div></div></div><div class="col-sm-2" style="margin-left:-49px;"><div style="width:155px; height:30px; background-color:#A7ADAA; position:relative;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px; z-index:22;"><h6 style="margin: -8px 0px 0px -125px; color: #fff!important;font-size: 12px;">Reminder</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #A7ADAA;position:absolute;right: -20px; z-index:22;"></div></div></div><div class="col-sm-3" style="margin-left:-49px;"><a type="button"  onclick="send_in_close_status(' + xhr.responce.id +')"><div style="width:200px; height:30px; background-color:#058D3D; position:relative; border-radius: 0px 15px 15px 0px;"><div style="width: 0;height: 0;position:absolute;right: -24px;"><h6 style="margin: 7px 0px 0px -180px; color: #fff!important; font-size: 12px;">Mark status as complete</h6></div></div></a></div><div class="col-sm-1"><div class="form-group" id="markascomplete"><button onclick="show_case_detail()" type="button" class="btn btn-primary btn-lg" style="margin: -10px -100px 0px 0px; background-color:#3D6AD6;padding: 5px 15px;font-size: 14px;"><i class="ti-alarm-clock menu-icon"></i> History </button></div></div><div class="col-sm-1"><div class="form-group" id="markascomplete"><button onclick="show_mail_datails()" type="button" class="btn btn-primary btn-lg" style="margin: -10px -135px 0px 72px; background-color:#3D6AD6;padding: 5px 15px;font-size: 14px; "><i class="ti-email menu-icon"></i> Mail</button></div></div>'
                            );
                            $('#employement').html('');
                            $('#video').html('');
                            $('#consent-form').html('');
                    }
                    
                    if (xhr.responce.lead_status == 'INPROCESS') {
                        
                        if(xhr.get_user_exist == null){
                            $("#view-application-form").html('<a type="button" onclick="onboard(' +xhr.responce.id +');" href="#" class="btn btn-warning">Start On Boarding</a>');
                        }else{
                            $("#view-application-form").html('<a type="button" target="_blank" href="<?php echo route('get-started'); ?>/admin/view-save-personal/'+xhr.get_user_exist.id+'" class="btn btn-success">Boarding In Process</a>');
                        }
                        $("#status_bar").html(
                            '<div class="col-sm-1"><div class="form-group"><p style="weight:400; font-size:20px;"><b>Status:</b></p></div></div><div class="col-sm-2" style="z-index:22"><div style="width:155px; height:30px; background-color:#3D6AD6; position:relative; border-radius: 15px 0px 0px 15px;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px;"><h6 style="margin: -8px 0px 0px -115px; color: #fff!important;font-size: 12px;">Open</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #3D6AD6;position:absolute;right: -20px;"></div></div></div><div class="col-sm-2" style="margin-left:-49px; z-index:11"><a type="button" onclick="send_in_process_status(' + xhr.responce.id + ')"><div style="width:155px; height:30px; background-color:#FFB800; position:relative;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px;"><h6 style="margin: -8px 0px 0px -125px; color: #fff!important;font-size: 12px;">In Proccess</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #FFB800;position:absolute;right: -20px;"></div></div></div><div class="col-sm-2" style="margin-left:-49px;"><div style="width:155px; height:30px; background-color:#A7ADAA; position:relative;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px; z-index:22;"><h6 style="margin: -8px 0px 0px -125px; color: #fff!important;font-size: 12px;">Reminder</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #A7ADAA;position:absolute;right: -20px; z-index:22;"></div></div></div><div class="col-sm-3" style="margin-left:-49px;"><a type="button"   onclick="send_in_close_status(' +xhr.responce.id +')"><div style="width:200px; height:30px; background-color:#058D3D; position:relative; border-radius: 0px 15px 15px 0px;"><div style="width: 0;height: 0;position:absolute;right: -24px;"><h6 style="margin: 7px 0px 0px -180px; color: #fff!important; font-size: 12px;">Mark status as complete</h6></div></div></a></div><div class="col-sm-1"><div class="form-group" id="markascomplete"><button onclick="show_case_detail()" type="button" class="btn btn-primary btn-lg" style="margin: -10px -100px 0px 0px; background-color:#3D6AD6;padding: 5px 15px;font-size: 14px;"><i class="ti-alarm-clock menu-icon"></i> History </button></div></div><div class="col-sm-1"><div class="form-group" id="markascomplete"><button onclick="show_mail_datails()" type="button" class="btn btn-primary btn-lg" style="margin: -10px -135px 0px 72px; background-color:#3D6AD6; padding: 5px 15px;font-size: 14px;"><i class="ti-email menu-icon"></i> Mail</button></div></div>');
                            if(xhr.application.cm_type == ''){
                                $('#employement').html('<h6 class="text-center">EMPLOYMENT</h6><p class="text-center"><i style="color: red" class="fa fa-times"></i></p>');
                            }if(xhr.application.cm_type != ''){
                                $('#employement').html('<h6 class="text-center">EMPLOYMENT</h6><p class="text-center"><i style="color: green" class="fa fa-check"></i></p>');
                            }
                            if(xhr.application.video == ''){
                                $('#video').html('<h6 class="text-center">VIDEO</h6><p class="text-center"><i style="color: red" class="fa fa-times"></i></p>');
                            }if(xhr.application.video != ''){
                                $('#video').html('<h6 class="text-center">VIDEO</h6><p class="text-center"><i style="color: green" class="fa fa-check"></i></p>');
                            }
                            if(xhr.application.consent_form == ''){
                                $('#consent-form').html('<h6 class="text-center">CONSENT FORM</h6><p class="text-center"><i style="color: red" class="fa fa-times"></i></p>');
                            }if(xhr.application.consent_form != ''){
                                $('#consent-form').html('<h6 class="text-center">CONSENT FORM</h6><p class="text-center"><i style="color: green" class="fa fa-check"></i></p>');
                            }
                    }

                    if (xhr.responce.lead_status == 'REMINDER') {
                        if(xhr.get_user_exist.id == ''){
                            $("#view-application-form").html('<a type="button" onclick="onboard(' +xhr.responce.id +');" href="#" class="btn btn-warning">On-board Customer</a>');
                        }else{
                            $("#view-application-form").html('<a type="button" target="_blank" href="<?php echo route('get-started'); ?>/admin/view-save-personal/'+xhr.get_user_exist.id+'" class="btn btn-success">On-boarded Customer</a>');
                        }
                        $("#status_bar").html(
                            '<div class="col-sm-1"><div class="form-group"><p style="weight:400; font-size:20px;"><b>Status:</b></p></div></div><div class="col-sm-2" style="z-index:22"><div style="width:155px; height:30px; background-color:#3D6AD6; position:relative; border-radius: 15px 0px 0px 15px;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px;"><h6 style="margin: -8px 0px 0px -115px; color: #fff!important;font-size: 12px;">Open</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #3D6AD6;position:absolute;right: -20px;"></div></div></div><div class="col-sm-2" style="margin-left:-49px; z-index:11"><a onclick="send_in_process_status(' + xhr.responce.id + ')" type="button"><div style="width:155px; height:30px; background-color:#FFB800; position:relative;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px;"><h6 style="margin: -8px 0px 0px -125px; color: #fff!important;font-size: 12px;">In Proccess</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #FFB800;position:absolute;right: -20px;"></div></div></a></div><div class="col-sm-2" style="margin-left:-49px;"><a href="#"><div style="width:155px; height:30px; background-color:#FF8A00; position:relative;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px; z-index:22;"><h6 style="margin: -8px 0px 0px -125px; color: #fff!important;font-size: 12px;">Reminder</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #FF8A00;position:absolute;right: -20px; z-index:22;"></div></div></div></a><div class="col-sm-3" style="margin-left:-49px;"><a type="button"   onclick="send_in_close_status(' +xhr.responce.id +')"><div style="width:200px; height:30px; background-color:#058D3D; position:relative; border-radius: 0px 15px 15px 0px;"><div style="width: 0;height: 0;position:absolute;right: -24px;"><h6 style="margin: 7px 0px 0px -180px; color: #fff!important; font-size: 12px;">Mark status as complete</h6></div></div></a></div><div class="col-sm-1"><div class="form-group" id="markascomplete"><button onclick="show_case_detail()" type="button" class="btn btn-primary btn-lg" style="margin: -10px -100px 0px 0px; background-color:#3D6AD6;padding: 5px 15px;font-size: 14px;"><i class="ti-alarm-clock menu-icon"></i> History </button></div></div><div class="col-sm-1"><div class="form-group" id="markascomplete"><button onclick="show_mail_datails()" type="button" class="btn btn-primary btn-lg" style="margin: -10px -135px 0px 72px; background-color:#3D6AD6;padding: 5px 15px;font-size: 14px; "><i class="ti-email menu-icon"></i> Mail</button></div></div>'
                            );
                            if(xhr.application.cm_type == ''){
                                $('#employement').html('<h6 class="text-center">EMPLOYMENT</h6><p class="text-center"><i style="color: red" class="fa fa-times"></i></p>');
                            }if(xhr.application.cm_type != ''){
                                $('#employement').html('<h6 class="text-center">EMPLOYMENT</h6><p class="text-center"><i style="color: green" class="fa fa-check"></i></p>');
                            }
                            if(xhr.application.video == ''){
                                $('#video').html('<h6 class="text-center">VIDEO</h6><p class="text-center"><i style="color: red" class="fa fa-times"></i></p>');
                            }if(xhr.application.video != ''){
                                $('#video').html('<h6 class="text-center">VIDEO</h6><p class="text-center"><i style="color: green" class="fa fa-check"></i></p>');
                            }
                            if(xhr.application.consent_form == ''){
                                $('#consent-form').html('<h6 class="text-center">CONSENT FORM</h6><p class="text-center"><i style="color: red" class="fa fa-times"></i></p>');
                            }if(xhr.application.consent_form != ''){
                                $('#consent-form').html('<h6 class="text-center">CONSENT FORM</h6><p class="text-center"><i style="color: green" class="fa fa-check"></i></p>');
                            }
                    }
                }
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
    function onboard(id){
        swal({
            title: "Are you sure?",
            // text: "Do you want to change status "+msg,
            text: "Do you want to On-Board",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, On-Board Lead!",
            closeOnConfirm: true
            }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: "GET",
                    url: "{{route('onboard.user.details')}}",
                    data: {
                        'id': id,
                    },
                    success: function(response) {
                        if (response.status == 200) {
                            toastr.options.timeOut = 1500;
                            toastr.success('Lead On-Boarded Succesfully');
                            window.open("<?php echo route('get-started'); ?>/admin/view-save-personal/"+response.get_last_id);
                            $("#view-application-form").html('<a type="button" onclick="onboard('+id+');" href="#" class="btn btn-success">On-boarded Customer</a>');
                        }else{
                            toastr.options.timeOut = 1500;
                            toastr.error('This Email ID and Mobile No is already exists');
                        }
                    }
                });
            }
        });
    }
    function submit_personal_details(){
        swal({
            title: "Are you sure?",
            // text: "Do you want to change status "+msg,
            text: "Do you want to update pesonal details",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, update details!",
            closeOnConfirm: true
            }, function (isConfirm) {
            if (isConfirm) {
                var m_id = $('#m_id').val();
                var m_name = $('#m_name').val();

                var mi_name = $('#mi_name').val();
                var ml_name = $('#ml_name').val();

                var m_number = $('#m_number').val();
                var m_email = $('#m_email').val();
                var m_description = $('#m_description').val();
                $.ajax({
                    type: "GET",
                    url: "{{route('get.personal.details')}}",
                    data: {
                        'm_id': m_id,
                        'm_name': m_name,
                        'mi_name': mi_name,
                        'ml_name': ml_name,
                        'm_number': m_number,
                        'm_email': m_email,
                        'm_description': m_description
                    },
                    success: function(response) {
                        if (response.status == 200) {
                            toastr.options.timeOut = 1500;
                            toastr.success('Pesonal Details Update Succesfully');
                            // $("#showrplye").text('Mail Sent Successfully')
                        }
                    }
                });
            }
        });
    }
    </script>
    <script>
    function send_mail() {
        swal({
            title: "Are you sure?",
            // text: "Do you want to change status "+msg,
            text: "Do you want to send mail",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, send!",
            closeOnConfirm: true
            }, function (isConfirm) {
            if (isConfirm) {
                var id = $('#m_id').val();
                var email = $("input[name='email_to']").val();
                var subject = $("input[name='mail_subject']").val();
                var description = CKEDITOR.instances.description.getData();
                $.ajax({
                    type: "GET",
                    url: "{{route('get.mail')}}",
                    data: {
                        'email': email,
                        'subject': subject,
                        'description': description
                    },
                    success: function(response) {
                        if (response.status == 200) {
                            toastr.options.timeOut = 1500;
                            toastr.success('E-mail Send Succesfully');
                            viewmails(id);
                            $("input[name='mail_subject']").val('');
                            CKEDITOR.instances.description.getData('');
                            
                        }
                    }
                });
            }
        });
    }
    </script>
    <script>
    function follow_up_sub(status) {
        swal({
            title: "Are you sure?",
            // text: "Do you want to change status "+msg,
            text: "Do you want to save follow up",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, save!",
            closeOnConfirm: true
            }, function (isConfirm) {
            if (isConfirm) {
                var id = $('#m_id').val();
                var fol_region_follow = $("#fol_region_follow").val();
                var fol_date = $("#fol_date").val();
                var fol_time = $("#fol_time").val();
                var fol_note = $("#fol_note").val();
                $.ajax({
                    type: "GET",
                    url: "{{url('admin/follow_up_sub')}}",
                    data: {
                        status:status,
                        'id': id,
                        'fol_region_follow': fol_region_follow,
                        'fol_date': fol_date,
                        'fol_time': fol_time,
                        'fol_note': fol_note,
                    },
                    success: function(response) {
                        toastr.options.timeOut = 1500;
                        toastr.success('Follow-up Added Succesfully');
                        viewcase(id);

                    }
                });
            }
        });
    }
    </script>
    <script>
    function viewcase(id) {
        var page = 1;
        $('#data-wrapper4').scroll(function() {
            if ($('#data-wrapper4').scrollTop() + $('#data-wrapper4').height() >= $(document).height()) {
                page++;
                infinteLoadMore4(page);
            }
        });
        $.ajax({
                url: "{{url('admin/admin-lead/case-detail')}}?page=" + page,
                datatype: "html",
                data: {
                    id: id
                },
                type: "get",
                beforeSend: function() {
                    $('.auto-load').show();
                    $('.priloder_ajax').show();
                }
            })
            .done(function(response) {
                if (response.length == 0) {
                    $('.auto-load').html("We don't have more data to display :(");
                    return;
                }
                $('.auto-load').hide();
                $("#data-wrapper4").html(response);
                var html = '<div class="priloder_ajax' + page + '">' +
                    '<div class="d-flex justify-content-center">' +
                    '<div class="spinner-grow text-primary" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>' +
                    '</div></div>';
                $("#data-wrapper4").append(html);
                setTimeout(function() {
                    $('.priloder_ajax' + page).hide();
                }, 2000);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
    </script>
    <script>
    function viewmails(id) {
        var id = id;
        var page = 1;
        $('#data-wrapper5').scroll(function() {
            if ($('#data-wrapper5').scrollTop() + $('#data-wrapper5').height() >= $(document).height()) {
                page++;
                infinteLoadMore4(page);
            }
        });
        $.ajax({
                url: "{{url('admin/admin-lead/mail-details')}}?page=" + page,
                datatype: "html",
                data: {
                    id: id
                },
                type: "get",
                beforeSend: function() {
                    $('.auto-load').show();
                    $('.priloder_ajax').show();
                }
            })
            .done(function(response) {
                if (response.length == 0) {
                    $('.auto-load').html("We don't have more data to display :(");
                    return;
                }
                $('.auto-load').hide();
                $("#data-wrapper5").html(response);
                var html = '<div class="priloder_ajax' + page + '">' +
                    '<div class="d-flex justify-content-center">' +
                    '<div class="spinner-grow text-primary" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>' +
                    '</div></div>';
                $("#data-wrapper5").append(html);
                setTimeout(function() {
                    $('.priloder_ajax' + page).hide();
                }, 2000);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script>
        function send_in_close_status(id){
        swal({
            title: "Are you sure?",
            // text: "Do you want to change status "+msg,
            text: "Do you want to change status as complete",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, change status!",
            closeOnConfirm: true
            }, function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type: "GET",
                    url: "{{url('admin/send_in_close_status')}}",
                    data: {
                        'id': id,
                    },
                    success: function(response) {
                        if(response.status == 200) {
                        toastr.options.timeOut = 1500;
                        toastr.success('Lead Closed Succesfully');
                        infinteLoadMore(1);
                        infinteLoadMore1(1);
                        infinteLoadMore2(1);
                        }
                        if(response.status == 400){
                            toastr.error('Employment type is not updated!');
                        }
                        if(response.status == 401){
                            toastr.error('Video KYC is not updated!');
                        }
                        if(response.status == 402){
                            toastr.error('Consent Form is not updated!');
                        }
                    }
                    });
                }
        });
        };
</script>
    @elseif(Auth()->user()->user_type == 3)
    <script>
    CKEDITOR.replace('description');
    </script>
    <script>
    $(window).on('load', function() {
        infinteLoadMore(1);
    });
    </script>
    <script>
    var page = 1;
    $('#data-wrapper').scroll(function() {
        if ($('#data-wrapper').scrollTop() + $('#data-wrapper').height() >= $(document).height()) {
            page++;
            infinteLoadMore(page);
        }
    });
    </script>
    <script>
    function infinteLoadMore(page) {
        $.ajax({
                url: "{{url('agent/agent-lead/tracking-open')}}?page=" + page,
                datatype: "html",
                type: "get",
                beforeSend: function() {
                    $('.auto-load').show();
                    $('.priloder_ajax').show();
                }
            })
            .done(function(response) {
                if (response.length == 0) {
                    $('.auto-load').html("We don't have more data to display :(");
                    return;
                }
                $('.auto-load').hide();
                $("#data-wrapper").append(response);
                var html = '<div class="priloder_ajax' + page + '">' +
                    '<div class="d-flex justify-content-center">' +
                    '<div class="spinner-grow text-primary" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>' +
                    '</div></div>';
                $("#data-wrapper").append(html);
                setTimeout(function() {
                    $('.priloder_ajax' + page).hide();
                }, 2000);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
    </script>
    <script>
    $(window).on('load', function() {
        infinteLoadMore1(1);
    });
    </script>
    <script>
    var page = 1;
    $('#data-wrapper1').scroll(function() {
        if ($('#data-wrapper1').scrollTop() + $('#data-wrapper1').height() >= $(document).height()) {
            page++;
            infinteLoadMore1(page);
        }
    });
    </script>
    <script>
    function infinteLoadMore1(page) {
        $.ajax({
                url: "{{url('agent/agent-lead/tracking-inprocess')}}?page=" + page,
                datatype: "html",
                type: "get",
                beforeSend: function() {
                    $('.auto-load').show();
                    $('.priloder_ajax').show();
                }
            })
            .done(function(response) {
                if (response.length == 0) {
                    $('.auto-load').html("We don't have more data to display :(");
                    return;
                }
                $('.auto-load').hide();
                $("#data-wrapper1").append(response);
                var html = '<div class="priloder_ajax' + page + '">' +
                    '<div class="d-flex justify-content-center">' +
                    '<div class="spinner-grow text-success" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>' +
                    '</div></div>';
                $("#data-wrapper1").append(html);
                setTimeout(function() {
                    $('.priloder_ajax' + page).hide();
                }, 2000);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
    </script>
    <script>
    $(window).on('load', function() {
        infinteLoadMore2(1);
    });
    </script>
    <script>
    var page = 1;
    $('#data-wrapper2').scroll(function() {
        if ($('#data-wrapper2').scrollTop() + $('#data-wrapper2').height() >= $(document).height()) {
            page++;
            infinteLoadMore2(page);
        }
    });
    </script>
    <script>
    function infinteLoadMore2(page) {
        $.ajax({
                url: "{{url('agent/agent-lead/tracking-reminder')}}?page=" + page,
                datatype: "html",
                type: "get",
                beforeSend: function() {
                    $('.auto-load').show();
                    $('.priloder_ajax').show();
                }
            })
            .done(function(response) {
                if (response.length == 0) {
                    $('.auto-load').html("We don't have more data to display :(");
                    return;
                }
                $('.auto-load').hide();
                $("#data-wrapper2").append(response);
                var html = '<div class="priloder_ajax' + page + '">' +
                    '<div class="d-flex justify-content-center">' +
                    '<div class="spinner-grow text-warning" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>' +
                    '</div></div>';
                $("#data-wrapper2").append(html);
                setTimeout(function() {
                    $('.priloder_ajax' + page).hide();
                }, 2000);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
    </script>

    <script>
    function get_popup(id) {

        viewcase(id);
        viewmails(id);
        $.ajax({
                type: 'GET',
                url: "{{url('agent/admin-lead/popup')}}",
                data: {
                    id: id
                },
            })
            .done(function(xhr) {
                if (xhr.status == 200) {
                     $("#m_id").val(xhr.responce.id);
                    $("#sat").html(xhr.responce.saturation);
                    $("#m_name").val(xhr.responce.name);
                    $("#mi_name").val(xhr.responce.mname);
                    $("#ml_name").val(xhr.responce.lname);
                    $("#name1").html(xhr.responce.name);
                    $("#name2").html(xhr.responce.name);
                    $("#m_email").val(xhr.responce.email);
                    $("#email1").html('<a href="mailto:' + xhr.responce.email + '">' + xhr.responce.email + '</a>');
                    $("#m_number").val(xhr.responce.number);
                    $("#number1").html('<a href="tel:' + xhr.responce.number + '">' + xhr.responce.number + '</a>');
                    $("#m_source").val(xhr.responce.source);
                    $("#source").val(xhr.responce.source);
                    $("#m_Lead_product_type").val(xhr.responce.product);
                    $("#m_reference").val(xhr.responce.reference);
                    $("#f_date").html(xhr.responce.f_date);
                    $("#m_leadowner").val(xhr.getuser.name);
                    $("#lead_owner1").html(xhr.getuser.name);
                    $("#m_uploadedby").val(xhr.getupload.name);
                    $("#m_created_at").val(xhr.responce.createdat);
                    $("#m_createdat").val(xhr.responce.createdat);
                    $("#updated").html(xhr.responce.updated_at);
                    $("#product").html(xhr.responce.product);
                    $("#source").html(xhr.responce.source);
                    $("#reference").html(xhr.responce.reference);
                    $("#follow_sub").html('<button type="button" class="btn btn-success" onclick="follow_up_sub(' +
                        xhr.responce.id + ')">Save</button>');
                    if (xhr.responce.lead_status == 'OPEN') {
                        $("#view-application-form").html('');
                        $("#status_bar").html(
                            '<div class="col-sm-1"><div class="form-group"><p style="weight:400; font-size:20px;"><b>Status:</b></p></div></div><div class="col-sm-2" style="z-index:22"><div style="width:155px; height:30px; background-color:#3D6AD6; position:relative; border-radius: 15px 0px 0px 15px;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px;"><h6 style="margin: -8px 0px 0px -115px; color: #fff!important;font-size: 12px;">Open</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #3D6AD6;position:absolute;right: -20px;"></div></div></div><div class="col-sm-2" style="margin-left:-49px; z-index:11"><div onclick="send_in_process_status(' + xhr.responce.id + ')" class="linkstatus" style="cursor:pointer;width:155px; height:30px; background-color:#A7ADAA; position:relative;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px;"><h6 style="margin: -8px 0px 0px -125px; color: #fff!important;font-size: 12px;">In Proccess</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #A7ADAA;position:absolute;right: -20px;"></div></div></div><div class="col-sm-2" style="margin-left:-49px;"><div style="width:155px; height:30px; background-color:#A7ADAA; position:relative;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px; z-index:22;"><h6 style="margin: -8px 0px 0px -125px; color: #fff!important;font-size: 12px;">Reminder</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #A7ADAA;position:absolute;right: -20px; z-index:22;"></div></div></div><div class="col-sm-3" style="margin-left:-49px;"><a type="button"   onclick="send_in_close_status(' +
                            xhr.responce.id +')"><div style="width:200px; height:30px; background-color:#058D3D; position:relative; border-radius: 0px 15px 15px 0px;"><div style="width: 0;height: 0;position:absolute;right: -24px;"><h6 style="margin: 7px 0px 0px -180px; color: #fff!important; font-size: 12px;">Mark status as complete</h6></div></div></a></div><div class="col-sm-1"><div class="form-group" id="markascomplete"><button onclick="show_case_detail()" type="button" class="btn btn-primary btn-lg" style="margin: -10px -100px 0px 0px; background-color:#3D6AD6;padding: 5px 15px;font-size: 14px;"><i class="ti-alarm-clock menu-icon"></i> History </button></div></div><div class="col-sm-1"><div class="form-group" id="markascomplete"><button onclick="show_mail_datails()" type="button" class="btn btn-primary btn-lg" style="margin: -10px -135px 0px 72px; background-color:#3D6AD6; padding: 5px 15px;font-size: 14px;"><i class="ti-email menu-icon"></i> Mail</button></div></div>'
                            );
                    }
                    if (xhr.responce.lead_status == 'INPROCESS') {
                        if(xhr.get_user_exist == null){
                            $("#view-application-form").html('<a type="button" onclick="onboard(' +xhr.responce.id +');" href="#" class="btn btn-warning">Start On Boarding</a>');
                        }else{
                            $("#view-application-form").html('<a type="button" target="_blank" href="<?php echo route('get-started'); ?>/admin/view-save-personal/'+xhr.get_user_exist.id+'" class="btn btn-success">Boarding In Process</a>');
                        }
                        $("#status_bar").html(
                            '<div class="col-sm-1"><div class="form-group"><p style="weight:400; font-size:20px;"><b>Status:</b></p></div></div><div class="col-sm-2" style="z-index:22"><div style="width:155px; height:30px; background-color:#3D6AD6; position:relative; border-radius: 15px 0px 0px 15px;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px;"><h6 style="margin: -8px 0px 0px -115px; color: #fff!important;font-size: 12px;">Open</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #3D6AD6;position:absolute;right: -20px;"></div></div></div><div class="col-sm-2" style="margin-left:-49px; z-index:11"><a type="button" onclick="send_in_process_status(' + xhr.responce.id + ')"><div style="width:155px; height:30px; background-color:#FFB800; position:relative;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px;"><h6 style="margin: -8px 0px 0px -125px; color: #fff!important;font-size: 12px;">In Proccess</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #FFB800;position:absolute;right: -20px;"></div></div></div><div class="col-sm-2" style="margin-left:-49px;"><div style="width:155px; height:30px; background-color:#A7ADAA; position:relative;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px; z-index:22;"><h6 style="margin: -8px 0px 0px -125px; color: #fff!important;font-size: 12px;">Reminder</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #A7ADAA;position:absolute;right: -20px; z-index:22;"></div></div></div><div class="col-sm-3" style="margin-left:-49px;"><a type="button"   onclick="send_in_close_status(' +
                            xhr.responce.id +')"><div style="width:200px; height:30px; background-color:#058D3D; position:relative; border-radius: 0px 15px 15px 0px;"><div style="width: 0;height: 0;position:absolute;right: -24px;"><h6 style="margin: 7px 0px 0px -180px; color: #fff!important; font-size: 12px;">Mark status as complete</h6></div></div></a></div><div class="col-sm-1"><div class="form-group" id="markascomplete"><button onclick="show_case_detail()" type="button" class="btn btn-primary btn-lg" style="margin: -10px -100px 0px 0px; background-color:#3D6AD6;padding: 5px 15px;font-size: 14px;"><i class="ti-alarm-clock menu-icon"></i> History </button></div></div><div class="col-sm-1"><div class="form-group" id="markascomplete"><button onclick="show_mail_datails()" type="button" class="btn btn-primary btn-lg" style="margin: -10px -135px 0px 72px; background-color:#3D6AD6;padding: 5px 15px;font-size: 14px;"><i class="ti-email menu-icon"></i> Mail</button></div></div>'
                            );
                    }
                    if (xhr.responce.lead_status == 'REMINDER') {
                        if(xhr.get_user_exist == null){
                            $("#view-application-form").html('<a type="button" onclick="onboard(' +xhr.responce.id +');" href="#" class="btn btn-warning">Start On Boarding</a>');
                        }else{
                            $("#view-application-form").html('<a type="button" target="_blank" href="<?php echo route('get-started'); ?>/admin/view-save-personal/'+xhr.get_user_exist.id+'" class="btn btn-success">Boarding In Process</a>');
                        }
                        $("#status_bar").html(
                            '<div class="col-sm-1"><div class="form-group"><p style="weight:400; font-size:20px;"><b>Status:</b></p></div></div><div class="col-sm-2" style="z-index:22"><div style="width:155px; height:30px; background-color:#3D6AD6; position:relative; border-radius: 15px 0px 0px 15px;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px;"><h6 style="margin: -8px 0px 0px -115px; color: #fff!important;font-size: 12px;">Open</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #3D6AD6;position:absolute;right: -20px;"></div></div></div><div class="col-sm-2" style="margin-left:-49px; z-index:11"><a type="button"  onclick="send_in_process_status(' + xhr.responce.id + ')"><div style="width:155px; height:30px; background-color:#FFB800; position:relative;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px;"><h6 style="margin: -8px 0px 0px -125px; color: #fff!important;font-size: 12px;">In Proccess</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #FFB800;position:absolute;right: -20px;"></div></div></a></div><div class="col-sm-2" style="margin-left:-49px;"><a href="#"><div style="width:155px; height:30px; background-color:#FF8A00; position:relative;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px; z-index:22;"><h6 style="margin: -8px 0px 0px -125px; color: #fff!important;font-size: 12px;">Reminder</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #FF8A00;position:absolute;right: -20px; z-index:22;"></div></div></div></a><div class="col-sm-3" style="margin-left:-49px;"><a type="button"   onclick="send_in_close_status(' +
                             xhr.responce.id + ')"><div style="width:200px; height:30px; background-color:#058D3D; position:relative; border-radius: 0px 15px 15px 0px;"><div style="width: 0;height: 0;position:absolute;right: -24px;"><h6 style="margin: 7px 0px 0px -180px; color: #fff!important; font-size: 12px;">Mark status as complete</h6></div></div></a></div><div class="col-sm-1"><div class="form-group" id="markascomplete"><button onclick="show_case_detail()" type="button" class="btn btn-primary btn-lg" style="margin: -10px -100px 0px 0px; background-color:#3D6AD6;padding: 5px 15px;font-size: 14px;"><i class="ti-alarm-clock menu-icon"></i> History </button></div></div><div class="col-sm-1"><div class="form-group" id="markascomplete"><button onclick="show_mail_datails()" type="button" class="btn btn-primary btn-lg" style="margin: -10px -135px 0px 72px; background-color:#3D6AD6;padding: 5px 15px;font-size: 14px; "><i class="ti-email menu-icon"></i> Mail</button></div></div>'
                            );
                    }


                }
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
    </script>
    <script>
    function send_mail() {
        var email = $("input[name='email_to']").val();
        var subject = $("input[name='mail_subject']").val();
        var description = CKEDITOR.instances.description.getData();
        $.ajax({
            type: "GET",
            url: "{{route('agent.get.mail')}}",
            data: {
                'email': email,
                'subject': subject,
                'description': description
            },
            success: function(response) {
                if (response.status == 200) {
                    $("#showrplye").text('Mail Sent Successfully')
                }
            }
        });
    }
    </script>
      <script>
    function send_in_close_status(id) {
        $("#hidden_id").val(id);
    }
    function final_close_sataus(id){
        var id = $("#hidden_id").val();
          $.ajax({
            type: "GET",
            url: "{{url('agent/send_in_close_status')}}",
            data: {
                'id': id,
            },
            success: function(response) {
                    location.reload();
            }
        });
    }
    </script>
    <script>
    function follow_up_sub(id) {
        var id = id;
        var fol_region_follow = $("#fol_region_follow").val();
        var fol_date = $("#fol_date").val();
        var fol_time = $("#fol_time").val();
        var fol_note = $("#fol_note").val();
        $.ajax({
            type: "GET",
            url: "{{url('agent/follow_up_sub')}}",
            data: {
                'id': id,
                'fol_region_follow': fol_region_follow,
                'fol_date': fol_date,
                'fol_time': fol_time,
                'fol_note': fol_note,
            },
            success: function(response) {
                location.reload();
            }
        });
    }
    </script>
    <script>
    function viewcase(id) {
        var id = id;
        var page = 1;
        $('#data-wrapper4').scroll(function() {
            if ($('#data-wrapper4').scrollTop() + $('#data-wrapper4').height() >= $(document).height()) {
                page++;
                infinteLoadMore4(page);
            }
        });
        $.ajax({
                url: "{{url('agent/admin-lead/case-detail')}}?page=" + page,
                datatype: "html",
                data: {
                    id: id
                },
                type: "get",
                beforeSend: function() {
                    $('.auto-load').show();
                    $('.priloder_ajax').show();
                }
            })
            .done(function(response) {
                if (response.length == 0) {
                    $('.auto-load').html("We don't have more data to display :(");
                    return;
                }
                $('.auto-load').hide();
                $("#data-wrapper4").html(response);
                var html = '<div class="priloder_ajax' + page + '">' +
                    '<div class="d-flex justify-content-center">' +
                    '<div class="spinner-grow text-primary" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>' +
                    '</div></div>';
                $("#data-wrapper4").append(html);
                setTimeout(function() {
                    $('.priloder_ajax' + page).hide();
                }, 2000);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
    </script>
    <script>
    function viewmails(id) {
        var id = id;
        var page = 1;
        $('#data-wrapper5').scroll(function() {
            if ($('#data-wrapper5').scrollTop() + $('#data-wrapper5').height() >= $(document).height()) {
                page++;
                infinteLoadMore4(page);
            }
        });
        $.ajax({
                url: "{{url('agent/admin-lead/mail-details')}}?page=" + page,
                datatype: "html",
                data: {
                    id: id
                },
                type: "get",
                beforeSend: function() {
                    $('.auto-load').show();
                    $('.priloder_ajax').show();
                }
            })
            .done(function(response) {
                if (response.length == 0) {
                    $('.auto-load').html("We don't have more data to display :(");
                    return;
                }
                $('.auto-load').hide();
                $("#data-wrapper5").html(response);
                var html = '<div class="priloder_ajax' + page + '">' +
                    '<div class="d-flex justify-content-center">' +
                    '<div class="spinner-grow text-primary" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>' +
                    '</div></div>';
                $("#data-wrapper5").append(html);
                setTimeout(function() {
                    $('.priloder_ajax' + page).hide();
                }, 2000);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
    </script>
    @elseif(Auth()->user()->user_type == 4)
    <script>
    CKEDITOR.replace('description');
    </script>
    <script>
    $(window).on('load', function() {
        infinteLoadMore(1);
    });
    </script>
    <script>
    var page = 1;
    $('#data-wrapper').scroll(function() {
        if ($('#data-wrapper').scrollTop() + $('#data-wrapper').height() >= $(document).height()) {
            page++;
            infinteLoadMore(page);
        }
    });
    </script>
    <script>
    function infinteLoadMore(page) {
        $.ajax({
                url: "{{url('employee/emp-lead/tracking-open')}}?page=" + page,
                datatype: "html",
                type: "get",
                beforeSend: function() {
                    $('.auto-load').show();
                    $('.priloder_ajax').show();
                }
            })
            .done(function(response) {
                if (response.length == 0) {
                    $('.auto-load').html("We don't have more data to display :(");
                    return;
                }
                $('.auto-load').hide();
                $("#data-wrapper").append(response);
                var html = '<div class="priloder_ajax' + page + '">' +
                    '<div class="d-flex justify-content-center">' +
                    '<div class="spinner-grow text-primary" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>' +
                    '</div></div>';
                $("#data-wrapper").append(html);
                setTimeout(function() {
                    $('.priloder_ajax' + page).hide();
                }, 2000);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
    </script>
    <script>
    $(window).on('load', function() {
        infinteLoadMore1(1);
    });
    </script>
    <script>
    var page = 1;
    $('#data-wrapper1').scroll(function() {
        if ($('#data-wrapper1').scrollTop() + $('#data-wrapper1').height() >= $(document).height()) {
            page++;
            infinteLoadMore1(page);
        }
    });
    </script>
    <script>
    function infinteLoadMore1(page) {
        $.ajax({
                url: "{{url('employee/emp-lead/tracking-inprocess')}}?page=" + page,
                datatype: "html",
                type: "get",
                beforeSend: function() {
                    $('.auto-load').show();
                    $('.priloder_ajax').show();
                }
            })
            .done(function(response) {
                if (response.length == 0) {
                    $('.auto-load').html("We don't have more data to display :(");
                    return;
                }
                $('.auto-load').hide();
                $("#data-wrapper1").append(response);
                var html = '<div class="priloder_ajax' + page + '">' +
                    '<div class="d-flex justify-content-center">' +
                    '<div class="spinner-grow text-success" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>' +
                    '</div></div>';
                $("#data-wrapper1").append(html);
                setTimeout(function() {
                    $('.priloder_ajax' + page).hide();
                }, 2000);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
    </script>
    <script>
    $(window).on('load', function() {
        infinteLoadMore2(1);
    });
    </script>
    <script>
    var page = 1;
    $('#data-wrapper2').scroll(function() {
        if ($('#data-wrapper2').scrollTop() + $('#data-wrapper2').height() >= $(document).height()) {
            page++;
            infinteLoadMore2(page);
        }
    });
    </script>
    <script>
    function infinteLoadMore2(page) {
        $.ajax({
                url: "{{url('employee/emp-lead/tracking-reminder')}}?page=" + page,
                datatype: "html",
                type: "get",
                beforeSend: function() {
                    $('.auto-load').show();
                    $('.priloder_ajax').show();
                }
            })
            .done(function(response) {
                if (response.length == 0) {
                    $('.auto-load').html("We don't have more data to display :(");
                    return;
                }
                $('.auto-load').hide();
                $("#data-wrapper2").append(response);
                var html = '<div class="priloder_ajax' + page + '">' +
                    '<div class="d-flex justify-content-center">' +
                    '<div class="spinner-grow text-warning" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>' +
                    '</div></div>';
                $("#data-wrapper2").append(html);
                setTimeout(function() {
                    $('.priloder_ajax' + page).hide();
                }, 2000);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
    </script>

    <script>
    function get_popup(id) {

        viewcase(id);
        viewmails(id);
        $.ajax({
                type: 'GET',
                url: "{{url('employee/admin-lead/popup')}}",
                data: {
                    id: id
                },
            })
            .done(function(xhr) {
                if (xhr.status == 200) {
                    $("#m_name").val(xhr.responce.name);
                    $("#name1").html(xhr.responce.name);
                    $("#name2").html(xhr.responce.name);
                    $("#sat").html(xhr.responce.saturation);
                    $("#m_email").val(xhr.responce.email);

                    $("#email1").html('<a href="mailto:' + xhr.responce.email + '">' + xhr.responce.email + '</a>');
                    $("#m_number").val(xhr.responce.number);
                    $("#number1").html('<a href="tel:' + xhr.responce.number + '">' + xhr.responce.number + '</a>');
                    $("#m_source").val(xhr.responce.source);
                    $("#source").val(xhr.responce.source);
                    $("#m_Lead_product_type").val(xhr.responce.product);
                    $("#m_reference").val(xhr.responce.reference);
                    $("#f_date").html(xhr.responce.f_date);
                    $("#m_leadowner").val(xhr.getuser.name);
                    $("#lead_owner1").html(xhr.getuser.name);
                    $("#m_uploadedby").val(xhr.getupload.name);
                    $("#m_created_at").val(xhr.responce.createdat);
                    $("#m_createdat").val(xhr.responce.createdat);
                    $("#updated").html(xhr.responce.updated_at);
                    $("#product").html(xhr.responce.product);
                    $("#source").html(xhr.responce.source);
                    $("#reference").html(xhr.responce.reference);
                    $("#follow_sub").html('<a type="button" class="btn btn-success" onclick="follow_up_sub(' + xhr
                        .responce.id + ')">Save</a>');
                    if (xhr.responce.lead_status == 'OPEN') {
                        $("#status_bar").html(
                            '<div class="col-sm-1"><div class="form-group"><p style="weight:400; font-size:20px;"><b>Status:</b></p></div></div><div class="col-sm-2" style="z-index:22"><div style="width:155px; height:30px; background-color:#3D6AD6; position:relative; border-radius: 15px 0px 0px 15px;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px;"><h6 style="margin: -8px 0px 0px -115px; color: #fff!important;font-size: 12px;">Open</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #3D6AD6;position:absolute;right: -20px;"></div></div></div><div class="col-sm-2" style="margin-left:-49px; z-index:11"><div onclick="send_in_process_status(' + xhr.responce.id + ')" class="linkstatus" style="cursor:pointer; width:155px; height:30px; background-color:#A7ADAA; position:relative;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px;"><h6 style="margin: -8px 0px 0px -125px; color: #fff!important;font-size: 12px;">In Proccess</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #A7ADAA;position:absolute;right: -20px;"></div></div></div><div class="col-sm-2" style="margin-left:-49px;"><div style="width:155px; height:30px; background-color:#A7ADAA; position:relative;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px; z-index:22;"><h6 style="margin: -8px 0px 0px -125px; color: #fff!important;font-size: 12px;">Reminder</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #A7ADAA;position:absolute;right: -20px; z-index:22;"></div></div></div><div class="col-sm-3" style="margin-left:-49px;"><a type="button"    onclick="send_in_close_status(' +
                            xhr.responce.id + ')"><div style="width:200px; height:30px; background-color:#058D3D; position:relative; border-radius: 0px 15px 15px 0px;"><div style="width: 0;height: 0;position:absolute;right: -24px;"><h6 style="margin: 7px 0px 0px -180px; color: #fff!important; font-size: 12px;">Mark status as complete</h6></div></div></a></div><div class="col-sm-1"><div class="form-group" id="markascomplete"><button onclick="show_case_detail()" type="button" class="btn btn-primary btn-lg" style="margin: -10px -100px 0px 0px; background-color:#3D6AD6;padding: 5px 15px;font-size: 14px;"><i class="ti-alarm-clock menu-icon"></i> History </button></div></div><div class="col-sm-1"><div class="form-group" id="markascomplete"><button onclick="show_mail_datails()" type="button" class="btn btn-primary btn-lg" style="margin: -10px -135px 0px 72px; background-color:#3D6AD6;padding: 5px 15px;font-size: 14px; "><i class="ti-email menu-icon"></i> Mail</button></div></div>'
                            );
                    }
                    if (xhr.responce.lead_status == 'INPROCESS') {
                        $("#status_bar").html(
                            '<div class="col-sm-1"><div class="form-group"><p style="weight:400; font-size:20px;"><b>Status:</b></p></div></div><div class="col-sm-2" style="z-index:22"><div style="width:155px; height:30px; background-color:#3D6AD6; position:relative; border-radius: 15px 0px 0px 15px;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px;"><h6 style="margin: -8px 0px 0px -115px; color: #fff!important;font-size: 12px;">Open</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #3D6AD6;position:absolute;right: -20px;"></div></div></div><div class="col-sm-2" style="margin-left:-49px; z-index:11"><a type="button" onclick="send_in_process_status(' + xhr.responce.id + ')"><div style="width:155px; height:30px; background-color:#FFB800; position:relative;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px;"><h6 style="margin: -8px 0px 0px -125px; color: #fff!important;font-size: 12px;">In Proccess</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #FFB800;position:absolute;right: -20px;"></div></div></div><div class="col-sm-2" style="margin-left:-49px;"><div style="width:155px; height:30px; background-color:#A7ADAA; position:relative;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px; z-index:22;"><h6 style="margin: -8px 0px 0px -125px; color: #fff!important;font-size: 12px;">Reminder</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #A7ADAA;position:absolute;right: -20px; z-index:22;"></div></div></div><div class="col-sm-3" style="margin-left:-49px;"><a type="button"   onclick="send_in_close_status(' + xhr.responce.id +
                            ')"><div style="width:200px; height:30px; background-color:#058D3D; position:relative; border-radius: 0px 15px 15px 0px;"><div style="width: 0;height: 0;position:absolute;right: -24px;"><h6 style="margin: 7px 0px 0px -180px; color: #fff!important; font-size: 12px;">Mark status as complete</h6></div></div></a></div><div class="col-sm-1"><div class="form-group" id="markascomplete"><button onclick="show_case_detail()" type="button" class="btn btn-primary btn-lg" style="margin: -10px -100px 0px 0px; background-color:#3D6AD6;padding: 5px 15px;font-size: 14px;"><i class="ti-alarm-clock menu-icon"></i> History </button></div></div><div class="col-sm-1"><div class="form-group" id="markascomplete"><button onclick="show_mail_datails()" type="button" class="btn btn-primary btn-lg" style="margin: -10px -135px 0px 72px; background-color:#3D6AD6;padding: 5px 15px;font-size: 14px; "><i class="ti-email menu-icon"></i> Mail</button></div></div>'
                            );
                    }
                    if (xhr.responce.lead_status == 'REMINDER') {
                        $("#status_bar").html(
                            '<div class="col-sm-1"><div class="form-group"><p style="weight:400; font-size:20px;"><b>Status:</b></p></div></div><div class="col-sm-2" style="z-index:22"><div style="width:155px; height:30px; background-color:#3D6AD6; position:relative; border-radius: 15px 0px 0px 15px;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px;"><h6 style="margin: -8px 0px 0px -115px; color: #fff!important;font-size: 12px;">Open</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #3D6AD6;position:absolute;right: -20px;"></div></div></div><div class="col-sm-2" style="margin-left:-49px; z-index:11"><a type="pointer" onclick="send_in_process_status(' + xhr.responce.id + ')"><div style="width:155px; height:30px; background-color:#FFB800; position:relative;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px;"><h6 style="margin: -8px 0px 0px -125px; color: #fff!important;font-size: 12px;">In Proccess</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #FFB800;position:absolute;right: -20px;"></div></div></a></div><div class="col-sm-2" style="margin-left:-49px;"><a href="#"><div style="width:155px; height:30px; background-color:#FF8A00; position:relative;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px; z-index:22;"><h6 style="margin: -8px 0px 0px -125px; color: #fff!important;font-size: 12px;">Reminder</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #FF8A00;position:absolute;right: -20px; z-index:22;"></div></div></div></a><div class="col-sm-3" style="margin-left:-49px;"><a type="button"    onclick="send_in_close_status(' +
                            xhr.responce.id + ')"><div style="width:200px; height:30px; background-color:#058D3D; position:relative; border-radius: 0px 15px 15px 0px;"><div style="width: 0;height: 0;position:absolute;right: -24px;"><h6 style="margin: 7px 0px 0px -180px; color: #fff!important; font-size: 12px;">Mark status as complete</h6></div></div></a></div><div class="col-sm-1"><div class="form-group" id="markascomplete"><button onclick="show_case_detail()" type="button" class="btn btn-primary btn-lg" style="margin: -10px -100px 0px 0px; background-color:#3D6AD6;padding: 5px 15px;font-size: 14px;"><i class="ti-alarm-clock menu-icon"></i> History </button></div></div><div class="col-sm-1"><div class="form-group" id="markascomplete"><button onclick="show_mail_datails()" type="button" class="btn btn-primary btn-lg" style="margin: -10px -135px 0px 72px; background-color:#3D6AD6; padding: 5px 15px;font-size: 14px;"><i class="ti-email menu-icon"></i> Mail</button></div></div>'
                            );
                    }


                }
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
    </script>
    <script>
    function send_mail() {
        var email = $("input[name='email_to']").val();
        var subject = $("input[name='mail_subject']").val();
        var description = CKEDITOR.instances.description.getData();
        $.ajax({
            type: "GET",
            url: "{{route('emp.get.mail')}}",
            data: {
                'email': email,
                'subject': subject,
                'description': description
            },
            success: function(response) {
                if (response.status == 200) {
                    $("#showrplye").text('Mail Sent Successfully')
                }
            }
        });
    }
    </script>
    </script>
    </script>
    <script>
    function send_in_close_status(id) {
        $("#hidden_id").val(id);
    }
    function final_close_sataus(id){
        var id = $("#hidden_id").val();
          $.ajax({
            type: "GET",
            url: "{{url('employee/send_in_close_status')}}",
            data: {
                'id': id,
            },
            success: function(response) {
                    location.reload();
            }
        });
    }
    </script>
    <script>
    function follow_up_sub(id) {
        var id = id;
        var fol_region_follow = $("#fol_region_follow").val();
        var fol_date = $("#fol_date").val();
        var fol_time = $("#fol_time").val();
        var fol_note = $("#fol_note").val();
        $.ajax({
            type: "GET",
            url: "{{url('employee/follow_up_sub')}}",
            data: {
                'id': id,
                'fol_region_follow': fol_region_follow,
                'fol_date': fol_date,
                'fol_time': fol_time,
                'fol_note': fol_note,
            },
            success: function(response) {
                location.reload();
            }
        });
    }
    </script>
    <script>
    function viewcase(id) {
        var id = id;
        var page = 1;
        $('#data-wrapper4').scroll(function() {
            if ($('#data-wrapper4').scrollTop() + $('#data-wrapper4').height() >= $(document).height()) {
                page++;
                infinteLoadMore4(page);
            }
        });
        $.ajax({
                url: "{{url('employee/admin-lead/case-detail')}}?page=" + page,
                datatype: "html",
                data: {
                    id: id
                },
                type: "get",
                beforeSend: function() {
                    $('.auto-load').show();
                    $('.priloder_ajax').show();
                }
            })
            .done(function(response) {
                if (response.length == 0) {
                    $('.auto-load').html("We don't have more data to display :(");
                    return;
                }
                $('.auto-load').hide();
                $("#data-wrapper4").html(response);
                var html = '<div class="priloder_ajax' + page + '">' +
                    '<div class="d-flex justify-content-center">' +
                    '<div class="spinner-grow text-primary" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>' +
                    '</div></div>';
                $("#data-wrapper4").append(html);
                setTimeout(function() {
                    $('.priloder_ajax' + page).hide();
                }, 2000);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
    </script>
    <script>
    function viewmails(id) {
        var id = id;
        var page = 1;
        $('#data-wrapper5').scroll(function() {
            if ($('#data-wrapper5').scrollTop() + $('#data-wrapper5').height() >= $(document).height()) {
                page++;
                infinteLoadMore4(page);
            }
        });
        $.ajax({
                url: "{{url('employee/admin-lead/mail-details')}}?page=" + page,
                datatype: "html",
                data: {
                    id: id
                },
                type: "get",
                beforeSend: function() {
                    $('.auto-load').show();
                    $('.priloder_ajax').show();
                }
            })
            .done(function(response) {
                if (response.length == 0) {
                    $('.auto-load').html("We don't have more data to display :(");
                    return;
                }
                $('.auto-load').hide();
                $("#data-wrapper5").html(response);
                var html = '<div class="priloder_ajax' + page + '">' +
                    '<div class="d-flex justify-content-center">' +
                    '<div class="spinner-grow text-primary" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>' +
                    '</div></div>';
                $("#data-wrapper5").append(html);
                setTimeout(function() {
                    $('.priloder_ajax' + page).hide();
                }, 2000);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
    </script>
    @elseif(Auth()->user()->user_type == 5)
    <script>
    CKEDITOR.replace('description');
    </script>
    <script>
    $(window).on('load', function() {
        infinteLoadMore(1);
    });
    </script>
    <script>
    var page = 1;
    $('#data-wrapper').scroll(function() {
        if ($('#data-wrapper').scrollTop() + $('#data-wrapper').height() >= $(document).height()) {
            page++;
            infinteLoadMore(page);
        }
    });
    </script>
    <script>
    function infinteLoadMore(page) {
        $.ajax({
                url: "{{url('manager/emp-lead/tracking-open')}}?page=" + page,
                datatype: "html",
                type: "get",
                beforeSend: function() {
                    $('.auto-load').show();
                    $('.priloder_ajax').show();
                }
            })
            .done(function(response) {
                if (response.length == 0) {
                    $('.auto-load').html("We don't have more data to display :(");
                    return;
                }
                $('.auto-load').hide();
                $("#data-wrapper").append(response);
                var html = '<div class="priloder_ajax' + page + '">' +
                    '<div class="d-flex justify-content-center">' +
                    '<div class="spinner-grow text-primary" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>' +
                    '</div></div>';
                $("#data-wrapper").append(html);
                setTimeout(function() {
                    $('.priloder_ajax' + page).hide();
                }, 2000);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
    </script>
    <script>
    $(window).on('load', function() {
        infinteLoadMore1(1);
    });
    </script>
    <script>
    var page = 1;
    $('#data-wrapper1').scroll(function() {
        if ($('#data-wrapper1').scrollTop() + $('#data-wrapper1').height() >= $(document).height()) {
            page++;
            infinteLoadMore1(page);
        }
    });
    </script>
    <script>
    function infinteLoadMore1(page) {
        $.ajax({
                url: "{{url('manager/emp-lead/tracking-inprocess')}}?page=" + page,
                datatype: "html",
                type: "get",
                beforeSend: function() {
                    $('.auto-load').show();
                    $('.priloder_ajax').show();
                }
            })
            .done(function(response) {
                if (response.length == 0) {
                    $('.auto-load').html("We don't have more data to display :(");
                    return;
                }
                $('.auto-load').hide();
                $("#data-wrapper1").append(response);
                var html = '<div class="priloder_ajax' + page + '">' +
                    '<div class="d-flex justify-content-center">' +
                    '<div class="spinner-grow text-success" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>' +
                    '</div></div>';
                $("#data-wrapper1").append(html);
                setTimeout(function() {
                    $('.priloder_ajax' + page).hide();
                }, 2000);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
    </script>
    <script>
    $(window).on('load', function() {
        infinteLoadMore2(1);
    });
    </script>
    <script>
    var page = 1;
    $('#data-wrapper2').scroll(function() {
        if ($('#data-wrapper2').scrollTop() + $('#data-wrapper2').height() >= $(document).height()) {
            page++;
            infinteLoadMore2(page);
        }
    });
    </script>
    <script>
    function infinteLoadMore2(page) {
        $.ajax({
                url: "{{url('manager/emp-lead/tracking-reminder')}}?page=" + page,
                datatype: "html",
                type: "get",
                beforeSend: function() {
                    $('.auto-load').show();
                    $('.priloder_ajax').show();
                }
            })
            .done(function(response) {
                if (response.length == 0) {
                    $('.auto-load').html("We don't have more data to display :(");
                    return;
                }
                $('.auto-load').hide();
                $("#data-wrapper2").append(response);
                var html = '<div class="priloder_ajax' + page + '">' +
                    '<div class="d-flex justify-content-center">' +
                    '<div class="spinner-grow text-warning" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>' +
                    '</div></div>';
                $("#data-wrapper2").append(html);
                setTimeout(function() {
                    $('.priloder_ajax' + page).hide();
                }, 2000);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
    </script>

    <script>
    function get_popup(id) {

        viewcase(id);
        viewmails(id);
        $.ajax({
                type: 'GET',
                url: "{{url('manager/admin-lead/popup')}}",
                data: {
                    id: id
                },
            })
            .done(function(xhr) {
                if (xhr.status == 200) {
                    $("#m_name").val(xhr.responce.name);
                    $("#name1").html(xhr.responce.name);
                    $("#name2").html(xhr.responce.name);
                    $("#sat").html(xhr.responce.saturation);
                    $("#m_email").val(xhr.responce.email);
                    $("#email1").html('<a href="mailto:' + xhr.responce.email + '">' + xhr.responce.email + '</a>');
                    $("#m_number").val(xhr.responce.number);
                    $("#number1").html('<a href="tel:' + xhr.responce.number + '">' + xhr.responce.number + '</a>');
                    $("#m_source").val(xhr.responce.source);
                    $("#source").val(xhr.responce.source);
                    $("#m_Lead_product_type").val(xhr.responce.product);
                    $("#m_reference").val(xhr.responce.reference);
                    $("#f_date").html(xhr.responce.f_date);
                    $("#m_leadowner").val(xhr.getuser.name);
                    $("#lead_owner1").html(xhr.getuser.name);
                    $("#m_uploadedby").val(xhr.getupload.name);
                    $("#m_created_at").val(xhr.responce.createdat);
                    $("#m_createdat").val(xhr.responce.createdat);
                    $("#updated").html(xhr.responce.updated_at);
                    $("#product").html(xhr.responce.product);
                    $("#source").html(xhr.responce.source);
                    $("#reference").html(xhr.responce.reference);
                    $("#follow_sub").html('<a type="button" class="btn btn-success" onclick="follow_up_sub(' + xhr
                        .responce.id + ')">Save</a>');
                    if (xhr.responce.lead_status == 'OPEN') {
                        $("#status_bar").html(
                            '<div class="col-sm-1"><div class="form-group"><p style="weight:400; font-size:20px;"><b>Status:</b></p></div></div><div class="col-sm-2" style="z-index:22"><div style="width:155px; height:30px; background-color:#3D6AD6; position:relative; border-radius: 15px 0px 0px 15px;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px;"><h6 style="margin: -8px 0px 0px -115px; color: #fff!important;font-size: 12px;">Open</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #3D6AD6;position:absolute;right: -20px;"></div></div></div><div class="col-sm-2" style="margin-left:-49px; z-index:11"><div onclick="send_in_process_status(' + xhr.responce.id + ')" class="linkstatus" style="cursor:pointer; width:155px; height:30px; background-color:#A7ADAA; position:relative;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px;"><h6 style="margin: -8px 0px 0px -125px; color: #fff!important;font-size: 12px;">In Proccess</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #A7ADAA;position:absolute;right: -20px;"></div></div></div><div class="col-sm-2" style="margin-left:-49px;"><div style="width:155px; height:30px; background-color:#A7ADAA; position:relative;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px; z-index:22;"><h6 style="margin: -8px 0px 0px -125px; color: #fff!important;font-size: 12px;">Reminder</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #A7ADAA;position:absolute;right: -20px; z-index:22;"></div></div></div><div class="col-sm-3" style="margin-left:-49px;"><a type="button"    onclick="send_in_close_status(' +
                            xhr.responce.id + ')"><div style="width:200px; height:30px; background-color:#058D3D; position:relative; border-radius: 0px 15px 15px 0px;"><div style="width: 0;height: 0;position:absolute;right: -24px;"><h6 style="margin: 7px 0px 0px -180px; color: #fff!important; font-size: 12px;">Mark status as complete</h6></div></div></a></div><div class="col-sm-1"><div class="form-group" id="markascomplete"><button onclick="show_case_detail()" type="button" class="btn btn-primary btn-lg" style="margin: -10px -100px 0px 0px; background-color:#3D6AD6;padding: 5px 15px;font-size: 14px;"><i class="ti-alarm-clock menu-icon"></i> History </button></div></div><div class="col-sm-1"><div class="form-group" id="markascomplete"><button onclick="show_mail_datails()" type="button" class="btn btn-primary btn-lg" style="margin: -10px -135px 0px 72px; background-color:#3D6AD6;padding: 5px 15px;font-size: 14px; "><i class="ti-email menu-icon"></i> Mail</button></div></div>'
                            );
                    }
                    if (xhr.responce.lead_status == 'INPROCESS') {
                        $("#status_bar").html(
                            '<div class="col-sm-1"><div class="form-group"><p style="weight:400; font-size:20px;"><b>Status:</b></p></div></div><div class="col-sm-2" style="z-index:22"><div style="width:155px; height:30px; background-color:#3D6AD6; position:relative; border-radius: 15px 0px 0px 15px;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px;"><h6 style="margin: -8px 0px 0px -115px; color: #fff!important;font-size: 12px;">Open</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #3D6AD6;position:absolute;right: -20px;"></div></div></div><div class="col-sm-2" style="margin-left:-49px; z-index:11"><a type="button" onclick="send_in_process_status(' + xhr.responce.id + ')"><div style="width:155px; height:30px; background-color:#FFB800; position:relative;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px;"><h6 style="margin: -8px 0px 0px -125px; color: #fff!important;font-size: 12px;">In Proccess</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #FFB800;position:absolute;right: -20px;"></div></div></div><div class="col-sm-2" style="margin-left:-49px;"><div style="width:155px; height:30px; background-color:#A7ADAA; position:relative;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px; z-index:22;"><h6 style="margin: -8px 0px 0px -125px; color: #fff!important;font-size: 12px;">Reminder</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #A7ADAA;position:absolute;right: -20px; z-index:22;"></div></div></div><div class="col-sm-3" style="margin-left:-49px;"><a type="button"   onclick="send_in_close_status(' + xhr.responce.id + ')"><div style="width:200px; height:30px; background-color:#058D3D; position:relative; border-radius: 0px 15px 15px 0px;"><div style="width: 0;height: 0;position:absolute;right: -24px;"><h6 style="margin: 7px 0px 0px -180px; color: #fff!important; font-size: 12px;">Mark status as complete</h6></div></div></a></div><div class="col-sm-1"><div class="form-group" id="markascomplete"><button onclick="show_case_detail()" type="button" class="btn btn-primary btn-lg" style="margin: -10px -100px 0px 0px; background-color:#3D6AD6;padding: 5px 15px;font-size: 14px;"><i class="ti-alarm-clock menu-icon"></i> History </button></div></div><div class="col-sm-1"><div class="form-group" id="markascomplete"><button onclick="show_mail_datails()" type="button" class="btn btn-primary btn-lg" style="margin: -10px -135px 0px 72px; background-color:#3D6AD6;padding: 5px 15px;font-size: 14px; "><i class="ti-email menu-icon"></i> Mail</button></div></div>'
                            );
                    }
                    if (xhr.responce.lead_status == 'REMINDER') {
                        $("#status_bar").html(
                            '<div class="col-sm-1"><div class="form-group"><p style="weight:400; font-size:20px;"><b>Status:</b></p></div></div><div class="col-sm-2" style="z-index:22"><div style="width:155px; height:30px; background-color:#3D6AD6; position:relative; border-radius: 15px 0px 0px 15px;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px;"><h6 style="margin: -8px 0px 0px -115px; color: #fff!important;font-size: 12px;">Open</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #3D6AD6;position:absolute;right: -20px;"></div></div></div><div class="col-sm-2" style="margin-left:-49px; z-index:11"><a type="button"  onclick="send_in_process_status(' + xhr.responce.id + ')"><div style="width:155px; height:30px; background-color:#FFB800; position:relative;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px;"><h6 style="margin: -8px 0px 0px -125px; color: #fff!important;font-size: 12px;">In Proccess</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #FFB800;position:absolute;right: -20px;"></div></div></a></div><div class="col-sm-2" style="margin-left:-49px;"><a href="#"><div style="width:155px; height:30px; background-color:#FF8A00; position:relative;"><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #fff;position:absolute;right: -24px; z-index:22;"><h6 style="margin: -8px 0px 0px -125px; color: #fff!important;font-size: 12px;">Reminder</h6></div><div style="width: 0;height: 0;border-top: 15px solid transparent;border-bottom: 15px solid transparent;border-left: 20px solid #FF8A00;position:absolute;right: -20px; z-index:22;"></div></div></div></a><div class="col-sm-3" style="margin-left:-49px;"><a type="button"   onclick="send_in_close_status(' + xhr.responce.id + ')"><div style="width:200px; height:30px; background-color:#058D3D; position:relative; border-radius: 0px 15px 15px 0px;"><div style="width: 0;height: 0;position:absolute;right: -24px;"><h6 style="margin: 7px 0px 0px -180px; color: #fff!important; font-size: 12px;">Mark status as complete</h6></div></div></a></div><div class="col-sm-1"><div class="form-group" id="markascomplete"><button onclick="show_case_detail()" type="button" class="btn btn-primary btn-lg" style="margin: -10px -100px 0px 0px; background-color:#3D6AD6;padding: 5px 15px;font-size: 14px;"><i class="ti-alarm-clock menu-icon"></i> History </button></div></div><div class="col-sm-1"><div class="form-group" id="markascomplete"><button onclick="show_mail_datails()" type="button" class="btn btn-primary btn-lg" style="margin: -10px -135px 0px 72px; background-color:#3D6AD6;padding: 5px 15px;font-size: 14px; "><i class="ti-email menu-icon"></i> Mail</button></div></div>'
                            );
                    }


                }
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
    </script>
    <script>
    function send_mail() {
        var email = $("input[name='email_to']").val();
        var subject = $("input[name='mail_subject']").val();
        var description = CKEDITOR.instances.description.getData();
        $.ajax({
            type: "GET",
            url: "{{route('manager.get.mail')}}",
            data: {
                'email': email,
                'subject': subject,
                'description': description
            },
            success: function(response) {
                if (response.status == 200) {
                    $("#showrplye").text('Mail Sent Successfully')
                }
            }
        });
    }
    </script>
    </script>
    </script>
    <script>
    function send_in_close_status(id) {
        $("#hidden_id").val(id);
    }
    function final_close_sataus(id){
        var id = $("#hidden_id").val();
          $.ajax({
            type: "GET",
            url: "{{url('manager/send_in_close_status')}}",
            data: {
                'id': id,
            },
            success: function(response) {
                    location.reload();
            }
        });
    }
    </script>
    <script>
    function follow_up_sub(id) {
        var id = id;
        var fol_region_follow = $("#fol_region_follow").val();
        var fol_date = $("#fol_date").val();
        var fol_time = $("#fol_time").val();
        var fol_note = $("#fol_note").val();
        $.ajax({
            type: "GET",
            url: "{{url('manager/follow_up_sub')}}",
            data: {
                'id': id,
                'fol_region_follow': fol_region_follow,
                'fol_date': fol_date,
                'fol_time': fol_time,
                'fol_note': fol_note,
            },
            success: function(response) {
                location.reload();
            }
        });
    }
    </script>
    <script>
    function viewcase(id) {
        var id = id;
        var page = 1;
        $('#data-wrapper4').scroll(function() {
            if ($('#data-wrapper4').scrollTop() + $('#data-wrapper4').height() >= $(document).height()) {
                page++;
                infinteLoadMore4(page);
            }
        });
        $.ajax({
                url: "{{url('manager/admin-lead/case-detail')}}?page=" + page,
                datatype: "html",
                data: {
                    id: id
                },
                type: "get",
                beforeSend: function() {
                    $('.auto-load').show();
                    $('.priloder_ajax').show();
                }
            })
            .done(function(response) {
                if (response.length == 0) {
                    $('.auto-load').html("We don't have more data to display :(");
                    return;
                }
                $('.auto-load').hide();
                $("#data-wrapper4").html(response);
                var html = '<div class="priloder_ajax' + page + '">' +
                    '<div class="d-flex justify-content-center">' +
                    '<div class="spinner-grow text-primary" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>' +
                    '</div></div>';
                $("#data-wrapper4").append(html);
                setTimeout(function() {
                    $('.priloder_ajax' + page).hide();
                }, 2000);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
    </script>
    <script>
    function viewmails(id) {
        var id = id;
        var page = 1;
        $('#data-wrapper5').scroll(function() {
            if ($('#data-wrapper5').scrollTop() + $('#data-wrapper5').height() >= $(document).height()) {
                page++;
                infinteLoadMore4(page);
            }
        });
        $.ajax({
                url: "{{url('manager/admin-lead/mail-details')}}?page=" + page,
                datatype: "html",
                data: {
                    id: id
                },
                type: "get",
                beforeSend: function() {
                    $('.auto-load').show();
                    $('.priloder_ajax').show();
                }
            })
            .done(function(response) {
                if (response.length == 0) {
                    $('.auto-load').html("We don't have more data to display :(");
                    return;
                }
                $('.auto-load').hide();
                $("#data-wrapper5").html(response);
                var html = '<div class="priloder_ajax' + page + '">' +
                    '<div class="d-flex justify-content-center">' +
                    '<div class="spinner-grow text-primary" role="status">' +
                    '<span class="sr-only">Loading...</span>' +
                    '</div>' +
                    '</div></div>';
                $("#data-wrapper5").append(html);
                setTimeout(function() {
                    $('.priloder_ajax' + page).hide();
                }, 2000);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
    </script>
    @endif
    <script>
    function show_case_detail() {
        $(".casedetails").show();
        $(".maildetails").hide();
    }

    function show_mail_datails() {
        $(".casedetails").hide();
        $(".maildetails").show();
    }
    </script>
    <script type="text/javascript">
    $(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
        //    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Weekly': [moment().subtract(6, 'days'), moment()],
           'Montly': [moment().subtract(30, 'days'), moment()],
        //    'This Month': [moment().startOf('month'), moment().endOf('month')],
        //    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb).on('apply.daterangepicker', function (ev, picker) {
        var startDate = picker.startDate.format('YYYY-MM-DD');
        var endDate = picker.endDate.format('YYYY-MM-DD');
        date_rage(startDate, endDate);  
    });
    cb(start, end);
});
 function date_rage(startDate, endDate){
    alert(startDate);

 }


function send_in_process_status(val){

    $.ajax({
        type: "GET",
        url: "{{ route('send_in_process_status') }}",
        data: {'id' : val},
        success: function(data){
        if(data.status == 200){
            $("#view-application-form").html('<a type="button" target="_blank" href="<?php echo route('get-started'); ?>/admin/view-save-personal/'+data.id+'" class="btn btn-success">Boarding In Process</a>');
        } else {
            $("#view-application-form").html('<a type="button" onclick="onboard('+data.id+');" href="#" class="btn btn-warning">Start On Boarding</a>');
        }

        }
    });


}


</script>



    @stop
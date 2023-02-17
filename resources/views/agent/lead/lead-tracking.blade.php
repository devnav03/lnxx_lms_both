@extends('agent.layouts.agent')
@section('css')
<!-- tables -->
<link rel="stylesheet" type="text/css" href="{!! asset('css/table-style.css') !!}" />
<!-- //tables -->
@endsection
@section('content')

<div class="agile-grids">
    <div class="grids">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">Lead Tracking</h1>

                <div class="agile-tables">
                    <div class="w3l-table-info">
                        {{-- for message rendering --}}
                        @include('agent.layouts.messages')
                        <div class="panel panel-default">

                            <div class="row row-sm">
                                <div class="col-lg-12 col-md-12">
                                    <div class="card custom-card">
                                        <div class="card-body">
                                            <div>
                                                <h6 class="main-content-label mb-1">Lead Tracking System</h6>
                                            </div>
                                            <div class="panel-body row">
                                                <div class="col-md-12" style="margin-top: 15px;">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <ul class="nav nav-pills nav-fill">
                                                                <li class="nav-item">
                                                                    <p class="nav-link bg-primary text-white"
                                                                        aria-current="page" href="#">Open Leads</p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <ul class="nav nav-pills nav-fill">
                                                                <li class="nav-item">
                                                                    <p class="nav-link bg-success text-white"
                                                                        aria-current="page" href="#">In Progress</p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <ul class="nav nav-pills nav-fill">
                                                                <li class="nav-item">
                                                                    <p class="nav-link bg-warning text-white"
                                                                        aria-current="page" href="#">Reminder</p>
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
                                                            
                                                                <div id="data-wrapper" style="height:400px;overflow-y: scroll;">
                                                                    <!-- Results -->
                                                                </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                                <div id="data-wrapper1" style="height:400px;overflow-y: scroll;">
                                                                    <!-- Results -->
                                                                </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div id="data-wrapper2" style="height:400px;overflow-y: scroll;">
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
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
  <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Leads Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="bd-example-modal-sm" style="margin-right:-1100px; margin-bottom: -220px;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
            <div class="card-header emp_head_h">
                            <div class="row">
                                <div class="col-md-10">
                                <h5 class="">Follow Up & Remider</h5>
                                </div>
                            </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Follow Up date</label>
                                        <p id="f_date"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
      </div>
      <div class="modal-body">
        <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card" id="employee_details">
                        <div class="card-header emp_head_h">
                            <div class="row">
                                <div class="col-md-10">
                                <h5 class="">Pesonal Details</h5>
                                </div>
                                <div class="col-md-2">
                                    <img id="output" />
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Full Name (As per ID)</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Full Name (As per ID)" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="email" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>UAE Mobile No.</label>
                                        <input type="number" class="form-control" id="number" name="number"
                                            placeholder="UAE Mobile No." required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Fateher Name (As per ID)</label>
                                        <input type="text" class="form-control" id="father_name" name="father_name"
                                            placeholder="Father Name" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Mother Name</label>
                                        <input type="text" class="form-control" id="mother_name" name="mother_name"
                                            placeholder="Mother Name" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select class="form-control form-control-sm" id="gender" name="gender">
                                                <option value="">Select Gender</option>
                                                    <option value="">Male</option>
                                                    <option value="">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Marital Status</label>
                                        <select class="form-control form-control-sm" id="marital_status" name="marital_status">
                                                <option value="">Select Marital Status</option>
                                                    <option value="">Single</option>
                                                    <option value="">Married</option>
                                                    <option value="">Widowed</option>
                                                    <option value="">Divorced</option>
                                                    <option value="">Separated </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Emirates ID No.</label>
                                        <input type="number" class="form-control" id="emirates_id" name="emirates_id"
                                            placeholder="Emirates ID No." required>
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>DOB</label>
                                        <input type="date" class="form-control" id="date_of_birth" name="dob"
                                            placeholder="dob" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <span id="next_button"
                                        class="btn btn-primary btn-sm mr-2 employee_button">Next</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" id="employee_contact" style="display:none">
                        <div class="card-header">
                            <h5 class="">Communication Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea type="text" class="form-control" id="address" name="address"
                                                placeholder="Full Address"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" class="form-control" id="city" name="city" placeholder="City">
                                        </div>
                                    </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>State</label>
                                        <input type="text" class="form-control" id="state" name="state" placeholder="State">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Pin Code</label>
                                        <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Pin Code">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <input type="text" class="form-control" id="country" name="country" placeholder="Country">
                                    </div>
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <span id="back_button_contact" class="btn btn-primary btn-sm mr-2">Back</span>
                                    <span id="next_button_contact"
                                        class="btn btn-primary btn-sm mr-2 employee_button">Next</span>
                                </div>
                            </div>
                        </div>
                    </div>
                

                    <div class="card" id="employee_education" style="display:none">
                        <div class="card-header">
                            <h5 class="">Required Product & Credit Score Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="multi-field-wrapper">
                                    <div class="multi-fields">
                                        <div class="multi-field">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Credit Score</label>
                                                        <input type="text" class="form-control" id="score"
                                                            name="score" placeholder="Credit Score">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Product Type</label>
                                                        <input type="text" class="form-control" id="product"
                                                            name="product" placeholder="Product">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Source of lead</label>
                                                        <input type="text" class="form-control" id="source"
                                                            name="source" placeholder="Source of lead">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Reference of lead</label>
                                                        <input type="text" class="form-control" id="reference"
                                                            name="reference" placeholder="Reference of lead">
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-sm-12">
                                    <span id="back_button_education" class="btn btn-primary btn-sm mr-2">Back</span>
                                    <span id="next_button_education"
                                        class="btn btn-primary btn-sm mr-2 employee_button">Next</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card" id="employee_bank" style="display:none">
                        <div class="card-header">
                            <h5 class="">Documents Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Upload Emirates id front side <span style="font-size: 13px;">(allowed file types (.jpg, .jpeg, *.png only) with maximum size 2mb.)*</span></label>
                                        <input type="file" accept="image/png, image/jpg, image/jpeg" id="imgInp" style="box-shadow: none; margin-top: 3px;" name="emirates_id_front">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Upload Emirates id back side <span style="font-size: 13px;">(allowed file types (.jpg, .jpeg, *.png only) with maximum size 2mb.)*</span></label>
                                    <input type="file" accept="image/png, image/jpg, image/jpeg" id="imgInp1" style="box-shadow: none; margin-top: 3px;" name="emirates_id_back">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="sub-label">Passport Number*</label>
                                    <input name="passport_number" maxlength="16" class="form-control" required="true" value="66" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Passport Expiry Date*</label>
                                    <input name="passport_expiry_date" id="my_date_picker" class="form-control hasDatepicker" required="true" value="0006-06-06" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Upload Passport <span style="font-size: 13px;">(allowed file types (.jpg, .jpeg, *.png only) with maximum size 2mb.)</span></label>
                                    <input type="file" accept="image/png, image/jpg, image/jpeg" id="imgInp2" style="box-shadow: none; margin-top: 3px;" name="passport_photo">
                                </div>
                            </div>
                                <div class="col-sm-12 mt-3">
                                    <span id="back_button_bank" class="btn btn-primary btn-sm mr-2">Back</span>
                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
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

<script>
    $(window).on('load', function () {
        infinteLoadMore(1);
    });
</script>
<script>
    var page = 1;
    $('#data-wrapper').scroll(function () {
        if($('#data-wrapper').scrollTop() + $('#data-wrapper').height() >= $(document).height()) {
            page++;
            infinteLoadMore(page);
        }
    });
</script>
<script>
    function infinteLoadMore(page) {
        $.ajax({
                url:"{{url('agent/agent-lead/tracking-open')}}?page="+page,
                datatype: "html",
                type: "get",
                beforeSend: function () {
                    $('.auto-load').show();
                    $('.priloder_ajax').show();
                }
            })
            .done(function (response) {
                if (response.length == 0) {
                    $('.auto-load').html("We don't have more data to display :(");
                    return;
                }
                $('.auto-load').hide();
                $("#data-wrapper").append(response);
                var html = '<div class="priloder_ajax'+page+'">'+
                '<div class="d-flex justify-content-center">'+
                    '<div class="spinner-grow text-primary" role="status">'+
                        '<span class="sr-only">Loading...</span>'+
                    '</div>'+
                '</div></div>';
                $("#data-wrapper").append(html);
                setTimeout(function () {
                    $('.priloder_ajax'+page).hide();
                },2000);
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
</script>
<script>
    $(window).on('load', function () {
        infinteLoadMore1(1);
    });
</script>
<script>
    var page = 1;
    $('#data-wrapper1').scroll(function () {
        if($('#data-wrapper1').scrollTop() + $('#data-wrapper1').height() >= $(document).height()) {
            page++;
            infinteLoadMore1(page);
        }
    });
</script>
<script>
    function infinteLoadMore1(page) {
        $.ajax({
                url:"{{url('agent/agent-lead/tracking-inprocess')}}?page="+page,
                datatype: "html",
                type: "get",
                beforeSend: function () {
                    $('.auto-load').show();
                    $('.priloder_ajax').show();
                }
            })
            .done(function (response) {
                if (response.length == 0) {
                    $('.auto-load').html("We don't have more data to display :(");
                    return;
                }
                $('.auto-load').hide();
                $("#data-wrapper1").append(response);
                var html = '<div class="priloder_ajax'+page+'">'+
                '<div class="d-flex justify-content-center">'+
                    '<div class="spinner-grow text-success" role="status">'+
                        '<span class="sr-only">Loading...</span>'+
                    '</div>'+
                '</div></div>';
                $("#data-wrapper1").append(html);
                setTimeout(function () {
                    $('.priloder_ajax'+page).hide();
                },2000);
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
</script>
<script>
    $(window).on('load', function () {
        infinteLoadMore2(1);
    });
</script>
<script>
    var page = 1;
    $('#data-wrapper2').scroll(function () {
        if($('#data-wrapper2').scrollTop() + $('#data-wrapper2').height() >= $(document).height()) {
            page++;
            infinteLoadMore2(page);
        }
    });
</script>
<script>
    function infinteLoadMore2(page) {
        $.ajax({
                url:"{{url('agent/agent-lead/tracking-reminder')}}?page="+page,
                datatype: "html",
                type: "get",
                beforeSend: function () {
                    $('.auto-load').show();
                    $('.priloder_ajax').show();
                }
            })
            .done(function (response) {
                if (response.length == 0) {
                    $('.auto-load').html("We don't have more data to display :(");
                    return;
                }
                $('.auto-load').hide();
                $("#data-wrapper2").append(response);
                var html = '<div class="priloder_ajax'+page+'">'+
                '<div class="d-flex justify-content-center">'+
                    '<div class="spinner-grow text-warning" role="status">'+
                        '<span class="sr-only">Loading...</span>'+
                    '</div>'+
                '</div></div>';
                $("#data-wrapper2").append(html);
                setTimeout(function () {
                    $('.priloder_ajax'+page).hide();
                },2000);
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
</script>
<script>
function get_popup(id){
    $.ajax({
        type: 'GET',
        url : "{{url('agent/agent-lead/popup')}}",
        data: {id:id},
    })
    .done(function (xhr) {
        if(xhr.status==200){
            $("#name").val(xhr.responce.name); 
            $("#email").val(xhr.responce.email); 
            $("#number").val(xhr.responce.number); 
            $("#score").val(xhr.responce.score); 
            $("#source").val(xhr.responce.source); 
            $("#product").val(xhr.responce.product); 
            $("#reference").val(xhr.responce.reference); 
            $("#f_date").html(xhr.responce.f_date); 
        }
    })
    .fail(function (jqXHR, ajaxOptions, thrownError) {
        console.log('Server error occured');
    });
}
</script>
<script>
    $("#next_button").on('click', function() {
        $('#employee_details').hide();
        $('#employee_contact').show();
    });
    $("#next_button_contact").on('click', function() {
        $('#employee_details').hide();
        $('#employee_contact').hide();
        $('#employee_education').show();
    });
    $("#back_button_contact").on('click', function() {
        $('#employee_details').show();
        $('#employee_contact').hide();
    });
    $("#back_button_education").on('click', function() {
        $('#employee_contact').show();
        $('#employee_education').hide();
    });
    $("#next_button_education").on('click', function() {
        $('#employee_education').hide();
        $('#employee_bank').show();
    });
    $("#next_button_bank").on('click', function() {
        $('#employee_bank').hide();
        $('#employee_company').show();
    });
    $("#back_button_bank").on('click', function() {
        $('#employee_education').show();
        $('#employee_bank').hide();
    });
    </script>

@stop
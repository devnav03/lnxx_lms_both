@extends('admin.layouts.admin')
@section('css')
<!-- tables -->
<link rel="stylesheet" type="text/css" href="{!! asset('css/table-style.css') !!}" />
<!-- //tables -->
@endsection
@section('content')
<style>
    .daterangepicker.ltr.show-ranges.opensright {
    /* display: block!important; */
    top: 377.757px!important;
    left: 875px!important;
    right: auto!important;
    z-index: 11111!important;
    position: absolute!important;
}
</style>
<div class="agile-grids">
    <div class="grids">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">Lead List</h1>

                <div class="agile-tables">
                    <div class="w3l-table-info">
                        {{-- for message rendering --}}
                        @include('admin.layouts.messages')
                        <div class="panel panel-default">

            <div class="row row-sm">
                <div class="col-lg-12 col-md-12">
                <div class="card custom-card">
                    <div class="card-body">
                <div>
                    <h6 class="main-content-label mb-1">Lead Filter</h6>
                </div>
                <div class="panel-body row">
                <div class="col-md-12" style="margin-top: 15px;">
                    {!! Form::open(array('method' => 'POST', 'route' => array('lead.paginate'), 'id' => 'ajaxForm')) !!}
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="name" class="control-label">Customer Name</label>
                            {!! Form::text('name', null, array('class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                        <label for="product_type" class="control-label">Customer Email</label>
                        {!! Form::text('email', null, array('class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                        <label for="product_type" class="control-label">Customer Mobile</label>
                        {!! Form::number('number', null, array('class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                        <label for="product_type" class="control-label">Agent/Employee Reference ID</label>
                        {!! Form::text('reference', null, array('class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                        <label for="product_type" class="control-label">By Source</label>
                        <select name="source" class="form-control minimal" aria-label="Default select example">
                            <option value="">Please Select</option>
                            <?php $get_source = \DB::table('lead_source')->get(); ?>
                            @foreach($get_source as $get_source)
                            <option value="{{$get_source->name}}">{{$get_source->name}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="product_type" class="control-label">By Product</label>
                            <select name="product" class="form-control minimal" aria-label="Default select example">
                            <option value="" selected>Select Product Type</option>
                            <?php $get_type = \DB::table('services')->get(); ?>
                            @foreach($get_type as $get_type)
                                <option value="{{$get_type->name}}">{{$get_type->name}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="product_type" class="control-label">From Date</label>
                        {!! Form::date('from', null, array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="to" class="control-label">To Date</label>
                        {!! Form::date('to', null, array('class' => 'form-control')) !!}
                    </div>
                </div>
              <!--   <div class="col-sm-3">
                    <div class="form-group">
                    <label for="product_type" class="control-label">By Location</label>
                        <input type="text" class="form-control" >
                    </div>
                </div> -->
                <div class="col-sm-6 margintop20">
                    <div class="form-group">
                        {!! Form::hidden('form-search', 1) !!}
                        {!! Form::submit('Filter', array('class' => 'btn btn-primary')) !!}
                        <a href="{!! route('lead.index') !!}" class="btn btn-success">Reset Filter</a>
                    </div>
                </div>                                
                </div>
                {!! Form::close() !!}
                </div>
                </div>
                </div>
                </div>
                </div>
                </div>

                        </div>
                        <form action="{{ route('lead.action') }}" method="post">
                            <!--     <div class="row"> -->
                            <div class="col-md-3 pull-right padding0" style="text-align: right; margin-bottom: 15px;padding-top: 10px;">
                                {!! lang('Show') !!} {!! Form::select('name', ['20' => '20', '40' => '40', '100' => '100', '200' => '200', '300' => '300'], '20', ['id' => 'per-page']) !!} {!! lang('entries') !!}
                            </div>
                            <div class="col-md-3 padding0" style="padding-left: 0px !important; margin-bottom: 10px;">
                                {!! Form::hidden('page', 'search') !!}
                                {!! Form::hidden('_token', csrf_token()) !!}
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">Select multiple to assign</button>
                               <!--  {!! Form::text('name', null, array('class' => 'form-control live-search', 'placeholder' => 'Search customer by name')) !!} -->
                            </div>
                            <!--  </div> -->
                            <table id="paginate-load" data-route="{{route('lead.paginate')}}" class="table table-hover">
                            </table>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><img src="{{asset('img/logo-black.png')}}" alt="logo" style="float: left;"><span style="margin-top: 8px; float: left; margin-left: 15px;">MULTIPLE ASSIGN LEAD</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
            <div class="col-md-12">
                <div class="card custom-card">
                    <div class="card-body" style="padding: 5px;">
                        <div>
                            <h6 class="main-content-label mb-1">Lead Distribution by Agent/Employee Category</h6>
                            <input type="hidden" id="ids" value="">
                        </div>
                        <div class="panel-body row">
                            <div class="col-md-12" style="margin-top: 15px;">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="name" class="control-label">Name</label>
                                            {!! Form::text('name', null, array('class' =>
                                            'form-control', 'id' => 'name')) !!}
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="product_type"
                                                class="control-label">Email</label>
                                            {!! Form::text('email', null, array('class' =>
                                            'form-control', 'id' => 'email')) !!}
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="product_type"
                                                class="control-label">Mobile</label>
                                            {!! Form::number('mobile', null, array('class' =>
                                            'form-control', 'id' => 'mobile')) !!}
                                        </div>
                                            </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="user_type"
                                                class="control-label">By Products</label>
                                                <select name="pattern" id="product" class="form-control minimal" aria-label="Default select example">
                                                <option>Select Product</option>
                                                <?php $get_type = \DB::table('services')->get(); ?>
                                                @foreach($get_type as $get_type)
                                                <option value="{{$get_type->name}}">{{$get_type->name}}</option>
                                                @endforeach
                                                    
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="user_type"
                                                class="control-label">By Language</label>
                                                <select name="pattern" id="language" class="form-control minimal" aria-label="Default select example">
                                                <?php $get_lang = \DB::table('lead_language_master')->get(); ?>
                                                <option>Please Select</option>
                                                @foreach($get_lang as $get_lang)
                                                <option value="{{$get_lang->lang_name}}">{{$get_lang->lang_name}}</option>
                                                @endforeach
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="user_type"
                                                class="control-label">Type of Selection</label>
                                                <select name="user_type" id="user_type" class="form-control minimal" aria-label="Default select example">
                                                    <option>Please Select</option>
                                                    <option value="3">Agents</option>
                                                    <option value="4">Employees</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="user_type"
                                                class="control-label">Duration/Pattern</label>
                                                <select onchange="duration_pattern(this.value)" class="form-control minimal" aria-label="Default select example">
                                                    <option>Please Select</option>
                                                    <option value="duration">Date</option>
                                                    <option value="pattern">Pattern</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 duration" style="display:none">
                                        <div class="form-group">
                                            <label for="user_type" class="control-label">Selection of Duration</label>
                                            <select onchange="custom_range(this.value)" class="form-control minimal" aria-label="Default select example">
                                                    <option>Please Select</option>
                                                    <option value="today">Today</option>
                                                    <!-- <option value="yeasterday">Yeasterday</option> -->
                                                    <option value="last7days">last 7 Days</option>
                                                    <option value="last30days">last 30 Days</option>
                                                    <!-- <option value="thismonth">This Month</option> -->
                                                    <option value="CustomRange">Custom Range</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 custom_date" style="display:none">
                                        <div class="form-group">
                                            <label for="user_type" class="control-label">From Date</label>
                                            <input type="date" name="f_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-3 custom_date" style="display:none">
                                        <div class="form-group">
                                            <label for="user_type" class="control-label">To Date</label>
                                            <input type="date" name="t_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-3 pattern" style="display:none">
                                        <div class="form-group">
                                            <label for="user_type"
                                                class="control-label">Selection of Pattern</label>
                                                <select name="pattern" class="form-control minimal" aria-label="Default select example">
                                                    <option value="" selected>Select</option>
                                                    <option value="follow_up">No of Follow Up</option>
                                                    <option value="reminder">No of Reminder</option>
                                                    <option value="emails">No of E-mails</option>
                                                    <option value="calls">No of Calls Attempts</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="user_type"
                                                class="control-label">By Location</label>
                                                <input type="text" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6 margintop20">
                                        <div class="form-group">
                                        <a href="#" onclick="search_filter()" style="color:white;"
                                                class="btn btn-success">Filter</a>    
                                        <a href="#"
                                                class="btn btn-warning">Reset Filter</a>
                                                <a style="color:white;" onclick="action_filter()"  type="button" class="btn btn-success">Distribute Now</a>
                                        </div>
                                    </div>
                                    <div id="send-status">
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="panel-body row">
                            <div class="col-md-12" style="margin-top: 15px;">
                            <div class="data-wrapper4" style="height:230px;overflow-y: scroll;">
                                            <!-- Results -->
                                        </div>
                            </div>
                        </div>   
                    </div>
                </div>

            </div>
        </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div> -->
    </div>
  </div>
</div>
<div class="modal fade bd-example-modal-lg" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><img style="float: left;" src="{{asset('img/logo-black.png')}}" alt="logo"><span style="float: left; margin-top: 8px;margin-left: 15px;">ASSIGN LEAD<span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
            <div class="col-md-12">
                <div class="card custom-card">
                    <div class="card-body" style="padding: 5px;">
                        <div>
                            <h6 class="main-content-label mb-1">Lead Distribution by Agent/Employee Category</h6>
                            <input type="hidden" id="ids" value="">
                        </div>
                        <div class="panel-body row">
                        <div class="col-md-12" style="margin-top: 15px;">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="name" class="control-label">Name</label>
                                            {!! Form::text('name', null, array('class' =>
                                            'form-control', 'id' => 'name')) !!}
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="product_type"
                                                class="control-label">Email</label>
                                            {!! Form::text('email', null, array('class' =>
                                            'form-control', 'id' => 'email')) !!}
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="product_type"
                                                class="control-label">Mobile</label>
                                            {!! Form::number('mobile', null, array('class' =>
                                            'form-control', 'id' => 'mobile')) !!}
                                        </div>
                                            </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                        <label for="user_type" class="control-label">Products Type</label>
                                        <select name="pattern" id="product" class="form-control minimal" aria-label="Default select example">
                                            <option>Select Product</option>
                                            <?php $get_type = \DB::table('services')->get(); ?>
                                            @foreach($get_type as $get_type)
                                            <option value="{{$get_type->name}}">{{$get_type->name}}</option>
                                            @endforeach 
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="user_type"
                                                class="control-label">Choose Language</label>
                                                <select name="pattern" id="language" class="form-control minimal" aria-label="Default select example">
                                                <?php $get_lang = \DB::table('lead_language_master')->get(); ?>
                                                <option>Please Select</option>
                                                @foreach($get_lang as $get_lang)
                                                <option value="{{$get_lang->lang_name}}">{{$get_lang->lang_name}}</option>
                                                @endforeach
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="user_type"
                                                class="control-label">Assign To</label>
                                                <select name="user_type" id="type" class="form-control minimal" aria-label="Default select example">
                                                    <option>Please Select</option>
                                                    <option value="3">Agents</option>
                                                    <option value="4">Employees</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="user_type"
                                                class="control-label">Duration/Pattern</label>
                                                <select onchange="duration_pattern(this.value)" class="form-control minimal" aria-label="Default select example">
                                                    <option>Please Select</option>
                                                    <option value="duration">Date</option>
                                                    <option value="pattern">Pattern</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 duration" style="display:none">
                                        <div class="form-group">
                                            <label for="user_type" class="control-label">Selection of Duration</label>
                                            <select onchange="custom_range(this.value)" class="form-control minimal" aria-label="Default select example">
                                                    <option>Please Select</option>
                                                    <option value="today">Today</option>
                                                    <!-- <option value="yeasterday">Yeasterday</option> -->
                                                    <option value="last7days">last 7 Days</option>
                                                    <option value="last30days">last 30 Days</option>
                                                    <!-- <option value="thismonth">This Month</option> -->
                                                    <option value="CustomRange">Custom Range</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 custom_date" style="display:none">
                                        <div class="form-group">
                                            <label for="user_type" class="control-label">From Date</label>
                                            <input type="date" name="f_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-3 custom_date" style="display:none">
                                        <div class="form-group">
                                            <label for="user_type" class="control-label">To Date</label>
                                            <input type="date" name="t_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-3 pattern" style="display:none">
                                        <div class="form-group">
                                            <label for="user_type"
                                                class="control-label">Selection of Pattern</label>
                                                <select name="pattern" class="form-control minimal" aria-label="Default select example">
                                                    <option value="" selected>Select</option>
                                                    <option value="follow_up">No of Follow Up</option>
                                                    <option value="reminder">No of Reminder</option>
                                                    <option value="emails">No of E-mails</option>
                                                    <option value="calls">No of Calls Attempts</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="user_type"
                                                class="control-label">By Location</label>
                                                <input type="text" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6 margintop20">
                                        <div class="form-group">
                                        <a href="#" onclick="search_filter2()" style="color:white;"
                                                class="btn btn-success">Filter</a>    
                                        <a href="#"
                                                class="btn btn-warning">Reset Filter</a>
                                        </div>
                                    </div>
                                    <div id="send-status">
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="panel-body row">
                            <div class="col-md-12" style="margin-top: 15px;">
                            <div class="data-wrapper5" style="height:230px;overflow-y: scroll;">
                                            <!-- Results -->
                                        </div>
                            </div>
                        </div>   
                    </div>
                </div>

            </div>
        </div>
      </div>
     <!--  <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div> -->
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <img src="{{asset('img/logo-black.png')}}" alt="logo">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="showDetails">
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div> -->
    </div>
  </div>
</div>

<style type="text/css"> 
@media(min-width: 576px){
.modal-dialog {
    max-width: 650px;
}
#showDetails .form-row {
    margin-right: -15px;
    margin-left: -15px;
}
#showDetails label {
    margin-top: 15px;
}
}
#ajaxForm input {
    padding-right: 10px;
}
@media (min-width: 922px){
#exampleModal .modal-dialog, 
#exampleModal1 .modal-dialog {
    max-width: 920px;
}
}




</style>

<script>
function check_send(multi_check_option){
    var check_val = $.map($(':checkbox[name=check_v\\[\\]]:checked'), function(n, i){
      return n.value;
    }).join(',');
    var get_emp_aj = multi_check_option;
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'POST',
        url : "{{route('leads.multiple_check_val')}}", 
        data: {check_val:check_val,get_emp_aj:get_emp_aj},
        success:function(xhr){
            if(xhr.status==200){
                location.reload();
            }
        },
        });
}
</script>
<script>
function search_filter(){
    var name = $("#name").val();
    var email = $("#email").val();
    var mobile = $("#mobile").val();
    var type = $("#user_type").val();
    var product = $("#product").val();
    var language = $("#language").val();
    var page = 1;
    $('.data-wrapper4').scroll(function() {
    if ($('.data-wrapper4').scrollTop() + $('.data-wrapper4').height() >= $(document).height()) {
        page++;
        infinteLoadMore4(page);
    }
    });
    $.ajax({
            url: "{{url('admin/emp-agent/filter')}}?page=" + page,
            datatype: "html",
            data:{name:name, email:email, mobile:mobile, type:type, product:product, language:language},
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
            $(".data-wrapper4").html(response);
            var html = '<div class="priloder_ajax' + page + '">' +
                '<div class="d-flex justify-content-center">' +
                '<div class="spinner-grow text-primary" role="status">' +
                '<span class="sr-only">Loading...</span>' +
                '</div>' +
                '</div></div>';
            $(".data-wrapper4").append(html);
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
function search_filter2(){
    var name = $("#name").val();
    var email = $("#email").val();
    var mobile = $("#mobile").val();
    var type = $("#type").val();
    var product = $("#product").val();
    var language = $("#language").val();
    var page = 1;
    $('.data-wrapper4').scroll(function() {
    if ($('.data-wrapper4').scrollTop() + $('.data-wrapper4').height() >= $(document).height()) {
        page++;
        infinteLoadMore4(page);
    }
    });
    $.ajax({
            url: "{{url('admin/emp-agent/filter2')}}?page=" + page,
            datatype: "html",
            data:{name:name, email:email, mobile:mobile, type:type, product:product, language:language},
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
            $(".data-wrapper5").html(response);
            var html = '<div class="priloder_ajax' + page + '">' +
                '<div class="d-flex justify-content-center">' +
                '<div class="spinner-grow text-primary" role="status">' +
                '<span class="sr-only">Loading...</span>' +
                '</div>' +
                '</div></div>';
            $(".data-wrapper5").append(html);
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
function view_details(id){
    $.ajax({
        type: 'GET',
        url : "{{url('admin/admin-view-details')}}", 
        data: {id:id},
        success: function(response){
                $("#showDetails").html(response)
        }
        });    
}
function savedata(id){
    // alert(id);
    var name = $('#m_name').val();
    var mname = $('#m_mname').val();
    var lname = $('#m_lname').val();
    var email = $('#m_email').val();
    var number = $('#m_number').val();
    var product = $('#m_product').val();
    var source = $('#m_source').val();
    var status = $('#m_status').val();
    $.ajax({
        type: 'GET',
        url : "{{url('admin/save-view-details')}}", 
        data: {id:id, name:name, mname:mname, lname:lname, email:email, number:number, product:product, source:source, status:status},
        success: function(response){
            location.reload();
        }
        });    
}
function get_ids(id){
    $('#ids').val(id);
}
function check_send_2(id){
    var check_vall = $.map($(':checkbox[name=check_v\\[\\]]:checked'), function(n, i){
      return n.value;
    }).join(',');
    var lead_id = $('#ids').val();
    if(check_vall == ''){
       var check_val = lead_id;
    }else{
       var check_val = check_vall;
    }
    var get_emp_aj = id;
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'POST',
        url : "{{route('leads.multiple_check_val')}}", 
        data: {check_val:check_val,get_emp_aj:get_emp_aj},
        success:function(xhr){
            if(xhr.status==200){
                toastr.options.timeOut = 1000;
                toastr.success('Lead Assign Succesfully');
                setTimeout(function(){
                    location.reload();
                }, 2000);
            }
        },
        });
}
</script>
<script>
    function duration_pattern(value){
        val = value;
        if(val == ''){
            $(".duration").hide();
            $(".pattern").hide();
            $('.custom_date').hide();  
        }
        if(val == 'duration'){
            $(".duration").show();
            $(".pattern").hide();
            $('.custom_date').hide();  
        }
        if(val == 'pattern'){
            $(".pattern").show();
            $(".duration").hide();
            $('.custom_date').hide();  
        }
    }
</script>
<script>
//     function select_all_2() {
//     $('.cb-element').
// };
function select_all_2(){
        var is_checked = $('#select_all_2').val();
        if(is_checked == 1){
            $( ".check_boxs" ).each(function(){
                this.checked = true;
            });
            $('#select_all_2').val(0);
        }
        if(is_checked == 0){
            $( ".check_boxs" ).each(function(){
                this.checked = false;
            });
            $('#select_all_2').val(1);
        }
    };
</script>
<script>
    function action_filter(){
    var user_value = $.map($(':checkbox[name=select_all_2\\[\\]]:checked'), function(n, i){
      return n.value; }).join(',');
    var lead_value = $.map($(':checkbox[name=check_v\\[\\]]:checked'), function(n, i){
        return n.value;}).join(',');
    $.ajax({
        type: 'GET',
        url : "{{route('select-user-lead')}}", 
        data: {user_value:user_value,lead_value:lead_value},
        success:function(xhr){
            if(xhr.status == 200){
                toastr.options.timeOut = 1500;
                toastr.success('Lead Assign Succesfully');
                setTimeout(function(){
                    location.reload();
                }, 3000);
            }
        },
        });
    }

</script>
<script>
    function custom_range(value){
        if(value == 'CustomRange'){
            $('.custom_date').show();
        }else{
            $('.custom_date').hide();   
        }
    }
</script>
<script>                                                    
   // $(function () {
       // $('#daterange-btn').daterangepicker(
        //{
         //   ranges   : {
        //  'Today'       : [moment(), moment()],
        //    'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        // 'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
        //'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        //  'This Month'  : [moment().startOf('month'), moment().endOf('month')],
        // 'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
       //     },
       //     startDate: moment().subtract(29, 'days'),
       //     endDate  : moment()
      //  },
      //  function (start, end) {
          //  $('#reportrange span').html(start.format('MMMM D, YYYY')+'-'+end.format('MMMM D, YYYY'))
     //   }
      //  );
    //});
</script>

@stop
@extends('admin.layouts.admin')
@section('css')
<!-- tables -->
<link rel="stylesheet" type="text/css" href="{!! asset('css/table-style.css') !!}" />
<!-- //tables -->
@endsection
@php
    $route  = \Route::currentRouteName();    
@endphp
@section('content')

<div class="agile-grids">   
    <div class="grids">       
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">Assign Lead List</h1>
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
                                    <h6 class="main-content-label mb-1">Assign Lead Filter</h6>
                                    </div>
                                    <div class="panel-body row">
                                            <div class="col-md-12" style="margin-top: 15px;">
                                                @if($route == 'leads.lead_assign_leads')
                                                    {!! Form::open(array('method' => 'POST',
                                                    'route' => array('assign.lead.paginate'), 'id' => 'ajaxForm')) !!}
                                                @elseif($route == 'leads.open_leads')
                                                    {!! Form::open(array('method' => 'POST',
                                                    'route' => array('emp.open.lead.paginate'), 'id' => 'ajaxForm')) !!}
                                                @elseif($route == 'agent.leads.open_leads')
                                                    {!! Form::open(array('method' => 'POST',
                                                    'route' => array('agent.open.lead.paginate'), 'id' => 'ajaxForm')) !!}
                                                @elseif($route == 'manager.leads.open_leads')
                                                    {!! Form::open(array('method' => 'POST',
                                                    'route' => array('manager.open.lead.paginate'), 'id' => 'ajaxForm')) !!}
                                                @endif
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="name" class="control-label">Customer Name</label>
                                                                {!! Form::text('name', null, array('class' =>
                                                                'form-control')) !!}
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="product_type"
                                                                    class="control-label">Customer Email</label>
                                                                {!! Form::text('email', null, array('class' =>
                                                                'form-control')) !!}
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                            <label>Mobile</label>
										<div id="mobile-number" class="input-group telephone-input">
										</div> 
                                        <input type="number" class="form-control" name="number" style="width: 100%;padding-left: 45px;">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="product_type"
                                                                    class="control-label">Agent/Employee Reference ID</label>
                                                                {!! Form::text('reference', null, array('class' =>
                                                                'form-control')) !!}
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="product_type"
                                                                    class="control-label">By Source</label>
                                                                {!! Form::text('source', null, array('class' =>
                                                                'form-control')) !!}
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="product_type"
                                                                    class="control-label">By Product</label>
                                                                    <select name="product" class="form-control minimal" aria-label="Default select example">
                                                                        <option value="" selected>Select Product Type</option>
                                                                        <?php $get_type = \DB::table('services')->where('status', 1)->get(); ?>
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




                                                        @if($route == 'leads.lead_assign_leads')
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="alloted_to"
                                                                    class="control-label">Assign To Agent/Employee</label>
                                                                    <select name="alloted_to" class="form-control minimal" aria-label="Default select example">
                                                                        <option value="" selected>Select Product Type</option>
                                                                        <?php $get_user_type = App\Models\User::where('status', 1)->where('user_type', 4)->orWhere('user_type', 3)->get(); ?>
                                                                        @foreach($get_user_type as $get_user_type)
                                                                        <option value="{{$get_user_type->id}}">{{$get_user_type->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                            </div>
                                                        </div>
                                                     
                                                        @endif
                     
                        <div class="col-sm-3 margintop20">
                            <div class="form-group">
                            {!! Form::hidden('form-search', 1) !!}
                            {!! Form::submit('Filter', array('class' => 'btn btn-primary')) !!}
                            @if($route == 'leads.lead_assign_leads')
                                <a href="{!! route('leads.lead_assign_leads') !!}" class="btn btn-success">Reset Filter</a>
                            @elseif($route == 'leads.open_leads')
                                <a href="{!! route('leads.open_leads') !!}" class="btn btn-success">Reset Filter</a>
                            @elseif($route == 'agent.leads.open_leads')
                                <a href="{!! route('agent.leads.open_leads') !!}" class="btn btn-success">Reset Filter</a>
                            @elseif($route == 'manager.leads.open_leads')
                                <a href="{!! route('manager.leads.open_leads') !!}" class="btn btn-success">Reset Filter</a>
                            @endif
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

                        @if($route == 'leads.lead_assign_leads')
                        <form action="{{ route('assign.lead.action') }}" method="post">
                        @elseif($route == 'leads.open_leads')
                        <form action="{{ route('emp.open.lead.action') }}" method="post">
                        @elseif($route == 'agent.leads.open_leads')
                        <form action="{{ route('agent.open.lead.action') }}" method="post">
                        @elseif($route == 'manager.leads.open_leads')
                        <form action="{{ route('manager.open.lead.action') }}" method="post">
                        @endif
                        <!--     <div class="row"> -->
                        <div class="col-md-3 pull-right padding0" style="text-align: right; margin-bottom: 15px;">
                                {!! lang('Show') !!} {!! Form::select('name', ['20' => '20', '40' => '40', '100' => '100', '200' => '200', '300' => '300'], '20', ['id' => 'per-page']) !!} {!! lang('entries') !!}
                            </div>
                            <div class="col-md-3 padding0">
                                {!! Form::hidden('page', 'search') !!}
                                {!! Form::hidden('_token', csrf_token()) !!}
                               <!--  {!! Form::text('name', null, array('class' => 'form-control live-search', 'placeholder' => 'Search customer by name')) !!} -->
                            </div>
                           <!--  </div> -->
                           @if($route == 'leads.lead_assign_leads')
                           <table id="paginate-load" data-route="{{route('assign.lead.paginate')}}" class="table table-hover">
                            </table>
                            @elseif($route == 'leads.open_leads')
                            <table id="paginate-load" data-route="{{route('emp.open.lead.paginate')}}" class="table table-hover">
                            </table>
                            @elseif($route == 'agent.leads.open_leads')
                            <table id="paginate-load" data-route="{{route('agent.open.lead.paginate')}}" class="table table-hover">
                            </table>
                            @elseif($route == 'manager.leads.open_leads')
                            <table id="paginate-load" data-route="{{route('manager.open.lead.paginate')}}" class="table table-hover">
                            </table>
                           @endif
                        </form>
                    </div>
                    
                </div>
            </div>
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
<!-- Modal -->
  <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><img src="{{asset('img/logo-black.png')}}" alt="logo" style="float: left;"><span style="float: left; margin-top: 8px; margin-left: 20px;">REASSIGN LEAD</span></h5>
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
                        <h6 class="main-content-label mb-1">Filter to distribute leads to Agent/Employee/Manager</h6>
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
                                                    <option value="">Please Select</option>
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
                                        <a href="#" class="btn btn-warning">Reset Filter</a>
                                    </div>
                                    </div>
                                        <div id="send-status"></div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="panel-body row">
                            <div class="col-md-12" style="margin-top: 15px;">
                            <input type="hidden" id="m_id">
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
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div> -->
    </div>
  </div>
</div>

<style type="text/css">
@media(min-width: 922px){
.modal-lg, .modal-xl {
    max-width: 920px;
}
}
@media(min-width: 576px){
#exampleModalCenter .modal-dialog {
    max-width: 630px;
}
}
#showDetails label {
    margin-top: 15px;
}
#showDetails .form-row{
    margin-right: -15px;
    margin-left: -15px;
}
#ajaxForm input {
    padding-right: 10px;
}

</style>

<script>
    function check_send_2(id){
    
    var m_id = $("#m_id").val();
    var id = id;
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'POST',
        url : "{{route('leads.single_check_val')}}", 
        data: {m_id:m_id,id:id},
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
function set_id(id){
    $("#m_id").val(id);
}
</script>

@if($route == 'leads.lead_assign_leads')
<script>
function search_filter2(){
    var name = $("#name").val();
    var email = $("#email").val();
    var mobile = $("#mobile").val();
    var type = $("#user_type").val();
    var product = $("#product").val();
    var language = $("#language").val();
    var page = 1;
    $('.data-wrapper5').scroll(function() {
    if ($('.data-wrapper5').scrollTop() + $('.data-wrapper5').height() >= $(document).height()) {
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
</script>
@elseif($route == 'leads.open_leads')
<script>

function view_details(id){
    $.ajax({
        type: 'GET',
        url : "{{url('employee/admin-view-details')}}", 
        data: {id:id},
        success: function(response){
                $("#showDetails").html(response)
        }
        });    
}
function savedata(id){
    var name = $('#m_name').val();
    var email = $('#m_email').val();
    var number = $('#m_number').val();
    var product = $('#m_product').val();
    var source = $('#m_source').val();
    var status = $('#m_status').val();
    $.ajax({
        type: 'GET',
        url : "{{url('employee/save-view-details')}}", 
        data: {id:id, name:name, email:email, number:number, product:product, source:source, status:status},
        success: function(response){
            location.reload();
        }
        });    
}
</script>
@elseif($route == 'agent.leads.open_leads')
<script>

function view_details(id){
    $.ajax({
        type: 'GET',
        url : "{{url('agent/admin-view-details')}}", 
        data: {id:id},
        success: function(response){
                $("#showDetails").html(response);
        }
        });    
}
function savedata(id){
    var name = $('#m_name').val();
    var email = $('#m_email').val();
    var number = $('#m_number').val();
    var product = $('#m_product').val();
    var source = $('#m_source').val();
    var status = $('#m_status').val();
    $.ajax({
        type: 'GET',
        url : "{{url('agent/save-view-details')}}", 
        data: {id:id, name:name, email:email, number:number, product:product, source:source, status:status},
        success: function(response){
            location.reload();
        }
        });    
}
</script>
@elseif($route == 'manager.leads.open_leads')
<script>

function view_details(id){
    $.ajax({
        type: 'GET',
        url : "{{url('manager/admin-view-details')}}", 
        data: {id:id},
        success: function(response){
                $("#showDetails").html(response)
        }
        });    
}
function savedata(id){
    var name = $('#m_name').val();
    var email = $('#m_email').val();
    var number = $('#m_number').val();
    var product = $('#m_product').val();
    var source = $('#m_source').val();
    var status = $('#m_status').val();
    $.ajax({
        type: 'GET',
        url : "{{url('manager/save-view-details')}}", 
        data: {id:id, name:name, email:email, number:number, product:product, source:source, status:status},
        success: function(response){
            location.reload();
        }
        });    
}
</script>
@endif
<script>                                                    
    $(function () {
        $('#daterange-btn').daterangepicker(
        {
            ranges   : {
            'Today'       : [moment(), moment()],
            'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month'  : [moment().startOf('month'), moment().endOf('month')],
            'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().subtract(29, 'days'),
            endDate  : moment()
        },
        function (start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
        );
    });
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
    function custom_range(value){
        if(value == 'CustomRange'){
            $('.custom_date').show();
        }else{
            $('.custom_date').hide();   
        }
    }
</script>
@stop


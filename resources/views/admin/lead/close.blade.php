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
                <h1 class="page-header">Report List</h1>

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
                    <h6 class="main-content-label mb-1">Report List Filter</h6>
                </div>
                <div class="panel-body row">
                    <div class="col-md-12" style="margin-top: 15px;">
                    @if($route == 'leads.lead_close_leads')    
                    {!! Form::open(array('method' => 'POST', 'route' => array('close.lead.paginate'), 'id' => 'ajaxForm')) !!}
                    @elseif($route == 'leads.closed_leads')
                        {!! Form::open(array('method' => 'POST', 'route' => array('emp.close.lead.paginate'), 'id' => 'ajaxForm')) !!}
                    @elseif($route == 'agent.leads.closed_leads')
                        {!! Form::open(array('method' => 'POST', 'route' => array('agent.close.lead.paginate'), 'id' => 'ajaxForm')) !!}
                    @elseif($route == 'manager.leads.closed_leads')
                        {!! Form::open(array('method' => 'POST', 'route' => array('manager.close.lead.paginate'), 'id' => 'ajaxForm')) !!}
                    @endif
                    <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="name" class="control-label">Customer Name</label>
                                    {!! Form::text('name', null, array('class' =>
                                    'form-control', 'id' => 'c_name')) !!}
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="product_type"
                                        class="control-label">Customer Email</label>
                                    {!! Form::text('email', null, array('class' =>
                                    'form-control' , 'id' => 'c_email')) !!}
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label>Mobile</label>
									<div class="input-group telephone-input"></div> 
                                    <input type="tel" class="form-control" name="number" id="mobile-number" style="width: 100%;">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="product_type"
                                        class="control-label">Agent/Employee Reference ID</label>
                                    {!! Form::text('reference', null, array('class' =>
                                    'form-control' , 'id' => 'c_reference')) !!}
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="product_type"
                                        class="control-label">By Source</label>
                                        <select name="source" id="source" class="form-control minimal" aria-label="Default select example">
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
                                    <label for="product_type"
                                        class="control-label">By Product</label>
                                        <select name="product" id="product" class="form-control minimal" aria-label="Default select example">
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



                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="alloted_to"
                                                                    class="control-label">Assign To Agent/Employee</label>
                                                                    <select name="alloted_to" id="alloted_to" class="form-control minimal" aria-label="Default select example">
                                                                        <option value="" selected>Select Product Type</option>
                                                                        <?php $get_user_type = App\Models\User::where('status', 1)->where('user_type', 4)->orWhere('user_type', 3)->get(); ?>
                                                                        @foreach($get_user_type as $get_user_type)
                                                                        <option value="{{$get_user_type->id}}">{{$get_user_type->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="product_type"
                                                                    class="control-label">By Location</label>
                                                                    <input type="text" id="location" class="form-control" >
                                                            </div>
                                                        </div> -->
                                                        <!-- <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="product_type"
                                                                    class="control-label">Between Dates</label>
                                                                    <div style="display: block; width: 100%; height: calc(1.5em + 0.75rem rem + 2px); font-size: 0.875rem; font-weight: 400; line-height: 1.5; color: #a8afc7; background-color: #ffffff; background-clip: padding-box; border: 1px solid #e8e8f7; border-radius: 3px; transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out; height: 38px; border-radius: 5px;"> 
                                                                    <input type="button" name="between_date" id="daterange-btn" class="btn btn-default float-right" >
                                                                    <i class="far fa-calendar-alt"></i>
                                                                    </div>
                                                                    
                                                            </div>
                                                        </div> -->
                                                        <div class="col-sm-4 margintop20">
                                <div class="form-group">
                                    {!! Form::hidden('form-search', 1) !!}
                                    {!! Form::submit('Filter', array('class' => 'btn
                                    btn-primary')) !!}
                                    @if($route == 'leads.lead_close_leads')    
                                    <a href="{!! route('leads.lead_close_leads') !!}"
                                        class="btn btn-success">Reset Filter</a>
                                    <!--  <a type="button" onclick="download_reort();"
                                        class="btn btn-warning">Downlaod Report</a> -->
                                    @elseif($route == 'leads.closed_leads')
                                    <!--  <a href="{!! route('leads.closed_leads') !!}"
                                        class="btn btn-success">Reset Filter</a> -->
                                    <!-- <a href="{!! route('emp.leads.lead_close_leads.download') !!}"
                                        class="btn btn-warning">Downlaod Report</a> -->
                                    @elseif($route == 'agent.leads.closed_leads')
                                    <a href="{!! route('agent.leads.closed_leads') !!}"
                                        class="btn btn-success">Reset Filter</a>
                                   <!--  <a href="{!! route('agent.leads.lead_close_leads.download') !!}"
                                        class="btn btn-warning">Downlaod Report</a> -->
                                    @elseif($route == 'manager.leads.closed_leads')
                                    <a href="{!! route('manager.leads.closed_leads') !!}"
                                        class="btn btn-success">Reset Filter</a>
                                    <!-- <a href="{!! route('manager.leads.lead_close_leads.download') !!}"
                                        class="btn btn-warning">Downlaod Report</a> -->
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
                        @if($route == 'leads.lead_close_leads')    
                            <form action="{{ route('close.lead.action') }}" method="post">
                        @elseif($route == 'emp.leads.closed_leads')
                            <form action="{{ route('emp.close.lead.action') }}" method="post">
                        @elseif($route == 'aganet.leads.closed_leads')
                            <form action="{{ route('agent.close.lead.action') }}" method="post">
                        @elseif($route == 'manager.leads.closed_leads')
                            <form action="{{ route('manager.close.lead.action') }}" method="post">
                        @endif
                        
                        <!--     <div class="row"> -->
                            <div class="col-md-3 pull-right padding0" style="text-align: right; margin-bottom: 15px;padding-right: 0px !important;">
                                {!! lang('Show') !!} {!! Form::select('name', ['20' => '20', '40' => '40', '100' => '100', '200' => '200', '300' => '300'], '20', ['id' => 'per-page']) !!} {!! lang('entries') !!}
                            </div>
                            <div class="col-md-3 padding0" style="padding-left: 0px !important; margin-bottom: 15px;">
                                {!! Form::hidden('page', 'search') !!}
                                {!! Form::hidden('_token', csrf_token()) !!}
                                <!-- {!! Form::text('name', null, array('class' => 'form-control live-search', 'placeholder' => 'Search lead by name')) !!} -->
                            </div>
                           <!--  </div> -->
                            
                            @if($route == 'leads.lead_close_leads')    
                            <table id="paginate-load" data-route="{{route('close.lead.paginate')}}" class="table table-hover">
                            </table>
                            @elseif($route == 'emp.leads.closed_leads')
                            <table id="paginate-load" data-route="{{route('emp.close.lead.paginate')}}" class="table table-hover">
                            </table>
                            @elseif($route == 'agent.leads.closed_leads')
                            <table id="paginate-load" data-route="{{route('agent.close.lead.paginate')}}" class="table table-hover">
                            </table>
                            @elseif($route == 'manager.leads.closed_leads')
                            <table id="paginate-load" data-route="{{route('manager.close.lead.paginate')}}" class="table table-hover">
                            </table>
                            @endif
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
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
    function download_reort(){
        var c_name = $('#c_name').val();
        var c_email = $('#c_email').val();
        var mobile = $('#mobile-number').val();
        var c_reference = $('#c_reference').val();
        var source = $('#source').val();
        var product = $('#product').val();
        var alloted_to = $('#alloted_to').val();
        var location = $('#location').val();
        var between_date = $('#daterange-btn').val();
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: "POST",
            url: "{{url('admin/leads/lead_close_leads/download')}}",
            data: {
                'c_name': c_name,
                'c_email': c_email,
                'mobile': mobile,
                'c_reference': c_reference,
                'source': source,
                'product': product,
                'alloted_to': alloted_to,
                'location': location,
                'between_date': between_date,
            },
            success: function(response) {
                toastr.options.timeOut = 1500;
                toastr.success('Report Download Successfully');
            }
        });
    }
</script>

@stop


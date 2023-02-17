@extends('admin.layouts.admin')

@section('css')
<!-- tables -->
<link rel="stylesheet" type="text/css" href="{!! asset('css/table-style.css') !!}" />
<!-- //tables -->
<style>
    
 input[type=time]::-webkit-datetime-edit-ampm-field {
  display: none;
}
</style>
@endsection
@section('content')
<style type="text/css">
    .bootstrap-timepicker-meridian, .meridian-column
{
display: none;
}
</style>

<div class="agile-grids">
    <div class="grids">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">Automatic Leads Distributions</h1>
                <div class="card custom-card">
                    <div class="card-body">
                        <div>
                            <h6 class="main-content-label mb-1">Lead Distrubution by Category</h6>
                        </div>
                        <div class="panel-body row">
                            <div class="col-md-12" style="margin-top: 15px;">
                            <form action="{{url('admin/automatic_save_cat')}}" method="post"> 
                                @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="name" class="control-label">Automatic Assign by Category</label>
                                                <select name="assign_by_category" id="" class="form-control minimal">
                                                    <option>Please Select</option>
                                                    <?php 
                                                    $assign_category = DB::table('lead_auto_distribution_category')->get();
                                                    ?>
                                                    @foreach($assign_category as $assign_category)
                                                    <option value="{{$assign_category->id}}" <?php if($assign_category->active_deactive == 1){ echo "selected"; } ?>>{{$assign_category->category}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 margintop20">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-warning">Save Setting</button>
                                            </div>
                                        </div>   
                                        <div class="col-sm-3 margintop20" style="margin-left:-145px">
                                            <div class="form-group">
                                                <a style="color:white;" href="{{url('admin/auto-distribution')}}" type="button" class="btn btn-success">Distribute Now</a>
                                            </div>
                                        </div>   
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
<!--                 
                <div class="card custom-card">
                    <div class="card-body">
                        <div>
                            <h6 class="main-content-label mb-1">Lead Distribution by Agent Category</h6>
                        </div>
                        <div class="panel-body row">
                            <div class="col-md-12" style="margin-top: 15px;">
                                {!! Form::open(array('method' => 'POST',
                                'route' => array('auto.lead.paginate'), 'id' => 'ajaxForm')) !!}
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="name" class="control-label">Name</label>
                                            {!! Form::text('name', null, array('class' =>
                                            'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="product_type"
                                                class="control-label">Email</label>
                                            {!! Form::text('email', null, array('class' =>
                                            'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="product_type"
                                                class="control-label">Mobile</label>
                                            {!! Form::number('mobile', null, array('class' =>
                                            'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="user_type"
                                                class="control-label">Type of Selection</label>
                                                <select name="user_type" class="form-control" aria-label="Default select example">
                                                    <option value="" selected>Select</option>
                                                    <option value="3">Agents</option>
                                                    <option value="4">Employees</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="user_type"
                                                class="control-label">Selection of Duration/Pattern</label>
                                                <select onchange="duration_pattern(this.value)" class="form-control" aria-label="Default select example">
                                                    <option value="" selected>Select</option>
                                                    <option value="duration">Duration</option>
                                                    <option value="pattern">Pattern</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 duration" style="display:none">
                                        <div class="form-group">
                                            <label for="user_type"
                                                class="control-label">Selection of Duration</label>
                                                <select onchange="duration(this.value)" class="form-control" aria-label="Default select example">
                                                    <option value="" selected>Select</option>
                                                    <option value="hours">Hrs</option>
                                                    <option value="days">Days</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 hours" style="display:none">
                                        <div class="form-group">
                                        <label for="product_type" class="control-label">Hours</label>
                                                <input id="timepicker" name="hours" class="form-control" type="text">     
                                        </div>
                                    </div>
                                    <div class="col-sm-2 days" style="display:none">
                                        <div class="form-group">
                                        <label for="product_type"
                                                class="control-label">Days</label>
                                            {!! Form::number('days', null, array('class' =>
                                            'form-control')) !!}
                                                
                                        </div>
                                    </div>
                                    <div class="col-sm-3 pattern" style="display:none">
                                        <div class="form-group">
                                            <label for="user_type"
                                                class="control-label">Selection of Pattern</label>
                                                <select name="pattern" class="form-control" aria-label="Default select example">
                                                    <option value="" selected>Select</option>
                                                    <option value="follow_up">No of Follow Up</option>
                                                    <option value="reminder">No of Reminder</option>
                                                    <option value="emails">No of E-mails</option>
                                                    <option value="calls">No of Calls Attempts</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 margintop20">
                                        <div class="form-group">
                                            {!! Form::hidden('form-search', 1) !!}
                                            {!! Form::submit('Filter', array('class' => 'btn
                                            btn-primary')) !!}
                                            <a href="{!! url('admin/leads/lead-assign-automatic-leads') !!}"
                                                class="btn btn-warning">Reset Filter</a>
                                                <a style="color:white;" onclick="action_filter()"  type="button" class="btn btn-success">Distribute Now</a>
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
    <form action="{{ route('auto.lead.action') }}" method="post">
        <div class="col-md-3 pull-right padding0" style="text-align: right; margin-bottom: 15px;">
            {!! lang('Show') !!} {!! Form::select('name', ['20' => '20', '40' => '40', '100' => '100', '200' => '200', '300' => '300'], '20', ['id' => 'per-page']) !!} {!! lang('entries') !!}
        </div>
        <div class="col-md-3 padding0">
            {!! Form::hidden('page', 'search') !!}
            {!! Form::hidden('_token', csrf_token()) !!}
        </div>
        <table id="paginate-load" data-route="{{route('auto.lead.paginate')}}" class="table table-hover">
        </table>
    </form> -->
</div>
<script>
    function duration_pattern(value){
        val = value;
        if(val == ''){
            $(".duration").hide();
            $(".pattern").hide();
        }
        if(val == 'duration'){
            $(".duration").show();
            $(".hours").hide();
            $(".days").hide();
            $(".pattern").hide();
        }
        if(val == 'pattern'){
            $(".pattern").show();
            $(".hours").hide();
            $(".days").hide();
            $(".duration").hide();
        }
    }
    function duration(value){
        val = value;
        if(val == ''){
            $(".hours").hide();
            $(".days").hide();
        }
        if(val == 'hours'){
            $(".hours").show();
            $(".days").hide();
        }
        if(val == 'days'){
            $(".days").show();
            $(".hours").hide();
        }
    }
</script>
<script>
// $(document).ready(function(){
//     $('#timepicker').timepicker({
//         timeFormat: 'HH:mm:ss',
//         minTime: '11:45:00' // 11:45:00 AM,
//         maxHour: 20,
//         maxMinutes: 30,
//         startTime: new Date(0,0,0,15,0,0) // 3:00:00 PM - noon
//         interval: 15 // 15 minutes
//     });
// });

</script>
<script>
function action_filter(){
    var check_val = $.map($(':checkbox[name=check_v\\[\\]]:checked'), function(n, i){
      return n.value;
    }).join(',');
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'POST',
        url : "{{url('admin/filter-action-distribution')}}", 
        data: {check_val:check_val},
        success:function(xhr){
            if(xhr.status==200){
                location.reload();
            }
        },
    });
}
</script>

@stop
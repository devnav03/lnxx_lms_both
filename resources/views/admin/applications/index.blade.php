@extends('admin.layouts.admin')
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
                <h1 class="page-header">Applications</h1>
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
                                        <h6 class="main-content-label mb-1">Applications Filter</h6>
                                    </div>
                                    <div class="panel-body row">
                                    <div class="col-md-12" style="margin-top: 15px;">
                                    {!! Form::open(array('method' => 'POST',
                                    'route' => array('applications.paginate'), 'id' => 'ajaxForm')) !!}
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="name" class="control-label">Name</label>
                                                {!! Form::text('name', null, array('class' => 'form-control')) !!}
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="product_type" class="control-label">Email</label>
                                                {!! Form::text('email', null, array('class' => 'form-control')) !!}
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="product_type" class="control-label">Mobile</label>
                                                {!! Form::number('mobile', null, array('class' => 'form-control')) !!}
                                            </div>
                                        </div>
                                        <div class="col-sm-2" style="padding-right: 0px;">
                                            <div class="form-group">
                                                <label for="product_type" class="control-label">From</label>
                                                {!! Form::date('from', null, array('class' => 'form-control')) !!}
                                            </div>
                                        </div>
                                        <div class="col-sm-2" style="padding-right: 0px;">
                                            <div class="form-group">
                                                <label for="to" class="control-label">To</label>
                                                {!! Form::date('to', null, array('class' => 'form-control')) !!}
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                        <div class="form-group">
                                        <label for="status" class="control-label">Applications Status</label>
                                            <select class="form-control" name="status">
                                                <option value="">Select</option>
                                                <option value="102">Pending</option>
                                                <option value="1">Complete</option>
                                                <option value="2">Decline</option>
                                            </select>
                                        </div>

                                        </div>
                                        <div class="col-sm-3 margintop20">
                                            <div class="form-group">
                                                {!! Form::hidden('form-search', 1) !!}
                                                {!! Form::submit('Filter', array('class' => 'btn btn-primary')) !!}
                                                <a href="{!! route('applications.index') !!}" class="btn btn-success">Reset Filter</a>
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


                        <form action="{{ route('applications.action') }}" method="post">
                            <div class="col-md-3 pull-right padding0" style="text-align: right; margin-bottom: 15px;">
                                {!! lang('Show') !!} {!! Form::select('name', ['20' => '20', '40' => '40', '100' => '100', '200' => '200', '300' => '300'], '20', ['id' => 'per-page']) !!} {!! lang('entries') !!}
                            </div>
                            <div class="col-md-3 padding0">
                                {!! Form::hidden('page', 'search') !!}
                                {!! Form::hidden('_token', csrf_token()) !!}
                        
                            </div>

                            <table id="paginate-load" data-route="{{ route('applications.paginate') }}" class="table table-hover">
                            </table>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
#paginate-load .fa-times{
    color: #f00;
}   
#paginate-load .fa-check{
    color: green;
} 
</style>

@stop


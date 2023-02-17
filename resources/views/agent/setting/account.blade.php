@extends('admin.layouts.admin')
@section('content')

<div class="agile-grids">   
    <div class="grids">       
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h1 class="page-header">Change Password</h1>
               
                <div class="card custom-card">
            <div class="card-body">
                @include('admin.layouts.messages')
                <div class="panel panel-widget forms-panel">
                    <div class="forms">
                        <div class="form-grids widget-shadow" data-example-id="basic-forms"> 
                            <div class="form-title">
                               <!--  <h4>{!! lang('common.password_info') !!}</h4> -->
                            </div>
                            <div class="form-body">
                                    {!! Form::open(array('method' => 'POST', 'route' => array('setting.manage-account'), 'id' => 'ajaxSave', 'class' => '')) !!}                               
                                <div class="row">
                                    <div class="col-md-12">
                                      <!--    <div class="form-group"> 
                                            <label><strong>Username:</strong></label>
                                            {!! \Auth::user()->name !!}
                                        </div>  -->
                                        <div class="form-group"> 
                                            {!! Form::label('old_password', lang('Old Password'), array('class' => '')) !!}
                                            {!! Form::password('password', array('class' => 'form-control' )) !!}
                                        </div> 

                                        <div class="form-group"> 
                                            {!! Form::label('new_password', lang('New Password'), array('class' => '')) !!}
                                            {!! Form::password('new_password', array('class' => 'form-control')) !!}
                                        </div>
                                        <div class="form-group"> 
                                            {!! Form::label('confirm_password', lang('Confirm Password'), array('class' => '')) !!}
                                            {!! Form::password('confirm_password', array('class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                         <button type="submit" class="btn btn-default w3ls-button">Submit</button> 
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
        </div>
    </div>
</div>

<style type="text/css">
    
.w3ls-button {
    background: #5EB495;
    color: #fff;
    padding: 9px 28px;
    font-size: 15px;
}
.alert-danger ul {
    margin-bottom: 0px;
    padding-left: 5px;
}
</style>

@stop


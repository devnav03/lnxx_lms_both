@extends('admin.layouts.admin')
@section('content')
@include('admin.layouts.messages')
@php
    $route  = \Route::currentRouteName();    
@endphp
<div class="agile-grids">   
    <div class="grids">       
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">Create Employee<a class="btn btn-sm btn-primary pull-right" href="{!! route('employee.index') !!}" > <i class="fa fa-solid fa-arrow-left"></i> All Employee</a></h1>
                
                <div class="panel panel-widget forms-panel">
                    <div class="card custom-card">
            <div class="card-body">
            <div class="panel panel-widget forms-panel" style="float: left;width: 100%; padding-bottom: 20px;">
                <div class="forms">
                        <div class="form-grids widget-shadow" data-example-id="basic-forms"> 
                            <!-- <div class="form-title">
                                <h4>Service Information</h4>                        
                            </div> -->
                            <div class="form-body">
                                @if($route == 'employee.create')
                                    {!! Form::open(array('method' => 'POST', 'route' => array('employee.store'), 'id' => 'ajaxSave', 'class' => '', 'files'=>'true')) !!}
                                @elseif($route == 'employee.edit')
                                    {!! Form::model($result, array('route' => array('employee.update', $result->id), 'method' => 'PATCH', 'id' => 'banks-form', 'class' => '', 'files'=>'true')) !!}
                                @else
                                    Nothing
                                @endif
                                
                                <div class="row">
                                    <div class="col-md-6">
                                         <div class="form-group"> 
                                            {!! Form::label('name', lang('Name'), array('class' => '')) !!}
                                            {!! Form::text('name', null, array('class' => 'form-control', 'required' => 'true')) !!}
                                        </div> 
                                    </div>  
                                    <div class="col-md-6">
                                         <div class="form-group"> 
                                            {!! Form::label('email', lang('Email'), array('class' => '')) !!}
                                            {!! Form::email('email', null, array('class' => 'form-control', 'required' => 'true')) !!}
                                        </div> 
                                    </div>  
                                    <div class="col-md-6">
                                         <div class="form-group"> 
                                            {!! Form::label('password', lang('Password'), array('class' => '')) !!}
                                            @if(!empty($result->password))
                                            {!! Form::text('password', null, array('class' => 'form-control')) !!}
                                            @else
                                            {!! Form::text('password', null, array('class' => 'form-control', 'required' => 'true')) !!}
                                            @endif
                                        </div> 
                                    </div>  
                                    <div class="col-md-6">
                                         <div class="form-group"> 
                                            {!! Form::label('gender', lang('Gender'), array('class' => '')) !!}
                                            <select name="gender" class="form-control" aria-label="Default select example">
                                                <option>Select Gender</option>
                                                <option value="Male" <?php if(!empty($result->gender)){if($result->gender == 'Male'){echo"selected";}} ?>>Male</option>
                                                <option value="Female" <?php if(!empty($result->gender)){if($result->gender == 'Female'){echo"selected";}} ?>>Female</option>
                                            </select>
                                        </div> 
                                    </div>  

                                    <div class="col-md-6">
                                         <div class="form-group"> 
                                            {!! Form::label('date_of_birth', lang('Date of Birth'), array('class' => '')) !!}
                                            {!! Form::date('date_of_birth', null, array('class' => 'form-control', 'required' => 'true')) !!}
                                        </div> 
                                    </div>  

                                    <div class="col-md-6">
                                         <div class="form-group"> 
                                            {!! Form::label('mobile', lang('Mobile Number'), array('class' => '')) !!}
                                            {!! Form::number('mobile', null, array('class' => 'form-control', 'required' => 'true')) !!}
                                        </div> 
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                            {!! Form::label('profile_image', lang('Profile Picture'), array('class' => '')) !!}
                                            @if(!empty($result->profile_image))
                                            <input name="profile_image" type='file' class="form-control" accept="image/png, image/jpeg" id="imgInp" style="padding-top: 6px; border: 0px;" />
                                            @else
                                            <input name="profile_image" type='file' class="form-control" accept="image/png, image/jpeg" required="true" id="imgInp" style="padding-top: 6px; border: 0px;" />
                                            @endif
                                            <img id="blah" style="max-width: 55%;margin-top:10px;" src="#" alt="" />
                                        </div>
                                        @if(!empty($result->profile_image))
                                            <div class="form-group"> 
                                                 {!! Html::image(asset($result->profile_image),'' ,array('width' => 80 ,'class'=>'img-responsive') ) !!}
           
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                         <div class="form-group"> 
                                         </div> 
                                    </div>
                                 
                                    <div class="col-md-6">
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
</div>

<script type="text/javascript">
    
imgInp.onchange = evt => {
  const [file] = imgInp.files
  if (file) {
    blah.src = URL.createObjectURL(file)
  }
}    

</script>

@stop


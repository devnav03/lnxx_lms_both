@extends('admin.layouts.admin')
@section('content')
@php
    $route  = \Route::currentRouteName();    
@endphp
<div class="agile-grids">   
    <div class="grids">       
        <div class="row">
            <div class="col-md-12">
            <h1 class="page-header"> Agent <a class="btn btn-sm btn-primary pull-right" href="{!! route('agent-request.index') !!}"> <i class="fa fa-arrow-left"></i> All Agent Requests </a></h1>
            <div class="card custom-card">
            <div class="card-body">
            <div class="panel panel-widget forms-panel" style="float: left;width: 100%; padding-bottom: 20px;">
                <div class="forms">
                        <div class="form-grids widget-shadow" data-example-id="basic-forms"> 
                            <div class="form-title">
                                <h4>Agent Information</h4>                        
                            </div>
                            <div class="form-body">
                                @if($route == 'agent-request.create')
                                    {!! Form::open(array('method' => 'POST', 'route' => array('agent-request.store'), 'id' => 'ajaxSave', 'class' => '')) !!}
                                @elseif($route == 'agent-request.edit')
                                    {!! Form::model($result, array('route' => array('agent-request.update', $result->id), 'method' => 'PATCH', 'id' => 'agent-request-form', 'class' => '')) !!}
                                @else
                                    Nothing
                                @endif
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                            {!! Form::label('name', lang('Name'), array('class' => '')) !!}
                                            @if(!empty($result->id))
                                          <!--       {!! Form::text('name', null, array('class' => 'form-control', 'required'=> 'true')) !!} -->
                                          <input class="form-control" required="true" name="name" type="text" value="{{ $result->salutation  }} {{ $result->first_name }} {{ $result->middle_name  }} {{ $result->last_name  }}" id="name" readonly="">
                                            @else
                                                {!! Form::text('name', null, array('class' => 'form-control', 'required'=> 'true','readonly')) !!}
                                            @endif 
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                            {!! Form::label('email', lang('Email'), array('class' => '')) !!}
                                            @if(!empty($result->id))
                                                {!! Form::email('email', null, array('class' => 'form-control','readonly')) !!}
                                            @else
                                                {!! Form::email('email', null, array('class' => 'form-control', 'required'=> 'true')) !!}
                                            @endif 
                                            @if($errors->has('email'))
                                             <span class="text-danger">{{$errors->first('email')}}</span>
                                            @endif
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                            {!! Form::label('mobile', lang('Mobile'), array('class' => '')) !!}
                                            @if(!empty($result->id))
                                                {!! Form::number('mobile', null, array('class' => 'form-control', 'required'=> 'true', 'readonly')) !!}
                                            @else
                                                {!! Form::number('mobile', null, array('class' => 'form-control', 'required'=> 'true', 'readonly')) !!}
                                            @endif
                                            @if($errors->has('mobile'))
                                             <span class="text-danger">{{$errors->first('mobile')}}</span>
                                            @endif
                                            
                                        </div> 
                                    </div>
                                    <input type="hidden" value="{{ $result->user_type }}" name="user_type">
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                        {!! Form::label('date_of_birth', lang('Date of Birth'), array('class' => '')) !!}
                                        @if($result->date_of_birth)
                                        <input type="text" value="{!! $result->date_of_birth !!}" readonly="" class="form-control"> 
                                        @else
                                        {!! Form::date('date_of_birth', null, array('class' => 'form-control', 'required'=> 'true')) !!}
                                        @endif

                                        @if($errors->has('date_of_birth'))
                                            <span class="text-danger">{{$errors->first('date_of_birth')}}</span>
                                        @endif
                                        </div> 
                                    </div> 
                                    
                                  <!--   @if($result->gender)
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                        {!! Form::label('gender', lang('Gender'), array('class' => '')) !!}
                                        <input type="text" value="{{ $result->gender }}" readonly="" class="form-control"> 
                                        @if($errors->has('gender'))
                                            <span class="text-danger">{{$errors->first('gender')}}</span>
                                        @endif
                                        </div> 
                                    </div>
                                    @endif -->
            

                                    @if(isset($result))
                                    @else

                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                          {!! Form::label('password', lang('Password'), array('class' => '')) !!}
                                            {!! Form::password('password', null, array('class' => 'form-control', 'required'=> 'true')) !!}
                                            <span style="font-size: 12px;">Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters</span>
                                            @if($errors->has('password'))
                                             <span class="text-danger"><br>{{$errors->first('password')}}</span>
                                            @endif
                                        </div> 
                                    </div>
                                    @endif

                                 <!--    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="sub-label">Nationality</label>
                                            <select name="nationality" class="form-control" readonly="" required="true">
                                            @foreach($countries as $country)       
                                            <option value="{{ $country->id }}" @if($country->id == $result->nationality) selected @endif >{{ $country->country_name }}</option>
                                            @endforeach  
                                            </select>
                                        </div>
                                    </div> -->

                                  <!--   <div class="col-md-6">
                                        <div class="form-group"> 
                                            {!! Form::label('passport_number', lang('Passport Number'), array('class' => '')) !!}
                                            @if(!empty($result->id))
                                                {!! Form::text('passport_number', null, array('class' => 'form-control','readonly')) !!}
                                            @else
                                                {!! Form::text('passport_number', null, array('class' => 'form-control', 'required'=> 'true')) !!}
                                            @endif 
                                            @if($errors->has('passport_number'))
                                             <span class="text-danger">{{$errors->first('passport_number')}}</span>
                                            @endif
                                        </div> 
                                    </div> -->

                                  <!--   <div class="col-md-6">
                                        <div class="form-group"> 
                                            {!! Form::label('passport_expiry_date', lang('Passport Expiry Date'), array('class' => '')) !!}
                                            @if(!empty($result->id))
                                                {!! Form::text('passport_expiry_date', null, array('class' => 'form-control','readonly')) !!}
                                            @else
                                                {!! Form::text('passport_expiry_date', null, array('class' => 'form-control', 'required'=> 'true')) !!}
                                            @endif 
                                            @if($errors->has('passport_expiry_date'))
                                             <span class="text-danger">{{$errors->first('passport_expiry_date')}}</span>
                                            @endif
                                        </div> 
                                    </div> -->

                                    <!-- <div class="col-md-6">
                                        <div class="form-group"> 
                                            {!! Form::label('emirates_id_number', lang('Emirates ID Number'), array('class' => '')) !!}
                                            @if(!empty($result->id))
                                                {!! Form::text('emirates_id_number', null, array('class' => 'form-control','readonly')) !!}
                                            @else
                                                {!! Form::text('emirates_id_number', null, array('class' => 'form-control', 'required'=> 'true')) !!}
                                            @endif 
                                            @if($errors->has('emirates_id_number'))
                                             <span class="text-danger">{{$errors->first('emirates_id_number')}}</span>
                                            @endif
                                        </div> 
                                    </div> -->

                                    <!-- <div class="col-md-6">
                                        <div class="form-group"> 
                                            {!! Form::label('emirates_expire_date', lang('Emirates ID Expire Date'), array('class' => '')) !!}
                                            @if(!empty($result->id))
                                                {!! Form::text('emirates_expire_date', null, array('class' => 'form-control','readonly')) !!}
                                            @else
                                                {!! Form::text('emirates_expire_date', null, array('class' => 'form-control', 'required'=> 'true')) !!}
                                            @endif 
                                            @if($errors->has('emirates_expire_date'))
                                             <span class="text-danger">{{$errors->first('emirates_expire_date')}}</span>
                                            @endif
                                        </div> 
                                    </div> -->

                                  <!--   <div class="col-md-6">
                                        <div class="form-group"> 
                                            {!! Form::label('education', lang('Highest Level Of Education'), array('class' => '')) !!}
                                            @if(!empty($result->id))
                                                {!! Form::text('education', null, array('class' => 'form-control','readonly')) !!}
                                            @else
                                                {!! Form::text('education', null, array('class' => 'form-control', 'required'=> 'true')) !!}
                                            @endif 
                                            @if($errors->has('education'))
                                             <span class="text-danger">{{$errors->first('education')}}</span>
                                            @endif
                                        </div> 
                                    </div> -->

                                  <!--   <div class="col-md-6">
                                        <div class="form-group"> 
                                            {!! Form::label('collage_name', lang('Name of Collage / Institution / University'), array('class' => '')) !!}
                                            @if(!empty($result->id))
                                                {!! Form::text('collage_name', null, array('class' => 'form-control','readonly')) !!}
                                            @else
                                                {!! Form::text('collage_name', null, array('class' => 'form-control', 'required'=> 'true')) !!}
                                            @endif 
                                            @if($errors->has('collage_name'))
                                             <span class="text-danger">{{$errors->first('collage_name')}}</span>
                                            @endif
                                        </div> 
                                    </div> -->

                               <!--      <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="sub-label">Country Studied In</label>
                                            <select name="country_studied_in" class="form-control" readonly="" required="true">
                                            @foreach($countries as $country)       
                                            <option value="{{ $country->id }}" @if($country->id == $result->country_studied_in) selected @endif >{{ $country->country_name }}</option>
                                            @endforeach  
                                            </select>
                                        </div>
                                    </div> -->

                             <!--        <div class="col-md-6">
                                        <div class="form-group"> 
                                            {!! Form::label('percentage_cgpa', lang('Percentage / CGP'), array('class' => '')) !!}
                                            @if(!empty($result->id))
                                                {!! Form::text('percentage_cgpa', null, array('class' => 'form-control','readonly')) !!}
                                            @else
                                                {!! Form::text('percentage_cgpa', null, array('class' => 'form-control', 'required'=> 'true')) !!}
                                            @endif 
                                            @if($errors->has('percentage_cgpa'))
                                             <span class="text-danger">{{$errors->first('percentage_cgpa')}}</span>
                                            @endif
                                        </div> 
                                    </div> -->

                                <!--     <div class="col-md-6">
                                        <div class="form-group"> 
                                            {!! Form::label('course_completion_date', lang('Course Date Completion Date'), array('class' => '')) !!}
                                            @if(!empty($result->id))
                                                {!! Form::text('course_completion_date', null, array('class' => 'form-control','readonly')) !!}
                                            @else
                                                {!! Form::text('course_completion_date', null, array('class' => 'form-control', 'required'=> 'true')) !!}
                                            @endif 
                                            @if($errors->has('course_completion_date'))
                                             <span class="text-danger">{{$errors->first('course_completion_date')}}</span>
                                            @endif
                                        </div> 
                                    </div> -->
<!-- 
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                            {!! Form::label('diploma_certifications', lang('Diploma / Certifications'), array('class' => '')) !!}
                                            @if(!empty($result->id))
                                                {!! Form::text('diploma_certifications', null, array('class' => 'form-control','readonly')) !!}
                                            @else
                                                {!! Form::text('diploma_certifications', null, array('class' => 'form-control', 'required'=> 'true')) !!}
                                            @endif 
                                            @if($errors->has('diploma_certifications'))
                                             <span class="text-danger">{{$errors->first('diploma_certifications')}}</span>
                                            @endif
                                        </div> 
                                    </div> -->

                                    <!-- <div class="col-md-6">
                                        <div class="form-group"> 
                                            {!! Form::label('duration_of_course', lang('Duration of Course'), array('class' => '')) !!}
                                            @if(!empty($result->id))
                                                {!! Form::text('duration_of_course', null, array('class' => 'form-control','readonly')) !!}
                                            @else
                                                {!! Form::text('duration_of_course', null, array('class' => 'form-control', 'required'=> 'true')) !!}
                                            @endif 
                                            @if($errors->has('duration_of_course'))
                                             <span class="text-danger">{{$errors->first('duration_of_course')}}</span>
                                            @endif
                                        </div> 
                                    </div> -->

                                    <!-- <div class="col-md-6">
                                        <div class="form-group"> 
                                            {!! Form::label('current_position', lang('Current Position'), array('class' => '')) !!}
                                            @if(!empty($result->id))
                                                {!! Form::text('current_position', null, array('class' => 'form-control','readonly')) !!}
                                            @else
                                                {!! Form::text('current_position', null, array('class' => 'form-control', 'required'=> 'true')) !!}
                                            @endif 
                                            @if($errors->has('current_position'))
                                             <span class="text-danger">{{$errors->first('current_position')}}</span>
                                            @endif
                                        </div> 
                                    </div> -->

                                    <!-- <div class="col-md-6">
                                        <div class="form-group"> 
                                            {!! Form::label('current_employer_name', lang('Current Employer Name'), array('class' => '')) !!}
                                            @if(!empty($result->id))
                                                {!! Form::text('current_employer_name', null, array('class' => 'form-control','readonly')) !!}
                                            @else
                                                {!! Form::text('current_employer_name', null, array('class' => 'form-control', 'required'=> 'true')) !!}
                                            @endif 
                                            @if($errors->has('current_employer_name'))
                                             <span class="text-danger">{{$errors->first('current_employer_name')}}</span>
                                            @endif
                                        </div> 
                                    </div> -->

                                    <!-- <div class="col-md-6">
                                        <div class="form-group"> 
                                            {!! Form::label('notice_period', lang('Notice Period'), array('class' => '')) !!}
                                            @if(!empty($result->id))
                                                {!! Form::text('notice_period', null, array('class' => 'form-control','readonly')) !!}
                                            @else
                                                {!! Form::text('notice_period', null, array('class' => 'form-control', 'required'=> 'true')) !!}
                                            @endif 
                                            @if($errors->has('notice_period'))
                                             <span class="text-danger">{{$errors->first('notice_period')}}</span>
                                            @endif
                                        </div> 
                                    </div> -->

                                    <!-- <div class="col-md-6">
                                        <div class="form-group"> 
                                            {!! Form::label('current_salary', lang('Current Salary (In AED)'), array('class' => '')) !!}
                                            @if(!empty($result->id))
                                                {!! Form::text('current_salary', null, array('class' => 'form-control','readonly')) !!}
                                            @else
                                                {!! Form::text('current_salary', null, array('class' => 'form-control', 'required'=> 'true')) !!}
                                            @endif 
                                            @if($errors->has('current_salary'))
                                             <span class="text-danger">{{$errors->first('current_salary')}}</span>
                                            @endif
                                        </div> 
                                    </div> -->

                                    <!-- <div class="col-md-6">
                                        <div class="form-group"> 
                                            {!! Form::label('expected_salary', lang('Expected Salary (In AED)'), array('class' => '')) !!}
                                            @if(!empty($result->id))
                                                {!! Form::text('expected_salary', null, array('class' => 'form-control','readonly')) !!}
                                            @else
                                                {!! Form::text('expected_salary', null, array('class' => 'form-control', 'required'=> 'true')) !!}
                                            @endif 
                                            @if($errors->has('expected_salary'))
                                             <span class="text-danger">{{$errors->first('expected_salary')}}</span>
                                            @endif
                                        </div> 
                                    </div> -->

                                    <!-- @if(isset($result->education_document))
                                    <div class="col-md-6" style="margin-top: 20px;">
                                        <label>Education Document</label><br>
                                        <a href="{{ asset($result->education_document) }}" download=""> Download</a>
                                    </div>    
                                    @endif -->

                                    @if(isset($result->resume))
                                    <div class="col-md-6" style="margin-top: 20px;">
                                        <label>Resume</label><br>
                                        <a href="{{ asset($result->resume) }}" download=""> Download</a>
                                    </div>    
                                    @endif

                                    <input type="hidden" value="normal" name="provider">
                                    <div class="col-md-6" style="margin-top: 20px;">
                                   <!--  <button type="submit" class="btn btn-default w3ls-button">Submit</button>  -->
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
        </div> 
            </div>
        </div>
    </div>
</div>

<style type="text/css">
.form-body li{
    list-style: none;
    font-size: 16px;
    margin-bottom: 10px;
}
.form-body li span {
    color: #1777e5;
}
.cm_type {
    float: left;
    color: #000 !important;
    background: #ffff;
    padding: 9px 22px;
    border: 1px solid #000;
    border-radius: 25px;
    margin-right: 25px;
    font-size: 14px;
    /*cursor: pointer;*/
    margin-bottom: 15px;
    margin-top: 0px;
}
.cm_type.active {
    background: #FF6722;
    color: #fff !important;
}



</style>

@stop





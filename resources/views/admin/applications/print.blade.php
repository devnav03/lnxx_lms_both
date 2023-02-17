@extends('admin.layouts.admin')
@section('content')
@php
    $route  = \Route::currentRouteName();    
@endphp
<div class="agile-grids">   
    <div class="grids">       
        <div class="row">
            <div class="col-md-12">
            <h1 style="font-size: 17px;font-weight: normal;display: block;margin-bottom: 0px;" class="page-header"> @if(isset($result->ref_id)) Application No #{{ $result->ref_id }} @else Application @endif &nbsp;&nbsp; | &nbsp;&nbsp; Application For : {{ $service->name }} @if($result->service_id == 1) @if($PersonalLoanlimit->loan_limit != 0) &nbsp;&nbsp; | &nbsp;&nbsp; Eligible Loan Amount AED {!! round($PersonalLoanlimit->loan_limit, 2) !!}/- &nbsp;&nbsp; | &nbsp;&nbsp;   EMI AED {!! round($PersonalLoanlimit->loan_emi, 2) !!}/- @endif @endif  @if($result->service_id == 3) @if($PersonalLoanlimit->loan_limit != 0) &nbsp;&nbsp; | &nbsp;&nbsp; Eligible Limit AED {!! round($PersonalLoanlimit->loan_limit, 2) !!}/- @endif @endif <a class="noPrint btn btn-sm btn-primary pull-right" href="{!! route('applications.index') !!}"> <i class="fa fa-arrow-left"></i> All Applications </a> <a style="margin-right: 10px; color: #fff;" class="noPrint btn btn-sm btn-primary pull-right" href="{{ route('applications.edit', $result->id) }}">Back</a></h1>
            <form action="{{ route('applications-profile') }}" method="POST" style="background: #fff; padding: 30px; margin-bottom: 30px;">
                {{ csrf_field() }}
                <label style="font-size: 17px; font-weight: 600;">Select Bank</label>
                <input type="hidden" name="id" value="{{ $result->id }}">
                <ul style="padding: 0px; list-style: none;">
                    @php
                        $i = 1;
                    @endphp
                    @foreach($bank_lists as $bank_list)
                    <li><label><input @if($i == 1) checked="" @endif style="margin-right: 7px; width: 15px; height: 15px; margin-top: 2px; float: left;" type="radio" name="bank_id" value="{{ $bank_list->id }}"> {{ $bank_list->name }}</label></li>
                    @php
                        $i++;
                    @endphp
                    @endforeach
                </ul>
                <button style="background: #5EB495; color: #fff; border: 0px; padding: 8px 25px; font-size: 16px;" type="submit">Generate</button>
            </form>

            <div class="print">
            <div class="card custom-card">
            <div class="card-body">
            <div class="panel panel-widget forms-panel" style="float: left;width: 100%; padding-bottom: 20px;">
                <div class="forms">
                        <div class="form-grids widget-shadow" data-example-id="basic-forms"> 
                            <div class="form-title">
                                <h4>Customer Information</h4>                        
                            </div>
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                            {!! Form::label('name', lang('Name'), array('class' => '')) !!}
                                            @if(!empty($result->id))
                                                {!! Form::text('name', null, array('class' => 'form-control', 'required'=> 'true')) !!}
                                            @else
                                                {!! Form::text('name', null, array('class' => 'form-control', 'required'=> 'true')) !!}
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
                                                {!! Form::number('mobile', null, array('class' => 'form-control', 'required'=> 'true')) !!}
                                            @else
                                                {!! Form::number('mobile', null, array('class' => 'form-control', 'required'=> 'true')) !!}
                                            @endif
                                            @if($errors->has('mobile'))
                                             <span class="text-danger">{{$errors->first('mobile')}}</span>
                                            @endif
                                        </div> 
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                        {!! Form::label('date_of_birth', lang('Date of Birth'), array('class' => '')) !!}
                                        @if($result->date_of_birth)
                                        <input type="text" value="{{ $result->date_of_birth }}" readonly="" class="form-control"> 
                                        @else
                                        {!! Form::date('date_of_birth', null, array('class' => 'form-control', 'required'=> 'true')) !!}
                                        @endif

                                        @if($errors->has('date_of_birth'))
                                            <span class="text-danger">{{$errors->first('date_of_birth')}}</span>
                                        @endif
                                        </div> 
                                    </div> 
                                    
                                    @if($result->gender)
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                        {!! Form::label('gender', lang('Gender'), array('class' => '')) !!}
                                        <input type="text" value="{{ $result->gender }}" readonly="" class="form-control"> 
                                        <!-- <select name="gender" required="true" class="form-control">
                                          <option value="">Select</option>
                                          @if(isset($result))
                                          <option value="Male" @if($result->gender == 'Male') selected @endif>Male</option>
                                          <option value="Female" @if($result->gender == 'Female') selected @endif>Female</option>
                                          @else
                                          <option value="Male">Male</option>
                                          <option value="Female">Female</option>
                                          @endif
                                        </select> -->
                                        @if($errors->has('gender'))
                                            <span class="text-danger">{{$errors->first('gender')}}</span>
                                        @endif
                                        </div> 
                                    </div>
                                    @endif
            
                                    @if(isset($result->profile_image))
                                    <div class="col-md-6" >
                                        <label>Profile Image</label><br>
                                        <img id="blah" src="{!! asset($result->profile_image) !!}" style="max-width: 150px;margin-top: 10px;" alt="" />
                                    </div>    
                                    @endif
                                    <input type="hidden" value="normal" name="provider">
                                   <!--  <div class="col-md-6" style="margin-top: 20px;">
                                    <button type="submit" class="btn btn-default w3ls-button">Submit</button> 
                                    </div>  -->
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div> 
                </div>

                @if($result->emirates_id)
                <div class="card custom-card">
                    <div class="card-body">
                    <div class="panel panel-widget forms-panel" style="float: left;width: 100%; padding-bottom: 20px;">
                        <div class="forms">
                                <div class="form-grids widget-shadow" data-example-id="basic-forms"> 
                                    <div class="form-title">
                                        <h4>Emirates ID</h4>                        
                                    </div>
                                    <div class="form-body">
                                        <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="sub-label">Emirates ID Number*</label>
                                                <input name="eid_number" class="form-control" value="{{ $result->eid_number }}" type="text">
                                            </div>
                                        </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6" style="margin-top: 10px;">
                                               <img src="{!! asset($result->emirates_id) !!}">
                                            </div>
                                            <div class="col-md-6" style="margin-top: 10px;">
                                               <img src="{!! asset($result->emirates_id_back) !!}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            

            <div class="card custom-card">
                <div class="card-body">
                <div class="panel panel-widget forms-panel" style="float: left;width: 100%; padding-bottom: 20px;">
                    <div class="forms">
                            <div class="form-grids widget-shadow" data-example-id="basic-forms"> 
                                <div class="form-title">
                                    <h4>Personal Details</h4>                        
                                </div>
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label style="margin-top: 15px; font-size: 15px; font-weight: 500;">Name As Per Passport</label>
                                            </div>
                                            <div class="col-md-3">
                                              <label class="sub-label">Salutation</label>
                                              <select name="salutation" class="form-control" required="true">
                                                <option @if($result->salutation == 'Mr.') selected @endif value="Mr.">Mr.</option>
                                                <option @if($result->salutation == 'Mrs.') selected @endif value="Mrs.">Mrs.</option>
                                                <option @if($result->salutation == 'Miss.') selected @endif value="Miss.">Miss</option>
                                                <option @if($result->salutation == 'Dr.') selected @endif value="Dr.">Dr.</option>
                                                <option @if($result->salutation == 'Prof.') selected @endif value="Prof.">Prof.</option>
                                                <option @if($result->salutation == 'Rev.') selected @endif value="Rev.">Rev.</option>
                                                <option @if($result->salutation == 'Other') selected @endif value="Other">Other</option>
                                              </select>
                                            </div>
                                            <div class="col-md-9">
                                              <div class="row">  
                                                <div class="col-md-4">
                                                  <div class="form-group">
                                                    <label class="sub-label">First Name</label>
                                                    <input name="name" class="form-control" value="{{ $result->name }}" type="text" pattern="(?=^.{2,25}$)(?![.\n])(?=.*[a-zA-Z]).*$" required="true">
                                                    @if($errors->has('name'))
                                                    <span class="text-danger">{{$errors->first('name')}}</span>
                                                    @endif
                                                  </div>
                                                </div>
                                                <div class="col-md-4">
                                                  <div class="form-group">
                                                    <label class="sub-label">Middle Name</label>
                                                    <input name="middle_name" class="form-control" value="{{ $result->middle_name }}" type="text" pattern="(?=^.{2,25}$)(?![.\n])(?=.*[a-zA-Z]).*$">
                                                    @if($errors->has('middle_name'))
                                                    <span class="text-danger">{{$errors->first('middle_name')}}</span>
                                                    @endif
                                                  </div>
                                                </div>
                                                <div class="col-md-4">
                                                  <div class="form-group">
                                                    <label class="sub-label">Last Name</label>
                                                    <input name="last_name" class="form-control" value="{{ $result->last_name }}" type="text" pattern="(?=^.{2,25}$)(?![.\n])(?=.*[a-zA-Z]).*$">
                                                    @if($errors->has('last_name'))
                                                    <span class="text-danger">{{$errors->first('last_name')}}</span>
                                                    @endif
                                                  </div>
                                                </div>
                                              </div>
                                            </div>

                                </div>

    <div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="sub-label">Nationality*</label>
            <select name="nationality" class="form-control" required="true">
            @foreach($country as $country1)       
            <option value="{{ $country1->id }}" @if($country1->id == $result->nationality) selected @endif >{{ $country1->country_name }}</option>
            @endforeach  
            </select>
           <!--  <input name="nationality" class="form-control" value="{{ $result->nationality }}" type="text" required="true"> -->
        </div>
    </div>
    @if($result->nationality != 229)
    <div class="col-md-6">
        <div class="form-group">
            <label class="sub-label">Years in UAE*</label>
            <input name="years_in_uae" class="form-control" value="{{ $result->years_in_uae }}" type="text" required="true">
        </div>
    </div>
    @endif
    <div class="col-md-6">
        <div class="form-group">
            <label class="sub-label">Marital Status*</label>
            <input name="marital_status" class="form-control" value="{{ $result->marital_status }}" type="text" required="true">
        </div>
    </div>

    @if($result->marital_status == 'Married')

        <div class="col-md-6">
            <div class="form-group">
                <label class="sub-label">Spouse Name*</label>
                <input name="wife_name" class="form-control" value="{{ $result->wife_name }}" type="text" required="true">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="sub-label">Spouse DOB*</label>
                <input name="spouse_date_of_birth" class="form-control" value="{{ $result->spouse_date_of_birth }}" type="text" required="true">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="sub-label">Wedding Anniversary Date*</label>
                <input name="wedding_anniversary_date" class="form-control" value="{{ $result->wedding_anniversary_date }}" type="text" required="true">
            </div>
        </div>


    @endif 

    <div class="col-md-6">
        <div class="form-group">
        <label class="sub-label">No of Dependents*</label>
        <input name="no_of_dependents" class="form-control" @if($result->no_of_dependents) value="{{ $result->no_of_dependents }}" @endif type="text" required="true">
        </div>
    </div>

    @if($dependents)
    <div class="col-md-12"></div>
        @foreach($dependents as $key => $dependent)
            <div class="col-md-6">
                <div class="form-group">
                  <label class="sub-label">Name</label>
                  <input name="dependent_name[{{$key}}]" class="form-control" value="{{ $dependent->name }}" type="text">
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group">
                <label class="sub-label">Relation</label>
                <select name="dependent_relation[{{$key}}]" class="form-control">
                <option value="">Select</option>
                <option value="Father" @if($dependent->relation == "Father") selected @endif >Father</option>
                <option value="Mother" @if($dependent->relation == "Mother") selected @endif >Mother</option>
                <option value="Son" @if($dependent->relation == "Son") selected @endif >Son</option>
                <option value="Daughter" @if($dependent->relation == "Daughter") selected @endif >Daughter</option>
                <option value="Brother" @if($dependent->relation == "Brother") selected @endif >Brother</option>
                <option value="Sister" @if($dependent->relation == "Sister") selected @endif >Sister</option>
                <option value="Grandfather" @if($dependent->relation == "Grandfather") selected @endif >Grandfather</option>
                <option value="Grandmother" @if($dependent->relation == "Grandmother") selected @endif >Grandmother</option>
                <option value="Uncle" @if($dependent->relation == "Uncle") selected @endif >Uncle</option>
                <option value="Aunt" @if($dependent->relation == "Aunt") selected @endif >Aunt</option>
                <option value="Cousin" @if($dependent->relation == "Cousin") selected @endif >Cousin</option>
                <option value="Nephew" @if($dependent->relation == "Nephew") selected @endif >Nephew</option>
                <option value="Niece" @if($dependent->relation == "Niece") selected @endif >Niece</option>
                <option value="Husband" @if($dependent->relation == "Husband") selected @endif >Husband</option>
                <option value="Wife" @if($dependent->relation == "Wife") selected @endif >Wife</option>
                </select>
                </div>
            </div>
        @endforeach
    @endif


    <div class="col-md-6">
        <div class="form-group">
            <label class="sub-label">Are you assisted by an agent?</label>
            <input name="agent_reference" class="form-control" value=" @if($result->agent_reference == 0) No @else Yes @endif " type="text">
        </div>
    </div>
    @if($result->agent_reference == 1)
    <div class="col-md-6">
        <div class="form-group">
            <label class="sub-label">Reference Number</label>
            <input name="reference_number" class="form-control" value="{{ $result->reference_number }}" type="text">
        </div>
    </div>
    @endif
    @if($result->visa_number)
    <div class="col-md-6">
        <div class="form-group">
            <label class="sub-label">Visa Number</label>
            <input name="visa_number" class="form-control" @if($result->visa_number) value="{{ $result->visa_number }}" @endif type="text">
        </div>
    </div>
    @endif
    @if($result->officer_email)
    <div class="col-md-6">
        <div class="form-group">
            <label class="sub-label">Official mail ID</label>
            <input name="officer_email" class="form-control" value="{{ $result->officer_email }}" type="text">
        </div>
    </div>
    @endif
    @if($result->credit_score)
    <div class="col-md-6">
        <div class="form-group">
            <label class="sub-label">AECB Credit Score</label>
            <input name="credit_score" class="form-control" value="{{ $result->credit_score }}" type="text">
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="form-group">
            <label class="sub-label">Date (when the score was fetched)</label>
            <input name="aecb_date" class="form-control" value="{{ $result->aecb_date }}" type="text" readonly="">
        </div>
    </div>
    @if($result->aecb_image)
    <div class="col-md-6 noPrint">
        <div class="form-group">
            <label class="sub-label">AECB credit score file</label><br>
            <a href="{{ asset($result->aecb_image) }}" download>Download</a>
        </div>
    </div>
    @endif

    
    @endif
    <div class="col-md-12"></div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="sub-label">Passport Number</label>
            <input name="passport_number" class="form-control" value="{{ $result->passport_number }}" type="text">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label class="sub-label">Passport Expiry Date</label>
            <input name="passport_expiry_date" class="form-control" value="{{ $result->passport_expiry_date }}" type="text" readonly="">
        </div>
    </div>

    @if($result->passport_photo)
    <div class="col-md-6">
        <div class="form-group">
            <label class="sub-label">Passport Photo</label><br>
            <img src="{!! asset($result->passport_photo) !!}" class="img-responsive">
        </div>
    </div>
    @endif

    </div>
    </div>
                                
    </div>
    </div>
    </div>
    </div> 
    </div>


            @if($result->cm_type == 1)
            <div class="card custom-card">
            <div class="card-body">
            <div class="panel panel-widget forms-panel" style="float: left;width: 100%; padding-bottom: 20px;">
                <div class="forms">
                    <div class="form-grids widget-shadow" data-example-id="basic-forms"> 
                    <div class="form-title">
                        <h4 style="margin-bottom: 20px;">Employment Details</h4>                     
                    </div>
                    <div class="form-body">
                    <div class="row">  
                    <div class="col-md-12">
                        <h6 id="salaried" class="cm_type @if($result->cm_type == 1) active @else noPrint @endif ">Salaried</h6>
                        <h6 id="self_employed" class="cm_type @if($result->cm_type == 2) active @else noPrint @endif">Self Employed</h6>
                        <h6 id="other_employed"  class="cm_type @if($result->cm_type == 3) active @else noPrint @endif ">Pension</h6>
                        <input type="hidden" id="cm_type" name="cm_type" value="{{ $result->cm_type }}">
                    </div>      
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="sub-label">Company Name*</label>
                          <input name="company_name" class="form-control" value="{{ $result->company_name }}" type="text" required="true"> 
                          @if($errors->has('company_name'))
                          <span class="text-danger">{{$errors->first('company_name')}}</span>
                          @endif
                        </div>
                    </div>

    <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Date Of Joining*</label>
      <input name="date_of_joining" class="form-control" readonly="" value="{{ $result->date_of_joining }}" type="text">
      @if($errors->has('date_of_joining'))
      <span class="text-danger">{{$errors->first('date_of_joining')}}</span>
      @endif
    </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
          <label class="sub-label">Monthly Salary*</label>
          <input name="monthly_salary" class="form-control" value="{{ $result->monthly_salary }}" type="text">
          @if($errors->has('monthly_salary'))
          <span class="text-danger">{{$errors->first('monthly_salary')}}</span>
          @endif
        </div>
    </div>

    <div class="col-md-12">
        <label class="sub-label">Last Three Salary Credits</label>
    </div>
  
    <div class="col-md-4">
        <div class="row">
        <div class="col-md-9">
            <div class="form-group">
              <label class="sub-label">First</label>
              <input name="last_one_salary_credits" class="form-control" value="{{ $result->last_one_salary_credits }}" type="number">
              @if($errors->has('last_one_salary_credits'))
              <span class="text-danger">{{$errors->first('last_one_salary_credits')}}</span>
              @endif
            </div>
        </div>
        <div class="col-md-3 noPrint">
            @if($result->last_one_salary_file)
            <a style="margin-top: 39px; float: left; margin-left: -105px;" href="{{ asset($result->last_one_salary_file) }}" download>Download</a>
            @endif
        </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-9">
                <div class="form-group">
                  <label class="sub-label">Second</label>
                  <input name="last_two_salary_credits" class="form-control" value="{{ $result->last_two_salary_credits }}" type="number">
                  @if($errors->has('last_two_salary_credits'))
                  <span class="text-danger">{{$errors->first('last_two_salary_credits')}}</span>
                  @endif
                </div>
            </div>
            <div class="col-md-3 noPrint">
                @if($result->last_two_salary_file)
                <a style="margin-top: 39px; float: left; margin-left: -105px;" href="{{ asset($result->last_two_salary_file) }}" download>Download</a>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="row">
        <div class="col-md-9">
        <div class="form-group">
          <label class="sub-label">Third</label>
          <input name="last_three_salary_credits" class="form-control" value="{{ $result->last_three_salary_credits }}" type="number">
          @if($errors->has('last_three_salary_credits'))
          <span class="text-danger">{{$errors->first('last_three_salary_credits')}}</span>
          @endif
        </div>
        </div>
        <div class="col-md-3 noPrint">
        @if($result->last_three_salary_file)
        <a style="margin-top: 39px; float: left; margin-left: -105px;" href="{{ asset($result->last_three_salary_file) }}" download>Download</a>
        @endif
        </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
          <label class="sub-label">I have company provided accommodation</label>
          <input name="accommodation_company" class="form-control" value=" @if($result->accommodation_company == 0) No @else Yes @endif " type="text">
          @if($errors->has('    accommodation_company'))
          <span class="text-danger">{{$errors->first('  accommodation_company')}}</span>
          @endif
        </div>
    </div>
    </div>                           
    </div>                     
    </div>
    </div>
    </div>
    </div> 
    </div>
           
            @endif  
            @if($result->cm_type == 2)

            <div class="card custom-card">
            <div class="card-body">
            <div class="panel panel-widget forms-panel" style="float: left;width: 100%; padding-bottom: 20px;">
                <div class="forms">
                <div class="form-grids widget-shadow" data-example-id="basic-forms"> 
                    <div class="form-title">
                        <h4>Employment Details</h4>                        
                    </div>
            <div class="form-body">
            <div class="row">    
            <div class="col-md-12">
                <h6 id="salaried" class="cm_type @if($result->cm_type == 1) active @else noPrint @endif">Salaried</h6>
                <h6 id="self_employed" class="cm_type @if($result->cm_type == 2) active @else noPrint @endif">Self Employed</h6>
                <h6 id="other_employed"  class="cm_type @if($result->cm_type == 3) active @else noPrint @endif">Pension</h6>
                <input type="hidden" id="cm_type" name="cm_type" value="{{ $result->cm_type }}">
            </div>    
            <div class="col-md-6">
                <div class="form-group">
                  <label class="sub-label">Company Name*</label>
                   <input name="self_company_name" class="form-control" value="{{ $result->self_company_name }}" type="text">
                   <!-- <select name="self_company_name" class="form-control" required="true">
                    @foreach($company as $comp)
                    <option value="{{ $comp->id }}" @if($result->self_company_name == $comp->id) selected @endif >{{ $comp->name }}</option> 
                    @endforeach
                  </select> -->
                  @if($errors->has('self_company_name'))
                  <span class="text-danger">{{$errors->first('self_company_name')}}</span>
                  @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                  <label class="sub-label">Percentage Ownership*</label>
                  <input name="percentage_ownership" class="form-control" value="{{ $result->percentage_ownership }}" type="text">
                  @if($errors->has('percentage_ownership'))
                  <span class="text-danger">{{$errors->first('percentage_ownership')}}</span>
                  @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                  <label class="sub-label">Type of profession/business*</label>
                  <input name="profession_business" class="form-control" required="true" value="{{ $result->profession_business }}" type="text">
                  @if($errors->has('profession_business'))
                  <span class="text-danger">{{$errors->first('profession_business')}}</span>
                  @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                  <label class="sub-label">Annual Business Income*</label>
                  <input name="annual_business_income" class="form-control" value="{{ $result->annual_business_income }}" type="number">
                  @if($errors->has('annual_business_income'))
                  <span class="text-danger">{{$errors->first('annual_business_income')}}</span>
                  @endif
                </div>
            </div>
    </div>                           
         
                                </div>
                            </div>
                        </div>
                    </div>
                    </div> 
                </div>
       
                @endif

            @if($result->cm_type == 3)

            <div class="card custom-card">
                <div class="card-body">
                <div class="panel panel-widget forms-panel" style="float: left;width: 100%; padding-bottom: 20px;">
                    <div class="forms">
                            <div class="form-grids widget-shadow" data-example-id="basic-forms"> 
                                <div class="form-title">
                                    <h4>Employment Details</h4>                        
                                </div>
                                <div class="form-body">
                    <div class="row"> 
                    <div class="col-md-12">
                        <h6 id="salaried" class="cm_type @if($result->cm_type == 1) active @else noPrint @endif">Salaried</h6>
                        <h6 id="self_employed" class="cm_type @if($result->cm_type == 2) active @else noPrint @endif">Self Employed</h6>
                        <h6 id="other_employed"  class="cm_type @if($result->cm_type == 3) active @else noPrint @endif">Pension</h6>
                        <input type="hidden" id="cm_type" name="cm_type" value="{{ $result->cm_type }}">
                    </div>       
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="sub-label">Monthly Pension*</label>
                          <input name="monthly_pension" class="form-control" required="true" value="{{ $result->monthly_pension }}"  type="text">
                          @if($errors->has('monthly_pension'))
                          <span class="text-danger">{{$errors->first('monthly_pension')}}</span>
                          @endif
                        </div>
                      </div>
    </div>                           
         
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    </div> 
                </div>
      
                @endif
            
            @if(count($PersonalLoanPreference) != 0)
            <div class="card custom-card">
                <div class="card-body">
                    <div class="panel panel-widget forms-panel" style="float: left;width: 100%; padding-bottom: 20px;">
                        <div class="forms">
                            <div class="form-title">
                                <h4>Preferred Bank</h4>                        
                            </div>
                            <ul style="padding-left: 15px; margin-bottom: 0px;">
                                @foreach($PersonalLoanPreference as $preference_bank)
                                    <li style="margin-bottom: 5px; font-size: 15px;">{{ $preference_bank->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div> 
            @endif

            @if(count($CardTypePreference) != 0)
            <div class="card custom-card">
                <div class="card-body">
                    <div class="panel panel-widget forms-panel" style="float: left;width: 100%; padding-bottom: 20px;">
                        <div class="forms">
                            <div class="form-title">
                                <h4>Preferred Card Type</h4>                        
                            </div>
                            <ul style="padding-left: 15px; margin-bottom: 0px;">
                                @foreach($CardTypePreference as $CardType)
                                    <li style="margin-bottom: 5px; font-size: 15px;">{{ $CardType->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div> 
            @endif


            <div class="card custom-card">
            @if($Application_Request)    
            <div class="card-body">
            <div class="panel panel-widget forms-panel" style="float: left;width: 100%; padding-bottom: 20px;">
                <div class="forms">
                <div class="form-grids widget-shadow" data-example-id="basic-forms"> 
                <div class="form-title">
                    <h4>Details of existing financial products</h4>                        
                </div>
                <div class="form-body">   
                <div class="row">
                @if($Application_Request->credit_card_limit != '' ||  $Application_Request->credit_bank_name != '')    
                <div class="col-md-12">                            
                    <label style="font-size: 18px; margin-top: 15px;">Details For Credit Card</label>
                </div>
                @endif
                @if($Application_Request->credit_card_limit)
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Required credit card limit</label>
                      <input name="credit_card_limit" class="form-control" value="{{ $Application_Request->credit_card_limit }}" type="text">
                      @if($errors->has('credit_card_limit'))
                      <span class="text-danger">{{$errors->first('credit_card_limit')}}</span>
                      @endif
                    </div>
                </div>
                @endif
                @if($Application_Request->credit_bank_name)
                <div class="col-md-12">                            
                    <label style="font-size: 15px; margin-top: 0px;">Existing Financial Products</label>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Details of Cards</label>
                      <input name="details_of_cards" class="form-control" value="{{ $Application_Request->details_of_cards }}" type="text" required="true">
                      @if($errors->has('details_of_cards'))
                      <span class="text-danger">{{$errors->first('details_of_cards')}}</span>
                      @endif
                    </div>
                </div> 
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Bank Name</label>
                      <select name="credit_bank_name" class="form-control">
                            @foreach($banks as $bank)
                                <option value="$bank->id" @if($bank->id == $Application_Request->credit_bank_name ) selected @endif>{{ $bank->name }}</option>
                            @endforeach
                      </select>

                      @if($errors->has('credit_bank_name'))
                      <span class="text-danger">{{$errors->first('credit_bank_name')}}</span>
                      @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Card Limit</label>
                      <input name="card_limit" class="form-control" value="{{ $Application_Request->card_limit }}" type="text" required="true">
                      @if($errors->has('card_limit'))
                      <span class="text-danger">{{$errors->first('card_limit')}}</span>
                      @endif
                    </div>
                </div>
                @endif
                @if($Application_Request->credit_bank_name2)
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Details of Cards</label>
                      <input name="details_of_cards2" class="form-control" value="{{ $Application_Request->details_of_cards2 }}" type="text" required="true">
                      @if($errors->has('details_of_cards2'))
                      <span class="text-danger">{{$errors->first('details_of_cards2')}}</span>
                      @endif
                    </div>
                </div> 
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Bank Name</label>
                      <select name="credit_bank_name2" class="form-control">
                            @foreach($banks as $bank)
                                <option value="$bank->id" @if($bank->id == $Application_Request->credit_bank_name2 ) selected @endif>{{ $bank->name }}</option>
                            @endforeach
                      </select>
                      @if($errors->has('credit_bank_name2'))
                      <span class="text-danger">{{$errors->first('credit_bank_name2')}}</span>
                      @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Card Limit</label>
                      <input name="card_limit2" class="form-control" value="{{ $Application_Request->card_limit2 }}" type="text" required="true">
                      @if($errors->has('card_limit2'))
                      <span class="text-danger">{{$errors->first('card_limit2')}}</span>
                      @endif
                    </div>
                </div>
                @endif

                @if($Application_Request->credit_bank_name3)
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Details of Cards</label>
                      <input name="details_of_cards3" class="form-control" value="{{ $Application_Request->details_of_cards3 }}" type="text" required="true">
                      @if($errors->has('details_of_cards3'))
                      <span class="text-danger">{{$errors->first('details_of_cards3')}}</span>
                      @endif
                    </div>
                </div> 
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Bank Name</label>
                      <select name="credit_bank_name3" class="form-control">
                            @foreach($banks as $bank)
                                <option value="$bank->id" @if($bank->id == $Application_Request->credit_bank_name3 ) selected @endif>{{ $bank->name }}</option>
                            @endforeach
                      </select>
                      @if($errors->has('credit_bank_name3'))
                      <span class="text-danger">{{$errors->first('credit_bank_name3')}}</span>
                      @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Card Limit</label>
                      <input name="card_limit3" class="form-control" value="{{ $Application_Request->card_limit3 }}" type="text" required="true">
                      @if($errors->has('card_limit3'))
                      <span class="text-danger">{{$errors->first('card_limit3')}}</span>
                      @endif
                    </div>
                </div>
                @endif

                @if($Application_Request->credit_bank_name4)
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Details of Cards</label>
                      <input name="details_of_cards4" class="form-control" value="{{ $Application_Request->details_of_cards4 }}" type="text" required="true">
                      @if($errors->has('details_of_cards4'))
                      <span class="text-danger">{{$errors->first('details_of_cards4')}}</span>
                      @endif
                    </div>
                </div> 
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Bank Name</label>
                      <select name="credit_bank_name4" class="form-control">
                            @foreach($banks as $bank)
                                <option value="$bank->id" @if($bank->id == $Application_Request->credit_bank_name4 ) selected @endif>{{ $bank->name }}</option>
                            @endforeach
                      </select>
                      @if($errors->has('credit_bank_name4'))
                      <span class="text-danger">{{$errors->first('credit_bank_name4')}}</span>
                      @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Card Limit</label>
                      <input name="card_limit4" class="form-control" value="{{ $Application_Request->card_limit4 }}" type="text" required="true">
                      @if($errors->has('card_limit4'))
                      <span class="text-danger">{{$errors->first('card_limit4')}}</span>
                      @endif
                    </div>
                </div>
                @endif

               
             <!--    <div class="col-md-12">                            
                    <label style="font-size: 18px; margin-top: 15px;">Details For Personal Loan</label>
                </div>  --> 
                @if($Application_Request->loan_amount)
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Required Loan Amount</label>
                      <input name="loan_amount" class="form-control" value="{{ $Application_Request->loan_amount }}" type="text">
                      @if($errors->has('loan_amount'))
                      <span class="text-danger">{{$errors->first('loan_amount')}}</span>
                      @endif
                    </div>
                </div>
                @endif

                @if($Application_Request->exist_personal == 1)
                <div class="col-md-12">                            
                    <label style="font-size: 15px; margin-top: 0px;">Details of Existing Personal Loans</label>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Bank Name</label>
                      <select name="loan_bank_name" class="form-control">
                            @foreach($banks as $bank)
                                <option value="$bank->id" @if($bank->id == $Application_Request->loan_bank_name ) selected @endif>{{ $bank->name }}</option>
                            @endforeach
                      </select>
                      @if($errors->has('loan_bank_name'))
                      <span class="text-danger">{{$errors->first('loan_bank_name')}}</span>
                      @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Original Loan amount</label>
                      <input name="original_loan_amount" class="form-control" value="{{ $Application_Request->original_loan_amount }}" type="text">
                      @if($errors->has('original_loan_amount'))
                      <span class="text-danger">{{$errors->first('original_loan_amount')}}</span>
                      @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">EMI</label>
                      <input name="loan_emi" class="form-control" value="{{ $Application_Request->loan_emi }}" type="text">
                      @if($errors->has('loan_emi'))
                      <span class="text-danger">{{$errors->first('loan_emi')}}</span>
                      @endif
                    </div>
                </div>
                @endif

                @if($Application_Request->loan_bank_name2)
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="sub-label">Bank Name</label>
                          <select name="loan_bank_name2" class="form-control">
                                @foreach($banks as $bank)
                                    <option value="$bank->id" @if($bank->id == $Application_Request->loan_bank_name2) selected @endif>{{ $bank->name }}</option>
                                @endforeach
                          </select>
                          @if($errors->has('loan_bank_name2'))
                          <span class="text-danger">{{$errors->first('loan_bank_name2')}}</span>
                          @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="sub-label">Original Loan amount</label>
                          <input name="original_loan_amount2" class="form-control" value="{{ $Application_Request->original_loan_amount2 }}" type="text">
                          @if($errors->has('original_loan_amount2'))
                          <span class="text-danger">{{$errors->first('original_loan_amount2')}}</span>
                          @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="sub-label">EMI</label>
                          <input name="loan_emi2" class="form-control" value="{{ $Application_Request->loan_emi2 }}" type="text">
                          @if($errors->has('loan_emi2'))
                          <span class="text-danger">{{$errors->first('loan_emi2')}}</span>
                          @endif
                        </div>
                    </div>
                @endif

                @if($Application_Request->loan_bank_name3)
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="sub-label">Bank Name</label>
                          <select name="loan_bank_name3" class="form-control">
                                @foreach($banks as $bank)
                                    <option value="$bank->id" @if($bank->id == $Application_Request->loan_bank_name3) selected @endif>{{ $bank->name }}</option>
                                @endforeach
                          </select>
                          @if($errors->has('loan_bank_name3'))
                          <span class="text-danger">{{$errors->first('loan_bank_name3')}}</span>
                          @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="sub-label">Original Loan amount</label>
                          <input name="original_loan_amount3" class="form-control" value="{{ $Application_Request->original_loan_amount3 }}" type="text">
                          @if($errors->has('original_loan_amount3'))
                          <span class="text-danger">{{$errors->first('original_loan_amount3')}}</span>
                          @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="sub-label">EMI</label>
                          <input name="loan_emi3" class="form-control" value="{{ $Application_Request->loan_emi3 }}" type="text">
                          @if($errors->has('loan_emi3'))
                          <span class="text-danger">{{$errors->first('loan_emi3')}}</span>
                          @endif
                        </div>
                    </div>
                @endif

                @if($Application_Request->loan_bank_name4)
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label class="sub-label">Bank Name</label>
                          <select name="loan_bank_name4" class="form-control">
                                @foreach($banks as $bank)
                                    <option value="$bank->id" @if($bank->id == $Application_Request->loan_bank_name4) selected @endif>{{ $bank->name }}</option>
                                @endforeach
                          </select>
                          @if($errors->has('loan_bank_name4'))
                          <span class="text-danger">{{$errors->first('loan_bank_name4')}}</span>
                          @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="sub-label">Original Loan amount</label>
                          <input name="original_loan_amount4" class="form-control" value="{{ $Application_Request->original_loan_amount4 }}" type="text">
                          @if($errors->has('original_loan_amount4'))
                          <span class="text-danger">{{$errors->first('original_loan_amount4')}}</span>
                          @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="sub-label">EMI</label>
                          <input name="loan_emi4" class="form-control" value="{{ $Application_Request->loan_emi4 }}" type="text">
                          @if($errors->has('loan_emi4'))
                          <span class="text-danger">{{$errors->first('loan_emi4')}}</span>
                          @endif
                        </div>
                    </div>
                @endif 
                

                @if($Application_Request->business_loan_amount)
                <div class="col-md-12">                            
                    <label style="font-size: 18px; margin-top: 15px;">Details For Business Loan</label>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Loan Amount</label>
                      <input name="business_loan_amount" class="form-control" value="{{ $Application_Request->business_loan_amount }}" type="text">
                      @if($errors->has('business_loan_amount'))
                      <span class="text-danger">{{$errors->first('business_loan_amount')}}</span>
                      @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">EMI</label>
                      <input name="business_loan_emi" class="form-control" value="{{ $Application_Request->business_loan_emi }}" type="text">
                      @if($errors->has('business_loan_emi'))
                      <span class="text-danger">{{$errors->first('business_loan_emi')}}</span>
                      @endif
                    </div>
                </div>
                @endif

                @if($Application_Request->business_loan_amount2)
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Loan Amount</label>
                      <input name="business_loan_amount2" class="form-control" value="{{ $Application_Request->business_loan_amount2 }}" type="text">
                      @if($errors->has('business_loan_amount2'))
                      <span class="text-danger">{{$errors->first('business_loan_amount2')}}</span>
                      @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">EMI</label>
                      <input name="business_loan_emi2" class="form-control" value="{{ $Application_Request->business_loan_emi2 }}" type="text">
                      @if($errors->has('business_loan_emi2'))
                      <span class="text-danger">{{$errors->first('business_loan_emi2')}}</span>
                      @endif
                    </div>
                </div>
                @endif

                @if($Application_Request->business_loan_amount3)
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Loan Amount</label>
                      <input name="business_loan_amount3" class="form-control" value="{{ $Application_Request->business_loan_amount3 }}" type="text">
                      @if($errors->has('business_loan_amount3'))
                      <span class="text-danger">{{$errors->first('business_loan_amount3')}}</span>
                      @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">EMI</label>
                      <input name="business_loan_emi3" class="form-control" value="{{ $Application_Request->business_loan_emi3 }}" type="text">
                      @if($errors->has('business_loan_emi3'))
                      <span class="text-danger">{{$errors->first('business_loan_emi3')}}</span>
                      @endif
                    </div>
                </div>
                @endif
                @if($Application_Request->business_loan_amount4)
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Loan Amount</label>
                      <input name="business_loan_amount4" class="form-control" value="{{ $Application_Request->business_loan_amount4 }}" type="text">
                      @if($errors->has('business_loan_amount4'))
                      <span class="text-danger">{{$errors->first('business_loan_amount4')}}</span>
                      @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">EMI</label>
                      <input name="business_loan_emi4" class="form-control" value="{{ $Application_Request->business_loan_emi4 }}" type="text">
                      @if($errors->has('business_loan_emi4'))
                      <span class="text-danger">{{$errors->first('business_loan_emi4')}}</span>
                      @endif
                    </div>
                </div>
                @endif


                @if($Application_Request->mortgage_loan_amount)
                <div class="col-md-12">                            
                    <label style="font-size: 18px; margin-top: 15px;">Details For Mortgage Loan</label>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Loan Amount</label>
                      <input name="mortgage_loan_amount" class="form-control" value="{{ $Application_Request->mortgage_loan_amount }}" type="text">
                      @if($errors->has('mortgage_loan_amount'))
                      <span class="text-danger">{{$errors->first('mortgage_loan_amount')}}</span>
                      @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Purchase price/ current market valuation</label>
                      <input name="purchase_price" class="form-control" value="{{ $Application_Request->purchase_price }}" type="text">
                      @if($errors->has('purchase_price'))
                      <span class="text-danger">{{$errors->first('purchase_price')}}</span>
                      @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Type of loan</label>
                      <input name="type_of_loan" class="form-control" value="{{ $Application_Request->type_of_loan }}" type="text">
                      @if($errors->has('type_of_loan'))
                      <span class="text-danger">{{$errors->first('type_of_loan')}}</span>
                      @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Term of loan</label>
                      <input name="term_of_loan" class="form-control" value="{{ $Application_Request->term_of_loan }}" type="text">
                      @if($errors->has('term_of_loan'))
                      <span class="text-danger">{{$errors->first('term_of_loan')}}</span>
                      @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">End use of property</label>
                      <input name="end_use_of_property" class="form-control" value="{{ $Application_Request->end_use_of_property }}" type="text">
                      @if($errors->has('end_use_of_property'))
                      <span class="text-danger">{{$errors->first('end_use_of_property')}}</span>
                      @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Interest Rate</label>
                      <input name="interest_rate" class="form-control" value="{{ $Application_Request->interest_rate }}" type="text">
                      @if($errors->has('interest_rate'))
                      <span class="text-danger">{{$errors->first('interest_rate')}}</span>
                      @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">EMI</label>
                      <input name="mortgage_emi" class="form-control" value="{{ $Application_Request->mortgage_emi }}" type="text">
                      @if($errors->has('mortgage_emi'))
                      <span class="text-danger">{{$errors->first('mortgage_emi')}}</span>
                      @endif
                    </div>
                </div>
                @endif
                @if($Application_Request->mortgage_loan_amount2)
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Loan Amount</label>
                      <input name="mortgage_loan_amount2" class="form-control" value="{{ $Application_Request->mortgage_loan_amount2 }}" type="text">
                      @if($errors->has('mortgage_loan_amount2'))
                      <span class="text-danger">{{$errors->first('mortgage_loan_amount2')}}</span>
                      @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Purchase price/ current market valuation</label>
                      <input name="purchase_price2" class="form-control" value="{{ $Application_Request->purchase_price2 }}" type="text">
                      @if($errors->has('purchase_price2'))
                      <span class="text-danger">{{$errors->first('purchase_price2')}}</span>
                      @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Type of loan</label>
                      <input name="type_of_loan2" class="form-control" value="{{ $Application_Request->type_of_loan2 }}" type="text">
                      @if($errors->has('type_of_loan2'))
                      <span class="text-danger">{{$errors->first('type_of_loan2')}}</span>
                      @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Term of loan</label>
                      <input name="term_of_loan2" class="form-control" value="{{ $Application_Request->term_of_loan2 }}" type="text">
                      @if($errors->has('term_of_loan2'))
                      <span class="text-danger">{{$errors->first('term_of_loan2')}}</span>
                      @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">End use of property</label>
                      <input name="end_use_of_property2" class="form-control" value="{{ $Application_Request->end_use_of_property2 }}" type="text">
                      @if($errors->has('end_use_of_property2'))
                      <span class="text-danger">{{$errors->first('end_use_of_property2')}}</span>
                      @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Interest Rate</label>
                      <input name="interest_rate2" class="form-control" value="{{ $Application_Request->interest_rate2 }}" type="text">
                      @if($errors->has('interest_rate2'))
                      <span class="text-danger">{{$errors->first('interest_rate2')}}</span>
                      @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">EMI</label>
                      <input name="mortgage_emi2" class="form-control" value="{{ $Application_Request->mortgage_emi2 }}" type="text">
                      @if($errors->has('mortgage_emi2'))
                      <span class="text-danger">{{$errors->first('mortgage_emi2')}}</span>
                      @endif
                    </div>
                </div>
                @endif

                @if($Application_Request->mortgage_loan_amount3)
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Loan Amount</label>
                      <input name="mortgage_loan_amount3" class="form-control" value="{{ $Application_Request->mortgage_loan_amount3 }}" type="text">
                      @if($errors->has('mortgage_loan_amount3'))
                      <span class="text-danger">{{$errors->first('mortgage_loan_amount3')}}</span>
                      @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Purchase price/ current market valuation</label>
                      <input name="purchase_price3" class="form-control" value="{{ $Application_Request->purchase_price3 }}" type="text">
                      @if($errors->has('purchase_price3'))
                      <span class="text-danger">{{$errors->first('purchase_price3')}}</span>
                      @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Type of loan</label>
                      <input name="type_of_loan3" class="form-control" value="{{ $Application_Request->type_of_loan3 }}" type="text">
                      @if($errors->has('type_of_loan3'))
                      <span class="text-danger">{{$errors->first('type_of_loan3')}}</span>
                      @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Term of loan</label>
                      <input name="term_of_loan3" class="form-control" value="{{ $Application_Request->term_of_loan3 }}" type="text">
                      @if($errors->has('term_of_loan3'))
                      <span class="text-danger">{{$errors->first('term_of_loan3')}}</span>
                      @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">End use of property</label>
                      <input name="end_use_of_property3" class="form-control" value="{{ $Application_Request->end_use_of_property3 }}" type="text">
                      @if($errors->has('end_use_of_property3'))
                      <span class="text-danger">{{$errors->first('end_use_of_property3')}}</span>
                      @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Interest Rate</label>
                      <input name="interest_rate3" class="form-control" value="{{ $Application_Request->interest_rate3 }}" type="text">
                      @if($errors->has('interest_rate3'))
                      <span class="text-danger">{{$errors->first('interest_rate3')}}</span>
                      @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">EMI</label>
                      <input name="mortgage_emi3" class="form-control" value="{{ $Application_Request->mortgage_emi3 }}" type="text">
                      @if($errors->has('mortgage_emi3'))
                      <span class="text-danger">{{$errors->first('mortgage_emi3')}}</span>
                      @endif
                    </div>
                </div>
                @endif


                @if($Application_Request->mortgage_loan_amount4)
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Loan Amount</label>
                      <input name="mortgage_loan_amount4" class="form-control" value="{{ $Application_Request->mortgage_loan_amount4 }}" type="text">
                      @if($errors->has('mortgage_loan_amount4'))
                      <span class="text-danger">{{$errors->first('mortgage_loan_amount4')}}</span>
                      @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Purchase price/ current market valuation</label>
                      <input name="purchase_price4" class="form-control" value="{{ $Application_Request->purchase_price4 }}" type="text">
                      @if($errors->has('purchase_price4'))
                      <span class="text-danger">{{$errors->first('purchase_price4')}}</span>
                      @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Type of loan</label>
                      <input name="type_of_loan4" class="form-control" value="{{ $Application_Request->type_of_loan4 }}" type="text">
                      @if($errors->has('type_of_loan4'))
                      <span class="text-danger">{{$errors->first('type_of_loan4')}}</span>
                      @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Term of loan</label>
                      <input name="term_of_loan4" class="form-control" value="{{ $Application_Request->term_of_loan4 }}" type="text">
                      @if($errors->has('term_of_loan4'))
                      <span class="text-danger">{{$errors->first('term_of_loan4')}}</span>
                      @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">End use of property</label>
                      <input name="end_use_of_property4" class="form-control" value="{{ $Application_Request->end_use_of_property4 }}" type="text">
                      @if($errors->has('end_use_of_property4'))
                      <span class="text-danger">{{$errors->first('end_use_of_property4')}}</span>
                      @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">Interest Rate</label>
                      <input name="interest_rate4" class="form-control" value="{{ $Application_Request->interest_rate4 }}" type="text">
                      @if($errors->has('interest_rate4'))
                      <span class="text-danger">{{$errors->first('interest_rate4')}}</span>
                      @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="sub-label">EMI</label>
                      <input name="mortgage_emi4" class="form-control" value="{{ $Application_Request->mortgage_emi4 }}" type="text">
                      @if($errors->has('mortgage_emi4'))
                      <span class="text-danger">{{$errors->first('mortgage_emi4')}}</span>
                      @endif
                    </div>
                </div>
                @endif
                
            </div>
            </div>           
            </div>
            </div>
            </div>
        </div> 
        @endif
                
            @if(isset($result->video))  
            <div class="col-md-6 noPrint">
                <h3 style="margin-top: -20px; font-size: 20px; ">Upload Video</h3>    
                <video width="420" height="300" controls style="margin-bottom: 20px;">
                  <source src="{!! asset($result->video) !!}" type="video/mp4">
                </video>
            </div>
            
            @endif
            </div>

            
            @if($app_data)
            @if($app_data->residential_address_line_1)
            <div class="card custom-card">
                <div class="card-body">
                    <div class="panel panel-widget forms-panel" style="float: left;width: 100%; padding-bottom: 20px;">
                    <div class="forms">
                    <div class="form-title">
                        <h4>Address Details</h4>                        
                    </div>
                    <div class="row">     
                        <div class="col-md-12">
                            <label class="sub-label" style="font-size: 17px; font-weight: 500; margin-bottom: 0px;">Residential Address Details</label>
                        </div> 

                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="sub-label">Residential Address Line 1</label>
                              <input name="residential_address_line_1" class="form-control" value="{{ $app_data->residential_address_line_1 }}" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="sub-label">Residential Address Line 2</label>
                              <input name="residential_address_line_2" class="form-control" value="{{ $app_data->residential_address_line_2 }}" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="sub-label">Residential Address Line 3</label>
                              <input name="residential_address_line_3" class="form-control" value="{{ $app_data->residential_address_line_3 }}" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="sub-label">Nearest Landmark</label>
                              <input name="residential_address_nearest_landmark" class="form-control" value="{{ $app_data->residential_address_nearest_landmark }}" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="sub-label">Emirate</label>
                              <input name="residential_emirate" class="form-control" value="{{ $app_data->residential_emirate }}" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="sub-label">PO Box No</label>
                              <input name="residential_po_box" class="form-control" value="{{ $app_data->residential_po_box }}" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="sub-label">Residence Type</label>
                                <select name="resdence_type" class="form-control">
                                    <option value="">Select</option>
                                    <option @if($app_data->resdence_type ==  "Shared") Selected @endif value="Shared">Shared</option>
                                    <option @if($app_data->resdence_type ==  "Rented") Selected @endif value="Rented">Rented</option>
                                    <option @if($app_data->resdence_type ==  "Owned") Selected @endif value="Owned">Owned</option>
                                    <option @if($app_data->resdence_type ==  "Employer Provided") Selected @endif value="Employer Provided">Employer Provided</option>
                                    <option @if($app_data->resdence_type ==  "Employer Provided") Selected @endif value="Employer Provided">Living With Parents</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="sub-label">Annual Rent</label>
                              <input name="annual_rent" class="form-control" value="{{ $app_data->annual_rent }}" type="text">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="sub-label">Duration At Current Address</label>
                              <input name="duration_at_current_address" class="form-control" value="{{ $app_data->duration_at_current_address }}" type="text">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="sub-label" style="font-size: 17px; font-weight: 500; margin-bottom: 0px;">Office Address</label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="sub-label">Company Name</label>
                              <input name="company_name" class="form-control" value="{{ $app_data->company_name }}" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="sub-label">Company Phone No</label>
                              <input name="company_phone_no" class="form-control" value="{{ $app_data->company_phone_no }}" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="sub-label">Address Line 1</label>
                              <input name="company_address_line_1" class="form-control" value="{{ $app_data->company_address_line_1 }}" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="sub-label">Address Line 2</label>
                              <input name="company_address_line_2" class="form-control" value="{{ $app_data->company_address_line_2 }}" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="sub-label">Address Line 3</label>
                              <input name="company_address_line_3" class="form-control" value="{{ $app_data->company_address_line_3 }}" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="sub-label">Po Box No</label>
                              <input name="company_po_box" class="form-control" value="{{ $app_data->company_po_box }}" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="sub-label">Emirate</label>
                              <input name="company_emirate" class="form-control" value="{{ $app_data->company_emirate }}" type="text">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="sub-label" style="font-size: 17px; font-weight: 500; margin-bottom: 0px;">Permanent Address In Home Country</label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="sub-label">Address Line 1</label>
                              <input name="permanent_address_home_country_line_1" class="form-control" value="{{ $app_data->permanent_address_home_country_line_1 }}" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="sub-label">Address Line 2</label>
                              <input name="permanent_address_home_country_line_2" class="form-control" value="{{ $app_data->permanent_address_home_country_line_2 }}" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="sub-label">Address Line 3</label>
                              <input name="permanent_address_home_country_line_3" class="form-control" value="{{ $app_data->permanent_address_home_country_line_3 }}" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="sub-label">City</label>
                              <input name="permanent_address_city" class="form-control" value="{{ $app_data->permanent_address_city }}" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="sub-label">Country</label>
                                <select class="form-control" name="permanent_address_country">
                                    @foreach($country as $country)       
                                    <option value="{{ $country->id }}" @if($country->id == $app_data->permanent_address_country) selected @endif >{{ $country->country_name }}</option>
                                    @endforeach  
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="sub-label">Zip/Pin Code</label>
                              <input name="permanent_address_zipcode" class="form-control" value="{{ $app_data->permanent_address_zipcode }}" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="sub-label">Tel. with IDD Code</label>
                              <input name="permanent_addresstel_with_idd_code" class="form-control" value="{{ $app_data->permanent_addresstel_with_idd_code }}" type="text">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="sub-label" style="font-size: 17px; font-weight: 500; margin-bottom: 0px;">Mailing Address</label>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="sub-label">Po Box</label>
                              <input name="mailing_po_box" class="form-control" value="{{ $app_data->mailing_po_box }}" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="sub-label">Address Line 1</label>
                              <input name="mailing_address_line" class="form-control" value="{{ $app_data->mailing_address_line }}" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="sub-label">Emirate</label>
                              <input name="mailing_emirate" class="form-control" value="{{ $app_data->mailing_emirate }}" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="sub-label">Preferred Mailing Address</label>
                                <select name="resdence_type" class="form-control">
                                    <option value="">Select</option>
                                    <option @if($app_data->resdence_type ==  "Residential") Selected @endif value="Residential">Residential</option>
                                    <option @if($app_data->resdence_type ==  "Office") Selected @endif value="Office">Office</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="sub-label">Preferred Statement Mode</label>
                                <select name="preferred_statement_mode" class="form-control">
                                    <option value="">Select</option>
                                    <option @if($app_data->preferred_statement_mode ==  "E-Mail") Selected @endif value="E-Mail">E-Mail</option>
                                    <option @if($app_data->preferred_statement_mode ==  "Post") Selected @endif value="Post">Post</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="sub-label">Preferred Contact Number</label>
                                <select name="preferred_contact_number" class="form-control">
                                    <option value="">Select</option>
                                    <option @if($app_data->preferred_contact_number ==  "Home") Selected @endif value="Home">Home</option>
                                    <option @if($app_data->preferred_contact_number ==  "Business") Selected @endif value="Business">Business</option>
                                    <option @if($app_data->preferred_contact_number ==  "Mobile") Selected @endif value="Mobile">Mobile</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                </div>
            </div> 
            @endif

            @if($app_data->education)
            <div class="card custom-card">
                <div class="card-body">
                    <div class="panel panel-widget forms-panel" style="float: left;width: 100%; padding-bottom: 20px;">
                        <div class="forms">
                            <div class="form-title">
                                <h4>Education Details</h4>                        
                            </div>
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label class="sub-label">Qualification</label>
                                  <input name="education" class="form-control" value="{{ $app_data->education }}" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label class="sub-label">Primary School</label>
                                  <input name="primary_school" class="form-control" value="{{ $app_data->primary_school }}" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label class="sub-label">High School</label>
                                  <input name="high_school" class="form-control" value="{{ $app_data->high_school }}" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label class="sub-label">Graduate</label>
                                  <input name="graduate" class="form-control" value="{{ $app_data->graduate }}" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label class="sub-label">Postgraduate</label>
                                  <input name="postgraduate" class="form-control" value="{{ $app_data->postgraduate }}" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label class="sub-label">Others</label>
                                  <input name="others" class="form-control" value="{{ $app_data->others }}" type="text">
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            @endif

            @if($app_data->vehicle_in_uae)
            <div class="card custom-card">
                <div class="card-body">
                    <div class="panel panel-widget forms-panel" style="float: left;width: 100%; padding-bottom: 20px;">
                        <div class="forms">
                            <div class="form-title">
                                <h4>Personal details</h4>                        
                            </div>
                            <div class="row">

 @if($result->marital_status == 'Married')  
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Does Your Spouse Live In UAE?*</label> 
      <select name="spouse_live_in_uae" onChange="SpouseLive(this);" class="form-control" required="true">
        <option value="">Select</option>
        <option value="1" @if($app_data->spouse_live_in_uae == 1) selected @endif >Yes</option>
        <option value="0" @if($app_data->spouse_live_in_uae == 0) selected @endif >No</option>
      </select>
      @if($errors->has('spouse_live_in_uae'))
        <span class="text-danger">{{$errors->first('spouse_live_in_uae')}}</span>
      @endif
    </div>
  </div>
    @if($app_data->spouse_live_in_uae == 1)
    <div class="col-md-6 spouse_working">
        <div class="form-group">
          <label class="sub-label">Spouse Working*</label> 
          <select name="spouse_working" class="form-control">
            <option value="">Select</option>
            <option value="1" @if($app_data->spouse_working == 1) selected @endif >Yes</option>
            <option value="0" @if($app_data->spouse_working == 0) selected @endif >No</option>
          </select>
          @if($errors->has('spouse_working'))
            <span class="text-danger">{{$errors->first('spouse_working')}}</span>
          @endif
        </div>
    </div>
    @endif

    <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">You Have Children In The UAE?*</label> 
      <select name="children_in_the_uae" onChange="ChildrenUAE(this);" class="form-control" required="true">
        <option value="">Select</option>
        <option value="1" @if($app_data->children_in_the_uae == 1) selected @endif >Yes</option>
        <option value="0" @if($app_data->children_in_the_uae == 0) selected @endif >No</option>
      </select>
      @if($errors->has('children_in_the_uae'))
        <span class="text-danger">{{$errors->first('children_in_the_uae')}}</span>
      @endif
    </div>
    </div>
    @if($app_data->children_in_the_uae == 1)
    <div class="col-md-6 ChildrenUAE" >
        <div class="form-group">
          <label class="sub-label">In School?*</label> 
          <select name="in_school" class="form-control">
            <option value="">Select</option>
            <option value="1" @if($app_data->in_school == 1) selected @endif >Yes</option>
            <option value="0" @if($app_data->in_school == 0) selected @endif >No</option>
          </select>
          @if($errors->has('in_school'))
            <span class="text-danger">{{$errors->first('in_school')}}</span>
          @endif
        </div>
    </div>
    @endif
  @endif

<div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Do You Own A Vehicle In UAE?*</label> 
      <select name="vehicle_in_uae" class="form-control" required="true">
        <option value="">Select</option>
        <option value="1" @if($app_data->vehicle_in_uae == 1) selected @endif >Yes</option>
        <option value="0" @if($app_data->vehicle_in_uae == 0) selected @endif >No</option>
      </select>
      @if($errors->has('vehicle_in_uae'))
        <span class="text-danger">{{$errors->first('vehicle_in_uae')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Favorite City (As A Security Feature)*</label>
      <input name="favorite_city" class="form-control" value="{{ $app_data->favorite_city }}" required="true" type="text">
      @if($errors->has('favorite_city'))
      <span class="text-danger">{{$errors->first('favorite_city')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12">
    <label class="sub-label" style="font-size: 17px; font-weight: 500; margin-bottom: 0px;">Bank Details</label>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Account Number</label>
      <input name="account_number" class="form-control" value="{{ $app_data->account_number }}" type="number">
      @if($errors->has('account_number'))
      <span class="text-danger">{{$errors->first('account_number')}}</span>
      @endif
    </div>
  </div>
    <div class="col-md-6">
        <div class="form-group">
          <label class="sub-label">Bank Name</label>
          <input name="bank_name" class="form-control" value="{{ $app_data->bank_name }}" type="text">
          @if($errors->has('bank_name'))
          <span class="text-danger">{{$errors->first('bank_name')}}</span>
          @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        <label class="sub-label">Iban Number</label>
        <input name="iban_number" class="form-control" value="{{ $app_data->iban_number }}" type="text">
        @if($errors->has('iban_number'))
        <span class="text-danger">{{$errors->first('iban_number')}}</span>
        @endif
        </div>
    </div>

    <div class="col-md-12">
        <label class="sub-label" style="font-size: 17px; font-weight: 500; margin-bottom: 0px;">Multiple Nationality Holder Details</label>
    </div>

    <div class="col-md-6">
        <div class="form-group">
          <label class="sub-label">Nationality Name</label>
          <input name="multi_nationality_name" class="form-control" value="{{ $app_data->multi_nationality_name }}" type="text">
          @if($errors->has('multi_nationality_name'))
          <span class="text-danger">{{$errors->first('multi_nationality_name')}}</span>
          @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
          <label class="sub-label">Passport Number</label>
          <input name="multi_passport_number" class="form-control" value="{{ $app_data->multi_passport_number }}" type="text">
          @if($errors->has('multi_passport_number'))
          <span class="text-danger">{{$errors->first('multi_passport_number')}}</span>
          @endif
        </div>
    </div>
                
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            @endif

            
            @if($result->service_id == 3)
            @if($app_data->card_type) 
            <div class="card custom-card">
                <div class="card-body">
                    <div class="panel panel-widget forms-panel" style="float: left;width: 100%; padding-bottom: 20px;">
                        <div class="forms">
                            <div class="form-title">
                                <h4>Card Information</h4>                        
                            </div>
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="sub-label">Card Type</label>
                                <input name="card_type" class="form-control" value="{{ $app_data->card_type }}" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="sub-label">Embossing Name</label>
                                <input name="embossing_name" class="form-control" value="{{ $app_data->embossing_name }}" type="text">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="sub-label">CM Billing Cycle Date</label>
                                <input name="cm_billing_cycle_date" class="form-control" value="{{ $app_data->cm_billing_cycle_date }}" type="text">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="sub-label">E Statement Subscription</label>
                                <select name="e_statement_subscription" class="form-control" required="true">
                                <option value="">Select</option>
                                <option value="1" @if($app_data->e_statement_subscription == 1) selected @endif >Yes</option>
                                <option value="0" @if($app_data->e_statement_subscription == 0) selected @endif >No</option>
                                </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="sub-label">Paper Statement Subscription</label>
                                <select name="paper_statement_subscription" class="form-control" required="true">
                                <option value="">Select</option>
                                <option value="1" @if($app_data->paper_statement_subscription == 1) selected @endif >Yes</option>
                                <option value="0" @if($app_data->paper_statement_subscription == 0) selected @endif >No</option>
                                </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="sub-label" style="font-size: 17px; font-weight: 500; margin-bottom: 0px;">Supplementary Applicant(S) Cards Details</label>
                            </div>
                            <div class="col-md-2">
                            <label class="sub-label">Salutation</label>
                            <select name="supplementary_salutation" class="form-control" required="true">
                              <option value="Mr." @if($app_data->supplementary_salutation == 'Mr.') selected @endif >Mr.</option>
                              <option value="Mrs." @if($app_data->supplementary_salutation == 'Mrs.') selected @endif >Mrs.</option>
                              <option value="Miss." @if($app_data->supplementary_salutation == 'Miss.') selected @endif >Miss</option>
                              <option value="Dr." @if($app_data->supplementary_salutation == 'Dr.') selected @endif >Dr.</option>
                              <option value="Prof." @if($app_data->supplementary_salutation == 'Prof.') selected @endif >Prof.</option>
                              <option value="Rev." @if($app_data->supplementary_salutation == 'Rev.') selected @endif >Rev.</option>
                              <option value="Other" @if($app_data->supplementary_salutation == 'Other') selected @endif >Other</option>
                            </select>
                            </div>
                            <div class="col-md-10">
                                <div class="row">  
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="sub-label">First Name</label>
                                      <input name="supplementary_first_name" maxlength="16" class="form-control" value="{{ $app_data->supplementary_first_name }}" type="text" pattern="(?=^.{2,25}$)(?![.\n])(?=.*[a-zA-Z]).*$">
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="sub-label">Middle Name</label>
                                      <input name="supplementary_middle_name" class="form-control" value="{{ $app_data->supplementary_middle_name }}" type="text">
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="sub-label">Last Name</label>
                                      <input name="supplementary_last_name" class="form-control" value="{{ $app_data->supplementary_last_name }}" type="text">
                                    </div>
                                  </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                            <label class="sub-label">Relationship*</label>
                            <select name="supplementary_relationship" class="form-control" required="true">
                            <option value="Wife" @if($app_data->supplementary_relationship == 'Wife') selected @endif >Wife</option>
                            <option value="Husband" @if($app_data->supplementary_relationship == 'Husband') selected @endif >Husband</option>
                            <option value="Mother" @if($app_data->supplementary_relationship == 'Mother') selected @endif >Mother</option>
                            <option value="Father" @if($app_data->supplementary_relationship == 'Father') selected @endif >Father</option>
                            <option value="Daughter" @if($app_data->supplementary_relationship == 'Daughter') selected @endif >Daughter</option>
                            <option value="Son" @if($app_data->supplementary_relationship == 'Son') selected @endif >Son</option>
                            <option value="Brother" @if($app_data->supplementary_relationship == 'Brother') selected @endif >Brother</option>
                            <option value="Sister" @if($app_data->supplementary_relationship == 'Sister') selected @endif >Sister</option>
                            <option value="Others" @if($app_data->supplementary_relationship == 'Others') selected @endif >Others</option>
                            <option value="Company Partner" @if($app_data->supplementary_relationship == 'Company Partner') selected @endif >Company Partner</option>
                            </select>
                            </div>

    <div class="col-md-6">
        <div class="form-group">
          <label class="sub-label">Embossing Name</label>
          <input name="supplementary_embosing_name" class="form-control" value="{{ $app_data->supplementary_embosing_name }}" type="text">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
          <label class="sub-label">Nationality</label>
          <select name="supplementary_nationality" class="form-control">
            <option value="">Select</option>
            @foreach($countries as $country)
              <option value="{{ $country->id }}"  @if($app_data->supplementary_nationality == $country->id) selected @endif >{{ $country->country_name }}</option>
            @endforeach
          </select>
        </div>
    </div>

    <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Passport No.</label>
      <input name="supplementary_passport_no" class="form-control" value="{{ $app_data->supplementary_passport_no }}" type="text">
    </div>
    </div>

    <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Card limit (in AED)</label>
      <input name="supplementary_credit_limit_aed" class="form-control" pattern="\d*" maxlength="6"  value="{{ $app_data->supplementary_credit_limit_aed }}" type="text">
    </div>
    </div>

    <div class="col-md-6">
    <label class="sub-label">Marital Status</label>
    <select name="supplementary_marital_status" onChange="MaritalStatus(this);" class="form-control">
      <option value="Single" @if($app_data->supplementary_marital_status == "Single") selected @endif  >Single</option>
      <option value="Married" @if($app_data->supplementary_marital_status == "Married") selected @endif >Married</option>
      <option value="Others" @if($app_data->supplementary_marital_status == "Others") selected @endif >Others</option>
    </select>
    </div>
    <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Mother'S Maiden Name</label>
      <input name="supplementary_mother_maiden_name" class="form-control" value="{{ $app_data->supplementary_mother_maiden_name }}" type="text">
    </div>
    </div>

    <div class="col-md-12"> 
    <label class="sub-label" style="font-size: 17px; font-weight: 500; margin-bottom: 0px;">Credit Shield Plus (Optional)</label>
    </div>
  <div class="col-md-12"> 
    <div class="form-group" style="margin-bottom: 3px;">
        <label style="font-weight: normal; font-size: 13px; margin-top: 6px;"><input type="checkbox" name="no_sign_up_credit_shield" style="width: 20px; height: 20px; box-shadow: none; margin-right: 10px; margin-top: 0px; float: left;margin-bottom: 5px;"  @if($app_data->no_sign_up_credit_shield == "1") checked="" @endif value="1"> No, I would not like to sign up for credit shield plus</label>
    </div>
    </div>
    <div class="col-md-12"> 
    <div class="form-group">
        <label style="font-weight: normal; font-size: 13px; margin-top: 6px;"><input style="width: 20px; height: 20px; box-shadow: none; margin-right: 10px; margin-top: 0px; float: left;margin-bottom: 0px;" type="checkbox" name="sign_up_credit_shield_plus" @if($app_data->sign_up_credit_shield_plus == "1") checked="" @endif value="1"> I would like to sign up for credit shield plus applicable for all my emirates islamic credit cards</label>
    </div>
    </div>

    <div class="col-md-12">
    <label class="sub-label" style="font-size: 17px; font-weight: 500; margin-bottom: 0px;">Master Murabaha Agreement For The Sale Of Commodities For Credit Card Issuance*</label>
    </div>
    <div class="col-md-6">
      <select name="master_murabaha_agreement" required="true" class="form-control">
        <option value="">Select</option>    
        <option value="1" @if($app_data->master_murabaha_agreement == "1") selected @endif >Yes</option>
        <option value="0" @if($app_data->master_murabaha_agreement == "0") selected @endif >No</option>
      </select>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div> 
@endif
@endif
@endif


@if($result->service_id == 1)
@if($Personalloanform)

    <div class="card custom-card">
    <div class="card-body">
    <div class="panel panel-widget forms-panel" style="float: left;width: 100%;padding-bottom: 20px;">
    <div class="forms">
        <div class="form-title">
            <h4>Personal loan information</h4>                        
        </div>
    <div class="row">
    <div class="col-md-6">
    <label class="sub-label">Existing Customer*</label>
    <select name="existing_customer" onChange="ExistingCustomer(this);" class="form-control" required="true">
      <option value="">Select</option>
      <option value="1" @if($Personalloanform) @if($Personalloanform->existing_customer == "1") selected @endif @endif >Yes</option>
      <option value="0" @if($Personalloanform) @if($Personalloanform->existing_customer == "0") selected @endif @endif >No</option>
    </select>
    </div>

  <div class="col-md-6 account_no" @if($Personalloanform) @if($Personalloanform->existing_customer != "1") style="display: none;" @endif @else style="display: none;" @endif >
    <div class="form-group">
      <label class="sub-label">Account No*</label>
      <input name="account_no" class="form-control" @if($Personalloanform) @if($Personalloanform->existing_customer == "1") required="true" @endif value="{{ $Personalloanform->account_no }}" @else value="{{ old('account_no') }}" @endif type="number">
      @if($errors->has('account_no'))
      <span class="text-danger">{{$errors->first('account_no')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6 cif_no" @if($Personalloanform) @if($Personalloanform->existing_customer != "0") style="display: none;" @endif @else style="display: none;" @endif >
    <div class="form-group">
      <label class="sub-label">Cif No.*</label>
      <input name="cif_no" class="form-control" @if($Personalloanform) @if($Personalloanform->existing_customer == "0") required="true" @endif value="{{ $Personalloanform->cif_no }}" @else value="{{ old('cif_no') }}" @endif type="text">
      @if($errors->has('cif_no'))
      <span class="text-danger">{{$errors->first('cif_no')}}</span>
      @endif
    </div>
  </div>
  @if($result->cm_type == 2)
  <div class="col-md-12"> 
    <div class="form-group">
      <label class="sub-label">Tell Us More About Your Business</label>
      <textarea name="about_your_business" rows="4" class="form-control" required="true"> @if($Personalloanform) {{ $Personalloanform->about_your_business }} @else {{ old('about_your_business') }} @endif</textarea>
    </div>
  </div>

  <div class="col-md-6 self_employed_type">
    <div class="form-group">
      <label class="sub-label">Company Name*</label>
      <input type="text" value="{{ $result->self_company_name }}" name="self_company_name" id="self_company_name" class="form-control live_product_2 product_name2" required="true">
      <ul id="live_product_2"></ul> 
      @if($errors->has('self_company_name'))
      <span class="text-danger">{{$errors->first('self_company_name')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Years In Business*</label>
      <input type="number" @if($Personalloanform) value="{{ $Personalloanform->years_in_business }}" @else value="{{ old('years_in_business') }}" @endif name="years_in_business" class="form-control" required="true"> 
      @if($errors->has('years_in_business'))
      <span class="text-danger">{{$errors->first('years_in_business')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <label class="sub-label">Designation*</label>
    <select name="designation" class="form-control" required="true">
      <option value="">Select</option>
      <option value="Proprietor" @if($Personalloanform) @if($Personalloanform->designation == "Proprietor") selected @endif @endif >Proprietor</option>
      <option value="Partner" @if($Personalloanform) @if($Personalloanform->designation == "Partner") selected @endif @endif >Partner</option>
      <option value="Director" @if($Personalloanform) @if($Personalloanform->designation == "Director") selected @endif @endif >Director</option>
      <option value="Other" @if($Personalloanform) @if($Personalloanform->designation == "Other") selected @endif @endif >Other</option>
    </select>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Paid Up Capital (Aed)*</label>
      <input type="number" @if($Personalloanform) value="{{ $Personalloanform->paid_up_capital }}" @else value="{{ old('paid_up_capital') }}" @endif name="paid_up_capital" class="form-control" required="true"> 
      @if($errors->has('paid_up_capital'))
      <span class="text-danger">{{$errors->first('paid_up_capital')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">No. Of Employees (Excl. Owner)*</label>
      <input type="number" @if($Personalloanform) value="{{ $Personalloanform->no_of_employees }}" @else value="{{ old('no_of_employees') }}" @endif name="no_of_employees" class="form-control" required="true"> 
      @if($errors->has('no_of_employees'))
      <span class="text-danger">{{$errors->first('no_of_employees')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12">
    <div class="form-group">
      <label class="sub-label">Ownership Details*</label>
      <textarea name="ownership_details" rows="4" class="form-control" required="true"> @if($Personalloanform) {{ $Personalloanform->ownership_details }} @else {{ old('ownership_details') }} @endif</textarea> 
      @if($errors->has('ownership_details'))
      <span class="text-danger">{{$errors->first('ownership_details')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Percentage Ownership*</label>
      <input type="number" value="{{ $result->percentage_ownership }}" name="percentage_ownership" class="form-control" required="true"> 
      @if($errors->has('percentage_ownership'))
      <span class="text-danger">{{$errors->first('percentage_ownership')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Type of profession/business*</label>
      <select name="profession_business" required="true" id="profession_business" class="form-control">
        <option>Select</option>
        <option value="Retailer Wholesaler" @if(isset($result->profession_business)) @if($result->profession_business == "Retailer Wholesaler") selected @endif @endif>Retailer Wholesaler</option>
        <option value="Manufacturer Professional" @if(isset($result->profession_business)) @if($result->profession_business == 'Manufacturer Professional') selected @endif @endif>Manufacturer Professional</option>
        <option value="Services" @if(isset($result->profession_business)) @if($result->profession_business == 'Services') selected @endif @endif>Services</option>
        <option value="Other" @if(isset($result->profession_business)) @if($result->profession_business == 'Other') selected @endif @endif>Other</option>
        <option value="Industry" @if(isset($result->profession_business)) @if($result->profession_business == 'Industry') selected @endif @endif>Industry</option>
      </select>
      @if($errors->has('profession_business'))
      <span class="text-danger">{{$errors->first('profession_business')}}</span>
      @endif
    </div>
    </div>

    <div class="col-md-12">
    <label style="font-size: 17px;font-weight: 500;margin-bottom: 0px;">Partner Details</label>
    </div>
  
    <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Partner Name</label>
      <input type="text" @if($Personalloanform) value="{{ $Personalloanform->partner_name }}" @else value="{{ old('partner_name') }}" @endif name="partner_name" class="form-control"> 
      @if($errors->has('partner_name'))
      <span class="text-danger">{{$errors->first('partner_name')}}</span>
      @endif
    </div>
    </div>

    <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Partner Ownership</label>
      <input type="number" @if($Personalloanform) value="{{ $Personalloanform->partner_ownership }}" @else value="{{ old('partner_ownership') }}" @endif name="partner_ownership" class="form-control"> 
      @if($errors->has('partner_ownership'))
      <span class="text-danger">{{$errors->first('partner_ownership')}}</span>
      @endif
    </div>
    </div>
    <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Nationality</label>
      <select name="partner_nationality" class="form-control">
        <option value="">Select</option>
        @foreach($countries as $country)
          <option value="{{ $country->id }}" @if($Personalloanform) @if($Personalloanform->partner_nationality == $country->id) selected @endif @endif >{{ $country->country_name }}</option>
        @endforeach
      </select>
      @if($errors->has('partner_nationality'))
      <span class="text-danger">{{$errors->first('partner_nationality')}}</span>
      @endif
    </div>
  </div>
  @endif
  <div class="col-md-12">
    <label style="font-size: 17px;font-weight: 500;margin-bottom: 0px;">Variable Income Details (Aed)</label>
  </div>
     
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Annual Bonus</label>
      <input type="number" @if($Personalloanform) value="{{ $Personalloanform->annual_bonus }}" @else value="{{ old('annual_bonus') }}" @endif name="annual_bonus" class="form-control"> 
      @if($errors->has('annual_bonus'))
      <span class="text-danger">{{$errors->first('annual_bonus')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Average Monthly Commission</label>
      <input type="number" @if($Personalloanform) value="{{ $Personalloanform->average_monthly_commission }}" @else value="{{ old('average_monthly_commission') }}" @endif name="average_monthly_commission" class="form-control"> 
      @if($errors->has('average_monthly_commission'))
      <span class="text-danger">{{$errors->first('average_monthly_commission')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Average Monthly Overtime</label>
      <input type="number" @if($Personalloanform) value="{{ $Personalloanform->average_monthly_overtime }}" @else value="{{ old('average_monthly_overtime') }}" @endif name="average_monthly_overtime" class="form-control"> 
      @if($errors->has('average_monthly_overtime'))
      <span class="text-danger">{{$errors->first('average_monthly_overtime')}}</span>
      @endif
    </div>
  </div>
  @if($result->marital_status == 'Married')
  <div class="col-md-6">
    <label class="sub-label">Spouse Is A Co-Borrower</label>
    <select name="if_spouse_is_a_co_borrower" onChange="ifSpouseCoBorrower(this);" class="form-control" required="true">
      <option value="">Select</option>
      <option value="1" @if($Personalloanform) @if($Personalloanform->if_spouse_is_a_co_borrower == "1") selected @endif @endif >Yes</option>
      <option value="0" @if($Personalloanform) @if($Personalloanform->if_spouse_is_a_co_borrower == "0") selected @endif @endif >No</option>
    </select>
  </div>

  <div class="col-md-6 spouse_fixed_monthly_income" style="display: none;">
    <div class="form-group">
      <label class="sub-label">Spouse Fixed Monthly Income</label>
      <input type="number" @if($Personalloanform) value="{{ $Personalloanform->spouse_fixed_monthly_income }}" @else value="{{ old('spouse_fixed_monthly_income') }}" @endif name="spouse_fixed_monthly_income" class="form-control"> 
      @if($errors->has('spouse_fixed_monthly_income'))
      <span class="text-danger">{{$errors->first('spouse_fixed_monthly_income')}}</span>
      @endif
    </div>
  </div>
  @endif

  <div class="col-md-12">
    <label style="font-size: 17px;font-weight: 500;margin-bottom: 0px;">Reference Person In Home Country</label>
  </div>
  <div class="col-md-4">
    <label class="sub-label">Salutation*</label>
    <select name="reference_title" class="form-control" required="true">
      <option value="Mr." @if($Personalloanform) @if($Personalloanform->reference_title == 'Mr.') selected @endif @endif >Mr.</option>
      <option value="Mrs." @if($Personalloanform) @if($Personalloanform->reference_title == 'Mrs.') selected @endif @endif >Mrs.</option>
      <option value="Miss." @if($Personalloanform) @if($Personalloanform->reference_title == 'Miss.') selected @endif @endif >Miss</option>
      <option value="Dr." @if($Personalloanform) @if($Personalloanform->reference_title == 'Dr.') selected @endif @endif >Dr.</option>
      <option value="Prof." @if($Personalloanform) @if($Personalloanform->reference_title == 'Prof.') selected @endif @endif >Prof.</option>
      <option value="Rev." @if($Personalloanform) @if($Personalloanform->reference_title == 'Rev.') selected @endif @endif >Rev.</option>
      <option value="Other" @if($Personalloanform) @if($Personalloanform->reference_title == 'Other') selected @endif @endif >Other</option>
    </select>
    @if($errors->has('reference_title'))
      <span class="text-danger">{{$errors->first('reference_title')}}</span>
    @endif
  </div>

  <div class="col-md-8">
    <div class="form-group">
      <label class="sub-label">Full Name*</label>
      <input name="reference_full_name" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->reference_full_name }}" @else value="{{ old('reference_full_name') }}" @endif required="true" type="text">
      @if($errors->has('reference_full_name'))
      <span class="text-danger">{{$errors->first('reference_full_name')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Relation*</label>
      <select name="reference_relation" class="form-control" required="true">
        <option value="">Select</option>
        <option value="Father" @if($Personalloanform) @if($Personalloanform->reference_relation == 'Father') selected @endif @endif >Father</option>
        <option value="Mother" @if($Personalloanform) @if($Personalloanform->reference_relation == 'Mother') selected @endif @endif >Mother</option>
        <option value="Son" @if($Personalloanform) @if($Personalloanform->reference_relation == 'Son') selected @endif @endif>Son</option>
        <option value="Daughter" @if($Personalloanform) @if($Personalloanform->reference_relation == 'Daughter') selected @endif @endif>Daughter</option>
        <option value="Brother" @if($Personalloanform) @if($Personalloanform->reference_relation == 'Brother') selected @endif @endif>Brother</option>
        <option value="Sister" @if($Personalloanform) @if($Personalloanform->reference_relation == 'Sister') selected @endif @endif>Sister</option>
        <option value="Grandfather" @if($Personalloanform) @if($Personalloanform->reference_relation == 'Grandfather') selected @endif @endif>Grandfather</option>
        <option value="Grandmother" @if($Personalloanform) @if($Personalloanform->reference_relation == 'Grandmother') selected @endif @endif>Grandmother</option>
        <option value="Uncle" @if($Personalloanform) @if($Personalloanform->reference_relation == 'Uncle') selected @endif @endif >Uncle</option>
        <option value="Aunt" @if($Personalloanform) @if($Personalloanform->reference_relation == 'Aunt') selected @endif @endif>Aunt</option>
        <option value="Cousin" @if($Personalloanform) @if($Personalloanform->reference_relation == 'Cousin') selected @endif @endif>Cousin</option>
        <option value="Nephew" @if($Personalloanform) @if($Personalloanform->reference_relation == 'Nephew') selected @endif @endif>Nephew</option>
        <option value="Niece" @if($Personalloanform) @if($Personalloanform->reference_relation == 'Niece') selected @endif @endif>Niece</option>
        <option value="Husband" @if($Personalloanform) @if($Personalloanform->reference_relation == 'Husband') selected @endif @endif>Husband</option>
        <option value="Wife" @if($Personalloanform) @if($Personalloanform->reference_relation == 'Wife') selected @endif @endif>Wife</option>
      </select>
      @if($errors->has('reference_relation'))
      <span class="text-danger">{{$errors->first('reference_relation')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Mobile No.*</label>
      <input name="reference_mobile_no" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->reference_mobile_no }}" @else value="{{ old('reference_mobile_no') }}" @endif required="true" type="number">
      @if($errors->has('reference_mobile_no'))
      <span class="text-danger">{{$errors->first('reference_mobile_no')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Home Telephone No.</label>
      <input name="reference_home_telephone_no" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->reference_home_telephone_no }}" @else value="{{ old('reference_home_telephone_no') }}" @endif type="number">
      @if($errors->has('reference_home_telephone_no'))
      <span class="text-danger">{{$errors->first('reference_home_telephone_no')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Address*</label>
      <input name="reference_address" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->reference_address }}" @else value="{{ old('reference_address') }}" @endif required="true" type="text">
      @if($errors->has('reference_address'))
      <span class="text-danger">{{$errors->first('reference_address')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Po Box No.*</label>
      <input name="reference_po_box_no" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->reference_po_box_no }}" @else value="{{ old('reference_po_box_no') }}" @endif required="true" type="number">
      @if($errors->has('reference_po_box_no'))
      <span class="text-danger">{{$errors->first('reference_po_box_no')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-12">
    <label style="font-size: 17px;font-weight: 500;margin-bottom: 0px;">Business Reference</label>
  </div>
  <div class="col-md-12">
    <div class="form-group">
      <label class="sub-label">Company Name</label>
      <input name="business_reference_company_name" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->business_reference_company_name }}" @else value="{{ old('business_reference_company_name') }}" @endif type="text">
      @if($errors->has('business_reference_company_name'))
      <span class="text-danger">{{$errors->first('business_reference_company_name')}}</span>
      @endif
    </div>
  </div>
  
  <div class="col-md-4">
    <label class="sub-label">Salutation</label>
    <select name="business_title" class="form-control" >
      <option value="Mr." @if($Personalloanform) @if($Personalloanform->business_title == 'Mr.') selected @endif @endif >Mr.</option>
      <option value="Mrs." @if($Personalloanform) @if($Personalloanform->business_title == 'Mrs.') selected @endif @endif >Mrs.</option>
      <option value="Miss." @if($Personalloanform) @if($Personalloanform->business_title == 'Miss.') selected @endif @endif >Miss</option>
      <option value="Dr." @if($Personalloanform) @if($Personalloanform->business_title == 'Dr.') selected @endif @endif >Dr.</option>
      <option value="Prof." @if($Personalloanform) @if($Personalloanform->business_title == 'Prof.') selected @endif @endif >Prof.</option>
      <option value="Rev." @if($Personalloanform) @if($Personalloanform->business_title == 'Rev.') selected @endif @endif >Rev.</option>
      <option value="Other" @if($Personalloanform) @if($Personalloanform->business_title == 'Other') selected @endif @endif >Other</option>
    </select>
    @if($errors->has('business_title'))
      <span class="text-danger">{{$errors->first('business_title')}}</span>
    @endif
  </div>
  <div class="col-md-8">
    <div class="form-group">
      <label class="sub-label">Contact Person’S Name</label>
      <input name="business_contact_person_name" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->business_contact_person_name }}" @else value="{{ old('business_contact_person_name') }}" @endif type="text">
      @if($errors->has('business_contact_person_name'))
      <span class="text-danger">{{$errors->first('business_contact_person_name')}}</span>
      @endif
    </div>
  </div>
  
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Designation In The Company</label>
      <input name="business_designation" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->business_designation }}" @else value="{{ old('business_designation') }}" @endif type="text">
      @if($errors->has('business_designation'))
      <span class="text-danger">{{$errors->first('business_designation')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Relation</label>
      <select name="business_relationship" class="form-control">
        <option value="">Select</option>
        <option value="Father" @if($Personalloanform) @if($Personalloanform->business_relationship == 'Father') selected @endif @endif >Father</option>
        <option value="Mother" @if($Personalloanform) @if($Personalloanform->business_relationship == 'Mother') selected @endif @endif >Mother</option>
        <option value="Son" @if($Personalloanform) @if($Personalloanform->business_relationship == 'Son') selected @endif @endif>Son</option>
        <option value="Daughter" @if($Personalloanform) @if($Personalloanform->business_relationship == 'Daughter') selected @endif @endif>Daughter</option>
        <option value="Brother" @if($Personalloanform) @if($Personalloanform->business_relationship == 'Brother') selected @endif @endif>Brother</option>
        <option value="Sister" @if($Personalloanform) @if($Personalloanform->business_relationship == 'Sister') selected @endif @endif>Sister</option>
        <option value="Grandfather" @if($Personalloanform) @if($Personalloanform->business_relationship == 'Grandfather') selected @endif @endif>Grandfather</option>
        <option value="Grandmother" @if($Personalloanform) @if($Personalloanform->business_relationship == 'Grandmother') selected @endif @endif>Grandmother</option>
        <option value="Uncle" @if($Personalloanform) @if($Personalloanform->business_relationship == 'Uncle') selected @endif @endif >Uncle</option>
        <option value="Aunt" @if($Personalloanform) @if($Personalloanform->business_relationship == 'Aunt') selected @endif @endif>Aunt</option>
        <option value="Cousin" @if($Personalloanform) @if($Personalloanform->business_relationship == 'Cousin') selected @endif @endif>Cousin</option>
        <option value="Nephew" @if($Personalloanform) @if($Personalloanform->business_relationship == 'Nephew') selected @endif @endif>Nephew</option>
        <option value="Niece" @if($Personalloanform) @if($Personalloanform->business_relationship == 'Niece') selected @endif @endif>Niece</option>
        <option value="Husband" @if($Personalloanform) @if($Personalloanform->business_relationship == 'Husband') selected @endif @endif>Husband</option>
        <option value="Wife" @if($Personalloanform) @if($Personalloanform->business_relationship == 'Wife') selected @endif @endif>Wife</option>
      </select>
      @if($errors->has('business_relationship'))
      <span class="text-danger">{{$errors->first('business_relationship')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Contact Number</label>
      <input name="business_contact_number" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->business_contact_number }}" @else value="{{ old('business_contact_number') }}" @endif type="number">
      @if($errors->has('business_contact_number'))
      <span class="text-danger">{{$errors->first('business_contact_number')}}</span>
      @endif
    </div>
  </div> 
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Address</label>
      <input name="business_address" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->business_address }}" @else value="{{ old('business_address') }}" @endif type="text">
      @if($errors->has('business_address'))
      <span class="text-danger">{{$errors->first('business_address')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Emirate</label>
      <input name="business_emirate" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->business_emirate }}" @else value="{{ old('business_emirate') }}" @endif type="text">
      @if($errors->has('business_emirate'))
      <span class="text-danger">{{$errors->first('business_emirate')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12">
    <label style="font-size: 17px;font-weight: 500;margin-bottom: 0px;">Reference Details:-</label>
    <label style="width: 100%; font-size: 15px;font-weight: 500;">Reference 1</label>
  </div>
  <div class="col-md-4">
    <label class="sub-label">Salutation*</label>
    <select name="reference_1_title" class="form-control" required="true">
      <option value="Mr." @if($Personalloanform) @if($Personalloanform->reference_1_title == 'Mr.') selected @endif @endif >Mr.</option>
      <option value="Mrs." @if($Personalloanform) @if($Personalloanform->reference_1_title == 'Mrs.') selected @endif @endif >Mrs.</option>
      <option value="Miss." @if($Personalloanform) @if($Personalloanform->reference_1_title == 'Miss.') selected @endif @endif >Miss</option>
      <option value="Dr." @if($Personalloanform) @if($Personalloanform->reference_1_title == 'Dr.') selected @endif @endif >Dr.</option>
      <option value="Prof." @if($Personalloanform) @if($Personalloanform->reference_1_title == 'Prof.') selected @endif @endif >Prof.</option>
      <option value="Rev." @if($Personalloanform) @if($Personalloanform->reference_1_title == 'Rev.') selected @endif @endif >Rev.</option>
      <option value="Other" @if($Personalloanform) @if($Personalloanform->reference_1_title == 'Other') selected @endif @endif >Other</option>
    </select>
    @if($errors->has('reference_1_title'))
      <span class="text-danger">{{$errors->first('reference_1_title')}}</span>
    @endif
  </div>
  <div class="col-md-8">
    <div class="form-group">
      <label class="sub-label">Full Name*</label>
      <input name="reference_1_name" required="true" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->reference_1_name }}" @else value="{{ old('reference_1_name') }}" @endif type="text">
      @if($errors->has('reference_1_name'))
      <span class="text-danger">{{$errors->first('reference_1_name')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Relation*</label>
      <select name="reference_1_relation" required="true" class="form-control">
        <option value="">Select</option>
        <option value="Father" @if($Personalloanform) @if($Personalloanform->reference_1_relation == 'Father') selected @endif @endif >Father</option>
        <option value="Mother" @if($Personalloanform) @if($Personalloanform->reference_1_relation == 'Mother') selected @endif @endif >Mother</option>
        <option value="Son" @if($Personalloanform) @if($Personalloanform->reference_1_relation == 'Son') selected @endif @endif>Son</option>
        <option value="Daughter" @if($Personalloanform) @if($Personalloanform->reference_1_relation == 'Daughter') selected @endif @endif>Daughter</option>
        <option value="Brother" @if($Personalloanform) @if($Personalloanform->reference_1_relation == 'Brother') selected @endif @endif>Brother</option>
        <option value="Sister" @if($Personalloanform) @if($Personalloanform->reference_1_relation == 'Sister') selected @endif @endif>Sister</option>
        <option value="Grandfather" @if($Personalloanform) @if($Personalloanform->reference_1_relation == 'Grandfather') selected @endif @endif>Grandfather</option>
        <option value="Grandmother" @if($Personalloanform) @if($Personalloanform->reference_1_relation == 'Grandmother') selected @endif @endif>Grandmother</option>
        <option value="Uncle" @if($Personalloanform) @if($Personalloanform->reference_1_relation == 'Uncle') selected @endif @endif >Uncle</option>
        <option value="Aunt" @if($Personalloanform) @if($Personalloanform->reference_1_relation == 'Aunt') selected @endif @endif>Aunt</option>
        <option value="Cousin" @if($Personalloanform) @if($Personalloanform->reference_1_relation == 'Cousin') selected @endif @endif>Cousin</option>
        <option value="Nephew" @if($Personalloanform) @if($Personalloanform->reference_1_relation == 'Nephew') selected @endif @endif>Nephew</option>
        <option value="Niece" @if($Personalloanform) @if($Personalloanform->reference_1_relation == 'Niece') selected @endif @endif>Niece</option>
        <option value="Husband" @if($Personalloanform) @if($Personalloanform->reference_1_relation == 'Husband') selected @endif @endif>Husband</option>
        <option value="Wife" @if($Personalloanform) @if($Personalloanform->reference_1_relation == 'Wife') selected @endif @endif>Wife</option>
      </select>
      @if($errors->has('reference_1_relation'))
      <span class="text-danger">{{$errors->first('reference_1_relation')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Mobile No.*</label>
      <input name="reference_1_mobile_no" required="true" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->reference_1_mobile_no }}" @else value="{{ old('reference_1_mobile_no') }}" @endif type="number">
      @if($errors->has('reference_1_mobile_no'))
      <span class="text-danger">{{$errors->first('reference_1_mobile_no')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Emirate*</label>
      <input name="reference_1_emirate" required="true" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->reference_1_emirate }}" @else value="{{ old('reference_1_emirate') }}" @endif type="text">
      @if($errors->has('reference_1_emirate'))
      <span class="text-danger">{{$errors->first('reference_1_emirate')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Office Telephone No.</label>
      <input name="reference_1_office_telephone" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->reference_1_office_telephone }}" @else value="{{ old('reference_1_office_telephone') }}" @endif type="text">
      @if($errors->has('reference_1_office_telephone'))
      <span class="text-danger">{{$errors->first('reference_1_office_telephone')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">E-Mail</label>
      <input name="reference_1_email" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->reference_1_email }}" @else value="{{ old('reference_1_email') }}" @endif type="email">
      @if($errors->has('reference_1_email'))
      <span class="text-danger">{{$errors->first('reference_1_email')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12">
    <label style="width: 100%; font-size: 15px;font-weight: 500;">Reference 2</label>
  </div>
  <div class="col-md-4">
    <label class="sub-label">Salutation*</label>
    <select name="reference_2_title" class="form-control" required="true">
      <option value="Mr." @if($Personalloanform) @if($Personalloanform->reference_2_title == 'Mr.') selected @endif @endif >Mr.</option>
      <option value="Mrs." @if($Personalloanform) @if($Personalloanform->reference_2_title == 'Mrs.') selected @endif @endif >Mrs.</option>
      <option value="Miss." @if($Personalloanform) @if($Personalloanform->reference_2_title == 'Miss.') selected @endif @endif >Miss</option>
      <option value="Dr." @if($Personalloanform) @if($Personalloanform->reference_2_title == 'Dr.') selected @endif @endif >Dr.</option>
      <option value="Prof." @if($Personalloanform) @if($Personalloanform->reference_2_title == 'Prof.') selected @endif @endif >Prof.</option>
      <option value="Rev." @if($Personalloanform) @if($Personalloanform->reference_2_title == 'Rev.') selected @endif @endif >Rev.</option>
      <option value="Other" @if($Personalloanform) @if($Personalloanform->reference_2_title == 'Other') selected @endif @endif >Other</option>
    </select>
    @if($errors->has('reference_2_title'))
      <span class="text-danger">{{$errors->first('reference_2_title')}}</span>
    @endif
  </div>
  <div class="col-md-8">
    <div class="form-group">
      <label class="sub-label">Full Name*</label>
      <input name="reference_2_name" required="true" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->reference_2_name }}" @else value="{{ old('reference_2_name') }}" @endif type="text">
      @if($errors->has('reference_2_name'))
      <span class="text-danger">{{$errors->first('reference_2_name')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Relation*</label>
      <select name="reference_2_relation" class="form-control">
        <option value="">Select</option>
        <option value="Father" @if($Personalloanform) @if($Personalloanform->reference_2_relation == 'Father') selected @endif @endif >Father</option>
        <option value="Mother" @if($Personalloanform) @if($Personalloanform->reference_2_relation == 'Mother') selected @endif @endif >Mother</option>
        <option value="Son" @if($Personalloanform) @if($Personalloanform->reference_2_relation == 'Son') selected @endif @endif>Son</option>
        <option value="Daughter" @if($Personalloanform) @if($Personalloanform->reference_2_relation == 'Daughter') selected @endif @endif>Daughter</option>
        <option value="Brother" @if($Personalloanform) @if($Personalloanform->reference_2_relation == 'Brother') selected @endif @endif>Brother</option>
        <option value="Sister" @if($Personalloanform) @if($Personalloanform->reference_2_relation == 'Sister') selected @endif @endif>Sister</option>
        <option value="Grandfather" @if($Personalloanform) @if($Personalloanform->reference_2_relation == 'Grandfather') selected @endif @endif>Grandfather</option>
        <option value="Grandmother" @if($Personalloanform) @if($Personalloanform->reference_2_relation == 'Grandmother') selected @endif @endif>Grandmother</option>
        <option value="Uncle" @if($Personalloanform) @if($Personalloanform->reference_2_relation == 'Uncle') selected @endif @endif >Uncle</option>
        <option value="Aunt" @if($Personalloanform) @if($Personalloanform->reference_2_relation == 'Aunt') selected @endif @endif>Aunt</option>
        <option value="Cousin" @if($Personalloanform) @if($Personalloanform->reference_2_relation == 'Cousin') selected @endif @endif>Cousin</option>
        <option value="Nephew" @if($Personalloanform) @if($Personalloanform->reference_2_relation == 'Nephew') selected @endif @endif>Nephew</option>
        <option value="Niece" @if($Personalloanform) @if($Personalloanform->reference_2_relation == 'Niece') selected @endif @endif>Niece</option>
        <option value="Husband" @if($Personalloanform) @if($Personalloanform->reference_2_relation == 'Husband') selected @endif @endif>Husband</option>
        <option value="Wife" @if($Personalloanform) @if($Personalloanform->reference_2_relation == 'Wife') selected @endif @endif>Wife</option>
      </select>
      @if($errors->has('reference_2_relation'))
      <span class="text-danger">{{$errors->first('reference_2_relation')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Mobile No.*</label>
      <input name="reference_2_mobile_no" required="true" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->reference_2_mobile_no }}" @else value="{{ old('reference_2_mobile_no') }}" @endif type="number">
      @if($errors->has('reference_2_mobile_no'))
      <span class="text-danger">{{$errors->first('reference_2_mobile_no')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Emirate*</label>
      <input name="reference_2_emirate" required="true" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->reference_2_emirate }}" @else value="{{ old('reference_2_emirate') }}" @endif type="text">
      @if($errors->has('reference_2_emirate'))
      <span class="text-danger">{{$errors->first('reference_2_emirate')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Office Telephone No.</label>
      <input name="reference_2_office_telephone" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->reference_2_office_telephone }}" @else value="{{ old('reference_2_office_telephone') }}" @endif type="text">
      @if($errors->has('reference_2_office_telephone'))
      <span class="text-danger">{{$errors->first('reference_2_office_telephone')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">E-Mail</label>
      <input name="reference_2_email" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->reference_2_email }}" @else value="{{ old('reference_2_email') }}" @endif type="email">
      @if($errors->has('reference_2_email'))
      <span class="text-danger">{{$errors->first('reference_2_email')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12">
    <label style="font-size: 17px;font-weight: 500;margin-bottom: 0px;">Personal Loan Application</label>
  </div>
  <div class="col-md-6">
    <label class="sub-label">Purpose Of Loan*</label>
    <select name="purpose_of_loan" class="form-control" required="true">
      <option value="">Select</option>
      <option value="Education" @if($Personalloanform) @if($Personalloanform->purpose_of_loan == 'Education') selected @endif @endif >Education</option>
      <option value="Property" @if($Personalloanform) @if($Personalloanform->purpose_of_loan == 'Property') selected @endif @endif >Property</option>
      <option value="Household" @if($Personalloanform) @if($Personalloanform->purpose_of_loan == 'Household') selected @endif @endif >Household</option>
      <option value="Rent" @if($Personalloanform) @if($Personalloanform->purpose_of_loan == 'Rent') selected @endif @endif >Rent</option>
      <option value="Business" @if($Personalloanform) @if($Personalloanform->purpose_of_loan == 'Business') selected @endif @endif >Business</option>
      <option value="Personal" @if($Personalloanform) @if($Personalloanform->purpose_of_loan == 'Personal') selected @endif @endif >Personal</option>
      <option value="Other" @if($Personalloanform) @if($Personalloanform->purpose_of_loan == 'Other') selected @endif @endif >Other</option>
    </select>
    @if($errors->has('purpose_of_loan'))
      <span class="text-danger">{{ $errors->first('purpose_of_loan') }}</span>
    @endif
  </div>
  

  <div class="col-md-6">
    <label class="sub-label">If You Have A Co-Borrower*</label>
    <select name="if_you_have_co_borrower" onChange="ifYouHaveCOBorrower(this);" class="form-control" required="true">
      <option value="">Select</option>
      <option value="1" @if($Personalloanform) @if($Personalloanform->if_you_have_co_borrower == "1") selected @endif @endif >Yes</option>
      <option value="0" @if($Personalloanform) @if($Personalloanform->if_you_have_co_borrower == "0") selected @endif @endif >No</option>
    </select>
  </div>

  <div class="col-md-12 HaveCOBorrower" @if($Personalloanform) @if($Personalloanform->if_you_have_co_borrower == "0") style="display: none;" @endif @else style="display: none;" @endif >
    <label style="margin-top: 20px; font-size: 17px; font-weight: 500; margin-bottom: 5px;">Co-Borrower Details:</label>
  </div>

  <div class="col-md-4 HaveCOBorrower" @if($Personalloanform) @if($Personalloanform->if_you_have_co_borrower == "0") style="display: none;" @endif @else style="display: none;" @endif >
    <label class="sub-label">Salutation*</label>
    <select name="co_borrower_title" class="form-control">
      <option value="Mr." @if($Personalloanform) @if($Personalloanform->co_borrower_title == 'Mr.') selected @endif @endif >Mr.</option>
      <option value="Mrs." @if($Personalloanform) @if($Personalloanform->co_borrower_title == 'Mrs.') selected @endif @endif >Mrs.</option>
      <option value="Miss." @if($Personalloanform) @if($Personalloanform->co_borrower_title == 'Miss.') selected @endif @endif >Miss</option>
      <option value="Dr." @if($Personalloanform) @if($Personalloanform->co_borrower_title == 'Dr.') selected @endif @endif >Dr.</option>
      <option value="Prof." @if($Personalloanform) @if($Personalloanform->co_borrower_title == 'Prof.') selected @endif @endif >Prof.</option>
      <option value="Rev." @if($Personalloanform) @if($Personalloanform->co_borrower_title == 'Rev.') selected @endif @endif >Rev.</option>
      <option value="Other" @if($Personalloanform) @if($Personalloanform->co_borrower_title == 'Other') selected @endif @endif >Other</option>
    </select>
    @if($errors->has('co_borrower_title'))
      <span class="text-danger">{{$errors->first('co_borrower_title')}}</span>
    @endif
  </div>
  <div class="col-md-8 HaveCOBorrower" @if($Personalloanform) @if($Personalloanform->if_you_have_co_borrower == "0") style="display: none;" @endif @else style="display: none;" @endif >
    <div class="form-group">
      <label class="sub-label">Co-Borrower Name*</label>
      <input name="co_borrower_name" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->co_borrower_name }}" @else value="{{ old('co_borrower_name') }}" @endif type="text">
      @if($errors->has('co_borrower_name'))
      <span class="text-danger">{{$errors->first('co_borrower_name')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6 HaveCOBorrower" @if($Personalloanform) @if($Personalloanform->if_you_have_co_borrower == "0") style="display: none;" @endif @else style="display: none;" @endif >
    <div class="form-group">
      <label class="sub-label">Relationship To Primary Borrower*</label>
      <input name="relationship_to_primary_borrower" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->relationship_to_primary_borrower }}" @else value="{{ old('relationship_to_primary_borrower') }}" @endif type="text">
      @if($errors->has('relationship_to_primary_borrower'))
      <span class="text-danger">{{$errors->first('relationship_to_primary_borrower')}}</span>
      @endif
    </div>
  </div>

  <div class="noPrint col-md-6 HaveCOBorrower" @if($Personalloanform) @if($Personalloanform->if_you_have_co_borrower == "0") style="display: none;" @endif @else style="display: none;" @endif >
    <div class="form-group">
      <label class="sub-label" style="width: 100%;">Upload Co-Borrower Signature*</label>
      <input name="co_borrower_signature" style="box-shadow: none; float: left; padding-left: 0px; width: 70%;" class="form-control" type="file">
      @if($Personalloanform)
        @if($Personalloanform->co_borrower_signature)   <a href="{!! asset($Personalloanform->co_borrower_signature) !!}" download="" style="float: right;">Download</a>  @endif
      @endif 
      @if($errors->has('co_borrower_signature'))
      <span class="text-danger">{{$errors->first('co_borrower_signature')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6 HaveCOBorrower" @if($Personalloanform) @if($Personalloanform->if_you_have_co_borrower == "0") style="display: none;" @endif @else style="display: none;" @endif >
    <div class="form-group">
      <label class="sub-label">Co-Borrower Date*</label>
      <input id="date_of_joining" name="co_borrower_date" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->co_borrower_date }}" @else value="{{ old('co_borrower_date') }}" @endif type="text">
      <!-- <i class="fa-solid fa-calendar"></i> -->
      @if($errors->has('co_borrower_date'))
      <span class="text-danger">{{$errors->first('co_borrower_date')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-12"></div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Loan Amount (Aed)*</label>
      <input name="loan_amount" required="true" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->loan_amount }}" @else value="{{ old('loan_amount') }}" @endif type="number">
      @if($errors->has('loan_amount'))
      <span class="text-danger">{{$errors->first('loan_amount')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Interest Rate (Per Annum)*</label>
      <input name="interest_rate" required="true" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->interest_rate }}" @else value="{{ old('interest_rate') }}" @endif type="number">
      @if($errors->has('interest_rate'))
      <span class="text-danger">{{$errors->first('interest_rate')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Number Of Installments (Months)*</label>
      <input name="number_of_installments" required="true" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->number_of_installments }}" @else value="{{ old('number_of_installments') }}" @endif type="number">
      @if($errors->has('number_of_installments'))
      <span class="text-danger">{{$errors->first('number_of_installments')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Installment Start Date*</label>
      <input id="my_date_picker" required="true" name="installment_start_date" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->installment_start_date }}" @else value="{{ old('installment_start_date') }}" @endif type="text">
      <!-- <i class="fa-solid fa-calendar"></i> -->
      @if($errors->has('installment_start_date'))
      <span class="text-danger">{{$errors->first('installment_start_date')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Monthly Installment Amount (Aed)*</label>
      <input name="monthly_installment_amount" required="true" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->monthly_installment_amount }}" @else value="{{ old('monthly_installment_amount') }}" @endif type="number">
      @if($errors->has('monthly_installment_amount'))
      <span class="text-danger">{{$errors->first('monthly_installment_amount')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Processing Fee (Aed)*</label>
      <input name="processing_fee" required="true" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->processing_fee }}" @else value="{{ old('processing_fee') }}" @endif type="number">
      @if($errors->has('processing_fee'))
      <span class="text-danger">{{$errors->first('processing_fee')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12">
    <label style="font-size: 17px;font-weight: 500;margin-bottom: 0px;">Existing Financing Details/Other Banking Relationship</label>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Institution Name</label>
      <input name="institution_name" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->institution_name }}" @else value="{{ old('institution_name') }}" @endif type="text">
      @if($errors->has('institution_name'))
      <span class="text-danger">{{$errors->first('institution_name')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Product/Card Type</label>
      <input name="product_card_type" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->product_card_type }}" @else value="{{ old('product_card_type') }}" @endif type="text">
      @if($errors->has('product_card_type'))
      <span class="text-danger">{{$errors->first('product_card_type')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Account/Card Number</label>
      <input name="account_card_number" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->account_card_number }}" @else value="{{ old('account_card_number') }}" @endif type="number">
      @if($errors->has('account_card_number'))
      <span class="text-danger">{{$errors->first('account_card_number')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Finance Amount (Aed)</label>
      <input name="finance_amount" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->finance_amount }}" @else value="{{ old('finance_amount') }}" @endif type="number">
      @if($errors->has('finance_amount'))
      <span class="text-danger">{{$errors->first('finance_amount')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Monthly Installment (Aed)</label>
      <input name="monthly_installment" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->monthly_installment }}" @else value="{{ old('monthly_installment') }}" @endif type="number">
      @if($errors->has('monthly_installment'))
      <span class="text-danger">{{$errors->first('monthly_installment')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Outstanding Balance (Aed)</label>
      <input name="outstanding_balance" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->outstanding_balance }}" @else value="{{ old('outstanding_balance') }}" @endif type="number">
      @if($errors->has('outstanding_balance'))
      <span class="text-danger">{{$errors->first('outstanding_balance')}}</span>
      @endif
    </div>
  </div>
  
  <div class="col-md-12">
    <label style="font-size: 17px;font-weight: 500;margin-bottom: 0px;">Personal Finance Details</label>
  </div>
  <div class="col-md-6">    
    <div class="form-group">
      <label class="sub-label">Type Of Personal Finance</label>
      <select name="type_of_personal_finance" class="form-control">
      <option value="New/Fresh Case" @if($Personalloanform) @if($Personalloanform->type_of_personal_finance == 'New/Fresh Case') selected @endif @endif >New/Fresh Case</option>
      <option value="Debt Settlement" @if($Personalloanform) @if($Personalloanform->type_of_personal_finance == 'Debt Settlement') selected @endif @endif >Debt Settlement</option>
      <option value="Secured Finance" @if($Personalloanform) @if($Personalloanform->type_of_personal_finance == 'Secured Finance') selected @endif @endif >Secured Finance</option>
      <option value="Consolidation (Existing CM facilities)" @if($Personalloanform) @if($Personalloanform->type_of_personal_finance == 'Consolidation (Existing CM facilities)') selected @endif @endif >Consolidation (Existing CM facilities)</option>
      <option value="Investment Murabaha (Finance Against Shares)" @if($Personalloanform) @if($Personalloanform->type_of_personal_finance == 'Investment Murabaha (Finance Against Shares)') selected @endif @endif >Investment Murabaha (Finance Against Shares)</option>
      <option value="Top-Up" @if($Personalloanform) @if($Personalloanform->type_of_personal_finance == 'Top-Up') selected @endif @endif >Top-Up</option>
    </select>
    @if($errors->has('type_of_personal_finance'))
      <span class="text-danger">{{$errors->first('type_of_personal_finance')}}</span>
    @endif
    </div>
  </div>

  <div class="col-md-12">
    <label style="font-size: 17px;font-weight: 500;margin-bottom: 0px;">Type Of Murabaha</label>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Investment Murabaha</label>
      <select name="investment_murabaha" class="form-control">
      <option value="Account Numbers (If Available)" @if($Personalloanform) @if($Personalloanform->investment_murabaha == 'Account Numbers (If Available)') selected @endif @endif >Account Numbers (If Available)</option>
      <option value="Dfm/Nasdaq Account Number" @if($Personalloanform) @if($Personalloanform->investment_murabaha == 'Dfm/Nasdaq Account Number') selected @endif @endif >Dfm/Nasdaq Account Number</option>
      <option value="Adx Account Number" @if($Personalloanform) @if($Personalloanform->investment_murabaha == 'Adx Account Number') selected @endif @endif >Adx Account Number</option>
      <option value="Enbds Account Number" @if($Personalloanform) @if($Personalloanform->investment_murabaha == 'Enbds Account Number') selected @endif @endif >Enbds Account Number</option>
      <option value="Current/Savings Account Number" @if($Personalloanform) @if($Personalloanform->investment_murabaha == 'Current/Savings Account Number') selected @endif @endif >Current/Savings Account Number</option>
      <option value="Ei Stock Trading Account Number" @if($Personalloanform) @if($Personalloanform->investment_murabaha == 'Ei Stock Trading Account Number') selected @endif @endif >Ei Stock Trading Account Number</option>
      <option value="Certificates Murabaha" @if($Personalloanform) @if($Personalloanform->investment_murabaha == 'Certificates Murabaha') selected @endif @endif >Certificates Murabaha</option>
    </select>
    @if($errors->has('investment_murabaha'))
      <span class="text-danger">{{$errors->first('investment_murabaha')}}</span>
    @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Requested Financing Details</label>
      <select name="requested_financing_details" class="form-control">
      <option value="Total Finance Amount" @if($Personalloanform) @if($Personalloanform->requested_financing_details == 'Total Finance Amount') selected @endif @endif >Total Finance Amount</option>
      <option value="Profit Rate" @if($Personalloanform) @if($Personalloanform->requested_financing_details == 'Profit Rate') selected @endif @endif >Profit Rate</option>
      <option value="Tenure" @if($Personalloanform) @if($Personalloanform->requested_financing_details == 'Tenure') selected @endif @endif >Tenure</option>
      <option value="Installment Amount (Emi)" @if($Personalloanform) @if($Personalloanform->requested_financing_details == 'Installment Amount (Emi)') selected @endif @endif >Installment Amount (Emi)</option>
      <option value="Due Date (1St Emi Date)" @if($Personalloanform) @if($Personalloanform->requested_financing_details == 'Due Date (1St Emi Date)') selected @endif @endif >Due Date (1St Emi Date)</option>
      <option value="Salary Transfer Date" @if($Personalloanform) @if($Personalloanform->requested_financing_details == 'Salary Transfer Date') selected @endif @endif >Salary Transfer Date</option>
    </select>
    @if($errors->has('requested_financing_details'))
      <span class="text-danger">{{$errors->first('requested_financing_details')}}</span>
    @endif
    </div>
  </div>
  
  <div class="col-md-12">
    <label style="font-size: 17px;font-weight: 500;margin-bottom: 0px;">Repayment Details</label>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Customer Segment</label>
      <select name="customer_segment" class="form-control">
        <option value="Salary Transfer" @if($Personalloanform) @if($Personalloanform->customer_segment == 'Salary Transfer') selected @endif @endif >Salary Transfer</option>
        <option value="Non Salary Transfer" @if($Personalloanform) @if($Personalloanform->customer_segment == 'Non Salary Transfer') selected @endif @endif >Non Salary Transfer</option>
        <option value="Self Employed" @if($Personalloanform) @if($Personalloanform->customer_segment == 'Self Employed') selected @endif @endif >Self Employed</option>
        <option value="Other" @if($Personalloanform) @if($Personalloanform->customer_segment == 'Other') selected @endif @endif >Other</option>
      </select>
    @if($errors->has('customer_segment'))
      <span class="text-danger">{{$errors->first('customer_segment')}}</span>
    @endif
    </div>
  </div>
  
  <div class="col-md-12">
    <label style="font-size: 17px;font-weight: 500;margin-bottom: 0px;">Payment Method</label>
    <label style="width: 100%;font-size: 15px;font-weight: 500;">Payment From</label>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Direct debit account number</label>
      <input name="direct_debit_account_number" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->direct_debit_account_number }}" @else value="{{ old('direct_debit_account_number') }}" @endif type="number">
      @if($errors->has('direct_debit_account_number'))
      <span class="text-danger">{{$errors->first('direct_debit_account_number')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12">
    <label style="width: 100%; font-size: 17px;font-weight: 500;margin-bottom: 0px;"">Payment From Other Bank (Uaedds)</label>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Direct debit account number</label>
      <input name="other_bank_direct_debit_account_number" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->other_bank_direct_debit_account_number }}" @else value="{{ old('other_bank_direct_debit_account_number') }}" @endif type="number">
      @if($errors->has('other_bank_direct_debit_account_number'))
      <span class="text-danger">{{$errors->first('other_bank_direct_debit_account_number')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Bank name</label>
      <input name="other_bank_name" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->other_bank_name }}" @else value="{{ old('other_bank_name') }}" @endif type="text">
      @if($errors->has('other_bank_name'))
      <span class="text-danger">{{$errors->first('other_bank_name')}}</span>
      @endif
    </div>
  </div>
  
 <!--  <div class="col-md-12">
    <label style="width: 100%;font-size: 15px;">Frequency Of Payment</label>
  </div> -->
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Frequency Of Payment</label>
      <select name="frequency_of_payment" class="form-control">
        <option value="Monthly" @if($Personalloanform) @if($Personalloanform->frequency_of_payment == 'Monthly') selected @endif @endif >Monthly</option>
      </select>
      @if($errors->has('frequency_of_payment'))
        <span class="text-danger">{{$errors->first('frequency_of_payment')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Type Of New Account</label>
      <select name="type_of_new_account" class="form-control">
        <option value="Current Account" @if($Personalloanform) @if($Personalloanform->type_of_new_account == 'Current Account') selected @endif @endif >Current Account</option>
        <option value="Savings Account" @if($Personalloanform) @if($Personalloanform->type_of_new_account == 'Savings Account') selected @endif @endif >Savings Account</option>
        <option value="Other" @if($Personalloanform) @if($Personalloanform->type_of_new_account == 'Other') selected @endif @endif >Other</option>
      </select>
      @if($errors->has('type_of_new_account'))
        <span class="text-danger">{{$errors->first('type_of_new_account')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Takaful</label>
      <select name="takaful" class="form-control">
        <option value="Noor Takaful" @if($Personalloanform) @if($Personalloanform->takaful == 'Noor Takaful') selected @endif @endif >Noor Takaful</option>
        <option value="Arabian Scandinavian Insurance Company (Plc) - Takaful - Ascana Insurance (Ascana)" @if($Personalloanform) @if($Personalloanform->takaful == 'Arabian Scandinavian Insurance Company (Plc) - Takaful - Ascana Insurance (Ascana)') selected @endif @endif >Arabian Scandinavian Insurance Company (Plc) - Takaful - Ascana Insurance (Ascana)</option>
        <option value="Dubai Islamic Insurance & Reinsurance Company(Aman)" @if($Personalloanform) @if($Personalloanform->takaful == 'Dubai Islamic Insurance & Reinsurance Company(Aman)') selected @endif @endif >Dubai Islamic Insurance & Reinsurance Company(Aman)</option>
      </select>
      @if($errors->has('takaful'))
        <span class="text-danger">{{$errors->first('takaful')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-12">
    <label style="font-size: 17px;font-weight: 500;margin-bottom: 0px;">Takaful Protection For Adib Personal Finance</label>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">I Would Like To Receive A Special Rate To Participate In The Takaful Protection For Adib Personal Finance*</label>
      <select name="receive_a_special_rate_to_participate" class="form-control">
        <option value="1" @if($Personalloanform) @if($Personalloanform->receive_a_special_rate_to_participate == '1') selected @endif @endif >Yes</option>
        <option value="0" @if($Personalloanform) @if($Personalloanform->receive_a_special_rate_to_participate == '0') selected @endif @endif >No</option>
      </select>
      @if($errors->has('receive_a_special_rate_to_participate'))
        <span class="text-danger">{{$errors->first('receive_a_special_rate_to_participate')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label" style="min-height: 63px;">Have You Ever Obtained Al Khair Financing From Adib?Financing From Adib?</label>
      <select name="ever_obtained_al_khair_financing" class="form-control">
        <option value="1" @if($Personalloanform) @if($Personalloanform->ever_obtained_al_khair_financing == '1') selected @endif @endif >Yes</option>
        <option value="0" @if($Personalloanform) @if($Personalloanform->ever_obtained_al_khair_financing == '0') selected @endif @endif >No</option>
      </select>
      @if($errors->has('ever_obtained_al_khair_financing'))
        <span class="text-danger">{{$errors->first('ever_obtained_al_khair_financing')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-12">
    <label style="font-size: 17px;font-weight: 500;margin-bottom: 0px;">Details Of Bank Accounts</label>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Bank name</label>
      <input name="details_bank_name" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->details_bank_name }}" @else value="{{ old('details_bank_name') }}" @endif type="text">
      @if($errors->has('details_bank_name'))
      <span class="text-danger">{{$errors->first('details_bank_name')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Branch</label>
      <input name="details_branch" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->details_branch }}" @else value="{{ old('details_branch') }}" @endif type="text">
      @if($errors->has('details_branch'))
      <span class="text-danger">{{$errors->first('details_branch')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Account Since</label>
      <input name="details_account_since" id="spouse_date_of_birth" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->details_account_since }}" @else value="{{ old('details_account_since') }}" @endif type="text">
      <!-- <i class="fa-solid fa-calendar"></i> -->
      @if($errors->has('details_account_since'))
      <span class="text-danger">{{$errors->first('details_account_since')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12">
    <label style="font-size: 17px;font-weight: 500;margin-bottom: 0px;">Details Of Credit Cards</label>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Bank name</label>
      <input name="details_credit_bank" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->details_credit_bank }}" @else value="{{ old('details_credit_bank') }}" @endif type="text">
      @if($errors->has('details_credit_bank'))
      <span class="text-danger">{{$errors->first('details_credit_bank')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Limit (Aed)</label>
      <input name="details_credit_limit" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->details_credit_limit }}" @else value="{{ old('details_credit_limit') }}" @endif type="number">
      @if($errors->has('details_credit_limit'))
      <span class="text-danger">{{$errors->first('details_credit_limit')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Account Since</label>
      <input name="details_credit_account_since" class="member_joining form-control" @if($Personalloanform) value="{{ $Personalloanform->details_credit_account_since }}" @else value="{{ old('details_credit_account_since') }}" @endif type="text">
      <!-- <i class="fa-solid fa-calendar"></i> -->
      @if($errors->has('details_credit_account_since'))
      <span class="text-danger">{{$errors->first('details_credit_account_since')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-12">
    <label style="font-size: 17px;font-weight: 500;margin-bottom: 0px;">Information On Liabilities</label>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Bank Name</label>
      <input name="liabilities_bank_name" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->liabilities_bank_name }}" @else value="{{ old('liabilities_bank_name') }}" @endif type="text">
      @if($errors->has('liabilities_bank_name'))
      <span class="text-danger">{{$errors->first('liabilities_bank_name')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Facility Type</label>
      <input name="liabilities_facility_type" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->liabilities_facility_type }}" @else value="{{ old('liabilities_facility_type') }}" @endif type="text">
      @if($errors->has('liabilities_facility_type'))
      <span class="text-danger">{{$errors->first('liabilities_facility_type')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Monthly Installment Amount</label>
      <input name="liabilities_monthly_installment_amount" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->liabilities_monthly_installment_amount }}" @else value="{{ old('liabilities_monthly_installment_amount') }}" @endif type="number">
      @if($errors->has('liabilities_monthly_installment_amount'))
      <span class="text-danger">{{$errors->first('liabilities_monthly_installment_amount')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Outstanding Amount</label>
      <input name="liabilities_outstanding_amount" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->liabilities_outstanding_amount }}" @else value="{{ old('liabilities_outstanding_amount') }}" @endif type="number">
      @if($errors->has('liabilities_outstanding_amount'))
      <span class="text-danger">{{$errors->first('liabilities_outstanding_amount')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12">
    <label style="font-size: 17px;font-weight: 500;margin-bottom: 0px;">Customer'S Liabilities With Other Banks That Are To Be Settled</label>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Bank Name</label>
      <input name="liabilities_other_bank_name" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->liabilities_other_bank_name }}" @else value="{{ old('liabilities_other_bank_name') }}" @endif type="text">
      @if($errors->has('liabilities_other_bank_name'))
      <span class="text-danger">{{$errors->first('liabilities_other_bank_name')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Facility Type</label>
      <input name="liabilities_other_facility_type" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->liabilities_other_facility_type }}" @else value="{{ old('liabilities_other_facility_type') }}" @endif type="text">
      @if($errors->has('liabilities_other_facility_type'))
      <span class="text-danger">{{$errors->first('liabilities_other_facility_type')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Monthly Installment Amount</label>
      <input name="liabilities_other_monthly_installment_amount" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->liabilities_other_monthly_installment_amount }}" @else value="{{ old('liabilities_other_monthly_installment_amount') }}" @endif type="number">
      @if($errors->has('liabilities_other_monthly_installment_amount'))
      <span class="text-danger">{{$errors->first('liabilities_other_monthly_installment_amount')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Outstanding Amount</label>
      <input name="liabilities_other_outstanding_amount" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->liabilities_other_outstanding_amount }}" @else value="{{ old('liabilities_other_outstanding_amount') }}" @endif type="number">
      @if($errors->has('liabilities_other_outstanding_amount'))
      <span class="text-danger">{{$errors->first('liabilities_other_outstanding_amount')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12">
    <label style="font-size: 17px;font-weight: 500;margin-bottom: 0px;">Proposed Securities By The Customer</label>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Date Of Signing</label>
      <input name="date_of_signing" class="member_joining form-control" @if($Personalloanform) value="{{ $Personalloanform->date_of_signing }}" @else value="{{ old('date_of_signing') }}" @endif type="text">
     <!--  <i class="fa-solid fa-calendar"></i> -->
      @if($errors->has('date_of_signing'))
      <span class="text-danger">{{$errors->first('date_of_signing')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6 noPrint">
    <div class="form-group">
      <label class="sub-label" style="width: 100%;">Signature Of Applicant</label>
      <input name="signature_of_applicant" style="box-shadow: none; float: left; padding-left: 0px; width: 70%;" class="form-control" type="file">
      @if($Personalloanform)
        @if($Personalloanform->signature_of_applicant)   <a href="{!! asset($Personalloanform->signature_of_applicant) !!}" download="" style="float: right;">Download</a>  @endif
      @endif  
      @if($errors->has('signature_of_applicant'))
      <span class="text-danger">{{$errors->first('signature_of_applicant')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12">
    <label style="font-size: 17px;font-weight: 500;margin-bottom: 0px;">Public Figure Information</label>
  </div>

  <div class="col-md-6">
    <label class="sub-label">Are You A Public Figure*</label>
    <select name="are_you_a_public_figure" onChange="PublicFigure(this);" class="form-control" required="true">
      <option value="">Select</option>
      <option value="1" @if($Personalloanform) @if($Personalloanform->are_you_a_public_figure == "1") selected @endif @endif >Yes</option>
      <option value="0" @if($Personalloanform) @if($Personalloanform->are_you_a_public_figure == "0") selected @endif @endif >No</option>
    </select>
  </div>
  <div class="col-md-6 PublicFigure" @if($Personalloanform) @if($Personalloanform->are_you_a_public_figure == "0") style="display: none;" @endif @else style="display: none;" @endif>
    <div class="form-group">
      <label class="sub-label">Position/Title</label>
      <input name="public_figure_position_title" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->public_figure_position_title }}" @else value="{{ old('public_figure_position_title') }}" @endif type="text">
      @if($errors->has('public_figure_position_title'))
      <span class="text-danger">{{$errors->first('public_figure_position_title')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <label class="sub-label">Are You Related To A Public Figure*</label>
    <select name="related_to_public_figure" onChange="RelatedPublicFigure(this);" class="form-control" required="true">
      <option value="">Select</option>
      <option value="1" @if($Personalloanform) @if($Personalloanform->related_to_public_figure == "1") selected @endif @endif >Yes</option>
      <option value="0" @if($Personalloanform) @if($Personalloanform->related_to_public_figure == "0") selected @endif @endif >No</option>
    </select>
  </div>
  <div class="col-md-6 RelatedPublicFigure" @if($Personalloanform) @if($Personalloanform->related_to_public_figure == "0") style="display: none;" @endif @else style="display: none;" @endif>
    <div class="form-group">
      <label class="sub-label">Position/Title</label>
      <input name="related_public_figure_position_title" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->related_public_figure_position_title }}" @else value="{{ old('related_public_figure_position_title') }}" @endif type="text">
      @if($errors->has('related_public_figure_position_title'))
      <span class="text-danger">{{$errors->first('related_public_figure_position_title')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12">
    <label style="font-size: 17px;font-weight: 500;margin-bottom: 0px;margin-top: 20px;">Murabaha Transaction Mechanism</label>
    <label style="font-size: 15px;width: 100%;margin-bottom: 10px;font-weight: 500;">Acknowledgement</label>
  </div>
  <div class="col-md-12">
     <label style="font-weight: normal; font-size: 14px; margin-top: 6px;"><input style="width: 20px; height: 20px; box-shadow: none; margin-right: 10px; margin-top: 0px; float: left;margin-bottom: 0px;" type="checkbox" name="acknowledge_receiving_key_fact_statement" @if($Personalloanform) @if($Personalloanform->acknowledge_receiving_key_fact_statement == "1") checked="" @endif @endif value="1"> I Acknowledge Receiving A Key Fact Statement (Kfs) Of This Product.</label>
  </div>

  <div class="col-md-12" style="margin-top: 10px;">
     <label style="font-weight: normal; font-size: 14px; margin-top: 6px;"><input style="width: 20px; height: 20px; box-shadow: none; margin-right: 10px; margin-top: 22px; float: left;margin-bottom: 25px;" type="checkbox" name="hereby_give_our_consent_to_waive" @if($Personalloanform) @if($Personalloanform->hereby_give_our_consent_to_waive == "1") checked="" @endif @endif value="1"> I/We Hereby Give Our Consent To Waive Of The Cooling-Off Period Of 5 Business<br> Days And Understand That The Bank'S Terms & Condition Are Applicable From The
Date Of Signing This Application By Me.</label>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Customer Name</label>
      <input name="customer_name" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->customer_name }}" @else value="{{ old('customer_name') }}" @endif type="text">
      @if($errors->has('customer_name'))
      <span class="text-danger">{{$errors->first('customer_name')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Signature Date</label>
      <input name="signature_date" class="member_joining form-control" @if($Personalloanform) value="{{ $Personalloanform->signature_date }}" @else value="{{ old('signature_date') }}" @endif type="text">
      <!-- <i class="fa-solid fa-calendar"></i> -->
      @if($errors->has('signature_date'))
      <span class="text-danger">{{$errors->first('signature_date')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12">
     <label style="font-size: 17px;font-weight: 500;margin-bottom: 0px;">Individual Tax Residency Self Certification</label>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Us Citizen Or Other Citizen (If Us Citizen Us Tin No.)</label>
      <input name="us_citizen_or_other" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->us_citizen_or_other }}" @else value="{{ old('us_citizen_or_other') }}" @endif type="text">
      @if($errors->has('us_citizen_or_other'))
      <span class="text-danger">{{$errors->first('us_citizen_or_other')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Town Or City Of Birth</label>
      <input name="town_or_city_of_birth" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->town_or_city_of_birth }}" @else value="{{ old('town_or_city_of_birth') }}" @endif type="text">
      @if($errors->has('town_or_city_of_birth'))
      <span class="text-danger">{{$errors->first('town_or_city_of_birth')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Nationality</label>
      <select name="country_of_birth" class="form-control">
        <option value="">Select</option>
        @foreach($countries as $country)
          <option value="{{ $country->id }}" @if($Personalloanform) @if($Personalloanform->country_of_birth == $country->id) selected @endif @endif >{{ $country->country_name }}</option>
        @endforeach
      </select>
      @if($errors->has('country_of_birth'))
      <span class="text-danger">{{$errors->first('country_of_birth')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6 noPrint">
    <div class="form-group">
      <label class="sub-label" style="width: 100%;">Cm Signature</label>
      <input name="individual_tax_cm_signature" style="box-shadow: none; float: left; padding-left: 0px; width: 70%;" class="form-control" type="file">
      @if($Personalloanform)
        @if($Personalloanform->individual_tax_cm_signature)   <a href="{!! asset($Personalloanform->individual_tax_cm_signature) !!}" download="" style="float: right;">Download</a>  @endif
      @endif  
      @if($errors->has('individual_tax_cm_signature'))
      <span class="text-danger">{{$errors->first('individual_tax_cm_signature')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Date</label>
      <input name="individual_tax_date" class="member_joining form-control" @if($Personalloanform) value="{{ $Personalloanform->individual_tax_date }}" @else value="{{ old('individual_tax_date') }}" @endif type="text">
     <!--  <i class="fa-solid fa-calendar"></i> -->
      @if($errors->has('individual_tax_date'))
      <span class="text-danger">{{$errors->first('individual_tax_date')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-12">
    <label style="font-size: 17px;font-weight: 500;margin-bottom: 0px;">Promise To Purchase</label>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Cm Name</label>
      <input name="promise_cm_name" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->promise_cm_name }}" @else value="{{ old('promise_cm_name') }}" @endif type="text">
      @if($errors->has('promise_cm_name'))
      <span class="text-danger">{{$errors->first('promise_cm_name')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12">
    <label style="font-size: 17px;font-weight: 500;margin-bottom: 0px;">Schedule 1</label>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Cost Price (Finance Amt)</label>
      <input name="cost_price" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->cost_price }}" @else value="{{ old('cost_price') }}" @endif type="number">
      @if($errors->has('cost_price'))
      <span class="text-danger">{{$errors->first('cost_price')}}</span>
      @endif
    </div>
  </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="sub-label">Profit (As Per Salary)</label>
            <input name="profit" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->profit }}" @else value="{{ old('profit') }}" @endif type="number">
            @if($errors->has('profit'))
            <span class="text-danger">{{$errors->first('profit')}}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
          <label class="sub-label">Number Of Installments (As Per Cm)</label>
          <input name="schedule_1_number_of_installments" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->schedule_1_number_of_installments }}" @else value="{{ old('schedule_1_number_of_installments') }}" @endif type="number">
          @if($errors->has('schedule_1_number_of_installments'))
          <span class="text-danger">{{$errors->first('schedule_1_number_of_installments')}}</span>
          @endif
        </div>
    </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Day Of Every Month (Emi Date)</label>
      <input name="day_of_every_month" class="member_joining form-control" @if($Personalloanform) value="{{ $Personalloanform->day_of_every_month }}" @else value="{{ old('day_of_every_month') }}" @endif type="text">
     <!--  <i class="fa-solid fa-calendar"></i> -->
      @if($errors->has('day_of_every_month'))
      <span class="text-danger">{{$errors->first('day_of_every_month')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-12">
     <label style="font-weight: normal; font-size: 14px; margin-top: 6px;"><input style="width: 20px; height: 20px; box-shadow: none; margin-right: 10px; margin-top: 3px; float: left;margin-bottom: 7px;" type="radio" name="murabaha_contract_or_proceeds_thereof" @if($Personalloanform) @if($Personalloanform->murabaha_contract_or_proceeds_thereof == "1") checked="checked" @endif @endif value="1"> Advise Us Your Custody Account Number With Enbds To Which The Asset Will Be Transferred Upon Completion Of The Murabaha Contract</label>
  </div>
  <div class="col-md-12">
     <label style="font-weight: normal; font-size: 14px; margin-top: 6px;"><input style="width: 20px; height: 20px; box-shadow: none; margin-right: 10px; margin-top: 3px; float: left;margin-bottom: 7px;" type="radio" name="murabaha_contract_or_proceeds_thereof" @if($Personalloanform) @if($Personalloanform->murabaha_contract_or_proceeds_thereof == "2") checked="checked" @endif @else checked="checked" @endif value="2"> To Authorise Enbds To Sell The Asset To Third Party On Your Behalf And Transfer The Sale Proceeds Thereof Into Your Account With Ei No.</label>
  </div>

  <div class="col-md-12">
    <label style="margin-top: 15px; font-size: 17px;font-weight: 500;margin-bottom: 0px;">Schedule 2</label>
  </div>
  
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Emirates Islamic Bank Psjc (The “Seller”)</label>
      <input name="schedule_2_emirates_islamic_bank" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->schedule_2_emirates_islamic_bank }}" @else value="{{ old('schedule_2_emirates_islamic_bank') }}" @endif type="text">
      @if($errors->has('schedule_2_emirates_islamic_bank'))
      <span class="text-danger">{{$errors->first('schedule_2_emirates_islamic_bank')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Date</label>
      <input name="schedule_2_date" class="member_joining form-control" @if($Personalloanform) value="{{ $Personalloanform->schedule_2_date }}" @else value="{{ old('schedule_2_date') }}" @endif type="text">
     <!--  <i class="fa-solid fa-calendar"></i> -->
      @if($errors->has('schedule_2_date'))
      <span class="text-danger">{{$errors->first('schedule_2_date')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Number Of Investment Certificates</label>
      <input name="schedule_2_number_investment_certificates" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->schedule_2_number_investment_certificates }}" @else value="{{ old('schedule_2_number_investment_certificates') }}" @endif type="number">
      @if($errors->has('schedule_2_number_investment_certificates'))
      <span class="text-danger">{{$errors->first('schedule_2_number_investment_certificates')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Cost Price</label>
      <input name="schedule_2_cost_price" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->schedule_2_cost_price }}" @else value="{{ old('schedule_2_cost_price') }}" @endif type="number">
      @if($errors->has('schedule_2_cost_price'))
      <span class="text-danger">{{$errors->first('schedule_2_cost_price')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Deferred Profit</label>
      <input name="schedule_2_deferred_profit" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->schedule_2_deferred_profit }}" @else value="{{ old('schedule_2_deferred_profit') }}" @endif type="number">
      @if($errors->has('schedule_2_deferred_profit'))
      <span class="text-danger">{{$errors->first('schedule_2_deferred_profit')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Advance Payment (Deducted Up Front)</label>
      <input name="schedule_2_advance_payment" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->schedule_2_advance_payment }}" @else value="{{ old('schedule_2_advance_payment') }}" @endif type="number">
      @if($errors->has('schedule_2_advance_payment'))
      <span class="text-danger">{{$errors->first('schedule_2_advance_payment')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Murabaha Sale Price</label>
      <input name="schedule_2_murabaha_sale_price" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->schedule_2_murabaha_sale_price }}" @else value="{{ old('schedule_2_murabaha_sale_price') }}" @endif type="number">
      @if($errors->has('schedule_2_murabaha_sale_price'))
      <span class="text-danger">{{$errors->first('schedule_2_murabaha_sale_price')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Payment Date</label>
      <input name="schedule_2_payment_date" class="member_joining form-control" @if($Personalloanform) value="{{ $Personalloanform->schedule_2_payment_date }}" @else value="{{ old('schedule_2_payment_date') }}" @endif type="text">
      <!-- <i class="fa-solid fa-calendar"></i> -->
      @if($errors->has('schedule_2_payment_date'))
      <span class="text-danger">{{$errors->first('schedule_2_payment_date')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">  
      <label class="sub-label">Sale Date</label>
      <input name="schedule_2_sale_date" class="member_joining form-control" @if($Personalloanform) value="{{ $Personalloanform->schedule_2_sale_date }}" @else value="{{ old('schedule_2_sale_date') }}" @endif type="text">
     <!--  <i class="fa-solid fa-calendar"></i> -->
      @if($errors->has('schedule_2_sale_date'))
      <span class="text-danger">{{$errors->first('schedule_2_sale_date')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">  
      <label class="sub-label">Cut Off Time</label>
      <input name="schedule_2_cut_off_time" class="member_joining form-control" @if($Personalloanform) value="{{ $Personalloanform->schedule_2_cut_off_time }}" @else value="{{ old('schedule_2_cut_off_time') }}" @endif type="text">
   <!--    <i class="fa-solid fa-calendar"></i> -->
      @if($errors->has('schedule_2_cut_off_time'))
      <span class="text-danger">{{$errors->first('schedule_2_cut_off_time')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12">
    <label style="font-size: 17px;font-weight: 500;margin-bottom: 0px;">Annexure (For Debt Settlement “Buyout” Cases Only)</label>
  </div>

  <div class="col-md-6">
    <div class="form-group">  
      <label class="sub-label">Date</label>
      <input name="annexure_date" class="member_joining form-control" @if($Personalloanform) value="{{ $Personalloanform->annexure_date }}" @else value="{{ old('annexure_date') }}" @endif type="text">
      <!-- <i class="fa-solid fa-calendar"></i> -->
      @if($errors->has('annexure_date'))
      <span class="text-danger">{{$errors->first('annexure_date')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">  
      <label class="sub-label">Ei Reference</label>
      <input name="annexure_ei_reference" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->annexure_ei_reference }}" @else value="{{ old('annexure_ei_reference') }}" @endif type="text">
      @if($errors->has('annexure_ei_reference'))
      <span class="text-danger">{{$errors->first('annexure_ei_reference')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">  
      <label class="sub-label">Takaful Fees (Aed)</label>
      <input name="annexure_takaful_fees" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->annexure_takaful_fees }}" @else value="{{ old('annexure_takaful_fees') }}" @endif type="number">
      @if($errors->has('annexure_takaful_fees'))
      <span class="text-danger">{{$errors->first('annexure_takaful_fees')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">  
      <label class="sub-label">Processing Fees (Aed)</label>
      <input name="annexure_processing_fees" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->annexure_processing_fees }}" @else value="{{ old('annexure_processing_fees') }}" @endif type="number">
      @if($errors->has('annexure_processing_fees'))
      <span class="text-danger">{{$errors->first('annexure_processing_fees')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">  
      <label class="sub-label">Trading Fees (Aed)</label>
      <input name="annexure_trading_fees" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->annexure_trading_fees }}" @else value="{{ old('annexure_trading_fees') }}" @endif type="number">
      @if($errors->has('annexure_trading_fees'))
      <span class="text-danger">{{$errors->first('annexure_trading_fees')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">  
      <label class="sub-label">Account Number</label>
      <input name="annexure_account_number" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->annexure_account_number }}" @else value="{{ old('annexure_account_number') }}" @endif type="number">
      @if($errors->has('annexure_account_number'))
      <span class="text-danger">{{$errors->first('annexure_account_number')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">  
      <label class="sub-label">Collect Original Clearance Letter From</label>
      <input name="annexure_collect_original_clearance" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->annexure_collect_original_clearance }}" @else value="{{ old('annexure_collect_original_clearance') }}" @endif type="text">
      @if($errors->has('annexure_collect_original_clearance'))
      <span class="text-danger">{{$errors->first('annexure_collect_original_clearance')}}</span>
      @endif
    </div>
  </div>

    <div class="col-md-6">
        <div class="form-group">  
          <label class="sub-label">Post Settlement Of My Liability Of Aed (Outgoing Bank)</label>
          <input name="annexure_post_settlement" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->annexure_post_settlement }}" @else value="{{ old('annexure_post_settlement') }}" @endif type="text">
          @if($errors->has('annexure_post_settlement'))
          <span class="text-danger">{{$errors->first('annexure_post_settlement')}}</span>
          @endif
        </div>
    </div>

    <div class="col-md-12">
    <label style="font-size: 17px;font-weight: 500;margin-bottom: 0px;">Customer Undertaking</label>
    </div>
    <div class="col-md-6">
        <div class="form-group">  
          <label class="sub-label">Liability From</label>
          <input name="liability_from" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->liability_from }}" @else value="{{ old('liability_from') }}" @endif type="text">
          @if($errors->has('liability_from'))
          <span class="text-danger">{{$errors->first('liability_from')}}</span>
          @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">  
          <label class="sub-label">The Outgoing Bank Name &Final Settlement Of The Outstanding</label>
          <input name="outgoing_bank_name" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->outgoing_bank_name }}" @else value="{{ old('outgoing_bank_name') }}" @endif type="text">
          @if($errors->has('outgoing_bank_name'))
          <span class="text-danger">{{$errors->first('outgoing_bank_name')}}</span>
          @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">  
          <label class="sub-label">Salary For The Month Of</label>
          <input name="salary_for_the_month" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->salary_for_the_month }}" @else value="{{ old('salary_for_the_month') }}" @endif type="text">
          @if($errors->has('salary_for_the_month'))
          <span class="text-danger">{{$errors->first('salary_for_the_month')}}</span>
          @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">  
          <label class="sub-label">Debit Emi Account No.</label>
          <input name="debit_emi_account_no" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->debit_emi_account_no }}" @else value="{{ old('debit_emi_account_no') }}" @endif type="number">
          @if($errors->has('debit_emi_account_no'))
          <span class="text-danger">{{$errors->first('debit_emi_account_no')}}</span>
          @endif
        </div>
    </div> 

  <div class="col-md-6">
    <div class="form-group">  
      <label class="sub-label">Account No.</label>
      <input name="customer_undertaking_account_no" class="form-control" @if($Personalloanform) value="{{ $Personalloanform->customer_undertaking_account_no }}" @else value="{{ old('customer_undertaking_account_no') }}" @endif type="number">
      @if($errors->has('customer_undertaking_account_no'))
      <span class="text-danger">{{$errors->first('customer_undertaking_account_no')}}</span>
      @endif
    </div>
    </div>  
    </div>
    </div>
    </div>
    </div>
    </div>

@endif
@endif

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
.print{
    display: none;
}

@media print {
.noPrint {
    display:none !important;
}
.print{
    display: block !important;
}
.col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12, .col, .col-auto, .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm, .col-sm-auto, .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12, .col-md, .col-md-auto, .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg, .col-lg-auto, .col-xl-1, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl, .col-xl-auto {
    position: relative;
    width: 100% !important;
    padding-right: 15px !important;
    padding-left: 15px !important;
}
.col-md-6 {
    flex: 0 0 50%;
    max-width: 50%;
}
.form-group {
    margin-bottom: 1rem;
}
.form-control {
    display: block;
    width: 100%;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.175rem 2.25rem 0.175rem 0.75rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1.5;
    background-color: #ffffff;
    background-clip: padding-box;
    border: 1px solid #e8e8f7;
    border-radius: 3px;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    height: 38px;
    border-radius: 5px;
}
.form-control {
    color: #000;
}
.row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}
.col-md-4 {
    flex: 0 0 33.33333%;
    max-width: 33.33333%;
}
.col-md-3 {
    flex: 0 0 25%;
    max-width: 25%;
}
.col-md-12 {
    flex: 0 0 100%;
    max-width: 100%;
}
.col-md-9 {
    flex: 0 0 75%;
    max-width: 75%;
}

@page { size: auto;  margin: 0mm; }


}


</style>

@stop





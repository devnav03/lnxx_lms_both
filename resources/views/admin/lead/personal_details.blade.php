@extends('admin.layouts.admin')
@php
    $route  = \Route::currentRouteName();    
@endphp
@section('content')

@php
if($result) {
  $sel_country = $result->nationality;
} else {
  $sel_country = '';
}
@endphp

<section class="personal_details">
<div class="container">  
<div class="row">  
<div class="col-md-10">
<div class="personal_details_box" style="margin-top: 20px;">
<!-- <h1 class="app_form_head">Application Form</h1>   -->
<h2 style="font-size: 22px; margin-bottom: 15px;">Personal Details <span style="float: right; color: #000; font-size: 14px;font-weight: 600;">(*Mandatory)</span></h2>
<!-- <h6 style="margin-top: 12px;margin-bottom: 15px;">Please enter your information to check the offer.</h6> -->
<form action="{{ route('admin.cm-details', $user_id) }}" enctype="multipart/form-data" method="post">
{{ csrf_field() }}  
<div class="row">  
<!-- <div class="col-md-12">
<label>Name As Per Passport</label>
</div> -->
<div class="col-md-2">
  <label class="sub-label">Salutation*</label>
  <select name="salutation" class="form-control" required="true">
    <option value="Mr." @if($user->salutation == 'Mr.') selected @endif >Mr.</option>
    <option value="Mrs." @if($user->salutation == 'Mrs.') selected @endif>Mrs.</option>
    <option value="Miss." @if($user->salutation == 'Miss.') selected @endif>Miss</option>
    <option value="Dr." @if($user->salutation == 'Dr.') selected @endif>Dr.</option>
    <option value="Prof." @if($user->salutation == 'Prof.') selected @endif>Prof.</option>
    <option value="Rev." @if($user->salutation == 'Rev.') selected @endif>Rev.</option>
    <option value="Other" @if($user->salutation == 'Other') selected @endif>Other</option>
  </select>
</div>
<div class="col-md-10">
  <div class="row">  
    <div class="col-md-4">
      <div class="form-group">
        <label class="sub-label">First Name*</label>
        <input name="first_name_as_per_passport" maxlength="16" class="form-control" value="{{ $user->name }}" type="text" pattern="(?=^.{2,25}$)(?![.\n])(?=.*[a-zA-Z]).*$" required="true">
        @if($errors->has('first_name_as_per_passport'))
        <span class="text-danger">{{$errors->first('first_name_as_per_passport')}}</span>
        @endif
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label class="sub-label">Middle Name</label>
        <input name="middle_name" class="form-control" maxlength="16" value="{{ $user->middle_name }}" type="text" pattern="(?=^.{2,25}$)(?![.\n])(?=.*[a-zA-Z]).*$">
        @if($errors->has('middle_name'))
        <span class="text-danger">{{$errors->first('middle_name')}}</span>
        @endif
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label class="sub-label">Last Name*</label>
        <input name="last_name" required="true" maxlength="16" class="form-control" value="{{ $user->last_name }}" type="text" pattern="(?=^.{2,25}$)(?![.\n])(?=.*[a-zA-Z]).*$">
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
      <label class="sub-label">DOB*</label> 
      <input name="date_of_birth" class="form-control" id="my_date_picker_dob" @if($result) value="{{ $user->date_of_birth }}" @else  value="{{ old('date_of_birth') }}" @endif type="text" required="true">
      <i style="position: absolute; top: 42px; right: 30px;" class="ti-calendar sidemenu-icon menu-icon"></i>
      @if($errors->has('date_of_birth'))
        <span class="text-danger">{{$errors->first('date_of_birth')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <label class="sub-label">Gender*</label>  
    <select name="gender" class="form-control" required="true">
    <option value="">Select</option>  
    <option value="Male" @if($user->gender == 'Male') selected @endif>Male</option>
    <option value="Female" @if($user->gender == 'Female') selected @endif>Female</option>
    <option value="Other" @if($user->gender == 'Other') selected @endif>Other</option>
    </select>
    @if($errors->has('gender'))
    <span class="text-danger">{{$errors->first('gender')}}</span>
    @endif
  </div>

  <div class="col-md-6">
    <div class="form-group">
    <label class="sub-label">Nationality*</label>
    <select name="nationality" onChange="ChangeCountry(this);" class="form-control" required="true">
        <option value="">Select</option>
        @foreach($countries as $country)
          <option value="{{ $country->id }}" @if($result) @if($result->nationality == $country->id) selected @endif @endif >{{ $country->country_name }}</option>
        @endforeach
      </select>
      @if($errors->has('nationality'))
      <span class="text-danger">{{$errors->first('nationality')}}</span>
      @endif
    </div>
  </div>

<div class="col-md-6" id="years_in_uae_div" @if($sel_country == 229) style="display: none;" @endif>
      <label class="sub-label">No. of Years in UAE*</label>
      <input name="years_in_uae" maxlength="2" pattern="\d*" id="years_in_uae" class="form-control" @if($sel_country != 229) required="true" @endif   @if($result) value="{{ $result->years_in_uae }}" @else value="{{ old('years_in_uae') }}" @endif type="text">
      @if($errors->has('years_in_uae'))
      <span class="text-danger">{{$errors->first('years_in_uae')}}</span>
      @endif
  </div>

  <div class="col-md-6">
    <label class="sub-label">Marital Status*</label>
    <select name="marital_status" onChange="MaritalStatus(this);" class="form-control" required="true">
      <option value="Single" @if($result) @if($result->marital_status == "Single") selected @endif @endif >Single</option>
      <option value="Married" @if($result) @if($result->marital_status == "Married") selected @endif @endif >Married</option>
      <option value="Others" @if($result) @if($result->marital_status == "Others") selected @endif @endif >Others</option>
    </select>
  </div>

  <div class="col-md-6 wife_name" @if($result) @if($result->marital_status != "Married") style="display: none;" @endif @else style="display: none;" @endif >
    <div class="form-group">
      <label class="sub-label">Spouse Name*</label>
      <input name="wife_name" class="form-control" @if($result) @if($result->marital_status == "Married") required="true" @endif value="{{ $result->wife_name }}" @else value="{{ old('wife_name') }}" @endif type="text">
      @if($errors->has('wife_name'))
      <span class="text-danger">{{$errors->first('wife_name')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6 wife_name" @if($result) @if($result->marital_status != "Married") style="display: none;" @endif @else style="display: none;" @endif >
    <div class="form-group">
      <label class="sub-label">Spouse DOB*</label>
      <input name="spouse_date_of_birth" id="spouse_date_of_birth" class="form-control" @if($result) @if($result->marital_status == "Married") required="true" @endif value="{{ $result->spouse_date_of_birth }}" @else value="{{ old('spouse_date_of_birth') }}" @endif type="text">
      <i style="position: absolute; top: 42px; right: 30px;" class="ti-calendar sidemenu-icon menu-icon"></i>
      @if($errors->has('spouse_date_of_birth'))
      <span class="text-danger">{{$errors->first('spouse_date_of_birth')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6 wife_name" @if($result) @if($result->marital_status != "Married") style="display: none;" @endif @else style="display: none;" @endif >
    <div class="form-group">
      <label class="sub-label">Wedding Anniversary Date*</label>
      <input name="wedding_anniversary_date" id="date_of_joining" class="form-control" @if($result) @if($result->marital_status == "Married") required="true" @endif value="{{ $result->wedding_anniversary_date }}" @else value="{{ old('wedding_anniversary_date') }}" @endif type="text">
      <i style="position: absolute; top: 42px; right: 30px;" class="ti-calendar sidemenu-icon menu-icon"></i>
      @if($errors->has('wedding_anniversary_date'))
      <span class="text-danger">{{ $errors->first('wedding_anniversary_date') }}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">No. of Dependents*</label>
      <select name="no_of_dependents" onChange="NoOfDependents(this);" class="form-control" required="true">
        <option value="">Select</option>
        <option value="0" @if($result) @if($result->no_of_dependents == 0) selected @endif @endif >0</option>
        <option value="1" @if($result) @if($result->no_of_dependents == 1) selected @endif @endif>1</option>
        <option value="2" @if($result) @if($result->no_of_dependents == 2) selected @endif @endif>2</option>
        <option value="3" @if($result) @if($result->no_of_dependents == 3) selected @endif @endif>3</option>
        <option value="4" @if($result) @if($result->no_of_dependents == 4) selected @endif @endif>4</option>
        <option value="5" @if($result) @if($result->no_of_dependents == 5) selected @endif @endif>5</option>
        <option value="6" @if($result) @if($result->no_of_dependents == 6) selected @endif @endif>6</option>
        <option value="7" @if($result) @if($result->no_of_dependents == 7) selected @endif @endif>7</option>
        <option value="8" @if($result) @if($result->no_of_dependents == 8) selected @endif @endif>8</option>
        <option value="9" @if($result) @if($result->no_of_dependents == 9) selected @endif @endif>9</option>
        <option value="10" @if($result) @if($result->no_of_dependents == 10) selected @endif @endif>10</option>
        <option value="11" @if($result) @if($result->no_of_dependents == 11) selected @endif @endif>11</option>
        <option value="12" @if($result) @if($result->no_of_dependents == 12) selected @endif @endif>12</option>
      </select>
      @if($errors->has('no_of_dependents'))
      <span class="text-danger">{{$errors->first('no_of_dependents')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-12 family1" @if($result) @if($result->no_of_dependents == 0) style="display: none;" @endif @else style="display: none;" @endif >
      <label style="color: #000; font-weight: 600;" class="sub-label">Dependents Name & Relation</label>
  </div>
@php
  $family = get_family_info_agent(0, $user_id);
@endphp

  <div class="col-md-6 family1" @if($result) @if($result->no_of_dependents == 0) style="display: none;" @endif @else style="display: none;" @endif >
    <div class="form-group">
      <label class="sub-label">Name</label>
      <input name="dependent_name[0]" class="form-control" @if($family) value="{{ $family->name }}" @else value="{{ old('dependent_name') }}" @endif type="text">
      @if($errors->has('dependent_name'))
      <span class="text-danger">{{$errors->first('dependent_name')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6 family1" @if($result) @if($result->no_of_dependents == 0) style="display: none;" @endif @else style="display: none;" @endif >
    <div class="form-group">
      <label class="sub-label">Relation</label>
      <select name="dependent_relation[0]" @if($family) @endif class="form-control">
        <option value="">Select</option>
        <option value="Father" @if($family) @if($family->relation == "Father") selected @endif @endif >Father</option>
        <option value="Mother" @if($family) @if($family->relation == "Mother") selected @endif @endif>Mother</option>
        <option value="Son" @if($family) @if($family->relation == "Son") selected @endif @endif>Son</option>
        <option value="Daughter" @if($family) @if($family->relation == "Daughter") selected @endif @endif >Daughter</option>
        <option value="Brother" @if($family) @if($family->relation == "Brother") selected @endif @endif >Brother</option>
        <option value="Sister" @if($family) @if($family->relation == "Sister") selected @endif @endif>Sister</option>
        <option value="Grandfather" @if($family) @if($family->relation == "Grandfather") selected @endif @endif>Grandfather</option>
        <option value="Grandmother" @if($family) @if($family->relation == "Grandmother") selected @endif @endif>Grandmother</option>
        <option value="Uncle" @if($family) @if($family->relation == "Uncle") selected @endif @endif>Uncle</option>
        <option value="Aunt" @if($family) @if($family->relation == "Aunt") selected @endif @endif >Aunt</option>
        <option value="Cousin" @if($family) @if($family->relation == "Cousin") selected @endif @endif>Cousin</option>
        <option value="Nephew" @if($family) @if($family->relation == "Nephew") selected @endif @endif>Nephew</option>
        <option value="Niece" @if($family) @if($family->relation == "Niece") selected @endif @endif >Niece</option>
        <option value="Husband" @if($family) @if($family->relation == "Husband") selected @endif @endif >Husband</option>
        <option value="Wife" @if($family) @if($family->relation == "Wife") selected @endif @endif >Wife</option>
      </select>
    </div>
  </div>
@php
  $family = get_family_info_agent(1, $user_id);
@endphp
  <div class="col-md-6 family2" @if($result) @if($result->no_of_dependents >= 2) @else style="display: none;" @endif @else style="display: none;" @endif >
    <div class="form-group">
      <label class="sub-label">Name</label>
      <input name="dependent_name[1]" class="form-control" @if($family) value="{{ $family->name }}" @else value="{{ old('dependent_name') }}" @endif type="text">
      @if($errors->has('dependent_name'))
      <span class="text-danger">{{$errors->first('dependent_name')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6 family2" @if($result) @if($result->no_of_dependents >= 2) @else style="display: none;" @endif @else style="display: none;" @endif>
    <div class="form-group">
      <label class="sub-label">Relation</label>
      <select name="dependent_relation[1]" @if($family) @endif class="form-control">
        <option value="">Select</option>
         <option value="Father" @if($family) @if($family->relation == "Father") selected @endif @endif >Father</option>
        <option value="Mother" @if($family) @if($family->relation == "Mother") selected @endif @endif>Mother</option>
        <option value="Son" @if($family) @if($family->relation == "Son") selected @endif @endif>Son</option>
        <option value="Daughter" @if($family) @if($family->relation == "Daughter") selected @endif @endif >Daughter</option>
        <option value="Brother" @if($family) @if($family->relation == "Brother") selected @endif @endif >Brother</option>
        <option value="Sister" @if($family) @if($family->relation == "Sister") selected @endif @endif>Sister</option>
        <option value="Grandfather" @if($family) @if($family->relation == "Grandfather") selected @endif @endif>Grandfather</option>
        <option value="Grandmother" @if($family) @if($family->relation == "Grandmother") selected @endif @endif>Grandmother</option>
        <option value="Uncle" @if($family) @if($family->relation == "Uncle") selected @endif @endif>Uncle</option>
        <option value="Aunt" @if($family) @if($family->relation == "Aunt") selected @endif @endif >Aunt</option>
        <option value="Cousin" @if($family) @if($family->relation == "Cousin") selected @endif @endif>Cousin</option>
        <option value="Nephew" @if($family) @if($family->relation == "Nephew") selected @endif @endif>Nephew</option>
        <option value="Niece" @if($family) @if($family->relation == "Niece") selected @endif @endif >Niece</option>
        <option value="Husband" @if($family) @if($family->relation == "Husband") selected @endif @endif >Husband</option>
        <option value="Wife" @if($family) @if($family->relation == "Wife") selected @endif @endif >Wife</option>
      </select>
    </div>
  </div>
@php
  $family = get_family_info_agent(2, $user_id);
@endphp
  <div class="col-md-6 family3" @if($result) @if($result->no_of_dependents >= 3) @else style="display: none;" @endif @else style="display: none;" @endif>
    <div class="form-group">
      <label class="sub-label">Name</label>
      <input name="dependent_name[2]" class="form-control" @if($family) value="{{ $family->name }}" @else value="{{ old('dependent_name') }}" @endif type="text">
      @if($errors->has('dependent_name'))
      <span class="text-danger">{{$errors->first('dependent_name')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6 family3" @if($result) @if($result->no_of_dependents >= 3) @else style="display: none;" @endif @else style="display: none;" @endif>
    <div class="form-group">
      <label class="sub-label">Relation</label>
      <select name="dependent_relation[2]" @if($family) @endif class="form-control">
        <option value="">Select</option>
         <option value="Father" @if($family) @if($family->relation == "Father") selected @endif @endif >Father</option>
        <option value="Mother" @if($family) @if($family->relation == "Mother") selected @endif @endif>Mother</option>
        <option value="Son" @if($family) @if($family->relation == "Son") selected @endif @endif>Son</option>
        <option value="Daughter" @if($family) @if($family->relation == "Daughter") selected @endif @endif >Daughter</option>
        <option value="Brother" @if($family) @if($family->relation == "Brother") selected @endif @endif >Brother</option>
        <option value="Sister" @if($family) @if($family->relation == "Sister") selected @endif @endif>Sister</option>
        <option value="Grandfather" @if($family) @if($family->relation == "Grandfather") selected @endif @endif>Grandfather</option>
        <option value="Grandmother" @if($family) @if($family->relation == "Grandmother") selected @endif @endif>Grandmother</option>
        <option value="Uncle" @if($family) @if($family->relation == "Uncle") selected @endif @endif>Uncle</option>
        <option value="Aunt" @if($family) @if($family->relation == "Aunt") selected @endif @endif >Aunt</option>
        <option value="Cousin" @if($family) @if($family->relation == "Cousin") selected @endif @endif>Cousin</option>
        <option value="Nephew" @if($family) @if($family->relation == "Nephew") selected @endif @endif>Nephew</option>
        <option value="Niece" @if($family) @if($family->relation == "Niece") selected @endif @endif >Niece</option>
        <option value="Husband" @if($family) @if($family->relation == "Husband") selected @endif @endif >Husband</option>
        <option value="Wife" @if($family) @if($family->relation == "Wife") selected @endif @endif >Wife</option>
      </select>
    </div>
  </div>
@php
  $family = get_family_info_agent(3, $user_id);
@endphp
  <div class="col-md-6 family4" @if($result) @if($result->no_of_dependents >= 4) @else style="display: none;" @endif @else style="display: none;" @endif>
    <div class="form-group">
      <label class="sub-label">Name</label>
      <input name="dependent_name[3]" class="form-control" @if($family) value="{{ $family->name }}" @else value="{{ old('dependent_name') }}" @endif type="text">
      @if($errors->has('dependent_name'))
      <span class="text-danger">{{$errors->first('dependent_name')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6 family4" @if($result) @if($result->no_of_dependents >= 4) @else style="display: none;" @endif @else style="display: none;" @endif>
    <div class="form-group">
      <label class="sub-label">Relation</label>
      <select name="dependent_relation[3]" @if($family) @endif class="form-control">
        <option value="">Select</option>
        <option value="Father" @if($family) @if($family->relation == "Father") selected @endif @endif >Father</option>
        <option value="Mother" @if($family) @if($family->relation == "Mother") selected @endif @endif>Mother</option>
        <option value="Son" @if($family) @if($family->relation == "Son") selected @endif @endif>Son</option>
        <option value="Daughter" @if($family) @if($family->relation == "Daughter") selected @endif @endif >Daughter</option>
        <option value="Brother" @if($family) @if($family->relation == "Brother") selected @endif @endif >Brother</option>
        <option value="Sister" @if($family) @if($family->relation == "Sister") selected @endif @endif>Sister</option>
        <option value="Grandfather" @if($family) @if($family->relation == "Grandfather") selected @endif @endif>Grandfather</option>
        <option value="Grandmother" @if($family) @if($family->relation == "Grandmother") selected @endif @endif>Grandmother</option>
        <option value="Uncle" @if($family) @if($family->relation == "Uncle") selected @endif @endif>Uncle</option>
        <option value="Aunt" @if($family) @if($family->relation == "Aunt") selected @endif @endif >Aunt</option>
        <option value="Cousin" @if($family) @if($family->relation == "Cousin") selected @endif @endif>Cousin</option>
        <option value="Nephew" @if($family) @if($family->relation == "Nephew") selected @endif @endif>Nephew</option>
        <option value="Niece" @if($family) @if($family->relation == "Niece") selected @endif @endif >Niece</option>
        <option value="Husband" @if($family) @if($family->relation == "Husband") selected @endif @endif >Husband</option>
        <option value="Wife" @if($family) @if($family->relation == "Wife") selected @endif @endif >Wife</option>
      </select>
    </div>
  </div>
@php
  $family = get_family_info_agent(4, $user_id);
@endphp
  <div class="col-md-6 family5" @if($result) @if($result->no_of_dependents >= 5) @else style="display: none;" @endif @else style="display: none;" @endif>
    <div class="form-group">
      <label class="sub-label">Name</label>
      <input name="dependent_name[4]" class="form-control" @if($family) value="{{ $family->name }}" @else value="{{ old('dependent_name') }}" @endif type="text">
      @if($errors->has('dependent_name'))
      <span class="text-danger">{{$errors->first('dependent_name')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6 family5" @if($result) @if($result->no_of_dependents >= 5) @else style="display: none;" @endif @else style="display: none;" @endif>
    <div class="form-group">
      <label class="sub-label">Relation</label>
      <select name="dependent_relation[4]" @if($family) @endif class="form-control">
        <option value="">Select</option>
        <option value="Father" @if($family) @if($family->relation == "Father") selected @endif @endif >Father</option>
        <option value="Mother" @if($family) @if($family->relation == "Mother") selected @endif @endif>Mother</option>
        <option value="Son" @if($family) @if($family->relation == "Son") selected @endif @endif>Son</option>
        <option value="Daughter" @if($family) @if($family->relation == "Daughter") selected @endif @endif >Daughter</option>
        <option value="Brother" @if($family) @if($family->relation == "Brother") selected @endif @endif >Brother</option>
        <option value="Sister" @if($family) @if($family->relation == "Sister") selected @endif @endif>Sister</option>
        <option value="Grandfather" @if($family) @if($family->relation == "Grandfather") selected @endif @endif>Grandfather</option>
        <option value="Grandmother" @if($family) @if($family->relation == "Grandmother") selected @endif @endif>Grandmother</option>
        <option value="Uncle" @if($family) @if($family->relation == "Uncle") selected @endif @endif>Uncle</option>
        <option value="Aunt" @if($family) @if($family->relation == "Aunt") selected @endif @endif >Aunt</option>
        <option value="Cousin" @if($family) @if($family->relation == "Cousin") selected @endif @endif>Cousin</option>
        <option value="Nephew" @if($family) @if($family->relation == "Nephew") selected @endif @endif>Nephew</option>
        <option value="Niece" @if($family) @if($family->relation == "Niece") selected @endif @endif >Niece</option>
        <option value="Husband" @if($family) @if($family->relation == "Husband") selected @endif @endif >Husband</option>
        <option value="Wife" @if($family) @if($family->relation == "Wife") selected @endif @endif >Wife</option>
      </select>
    </div>
  </div>
@php
  $family = $family = get_family_info_agent(5, $user_id);
@endphp
  <div class="col-md-6 family6" @if($result) @if($result->no_of_dependents >= 6) @else style="display: none;" @endif @else style="display: none;" @endif>
    <div class="form-group">
      <label class="sub-label">Name</label>
      <input name="dependent_name[5]" class="form-control" @if($family) value="{{ $family->name }}" @else value="{{ old('dependent_name') }}" @endif type="text">
      @if($errors->has('dependent_name'))
      <span class="text-danger">{{$errors->first('dependent_name')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6 family6" @if($result) @if($result->no_of_dependents >= 6) @else style="display: none;" @endif @else style="display: none;" @endif>
    <div class="form-group">
      <label class="sub-label">Relation</label>
      <select name="dependent_relation[5]" @if($family) @endif class="form-control">
        <option value="">Select</option>
        <option value="Father" @if($family) @if($family->relation == "Father") selected @endif @endif >Father</option>
        <option value="Mother" @if($family) @if($family->relation == "Mother") selected @endif @endif>Mother</option>
        <option value="Son" @if($family) @if($family->relation == "Son") selected @endif @endif>Son</option>
        <option value="Daughter" @if($family) @if($family->relation == "Daughter") selected @endif @endif >Daughter</option>
        <option value="Brother" @if($family) @if($family->relation == "Brother") selected @endif @endif >Brother</option>
        <option value="Sister" @if($family) @if($family->relation == "Sister") selected @endif @endif>Sister</option>
        <option value="Grandfather" @if($family) @if($family->relation == "Grandfather") selected @endif @endif>Grandfather</option>
        <option value="Grandmother" @if($family) @if($family->relation == "Grandmother") selected @endif @endif>Grandmother</option>
        <option value="Uncle" @if($family) @if($family->relation == "Uncle") selected @endif @endif>Uncle</option>
        <option value="Aunt" @if($family) @if($family->relation == "Aunt") selected @endif @endif >Aunt</option>
        <option value="Cousin" @if($family) @if($family->relation == "Cousin") selected @endif @endif>Cousin</option>
        <option value="Nephew" @if($family) @if($family->relation == "Nephew") selected @endif @endif>Nephew</option>
        <option value="Niece" @if($family) @if($family->relation == "Niece") selected @endif @endif >Niece</option>
        <option value="Husband" @if($family) @if($family->relation == "Husband") selected @endif @endif >Husband</option>
        <option value="Wife" @if($family) @if($family->relation == "Wife") selected @endif @endif >Wife</option>
      </select>
    </div>
  </div>
@php
  $family = $family = get_family_info_agent(6, $user_id);;
@endphp
  <div class="col-md-6 family7" @if($result) @if($result->no_of_dependents >= 7) @else style="display: none;" @endif @else style="display: none;" @endif>
    <div class="form-group">
      <label class="sub-label">Name</label>
      <input name="dependent_name[6]" class="form-control" @if($family) value="{{ $family->name }}" @else value="{{ old('dependent_name') }}" @endif type="text">
      @if($errors->has('dependent_name'))
      <span class="text-danger">{{$errors->first('dependent_name')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6 family7" @if($result) @if($result->no_of_dependents >= 7) @else style="display: none;" @endif @else style="display: none;" @endif>
    <div class="form-group">
      <label class="sub-label">Relation</label>
      <select name="dependent_relation[6]" @if($family) @endif class="form-control">
        <option value="">Select</option>
        <option value="Father" @if($family) @if($family->relation == "Father") selected @endif @endif >Father</option>
        <option value="Mother" @if($family) @if($family->relation == "Mother") selected @endif @endif>Mother</option>
        <option value="Son" @if($family) @if($family->relation == "Son") selected @endif @endif>Son</option>
        <option value="Daughter" @if($family) @if($family->relation == "Daughter") selected @endif @endif >Daughter</option>
        <option value="Brother" @if($family) @if($family->relation == "Brother") selected @endif @endif >Brother</option>
        <option value="Sister" @if($family) @if($family->relation == "Sister") selected @endif @endif>Sister</option>
        <option value="Grandfather" @if($family) @if($family->relation == "Grandfather") selected @endif @endif>Grandfather</option>
        <option value="Grandmother" @if($family) @if($family->relation == "Grandmother") selected @endif @endif>Grandmother</option>
        <option value="Uncle" @if($family) @if($family->relation == "Uncle") selected @endif @endif>Uncle</option>
        <option value="Aunt" @if($family) @if($family->relation == "Aunt") selected @endif @endif >Aunt</option>
        <option value="Cousin" @if($family) @if($family->relation == "Cousin") selected @endif @endif>Cousin</option>
        <option value="Nephew" @if($family) @if($family->relation == "Nephew") selected @endif @endif>Nephew</option>
        <option value="Niece" @if($family) @if($family->relation == "Niece") selected @endif @endif >Niece</option>
        <option value="Husband" @if($family) @if($family->relation == "Husband") selected @endif @endif >Husband</option>
        <option value="Wife" @if($family) @if($family->relation == "Wife") selected @endif @endif >Wife</option>
      </select>
    </div>
  </div>
@php
  $family = get_family_info_agent(7, $user_id);
@endphp
  <div class="col-md-6 family8" @if($result) @if($result->no_of_dependents >= 8) @else style="display: none;" @endif @else style="display: none;" @endif>
    <div class="form-group">
      <label class="sub-label">Name</label>
      <input name="dependent_name[7]" class="form-control" @if($family) value="{{ $family->name }}" @else value="{{ old('dependent_name') }}" @endif type="text">
      @if($errors->has('dependent_name'))
      <span class="text-danger">{{$errors->first('dependent_name')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6 family8" @if($result) @if($result->no_of_dependents >= 8) @else style="display: none;" @endif @else style="display: none;" @endif>
    <div class="form-group">
      <label class="sub-label">Relation</label>
      <select name="dependent_relation[7]" @if($family) @endif class="form-control">
        <option value="">Select</option>
        <option value="Father" @if($family) @if($family->relation == "Father") selected @endif @endif >Father</option>
        <option value="Mother" @if($family) @if($family->relation == "Mother") selected @endif @endif>Mother</option>
        <option value="Son" @if($family) @if($family->relation == "Son") selected @endif @endif>Son</option>
        <option value="Daughter" @if($family) @if($family->relation == "Daughter") selected @endif @endif >Daughter</option>
        <option value="Brother" @if($family) @if($family->relation == "Brother") selected @endif @endif >Brother</option>
        <option value="Sister" @if($family) @if($family->relation == "Sister") selected @endif @endif>Sister</option>
        <option value="Grandfather" @if($family) @if($family->relation == "Grandfather") selected @endif @endif>Grandfather</option>
        <option value="Grandmother" @if($family) @if($family->relation == "Grandmother") selected @endif @endif>Grandmother</option>
        <option value="Uncle" @if($family) @if($family->relation == "Uncle") selected @endif @endif>Uncle</option>
        <option value="Aunt" @if($family) @if($family->relation == "Aunt") selected @endif @endif >Aunt</option>
        <option value="Cousin" @if($family) @if($family->relation == "Cousin") selected @endif @endif>Cousin</option>
        <option value="Nephew" @if($family) @if($family->relation == "Nephew") selected @endif @endif>Nephew</option>
        <option value="Niece" @if($family) @if($family->relation == "Niece") selected @endif @endif >Niece</option>
        <option value="Husband" @if($family) @if($family->relation == "Husband") selected @endif @endif >Husband</option>
        <option value="Wife" @if($family) @if($family->relation == "Wife") selected @endif @endif >Wife</option>
      </select>
    </div>
  </div>
@php
  $family = get_family_info_agent(8, $user_id);
@endphp
  <div class="col-md-6 family9" @if($result) @if($result->no_of_dependents >= 9) @else style="display: none;" @endif @else style="display: none;" @endif>
    <div class="form-group">
      <label class="sub-label">Name</label>
      <input name="dependent_name[8]" class="form-control" @if($family) value="{{ $family->name }}" @else value="{{ old('dependent_name') }}" @endif type="text">
      @if($errors->has('dependent_name'))
      <span class="text-danger">{{$errors->first('dependent_name')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6 family9" @if($result) @if($result->no_of_dependents >= 9) @else style="display: none;" @endif @else style="display: none;" @endif>
    <div class="form-group">
      <label class="sub-label">Relation</label>
      <select name="dependent_relation[8]" @if($family) @endif class="form-control">
        <option value="">Select</option>
        <option value="Father" @if($family) @if($family->relation == "Father") selected @endif @endif >Father</option>
        <option value="Mother" @if($family) @if($family->relation == "Mother") selected @endif @endif>Mother</option>
        <option value="Son" @if($family) @if($family->relation == "Son") selected @endif @endif>Son</option>
        <option value="Daughter" @if($family) @if($family->relation == "Daughter") selected @endif @endif >Daughter</option>
        <option value="Brother" @if($family) @if($family->relation == "Brother") selected @endif @endif >Brother</option>
        <option value="Sister" @if($family) @if($family->relation == "Sister") selected @endif @endif>Sister</option>
        <option value="Grandfather" @if($family) @if($family->relation == "Grandfather") selected @endif @endif>Grandfather</option>
        <option value="Grandmother" @if($family) @if($family->relation == "Grandmother") selected @endif @endif>Grandmother</option>
        <option value="Uncle" @if($family) @if($family->relation == "Uncle") selected @endif @endif>Uncle</option>
        <option value="Aunt" @if($family) @if($family->relation == "Aunt") selected @endif @endif >Aunt</option>
        <option value="Cousin" @if($family) @if($family->relation == "Cousin") selected @endif @endif>Cousin</option>
        <option value="Nephew" @if($family) @if($family->relation == "Nephew") selected @endif @endif>Nephew</option>
        <option value="Niece" @if($family) @if($family->relation == "Niece") selected @endif @endif >Niece</option>
        <option value="Husband" @if($family) @if($family->relation == "Husband") selected @endif @endif >Husband</option>
        <option value="Wife" @if($family) @if($family->relation == "Wife") selected @endif @endif >Wife</option>
      </select>
    </div>
  </div>
@php
  $family = get_family_info_agent(9, $user_id);
@endphp
  <div class="col-md-6 family10" @if($result) @if($result->no_of_dependents >= 10) @else style="display: none;" @endif @else style="display: none;" @endif>
    <div class="form-group">
      <label class="sub-label">Name</label>
      <input name="dependent_name[9]" class="form-control" @if($family) value="{{ $family->name }}" @else value="{{ old('dependent_name') }}" @endif type="text">
      @if($errors->has('dependent_name'))
      <span class="text-danger">{{$errors->first('dependent_name')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6 family10" @if($result) @if($result->no_of_dependents >= 10) @else style="display: none;" @endif @else style="display: none;" @endif>
    <div class="form-group">
      <label class="sub-label">Relation</label>
      <select name="dependent_relation[9]" @if($family) @endif class="form-control">
        <option value="">Select</option>
        <option value="Father" @if($family) @if($family->relation == "Father") selected @endif @endif >Father</option>
        <option value="Mother" @if($family) @if($family->relation == "Mother") selected @endif @endif>Mother</option>
        <option value="Son" @if($family) @if($family->relation == "Son") selected @endif @endif>Son</option>
        <option value="Daughter" @if($family) @if($family->relation == "Daughter") selected @endif @endif >Daughter</option>
        <option value="Brother" @if($family) @if($family->relation == "Brother") selected @endif @endif >Brother</option>
        <option value="Sister" @if($family) @if($family->relation == "Sister") selected @endif @endif>Sister</option>
        <option value="Grandfather" @if($family) @if($family->relation == "Grandfather") selected @endif @endif>Grandfather</option>
        <option value="Grandmother" @if($family) @if($family->relation == "Grandmother") selected @endif @endif>Grandmother</option>
        <option value="Uncle" @if($family) @if($family->relation == "Uncle") selected @endif @endif>Uncle</option>
        <option value="Aunt" @if($family) @if($family->relation == "Aunt") selected @endif @endif >Aunt</option>
        <option value="Cousin" @if($family) @if($family->relation == "Cousin") selected @endif @endif>Cousin</option>
        <option value="Nephew" @if($family) @if($family->relation == "Nephew") selected @endif @endif>Nephew</option>
        <option value="Niece" @if($family) @if($family->relation == "Niece") selected @endif @endif >Niece</option>
        <option value="Husband" @if($family) @if($family->relation == "Husband") selected @endif @endif >Husband</option>
        <option value="Wife" @if($family) @if($family->relation == "Wife") selected @endif @endif >Wife</option>
      </select>
    </div>
  </div>
@php
  $family = get_family_info_agent(10, $user_id);
@endphp
  <div class="col-md-6 family11" @if($result) @if($result->no_of_dependents >= 11) @else style="display: none;" @endif @else style="display: none;" @endif>
    <div class="form-group">
      <label class="sub-label">Name</label>
      <input name="dependent_name[10]" class="form-control" @if($family) value="{{ $family->name }}" @else value="{{ old('dependent_name') }}" @endif type="text">
      @if($errors->has('dependent_name'))
      <span class="text-danger">{{$errors->first('dependent_name')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6 family11" @if($result) @if($result->no_of_dependents >= 11) @else style="display: none;" @endif @else style="display: none;" @endif>
    <div class="form-group">
      <label class="sub-label">Relation</label>
      <select name="dependent_relation[10]" @if($family) @endif class="form-control">
        <option value="">Select</option>
        <option value="Father" @if($family) @if($family->relation == "Father") selected @endif @endif >Father</option>
        <option value="Mother" @if($family) @if($family->relation == "Mother") selected @endif @endif>Mother</option>
        <option value="Son" @if($family) @if($family->relation == "Son") selected @endif @endif>Son</option>
        <option value="Daughter" @if($family) @if($family->relation == "Daughter") selected @endif @endif >Daughter</option>
        <option value="Brother" @if($family) @if($family->relation == "Brother") selected @endif @endif >Brother</option>
        <option value="Sister" @if($family) @if($family->relation == "Sister") selected @endif @endif>Sister</option>
        <option value="Grandfather" @if($family) @if($family->relation == "Grandfather") selected @endif @endif>Grandfather</option>
        <option value="Grandmother" @if($family) @if($family->relation == "Grandmother") selected @endif @endif>Grandmother</option>
        <option value="Uncle" @if($family) @if($family->relation == "Uncle") selected @endif @endif>Uncle</option>
        <option value="Aunt" @if($family) @if($family->relation == "Aunt") selected @endif @endif >Aunt</option>
        <option value="Cousin" @if($family) @if($family->relation == "Cousin") selected @endif @endif>Cousin</option>
        <option value="Nephew" @if($family) @if($family->relation == "Nephew") selected @endif @endif>Nephew</option>
        <option value="Niece" @if($family) @if($family->relation == "Niece") selected @endif @endif >Niece</option>
        <option value="Husband" @if($family) @if($family->relation == "Husband") selected @endif @endif >Husband</option>
        <option value="Wife" @if($family) @if($family->relation == "Wife") selected @endif @endif >Wife</option>
      </select>
    </div>
  </div>
@php
  $family = get_family_info_agent(11, $user_id);
@endphp
  <div class="col-md-6 family12" @if($result) @if($result->no_of_dependents >= 12) @else style="display: none;" @endif @else style="display: none;" @endif>
    <div class="form-group">
      <label class="sub-label">Name</label>
      <input name="dependent_name[11]" class="form-control" @if($family) value="{{ $family->name }}" @else value="{{ old('dependent_name') }}" @endif type="text">
      @if($errors->has('dependent_name'))
      <span class="text-danger">{{$errors->first('dependent_name')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6 family12" @if($result) @if($result->no_of_dependents >= 12) @else style="display: none;" @endif @else style="display: none;" @endif>
    <div class="form-group">
      <label class="sub-label">Relation</label>
      <select name="dependent_relation[11]" @if($family) @endif class="form-control">
        <option value="">Select</option>
        <option value="Father" @if($family) @if($family->relation == "Father") selected @endif @endif >Father</option>
        <option value="Mother" @if($family) @if($family->relation == "Mother") selected @endif @endif>Mother</option>
        <option value="Son" @if($family) @if($family->relation == "Son") selected @endif @endif>Son</option>
        <option value="Daughter" @if($family) @if($family->relation == "Daughter") selected @endif @endif >Daughter</option>
        <option value="Brother" @if($family) @if($family->relation == "Brother") selected @endif @endif >Brother</option>
        <option value="Sister" @if($family) @if($family->relation == "Sister") selected @endif @endif>Sister</option>
        <option value="Grandfather" @if($family) @if($family->relation == "Grandfather") selected @endif @endif>Grandfather</option>
        <option value="Grandmother" @if($family) @if($family->relation == "Grandmother") selected @endif @endif>Grandmother</option>
        <option value="Uncle" @if($family) @if($family->relation == "Uncle") selected @endif @endif>Uncle</option>
        <option value="Aunt" @if($family) @if($family->relation == "Aunt") selected @endif @endif >Aunt</option>
        <option value="Cousin" @if($family) @if($family->relation == "Cousin") selected @endif @endif>Cousin</option>
        <option value="Nephew" @if($family) @if($family->relation == "Nephew") selected @endif @endif>Nephew</option>
        <option value="Niece" @if($family) @if($family->relation == "Niece") selected @endif @endif >Niece</option>
        <option value="Husband" @if($family) @if($family->relation == "Husband") selected @endif @endif >Husband</option>
        <option value="Wife" @if($family) @if($family->relation == "Wife") selected @endif @endif >Wife</option>
      </select>
    </div>
  </div>

  <div class="col-md-6">
    <label class="sub-label">Are you assisted by an agent*</label>
    <select name="agent_reference" onChange="AgentReference(this);" class="form-control" required="true">
    <option value="">Select</option>
    <option value="1" @if($result) @if($result->agent_reference == 1) selected @endif @endif >Yes</option>
    <option value="0" @if($result) @if($result->agent_reference == 0) selected @endif @endif >No</option>
    </select>
  </div>

  <div class="col-md-6 agent_reference_number" @if($result) @if($result->agent_reference == 0) style="display: none;" @endif @else style="display: none;" @endif>
    <div class="form-group">
      <label class="sub-label">Enter the agent ref. number*</label>
      <input name="reference_number" class="form-control" maxlength="12" @if($result) value="{{ $result->reference_number }}" @else value="{{ old('reference_number') }}" @endif type="text">
      @if($errors->has('reference_number'))
      <span class="text-danger">{{$errors->first('reference_number')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Visa Number</label>
      <input name="visa_number" class="form-control" maxlength="16" @if($result) value="{{ $result->visa_number }}" @else value="{{ old('visa_number') }}" @endif type="text">
      @if($errors->has('visa_number'))
      <span class="text-danger">{{$errors->first('visa_number')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">AECB Credit Score</label>
      <input name="credit_score" pattern="\d*" maxlength="4" class="form-control" @if($result) value="{{ $result->credit_score }}" @else value="{{ old('credit_score') }}" @endif type="text">
      @if($errors->has('credit_score'))
      <span class="text-danger">{{$errors->first('credit_score')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6 aecb_date" @if(isset($result)) @if($result->credit_score == '') style="display: none;" @endif  @else style="display: none;" @endif >
    <div class="form-group">
      <label class="sub-label">Date (when the score was fetched)*</label>
      <input name="aecb_date" readonly="" class="form-control" id="aecb_date" @if($result) value="{{ $result->aecb_date }}" @else value="{{ old('aecb_date') }}" @endif type="text">
      <i style="position: absolute; top: 42px; right: 30px;" class="ti-calendar sidemenu-icon menu-icon"></i>
      @if($errors->has('aecb_date'))
      <span class="text-danger">{{$errors->first('aecb_date')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6 aecb_date" @if(isset($result)) @if($result->credit_score == '') style="display: none;" @endif  @else style="display: none;" @endif >
    <div class="form-group">
      <label class="sub-label" style="width: 100%;">AECB Credit Score Image*</label>
      <input name="aecb_image" style="box-shadow: none; margin-top: 3px;" type="file">
      @if($errors->has('aecb_image'))
      <span class="text-danger">{{$errors->first('aecb_image')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Work Email ID</label>
      <input name="officer_email" class="form-control" maxlength="40" @if($result) value="{{ $result->officer_email }}" @else value="{{ old('officer_email') }}" @endif type="email">
      @if($errors->has('officer_email'))
      <span class="text-danger">{{$errors->first('officer_email')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Emirates ID Number*</label>
      <input name="eid_number" pattern="\d*" class="form-control" maxlength="15" minlength="15" value="{{ $user->eid_number }}" required="true" type="text">
      @if($errors->has('eid_number'))
      <span class="text-danger">{{$errors->first('eid_number')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12"></div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Upload front photo of Emirates id <span style="font-size: 13px;">(allowed file types (.jpg, .jpeg, *.png only) with maximum size 2mb.)*</span></label>
      @if($user->emirates_id)
        <input type="file" accept="image/png, image/jpg, image/jpeg" id="imgInp" style="box-shadow: none; margin-top: 3px;" name="emirates_id_front">
        <img src="{!! asset($user->emirates_id) !!}" id="blah" class="img-responsive" style="margin-top: 10px;">
      @else
          <input type="file" required="true" accept="image/png, image/jpg, image/jpeg" id="imgInp" style="box-shadow: none; margin-top: 3px;" name="emirates_id_front">
          <img src="" id="blah" class="img-responsive">
      @endif
      @if($errors->has('emirates_id_front'))
        <span class="text-danger">{{$errors->first('emirates_id_front')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Upload back photo of Emirates id <span style="font-size: 13px;">(allowed file types (.jpg, .jpeg, *.png only) with maximum size 2mb.)*</span></label>
      @if($user->emirates_id_back)
        <input type="file" accept="image/png, image/jpg, image/jpeg" id="imgInp1" style="box-shadow: none; margin-top: 3px;" name="emirates_id_back">
         <img src="{!! asset($user->emirates_id_back) !!}" id="blah1" style="margin-top: 10px;" class="img-responsive">
      @else
        <input type="file" required="true" accept="image/png, image/jpg, image/jpeg" id="imgInp1" style="box-shadow: none; margin-top: 3px;" name="emirates_id_back">
        <img src="" id="blah1" class="img-responsive">
      @endif
      @if($errors->has('emirates_id_back'))
        <span class="text-danger">{{$errors->first('emirates_id_back')}}</span>
      @endif
    </div>
  </div>

  <!-- <div class="col-md-6">
    <label class="sub-label">Country</label>
    <select name="nationality" class="form-control" required="true">
      <option value="">Select</option>
      @foreach($countries as $country)
        <option value="{{ $country->id }}" @if(isset($result->nationality)) @if($result->nationality == $country->id) selected  @endif @else @if($country->id == 229) selected @endif @endif >{{ $country->country_name }}</option>
      @endforeach
    </select>
  </div> -->
  <!-- <div class="col-md-12">
    <label>Passport Details</label>
  </div> -->
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Passport Number*</label>
      <input name="passport_number" maxlength="16" class="form-control" required="true" @if($result) value="{{ $result->passport_number }}" @else value="{{ old('passport_number') }}" @endif type="text">
      @if($errors->has('passport_number'))
      <span class="text-danger">{{$errors->first('passport_number')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Passport Expiry Date*</label>
      <input name="passport_expiry_date" id="my_date_picker"  class="form-control" required="true" @if(isset($result->passport_expiry_date)) value="{{ $result->passport_expiry_date }}" @else value="{{ old('passport_expiry_date') }}" @endif type="text">
      <i style="position: absolute; top: 42px; right: 30px;" class="ti-calendar sidemenu-icon menu-icon"></i>
      @if($errors->has('passport_expiry_date'))
      <span class="text-danger">{{$errors->first('passport_expiry_date')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Upload passport photo <span style="font-size: 13px;">(allowed file types (.jpg, .jpeg, *.png only) with maximum size 2mb.)</span></label>
      @if(isset($result->passport_photo))
        <input type="file" accept="image/png, image/jpg, image/jpeg" id="imgInp2" style="box-shadow: none; margin-top: 3px;    width: 100%;
    margin-bottom: 10px;" name="passport_photo" >
        <img src="{!! asset($result->passport_photo) !!}" id="blah2" class="img-responsive" style="max-height: 110px;">
      @else
        <input type="file" required="true" accept="image/png, image/jpg, image/jpeg" id="imgInp2" style="box-shadow: none; margin-top: 3px;" name="passport_photo">
        <img src="" id="blah2" class="img-responsive" style="max-height: 110px;">
      @endif
      @if($errors->has('passport_photo'))
        <span class="text-danger">{{$errors->first('passport_photo')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Profile photo <span style="font-size: 13px;">(allowed file types (.jpg, .jpeg, *.png only) with maximum size 2mb.)</span></label>
      @if(isset($user->profile_image))
        <input type="file" accept="image/png, image/jpg, image/jpeg" id="imgInp5" style="box-shadow: none; margin-top: 3px;width: 100%; margin-bottom: 10px;" name="profile_image">
        <img src="{!! asset($user->profile_image) !!}" id="blah5" class="img-responsive" style="max-height: 110px;">
      @else
        <input type="file" required="true" accept="image/png, image/jpg, image/jpeg" id="imgInp5" style="box-shadow: none; margin-top: 3px;" name="profile_image">
        <img src="" id="blah5" class="img-responsive" style="max-height: 110px;">
      @endif
      @if($errors->has('profile_image'))
        <span class="text-danger">{{$errors->first('profile_image')}}</span>
      @endif
    </div>
  </div>


  <!--<div class="col-md-12">
    <label>Visa Details</label>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label class="sub-label">Visa Expiry Date</label>
      <input name="visa_expiry_date" class="form-control" onfocus="(this.type='date')" @if(isset($result->visa_expiry_date)) value="{{ $result->visa_expiry_date }}" @else value="{{ old('visa_expiry_date') }}" @endif type="text">
      @if($errors->has('visa_expiry_date'))
      <span class="text-danger">{{$errors->first('visa_expiry_date')}}</span>
      @endif
    </div>
  </div> -->

<!--   <div class="col-md-12">
    <label class="chk_bx" style="width: 100%; font-weight: normal; margin-bottom: 15px;"> @if($result) <input required="true" checked="" type="checkbox"> @else <input required="true" type="checkbox"> @endif By proceeding, you agree to the <a href="#">Terms and Conditions</a></label>
  </div> -->
  <div class="col-md-12 text-center">
    <a style="border: 1px solid #000;padding: 10px 30px;color: #000;" href="{{ route('get-started') }}/view-save-personal/{{ $user_id }}" class="back_btn">Back</a> &nbsp;&nbsp;
    <button type="submit" style="background: #000; color: #fff; padding: 8px 25px; margin-bottom: 35px;">Proceed</button>
  </div>
</div>
</form>
</div>
</div>

</div>
</div>
</section>

<script type="text/javascript">
  function ChangeCountry(that) {
    if (that.value == "229") {
        $("#years_in_uae_div").hide();
        // $(".show_hide").hide();
        $("#years_in_uae").removeAttr('required');
        // $(".Passport_img").removeAttr('required');

    } else {
        $("#years_in_uae_div").show();
        $("#years_in_uae").attr("required", true);
        // $(".Passport_img").attr("required", true); 
        // $(".show_hide").show();

    }
  }

  function AgentReference(that) {
    if (that.value == "1") {
      $(".agent_reference_number").show();
      $(".agent_reference_number input").attr("required", true);
    } else {
      $(".agent_reference_number").hide();
      $(".agent_reference_number input").removeAttr('required');
    }
  }

  function MaritalStatus(that) {
    if (that.value == "Married") {
      $(".wife_name").show();
      $(".wife_name input").attr("required", true);
    } else {
      $(".wife_name").hide();
      $(".wife_name input").removeAttr('required');
    }
  }

  function NoOfDependents(that) {
    if (that.value == "0") {
      $(".family1").hide();
      $(".family2").hide();
      $(".family3").hide();
      $(".family4").hide();
      $(".family5").hide();
      $(".family6").hide();
      $(".family7").hide();
      $(".family8").hide();
      $(".family9").hide();
      $(".family10").hide();
      $(".family11").hide();
      $(".family12").hide();

    } else if(that.value == "1") {
      $(".family1").show();
      $(".family2").hide();
      $(".family3").hide();
      $(".family4").hide();
      $(".family5").hide();
      $(".family6").hide();
      $(".family7").hide();
      $(".family8").hide();
      $(".family9").hide();
      $(".family10").hide();
      $(".family11").hide();
      $(".family12").hide();

    }  else if(that.value == "2") {
      $(".family1").show();
      $(".family2").show();
      $(".family3").hide();
      $(".family4").hide();
      $(".family5").hide();
      $(".family6").hide();
      $(".family7").hide();
      $(".family8").hide();
      $(".family9").hide();
      $(".family10").hide();
      $(".family11").hide();
      $(".family12").hide();

    } else if(that.value == "3") {
      $(".family1").show();
      $(".family2").show();
      $(".family3").show();
      $(".family4").hide();
      $(".family5").hide();
      $(".family6").hide();
      $(".family7").hide();
      $(".family8").hide();
      $(".family9").hide();
      $(".family10").hide();
      $(".family11").hide();
      $(".family12").hide();

    } else if(that.value == "4") {
      $(".family1").show();
      $(".family2").show();
      $(".family3").show();
      $(".family4").show();
      $(".family5").hide();
      $(".family6").hide();
      $(".family7").hide();
      $(".family8").hide();
      $(".family9").hide();
      $(".family10").hide();
      $(".family11").hide();
      $(".family12").hide();

    } else if(that.value == "5") {
      $(".family1").show();
      $(".family2").show();
      $(".family3").show();
      $(".family4").show();
      $(".family5").show();
      $(".family6").hide();
      $(".family7").hide();
      $(".family8").hide();
      $(".family9").hide();
      $(".family10").hide();
      $(".family11").hide();
      $(".family12").hide();

    } else if(that.value == "6") {
      $(".family1").show();
      $(".family2").show();
      $(".family3").show();
      $(".family4").show();
      $(".family5").show();
      $(".family6").show();
      $(".family7").hide();
      $(".family8").hide();
      $(".family9").hide();
      $(".family10").hide();
      $(".family11").hide();
      $(".family12").hide();

    } else if(that.value == "7") {
      $(".family1").show();
      $(".family2").show();
      $(".family3").show();
      $(".family4").show();
      $(".family5").show();
      $(".family6").show();
      $(".family7").show();
      $(".family8").hide();
      $(".family9").hide();
      $(".family10").hide();
      $(".family11").hide();
      $(".family12").hide();

    } else if(that.value == "8") {
      $(".family1").show();
      $(".family2").show();
      $(".family3").show();
      $(".family4").show();
      $(".family5").show();
      $(".family6").show();
      $(".family7").show();
      $(".family8").show();
      $(".family9").hide();
      $(".family10").hide();
      $(".family11").hide();
      $(".family12").hide();

    } else if(that.value == "9") {
      $(".family1").show();
      $(".family2").show();
      $(".family3").show();
      $(".family4").show();
      $(".family5").show();
      $(".family6").show();
      $(".family7").show();
      $(".family8").show();
      $(".family9").show();
      $(".family10").hide();
      $(".family11").hide();
      $(".family12").hide();

    } else if(that.value == "10") {
      $(".family1").show();
      $(".family2").show();
      $(".family3").show();
      $(".family4").show();
      $(".family5").show();
      $(".family6").show();
      $(".family7").show();
      $(".family8").show();
      $(".family9").show();
      $(".family10").show();
      $(".family11").hide();
      $(".family12").hide();

    } else if(that.value == "11") {
      $(".family1").show();
      $(".family2").show();
      $(".family3").show();
      $(".family4").show();
      $(".family5").show();
      $(".family6").show();
      $(".family7").show();
      $(".family8").show();
      $(".family9").show();
      $(".family10").show();
      $(".family11").show();
      $(".family12").hide();

    } else {
      $(".family1").show();
      $(".family2").show();
      $(".family3").show();
      $(".family4").show();
      $(".family5").show();
      $(".family6").show();
      $(".family7").show();
      $(".family8").show();
      $(".family9").show();
      $(".family10").show();
      $(".family11").show();
      $(".family12").show();

    }
  }
  

  $(function() {
    var maxBirthdayDate = new Date();
    maxBirthdayDate.setFullYear( maxBirthdayDate.getFullYear() - 18 );
    $( "#my_date_picker_dob" ).datepicker({
        "setDate": new Date(),
        "autoclose": true,
        dateFormat: 'dd/mm/yy', 
        maxDate: maxBirthdayDate,
        changeYear: true
    });
  });

  $(function() {
        $( "#my_date_picker" ).datepicker({
            "setDate": new Date(),
            "autoclose": true,
            minDate: 0,
            dateFormat: 'dd/mm/yy',
            changeYear: true
        });
  });
  
  $(function() {
        $( "#date_of_joining" ).datepicker({
            "setDate": new Date(),
            "autoclose": true,
            maxDate: 0,
            dateFormat: 'dd/mm/yy',
            changeYear: true
        });
  });

   $(function() {
        var maxBirthdayDate = new Date();
        maxBirthdayDate.setFullYear( maxBirthdayDate.getFullYear() - 18 );
        $( "#spouse_date_of_birth" ).datepicker({
            "setDate": new Date(),
            "autoclose": true,
            dateFormat: 'dd/mm/yy', 
            maxDate: maxBirthdayDate,
            changeYear: true
        });
    });

    $(function() {
        $( "#aecb_date" ).datepicker({
            "setDate": new Date(),
            "autoclose": true,
            maxDate: 0,
            dateFormat: 'dd/mm/yy',
            changeYear: true
        });
    });

    $('input[name=credit_score]').on('keyup' , function() { 
      var id = $("input[name=credit_score]").val();
      if( id.length == 0 ) {
          $(".aecb_date").hide();
          $(".aecb_date input").removeAttr('required'); 
      } else {
          $(".aecb_date").show();
          $(".aecb_date input").attr("required", true);
      }
    });


</script>

@endsection    
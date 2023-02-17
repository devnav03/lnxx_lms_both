<!DOCTYPE html>
@php
if($result) {
$sel_country = $result->nationality;
} else {
$sel_country = 229;
}
@endphp
<head class="wide wow-animation" lang="en">
<meta name="format-detection" content="telephone=no">
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="utf-8">
<meta name="csrf-token" content="{!! csrf_token() !!}" />
<link rel="icon" href="{!! asset('assets/frontend/images/favicon.png') !!}" type="image/png">
<meta name="csrf-token" content="{{ csrf_token() }}" />     
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inria+Sans:wght@300;400;700&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,500;1,700&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/956568d106.js" crossorigin="anonymous"></script>
{!! Html::style('assets/frontend/css/stellarnav.min.css') !!}

<link rel="stylesheet" href="fonts/flaticon/font/flaticon.css" />
{!! HTML::style('assets/frontend/css/jquery-ui.css') !!}
{!! HTML::style('assets/frontend/css/owl.carousel.min.css') !!}
{!! HTML::style('assets/frontend/css/owl.theme.default.min.css') !!}
{!! HTML::style('assets/frontend/css/jquery.fancybox.min.css') !!}
{!! HTML::style('assets/frontend/css/bootstrap-datepicker.css') !!}
{!! HTML::style('assets/frontend/fonts/flaticon/font/flaticon.css') !!}
<!-- {!! HTML::style('assets/frontend/css/bootstrap.min1.css') !!} -->
{!! HTML::style('assets/frontend/css/style.css') !!}
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="content-pages">
  <a id="button2"></a>
<section class="personal_details">
    <div class="container">
        <div class="row">
            <div class="col-md-7" id="personal-details">
                <div class="personal_details_box">
                    <form id="personal_detail" method="POST">
                    <h2>Personal Details</h2>
                    <h6>Please enter your information to check the offer.</h6>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Name As Per Passport</label>
                            </div>
                            <div class="col-md-2">
                                <label class="sub-label">Salutation*</label>
                                <select id="salutation" name="salutation" class="form-control" required="true">
                                    <option value="Mr." @if($user->salutation == 'Mr.') selected @endif >Mr.</option>
                                    <option value="Mrs." @if($user->salutation == 'Mrs.') selected @endif>Mrs.</option>
                                    <option value="Miss." @if($user->salutation == 'Miss.') selected @endif>Miss
                                    </option>
                                    <option value="Dr." @if($user->salutation == 'Dr.') selected @endif>Dr.</option>
                                    <option value="Prof." @if($user->salutation == 'Prof.') selected @endif>Prof.
                                    </option>
                                    <option value="Rev." @if($user->salutation == 'Rev.') selected @endif>Rev.</option>
                                    <option value="Other" @if($user->salutation == 'Other') selected @endif>Other
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="sub-label">First Name*</label>
                                            <input id="first_name_as_per_passport" name="first_name_as_per_passport" class="form-control"
                                                value="{{ $user->name }}" type="text"
                                                pattern="(?=^.{2,25}$)(?![.\n])(?=.*[a-zA-Z]).*$" required="true">
                                            @if($errors->has('first_name_as_per_passport'))
                                            <span
                                                class="text-danger">{{$errors->first('first_name_as_per_passport')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="sub-label">Middle Name</label>
                                            <input id="middle_name" name="middle_name" class="form-control"
                                                value="{{ $user->middle_name }}" type="text"
                                                pattern="(?=^.{2,25}$)(?![.\n])(?=.*[a-zA-Z]).*$">
                                            <input id="user_id" name="user_id" value="{{ Request::segment(3) }}" type="hidden">
                                            @if($errors->has('middle_name'))
                                            <span class="text-danger">{{$errors->first('middle_name')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="sub-label">Last Name*</label>
                                            <input id="last_name" name="last_name" required="true" class="form-control"
                                                value="{{ $user->last_name }}" type="text"
                                                pattern="(?=^.{2,25}$)(?![.\n])(?=.*[a-zA-Z]).*$">
                                            @if($errors->has('last_name'))
                                            <span class="text-danger">{{$errors->first('last_name')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                        $min_date = date('Y-m-d', strtotime('-18 years'));
                        @endphp
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">DOB*</label>
                                    <input id="date_of_birth" name="date_of_birth" class="form-control" max="{{ $min_date }}" @if($user->date_of_birth)
                                        value="{{$user->date_of_birth}}" @else
                                        value="{{ old('date_of_birth') }}" @endif type="date" required="true">
                                    @if($errors->has('date_of_birth'))
                                    <span class="text-danger">{{$errors->first('date_of_birth')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="sub-label">Gender*</label>
                                <select id="gender" name="gender" class="form-control" required="true">
                                    <option value="Male" @if($user->gender == 'Male') selected
                                        @endif>Male</option>
                                    <option value="Female" @if($user->gender == 'Female') selected
                                        @endif>Female</option>
                                    <option value="Other" @if($user->gender == 'Other') selected
                                        @endif>Other</option>
                                </select>
                                @if($errors->has('gender'))
                                <span class="text-danger">{{$errors->first('gender')}}</span>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Nationality*</label>
                                    <select id="nationality" name="nationality" onChange="ChangeCountry(this);" class="form-control"
                                        required="true">
                                        <option value="">select</option>
                                        @foreach($countries as $country)
                                        <option value="{{ $country->id }}" @if($result) @if($result->nationality ==
                                            $country->id) selected @endif @else @if($country->id == 229) selected @endif
                                            @endif >{{ $country->country_name }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('nationality'))
                                    <span class="text-danger">{{$errors->first('nationality')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6" id="years_in_uae_div" @if($sel_country==229) style="display: none;"
                                @endif>
                                <label class="sub-label">Years In UAE*</label>
                                <input id="years_in_uae" name="years_in_uae" id="years_in_uae" class="form-control" @if($sel_country
                                    !=229) required="true" @endif @if($result) value="{{ $result->years_in_uae }}" @else
                                    value="{{ old('years_in_uae') }}" @endif type="number">
                                @if($errors->has('years_in_uae'))
                                <span class="text-danger">{{$errors->first('years_in_uae')}}</span>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label class="sub-label">Marital Status*</label>
                                <select id="marital_status" name="marital_status" class="form-control" required="true">
                                    <option value="Single" <?php if($result->marital_status == 'Single'){echo "selected";} ?>>Single</option>
                                    <option value="Married" <?php if($result->marital_status == 'Married'){echo "selected";} ?>>Married</option>
                                    <option value="Others" <?php if($result->marital_status == 'Others'){echo "selected";} ?>>Others</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">No of Dependents*</label>
                                    <input id="no_of_dependents" name="no_of_dependents" class="form-control" required="true" @if($result)
                                        value="{{ $result->no_of_dependents }}" @else
                                        value="{{ old('no_of_dependents') }}" @endif type="number">
                                    @if($errors->has('no_of_dependents'))
                                    <span class="text-danger">{{$errors->first('no_of_dependents')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Emirates ID Number*</label>
                                    <input id="eid_number" name="eid_number" pattern="\d*" class="form-control" maxlength="16"
                                        minlength="16" value="{{ $user->eid_number }}" required="true" type="text">
                                    @if($errors->has('eid_number'))
                                    <span class="text-danger">{{$errors->first('eid_number')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Agent Reference Number</label>
                                    <input id="reference_number" name="reference_number" class="form-control" @if($result)
                                        value="{{ $result->reference_number }}" @else
                                        value="{{ old('reference_number') }}" @endif type="text">
                                    @if($errors->has('reference_number'))
                                    <span class="text-danger">{{$errors->first('reference_number')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Upload Emirates id front side <span
                                            style="font-size: 13px;">(recommended 750x400px / .png, .jpg, .jpeg, max
                                            size 2mb)*</span></label>
                                    @if($user->emirates_id)
                                    <input type="file" accept="image/png, image/jpg, image/jpeg" id="imgInp"
                                        style="box-shadow: none; margin-top: 3px;" name="emirates_id_front">
                                    <img src="{!! asset($user->emirates_id) !!}" id="blah"
                                        class="img-responsive">
                                    @else
                                    <input type="file" required="true" accept="image/png, image/jpg, image/jpeg"
                                        id="imgInp" style="box-shadow: none; margin-top: 3px;" name="emirates_id_front">
                                    <img src="" id="blah" class="img-responsive">
                                    @endif
                                    @if($errors->has('emirates_id_front'))
                                    <span class="text-danger">{{$errors->first('emirates_id_front')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Upload Emirates id back side <span
                                            style="font-size: 13px;">(recommended 750x400px / .png, .jpg, .jpeg, max
                                            size 2mb)*</span></label>
                                    @if($user->emirates_id_back)
                                    <input type="file" accept="image/png, image/jpg, image/jpeg" id="imgInp1"
                                        style="box-shadow: none; margin-top: 3px;" name="emirates_id_back">
                                    <img src="{!! asset($user->emirates_id_back) !!}" id="blah1"
                                        class="img-responsive">
                                    @else
                                    <input type="file" required="true" accept="image/png, image/jpg, image/jpeg"
                                        id="imgInp1" style="box-shadow: none; margin-top: 3px;" name="emirates_id_back">
                                    <img src="" id="blah1" class="img-responsive">
                                    @endif
                                    @if($errors->has('emirates_id_back'))
                                    <span class="text-danger">{{$errors->first('emirates_id_back')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Visa Number</label>
                                    <input id="visa_number" name="visa_number" class="form-control" @if($result)
                                        value="{{ $result->visa_number }}" @else value="{{ old('visa_number') }}" @endif
                                        type="text">
                                    @if($errors->has('visa_number'))
                                    <span class="text-danger">{{$errors->first('visa_number')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Official Mail ID</label>
                                    <input id="officer_email" name="officer_email" class="form-control" @if($result)
                                        value="{{ $result->officer_email }}" @else value="{{ old('officer_email') }}"
                                        @endif type="email">
                                    @if($errors->has('officer_email'))
                                    <span class="text-danger">{{$errors->first('officer_email')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Upload Passport <span style="font-size: 13px;">(recommended
                                            600x600px / .png, .jpg, .jpeg, max size 2mb)* </span></label>
                                    @if(isset($result->passport_photo))
                                    <input type="file" accept="image/png, image/jpg, image/jpeg" id="imgInp2"
                                        style="box-shadow: none; margin-top: 3px;" name="passport_photo">
                                    <img src="{!! asset($result->passport_photo) !!}" id="blah2" class="img-responsive"
                                        style="max-height: 110px;">
                                    @else
                                    <input type="file" required="true" accept="image/png, image/jpg, image/jpeg"
                                        id="imgInp2" style="box-shadow: none; margin-top: 3px;" name="passport_photo">
                                    <img src="" id="blah2" class="img-responsive" style="max-height: 110px;">
                                    @endif
                                    @if($errors->has('passport_photo'))
                                    <span class="text-danger">{{$errors->first('passport_photo')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Passport Number*</label>
                                    <input id="passport_number" name="passport_number" class="form-control" required="true" @if($result)
                                        value="{{ $result->passport_number }}" @else
                                        value="{{ old('passport_number') }}" @endif type="text">
                                    @if($errors->has('passport_number'))
                                    <span class="text-danger">{{$errors->first('passport_number')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Passport Expiry Date*</label>
                                    <input id="passport_expiry_date" name="passport_expiry_date" class="form-control" required="true"
                                        onfocus="(this.type='date')" @if(isset($result->passport_expiry_date))
                                    value="{{ $result->passport_expiry_date }}" @else
                                    value="{{ old('passport_expiry_date') }}" @endif type="text">
                                    @if($errors->has('passport_expiry_date'))
                                    <span class="text-danger">{{$errors->first('passport_expiry_date')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Credit Score</label>
                                    <input id="credit_score" name="credit_score" class="form-control" @if($result)
                                        value="{{ $result->credit_score }}" @else value="{{ old('credit_score') }}"
                                        @endif type="number">
                                    @if($errors->has('credit_score'))
                                    <span class="text-danger">{{$errors->first('credit_score')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="chk_bx" style="width: 100%; font-weight: normal; margin-bottom: 15px;">
                                    @if($result) <input id="check" required="true" checked="" type="checkbox"> @else <input
                                        required="true" id="check" type="checkbox"> @endif By proceeding, you agree to the <a
                                        href="#">Terms and Conditions</a></label>
                            </div>
                            <div class="col-md-12 text-center">
                                <!-- <button type="button" class="back_btn">Back</button> -->
                                <button type="submit" name="submit">Proceed</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-7" id="employment-details" style="display:none;">
                <div class="personal_details_box cm_dt">
                    <h2>Employment Details</h2>
                    <h6>Please enter your information to check the offer.</h6>

                    <form id="empl_details" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="sub-label">Employment Type*</label>
                                <input id="user_id" name="user_id" value="{{ Request::segment(3) }}" type="hidden">
                                <select name="cm_type" class="form-control" 
                                    onChange="RelationChange(this);">
                                    <option value="">select</option>
                                    <option value="1">Salaried</option>
                                    <option value="2">Self Employed</option>
                                    <option value="3">Pension</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 salaried_type" style="display: none;">
                                <div class="form-group form-rel">
                                    <label class="sub-label">Company Name*</label>
                                    <input type="text" value="{{ $result->company_name }}"
                                        name="company_name" id="company_name"
                                        class="form-control live_product_1 product_name">
                                    <ul id="live_product_1"></ul>
                                    @if($errors->has('company_name'))
                                    <span class="text-danger">{{$errors->first('company_name')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 salaried_type" style="display: none;">
                                <div class="form-group">
                                    <label class="sub-label">Date of Joining*</label>
                                    <input name="date_of_joining" id="date_of_joining"
                                        class="form-control" value="" type="date">
                                    @if($errors->has('date_of_joining'))
                                    <span class="text-danger">{{$errors->first('date_of_joining')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 salaried_type" style="display: none;">
                                <div class="form-group">
                                    <label class="sub-label">Monthly Salary*</label>
                                    <input name="monthly_salary" class="form-control" id="monthly_salary" value=""
                                         type="number">
                                    @if($errors->has('monthly_salary'))
                                    <span class="text-danger">{{ $errors->first('monthly_salary') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12 salaried_type" style="display: none;">
                                <label class="sub-label" style="color: #000; font-size: 15px;">Last Three Salary
                                    credits</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="sub-label">First</label>
                                            <input name="last_one_salary_credits" class="form-control"
                                                value="{{ old('last_one_salary_credits') }}" type="number">
                                            @if($errors->has('last_one_salary_credits'))
                                            <span
                                                class="text-danger">{{$errors->first('last_one_salary_credits')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="sub-label">Second</label>
                                            <input name="last_two_salary_credits" class="form-control" value=""
                                                type="number">
                                            @if($errors->has('last_two_salary_credits'))
                                            <span
                                                class="text-danger">{{$errors->first('last_two_salary_credits')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="sub-label">Third</label>
                                            <input name="last_three_salary_credits" class="form-control" @if($result)
                                                value="{{ $result->last_three_salary_credits }}" @else
                                                value="{{ old('last_three_salary_credits') }}" @endif type="number">
                                            @if($errors->has('last_three_salary_credits'))
                                            <span
                                                class="text-danger">{{$errors->first('last_three_salary_credits')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-6 self_employed_type" style="display: none;">
                                <div class="form-group">
                                    <label class="sub-label">Company Name*</label>
                                    <input type="text" value="" name="self_company_name"
                                        id="self_company_name" class="form-control live_product_2 product_name2">
                                    <ul id="live_product_2"></ul>


                                    @if($errors->has('self_company_name'))
                                    <span class="text-danger">{{$errors->first('self_company_name')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 self_employed_type" style="display: none;">
                                <div class="form-group">
                                    <label class="sub-label">Percentage Ownership*</label>
                                    <input name="percentage_ownership" id="percentage_ownership"
                                        class="form-control" value="" type="text">
                                    @if($errors->has('percentage_ownership'))
                                    <span class="text-danger">{{$errors->first('percentage_ownership')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 self_employed_type" style="display: none;">
                                <div class="form-group">
                                    <label class="sub-label">Type of profession/business*</label>
                                    <select name="profession_business" id="profession_business" class="form-control"
                                        >
                                        <option>select</option>
                                        <option value="Accounting">Accounting</option>
                                        <option value="Consulting">Consulting</option>
                                        <option value="Event Planning">Event Planning</option>
                                        <option value="Finance">Finance</option>
                                        <option value="Human Resources">Human Resources</option>
                                    </select>
                                    @if($errors->has('profession_business'))
                                    <span class="text-danger">{{$errors->first('profession_business')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 self_employed_type" style="display: none;">
                                <div class="form-group">
                                    <label class="sub-label">Annual Business Income*</label>
                                    <input name="annual_business_income" id="annual_business_income"
                                        class="form-control" value="" type="number">
                                    @if($errors->has('annual_business_income'))
                                    <span class="text-danger">{{$errors->first('annual_business_income')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 pension_type" style="display: none;">
                                <div class="form-group">
                                    <label class="sub-label">Monthly Pension*</label>
                                    <input name="monthly_pension" id="monthly_pension" class="form-control"
                                        value="" type="number">
                                    @if($errors->has('monthly_pension'))
                                    <span class="text-danger">{{$errors->first('monthly_pension')}}</span>
                                    @endif
                                </div>
                            </div>


                            <div class="col-md-12 text-center">
                                <button type="button" onclick="back1()" class="back_btn">Back</button>
                                <button type="submit" name="submit">Proceed</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-7" id="existing-financial" style="display:none;">
                <div class="personal_details_box">
                    <h2>Details of existing financial products</h2>
                    <h6>Please enter your information to check the offer.</h6>

                    <form id="existing_financial_save" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 style="font-size: 17px; margin-top: 15px;">Details For Credit Card</h5>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Credit Card Limit</label>
                                    <input id="user_id" name="user_id" value="{{ Request::segment(3) }}" type="hidden">
                                    <input name="credit_card_limit" class="form-control" type="number">
                                    @if($errors->has('credit_card_limit'))
                                    <span class="text-danger">{{$errors->first('credit_card_limit')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <!-- <label style="font-size: 14px; margin-top: -10px;">Existing Financial Products</label> -->
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Details of Cards</label>
                                    <select name="details_of_cards" class="form-control" >
                                        <option value="Credit Card">Credit Card</option>
                                        <option value="Debit Card">Debit Card</option>
                                    </select>
                                    @if($errors->has('details_of_cards'))
                                    <span class="text-danger">{{$errors->first('details_of_cards')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Bank Name</label>

                                    <select name="credit_bank_name" class="form-control">
                                        <option value="">select</option>
                                        @foreach($banks as $bank)
                                        <option value="{{ $bank->id }}">{{ $bank->name }}</option>
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
                                    <input name="card_limit" class="form-control" value="" type="number">
                                    @if($errors->has('card_limit'))
                                    <span class="text-danger">{{$errors->first('card_limit')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12" style="display:none;">
                                <a class="add_more_btn credit_card1_open"> + Add More</a>
                            </div>
                        </div>

                        <div class="row credit_card1" style="display:none;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Details of Cards</label>
                                    <select name="details_of_cards2" class="form-control" >

                                        <option value="Credit Card">Credit Card</option>
                                        <option value="Debit Card">Debit Card</option>

                                    </select>
                                    @if($errors->has('details_of_cards2'))
                                    <span class="text-danger">{{$errors->first('details_of_cards2')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Bank Name</label>

                                    <select name="credit_bank_name2" class="form-control">
                                        <option value="">select</option>
                                        @foreach($banks as $bank)
                                        <option value="{{ $bank->id }}">{{ $bank->name }}</option>
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
                                    <input name="card_limit2" class="form-control" type="number">
                                    @if($errors->has('card_limit2'))
                                    <span class="text-danger">{{$errors->first('card_limit2')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12" style="display:none;">
                                <a class="add_more_btn credit_card2_open"><span>+</span> Add More</a>
                            </div>
                        </div>

                        <div class="row credit_card2" style="display:none;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Details of Cards</label>
                                    <select name="details_of_cards3" class="form-control" >
                                        <option value="Credit Card">Credit Card</option>
                                        <option value="Debit Card">Debit Card</option>
                                    </select>
                                    @if($errors->has('details_of_cards3'))
                                    <span class="text-danger">{{$errors->first('details_of_cards3')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Bank Name</label>
                                    <select name="credit_bank_name3" class="form-control">
                                        <option value="">select</option>
                                        @foreach($banks as $bank)
                                        <option value="{{ $bank->id }}">{{ $bank->name }}</option>
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
                                    <input name="card_limit3" class="form-control" value="" type="number">
                                    @if($errors->has('card_limit3'))
                                    <span class="text-danger">{{$errors->first('card_limit3')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12" style="display:none;">
                                <a class="add_more_btn credit_card3_open"><span>+</span> Add More</a>
                            </div>
                        </div>

                        <div class="row credit_card3" style="display:none;" style="display:none;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Details of Cards</label>
                                    <select name="details_of_cards4" class="form-control" >
                                        <option value="Credit Card">Credit Card</option>
                                        <option value="Debit Card">Debit Card</option>
                                    </select>
                                    @if($errors->has('details_of_cards4'))
                                    <span class="text-danger">{{$errors->first('details_of_cards4')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Bank Name</label>
                                    <select name="credit_bank_name4" class="form-control">
                                        <option value="">select</option>
                                        @foreach($banks as $bank)
                                        <option value="{{ $bank->id }}">{{ $bank->name }}</option>
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
                                    <input name="card_limit4" class="form-control" value="" type="text">
                                    @if($errors->has('card_limit4'))
                                    <span class="text-danger">{{$errors->first('card_limit4')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="row" style="background: #f7f7f7; margin-top: 20px;">
                            <div class="col-md-12">
                                <h5 style="font-size: 17px; margin-top: 15px;">Details For Personal Loan</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Loan Amount</label>
                                    <input name="loan_amount" class="form-control" value="" type="text">
                                    @if($errors->has('loan_amount'))
                                    <span class="text-danger">{{$errors->first('loan_amount')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label style="font-size: 14px; margin-top: -10px;">Details of Existing Loans</label>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Bank Name</label>
                                    <select name="loan_bank_name" class="form-control">
                                        <option value="">select</option>
                                        @foreach($banks as $bank)
                                        <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('loan_bank_name'))
                                    <span class="text-danger">{{$errors->first('loan_bank_name')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Original Loan Amount</label>
                                    <input name="original_loan_amount" class="form-control" value="" type="text">
                                    @if($errors->has('original_loan_amount'))
                                    <span class="text-danger">{{$errors->first('original_loan_amount')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">EMI</label>
                                    <input name="loan_emi" class="form-control" type="number">
                                    @if($errors->has('loan_emi'))
                                    <span class="text-danger">{{$errors->first('loan_emi')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12" style="display:none;">
                                <a class="add_more_btn loan_bus2_open"><span>+</span> Add More</a>
                            </div>
                        </div>

                        <div class="row bus_lon2" style="background: #f7f7f7;">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Bank Name</label>
                                    <select name="loan_bank_name2" class="form-control">
                                        <option value="">select</option>
                                        @foreach($banks as $bank)
                                        <option value="{{ $bank->id }}">{{ $bank->name }}</option>
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
                                    <input name="original_loan_amount2" class="form-control" value="" type="text">
                                    @if($errors->has('original_loan_amount2'))
                                    <span class="text-danger">{{$errors->first('original_loan_amount2')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">EMI</label>
                                    <input name="loan_emi2" class="form-control" value="" type="number">
                                    @if($errors->has('loan_emi2'))
                                    <span class="text-danger">{{$errors->first('loan_emi2')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12" style="display:none;">
                                <a class="add_more_btn loan_bus3_open"><span>+</span> Add More</a>
                            </div>
                        </div>

                        <div class="row bus_lon3" style="background: #f7f7f7;"
                            style="display:none;background: #f7f7f7;">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Bank Name</label>
                                    <select name="loan_bank_name3" class="form-control">
                                        <option value="">select</option>
                                        @foreach($banks as $bank)
                                        <option value="{{ $bank->id }}">{{ $bank->name }}</option>
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
                                    <input name="original_loan_amount3" class="form-control" value="" type="text">
                                    @if($errors->has('original_loan_amount3'))
                                    <span class="text-danger">{{$errors->first('original_loan_amount3')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">EMI</label>
                                    <input name="loan_emi3" class="form-control" value="" type="number">
                                    @if($errors->has('loan_emi3'))
                                    <span class="text-danger">{{$errors->first('loan_emi3')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12" style="display:none;">
                                <a class="add_more_btn loan_bus4_open"><span>+</span> Add More</a>
                            </div>
                        </div>

                        <div class="row bus_lon4" style="display:none;background: #f7f7f7;">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Bank Name</label>
                                    <select name="loan_bank_name4" class="form-control">
                                        <option value="">select</option>
                                        @foreach($banks as $bank)
                                        <option value="{{ $bank->id }}">{{ $bank->name }}</option>
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
                                    <input name="original_loan_amount4" class="form-control" value="" type="text">
                                    @if($errors->has('original_loan_amount4'))
                                    <span class="text-danger">{{$errors->first('original_loan_amount4')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">EMI</label>
                                    <input name="loan_emi4" class="form-control" value="" type="number">
                                    @if($errors->has('loan_emi4'))
                                    <span class="text-danger">{{$errors->first('loan_emi4')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h5 style="font-size: 17px; margin-top: 15px;">Details For Business Loan</h5>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Loan Amount</label>
                                    <input name="business_loan_amount" class="form-control" value="" type="number">
                                    @if($errors->has('business_loan_amount'))
                                    <span class="text-danger">{{$errors->first('business_loan_amount')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">EMI</label>
                                    <input name="business_loan_emi" class="form-control" value="" type="number">
                                    @if($errors->has('business_loan_emi'))
                                    <span class="text-danger">{{$errors->first('business_loan_emi')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12" style="display:none;">
                                <a class="add_more_btn loan_busin2_open"><span>+</span> Add More</a>
                            </div>
                        </div>

                        <div class="row loan_busin2" style="display:none;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Loan Amount</label>
                                    <input name="business_loan_amount2" class="form-control" value="" type="number">
                                    @if($errors->has('business_loan_amount2'))
                                    <span class="text-danger">{{$errors->first('business_loan_amount2')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">EMI</label>
                                    <input name="business_loan_emi2" class="form-control" value="" type="number">
                                    @if($errors->has('business_loan_emi2'))
                                    <span class="text-danger">{{$errors->first('business_loan_emi2')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12" style="display:none;">
                                <a class="add_more_btn loan_busin3_open"><span>+</span> Add More</a>
                            </div>
                        </div>

                        <div class="row loan_busin3" style="display:none;" style="display:none;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Loan Amount</label>
                                    <input name="business_loan_amount3" class="form-control" value="" type="number">
                                    @if($errors->has('business_loan_amount3'))
                                    <span class="text-danger">{{$errors->first('business_loan_amount3')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">EMI</label>
                                    <input name="business_loan_emi3" class="form-control" value="" type="number">
                                    @if($errors->has('business_loan_emi3'))
                                    <span class="text-danger">{{$errors->first('business_loan_emi3')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12" style="display:none;">
                                <a class="add_more_btn loan_busin4_open"><span>+</span> Add More</a>
                            </div>
                        </div>

                        <div class="row loan_busin4" style="display:none;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Loan Amount</label>
                                    <input name="business_loan_amount4" class="form-control" value="" type="number">
                                    @if($errors->has('business_loan_amount4'))
                                    <span class="text-danger">{{$errors->first('business_loan_amount4')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">EMI</label>
                                    <input name="business_loan_emi4" class="form-control" value="" type="number">
                                    @if($errors->has('business_loan_emi4'))
                                    <span class="text-danger">{{$errors->first('business_loan_emi4')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="row" style="background: #f7f7f7;">
                            <div class="col-md-12">
                                <h5 style="font-size: 17px; margin-top: 15px;">Details For Mortgage Loan</h5>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Loan Amount</label>
                                    <input name="mortgage_loan_amount" class="form-control" value="" type="number">
                                    @if($errors->has('mortgage_loan_amount'))
                                    <span class="text-danger">{{$errors->first('mortgage_loan_amount')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Purchase price/ current market valuation</label>
                                    <input name="purchase_price" class="form-control" value="" type="text">
                                    @if($errors->has('purchase_price'))
                                    <span class="text-danger">{{$errors->first('purchase_price')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Type of loan</label>
                                    <select name="type_of_loan" class="form-control" >
                                        <option value="Primary Sale">Primary Sale</option>
                                        <option value="Secondary Sale">Secondary Sale</option>
                                        <option value="Buyout">Buyout</option>
                                        <option value="Equity">Equity</option>
                                        <option value="Top up">Top up</option>
                                    </select>
                                    @if($errors->has('type_of_loan'))
                                    <span class="text-danger">{{$errors->first('type_of_loan')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Term of loan</label>
                                    <input name="term_of_loan" class="form-control" value="" type="text">
                                    @if($errors->has('term_of_loan'))
                                    <span class="text-danger">{{$errors->first('term_of_loan')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">End use of property</label>
                                    <select name="end_use_of_property" class="form-control" >
                                        <option value="Self use">Self use</option>
                                        <option value="Rental">Rental</option>
                                    </select>
                                    @if($errors->has('end_use_of_property'))
                                    <span class="text-danger">{{$errors->first('end_use_of_property')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Interest Rate</label>
                                    <input name="interest_rate" class="form-control" value="" type="text">
                                    @if($errors->has('interest_rate'))
                                    <span class="text-danger">{{$errors->first('interest_rate')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">EMI</label>
                                    <input name="mortgage_emi" class="form-control" value="" type="text">
                                    @if($errors->has('mortgage_emi'))
                                    <span class="text-danger">{{$errors->first('mortgage_emi')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12" style="display:none;">
                                <a class="add_more_btn mortgage_loan2_open"><span>+</span> Add More</a>
                            </div>
                        </div>

                        <div class="row mortgage_loan2" style="display:none;background: #f7f7f7;">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Loan Amount</label>
                                    <input name="mortgage_loan_amount2" class="form-control" value="" type="number">
                                    @if($errors->has('mortgage_loan_amount2'))
                                    <span class="text-danger">{{$errors->first('mortgage_loan_amount2')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Purchase price/ current market valuation</label>
                                    <input name="purchase_price2" class="form-control" value="" type="text">
                                    @if($errors->has('purchase_price2'))
                                    <span class="text-danger">{{$errors->first('purchase_price2')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Type of loan</label>
                                    <select name="type_of_loan2" class="form-control" >
                                        <option value="Primary Sale">Primary Sale</option>
                                        <option value="Secondary Sale">Secondary Sale</option>
                                        <option value="Buyout">Buyout</option>
                                        <option value="Equity">Equity</option>
                                        <option value="Top up">Top up</option>
                                    </select>
                                    @if($errors->has('type_of_loan2'))
                                    <span class="text-danger">{{$errors->first('type_of_loan2')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Term of loan</label>
                                    <input name="term_of_loan2" class="form-control" @if($result)
                                        value="{{ $result->term_of_loan2 }}" @else value="{{ old('term_of_loan2') }}"
                                        @endif type="text">
                                    @if($errors->has('term_of_loan2'))
                                    <span class="text-danger">{{$errors->first('term_of_loan2')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">End use of property</label>
                                    <select name="end_use_of_property2" class="form-control" >
                                        <option value="Self use">Self use</option>
                                        <option value="Rental">Rental</option>
                                    </select>
                                    @if($errors->has('end_use_of_property2'))
                                    <span class="text-danger">{{$errors->first('end_use_of_property2')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Interest Rate</label>
                                    <input name="interest_rate2" class="form-control" value="" type="text">
                                    @if($errors->has('interest_rate2'))
                                    <span class="text-danger">{{$errors->first('interest_rate2')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">EMI</label>
                                    <input name="mortgage_emi2" class="form-control" value="" type="text">
                                    @if($errors->has('mortgage_emi2'))
                                    <span class="text-danger">{{$errors->first('mortgage_emi2')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12" style="display:none;">
                                <a class="add_more_btn mortgage_loan3_open"><span>+</span> Add More</a>
                            </div>
                        </div>
                        <div class="row mortgage_loan3" style="display:none;background: #f7f7f7;">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Loan Amount</label>
                                    <input name="mortgage_loan_amount3" class="form-control"
                                        value="{{ $result->mortgage_loan_amount3 }}" type="number">
                                    @if($errors->has('mortgage_loan_amount3'))
                                    <span class="text-danger">{{$errors->first('mortgage_loan_amount3')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Purchase price/ current market valuation</label>
                                    <input name="purchase_price3" class="form-control" value="" type="text">
                                    @if($errors->has('purchase_price3'))
                                    <span class="text-danger">{{$errors->first('purchase_price3')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Type of loan</label>
                                    <select name="type_of_loan3" class="form-control" >
                                        <option value="Primary Sale">Primary Sale</option>
                                        <option value="Secondary Sale">Secondary Sale</option>
                                        <option value="Buyout">Buyout</option>
                                        <option value="Equity">Equity</option>
                                        <option value="Top up">Top up</option>
                                    </select>
                                    @if($errors->has('type_of_loan3'))
                                    <span class="text-danger">{{$errors->first('type_of_loan3')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Term of loan</label>
                                    <input name="term_of_loan3" class="form-control" value="" type="text">
                                    @if($errors->has('term_of_loan3'))
                                    <span class="text-danger">{{$errors->first('term_of_loan3')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">End use of property</label>
                                    <select name="end_use_of_property3" class="form-control" >
                                        <option value="Self use">Self use</option>
                                        <option value="Rental">Rental</option>
                                    </select>
                                    @if($errors->has('end_use_of_property3'))
                                    <span class="text-danger">{{$errors->first('end_use_of_property3')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Interest Rate</label>
                                    <input name="interest_rate3" class="form-control" value="" type="text">
                                    @if($errors->has('interest_rate3'))
                                    <span class="text-danger">{{$errors->first('interest_rate3')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">EMI</label>
                                    <input name="mortgage_emi3" class="form-control" value="" type="text">
                                    @if($errors->has('mortgage_emi3'))
                                    <span class="text-danger">{{$errors->first('mortgage_emi3')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12" style="display:none;">
                                <a class="add_more_btn mortgage_loan4_open"><span>+</span> Add More</a>
                            </div>
                        </div>


                        <div class="row mortgage_loan4" style="display:none;background: #f7f7f7;">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Loan Amount</label>
                                    <input name="mortgage_loan_amount4" class="form-control" value="" type="number">
                                    @if($errors->has('mortgage_loan_amount4'))
                                    <span class="text-danger">{{$errors->first('mortgage_loan_amount4')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Purchase price/ current market valuation</label>
                                    <input name="purchase_price4" class="form-control" value="" type="text">
                                    @if($errors->has('purchase_price4'))
                                    <span class="text-danger">{{$errors->first('purchase_price4')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Type of loan</label>
                                    <select name="type_of_loan4" class="form-control" >
                                        <option value="Primary Sale">Primary Sale</option>
                                        <option value="Secondary Sale">Secondary Sale</option>
                                        <option value="Buyout">Buyout</option>
                                        <option value="Equity">Equity</option>
                                        <option value="Top up">Top up</option>
                                    </select>
                                    @if($errors->has('type_of_loan4'))
                                    <span class="text-danger">{{$errors->first('type_of_loan4')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Term of loan</label>
                                    <input name="term_of_loan4" class="form-control" value="{{ old('term_of_loan4') }}"
                                        type="text">
                                    @if($errors->has('term_of_loan4'))
                                    <span class="text-danger">{{$errors->first('term_of_loan4')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">End use of property</label>
                                    <select name="end_use_of_property4" class="form-control" >
                                        <option value="Self use">Self use</option>
                                        <option value="Rental">Rental</option>
                                    </select>
                                    @if($errors->has('end_use_of_property4'))
                                    <span class="text-danger">{{$errors->first('end_use_of_property4')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">Interest Rate</label>
                                    <input name="interest_rate4" class="form-control" value="" type="text">
                                    @if($errors->has('interest_rate4'))
                                    <span class="text-danger">{{$errors->first('interest_rate4')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="sub-label">EMI</label>
                                    <input name="mortgage_emi4" class="form-control" value="" type="text">
                                    @if($errors->has('mortgage_emi4'))
                                    <span class="text-danger">{{$errors->first('mortgage_emi4')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-12 text-center">
                                <!-- <a href="{{ route('cm-details') }}" back2 class="back_btn">Back</a> &nbsp;&nbsp; -->
                                <button type="button" onclick="back2();">Back</button>
                                <button type="submit" name="submit">Proceed</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-7" id="bank-preference" style="display:none;">
                <div class="personal_details_box cm_dt">
                    <h2>Bank Preference</h2>
                    <!-- <h6>Please select bank for preference</h6> -->

                    <form id="bank_preference" method="POST">

                        <div class="row">
                            <div class="col-md-12" style="margin-top: 20px;">
                                <label style="font-weight: normal; font-size: 15px;"><input type="radio"
                                        onclick="javascript:yesnoCheck();" name="decide_by" id="yesCheck" value="0"
                                        style="margin-top: 3px; float: left; margin-right: 8px; width: 16px; margin-bottom: 8px;">
                                    Yes lnxx will decide</label><br>
                                <label style="font-weight: normal; font-size: 15px;"><input type="radio"
                                        onclick="javascript:yesnoCheck();" name="decide_by" value="1" id="noCheck"
                                        style="margin-top: 3px; float: left; margin-right: 8px; width: 16px; margin-bottom: 5px;">
                                    No i will decide</label>
                            </div>
                            <div class="col-md-6" id="bank_select" style="margin-top: 15px;">
                                <input type="hidden" name="apply_id[]" value="">
                                <input id="user_id" name="user_id" value="{{ Request::segment(3) }}" type="hidden">
                                <label style="font-weight: normal; margin-bottom: 5px; font-size: 15px;">Bank</label>
                                <select name="bank_id" class="form-control" id="bank_select_field" >
                                    <option value="">Select</option>
                                    @foreach(get_prefer_bank($service->service_id) as $bank)
                                    <option value="{{ $bank->id }}" @if($bank->id == $service->bank_id) selected @endif>{{ $bank->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="button" onclick="back3();">Back</button>
                                <button type="submit" name="submit">Proceed</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-7" id="consent-form" style="display:none;">
                <div class="personal_details_box cm_dt">
                    <h2>Consent form</h2>
                    <h6 style="color: #000;font-size: 17px;">Providing the following guidelines for the form :</h6>

                    <form id="consent_form" method="POST">

                        <p class="by_signing">By signing this form, you consent (permission) to Emirates Islamic to
                            request for your statement of account through the Central Bank of the United Arab Emirates,
                            from your bank (as can be identified by the account number IBAN) and also for your bank to
                            provide this information through the Central Bank of the United Arab Emirates, without
                            taking additional consent. ....</p>
                        <div class="row">

                            <div class="col-md-12">
                                <label style="font-weight: 400; font-size: 15px;"><input id="user_id" name="user_id" value="{{ Request::segment(3) }}" type="hidden"><input type="checkbox"
                                        name="consultation" value="1"
                                        style="margin-top: 2px; width: 20px; height: 20px; box-shadow: none; float: left; margin-right: 10px;"
                                        > By checking the box, you agree to provide your Consent.</label>
                            </div>
                            <div class="col-md-12">
                                <p class="by_signing">By signing this form, you consent (permission) to Emirates Islamic
                                    to request for your statement of account through the Central Bank of the United Arab
                                    Emirates, from your bank (as can be identified by the account number IBAN) and also
                                    for your bank to provide this information through the Central Bank of the United
                                    Arab Emirates, without taking additional consent. ....</p>
                            </div>

                            <div class="col-md-12">
                                <label style="font-weight: 400; font-size: 15px;"><input type="checkbox"
                                        name="consultation" value="1"
                                        style="margin-top: 2px; width: 20px; height: 20px; box-shadow: none; float: left; margin-right: 10px;"
                                        > By checking the box, you agree to provide your Consent.</label>
                            </div>

                            <div class="col-md-12 text-center">
                            <button type="button" onclick="back4();">Back</button>
                                <button type="submit" name="submit">Proceed</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-7" id="upload-video" style="display:none;">
                <div class="personal_details_box cm_dt">
                    <h2>Upload Video</h2>
                    <h6 style="color: #000;font-size: 17px;">Important Guidelines for Video-KYC:</h6>
                    <!-- <p style="color: rgba(9, 15, 5, 0.5); font-size: 14px;">Lorem ipsum dolor sit amet consectetur. Tempor cum amet ac purus sed. Faucibus lobortis bibendum eu pellentesque a morbi sit varius. Lobortis in ultricies placerat accumsan. Ac pharetra dolor aliquam libero sit at consectetur. Diam eu pulvinar mauris pulvinar enim egestas magna venenatis non. </p> -->
                    <ul style="padding: 0px; list-style: none;">
                        <li style="color: #555; font-size: 13px; margin-bottom: 5px;">It is important to keep the
                            following guidelines in mind during your video KYC to ensure that it is completed
                            smoothly:Make sure your background is white in color</li>
                        <li style="color: #555; font-size: 13px; margin-bottom: 5px;">There should not be anyone else in
                            the frame</li>
                        <li style="color: #555; font-size: 13px; margin-bottom: 5px;">Your face should be clearly seen
                            on the call</li>
                        <li style="color: #555; font-size: 13px; margin-bottom: 5px;">When displaying a document for the
                            live capture, it should be displayed vertically from above
                            Make sure your ‘'location’' feature on your device is turned on</li>
                    </ul>
                    <form action="#" enctype="multipart/form-data" method="post">
                        {{ csrf_field() }}
                        <span id="start"></span>

                        <div class="row">
                            <div class="col-md-6">
                                <video id="gum" playsinline autoplay muted style="width:100%; height:200px;"></video>
                                <input type="hidden" name="video" id="videofile" required="true">
                                <span class="btn btn-danger" id="record"
                                    style="padding-top: 10px;padding-left: 25px !important; padding-right: 25px !important;  padding-bottom: 10px !important; font-size: 15px; display: none;">Record</span>
                                <span class="btn btn-info" onclick="SwitchButtons('play');" id="play"
                                    style="padding-top: 10px;  padding-left: 25px !important; padding-right: 25px !important; padding-bottom: 10px !important; font-size: 15px; display: none;">Play</span>
                                <!--   <span onclick="SwitchButtons('download');"  id="download" style="display:none;"></span> -->
                                <input type="hidden" id="echoCancellation" />
                            </div>
                            <div class="col-md-6">
                                <video id="recorded" playsinline loop style="width:100%; height:200px;"></video>

                            </div>
                            <div class="col-md-12 text-center">
                                <button type="button" onclick="back5();">Back</button>
                                <button type="button" onclick="proceed5();">Proceed</button>
                                <!-- <a href="{{ route('consent-approval') }}" class="back_btn">Back</a> &nbsp;&nbsp; -->
                                <!-- <button type="submit">Proceed</button>  -->
                                <!-- <span onclick="SwitchButtons('download');" id="download" class="upload_btn"
                                    style="display:none;">Upload</span>
                                <a href="{{ route('thank-you') }}" id="skip" -->
                                    <!-- style="background: #EFF2F0; padding: 10px 35px; color: #000; border: 1px solid #000;">Skip</a> -->
                            </div>
                            

                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-5">
                <div class="service-step">
                    <h3>Services is only a few step away from you</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>

                <div class="service-step">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <h3>Get money in just a step way*</h3>
                    <p style="border-top: 1px solid rgba(0, 0, 0, 0.5);padding-top: 30px;">Lorem ipsum dolor sit amet,
                        consectetur adipiscing elit. Risus dis adipiscing ac, consectetur quis aenean. Semper viverra
                        maecenas pharetra tristique tempus platea elit viverra. Proin mauris suspendisse risus sem. In
                        diam odio commodo, sodales tellus convallis tortor. Neque amet eget amet morbi ac at habitant.
                        Enim eget aliquam tempus duis amet. Sed amet sed bibendum ullamcorper. Nam bibendum eu magna in
                        in eget ullamcorper ultrices. Faucibus gravida tristique erat quam tincidunt tincidunt ut morbi.
                    </p>
                </div>

            </div>

        </div>
    </div>
</section>
<script>
function proceed1(){
    $('#personal-details').hide();
    $('#employment-details').show();
    $('#existing-financial').hide();
    $('#bank-preference').hide();
    $('#consent-form').hide();
    $('#upload-video').hide();   
}
function back1(){
    $('#personal-details').show();
    $('#employment-details').hide();
    $('#existing-financial').hide();
    $('#bank-preference').hide();
    $('#consent-form').hide();
    $('#upload-video').hide();
}
function proceed2(){
    $('#personal-details').hide();
    $('#employment-details').hide();
    $('#existing-financial').show();
    $('#bank-preference').hide();
    $('#consent-form').hide();
    $('#upload-video').hide();
}
function back2(){
    $('#personal-details').hide();
    $('#employment-details').show();
    $('#existing-financial').hide();
    $('#bank-preference').hide();
    $('#consent-form').hide();
    $('#upload-video').hide();
}
function proceed3(){
    $('#personal-details').hide();
    $('#employment-details').hide();
    $('#existing-financial').hide();
    $('#bank-preference').show();
    $('#consent-form').hide();
    $('#upload-video').hide();
}
function back3(){
    $('#personal-details').hide();
    $('#employment-details').hide();
    $('#existing-financial').show();
    $('#bank-preference').hide();
    $('#consent-form').hide();
    $('#upload-video').hide();
}
function proceed4(){
    $('#personal-details').hide();
    $('#employment-details').hide();
    $('#existing-financial').hide();
    $('#bank-preference').hide();
    $('#consent-form').show();
    $('#upload-video').hide();
}
function back4(){
    $('#personal-details').hide();
    $('#employment-details').hide();
    $('#existing-financial').hide();
    $('#bank-preference').show();
    $('#consent-form').hide();
    $('#upload-video').hide();
}
function proceed5(){
    $('#personal-details').hide();
    $('#employment-details').hide();
    $('#existing-financial').hide();
    $('#bank-preference').hide();
    $('#consent-form').hide();
    $('#upload-video').show();
}
function back5(){
    $('#personal-details').hide();
    $('#employment-details').hide();
    $('#existing-financial').hide();
    $('#bank-preference').hide();
    $('#consent-form').show();
    $('#upload-video').hide();
}
</script>
<script type="text/javascript">
function yesnoCheck() {
    if (document.getElementById('yesCheck').checked) {
        document.getElementById('bank_select').style.display = 'none';
        $("#bank_select_field").removeAttr('required');
    } else {
        document.getElementById('bank_select').style.display = 'block';
        $("#bank_select_field").attr("required", true);
    }
}
</script>


<script type="text/javascript">
function RelationChange(that) {
    if (that.value == "2") {
        $(".self_employed_type").show();
        $(".salaried_type").hide();
        $(".pension_type").hide();

        $("#company_name").removeAttr('required');
        $("#date_of_joining").removeAttr('required');
        $("#monthly_salary").removeAttr('required');

        $("#monthly_pension").removeAttr('required');

        $("#profession_business").attr("required", true);
        $("#percentage_ownership").attr("required", true);
        $("#company_name_sec").attr("required", true);
        $("#annual_business_income").attr("required", true);

    } else if (that.value == "3") {
        $(".salaried_type").hide();
        $(".self_employed_type").hide();
        $(".pension_type").show();

        $("#company_name").removeAttr('required');
        $("#date_of_joining").removeAttr('required');
        $("#monthly_salary").removeAttr('required');

        $("#profession_business").removeAttr('required');
        $("#percentage_ownership").removeAttr('required');
        $("#company_name_sec").removeAttr('required');
        $("#annual_business_income").removeAttr('required');

        $("#monthly_pension").attr("required", true);

    } else {
        $(".salaried_type").show();
        $(".self_employed_type").hide();
        $(".pension_type").hide();

        $("#company_name").attr("required", true);
        $("#date_of_joining").attr("required", true);
        $("#monthly_salary").attr("required", true);

        $("#profession_business").removeAttr('required');
        $("#percentage_ownership").removeAttr('required');
        $("#company_name_sec").removeAttr('required');
        $("#annual_business_income").removeAttr('required');

        $("#monthly_pension").removeAttr('required');
    }

}
</script>

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
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>

<script type="text/javascript">
$(document).ready(function(e) {
    $("#personal_detail").on('submit', (function(e) {
        e.preventDefault();
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{route('personal-detail-customer')}}",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            // beforeSend: function() {
                
            // },
            success: function(data) {
                proceed1();
            },
            // error: function(e) {
                
            // }
        });
    }));
});       
</script>       
<script type="text/javascript">
$(document).ready(function(e) {
    $("#empl_details").on('submit', (function(e) {
        e.preventDefault();
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{route('empl-details')}}",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            // beforeSend: function() {
                
            // },
            success: function(data) {
                proceed2();
            },
            // error: function(e) {
                
            // }
        });
    }));
});       
</script>       
<script type="text/javascript">
$(document).ready(function(e) {
    $("#existing_financial_save").on('submit', (function(e) {
        e.preventDefault();
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{route('existing-financial-save')}}",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            // beforeSend: function() {
                
            // },
            success: function(data) {
                proceed3();
            },
            // error: function(e) {
                
            // }
        });
    }));
});       
</script>       
<script type="text/javascript">
$(document).ready(function(e) {
    $("#bank_preference").on('submit', (function(e) {
        e.preventDefault();
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{route('bank-preference')}}",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            // beforeSend: function() {
                
            // },
            success: function(data) {
                proceed4();
            },
            // error: function(e) {
                
            // }
        });
    }));
});       
</script>       
<script type="text/javascript">
$(document).ready(function(e) {
    $("#consent_form").on('submit', (function(e) {
        e.preventDefault();
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{route('consent_form')}}",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            // beforeSend: function() {
                
            // },
            success: function(data) {
                proceed5();
            },
            // error: function(e) {
                
            // }
        });
    }));
});       
</script>       
<script type="text/javascript">       
  var btn = $('#button2');

  $(window).scroll(function() {
    if ($(window).scrollTop() > 300) {
      //alert('here');
      btn.addClass('show');
    } else {
      btn.removeClass('show');
     // alert('here 1');
    }
  });

  btn.on('click', function(e) {
    e.preventDefault();
    $('html, body').animate({scrollTop:0}, '300');
  });

</script>  
        {!! Html::script('assets/frontend/js/jquery-ui.js') !!}
        {!! Html::script('assets/frontend/js/popper.min.js') !!}
        {!! Html::script('assets/frontend/js/owl.carousel.min.js') !!}

<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
    $('#table').dataTable();
    } );
</script>

<script type="text/javascript">

const counters = document.querySelectorAll('.counters');
counters.forEach(counter => {
  let count = 0;
  const updateCounter = () => {
    const countTarget = parseInt(counter.getAttribute('data-counttarget'));
    count++;
    if (count < countTarget) {
      counter.innerHTML = count;
      setTimeout(updateCounter, 1);
    } else {
      counter.innerHTML = countTarget;
    }
  };
  updateCounter();
});

$('.testimonials-slider').owlCarousel({
    autoplay: true,
    smartSpeed: 900,
    loop: true,
    margin: 20,
    nav: true,
    center:false,
    autoplayHoverPause:true,
    navText: ['<i class="fas fa-angle-left"></i>','<i class="fas fa-angle-right"></i>'],
    dots: false,
    responsive:{
        0:{
            items:1,
            nav: false
        },
        575:{
            items:2,
            nav: false
        },
        768:{
            items:3,
            nav: false
        },
        992:{
            items:3,
        },
        1200:{
            items:3
           
        }
    }
});

$('.main-slider').owlCarousel({
    autoplay: true,
    smartSpeed: 900,
    loop: true,
    margin: 20,
    nav: false,
    center:false,
    autoplayHoverPause:true,
    navText: ['<i class="fas fa-angle-left"></i>','<i class="fas fa-angle-right"></i>'],
    dots: true,
    responsive:{
        0:{
            items:1,
            nav: false
        },
        575:{
            items:1,
            nav: false
        },
        768:{
            items:1,
            nav: false
        },
        992:{
            items:1,
        },
        1200:{
            items:1
           
        }
    }
});

$('.product-slider').owlCarousel({
    autoplay: true,
    smartSpeed: 900,
    loop: true,
    margin: 20,
    nav: false,
    center:false,
    autoplayHoverPause:true,
    navText: ['<i class="fas fa-angle-left"></i>','<i class="fas fa-angle-right"></i>'],
    dots: true,
    responsive:{
        0:{
            items:1,
            nav: false
        },
        575:{
            items:2,
            nav: false
        },
        768:{
            items:3,
            nav: false
        },
        992:{
            items:3,
        },
        1200:{
            items:5
           
        }
    }
});

$('.blog-slider').owlCarousel({
    autoplay: true,
    smartSpeed: 900,
    loop: true,
    margin: 20,
    nav: false,
    center:false,
    autoplayHoverPause:true,
    navText: ['<i class="fas fa-angle-left"></i>','<i class="fas fa-angle-right"></i>'],
    dots: true,
    responsive:{
        0:{
            items:1,
            nav: false
        },
        575:{
            items:2,
            nav: false
        },
        768:{
            items:3,
            nav: false
        },
        992:{
            items:3,
        },
        1200:{
            items:4
           
        }
    }
});

$('.blog-slider-ser').owlCarousel({
    autoplay: false,
    smartSpeed: 900,
    loop: true,
    margin: 20,
    nav: false,
    center:false,
    autoplayHoverPause:true,
    navText: ['<i class="fas fa-angle-left"></i>','<i class="fas fa-angle-right"></i>'],
    dots: true,
    responsive:{
        0:{
            items:1,
            nav: false
        },
        575:{
            items:2,
            nav: false
        },
        768:{
            items:3,
            nav: false
        },
        992:{
            items:3,
        },
        1200:{
            items:3
           
        }
    }
});

// function getState(val) {
//   $.ajax({
//     type: "GET",
//     url: "{{ route('getState') }}",
//     data: {'country_id' : val},
//     success: function(data){
//         $("#state").html(data);
//     }
//   });
// }

// function getCity(val) {
//   $.ajax({
//     type: "GET",
//     url: "{{ route('getCity') }}",
//     data: {'state_id' : val},
//     success: function(data){
//         $("#city").html(data);
//     }
//   });
// }

$('#salaried').click(function(){
    $('#cm_type').val('1');
    document.getElementById("salaried").classList.add("active");
    document.getElementById("other_employed").classList.remove("active");
    document.getElementById("self_employed").classList.remove("active");
});

$('#self_employed').click(function(){
    $('#cm_type').val('2');
    document.getElementById("self_employed").classList.add("active");
    document.getElementById("other_employed").classList.remove("active");
    document.getElementById("salaried").classList.remove("active");
});

$('#other_employed').click(function(){
    $('#cm_type').val('3');
    document.getElementById("other_employed").classList.add("active");
    document.getElementById("self_employed").classList.remove("active");
    document.getElementById("salaried").classList.remove("active");
});

$("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});

</script>
<script type="text/javascript">
imgInp.onchange = evt => {
  const [file] = imgInp.files
  if (file) {
    blah.src = URL.createObjectURL(file)
  }
} 
</script>
<script type="text/javascript">
imgInp.onchange = evt => {
  const [file] = imgInp.files
  if (file) {
    blah.src = URL.createObjectURL(file)
  }
} 
</script>
<script type="text/javascript">
imgInp.onchange = evt => {
  const [file] = imgInp.files
  if (file) {
    blah.src = URL.createObjectURL(file)
  }
} 
</script>
<script type="text/javascript">
imgInp1.onchange = evt => {
  const [file] = imgInp1.files
  if (file) {
    blah1.src = URL.createObjectURL(file)
  }
} 
</script>
<script type="text/javascript">
imgInp.onchange = evt => {
  const [file] = imgInp.files
  if (file) {
    blah.src = URL.createObjectURL(file)
  }
} 

imgInp1.onchange = evt => {
  const [file] = imgInp1.files
  if (file) {
    blah1.src = URL.createObjectURL(file)
  }
} 

imgInp2.onchange = evt => {
  const [file] = imgInp2.files
  if (file) {
    blah2.src = URL.createObjectURL(file)
  }
} 

</script>
<script type="text/javascript">
function yesnoCheckEmployer(that) {
    if (that.value == "2") {
        $(".employer_name").show();
    } 
    else {
        $(".employer_name").hide();
    }
}



// function getSubcategory(val) {
//   $.ajax({
//     type: "GET",
//     url: "{{ route('getSubcategory') }}",
//     data: {'main_id' : val},
//     success: function(data){
//         $("#category-list").html(data);
//     }
//   });
// }

$('input[name=otp_code]').on('keyup' , function() { 
    var email = $("input[name=email]").val();
    var email_otp = $("input[name=otp_code]").val();
    if( email_otp.length == 6 ) {
        $.ajax({
            type: "GET",
            url: "{{ route('email-otp-match') }}",
            data: {'otp' : email_otp, 'email' : email },  
            success: function(data){
                if(data.status == 'Fail'){
                    $(".not_verify").html('Invalid OTP');
                    $(".otp_lab").html('');
                    $(".otp_verify").html('');
                    $(".errors_otp").html('');
                    $(".otp_email").html('');
                } else{
                    $(".not_verify").html('');
                    $(".otp_lab").html('');
                    $(".otp_verify").html('OTP verify');
                    $(".errors_otp").html('');
                    $(".otp_email").html('');
                }
            }
        });
    } else {
        $(".not_verify").html('');
        $(".otp_verify").html('');
    }
}); 


$('input[name=login_otp]').on('keyup' , function() { 
    var id = $("input[name=id]").val();
    var login_otp = $("input[name=login_otp]").val();
    if( login_otp.length == 6 ) {
        $.ajax({
            type: "GET",
            url: "{{ route('login-otp-match') }}",
            data: {'otp' : login_otp, 'id' : id },  
            success: function(data){
                if(data.status == 'Fail'){
                    $(".not_verify").html('Invalid OTP');
                    $(".otp_lab").html('');
                    $(".otp_verify").html('');
                    $(".errors_otp").html('');
                    $(".otp_email").html('');
                } else{
                    $(".not_verify").html('');
                    $(".otp_lab").html('');
                    $(".otp_verify").html('OTP verify');
                    $(".errors_otp").html('');
                    $(".otp_email").html('');
                }
            }
        });
    } else {
        $(".not_verify").html('');
        $(".otp_verify").html('');
    }
}); 

$('input[name=mobile]').on('keyup' , function() { 
    var mobile = $("input[name=mobile]").val();
    if( mobile.length == 7 ) {
        $.ajax({
            type: "GET",
            url: "{{ route('otp-sent') }}",
            data: {'mobile' : mobile},
            success: function(data){
                if(data.status == 'Fail'){
                    $(".already_exist").html('Mobile no. is already exist');
                    $(".valid_no").html('');
                    $(".otp").val('');
                    $(".otp_sent").html('');
                } else{
                    $(".otp_sent").html('OTP sent successfully');
                    $(".valid_no").html('');
                    $(".already_exist").html('');
                }
            }
        });
    } else {
        $(".valid_no").html('Enter a valid mobile number');
        $(".otp").val('');
        $(".already_exist").html('');
        $(".otp_sent").html('');
    }
}); 

$('input[name=email]').on('keyup' , function() { 
    var email = $("input[name=email]").val();
        $.ajax({
            type: "GET",
            url: "{{ route('email-check') }}",
            data: {'email' : email},
            success: function(data){
                if(data.status == 'Fail'){
                    $(".already_exist").html('Email id already registered');
                    $(".valid_no").html('');
                } else{
                    $(".already_exist").html('');
                    $(".valid_no").html('');
                }
            }
        }); 
}); 


$('input[name=otp]').on('keyup' , function() { 
    var otp = $("input[name=otp]").val();
    var mobile = $("input[name=mobile]").val();
    if( otp.length == 6 ) {
        $.ajax({
            type: "GET",
            url: "{{ route('otp-match') }}",
            data: {'otp' : otp, 'mobile' : mobile },  
            success: function(data){
                if(data.status == 'Fail'){
                    $(".not_verify").html('Invalid OTP');
                    $(".otp_lab").html('');
                    $(".otp_verify").html('');
                    $(".errors_otp").html('');
                } else{
                    $(".not_verify").html('');
                    $(".otp_lab").html('');
                    $(".otp_verify").html('OTP verify');
                    $(".errors_otp").html('');
                }
            }
        });
    } else {
        $(".not_verify").html('');
        $(".otp_verify").html('');
    }
}); 


function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}

</script>
<script type="text/javascript">
$(".credit_card1_open").click(function(){
  $(".credit_card1").show();
  $(".credit_card1_open").hide();
});
$(".credit_card2_open").click(function(){
  $(".credit_card2").show();
  $(".credit_card2_open").hide();
});
$(".credit_card3_open").click(function(){
  $(".credit_card3").show();
  $(".credit_card3_open").hide();
});
$(".loan_bus2_open").click(function(){
  $(".bus_lon2").show();
  $(".loan_bus2_open").hide();
});
$(".loan_bus3_open").click(function(){
  $(".bus_lon3").show();
  $(".loan_bus3_open").hide();
});
$(".loan_bus4_open").click(function(){
  $(".bus_lon4").show();
  $(".loan_bus4_open").hide();
});
$(".loan_busin2_open").click(function(){
  $(".loan_busin2").show();
  $(".loan_busin2_open").hide();
});
$(".loan_busin3_open").click(function(){
  $(".loan_busin3").show();
  $(".loan_busin3_open").hide();
});
$(".loan_busin4_open").click(function(){
  $(".loan_busin4").show();
  $(".loan_busin4_open").hide();
});
$(".mortgage_loan2_open").click(function(){
  $(".mortgage_loan2").show();
  $(".mortgage_loan2_open").hide();
});
$(".mortgage_loan3_open").click(function(){
  $(".mortgage_loan3").show();
  $(".mortgage_loan3_open").hide();
});
$(".mortgage_loan4_open").click(function(){
  $(".mortgage_loan4").show();
  $(".mortgage_loan4_open").hide();
});

</script>
<script type="text/javascript">
jQuery(function(){
   jQuery('#start').click();
});

        'use strict';

        /* globals MediaRecorder */
        document.querySelector('#start').addEventListener('click', async () => {
            $('#play').hide();
            $('#download').hide();
            $('#record').show();
        
           
            
            const hasEchoCancellation = document.querySelector('#echoCancellation').checked;
            const constraints = {
                audio: {
                    echoCancellation: {
                        exact: hasEchoCancellation
                    }
                },
                video: {
                    width: 360,
                    height: 200
                }
            };

            console.log('Using media constraints:', constraints);
            await init(constraints);
        });

       
      
         let mediaRecorder;
            let recordedBlobs;
            let timerId = setInterval(() => document.getElementById("record").click(), 30000);

        const errorMsgElement = document.querySelector('span#errorMsg');
        const recordedVideo = document.querySelector('video#recorded');
        const recordButton = document.querySelector('#record');
        const playButton = document.querySelector('#play');
        const downloadButton = document.querySelector('#download');


        recordButton.addEventListener('click', () => {
            if (recordButton.textContent === 'Record') {
                startRecording();

            } else {
                stopRecording();
                recordButton.textContent = 'Record';
                playButton.disabled = false;
                downloadButton.disabled = false;
            }
        });


        playButton.addEventListener('click', () => {
           
            $('#download').show();
            $('#skip').hide();
            const superBuffer = new Blob(recordedBlobs, {
                type: 'video/webm'
            });
            recordedVideo.src = null;
            recordedVideo.srcObject = null;
            recordedVideo.src = window.URL.createObjectURL(superBuffer);
            $('#videofile').val(recordedVideo.src);
            recordedVideo.controls = true;
            recordedVideo.play();
        });


        downloadButton.addEventListener('click', () => {
            const blob = new Blob(recordedBlobs, {
                type: 'video/mp4'
            });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.style.display = 'none';
            // a.href = url;
            // a.download = 'test.mp4';
            document.body.appendChild(a);
            a.click();
            setTimeout(() => {
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
            }, 100);

            var formdata = new FormData();
            formdata.append('blobFile', new Blob(recordedBlobs));
            
            fetch('{{ route('consent-form') }}', {
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: 'POST',
                body: formdata
            }).then(() => {
                window.location.href = 'https://sspl20.com/lnxx/thank-you';
            })

            // $.ajax({
            //     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            //     type: "POST",
            //     url: "{{ route('consent-form') }}",
            //     body: formdata,
            //     // data: {'state_id' : val},
            //     success: function(data){
            //         $("#city").html(data);
            //     }
            // });
        

        });

        function handleDataAvailable(event) {
            console.log('handleDataAvailable', event);
            if (event.data && event.data.size > 0) {
                recordedBlobs.push(event.data);
            }
        }

        function startRecording() {
            recordedBlobs = [];
            let options = {
                mimeType: 'video/webm;codecs=vp9,opus',
                
              
            };
            try {
                mediaRecorder = new MediaRecorder(window.stream, options);
            } catch (e) {
                console.error('Exception while creating MediaRecorder:', e);
                errorMsgElement.innerHTML = `Exception while creating MediaRecorder: ${JSON.stringify(e)}`;
                return;
            } 
            console.log('Created MediaRecorder', mediaRecorder, 'with options', options);
            recordButton.textContent = 'Stop Recording';
            playButton.disabled = true;
            downloadButton.disabled = true;

            mediaRecorder.onstop = (event) =>  
            {
                $('#play').show();
                $('#record').hide();
                console.log('Recorder stopped: ', event);
                console.log('Recorded Blobs: ', recordedBlobs);
            };
            mediaRecorder.ondataavailable = handleDataAvailable;
            mediaRecorder.start();
        
            console.log('MediaRecorder started', mediaRecorder);
        }

        function stopRecording() {
            mediaRecorder.stop();
        }

        function handleSuccess(stream) {
            recordButton.disabled = false;
            console.log('getUserMedia() got stream:', stream);
            window.stream = stream;
            const gumVideo = document.querySelector('video#gum');
            gumVideo.srcObject = stream;
        }

        async function init(constraints) {
            try {
                const stream = await navigator.mediaDevices.getUserMedia(constraints);
                handleSuccess(stream);
            } catch (e) {
                console.error('navigator.getUserMedia error:', e);
                errorMsgElement.innerHTML = `navigator.getUserMedia error:${e.toString()}`;
            }
        }

       
       
</script>
<script type="text/javascript">
    $(document).ready(function(){

      fetch_product_data1();
      function fetch_product_data1(query = '') {
      $.ajax({
       url:"{{ route('live_product_1') }}",
       method:'GET',
       data:{query:query},
       dataType:'json',
       success:function(data) {
        $('#live_product_1').html(data.table_data);
       }
      })
     }

     $(document).on('keyup', '.live_product_1', function(){
      $("#live_product_1").show();    
      var query = $(this).val();
      fetch_product_data1(query);
     });
    });


    function getProduct_Code_1(val) {
        $.ajax({
            type: "GET",
            url: "{{ route('check_product_code') }}",
            data: {'code' : val},
            success: function(data){
                if(data.status == 'Fail'){
                } else{
                    $(".product_id").val(data.product_id);
                    $(".product_name").val(data.product_name);
                }
                $("#live_product_1").hide();   
            }
        });

    }
    
    $(".form-rel").mouseenter(function(){
    $("#live_product_1").slideDown();
    }).mouseleave(function(){
        $("#live_product_1").slideUp();
    });


    $(document).ready(function(){

      fetch_product_data2();
      function fetch_product_data2(query = '') {
      $.ajax({
       url:"{{ route('live_product_2') }}",
       method:'GET',
       data:{query:query},
       dataType:'json',
       success:function(data) {
        $('#live_product_2').html(data.table_data);
       }
      })
     }

     $(document).on('keyup', '.live_product_2', function(){
      $("#live_product_2").show();    
      var query = $(this).val();
      fetch_product_data2(query);
     });
    });


    function getProduct_Code_2(val) {
        $.ajax({
            type: "GET",
            url: "{{ route('check_product_code2') }}",
            data: {'code' : val},
            success: function(data){
                if(data.status == 'Fail'){
                } else{
                    $(".product_id").val(data.product_id);
                    $(".product_name2").val(data.product_name);
                }
                $("#live_product_2").hide();   
            }
        });

    }
    
    $(".form-rel2").mouseenter(function(){
    $("#live_product_2").slideDown();
    }).mouseleave(function(){
        $("#live_product_2").slideUp();
    });

</script>

@extends('frontend.layouts.app')
@section('content')

<section class="personal_details">
<div class="container">  
<div class="row">  
<div class="col-md-7">
<div class="personal_details_box">
<h1 class="app_form_head">Application Form</h1>
<h2 style="margin-bottom: 15px;">Personal loan information</h2>
<!-- <h6 style="margin-top: 12px;margin-bottom: 15px;">Please enter your information to check the offer.</h6> -->
<form action="{{ route('save-personal-loan-information') }}" enctype="multipart/form-data" method="post">
{{ csrf_field() }}  

<div class="row">

  <div class="col-md-6">
    <label class="sub-label">Existing Customer*</label>
    <select name="existing_customer" onChange="ExistingCustomer(this);" class="form-control" required="true">
      <option value="">Select</option>
      <option value="1" @if($result) @if($result->existing_customer == "1") selected @endif @endif >Yes</option>
      <option value="0" @if($result) @if($result->existing_customer == "0") selected @endif @endif >No</option>
    </select>
  </div>

  <div class="col-md-6 account_no" @if($result) @if($result->existing_customer != "1") style="display: none;" @endif @else style="display: none;" @endif >
    <div class="form-group">
      <label class="sub-label">Account No*</label>
      <input name="account_no" class="form-control" @if($result) @if($result->existing_customer == "1") required="true" @endif value="{{ $result->account_no }}" @else value="{{ old('account_no') }}" @endif type="number">
      @if($errors->has('account_no'))
      <span class="text-danger">{{$errors->first('account_no')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6 cif_no" @if($result) @if($result->existing_customer != "0") style="display: none;" @endif @else style="display: none;" @endif >
    <div class="form-group">
      <label class="sub-label">Cif No.*</label>
      <input name="cif_no" class="form-control" @if($result) @if($result->existing_customer == "0") required="true" @endif value="{{ $result->cif_no }}" @else value="{{ old('cif_no') }}" @endif type="text">
      @if($errors->has('cif_no'))
      <span class="text-danger">{{$errors->first('cif_no')}}</span>
      @endif
    </div>
  </div>
  @if($cm_type == 2)
  <div class="col-md-12"> 
    <div class="form-group">
      <label class="sub-label">Tell Us More About Your Business</label>
      <textarea name="about_your_business" rows="4" class="form-control" required="true"> @if($result) {{ $result->about_your_business }} @else {{ old('about_your_business') }} @endif</textarea>
    </div>
  </div>

  <div class="col-md-6 self_employed_type">
    <div class="form-group">
      <label class="sub-label">Company Name*</label>
      <input type="text" @if($cm_sal) value="{{ $cm_sal->self_company_name }}" @else value="{{ old('self_company_name') }}" @endif name="self_company_name" id="self_company_name" class="form-control live_product_2 product_name2" required="true">
      <ul id="live_product_2"></ul> 
      @if($errors->has('self_company_name'))
      <span class="text-danger">{{$errors->first('self_company_name')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Years In Business*</label>
      <input type="number" @if($result) value="{{ $result->years_in_business }}" @else value="{{ old('years_in_business') }}" @endif name="years_in_business" class="form-control" required="true"> 
      @if($errors->has('years_in_business'))
      <span class="text-danger">{{$errors->first('years_in_business')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <label class="sub-label">Designation*</label>
    <select name="designation" class="form-control" required="true">
      <option value="">Select</option>
      <option value="Proprietor" @if($result) @if($result->designation == "Proprietor") selected @endif @endif >Proprietor</option>
      <option value="Partner" @if($result) @if($result->designation == "Partner") selected @endif @endif >Partner</option>
      <option value="Director" @if($result) @if($result->designation == "Director") selected @endif @endif >Director</option>
      <option value="Other" @if($result) @if($result->designation == "Other") selected @endif @endif >Other</option>
    </select>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Paid Up Capital (Aed)*</label>
      <input type="number" @if($result) value="{{ $result->paid_up_capital }}" @else value="{{ old('paid_up_capital') }}" @endif name="paid_up_capital" class="form-control" required="true"> 
      @if($errors->has('paid_up_capital'))
      <span class="text-danger">{{$errors->first('paid_up_capital')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">No. Of Employees (Excl. Owner)*</label>
      <input type="number" @if($result) value="{{ $result->no_of_employees }}" @else value="{{ old('no_of_employees') }}" @endif name="no_of_employees" class="form-control" required="true"> 
      @if($errors->has('no_of_employees'))
      <span class="text-danger">{{$errors->first('no_of_employees')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12">
    <div class="form-group">
      <label class="sub-label">Ownership Details*</label>
      <textarea name="ownership_details" rows="4" class="form-control" required="true"> @if($result) {{ $result->ownership_details }} @else {{ old('ownership_details') }} @endif</textarea> 
      @if($errors->has('ownership_details'))
      <span class="text-danger">{{$errors->first('ownership_details')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Percentage Ownership*</label>
      <input type="number" @if($cm_sal) value="{{ $cm_sal->percentage_ownership }}" @else value="{{ old('percentage_ownership') }}" @endif name="percentage_ownership" class="form-control" required="true"> 
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
        <option value="Retailer Wholesaler" @if(isset($cm_sal->profession_business)) @if($cm_sal->profession_business == "Retailer Wholesaler") selected @endif @endif>Retailer Wholesaler</option>
        <option value="Manufacturer Professional" @if(isset($cm_sal->profession_business)) @if($cm_sal->profession_business == 'Manufacturer Professional') selected @endif @endif>Manufacturer Professional</option>
        <option value="Services" @if(isset($cm_sal->profession_business)) @if($cm_sal->profession_business == 'Services') selected @endif @endif>Services</option>
        <option value="Other" @if(isset($cm_sal->profession_business)) @if($cm_sal->profession_business == 'Other') selected @endif @endif>Other</option>
        <option value="Industry" @if(isset($cm_sal->profession_business)) @if($cm_sal->profession_business == 'Industry') selected @endif @endif>Industry</option>
      </select>
      @if($errors->has('profession_business'))
      <span class="text-danger">{{$errors->first('profession_business')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12">
    <label>Partner Details</label>
  </div>
  
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Partner Name</label>
      <input type="text" @if($result) value="{{ $result->partner_name }}" @else value="{{ old('partner_name') }}" @endif name="partner_name" class="form-control"> 
      @if($errors->has('partner_name'))
      <span class="text-danger">{{$errors->first('partner_name')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Partner Ownership</label>
      <input type="number" @if($result) value="{{ $result->partner_ownership }}" @else value="{{ old('partner_ownership') }}" @endif name="partner_ownership" class="form-control"> 
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
          <option value="{{ $country->id }}" @if($result) @if($result->partner_nationality == $country->id) selected @endif @endif >{{ $country->country_name }}</option>
        @endforeach
      </select>
      @if($errors->has('partner_nationality'))
      <span class="text-danger">{{$errors->first('partner_nationality')}}</span>
      @endif
    </div>
  </div>
  @endif
  <div class="col-md-12">
    <label>Variable Income Details (Aed)</label>
  </div>
     
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Annual Bonus</label>
      <input type="number" @if($result) value="{{ $result->annual_bonus }}" @else value="{{ old('annual_bonus') }}" @endif name="annual_bonus" class="form-control"> 
      @if($errors->has('annual_bonus'))
      <span class="text-danger">{{$errors->first('annual_bonus')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Average Monthly Commission</label>
      <input type="number" @if($result) value="{{ $result->average_monthly_commission }}" @else value="{{ old('average_monthly_commission') }}" @endif name="average_monthly_commission" class="form-control"> 
      @if($errors->has('average_monthly_commission'))
      <span class="text-danger">{{$errors->first('average_monthly_commission')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Average Monthly Overtime</label>
      <input type="number" @if($result) value="{{ $result->average_monthly_overtime }}" @else value="{{ old('average_monthly_overtime') }}" @endif name="average_monthly_overtime" class="form-control"> 
      @if($errors->has('average_monthly_overtime'))
      <span class="text-danger">{{$errors->first('average_monthly_overtime')}}</span>
      @endif
    </div>
  </div>
  @if($marital_status == 'Married')
  <div class="col-md-6">
    <label class="sub-label">Spouse Is A Co-Borrower</label>
    <select name="if_spouse_is_a_co_borrower" onChange="ifSpouseCoBorrower(this);" class="form-control" required="true">
      <option value="">Select</option>
      <option value="1" @if($result) @if($result->if_spouse_is_a_co_borrower == "1") selected @endif @endif >Yes</option>
      <option value="0" @if($result) @if($result->if_spouse_is_a_co_borrower == "0") selected @endif @endif >No</option>
    </select>
  </div>

  <div class="col-md-6 spouse_fixed_monthly_income" style="display: none;">
    <div class="form-group">
      <label class="sub-label">Spouse Fixed Monthly Income</label>
      <input type="number" @if($result) value="{{ $result->spouse_fixed_monthly_income }}" @else value="{{ old('spouse_fixed_monthly_income') }}" @endif name="spouse_fixed_monthly_income" class="form-control"> 
      @if($errors->has('spouse_fixed_monthly_income'))
      <span class="text-danger">{{$errors->first('spouse_fixed_monthly_income')}}</span>
      @endif
    </div>
  </div>
  @endif

  <div class="col-md-12">
    <label>Reference Person In Home Country</label>
  </div>
  <div class="col-md-4">
    <label class="sub-label">Salutation*</label>
    <select name="reference_title" class="form-control" required="true">
      <option value="Mr." @if($result) @if($result->reference_title == 'Mr.') selected @endif @endif >Mr.</option>
      <option value="Mrs." @if($result) @if($result->reference_title == 'Mrs.') selected @endif @endif >Mrs.</option>
      <option value="Miss." @if($result) @if($result->reference_title == 'Miss.') selected @endif @endif >Miss</option>
      <option value="Dr." @if($result) @if($result->reference_title == 'Dr.') selected @endif @endif >Dr.</option>
      <option value="Prof." @if($result) @if($result->reference_title == 'Prof.') selected @endif @endif >Prof.</option>
      <option value="Rev." @if($result) @if($result->reference_title == 'Rev.') selected @endif @endif >Rev.</option>
      <option value="Other" @if($result) @if($result->reference_title == 'Other') selected @endif @endif >Other</option>
    </select>
    @if($errors->has('reference_title'))
      <span class="text-danger">{{$errors->first('reference_title')}}</span>
    @endif
  </div>

  <div class="col-md-8">
    <div class="form-group">
      <label class="sub-label">Full Name*</label>
      <input name="reference_full_name" class="form-control" @if($result) value="{{ $result->reference_full_name }}" @else value="{{ old('reference_full_name') }}" @endif required="true" type="text">
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
        <option value="Father" @if($result) @if($result->reference_relation == 'Father') selected @endif @endif >Father</option>
        <option value="Mother" @if($result) @if($result->reference_relation == 'Mother') selected @endif @endif >Mother</option>
        <option value="Son" @if($result) @if($result->reference_relation == 'Son') selected @endif @endif>Son</option>
        <option value="Daughter" @if($result) @if($result->reference_relation == 'Daughter') selected @endif @endif>Daughter</option>
        <option value="Brother" @if($result) @if($result->reference_relation == 'Brother') selected @endif @endif>Brother</option>
        <option value="Sister" @if($result) @if($result->reference_relation == 'Sister') selected @endif @endif>Sister</option>
        <option value="Grandfather" @if($result) @if($result->reference_relation == 'Grandfather') selected @endif @endif>Grandfather</option>
        <option value="Grandmother" @if($result) @if($result->reference_relation == 'Grandmother') selected @endif @endif>Grandmother</option>
        <option value="Uncle" @if($result) @if($result->reference_relation == 'Uncle') selected @endif @endif >Uncle</option>
        <option value="Aunt" @if($result) @if($result->reference_relation == 'Aunt') selected @endif @endif>Aunt</option>
        <option value="Cousin" @if($result) @if($result->reference_relation == 'Cousin') selected @endif @endif>Cousin</option>
        <option value="Nephew" @if($result) @if($result->reference_relation == 'Nephew') selected @endif @endif>Nephew</option>
        <option value="Niece" @if($result) @if($result->reference_relation == 'Niece') selected @endif @endif>Niece</option>
        <option value="Husband" @if($result) @if($result->reference_relation == 'Husband') selected @endif @endif>Husband</option>
        <option value="Wife" @if($result) @if($result->reference_relation == 'Wife') selected @endif @endif>Wife</option>
      </select>
      @if($errors->has('reference_relation'))
      <span class="text-danger">{{$errors->first('reference_relation')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Mobile No.*</label>
      <input name="reference_mobile_no" class="form-control" @if($result) value="{{ $result->reference_mobile_no }}" @else value="{{ old('reference_mobile_no') }}" @endif required="true" type="number">
      @if($errors->has('reference_mobile_no'))
      <span class="text-danger">{{$errors->first('reference_mobile_no')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Home Telephone No.</label>
      <input name="reference_home_telephone_no" class="form-control" @if($result) value="{{ $result->reference_home_telephone_no }}" @else value="{{ old('reference_home_telephone_no') }}" @endif type="number">
      @if($errors->has('reference_home_telephone_no'))
      <span class="text-danger">{{$errors->first('reference_home_telephone_no')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Address*</label>
      <input name="reference_address" class="form-control" @if($result) value="{{ $result->reference_address }}" @else value="{{ old('reference_address') }}" @endif required="true" type="text">
      @if($errors->has('reference_address'))
      <span class="text-danger">{{$errors->first('reference_address')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Po Box No.*</label>
      <input name="reference_po_box_no" class="form-control" @if($result) value="{{ $result->reference_po_box_no }}" @else value="{{ old('reference_po_box_no') }}" @endif required="true" type="number">
      @if($errors->has('reference_po_box_no'))
      <span class="text-danger">{{$errors->first('reference_po_box_no')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-12">
    <label>Business Reference</label>
  </div>
  <div class="col-md-12">
    <div class="form-group">
      <label class="sub-label">Company Name</label>
      <input name="business_reference_company_name" class="form-control" @if($result) value="{{ $result->business_reference_company_name }}" @else value="{{ old('business_reference_company_name') }}" @endif type="text">
      @if($errors->has('business_reference_company_name'))
      <span class="text-danger">{{$errors->first('business_reference_company_name')}}</span>
      @endif
    </div>
  </div>
  
  <div class="col-md-4">
    <label class="sub-label">Salutation</label>
    <select name="business_title" class="form-control" >
      <option value="Mr." @if($result) @if($result->business_title == 'Mr.') selected @endif @endif >Mr.</option>
      <option value="Mrs." @if($result) @if($result->business_title == 'Mrs.') selected @endif @endif >Mrs.</option>
      <option value="Miss." @if($result) @if($result->business_title == 'Miss.') selected @endif @endif >Miss</option>
      <option value="Dr." @if($result) @if($result->business_title == 'Dr.') selected @endif @endif >Dr.</option>
      <option value="Prof." @if($result) @if($result->business_title == 'Prof.') selected @endif @endif >Prof.</option>
      <option value="Rev." @if($result) @if($result->business_title == 'Rev.') selected @endif @endif >Rev.</option>
      <option value="Other" @if($result) @if($result->business_title == 'Other') selected @endif @endif >Other</option>
    </select>
    @if($errors->has('business_title'))
      <span class="text-danger">{{$errors->first('business_title')}}</span>
    @endif
  </div>
  <div class="col-md-8">
    <div class="form-group">
      <label class="sub-label">Contact Person’S Name</label>
      <input name="business_contact_person_name" class="form-control" @if($result) value="{{ $result->business_contact_person_name }}" @else value="{{ old('business_contact_person_name') }}" @endif type="text">
      @if($errors->has('business_contact_person_name'))
      <span class="text-danger">{{$errors->first('business_contact_person_name')}}</span>
      @endif
    </div>
  </div>
  
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Designation In The Company</label>
      <input name="business_designation" class="form-control" @if($result) value="{{ $result->business_designation }}" @else value="{{ old('business_designation') }}" @endif type="text">
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
        <option value="Father" @if($result) @if($result->business_relationship == 'Father') selected @endif @endif >Father</option>
        <option value="Mother" @if($result) @if($result->business_relationship == 'Mother') selected @endif @endif >Mother</option>
        <option value="Son" @if($result) @if($result->business_relationship == 'Son') selected @endif @endif>Son</option>
        <option value="Daughter" @if($result) @if($result->business_relationship == 'Daughter') selected @endif @endif>Daughter</option>
        <option value="Brother" @if($result) @if($result->business_relationship == 'Brother') selected @endif @endif>Brother</option>
        <option value="Sister" @if($result) @if($result->business_relationship == 'Sister') selected @endif @endif>Sister</option>
        <option value="Grandfather" @if($result) @if($result->business_relationship == 'Grandfather') selected @endif @endif>Grandfather</option>
        <option value="Grandmother" @if($result) @if($result->business_relationship == 'Grandmother') selected @endif @endif>Grandmother</option>
        <option value="Uncle" @if($result) @if($result->business_relationship == 'Uncle') selected @endif @endif >Uncle</option>
        <option value="Aunt" @if($result) @if($result->business_relationship == 'Aunt') selected @endif @endif>Aunt</option>
        <option value="Cousin" @if($result) @if($result->business_relationship == 'Cousin') selected @endif @endif>Cousin</option>
        <option value="Nephew" @if($result) @if($result->business_relationship == 'Nephew') selected @endif @endif>Nephew</option>
        <option value="Niece" @if($result) @if($result->business_relationship == 'Niece') selected @endif @endif>Niece</option>
        <option value="Husband" @if($result) @if($result->business_relationship == 'Husband') selected @endif @endif>Husband</option>
        <option value="Wife" @if($result) @if($result->business_relationship == 'Wife') selected @endif @endif>Wife</option>
      </select>
      @if($errors->has('business_relationship'))
      <span class="text-danger">{{$errors->first('business_relationship')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Contact Number</label>
      <input name="business_contact_number" class="form-control" @if($result) value="{{ $result->business_contact_number }}" @else value="{{ old('business_contact_number') }}" @endif type="number">
      @if($errors->has('business_contact_number'))
      <span class="text-danger">{{$errors->first('business_contact_number')}}</span>
      @endif
    </div>
  </div> 
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Address</label>
      <input name="business_address" class="form-control" @if($result) value="{{ $result->business_address }}" @else value="{{ old('business_address') }}" @endif type="text">
      @if($errors->has('business_address'))
      <span class="text-danger">{{$errors->first('business_address')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Emirate</label>
      <input name="business_emirate" class="form-control" @if($result) value="{{ $result->business_emirate }}" @else value="{{ old('business_emirate') }}" @endif type="text">
      @if($errors->has('business_emirate'))
      <span class="text-danger">{{$errors->first('business_emirate')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12">
    <label>Reference Details:-</label>
    <label style="width: 100%; font-size: 15px;">Reference 1</label>
  </div>
  <div class="col-md-4">
    <label class="sub-label">Salutation*</label>
    <select name="reference_1_title" class="form-control" required="true">
      <option value="Mr." @if($result) @if($result->reference_1_title == 'Mr.') selected @endif @endif >Mr.</option>
      <option value="Mrs." @if($result) @if($result->reference_1_title == 'Mrs.') selected @endif @endif >Mrs.</option>
      <option value="Miss." @if($result) @if($result->reference_1_title == 'Miss.') selected @endif @endif >Miss</option>
      <option value="Dr." @if($result) @if($result->reference_1_title == 'Dr.') selected @endif @endif >Dr.</option>
      <option value="Prof." @if($result) @if($result->reference_1_title == 'Prof.') selected @endif @endif >Prof.</option>
      <option value="Rev." @if($result) @if($result->reference_1_title == 'Rev.') selected @endif @endif >Rev.</option>
      <option value="Other" @if($result) @if($result->reference_1_title == 'Other') selected @endif @endif >Other</option>
    </select>
    @if($errors->has('reference_1_title'))
      <span class="text-danger">{{$errors->first('reference_1_title')}}</span>
    @endif
  </div>
  <div class="col-md-8">
    <div class="form-group">
      <label class="sub-label">Full Name*</label>
      <input name="reference_1_name" required="true" class="form-control" @if($result) value="{{ $result->reference_1_name }}" @else value="{{ old('reference_1_name') }}" @endif type="text">
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
        <option value="Father" @if($result) @if($result->reference_1_relation == 'Father') selected @endif @endif >Father</option>
        <option value="Mother" @if($result) @if($result->reference_1_relation == 'Mother') selected @endif @endif >Mother</option>
        <option value="Son" @if($result) @if($result->reference_1_relation == 'Son') selected @endif @endif>Son</option>
        <option value="Daughter" @if($result) @if($result->reference_1_relation == 'Daughter') selected @endif @endif>Daughter</option>
        <option value="Brother" @if($result) @if($result->reference_1_relation == 'Brother') selected @endif @endif>Brother</option>
        <option value="Sister" @if($result) @if($result->reference_1_relation == 'Sister') selected @endif @endif>Sister</option>
        <option value="Grandfather" @if($result) @if($result->reference_1_relation == 'Grandfather') selected @endif @endif>Grandfather</option>
        <option value="Grandmother" @if($result) @if($result->reference_1_relation == 'Grandmother') selected @endif @endif>Grandmother</option>
        <option value="Uncle" @if($result) @if($result->reference_1_relation == 'Uncle') selected @endif @endif >Uncle</option>
        <option value="Aunt" @if($result) @if($result->reference_1_relation == 'Aunt') selected @endif @endif>Aunt</option>
        <option value="Cousin" @if($result) @if($result->reference_1_relation == 'Cousin') selected @endif @endif>Cousin</option>
        <option value="Nephew" @if($result) @if($result->reference_1_relation == 'Nephew') selected @endif @endif>Nephew</option>
        <option value="Niece" @if($result) @if($result->reference_1_relation == 'Niece') selected @endif @endif>Niece</option>
        <option value="Husband" @if($result) @if($result->reference_1_relation == 'Husband') selected @endif @endif>Husband</option>
        <option value="Wife" @if($result) @if($result->reference_1_relation == 'Wife') selected @endif @endif>Wife</option>
      </select>
      @if($errors->has('reference_1_relation'))
      <span class="text-danger">{{$errors->first('reference_1_relation')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Mobile No.*</label>
      <input name="reference_1_mobile_no" required="true" class="form-control" @if($result) value="{{ $result->reference_1_mobile_no }}" @else value="{{ old('reference_1_mobile_no') }}" @endif type="number">
      @if($errors->has('reference_1_mobile_no'))
      <span class="text-danger">{{$errors->first('reference_1_mobile_no')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Emirate*</label>
      <input name="reference_1_emirate" required="true" class="form-control" @if($result) value="{{ $result->reference_1_emirate }}" @else value="{{ old('reference_1_emirate') }}" @endif type="text">
      @if($errors->has('reference_1_emirate'))
      <span class="text-danger">{{$errors->first('reference_1_emirate')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Office Telephone No.</label>
      <input name="reference_1_office_telephone" class="form-control" @if($result) value="{{ $result->reference_1_office_telephone }}" @else value="{{ old('reference_1_office_telephone') }}" @endif type="text">
      @if($errors->has('reference_1_office_telephone'))
      <span class="text-danger">{{$errors->first('reference_1_office_telephone')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">E-Mail</label>
      <input name="reference_1_email" class="form-control" @if($result) value="{{ $result->reference_1_email }}" @else value="{{ old('reference_1_email') }}" @endif type="email">
      @if($errors->has('reference_1_email'))
      <span class="text-danger">{{$errors->first('reference_1_email')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12">
    <label style="width: 100%; font-size: 15px;">Reference 2</label>
  </div>
  <div class="col-md-4">
    <label class="sub-label">Salutation*</label>
    <select name="reference_2_title" class="form-control" required="true">
      <option value="Mr." @if($result) @if($result->reference_2_title == 'Mr.') selected @endif @endif >Mr.</option>
      <option value="Mrs." @if($result) @if($result->reference_2_title == 'Mrs.') selected @endif @endif >Mrs.</option>
      <option value="Miss." @if($result) @if($result->reference_2_title == 'Miss.') selected @endif @endif >Miss</option>
      <option value="Dr." @if($result) @if($result->reference_2_title == 'Dr.') selected @endif @endif >Dr.</option>
      <option value="Prof." @if($result) @if($result->reference_2_title == 'Prof.') selected @endif @endif >Prof.</option>
      <option value="Rev." @if($result) @if($result->reference_2_title == 'Rev.') selected @endif @endif >Rev.</option>
      <option value="Other" @if($result) @if($result->reference_2_title == 'Other') selected @endif @endif >Other</option>
    </select>
    @if($errors->has('reference_2_title'))
      <span class="text-danger">{{$errors->first('reference_2_title')}}</span>
    @endif
  </div>
  <div class="col-md-8">
    <div class="form-group">
      <label class="sub-label">Full Name*</label>
      <input name="reference_2_name" required="true" class="form-control" @if($result) value="{{ $result->reference_2_name }}" @else value="{{ old('reference_2_name') }}" @endif type="text">
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
        <option value="Father" @if($result) @if($result->reference_2_relation == 'Father') selected @endif @endif >Father</option>
        <option value="Mother" @if($result) @if($result->reference_2_relation == 'Mother') selected @endif @endif >Mother</option>
        <option value="Son" @if($result) @if($result->reference_2_relation == 'Son') selected @endif @endif>Son</option>
        <option value="Daughter" @if($result) @if($result->reference_2_relation == 'Daughter') selected @endif @endif>Daughter</option>
        <option value="Brother" @if($result) @if($result->reference_2_relation == 'Brother') selected @endif @endif>Brother</option>
        <option value="Sister" @if($result) @if($result->reference_2_relation == 'Sister') selected @endif @endif>Sister</option>
        <option value="Grandfather" @if($result) @if($result->reference_2_relation == 'Grandfather') selected @endif @endif>Grandfather</option>
        <option value="Grandmother" @if($result) @if($result->reference_2_relation == 'Grandmother') selected @endif @endif>Grandmother</option>
        <option value="Uncle" @if($result) @if($result->reference_2_relation == 'Uncle') selected @endif @endif >Uncle</option>
        <option value="Aunt" @if($result) @if($result->reference_2_relation == 'Aunt') selected @endif @endif>Aunt</option>
        <option value="Cousin" @if($result) @if($result->reference_2_relation == 'Cousin') selected @endif @endif>Cousin</option>
        <option value="Nephew" @if($result) @if($result->reference_2_relation == 'Nephew') selected @endif @endif>Nephew</option>
        <option value="Niece" @if($result) @if($result->reference_2_relation == 'Niece') selected @endif @endif>Niece</option>
        <option value="Husband" @if($result) @if($result->reference_2_relation == 'Husband') selected @endif @endif>Husband</option>
        <option value="Wife" @if($result) @if($result->reference_2_relation == 'Wife') selected @endif @endif>Wife</option>
      </select>
      @if($errors->has('reference_2_relation'))
      <span class="text-danger">{{$errors->first('reference_2_relation')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Mobile No.*</label>
      <input name="reference_2_mobile_no" required="true" class="form-control" @if($result) value="{{ $result->reference_2_mobile_no }}" @else value="{{ old('reference_2_mobile_no') }}" @endif type="number">
      @if($errors->has('reference_2_mobile_no'))
      <span class="text-danger">{{$errors->first('reference_2_mobile_no')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Emirate*</label>
      <input name="reference_2_emirate" required="true" class="form-control" @if($result) value="{{ $result->reference_2_emirate }}" @else value="{{ old('reference_2_emirate') }}" @endif type="text">
      @if($errors->has('reference_2_emirate'))
      <span class="text-danger">{{$errors->first('reference_2_emirate')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Office Telephone No.</label>
      <input name="reference_2_office_telephone" class="form-control" @if($result) value="{{ $result->reference_2_office_telephone }}" @else value="{{ old('reference_2_office_telephone') }}" @endif type="text">
      @if($errors->has('reference_2_office_telephone'))
      <span class="text-danger">{{$errors->first('reference_2_office_telephone')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">E-Mail</label>
      <input name="reference_2_email" class="form-control" @if($result) value="{{ $result->reference_2_email }}" @else value="{{ old('reference_2_email') }}" @endif type="email">
      @if($errors->has('reference_2_email'))
      <span class="text-danger">{{$errors->first('reference_2_email')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12">
    <label>Personal Loan Application</label>
  </div>

  <div class="col-md-6">
    <label class="sub-label">Purpose Of Loan*</label>
    <select name="purpose_of_loan" class="form-control" required="true">
      <option value="">Select</option>
      <option value="Education" @if($result) @if($result->purpose_of_loan == 'Education') selected @endif @endif >Education</option>
      <option value="Property" @if($result) @if($result->purpose_of_loan == 'Property') selected @endif @endif >Property</option>
      <option value="Household" @if($result) @if($result->purpose_of_loan == 'Household') selected @endif @endif >Household</option>
      <option value="Rent" @if($result) @if($result->purpose_of_loan == 'Rent') selected @endif @endif >Rent</option>
      <option value="Business" @if($result) @if($result->purpose_of_loan == 'Business') selected @endif @endif >Business</option>
      <option value="Personal" @if($result) @if($result->purpose_of_loan == 'Personal') selected @endif @endif >Personal</option>
      <option value="Other" @if($result) @if($result->purpose_of_loan == 'Other') selected @endif @endif >Other</option>
    </select>
    @if($errors->has('purpose_of_loan'))
      <span class="text-danger">{{ $errors->first('purpose_of_loan') }}</span>
    @endif
  </div>
  

  <div class="col-md-6">
    <label class="sub-label">If You Have A Co-Borrower*</label>
    <select name="if_you_have_co_borrower" onChange="ifYouHaveCOBorrower(this);" class="form-control" required="true">
      <option value="">Select</option>
      <option value="1" @if($result) @if($result->if_you_have_co_borrower == "1") selected @endif @endif >Yes</option>
      <option value="0" @if($result) @if($result->if_you_have_co_borrower == "0") selected @endif @endif >No</option>
    </select>
  </div>

  <div class="col-md-12 HaveCOBorrower" @if($result) @if($result->if_you_have_co_borrower == "0") style="display: none;" @endif @else style="display: none;" @endif >
    <label style="font-size: 15px;">Co-Borrower Details:</label>
  </div>

  <div class="col-md-4 HaveCOBorrower" @if($result) @if($result->if_you_have_co_borrower == "0") style="display: none;" @endif @else style="display: none;" @endif >
    <label class="sub-label">Salutation*</label>
    <select name="co_borrower_title" class="form-control">
      <option value="Mr." @if($result) @if($result->co_borrower_title == 'Mr.') selected @endif @endif >Mr.</option>
      <option value="Mrs." @if($result) @if($result->co_borrower_title == 'Mrs.') selected @endif @endif >Mrs.</option>
      <option value="Miss." @if($result) @if($result->co_borrower_title == 'Miss.') selected @endif @endif >Miss</option>
      <option value="Dr." @if($result) @if($result->co_borrower_title == 'Dr.') selected @endif @endif >Dr.</option>
      <option value="Prof." @if($result) @if($result->co_borrower_title == 'Prof.') selected @endif @endif >Prof.</option>
      <option value="Rev." @if($result) @if($result->co_borrower_title == 'Rev.') selected @endif @endif >Rev.</option>
      <option value="Other" @if($result) @if($result->co_borrower_title == 'Other') selected @endif @endif >Other</option>
    </select>
    @if($errors->has('co_borrower_title'))
      <span class="text-danger">{{$errors->first('co_borrower_title')}}</span>
    @endif
  </div>
  <div class="col-md-8 HaveCOBorrower" @if($result) @if($result->if_you_have_co_borrower == "0") style="display: none;" @endif @else style="display: none;" @endif >
    <div class="form-group">
      <label class="sub-label">Co-Borrower Name*</label>
      <input name="co_borrower_name" class="form-control" @if($result) value="{{ $result->co_borrower_name }}" @else value="{{ old('co_borrower_name') }}" @endif type="text">
      @if($errors->has('co_borrower_name'))
      <span class="text-danger">{{$errors->first('co_borrower_name')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6 HaveCOBorrower" @if($result) @if($result->if_you_have_co_borrower == "0") style="display: none;" @endif @else style="display: none;" @endif >
    <div class="form-group">
      <label class="sub-label">Relationship To Primary Borrower*</label>
      <input name="relationship_to_primary_borrower" class="form-control" @if($result) value="{{ $result->relationship_to_primary_borrower }}" @else value="{{ old('relationship_to_primary_borrower') }}" @endif type="text">
      @if($errors->has('relationship_to_primary_borrower'))
      <span class="text-danger">{{$errors->first('relationship_to_primary_borrower')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6 HaveCOBorrower" @if($result) @if($result->if_you_have_co_borrower == "0") style="display: none;" @endif @else style="display: none;" @endif >
    <div class="form-group">
      <label class="sub-label" style="width: 100%;">Upload Co-Borrower Signature*</label>
      <input name="co_borrower_signature" style="box-shadow: none; float: left; padding-left: 0px; width: 70%;" class="form-control" type="file">
      @if($result)
        @if($result->co_borrower_signature)   <a href="{!! asset($result->co_borrower_signature) !!}" download="" style="float: right;">Download</a>  @endif
      @endif 
      @if($errors->has('co_borrower_signature'))
      <span class="text-danger">{{$errors->first('co_borrower_signature')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6 HaveCOBorrower" @if($result) @if($result->if_you_have_co_borrower == "0") style="display: none;" @endif @else style="display: none;" @endif >
    <div class="form-group">
      <label class="sub-label">Co-Borrower Date*</label>
      <input id="date_of_joining" name="co_borrower_date" class="form-control" @if($result) value="{{ $result->co_borrower_date }}" @else value="{{ old('co_borrower_date') }}" @endif type="text">
      <i class="fa-solid fa-calendar"></i>
      @if($errors->has('co_borrower_date'))
      <span class="text-danger">{{$errors->first('co_borrower_date')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-12"></div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Loan Amount (Aed)*</label>
      <input name="loan_amount" required="true" class="form-control" @if($result) value="{{ $result->loan_amount }}" @else value="{{ old('loan_amount') }}" @endif type="number">
      @if($errors->has('loan_amount'))
      <span class="text-danger">{{$errors->first('loan_amount')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Interest Rate (Per Annum)*</label>
      <input name="interest_rate" required="true" class="form-control" @if($result) value="{{ $result->interest_rate }}" @else value="{{ old('interest_rate') }}" @endif type="number">
      @if($errors->has('interest_rate'))
      <span class="text-danger">{{$errors->first('interest_rate')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Number Of Installments (Months)*</label>
      <input name="number_of_installments" required="true" class="form-control" @if($result) value="{{ $result->number_of_installments }}" @else value="{{ old('number_of_installments') }}" @endif type="number">
      @if($errors->has('number_of_installments'))
      <span class="text-danger">{{$errors->first('number_of_installments')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Installment Start Date*</label>
      <input id="my_date_picker" required="true" name="installment_start_date" class="form-control" @if($result) value="{{ $result->installment_start_date }}" @else value="{{ old('installment_start_date') }}" @endif type="text">
      <i class="fa-solid fa-calendar"></i>
      @if($errors->has('installment_start_date'))
      <span class="text-danger">{{$errors->first('installment_start_date')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Monthly Installment Amount (Aed)*</label>
      <input name="monthly_installment_amount" required="true" class="form-control" @if($result) value="{{ $result->monthly_installment_amount }}" @else value="{{ old('monthly_installment_amount') }}" @endif type="number">
      @if($errors->has('monthly_installment_amount'))
      <span class="text-danger">{{$errors->first('monthly_installment_amount')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Processing Fee (Aed)*</label>
      <input name="processing_fee" required="true" class="form-control" @if($result) value="{{ $result->processing_fee }}" @else value="{{ old('processing_fee') }}" @endif type="number">
      @if($errors->has('processing_fee'))
      <span class="text-danger">{{$errors->first('processing_fee')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-12">
    <label>Existing Financing Details/Other Banking Relationship</label>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Institution Name</label>
      <input name="institution_name" class="form-control" @if($result) value="{{ $result->institution_name }}" @else value="{{ old('institution_name') }}" @endif type="text">
      @if($errors->has('institution_name'))
      <span class="text-danger">{{$errors->first('institution_name')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Product/Card Type</label>
      <input name="product_card_type" class="form-control" @if($result) value="{{ $result->product_card_type }}" @else value="{{ old('product_card_type') }}" @endif type="text">
      @if($errors->has('product_card_type'))
      <span class="text-danger">{{$errors->first('product_card_type')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Account/Card Number</label>
      <input name="account_card_number" class="form-control" @if($result) value="{{ $result->account_card_number }}" @else value="{{ old('account_card_number') }}" @endif type="number">
      @if($errors->has('account_card_number'))
      <span class="text-danger">{{$errors->first('account_card_number')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Finance Amount (Aed)</label>
      <input name="finance_amount" class="form-control" @if($result) value="{{ $result->finance_amount }}" @else value="{{ old('finance_amount') }}" @endif type="number">
      @if($errors->has('finance_amount'))
      <span class="text-danger">{{$errors->first('finance_amount')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Monthly Installment (Aed)</label>
      <input name="monthly_installment" class="form-control" @if($result) value="{{ $result->monthly_installment }}" @else value="{{ old('monthly_installment') }}" @endif type="number">
      @if($errors->has('monthly_installment'))
      <span class="text-danger">{{$errors->first('monthly_installment')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Outstanding Balance (Aed)</label>
      <input name="outstanding_balance" class="form-control" @if($result) value="{{ $result->outstanding_balance }}" @else value="{{ old('outstanding_balance') }}" @endif type="number">
      @if($errors->has('outstanding_balance'))
      <span class="text-danger">{{$errors->first('outstanding_balance')}}</span>
      @endif
    </div>
  </div>
  
  <div class="col-md-12">
    <label>Personal Finance Details</label>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Type Of Personal Finance</label>
      <select name="type_of_personal_finance" class="form-control">
      <option value="New/Fresh Case" @if($result) @if($result->type_of_personal_finance == 'New/Fresh Case') selected @endif @endif >New/Fresh Case</option>
      <option value="Debt Settlement" @if($result) @if($result->type_of_personal_finance == 'Debt Settlement') selected @endif @endif >Debt Settlement</option>
      <option value="Secured Finance" @if($result) @if($result->type_of_personal_finance == 'Secured Finance') selected @endif @endif >Secured Finance</option>
      <option value="Consolidation (Existing CM facilities)" @if($result) @if($result->type_of_personal_finance == 'Consolidation (Existing CM facilities)') selected @endif @endif >Consolidation (Existing CM facilities)</option>
      <option value="Investment Murabaha (Finance Against Shares)" @if($result) @if($result->type_of_personal_finance == 'Investment Murabaha (Finance Against Shares)') selected @endif @endif >Investment Murabaha (Finance Against Shares)</option>
      <option value="Top-Up" @if($result) @if($result->type_of_personal_finance == 'Top-Up') selected @endif @endif >Top-Up</option>
    </select>
    @if($errors->has('type_of_personal_finance'))
      <span class="text-danger">{{$errors->first('type_of_personal_finance')}}</span>
    @endif
    </div>
  </div>

  <div class="col-md-12">
    <label>Type Of Murabaha</label>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Investment Murabaha</label>
      <select name="investment_murabaha" class="form-control">
      <option value="Account Numbers (If Available)" @if($result) @if($result->investment_murabaha == 'Account Numbers (If Available)') selected @endif @endif >Account Numbers (If Available)</option>
      <option value="Dfm/Nasdaq Account Number" @if($result) @if($result->investment_murabaha == 'Dfm/Nasdaq Account Number') selected @endif @endif >Dfm/Nasdaq Account Number</option>
      <option value="Adx Account Number" @if($result) @if($result->investment_murabaha == 'Adx Account Number') selected @endif @endif >Adx Account Number</option>
      <option value="Enbds Account Number" @if($result) @if($result->investment_murabaha == 'Enbds Account Number') selected @endif @endif >Enbds Account Number</option>
      <option value="Current/Savings Account Number" @if($result) @if($result->investment_murabaha == 'Current/Savings Account Number') selected @endif @endif >Current/Savings Account Number</option>
      <option value="Ei Stock Trading Account Number" @if($result) @if($result->investment_murabaha == 'Ei Stock Trading Account Number') selected @endif @endif >Ei Stock Trading Account Number</option>
      <option value="Certificates Murabaha" @if($result) @if($result->investment_murabaha == 'Certificates Murabaha') selected @endif @endif >Certificates Murabaha</option>
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
      <option value="Total Finance Amount" @if($result) @if($result->requested_financing_details == 'Total Finance Amount') selected @endif @endif >Total Finance Amount</option>
      <option value="Profit Rate" @if($result) @if($result->requested_financing_details == 'Profit Rate') selected @endif @endif >Profit Rate</option>
      <option value="Tenure" @if($result) @if($result->requested_financing_details == 'Tenure') selected @endif @endif >Tenure</option>
      <option value="Installment Amount (Emi)" @if($result) @if($result->requested_financing_details == 'Installment Amount (Emi)') selected @endif @endif >Installment Amount (Emi)</option>
      <option value="Due Date (1St Emi Date)" @if($result) @if($result->requested_financing_details == 'Due Date (1St Emi Date)') selected @endif @endif >Due Date (1St Emi Date)</option>
      <option value="Salary Transfer Date" @if($result) @if($result->requested_financing_details == 'Salary Transfer Date') selected @endif @endif >Salary Transfer Date</option>
    </select>
    @if($errors->has('requested_financing_details'))
      <span class="text-danger">{{$errors->first('requested_financing_details')}}</span>
    @endif
    </div>
  </div>
  
  <div class="col-md-12">
    <label>Repayment Details</label>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Customer Segment</label>
      <select name="customer_segment" class="form-control">
        <option value="Salary Transfer" @if($result) @if($result->customer_segment == 'Salary Transfer') selected @endif @endif >Salary Transfer</option>
        <option value="Non Salary Transfer" @if($result) @if($result->customer_segment == 'Non Salary Transfer') selected @endif @endif >Non Salary Transfer</option>
        <option value="Self Employed" @if($result) @if($result->customer_segment == 'Self Employed') selected @endif @endif >Self Employed</option>
        <option value="Other" @if($result) @if($result->customer_segment == 'Other') selected @endif @endif >Other</option>
      </select>
    @if($errors->has('customer_segment'))
      <span class="text-danger">{{$errors->first('customer_segment')}}</span>
    @endif
    </div>
  </div>
  
  <div class="col-md-12">
    <label>Payment Method</label>
    <label style="width: 100%;font-size: 15px;">Payment From</label>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Direct debit account number</label>
      <input name="direct_debit_account_number" class="form-control" @if($result) value="{{ $result->direct_debit_account_number }}" @else value="{{ old('direct_debit_account_number') }}" @endif type="number">
      @if($errors->has('direct_debit_account_number'))
      <span class="text-danger">{{$errors->first('direct_debit_account_number')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12">
    <label style="width: 100%;font-size: 15px;">Payment From Other Bank (Uaedds)</label>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Direct debit account number</label>
      <input name="other_bank_direct_debit_account_number" class="form-control" @if($result) value="{{ $result->other_bank_direct_debit_account_number }}" @else value="{{ old('other_bank_direct_debit_account_number') }}" @endif type="number">
      @if($errors->has('other_bank_direct_debit_account_number'))
      <span class="text-danger">{{$errors->first('other_bank_direct_debit_account_number')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Bank name</label>
      <input name="other_bank_name" class="form-control" @if($result) value="{{ $result->other_bank_name }}" @else value="{{ old('other_bank_name') }}" @endif type="text">
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
        <option value="Monthly" @if($result) @if($result->frequency_of_payment == 'Monthly') selected @endif @endif >Monthly</option>
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
        <option value="Current Account" @if($result) @if($result->type_of_new_account == 'Current Account') selected @endif @endif >Current Account</option>
        <option value="Savings Account" @if($result) @if($result->type_of_new_account == 'Savings Account') selected @endif @endif >Savings Account</option>
        <option value="Other" @if($result) @if($result->type_of_new_account == 'Other') selected @endif @endif >Other</option>
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
        <option value="Noor Takaful" @if($result) @if($result->takaful == 'Noor Takaful') selected @endif @endif >Noor Takaful</option>
        <option value="Arabian Scandinavian Insurance Company (Plc) - Takaful - Ascana Insurance (Ascana)" @if($result) @if($result->takaful == 'Arabian Scandinavian Insurance Company (Plc) - Takaful - Ascana Insurance (Ascana)') selected @endif @endif >Arabian Scandinavian Insurance Company (Plc) - Takaful - Ascana Insurance (Ascana)</option>
        <option value="Dubai Islamic Insurance & Reinsurance Company(Aman)" @if($result) @if($result->takaful == 'Dubai Islamic Insurance & Reinsurance Company(Aman)') selected @endif @endif >Dubai Islamic Insurance & Reinsurance Company(Aman)</option>
      </select>
      @if($errors->has('takaful'))
        <span class="text-danger">{{$errors->first('takaful')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-12">
    <label>Takaful Protection For Adib Personal Finance</label>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">I Would Like To Receive A Special Rate To Participate In The Takaful Protection For Adib Personal Finance*</label>
      <select name="receive_a_special_rate_to_participate" class="form-control">
        <option value="1" @if($result) @if($result->receive_a_special_rate_to_participate == '1') selected @endif @endif >Yes</option>
        <option value="0" @if($result) @if($result->receive_a_special_rate_to_participate == '0') selected @endif @endif >No</option>
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
        <option value="1" @if($result) @if($result->ever_obtained_al_khair_financing == '1') selected @endif @endif >Yes</option>
        <option value="0" @if($result) @if($result->ever_obtained_al_khair_financing == '0') selected @endif @endif >No</option>
      </select>
      @if($errors->has('ever_obtained_al_khair_financing'))
        <span class="text-danger">{{$errors->first('ever_obtained_al_khair_financing')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-12">
    <label>Details Of Bank Accounts</label>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Bank name</label>
      <input name="details_bank_name" class="form-control" @if($result) value="{{ $result->details_bank_name }}" @else value="{{ old('details_bank_name') }}" @endif type="text">
      @if($errors->has('details_bank_name'))
      <span class="text-danger">{{$errors->first('details_bank_name')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Branch</label>
      <input name="details_branch" class="form-control" @if($result) value="{{ $result->details_branch }}" @else value="{{ old('details_branch') }}" @endif type="text">
      @if($errors->has('details_branch'))
      <span class="text-danger">{{$errors->first('details_branch')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Account Since</label>
      <input name="details_account_since" id="spouse_date_of_birth" class="form-control" @if($result) value="{{ $result->details_account_since }}" @else value="{{ old('details_account_since') }}" @endif type="text">
      <i class="fa-solid fa-calendar"></i>
      @if($errors->has('details_account_since'))
      <span class="text-danger">{{$errors->first('details_account_since')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12">
    <label>Details Of Credit Cards</label>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Bank name</label>
      <input name="details_credit_bank" class="form-control" @if($result) value="{{ $result->details_credit_bank }}" @else value="{{ old('details_credit_bank') }}" @endif type="text">
      @if($errors->has('details_credit_bank'))
      <span class="text-danger">{{$errors->first('details_credit_bank')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Limit (Aed)</label>
      <input name="details_credit_limit" class="form-control" @if($result) value="{{ $result->details_credit_limit }}" @else value="{{ old('details_credit_limit') }}" @endif type="number">
      @if($errors->has('details_credit_limit'))
      <span class="text-danger">{{$errors->first('details_credit_limit')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Account Since</label>
      <input name="details_credit_account_since" class="member_joining form-control" @if($result) value="{{ $result->details_credit_account_since }}" @else value="{{ old('details_credit_account_since') }}" @endif type="text">
      <i class="fa-solid fa-calendar"></i>
      @if($errors->has('details_credit_account_since'))
      <span class="text-danger">{{$errors->first('details_credit_account_since')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-12">
    <label>Information On Liabilities</label>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Bank Name</label>
      <input name="liabilities_bank_name" class="form-control" @if($result) value="{{ $result->liabilities_bank_name }}" @else value="{{ old('liabilities_bank_name') }}" @endif type="text">
      @if($errors->has('liabilities_bank_name'))
      <span class="text-danger">{{$errors->first('liabilities_bank_name')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Facility Type</label>
      <input name="liabilities_facility_type" class="form-control" @if($result) value="{{ $result->liabilities_facility_type }}" @else value="{{ old('liabilities_facility_type') }}" @endif type="text">
      @if($errors->has('liabilities_facility_type'))
      <span class="text-danger">{{$errors->first('liabilities_facility_type')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Monthly Installment Amount</label>
      <input name="liabilities_monthly_installment_amount" class="form-control" @if($result) value="{{ $result->liabilities_monthly_installment_amount }}" @else value="{{ old('liabilities_monthly_installment_amount') }}" @endif type="number">
      @if($errors->has('liabilities_monthly_installment_amount'))
      <span class="text-danger">{{$errors->first('liabilities_monthly_installment_amount')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Outstanding Amount</label>
      <input name="liabilities_outstanding_amount" class="form-control" @if($result) value="{{ $result->liabilities_outstanding_amount }}" @else value="{{ old('liabilities_outstanding_amount') }}" @endif type="number">
      @if($errors->has('liabilities_outstanding_amount'))
      <span class="text-danger">{{$errors->first('liabilities_outstanding_amount')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12">
    <label>Customer'S Liabilities With Other Banks That Are To Be Settled</label>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Bank Name</label>
      <input name="liabilities_other_bank_name" class="form-control" @if($result) value="{{ $result->liabilities_other_bank_name }}" @else value="{{ old('liabilities_other_bank_name') }}" @endif type="text">
      @if($errors->has('liabilities_other_bank_name'))
      <span class="text-danger">{{$errors->first('liabilities_other_bank_name')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Facility Type</label>
      <input name="liabilities_other_facility_type" class="form-control" @if($result) value="{{ $result->liabilities_other_facility_type }}" @else value="{{ old('liabilities_other_facility_type') }}" @endif type="text">
      @if($errors->has('liabilities_other_facility_type'))
      <span class="text-danger">{{$errors->first('liabilities_other_facility_type')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Monthly Installment Amount</label>
      <input name="liabilities_other_monthly_installment_amount" class="form-control" @if($result) value="{{ $result->liabilities_other_monthly_installment_amount }}" @else value="{{ old('liabilities_other_monthly_installment_amount') }}" @endif type="number">
      @if($errors->has('liabilities_other_monthly_installment_amount'))
      <span class="text-danger">{{$errors->first('liabilities_other_monthly_installment_amount')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Outstanding Amount</label>
      <input name="liabilities_other_outstanding_amount" class="form-control" @if($result) value="{{ $result->liabilities_other_outstanding_amount }}" @else value="{{ old('liabilities_other_outstanding_amount') }}" @endif type="number">
      @if($errors->has('liabilities_other_outstanding_amount'))
      <span class="text-danger">{{$errors->first('liabilities_other_outstanding_amount')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12">
    <label>Proposed Securities By The Customer</label>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Date Of Signing</label>
      <input name="date_of_signing" class="member_joining form-control" @if($result) value="{{ $result->date_of_signing }}" @else value="{{ old('date_of_signing') }}" @endif type="text">
      <i class="fa-solid fa-calendar"></i>
      @if($errors->has('date_of_signing'))
      <span class="text-danger">{{$errors->first('date_of_signing')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label" style="width: 100%;">Signature Of Applicant</label>
      <input name="signature_of_applicant" style="box-shadow: none; float: left; padding-left: 0px; width: 70%;" class="form-control" type="file">
      @if($result)
        @if($result->signature_of_applicant)   <a href="{!! asset($result->signature_of_applicant) !!}" download="" style="float: right;">Download</a>  @endif
      @endif  
      @if($errors->has('signature_of_applicant'))
      <span class="text-danger">{{$errors->first('signature_of_applicant')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12">
    <label>Public Figure Information</label>
  </div>

  <div class="col-md-6">
    <label class="sub-label">Are You A Public Figure*</label>
    <select name="are_you_a_public_figure" onChange="PublicFigure(this);" class="form-control" required="true">
      <option value="">Select</option>
      <option value="1" @if($result) @if($result->are_you_a_public_figure == "1") selected @endif @endif >Yes</option>
      <option value="0" @if($result) @if($result->are_you_a_public_figure == "0") selected @endif @endif >No</option>
    </select>
  </div>
  <div class="col-md-6 PublicFigure" @if($result) @if($result->are_you_a_public_figure == "0") style="display: none;" @endif @else style="display: none;" @endif >
    <div class="form-group">
      <label class="sub-label">Position/Title</label>
      <input name="public_figure_position_title" class="form-control" @if($result) value="{{ $result->public_figure_position_title }}" @else value="{{ old('public_figure_position_title') }}" @endif type="text">
      @if($errors->has('public_figure_position_title'))
      <span class="text-danger">{{$errors->first('public_figure_position_title')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <label class="sub-label">Are You Related To A Public Figure*</label>
    <select name="related_to_public_figure" onChange="RelatedPublicFigure(this);" class="form-control" required="true">
      <option value="">Select</option>
      <option value="1" @if($result) @if($result->related_to_public_figure == "1") selected @endif @endif >Yes</option>
      <option value="0" @if($result) @if($result->related_to_public_figure == "0") selected @endif @endif >No</option>
    </select>
  </div>
  <div class="col-md-6 RelatedPublicFigure" @if($result) @if($result->related_to_public_figure == "0") style="display: none;" @endif @else style="display: none;" @endif >
    <div class="form-group">
      <label class="sub-label">Position/Title</label>
      <input name="related_public_figure_position_title" class="form-control" @if($result) value="{{ $result->related_public_figure_position_title }}" @else value="{{ old('related_public_figure_position_title') }}" @endif type="text">
      @if($errors->has('related_public_figure_position_title'))
      <span class="text-danger">{{$errors->first('related_public_figure_position_title')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12">
    <label>Murabaha Transaction Mechanism</label>
    <label style="font-size: 15px;width: 100%;margin-bottom: 10px;">Acknowledgement</label>
  </div>
  <div class="col-md-12">
     <label style="font-weight: normal; font-size: 14px; margin-top: 6px;"><input style="width: 20px; height: 20px; box-shadow: none; margin-right: 10px; margin-top: 0px; float: left;margin-bottom: 0px;" type="checkbox" name="acknowledge_receiving_key_fact_statement" @if($result) @if($result->acknowledge_receiving_key_fact_statement == "1") checked="" @endif @endif value="1"> I Acknowledge Receiving A Key Fact Statement (Kfs) Of This Product.</label>
  </div>

  <div class="col-md-12" style="margin-top: 10px;">
     <label style="font-weight: normal; font-size: 14px; margin-top: 6px;"><input style="width: 20px; height: 20px; box-shadow: none; margin-right: 10px; margin-top: 22px; float: left;margin-bottom: 25px;" type="checkbox" name="hereby_give_our_consent_to_waive" @if($result) @if($result->hereby_give_our_consent_to_waive == "1") checked="" @endif @endif value="1"> I/We Hereby Give Our Consent To Waive Of The Cooling-Off Period Of 5 Business<br> Days And Understand That The Bank'S Terms & Condition Are Applicable From The
Date Of Signing This Application By Me.</label>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Customer Name</label>
      <input name="customer_name" class="form-control" @if($result) value="{{ $result->customer_name }}" @else value="{{ old('customer_name') }}" @endif type="text">
      @if($errors->has('customer_name'))
      <span class="text-danger">{{$errors->first('customer_name')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Signature Date</label>
      <input name="signature_date" class="member_joining form-control" @if($result) value="{{ $result->signature_date }}" @else value="{{ old('signature_date') }}" @endif type="text">
      <i class="fa-solid fa-calendar"></i>
      @if($errors->has('signature_date'))
      <span class="text-danger">{{$errors->first('signature_date')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12">
     <label>Individual Tax Residency Self Certification</label>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Us Citizen Or Other Citizen (If Us Citizen Us Tin No.)</label>
      <input name="us_citizen_or_other" class="form-control" @if($result) value="{{ $result->us_citizen_or_other }}" @else value="{{ old('us_citizen_or_other') }}" @endif type="text">
      @if($errors->has('us_citizen_or_other'))
      <span class="text-danger">{{$errors->first('us_citizen_or_other')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Town Or City Of Birth</label>
      <input name="town_or_city_of_birth" class="form-control" @if($result) value="{{ $result->town_or_city_of_birth }}" @else value="{{ old('town_or_city_of_birth') }}" @endif type="text">
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
          <option value="{{ $country->id }}" @if($result) @if($result->country_of_birth == $country->id) selected @endif @endif >{{ $country->country_name }}</option>
        @endforeach
      </select>
      @if($errors->has('country_of_birth'))
      <span class="text-danger">{{$errors->first('country_of_birth')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label" style="width: 100%;">Cm Signature</label>
      <input name="individual_tax_cm_signature" style="box-shadow: none; float: left; padding-left: 0px; width: 70%;" class="form-control" type="file">
      @if($result)
        @if($result->individual_tax_cm_signature)   <a href="{!! asset($result->individual_tax_cm_signature) !!}" download="" style="float: right;">Download</a>  @endif
      @endif  
      @if($errors->has('individual_tax_cm_signature'))
      <span class="text-danger">{{$errors->first('individual_tax_cm_signature')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Date</label>
      <input name="individual_tax_date" class="member_joining form-control" @if($result) value="{{ $result->individual_tax_date }}" @else value="{{ old('individual_tax_date') }}" @endif type="text">
      <i class="fa-solid fa-calendar"></i>
      @if($errors->has('individual_tax_date'))
      <span class="text-danger">{{$errors->first('individual_tax_date')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-12">
    <label>Promise To Purchase</label>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Cm Name</label>
      <input name="promise_cm_name" class="form-control" @if($result) value="{{ $result->promise_cm_name }}" @else value="{{ old('promise_cm_name') }}" @endif type="text">
      @if($errors->has('promise_cm_name'))
      <span class="text-danger">{{$errors->first('promise_cm_name')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12">
    <label style="font-size: 15px;">Schedule 1</label>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Cost Price (Finance Amt)</label>
      <input name="cost_price" class="form-control" @if($result) value="{{ $result->cost_price }}" @else value="{{ old('cost_price') }}" @endif type="number">
      @if($errors->has('cost_price'))
      <span class="text-danger">{{$errors->first('cost_price')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Profit (As Per Salary)</label>
      <input name="profit" class="form-control" @if($result) value="{{ $result->profit }}" @else value="{{ old('profit') }}" @endif type="number">
      @if($errors->has('profit'))
      <span class="text-danger">{{$errors->first('profit')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Number Of Installments (As Per Cm)</label>
      <input name="schedule_1_number_of_installments" class="form-control" @if($result) value="{{ $result->schedule_1_number_of_installments }}" @else value="{{ old('schedule_1_number_of_installments') }}" @endif type="number">
      @if($errors->has('schedule_1_number_of_installments'))
      <span class="text-danger">{{$errors->first('schedule_1_number_of_installments')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Day Of Every Month (Emi Date)</label>
      <input name="day_of_every_month" class="member_joining form-control" @if($result) value="{{ $result->day_of_every_month }}" @else value="{{ old('day_of_every_month') }}" @endif type="text">
      <i class="fa-solid fa-calendar"></i>
      @if($errors->has('day_of_every_month'))
      <span class="text-danger">{{$errors->first('day_of_every_month')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-12">
     <label style="font-weight: normal; font-size: 14px; margin-top: 6px;"><input style="width: 20px; height: 20px; box-shadow: none; margin-right: 10px; margin-top: 12px; float: left;margin-bottom: 7px;" type="radio" name="murabaha_contract_or_proceeds_thereof" @if($result) @if($result->murabaha_contract_or_proceeds_thereof == "1") checked="checked" @endif @endif value="1"> Advise Us Your Custody Account Number With Enbds To Which The Asset Will Be Transferred Upon Completion Of The Murabaha Contract</label>
  </div>
  <div class="col-md-12">
     <label style="font-weight: normal; font-size: 14px; margin-top: 6px;"><input style="width: 20px; height: 20px; box-shadow: none; margin-right: 10px; margin-top: 12px; float: left;margin-bottom: 7px;" type="radio" name="murabaha_contract_or_proceeds_thereof" @if($result) @if($result->murabaha_contract_or_proceeds_thereof == "2") checked="checked" @endif @else checked="checked" @endif value="2"> To Authorise Enbds To Sell The Asset To Third Party On Your Behalf And Transfer The Sale Proceeds Thereof Into Your Account With Ei No.</label>
  </div>

  <div class="col-md-12">
    <label style="font-size: 15px;margin-top: 15px;">Schedule 2</label>
  </div>
  
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Emirates Islamic Bank Psjc (The “Seller”)</label>
      <input name="schedule_2_emirates_islamic_bank" class="form-control" @if($result) value="{{ $result->schedule_2_emirates_islamic_bank }}" @else value="{{ old('schedule_2_emirates_islamic_bank') }}" @endif type="text">
      @if($errors->has('schedule_2_emirates_islamic_bank'))
      <span class="text-danger">{{$errors->first('schedule_2_emirates_islamic_bank')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Date</label>
      <input name="schedule_2_date" class="member_joining form-control" @if($result) value="{{ $result->schedule_2_date }}" @else value="{{ old('schedule_2_date') }}" @endif type="text">
      <i class="fa-solid fa-calendar"></i>
      @if($errors->has('schedule_2_date'))
      <span class="text-danger">{{$errors->first('schedule_2_date')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Number Of Investment Certificates</label>
      <input name="schedule_2_number_investment_certificates" class="form-control" @if($result) value="{{ $result->schedule_2_number_investment_certificates }}" @else value="{{ old('schedule_2_number_investment_certificates') }}" @endif type="number">
      @if($errors->has('schedule_2_number_investment_certificates'))
      <span class="text-danger">{{$errors->first('schedule_2_number_investment_certificates')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Cost Price</label>
      <input name="schedule_2_cost_price" class="form-control" @if($result) value="{{ $result->schedule_2_cost_price }}" @else value="{{ old('schedule_2_cost_price') }}" @endif type="number">
      @if($errors->has('schedule_2_cost_price'))
      <span class="text-danger">{{$errors->first('schedule_2_cost_price')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Deferred Profit</label>
      <input name="schedule_2_deferred_profit" class="form-control" @if($result) value="{{ $result->schedule_2_deferred_profit }}" @else value="{{ old('schedule_2_deferred_profit') }}" @endif type="number">
      @if($errors->has('schedule_2_deferred_profit'))
      <span class="text-danger">{{$errors->first('schedule_2_deferred_profit')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Advance Payment (Deducted Up Front)</label>
      <input name="schedule_2_advance_payment" class="form-control" @if($result) value="{{ $result->schedule_2_advance_payment }}" @else value="{{ old('schedule_2_advance_payment') }}" @endif type="number">
      @if($errors->has('schedule_2_advance_payment'))
      <span class="text-danger">{{$errors->first('schedule_2_advance_payment')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Murabaha Sale Price</label>
      <input name="schedule_2_murabaha_sale_price" class="form-control" @if($result) value="{{ $result->schedule_2_murabaha_sale_price }}" @else value="{{ old('schedule_2_murabaha_sale_price') }}" @endif type="number">
      @if($errors->has('schedule_2_murabaha_sale_price'))
      <span class="text-danger">{{$errors->first('schedule_2_murabaha_sale_price')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Payment Date</label>
      <input name="schedule_2_payment_date" class="member_joining form-control" @if($result) value="{{ $result->schedule_2_payment_date }}" @else value="{{ old('schedule_2_payment_date') }}" @endif type="text">
      <i class="fa-solid fa-calendar"></i>
      @if($errors->has('schedule_2_payment_date'))
      <span class="text-danger">{{$errors->first('schedule_2_payment_date')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">  
      <label class="sub-label">Sale Date</label>
      <input name="schedule_2_sale_date" class="member_joining form-control" @if($result) value="{{ $result->schedule_2_sale_date }}" @else value="{{ old('schedule_2_sale_date') }}" @endif type="text">
      <i class="fa-solid fa-calendar"></i>
      @if($errors->has('schedule_2_sale_date'))
      <span class="text-danger">{{$errors->first('schedule_2_sale_date')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">  
      <label class="sub-label">Cut Off Time</label>
      <input name="schedule_2_cut_off_time" class="member_joining form-control" @if($result) value="{{ $result->schedule_2_cut_off_time }}" @else value="{{ old('schedule_2_cut_off_time') }}" @endif type="text">
      <i class="fa-solid fa-calendar"></i>
      @if($errors->has('schedule_2_cut_off_time'))
      <span class="text-danger">{{$errors->first('schedule_2_cut_off_time')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12">
    <label>Annexure (For Debt Settlement “Buyout” Cases Only)</label>
  </div>

  <div class="col-md-6">
    <div class="form-group">  
      <label class="sub-label">Date</label>
      <input name="annexure_date" class="member_joining form-control" @if($result) value="{{ $result->annexure_date }}" @else value="{{ old('annexure_date') }}" @endif type="text">
      <i class="fa-solid fa-calendar"></i>
      @if($errors->has('annexure_date'))
      <span class="text-danger">{{$errors->first('annexure_date')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">  
      <label class="sub-label">Ei Reference</label>
      <input name="annexure_ei_reference" class="form-control" @if($result) value="{{ $result->annexure_ei_reference }}" @else value="{{ old('annexure_ei_reference') }}" @endif type="text">
      @if($errors->has('annexure_ei_reference'))
      <span class="text-danger">{{$errors->first('annexure_ei_reference')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">  
      <label class="sub-label">Takaful Fees (Aed)</label>
      <input name="annexure_takaful_fees" class="form-control" @if($result) value="{{ $result->annexure_takaful_fees }}" @else value="{{ old('annexure_takaful_fees') }}" @endif type="number">
      @if($errors->has('annexure_takaful_fees'))
      <span class="text-danger">{{$errors->first('annexure_takaful_fees')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">  
      <label class="sub-label">Processing Fees (Aed)</label>
      <input name="annexure_processing_fees" class="form-control" @if($result) value="{{ $result->annexure_processing_fees }}" @else value="{{ old('annexure_processing_fees') }}" @endif type="number">
      @if($errors->has('annexure_processing_fees'))
      <span class="text-danger">{{$errors->first('annexure_processing_fees')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">  
      <label class="sub-label">Trading Fees (Aed)</label>
      <input name="annexure_trading_fees" class="form-control" @if($result) value="{{ $result->annexure_trading_fees }}" @else value="{{ old('annexure_trading_fees') }}" @endif type="number">
      @if($errors->has('annexure_trading_fees'))
      <span class="text-danger">{{$errors->first('annexure_trading_fees')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">  
      <label class="sub-label">Account Number</label>
      <input name="annexure_account_number" class="form-control" @if($result) value="{{ $result->annexure_account_number }}" @else value="{{ old('annexure_account_number') }}" @endif type="number">
      @if($errors->has('annexure_account_number'))
      <span class="text-danger">{{$errors->first('annexure_account_number')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">  
      <label class="sub-label">Collect Original Clearance Letter From</label>
      <input name="annexure_collect_original_clearance" class="form-control" @if($result) value="{{ $result->annexure_collect_original_clearance }}" @else value="{{ old('annexure_collect_original_clearance') }}" @endif type="text">
      @if($errors->has('annexure_collect_original_clearance'))
      <span class="text-danger">{{$errors->first('annexure_collect_original_clearance')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">  
      <label class="sub-label">Post Settlement Of My Liability Of Aed (Outgoing Bank)</label>
      <input name="annexure_post_settlement" class="form-control" @if($result) value="{{ $result->annexure_post_settlement }}" @else value="{{ old('annexure_post_settlement') }}" @endif type="text">
      @if($errors->has('annexure_post_settlement'))
      <span class="text-danger">{{$errors->first('annexure_post_settlement')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12">
    <label>Customer Undertaking</label>
  </div>

  <div class="col-md-6">
    <div class="form-group">  
      <label class="sub-label">Liability From</label>
      <input name="liability_from" class="form-control" @if($result) value="{{ $result->liability_from }}" @else value="{{ old('liability_from') }}" @endif type="text">
      @if($errors->has('liability_from'))
      <span class="text-danger">{{$errors->first('liability_from')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">  
      <label class="sub-label">The Outgoing Bank Name &Final Settlement Of The Outstanding</label>
      <input name="outgoing_bank_name" class="form-control" @if($result) value="{{ $result->outgoing_bank_name }}" @else value="{{ old('outgoing_bank_name') }}" @endif type="text">
      @if($errors->has('outgoing_bank_name'))
      <span class="text-danger">{{$errors->first('outgoing_bank_name')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">  
      <label class="sub-label">Salary For The Month Of</label>
      <input name="salary_for_the_month" class="form-control" @if($result) value="{{ $result->salary_for_the_month }}" @else value="{{ old('salary_for_the_month') }}" @endif type="text">
      @if($errors->has('salary_for_the_month'))
      <span class="text-danger">{{$errors->first('salary_for_the_month')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">  
      <label class="sub-label">Debit Emi Account No.</label>
      <input name="debit_emi_account_no" class="form-control" @if($result) value="{{ $result->debit_emi_account_no }}" @else value="{{ old('debit_emi_account_no') }}" @endif type="number">
      @if($errors->has('debit_emi_account_no'))
      <span class="text-danger">{{$errors->first('debit_emi_account_no')}}</span>
      @endif
    </div>
  </div> 

  <div class="col-md-6">
    <div class="form-group">  
      <label class="sub-label">Account No.</label>
      <input name="customer_undertaking_account_no" class="form-control" @if($result) value="{{ $result->customer_undertaking_account_no }}" @else value="{{ old('customer_undertaking_account_no') }}" @endif type="number">
      @if($errors->has('customer_undertaking_account_no'))
      <span class="text-danger">{{$errors->first('customer_undertaking_account_no')}}</span>
      @endif
    </div>
  </div> 

<!--   <div class="col-md-12">
    <label>Annexure Direct Debit Authority (For Fresh Cases Only)</label>
  </div> -->
  
  <div class="col-md-12 text-center">
    <a @if($cred == 1) href="{{ route('credit-card-information') }}" @else href="{{ route('education-detail') }}" @endif class="back_btn">Back</a> &nbsp;&nbsp;
    <button type="submit">Proceed</button>
  </div>
</div>
</form>
</div>
</div>
<div class="col-md-5">
  <div class="service-step">
    <h3>All fields marked with an asterisk (*) are mandatory.</h3>
  </div>
  <div class="service-step">
    <h3>Complete and accurate information helps us bring you the best products suited to you at the fastest pace!</h3>
  </div>
</div>

</div>
</div>
</section>

<script type="text/javascript">



  function ExistingCustomer(that) {
    if (that.value == "1") {
      $(".account_no").show();
      $(".account_no input").attr("required", true);
      $(".cif_no").hide();
      $(".cif_no input").removeAttr('required');
    } else {
      $(".account_no").hide();
      $(".account_no input").removeAttr('required');
      $(".cif_no").show();
      $(".cif_no input").attr("required", true);
    }
  }

  function PublicFigure(that) {
    if (that.value == "1") {
      $(".PublicFigure").show();
      $(".PublicFigure input").attr("required", true);
    } else {
      $(".PublicFigure").hide();
      $(".PublicFigure input").removeAttr('required');
    }
  }

  function RelatedPublicFigure(that) {
    if (that.value == "1") {
      $(".RelatedPublicFigure").show();
      $(".RelatedPublicFigure input").attr("required", true);
    } else {
      $(".RelatedPublicFigure").hide();
      $(".RelatedPublicFigure input").removeAttr('required');
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

  function ifSpouseCoBorrower(that) {
    if (that.value == "1") {
      $(".spouse_fixed_monthly_income").show();
    } else {
      $(".spouse_fixed_monthly_income").hide();
    }
  }
  
  function ifYouHaveCOBorrower(that) {
    if (that.value == "1") {
      $(".HaveCOBorrower").show();
      $(".HaveCOBorrower input").attr("required", true);
      $(".HaveCOBorrower select").attr("required", true);
    } else {
      $(".HaveCOBorrower").hide();
      $(".HaveCOBorrower input").removeAttr('required');
      $(".HaveCOBorrower select").removeAttr('required');
    }
  }

  
  

</script>

@endsection    
@extends('frontend.layouts.app')
@section('content')


<section class="personal_details">
<div class="container">  
<div class="row">  
<div class="col-md-7">
<div class="personal_details_box">
<h1 class="app_form_head">Application Form</h1>
<h2 style="margin-bottom: 15px;">Credit cards details</h2>
<!-- <h6 style="margin-top: 12px;margin-bottom: 15px;">Please enter your information to check the offer.</h6> -->
<form action="{{ route('save-credit-card-information') }}" enctype="multipart/form-data" method="post">
{{ csrf_field() }}  

<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Card Type*</label> 
      <select name="card_type" class="form-control" required="true">
        <option value="">Select</option>
        <option value="Titanium" @if($result) @if($result->card_type == 'Titanium') selected @endif @endif >Titanium</option>
        <option value="Platinum" @if($result) @if($result->card_type == 'Platinum') selected @endif @endif >Platinum</option>
        <option value="Gold" @if($result) @if($result->card_type == 'Gold') selected @endif @endif >Gold</option>
        <option value="Etc." @if($result) @if($result->card_type == 'Etc.') selected @endif @endif >Etc.</option>
      </select>
      @if($errors->has('card_type'))
        <span class="text-danger">{{$errors->first('card_type')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Embossing Name*</label>
      <input name="embossing_name" class="form-control" @if($result) value="{{ $result->embossing_name }}" @else value="{{ old('embossing_name') }}" @endif required="true" type="text">
      @if($errors->has('embossing_name'))
      <span class="text-danger">{{$errors->first('embossing_name')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Cm Billing Cycle Date*</label> 
      <select name="cm_billing_cycle_date" class="form-control" required="true">
        <option value="">Select</option>
        <option value="5Th" @if($result) @if($result->cm_billing_cycle_date == '5Th') selected @endif @endif >5Th</option>
        <option value="10Th" @if($result) @if($result->cm_billing_cycle_date == '10Th') selected @endif @endif >10Th</option>
        <option value="19Th" @if($result) @if($result->cm_billing_cycle_date == '19Th') selected @endif @endif >19Th</option>
        <option value="24Th" @if($result) @if($result->cm_billing_cycle_date == '24Th') selected @endif @endif >24Th</option>
        <option value="Etc." @if($result) @if($result->cm_billing_cycle_date == 'Etc.') selected @endif @endif >Etc.</option>
      </select>
      @if($errors->has('cm_billing_cycle_date'))
        <span class="text-danger">{{$errors->first('cm_billing_cycle_date')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">E Statement Subscription*</label> 
      <select name="e_statement_subscription" class="form-control" required="true">
        <option value="">Select</option>
        <option value="Yes" @if($result) @if($result->e_statement_subscription == 'Yes') selected @endif @endif >Yes</option>
        <option value="No" @if($result) @if($result->e_statement_subscription == 'No') selected @endif @endif >No</option>
      </select>
      @if($errors->has('e_statement_subscription'))
        <span class="text-danger">{{$errors->first('e_statement_subscription')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Paper Statement Subscription*</label> 
      <select name="paper_statement_subscription" class="form-control" required="true">
        <option value="">Select</option>
        <option value="Yes" @if($result) @if($result->paper_statement_subscription == 'Yes') selected @endif @endif >Yes</option>
        <option value="No" @if($result) @if($result->paper_statement_subscription == 'No') selected @endif @endif >No</option>
      </select>
      @if($errors->has('paper_statement_subscription'))
        <span class="text-danger">{{$errors->first('paper_statement_subscription')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-12">
    <label>Supplementary Applicant(S) Cards Details</label>
  </div>
  <div class="col-md-2">
    <label class="sub-label">Salutation</label>
    <select name="supplementary_salutation" class="form-control" required="true">
      <option value="Mr." @if($result) @if($result->supplementary_salutation == 'Mr.') selected @endif @endif >Mr.</option>
      <option value="Mrs." @if($result) @if($result->supplementary_salutation == 'Mrs.') selected @endif @endif>Mrs.</option>
      <option value="Miss." @if($result) @if($result->supplementary_salutation == 'Miss.') selected @endif @endif>Miss</option>
      <option value="Dr." @if($result) @if($result->supplementary_salutation == 'Dr.') selected @endif @endif >Dr.</option>
      <option value="Prof." @if($result) @if($result->supplementary_salutation == 'Prof.') selected @endif @endif >Prof.</option>
      <option value="Rev." @if($result) @if($result->supplementary_salutation == 'Rev.') selected @endif @endif >Rev.</option>
      <option value="Other" @if($result) @if($result->supplementary_salutation == 'Other') selected @endif @endif >Other</option>
    </select>
  </div>
  <div class="col-md-10">
    <div class="row">  
      <div class="col-md-4">
        <div class="form-group">
          <label class="sub-label">First Name</label>
          <input name="supplementary_first_name" maxlength="16" class="form-control" @if($result) value="{{ $result->supplementary_first_name }}" @else value="{{ old('supplementary_first_name') }}" @endif type="text" pattern="(?=^.{2,25}$)(?![.\n])(?=.*[a-zA-Z]).*$">
          @if($errors->has('supplementary_first_name'))
          <span class="text-danger">{{$errors->first('supplementary_first_name')}}</span>
          @endif
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="sub-label">Middle Name</label>
          <input name="supplementary_middle_name" class="form-control"  @if($result) value="{{ $result->supplementary_middle_name }}" @else value="{{ old('supplementary_middle_name') }}"  @endif type="text">
          @if($errors->has('supplementary_middle_name'))
          <span class="text-danger">{{$errors->first('supplementary_middle_name')}}</span>
          @endif
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="sub-label">Last Name</label>
          <input name="supplementary_last_name" class="form-control" @if($result) value="{{ $result->supplementary_last_name }}" @else value="{{ old('supplementary_last_name') }}"  @endif type="text">
          @if($errors->has('supplementary_last_name'))
            <span class="text-danger">{{$errors->first('supplementary_last_name')}}</span>
          @endif
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-6">
    <label class="sub-label">Relationship*</label>
    <select name="supplementary_relationship" class="form-control" required="true">
      <option value="Wife" @if($result) @if($result->supplementary_relationship == 'Wife') selected @endif @endif >Wife</option>
      <option value="Husband" @if($result) @if($result->supplementary_relationship == 'Husband') selected @endif @endif>Husband</option>
      <option value="Mother" @if($result) @if($result->supplementary_relationship == 'Mother') selected @endif @endif>Mother</option>
      <option value="Father" @if($result) @if($result->supplementary_relationship == 'Father') selected @endif @endif >Father</option>
      <option value="Daughter" @if($result) @if($result->supplementary_relationship == 'Daughter') selected @endif @endif >Daughter</option>
      <option value="Son" @if($result) @if($result->supplementary_relationship == 'Son') selected @endif @endif >Son</option>
      <option value="Brother" @if($result) @if($result->supplementary_relationship == 'Brother') selected @endif @endif >Brother</option>
      
      <option value="Sister" @if($result) @if($result->supplementary_relationship == 'Sister') selected @endif @endif >Sister</option>
      <option value="Others" @if($result) @if($result->supplementary_relationship == 'Others') selected @endif @endif >Others</option>
      <option value="Company Partner" @if($result) @if($result->supplementary_relationship == 'Company Partner') selected @endif @endif >Company Partner</option>
    </select>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Embossing Name</label>
      <input name="supplementary_embosing_name" class="form-control" @if($result) value="{{ $result->supplementary_embosing_name }}" @else value="{{ old('supplementary_embosing_name') }}" @endif type="text">
      @if($errors->has('supplementary_embosing_name'))
      <span class="text-danger">{{$errors->first('supplementary_embosing_name')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Nationality</label>
      <select name="supplementary_nationality" class="form-control">
        <option value="">Select</option>
        @foreach($countries as $country)
          <option value="{{ $country->id }}" @if($result) @if($result->supplementary_nationality == $country->id) selected @endif @endif >{{ $country->country_name }}</option>
        @endforeach
      </select>
      @if($errors->has('supplementary_nationality'))
      <span class="text-danger">{{$errors->first('supplementary_nationality')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Passport No.</label>
      <input name="supplementary_passport_no" class="form-control" @if($result) value="{{ $result->supplementary_passport_no }}" @else value="{{ old('supplementary_passport_no') }}" @endif type="text">
      @if($errors->has('supplementary_passport_no'))
      <span class="text-danger">{{$errors->first('supplementary_passport_no')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Card limit (in AED)</label>
      <input name="supplementary_credit_limit_aed" class="form-control" pattern="\d*" maxlength="6" @if($result) value="{{ $result->supplementary_credit_limit_aed }}" @else value="{{ old('supplementary_credit_limit_aed') }}" @endif type="text">
      @if($errors->has('supplementary_credit_limit_aed'))
      <span class="text-danger">{{$errors->first('supplementary_credit_limit_aed')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6">
    <label class="sub-label">Marital Status</label>
    <select name="supplementary_marital_status" onChange="MaritalStatus(this);" class="form-control">
      <option value="Single" @if($result) @if($result->supplementary_marital_status == "Single") selected @endif @endif >Single</option>
      <option value="Married" @if($result) @if($result->supplementary_marital_status == "Married") selected @endif @endif >Married</option>
      <option value="Others" @if($result) @if($result->supplementary_marital_status == "Others") selected @endif @endif >Others</option>
    </select>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="sub-label">Mother'S Maiden Name</label>
      <input name="supplementary_mother_maiden_name" class="form-control" @if($result) value="{{ $result->supplementary_mother_maiden_name }}" @else value="{{ old('supplementary_mother_maiden_name') }}" @endif type="text">
      @if($errors->has('supplementary_mother_maiden_name'))
      <span class="text-danger">{{$errors->first('supplementary_mother_maiden_name')}}</span>
      @endif
    </div>
  </div>
  <div class="col-md-12"> 
    <label>Credit Shield Plus (Optional)</label>
  </div>
  <div class="col-md-12"> 
    <div class="form-group" style="margin-bottom: 3px;">
        <label style="font-weight: normal; font-size: 13px; margin-top: 6px;"><input type="checkbox" name="no_sign_up_credit_shield" style="width: 20px; height: 20px; box-shadow: none; margin-right: 10px; margin-top: 0px; float: left;margin-bottom: 5px;" @if($result) @if($result->no_sign_up_credit_shield == "1") checked="" @endif @endif value="1"> No, I would not like to sign up for credit shield plus</label>
    </div>
  </div>
  <div class="col-md-12"> 
    <div class="form-group">
        <label style="font-weight: normal; font-size: 13px; margin-top: 6px;"><input style="width: 20px; height: 20px; box-shadow: none; margin-right: 10px; margin-top: 0px; float: left;margin-bottom: 0px;" type="checkbox" name="sign_up_credit_shield_plus" @if($result) @if($result->sign_up_credit_shield_plus == "1") checked="" @endif @endif value="1"> I would like to sign up for credit shield plus applicable for all my emirates islamic credit cards</label>
    </div>
  </div>
  
  <div class="col-md-12">
    <label class="sub-label">Master Murabaha Agreement For The Sale Of Commodities For Credit Card Issuance*</label>
    </div>
    <div class="col-md-6">
      <select name="master_murabaha_agreement" required="true" class="form-control">
        <option value="">Select</option>    
        <option value="1" @if($result) @if($result->master_murabaha_agreement == "1") selected @endif @endif >Yes</option>
        <option value="0" @if($result) @if($result->master_murabaha_agreement == "0") selected @endif @endif >No</option>
      </select>
    </div>
    <div class="col-md-12">
        <label class="sub-label">Kyc Docs <span style="font-size: 13px;">(Income Documents- Sc/Labour Contract/Pay Slip/Bank Statement)</span></label>
        <input type="file" @if($result)  @else required="true" @endif style="box-shadow: none;width: 100%;" name="kyc_docs"> 
        @if($result)
        @if($result->kyc_docs)
        <a href="{!! asset($result->kyc_docs) !!}" style="display:block; margin-top: -8px; margin-bottom: 15px;" download><i class="fa-solid fa-download"></i> Download</a>
        @endif
        @endif
        @if($result)
        @if(empty($result->kyc_docs2))
        <a onclick="kyc_docs1()" class="kyc_docs12" style="background: #5EB495; color: #fff; font-size: 13px; padding: 6px 15px;cursor: pointer;">Add More</a>
        @endif
        @else
        <a onclick="kyc_docs1()" class="kyc_docs12" style="background: #5EB495; color: #fff; font-size: 13px; padding: 6px 15px;cursor: pointer;">Add More</a>
        @endif
    </div>
    
    <div class="col-md-12 kyc_docs1" @if($result) @if($result->kyc_docs2) style="margin-top:10px;" @else style="display:none;margin-top:10px" @endif  @else style="display:none;margin-top:10px" @endif >
        <input type="file" style="box-shadow: none;width: 100%; margin-top:10px" name="kyc_docs2"> 
        @if($result)
        @if($result->kyc_docs2)
        <a href="#" style="display:block; margin-top: -8px; margin-bottom: 15px;"><i class="fa-solid fa-download"></i> Download</a>
        @endif
        @endif
        @if($result)
        @if(empty($result->kyc_docs3))
        <a onclick="kyc_docs2()" class="kyc_docs13" style="background: #5EB495; color: #fff; font-size: 13px; padding: 6px 15px;cursor: pointer;">Add More</a>
        @endif
        @else
        <a onclick="kyc_docs2()" class="kyc_docs13" style="background: #5EB495; color: #fff; font-size: 13px; padding: 6px 15px;cursor: pointer;">Add More</a>
        @endif
    </div>
    
    <div class="col-md-12 kyc_docs2" @if($result) @if($result->kyc_docs3) style="margin-top:10px;" @else style="display:none;margin-top:10px;" @endif  @else style="display:none;margin-top:10px;" @endif >
        <input type="file" style="box-shadow: none;width: 100%; margin-top:10px" name="kyc_docs3"> 
        @if($result)
        @if($result->kyc_docs3)
        <a href="#" style="display:block; margin-top: -8px; margin-bottom: 15px;"><i class="fa-solid fa-download"></i> Download</a>
        @endif
        @endif
        @if($result)
        @if(empty($result->kyc_docs4))
        <a onclick="kyc_docs3()" class="kyc_docs14" style="background: #5EB495; color: #fff; font-size: 13px; padding: 6px 15px;cursor: pointer;">Add More</a>
        @endif
        @else
        <a onclick="kyc_docs3()" class="kyc_docs14" style="background: #5EB495; color: #fff; font-size: 13px; padding: 6px 15px;cursor: pointer;">Add More</a>
        @endif
    </div>
    
    <div class="col-md-12 kyc_docs3" @if($result) @if($result->kyc_docs4) style="margin-top:10px" @else style="display:none; margin-top:10px" @endif  @else style="display:none; margin-top:10px" @endif>
        <input type="file" style="box-shadow: none;width: 100%;" name="kyc_docs4"> 
        @if($result)
        @if($result->kyc_docs4)
        <a href="#" style="display:block; margin-top: -8px; margin-bottom: 15px;"><i class="fa-solid fa-download"></i> Download</a>
        @endif
        @endif
    </div>


  <div class="col-md-12 text-center">
    <a href="{{ route('education-detail') }}" class="back_btn">Back</a> &nbsp;&nbsp;
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
      
      // $(".family1 input").removeAttr('required');
      // $(".family2 input").removeAttr('required');
      // $(".family3 input").removeAttr('required');
      // $(".family4 input").removeAttr('required');
      // $(".family5 input").removeAttr('required');
      // $(".family6 input").removeAttr('required');
      // $(".family7 input").removeAttr('required');
      // $(".family8 input").removeAttr('required');
      // $(".family9 input").removeAttr('required');
      // $(".family10 input").removeAttr('required');
      // $(".family11 input").removeAttr('required');
      // $(".family12 input").removeAttr('required');

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

      // $(".family1 input").attr("required", true);
      // $(".family2 input").removeAttr('required');
      // $(".family3 input").removeAttr('required');
      // $(".family4 input").removeAttr('required');
      // $(".family5 input").removeAttr('required');
      // $(".family6 input").removeAttr('required');
      // $(".family7 input").removeAttr('required');
      // $(".family8 input").removeAttr('required');
      // $(".family9 input").removeAttr('required');
      // $(".family10 input").removeAttr('required');
      // $(".family11 input").removeAttr('required');
      // $(".family12 input").removeAttr('required');
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

      // $(".family1 input").attr("required", true);
      // $(".family2 input").attr("required", true);
      // $(".family3 input").removeAttr('required');
      // $(".family4 input").removeAttr('required');
      // $(".family5 input").removeAttr('required');
      // $(".family6 input").removeAttr('required');
      // $(".family7 input").removeAttr('required');
      // $(".family8 input").removeAttr('required');
      // $(".family9 input").removeAttr('required');
      // $(".family10 input").removeAttr('required');
      // $(".family11 input").removeAttr('required');
      // $(".family12 input").removeAttr('required');
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

      // $(".family1 input").attr("required", true);
      // $(".family2 input").attr("required", true);
      // $(".family3 input").attr("required", true);
      // $(".family4 input").removeAttr('required');
      // $(".family5 input").removeAttr('required');
      // $(".family6 input").removeAttr('required');
      // $(".family7 input").removeAttr('required');
      // $(".family8 input").removeAttr('required');
      // $(".family9 input").removeAttr('required');
      // $(".family10 input").removeAttr('required');
      // $(".family11 input").removeAttr('required');
      // $(".family12 input").removeAttr('required');
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

      // $(".family1 input").attr("required", true);
      // $(".family2 input").attr("required", true);
      // $(".family3 input").attr("required", true);
      // $(".family4 input").attr("required", true);
      // $(".family5 input").removeAttr('required');
      // $(".family6 input").removeAttr('required');
      // $(".family7 input").removeAttr('required');
      // $(".family8 input").removeAttr('required');
      // $(".family9 input").removeAttr('required');
      // $(".family10 input").removeAttr('required');
      // $(".family11 input").removeAttr('required');
      // $(".family12 input").removeAttr('required');
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

      // $(".family1 input").attr("required", true);
      // $(".family2 input").attr("required", true);
      // $(".family3 input").attr("required", true);
      // $(".family4 input").attr("required", true);
      // $(".family5 input").attr("required", true);
      // $(".family6 input").removeAttr('required');
      // $(".family7 input").removeAttr('required');
      // $(".family8 input").removeAttr('required');
      // $(".family9 input").removeAttr('required');
      // $(".family10 input").removeAttr('required');
      // $(".family11 input").removeAttr('required');
      // $(".family12 input").removeAttr('required');
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

      // $(".family1 input").attr("required", true);
      // $(".family2 input").attr("required", true);
      // $(".family3 input").attr("required", true);
      // $(".family4 input").attr("required", true);
      // $(".family5 input").attr("required", true);
      // $(".family6 input").attr("required", true);
      // $(".family7 input").removeAttr('required');
      // $(".family8 input").removeAttr('required');
      // $(".family9 input").removeAttr('required');
      // $(".family10 input").removeAttr('required');
      // $(".family11 input").removeAttr('required');
      // $(".family12 input").removeAttr('required');
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

      // $(".family1 input").attr("required", true);
      // $(".family2 input").attr("required", true);
      // $(".family3 input").attr("required", true);
      // $(".family4 input").attr("required", true);
      // $(".family5 input").attr("required", true);
      // $(".family6 input").attr("required", true);
      // $(".family7 input").attr("required", true);
      // $(".family8 input").removeAttr('required');
      // $(".family9 input").removeAttr('required');
      // $(".family10 input").removeAttr('required');
      // $(".family11 input").removeAttr('required');
      // $(".family12 input").removeAttr('required');
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

      // $(".family1 input").attr("required", true);
      // $(".family2 input").attr("required", true);
      // $(".family3 input").attr("required", true);
      // $(".family4 input").attr("required", true);
      // $(".family5 input").attr("required", true);
      // $(".family6 input").attr("required", true);
      // $(".family7 input").attr("required", true);
      // $(".family8 input").attr("required", true);
      // $(".family9 input").removeAttr('required');
      // $(".family10 input").removeAttr('required');
      // $(".family11 input").removeAttr('required');
      // $(".family12 input").removeAttr('required');
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

      // $(".family1 input").attr("required", true);
      // $(".family2 input").attr("required", true);
      // $(".family3 input").attr("required", true);
      // $(".family4 input").attr("required", true);
      // $(".family5 input").attr("required", true);
      // $(".family6 input").attr("required", true);
      // $(".family7 input").attr("required", true);
      // $(".family8 input").attr("required", true);
      // $(".family9 input").attr("required", true);
      // $(".family10 input").removeAttr('required');
      // $(".family11 input").removeAttr('required');
      // $(".family12 input").removeAttr('required');
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

      // $(".family1 input").attr("required", true);
      // $(".family2 input").attr("required", true);
      // $(".family3 input").attr("required", true);
      // $(".family4 input").attr("required", true);
      // $(".family5 input").attr("required", true);
      // $(".family6 input").attr("required", true);
      // $(".family7 input").attr("required", true);
      // $(".family8 input").attr("required", true);
      // $(".family9 input").attr("required", true);
      // $(".family10 input").attr("required", true);
      // $(".family11 input").removeAttr('required');
      // $(".family12 input").removeAttr('required');
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

      // $(".family1 input").attr("required", true);
      // $(".family2 input").attr("required", true);
      // $(".family3 input").attr("required", true);
      // $(".family4 input").attr("required", true);
      // $(".family5 input").attr("required", true);
      // $(".family6 input").attr("required", true);
      // $(".family7 input").attr("required", true);
      // $(".family8 input").attr("required", true);
      // $(".family9 input").attr("required", true);
      // $(".family10 input").attr("required", true);
      // $(".family11 input").attr("required", true);
      // $(".family12 input").removeAttr('required');
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

      // $(".family1 input").attr("required", true);
      // $(".family2 input").attr("required", true);
      // $(".family3 input").attr("required", true);
      // $(".family4 input").attr("required", true);
      // $(".family5 input").attr("required", true);
      // $(".family6 input").attr("required", true);
      // $(".family7 input").attr("required", true);
      // $(".family8 input").attr("required", true);
      // $(".family9 input").attr("required", true);
      // $(".family10 input").attr("required", true);
      // $(".family11 input").attr("required", true);
      // $(".family12 input").attr("required", true);
    }
  }
  
    function kyc_docs1(){
        $(".kyc_docs1").show();
        $(".kyc_docs12").hide();
    }
    function kyc_docs2(){
        $(".kyc_docs2").show();
        $(".kyc_docs13").hide();
    }
    function kyc_docs3(){
        $(".kyc_docs3").show();
        $(".kyc_docs14").hide();
    }
    
    

</script>

@endsection    
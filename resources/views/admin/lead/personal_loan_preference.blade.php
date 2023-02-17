@extends('admin.layouts.admin')
@php
    $route  = \Route::currentRouteName();    
@endphp
@section('content')

<section class="personal_details">
<div class="container">  
<div class="row">  
<div class="col-md-8">
<div class="personal_details_box cm_dt"> 
<h2 style="font-size: 22px; margin-bottom: 15px;margin-top: 20px;">Personal Loan Preference</h2>
<form action="{{ route('admin.save-personal-loan-preference', $user_id) }}" class="pref_bank" method="post">
  {{ csrf_field() }}  
  @if($your_limit)
  <p style="margin-top: 25px !important; color: #333; font-weight: 500; font-size: 16px;">Based on the information that you have provided, you may be eligible for a personal loan with a limit of up to </p>
  <h5 style="text-align: center; margin-top: 30px !important; margin-bottom: 35px !important; color: #fff; font-weight: 600; font-size: 20px; background: #5EB495; max-width: 210px; margin: 0 auto; padding: 13px 1px;">AED {{ round($your_limit, 2); }}/-*</h5>
  <h5 style="text-align: center; margin-bottom: 35px !important; color: #fff; font-weight: 600; font-size: 16px; background: #5EB495; max-width: 210px; margin: 0 auto; padding: 13px 1px;"><span style="font-size: 13px;">With EMI:</span> AED {{ round($your_emi, 2); }}/-*</h5>
@endif 

  <h4 style="border-top: 1px solid #f3f3f3; padding-top: 25px; color: #000; font-size: 16px;float: left;width: 100%;margin-top: 25px;">Please tell us about the choice of your banks</h4>
   
    <div class="row"> 
      @foreach(get_prefer_bank_personal_loan(1) as $bank) 
        <div class="col-md-6" style="margin-bottom: 10px; margin-top: 5px;">
          <label><input type="checkbox" name="bank_id[]" value="{{ $bank->id }}"> {{ $bank->name }} @if(isset($bank->valuable_text))<span class="info_box"><i class="fa fa-circle-info"></i> <div class="bank_iinfo"><p>{{ $bank->valuable_text }}</p></div> </span>@endif </label>
        </div>
      @endforeach
    </div> 
    @if(session()->has('no_preference_bank'))
        <p style="color: #f00; margin-left: 15px;">Kindly select a bank</p>
    @endif

    <input type="hidden" name="your_limit" value="{{ $your_limit }}">
    <input type="hidden" name="your_emi" value="{{ $your_emi }}">
 
  <div class="credit_card_limit" style="border-top: 1px solid #f3f3f3; margin-top: 10px; padding-top: 45px; padding-bottom: 30px;">
    <p style="text-align: center; max-width: 500px; margin: 0 auto; color: #333; font-weight: 500;font-size: 14px;">Please Note: Credit limits and loans are at the sole discretion of the loan/card extending bank.</p>
  </div>

  <div class="row">
    <div class="col-md-12 text-center">
      <a href="{{ route('admin.product-requested', $user_id) }}" class="back_btn" style="border: 1px solid #000;  padding: 10px 30px; color: #000;margin-top: 20px;">Back</a> &nbsp;&nbsp;
      <button type="submit" style="background: #000; color: #fff; padding: 8px 25px; margin-bottom: 35px;margin-top: 20px;">Proceed</button>
    </div>
  </div>
</form>
</div>
</div>

</div>
</div>
</section>

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
@endsection    
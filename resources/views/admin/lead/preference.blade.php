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
<h2 style="font-size: 22px; margin-bottom: 15px;margin-top: 20px;">Credit Card Preference</h2>
<!-- <h6 style="margin-bottom: 0px;">Please select the credit card preference</h6>  -->
<form action="{{ route('admin.save-preference', $user_id) }}" class="pref_bank" method="post">
{{ csrf_field() }}  

  @if($your_limit)
  <p style="margin-top: 25px !important; color: #333; font-weight: 500; font-size: 16px;">Based on the information that you have provided, you are eligible for a credit card with a limit of up to </p>
  <h5 style="text-align: center; margin-top: 30px !important; margin-bottom: 35px !important; color: #fff; font-weight: 600; font-size: 20px; background: #5EB495; max-width: 210px; margin: 0 auto; padding: 13px 1px;">AED {!! round($your_limit, 2); !!}/-*</h5>
  @endif 
  <h6 style="color: #000;font-size: 16px;margin-bottom: 0px;">Please tell us about the type of card you want to apply for:</h6>
  @foreach($card_types as $card_type)
  <label style="margin-right: 0px;width: 50%;float: left;margin-top: 15px;"><input type="checkbox"
   name="card_type[]" value="{{ $card_type->id }}"> {{ $card_type->name }}</label>
  @endforeach
  
  @if(session()->has('no_card_type'))
    <p style="color: #f00;">Kindly select a type of card </p>
  @endif

  <input type="hidden" name="your_limit" value="{{ $your_limit }}">

  <h4 style="border-top: 1px solid #f3f3f3; padding-top: 25px; color: #000; font-size: 16px;float: left;width: 100%;margin-top: 25px;">Please tell us about the choice of your banks</h4>
  <!-- <p style="color: rgba(9, 15, 5, 0.5);">On the basis of your basic information details we are suggesting you these offers.</p> -->
  @if($service)
    <input type="hidden" name="apply_id[]" value="{{ $service->id }}"> 
    <div class="row"> 
      @foreach(get_prefer_bank($service->service_id) as $bank) 
        
        @if($bank->default_show == 1)
        <div class="col-md-6" style="margin-bottom: 10px; margin-top: 5px;">
          <label><input type="checkbox" name="bank_id[]" value="{{ $bank->id }}"> {{ $bank->name }} @if($bank->valuable_text)<span class="info_box"><i class="ti-info sidemenu-icon menu-icon "></i> <div class="bank_iinfo"><p>{{ $bank->valuable_text }}</p></div> </span>@endif </label>
        </div>
        @else

        @if($avg_sal >= $bank->min_salary && $avg_sal <= $bank->max_salary)
          <div class="col-md-6" style="margin-bottom: 10px; margin-top: 5px;">
          <label><input type="checkbox" name="bank_id[]" value="{{ $bank->id }}"> {{ $bank->name }} @if($bank->valuable_text)<span class="info_box"><i class="ti-info sidemenu-icon menu-icon "></i> <div class="bank_iinfo"><p>{{ $bank->valuable_text }}</p></div> </span>@endif </label>
          </div>
        @else

        @if($bank->existing_card == 1) 
        @php
          $show = 0;
        @endphp
        @foreach(get_existing_bank_card($bank->id) as $bank_card)
            @if(in_array($bank_card->bank_id, $credit_bank))
              @php
                $show = 1;
              @endphp
            @endif 
        @endforeach
        @if($show == 1)
            
            <div class="col-md-6" style="margin-bottom: 10px; margin-top: 5px;">
          <label><input type="checkbox" name="bank_id[]" value="{{ $bank->id }}"> {{ $bank->name }} @if($bank->valuable_text)<span class="info_box"><i class="ti-info sidemenu-icon menu-icon "></i> <div class="bank_iinfo"><p>{{ $bank->valuable_text }}</p></div> </span>@endif </label>
          </div>

        @endif

        @endif
        @endif
        @endif

      @endforeach
      @if(session()->has('no_credit_card'))
        <p style="color: #f00; margin-left: 15px;">Kindly select a bank </p>
      @endif
    </div> 
  @endif

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

<style type="text/css">
.ti-info.sidemenu-icon.menu-icon {
    border: 1px solid;
    border-radius: 50%;
}
.bank_iinfo {
    background: #fff;
    position: absolute;
    width: 95%;
    z-index: 9;
    display: none;
    border: 1px solid #f00;
    border-radius: 3px;
    padding: 4px;
}
.info_box:hover .bank_iinfo {
    display: block;
}


</style>


@endsection    
@extends('admin.layouts.admin')
@php
    $route  = \Route::currentRouteName();    
@endphp
@section('content')

<section class="personal_details">
<div class="container">  
<div class="row">  
<div class="col-md-9">
<div class="personal_details_box cm_dt">
<!-- <h1 class="app_form_head">Application Form</h1>   -->
<h2 style="font-size: 22px; margin-bottom: 15px;margin-top: 20px;">Employment Details</h2>
<!-- <h6>Please enter your employment information</h6> -->
<form action="{{ route('admin.product-requested', $user_id) }}" enctype="multipart/form-data" method="post">
{{ csrf_field() }}  
<div class="row">
  <div class="col-md-6" style="margin-bottom: 20px;">
  <label class="sub-label">Employment Type*</label>
    <select name="cm_type" class="form-control" required="true" onChange="RelationChange(this);">
      <option value="">Select</option>
      <option value="1" @if($cm_type == '') selected @endif @if($cm_type == 1) selected @endif>Salaried</option>
      <option value="2" @if($cm_type == 2) selected @endif>Self Employed</option>
      <option value="3" @if($cm_type == 3) selected @endif>Pension</option>
    </select>
  </div>
</div>
<div class="row">
  <div class="col-md-6 salaried_type" @if($cm_type == 2 || $cm_type == 3) style="display: none;"  @endif>
    <div class="form-group form-rel">
      <label class="sub-label">Company Name*</label>
      <input type="text" @if($result) value="{{ $result->company_name }}" @else value="{{ old('company_name') }}" @endif @if($cm_type != 2 && $cm_type != 3) required="true" @endif name="company_name" id="company_name" class="form-control live_product_1 product_name">
      <ul id="live_product_1"></ul> 
      @if($errors->has('company_name'))
      <span class="text-danger">{{$errors->first('company_name')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6 salaried_type" @if($cm_type == 2 || $cm_type == 3) style="display: none;"  @endif>
    <div class="form-group">
      <label class="sub-label">Date of Joining*</label>
      <input name="date_of_joining" id="date_of_joining" @if($cm_type != 2 && $cm_type != 3) required="true"  @endif class="form-control" @if($result) value="{{ $result->date_of_joining }}" @else value="{{ old('date_of_joining') }}" @endif type="text">
      <i style="position: absolute; top: 42px; right: 30px;" class="ti-calendar sidemenu-icon menu-icon"></i>
      @if($errors->has('date_of_joining'))
      <span class="text-danger">{{$errors->first('date_of_joining')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6 salaried_type" @if($cm_type == 2 || $cm_type == 3) style="display: none;" @endif>
    <div class="form-group">
      <label class="sub-label">Monthly Salary (in AED)*</label>
      <input name="monthly_salary" pattern="\d*" maxlength="6" class="form-control" id="monthly_salary" @if($result) value="{{ $result->monthly_salary }}" @else value="{{ old('monthly_salary') }}" @endif @if($cm_type != 2 && $cm_type != 3) required="true"  @endif type="text">
      @if($errors->has('monthly_salary'))
      <span class="text-danger">{{ $errors->first('monthly_salary') }}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12 salaried_type" @if($cm_type == 2 || $cm_type == 3) style="display: none;" @endif>
    <label class="sub-label" style="color: #000; font-size: 15px;">The most three recent salary credit</label>
    <p style="color: rgba(9, 15, 5, 0.5);">To imporeve your approval rate. Please upload your salary credit slip</p>
    <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label class="sub-label">First (in AED)</label>
        <input name="last_one_salary_credits" pattern="\d*" maxlength="6" class="form-control" @if($result) value="{{ $result->last_one_salary_credits }}" @else value="{{ old('last_one_salary_credits') }}" @endif type="text">
        @if($errors->has('last_one_salary_credits'))
        <span class="text-danger">{{$errors->first('last_one_salary_credits')}}</span>
        @endif
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group" style="width: 75%; float: left;">
        <label class="sub-label">Upload salary slip</label><br>
        <input name="last_one_salary_file" style="box-shadow: none;padding-left: 0px;" class="form-control" type="file">
        @if($errors->has('last_one_salary_file'))
        <span class="text-danger">{{$errors->first('last_one_salary_file')}}</span>
        @endif
      </div>
      @if($result)
          @if($result->last_one_salary_file)
            <a href="{{ asset($result->last_one_salary_file) }}" download style="float: right;margin-top: 30px;"><i class="ti-download sidemenu-icon menu-icon "></i> Download</a> 
          @endif
      @endif
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label class="sub-label">Second (in AED)</label>
        <input name="last_two_salary_credits" pattern="\d*" maxlength="6" class="form-control" @if($result) value="{{ $result->last_two_salary_credits }}" @else value="{{ old('last_two_salary_credits') }}" @endif type="text">
        @if($errors->has('last_two_salary_credits'))
        <span class="text-danger">{{$errors->first('last_two_salary_credits')}}</span>
        @endif
      </div>
    </div> 

    <div class="col-md-6">
      <div class="form-group" style="width: 75%; float: left;">
        <label class="sub-label">Upload salary slip</label><br>
        <input name="last_two_salary_file" style="box-shadow: none;padding-left: 0px; width: 100%; float: left;" class="form-control" type="file">
        @if($errors->has('last_two_salary_file'))
        <span class="text-danger">{{$errors->first('last_two_salary_file')}}</span>
        @endif
      </div>
      @if($result)
          @if($result->last_two_salary_file)
            <a href="{{ asset($result->last_two_salary_file) }}" download style="float: right;margin-top: 30px;"><i class="ti-download sidemenu-icon menu-icon "></i> Download</a> 
          @endif
      @endif
    </div> 

    <div class="col-md-6">
      <div class="form-group">
        <label class="sub-label">Third (in AED)</label>
        <input name="last_three_salary_credits" maxlength="6" pattern="\d*" class="form-control" @if($result) value="{{ $result->last_three_salary_credits }}" @else value="{{ old('last_three_salary_credits') }}" @endif type="text">
        @if($errors->has('last_three_salary_credits'))
        <span class="text-danger">{{$errors->first('last_three_salary_credits')}}</span>
        @endif
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group" style="width: 75%; float: left;">
        <label class="sub-label">Upload salary slip</label><br>
        <input name="last_three_salary_file" style="box-shadow: none; padding-left: 0px; width: 100%; float: left;" class="form-control" type="file">
        @if($errors->has('last_three_salary_file'))
        <span class="text-danger">{{$errors->first('last_three_salary_file')}}</span>
        @endif
      </div>
      @if($result)
          @if($result->last_three_salary_file)
            <a href="{{ asset($result->last_three_salary_file) }}" download style="float: right;margin-top: 30px;"><i class="ti-download sidemenu-icon menu-icon "></i> Download</a> 
          @endif
      @endif
    </div> 

    <div class="col-md-12">
      <div class="form-group">
        <label style="font-weight: normal; font-size: 14px;"> <input style=" width: 18px;
    height: 18px; margin-top: 2px; float: left; margin-right: 10px;" type="checkbox" value="1" name="accommodation_company" @if($result) @if($result->accommodation_company == 1) checked=""  @endif @endif  > I have company provided accommodation.</label>
      </div>
    </div>

    </div>
  </div>

  <div class="col-md-6 self_employed_type" @if($cm_type != 2) style="display: none;" @endif>
    <div class="form-group">
      <label class="sub-label">Company Name*</label>
      <input type="text" @if($result) value="{{ $result->self_company_name }}" @else value="{{ old('self_company_name') }}" @endif @if($cm_type == 2) required="true" @endif name="self_company_name" id="self_company_name" class="form-control live_product_2 product_name2">
      <ul id="live_product_2"></ul>

      @if($errors->has('self_company_name'))
      <span class="text-danger">{{$errors->first('self_company_name')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6 self_employed_type" @if($cm_type != 2) style="display: none;" @endif>
    <div class="form-group">
      <label class="sub-label">Percentage Ownership*</label>
      <input name="percentage_ownership" maxlength="3" pattern="\d*" @if($cm_type == 2) required="true"  @endif id="percentage_ownership" class="form-control" @if($result) value="{{ $result->percentage_ownership }}" @else value="{{ old('percentage_ownership') }}" @endif type="text">
      @if($errors->has('percentage_ownership'))
      <span class="text-danger">{{$errors->first('percentage_ownership')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6 self_employed_type" @if($cm_type != 2) style="display: none;" @endif>
    <div class="form-group">
      <label class="sub-label">Type of profession/business*</label>
      <select name="profession_business" id="profession_business" class="form-control" @if($cm_type == 2) required="true"  @endif>
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

  <div class="col-md-6 self_employed_type" @if($cm_type != 2) style="display: none;" @endif>
    <div class="form-group">
      <label class="sub-label">Annual Business Income (in AED)*</label>
      <input name="annual_business_income" id="annual_business_income" pattern="\d*" maxlength="6" @if($cm_type == 2) required="true"  @endif class="form-control" @if($result) value="{{ $result->annual_business_income }}" @else value="{{ old('annual_business_income') }}" @endif type="text">
      @if($errors->has('annual_business_income'))
      <span class="text-danger">{{$errors->first('annual_business_income')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-6 pension_type" @if($cm_type != 3) style="display: none;" @endif>
    <div class="form-group">
      <label class="sub-label">Monthly Pension (in AED)*</label>
      <input name="monthly_pension" id="monthly_pension" pattern="\d*" maxlength="6" class="form-control" @if($cm_type == 3) required="true"  @endif @if($result) value="{{ $result->monthly_pension }}" @else value="{{ old('monthly_pension') }}" @endif type="text">
      @if($errors->has('monthly_pension'))
      <span class="text-danger">{{$errors->first('monthly_pension')}}</span>
      @endif
    </div>
  </div>

  <div class="col-md-12 text-center">
    <a href="{{ route('admin.personal-details', $user_id) }}" class="back_btn" style="border: 1px solid #000;  padding: 10px 30px; color: #000;">Back</a> &nbsp;&nbsp;
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
        $("#self_company_name").attr("required", true);
        $("#annual_business_income").attr("required", true);
        
    } else if(that.value == "3") {
        $(".salaried_type").hide();
        $(".self_employed_type").hide();
        $(".pension_type").show();

        $("#company_name").removeAttr('required');
        $("#date_of_joining").removeAttr('required'); 
        $("#monthly_salary").removeAttr('required');
        $("#self_company_name").removeAttr('required');

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
        $("#self_company_name").removeAttr('required');

        $("#monthly_pension").removeAttr('required');
    }
   
}

$(function() {
        $( "#date_of_joining" ).datepicker({
            "setDate": new Date(),
            "autoclose": true,
            maxDate: 0,
            dateFormat: 'dd/mm/yy',
            changeYear: true
        });
  });

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

<style type="text/css">
  
#live_product_1 input,
#live_product_2 input{
    position: absolute;
    width: 100%;
    opacity: 0;
    height: 100%;
    z-index: 4;
    margin-bottom: 0px;
    cursor: pointer;
} 
#live_product_1 li,
#live_product_2 li{
    cursor: pointer;
    position: relative;
    padding: 4px 10px;
}


#live_product_1, #live_product_2, #live_product_3 {
    position: absolute;
    z-index: 999;
    background: #f3f3f3;
    width: 100%;
    top: 64px;
    list-style: none;
    padding: 0px;
  /*  display: none;*/
}
#total_records1,
#total_records2 {
    position: absolute;
    z-index: 999;
    background: #f3f3f3;
    width: 100%;
    top: 64px;
    list-style: none;
    display: none;
}
#total_records1 li,
#total_records2 li{
    margin-bottom: 5px;
    text-transform: uppercase;
    font-weight: 500;
}
#live_product_1 li, #live_product_2 li, 
#live_product_3 li{
    margin-bottom: 5px;
    text-transform: capitalize;
    font-weight: 500;
    color: #000;
}
#live_product_1,
#live_product_2{
    display: none;
}
.view_hv:hover #total_records1,
.form-rel:hover #live_product_1,
.form-rel2:hover #live_product2,
.view_hv:hover #live_product_2,
.view_hv:hover #live_product_3{
    display: block;
}
  
</style>

@endsection    
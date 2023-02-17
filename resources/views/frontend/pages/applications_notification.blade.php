@extends('frontend.layouts.app')
@section('content')

<section class="cus_dashboard">
<div class="container">  
<div class="row"> 
<div class="col-md-12">

<div class="dashboard_sidebar" style="padding-bottom: 30px;">
  <h3 style="font-size: 24px; font-weight: 600; margin-top: 15px; margin-bottom: 15px;">Application Status</h3>
  @foreach($app_noti as $app_noti)
  <div class="row">
    <div class="col-md-12">
      <h5 style="line-height: 21px; margin-top: 0px; font-weight: 500; font-size: 14px;"><i class="fa-solid fa-arrow-right" style="color: #5EB495;"></i> &nbsp; Application no #{{ $app_noti->ref_id }} KYC is @if($app_noti->status == 0) pending @endif </h5>
    </div>
  </div>
  @endforeach



</div>

</div>
</div>
</div>
</section>



@endsection    
@extends('admin.layouts.admin')
@section('css')
<!-- tables -->
<link rel="stylesheet" type="text/css" href="{!! asset('css/table-style.css') !!}" />
<!-- //tables -->
@endsection
@section('content')
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>

<div class="agile-grids">
    <div class="grids">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">Social From Setting</h1>

                <div class="agile-tables">
                    <div class="w3l-table-info">
                        {{-- for message rendering --}}
                        @include('admin.layouts.messages')
                        <div class="panel panel-default">

                            <div class="row row-sm">
                                <div class="col-lg-12 col-md-12">
                                    <div class="card custom-card">
                                        <div class="card-body">
                                            <div>
                                                <h6 class="main-content-label mb-1">Social From Setting</h6>
                                            </div>
                                            <div class="panel-body row">
                                                <div class="col-md-12" style="margin-top: 15px;">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label>Email OTP</label>    
                                                            <div>
                                                                <label class="switch">
                                                                    <input onchange="email_setting(this.value);" value="{{$status->e_otp}}" type="checkbox" <?php if($status->e_otp == 1){echo "checked";} ?>>
                                                                    <span class="slider round"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Mobile OTP</label>    
                                                            <div>
                                                                <label class="switch">
                                                                <input onchange="mobile_setting(this.value);" value="{{$status->m_otp}}" type="checkbox" <?php if($status->m_otp == 1){echo "checked";} ?>>
                                                                    <span class="slider round"></span>
                                                                </label>
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
<script>
    function email_setting(val){
        var val = val;
        if(val == 0){
            vall = 1;
        }
        if(val == 1){
            vall = 0;
        }
        $.ajax({
            type:'GET',
            url:"{{url('admin/social_form_e_status')}}",
            data:{vall:vall},
            success:function(){
                location.reload();
            }                   
        });
        

    }
    function mobile_setting(val){
        var val = val;
        if(val == 0){
            m_vall = 1;
        }
        if(val == 1){
            m_vall = 0;
        }
        $.ajax({
            type:'GET',
            url:"{{url('admin/social_form_m_status')}}",
            data:{m_vall:m_vall},
            success:function(){
                location.reload();
            }                   
        });
        

    }
</script>

@stop
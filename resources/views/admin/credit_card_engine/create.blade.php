@extends('admin.layouts.admin')
@section('content')
@include('admin.layouts.messages')
@php
    $route  = \Route::currentRouteName();    
@endphp
<div class="agile-grids">   
    <div class="grids">       
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">Credit Card Engine Information<a class="btn btn-sm btn-primary pull-right" href="{!! route('credit-card-engines.index') !!}" > <i class="fa fa-solid fa-arrow-left"></i> All Credit Card Engines</a></h1>
                
                <div class="panel panel-widget forms-panel">
                    <div class="card custom-card">
            <div class="card-body">
            <div class="panel panel-widget forms-panel" style="float: left;width: 100%; padding-bottom: 20px;">
                <div class="forms">
                        <div class="form-grids widget-shadow" data-example-id="basic-forms"> 
                            <!-- <div class="form-title">
                                <h4>Service Information</h4>                        
                            </div> -->
                            <div class="form-body">
                                @if($route == 'credit-card-engines.create')
                                    {!! Form::open(array('method' => 'POST', 'route' => array('credit-card-engines.store'), 'id' => 'ajaxSave', 'class' => '', 'files'=>'true')) !!}
                                @elseif($route == 'credit-card-engines.edit')
                                    {!! Form::model($result, array('route' => array('credit-card-engines.update', $result->id), 'method' => 'PATCH', 'id' => 'credit-card-engines-form', 'class' => '', 'files'=>'true')) !!}
                                @else
                                    Nothing
                                @endif
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group"> 
                                            {!! Form::label('name', lang('Select Bank'), array('class' => '')) !!}
                                            @if(isset($banks))
                                            <select name="bank_id" class="form-control" required="true">
                                                <option value="">Select</option>
                                                @foreach($banks as $bank)
                                                <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                                @endforeach
                                            </select>
                                            @else
                                         <select name="bank_id" class="form-control" readonly="" required="true">
                                                <option value="">Select</option>
                                                @foreach($bank_list as $bank_li)
                                                <option @if($result->bank_id == $bank_li->id) selected @endif value="{{ $bank_li->id }}">{{ $bank_li->name }}</option>
                                                @endforeach
                                            </select>

                                            @endif
                                        </div> 
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        {!! Form::label('min_salary', lang('Min Salary (In AED)'), array('class' => '')) !!}
                                        {!! Form::number('min_salary', null, array('class' => 'form-control', 'required'=> 'true')) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        {!! Form::label('max_salary', lang('Max Salary (In AED)'), array('class' => '')) !!}
                                        {!! Form::number('max_salary', null, array('class' => 'form-control', 'required'=> 'true')) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                        {!! Form::label('default_show', lang('Show by default'), array('class' => '')) !!}
                                        <select class="form-control" required="true" name="default_show">
                                            <option @if(isset($result)) @if($result->default_show == 0) selected @endif @endif value="0">No</option>
                                            <option @if(isset($result)) @if($result->default_show == 1) selected @endif @endif value="1">Yes</option>
                                        </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                        {!! Form::label('valuable_text', lang('Valuable Text'), array('class' => '')) !!}
                                        {!! Form::text('valuable_text', null, array('class' => 'form-control')) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                        {!! Form::label('existing_card', lang('Is Having Credit Card'), array('class' => '')) !!}
                                        <select onChange="ExistingCardChange(this);" class="form-control" required="true" name="existing_card">
                                            <option @if(isset($result)) @if($result->existing_card == 0) selected @endif @endif value="0">No</option>
                                            <option @if(isset($result)) @if($result->existing_card == 1) selected @endif @endif value="1">Yes</option>
                                        </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12 bank_list" @if(isset($result)) @if($result->existing_card == 0) style="display: none;" @endif  @else style="display: none;" @endif >

                                        @if(isset($result)) 
                                        @if($result->existing_card == 1)
                                            @php $i = 50; @endphp
                                            @foreach($bank_credits as $bank_credit)
                                            @php $i++; @endphp
                                                <div class="row" id="bank_credits{{$i}}">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                        <label for="bank">Bank</label>
                                                        <select id="bank_fil" required="true" name="bank[{{$i}}]" class="form-control">
                                                        <option value="">Select</option>
                                                        @foreach($bank_list as $bank_li)
                                                        <option @if($bank_li->id == $bank_credit->bank_id) selected @endif value="{{ $bank_li->id }}">{{ $bank_li->name }}</option>
                                                        @endforeach
                                                        </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="credit_limit">Credit Limit</label>
                                                            <input value="{{ $bank_credit->credit_limit }}" required="true" id="credit_fil" type="number" name="credit_limit[{{$i}}]" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <a onclick="remove_bank{{$i}}();" class="del_btn">Delete</a>
                                                    </div>
                                                </div>

                                            @endforeach
                                        @endif
                                        @endif


                                        <div class="row" id="bank_fileds">
                                            @if(isset($result))
                                            @else
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="bank">Bank</label>
                                                    <select id="bank_fil" name="bank[0]" class="form-control">
                                                    <option value="">Select</option>
                                                    @foreach($bank_list as $bank_li)
                                                    <option value="{{ $bank_li->id }}">{{ $bank_li->name }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="credit_limit">Credit Limit</label>
                                                    <input id="credit_fil" type="number" name="credit_limit[0]" class="form-control">
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="form-group">   
                                                <input type="button" id="more_bank" onclick="add_bank();" value="Add Bank" />
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12" style="margin-top: 20px;">
                                        <button type="submit" class="btn btn-default w3ls-button">Submit</button> 
                                    </div>
                                </div>
                                    
                                {!! Form::close() !!}
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

<script type="text/javascript">

function ExistingCardChange(that) {
    if (that.value == "1") {
        $(".bank_list").show();
        $("#credit_fil").attr("required", true);
        $("#bank_fil").attr("required", true);
        $(".req_per").attr("required", true);
        
    } else {
        $(".bank_list").hide();
        $("#credit_fil").removeAttr('required');
        $("#bank_fil").removeAttr('required');
        $(".req_per").removeAttr('required');
    }
}

var count = 0;
function add_bank() {
    count++;
    var objTo = document.getElementById('bank_fileds')
    var divtest = document.createElement("div");
    divtest.innerHTML = '<div class="row" id="remove_bank'+ count +'"><div class="col-md-4"><div class="form-group"><label for="bank">Bank</label><select name="bank['+ count +']" required="true" class="form-control req_per"><option value="">Select</option><?php foreach($bank_list as $bank_li) { ?><option value="<?php echo $bank_li->id; ?>"><?php echo $bank_li->name; ?></option><?php } ?></select></div></div><div class="col-md-4"><div class="form-group"><label for="credit_limit">Credit Limit</label><input type="number" required="true" name="credit_limit['+ count +']" class="form-control req_per"></div></div><div class="col-md-4"><a onclick="remove_bank'+ count +'();" class="del_btn">Delete</a></div></div>';
    
    objTo.appendChild(divtest)
}

function remove_bank1() {
    const element = document.getElementById("remove_bank1");
    element.remove();
}
function remove_bank2() {
    const element = document.getElementById("remove_bank2");
    element.remove();
}
function remove_bank3() {
    const element = document.getElementById("remove_bank3");
    element.remove();
}
function remove_bank4() {
    const element = document.getElementById("remove_bank4");
    element.remove();
}
function remove_bank5() {
    const element = document.getElementById("remove_bank5");
    element.remove();
}
function remove_bank6() {
    const element = document.getElementById("remove_bank6");
    element.remove();
}
function remove_bank7() {
    const element = document.getElementById("remove_bank7");
    element.remove();
}
function remove_bank8() {
    const element = document.getElementById("remove_bank8");
    element.remove();
}
function remove_bank9() {
    const element = document.getElementById("remove_bank9");
    element.remove();
}
function remove_bank10() {
    const element = document.getElementById("remove_bank10");
    element.remove();
}
function remove_bank11() {
    const element = document.getElementById("remove_bank11");
    element.remove();
}
function remove_bank12() {
    const element = document.getElementById("remove_bank12");
    element.remove();
}
function remove_bank13() {
    const element = document.getElementById("remove_bank13");
    element.remove();
}
function remove_bank14() {
    const element = document.getElementById("remove_bank11");
    element.remove();
}
function remove_bank15() {
    const element = document.getElementById("remove_bank12");
    element.remove();
}
function remove_bank16() {
    const element = document.getElementById("remove_bank13");
    element.remove();
}


function remove_bank51() {
    const element = document.getElementById("bank_credits51");
    element.remove();
}
function remove_bank52() {
    const element = document.getElementById("bank_credits52");
    element.remove();
}
function remove_bank53() {
    const element = document.getElementById("bank_credits53");
    element.remove();
}
function remove_bank54() {
    const element = document.getElementById("bank_credits54");
    element.remove();
}
function remove_bank55() {
    const element = document.getElementById("bank_credits55");
    element.remove();
}
function remove_bank56() {
    const element = document.getElementById("bank_credits56");
    element.remove();
}

</script>

<style type="text/css"> 
#more_bank {
    margin-top: 0px;
    background: #5EB495;
    border: 0px;
    color: #fff;
    padding: 9px 20px 6px 20px;
}
.del_btn{
    background: #f00;
    color: #fff !important;
    margin-top: 30px;
    float: left;
    padding: 5px 20px;
    cursor: pointer;
}






</style>

@stop


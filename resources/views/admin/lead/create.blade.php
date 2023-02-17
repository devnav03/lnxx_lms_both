@extends('admin.layouts.admin')
@section('content')
@include('admin.layouts.messages')
@php
    $route  = \Route::currentRouteName();    
@endphp
<style>
* {
  box-sizing: border-box;
}

body {
  font: 16px Arial;  
}

/*the container must be positioned relative:*/
.autocomplete {
  position: relative;
  display: inline-block;
}

input {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}

input[type=text] {
  width: 100%;
}

input[type=submit] {
  background-color: DodgerBlue;
  color: #fff;
  cursor: pointer;
}

.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
</style>
<div class="agile-grids">   
    <div class="grids">       
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">Add Lead @if($route == 'lead.create')<button type="button" class="btn tn-sm btn-primary pull-right" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-solid fa-arrow-up"></i> Import Leads</button>
                @elseif($route == 'leads.add_leads')<button type="button" class="btn tn-sm btn-primary pull-right" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-solid fa-arrow-up"></i> Import Leads</button>@elseif($route == 'agent.leads.add_leads')<button type="button" class="btn tn-sm btn-primary pull-right" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-solid fa-arrow-up"></i> Import Leads</button>@elseif($route == 'manager.leads.add_leads')<button type="button" class="btn tn-sm btn-primary pull-right" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-solid fa-arrow-up"></i> Import Leads</button>@endif</h1>
                
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
                                @if($route == 'lead.create')
                                    {!! Form::open(array('method' => 'POST', 'route' => array('lead.store'), 'id' => 'ajaxSave', 'class' => '', 'files'=>'true')) !!}
                                @elseif($route == 'leads.add_leads')
                                    {!! Form::open(array('method' => 'POST', 'route' => array('emp-lead.store'), 'id' => 'ajaxSave', 'class' => '', 'files'=>'true')) !!}
                                @elseif($route == 'leads.edit_leads')
                                    {!! Form::model($result, array('route' => array('emp-lead.update', $result->id), 'method' => 'PATCH', 'id' => 'banks-form', 'class' => '', 'files'=>'true')) !!}
                                @elseif($route == 'lead.edit')
                                    {!! Form::model($result, array('route' => array('lead.update', $result->id), 'method' => 'PATCH', 'id' => 'banks-form', 'class' => '', 'files'=>'true')) !!}
                                @elseif($route == 'agent.leads.add_leads')
                                    {!! Form::open(array('method' => 'POST', 'route' => array('agent-lead.store'), 'id' => 'ajaxSave', 'class' => '', 'files'=>'true')) !!}
                                @elseif($route == 'manager.leads.add_leads')
                                {!! Form::open(array('method' => 'POST', 'route' => array('manager-lead.store'), 'id' => 'ajaxSave', 'class' => '', 'files'=>'true')) !!}
                                @else
                                    Nothing
                                @endif
                                
                                <div class="row">
                                    <div class="col-md-2">
                                         <div class="form-group">
                                            {!! Form::label('salutation', lang('Salutation'), array('class' => '')) !!}
                                            <select name="sat" class="form-control minimal" aria-label="Default select example">
                                                <option value="Mr.">Mr.</option>
                                                <option value="Mrs.">Mrs.</option>
                                                <option value="Miss.">Miss</option>
                                                <option value="Dr.">Dr.</option>
                                                <option value="Prof.">Prof.</option>
                                                <option value="Rev.">Rev.</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div> 
                                    </div>  
                                    <div class="col-md-4">
                                         <div class="form-group"> 
                                            {!! Form::label('fname', lang('First Name'), array('class' => '')) !!}
                                            {!! Form::text('fname', null, array('class' => 'form-control', 'required' => 'true')) !!}
                                        </div> 
                                    </div>  
                                    <div class="col-md-3">
                                         <div class="form-group"> 
                                            {!! Form::label('mname', lang('Middle Name'), array('class' => '')) !!}
                                            {!! Form::text('mname', null, array('class' => 'form-control')) !!}
                                        </div> 
                                    </div>  
                                    <div class="col-md-3">
                                         <div class="form-group"> 
                                            {!! Form::label('lname', lang('Last Name'), array('class' => '')) !!}
                                            {!! Form::text('lname', null, array('class' => 'form-control', 'required' => 'true')) !!}
                                        </div> 
                                    </div>  
                                    <div class="col-md-4">
                                         <div class="form-group"> 
                                          {!! Form::label('email', lang('Email'), array('class' => '')) !!}
                                          {!! Form::email('email', null, array('class' => 'form-control', 'required' => 'true')) !!}
                                        </div> 
                                    </div>  
                                    <div class="col-md-4">
  										              <label>Mobile</label>
  										              <div class="input-group telephone-input" id="mobile-number"></div> 
                                    <input type="number" max="9999999999" class="form-control" name="number" style="width: 100%;padding-left: 45px;">
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group"> 
                                        {!! Form::label('source', lang('Source'), array('class' => '')) !!}
                                        <select name="source" class="form-control minimal" aria-label="Default select example">
                                        <option>Select</option>
                                        
                                        @foreach($get_source as $get_source)
                                          <option value="{{$get_source->name}}">{{$get_source->name}}</option>
                                        @endforeach
                                        </select>
                                      </div> 
                                    </div>    
                                    <div class="col-md-4">
                                         <div class="form-group"> 
                                            {!! Form::label('product', lang('Product'), array('class' => '')) !!}
                                            <select name="product" class="form-control minimal" aria-label="Default select example">
                                                <option>Select</option>
                                                @foreach($get_type as $get_type)
                                                <option value="{{$get_type->name}}">{{$get_type->name}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                    </div>  

                                    <div class="col-md-4">
                                         <div class="form-group"> 
                                          {!! Form::label('reference', lang('Agent/Employee Reference ID'), array('class' => '')) !!}
                                          {!! Form::text('reference', null, array('class' => 'form-control')) !!}
                                        </div> 
                                    </div>

                                    @if(auth()->user()->user_type != 3)
                                    <div class="col-md-4">
                                         <div class="form-group"> 
                                            {!! Form::label('reference', lang('Assign To'), array('class' => '')) !!}
                                            <select name="product1" onchange="select_type(this.value)" class="form-control minimal" aria-label="Default select example">
                                                <option value="">Select</option>
                                                <option value="agent">Agent</option>
                                                <option value="employee">Employee</option>
                                                <option value="manager">Manager</option>
                                            </select>
                                        </div> 
                                    </div>  
                                    @endif
                                    <!-- <div class="col-md-6" id="agnet_list">
                                         <div class="form-group"> 
                                            {!! Form::label('reference', lang('Search by Name or ID'), array('class' => '')) !!}<br>
                                            <div class="autocomplete" style="width:495px;">
                                                <input id="myInput" type="text" name="user_id" class="form-control">
                                            </div>
                
                                        </div> 
                                    </div>   -->
                                    <div class="col-md-6" id="agent_list" style="display:none">
                                         <div class="form-group"> 
                                            {!! Form::label('reference', lang('Agent'), array('class' => '')) !!}
                                            <select name="agent" class="form-control minimal" aria-label="Default select example">
                                                <option value="">Select</option>
                                                @foreach($get_emp_assign as $get_emp_assign)
                                                <option value="{{$get_emp_assign->id}}">{{$get_emp_assign->name}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                    </div>  
                                    <div class="col-md-6" id="employee_list" style="display:none">
                                         <div class="form-group"> 
                                            {!! Form::label('reference', lang('Employee'), array('class' => '')) !!}
                                            <select name="employee" class="form-control minimal" aria-label="Default select example">
                                                <option value="">Select</option>
                                                @foreach($Employee_emp_assign as $get_emp_assign)
                                                <option value="{{$get_emp_assign->id}}">{{$get_emp_assign->name}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                    </div>  
                                    <div class="col-md-6" id="manager_list" style="display:none">
                                         <div class="form-group"> 
                                            {!! Form::label('reference', lang('Manager'), array('class' => '')) !!}
                                            <select name="manager" class="form-control minimal" aria-label="Default select example">
                                                <option value="">Select</option>
                                                @foreach($get_manager_assign as $get_manager_assign)
                                                <option value="{{$get_manager_assign->id}}">{{$get_manager_assign->name}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="col-md-12">
                                         <div class="form-group"> 
                                            {!! Form::label('note', lang('Note'), array('class' => '')) !!}
                                            <textarea name="note" id="" class="form-control" cols="30" rows="2"></textarea>
                                        </div> 
                                    </div>
                                    <div class="col-md-12">
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Lead</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                   
                       <span id="result"></span>
                        <form action="{{ route('testimonials.action') }}" method="post">
                          <div class="row">
                            <div class="col-sm-9">
                              <input type="file" style="padding: 10px; height: 43px; border: 0px;" class="form-control" name="excel_file" id="id-input-file-2">
                            </div>
                            <div class="col-sm-3">
                            <button type="button" style="padding: 8px 13px; font-size: 14px; margin-top: 2px;" class="btn btn-sm btn-primary" id="upload_excel" onclick="uploadfunction()" >Upload
                            <i class="ace-icon fa fa-arrow-up icon-on-right bigger-110"></i>
                            </button>
                            </div>
                          </div>
                            
                        </form>
                    
      </div>
      <div class="modal-footer">
        @if($route == 'lead.create')
        <a style="color:white;" href="{{route('lead.sample.sheet.download')}}" type="button" class="btn btn-success">Download Sample File</a>
        @elseif($route == 'leads.add_leads')
        <a style="color:white;" href="{{route('emp.lead.sample.sheet.download')}}" type="button" class="btn btn-success">Download Sample File</a>
        @elseif($route == 'agent.leads.add_leads')
        <a style="color:white;" href="{{route('agent.lead.sample.sheet.download')}}" type="button" class="btn btn-success">Download Sample File</a>
        @elseif($route == 'manager.leads.add_leads')
        <a style="color:white;" href="{{route('manager.lead.sample.sheet.download')}}" type="button" class="btn btn-success">Download Sample File</a>
        @endif
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});

function autocomplete(inp, arr) {
  var currentFocus;
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      this.parentNode.appendChild(a);
      for (i = 0; i < arr.length; i++) {
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          b = document.createElement("DIV");
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          b.addEventListener("click", function(e) {
              inp.value = this.getElementsByTagName("input")[0].value;
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        currentFocus++;
        addActive(x);
      } else if (e.keyCode == 38) { //up
        currentFocus--;
        addActive(x);
      } else if (e.keyCode == 13) {
        e.preventDefault();
        if (currentFocus > -1) {
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    if (!x) return false;
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

var countries = <?php echo $explode; ?>;
autocomplete(document.getElementById("myInput"), countries);
</script>

 @if($route == 'lead.create')
<script>
function uploadfunction(){
    var fileSelect = document.getElementById('id-input-file-2');
    var files = fileSelect.files;
    formData  = new FormData();
    var file = files[0]; 
    formData.append('uploaded_file', file, file.name);
    $("#upload_excel").text('Uploading....');
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: "{{ route('upload-lead') }}", 
        method: 'POST',
        data:formData ,
        mimeType: 'multipart/form-data',
        contentType: false,
        dataType:'json',
        processData: false,
        success:function(responce){
            if(responce.status==200){
                $("#result").html(responce.message);
                $("#upload_excel").text('Uploaded');
            }
        },
    });
}
</script>
<script>
    function select_type(value){
        if(value == 'agent'){
            $('#agent_list').show();
            $('#employee_list').hide();
            $('#manager_list').hide();
        }
        if(value == 'employee'){
            $('#agent_list').hide();
            $('#employee_list').show();
            $('#manager_list').hide();
        }
        if(value == 'manager'){
            $('#agent_list').hide();
            $('#employee_list').hide();
            $('#manager_list').show();
        }

    }
</script>
@elseif($route == 'leads.add_leads')
<script>
function uploadfunction(){
    var fileSelect = document.getElementById('id-input-file-2');
    var files = fileSelect.files;
    formData  = new FormData();
    var file = files[0]; 
    formData.append('uploaded_file', file, file.name);
    $("#upload_excel").text('Uploading....');
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: "{{ route('emp-upload-lead') }}", 
        method: 'POST',
        data:formData ,
        mimeType: 'multipart/form-data',
        contentType: false,
        dataType:'json',
        processData: false,
        success:function(responce){
            if(responce.status==200){
                $("#result").text(responce.message);
                $("#upload_excel").text('Uploaded');
            }
        },
    });
}
</script>
@elseif($route == 'agent.leads.add_leads')
<script>
function uploadfunction(){
    var fileSelect = document.getElementById('id-input-file-2');
    var files = fileSelect.files;
    formData  = new FormData();
    var file = files[0]; 
    formData.append('uploaded_file', file, file.name);
    $("#upload_excel").text('Uploading....');
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: "{{ route('agent-upload-lead') }}", 
        method: 'POST',
        data:formData ,
        mimeType: 'multipart/form-data',
        contentType: false,
        dataType:'json',
        processData: false,
        success:function(responce){
            if(responce.status==200){
                $("#result").text(responce.message);
                $("#upload_excel").text('Uploaded');
            }
        },
    });
}
</script>
@elseif($route == 'manager.leads.add_leads')
<script>
function uploadfunction(){
    var fileSelect = document.getElementById('id-input-file-2');
    var files = fileSelect.files;
    formData  = new FormData();
    var file = files[0]; 
    formData.append('uploaded_file', file, file.name);
    $("#upload_excel").text('Uploading....');
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: "{{ route('manager-upload-lead') }}", 
        method: 'POST',
        data:formData ,
        mimeType: 'multipart/form-data',
        contentType: false,
        dataType:'json',
        processData: false,
        success:function(responce){
            if(responce.status==200){
                $("#result").text(responce.message);
                $("#upload_excel").text('Uploaded');
            }
        },
    });
}
</script>

@endif

@stop


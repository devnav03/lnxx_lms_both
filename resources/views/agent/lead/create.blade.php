@extends('agent.layouts.agent')
@section('content')
@include('agent.layouts.messages')
@php
    $route  = \Route::currentRouteName();    
@endphp
<div class="agile-grids">   
    <div class="grids">       
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">Create Lead @if($route == 'agent.leads.add_leads')<button type="button" class="btn tn-sm btn-primary pull-right" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-solid fa-arrow-up"></i>Bulk Upload Leads</button> @endif </h1>
                
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
                                @if($route == 'agent.leads.add_leads')
                                    {!! Form::open(array('method' => 'POST', 'route' => array('agent-lead.store'), 'id' => 'ajaxSave', 'class' => '', 'files'=>'true')) !!}
                                @elseif($route == 'agent.leads.edit_leads')
                                    {!! Form::model($result, array('route' => array('agent-lead.update', $result->id), 'method' => 'PATCH', 'id' => 'banks-form', 'class' => '', 'files'=>'true')) !!}
                                @else
                                    Nothing
                                @endif
                                
                                <div class="row">
                                    <div class="col-md-6">
                                         <div class="form-group"> 
                                            {!! Form::label('name', lang('Name'), array('class' => '')) !!}
                                            {!! Form::text('name', null, array('class' => 'form-control', 'required' => 'true')) !!}
                                        </div> 
                                    </div>  
                                    <div class="col-md-6">
                                         <div class="form-group"> 
                                            {!! Form::label('email', lang('Email'), array('class' => '')) !!}
                                            {!! Form::email('email', null, array('class' => 'form-control', 'required' => 'true')) !!}
                                        </div> 
                                    </div>  
                                    <div class="col-md-6">
                                         <div class="form-group"> 
                                            {!! Form::label('number', lang('Mobile'), array('class' => '')) !!}
                                            @if(!empty($result->number))
                                            {!! Form::number('number', null, array('class' => 'form-control')) !!}
                                            @else
                                            {!! Form::number('number', null, array('class' => 'form-control', 'required' => 'true')) !!}
                                            @endif
                                        </div> 
                                    </div>  
                                    <div class="col-md-6">
                                         <div class="form-group"> 
                                            {!! Form::label('product', lang('Product'), array('class' => '')) !!}
                                            <select name="product" class="form-control" aria-label="Default select example">
                                                <option>Select Product</option>
                                                <?php $get_type = \DB::table('services')->get(); ?>
                                                @foreach($get_type as $get_type)
                                                <option value="{{$get_type->name}}" <?php if(!empty($result->product)){if($result->product == $get_type->name){echo"selected";}} ?>>{{$get_type->name}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                    </div>  

                                    <div class="col-md-6">
                                         <div class="form-group"> 
                                            {!! Form::label('reference', lang('Reference'), array('class' => '')) !!}
                                            {!! Form::text('reference', null, array('class' => 'form-control', 'required' => 'true')) !!}
                                        </div> 
                                    </div>  
                                    
                                    <div class="col-md-6">
                                         <div class="form-group"> 
                                            {!! Form::label('source', lang('Source'), array('class' => '')) !!}
                                            {!! Form::text('source', null, array('class' => 'form-control', 'required' => 'true')) !!}
                                        </div> 
                                    </div>  

                                    <div class="col-md-6">
                                         <div class="form-group"> 
                                            {!! Form::label('note', lang('Note'), array('class' => '')) !!}
                                            {!! Form::text('note', null, array('class' => 'form-control', 'required' => 'true')) !!}
                                        </div> 
                                    </div>

                                    <div class="col-md-6">
                                         <div class="form-group"> 
                                         </div> 
                                    </div>
                                 
                                    <div class="col-md-6">
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
        <h5 class="modal-title" id="exampleModalLabel">Upload Bulk Lead</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                        {{-- for message rendering --}}
                        @include('agent.layouts.messages')

                        <form method="post">
                            <div class="col-sm-12">
                                <input type="file" class="form-control" name="excel_file" id="id-input-file-2">
                            </div>
                            <div class="col-sm-12">
                            <button type="button" class="btn btn-sm btn-primary" id="upload_excel" onclick="uploadfunction()" >Upload
                            <i class="ace-icon fa fa-arrow-up icon-on-right bigger-110"></i>
                            </button>
                            </div>
                            <span id="result"></span>
                        </form>
                    
      </div>
      <div class="modal-footer">
        <a style="color:white;" href="{{route('agent.lead.sample.sheet.download')}}" type="button" class="btn btn-success">Download Sample File</a>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
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

@stop


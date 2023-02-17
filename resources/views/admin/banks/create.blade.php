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
                <h1 class="page-header">Bank Information<a class="btn btn-sm btn-primary pull-right" href="{!! route('banks.index') !!}" > <i class="fa fa-solid fa-arrow-left"></i> All Banks</a></h1>
                
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
                                @if($route == 'banks.create')
                                    {!! Form::open(array('method' => 'POST', 'route' => array('banks.store'), 'id' => 'ajaxSave', 'class' => '', 'files'=>'true')) !!}
                                @elseif($route == 'banks.edit')
                                    {!! Form::model($result, array('route' => array('banks.update', $result->id), 'method' => 'PATCH', 'id' => 'banks-form', 'class' => '', 'files'=>'true')) !!}
                                @else
                                    Nothing
                                @endif
                                
                                <div class="row">
                                    <div class="col-md-6">
                                         <div class="form-group"> 
                                            {!! Form::label('name', lang('Name'), array('class' => '')) !!}
                                            {!! Form::text('name', null, array('class' => 'form-control', 'required' => 'true')) !!}
                                        </div> 
                                        <div class="row">
                                        <div class="col-md-12">
                                        <div class="form-group"> 
                                            <ul style="padding: 0px; list-style: none;">
                                                @foreach($services as $service)   
                                                    <li style="margin-bottom: 6px;"><input @if(isset($service_id)) @if(in_array($service->id, $service_id)) checked="" @endif @endif style="float: left; margin-top: 3px; margin-right: 7px;" type="checkbox" value="{{ $service->id }}" name="service[]"> {{ $service->name }} </li>
                                                @endforeach
                                            </ul>

                                        </div>
                                    </div>
                                 
                                    <div class="col-md-12">
                                         <button type="submit" class="btn btn-default w3ls-button">Submit</button> 
                                    </div>
                                </div>
                                    </div>  

                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                            {!! Form::label('image', lang('Logo'), array('class' => '')) !!}
                                            @if(!empty($result->image))
                                            <input name="image" type='file' class="form-control" accept="image/png, image/jpeg" id="imgInp" style="padding-top: 6px; border: 0px;" />
                                            @else
                                            <input name="image" type='file' class="form-control" accept="image/png, image/jpeg" required="true" id="imgInp" style="padding-top: 6px; border: 0px;" />
                                            @endif
                                            <img id="blah" style="max-width: 55%;margin-top:10px;" src="#" alt="" />
                                        </div>
                                        @if(!empty($result->image))
                                            <div class="form-group"> 
                                                 {!! Html::image(asset($result->image),'' ,array('width' => 80 ,'class'=>'img-responsive') ) !!}
           
                                            </div>
                                        @endif
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
    
imgInp.onchange = evt => {
  const [file] = imgInp.files
  if (file) {
    blah.src = URL.createObjectURL(file)
  }
}    

</script>

@stop


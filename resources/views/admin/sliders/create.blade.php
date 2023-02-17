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
                <h1 class="page-header">Slider Information<a class="btn btn-sm btn-primary pull-right" href="{!! route('sliders.index') !!}" > <i class="fa fa-solid fa-arrow-left"></i> All Sliders</a></h1>
                
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
                                @if($route == 'sliders.create')
                                    {!! Form::open(array('method' => 'POST', 'route' => array('sliders.store'), 'id' => 'ajaxSave', 'class' => '', 'files'=>'true')) !!}
                                @elseif($route == 'sliders.edit')
                                    {!! Form::model($result, array('route' => array('sliders.update', $result->id), 'method' => 'PATCH', 'id' => 'sliders-form', 'class' => '', 'files'=>'true')) !!}
                                @else
                                    Nothing
                                @endif
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                            {!! Form::label('title', lang('Title'), array('class' => '')) !!}
                                            {!! Form::text('title', null, array('class' => 'form-control', 'required' => 'true')) !!}
                                        </div>
                                        <div class="form-group"> 
                                            {!! Form::label('link', lang('Link'), array('class' => '')) !!}
                                            {!! Form::text('link', null, array('class' => 'form-control')) !!}
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-default w3ls-button">Submit</button>
                                        </div> 
                                    </div>  

                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                            {!! Form::label('image', lang('Slider Image (1400px*700px)'), array('class' => '')) !!}
                                            @if(!empty($result->image))
                                            <input name="image" type='file' class="form-control" accept="image/png, image/jpeg" id="imgInp" style="padding-top: 6px; border: 0px;" />
                                            @else
                                            <input name="image" type='file' class="form-control" accept="image/png, image/jpeg" required="true" id="imgInp" style="padding-top: 6px; border: 0px;" />
                                            @endif
                                            <img id="blah" style="max-width: 55%;margin-top:10px;" src="#" alt="" />
                                        </div>
                                        @if(!empty($result->image))
                                            <div class="form-group"> 
                                                 {!! Html::image(asset($result->image),'' ,array('width' => 200 ,'class'=>'img-responsive') ) !!}
           
                                            </div>
                                        @endif
                                    </div>
                                 
                                    <div class="col-md-6">
                                          
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


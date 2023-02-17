@extends('admin.layouts.admin')
@section('css')
<!-- tables -->
<link rel="stylesheet" type="text/css" href="{!! asset('css/table-style.css') !!}" />
<!-- //tables -->
@endsection
@section('content')

<div class="agile-grids">
    <div class="grids">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">Social Lead Capturing</h1>

                <div class="agile-tables">
                    <div class="w3l-table-info">
                        <table class="table table-hover">
                            <thead>
                                <tr style="background: #5EB495;"> 
                                    <th class="text-center" style="width: 100px;color: #fff;">Sr. No.</th>
                                    <th style="color: #fff; text-align:center;">Name</th>
                                    <th style="color: #fff; text-align:center;">Social Link</th>
                                    <th style="color: #fff; text-align:center;">Copy Social Link</th>
                                </tr>
                            </thead>
                            <tbody>
                                <td class="text-center">1</td>
                                <td class="text-center">{{auth()->user()->name}}</td>
                                <td class="text-center"><input class="form-control" id="copyinput" type="text" value="{{route('social_form', auth()->user()->id)}}" disabled></td>
                                <td class="text-center"><a type="button" onclick="myFunction()" ><i style="font-size:33px;" class="ti-save"></i></a></td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function myFunction() {
  // Get the text field
  var copyText = document.getElementById("copyinput");

  // Select the text field
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices

  // Copy the text inside the text field
  navigator.clipboard.writeText(copyText.value);
  
  // Alert the copied text
  alert("Copied the text: " + copyText.value);
}
</script>

@stop
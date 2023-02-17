<thead>
<tr style="background: #5EB495;"> 
    <th class="text-center" style="width: 100px;color: #fff;">Sr. No.</th>
    <th style="color: #fff;">Name</th>
    <th style="color: #fff;">Email</th>
    <th style="color: #fff;">Gender</th>
    <th style="color: #fff;">DOB</th>
    <th style="color: #fff;">Mobile</th>
    <th style="color: #fff;">Profile Image</th>
    <th style="color: #fff;" width="6%" class="text-center">Status</th>
    <th style="color: #fff;" class="text-center">Action</th>
</tr>
</thead>
<tbody>
<?php $index = 1; ?>



@foreach($data as $detail)
<tr id="order_{{ $detail->id }}">
    <td class="text-center">{!! pageIndex($index++, $page, $perPage) !!}</td>
    <td><a style="color: #000;" href="{!! route('employee.edit', [$detail->id]) !!}">{!! $detail->salutation!!} {!! $detail->name !!}</a></td>
    <td>{!! $detail->email !!}</td>
    <td>{!! $detail->gender !!}</td>
    <td>{!! $detail->date_of_birth !!}</td>
    <td>{!! $detail->mobile !!}</td>
    <td><img class="rounded-circle" alt="80x80" src="{{URL::asset($detail->profile_image)}}" data-holder-rendered="true"></td>
    <td class="text-center">
        <a href="javascript:void(0);" class="toggle-status" data-message="{!! lang('messages.change_status') !!}" data-route="{!! route('employee.toggle', $detail->id) !!}" title="@if($detail->status == 0) Deactive @else Active @endif"> {!! Html::image('img/' . $detail->status . '.gif') !!} </a>
    </td>
    <td class="text-center col-md-1">
        <a class="btn btn-xs btn-primary" style="padding: 6px 8px; line-height: 17px; min-height: 25px;" href="{{ route('employee.edit', [$detail->id]) }}"><i class="fa fa-pen"></i></a>
    </td>    
</tr>
@endforeach
@if (count($data) < 1)
<tr>
    <td class="text-center" colspan="10">No Data Found</td>
</tr>
@else
<tr>
    <td colspan="10">
        {!! paginationControls($page, $total, $perPage) !!}
    </td>
</tr>
@endif
</tbody>
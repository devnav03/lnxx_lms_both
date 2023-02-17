<thead>
<tr style="background: #5EB495;">
    <th width="5%" class="text-center" style="color: #fff;">ID</th>
    <th style="color: #fff;">Title</th>
    <th width="6%" class="text-center" style="color: #fff;"> Status </th>
    <th class="text-center" style="color: #fff;">Action</th>
</tr>
</thead>
<tbody>
<?php $index = 1; ?>
@foreach($data as $detail)
<tr id="order_{{ $detail->id }}">
    <td class="text-center">{!! pageIndex($index++, $page, $perPage) !!}</td>
    <td><a href="{!! route('blogs.edit', [$detail->id]) !!}"> {!! $detail->title !!}</a></td>
    <td class="text-center">
        <a href="javascript:void(0);" class="toggle-status" data-message="{!! lang('messages.change_status') !!}" data-route="{!! route('blogs.toggle', $detail->id) !!}" title="@if($detail->status == 0) Deactive @else Active @endif">
            {!! Html::image('img/' . $detail->status . '.gif') !!}
        </a>
    </td>
    <td class="text-center col-md-1">
        <a class="btn btn-xs btn-primary" href="{{ route('blogs.edit', [$detail->id]) }}"><i class="fa fa-edit"></i></a>
       
    </td>    
</tr>
@endforeach
@if (count($data) < 1)
<tr>
    <td class="text-center" colspan="8">No data found</td>
</tr>
@else
<tr>
    <td colspan="10">
        {!! paginationControls($page, $total, $perPage) !!}
    </td>
</tr>
@endif
</tbody>
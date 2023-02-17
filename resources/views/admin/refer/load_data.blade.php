<thead>
<tr style="background: #5EB495;"> 
    <th class="text-center" style="width: 100px;color: #fff;">Sr. No.</th>
    <th style="color: #fff;">Invitee</th>
    <th style="color: #fff;">Name</th>
    <th style="color: #fff;">Mobile</th>
    <th style="color: #fff;">Email</th>
    <th style="color: #fff;" width="6%" class="text-center">Register</th>
</tr>
</thead>
<tbody>
<?php $index = 1; ?>

@foreach($data as $detail)
@php
$code = 1300+$detail->user_id;
@endphp

<tr id="order_{{ $detail->id }}">
    <td class="text-center">{!! pageIndex($index++, $page, $perPage) !!}</td>
    <td>{!! $detail->user_name !!} (lnxx{{$code}})</td>
    <td>{!! $detail->name !!}</td>
    <td>{!! $detail->mobile !!}</td>
    <td>{!! $detail->email !!}</td>
    <td class="text-center"> {!! Html::image('img/' . $detail->status . '.gif') !!} </td>  
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
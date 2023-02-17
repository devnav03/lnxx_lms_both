<thead>
<tr style="background: #5EB495;">
    <th width="5%" class="text-center" style="color: #fff;">ID</th>
    <th style="color: #fff;">Name</th>
    <th style="color: #fff;">Email</th>
    <th style="color: #fff;">Phone</th>
    <th style="color: #fff;">Subject</th>
    <th style="color: #fff;">Message</th>
    <th style="color: #fff;">IP Address</th>
</tr>
</thead>
<tbody>
<?php $index = 1; ?>
@foreach($data as $detail)
<tr id="order_{{ $detail->id }}">
    <td class="text-center">{!! pageIndex($index++, $page, $perPage) !!}</td>
    <td>{!! $detail->salutation !!} {!! $detail->first_name !!} {!! $detail->last_name !!}</td>
    <td>{!! $detail->email !!}</td>
    <td>{!! $detail->phone !!}</td> 
    <td>{!! $detail->subject !!}</td>
    <td>{!! $detail->message !!}</td>    
    <td>{!! $detail->ip_address !!}</td>
</tr>
@endforeach
@if (count($data) < 1)
<tr>
    <td class="text-center" colspan="7"> {!! lang('messages.no_data_found') !!} </td>
</tr>
@else
<tr>
    <td colspan="7">
        {!! paginationControls($page, $total, $perPage) !!}
    </td>
</tr>
@endif
</tbody>
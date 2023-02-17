<thead>
<tr style="background: #5EB495;"> 
    <th class="text-center" style="color: #fff;">Sr. No.</th>
    <th style="color: #fff;">Name</th>
    <th style="color: #fff;">Email</th>    
    <th style="color: #fff;">Mobile</th> 
    <th style="color: #fff;">DOB</th> 
    <th style="color: #fff;">Apply Date</th> 
    <th style="color: #fff;" class="text-center">Action</th>
</tr>
</thead>
<tbody>
<?php $index = 1; ?>

@foreach($data as $detail)
<tr id="order_{{ $detail->id }}">
    <td class="text-center">{!! pageIndex($index++, $page, $perPage) !!}</td>
    <td><a style="color: #000;" href="{!! route('agent-request.edit', [$detail->id]) !!}">{!! $detail->salutation !!} {!! $detail->first_name !!} {!! $detail->middle_name !!} {!! $detail->last_name !!}  </a></td>
    <td>{!! $detail->email !!}</td> 
    <td>{!! $detail->mobile !!}</td>
    <td>{!! $detail->date_of_birth !!}</td>
    <td>{!! date('d M, Y', strtotime($detail->created_at)) !!}</td>
    <td class="text-center col-md-1">
        <a class="btn btn-xs btn-primary" style="padding: 6px 8px; line-height: 17px; min-height: 25px;" href="{{ route('agent-request.edit', [$detail->id]) }}"><i class="fa fa-eye"></i></a>
        
    </td>    
</tr>
@endforeach
@if (count($data) < 1)
<tr>
    <td class="text-center" colspan="12">No Data Found</td>
</tr>
@else
<tr>
    <td colspan="12">
        {!! paginationControls($page, $total, $perPage) !!}
    </td>
</tr>
@endif
</tbody>
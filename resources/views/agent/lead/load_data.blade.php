<thead>
<tr style="background: #5EB495;"> 
    <th class="text-center" style="width: 100px;color: #fff;">Sr. No.</th>
    <th style="color: #fff; text-align:center;">Name</th>
    <th style="color: #fff; text-align:center;">Email</th>
    <th style="color: #fff; text-align:center;">Mobile</th>
    <th style="color: #fff; text-align:center;">Product</th>
    <th style="color: #fff; text-align:center;">Source</th>
    <th style="color: #fff; text-align:center;">Reference</th>
    <th style="color: #fff; text-align:center;">Uploaded by</th>
    <th style="color: #fff;text-align: center;">Status</th>
    <th style="color: #fff;text-align: center;">Note</th>
    <th style="color: #fff;text-align: center;">Follow Up Date</th>
    <th style="color: #fff; text-align:center;" class="text-center">Action</th>
</tr>
</thead>
<tbody>
<?php $index = 1; ?>



@foreach($data as $detail)
    <tr id="order_{{ $detail->id }}">
    <td class="text-center">{!! pageIndex($index++, $page, $perPage) !!}</td>
    <td class="text-center">{!! $detail->salutation!!} {!! $detail->name !!}</td>
    <td class="text-center">{!! $detail->email !!}</td>
    <td class="text-center">{!! $detail->number !!}</td>
    <td class="text-center">{!! $detail->product !!}</td>
    <td class="text-center">{!! $detail->source !!}</td>
    <td class="text-center">{!! $detail->reference !!}</td>
    <?php 
    $uploade_by = App\Models\User::select('name')->where('id', $detail->uploaded_by)->first();
    @$up_name =  $uploade_by->name
    ?>

    <td class="text-center">{!! $up_name !!}</td>
    <td >
            <?php $get_emp = App\Models\Lead::where('id', $detail->id)->first() ?>
            
            <select class="form-control" onchange="sendstatus(this.value, {{$detail->id}})">    
                <option value="OPEN" <?php if($get_emp->lead_status == "OPEN"){ echo "selected";} ?>>Open</option> 
                <option value="CLOSE" <?php if($get_emp->lead_status == "CLOSE"){ echo "selected";} ?>>Close</option> 
            </select>
        </td>
    <td><input type="text" onkeyup="runtimeinput(this.value, {{$detail->id}})" value="{{@$detail->note}}" class="form-control"></td>
    <td><input type="date" class="form-control" onkeyup="runtimefdate(this.value, {{$detail->id}})" value="{{$detail->f_date}}"></td>
    <td class="text-center col-md-1">
        <a class="btn btn-xs btn-primary" style="padding: 6px 8px; line-height: 17px; min-height: 25px;" href="{{ route('agent.leads.edit_leads', [$detail->id]) }}"><i class="fa fa-pen"></i></a>
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

<thead>
<tr style="background: #5EB495;"> 
<th class="text-center" style="width: 100px;color: #fff;">Sr. No.</th>
    <th style="color: #fff; text-align:center;">Name</th>
    <!-- <th style="color: #fff; text-align:center;">Email</th> -->
    <!-- <th style="color: #fff; text-align:center;">Mobile</th> -->
    <th style="color: #fff; text-align:center;">Product</th>
    <th style="color: #fff; text-align:center;">Source</th>
    <th style="color: #fff; text-align:center;">Reference</th>
    <th style="color: #fff; text-align:center;">Uploaded by</th>
    <!-- <th style="color: #fff;text-align: center;">Assign Lead</th> -->
    <th style="color: #fff; text-align:center;" class="text-center">Action</th>
</tr>
</thead>
<tbody>
<?php $index = 1; ?>



@foreach($data as $detail)
<tr id="order_{{ $detail->id }}">
    <td class="text-center">{!! pageIndex($index++, $page, $perPage) !!}</td>
    <td class="text-center"><a style="color: #000;" href="{!! route('lead.edit', [$detail->id]) !!}">{!! $detail->salutation!!} {!! $detail->name !!}</a></td>
    <!-- <td class="text-center">{!! $detail->email !!}</td> -->
    <!-- <td class="text-center">{!! $detail->number !!}</td> -->
    <td class="text-center">{!! $detail->product !!}</td>
    <td class="text-center">{!! $detail->source !!}</td>
    <td class="text-center">{!! $detail->reference !!}</td>
    <?php 
    $uploade_by = App\Models\User::select('name')->where('id', $detail->uploaded_by)->first();
    @$up_name =  $uploade_by->name
    ?>

    <td class="text-center">{!! $up_name !!}</td>
    <!-- <td > -->
            <?php $get_emp = App\Models\User::where('status', 1)->where('user_type', 4)->orWhere('user_type', 3)->get() ?>
            
            <!-- <select class="form-control"  id="send_value" onchange="sendvalue(this.value, {{$detail->id}})">    
                <option>Assign Employee</option>
                @foreach($get_emp as $get_emp)  
                <option value="{{$get_emp->id}}" <?php if($get_emp->id == $detail->alloted_to){ echo "selected";} ?> >{{$get_emp->name}}</option>
                @endforeach
            </select> -->
        <!-- </td> -->
    <td class="text-center col-md-1">
        <a class="btn btn-xs btn-primary" type="button" style="color:white; padding: 6px 8px; line-height: 17px; min-height: 25px;" data-toggle="modal" onclick="view_details({{$detail->id}})" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a>
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

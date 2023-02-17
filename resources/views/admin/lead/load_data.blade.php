<thead>
<tr style="background: #5EB495;"> 
    <th class="text-center"><input type="checkbox" id="select_all"></th>
    <th class="text-center" style="width: 100px;color: #fff;">Sr. No.</th>
    <th style="color: #fff; text-align:center;">Name</th>
    <!-- <th style="color: #fff; text-align:center;">Email</th>
    <th style="color: #fff; text-align:center;">Mobile</th> -->
    <th style="color: #fff; text-align:center;">Product</th>
    <th style="color: #fff; text-align:center;">Source</th>
    <th style="color: #fff; text-align:center;">Reference</th>
    <th style="color: #fff; text-align:center;">Uploaded by</th>
    <th style="color: #fff;text-align: center;">Assign Lead</th>
    <th style="color: #fff; text-align:center;" class="text-center">Action</th>
</tr>
</thead>
<tbody>
<?php $index = 1; ?>



@foreach($data as $detail)
    <tr id="order_{{ $detail->id }}">
    <td class="text-center"><input type="checkbox" class="checkbox" name="check_v[]" value="{{$detail->id}}"/></td>
    <td class="text-center">{!! pageIndex($index++, $page, $perPage) !!}</td>
    <td class="text-center"><a style="color: #000;" href="{!! route('lead.edit', [$detail->id]) !!}">{!! $detail->salutation!!} {!! $detail->name !!}</a></td>
    <!-- <td class="text-center">{!! $detail->email !!}</td>
    <td class="text-center">{!! $detail->number !!}</td> -->
    <td class="text-center">{!! $detail->product !!}</td>
    <td class="text-center">{!! $detail->source !!}</td>
    <td class="text-center">{!! $detail->reference !!}</td>
    <?php 
    $uploade_by = App\Models\User::select('name')->where('id', $detail->uploaded_by)->first();
    @$up_name =  $uploade_by->name
    ?>

    <td class="text-center">{!! $up_name !!}</td>
    <td style="text-align: center;">
    <button type="button" style="padding: 3px 10px; min-height: 20px; font-size: 13px;" class="btn btn-warning" data-toggle="modal" onclick="get_ids({{$detail->id}})" data-target="#exampleModal1">Assign</button>
        </td>
        <td class="text-center col-md-1">
    <button type="button" style="padding: 3px 10px; min-height: 20px; font-size: 13px;" class="btn btn-primary" onclick="view_details({{$detail->id}})" data-toggle="modal" data-target="#exampleModalCenter">
    @if($detail->seen == '')
        <i class="fa fa-eye" id="unseen_eye{{$detail->id}}"></i>
    @else
        <i class="fa fa-eye" id="seen_eye{{$detail->id}}"></i>
    @endif
    </button>    
    </td> 
    <!-- <td class="text-center col-md-1">
        <a class="btn btn-xs btn-primary" style="padding: 6px 8px; line-height: 17px; min-height: 25px;" href="{{ route('lead.edit', [$detail->id]) }}"><i class="fa fa-pen"></i></a>
    </td>     -->
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
<script type="text/javascript">
$(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });
});
</script>
</tbody>

<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


function lang($path = null, $string = null)
{
    $lang = $path;
    if (trim($path) != '' && trim($string) == '') {
        $lang = \Lang::get($path);
    } elseif (trim($path) != '' && trim($string) != '') {
        $lang = \Lang::get($path, ['attribute' => $string]);
    }
    return $lang;
}

function isSuperAdmin()
{
    if(\Auth::check()) {
        return (\Auth::user()->user_type == 1) ? true : false;
    }
}

function isEmp()
{
    if(\Auth::check()) {
        return (\Auth::user()->user_type == 4) ? true : false;
    }
}
function isAgent()
{
    if(\Auth::check()) {
        return (\Auth::user()->user_type == 3) ? true : false;
    }
}
function isManager()
{
    if(\Auth::check()) {
        return (\Auth::user()->user_type == 5) ? true : false;
    }
}

function pageIndex($index, $page, $perPage)
{
    return (($page - 1) * $perPage) + $index;
}

function paginationControls($page, $total, $perPage = 20)
{
    $paginates = '';
    $curPage = $page;
    $page -= 1;
    $previousButton = true;
    $next_btn = true;
    $first_btn = false;
    $last_btn = false;
    $noOfPaginations = ceil($total / $perPage);

    /* ---------------Calculating the starting and ending values for the loop----------------------------------- */
    if ($curPage >= 10) {
        $start_loop = $curPage - 5;
        if ($noOfPaginations > $curPage + 5) {
            $end_loop = $curPage + 5;
        } elseif ($curPage <= $noOfPaginations && $curPage > $noOfPaginations - 9) {
            $start_loop = $noOfPaginations - 9;
            $end_loop = $noOfPaginations;
        } else {
            $end_loop = $noOfPaginations;
        }
    } else {
        $start_loop = 1;
        if ($noOfPaginations > 10)
            $end_loop = 10;
        else
            $end_loop = $noOfPaginations;
    }

    $paginates .= '<div class="col-sm-5 padding0 pull-left custom-martop">' .
        lang('Jump to ') .
        '<input type="text" class="goto" size="1" />
                    <button type="button" id="go_btn" class="small-btn small-btn-primary"> <span class="fa fa-arrow-right"> </span> </button> ' .
        lang('Pages') . ' ' .  $curPage . ' of <span class="_total">' . $noOfPaginations . '</span> | ' . lang('Total Records', $total) .
        '</div> <ul class="pagination pagination-sm pull-right custom-martop">';

    // FOR ENABLING THE FIRST BUTTON
    if ($first_btn && $curPage > 1) {
        $paginates .= '<li p="1" class="disabled">
                            <a href="javascript:void(0);">' .
            lang('common.first')
            . '</a>
                       </li>';
    } elseif ($first_btn) {
        $paginates .= '<li p="1" class="disabled">
                            <a href="javascript:void(0);">' .
            lang('common.first')
            . '</a>
                       </li>';
    }

    // FOR ENABLING THE PREVIOUS BUTTON
    if ($previousButton && $curPage > 1) {
        $pre = $curPage - 1;
        $paginates .= '<li p="' . $pre . '" class="_paginate">
                            <a href="javascript:void(0);" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                       </li>';
    } elseif ($previousButton) {
        $paginates .= '<li class="disabled">
                            <a href="javascript:void(0);" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                       </li>';
    }

    for ($i = $start_loop; $i <= $end_loop; $i++) {
        if ($curPage == $i)
            $paginates .= '<li p="' . $i . '" class="active"><a href="javascript:void(0);">' . $i . '</a></li>';
        else
            $paginates .= '<li p="' . $i . '" class="_paginate"><a href="javascript:void(0);">' . $i . '</a></li>';
    }

    // TO ENABLE THE NEXT BUTTON
    if ($next_btn && $curPage < $noOfPaginations) {
        $nex = $curPage + 1;
        $paginates .= '<li p="' . $nex . '" class="_paginate">
                            <a href="javascript:void(0);" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                       </li>';
    } elseif ($next_btn) {
        $paginates .= '<li class="disabled">
                            <a href="javascript:void(0);" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                       </li>';
    }

    // TO ENABLE THE END BUTTON
    if ($last_btn && $curPage < $noOfPaginations) {
        $paginates .= '<li p="' . $noOfPaginations . '" class="_paginate">
                            <a href="javascript:void(0);">' .
            lang('common.last')
            . '</a>
                       </li>';
    } elseif ($last_btn) {
        $paginates .= '<li p="' . $noOfPaginations . '" class="disabled">
                            <a href="javascript:void(0);">' .
            lang('common.last')
            . '</a>
                       </li>';
    }

    $paginates .= '</ul>';

    return $paginates;
}

function authUserIdNull() {
    $id = null;
    if (\Auth::check()) {
        $id = \Auth::user()->id;
    }
    return $id;
}

function get_family_info($id){
    $user_id = \Auth::user()->id;
    return App\Models\Dependent::where('user_id', $user_id)->skip($id)->select('name', 'relation')->first();
}

function get_family_info_agent($id, $user_id){
    return App\Models\Dependent::where('user_id', $user_id)->skip($id)->select('name', 'relation')->first();
}

function get_service_status($service_id){

    $id = \Auth::user()->id;
    $apply_ser = App\Models\ServiceApply::where('service_id', $service_id)->where('app_status', 0)->where('customer_id', $id)->count();
    
    if($apply_ser == 0){
        $value = 0;
    } else {
        $value = 1;
    }
    return $value;
}

function get_service_status_agent($service_id, $id){

    $apply_ser = App\Models\ServiceApply::where('service_id', $service_id)->where('app_status', 0)->where('customer_id', $id)->count();
    
    if($apply_ser == 0){
        $value = 0;
    } else {
        $value = 1;
    }
    return $value;
}


function get_service_details($id){
    $apply_ser = App\Models\ServiceApply::where('customer_id', $id)->select('service_id')->get();
    $services = [];
    foreach ($apply_ser as $service) {
        $service = App\Models\Service::where('id', $service->service_id)->select('name')->first();
            $slide['name'] = $service->name;
            $services[] = $slide;   
    }
    
    return $services;
}

function get_prefer_bank($id){
    return \DB::table('bank_services')
            ->join('banks', 'banks.id', '=', 'bank_services.bank_id')
            ->join('credit_card_engines', 'credit_card_engines.bank_id', '=', 'banks.id')
            ->select('banks.name', 'banks.id', 'credit_card_engines.min_salary', 'credit_card_engines.max_salary', 'credit_card_engines.existing_card', 'credit_card_engines.default_show', 'credit_card_engines.valuable_text')->where('bank_services.service_id', $id)->get(); 
}

function get_prefer_bank_personal_loan($id){
    return \DB::table('bank_services')
            ->join('banks', 'banks.id', '=', 'bank_services.bank_id')
            ->select('banks.name', 'banks.id')->where('bank_services.service_id', $id)->get(); 
}



function get_existing_bank_card($id){
    return \DB::table('existing_credit_card_engines')
            ->join('credit_card_engines', 'credit_card_engines.id', '=', 'existing_credit_card_engines.engine_id')
            ->select('existing_credit_card_engines.bank_id', 'existing_credit_card_engines.credit_limit')->where('credit_card_engines.bank_id', $id)->get(); 
}

function get_sel_bank($id){
    $result =  App\Models\ServiceApply::where('id', $id)->select('bank_id')->first();
    return @$result->bank_id;
}

function authUserId() {
    $id = 1;
    if (\Auth::check()) {
        $id = \Auth::user()->id;
    }
    return $id;
}

function apiResponseApp($status, $statusCode, $message, $errors = [], $data = [])
{
    $response = ['success' => $status, 'status' => $statusCode];
    
    if ($message != "") {
        $response['message']['success'] = $message;
    }

    if(isset($errors)){
        if (count($errors) > 0) {
            $response['message']['errors'] = $errors;
        }
    }
    
    if (isset($data)) {
        $response['data'] = $data;
    }
    return response()->json($response);
}

function apiResponseAppmsg($status, $statusCode, $message, $errors = [], $data = [])
{
    $response = ['success' => $status, 'status' => $statusCode];
    
    if ($message != "") {
        $response['message'] = $message;
    }

    if(isset($errors)){
        if (count($errors) > 0) {
            $response['message']['errors'] = $errors;
        }
    }
    
    if (isset($data)) {
        $response['data'] = $data;
    }
    return response()->json($response);
}


function apiResponseAppcart($status, $statusCode, $message, $errors = [], $data = [], $total_amount)
{
    $response = ['success' => $status, 'status' => $statusCode, 'total_amount' => $total_amount];
    
    if ($message != "") {
        $response['message']['success'] = $message;
    }

    if(isset($errors)){
        if (count($errors) > 0) {
            $response['message']['errors'] = $errors;
        }
    }
    
    if (isset($data)) {
        $response['data'] = $data;
    }
    return response()->json($response);
}










<?php

namespace App\Http\Controllers;
use Intervention\Image\ImageManagerStatic as Image;
use Auth;
use Files;
use Illuminate\Support\Facades\Storage;
use App\Models\Lead; 
use App\Models\Bank; 
use App\Models\Employee; 
use App\Models\Country; 
use App\Models\Company; 
use App\Models\CustomerOnboarding; 
use App\Models\ProductRequest; 
use App\Models\ServiceApply; 
use App\Models\SelfEmpDetail;
use App\Models\CmSalariedDetail;
use App\Models\Service;
use App\Models\User; 
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class LeadController extends  Controller{

    public function index() {
        return view('admin.lead.index');
    }
  
    public function create() {
        $filterResult = User::select('name')->whereIn('user_type', [3, 4, 5])->get();
        $explode = json_encode($filterResult);
        $get_manager_assign = User::where('user_type', 5)->where('status', 1)->get();
        $get_emp_assign = User::where('user_type', 3)->where('status', 1)->get();
        $Employee_emp_assign = User::where('user_type', 4)->where('status', 1)->get();
        $get_type = Service::where('status', 1)->get();
        $get_source = \DB::table('lead_source')->get();

        return view('admin.lead.create', compact('explode', 'get_manager_assign', 'get_emp_assign', 'Employee_emp_assign', 'get_type', 'get_source'));
    }
    
    public function send_in_process_status(Request $request){

        Lead::where('id', $request->id)
         ->update([
            'lead_status' => 'INPROCESS'
        ]);

        $lead = Lead::where('id', $request->id)->select('email', 'number')->first();
        $user = User::where('email', $lead->email)->orWhere('mobile', $request->number)->select('id')->first();
        if($user){
            $data['id'] = $user->id;
            $data['status'] = 200;
        } else {
            $data['id'] = $request->id;
            $data['status'] = 201;  
        }
        return $data;
    }


    public function store(Request $request) {
        // dd($_POST);
        try {
            $inputs = $request->all();
            $inputs['product'] = $request->product;
            $user_id = \Auth::id();
            $user_type = Auth()->user()->user_type;
            if($user_type == 1){
                $validator = (new Lead)->validate($inputs);
                $inputs['saturation'] = $request->sat;
                $inputs['name'] = $request->fname;
                $inputs['mname'] = $request->mname;
                $inputs['lname'] = $request->lname;
                $inputs['number'] = str_replace('+971', '', $inputs['number']);
                $inputs['number'] = str_replace(' ', '', $inputs['number']);
                

                if(!empty($request->agent)){
                    $inputs['alloted_to'] = $request->agent;
                }elseif(!empty($request->employee)){
                    $inputs['alloted_to'] = $request->employee;
                }elseif(!empty($request->manager)){
                    $inputs['alloted_to'] = $request->manager;
                }
                $inputs['uploaded_by'] = $user_id;
                (new Lead)->store($inputs);
                return back()->with('success', 'Lead successfully created');
            }elseif($user_type == 3){

                $validator = (new Lead)->validate($inputs);
                $inputs['saturation'] = $request->sat;
                $inputs['name'] = $request->fname;
                $inputs['mname'] = $request->mname;
                $inputs['lname'] = $request->lname;
                $inputs['number'] = str_replace('+971', '', $inputs['number']);
                $inputs['number'] = str_replace(' ', '', $inputs['number']);
                $inputs['uploaded_by'] = $user_id;
                $inputs['alloted_to'] = $user_id;
                // print_r($inputs['alloted_to']);
                // die;
                (new Lead)->store($inputs);
                return back()->with('success', 'Lead successfully created');                
            }elseif($user_type == 4){
                $validator = (new Lead)->validate($inputs);
                $inputs['uploaded_by'] = $user_id;
                $inputs['alloted_to'] = $user_id;
                (new Lead)->store($inputs);
                return back()->with('success', 'Lead successfully created');                
            }elseif($user_type == 5){
                $validator = (new Lead)->validate($inputs);
                $inputs['uploaded_by'] = $user_id;
                $inputs['alloted_to'] = $user_id;
                (new Lead)->store($inputs);
                return back()->with('success', 'Lead successfully created');                
            } 
        } catch (\Exception $exception) {
            return back()->withInput()->with('error', lang('messages.server_error').$exception->getMessage());
        }
    }

  
    public function update(Request $request, $id = null) {
        $result = (new Lead)->find($id);
        if (!$result) {
            abort(401);
        }
        $inputs = $request->all();
        try {
            (new Lead)->store($inputs, $id);
            return redirect()->route('lead.index')
                ->with('success', 'Employee successfully updated');
        } catch (\Exception $exception) {
            return redirect()->route('lead.edit', [$id])
                ->withInput()
                ->with('error', lang('messages.server_error'));
        }
    }

  
    public function edit($id = null) {
        $result = (new Lead)->find($id);
        if (!$result) {
            abort(401);
        }
        return view('admin.lead.create', compact('result'));
    }


    public function leadPaginate(Request $request, $pageNumber = null) {
        if (!\Request::isMethod('post') && !\Request::ajax()) { //
            return lang('messages.server_error');
        }

        $inputs = $request->all();
        $page = 1;
        if (isset($inputs['page']) && (int)$inputs['page'] > 0) {
            $page = $inputs['page'];
        }

        $perPage = 20;
        if (isset($inputs['perpage']) && (int)$inputs['perpage'] > 0) {
            $perPage = $inputs['perpage'];
        }

       // dd('test');                                                                                                                                                       

        $start = ($page - 1) * $perPage;
        if (isset($inputs['form-search']) && $inputs['form-search'] != '') {
            $inputs = array_filter($inputs);
            unset($inputs['_token']);
            $data = (new Lead)->getlead($inputs, $start, $perPage);
            $totalGameMaster = (new Lead)->totalLead($inputs);
            $total = $totalGameMaster->total;
            // dd($data);
        } else {
            $data = (new Lead)->getlead($inputs, $start, $perPage);
            $totalGameMaster = (new Lead)->totalLead();                                 
            $total = $totalGameMaster->total;
        }

       //   dd($data);

        return view('admin.lead.load_data', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }

 
    // public function servicesToggle($id = null) {
    //     if (!\Request::isMethod('post') && !\Request::ajax()) {
    //         return lang('messages.server_error');
    //     }
    //     try {
    //         $game = Employee::find($id);
    //     } catch (\Exception $exception) {
    //         return lang('messages.invalid_id', string_manip(lang('Employee')));
    //     }

    //     $game->update(['status' => !$game->status]);
    //     $response = ['status' => 1, 'data' => (int)$game->status . '.gif'];
    //     // return json response
    //     return json_encode($response);
    // }

  
    public function leadAction(Request $request)  {

        $inputs = $request->all();
        if (!isset($inputs['tick']) || count($inputs['tick']) < 1) {
            return redirect()->route('employee.index')
                ->with('error', lang('messages.atleast_one', string_manip(lang('Bank'))));
        }

        $ids = '';
        foreach ($inputs['tick'] as $key => $value) {
            $ids .= $value . ',';
        }

        $ids = rtrim($ids, ',');
        $status = 0;
        if (isset($inputs['active'])) {
            $status = 1;
        }

        Lead::whereRaw('id IN (' . $ids . ')')->update(['status' => $status]);
        return redirect()->route('banks.index')
            ->with('success', lang('messages.updated', lang('Bank')));
    }


    public function drop($id) {
        if (!\Request::ajax()) {
            return lang('messages.server_error');
        }
        $result = (new Employee)->find($id);
        if (!$result) {
            // use ajax return response not abort because ajaz request abort not works
            abort(401);
        }
        try {
            // get the unit w.r.t id
            $result = (new Employee)->find($id);
            // if($result->status == 1) {
            //     $response = ['status' => 0, 'message' => lang('category.category_in_use')];
            // }
            //  else {
                (new Employee)->tempDelete($id);
                $response = ['status' => 1, 'message' => lang('messages.deleted', lang('Bank'))];
             // }
        }
        catch (Exception $exception) {
            $response = ['status' => 0, 'message' => lang('messages.server_error')];
        }        
        // return json response
        return json_encode($response);
    }

    public function lead_assign_leads() {
        return view('admin.lead.assign');
    }
    public function social(){
        return view('admin.lead.social');
    }

    public function assignleadPaginate(Request $request){
        if (!\Request::isMethod('post') && !\Request::ajax()) { //
            return lang('messages.server_error');
        }

        $inputs = $request->all();
        $page = 1;
        if (isset($inputs['page']) && (int)$inputs['page'] > 0) {
            $page = $inputs['page'];
        }

        $perPage = 20;
        if (isset($inputs['perpage']) && (int)$inputs['perpage'] > 0) {
            $perPage = $inputs['perpage'];
        }

       // dd('test');

        $start = ($page - 1) * $perPage;
        if (isset($inputs['form-search']) && $inputs['form-search'] != '') {
            $inputs = array_filter($inputs);
            unset($inputs['_token']);
            $data = (new Lead)->getassignlead($inputs, $start, $perPage);
            $totalGameMaster = (new Lead)->assigntotalLead($inputs);
            $total = $totalGameMaster->total;
            // dd($data);
        } else {
            $data = (new Lead)->getassignlead($inputs, $start, $perPage);
            $totalGameMaster = (new Lead)->assigntotalLead();
            $total = $totalGameMaster->total;
        }

       // dd($data);

        return view('admin.lead.assign_load', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }
    public function assignleadAction(Request $request){
        $inputs = $request->all();
        if (!isset($inputs['tick']) || count($inputs['tick']) < 1) {
            return redirect()->route('employee.index')
                ->with('error', lang('messages.atleast_one', string_manip(lang('Bank'))));
        }

        $ids = '';
        foreach ($inputs['tick'] as $key => $value) {
            $ids .= $value . ',';
        }

        $ids = rtrim($ids, ',');
        $status = 0;
        if (isset($inputs['active'])) {
            $status = 1;
        }

        Lead::whereRaw('id IN (' . $ids . ')')->update(['status' => $status]);
        return redirect()->route('banks.index')
            ->with('success', lang('messages.updated', lang('Bank')));
    }
    public function lead_assign_automatic_leads() {
        return view('admin.lead.automatic');
    }
    public function lead_open_leads() {
        return view('admin.lead.open');
    }
    public function lead_close_leads() {
        return view('admin.lead.close');
    }
    public function openleadPaginate(Request $request){
        if (!\Request::isMethod('post') && !\Request::ajax()) { //
            return lang('messages.server_error');
        }

        $inputs = $request->all();
        $page = 1;
        if (isset($inputs['page']) && (int)$inputs['page'] > 0) {
            $page = $inputs['page'];
        }

        $perPage = 20;
        if (isset($inputs['perpage']) && (int)$inputs['perpage'] > 0) {
            $perPage = $inputs['perpage'];
        }

       // dd('test');

        $start = ($page - 1) * $perPage;
        if (isset($inputs['form-search']) && $inputs['form-search'] != '') {
            $inputs = array_filter($inputs);
            unset($inputs['_token']);
            $data = (new Lead)->getAdminOpenlead($inputs, $start, $perPage);
            $totalGameMaster = (new Lead)->totalAdminOpenLead($inputs);
            $total = $totalGameMaster->total;
            // dd($data);
        } else {
            $data = (new Lead)->getAdminOpenlead($inputs, $start, $perPage);
            $totalGameMaster = (new Lead)->totalAdminOpenLead();
            $total = $totalGameMaster->total;
        }

       // dd($data);

        return view('admin.lead.open_load', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }
    public function openleadAction(Request $request){
        $inputs = $request->all();
        if (!isset($inputs['tick']) || count($inputs['tick']) < 1) {
            return redirect()->route('employee.index')
                ->with('error', lang('messages.atleast_one', string_manip(lang('Bank'))));
        }

        $ids = '';
        foreach ($inputs['tick'] as $key => $value) {
            $ids .= $value . ',';
        }

        $ids = rtrim($ids, ',');
        $status = 0;
        if (isset($inputs['active'])) {
            $status = 1;
        }

        Lead::whereRaw('id IN (' . $ids . ')')->update(['status' => $status]);
        return redirect()->route('banks.index')
            ->with('success', lang('messages.updated', lang('Bank')));
    }
    public function autoleadPaginate(Request $request){
        if (!\Request::isMethod('post') && !\Request::ajax()) { //
            return lang('messages.server_error');
        }

        $inputs = $request->all();
        $page = 1;
        if (isset($inputs['page']) && (int)$inputs['page'] > 0) {
            $page = $inputs['page'];
        }

        $perPage = 20;
        if (isset($inputs['perpage']) && (int)$inputs['perpage'] > 0) {
            $perPage = $inputs['perpage'];
        }

       // dd('test');

        $start = ($page - 1) * $perPage;
        if (isset($inputs['form-search']) && $inputs['form-search'] != '') {
            $inputs = array_filter($inputs);
            unset($inputs['_token']);
            $data = (new Employee)->getAdminAutolead($inputs, $start, $perPage);
            $totalGameMaster = (new Employee)->totalAdminAutoLead($inputs);
            $total = $totalGameMaster->total;
            // dd($data);
        }else {
            // $data = (new Employee)->getAdminAutolead($inputs, $start, $perPage);
            // $totalGameMaster = (new Employee)->totalAdminAutoLead();
            // $total = $totalGameMaster->total;
            $total = 0;
            $data = [];
        }

       // dd($data);

        return view('admin.lead.auto_load', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }
    public function autoleadAction(Request $request){
        $inputs = $request->all();
        if (!isset($inputs['tick']) || count($inputs['tick']) < 1) {
            return redirect()->route('employee.index')
                ->with('error', lang('messages.atleast_one', string_manip(lang('Bank'))));
        }

        $ids = '';
        foreach ($inputs['tick'] as $key => $value) {
            $ids .= $value . ',';
        }

        $ids = rtrim($ids, ',');
        $status = 0;
        if (isset($inputs['active'])) {
            $status = 1;
        }
        return redirect()->route('banks.index')
            ->with('success', lang('messages.updated', lang('Bank')));
    }
    
    public function closeleadPaginate(Request $request){
        if (!\Request::isMethod('post') && !\Request::ajax()) { //
            return lang('messages.server_error');
        }

        $inputs = $request->all();
        $page = 1;
        if (isset($inputs['page']) && (int)$inputs['page'] > 0) {
            $page = $inputs['page'];
        }

        $perPage = 20;
        if (isset($inputs['perpage']) && (int)$inputs['perpage'] > 0) {
            $perPage = $inputs['perpage'];
        }

       // dd('test');

        $start = ($page - 1) * $perPage;
        if (isset($inputs['form-search']) && $inputs['form-search'] != '') {
            $inputs = array_filter($inputs);
            unset($inputs['_token']);
            $data = (new Lead)->getAdmincloselead($inputs, $start, $perPage);
            $totalGameMaster = (new Lead)->totalAdmincloseLead($inputs);
            $total = $totalGameMaster->total;
            // dd($data);
        } else {
            $data = (new Lead)->getAdmincloselead($inputs, $start, $perPage);
            $totalGameMaster = (new Lead)->totalAdmincloseLead();
            $total = $totalGameMaster->total;
        }

       // dd($data);

        return view('admin.lead.close_load', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }
    public function leads_single_check_val(Request $request){
        \DB::table('leads')->where('id', $request->m_id)->update(['alloted_to' => $request->id]);
        return ['status'=>200];
    }
        public function closeleadAction(Request $request){
        $inputs = $request->all();
        if (!isset($inputs['tick']) || count($inputs['tick']) < 1) {
            return redirect()->route('employee.index')
                ->with('error', lang('messages.atleast_one', string_manip(lang('Bank'))));
        }

        $ids = '';
        foreach ($inputs['tick'] as $key => $value) {
            $ids .= $value . ',';
        }

        $ids = rtrim($ids, ',');
        $status = 0;
        if (isset($inputs['active'])) {
            $status = 1;
        }

        Lead::whereRaw('id IN (' . $ids . ')')->update(['status' => $status]);
        return redirect()->route('banks.index')
            ->with('success', lang('messages.updated', lang('Bank')));
    }
    public function multiple_check_val(request $request){
     if($request->check_val){
        $array = explode(",", $request->check_val);
        foreach($array as $array){    
          Lead::where('id', $array)
         ->update([
             'alloted_to' => $request->get_emp_aj
          ]);
        }
        return ['status'=>200];
     }
    }
    public function admin_lead_page(){
       return view('admin.lead.lead-trcking');
    }
    
    // public function fetch_graph(){
    //     $year = DB::select("SELECT YEAR(created_at) datex FROM `leads` GROUP BY datex");
    //     foreach($year as $row){
    //         $inprocess = DB::select("SELECT COUNT(id) as id FROM `leads` WHERE lead_status = 'INPROCESS' AND YEAR(created_at)='$row->datex'");
    //         $open = DB::select("SELECT COUNT(id) as id FROM `leads` WHERE lead_status = 'OPEN' AND YEAR(created_at)='$row->datex'");
    //         $close = DB::select("SELECT COUNT(id) as id FROM `leads` WHERE lead_status = 'CLOSE' AND YEAR(created_at)='$row->datex'");
    //         $datas['year']=$row->datex;
    //         $datas['inprocess']=!empty($inprocess[0]->id) ? $inprocess[0]->id:0;
    //         $datas['open']=!empty($open[0]->id) ? $open[0]->id:0;
    //         $datas['close']=!empty($close[0]->id) ? $close[0]->id:0;
    //         $result[] = $datas;
    //     }
    //     $datas=['status'=>200,'responce'=>$result];
    //     return response()->json($datas);
    // }

    public function admin_lead_open_tracking(Request $request) {
        $user_type = Auth()->user()->user_type;
        $auth_user_id = \Auth::user()->id;
        if($user_type == 1){
            $results = lead::orderBy('id')->where('lead_status', 'OPEN')->where('alloted_to', '!=', Null)->paginate(5);
            $artilces = '';
            if ($request->page){
                foreach ($results as $result) {
                    $artilces.='<div class="card">
                    <h5 class="card-header">'.$result->name.'</h5><div class="card-body"><h5 class="card-title">Product: '.$result->product.'</h5><p class="card-text">Created at: '.$result->created_at.'</p><button type="button" class="btn btn-primary" onclick="get_popup('.$result->id.');" data-toggle="modal" data-target=".bd-example-modal-lg">View</button></div></div>';
                }
                return $artilces;
            }
        } elseif($user_type == 3){
            $results = lead::orderBy('id')->where('lead_status', 'OPEN')->where('alloted_to', $auth_user_id)->paginate(5);
            $artilces = '';
            if ($request->page){
                foreach ($results as $result) {
                    $artilces.='<div class="card">
                    <h5 class="card-header">'.$result->name.'</h5><div class="card-body"><h5 class="card-title">Product: '.$result->product.'</h5><p class="card-text">Created at: '.$result->created_at.'</p><button type="button" class="btn btn-primary" onclick="get_popup('.$result->id.');" data-toggle="modal" data-target=".bd-example-modal-lg">View</button></div></div>';
                }
                return $artilces;
            }
        } elseif($user_type == 4){
            $results = lead::orderBy('id')->where('lead_status', 'OPEN')->where('alloted_to', $auth_user_id)->paginate(5);
            $artilces = '';
            if ($request->page){
                foreach ($results as $result) {
                    $artilces.='<div class="card">
                    <h5 class="card-header">'.$result->name.'</h5><div class="card-body"><h5 class="card-title">Product: '.$result->product.'</h5><p class="card-text">Created at: '.$result->created_at.'</p><button type="button" class="btn btn-primary" onclick="get_popup('.$result->id.');" data-toggle="modal" data-target=".bd-example-modal-lg">View</button></div></div>';
                }
                return $artilces;
            }
        }
    }    
    public function admin_lead_inprocess_tracking(Request $request)
    {
        $user_type = Auth()->user()->user_type;
        $auth_user_id = \Auth::user()->id;
        $page = $request->page;
        $total_c = $page*5;
        $skip = $total_c-5;
        if($user_type == 1){
            $results = lead::where('lead_status', 'INPROCESS')->orderBy('id', 'desc')->paginate(5);
            $artilces = '';
            if ($request->page){
                foreach ($results as $result) {
                    $artilces.='<div class="card">
                    <h5 class="card-header">'.$result->name.'</h5><div class="card-body"><h5 class="card-title">Product: '.$result->product.'</h5><p class="card-text">Created at: '.$result->created_at.'</p><button type="button" class="btn btn-primary" onclick="get_popup('.$result->id.');" data-toggle="modal" data-target=".bd-example-modal-lg">View</button></div></div>';
                }
                
                return $artilces;
            }
        } elseif($user_type == 3){
            $results = lead::orderBy('id')->where('lead_status', 'INPROCESS')->where('alloted_to', $auth_user_id)->paginate(5);
            $artilces = '';
            if ($request->page){
                foreach ($results as $result) {
                    $artilces.='<div class="card">
                    <h5 class="card-header">'.$result->name.'</h5><div class="card-body"><h5 class="card-title">Product: '.$result->product.'</h5><p class="card-text">Created at: '.$result->created_at.'</p><button type="button" class="btn btn-primary" onclick="get_popup('.$result->id.');" data-toggle="modal" data-target=".bd-example-modal-lg">View</button></div></div>';
                }
                
                return $artilces;
            }
        } elseif($user_type == 4){
            $results = lead::orderBy('id')->where('lead_status', 'INPROCESS')->where('alloted_to', $auth_user_id)->paginate(5);
            $artilces = '';
            if ($request->page){
                foreach ($results as $result) {
                    $artilces.='<div class="card">
                    <h5 class="card-header">'.$result->name.'</h5><div class="card-body"><h5 class="card-title">Product: '.$result->product.'</h5><p class="card-text">Created at: '.$result->created_at.'</p><button type="button" class="btn btn-primary" onclick="get_popup('.$result->id.');" data-toggle="modal" data-target=".bd-example-modal-lg">View</button></div></div>';
                }
                
                return $artilces;
            }
        }
    }  

    public function admin_lead_reminder_tracking(Request $request) {
        $user_type = Auth()->user()->user_type;
        $auth_user_id = \Auth::user()->id;
        if($user_type == 1){
            $results = lead::orderBy('id')->where('lead_status', 'REMINDER')->paginate(5);
            $artilces = '';
            if ($request->page){
                foreach ($results as $result) {
                    $artilces.='<div class="card">
                    <h5 class="card-header">'.$result->name.'</h5><div class="card-body"><h5 class="card-title">Product: '.$result->product.'</h5><p class="card-text">Created at: '.$result->created_at.'</p><button type="button" class="btn btn-primary" onclick="get_popup('.$result->id.');" data-toggle="modal" data-target=".bd-example-modal-lg">View</button></div></div>';
                }
                return $artilces;
            }
        } elseif($user_type == 3){
            $results = lead::orderBy('id')->where('lead_status', 'REMINDER')->where('alloted_to', $auth_user_id)->paginate(5);
            $artilces = '';
            if ($request->page){
            foreach ($results as $result) {
                $artilces.='<div class="card">
                <h5 class="card-header">'.$result->name.'</h5><div class="card-body"><h5 class="card-title">Product: '.$result->product.'</h5><p class="card-text">Created at: '.$result->created_at.'</p><button type="button" class="btn btn-primary" onclick="get_popup('.$result->id.');" data-toggle="modal" data-target=".bd-example-modal-lg">View</button></div></div>';
            }
            return $artilces;
        }
        } elseif($user_type == 4){
            $results = lead::orderBy('id')->where('lead_status', 'REMINDER')->where('alloted_to', $auth_user_id)->paginate(5);
        $artilces = '';
        if ($request->page){
            foreach ($results as $result) {
                $artilces.='<div class="card">
                <h5 class="card-header">'.$result->name.'</h5><div class="card-body"><h5 class="card-title">Product: '.$result->product.'</h5><p class="card-text">Created at: '.$result->created_at.'</p><button type="button" class="btn btn-primary" onclick="get_popup('.$result->id.');" data-toggle="modal" data-target=".bd-example-modal-lg">View</button></div></div>';
            }
            return $artilces;
        }
        } 
    }

    public function admin_lead_popup(Request $request) {
        $user_type = Auth()->user()->user_type;
        if($user_type == 3 || $user_type == 4){
            $time=Carbon::now()->toDateTimeString();
            \DB::table('leads')->where('id', $request->id)->where('seen_time', Null)->update(['seen_time' => $time, 'lead_status' => 'INPROCESS']); 
        }


        $results = lead::where('id', $request->id)->first();
        $results->createdat = date_format(date_create($results->created_at),"d-M-Y H:i:s");
        $get_user = User::where('id', $results->alloted_to)->first();
        $get_user_exist = User::select('id')->where('email', $results->email)->first();
        if(empty($get_user_exist)){
            $get_user_exist = User::select('id')->where('mobile', $results->number)->first();    
        }
        if(empty($get_user)){
            $get_user = (object)['name'];
        }
        
        // $mname = '';
        // $lname = '';
        // if($results->mname){
        //     $mname = $results->mname;
        // }
        // if($results->lname){
        //     $lname = $results->lname;
        // }

        // $results->name = $results->name.' '.$mname.' '.$lname;
        $get_upload = User::where('id', $results->uploaded_by)->first();

        if(!empty($get_user_exist)){
            $application = \DB::table('applications')->select('cm_type', 'video', 'consent_form')->where('user_id', $get_user_exist->id)->first();
        } else {
            $application['cm_type'] = '';
            $application['video'] = '';
            $application['consent_form'] = '';
            //$get_user_exist->id = '';
        }

        $get_status = \DB::table('status_master')->get();
        $decoded_status = json_encode($get_status, TRUE);

        if (!empty($results->id)){
            $datas=['status'=>200,'responce'=>$results,'getuser'=>$get_user,'getupload'=>$get_upload,'decoded_status'=>$decoded_status, 'application' => $application, 'get_user_exist' => $get_user_exist];
            //dd($datas);
            return response()->json($datas);
        }
    }
    public function get_mail(request $request){
        $auth_user_id = \Auth::user()->id;
        $current_date_time = Carbon::now()->toDateTimeString();
        @$email_user_id = lead::where('email', $request->email)->first();
        \DB::table('lead_mails')->insert(['to_mail_id' => @$email_user_id->id, 'mail_to' => $request->email, 'subject' => $request->subject, 'mail' => $request->description, 'send_by' => $auth_user_id, 'created_at' => $current_date_time, 'updated_at'=>$current_date_time]);
        if(!empty($request->email)){
            $email = $request->email;
            $postdata = http_build_query(
                array(
                    'name' => @$email_user_id->name,
                    'email' => $email,
                    'subject' => $request->subject,
                    'mail' => $request->description,
                )
                );
                $opts = array('http' =>
                    array(
                    'method'  => 'POST',
                    'header'  => 'Content-Type: application/x-www-form-urlencoded',
                    'content' => $postdata
                    )
                );
                $context  = stream_context_create($opts);
                $result = file_get_contents('https://sspl20.com/email-api/api/lnxx/lead-mail', false, $context);
        }
        $datas=['status'=>200];
        return response()->json($datas);   
    }
    public function assign_lead_view(Request $request){
       $user_type = Auth()->user()->user_type;
       if($user_type == 3 || $user_type == 4){
        $time=Carbon::now()->toDateTimeString();
        Lead::where('id', $request->id)->update(['seen_time' => $time]); 
       }
       $lead = Lead::where('id', $request->id)->first();
       $status_master = \DB::table('status_master')->get();
       ?><form>
                <h5><b>Lead Details</b></h5>
                <div class="form-row">
                    <div class="col">
                        <label for="formGroupExampleInput">First Name</label>
                        <input type="text" class="form-control" id="m_name" value="<?php echo "$lead->name"; ?>">
                    </div>
                    <div class="col">
                        <label for="formGroupExampleInput">Middle Name</label>
                        <input type="text" class="form-control" id="m_mname" value="<?php echo "$lead->mname"; ?>">
                    </div>
                </div>
                <div class="form-row">
                <div class="col">
                        <label for="formGroupExampleInput">Last Name</label>
                        <input type="text" class="form-control" id="m_lname" value="<?php echo "$lead->lname"; ?>">
                    </div>
                    <div class="col">
                        <label for="formGroupExampleInput">Email</label> 
                        <input type="text" class="form-control" id="m_email" value="<?php echo "$lead->email"; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label for="formGroupExampleInput">Mobile No.</label> 
                        <input type="text" class="form-control" id="m_number" value="<?php echo "$lead->number"; ?>">
                    </div>
                    <div class="col">
                        <label for="formGroupExampleInput">Product</label> 
                        <input type="text" class="form-control" id="m_product" value="<?php echo "$lead->product"; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label for="formGroupExampleInput">Source</label> 
                        <input type="text" class="form-control" id="m_source" value="<?php echo "$lead->source"; ?>">
                    </div>
                    <div class="col">
                        <label for="formGroupExampleInput">Status</label> 
                        <select type="text" class="form-control minimal" id="m_status">
                            <?php foreach($status_master as $status_master){
                             echo '<option value="'.$status_master->name.'">'.$status_master->name.'</option>';
                            }?>
                        </select>
                    </div>
                </div>
                <div class="form-row" style="margin-top:10px;">
                    <div class="col" style="text-align: center; margin-top: 15px;">
                        <button type="button" onclick="savedata(<?php echo $lead->id; ?>)" class="btn btn-success">Save Changes</button>
                    </div>
                </div>
            </form>
        <?php 
    }
    public function assign_all_lead_view(Request $request){
       $user_type = Auth()->user()->user_type;
       if($user_type == 3 || $user_type == 4){
        $time=Carbon::now()->toDateTimeString();
        \DB::table('leads')->where('id', $request->id)->update(['seen_time' => $time, 'lead_status' => 'INPROCESS']); 
       }
       $lead = \DB::table('leads')->where('id', $request->id)->first();
       $status_master = \DB::table('status_master')->get();
       ?><form>
                <h5><b>Lead Details</b></h5>
                <div class="form-row">
                    <div class="col">
                        <label for="formGroupExampleInput">Name</label>
                        <input type="text" class="form-control" id="m_name" value="<?php echo "$lead->name"; ?>">
                    </div>
                    <div class="col">
                        <label for="formGroupExampleInput">Email</label> 
                        <input type="text" class="form-control" id="m_email" value="<?php echo "$lead->email"; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label for="formGroupExampleInput">Mobile No.</label> 
                        <input type="text" class="form-control" id="m_number" value="<?php echo "$lead->number"; ?>">
                    </div>
                    <div class="col">
                        <label for="formGroupExampleInput">Product</label> 
                        <input type="text" class="form-control" id="m_product" value="<?php echo "$lead->product"; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label for="formGroupExampleInput">Source</label> 
                        <input type="text" class="form-control" id="m_source" value="<?php echo "$lead->source"; ?>">
                    </div>
                    <div class="col">
                        <label for="formGroupExampleInput">Status</label> 
                        <select type="text" class="form-control minimal" id="m_status">
                            <?php foreach($status_master as $status_master){
                                if($status_master->name == $lead->lead_status){
                                    echo '<option value="'.$status_master->name.'" selected>'.$status_master->name.'</option>';
                                }else{
                                    echo '<option value="'.$status_master->name.'">'.$status_master->name.'</option>';
                                }
                             
                            }?>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label for="formGroupExampleInput">Assign To</label> 
                        <select type="text" class="form-control minimal" id="m_assign_to">
                        <?php $get_emp = User::where('status', 1)->where('user_type', 4)->orWhere('user_type', 3)->get() ?>
                            <?php foreach($get_emp as $get_emp){
                            if($get_emp->id == $lead->alloted_to){
                             echo '<option value="'.$get_emp->id.'" selected>'.$get_emp->name.'</option>';
                            }else{
                             echo '<option value="'.$get_emp->id.'">'.$get_emp->name.'</option>';
                            }
                            }?>
                        </select>
                    </div>
                </div>
                <div class="form-row" style="margin-top:10px;">
                    <div class="col" style="text-align: center; margin-top: 10px;">
                        <button type="button" onclick="savedata(<?php echo $lead->id; ?>)" class="btn btn-success">Save Changes</button>
                    </div>
                </div>
            </form>
        <?php 
    }
    public function save_view_details(request $request){
         $time=Carbon::now()->toDateTimeString();
         if($request->status == 'CLOSE'){
            \DB::table('leads')->where('id', $request->id)->update(['name' => $request->name, 'mname' => $request->mname, 'lname' => $request->lname, 'email' => $request->email, 'number' => $request->number, 'product' => $request->product, 'source' => $request->source, 'lead_status' => $request->status, 'close_time' => $time , 'alloted_to' => $request->assign_to]); 
         }else{
            \DB::table('leads')->where('id', $request->id)->update(['name' => $request->name, 'mname' => $request->mname, 'lname' => $request->lname, 'email' => $request->email, 'number' => $request->number, 'product' => $request->product, 'source' => $request->source, 'lead_status' => $request->status, 'alloted_to' => $request->assign_to]); 
         }       
    }
    public function send_in_close_status(request $request){
        $user_status_check = DB::table('leads')->select('email', 'number')->where('id', $request->id)->first();
        $application = \DB::table('applications')->select('cm_type', 'video', 'consent_form')->where(['email' => $user_status_check->email, 'mobile' => $user_status_check->number])->first();
        if(@$application->cm_type == ''){
            $datas=['status'=>400];
            return response()->json($datas);
        }elseif(@$application->video == ''){
            $datas=['status'=>401];
            return response()->json($datas);
        }elseif(@$application->consent_form == ''){
            $datas=['status'=>402];
            return response()->json($datas);
        }else{
            $time=Carbon::now()->toDateTimeString();
            \DB::table('leads')->where('id', $request->id)->update(['lead_status' => 'CLOSE', 'close_time' => $time]);
            $datas=['status'=>200];
            return response()->json($datas);
        }
        
    }
    public function onboard_user_details(request $request){
        $time=Carbon::now()->toDateTimeString();
        $create_user = \DB::table('leads')->where('id', $request->id)->first();
        if(User::where('email', $create_user->email)->orWhere('mobile', $create_user->number)->exists()){
            $datas=['status'=>400];
            return response()->json($datas);
        }else{

            // \DB::table('users')->insert(['salutation' =>$create_user->saturation, 'name' => $create_user->name, 'middle_name' => $create_user->mname, 'last_name' => $create_user->lname, 'email' => $create_user->email, 'user_type' => 2, 'mobile' => $create_user->number]);

            $user = new User;
            $user->email = $create_user->email;
            $user->mobile = $create_user->number;
            $user->salutation = $create_user->saturation;
            $user->name = $create_user->name;
            $user->middle_name = $create_user->mname;
            $user->last_name = $create_user->lname;
            $user->user_type = 2;
            $user->status = 1;
            $user->save();

            $get_last_id = User::where('email', $create_user->email)->where('mobile', $create_user->number)->select('id')->first();

            // \DB::table('customer_onboardings')->insert(['user_id' => $get_last_id->id, 'first_name_as_per_passport' => $create_user->name, 'middle_name' => $create_user->mname, 'last_name' => $create_user->lname, 'date_of_birth' => $create_user->dob, 'salutation' => $create_user->saturation, 'gender' =>  $create_user->gender, 'created_at' => $time, 'updated_at' => $time]);
            // $service_id = \DB::select('id')->where('services', $create_user->product)->where('mobile', $create_user->number)->first();
            // \DB::table('service_applies')->insert(['customer_id' => $get_last_id->id, 'service_id' => $service_id->id, 'created_at' => $time, 'updated_at' => $time]);

            $id = $get_last_id->id;

            $datas=['status'=>200, 'get_last_id' => $id];
            return response()->json($datas);
        }
        
    }
    
    public function lead_close_leads_download(){
        $user_type = Auth()->user()->user_type;
        $auth_user_id = \Auth::user()->id;
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=lead_sample_file'.'.csv');
        $output = fopen('php://output', 'w');
        fputcsv($output, array('saturation', 'first name', 'middle name', 'last name', 'email', 'mobile', 'product', 'reference', 'source', 'Lead Status', 'note'));
        if($user_type == 3 || $user_type == 4){
            $reports = Lead::where('lead_status', 'CLOSE')->where('alloted_to', $auth_user_id)->get();
        }elseif($user_type == 5){
            $reports = Lead::where('lead_status', 'CLOSE')->where('alloted_to', $auth_user_id)->get();
        }else{
            $reports = Lead::where('lead_status', 'CLOSE')->get();
        }
        if (count($reports) > 0) {
            foreach ($reports as $report) {
                $report_row = [
                    $report['saturation'],
                    ucfirst($report['name']),
                    ucfirst($report['mname']),
                    ucfirst($report['lname']),
                    $report['email'],
                    $report['number'],
                    $report['product'], 
                    $report['reference'],
                    $report['source'],
                    $report['lead_status'],
                    $report['note'],
                ];

                fputcsv($output, $report_row);
            }
          }    
        }
        public function follow_up_sub(Request $request){
            $auth_user_id = \Auth::user()->id;
            $current_date_time = Carbon::now()->toDateTimeString();
            \DB::table('lead_cases')->insert(['lead_id'=>$request->id,'user_id'=>$auth_user_id,'reason_for_follow_up'=>$request->fol_region_follow,'date'=>$request->fol_date, 'time'=>$request->fol_time, 'note'=>$request->fol_note,'created_at'=>$current_date_time, 'updated_at'=>$current_date_time ]);
            \DB::table('leads')->where('id', $request->id)->update(['lead_status'=> $request->status]);

        }
        public function case_detail(Request $request)
        {
        $user_type = Auth()->user()->user_type;
        $auth_user_id = \Auth::user()->id;
            $results = \DB::table('lead_cases')->where('lead_id', $request->id)->orderBy('created_at', 'desc')->get();
            // $artilces = '<table>
            // <thead>
            //     <tr>
            //         <th width="40%">Date</th>
            //         <th width="40%">Note</th>
            //         <th width="20%">Activity</th>
            //     </tr>
            // </thead>
            // <tbody style="text-transform: capitalize !important;">';
            // $i = 0;
            // $len = count($results);
            $artilces = '';
            if ($request->page){
                foreach ($results as $result) {
                    // if($i == 0){
                        $artilces.=
                        '<div class="card card-body" style="padding: 15px 15px 0px 15px;">
                        <a data-bs-toggle="collapse" href="#multiCollapseExample'.$result->id.'" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                        <div class="row" style="line-height: 0.0;">            
                            <div class="col-10">    
                                <h6 style="color:black;">'.$result->reason_for_follow_up.'</h6><p style="color:black;">'.$result->created_at.'</p>
                            </div>
                            <div class="col-2">
                                <i style="color:black;" class="fa fa-caret-down" aria-hidden="true"></i>
                            </div>
                        </div>
                        </a>
                            <p>
                                <span class="collapse multi-collapse" id="multiCollapseExample'.$result->id.'">'.$result->note.'</span>
                            </p>
                    </div>';
                        // '<tr>
                        // <td width="40%">'.$result->created_at.'</td>
                        // <td width="40%">'.$result->note.'</td>
                        // <td width="20%" align="left" style="text-align: center;"><img src="http://localhost/lnxx/public/img/sta_icon/deliveredRedStatus.png"></td>
                        // </tr>';
                    // }elseif($i == $len - 1){
                        // $artilces.=
                        // '<tr>
                        // <td width="40%">'.$result->created_at.'</td>
                        // <td width="40%">'.$result->note.'</td>
                        // <td width="20%" align="left" style="text-align: center;"><img src="http://localhost/lnxx/public/img/sta_icon/verticalSliderbar.png"></td>
                        // </tr>';
                    // }
                    // $i++;
                }
                // $artilces.= '</tbody>
                // </table>';
            }
            return $artilces;
        
    } 
        public function mail_details(Request $request)
        {
        $user_type = Auth()->user()->user_type;
        // $auth_user_id = \Auth::user()->id;
        $results = \DB::table('lead_mails')->where('to_mail_id', $request->id)->orderBy('created_at', 'desc')->get();
        
            // $i = 0;
            // $len = count($results);
            $artilces = '';
            if ($request->page){
                foreach ($results as $result) {
                    $artilces.=
                        '<div class="card card-body" style="padding: 15px 15px 0px 15px;">
                        <a data-bs-toggle="collapse" href="#multiCollapseExamplemail'.$result->id.'" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                        <div class="row" style="line-height: 0.0;">            
                            <div class="col-10">    
                                <h6 style="color:black;">'.$result->subject.'</h6><p style="color:black;">'.$result->created_at.'</p>
                            </div>
                            <div class="col-2">
                                <i style="color:black;" class="fa fa-caret-down" aria-hidden="true"></i>
                            </div>
                        </div>
                        </a>
                            <span class="collapse multi-collapse" id="multiCollapseExamplemail'.$result->id.'">
                                '.$result->mail.'
                            </span>
                    </div>';
                }
            //     $artilces.= '</tbody>
            //     </table>';
            }
            return $artilces;
        
    } 
    public function social_form_setting(){
        $status = \DB::table('lead_social_form_setting')->where('id', 1)->first();
        return view('admin.lead.social-form-setting', compact('status'));
    }   
    public function social_form_e_status(Request $request){
        \DB::table('lead_social_form_setting')->where('id', 1)->update(['e_otp' => $request->vall]);
    }   
    public function social_form_m_status(Request $request){
        \DB::table('lead_social_form_setting')->where('id', 1)->update(['m_otp' => $request->m_vall]);
    }   
    public function automatic_save_cat(Request $request){
        \DB::table('lead_auto_distribution_category')->update(['active_deactive' => 0]);
        if(!empty($request->assign_by_category)){
            \DB::table('lead_auto_distribution_category')->where('id', $request->assign_by_category)->update(['active_deactive' => 1]);
        }
        return back()->with('success', 'Setting saved successfully');
    }  

    public function auto_distribution(Request $request) {
        $get_lead = \DB::table('leads')->where('lead_status', 'OPEN')->where('alloted_to', Null)->get(); 
        foreach($get_lead as $get_lead){
            $check_last_id = \DB::table('lead_assign_auto')->orderBy('id', 'desc')->first();
            if(!empty($check_last_id->id)){
                $get_agent_emp = \DB::table('users')->wherein('user_type', [3,4])->where('id', '>', $check_last_id->assign_to_id)->first();
            }
            if(!empty($get_agent_emp->id)){
                \DB::table('leads')->where('id', $get_lead->id)->update(['alloted_to' => $get_agent_emp->id]);
                \DB::table('lead_assign_auto')->insert(['assign_to_id' => $get_agent_emp->id, 'assigned_lead_id' => $get_lead->id]); 
            } else {
                $get_agent_emp1 = \DB::table('users')->wherein('user_type', [3,4])->first();
                \DB::table('leads')->where('id', $get_lead->id)->update(['alloted_to' => $get_agent_emp1->id]);
                \DB::table('lead_assign_auto')->insert(['assign_to_id' => $get_agent_emp1->id, 'assigned_lead_id' => $get_lead->id]);
            }
        }
        return back()->with('success', 'Distribution Successfull');
    }
    public function select_user_lead(Request $request)
    {
        $explode_lead_value = explode(',', $request->lead_value);
        $explode_user_value = explode(',', $request->user_value);
        $get_lead = \DB::table('leads')->wherein('id', $explode_lead_value)->get(); 
        foreach($get_lead as $get_lead){
            $check_last_id = \DB::table('lead_assign_auto')->orderBy('id', 'desc')->first();
            if(!empty($check_last_id->id)){
                $get_agent_emp = \DB::table('users')->wherein('id', $explode_user_value)->where('id', '>', $check_last_id->assign_to_id)->first();
            }
            if(!empty($get_agent_emp->id)){
                \DB::table('leads')->where('id', $get_lead->id)->update(['alloted_to' => $get_agent_emp->id]);
                \DB::table('lead_assign_auto')->insert(['assign_to_id' => $get_agent_emp->id, 'assigned_lead_id' => $get_lead->id]); 
            }else{
                $get_agent_emp1 = \DB::table('users')->wherein('id', $explode_user_value)->first();
                \DB::table('leads')->where('id', $get_lead->id)->update(['alloted_to' => $get_agent_emp1->id]);
                \DB::table('lead_assign_auto')->insert(['assign_to_id' => $get_agent_emp1->id, 'assigned_lead_id' => $get_lead->id]);
            }
        }
            return response()->json(['status'=>200]);
        }
        public function get_personal_details(request $request){
            \DB::table('leads')->where('id', $request->m_id)->update([
                'name' => $request->m_name, 
                'mname' => $request->mi_name,
                'lname' => $request->ml_name,
                'number' => $request->m_number, 
                'email' => $request->m_email, 
                'note' => $request->m_description,
            ]);

            $datas=['status'=>200];
            return response()->json($datas);   
        }
        public function view_save_personal($id){


            $selected_services = ServiceApply::where('customer_id', $id)->pluck('service_id')->toArray();                   
            $service = Service::where('status', 1)->select('name', 'url', 'image', 'id')->orderBy('sort_order', 'ASC')->get();
            $relations = \DB::table('applications')
                    ->join('services', 'services.id', '=', 'applications.service_id')
                    ->select('applications.status', 'services.name', 'services.image', 'applications.ref_id', 'applications.created_at')->where('applications.user_id', $id)->get();
            return view('admin.lead.select-service', compact('selected_services', 'service', 'relations', 'id'));
            
            // $user_id = $id;
            // $banks = Bank::where('status', 1)->select('id', 'name')->get();
            // $countries = Country::all();
            // $user = User::where('id', $id)->first();
            // $result = CustomerOnboarding::where('user_id', $id)->first();
            // $apply_ser = ServiceApply::where('customer_id', $user_id)->count();
            //     if($result->cm_type == 1){
            //         $cm_type = CmSalariedDetail::where('customer_id', $user_id)->first();
            //     } elseif ($result->cm_type == 2) {
            //         $cm_type = SelfEmpDetail::where('customer_id', $user_id)->first();
            //     } elseif ($result->cm_type == 3) {
            //         $cm_type = OtherCmDetail::where('customer_id', $user_id)->first();  
            //     } else {
            //         $cm_type = ''; 
            //     }
            //     if(isset($request->service)){
            //         foreach($request->service as $service_id){
            //             $apply_ser = ServiceApply::where('service_id', $service_id)->where('customer_id', $user_id)->count();
            //             if($apply_ser == 0) {
            //                 ServiceApply::create([
            //                     'service_id'  =>  $service_id,
            //                     'customer_id'  => $user_id,
            //                 ]);
            //             }
            //         }
            //         $service = \DB::table('service_applies')
            //             ->join('services', 'services.id', '=', 'service_applies.service_id')
            //             ->select('service_applies.status', 'services.name', 'service_applies.id', 'service_applies.bank_id', 'services.id as service_id')->where('service_applies.customer_id', $user_id)->get();    
            //             return view('admin.lead.view-save-personal', compact('cm_type', 'user', 'result', 'countries', 'banks', 'service'));
            //     } else {
            //         $apply_ser = ServiceApply::where('customer_id', $user_id)->count();
            //         if($apply_ser == 0) {
            //             return redirect()->route('user-dashboard')->with('select_service', 'select_service');
            //         } else {
            //         $service = \DB::table('service_applies')
            //             ->join('services', 'services.id', '=', 'service_applies.service_id')
            //             ->select('service_applies.status', 'services.name', 'service_applies.id', 'service_applies.bank_id', 'services.id as service_id', 'service_applies.decide_by')->where('service_applies.customer_id', $user_id)->where('service_applies.service_id', 3)->where('service_applies.app_status', 0)->first(); 
            //             // dd($services);   
            //             return view('admin.lead.view-save-personal', compact('cm_type', 'user', 'result', 'countries', 'banks', 'service'));
            //         }
            //     }
        }
    
        public function personal_detail_customer(Request $request){
            $user_id =  $request->user_id;
            $inputs = $request->all(); 
            $company = Company::where('status', 1)->select('id', 'name')->get();
            if($request->first_name_as_per_passport){
                $inputs['user_id'] = $user_id;
                $result = '';
                $cm_details = CustomerOnboarding::where('user_id', $user_id)->select('id', 'cm_type', 'passport_photo')->first();

                if(isset($inputs['passport_photo']) or !empty($inputs['passport_photo'])) {
                    $image_name = rand(100000, 999999);
                    $fileName = '';

                    if($file = $request->hasFile('passport_photo')) {
                        $file = $request->file('passport_photo');
                        $img_name = $file->getClientOriginalName();
                        $image_resize = Image::make($file->getRealPath()); 
                        $image_resize->resize(600, 600);
                        $fileName = $image_name.$img_name;
                        $image_resize->save(public_path('/uploads/passport_images/' .$fileName));               
                    }

                    $fname ='/uploads/passport_images/';
                    $passport_photo = $fname.$fileName;
                } else {
                    $passport_photo = @$cm_details->passport_photo;
                }

                unset($inputs['passport_photo']);
                $inputs['passport_photo'] = $passport_photo;

                if($cm_details){
                    $id = $cm_details->id;
                    (new CustomerOnboarding)->store($inputs, $id); 
                } else {
                    (new CustomerOnboarding)->store($inputs); 
                }
                 
                $cm_type = @$cm_details->cm_type;

                if($cm_type == 1){
                    $result = CmSalariedDetail::where('customer_id', $user_id)->first();
                } elseif ($cm_type == 2) {
                    $result = SelfEmpDetail::where('customer_id', $user_id)->first();
                } elseif ($cm_type == 3) {
                    $result = OtherCmDetail::where('customer_id', $user_id)->first();  
                } else {
                    $result = ''; 
                }

                $user = User::where('id', $user_id)->select('emirates_id', 'emirates_id_back', 'eid_status')->first();

                if(isset($inputs['emirates_id_front']) or !empty($inputs['emirates_id_front'])) {
                    $image_name = rand(100000, 999999);
                    $fileName = '';

                    if($file = $request->hasFile('emirates_id_front')) {
                        $file = $request->file('emirates_id_front') ;
                        $img_name = $file->getClientOriginalName();
                        $image_resize = Image::make($file->getRealPath()); 
                        $image_resize->resize(750, 400);
                        $fileName = $image_name.$img_name;
                        $image_resize->save(public_path('/uploads/emirates_id/' .$fileName));                 
                    }
                    $fname ='/uploads/emirates_id/';
                    $emirates_id_front = $fname.$fileName;
                } else {
                    $emirates_id_front = @$user->emirates_id;
                }
                if(isset($inputs['emirates_id_back']) or !empty($inputs['emirates_id_back'])) {
                    $image_name = rand(100000, 999999);
                    $fileName = '';
                    if($file = $request->hasFile('emirates_id_back')) {
                        $file = $request->file('emirates_id_back') ;
                        $img_name = $file->getClientOriginalName();
                        $image_resize = Image::make($file->getRealPath()); 
                        $image_resize->resize(750, 400);
                        $fileName = $image_name.$img_name;
                        $image_resize->save(public_path('/uploads/emirates_id/' .$fileName));                 
                    }
                    $fname ='/uploads/emirates_id/';
                    $emirates_id_back = $fname.$fileName;
                } else {
                    $emirates_id_back = @$user->emirates_id_back;
                }

                User::where('id', $user_id)
                ->update([
                    'emirates_id' =>  $emirates_id_front,
                    'emirates_id_back' =>  $emirates_id_back,
                    'date_of_birth' => $request->date_of_birth,
                    'gender' => $request->gender,
                    'salutation' =>  $request->salutation,
                    'name' => $request->first_name_as_per_passport,
                    'middle_name' => $request->middle_name,
                    'last_name' => $request->last_name,
                    'eid_number' => $request->eid_number,
                ]); 
            }
        }
        public function empl_details(Request $request){
            $user_id =  $request->user_id;
                $inputs = $request->all();
                $inputs['customer_id'] = $user_id;

                $banks = Bank::where('status', 1)->select('id', 'name')->get();

                if($request->cm_type) {
                    $cm_type = $request->cm_type;
                    $r_type = 1;
                } else {
                    $onboarding = CustomerOnboarding::where('user_id', $user_id)->select('cm_type')->first();
                    $cm_type = @$onboarding->cm_type;
                    $r_type = 2;
                }

                if($cm_type){

                    if($r_type == 1){
                        CustomerOnboarding::where('user_id', $user_id)->update([
                            'cm_type'  =>  $cm_type,
                        ]);
                    }

                    if($cm_type == 1){
                        $cm_sal = CmSalariedDetail::where('customer_id', $user_id)->select('id')->first();
                        if($cm_sal){
                            $id = $cm_sal->id;
                            (new CmSalariedDetail)->store($inputs, $id); 
                        } else {
                            (new CmSalariedDetail)->store($inputs); 
                        }
                    $result = ProductRequest::where('user_id', $user_id)->first();
                    $services = ServiceApply::where('customer_id', $user_id)->where('app_status', 0)->pluck('service_id')->toArray();
                    return view('frontend.pages.product_requested', compact('result', 'services', 'banks'));     
                    } elseif ($cm_type == 2) {
                
                        $cm_sal = SelfEmpDetail::where('customer_id', $user_id)->select('id')->first();
                        if($cm_sal){
                            $id = $cm_sal->id;
                            (new SelfEmpDetail)->store($inputs, $id); 
                        } else {
                            (new SelfEmpDetail)->store($inputs); 
                        }
                    $result = ProductRequest::where('user_id', $user_id)->first();
                    $services = ServiceApply::where('customer_id', $user_id)->where('app_status', 0)->pluck('service_id')->toArray();
                    return view('frontend.pages.product_requested', compact('result', 'services', 'banks'));
                    } else {
                        $cm_sal = OtherCmDetail::where('customer_id', $user_id)->select('id')->first();
                        if($cm_sal){
                            $id = $cm_sal->id;
                            (new OtherCmDetail)->store($inputs, $id); 
                        } else {
                            (new OtherCmDetail)->store($inputs); 
                        }
                    $result = ProductRequest::where('user_id', $user_id)->first();
                    $services = ServiceApply::where('customer_id', $user_id)->where('app_status', 0)->pluck('service_id')->toArray();
                        return view('frontend.pages.product_requested', compact('result', 'services', 'banks'));
                    }

                } 
        }
        public function existing_financial_save(Request $request){
                $user_id =  $request->user_id;
                $inputs = $request->all();
                $inputs['user_id'] = $user_id;
                $result = '';
                $cm_sal = ProductRequest::where('user_id', $user_id)->select('id')->first();
                if($cm_sal){
                    $id = $cm_sal->id;
                    (new ProductRequest)->store($inputs, $id); 
                } else {
                    (new ProductRequest)->store($inputs); 
                }
                
                $services = ServiceApply::where('app_status', 0)->where('customer_id', $user_id)->count();
                if($services != 0){ 
                $result = CustomerOnboarding::where('user_id', $user_id)->select('id', 'consent_form')->first();
                $ser = 1300;
                $ref_id = $ser.$result->id;
                CustomerOnboarding::where('user_id', $user_id)->update(['ref_id'  =>  $ref_id,]);
                $consent_form = $result->consent_form; 
                }
            }
        public function bank_preference(Request $request){
            $user_id =  $request->user_id;
            ServiceApply::where('customer_id', $user_id)->where('app_status', 0)->where('service_id', 3)
            ->update([
                'bank_id' => $request->bank_id,
                'decide_by' => $request->decide_by,
            ]);
        }
        public function consent_form(Request $request){
            $user_id =  $request->user_id;
            $inputs['user_id'] = $user_id;
            $result = '';
            $result = CustomerOnboarding::where('user_id', $user_id)->select('id')->first();
            $ser = 1300;
            $ref_id = $ser.$result->id;
            CustomerOnboarding::where('user_id', $user_id)->update(['ref_id'  =>  $ref_id, 'consent_form' => 1]);
        }
}

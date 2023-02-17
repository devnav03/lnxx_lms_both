<?php

namespace App\Http\Controllers\Agent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Lead;
use App\Models\Request as Makerequest;
use Auth;
Use Response;

class LeadController extends Controller {
    public function lead_upload(Request $request){

        $file = $request->uploaded_file;
        if ($file) {
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $this->checkUploadedFileProperties($extension, $fileSize);
            $location = 'uploads';
            $file->move($location, $filename);
            $filepath = public_path($location . "/" . $filename);
            $file = fopen($filepath, "r");
            $importData_arr = array();
            $i = 0;
            while (($filedata = fgetcsv($file, 5000, ",")) !== FALSE) {
                $num = count($filedata);
                if ($i == 0) {
                    $i++;
                    continue;
                }
                for ($c = 0; $c < $num; $c++) {
                    $importData_arr[$i][] = $filedata[$c];
                }
                $i++;
            }
            fclose($file);
                $responce = $this->uploadleads($importData_arr);
        } else {
            throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);
            $responce = ['status'=>404,'message' => "No file was uploaded"];
        }
        return response()->json($responce);
    }
    public function checkUploadedFileProperties($extension, $fileSize){
        $valid_extension = array("csv", "xlsx");
        $maxFileSize = 2097152;
        if (in_array(strtolower($extension), $valid_extension)) {
            if ($fileSize <= $maxFileSize) {
            } else {
                throw new \Exception('No file was uploaded', Response::HTTP_REQUEST_ENTITY_TOO_LARGE);
            }
        } else {
            throw new \Exception('Invalid file extension', Response::HTTP_UNSUPPORTED_MEDIA_TYPE);
        }
    }
    public function uploadleads($importData_arr){
        $userId = \Auth::id();
        $j = 0;
        foreach ($importData_arr as $importData) {
            $j++;
            $uploadlead = Lead::where(['email'=>$importData[2], 'number'=>$importData[3]])->first();
            if(!empty($uploadlead)){
                $lead = $uploadlead;
            }else{
                $lead = new Lead;
            }
            if(!empty($importData[0])){
                $lead->saturation = $importData[0];
            }
            if(!empty($importData[1])){
                $lead->name = $importData[1];
            }
            if(!empty($importData[2])){
                $lead->email = $importData[2];
            }
            if(is_numeric($importData[3])){
                $lead->number = $importData[3];
            }
            if(!empty($importData[4])){
                $lead->product = $importData[4];
            }
            if(!empty($importData[5])){
                $lead->reference = $importData[5];
            }
            if(!empty($importData[6])){
                $lead->source = $importData[6];
            }
            if(!empty($importData[7])){
                $lead->note = $importData[7];
            }
            $lead->uploaded_by = $userId;
            $lead->alloted_to = $userId;
            $lead->save();
        }
        return ['status'=>200,'message' => "$j Records Successfully Uploaded"];
    } 
  
    public function add_leads() {  
       return view('agent.lead.create');  
    }
    public function edit_leads($id = null) {
        $result = (new Lead)->find($id);
        if (!$result) {
            abort(401);
        }
        return view('agent.lead.create', compact('result'));
    }
    public function open_leads() {  
       return view('agent.lead.open-lead');  
    }
    public function  store(Request $request) {
        $inputs = $request->all();
        // dd($password);
        try {
            $validator = (new Lead)->validate($inputs);
            $user_id = \Auth::id();
            $inputs['uploaded_by'] = $user_id;
            $inputs['alloted_to'] = $user_id;
            (new Lead)->store($inputs);
            return redirect()->route('agent.leads.add_leads')
                ->with('success', 'Lead successfully created');
        } catch (\Exception $exception) {
            return redirect()->route('agent.leads.add_leads')
                ->withInput()
                ->with('error', lang('messages.server_error').$exception->getMessage());
        }
    }
    public function empOpenleadPaginate(Request $request, $pageNumber = null) {
      //  dd($request);
  
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
              $data = (new Lead)->getEmpOpenlead($inputs, $start, $perPage);
              $totalGameMaster = (new Lead)->totalEmpOpenLead($inputs);
              $total = $totalGameMaster->total;
              // dd($data);
          } else {
              $data = (new Lead)->getEmpOpenlead($inputs, $start, $perPage);
              $totalGameMaster = (new Lead)->totalEmpOpenLead();
              $total = $totalGameMaster->total;
          }
  
         // dd($data);
  
          return view('agent.lead.load_data', compact('inputs', 'data', 'total', 'page', 'perPage'));
      }
      public function OpenleadsAction(Request $request)  {

         $inputs = $request->all();
         if (!isset($inputs['tick']) || count($inputs['tick']) < 1) {
             return redirect()->route('agent.index')
                 ->with('error', lang('messages.atleast_one', 'Bank'));
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
         return redirect()->route('agent.index')
             ->with('success', lang('messages.updated', lang('Bank')));
     } 
    public function empCloseleadPaginate(Request $request, $pageNumber = null) {
      //  dd($request);
  
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
              $data = (new Lead)->getEmpCloselead($inputs, $start, $perPage);
              $totalGameMaster = (new Lead)->totalEmpCloseLead($inputs);
              $total = $totalGameMaster->total;
              // dd($data);
          } else {
              $data = (new Lead)->getEmpCloselead($inputs, $start, $perPage);
              $totalGameMaster = (new Lead)->totalEmpCloseLead();
              $total = $totalGameMaster->total;
          }
  
         // dd($data);
  
          return view('agent.lead.close_load_data', compact('inputs', 'data', 'total', 'page', 'perPage'));
      }
      public function CloseleadsAction(Request $request)  {

         $inputs = $request->all();
         if (!isset($inputs['tick']) || count($inputs['tick']) < 1) {
             return redirect()->route('employee.index')
                 ->with('error', lang('messages.atleast_one', 'Bank'));
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
    
      
    public function send_status(request $request){
        \DB::table('leads')->where('id', $request->lead_id)
        ->update([
            'lead_status' => $request->status
         ]);

    }  
    public function runtime_note(request $request){
        \DB::table('leads')->where('id', $request->lead_id)
        ->update([
            'note' => $request->note
         ]);

    }  
    public function runtime_date(request $request){
        \DB::table('leads')->where('id', $request->lead_id)
        ->update([
            'f_date' => $request->date
         ]);

    }  
    // public function ajax_send(request $request){
    //     // print_r($request->id);
    //     // die;
    //     $data = \DB::table('leads')->where('id', $request->id)->first();
    //     return response()->json(['status' => 200, 'data' => $data]);

    // }  

    public function closed_leads(){
        return view('agent.lead.closed-lead');
    }
    public function social(){
        return view('agent.lead.social');
    }
    public function admin_lead_page(){
        return view('agent.lead.lead-tracking');
     }
     public function admin_lead_open_tracking(Request $request)
     {
         $auth_user_id = \Auth::user()->id;
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
     public function admin_lead_inprocess_tracking(Request $request)
     {
         $auth_user_id = \Auth::user()->id;
         $results = lead::orderBy('id')->where('lead_status', 'INPROCESS')->where('alloted_to', $auth_user_id)->paginate(5);
         $artilces = '';
         if ($request->page){
             foreach ($results as $result) {
                $artilces.='<div class="card">
                <h5 class="card-header">'.$result->name.'</h5><div class="card-body"><h5 class="card-title">Product: '.$result->product.'</h5><p class="card-text">Created at: '.$result->created_at.'</p><button type="button" class="btn btn-primary" onclick="get_popup('.$result->id.');" data-toggle="modal" data-target=".bd-example-modal-lg2">View</button></div></div>';
             }
             
             return $artilces;
         }
     }    
     public function admin_lead_reminder_tracking(Request $request)
     {
         $auth_user_id = \Auth::user()->id;
         $results = lead::orderBy('id')->where('lead_status', 'REMINDER')->where('alloted_to', $auth_user_id)->paginate(5);
         $artilces = '';
         if ($request->page){
             foreach ($results as $result) {
                $artilces.='<div class="card">
                <h5 class="card-header">'.$result->name.'</h5><div class="card-body"><h5 class="card-title">Product: '.$result->product.'</h5><p class="card-text">Created at: '.$result->created_at.'</p><button type="button" class="btn btn-primary" onclick="get_popup('.$result->id.');" data-toggle="modal" data-target=".bd-example-modal-lg2">View</button></div></div>';
             }
             return $artilces;
         }
     }
     public function agent_lead_popup(Request $request)
    {
        $results = lead::where('id', $request->id)->first();
        $status_master = \DB::table('status_master')->get();
        $artilces = '';
        if (!empty($results->id)){
            $datas=['status'=>200,'responce'=>$results];
            return response()->json($datas);
        }
    }    
}
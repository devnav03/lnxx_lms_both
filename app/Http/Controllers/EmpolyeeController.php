<?php

namespace App\Http\Controllers;
/**
 * :: Bank Controller ::
 * 
 *
 **/
use Intervention\Image\ImageManagerStatic as Image;
use Auth;
use Files;
use Illuminate\Support\Facades\Storage;
use App\Models\Employee; 
use Illuminate\Http\Request;

class EmpolyeeController extends  Controller{

    public function index() {
        return view('admin.employee.index');
    }
  
    public function create() {
        return view('admin.employee.create');
    }

    public function store(Request $request) {
        $inputs = $request->all();
        // dd($password);
        try {
            $validator = (new Employee)->validate($inputs);
            if( $validator->fails() ) {
                return back()->withErrors($validator)->withInput();
            }
            if(isset($inputs['profile_image']) or !empty($inputs['profile_image'])) {
                $image_name = rand(100000, 999999);
                $fileName = '';
                if($file = $request->hasFile('profile_image')) {
                    $file = $request->file('profile_image') ;
                    $img_name = $file->getClientOriginalName();
                    $fileName = $image_name.$img_name;
                    $destinationPath = public_path().'/uploads/user_images/' ;
                    $file->move($destinationPath, $fileName);
                }
                $fname ='/uploads/user_images/';
                $image = $fname.$fileName;
            }
            else{
                $image = '';
            }
            
            unset($inputs['profile_image']);
            $inputs['profile_image'] = $image;
            $inputs['user_type'] = 4;
            $password = \Hash::make($inputs['password']);
            unset($inputs['password']);
            $inputs['password'] = $password;
            (new Employee)->store($inputs);
            return redirect()->route('employee.index')
                ->with('success', 'Employee successfully created');
        } catch (\Exception $exception) {
            return redirect()->route('employee.create')
                ->withInput()
                ->with('error', lang('messages.server_error').$exception->getMessage());
        }
    }

  
    public function update(Request $request, $id = null) {
        $result = (new Employee)->find($id);
        if (!$result) {
            abort(401);
        }
        $inputs = $request->all();
        try {
          
            if(isset($inputs['profile_image']) or !empty($inputs['profile_image'])) {
                $image_name = rand(100000, 999999);
                $fileName = '';
                if($file = $request->hasFile('profile_image')) {
                    $file = $request->file('profile_image') ;
                    $img_name = $file->getClientOriginalName();
                    $fileName = $image_name.$img_name;
                    $destinationPath = public_path().'/uploads/user_images/' ;
                    $file->move($destinationPath, $fileName);
                }
                $fname ='/uploads/user_images/';
                $image = $fname.$fileName;
            } else{
                $image = $result->profile_image;
            }
            unset($inputs['profile_image']);
            $inputs['profile_image'] = $image;
            $password = \Hash::make($inputs['password']);
            unset($inputs['password']);
            $inputs['password'] = $password;
            (new Employee)->store($inputs, $id);

            return redirect()->route('employee.index')
                ->with('success', 'Employee successfully updated');

        } catch (\Exception $exception) {
            return redirect()->route('employee.edit', [$id])
                ->withInput()
                ->with('error', lang('messages.server_error'));
        }
    }

  
    public function edit($id = null) {
        $result = (new Employee)->find($id);
        if (!$result) {
            abort(401);
        }
        return view('admin.employee.create', compact('result'));
    }


    public function empPaginate(Request $request, $pageNumber = null) {
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
            $data = (new Employee)->getEmp($inputs, $start, $perPage);
            $totalGameMaster = (new Employee)->totalEmp($inputs);
            $total = $totalGameMaster->total;
            // dd($data);
        } else {
            $data = (new Employee)->getEmp($inputs, $start, $perPage);
            $totalGameMaster = (new Employee)->totalEmp();
            $total = $totalGameMaster->total;
        }

       // dd($data);

        return view('admin.employee.load_data', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }

 
    public function servicesToggle($id = null) {
        if (!\Request::isMethod('post') && !\Request::ajax()) {
            return lang('messages.server_error');
        }
        try {
            $game = Employee::find($id);
        } catch (\Exception $exception) {
            return lang('messages.invalid_id', string_manip(lang('Employee')));
        }

        $game->update(['status' => !$game->status]);
        $response = ['status' => 1, 'data' => (int)$game->status . '.gif'];
        // return json response
        return json_encode($response);
    }

  
    public function servicesAction(Request $request)  {

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

        Employee::whereRaw('id IN (' . $ids . ')')->update(['status' => $status]);
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
    public function emp_agent_filter(Request $request)
    {
    $user_type = Auth()->user()->user_type;
    $auth_user_id = \Auth::user()->id;
    $results = \DB::select("SELECT * FROM users where user_type IN (3,4) and name LIKE '%$request->name%' and email LIKE '%$request->email%' and mobile LIKE '%$request->mobile%' and user_type = '$request->type'");
    // print_r($results);
    // die();
    $artilces = '';
        $artilces.= '<table class="table">
        <thead>
            <tr>
                <th width="10%"><input type="checkbox" onclick="select_all_2()" value="1" id="select_all_2"></th>
                <th width="40%">Name</th>
                <th width="30%">Email</th>
                <th width="20%">Mobile</th>
            </tr>
        </thead>
        <tbody style="text-transform: capitalize !important;">';
        $i = 0;
        $len = count($results);
        if ($request->page){
            foreach ($results as $result) {
                  $artilces.=
                  '<tr>
                  <td width="10%"><input type="checkbox" class="check_boxs" name="select_all_2[]" value="'.$result->id.'"></td>
                  <td width="40%">'.$result->name.'</td>
                  <td width="30%">'.$result->email.'</td>
                  <td width="20%">'.$result->mobile.'</td>
                  </tr>';
            }
            $artilces.= '</tbody>
            </table>';
        }
        return $artilces;
    
} 
    public function emp_agent_filter2(Request $request) {
    //     print_r($request->name);
    //     die;
    $user_type = Auth()->user()->user_type;
    $auth_user_id = \Auth::user()->id;
    $results = \DB::select("SELECT * FROM users where user_type IN (3,4) and name LIKE '%$request->name%' and email LIKE '%$request->email%' and mobile LIKE '%$request->mobile%' and user_type = '$request->type'");
    // $results = \DB::SELECT("SELECT a.id, a.to_mail_id, a.mail_to, a.subject, a.mail, a.send_by, a.created_at, a.updated_at, b.id, b.name FROM `lead_mails` as a LEFT JOIN leads as b on a.to_mail_id = b.id WHERE b.id = $request->id;");
        $artilces = '';
        $artilces.= '<table class="table">
        <thead>
            <tr>
                <th width="40%">Name</th>
                <th width="30%">Email</th>
                <th width="20%">Mobile</th>
                <th width="30%">Action</th>
            </tr>
        </thead>
        <tbody style="text-transform: capitalize !important;">';
        $i = 0;
        $len = count($results);
        if ($request->page){
            foreach ($results as $result) {
                  $artilces.=
                  '<tr>
                  <td width="40%">'.$result->name.'</td>
                  <td width="30%">'.$result->email.'</td>
                  <td width="20%">'.$result->mobile.'</td>
                  <td width="30%"><a style="color:white; padding: 3px 10px; min-height: 20px; font-size: 13px;" type="button" onclick="check_send_2('.$result->id.')" class="btn btn-warning">Assign</a></td>
                  </tr>';
            }
            $artilces.= '</tbody>
            </table>';
        }
        return $artilces;
    
} 
    

}
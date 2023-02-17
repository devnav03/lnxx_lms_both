<?php

namespace App\Http\Controllers;
/**
 * :: Service Controller ::
 * 
 *
 **/
use Intervention\Image\ImageManagerStatic as Image;
use Auth;
use Files;
use Illuminate\Support\Facades\Storage;
use App\Models\Service;
use App\Models\BankService;
use Illuminate\Http\Request;

class ServiceController extends  Controller{

    public function index() {
        // if((\Auth::user()->user_type) == 1){
            return view('admin.services.index');
        // } else {
        //     \Auth::logout();
        //     \Session::flush();
        //     return redirect()->route('admin');
        // }
    }
  
    public function create() {
        // if((\Auth::user()->user_type) == 1){

        return view('admin.services.create');
        // } else {
        //     \Auth::logout();
        //     \Session::flush();
        //     return redirect()->route('admin');
        // }
    }

    public function  store(Request $request) {
        $inputs = $request->all();
       // dd($request);
        try {
            $validator = (new Service)->validate($inputs);
            if( $validator->fails() ) {
                return back()->withErrors($validator)->withInput();
            }

            $slug_name = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $inputs['name'])));
            $inputs = $inputs + [
                    'url' =>  $slug_name,
                ];  

            if(isset($inputs['image']) or !empty($inputs['image'])) {
                $image_name = rand(100000, 999999);
                $fileName = '';
                if($file = $request->hasFile('image')) {
                    $file = $request->file('image') ;
                    $img_name = $file->getClientOriginalName();
                    $fileName = $image_name.$img_name;
                    $destinationPath = public_path().'/uploads/services/' ;
                    $file->move($destinationPath, $fileName);
                }
                $fname ='/uploads/services/';
                $image = $fname.$fileName;
            }
            else{
                $image = '';
            }
            unset($inputs['image']);
            $inputs['image'] = $image;

            if(isset($inputs['blue_icon']) or !empty($inputs['blue_icon'])) {
                $image_name = rand(100000, 999999);
                $fileName = '';
                if($file = $request->hasFile('blue_icon')) {
                    $file = $request->file('blue_icon') ;
                    $img_name = $file->getClientOriginalName();
                    $fileName = $image_name.$img_name;
                    $destinationPath = public_path().'/uploads/services/' ;
                    $file->move($destinationPath, $fileName);
                }
                $fname ='/uploads/services/';
                $image = $fname.$fileName;
            } else{
                $image = '';
            }
            unset($inputs['blue_icon']);
            $inputs['blue_icon'] = $image;

            $id = (new Service)->store($inputs);

            return redirect()->route('services.index')
                ->with('success', 'Service successfully created');
        } catch (\Exception $exception) {
            return redirect()->route('services.create')
                ->withInput()
                ->with('error', lang('messages.server_error').$exception->getMessage());
        }
    }

  
    public function update(Request $request, $id = null) {
        $result = (new Service)->find($id);
        if (!$result) {
            abort(401);
        }
        $inputs = $request->all();
        try {
          
            if(isset($inputs['image']) or !empty($inputs['image'])) {
                $image_name = rand(100000, 999999);
                $fileName = '';
                if($file = $request->hasFile('image')) {
                    $file = $request->file('image') ;
                    $img_name = $file->getClientOriginalName();
                    $fileName = $image_name.$img_name;
                    $destinationPath = public_path().'/uploads/services/' ;
                    $file->move($destinationPath, $fileName);
                }
                $fname ='/uploads/services/';
                $image = $fname.$fileName;
            } else{
                $image = $result->image;
            }
            unset($inputs['image']);
            $inputs['image'] = $image;

            if(isset($inputs['blue_icon']) or !empty($inputs['blue_icon'])) {
                $image_name = rand(100000, 999999);
                $fileName = '';
                if($file = $request->hasFile('blue_icon')) {
                    $file = $request->file('blue_icon') ;
                    $img_name = $file->getClientOriginalName();
                    $fileName = $image_name.$img_name;
                    $destinationPath = public_path().'/uploads/services/' ;
                    $file->move($destinationPath, $fileName);
                }
                $fname ='/uploads/services/';
                $image = $fname.$fileName;
            } else{
                $image = $result->blue_icon;
            }
            unset($inputs['blue_icon']);
            $inputs['blue_icon'] = $image;

            (new Service)->store($inputs, $id);

            return redirect()->route('services.index')
                ->with('success', 'Service successfully updated');

        } catch (\Exception $exception) {
            return redirect()->route('services.edit', [$id])
                ->withInput()
                ->with('error', lang('messages.server_error'));
        }
    }

  
    public function edit($id = null) {
        $result = (new Service)->find($id);
        if (!$result) {
            abort(401);
        }

        if((\Auth::user()->user_type) == 1){
            return view('admin.services.create', compact('result'));
        } else {
            \Auth::logout();
            \Session::flush();
            return redirect()->route('admin');
        }
    }


    public function servicesPaginate(Request $request, $pageNumber = null) {
     // dd($request);

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

            $data = (new Service)->getService($inputs, $start, $perPage);
            $totalGameMaster = (new Service)->totalService($inputs);
            $total = $totalGameMaster->total;
            // dd($data);

        } else {

            $data = (new Service)->getService($inputs, $start, $perPage);
            $totalGameMaster = (new Service)->totalService();
            $total = $totalGameMaster->total;
        }

       // dd($data);

        return view('admin.services.load_data', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }

 
    public function servicesToggle($id = null) {
        if (!\Request::isMethod('post') && !\Request::ajax()) {
            return lang('messages.server_error');
        }

        try {
            $game = Service::find($id);
        } catch (\Exception $exception) {
            return lang('messages.invalid_id', string_manip(lang('Service')));
        }

        $game->update(['status' => !$game->status]);
        $response = ['status' => 1, 'data' => (int)$game->status . '.gif'];
        // return json response
        return json_encode($response);
    }

  
    public function servicesAction(Request $request)  {

        $inputs = $request->all();
        if (!isset($inputs['tick']) || count($inputs['tick']) < 1) {
            return redirect()->route('service.index')
                ->with('error', lang('messages.atleast_one', string_manip(lang('Service'))));
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

        Service::whereRaw('id IN (' . $ids . ')')->update(['status' => $status]);
        return redirect()->route('services.index')
            ->with('success', lang('messages.updated', lang('Service')));
    }


    public function drop($id) {
        if (!\Request::ajax()) {
            return lang('messages.server_error');
        }
        $result = (new Service)->find($id);
        if (!$result) {
            // use ajax return response not abort because ajaz request abort not works
            abort(401);
        }
        try {
            // get the unit w.r.t id
            $result = (new Service)->find($id);
            // if($result->status == 1) {
            //     $response = ['status' => 0, 'message' => lang('category.category_in_use')];
            // }
            //  else {
                (new Service)->tempDelete($id);
                $response = ['status' => 1, 'message' => lang('messages.deleted', lang('Service'))];
             // }
        }
        catch (Exception $exception) {
            $response = ['status' => 0, 'message' => lang('messages.server_error')];
        }        
        // return json response
        return json_encode($response);
    }
    

}

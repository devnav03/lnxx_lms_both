<?php

namespace App\Http\Controllers;
/**
 * :: SmallSlider Controller ::
 * 
 *
 **/
use Intervention\Image\ImageManagerStatic as Image;
use Auth;
use Files;
use Illuminate\Support\Facades\Storage;
use App\Models\SmallSlider;
use Illuminate\Http\Request;

class SmallSliderController extends  Controller{

    public function index() {
        return view('admin.small_sliders.index');
    }
  
    public function create() {
        return view('admin.small_sliders.create');
    }

    public function store(Request $request) {
        $inputs = $request->all();
        try {
            $validator = (new SmallSlider)->validate($inputs);
            if( $validator->fails() ) {
                return back()->withErrors($validator)->withInput();
            }

            if(isset($inputs['image']) or !empty($inputs['image'])) {
                $image_name = rand(100000, 999999);
                $fileName = '';
                if($file = $request->hasFile('image')) {
                    $file = $request->file('image') ;
                    $img_name = $file->getClientOriginalName();
                    $fileName = $image_name.$img_name;
                    $destinationPath = public_path().'/uploads/sliders/' ;
                    $file->move($destinationPath, $fileName);
                }
                $fname ='/uploads/sliders/';
                $image = $fname.$fileName;
            }  else{
                $image = '';
            }
            
            unset($inputs['image']);
            $inputs['image'] = $image;

            (new SmallSlider)->store($inputs);
            return redirect()->route('landing-sliders.index')
                ->with('success', 'Slider successfully created');
        } catch (\Exception $exception) {
            return redirect()->route('landing-sliders.create')
                ->withInput()
                ->with('error', lang('messages.server_error').$exception->getMessage());
        }
    }

  
    public function update(Request $request, $id = null) {
        $result = (new SmallSlider)->find($id);
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
                    $destinationPath = public_path().'/uploads/sliders/' ;
                    $file->move($destinationPath, $fileName);
                }
                $fname ='/uploads/sliders/';
                $image = $fname.$fileName;
            } else{
                $image = $result->image;
            }
            unset($inputs['image']);
            $inputs['image'] = $image;
            (new SmallSlider)->store($inputs, $id);

            return redirect()->route('landing-sliders.index')
                ->with('success', 'Slider successfully updated');

        } catch (\Exception $exception) {
            return redirect()->route('landing-sliders.edit', [$id])
                ->withInput()
                ->with('error', lang('messages.server_error'));
        }
    }

  
    public function edit($id = null) {
        $result = (new SmallSlider)->find($id);
        if (!$result) {
            abort(401);
        }
        return view('admin.small_sliders.create', compact('result'));
    }


    public function servicesPaginate(Request $request, $pageNumber = null) {

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


        $start = ($page - 1) * $perPage;
        if (isset($inputs['form-search']) && $inputs['form-search'] != '') {
            $inputs = array_filter($inputs);
            unset($inputs['_token']);
            $data = (new SmallSlider)->getService($inputs, $start, $perPage);
            $totalGameMaster = (new SmallSlider)->totalService($inputs);
            $total = $totalGameMaster->total;
            // dd($data);
        } else {
            $data = (new SmallSlider)->getService($inputs, $start, $perPage);
            $totalGameMaster = (new SmallSlider)->totalService();
            $total = $totalGameMaster->total;
        }

        return view('admin.small_sliders.load_data', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }

 
    public function servicesToggle($id = null) {
        if (!\Request::isMethod('post') && !\Request::ajax()) {
            return lang('messages.server_error');
        }
        try {
            $game = SmallSlider::find($id);
        } catch (\Exception $exception) {
            return lang('messages.invalid_id', string_manip(lang('Slider')));
        }

        $game->update(['status' => !$game->status]);
        $response = ['status' => 1, 'data' => (int)$game->status . '.gif'];
        // return json response
        return json_encode($response);
    }

  
    public function servicesAction(Request $request)  {

        $inputs = $request->all();
        if (!isset($inputs['tick']) || count($inputs['tick']) < 1) {
            return redirect()->route('landing-sliders.index')
                ->with('error', lang('messages.atleast_one', string_manip(lang('Slider'))));
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

        SmallSlider::whereRaw('id IN (' . $ids . ')')->update(['status' => $status]);
        return redirect()->route('landing-sliders.index')
            ->with('success', lang('messages.updated', lang('Slider')));
    }


    public function drop($id) {
        if (!\Request::ajax()) {
            return lang('messages.server_error');
        }
        $result = (new SmallSlider)->find($id);
        if (!$result) {
       
            abort(401);
        }
        try {
      
            $result = (new SmallSlider)->find($id);
         
            (new SmallSlider)->tempDelete($id);
            $response = ['status' => 1, 'message' => lang('messages.deleted', lang('Slider'))];
             
        }
        catch (Exception $exception) {
            $response = ['status' => 0, 'message' => lang('messages.server_error')];
        }        
   
        return json_encode($response);
    }
    

}

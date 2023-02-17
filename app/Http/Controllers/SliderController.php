<?php

namespace App\Http\Controllers;
/**
 * :: Slider Controller ::
 * 
 *
 **/
use Intervention\Image\ImageManagerStatic as Image;
use Auth;
use Files;
use Illuminate\Support\Facades\Storage;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends  Controller{

    public function index() {
        return view('admin.sliders.index');
    }
  
    public function create() {
        return view('admin.sliders.create');
    }

    public function store(Request $request) {
        $inputs = $request->all();
       // dd($request);
        try {
            $validator = (new Slider)->validate($inputs);
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

            (new Slider)->store($inputs);
            return redirect()->route('sliders.index')
                ->with('success', 'Slider successfully created');
        } catch (\Exception $exception) {
            return redirect()->route('sliders.create')
                ->withInput()
                ->with('error', lang('messages.server_error').$exception->getMessage());
        }
    }

  
    public function update(Request $request, $id = null) {
        $result = (new Slider)->find($id);
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
            (new Slider)->store($inputs, $id);

            return redirect()->route('sliders.index')
                ->with('success', 'Slider successfully updated');

        } catch (\Exception $exception) {
            return redirect()->route('sliders.edit', [$id])
                ->withInput()
                ->with('error', lang('messages.server_error'));
        }
    }

  
    public function edit($id = null) {
        $result = (new Slider)->find($id);
        if (!$result) {
            abort(401);
        }
        return view('admin.sliders.create', compact('result'));
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
            $data = (new Slider)->getService($inputs, $start, $perPage);
            $totalGameMaster = (new Slider)->totalService($inputs);
            $total = $totalGameMaster->total;
            // dd($data);
        } else {
            $data = (new Slider)->getService($inputs, $start, $perPage);
            $totalGameMaster = (new Slider)->totalService();
            $total = $totalGameMaster->total;
        }

       // dd($data);

        return view('admin.sliders.load_data', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }

 
    public function servicesToggle($id = null) {
        if (!\Request::isMethod('post') && !\Request::ajax()) {
            return lang('messages.server_error');
        }
        try {
            $game = Slider::find($id);
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
            return redirect()->route('sliders.index')
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

        Slider::whereRaw('id IN (' . $ids . ')')->update(['status' => $status]);
        return redirect()->route('sliders.index')
            ->with('success', lang('messages.updated', lang('Slider')));
    }


    public function drop($id) {
        if (!\Request::ajax()) {
            return lang('messages.server_error');
        }
        $result = (new Slider)->find($id);
        if (!$result) {
            // use ajax return response not abort because ajaz request abort not works
            abort(401);
        }
        try {
            // get the unit w.r.t id
            $result = (new Slider)->find($id);
            // if($result->status == 1) {
            //     $response = ['status' => 0, 'message' => lang('category.category_in_use')];
            // }
            //  else {
                (new Slider)->tempDelete($id);
                $response = ['status' => 1, 'message' => lang('messages.deleted', lang('Slider'))];
             // }
        }
        catch (Exception $exception) {
            $response = ['status' => 0, 'message' => lang('messages.server_error')];
        }        
        // return json response
        return json_encode($response);
    }
    

}

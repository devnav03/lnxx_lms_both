<?php

namespace App\Http\Controllers;
/**
 * :: Refer Controller ::
 * 
 *
 **/
use Intervention\Image\ImageManagerStatic as Image;
use Auth;
use Files;
use Illuminate\Support\Facades\Storage;
use App\Models\Refer;
use Illuminate\Http\Request;

class ReferController extends Controller{

    public function index() {
        return view('admin.refer.index');
    }
  
    public function create() {
        return view('admin.refer.create');
    }
  
    public function edit($id = null) {
        $result = (new Refer)->find($id);
        if (!$result) {
            abort(401);
        }
        return view('admin.refer.create', compact('result'));
    }

    public function Paginate(Request $request, $pageNumber = null) {
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
            $data = (new Refer)->getRefer($inputs, $start, $perPage);
            $totalGameMaster = (new Refer)->totalRefer($inputs);
            $total = $totalGameMaster->total;
            // dd($data);
        } else {
            $data = (new Refer)->getRefer($inputs, $start, $perPage);
            $totalGameMaster = (new Refer)->totalRefer($inputs);
            $total = $totalGameMaster->total;
        }

       // dd($data);

        return view('admin.refer.load_data', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }

 
    public function Toggle($id = null) {
        if (!\Request::isMethod('post') && !\Request::ajax()) {
            return lang('messages.server_error');
        }
        try {
            $game = Refer::find($id);
        } catch (\Exception $exception) {
            return lang('messages.invalid_id', string_manip(lang('Refer')));
        }

        $game->update(['status' => !$game->status]);
        $response = ['status' => 1, 'data' => (int)$game->status . '.gif'];
        // return json response
        return json_encode($response);
    }

  
    public function Action(Request $request)  {

        $inputs = $request->all();
        if (!isset($inputs['tick']) || count($inputs['tick']) < 1) {
            return redirect()->route('refers.index')
                ->with('error', lang('messages.atleast_one', string_manip(lang('Refer'))));
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

        Refer::whereRaw('id IN (' . $ids . ')')->update(['status' => $status]);
        return redirect()->route('refers.index')
            ->with('success', lang('messages.updated', lang('Refer')));
    }


    public function drop($id) {
        if (!\Request::ajax()) {
            return lang('messages.server_error');
        }
        $result = (new Refer)->find($id);
        if (!$result) {
            abort(401);
        }
        try {
            // get the unit w.r.t id
            $result = (new Refer)->find($id);
          
                (new Refer)->tempDelete($id);
                $response = ['status' => 1, 'message' => lang('messages.deleted', lang('Refer'))];
        }
        catch (Exception $exception) {
            $response = ['status' => 0, 'message' => lang('messages.server_error')];
        }        
        return json_encode($response);
    }
    

}

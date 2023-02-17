<?php

namespace App\Http\Controllers;
/**
 * :: AgentRequest Controller ::
 * 
 *
 **/
use Intervention\Image\ImageManagerStatic as Image;
use Auth;
use Files;
use Illuminate\Support\Facades\Storage;
use App\Models\AgentRequest;
use App\Models\Country;
use Illuminate\Http\Request;

class AgentRequestController extends  Controller{

    public function index() {
        return view('admin.agent_request.index');
    }
  
    public function create() {
        return view('admin.agent_request.create');
    }
  
    public function update(Request $request, $id = null) {
        $result = (new AgentRequest)->find($id);
        if (!$result) {
            abort(401);
        }
        $inputs = $request->all();
        try {
          
          
            (new AgentRequest)->store($inputs, $id);

            return redirect()->route('agent-request.index')
                ->with('success', 'Bank successfully updated');

        } catch (\Exception $exception) {
            return redirect()->route('agent-request.edit', [$id])
                ->withInput()
                ->with('error', lang('messages.server_error'));
        }
    }

  
    public function edit($id = null) {
        $result = (new AgentRequest)->find($id);
        if (!$result) {
            abort(401);
        }
        $countries = Country::all();

        return view('admin.agent_request.create', compact('result', 'countries'));
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

        $start = ($page - 1) * $perPage;
        if (isset($inputs['form-search']) && $inputs['form-search'] != '') {
            $inputs = array_filter($inputs);
            unset($inputs['_token']);
            $data = (new AgentRequest)->getAgentRequest($inputs, $start, $perPage);
            $totalGameMaster = (new AgentRequest)->totalAgentRequest($inputs);
            $total = $totalGameMaster->total;
            // dd($data);
        } else {
            $data = (new AgentRequest)->getAgentRequest($inputs, $start, $perPage);
            $totalGameMaster = (new AgentRequest)->totalAgentRequest();
            $total = $totalGameMaster->total;
        }

        return view('admin.agent_request.load_data', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }

 
    public function Toggle($id = null) {
        if (!\Request::isMethod('post') && !\Request::ajax()) {
            return lang('messages.server_error');
        }
        try {
            $game = AgentRequest::find($id);
        } catch (\Exception $exception) {
            return lang('messages.invalid_id', string_manip(lang('Agent Request')));
        }

        $game->update(['status' => !$game->status]);
        $response = ['status' => 1, 'data' => (int)$game->status . '.gif'];
        // return json response
        return json_encode($response);
    }

  
    public function Action(Request $request)  {

        $inputs = $request->all();
        if (!isset($inputs['tick']) || count($inputs['tick']) < 1) {
            return redirect()->route('agent-request.index')
                ->with('error', lang('messages.atleast_one', string_manip(lang('Agent Request'))));
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

        AgentRequest::whereRaw('id IN (' . $ids . ')')->update(['status' => $status]);
        return redirect()->route('agent-request.index')
            ->with('success', lang('messages.updated', lang('Agent Request')));
    }


    public function drop($id) {
        if (!\Request::ajax()) {
            return lang('messages.server_error');
        }
        $result = (new AgentRequest)->find($id);
        if (!$result) {
            // use ajax return response not abort because ajaz request abort not works
            abort(401);
        }
        try {
            // get the unit w.r.t id
            $result = (new AgentRequest)->find($id);
            // if($result->status == 1) {
            //     $response = ['status' => 0, 'message' => lang('category.category_in_use')];
            // }
            //  else {
                (new AgentRequest)->tempDelete($id);
                $response = ['status' => 1, 'message' => lang('messages.deleted', lang('Agent Request'))];
             // }
        }
        catch (Exception $exception) {
            $response = ['status' => 0, 'message' => lang('messages.server_error')];
        }        
        // return json response
        return json_encode($response);
    }
    

}

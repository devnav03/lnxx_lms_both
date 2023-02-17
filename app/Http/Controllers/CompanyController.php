<?php

namespace App\Http\Controllers;
/**
 * :: Company Controller ::
 * 
 *
 **/
use Intervention\Image\ImageManagerStatic as Image;
use Auth;
use Files;
use Illuminate\Support\Facades\Storage;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends  Controller{

    public function index() {
        return view('admin.company.index');
    }
  
    public function create() {
        return view('admin.company.create');
    }

    public function  store(Request $request) {
        $inputs = $request->all();
       // dd($request);
        try {
            (new Company)->store($inputs);
            return redirect()->route('company.index')
                ->with('success', 'Company successfully created');
        } catch (\Exception $exception) {
            return redirect()->route('company.create')
                ->withInput()
                ->with('error', lang('messages.server_error').$exception->getMessage());
        }
    }

  
    public function update(Request $request, $id = null) {
        $result = (new Company)->find($id);
        if (!$result) {
            abort(401);
        }
        $inputs = $request->all();
        try {
          
            (new Company)->store($inputs, $id);

            return redirect()->route('company.index')
                ->with('success', 'Company successfully updated');

        } catch (\Exception $exception) {
            return redirect()->route('company.edit', [$id])
                ->withInput()->with('error', lang('messages.server_error'));
        }
    }

  
    public function edit($id = null) {
        $result = (new Company)->find($id);
        if (!$result) {
            abort(401);
        }
        return view('admin.company.create', compact('result'));
    }


    public function companyPaginate(Request $request, $pageNumber = null) {

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
            $data = (new Company)->getCompany($inputs, $start, $perPage);
            $totalGameMaster = (new Company)->totalCompany($inputs);
            $total = $totalGameMaster->total;
            // dd($data);
        } else {
            $data = (new Company)->getCompany($inputs, $start, $perPage);
            $totalGameMaster = (new Company)->totalCompany();
            $total = $totalGameMaster->total;
        }

        return view('admin.company.load_data', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }

 
    public function companyToggle($id = null) {
        if (!\Request::isMethod('post') && !\Request::ajax()) {
            return lang('messages.server_error');
        }
        try {
            $game = Company::find($id);
        } catch (\Exception $exception) {
            return lang('messages.invalid_id', string_manip(lang('Company')));
        }

        $game->update(['status' => !$game->status]);
        $response = ['status' => 1, 'data' => (int)$game->status . '.gif'];
        // return json response
        return json_encode($response);
    }

  
    public function companyAction(Request $request)  {

        $inputs = $request->all();
        if (!isset($inputs['tick']) || count($inputs['tick']) < 1) {
            return redirect()->route('company.index')
                ->with('error', lang('messages.atleast_one', string_manip(lang('Company'))));
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

        Company::whereRaw('id IN (' . $ids . ')')->update(['status' => $status]);
        return redirect()->route('company.index')
            ->with('success', lang('messages.updated', lang('Company')));
    }


    public function drop($id) {
        if (!\Request::ajax()) {
            return lang('messages.server_error');
        }
        $result = (new Company)->find($id);
        if (!$result) {
            abort(401);
        }
        try {
            $result = (new Company)->find($id);
            (new Company)->tempDelete($id);
            $response = ['status' => 1, 'message' => lang('messages.deleted', lang('Company'))];
        } catch (Exception $exception) {
            $response = ['status' => 0, 'message' => lang('messages.server_error')];
        }        
        return json_encode($response);
    }

}

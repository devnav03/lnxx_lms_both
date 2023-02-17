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
use App\Models\Lead; 
use App\Models\Employee; 
use App\Models\User; 
use Illuminate\Http\Request;
use Carbon\Carbon;

class ManagerController extends  Controller{

    public function manager_employees() {
        return view('admin.manager.employees');
    }
    public function employeespaginate(Request $request){
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

        return view('admin.manager.employees_load', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }
    public function employeesaction(Request $request){
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

}
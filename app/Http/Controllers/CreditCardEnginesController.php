<?php

namespace App\Http\Controllers;
/**
 * :: CreditCardEngine Controller ::
 * 
 *
 **/
use Intervention\Image\ImageManagerStatic as Image;
use Auth;
use Files;
use Illuminate\Support\Facades\Storage;
use App\Models\CreditCardEngine;
use App\Models\Bank;
use App\Models\ExistingCreditCardEngine;
use App\Models\BankService;
use Illuminate\Http\Request;

class CreditCardEnginesController extends Controller{

    public function index() {
        return view('admin.credit_card_engine.index');
    }
  
    public function create() {

        $already_added = CreditCardEngine::where('status', 1)->pluck('bank_id')->toArray();
        $credit_card_provider = BankService::where('service_id', 3)->pluck('bank_id')->toArray();

        $banks = Bank::where('status', 1)->whereIn('id', $credit_card_provider)->whereNotIn('id', $already_added)->select('name', 'id')->get();
        $bank_list = Bank::where('status', 1)->select('name', 'id')->get();

        return view('admin.credit_card_engine.create', compact('banks', 'bank_list'));
    }

    public function store(Request $request) {
        $inputs = $request->all();
       // dd($request);
        try {
            // $validator = (new CreditCardEngine)->validate($inputs);
            // if( $validator->fails() ) {
            //     return back()->withErrors($validator)->withInput();
            // }

            $id = (new CreditCardEngine)->store($inputs);
            if($request->existing_card == 1){
                if($request->bank){
                    foreach($request->bank as $key => $value) {
                        $ExistingCredit = new ExistingCreditCardEngine;
                        $ExistingCredit->bank_id = $value;
                        $ExistingCredit->engine_id = $id;
                        $ExistingCredit->credit_limit = $request->credit_limit[$key];
                        $ExistingCredit->save();
                    }
                }
            }

            return redirect()->route('credit-card-engines.index')
                ->with('success', 'Credit card engine successfully created');
        } catch (\Exception $exception) {
            return redirect()->route('credit-card-engines.create')
                ->withInput()
                ->with('error', lang('messages.server_error').$exception->getMessage());
        }
    }

  
    public function update(Request $request, $id = null) {
        $result = (new CreditCardEngine)->find($id);
        if (!$result) {
            abort(401);
        }
        $inputs = $request->all();
        try {
          
            (new CreditCardEngine)->store($inputs, $id);

            \DB::table('existing_credit_card_engines')->where('engine_id', $id)->delete();
            if($request->existing_card == 1){
                if($request->bank){
                    foreach($request->bank as $key => $value) {
                        $ExistingCredit = new ExistingCreditCardEngine;
                        $ExistingCredit->bank_id = $value;
                        $ExistingCredit->engine_id = $id;
                        $ExistingCredit->credit_limit = $request->credit_limit[$key];
                        $ExistingCredit->save();
                    }
                }
            }

            return redirect()->route('credit-card-engines.index')
                ->with('success', 'Credit card engine successfully updated');

        } catch (\Exception $exception) {
            return redirect()->route('credit-card-engines.edit', [$id])
                ->withInput()
                ->with('error', lang('messages.server_error'));
        }
    }
  
    public function edit($id = null) {
        $result = (new CreditCardEngine)->find($id);
        if (!$result) {
            abort(401);
        }
        $bank_list = Bank::where('status', 1)->select('name', 'id')->get();
        $bank_credits = ExistingCreditCardEngine::where('engine_id', $id)->select('bank_id', 'credit_limit')->get();
        return view('admin.credit_card_engine.create', compact('result', 'bank_list', 'bank_credits'));
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
            $data = (new CreditCardEngine)->getCreditCardEngine($inputs, $start, $perPage);
            $totalGameMaster = (new CreditCardEngine)->totalCreditCardEngine($inputs);
            $total = $totalGameMaster->total;
            // dd($data);
        } else {
            $data = (new CreditCardEngine)->getCreditCardEngine($inputs, $start, $perPage);
            $totalGameMaster = (new CreditCardEngine)->totalCreditCardEngine();
            $total = $totalGameMaster->total;
        }

        return view('admin.credit_card_engine.load_data', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }

 
    public function servicesToggle($id = null) {
        if (!\Request::isMethod('post') && !\Request::ajax()) {
            return lang('messages.server_error');
        }
        try {
            $game = CreditCardEngine::find($id);
        } catch (\Exception $exception) {
            return lang('messages.invalid_id', string_manip(lang('Credit Card Engine')));
        }

        $game->update(['status' => !$game->status]);
        $response = ['status' => 1, 'data' => (int)$game->status . '.gif'];
        // return json response
        return json_encode($response);
    }

  
    public function servicesAction(Request $request)  {

        $inputs = $request->all();
        if (!isset($inputs['tick']) || count($inputs['tick']) < 1) {
            return redirect()->route('credit-card-engines.index')
                ->with('error', lang('messages.atleast_one', string_manip(lang('Credit Card Engine'))));
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

        CreditCardEngine::whereRaw('id IN (' . $ids . ')')->update(['status' => $status]);
        return redirect()->route('credit-card-engines.index')
            ->with('success', lang('messages.updated', lang('Credit Card Engine')));
    }


    public function drop($id) {
        if (!\Request::ajax()) {
            return lang('messages.server_error');
        }
        $result = (new CreditCardEngine)->find($id);
        if (!$result) {
            abort(401);
        }
        try {
            $result = (new CreditCardEngine)->find($id);
                (new CreditCardEngine)->tempDelete($id);
                $response = ['status' => 1, 'message' => lang('messages.deleted', lang('Credit Card Engine'))];
        }
        catch (Exception $exception) {
            $response = ['status' => 0, 'message' => lang('messages.server_error')];
        }        
        return json_encode($response);
    }
    

}

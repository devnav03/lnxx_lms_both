<?php

namespace App\Http\Controllers;
/**
 * :: CardType Controller ::
 * 
 *
 **/
use Intervention\Image\ImageManagerStatic as Image;
use Auth;
use Files;
use Illuminate\Support\Facades\Storage;
use App\Models\CardType;
use Illuminate\Http\Request;

class CardTypeController extends  Controller{

    public function index() {
        return view('admin.card_type.index');
    }
  
    public function create() {
        return view('admin.card_type.create');
    }

    public function  store(Request $request) {
        $inputs = $request->all();
       // dd($request);
        try {
            (new CardType)->store($inputs);
            return redirect()->route('card-type.index')
                ->with('success', 'Card type successfully created');
        } catch (\Exception $exception) {
            return redirect()->route('card-type.create')
                ->withInput()
                ->with('error', lang('messages.server_error').$exception->getMessage());
        }
    }

  
    public function update(Request $request, $id = null) {
        $result = (new CardType)->find($id);
        if (!$result) {
            abort(401);
        }
        $inputs = $request->all();
        try {
            (new CardType)->store($inputs, $id);
            return redirect()->route('card-type.index')
                ->with('success', 'Card type successfully updated');
        } catch (\Exception $exception) {
            return redirect()->route('card-type.edit', [$id])
                ->withInput()->with('error', lang('messages.server_error'));
        }
    }
  
    public function edit($id = null) {
        $result = (new CardType)->find($id);
        if (!$result) {
            abort(401);
        }
        return view('admin.card_type.create', compact('result'));
    }


    public function Paginate(Request $request, $pageNumber = null) {

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
            $data = (new CardType)->getCardType($inputs, $start, $perPage);
            $totalGameMaster = (new CardType)->totalCardType($inputs);
            $total = $totalGameMaster->total;
            // dd($data);
        } else {
            $data = (new CardType)->getCardType($inputs, $start, $perPage);
            $totalGameMaster = (new CardType)->totalCardType();
            $total = $totalGameMaster->total;
        }

        return view('admin.card_type.load_data', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }

 
    public function Toggle($id = null) {
        if (!\Request::isMethod('post') && !\Request::ajax()) {
            return lang('messages.server_error');
        }
        try {
            $game = CardType::find($id);
        } catch (\Exception $exception) {
            return lang('messages.invalid_id', string_manip(lang('Card Type')));
        }

        $game->update(['status' => !$game->status]);
        $response = ['status' => 1, 'data' => (int)$game->status . '.gif'];
        // return json response
        return json_encode($response);
    }
  
    public function Action(Request $request)  {
        $inputs = $request->all();
        if (!isset($inputs['tick']) || count($inputs['tick']) < 1) {
            return redirect()->route('card-type.index')
                ->with('error', lang('messages.atleast_one', string_manip(lang('Card Type'))));
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
        CardType::whereRaw('id IN (' . $ids . ')')->update(['status' => $status]);
        return redirect()->route('card-type.index')
            ->with('success', lang('messages.updated', lang('Card Type')));
    }


    public function drop($id) {
        if (!\Request::ajax()) {
            return lang('messages.server_error');
        }
        $result = (new CardType)->find($id);
        if (!$result) {
            abort(401);
        }
        try {
            $result = (new CardType)->find($id);
            (new CardType)->tempDelete($id);
            $response = ['status' => 1, 'message' => lang('messages.deleted', lang('Card Type'))];
        } catch (Exception $exception) {
            $response = ['status' => 0, 'message' => lang('messages.server_error')];
        }        
        return json_encode($response);
    }

}

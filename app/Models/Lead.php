<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Lead extends Model
{

    use HasFactory;
    protected $fillable = [
        'saturation',
        'name',
        'mname',
        'lname',
        'email',
        'number',
        'product',
        'reference',
        'note',
        'source',
        'f_date',
        'uploaded_by',
        'alloted_to'
    ];
    public function validate($inputs, $id = null){
        $rules['name'] = 'required|unique:banks';
        return \Validator::make($inputs, $rules);
    }
    public function store($inputs, $id = null) {
        // dd($inputs);
         if ($id) {
             return $this->find($id)->update($inputs);
         } else {
             return $this->create($inputs)->id;
         }
     }
    public function getlead($search = null, $skip, $perPage) {
        // dd($search);
        if(isset($search['between_date'])){
            $new_request = explode(' - ', $search['between_date']);
            $search['from'] = $new_request[0];
            $search['to'] = $new_request[1];
        }
        $take = ((int)$perPage > 0) ? $perPage : 20;
        $filter = 1; // default filter if no search

        $fields = [
            'id',
            'saturation',
            'name',
            'email',
            'number',
            'product',
            'reference',
            'note',
            'source',
            'f_date',
            'uploaded_by',
            'alloted_to',
            'created_at'
        ];

        $sortBy = [
            'name' => 'name',
        ];

        $orderEntity = 'id';
        $orderAction = 'desc';
        if (isset($search['sort_action']) && $search['sort_action'] != "") {
            $orderAction = ($search['sort_action'] == 1) ? 'desc' : 'asc';
        }

        if (isset($search['sort_entity']) && $search['sort_entity'] != "") {
            $orderEntity = (array_key_exists($search['sort_entity'], $sortBy)) ? $sortBy[$search['sort_entity']] : $orderEntity;
        }

        if(isset($search['from'])){
            $search['from'] = date('Y-m-d H:i:s', strtotime($search['from']));
        }

        if(isset($search['to'])){
            $search['to'] = date('Y-m-d H:i:s', strtotime($search['to']));
            $search['to'] = date('Y-m-d H:i:s', strtotime($search['to'] . ' +1 day'));
        }

        if (is_array($search) && count($search) > 0) { 
            $f1 = (array_key_exists('name', $search)) ? " AND (name Like '%" .
                addslashes($search['name']) . "%')" : "";
            $f2 = (array_key_exists('email', $search)) ? " AND (email Like '%" .
                addslashes($search['email']) . "%')" : "";
            $f3 = (array_key_exists('number', $search)) ? " AND (number Like '%" .
                addslashes($search['number']) . "%')" : "";
            $f4 = (array_key_exists('product', $search)) ? " AND (product LIKE '%" .
                addslashes(trim($search['product'])) . "%')" : "";  
            $f5 = (array_key_exists('reference', $search)) ? " AND (reference LIKE '%" .
                addslashes(trim($search['reference'])) . "%')" : ""; 

            $f6 = (array_key_exists('source', $search)) ? " AND (source LIKE '%" .
                addslashes(trim($search['source'])) . "%')" : "";   

            $f7 = (array_key_exists('from', $search)) ? " AND (created_at >= '" .
                addslashes($search['from']) . "')" : "";  

            $f8 =  (array_key_exists('to', $search)) ? " AND (created_at <= '" .
                addslashes($search['to']) . "')" : ""; 

            $filter .= $f1 . $f2 . $f3 . $f4 . $f5 . $f6 . $f7 . $f8;
         }
        //  dd($f8);

         return $this->whereRaw($filter)
                ->where('alloted_to', Null) 
                ->orderBy($orderEntity, $orderAction)
                ->skip($skip)->take($take)
                ->get($fields);
    }
    public function getassignlead($search = null, $skip, $perPage) {

  
        if(isset($search['from'])){
            $search['from'] = date('Y-m-d H:i:s', strtotime($search['from']));
        }

        if(isset($search['to'])){
            $search['to'] = date('Y-m-d H:i:s', strtotime($search['to']));
            $search['to'] = date('Y-m-d H:i:s', strtotime($search['to'] . ' +1 day'));
        }

        $auth_user_id = \Auth::user()->id;
        $user_type = Auth()->user()->user_type;
        $take = ((int)$perPage > 0) ? $perPage : 20;
        $filter = 1; // default filter if no search

        $fields = [
            'id',
            'saturation',
            'name',
            'email',
            'number',
            'product',
            'reference',
            'note',
            'source',
            'f_date',
            'uploaded_by',
            'alloted_to',
            'created_at'
        ];

        $sortBy = [
            'name' => 'name',
        ];

         $orderEntity = 'id';
         $orderAction = 'desc';
         if (isset($search['sort_action']) && $search['sort_action'] != "") {
             $orderAction = ($search['sort_action'] == 1) ? 'desc' : 'asc';
         }

         if (isset($search['sort_entity']) && $search['sort_entity'] != "") {
             $orderEntity = (array_key_exists($search['sort_entity'], $sortBy)) ? $sortBy[$search['sort_entity']] : $orderEntity;
         }

         if (is_array($search) && count($search) > 0) { 
            $f1 = (array_key_exists('name', $search)) ? " AND (name LIKE '%" .
            addslashes(trim($search['name'])) . "%')" : "";  
            $f2 = (array_key_exists('email', $search)) ? " AND (email LIKE '%" .
            addslashes(trim($search['email'])) . "%')" : "";  
            $f3 = (array_key_exists('number', $search)) ? " AND (number LIKE '%" .
            addslashes(trim($search['number'])) . "%')" : "";  
            $f4 = (array_key_exists('product', $search)) ? " AND (product LIKE '%" .
            addslashes(trim($search['product'])) . "%')" : "";  
            $f5 = (array_key_exists('reference', $search)) ? " AND (reference = '" .
            addslashes(trim($search['reference'])) . "')" : "";
            $f6 = (array_key_exists('source', $search)) ? " AND (source LIKE '%" .
            addslashes(trim($search['source'])) . "%')" : "";
            $f7 = (array_key_exists('alloted_to', $search)) ? " AND (alloted_to = '" .
                addslashes($search['alloted_to']) . "')" : "";
            $f8 = (array_key_exists('from', $search)) ? " AND (created_at >= '" .
                addslashes($search['from']) . "')" : "";  

            $f9 =  (array_key_exists('to', $search)) ? " AND (created_at <= '" .
                addslashes($search['to']) . "')" : ""; 
            $filter .= $f1 . $f2 . $f3 . $f4 . $f5 . $f6 . $f7 . $f8 .$f9;
         }
         if($user_type == 1){
            return $this->whereRaw($filter)
            ->where('alloted_to', '!=', Null)
            ->where('lead_status', '!=', 'CLOSE')
            ->orderBy($orderEntity, $orderAction)
            ->skip($skip)->take($take)
            ->get($fields);   
         }elseif($user_type == 5){
            return $this->whereRaw($filter)
            ->where('lead_status', '!=', 'CLOSE')
            ->where('alloted_to', $auth_user_id)
            ->orderBy($orderEntity, $orderAction)
            ->skip($skip)->take($take)
            ->get($fields);
         }elseif($user_type == 4 || $user_type == 3){
            return $this->whereRaw($filter)
            ->where('lead_status', '!=', 'CLOSE')
            ->where('alloted_to', $auth_user_id)
            ->orderBy($orderEntity, $orderAction)
            ->skip($skip)->take($take)
            ->get($fields);
         } 
         
    }
    public function getOpenlead($search = null, $skip, $perPage) {

        $auth_user_id = \Auth::user()->id;
        $take = ((int)$perPage > 0) ? $perPage : 20;
        $filter = 1; // default filter if no search

        $fields = [
            'id',
            'saturation',
            'name',
            'email',
            'number',
            'product',
            'reference',
            'note',
            'source',
            'f_date',
            'lead_status',
            'uploaded_by'
        ];

        $sortBy = [
            'name' => 'name',
        ];

         $orderEntity = 'id';
         $orderAction = 'desc';
         if (isset($search['sort_action']) && $search['sort_action'] != "") {
             $orderAction = ($search['sort_action'] == 1) ? 'desc' : 'asc';
         }

         if (isset($search['sort_entity']) && $search['sort_entity'] != "") {
             $orderEntity = (array_key_exists($search['sort_entity'], $sortBy)) ? $sortBy[$search['sort_entity']] : $orderEntity;
         }

         if (is_array($search) && count($search) > 0) { 
             $keyword = (array_key_exists('keyword', $search)) ?
                 " AND (name LIKE '%" .addslashes(trim($search['keyword'])) . "%')" : "";
             $filter .= $keyword;
         }

         return $this->whereRaw($filter)
                ->where('lead_status', 'OPEN')
                ->where('alloted_to', $auth_user_id)
                ->orderBy($orderEntity, $orderAction)
                ->skip($skip)->take($take)
                ->get($fields);
    }
    public function totalLead($search = null)  {
        $filter = 1; // if no search add where

        // when search
        if (is_array($search) && count($search) > 0) {
            $partyName = (array_key_exists('keyword', $search)) ? " AND name LIKE '%" .
                addslashes(trim($search['keyword'])) . "%' " : "";
            $filter .= $partyName;
        }
        return $this->select(\DB::raw('count(*) as total'))
            ->whereRaw($filter)->where('alloted_to', Null) ->first();
    }
    public function assigntotalLead($search = null)  {
        $filter = 1; // if no search add where

        // when search
        if (is_array($search) && count($search) > 0) {
            $partyName = (array_key_exists('keyword', $search)) ? " AND name LIKE '%" .
                addslashes(trim($search['keyword'])) . "%' " : "";
            $filter .= $partyName;
        }

        $auth_user_id = \Auth::user()->id;
        $user_type = Auth()->user()->user_type;

        if($user_type == 1){
            return $this->select(\DB::raw('count(*) as total'))->whereRaw($filter)->where('alloted_to', '!=', Null)->where('lead_status', '!=', 'CLOSE')->first();
        }elseif($user_type == 5){
            return $this->select(\DB::raw('count(*) as total'))->whereRaw($filter)->where('lead_status', '!=', 'CLOSE')->where('alloted_to', $auth_user_id)->first();
        }elseif($user_type == 4 || $user_type == 3){
            return $this->select(\DB::raw('count(*) as total'))->whereRaw($filter)->where('lead_status', '!=', 'CLOSE')->where('alloted_to', $auth_user_id)->first();
        } 
    }

    public function getAdminOpenlead($search = null, $skip, $perPage) {
     
        if(isset($search['from'])){
            $search['from'] = date('Y-m-d H:i:s', strtotime($search['from']));
        }
        if(isset($search['to'])){
            $search['to'] = date('Y-m-d H:i:s', strtotime($search['to']));
            $search['to'] = date('Y-m-d H:i:s', strtotime($search['to'] . ' +1 day'));
        }
        $take = ((int)$perPage > 0) ? $perPage : 20;
        $filter = 1; // default filter if no search

        $fields = [
            'id',
            'saturation',
            'name',
            'email',
            'number',
            'product',
            'reference',
            'note',
            'source',
            'f_date',
            'lead_status',
            'alloted_to',
            'uploaded_by',
            'created_at'
        ];

        $sortBy = [
            'name' => 'name',
        ];

         $orderEntity = 'id';
         $orderAction = 'desc';
         if (isset($search['sort_action']) && $search['sort_action'] != "") {
             $orderAction = ($search['sort_action'] == 1) ? 'desc' : 'asc';
         }

         if (isset($search['sort_entity']) && $search['sort_entity'] != "") {
             $orderEntity = (array_key_exists($search['sort_entity'], $sortBy)) ? $sortBy[$search['sort_entity']] : $orderEntity;
         }

         if (is_array($search) && count($search) > 0) { 
            $f1 = (array_key_exists('name', $search)) ? " AND (name LIKE '%" .
            addslashes(trim($search['name'])) . "%')" : "";  
            $f2 = (array_key_exists('email', $search)) ? " AND (email LIKE '%" .
            addslashes(trim($search['email'])) . "%')" : "";  
            $f3 = (array_key_exists('number', $search)) ? " AND (number LIKE '%" .
            addslashes(trim($search['number'])) . "%')" : "";  
            $f4 = (array_key_exists('product', $search)) ? " AND (product LIKE '%" .
            addslashes(trim($search['product'])) . "%')" : "";  
            $f5 = (array_key_exists('reference', $search)) ? " AND (reference = '" .
            addslashes(trim($search['reference'])) . "')" : "";
            $f6 = (array_key_exists('source', $search)) ? " AND (source LIKE '%" .
            addslashes(trim($search['source'])) . "%')" : "";
            $f7 = (array_key_exists('alloted_to', $search)) ? " AND (alloted_to = '" .
                addslashes($search['alloted_to']) . "')" : "";
            $f8 = (array_key_exists('from', $search)) ? " AND (created_at >= '" .
                addslashes($search['from']) . "')" : "";  

            $f9 =  (array_key_exists('to', $search)) ? " AND (created_at <= '" .
                addslashes($search['to']) . "')" : ""; 

            $filter .= $f1 . $f2 . $f3 . $f4 . $f5 . $f6 . $f7 . $f8 . $f9;
         }

         return $this->whereRaw($filter)
                ->where('lead_status', '!=', 'CLOSE')
                ->where('lead_status', '!=', 'DISQUALIFIED')
                ->where('lead_status', '!=', 'INACTIVE CUSTOMER')
                ->orderBy($orderEntity, $orderAction)
                ->skip($skip)->take($take)
                ->get($fields);
    }
    
    public function totalAdminOpenLead($search = null)  {
        $filter = 1; // if no search add where

        // when search
        if (is_array($search) && count($search) > 0) {
            $partyName = (array_key_exists('keyword', $search)) ? " AND name LIKE '%" .
                addslashes(trim($search['keyword'])) . "%' " : "";
            $filter .= $partyName;
        }
        return $this->select(\DB::raw('count(*) as total'))
            ->whereRaw($filter)->first();
    }
    public function getAdmincloselead($search = null, $skip, $perPage) {
        if(isset($search['from'])){
            $search['from'] = date('Y-m-d H:i:s', strtotime($search['from']));
        }
        if(isset($search['to'])){
            $search['to'] = date('Y-m-d H:i:s', strtotime($search['to']));
            $search['to'] = date('Y-m-d H:i:s', strtotime($search['to'] . ' +1 day'));
        }
        $auth_user_id = \Auth::user()->id;
        $user_type = Auth()->user()->user_type;
        $take = ((int)$perPage > 0) ? $perPage : 20;
        $filter = 1; // default filter if no search

        $fields = [
            'id', 
            'saturation',
            'name',
            'email',
            'number',
            'product',
            'reference',
            'note',
            'source',
            'f_date',
            'lead_status',
            'alloted_to',
            'uploaded_by',
            'created_at'
        ];

        $sortBy = [
            'name' => 'name',
        ];

         $orderEntity = 'id';
         $orderAction = 'desc';
         if (isset($search['sort_action']) && $search['sort_action'] != "") {
             $orderAction = ($search['sort_action'] == 1) ? 'desc' : 'asc';
         }

         if (isset($search['sort_entity']) && $search['sort_entity'] != "") {
             $orderEntity = (array_key_exists($search['sort_entity'], $sortBy)) ? $sortBy[$search['sort_entity']] : $orderEntity;
         }

         if (is_array($search) && count($search) > 0) { 
            $f1 = (array_key_exists('name', $search)) ? " AND (name LIKE '%" .
            addslashes(trim($search['name'])) . "%')" : "";  
            $f2 = (array_key_exists('email', $search)) ? " AND (email LIKE '%" .
            addslashes(trim($search['email'])) . "%')" : "";  
            $f3 = (array_key_exists('number', $search)) ? " AND (number LIKE '%" .
            addslashes(trim($search['number'])) . "%')" : "";  
            $f4 = (array_key_exists('product', $search)) ? " AND (product LIKE '%" .
            addslashes(trim($search['product'])) . "%')" : "";  
            $f5 = (array_key_exists('reference', $search)) ? " AND (reference = '" .
            addslashes(trim($search['reference'])) . "')" : "";
            $f6 = (array_key_exists('source', $search)) ? " AND (source LIKE '%" .
            addslashes(trim($search['source'])) . "%')" : "";
            $f7 = (array_key_exists('alloted_to', $search)) ? " AND (alloted_to = '" .
                addslashes($search['alloted_to']) . "')" : "";
            $f8 = (array_key_exists('from', $search)) ? " AND (created_at >= '" .
                addslashes($search['from']) . "')" : "";  

            $f9 =  (array_key_exists('to', $search)) ? " AND (created_at <= '" .
                addslashes($search['to']) . "')" : ""; 
            $filter .= $f1 . $f2 . $f3 . $f4 . $f5 . $f6 . $f7 . $f8 . $f9;
         }
         if($user_type == 1){
            return $this->whereRaw($filter)
            ->where('lead_status', 'CLOSE')
            ->orWhere('lead_status', 'DISQUALIFIED')
            ->orWhere('lead_status', 'INACTIVE CUSTOMER')
            ->orderBy($orderEntity, $orderAction)
            ->skip($skip)->take($take)
            ->get($fields);   
        } elseif($user_type == 4 || $user_type == 3){
            return $this->whereRaw($filter)
            ->orWhere('lead_status', 'CLOSE')
            ->orWhere('lead_status', 'DISQUALIFIED')
            ->orWhere('lead_status', 'INACTIVE CUSTOMER')
            ->where('alloted_to', $auth_user_id)
            ->orderBy($orderEntity, $orderAction)
            ->skip($skip)->take($take)
            ->get($fields);
        } elseif($user_type == 5){
            return $this->whereRaw($filter)
            ->where('lead_status', 'CLOSE')
            ->where('lead_status', 'DISQUALIFIED')
            ->where('lead_status', 'INACTIVE CUSTOMER')
            ->where('alloted_to', $auth_user_id)
            ->orderBy($orderEntity, $orderAction)
            ->skip($skip)->take($take)
            ->get($fields);
        }
    }
    
    public function totalAdmincloseLead($search = null)  {
        $filter = 1; // if no search add where

        // when search
        if (is_array($search) && count($search) > 0) {
            $partyName = (array_key_exists('keyword', $search)) ? " AND name LIKE '%" .
                addslashes(trim($search['keyword'])) . "%' " : "";
            $filter .= $partyName;
        }
        return $this->select(\DB::raw('count(*) as total'))
            ->where('lead_status', 'CLOSE')
            ->whereRaw($filter)->first();
    }
    public function getEmpOpenlead($search = null, $skip, $perPage) {
        $auth_user_id = \Auth::user()->id;
        $take = ((int)$perPage > 0) ? $perPage : 20;
        $filter = 1; // default filter if no search

        $fields = [
            'id',
            'saturation',
            'name',
            'email',
            'number',
            'product',
            'reference',
            'note',
            'source',
            'f_date',
            'lead_status',
            'alloted_to',
            'uploaded_by'
        ];

        $sortBy = [
            'name' => 'name',
        ];

         $orderEntity = 'id';
         $orderAction = 'desc';
         if (isset($search['sort_action']) && $search['sort_action'] != "") {
             $orderAction = ($search['sort_action'] == 1) ? 'desc' : 'asc';
         }

         if (isset($search['sort_entity']) && $search['sort_entity'] != "") {
             $orderEntity = (array_key_exists($search['sort_entity'], $sortBy)) ? $sortBy[$search['sort_entity']] : $orderEntity;
         }

         if (is_array($search) && count($search) > 0) { 
            $f1 = (array_key_exists('name', $search)) ? " AND (name LIKE '%" .
            addslashes(trim($search['name'])) . "%')" : "";  
            $f2 = (array_key_exists('email', $search)) ? " AND (email LIKE '%" .
            addslashes(trim($search['email'])) . "%')" : "";  
            $f3 = (array_key_exists('number', $search)) ? " AND (number LIKE '%" .
            addslashes(trim($search['number'])) . "%')" : "";  
            $f4 = (array_key_exists('product', $search)) ? " AND (product LIKE '%" .
            addslashes(trim($search['product'])) . "%')" : "";  
            $f5 = (array_key_exists('reference', $search)) ? " AND (reference = '" .
            addslashes(trim($search['reference'])) . "')" : "";
            $f6 = (array_key_exists('source', $search)) ? " AND (source LIKE '%" .
            addslashes(trim($search['source'])) . "%')" : "";
            $f7 = (array_key_exists('alloted_to', $search)) ? " AND (alloted_to = '" .
                addslashes($search['alloted_to']) . "')" : "";
            $filter .= $f1 . $f2 . $f3 . $f4 . $f5 . $f6 . $f7;
         }
         return $this->whereRaw($filter)
                ->where('lead_status', 'OPEN')
                ->where('alloted_to', $auth_user_id)
                ->orderBy($orderEntity, $orderAction)
                ->skip($skip)->take($take)
                ->get($fields);
        }

        public function totalEmpOpenLead($search = null)  {
            $auth_user_id = \Auth::user()->id;
            $filter = 1; // if no search add where
    
            // when search
            if (is_array($search) && count($search) > 0) {
                $partyName = (array_key_exists('keyword', $search)) ? " AND name LIKE '%" .
                    addslashes(trim($search['keyword'])) . "%' " : "";
                $filter .= $partyName;
            }
            return $this->select(\DB::raw('count(*) as total'))
                ->where('lead_status', 'OPEN')
                ->where('alloted_to', $auth_user_id)
                ->whereRaw($filter)->first();
        }
    public function getEmpCloselead($search = null, $skip, $perPage) {
        $auth_user_id = \Auth::user()->id;
        $take = ((int)$perPage > 0) ? $perPage : 20;
        $filter = 1; // default filter if no search

        $fields = [
            'id',
            'saturation',
            'name',
            'email',
            'number',
            'product',
            'reference',
            'note',
            'source',
            'f_date',
            'lead_status',
            'alloted_to',
            'uploaded_by'
        ];

        $sortBy = [
            'name' => 'name',
        ];

         $orderEntity = 'id';
         $orderAction = 'desc';
         if (isset($search['sort_action']) && $search['sort_action'] != "") {
             $orderAction = ($search['sort_action'] == 1) ? 'desc' : 'asc';
         }

         if (isset($search['sort_entity']) && $search['sort_entity'] != "") {
             $orderEntity = (array_key_exists($search['sort_entity'], $sortBy)) ? $sortBy[$search['sort_entity']] : $orderEntity;
         }

         if (is_array($search) && count($search) > 0) { 
            $f1 = (array_key_exists('name', $search)) ? " AND (name LIKE '%" .
            addslashes(trim($search['name'])) . "%')" : "";  
            $f2 = (array_key_exists('email', $search)) ? " AND (email LIKE '%" .
            addslashes(trim($search['email'])) . "%')" : "";  
            $f3 = (array_key_exists('number', $search)) ? " AND (number LIKE '%" .
            addslashes(trim($search['number'])) . "%')" : "";  
            $f4 = (array_key_exists('product', $search)) ? " AND (product LIKE '%" .
            addslashes(trim($search['product'])) . "%')" : "";  
            $f5 = (array_key_exists('reference', $search)) ? " AND (reference = '" .
            addslashes(trim($search['reference'])) . "')" : "";
            $f6 = (array_key_exists('source', $search)) ? " AND (source LIKE '%" .
            addslashes(trim($search['source'])) . "%')" : "";
            $f7 = (array_key_exists('alloted_to', $search)) ? " AND (alloted_to = '" .
                addslashes($search['alloted_to']) . "')" : "";
            $filter .= $f1 . $f2 . $f3 . $f4 . $f5 . $f6 . $f7;
         }
         return $this->whereRaw($filter)
                ->where('lead_status', 'CLOSE')
                ->where('alloted_to', $auth_user_id)
                ->orderBy($orderEntity, $orderAction)
                ->skip($skip)->take($take)
                ->get($fields);
        }

        public function totalEmpCloseLead($search = null)  {
            $auth_user_id = \Auth::user()->id;
            $filter = 1; // if no search add where
    
            // when search
            if (is_array($search) && count($search) > 0) {
                $partyName = (array_key_exists('keyword', $search)) ? " AND name LIKE '%" .
                    addslashes(trim($search['keyword'])) . "%' " : "";
                $filter .= $partyName;
            }
            return $this->select(\DB::raw('count(*) as total'))
                ->where('lead_status', 'CLOSE')
                ->where('alloted_to', $auth_user_id)
                ->whereRaw($filter)->first();
        }


}
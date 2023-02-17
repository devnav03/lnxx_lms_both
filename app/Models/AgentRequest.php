<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class AgentRequest extends Model {

    protected $fillable = [ 
    	'salutation', 
    	'first_name', 
    	'middle_name', 
    	'last_name', 
    	'date_of_birth', 
    	'nationality', 
    	'gender', 
    	'mobile', 
    	'email', 
    	'education',
        'collage_name',
        'country_studied_in',
        'percentage_cgpa',
        'course_completion_date',
        'diploma_certifications',
        'duration_of_course',
        'education_document',
        'passport_number',
        'passport_expiry_date',
        'emirates_id_number',
        'emirates_expire_date',
        'current_position',
        'current_employer_name',
        'notice_period',
        'current_salary',
        'expected_salary',
        'resume',
    	'created_at', 
    	'updated_at',
    	'deleted_at',
    ];

    public function store($inputs, $id = null)  {
        if ($id) {
            return $this->find($id)->update($inputs);
        } else {
            return $this->create($inputs)->id;
        }
    }

    public function validate($inputs, $id = null) {
        $rules['salutation'] = 'required|string|max:25';
        $rules['first_name'] = 'required|string|max:30|regex:/^[a-zA-Z ]+$/';
        $rules['last_name'] = 'required|string|max:30|regex:/^[a-zA-Z ]+$/';
        $rules['email'] = 'required|email|max:65|unique:agent_requests';
        $rules['mobile'] = 'required|digits:9|unique:agent_requests';
        $rules['date_of_birth'] = 'required|max:20';
        // $rules['nationality'] = 'required';
        // $rules['gender'] = 'required|max:15';
        // $rules['education'] = 'required|max:40';
        // $rules['collage_name'] = 'required|max:100';
        // $rules['country_studied_in'] = 'required|max:11';
        // $rules['percentage_cgpa'] = 'required|max:5';
        // $rules['course_completion_date'] = 'required|max:20';
        // $rules['diploma_certifications'] = 'required|max:100';
        // $rules['duration_of_course'] = 'required|max:11';
        // $rules['education_document'] = 'required|max:255';
        // $rules['passport_number'] = 'required|max:20';
        // $rules['passport_expiry_date'] = 'required|max:20';
        // $rules['emirates_id_number'] = 'required|digits:15|unique:agent_requests';
        // $rules['emirates_expire_date'] = 'required|max:20';
        // $rules['current_position'] = 'max:100';
        // $rules['current_employer_name'] = 'max:120';
        // $rules['notice_period'] = 'max:11';
        // $rules['current_salary'] = 'max:11';
        // $rules['expected_salary'] = 'required|max:11';
        $rules['resume'] = 'required|max:255';
        return \Validator::make($inputs, $rules);
    }


     public function getAgentRequest($search = null, $skip, $perPage) {
        $take = ((int)$perPage > 0) ? $perPage : 20;
        $filter = 1; // default filter if no search
        $fields = [
            'id',
            'salutation',
            'first_name',
            'middle_name',
            'last_name',
            'date_of_birth',
            // 'gender',
            'email',
            'mobile',
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
            $f1 = (array_key_exists('email', $search)) ? " AND (email Like '%" .
                addslashes($search['email']) . "%')" : "";
              
            $f2 = (array_key_exists('mobile', $search)) ? " AND (mobile Like '%" .
                addslashes($search['mobile']) . "%')" : "";

            $f3 = (array_key_exists('status', $search)) ? " AND (users.status = '" .
                addslashes($search['status']) . "')" : "";
           $f4 = (array_key_exists('name', $search)) ? " AND (first_name LIKE '%" .
                addslashes(trim($search['name'])) . "%')" : "";  
            $filter .= $f1 . $f2 . $f3 . $f4;
        }
         return $this->whereRaw($filter)
                ->orderBy($orderEntity, $orderAction)
                ->skip($skip)->take($take)
                ->get($fields);
    }
 

    public function totalAgentRequest($search = null)  {
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

}

 
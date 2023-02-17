<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PreRegister extends Model {
    use SoftDeletes;
    protected $table = 'pre_registers';
   
    protected $fillable = [
        'mobile', 'mobile_otp', 'email', 'email_otp', 'salutation', 'name', 'middle_name', 'last_name', 'mobile_status', 'email_status', 'emirates_id', 'emirates_id_back', 'eid_number', 'eid_status', 
        'login_otp', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function store($inputs, $id = null)  {
        if ($id) {
            return $this->find($id)->update($inputs);
        } else {
            return $this->create($inputs)->id;
        }
    }


}

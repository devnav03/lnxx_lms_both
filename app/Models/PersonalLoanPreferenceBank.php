<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonalLoanPreferenceBank extends Model {

    protected $table = 'personal_loan_preference_bank';
   
    protected $fillable = [
       'user_id', 'bank_id', 'loan_limit', 'loan_emi', 'created_at', 'updated_at'
    ];

    public function store($inputs, $id = null) {
       // dd($inputs);
        if ($id) {
            return $this->find($id)->update($inputs);
        } else {
            return $this->create($inputs)->id;
        }
    }

}

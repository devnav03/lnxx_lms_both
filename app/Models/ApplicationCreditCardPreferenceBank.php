<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicationCreditCardPreferenceBank extends Model {

    protected $table = 'application_credit_card_preference_bank';
   
    protected $fillable = [
       'app_id', 'bank_id', 'loan_limit', 'created_at', 'updated_at'
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

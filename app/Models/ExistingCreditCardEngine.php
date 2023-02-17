<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExistingCreditCardEngine extends Model {

    protected $table = 'existing_credit_card_engines';
   
    protected $fillable = [
        'engine_id', 'bank_id', 'credit_limit', 'created_at', 'updated_at'
    ];

    public function validate($inputs, $id = null){
        $rules['title'] = 'required';
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


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicationCardTypePreference extends Model {

    protected $table = 'application_card_type_preference';
   
    protected $fillable = [
       'app_id', 'type_id', 'created_at', 'updated_at'
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

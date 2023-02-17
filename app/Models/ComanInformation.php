<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ComanInformation extends Model {
	
    protected $fillable = [ 
    	'user_id', 
    	'spouse_live_in_uae', 
    	'spouse_working', 
    	'children_in_the_uae', 
        'in_school', 
        'vehicle_in_uae', 
        'favorite_city', 
        'account_number', 
        'bank_name', 
        'iban_number', 
        'multi_nationality_name', 
        'multi_passport_number', 
        'created_at', 
        'updated_at' 
    ];

    public function store($inputs, $id = null) {
        if ($id){
            return $this->find($id)->update($inputs);
        } else {
            return $this->create($inputs)->id;
        }
    }


}

 
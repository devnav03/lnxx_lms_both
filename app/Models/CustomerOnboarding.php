<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CustomerOnboarding extends Model
{
    protected $fillable = [
    	'user_id', 
    	'salutation', 
    	'last_name', 
    	'cm_type', 
    	'first_name_as_per_passport',  
    	'nationality', 
    	'visa_number', 
    	'date_of_birth', 
    	'marital_status', 
    	'years_in_uae', 
    	'passport_photo', 
    	'agent_reference', 
    	'reference_number', 
    	'wedding_anniversary_date', 
    	'wife_name', 
    	'officer_email', 
    	'eid_number', 
    	'passport_expiry_date', 
    	'passport_number', 
    	'ref_id', 
    	'consent_form', 
    	'created_at', 
    	'no_of_dependents', 
    	'video', 
    	'aecb_date', 
    	'credit_score', 
    	'aecb_image', 
    	'spouse_date_of_birth', 
    	'updated_at'
    ];

    public function store($inputs, $id = null)  {
        if ($id) {
            return $this->find($id)->update($inputs);
        } else {
            return $this->create($inputs)->id;
        }
    }

}


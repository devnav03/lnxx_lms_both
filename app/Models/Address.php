<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Address extends Model
{
    protected $fillable = [ 
    	'customer_id', 
    	'residential_address_line_1', 
    	'residential_address_line_2', 
    	'residential_address_line_3', 
    	'residential_address_nearest_landmark',
		'residential_emirate', 
		'residential_po_box', 
		'resdence_type', 
		'annual_rent', 
		'duration_at_current_address', 
		'company_name', 
		'company_phone_no', 
		'company_address_line_1', 
		'company_address_line_2', 
		'company_address_line_3', 
		'company_po_box', 
		'company_emirate', 
		'permanent_address_home_country_line_1', 
		'permanent_address_home_country_line_2', 
		'permanent_address_home_country_line_3', 
		'permanent_address_country', 
		'permanent_address_city', 
		'permanent_address_zipcode', 
		'permanent_addresstel_with_idd_code', 
		'mailing_po_box',
		'mailing_address_line',
		'mailing_emirate',
		'preferred_mailing_address',
		'preferred_statement_mode',
		'preferred_contact_number',
		'created_at', 
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

 
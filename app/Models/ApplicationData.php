<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ApplicationData extends Model {
	
    protected $fillable = [ 
    	'app_id', 
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
        'permanent_address_home_country_line_1', 
        'permanent_address_home_country_line_2', 
	    'permanent_address_home_country_line_3', 
	    'permanent_address_zipcode', 
	    'permanent_home_country_emirates', 
	    'permanent_home_country_po_box', 
	    'permanent_address_country', 
        'permanent_address_city',
        'permanent_addresstel_with_idd_code',
	    'residential_address_line_1', 
	    'residential_address_line_2', 
	    'residential_address_line_3', 
	    'residential_address_buliding_name', 
	    'residential_address_street_name', 
	    'residential_address_nearest_landmark', 
        'residential_emirate',
	    'residential_po_box', 
	    'office_address_office_address_building_name', 
	    'office_address_street_name', 
	    'office_address_office_address_nearest', 
	    'office_emirate',
	    'office_po_box', 
	    'mailing_address_line', 
        'annual_rent',
	    'mailing_po_box', 
        'mailing_emirate',
        'company_name',
	    'duration_at_current_address',
	    'company_address_line_1',
	    'company_address_line_2',
        'company_address_line_3',
        'company_po_box',
        'company_phone_no',
        'company_emirate',
        'resdence_type',
        'preferred_mailing_address',
        'preferred_statement_mode',
        'preferred_contact_number',
        'card_type',
        'embossing_name',
        'cm_billing_cycle_date',
        'e_statement_subscription',
        'paper_statement_subscription',
        'supplementary_salutation',
        'supplementary_relationship',
        'supplementary_first_name',
        'supplementary_middle_name',
        'supplementary_last_name',
        'supplementary_embosing_name',
        'supplementary_nationality',
        'supplementary_passport_no',
        'supplementary_credit_limit_aed',
        'supplementary_marital_status',
        'supplementary_mother_maiden_name',
        'no_sign_up_credit_shield',
        'sign_up_credit_shield_plus',
        'master_murabaha_agreement',
        'kyc_docs',
        'kyc_docs2',
        'kyc_docs3',
        'kyc_docs4',
        'education',
        'primary_school',
        'high_school',
        'graduate',
        'postgraduate',
        'others',
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











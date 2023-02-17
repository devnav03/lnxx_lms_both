<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CreditCardInformation extends Model {
	
    protected $fillable = [ 
        'user_id', 
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
        'created_at', 
        'updated_at' 
    ];

    public function store($inputs, $id = null)  {
        if ($id){
            return $this->find($id)->update($inputs);
        } else {
            return $this->create($inputs)->id;
        }
    }

}

 
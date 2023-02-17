<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function CustomerOnboarding(Request $request){
        $required=[
            'gender','name_as_per_passport','embossing_name','mother_maiden_name','nationality',
            'have_passport','passport_number','passport_expiry_date','have_visa','visa_sponsor',
            'visa_number','visa_expiry_date','marital_status','years_in_uae','favorite_city',
            'id_type','idbarah_no','required_credit_card_limit','does_your_spouse_live_in_uae',
            'have_children_in_uae','children_are','own_vehicle_in_uae','vehicle_model','education_id',
            'own_house_cuntry','country_of_origin','preferred_language','permanent_address_city',
            'duration_at_current_address','permanent_address_country','permanent_address_zipcode'
        ];
        $this->ApiValidate($required);
    }
    public function ApiValidate($required){
        foreach ($required as $key => $value) {
            if(empty($request[$value])) {
                $dataresponce=['Api_status'=>400,'msg'=> $value.' (POST) value is missing'];
                return response()->json($dataresponce, 200);exit;
            }
        }
    }
}
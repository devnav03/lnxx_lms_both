<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::any('v1/enter-mobile', ['as' => 'enter-mobile','uses' => 'App\Http\Controllers\API\V1\UserController@register']);
Route::any('v1/mobile-verify', ['as' => 'mobile-verify','uses' => 'App\Http\Controllers\API\V1\UserController@mobile_verify']);
Route::any('v1/enter-email', ['as' => 'enter-email','uses' => 'App\Http\Controllers\API\V1\UserController@email_register']);
Route::any('v1/email-verify', ['as' => 'email-verify','uses' => 'App\Http\Controllers\API\V1\UserController@email_verify']);
Route::any('v1/sign-up', ['as' => 'sign-up','uses' => 'App\Http\Controllers\API\V1\UserController@sign_up']);

Route::any('v1/login', ['as' => 'login','uses' => 'App\Http\Controllers\API\V1\UserController@login']);
Route::any('v1/login-otp', ['as' => 'login-otp','uses' => 'App\Http\Controllers\API\V1\UserController@login_otp']);
Route::any('v1/profile', ['as' => 'profile','uses' => 'App\Http\Controllers\API\V1\UserController@profile']);
Route::any('v1/update-profile', ['as' => 'update-profile','uses' => 'App\Http\Controllers\API\V1\UserController@updateProfile']);
Route::any('v1/logout', ['as' => 'logout','uses' => 'App\Http\Controllers\API\V1\UserController@logout']);  
Route::any('v1/basic-information', ['as' => 'basic-information','uses' => 'App\Http\Controllers\API\V1\UserController@basic_information']);
Route::any('v1/show-basic-information', ['as' => 'show-basic-information','uses' => 'App\Http\Controllers\API\V1\UserController@show_basic_information']);
Route::any('v1/show-cm-details', ['as' => 'show-cm-details','uses' => 'App\Http\Controllers\API\V1\UserController@show_cm_details']);
Route::any('v1/save-cm-details', ['as' => 'save-cm-details','uses' => 'App\Http\Controllers\API\V1\UserController@save_cm_details']);
Route::any('v1/service-list', ['as' => 'service-list','uses' => 'App\Http\Controllers\API\V1\UserController@service_list']);
Route::any('v1/education-details', ['as' => 'education-details','uses' => 'App\Http\Controllers\API\V1\UserController@education_details']);
Route::any('v1/education-details-save', ['as' => 'education-details-save','uses' => 'App\Http\Controllers\API\V1\UserController@education_details_save']);
Route::any('v1/address-detail', ['as' => 'address-detail','uses' => 'App\Http\Controllers\API\V1\UserController@address_details']);
Route::any('v1/address-details-save', ['as' => 'address-details-save','uses' => 'App\Http\Controllers\API\V1\UserController@address_details_save']);

Route::any('v1/select-service', ['as' => 'select-service','uses' => 'App\Http\Controllers\API\V1\UserController@select_services']);

Route::any('v1/country', ['as' => 'country','uses' => 'App\Http\Controllers\API\V1\UserController@country']);

Route::any('v1/emirates-id', ['as' => 'emirates-id','uses' => 'App\Http\Controllers\API\V1\UserController@emirates_id']);

Route::any('v1/profile-image', ['as' => 'profile-image','uses' => 'App\Http\Controllers\API\V1\UserController@profile_image']);

Route::any('v1/selected-services', ['as' => 'selected-services','uses' => 'App\Http\Controllers\API\V1\UserController@selected_services']);
Route::any('v1/save-product-requested', ['as' => 'save-product-requested','uses' => 'App\Http\Controllers\API\V1\UserController@save_product_requested']);
Route::any('v1/show-product-requested', ['as' => 'show-product-requested','uses' => 'App\Http\Controllers\API\V1\UserController@show_product_requested']);
Route::any('v1/upload-video', ['as' => 'upload-video','uses' => 'App\Http\Controllers\API\V1\UserController@upload_video']);
Route::any('v1/consent-form-status', ['as' => 'consent-form-status','uses' => 'App\Http\Controllers\API\V1\UserController@consent_form_status']);
	
Route::any('v1/bank-list', ['as' => 'bank-list','uses' => 'App\Http\Controllers\API\V1\UserController@bank_list']);
Route::any('v1/company-list', ['as' => 'company-list','uses' => 'App\Http\Controllers\API\V1\UserController@company_list']);
Route::any('v1/verify-emirate-id', ['as' => 'verify-emirate-id','uses' => 'App\Http\Controllers\API\V1\UserController@verify_emirates']);
Route::any('v1/verify-emirate', ['as' => 'verify-emirate','uses' => 'App\Http\Controllers\API\V1\UserController@verify_emirate']);
Route::any('v1/my-relations', ['as' => 'my-relations','uses' => 'App\Http\Controllers\API\V1\UserController@my_relations']);
Route::any('v1/bank-preference', ['as' => 'bank-preference','uses' => 'App\Http\Controllers\API\V1\UserController@bank_preference']);
Route::any('v1/save-bank-preference', ['as' => 'save-bank-preference','uses' => 'App\Http\Controllers\API\V1\UserController@save_bank_preference']);
Route::any('v1/skip-video', ['as' => 'skip-video','uses' => 'App\Http\Controllers\API\V1\UserController@skipVideo']);
Route::any('v1/refer-friend', ['as' => 'refer-friend','uses' => 'App\Http\Controllers\API\V1\UserController@refer_friend']);
Route::any('v1/save-agent-information', ['as' => 'save-agent-information','uses' => 'App\Http\Controllers\API\V1\UserController@save_agent_information']);
Route::any('v1/cms-content', ['as' => 'cms-content','uses' => 'App\Http\Controllers\API\V1\UserController@cms_content']);
Route::any('v1/save-credit-card-informations', ['as' => 'save-credit-card-informations','uses' => 'App\Http\Controllers\API\V1\UserController@save_credit_card_information']);
Route::any('v1/show-credit-card-information', ['as' => 'show-credit-card-information','uses' => 'App\Http\Controllers\API\V1\UserController@show_credit_card_information']);
Route::any('v1/save-coman-information-form', ['as' => 'save-coman-information-form','uses' => 'App\Http\Controllers\API\V1\UserController@save_coman_information_form']);
Route::any('v1/show-coman-information-form', ['as' => 'show-coman-information-form','uses' => 'App\Http\Controllers\API\V1\UserController@show_coman_information_form']);
Route::any('v1/save-personal-loan-informations', ['as' => 'save-personal-loan-informations','uses' => 'App\Http\Controllers\API\V1\UserController@save_personal_loan_informations']);
Route::any('v1/show-personal-loan-informations', ['as' => 'show-personal-loan-informations','uses' => 'App\Http\Controllers\API\V1\UserController@show_personal_loan_informations']);
Route::any('v1/card-type-list', ['as' => 'card-type-list','uses' => 'App\Http\Controllers\API\V1\UserController@card_type_list']);
Route::any('v1/credit-dbr-calculation', ['as' => 'credit-dbr-calculation','uses' => 'App\Http\Controllers\API\V1\UserController@credit_dbr_calculation']);

Route::any('v1/save-personal-loan-bank-preference', ['as' => 'save-personal-loan-bank-preference','uses' => 'App\Http\Controllers\API\V1\UserController@save_personal_loan_bank_preference']);
Route::any('v1/personal-loan-bank-list', ['as' => 'personal-loan-bank-list','uses' => 'App\Http\Controllers\API\V1\UserController@personal_loan_bank_list']);

Route::any('v1/profile-score', ['as' => 'profile-score','uses' => 'App\Http\Controllers\API\V1\UserController@profile_score']);

Route::any('v1/inert-user', ['as' => 'inert-user','uses' => 'App\Http\Controllers\API\V1\UserController@inert_user']);




















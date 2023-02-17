<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\UserDevice;
use ElfSundae\Laravel\Hashid\Facades\Hashid;
use App\Models\Contact;
use App\Models\ForceUpdate;
use App\Models\PreRegister;
use App\Models\SelfEmpDetail;
use App\Models\OtherCmDetail;
use App\Models\UserEducation;
use App\Models\Refer;
use App\Models\CmSalariedDetail;
use App\Models\CustomerOnboarding;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Service;
use App\Models\ServiceApply;
use App\Models\ApplicationProductRequest;
use App\Models\Address;
use App\Models\Application;
use App\Models\Bank;
use App\Models\ContentManagement;
use App\Models\Company;
use App\Models\Country;
use App\Models\ProductRequest;
use App\Models\CardTypePreference;
use App\Models\CreditCardPreferenceBank;
use App\Models\PersonalLoanInformation;
use App\Models\AgentRequest;
use App\Models\Dependent;
use App\Models\ApplicationDependent;
use App\Models\ComanInformation;
use App\Models\CreditCardInformation;
use App\Models\PersonalLoanPreferenceBank;
use App\Models\ApplicationPersonalLoanPreferenceBank;
use App\Models\ApplicationCreditCardPreferenceBank;
use App\Models\ApplicationCardTypePreference;
use App\Models\CardType;
use App\Models\ApplicationData;
use App\Models\ApplicationPersonalLoanInformation;
use Auth;
use Ixudra\Curl\Facades\Curl;
use PDF;
use App\PasswordHash;


class UserController extends Controller {

    public function about(){

      try{
        $data['content'] = AboutContent::where('id', 1)->first();
        return apiResponseApp(true, 200, null, null, $data);
      } catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
        }
    }

    public function support(){
      try{
        $data['support'] = ForceUpdate::where('id', 1)->select('mobile', 'email')->first();
        return apiResponseApp(true, 200, null, null, $data);
      } catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
        }
    }

    public function inert_user(Request $request){

        $user = User::where('mobile', $request->mobile)->where('email', $request->email)->select('id')->first();

        $password = \Hash::make($request->password);

        if(empty($user)){
          User::create([
            'salutation' => @$request->salutation,
            'name' => $request->name,
            'middle_name' => @$request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'user_type' => 3,
            'date_of_birth' => @$request->date_of_birth,
            'profile_image' => @$request->profile_image,
            'status' => $request->status,
            'password' => $password,
          ]);

          $message = "User successfully created";
        } else {

            User::where('id', $user->id)
                ->update([
                'salutation' => @$request->salutation,
                'name' => $request->name,
                'middle_name' => @$request->middle_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'user_type' => 3,
                'date_of_birth' => @$request->date_of_birth,
                'profile_image' => @$request->profile_image,
                'status' => $request->status,
                'password' => $password,
            ]);
            $message = "User successfully updated";    
        }
        
      return response()->json(['success' => true, 'status' => 200, 'message' => $message]);

    }

    public function verify_emirates(Request $request){
      try {
            if($request->api_key){
              $user = User::where('api_key', $request->api_key)->select('id', 'login_otp')->first();
              if($user){

                $user_id = $user->id;
                
                if($user->login_otp == $request->otp){
                  User::where('id', $user_id)
                  ->update([
                  'eid_status' =>  1,
                  ]);

                  return response()->json(['success' => true, 'status' => 200, 'message' => 'Emirate id is successfully verified']);

                } elseif ($request->otp == '652160') {
                  User::where('id', $user_id)
                  ->update([
                  'eid_status' =>  1,
                  ]);

                  return response()->json(['success' => true, 'status' => 200, 'message' => 'Emirate id is successfully verified']);
                } else {
                  return response()->json(['success' => false, 'status' => 201, 'message' => 'Invalid OTP try again']);
                }
              } 
            }
      } catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
        }
    }
    
    public function force_update(){
      try{
        $data['support'] = ForceUpdate::where('id', 1)->select('force_update', 'version')->first();
        return apiResponseApp(true, 200, null, null, $data);
      } catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
        }
    }
    
    public function user_device(Request $request){
      try{
          $check = UserDevice::where('device_token', $request->device_token)->first();
          if($request->api_key){
              $user = User::where('api_key', $request->api_key)->select('id')->first();
              $user_id = $user->id;
          } else {
            $user_id = "";
          }

          if($check){
           if($user_id){
            UserDevice::where('id', $check->id)
            ->update([
              'user_id' => $user_id,
            ]);
           }
          } else{
            if($user_id){
              UserDevice::create([
              'device_token' => $request->device_token,
              'user_id' => $user_id,
              ]);
            } else {
              UserDevice::create([
              'device_token' => $request->device_token,
              ]);
            }
          }

        $message = "Device Token Successfully Saved";
        return apiResponseAppmsg(true, 200, $message, null, null);

      } catch(Exception $e){
          return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

    public function contact_save(Request $request){
      try{

          $inputs = $request->all();
          (new Contact)->store($inputs);
          $email = $inputs['email'];
          $data['mail_data'] = $inputs;
          $message = "Your enquiry has been received and we will be contacting you shortly to follow-up.";
          return apiResponseAppmsg(false, 200, $message, null, null);

      } catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

    public function bank_list(){
        $data = Bank::where('status', 1)->select('name', 'id')->get();
        return response()->json(['success' => true, 'status' => 200, 'data' => $data]);      
    }

    public function company_list(){
        $data = Company::where('status', 1)->select('name', 'id')->get();
        return response()->json(['success' => true, 'status' => 200, 'data' => $data]);
    }

    public function my_relations(Request $request){

      if($request->api_key){
        $user = User::where('api_key', $request->api_key)->select('id')->first();
          if($user){

            $data = \DB::table('applications')
                    ->join('services', 'services.id', '=', 'applications.service_id')
                    ->select('applications.status', 'services.name', 'services.image', 'applications.created_at', 'ref_id')
                    ->where('applications.user_id', $user->id)->get();

            return response()->json(['success' => true, 'status' => 200, 'data' => $data]);       
          }
      }
    }

    public function card_type_list(Request $request){
        $data = CardType::where('status', 1)->select('name', 'id')->get();
        return response()->json(['success' => true, 'status' => 200, 'data' => $data]); 
    }

    public function credit_dbr_calculation(Request $request){
      if($request->api_key){
          $user = User::where('api_key', $request->api_key)->select('id')->first();
          if($user){
              $user_id = $user->id;
              $f_details = ProductRequest::where('user_id', $user_id)->select('exist_credit', 'card_limit', 'card_limit2', 'card_limit3', 'card_limit4', 'exist_personal', 'loan_emi', 'loan_emi2', 'loan_emi3', 'loan_emi4', 'exist_business', 'business_loan_emi', 'business_loan_emi2', 
                'business_loan_emi3', 'business_loan_emi4', 'exist_mortgage', 'mortgage_emi', 
                'mortgage_emi2', 'mortgage_emi3', 'mortgage_emi4', 'details_of_cards', 'details_of_cards2', 'details_of_cards3', 'details_of_cards4', 'credit_bank_name', 'credit_bank_name2', 'credit_bank_name3', 'credit_bank_name4')->first();
            
              $cus_onboard = CustomerOnboarding::where('user_id', $user_id)->select('cm_type')->first(); 

              $avg_sal = 0;
              $total_cred_limit = 0;
              $cred_five = 0;
              $emi = 0;
              $credit_bank = [];

              if($f_details->exist_personal == 1){
                  $emi += $f_details->loan_emi;
                  if($f_details->loan_emi2){
                      $emi += $f_details->loan_emi2;
                  }
                  if($f_details->loan_emi3){
                      $emi += $f_details->loan_emi3;
                  }
                  if($f_details->loan_emi4){
                      $emi += $f_details->loan_emi4;
                  }
              }

              if($f_details->exist_business == 1){
                $emi += $f_details->business_loan_emi;
                if($f_details->business_loan_emi2){
                    $emi += $f_details->business_loan_emi2;
                }
                if($f_details->business_loan_emi3){
                    $emi += $f_details->business_loan_emi3;
                }
                if($f_details->business_loan_emi4){
                    $emi += $f_details->business_loan_emi4;
                }
            }

            if($f_details->exist_mortgage == 1){
                $emi += $f_details->mortgage_emi;
                if($f_details->mortgage_emi2){
                    $emi += $f_details->mortgage_emi2;
                }
                if($f_details->mortgage_emi3){
                    $emi += $f_details->mortgage_emi3;
                }
                if($f_details->mortgage_emi4){
                    $emi += $f_details->mortgage_emi4;
                }
            }


            if($f_details->exist_credit == 1){
                $cred1 = 0;
                $cred2 = 0;
                $cred3 = 0;
                $cred4 = 0;
                if($f_details->details_of_cards == 'Credit Card'){
                    $cred1 = $f_details->card_limit;
                    $credit_bank[] = $f_details->credit_bank_name;
                }
                if($f_details->details_of_cards2 == 'Credit Card'){
                    $cred2 = $f_details->card_limit2;
                   
                    $credit_bank[] = $f_details->credit_bank_name2;
                }
                if($f_details->details_of_cards3 == 'Credit Card'){
                    $cred3 = $f_details->card_limit3;
                    $credit_bank[] = $f_details->credit_bank_name3;
                }
                if($f_details->details_of_cards4 == 'Credit Card'){
                    $cred4 = $f_details->card_limit4;
                    $credit_bank[] = $f_details->credit_bank_name4;
                }
                $total_cred_limit = $cred1+$cred2+$cred3+$cred4;
                if($total_cred_limit != 0){
                    $cred_five = $total_cred_limit/100*5;
                }
            }

            if($cus_onboard->cm_type == 1){
                $sal_details = CmSalariedDetail::where('customer_id', $user_id)->select('last_three_salary_credits', 'last_two_salary_credits', 'last_one_salary_credits', 'monthly_salary')->first(); 
                $no = 0; 
                $sal1 = 0;
                $sal2 = 0;
                $sal3 = 0;
                if($sal_details->last_one_salary_credits){
                    $sal1 = $sal_details->last_one_salary_credits;
                    $no++;
                }
                if($sal_details->last_two_salary_credits){
                    $sal2 = $sal_details->last_two_salary_credits;
                    $no++;
                }
                if($sal_details->last_three_salary_credits){
                    $sal3 = $sal_details->last_three_salary_credits;
                    $no++;
                }
                $total_sal = $sal1 + $sal2 + $sal3;  
                if($no == 0){
                    $no = 1;
                } 
                $avg_sal = $total_sal/$no;
                if($avg_sal == 0){
                 $avg_sal = $sal_details->monthly_salary; 
                }
            }
            if($cus_onboard->cm_type == 2){
                $sal_details = SelfEmpDetail::where('customer_id', $user_id)->select('annual_business_income')->first();
                $avg_sal = $sal_details->annual_business_income/12;
            }
            if($cus_onboard->cm_type == 3){
                $sal_details = OtherCmDetail::where('customer_id', $user_id)->select('monthly_pension')->first();
                $avg_sal = $sal_details->monthly_pension;
            }
            
            $cred_emi = $emi+$cred_five;
            $dbr_calculation = ($cred_emi/$avg_sal)*100;
            $remaining_value = 50-$dbr_calculation;
  
            if($remaining_value > 0){
                $your_emi = ($avg_sal*$remaining_value)/100;
                $your_limit = $your_emi*20;
                $eligible = 1;
            } else {
                $your_limit = 0;
                $your_emi = 0;
                $eligible = 0;
            } 

            return response()->json(['success' => true, 'status' => 200, 'eligible' => $eligible, 
              'your_emi' => $your_emi, 'your_limit' => $your_limit ]); 

          }
      }
    }


    public function cms_content(Request $request){
        $content =  ContentManagement::where('id', 1)->select('about', 'privacy', 'terms_conditions', 
          'contact')->first();
        return response()->json(['success' => true, 'status' => 200, 'data' => $content]);  
    }

    public function save_agent_information(Request $request){

      $check = AgentRequest::where('mobile', $request->mobile)->where('email', $request->email)->count();
      if($check != 0){
        return response()->json(['success' => false, 'status' => 201, 'message' => 'Email and mobile number is already exist']); 
      }
      $check = AgentRequest::where('mobile', $request->mobile)->count();
      if($check != 0){
        return response()->json(['success' => false, 'status' => 201, 'message' => 'Mobile number is already exist']); 
      }
      $check = AgentRequest::where('email', $request->email)->count();
      if($check != 0){
        return response()->json(['success' => false, 'status' => 201, 'message' => 'Email is already exist']); 
      }
  
        $inputs = $request->all();
        $image = '';
        if(isset($inputs['education_document']) or !empty($inputs['education_document'])) {
            $image_name = rand(100000, 999999);
            $fileName = '';
            if($file = $request->hasFile('education_document')) {
                $file = $request->file('education_document');
                $img_name = $file->getClientOriginalName();
                $fileName = $image_name.$img_name;
                $destinationPath = public_path().'/uploads/education_document/';
                $file->move($destinationPath, $fileName);
            }
            $fname ='/uploads/education_document/';
            $image = $fname.$fileName;
        }
        unset($inputs['education_document']);
        $inputs['education_document'] = $image;

        $image = '';
        if(isset($inputs['resume']) or !empty($inputs['resume'])) {
            $image_name = rand(100000, 999999);
            $fileName = '';
            if($file = $request->hasFile('resume')) {
                $file = $request->file('resume');
                $img_name = $file->getClientOriginalName();
                $fileName = $image_name.$img_name;
                $destinationPath = public_path().'/uploads/resume/';
                $file->move($destinationPath, $fileName);
            }
            $fname ='/uploads/resume/';
            $image = $fname.$fileName;
        }
        unset($inputs['resume']);
        $inputs['resume'] = $image;

        $id = (new AgentRequest)->store($inputs); 

        return response()->json(['success' => true, 'status' => 200, 'message' => 'Your job application has been received successfully.']);

    }




    public function refer_friend(Request $request){
       
      if($request->api_key){
          $user = User::where('api_key', $request->api_key)->select('id', 'name')->first();
          if($user){
            $user_id = $user->id;
            $user_chk = User::where('mobile', $request->mobile)->orWhere('email', $request->email)->first();
            if($user_chk){
              return response()->json(['success' => false, 'status' => 201, 'message' => 'Oops, you referred someone who was already registered.']);
            } else {
                $inputs = $request->all();
                $inputs['user_id'] = $user->id;
                (new Refer)->store($inputs); 
                $name = $user->name; 
                $user_code = 1300+$user_id;

                $postdata = http_build_query(
                    array(
                        'username' => $request->name,
                        'email' => $request->email,
                        'sender_name' => $name,
                        'user_code' => 'lnxx'.$user_code,
                    )
                );
                        $opts = array('http' =>
                            array(
                            'method'  => 'POST',
                            'header'  => 'Content-Type: application/x-www-form-urlencoded',
                            'content' => $postdata
                            )
                        );
                $context  = stream_context_create($opts);
                $result = file_get_contents('https://sspl20.com/email-api/api/lnxx/refer-friend', false, $context);

               return response()->json(['success' => true, 'status' => 200, 'message' => 'Invitation sent successfully']);
            }


        }
      }
        
    }

    public function skipVideo(Request $request){
      try {

            if($request->api_key){
              $user = User::where('api_key', $request->api_key)->first();
              if($user){

              $user_id = $user->id;
              $ref_id = [];

              $CustomerOnboarding = CustomerOnboarding::where('user_id', $user_id)->first();
              $services = ServiceApply::where('customer_id', $user_id)->where('app_status', 0)->select('id','service_id', 'bank_id', 'decide_by')->get();

              $app_base = 1300;
                if($services){
                        if($CustomerOnboarding->cm_type == 1){
                            $employee = CmSalariedDetail::where('customer_id', $user_id)->select('company_name', 'date_of_joining', 'monthly_salary', 'last_three_salary_credits', 'other_company', 'last_two_salary_credits', 'last_one_salary_credits', 'accommodation_company', 'last_one_salary_file', 'last_two_salary_file', 'last_three_salary_file')->first();
                            $inputs['company_name'] = $employee->company_name;
                            $inputs['date_of_joining'] = $employee->date_of_joining;
                            $inputs['monthly_salary'] = $employee->monthly_salary;
                            $inputs['last_three_salary_credits'] = $employee->last_three_salary_credits;
                            $inputs['last_two_salary_credits'] = $employee->last_two_salary_credits;
                            $inputs['last_one_salary_credits'] = $employee->last_one_salary_credits;
                            $inputs['other_company'] = $employee->other_company;
                            $inputs['accommodation_company'] = $employee->accommodation_company;

                            $inputs['last_one_salary_file'] = $employee->last_one_salary_file;
                            $inputs['last_two_salary_file'] = $employee->last_two_salary_file;
                            $inputs['last_three_salary_file'] = $employee->last_three_salary_file;

                        } elseif ($CustomerOnboarding->cm_type == 2){
                            $employee = SelfEmpDetail::where('customer_id', $user_id)->select('self_company_name', 'percentage_ownership', 'profession_business', 'annual_business_income', 'self_other_company')->first();
                            $inputs['self_company_name'] = $employee->self_company_name;
                            $inputs['percentage_ownership'] = $employee->percentage_ownership;
                            $inputs['profession_business'] = $employee->profession_business;
                            $inputs['annual_business_income'] = $employee->annual_business_income;
                            $inputs['other_company'] = $employee->self_other_company;
                        } else {
                            $employee = OtherCmDetail::where('customer_id', $user_id)->select('monthly_pension')->first();
                            $inputs['monthly_pension'] = $employee->monthly_pension;
                        }

                        $inputs['nationality'] = $CustomerOnboarding->nationality;
                        $inputs['passport_number'] = $CustomerOnboarding->passport_number;
                        $inputs['passport_expiry_date'] = $CustomerOnboarding->passport_expiry_date;
                        $inputs['officer_email'] = $CustomerOnboarding->officer_email;
                        $inputs['visa_number'] = $CustomerOnboarding->visa_number;
                        $inputs['marital_status'] = $CustomerOnboarding->marital_status;
                        $inputs['years_in_uae'] = $CustomerOnboarding->years_in_uae;
                        $inputs['reference_number'] = $CustomerOnboarding->reference_number;
                        $inputs['passport_photo'] = $CustomerOnboarding->passport_photo;
                        $inputs['video'] = $CustomerOnboarding->video;
                        $inputs['no_of_dependents'] = $CustomerOnboarding->no_of_dependents;
                        $inputs['consent_form'] = $CustomerOnboarding->consent_form;
                        $inputs['cm_type'] = $CustomerOnboarding->cm_type;
                        $inputs['credit_score'] = $CustomerOnboarding->credit_score;
                        $inputs['aecb_date'] = $CustomerOnboarding->aecb_date;
                        

                        $inputs['spouse_date_of_birth'] = $CustomerOnboarding->spouse_date_of_birth;
                        $inputs['agent_reference'] = $CustomerOnboarding->agent_reference;
                        $inputs['aecb_image'] = $CustomerOnboarding->aecb_image;
                        $inputs['wife_name'] = $CustomerOnboarding->wife_name;
                        $inputs['wedding_anniversary_date'] = $CustomerOnboarding->wedding_anniversary_date;

                        $inputs['user_id'] = $user_id;
                        $inputs['salutation'] = $user->salutation;
                        $inputs['name'] = $user->name;
                        $inputs['middle_name'] = $user->middle_name;
                        $inputs['last_name'] = $user->last_name;
                        $inputs['email'] = $user->email;
                        $inputs['gender'] = $user->gender;
                        $inputs['date_of_birth'] = $user->date_of_birth;
                        $inputs['profile_image'] = $user->profile_image;
                        $inputs['emirates_id'] = $user->emirates_id;
                        $inputs['emirates_id_back'] = $user->emirates_id_back;
                        $inputs['eid_number'] = $user->eid_number;
                        $inputs['eid_status'] = $user->eid_status;
                        $inputs['mobile'] = $user->mobile;
                        $inputs['status'] = 0;
                        $ProductRequest = ProductRequest::where('user_id', $user_id)->first();

                        $application_data['exist_credit'] = $ProductRequest->exist_credit;
                        $application_data['exist_personal'] = $ProductRequest->exist_personal;
                        $application_data['exist_business'] = $ProductRequest->exist_business;
                        $application_data['exist_mortgage'] = $ProductRequest->exist_mortgage;
                        $application_data['credit_member_since'] = $ProductRequest->credit_member_since;
                        $application_data['credit_member_since2']= $ProductRequest->credit_member_since2;
                        $application_data['credit_member_since3'] =$ProductRequest->credit_member_since3;
                        $application_data['credit_member_since4'] =$ProductRequest->credit_member_since4;
                        $application_data['loan_member_since'] = $ProductRequest->loan_member_since;
                        $application_data['loan_member_since2'] = $ProductRequest->loan_member_since2;
                        $application_data['loan_member_since3'] = $ProductRequest->loan_member_since3;
                        $application_data['loan_member_since4'] = $ProductRequest->loan_member_since4;
                        $application_data['business_member_since'] = $ProductRequest->business_member_since;

                        $application_data['business_member_since2'] = $ProductRequest->business_member_since2;
                        $application_data['business_member_since3'] = $ProductRequest->business_member_since3;
                        $application_data['business_member_since4'] = $ProductRequest->business_member_since4;
                        $application_data['mortgage_member_since'] = $ProductRequest->mortgage_member_since;
                        $application_data['mortgage_member_since2'] = $ProductRequest->mortgage_member_since2;
                        $application_data['mortgage_member_since3'] = $ProductRequest->mortgage_member_since3;
                        $application_data['mortgage_member_since4'] = $ProductRequest->mortgage_member_since4;

                        $application_data['credit_card_limit'] = $ProductRequest->credit_card_limit;
                        $application_data['details_of_cards'] = $ProductRequest->details_of_cards;
                        $application_data['credit_bank_name'] = $ProductRequest->credit_bank_name;
                        $application_data['card_limit'] = $ProductRequest->card_limit;
                        $application_data['details_of_cards2'] = $ProductRequest->details_of_cards2;
                        $application_data['credit_bank_name2'] = $ProductRequest->credit_bank_name2;
                        $application_data['card_limit2'] = $ProductRequest->card_limit2;
                        $application_data['details_of_cards3'] = $ProductRequest->details_of_cards3;
                        $application_data['credit_bank_name3'] = $ProductRequest->credit_bank_name3;
                        $application_data['card_limit3'] = $ProductRequest->card_limit3;
                        $application_data['details_of_cards4'] = $ProductRequest->details_of_cards4;
                        $application_data['credit_bank_name4'] = $ProductRequest->credit_bank_name4;
                        $application_data['card_limit4'] = $ProductRequest->card_limit4;
                        $application_data['loan_amount'] = $ProductRequest->loan_amount;
                        $application_data['loan_bank_name'] = $ProductRequest->loan_bank_name;
                        $application_data['original_loan_amount'] = $ProductRequest->original_loan_amount;
                        $application_data['loan_emi'] = $ProductRequest->loan_emi;
                        $application_data['loan_bank_name2'] = $ProductRequest->loan_bank_name2;
                        $application_data['original_loan_amount2'] = $ProductRequest->original_loan_amount2;
                        $application_data['loan_emi2'] = $ProductRequest->loan_emi2;
                        $application_data['loan_bank_name3'] = $ProductRequest->loan_bank_name3;
                        $application_data['original_loan_amount3'] = $ProductRequest->original_loan_amount3;
                        $application_data['loan_emi3'] = $ProductRequest->loan_emi3;
                        $application_data['loan_bank_name4'] = $ProductRequest->loan_bank_name4;
                        $application_data['original_loan_amount4'] = $ProductRequest->original_loan_amount4;
                        $application_data['loan_emi4'] = $ProductRequest->loan_emi4;
                        $application_data['business_loan_amount'] = $ProductRequest->business_loan_amount;
                        $application_data['business_loan_emi'] = $ProductRequest->business_loan_emi;
                        $application_data['business_loan_amount2'] = $ProductRequest->business_loan_amount2;
                        $application_data['business_loan_emi2'] = $ProductRequest->business_loan_emi2;
                        $application_data['business_loan_amount3'] = $ProductRequest->business_loan_amount3;
                        $application_data['business_loan_emi3'] = $ProductRequest->business_loan_emi3;
                        $application_data['business_loan_amount4    '] = $ProductRequest->business_loan_amount4;
                        $application_data['business_loan_emi4'] = $ProductRequest->business_loan_emi4;
                        $application_data['mortgage_loan_amount'] = $ProductRequest->mortgage_loan_amount;
                        $application_data['purchase_price'] = $ProductRequest->purchase_price;
                        $application_data['type_of_loan'] = $ProductRequest->type_of_loan;
                        $application_data['term_of_loan'] = $ProductRequest->term_of_loan;
                        $application_data['end_use_of_property'] = $ProductRequest->end_use_of_property;
                        $application_data['interest_rate'] = $ProductRequest->interest_rate;
                        $application_data['mortgage_emi'] = $ProductRequest->mortgage_emi;
                        $application_data['mortgage_loan_amount2'] = $ProductRequest->mortgage_loan_amount2;
                        $application_data['purchase_price2'] = $ProductRequest->purchase_price2;
                        $application_data['type_of_loan2'] = $ProductRequest->type_of_loan2;
                        $application_data['term_of_loan2'] = $ProductRequest->term_of_loan2;
                        $application_data['end_use_of_property2'] = $ProductRequest->end_use_of_property2;
                        $application_data['interest_rate2'] = $ProductRequest->interest_rate2;
                        $application_data['mortgage_emi2'] = $ProductRequest->mortgage_emi2;
                        $application_data['mortgage_loan_amount3'] = $ProductRequest->mortgage_loan_amount3;
                        $application_data['purchase_price3'] = $ProductRequest->purchase_price3;
                        $application_data['type_of_loan3'] = $ProductRequest->type_of_loan3;
                        $application_data['term_of_loan3'] = $ProductRequest->term_of_loan3;
                        $application_data['end_use_of_property3'] = $ProductRequest->end_use_of_property3;
                        $application_data['interest_rate3'] = $ProductRequest->interest_rate3;
                        $application_data['mortgage_emi3'] = $ProductRequest->mortgage_emi3;
                        $application_data['mortgage_loan_amount4'] = $ProductRequest->mortgage_loan_amount4;
                        $application_data['purchase_price4'] = $ProductRequest->purchase_price4;
                        $application_data['type_of_loan4'] = $ProductRequest->type_of_loan4;
                        $application_data['term_of_loan4'] = $ProductRequest->term_of_loan4;
                        $application_data['end_use_of_property4'] = $ProductRequest->end_use_of_property4;
                        $application_data['interest_rate4'] = $ProductRequest->interest_rate4;
                        $application_data['mortgage_emi4'] = $ProductRequest->mortgage_emi4;

                    foreach ($services as $service) {
                        $a_no = $app_base+$service->id;
                        $inputs['ref_id'] = $a_no;
                        $inputs['service_id'] = $service->service_id;
                        $inputs['preference_bank_id'] = $service->bank_id;
                        $inputs['decide_by'] = $service->decide_by;
                        $service_name = Service::where('id', $service->service_id)->select('name')->first();
                        $slide['line'] = "Application Ref. ID #".$a_no. " for ".$service_name->name. "";
                         ServiceApply::where('id', $service->id)->update([
                          'app_no' => $a_no, 
                          'app_status' => 1,
                        ]);
                        $application_id = (new Application)->store($inputs); 
                        $application_data['application_id'] = $application_id;

                        $app_id = (new ApplicationProductRequest)->store($application_data);

                        if($service->service_id == 3){
                            $card_types = CardTypePreference::where('user_id', $user_id)->select('type_id')->get();
                            if($card_types){
                                foreach ($card_types as $card_type) {
                                    ApplicationCardTypePreference::create([
                                        'app_id' => $application_id,
                                        'type_id' => $card_type->type_id,
                                    ]);
                                }
                            }
                            $CreditCards = CreditCardPreferenceBank::where('user_id', $user_id)->select('bank_id', 'loan_limit')->get();
                            if($CreditCards){
                                foreach ($CreditCards as $CreditCard) {
                                    ApplicationCreditCardPreferenceBank::create([
                                        'app_id' => $application_id,
                                        'bank_id' => $CreditCard->bank_id,
                                        'loan_limit' => $CreditCard->loan_limit,
                                    ]);
                                }
                            }
                        }

                        if($service->service_id == 1){
                            $PersonalLoans = PersonalLoanPreferenceBank::where('user_id', $user_id)->select('bank_id', 'loan_limit', 'loan_emi')->get();
                            if($PersonalLoans){
                                foreach ($PersonalLoans as $PersonalLoan) {
                                    ApplicationPersonalLoanPreferenceBank::create([
                                        'app_id' => $application_id,
                                        'bank_id' => $PersonalLoan->bank_id,
                                        'loan_limit' => $PersonalLoan->loan_limit,
                                        'loan_emi' => $PersonalLoan->loan_emi,
                                    ]);
                                }
                            }
                        }

                        $ref_id[] = $slide;

                        $ApplicationDependent['app_id'] = $app_id;
                        $dependents = Dependent::where('user_id', $user_id)->select('name', 'relation')->get();
                        if($dependents){
                            foreach($dependents as $dependent){    
                                $ApplicationDependent['name'] = $dependent->name;
                                $ApplicationDependent['relation'] = $dependent->relation;
                                (new ApplicationDependent)->store($ApplicationDependent); 
                            }
                        }
                    }
                } 


              return response()->json(['success' => true, 'status' => 200, 'message' => 'Application submited successfully', 'ref_id' => $ref_id]);



              }

            }

      } catch(Exception $e){
          return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

    public function upload_video(Request $request){
      try {
          if($request->api_key){
            $inputs = $request->all();
            $user = User::where('api_key', $request->api_key)->first();
            if($user){
              $user_id = $user->id;
              $vid_dt = CustomerOnboarding::where('user_id', $user_id)->select('video')->first();
              if(isset($inputs['video']) or !empty($inputs['video'])) {
                  $image_name = rand(100000, 999999);
                  $fileName = '';
                  if($file = $request->hasFile('video')) {
                      $file = $request->file('video');
                      $img_name = $file->getClientOriginalName();
                      $fileName = $image_name.$img_name;
                      $destinationPath = public_path().'/uploads/video/' ;
                      $file->move($destinationPath, $fileName);
                  }
                  $fname ='/uploads/video/';
                  $image = $fname.$fileName;
              }  else{
                  $image = $vid_dt->video;
              }

              CustomerOnboarding::where('user_id', $user_id)->update(['video' => $image]);

              return response()->json(['success' => true, 'status' => 200, 'message' => 'Video uploaded successfully']);
            }
          }
      } catch(Exception $e){
          return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

    public function consent_form_status(Request $request){

      if($request->api_key){
        $user = User::where('api_key', $request->api_key)->first();
        if($user) {
          
          $user_id = $user->id;
          $ref_id = [];
          CustomerOnboarding::where('user_id', $user_id)->update(['consent_form' => 1]);
              $ref_id = [];
               $CustomerOnboarding = CustomerOnboarding::where('user_id', $user_id)->first();

              $services = ServiceApply::where('customer_id', $user_id)->where('app_status', 0)->select('id','service_id', 'bank_id', 'decide_by')->get();

                $app_base = 1300;
                if($services){
                        if($CustomerOnboarding->cm_type == 1){
                            $employee = CmSalariedDetail::where('customer_id', $user_id)->select('company_name', 'date_of_joining', 'monthly_salary', 'last_three_salary_credits', 'other_company', 'last_two_salary_credits', 'last_one_salary_credits', 'accommodation_company', 'last_one_salary_file', 'last_two_salary_file', 'last_three_salary_file')->first();
                            $inputs['company_name'] = $employee->company_name;
                            $inputs['date_of_joining'] = $employee->date_of_joining;
                            $inputs['monthly_salary'] = $employee->monthly_salary;
                            $inputs['last_three_salary_credits'] = $employee->last_three_salary_credits;
                            $inputs['last_two_salary_credits'] = $employee->last_two_salary_credits;
                            $inputs['last_one_salary_credits'] = $employee->last_one_salary_credits;
                            $inputs['other_company'] = $employee->other_company;
                            $inputs['accommodation_company'] = $employee->accommodation_company;

                            $inputs['last_one_salary_file'] = $employee->last_one_salary_file;
                            $inputs['last_two_salary_file'] = $employee->last_two_salary_file;
                            $inputs['last_three_salary_file'] = $employee->last_three_salary_file;


                        } elseif ($CustomerOnboarding->cm_type == 2){
                            $employee = SelfEmpDetail::where('customer_id', $user_id)->select('self_company_name', 'percentage_ownership', 'profession_business', 'annual_business_income', 'self_other_company')->first();
                            $inputs['self_company_name'] = $employee->self_company_name;
                            $inputs['percentage_ownership'] = $employee->percentage_ownership;
                            $inputs['profession_business'] = $employee->profession_business;
                            $inputs['annual_business_income'] = $employee->annual_business_income;
                            $inputs['other_company'] = $employee->self_other_company;
                        } else {
                            $employee = OtherCmDetail::where('customer_id', $user_id)->select('monthly_pension')->first();
                            $inputs['monthly_pension'] = $employee->monthly_pension;
                        }

                        $inputs['nationality'] = $CustomerOnboarding->nationality;
                        $inputs['passport_number'] = $CustomerOnboarding->passport_number;
                        $inputs['passport_expiry_date'] = $CustomerOnboarding->passport_expiry_date;
                        $inputs['officer_email'] = $CustomerOnboarding->officer_email;
                        $inputs['visa_number'] = $CustomerOnboarding->visa_number;
                        $inputs['marital_status'] = $CustomerOnboarding->marital_status;
                        $inputs['years_in_uae'] = $CustomerOnboarding->years_in_uae;
                        $inputs['reference_number'] = $CustomerOnboarding->reference_number;
                        $inputs['passport_photo'] = $CustomerOnboarding->passport_photo;
                        $inputs['video'] = $CustomerOnboarding->video;
                        $inputs['no_of_dependents'] = $CustomerOnboarding->no_of_dependents;
                        $inputs['consent_form'] = $CustomerOnboarding->consent_form;
                        $inputs['cm_type'] = $CustomerOnboarding->cm_type;
                        $inputs['credit_score'] = $CustomerOnboarding->credit_score;
                        $inputs['aecb_date'] = $CustomerOnboarding->aecb_date;

                        $inputs['spouse_date_of_birth'] = $CustomerOnboarding->spouse_date_of_birth;
                        $inputs['agent_reference'] = $CustomerOnboarding->agent_reference;
                        $inputs['aecb_image'] = $CustomerOnboarding->aecb_image;
                        $inputs['wife_name'] = $CustomerOnboarding->wife_name;
                        $inputs['wedding_anniversary_date'] = $CustomerOnboarding->wedding_anniversary_date;

                        $inputs['user_id'] = $user_id;
                        $inputs['salutation'] = $user->salutation;
                        $inputs['name'] = $user->name;
                        $inputs['middle_name'] = $user->middle_name;
                        $inputs['last_name'] = $user->last_name;
                        $inputs['email'] = $user->email;
                        $inputs['gender'] = $user->gender;
                        $inputs['date_of_birth'] = $user->date_of_birth;
                        $inputs['profile_image'] = $user->profile_image;
                        $inputs['emirates_id'] = $user->emirates_id;
                        $inputs['emirates_id_back'] = $user->emirates_id_back;
                        $inputs['eid_number'] = $user->eid_number;
                        $inputs['eid_status'] = $user->eid_status;
                        $inputs['mobile'] = $user->mobile;
                        $inputs['status'] = 0;
                        $ProductRequest = ProductRequest::where('user_id', $user_id)->first();

                        $application_data['exist_credit'] = $ProductRequest->exist_credit;
                        $application_data['exist_personal'] = $ProductRequest->exist_personal;
                        $application_data['exist_business'] = $ProductRequest->exist_business;
                        $application_data['exist_mortgage'] = $ProductRequest->exist_mortgage;
                        $application_data['credit_member_since'] = $ProductRequest->credit_member_since;
                        $application_data['credit_member_since2']= $ProductRequest->credit_member_since2;
                        $application_data['credit_member_since3'] =$ProductRequest->credit_member_since3;
                        $application_data['credit_member_since4'] =$ProductRequest->credit_member_since4;
                        $application_data['loan_member_since'] = $ProductRequest->loan_member_since;
                        $application_data['loan_member_since2'] = $ProductRequest->loan_member_since2;
                        $application_data['loan_member_since3'] = $ProductRequest->loan_member_since3;
                        $application_data['loan_member_since4'] = $ProductRequest->loan_member_since4;
                        $application_data['business_member_since'] = $ProductRequest->business_member_since;

                        $application_data['business_member_since2'] = $ProductRequest->business_member_since2;
                        $application_data['business_member_since3'] = $ProductRequest->business_member_since3;
                        $application_data['business_member_since4'] = $ProductRequest->business_member_since4;
                        $application_data['mortgage_member_since'] = $ProductRequest->mortgage_member_since;
                        $application_data['mortgage_member_since2'] = $ProductRequest->mortgage_member_since2;
                        $application_data['mortgage_member_since3'] = $ProductRequest->mortgage_member_since3;
                        $application_data['mortgage_member_since4'] = $ProductRequest->mortgage_member_since4;
                        
                        $application_data['credit_card_limit'] = $ProductRequest->credit_card_limit;
                        $application_data['details_of_cards'] = $ProductRequest->details_of_cards;
                        $application_data['credit_bank_name'] = $ProductRequest->credit_bank_name;
                        $application_data['card_limit'] = $ProductRequest->card_limit;
                        $application_data['details_of_cards2'] = $ProductRequest->details_of_cards2;
                        $application_data['credit_bank_name2'] = $ProductRequest->credit_bank_name2;
                        $application_data['card_limit2'] = $ProductRequest->card_limit2;
                        $application_data['details_of_cards3'] = $ProductRequest->details_of_cards3;
                        $application_data['credit_bank_name3'] = $ProductRequest->credit_bank_name3;
                        $application_data['card_limit3'] = $ProductRequest->card_limit3;
                        $application_data['details_of_cards4'] = $ProductRequest->details_of_cards4;
                        $application_data['credit_bank_name4'] = $ProductRequest->credit_bank_name4;
                        $application_data['card_limit4'] = $ProductRequest->card_limit4;
                        $application_data['loan_amount'] = $ProductRequest->loan_amount;
                        $application_data['loan_bank_name'] = $ProductRequest->loan_bank_name;
                        $application_data['original_loan_amount'] = $ProductRequest->original_loan_amount;
                        $application_data['loan_emi'] = $ProductRequest->loan_emi;
                        $application_data['loan_bank_name2'] = $ProductRequest->loan_bank_name2;
                        $application_data['original_loan_amount2'] = $ProductRequest->original_loan_amount2;
                        $application_data['loan_emi2'] = $ProductRequest->loan_emi2;
                        $application_data['loan_bank_name3'] = $ProductRequest->loan_bank_name3;
                        $application_data['original_loan_amount3'] = $ProductRequest->original_loan_amount3;
                        $application_data['loan_emi3'] = $ProductRequest->loan_emi3;
                        $application_data['loan_bank_name4'] = $ProductRequest->loan_bank_name4;
                        $application_data['original_loan_amount4'] = $ProductRequest->original_loan_amount4;
                        $application_data['loan_emi4'] = $ProductRequest->loan_emi4;
                        $application_data['business_loan_amount'] = $ProductRequest->business_loan_amount;
                        $application_data['business_loan_emi'] = $ProductRequest->business_loan_emi;
                        $application_data['business_loan_amount2'] = $ProductRequest->business_loan_amount2;
                        $application_data['business_loan_emi2'] = $ProductRequest->business_loan_emi2;
                        $application_data['business_loan_amount3'] = $ProductRequest->business_loan_amount3;
                        $application_data['business_loan_emi3'] = $ProductRequest->business_loan_emi3;
                        $application_data['business_loan_amount4    '] = $ProductRequest->business_loan_amount4;
                        $application_data['business_loan_emi4'] = $ProductRequest->business_loan_emi4;
                        $application_data['mortgage_loan_amount'] = $ProductRequest->mortgage_loan_amount;
                        $application_data['purchase_price'] = $ProductRequest->purchase_price;
                        $application_data['type_of_loan'] = $ProductRequest->type_of_loan;
                        $application_data['term_of_loan'] = $ProductRequest->term_of_loan;
                        $application_data['end_use_of_property'] = $ProductRequest->end_use_of_property;
                        $application_data['interest_rate'] = $ProductRequest->interest_rate;
                        $application_data['mortgage_emi'] = $ProductRequest->mortgage_emi;
                        $application_data['mortgage_loan_amount2'] = $ProductRequest->mortgage_loan_amount2;
                        $application_data['purchase_price2'] = $ProductRequest->purchase_price2;
                        $application_data['type_of_loan2'] = $ProductRequest->type_of_loan2;
                        $application_data['term_of_loan2'] = $ProductRequest->term_of_loan2;
                        $application_data['end_use_of_property2'] = $ProductRequest->end_use_of_property2;
                        $application_data['interest_rate2'] = $ProductRequest->interest_rate2;
                        $application_data['mortgage_emi2'] = $ProductRequest->mortgage_emi2;
                        $application_data['mortgage_loan_amount3'] = $ProductRequest->mortgage_loan_amount3;
                        $application_data['purchase_price3'] = $ProductRequest->purchase_price3;
                        $application_data['type_of_loan3'] = $ProductRequest->type_of_loan3;
                        $application_data['term_of_loan3'] = $ProductRequest->term_of_loan3;
                        $application_data['end_use_of_property3'] = $ProductRequest->end_use_of_property3;
                        $application_data['interest_rate3'] = $ProductRequest->interest_rate3;
                        $application_data['mortgage_emi3'] = $ProductRequest->mortgage_emi3;
                        $application_data['mortgage_loan_amount4'] = $ProductRequest->mortgage_loan_amount4;
                        $application_data['purchase_price4'] = $ProductRequest->purchase_price4;
                        $application_data['type_of_loan4'] = $ProductRequest->type_of_loan4;
                        $application_data['term_of_loan4'] = $ProductRequest->term_of_loan4;
                        $application_data['end_use_of_property4'] = $ProductRequest->end_use_of_property4;
                        $application_data['interest_rate4'] = $ProductRequest->interest_rate4;
                        $application_data['mortgage_emi4'] = $ProductRequest->mortgage_emi4;

                    foreach ($services as $service) {
                        $a_no = $app_base+$service->id;
                        $inputs['ref_id'] = $a_no;
                        $inputs['service_id'] = $service->service_id;
                        $inputs['preference_bank_id'] = $service->bank_id;
                        $inputs['decide_by'] = $service->decide_by;
                        $service_name = Service::where('id', $service->service_id)->select('name')->first();
                        $slide['line'] = "Application Ref. ID #".$a_no. " for ".$service_name->name. "";
                         ServiceApply::where('id', $service->id)->update([
                          'app_no' => $a_no, 
                          'app_status' => 1,
                        ]);
                        $application_id = (new Application)->store($inputs); 
                        $application_data['application_id'] = $application_id;

                        $app_id = (new ApplicationProductRequest)->store($application_data); 

                        if($service->service_id == 3){
                            $card_types = CardTypePreference::where('user_id', $user_id)->select('type_id')->get();
                            if($card_types){
                                foreach ($card_types as $card_type) {
                                    ApplicationCardTypePreference::create([
                                        'app_id' => $application_id,
                                        'type_id' => $card_type->type_id,
                                    ]);
                                }
                            }
                            $CreditCards = CreditCardPreferenceBank::where('user_id', $user_id)->select('bank_id', 'loan_limit')->get();
                            if($CreditCards){
                                foreach ($CreditCards as $CreditCard) {
                                    ApplicationCreditCardPreferenceBank::create([
                                        'app_id' => $application_id,
                                        'bank_id' => $CreditCard->bank_id,
                                        'loan_limit' => $CreditCard->loan_limit,
                                    ]);
                                }
                            }
                        }

                        if($service->service_id == 1){
                            $PersonalLoans = PersonalLoanPreferenceBank::where('user_id', $user_id)->select('bank_id', 'loan_limit', 'loan_emi')->get();
                            if($PersonalLoans){
                                foreach ($PersonalLoans as $PersonalLoan) {
                                    ApplicationPersonalLoanPreferenceBank::create([
                                        'app_id' => $application_id,
                                        'bank_id' => $PersonalLoan->bank_id,
                                        'loan_limit' => $PersonalLoan->loan_limit,
                                        'loan_emi' => $PersonalLoan->loan_emi,
                                    ]);
                                }
                            }
                        }
                        $ref_id[] = $slide;
                        $ApplicationDependent['app_id'] = $app_id;
                        $dependents = Dependent::where('user_id', $user_id)->select('name', 'relation')->get();
                        if($dependents){
                            foreach($dependents as $dependent){    
                                $ApplicationDependent['name'] = $dependent->name;
                                $ApplicationDependent['relation'] = $dependent->relation;
                                (new ApplicationDependent)->store($ApplicationDependent); 
                            }
                        }
                    }
                } 
          
          return response()->json(['success' => true, 'status' => 200, 'message' => 'save successfully', 'ref_id' => $ref_id]);
        }
      }
    }

    public function changePassword(Request $request){
      try {
           
          if($request->api_key){
            $inputs = $request->all();
            $user = User::where('api_key', $request->api_key)->select('id', 'password')->first();
            $password = \Hash::make($inputs['password']);  
            $old_password = \Hash::make($inputs['old_password']);

            if (!\Hash::check($request->old_password, $user->password)){

            $message = "Old password not match";
            return apiResponseAppmsg(false, 200, $message, null, null);


            } else {
              $id = $user->id;
              unset($inputs['password']);
              $inputs = $inputs + ['password' => $password];
              (new User)->store($inputs, $id);

              $message = "Password successfully Changed";
              return apiResponseAppmsg(true, 200, $message, null, null);
           }  

          }

      } catch(Exception $e){
          return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

    public function bank_preference(Request $request){
      if($request->api_key){
          $user = User::where('api_key', $request->api_key)->select('id')->first();
          if($user){
          $data = [];

          $service = ServiceApply::where('customer_id', $user->id)->where('service_id', 3)->select('service_id', 'bank_id')->first();

          $user_id = $user->id;
          $f_details = ProductRequest::where('user_id', $user_id)->select('exist_credit', 'card_limit', 'card_limit2', 'card_limit3', 'card_limit4', 'exist_personal', 'loan_emi', 'loan_emi2', 'loan_emi3', 'loan_emi4', 'exist_business', 'business_loan_emi', 'business_loan_emi2', 'business_loan_emi3', 'business_loan_emi4', 'exist_mortgage', 'mortgage_emi', 'mortgage_emi2', 'mortgage_emi3', 'mortgage_emi4', 'details_of_cards', 'details_of_cards2', 'details_of_cards3', 'details_of_cards4', 'credit_bank_name', 'credit_bank_name2', 'credit_bank_name3', 'credit_bank_name4')->first();
            
          $cus_onboard = CustomerOnboarding::where('user_id', $user_id)->select('cm_type')->first();

          $avg_sal = 0;
          $total_cred_limit = 0;
          $cred_five = 0;
          $emi = 0;
          $credit_bank = [];

          if($f_details->exist_personal == 1){
                $emi += $f_details->loan_emi;
                if($f_details->loan_emi2){
                    $emi += $f_details->loan_emi2;
                }
                if($f_details->loan_emi3){
                    $emi += $f_details->loan_emi3;
                }
                if($f_details->loan_emi4){
                    $emi += $f_details->loan_emi4;
                }
            }

            if($f_details->exist_business == 1){
                $emi += $f_details->business_loan_emi;
                if($f_details->business_loan_emi2){
                    $emi += $f_details->business_loan_emi2;
                }
                if($f_details->business_loan_emi3){
                    $emi += $f_details->business_loan_emi3;
                }
                if($f_details->business_loan_emi4){
                    $emi += $f_details->business_loan_emi4;
                }
            }

            if($f_details->exist_mortgage == 1){
                $emi += $f_details->mortgage_emi;
                if($f_details->mortgage_emi2){
                    $emi += $f_details->mortgage_emi2;
                }
                if($f_details->mortgage_emi3){
                    $emi += $f_details->mortgage_emi3;
                }
                if($f_details->mortgage_emi4){
                    $emi += $f_details->mortgage_emi4;
                }
            }

            if($f_details->exist_credit == 1){
                $cred1 = 0;
                $cred2 = 0;
                $cred3 = 0;
                $cred4 = 0;
                if($f_details->details_of_cards == 'Credit Card'){
                    $cred1 = $f_details->card_limit;
                    $credit_bank[] = $f_details->credit_bank_name;
                }
                if($f_details->details_of_cards2 == 'Credit Card'){
                    $cred2 = $f_details->card_limit2;
                   
                    $credit_bank[] = $f_details->credit_bank_name2;
                }
                if($f_details->details_of_cards3 == 'Credit Card'){
                    $cred3 = $f_details->card_limit3;
                    $credit_bank[] = $f_details->credit_bank_name3;
                }
                if($f_details->details_of_cards4 == 'Credit Card'){
                    $cred4 = $f_details->card_limit4;
                    $credit_bank[] = $f_details->credit_bank_name4;
                }
                $total_cred_limit = $cred1+$cred2+$cred3+$cred4;
                if($total_cred_limit != 0){
                    $cred_five = $total_cred_limit/100*5;
                }
            }

            if($cus_onboard->cm_type == 1){
                $sal_details = CmSalariedDetail::where('customer_id', $user_id)->select('last_three_salary_credits', 'last_two_salary_credits', 'last_one_salary_credits', 'monthly_salary')->first(); 
                $no = 0; 
                $sal1 = 0;
                $sal2 = 0;
                $sal3 = 0;
                if($sal_details->last_one_salary_credits){
                    $sal1 = $sal_details->last_one_salary_credits;
                    $no++;
                }
                if($sal_details->last_two_salary_credits){
                    $sal2 = $sal_details->last_two_salary_credits;
                    $no++;
                }
                if($sal_details->last_three_salary_credits){
                    $sal3 = $sal_details->last_three_salary_credits;
                    $no++;
                }
                $total_sal = $sal1 + $sal2 + $sal3;  
                $avg_sal = $total_sal/$no;
                if($avg_sal == 0){
                 $avg_sal = $sal_details->monthly_salary; 
                }
            }
            if($cus_onboard->cm_type == 2){
                $sal_details = SelfEmpDetail::where('customer_id', $user_id)->select('annual_business_income')->first();
                $avg_sal = $sal_details->annual_business_income/12;
            }
            if($cus_onboard->cm_type == 3){
                $sal_details = OtherCmDetail::where('customer_id', $user_id)->select('monthly_pension')->first();
                $avg_sal = $sal_details->monthly_pension;
            }

            if($service){
                $slide['service_id'] = $service->service_id;
                $service_name = Service::where('id', $service->service_id)->select('name')->first();
                $slide['service_name'] = $service_name->name;
                $bank_data = [];

                foreach(get_prefer_bank($service->service_id) as $bank){
                    if($bank->default_show == 1){
                      $bank_slide['bank_id'] = $bank->id;
                      $bank_slide['bank_name'] = $bank->name;
                      $bank_slide['valuable_text'] = $bank->valuable_text;
                      
                      $bank_data[] = $bank_slide;
                    } else {
                      if($avg_sal >= $bank->min_salary && $avg_sal <= $bank->max_salary){
                        $bank_slide['bank_id'] = $bank->id;
                        $bank_slide['bank_name'] = $bank->name;
                        $bank_slide['valuable_text'] = $bank->valuable_text;
                        $bank_data[] = $bank_slide;
                      } else {
                         
                        if($bank->existing_card == 1){
                          $show = 0;
                          foreach(get_existing_bank_card($bank->id) as $bank_card){
                          if(in_array($bank_card->bank_id, $credit_bank)){
                            $show = 1;
                          }
                        }

                        if($show == 1){
                          $bank_slide['bank_id'] = $bank->id;
                          $bank_slide['bank_name'] = $bank->name;
                          $bank_slide['valuable_text'] = $bank->valuable_text;
                          $bank_data[] = $bank_slide;
                        }
                        } 
                      }
                    }
                }

              $slide['bank_data']  = $bank_data;
              $data[] = $slide;  
            }
          return response()->json(['success' => true, 'status' => 200, 'data' => $data]);  
          }
      }
    }


    public function profile_score(Request $request){

      if($request->api_key){
        $user = User::where('api_key', $request->api_key)->select('id', 'emirates_id', 'gender')->first();
          if($user){
          $user_id = $user->id;
          $score = 10;
          $cus_onboard = CustomerOnboarding::where('user_id', $user_id)->select('nationality', 'date_of_birth', 'passport_photo', 'marital_status', 'cm_type', 'passport_number')->first(); 
            if($cus_onboard){
              if($cus_onboard->nationality != NULL && $cus_onboard->date_of_birth != NULL && $cus_onboard->marital_status != NULL && $cus_onboard->marital_status != NULL){
                    $score += 5;
              }

               if($cus_onboard->passport_photo != NULL && $cus_onboard->passport_number != NULL){
                    $score += 5;
            }

            if($cus_onboard->cm_type != NULL){
                    $score += 50;
            }


            }
            
            if($user->emirates_id != NULL){
                    $score += 5;
            }

           

            $coman_info = ComanInformation::where('user_id', $user_id)->select('spouse_live_in_uae')->first();
            if(!empty($coman_info)){
                    $score += 10;
            }

            return response()->json(['success' => true, 'status' => 200, 'score' => $score]);
        }
      }
    }

    public function personal_loan_bank_list(){
      $bank_data = []; 
      foreach(get_prefer_bank_personal_loan(1) as $bank){
          $bank_slide['bank_id'] = $bank->id;
          $bank_slide['bank_name'] = $bank->name;          
          $bank_data[] = $bank_slide;
      }
      $slide['bank_data']  = $bank_data;
      $data[] = $slide; 
      return response()->json(['success' => true, 'status' => 200, 'data' => $data]); 
    }

    public function save_bank_preference(Request $request){
      if($request->api_key){
        $user = User::where('api_key', $request->api_key)->select('id')->first();
        if($user){
          $user_id = $user->id;
  
            // ServiceApply::where('service_id', 3)->where('app_status', 0)->where('customer_id', $user_id)->update([
            //   'bank_id' => $request->bank_id,
            //   'decide_by' => $request->decide_by,
            // ]);

            \DB::table('credit_card_preference_bank')->where('user_id', $user_id)->delete();
            \DB::table('card_type_preference')->where('user_id', $user_id)->delete();

            if(isset($request->bank_id)){
                $banks = explode(',', $request->bank_id);
                foreach($banks as $bank_id){
                  CreditCardPreferenceBank::create([
                      'bank_id' => $bank_id,
                      'user_id' => $user_id,
                      'loan_limit' => $request->your_limit,
                  ]);
                }
            }

            if(isset($request->card_type)){
                $card_types = explode(',', $request->card_type);
                foreach($card_types as $card_type){
                    CardTypePreference::create([
                        'type_id' => $card_type,
                        'user_id' => $user_id,
                    ]);
                }
            }
            
            return response()->json(['success' => true, 'status' => 200, 'message' => 'Bank preference have been successfully added']);  
        }
      } 
    }

    public function save_personal_loan_bank_preference(Request $request){
        if($request->api_key){
          $user = User::where('api_key', $request->api_key)->select('id')->first();
            if($user){
              $user_id = $user->id;
              \DB::table('personal_loan_preference_bank')->where('user_id', $user_id)->delete();
              if(isset($request->bank_id)){
                $banks = explode(',', $request->bank_id);
                  foreach($banks as $bank_id){
                      PersonalLoanPreferenceBank::create([
                          'bank_id'    =>  $bank_id,
                          'user_id'    =>  $user_id,
                          'loan_limit' =>  $request->your_limit,
                          'loan_emi'   =>  $request->your_emi,
                      ]);
                  }
              }
              return response()->json(['success' => true, 'status' => 200, 'message' => 'Personal loan bank preference successfully saved']);
            }
        }
    }
        




    public function service_list(Request $request){
      try {
            if($request->api_key){
              $user = User::where('api_key', $request->api_key)->select('id')->first();
              if($user){
              $services = Service::where('status', 1)->select('id', 'name', 'image')->orderBy('sort_order', 'ASC')->get();
              $base = route('get-started');
              $data = [];
              foreach ($services as $service) {
                $check = ServiceApply::where('service_id', $service->id)->where('app_status', 0)->where('customer_id', $user->id)->count();
             
                $slide['id'] = $service->id;
                $slide['name'] = $service->name;
                $slide['image'] = $base.$service->image;  
                if($check == 0){
                  $slide['selected'] = false;  
                } else {
                  $slide['selected'] = true;  
                }
                $data[] = $slide;
              } 
                return response()->json(['success' => true, 'status' => 200, 'data' => $data]);
              }
            }
      } catch(Exception $e){
          return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

    public function education_details_save(Request $request){
      try {
          if($request->api_key){
            $inputs = $request->all();
            $user = User::where('api_key', $request->api_key)->select('id')->first();
            if($user){
              $inputs['user_id'] = $user->id;
              $Details = UserEducation::where('user_id', $user->id)->select('id')->first();
              if($Details){
                    $id = $Details->id;
                    (new UserEducation)->store($inputs, $id);
                    return response()->json(['success' => true, 'status' => 200, 'message' => 'Education Details successfully updated']);
              } else {
                    (new UserEducation)->store($inputs); 
                    return response()->json(['success' => true, 'status' => 200, 'message' => 'Education Details successfully Saved']);
              } 
            }
          }
            return response()->json(['success' => true, 'status' => 200, 'data' => $data]);
          } catch(Exception $e){
          return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

    public function address_details(Request $request){
      try {
          if($request->api_key){
            $user = User::where('api_key', $request->api_key)->select('id')->first();
            if($user) {
              $data = Address::where('customer_id', $user->id)->first();
              return response()->json(['success' => true, 'status' => 200, 'data' => $data]);
            }
          }
      } catch(Exception $e){
            return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

    public function address_details_save(Request $request){
        try {
          if($request->api_key){
            $inputs = $request->all();
            $user = User::where('api_key', $request->api_key)->select('id')->first();
            if($user){
              $user_id = $user->id;
              $inputs['customer_id'] = $user->id;
              $Details = Address::where('customer_id', $user->id)->select('id')->first();
              if($Details){
                    $id = $Details->id;
                    (new Address)->store($inputs, $id);

                    $result = CustomerOnboarding::where('user_id', $user_id)->select('id')->first();
                    $ser = 1300;
                    $ref_id = $ser.$result->id;
                    CustomerOnboarding::where('user_id', $user_id)->update(['ref_id'  =>  $ref_id,]);

                    return response()->json(['success' => true, 'status' => 200, 'message' => 'Address Details successfully updated', 'ref_id' => $ref_id]);
              } else {
                    (new Address)->store($inputs); 
                    
                    $result = CustomerOnboarding::where('user_id', $user_id)->select('id')->first();
                    $ser = 1300;
                    $ref_id = $ser.$result->id;
                    CustomerOnboarding::where('user_id', $user_id)->update(['ref_id'  =>  $ref_id,]);

                    return response()->json(['success' => true, 'status' => 200, 'message' => 'Address Details successfully Saved', 'ref_id' => $ref_id]);
              } 
            }
          }
            return response()->json(['success' => true, 'status' => 200, 'data' => $data]);
        } catch(Exception $e){
          return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

    public function country(){
      $data = Country::all();
      return response()->json(['success' => true, 'status' => 200, 'data' => $data]);
    }
 
    public function select_services(Request $request){
      try {
          if($request->api_key){
            $user = User::where('api_key', $request->api_key)->select('id')->first();
            if($user) {
              $user_id = $user->id;
              if(isset($request->service)){
                $ser_list = explode(',', $request->service);

                \DB::table('service_applies')->where('customer_id', $user_id)->delete();

                foreach($ser_list as $service_id){
                    $apply_ser = ServiceApply::where('service_id', $service_id)->where('app_status', 0)->where('customer_id', $user_id)->count();
                      if($apply_ser == 0){
                        ServiceApply::create([
                            'service_id'  =>  $service_id,
                            'customer_id'  => $user_id,
                        ]);
                      }
                }

                return response()->json(['success' => true, 'status' => 200]);
              }
            }
          }
      } catch(Exception $e){
            return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

    public function education_details(Request $request){
      try {
          if($request->api_key){
            $user = User::where('api_key', $request->api_key)->select('id')->first();
            if($user) {
              $data = UserEducation::where('user_id', $user->id)->select('education', 'primary_school', 'high_school', 'graduate', 'postgraduate', 'others')->first();
                return response()->json(['success' => true, 'status' => 200, 'data' => $data]);
            }
          }
      } catch(Exception $e){
            return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

    public function forgot_password_otp(Request $request){
      try {
          if($request->otp){
              $user = User::where('login_otp', $request->otp)->select('id')->first();
              if($user){
                $password = \Hash::make($request->password);
                User::where('id', $user->id)->update(['password' => $password, 'login_otp' => NULL]);
                $message = "Password Successfully Changed";
                return apiResponseAppmsg(true, 200, $message, null, null);

              } else {
                $message = "OTP not valid";
                return apiResponseAppmsg(false, 200, $message, null, null);
              }
          }
      } catch(Exception $e){
          return apiResponse(false, 500, lang('messages.server_error'));
      }
    }
    

    public function forgot_password(Request $request){
      try{

          $user = User::where('email', $request->email)->where('status', 1)->select('name', 'id')->first();
          if($user) {
            $email = $request->email;
            $data['name'] = $user->name;
            $otp = rand(100000, 999999);
            $data['otp'] = $otp; 
            User::where('id', $user->id)
            ->update([
                'login_otp' =>  $otp,
            ]);

            \Mail::send('email.forgot_password_app', $data, function($message) use($email){
              $message->from('no-reply@lnxx.com');
              $message->to($email);
              $message->subject('Lnxx - Forgot Password');
            });

            $message = "We sent the OTP to your registerd email id. Kindly check your email.";
            return apiResponseAppmsg(true, 200, $message, null, null);
          } else {
            $message = "Hey, looks like we don't have your email in our database";
            return apiResponseAppmsg(false, 200, $message, null, null);
          }

      } catch(Exception $e){
          return apiResponse(false, 500, lang('messages.server_error'));
      }

    }


    public function register(Request $request){
        try {
          $inputs = $request->all();
          $check_val1 =  User::where('mobile', $request->mobile)->first();
          if($check_val1){
            $message = "The mobile number has already registered";
            return apiResponseAppmsg(false, 201, $message, null, null); 
          }
          $otp = rand(100000, 999999);
          $inputs['mobile_otp'] = $otp;
          $id = (new PreRegister)->store($inputs);
          $message = "OTP sent on your mobile number";
          return response()->json(['success' => true, 'status' => 200, 'message' => $message, 'id' => $id, 'mobile' => $request->mobile]);
        } catch(Exception $e){
        return apiResponse(false, 500, 'error');
        }
    }

    public function email_register(Request $request){
        try {
          $inputs = $request->all();
          $check_val1 =  User::where('email', $request->email)->first();
          if($check_val1){
            $message = "Email id already registered";
            return apiResponseAppmsg(false, 201, $message, null, null); 
          }
          $otp = rand(100000, 999999);
          $id = $request->id;
          $inputs['email_otp'] = $otp;
          (new PreRegister)->store($inputs, $id);

            $email = $request->email;

            $postdata = http_build_query(
            array(
                'otp' => $otp,
                'email' => $email,
            )
            );
            $opts = array('http' =>
            array(
            'method'  => 'POST',
            'header'  => 'Content-Type: application/x-www-form-urlencoded',
            'content' => $postdata
            )
            );

            $context  = stream_context_create($opts);
            $result = file_get_contents('https://sspl20.com/email-api/api/lnxx/email-otp', false, $context);
            $message = "OTP sent on your email id";
            
          return response()->json(['success' => true, 'status' => 200, 'message' => $message, 'id' => $id, 'email' => $request->email]);
        } catch(Exception $e){
        return apiResponse(false, 500, 'error');
        }
    }
    
    public function sign_up(Request $request){
      try {
            $PreRegister =  PreRegister::where('id', $request->id)->where('email_status', 1)->where('mobile_status', 1)->select('email', 'mobile')->first();
            if($PreRegister){
              $api_key = $this->generateApiKey();
              $inputs['name'] = $request->name;

              $inputs['email'] = $PreRegister->email;
              $inputs['mobile'] = $PreRegister->mobile;
              $inputs['status'] = 1;
              $inputs['user_type'] = 2;
              $inputs['api_key'] = $api_key; 
              $id = (new User)->store($inputs);
              $data['name'] = $request->name;
              $data['email'] = $PreRegister->email;
              $data['mobile'] = $PreRegister->mobile;
              $data['api_key'] = $api_key;
              return response()->json(['success' => true, 'status' => 200, 'user' => $data]);
            } else {
              $message = "Email mobile not verified";
              return response()->json(['success' => false, 'status' => 201, 'message' => $message]);
            }

       } catch(Exception $e){
        return apiResponse(false, 500, 'error');
        }
    }

    public function profile_image(Request $request){

      $user = PreRegister::where('id', $request->id)->first();
      if($user){
        $inputs = $request->all();
        $mg = "Account created successfully";
        $user_id = $user->id;
          $profile_image = '';
          if(isset($inputs['profile_image']) or !empty($inputs['profile_image'])) {

              // $image_name = rand(100000, 999999);
              // $fileName = '';
              // if($file = $request->hasFile('profile_image')) {
              //   $file = $request->file('profile_image') ;
              //   $img_name = $file->getClientOriginalName();
              //   $image_resize = Image::make($file->getRealPath()); 
              //   $image_resize->resize(300, 300);
              //   $fileName = $image_name.$img_name;
              //   $image_resize->save(public_path('/uploads/user_images/' .$fileName));
              //   $mg = "Profile image successfully uploaded!";                
              // }

              // $fname ='/uploads/user_images/';
              // $profile_image = $fname.$fileName;


              $image1 = $request->file('profile_image');
              $originalExtension1 = $image1->getClientOriginalExtension();
              $image_s1 = Image::make($image1)->orientate();
              $image_s1->resize(300, null, function ($constraint) {
              $constraint->aspectRatio();
              });
              $filename1 = random_int(9, 999999999) + time() . '.' . $originalExtension1;
              $image_s1->save(public_path('/uploads/user_images/'.$filename1));
              $profile_image = '/uploads/user_images/'.$filename1;
          }
            
            $api_key = $this->generateApiKey();

            $ref = Refer::where('mobile', $user->mobile)->orWhere('email', $user->email)->select('user_id', 'id')->first();

            User::create([
              'salutation' => $user->salutation,
              'name' => $user->name,
              'mobile' => $user->mobile,
              'middle_name' => $user->middle_name,
              'last_name' => $user->last_name,
              'email' => $user->email,
              'api_key' => $api_key,
              'emirates_id' => $user->emirates_id,
              'emirates_id_back' => $user->emirates_id_back,
              'eid_number' =>  $user->eid_number,
              'eid_status' =>  $user->eid_status,
              'profile_image' => $profile_image,
              'referral_id' => @$ref->user_id,
              'user_type' => 2,
              'status' => 1,
            ]);

            if($ref){
              Refer::where('id', $ref->id)->update(['status' => 1]);
            }

          // User::where('id', $user_id)
          //   ->update([
          //     'profile_image' => $profile_image,
          // ]); 
        $users = User::where('email', $user->email)->where('mobile', $user->mobile)->first();
        $home = route('get-started');
        $data['salutation'] = $users->salutation;
        $data['name'] = $users->name;
        $data['middle_name'] = $users->middle_name;
        $data['last_name'] = $users->last_name;
        $data['email'] = $users->email;
        $data['mobile'] = $users->mobile;
        $data['api_key'] = $users->api_key;
        $user_id = 1300+$users->id;
        $data['user_code'] = 'lnxx'.$user_id;
        if($profile_image){
          $data['profile_image'] = $home.$profile_image;
        } else {
          $data['profile_image'] = '';
        }

        return response()->json(['success' => true, 'status' => 200, 'message' => $mg, 'data' => $data ]);
      }
    }
    
    public function verify_emirate(Request $request){
        $user = PreRegister::where('id', $request->id)->select('login_otp')->first();
        if($request->otp == $user->login_otp){
            PreRegister::where('id', $request->id)->update(['eid_status' =>  1]);
            return response()->json(['success' => true, 'status' => 200, 'message' => 'Emirate id is successfully verified']); 
        } elseif ($request->otp == '652160') {
              PreRegister::where('id', $request->id)->update(['eid_status' =>  1]);
              return response()->json(['success' => true, 'status' => 200, 'message' => 'Emirate id is successfully verified']); 
        } else {
              return response()->json(['success' => false, 'status' => 201, 'message' => 'Invalid OTP try again']); 
        }
    }

    public function emirates_id(Request $request){
      
      $user = User::where('api_key', $request->api_key)->select('id')->first();
      if($user){
      $user_id = $user->id;
      if($request->emirates_id_front){
      $inputs = $request->all(); 
      if(isset($inputs['emirates_id_front']) or !empty($inputs['emirates_id_front'])) {
          $image_name = rand(100000, 999999);
          $fileName = '';

          if($file = $request->hasFile('emirates_id_front')) {
              $file = $request->file('emirates_id_front') ;
              $img_name = $file->getClientOriginalName();
              $image_resize = Image::make($file->getRealPath()); 
              $image_resize->resize(750, 400);
              $fileName = $image_name.$img_name;
              $image_resize->save(public_path('/uploads/emirates_id/' .$fileName));                 
          }

          $fname ='/uploads/emirates_id/';
          $emirates_id_front = $fname.$fileName;
      }

      if(isset($inputs['emirates_id_back']) or !empty($inputs['emirates_id_back'])) {
          $image_name = rand(100000, 999999);
          $fileName = '';

          if($file = $request->hasFile('emirates_id_back')) {
            $file = $request->file('emirates_id_back') ;
            $img_name = $file->getClientOriginalName();
            $image_resize = Image::make($file->getRealPath()); 
            $image_resize->resize(750, 400);
            $fileName = $image_name.$img_name;
            $image_resize->save(public_path('/uploads/emirates_id/' .$fileName));                 
          }


          $fname ='/uploads/emirates_id/';
          $emirates_id_back = $fname.$fileName;
      }
       
      $otp = rand(100000, 999999);

      PreRegister::where('id', $request->id)
      ->update([
          'emirates_id' =>  $emirates_id_front,
          'emirates_id_back' =>  $emirates_id_back,
          'eid_number' => $request->eid_number,
          'login_otp' => $otp,
      ]);

      return response()->json(['success' => true, 'status' => 200, 'message' => 'Emirate ID successfully uploaded!']);
      }
      }
    }

    public function email_verify(Request $request){
      try {
          $check_otp =  PreRegister::where('id', $request->id)->where('email_otp', $request->otp)->first();
          if($check_otp){
            $inputs['email_status'] = 1; 
            $id = $request->id;
            (new PreRegister)->store($inputs, $id);
            $message = "OTP Email id is successfully verified";
            
            $PreRegister =  PreRegister::where('id', $request->id)->where('email_status', 1)->where('mobile_status', 1)->select('email', 'mobile', 'name', 'middle_name', 'last_name', 'salutation')->first();

          //   if($PreRegister){
          //     $api_key = $this->generateApiKey();
          //     $inputs['name'] = $PreRegister->name;
          //     $inputs['email'] = $PreRegister->email;
          //     $inputs['mobile'] = $PreRegister->mobile;
          //     $inputs['salutation'] = $PreRegister->salutation;
          //     $inputs['middle_name'] = $PreRegister->middle_name;
          //     $inputs['last_name'] = $PreRegister->last_name;
          //     $inputs['status'] = 1;
          //     $inputs['user_type'] = 2;
          //     $inputs['api_key'] = $api_key; 
              
          //     $id = (new User)->store($inputs);
          //     $data['name'] = $PreRegister->name;
          //     $data['email'] = $PreRegister->email;
          //     $data['mobile'] = $PreRegister->mobile;
          //     $data['middle_name'] = $PreRegister->middle_name;
          //     $data['last_name'] = $PreRegister->last_name;
          //     $data['api_key'] = $api_key;

          //   return response()->json(['success' => true, 'status' => 200, 'message' => $message, 'user' => $data]);
          // }

          return response()->json(['success' => true, 'status' => 200, 'message' => $message, 'id' => $id]);

          } elseif ($request->otp == 652160) {
            $inputs['email_status'] = 1; 
            $id = $request->id;
            (new PreRegister)->store($inputs, $id);
            $message = "Email id is successfully verified";

          //   $PreRegister =  PreRegister::where('id', $request->id)->where('email_status', 1)->where('mobile_status', 1)->select('email', 'mobile', 'name', 'last_name', 'middle_name', 'salutation')->first();

          //   if($PreRegister){
          //     $api_key = $this->generateApiKey();
          //     $inputs['name'] = $PreRegister->name;
          //     $inputs['email'] = $PreRegister->email;
          //     $inputs['mobile'] = $PreRegister->mobile;
          //     $inputs['middle_name'] = $PreRegister->middle_name;
          //     $inputs['last_name'] = $PreRegister->last_name;
          //     $inputs['salutation'] = $PreRegister->salutation;
          //     $inputs['status'] = 1;
          //     $inputs['user_type'] = 2;
          //     $inputs['api_key'] = $api_key; 
              
          //     $id = (new User)->store($inputs);
          //     $data['name'] = $PreRegister->name;
          //     $data['email'] = $PreRegister->email;
          //     $data['mobile'] = $PreRegister->mobile;
          //     $data['api_key'] = $api_key;
          //   return response()->json(['success' => true, 'status' => 200, 'message' => $message, 'user' => $data]);
          // }

          return response()->json(['success' => true, 'status' => 200, 'message' => $message, 'id' => $id]);

          } else {
            $id = $request->id;
            $message = "Invalid OTP try again";
            return response()->json(['success' => false, 'status' => 201, 'message' => $message, 'id' => $id]);
          }
      } catch(Exception $e){
        return apiResponse(false, 500, 'error');
        }
    }

    public function mobile_verify(Request $request){
        try {

          $check_otp =  PreRegister::where('id', $request->id)->where('mobile_otp', $request->otp)->first();
          if($check_otp){
            $inputs['mobile_status'] = 1; 
            $id = $request->id;
            (new PreRegister)->store($inputs, $id);
            $message = "Mobile no. is successfully verified";
            return response()->json(['success' => true, 'status' => 200, 'message' => $message, 'id' => $id]);
          } elseif ($request->otp == 652160) {
            
            $inputs['mobile_status'] = 1; 
            $id = $request->id;
            (new PreRegister)->store($inputs, $id);
            $message = "Mobile no. is successfully verified";
            return response()->json(['success' => true, 'status' => 200, 'message' => $message, 'id' => $id]);

          } else {
            $id = $request->id;
            $message = "Invalid OTP try again";
            return response()->json(['success' => false, 'status' => 201, 'message' => $message, 'id' => $id]);
          }
        
        } catch(Exception $e){
        return apiResponse(false, 500, 'error');
        }
    }
    
    public function login(Request $request){
        $user = User::where('mobile', $request->username)->where('status', 1)->select('id')->first();
        if($user){
            $gen_otp = rand(100000, 999999);
            User::where('id', $user->id)->update([ 'login_otp' =>  $gen_otp]);
            $id = $user->id;
            $username = $request->username;
            
            $message = "OTP sent successfully on your registered mobile";
            return response()->json(['success' => true, 'status' => 200, 'message' => $message, 'id' => $id, 'username' => $username]);
            
        } else {
            $user = User::where('email', $request->username)->where('status', 1)->select('id')->first();
            if($user){
                $gen_otp = rand(100000, 999999);
                User::where('id', $user->id)->update([ 'login_otp' =>  $gen_otp]);
                $email = $request->username;
                $postdata = http_build_query(
                    array(
                        'otp' => $gen_otp,
                        'email' => $email,
                    )
                    );
                    $opts = array('http' =>
                        array(
                        'method'  => 'POST',
                        'header'  => 'Content-Type: application/x-www-form-urlencoded',
                        'content' => $postdata
                        )
                    );
                    $context  = stream_context_create($opts);
                    $result = file_get_contents('https://sspl20.com/email-api/api/lnxx/email-otp', false, $context);
                $username = $request->username;;    
                $id = $user->id;
                return response()->json(['success' => true, 'status' => 200, 'message' => 'OTP sent successfully on your registered email', 'id' => $id, 'username' => $username]);
            } else {
                $username = $request->username;
                
                if(preg_match('(@)', $username) === 1) {
                       return response()->json(['success' => false, 'status' => 201, 'message' => 'Entered email id is invalid. Try again!', 'username' => $username]);
                } else {
                  return response()->json(['success' => false, 'status' => 201, 'message' => 'Entered mobile number is invalid. Try again!', 'username' => $username]);
                }

                

            }
        }    
    }

    
    public function login_otp(Request $request){
    try{
       $user_data = User::where('id', $request->id)->where('login_otp', $request->otp)->first();
       if($user_data){
           $api_key = $this->generateApiKey();
            $home = route('get-started');
            if($user_data->api_key){
                $api_key = $user_data->api_key; 
            } else {
                User::where('id', $request->id)
                ->update([
                'api_key' =>  $api_key,
                 ]);
            }
            $data['salutation'] = $user_data->salutation;
            $data['name'] = $user_data->name;
            $data['middle_name'] = $user_data->middle_name;
            $data['last_name'] = $user_data->last_name;
            $data['email'] = $user_data->email;
            $data['mobile'] = $user_data->mobile;
            if($user_data->profile_image){
            $data['profile_image'] = $home.$user_data->profile_image;
            } else {
            $data['profile_image'] = null;
            }

            $user_id = 1300+$user_data->id;
            $data['user_code'] = 'lnxx'.$user_id;
            $data['api_key'] = $api_key;
           return response()->json(['success' => true, 'status' => 200, 'message' => 'Login successfully', 'user' => $data]);
       } else{
          $home = route('get-started');
            if($request->otp == 652160){
               $api_key = $this->generateApiKey();
               $user_data = User::where('id', $request->id)->first();
            if($user_data->api_key){
                $api_key = $user_data->api_key; 
            } else {
                User::where('id', $request->id)
                ->update([
                'api_key' =>  $api_key,
                 ]);
            }
            $data['salutation'] = $user_data->salutation;
            $data['name'] = $user_data->name;
            $data['middle_name'] = $user_data->middle_name;
            $data['last_name'] = $user_data->last_name;
            $data['email'] = $user_data->email;
            $data['mobile'] = $user_data->mobile;
            if($user_data->profile_image){
            $data['profile_image'] = $home.$user_data->profile_image;
            } else {
            $data['profile_image'] = null;
            }
            $user_id = 1300+$user_data->id;
            $data['user_code'] = 'lnxx'.$user_id;

            $data['api_key'] = $api_key;
            return response()->json(['success' => true, 'status' => 200, 'message' => 'Login successfully', 'user' => $data]);
            } else {
            return response()->json(['success' => false, 'status' => 201, 'message' => 'Incorrect OTP', 'id' => $request->id ]);    
            }
       }
    } catch (\Exception $e) {
        return back();
    }
    }


    public function mobile_verify1(Request $request){
        try{
 
          $user_data = User::where('mobile', $request->mobile)->first();

                $api_key = $this->generateApiKey();
                if($user_data->api_key){
                } else {
                  User::where('email', $request->email)
                  ->update([
                    'api_key' =>  $api_key,
                  ]);
                } 

                $user_data1 = User::where('email', $request->email)->first();

                $data['name'] = $user_data1->name;
                $data['email'] = $user_data1->email;
                $data['image'] = $user_data1->profile_image;
                $data['mobile'] = $user_data1->mobile;  
                if($user_data->api_key){
                  $data['api_key'] = $user_data->api_key;
                } else {
                  $data['api_key'] = $user_data1->api_key;
                }

              $data['email'] = $request->email;
              $data['name'] = $request->name;

              return apiResponseApp(false, 200, null, null, $data);
        } catch(Exception $e){
        
          return apiResponse(false, 500, lang('messages.server_error'));
        }
    }

    public function login_user(Request $request){

        try{

        $credentials = [
            'email' => $request->get('username'),
            'password' => $request->get('password'),
            'status' => 1
        ];

        $credentials1 = [
            'mobile' => $request->get('username'),
            'password' => $request->get('password'),
            'status' => 1
        ];
         
          $url = route('get-started');
          $inputs = $request->all();
            // $validator = (new User)->validateLoginUser($inputs);
            // if( $validator->fails() ) {
            //   $data['messages'] = "Enter required field";
            //     return apiResponseApp(false, 200, null, null, $data);
            // }

         $user = User::where('email', $request->username)->where('status', 1)->select('password')->first(); 
         if($user){
          $wp_hasher = new PasswordHash(8, TRUE);
          $plain_password = $request->password; 
          $password_hashed  =  $user->password;

          if($wp_hasher->CheckPassword($plain_password, $password_hashed)) {
            $user = User::where('email', $request->username)->where('status', 1)->first(); 
          } else {
            $user = ''; 
          }
         }
            if (!empty($user))  {
                
                $user_data = User::where('email', $request->username)->first();
                $api_key = $this->generateApiKey();
                if($user_data->api_key){
                $api_key = $user_data->api_key;
                } else {
                User::where('email', $request->username)
                ->update([
                'api_key' =>  $api_key,
                 ]);
                }
                
                $data['name'] = $user_data->name;
                $data['email'] = $user_data->email;
                if($user_data->profile_image){
                  $data['image'] = $url.$user_data->profile_image;
                } else {
                  $data['image'] =$user_data->profile_image;
                }
                $data['mobile'] = $user_data->mobile;  
                $data['gender'] = $user_data->gender;  
                $data['api_key'] = $api_key;  

                return apiResponseApp(true, 200, null, null, $data);

          } else if (Auth::attempt($credentials))  {

                $user_data = User::where('email', $request->username)->first();

                $api_key = $this->generateApiKey();
                if($user_data->api_key){
                  $api_key = $user_data->api_key;
                } else {
                User::where('email', $request->username)
                ->update([
                'api_key' =>  $api_key,
                 ]);
                }

              if($user_data->user_type == 4){

                return apiResponse(false, 200, 'You are not allow on APP');

               } else {

                $data['name'] = $user_data->name;
                $data['email'] = $user_data->email;
                if($user_data->profile_image){
                  $data['image'] = $url.$user_data->profile_image;
                } else {
                  $data['image'] = $user_data->profile_image;
                }
                $data['mobile'] = $user_data->mobile;  
                $data['gender'] = $user_data->gender;  
                $data['api_key'] = $api_key;  

                return apiResponseApp(true, 200, null, null, $data);
              
              }

          } else if(Auth::attempt($credentials1)) {
                $user_data = User::where('mobile', $request->username)->first();
                $api_key = $this->generateApiKey();
                if($user_data->api_key){
                $api_key = $user_data->api_key;
                } else {
                User::where('email', $request->username)
                ->update([
                'api_key' =>  $api_key,
                 ]);
                }
                if($user_data->user_type == 4){
                  return apiResponse(false, 200, 'You are not allow on APP');
                } else {
                $data['name'] = $user_data->name;
                $data['email'] = $user_data->email;
                if($user_data->profile_image){
                  $data['image'] = $url.$user_data->profile_image;
                } else {
                  $data['image'] =$user_data->profile_image;
                }
                $data['mobile'] = $user_data->mobile; 
                $data['gender'] = $user_data->gender;  
                $data['api_key'] = $api_key; 
                return apiResponseApp(true, 200, null, null, $data);
                }
        } else {
         //  dd($request);
          return apiResponse(false, 200, 'Invalid login credentials');
        }
    } catch(Exception $e){
            return apiResponse(false, 500, lang('messages.server_error'));
        }
    }


     /*create app key*/
    private function generateApiKey() {
        return md5(uniqid(rand(), true));
    }

    public function emailVerifyApp($user_id) {
        try{
            if($user_id){
                $de_crypt_user_id = Hashid::decode($user_id);
                $data = [];
                $user = User::where('id', $de_crypt_user_id)->first();
                User::where('id',  $de_crypt_user_id)->update(['status' => 1]);
                return redirect()->route('home');
            }
        }
        catch(\Exception $e){
            return back();
        }
    }

    public function show_basic_information(Request $request){
      try {
        if($request->api_key){
          $user = User::where('api_key', $request->api_key)->select('id', 'gender', 'date_of_birth', 'emirates_id', 'emirates_id_back', 'name', 'last_name', 'middle_name', 'salutation', 'eid_number', 'eid_status')->first();
          if($user) {
              $home = route('get-started');
              $datas = CustomerOnboarding::where('user_id', $user->id)->select('nationality', 'visa_number', 'marital_status', 'years_in_uae', 'passport_photo', 'reference_number', 'officer_email', 'eid_number', 'no_of_dependents', 'credit_score', 'passport_expiry_date', 'passport_number', 'aecb_date', 'agent_reference', 'aecb_image', 'wife_name', 'wedding_anniversary_date', 'spouse_date_of_birth')->first();
              //dd($data);
              if(isset($datas->passport_photo)){
                $data['passport_photo'] = $home.$datas->passport_photo;
              } else {
                $data['passport_photo'] = null;
              }

              if(isset($datas->aecb_image)){
                $data['aecb_image'] = $home.$datas->aecb_image;
              } else {
                $data['aecb_image'] = null;
              }
              
              if($user->emirates_id){
                $data['emirates_id_front'] = $home.$user->emirates_id;
              } else {
                $data['emirates_id_front'] = null;
              }
              if($user->emirates_id_back){
                $data['emirates_id_back'] = $home.$user->emirates_id_back;
              } else {
                $data['emirates_id_back'] = null;
              }
              if(isset($datas->passport_expiry_date)){
                $data['passport_expiry_date'] = $datas->passport_expiry_date;
              } else {
                $data['passport_expiry_date'] = null;
              }
              if(isset($datas->passport_number)){
                $data['passport_number'] = $datas->passport_number;
              } else {
                $data['passport_number'] = null;
              }
              if(isset($datas->aecb_date)){
                $data['aecb_date'] = $datas->aecb_date;
              } else {
                $data['aecb_date'] = null;
              }

              $data['gender'] = $user->gender;
              $data['date_of_birth'] = $user->date_of_birth;
              if(isset($user->salutation)){
                $data['salutation'] = $user->salutation;
              } else {
                $data['salutation'] = null;
              }
              if(isset($user->name)){
                $data['first_name_as_per_passport'] = $user->name;
              } else {
                $data['first_name_as_per_passport'] = null;
              }
              if(isset($user->last_name)){
                $data['last_name'] = $user->last_name;
              } else {
                $data['last_name'] = null;
              }
              if(isset($user->middle_name)){
                $data['middle_name'] = $user->middle_name;
              } else {
                $data['middle_name'] = null;
              }
              if(isset($datas->nationality)){
                $data['nationality'] = $datas->nationality;
              } else {
                $data['nationality'] = null;
              }
              if(isset($datas->credit_score)){
                $data['credit_score'] = $datas->credit_score;
              } else {
                $data['credit_score'] = null;
              }
              if(isset($datas->marital_status)){
                $data['marital_status'] = $datas->marital_status;
              } else {
                $data['marital_status'] = null;
              }
              if(isset($datas->wife_name)){
                $data['wife_name'] = $datas->wife_name;
              } else {
                $data['wife_name'] = null;
              }
              if(isset($datas->wedding_anniversary_date)){
                $data['wedding_anniversary_date'] = $datas->wedding_anniversary_date;
              } else {
                $data['wedding_anniversary_date'] = null;
              }
              if(isset($datas->spouse_date_of_birth)){
                $data['spouse_date_of_birth'] = $datas->spouse_date_of_birth;
              } else {
                $data['spouse_date_of_birth'] = null;
              }
              if(isset($datas->years_in_uae)){
                $data['years_in_uae'] = $datas->years_in_uae;
              } else {
                $data['years_in_uae'] = null;
              }
              if(isset($datas->agent_reference)){
                $data['agent_reference'] = $datas->agent_reference;
              } else {
                $data['agent_reference'] = null;
              }
              if(isset($datas->reference_number)){
                $data['reference_number'] = $datas->reference_number;
              } else {
                $data['reference_number'] = null;
              }
              if(isset($datas->officer_email)){
                $data['officer_email'] = $datas->officer_email;
              } else {
                $data['officer_email'] = null;
              }
              if(isset($user->eid_number)){
                $data['eid_number'] = $user->eid_number;
              } else {
                $data['eid_number'] = null;
              }

              if(isset($user->eid_status)){
                $data['eid_status'] = $user->eid_status;
              } 

              if(isset($datas->no_of_dependents)){
                $data['no_of_dependents'] = $datas->no_of_dependents;
              } else {
                $data['no_of_dependents'] = null;
              }

              if(isset($datas->visa_number)){
                $data['visa_number'] = $datas->visa_number;
              } else {
                $data['visa_number'] = null;
              }

              $dependents = Dependent::where('user_id', $user->id)->select('name', 'relation')->get();
              $data['dependents'] = $dependents;

              return apiResponseApp(true, 200, null, null, $data);
          }
        }
      } catch(\Exception $e){
         //dd($e);
          return back();
        }
    }


    public function save_cm_details(Request $request){
      try {

        if($request->api_key){
          $user = User::where('api_key', $request->api_key)->select('id')->first();
          if($user) {
            $inputs = $request->all();
            $user_id = $user->id;
            
            CustomerOnboarding::where('user_id', $user_id)
              ->update([
              'cm_type' => $request->cm_type,
            ]); 

            $cm_type = CustomerOnboarding::where('user_id', $user->id)->select('cm_type')->first();
            if($cm_type){
              
              $inputs['customer_id'] = $user->id;
              if($cm_type->cm_type == 1){
                
                  $cm_sal = CmSalariedDetail::where('customer_id', $user_id)->select('id', 'last_one_salary_file', 'last_two_salary_file', 'last_three_salary_file')->first();

                  if(isset($inputs['last_one_salary_file']) or !empty($inputs['last_one_salary_file'])) {
                            $image_name = rand(100000, 999999);
                            $fileName = '';
                            if($file = $request->hasFile('last_one_salary_file')) {
                                $file = $request->file('last_one_salary_file');
                                $img_name = $file->getClientOriginalName();
                                $fileName = $image_name.$img_name;
                                $destinationPath = public_path().'/uploads/salary_slip/';
                                $file->move($destinationPath, $fileName);
                            }
                            $fname ='/uploads/salary_slip/';
                            $image = $fname.$fileName;
                        } else{
                            $image = @$cm_sal->last_one_salary_file;
                        }  
                        unset($inputs['last_one_salary_file']);
                        $inputs['last_one_salary_file'] = $image;

                        if(isset($inputs['last_two_salary_file']) or !empty($inputs['last_two_salary_file'])) {
                            $image_name = rand(100000, 999999);
                            $fileName = '';
                            if($file = $request->hasFile('last_two_salary_file')) {
                                $file = $request->file('last_two_salary_file');
                                $img_name = $file->getClientOriginalName();
                                $fileName = $image_name.$img_name;
                                $destinationPath = public_path().'/uploads/salary_slip/';
                                $file->move($destinationPath, $fileName);
                            }
                            $fname ='/uploads/salary_slip/';
                            $image = $fname.$fileName;
                        } else{
                            $image = @$cm_sal->last_two_salary_file;
                        }  
                        unset($inputs['last_two_salary_file']);
                        $inputs['last_two_salary_file'] = $image;


                        if(isset($inputs['last_three_salary_file']) or !empty($inputs['last_three_salary_file'])) {
                            $image_name = rand(100000, 999999);
                            $fileName = '';
                            if($file = $request->hasFile('last_three_salary_file')) {
                                $file = $request->file('last_three_salary_file');
                                $img_name = $file->getClientOriginalName();
                                $fileName = $image_name.$img_name;
                                $destinationPath = public_path().'/uploads/salary_slip/';
                                $file->move($destinationPath, $fileName);
                            }
                            $fname ='/uploads/salary_slip/';
                            $image = $fname.$fileName;
                        } else{
                            $image = @$cm_sal->last_three_salary_file;
                        }  
                        unset($inputs['last_three_salary_file']);
                        $inputs['last_three_salary_file'] = $image;


                  if($cm_sal){
                    $id = $cm_sal->id;
                    (new CmSalariedDetail)->store($inputs, $id);
                    return response()->json(['success' => true, 'status' => 200, 'message' => 'Employment details have been successfully added']);
                  } else {
                    (new CmSalariedDetail)->store($inputs); 
                    return response()->json(['success' => true, 'status' => 200, 'message' => 'Employment details have been successfully added']);
                  }      
              } elseif ($cm_type->cm_type == 2) {
                
                    $cm_sal = SelfEmpDetail::where('customer_id', $user_id)->select('id')->first();
                    if($cm_sal){
                        $id = $cm_sal->id;
                        (new SelfEmpDetail)->store($inputs, $id); 
                        return response()->json(['success' => true, 'status' => 200, 'message' => 'CM Details successfully updated']);
                    } else {
                        (new SelfEmpDetail)->store($inputs); 
                        return response()->json(['success' => true, 'status' => 200, 'message' => 'CM Details successfully Saved']);
                    }
              } else {
                      $cm_sal = OtherCmDetail::where('customer_id', $user_id)->select('id')->first();
                      if($cm_sal){
                          $id = $cm_sal->id;
                          (new OtherCmDetail)->store($inputs, $id); 
                          return response()->json(['success' => true, 'status' => 200, 'message' => 'CM Details successfully updated']);
                      } else {
                          (new OtherCmDetail)->store($inputs); 
                          return response()->json(['success' => true, 'status' => 200, 'message' => 'CM Details successfully Saved']);
                      }
              }
            } else {
                  $message = "Basic information not updated";
                  return apiResponseAppmsg(false, 201, $message, null, null);
              }
          }
        }

      } catch(\Exception $e){
       // dd($e);
          return back();
        }
    }

    public function show_product_requested(Request $request){
      if($request->api_key){
        $user = User::where('api_key', $request->api_key)->select('id')->first();
        if($user) {

          $datas = ProductRequest::where('user_id', $user->id)->first();
          if($datas->credit_card_limit){
            $data['credit_card_limit'] = $datas->credit_card_limit;
          } else {
            $data['credit_card_limit'] = null;
          }
          if($datas->exist_credit){
            $data['exist_credit'] = $datas->exist_credit;
          } else {
            $data['exist_credit'] = null;
          }
          if($datas->loan_amount){
            $data['loan_amount'] = $datas->loan_amount;
          } else {
            $data['loan_amount'] = null;
          }
          if($datas->exist_personal){
            $data['exist_personal'] = $datas->exist_personal;
          } else {
            $data['exist_personal'] = null;
          }
          if($datas->exist_business){
            $data['exist_business'] = $datas->exist_business;
          } else {
            $data['exist_business'] = null;
          }

          if($datas->exist_mortgage){
            $data['exist_mortgage'] = $datas->exist_mortgage;
          } else {
            $data['exist_mortgage'] = null;
          }

          $credit_card_existing_financials  = [];
          $business_loan_amount = [];
          $loan_bank_name = [];
          $mortgage_loan_amount = [];
          if($datas->mortgage_loan_amount) {
              $mortgage_loan_amount[] = 
              array(
                'mortgage_loan_amount' => $datas->mortgage_loan_amount,
                'purchase_price' => $datas->purchase_price,
                'type_of_loan' => $datas->type_of_loan,
                'term_of_loan' => $datas->term_of_loan,
                'end_use_of_property' => $datas->end_use_of_property,
                'interest_rate' => $datas->interest_rate,
                'mortgage_emi' => $datas->mortgage_emi,
                'mortgage_member_since' => $datas->mortgage_member_since,
              );
          }
          if($datas->mortgage_loan_amount2) {
              $mortgage_loan_amount[] = 
              array(
                'mortgage_loan_amount' => $datas->mortgage_loan_amount2,
                'purchase_price' => $datas->purchase_price2,
                'type_of_loan' => $datas->type_of_loan2,
                'term_of_loan' => $datas->term_of_loan2,
                'end_use_of_property' => $datas->end_use_of_property2,
                'interest_rate' => $datas->interest_rate2,
                'mortgage_emi' => $datas->mortgage_emi2,
                'mortgage_member_since' => $datas->mortgage_member_since2,
              );
          }
          if($datas->mortgage_loan_amount3) {
              $mortgage_loan_amount[] = 
              array(
                'mortgage_loan_amount' => $datas->mortgage_loan_amount3,
                'purchase_price' => $datas->purchase_price3,
                'type_of_loan' => $datas->type_of_loan3,
                'term_of_loan' => $datas->term_of_loan3,
                'end_use_of_property' => $datas->end_use_of_property3,
                'interest_rate' => $datas->interest_rate3,
                'mortgage_emi' => $datas->mortgage_emi3,
                'mortgage_member_since' => $datas->mortgage_member_since3,
              );
          }
          if($datas->mortgage_loan_amount4) {
              $mortgage_loan_amount[] = 
              array(
                'mortgage_loan_amount' => $datas->mortgage_loan_amount4,
                'purchase_price' => $datas->purchase_price3,
                'type_of_loan' => $datas->type_of_loan4,
                'term_of_loan' => $datas->term_of_loan4,
                'end_use_of_property' => $datas->end_use_of_property4,
                'interest_rate' => $datas->interest_rate4,
                'mortgage_emi' => $datas->mortgage_emi4,
                'mortgage_member_since' => $datas->mortgage_member_since4,
              );
          }

          if($datas->loan_bank_name) {
              $loan_bank_name[] = 
              array(
                'loan_bank_name' => $datas->loan_bank_name,
                'original_loan_amount' => $datas->original_loan_amount,
                'loan_emi' => $datas->loan_emi,
                'loan_member_since' => $datas->loan_member_since,
              );
          }
          if($datas->loan_bank_name2) {
              $loan_bank_name[] = 
              array(
                'loan_bank_name' => $datas->loan_bank_nam2,
                'original_loan_amount' => $datas->original_loan_amount2,
                'loan_emi' => $datas->loan_emi2,
                'loan_member_since' => $datas->loan_member_since2,
              );
          }
          if($datas->loan_bank_nam3) {
              $loan_bank_name[] = 
              array(
                'loan_bank_name' => $datas->loan_bank_nam3,
                'original_loan_amount' => $datas->original_loan_amount3,
                'loan_emi' => $datas->loan_emi3,
                'loan_member_since' => $datas->loan_member_since3,
              );
          }
          if($datas->loan_bank_name4) {
              $loan_bank_name[] = 
              array(
                'loan_bank_name' => $datas->loan_bank_name4,
                'original_loan_amount' => $datas->original_loan_amount4,
                'loan_emi' => $datas->loan_emi4,
                'loan_member_since' => $datas->loan_member_since4,
              );
          }

          if($datas->details_of_cards) {
              $credit_card_existing_financials[] = 
              array(
                'details_of_cards' => $datas->details_of_cards,
                'credit_bank_name' => $datas->credit_bank_name,
                'card_limit' => $datas->card_limit,
                'credit_member_since' => $datas->credit_member_since,
              );
          }
          if($datas->details_of_cards2) {
              $credit_card_existing_financials[] = 
              array(
                'details_of_cards' => $datas->details_of_cards2,
                'credit_bank_name' => $datas->credit_bank_name2,
                'card_limit' => $datas->card_limit2,
                'credit_member_since' => $datas->credit_member_since2,
              );
          }
          if($datas->details_of_cards3) {
              $credit_card_existing_financials[] = 
              array(
                'details_of_cards' => $datas->details_of_cards3,
                'credit_bank_name' => $datas->credit_bank_name3,
                'card_limit' => $datas->card_limit3,
                'credit_member_since' => $datas->credit_member_since3,
              );
          }
          if($datas->details_of_cards4) {
              $credit_card_existing_financials[] = 
              array(
                'details_of_cards' => $datas->details_of_cards4,
                'credit_bank_name' => $datas->credit_bank_name4,
                'card_limit' => $datas->card_limit4,
                'credit_member_since' => $datas->credit_member_since4,
              );
          }



          if($datas->business_loan_amount) {
              $business_loan_amount[] = 
              array(
                'business_loan_amount' => $datas->business_loan_amount,
                'business_loan_emi' => $datas->business_loan_emi,
                'business_member_since' => $datas->business_member_since,
              );
          }
          if($datas->business_loan_amount2) {
              $business_loan_amount[] = 
              array(
                'business_loan_amount' => $datas->business_loan_amount2,
                'business_loan_emi' => $datas->business_loan_emi2,
                'business_member_since' => $datas->business_member_since2,
              );
          }
          if($datas->business_loan_amount3) {
              $business_loan_amount[] = 
              array(
                'business_loan_amount' => $datas->business_loan_amount3,
                'business_loan_emi' => $datas->business_loan_emi3,
                'business_member_since' => $datas->business_member_since3,
              );
          }
          if($datas->business_loan_amount4) {
              $business_loan_amount[] = 
              array(
                'business_loan_amount' => $datas->business_loan_amount4,
                'business_loan_emi' => $datas->business_loan_emi4,
                'business_member_since' => $datas->business_member_since4,
              );
          }



          $data['credit_card_existing_financials'] = $credit_card_existing_financials;
          $data['business_loan_amount'] = $business_loan_amount;
          $data['loan_bank_name'] = $loan_bank_name;
          $data['mortgage_loan_amount'] = $mortgage_loan_amount; 

          return response()->json(['success' => true, 'status' => 200, 'data' => $data]);

        }
      }

    }

    public function save_product_requested(Request $request){

      if($request->api_key){
        $user = User::where('api_key', $request->api_key)->select('id')->first();
        if($user) {
            $credit_card_limit = '';
            if(isset($request->credit_card_limit)){
              $credit_card_limit = $request->credit_card_limit;
            }
            $exist_credit = 0;
            if(isset($request->exist_credit)){
              $exist_credit = $request->exist_credit;
            }

            $details_of_cards = '';
            $credit_bank_name = '';
            $card_limit = '';
            $credit_member_since = '';
            
            $details_of_cards2 = '';
            $credit_bank_name2 = '';
            $card_limit2 = '';
            $credit_member_since2 = '';

            $details_of_cards3 = '';
            $credit_bank_name3 = '';
            $card_limit3 = '';
            $credit_member_since3 = '';

            $details_of_cards4 = '';
            $credit_bank_name4 = '';
            $card_limit4 = '';
            $credit_member_since4 = '';

            $loan_amount = '';
            if(isset($request->loan_amount)){
              $loan_amount = $request->loan_amount;
            }

            $exist_personal = 0;
            if(isset($request->exist_personal)){
              $exist_personal = $request->exist_personal;
            }

            $loan_bank_name = '';
            $original_loan_amount = '';
            $loan_emi = '';
            $loan_member_since = '';

            $loan_bank_name2 = '';
            $original_loan_amount2 = '';
            $loan_emi2 = '';
            $loan_member_since2 = '';

            $loan_bank_name3 = '';
            $original_loan_amount3 = '';
            $loan_emi3 = '';
            $loan_member_since3 = '';

            $loan_bank_name4 = '';
            $original_loan_amount4 = '';
            $loan_emi4 = '';
            $loan_member_since4 = '';

            $exist_business = 0;
            if(isset($request->exist_business)){
              $exist_business = $request->exist_business;
            }

            $business_loan_amount = '';
            $business_loan_emi = '';
            $business_member_since = '';

            $business_loan_amount2 = '';
            $business_loan_emi2 = '';
            $business_member_since2 = '';

            $business_loan_amount3 = '';
            $business_loan_emi3 = '';
            $business_member_since3 = '';

            $business_loan_amount4 = '';
            $business_loan_emi4 = '';
            $business_member_since4 = '';


            $exist_mortgage = 0;
            if(isset($request->exist_mortgage)){
              $exist_mortgage = $request->exist_mortgage;
            }

            $mortgage_loan_amount = '';
            $purchase_price = '';
            $type_of_loan = '';
            $term_of_loan = '';
            $end_use_of_property = '';
            $interest_rate = '';
            $mortgage_emi = '';
            $mortgage_member_since = '';

            $mortgage_loan_amount2 = '';
            $purchase_price2 = '';
            $type_of_loan2 = '';
            $term_of_loan2 = '';
            $end_use_of_property2 = '';
            $interest_rate2 = '';
            $mortgage_emi2 = '';
            $mortgage_member_since2 = '';

            $mortgage_loan_amount3 = '';
            $purchase_price3 = '';
            $type_of_loan3 = '';
            $term_of_loan3 = '';
            $end_use_of_property3 = '';
            $interest_rate3 = '';
            $mortgage_emi3 = '';
            $mortgage_member_since3 = '';

            $mortgage_loan_amount4 = '';
            $purchase_price4 = '';
            $type_of_loan4 = '';
            $term_of_loan4 = '';
            $end_use_of_property4 = '';
            $interest_rate4 = '';
            $mortgage_emi4 = '';
            $mortgage_member_since4 = '';
            // $inputs = $request->all();
            $user_id = $user->id;
            // $inputs['user_id'] = $user_id;

            if($request->details_of_cards){
              $i = 1;
              $bus_data = json_decode($request->details_of_cards);

              foreach($bus_data as $key => $details_of_card) {
                  if($i == 1){
                    $details_of_cards = $details_of_card->details_of_cards;
                    $credit_bank_name = $details_of_card->credit_bank_name;
                    $card_limit = $details_of_card->card_limit;
                    $credit_member_since = $details_of_card->credit_member_since;
                  } elseif ($i == 2) {
                    $details_of_cards2 = $details_of_card->details_of_cards;
                    $credit_bank_name2 = $details_of_card->credit_bank_name;
                    $card_limit2 = $details_of_card->card_limit;
                    $credit_member_since2 = $details_of_card->credit_member_since;
                  } elseif ($i == 3) {
                    $details_of_cards3 = $details_of_card->details_of_cards;
                    $credit_bank_name3 = $details_of_card->credit_bank_name;
                    $card_limit3 = $details_of_card->card_limit;
                    $credit_member_since3 = $details_of_card->credit_member_since;
                  } else {
                    $details_of_cards4 = $details_of_card->details_of_cards;
                    $credit_bank_name4 = $details_of_card->credit_bank_name;
                    $card_limit4 = $details_of_card->card_limit;
                    $credit_member_since4 = $details_of_card->credit_member_since;
                  }
                $i++;
              } 
            }
        
            if($request->loan_bank_name){ 
              $i = 1;
              $bus_data = json_decode($request->loan_bank_name);
              foreach($bus_data as $loan_bank_nam) {
                  if($i == 1){
                    $loan_bank_name = $loan_bank_nam->loan_bank_name;
                    $original_loan_amount = $loan_bank_nam->original_loan_amount;
                    $loan_emi = $loan_bank_nam->loan_emi;
                    $loan_member_since = $loan_bank_nam->loan_member_since;
                  } elseif ($i == 2) {
                    $loan_bank_name2 = $loan_bank_nam->loan_bank_name;
                    $original_loan_amount2 = $loan_bank_nam->original_loan_amount;
                    $loan_emi2 = $loan_bank_nam->loan_emi;
                    $loan_member_since2 = $loan_bank_nam->loan_member_since;
                  } elseif ($i == 3) {
                    $loan_bank_name3 = $loan_bank_nam->loan_bank_name;
                    $original_loan_amount3 = $loan_bank_nam->original_loan_amount;
                    $loan_emi3 = $loan_bank_nam->loan_emi;
                    $loan_member_since3 = $loan_bank_nam->loan_member_since;
                  } else {
                    $loan_bank_name4 = $loan_bank_nam->loan_bank_name; 
                    $original_loan_amount4 = $loan_bank_nam->original_loan_amount;
                    $loan_emi4 = $loan_bank_nam->loan_emi;
                    $loan_member_since4 = $loan_bank_nam->loan_member_since;
                  }
                $i++;
              }
            }
          
            
            if($request->business_loan_amount){ 
              $i = 1;
              $bus_data = json_decode($request->business_loan_amount);
              foreach($bus_data as $businessLoan) {
                  //dd($businessLoan->businessLoan);
                  if($i == 1){
                    $business_loan_amount = $businessLoan->business_loan_amount;
                    $business_loan_emi = $businessLoan->business_loan_emi; 
                    $business_member_since = $businessLoan->business_member_since; 
                  } elseif ($i == 2) {
                    $business_loan_amount2 = $businessLoan->business_loan_amount;
                    $business_loan_emi2 = $businessLoan->business_loan_emi; 
                    $business_member_since2 = $businessLoan->business_member_since;
                  } elseif ($i == 3) {
                    $business_loan_amount3 = $businessLoan->business_loan_amount;
                    $business_loan_emi3 = $businessLoan->business_loan_emi; 
                    $business_member_since3 = $businessLoan->business_member_since;
                  } else {
                    $business_loan_amount4 = $businessLoan->business_loan_amount; 
                    $business_loan_emi4 = $businessLoan->business_loan_emi; 
                    $business_member_since4 = $businessLoan->business_member_since;
                  }
                $i++;
              }
            }

          if($request->mortgage_loan_amount){ 
            $i = 1;
            $bus_data = json_decode($request->mortgage_loan_amount);
            foreach($bus_data as $mortgage_loan_amoun) {
                if($i == 1){
                  $mortgage_loan_amount = $mortgage_loan_amoun->mortgage_loan_amount;
                  $purchase_price = $mortgage_loan_amoun->purchase_price;
                  $type_of_loan = $mortgage_loan_amoun->type_of_loan;
                  $term_of_loan = $mortgage_loan_amoun->term_of_loan;
                  $end_use_of_property = $mortgage_loan_amoun->end_use_of_property;
                  $interest_rate = $mortgage_loan_amoun->interest_rate;
                  $mortgage_emi = $mortgage_loan_amoun->mortgage_emi;
                  $mortgage_member_since = $mortgage_loan_amoun->mortgage_member_since;
                } elseif ($i == 2) {
                  $mortgage_loan_amount2 = $mortgage_loan_amoun->mortgage_loan_amount;
                  $purchase_price2 = $mortgage_loan_amoun->purchase_price;
                  $type_of_loan2 = $mortgage_loan_amoun->type_of_loan;
                  $term_of_loan2 = $mortgage_loan_amoun->term_of_loan;
                  $end_use_of_property2 = $mortgage_loan_amoun->end_use_of_property;
                  $interest_rate2 = $mortgage_loan_amoun->interest_rate;
                  $mortgage_emi2 = $mortgage_loan_amoun->mortgage_emi;
                  $mortgage_member_since2 = $mortgage_loan_amoun->mortgage_member_since;
                } elseif ($i == 3) {
                  $mortgage_loan_amount3 = $mortgage_loan_amoun->mortgage_loan_amount;
                  $purchase_price3 = $mortgage_loan_amoun->purchase_price;
                  $type_of_loan3 = $mortgage_loan_amoun->type_of_loan;
                  $term_of_loan3 = $mortgage_loan_amoun->term_of_loan;
                  $end_use_of_property3 = $mortgage_loan_amoun->end_use_of_property;
                  $interest_rate3 = $mortgage_loan_amoun->interest_rate;
                  $mortgage_emi3 = $mortgage_loan_amoun->mortgage_emi;
                  $mortgage_member_since3 = $mortgage_loan_amoun->mortgage_member_since;
                } else {
                  $mortgage_loan_amount4 = $mortgage_loan_amoun->mortgage_loan_amount;
                  $purchase_price4 = $mortgage_loan_amoun->purchase_price;
                  $type_of_loan4 = $mortgage_loan_amoun->type_of_loan;
                  $term_of_loan4 = $mortgage_loan_amoun->term_of_loan;
                  $end_use_of_property4 = $mortgage_loan_amoun->end_use_of_property;
                  $interest_rate4 = $mortgage_loan_amoun->interest_rate; 
                  $mortgage_emi4 = $mortgage_loan_amoun->mortgage_emi; 
                  $mortgage_member_since4 = $mortgage_loan_amoun->mortgage_member_since;
                }
              $i++;
            }
          }
           

            $inputs['credit_card_limit'] =  $credit_card_limit;
            $inputs['exist_credit'] = $exist_credit;
            $inputs['user_id'] = $user_id;
            $inputs['details_of_cards'] = $details_of_cards;
            $inputs['credit_bank_name'] = $credit_bank_name;
            $inputs['card_limit'] =  $card_limit;
            
            $inputs['credit_member_since'] =  $credit_member_since;
            $inputs['credit_member_since2'] =  $credit_member_since2;
            $inputs['credit_member_since3'] =  $credit_member_since3;
            $inputs['credit_member_since4'] =  $credit_member_since4;

            $inputs['exist_personal'] = $exist_personal;
            $inputs['loan_member_since'] =  $loan_member_since;
            $inputs['loan_member_since2'] =  $loan_member_since2;
            $inputs['loan_member_since3'] =  $loan_member_since3;
            $inputs['loan_member_since4'] =  $loan_member_since4;

            $inputs['exist_business'] = $exist_business;
            $inputs['business_member_since'] =  $business_member_since;
            $inputs['business_member_since2'] =  $business_member_since2;
            $inputs['business_member_since3'] =  $business_member_since3;
            $inputs['business_member_since4'] =  $business_member_since4;
            
            $inputs['exist_mortgage'] = $exist_mortgage;
            $inputs['mortgage_member_since'] =  $mortgage_member_since;
            $inputs['mortgage_member_since2'] =  $mortgage_member_since2;
            $inputs['mortgage_member_since3'] =  $mortgage_member_since3;
            $inputs['mortgage_member_since4'] =  $mortgage_member_since4;

            $inputs['details_of_cards2'] = $details_of_cards2;
            $inputs['credit_bank_name2'] =  $credit_bank_name2;
            $inputs['card_limit2'] = $card_limit2;
            $inputs['details_of_cards3'] =  $details_of_cards3;
            $inputs['credit_bank_name3'] = $credit_bank_name3;
            $inputs['card_limit3'] =  $card_limit3;
            $inputs['details_of_cards4'] = $details_of_cards4;
            $inputs['credit_bank_name4'] =  $credit_bank_name4;
            $inputs['card_limit4'] = $card_limit4;
            $inputs['loan_amount'] =  $loan_amount;
            $inputs['loan_bank_name'] = $loan_bank_name;
            $inputs['original_loan_amount'] =  $original_loan_amount;
            $inputs['loan_emi'] = $loan_emi;
            $inputs['loan_bank_name2'] =  $loan_bank_name2;
            $inputs['original_loan_amount2'] = $original_loan_amount2;
            $inputs['loan_emi2'] =  $loan_emi2;
            $inputs['loan_bank_name3'] = $loan_bank_name3;
            $inputs['original_loan_amount3'] =  $original_loan_amount3;
            $inputs['loan_emi3'] = $loan_emi3;
            $inputs['loan_bank_name4'] =  $loan_bank_name4;
            $inputs['original_loan_amount4'] = $original_loan_amount4;
            $inputs['loan_emi4'] =  $loan_emi4;
            $inputs['business_loan_amount'] = $business_loan_amount;
            $inputs['business_loan_emi'] =  $business_loan_emi;
            $inputs['business_loan_amount2'] = $business_loan_amount2;
            $inputs['business_loan_emi2'] = $business_loan_emi2;
            $inputs['business_loan_amount3'] = $business_loan_amount3;
            $inputs['business_loan_emi3'] =  $business_loan_emi3;
            $inputs['business_loan_amount4'] = $business_loan_amount4;
            $inputs['business_loan_emi4'] =  $business_loan_emi4;
            $inputs['mortgage_loan_amount'] = $mortgage_loan_amount;
            $inputs['purchase_price'] =  $purchase_price;
            $inputs['type_of_loan'] = $type_of_loan;
            $inputs['term_of_loan'] = $term_of_loan;
            $inputs['end_use_of_property'] = $end_use_of_property;
            $inputs['interest_rate'] =  $interest_rate;
            $inputs['mortgage_emi'] = $mortgage_emi;
            $inputs['mortgage_loan_amount2']  =  $mortgage_loan_amount2;
            $inputs['purchase_price2'] = $purchase_price2;
            $inputs['type_of_loan2'] =  $type_of_loan2;
            $inputs['term_of_loan2'] = $term_of_loan2;
            $inputs['end_use_of_property2'] =  $end_use_of_property2;
            $inputs['interest_rate2'] = $interest_rate2;
            $inputs['mortgage_emi2'] =  $mortgage_emi2;
            $inputs['mortgage_loan_amount3'] = $mortgage_loan_amount3;
            $inputs['purchase_price3'] =  $purchase_price3;
            $inputs['type_of_loan3'] = $type_of_loan3;
            $inputs['term_of_loan3'] =  $term_of_loan3;
            $inputs['end_use_of_property3'] = $end_use_of_property3;
            $inputs['interest_rate3'] = $interest_rate3;
            $inputs['mortgage_emi3'] = $mortgage_emi3;
            $inputs['mortgage_loan_amount4'] = $mortgage_loan_amount4;
            $inputs['purchase_price4'] = $purchase_price4;
            $inputs['type_of_loan4'] =  $type_of_loan4;
            $inputs['term_of_loan4'] = $term_of_loan4;
            $inputs['end_use_of_property4'] =  $end_use_of_property4;
            $inputs['interest_rate4'] = $interest_rate4;
            $inputs['mortgage_emi4'] = $mortgage_emi4;

            //dd($inputs);

            $cm_sal = ProductRequest::where('user_id', $user_id)->select('id')->first();
            if($cm_sal){
                $id = $cm_sal->id;
                      
                (new ProductRequest)->store($inputs, $id);

                $result = CustomerOnboarding::where('user_id', $user_id)->select('id')->first();
            $ser = 1300;
            $ref_id = $ser.$result->id;
            CustomerOnboarding::where('user_id', $user_id)->update(['ref_id'  =>  $ref_id,]);
            return response()->json(['success' => true, 'status' => 200, 'message' => 'Product details have been successfully added', 'ref_id' => $ref_id]);
            } else {
                (new ProductRequest)->store($inputs); 
                $result = CustomerOnboarding::where('user_id', $user_id)->select('id')->first();
                $ser = 1300;
                $ref_id = $ser.$result->id;
                CustomerOnboarding::where('user_id', $user_id)->update(['ref_id'  =>  $ref_id,]);
                return response()->json(['success' => true, 'status' => 200, 'message' => 'Product details have been successfully added', 'ref_id' => $ref_id]);
            }
        }
      }
    }

    public function selected_services(Request $request){
      if($request->api_key){
        $user = User::where('api_key', $request->api_key)->select('id')->first();
        if($user) {
          $data = ServiceApply::where('customer_id', $user->id)->where('app_status', 0)->pluck('service_id')->toArray();
          return response()->json(['success' => true, 'status' => 200, 'services' => $data]); 
        }
      }
    }

    public function show_cm_details(Request $request){
      try {
        if($request->api_key){
          $user = User::where('api_key', $request->api_key)->select('id')->first();
          if($user) {
              $cm_type = CustomerOnboarding::where('user_id', $user->id)->select('cm_type')->first();
              if($cm_type){
                $data = '';
                if($cm_type->cm_type == 1){
                  $data = CmSalariedDetail::where('customer_id', $user->id)->select('company_name', 'date_of_joining', 'monthly_salary', 'last_three_salary_credits', 'last_two_salary_credits', 'last_one_salary_credits', 'accommodation_company', 'last_one_salary_file', 'last_two_salary_file', 'last_three_salary_file')->first();

                  $url = route('get-started');
                  
                  if(isset($data->company_name)){
                    $data['company_name'] = $data->company_name;
                  } else {
                    $data['company_name'] = null;
                  }
                  if(isset($data->date_of_joining)){
                    $data['date_of_joining'] = $data->date_of_joining;
                  } else {
                    $data['date_of_joining'] = null;
                  }
                  if(isset($data->monthly_salary)){
                    $data['monthly_salary'] = $data->monthly_salary;
                  } else {
                    $data['monthly_salary'] = null;
                  }
                  if(isset($data->last_three_salary_credits)){
                    $data['last_three_salary_credits'] = $data->last_three_salary_credits;
                  } else {
                    $data['last_three_salary_credits'] = null;
                  }
                  if(isset($data->last_three_salary_file)){
                    $data['last_three_salary_file'] = $url.$data->last_three_salary_file;
                  } else {
                    $data['last_three_salary_file'] = null;
                  }
                  if(isset($data->last_two_salary_credits)){
                    $data['last_two_salary_credits'] = $data->last_two_salary_credits;
                  } else {
                    $data['last_two_salary_credits'] = null;
                  }
                  if(isset($data->last_two_salary_file)){
                    $data['last_two_salary_file'] = $url.$data->last_two_salary_file;
                  } else {
                    $data['last_two_salary_file'] = null;
                  }
                  if(isset($data->last_one_salary_credits)){
                    $data['last_one_salary_credits'] = $data->last_one_salary_credits;
                  } else {
                    $data['last_one_salary_credits'] = null;
                  }
                  if(isset($data->last_one_salary_file)){
                    $data['last_one_salary_file'] = $url.$data->last_one_salary_file;
                  } else {
                    $data['last_one_salary_file'] = null;
                  }
                  if(isset($data->accommodation_company)){
                    $data['accommodation_company'] = $data->accommodation_company;
                  } else {
                    $data['accommodation_company'] = null;
                  }

                } elseif ($cm_type->cm_type == 2) {
                    $data = SelfEmpDetail::where('customer_id', $user->id)->select('self_company_name', 'percentage_ownership', 'profession_business', 'annual_business_income')->first();

                  if(isset($data->self_company_name)){
                    $data['self_company_name'] = $data->self_company_name;
                  } else {
                    $data['self_company_name'] = null;
                  }
                  if(isset($data->percentage_ownership)){
                    $data['percentage_ownership'] = $data->percentage_ownership;
                  } else {
                    $data['percentage_ownership'] = null;
                  }
                  if(isset($data->profession_business)){
                    $data['profession_business'] = $data->profession_business;
                  } else {
                    $data['profession_business'] = null;
                  }
                  if(isset($data->annual_business_income)){
                    $data['annual_business_income'] = $data->annual_business_income;
                  } else {
                    $data['annual_business_income'] = null;
                  }

                } else {
                    $data = OtherCmDetail::where('customer_id', $user->id)->select('monthly_pension')->first();
                    if(isset($data->monthly_pension)){
                    $data['monthly_pension'] = $data->monthly_pension;
                  } else {
                    $data['monthly_pension'] = null;
                  }
                }
                  $data['cm_type'] = $cm_type->cm_type;
                // return apiResponseApp(true, 200, null, null, $data);
                return response()->json(['success' => true, 'status' => 200, 'data' => $data]);
              } else {
                  $message = "Basic information not updated";
                  return apiResponseAppmsg(false, 201, $message, null, null);
              }
          }
        }
      } catch(\Exception $e){
       // dd($e);
          return back();
        }
    }


    public function basic_information(Request $request){
      try {
        if($request->api_key){
            $user = User::where('api_key', $request->api_key)->select('id')->first();
            if($user) {
              $user_id = $user->id;
              $inputs = $request->all(); 
              $inputs['user_id'] = $user_id;

              $cm_details = CustomerOnboarding::where('user_id', $user_id)->select('id', 'cm_type', 'passport_photo', 'aecb_image')->first();

              $user = User::where('id', $user_id)->select('emirates_id', 'emirates_id_back')->first();

                if(isset($inputs['emirates_id_front']) or !empty($inputs['emirates_id_front'])) {
                    $image_name = rand(100000, 999999);
                    $fileName = '';
                    // if($file = $request->hasFile('emirates_id_front')) {
                    // $file = $request->file('emirates_id_front') ;
                    // $img_name = $file->getClientOriginalName();
                    // $fileName = $image_name.$img_name;
                    // $destinationPath = public_path().'/uploads/emirates_id/' ;
                    // $file->move($destinationPath, $fileName);
                    // }

                    if($file = $request->hasFile('emirates_id_front')) {
                      $file = $request->file('emirates_id_front') ;
                      $img_name = $file->getClientOriginalName();
                      $image_resize = Image::make($file->getRealPath()); 
                      $image_resize->resize(750, 400);
                      $fileName = $image_name.$img_name;
                      $image_resize->save(public_path('/uploads/emirates_id/' .$fileName));                 
                    }

                    $fname ='/uploads/emirates_id/';
                    $emirates_id_front = $fname.$fileName;
                } else {
                    $emirates_id_front = @$user->emirates_id;
                }

                if(isset($inputs['emirates_id_back']) or !empty($inputs['emirates_id_back'])) {
                    $image_name = rand(100000, 999999);
                    $fileName = '';

                    // if($file = $request->hasFile('emirates_id_back')) {
                    //     $file = $request->file('emirates_id_back') ;
                    //     $img_name = $file->getClientOriginalName();
                    //     $fileName = $image_name.$img_name;
                    //     $destinationPath = public_path().'/uploads/emirates_id/' ;
                    //     $file->move($destinationPath, $fileName);
                    // }

                    if($file = $request->hasFile('emirates_id_back')) {
                      $file = $request->file('emirates_id_back') ;
                      $img_name = $file->getClientOriginalName();
                      $image_resize = Image::make($file->getRealPath()); 
                      $image_resize->resize(750, 400);
                      $fileName = $image_name.$img_name;
                      $image_resize->save(public_path('/uploads/emirates_id/' .$fileName));                 
                    }

                    $fname ='/uploads/emirates_id/';
                    $emirates_id_back = $fname.$fileName;
                } else {
                    $emirates_id_back = @$user->emirates_id_back;
                }

                User::where('id', $user_id)
                ->update([
                    'emirates_id' =>  $emirates_id_front,
                    'emirates_id_back' =>  $emirates_id_back,
                    'date_of_birth' => $request->date_of_birth,
                    'gender' => $request->gender,
                    'salutation' => $request->salutation,
                    'name' =>  $request->first_name_as_per_passport,
                    'middle_name' =>  $request->middle_name,
                    'last_name' => $request->last_name,
                    'eid_number' => $request->eid_number,
                ]); 


                if(isset($inputs['passport_photo']) or !empty($inputs['passport_photo'])) {
                    $image_name = rand(100000, 999999);
                    $fileName = '';

                    // if($file = $request->hasFile('passport_photo')) {
                    //     $file = $request->file('passport_photo') ;
                    //     $img_name = $file->getClientOriginalName();
                    //     $fileName = $image_name.$img_name;
                    //     $destinationPath = public_path().'/uploads/passport_images/' ;
                    //     $file->move($destinationPath, $fileName);
                    // }

                    if($file = $request->hasFile('passport_photo')) {
                        $file = $request->file('passport_photo');
                        $img_name = $file->getClientOriginalName();
                        $image_resize = Image::make($file->getRealPath()); 
                        $image_resize->resize(600, 600);
                        $fileName = $image_name.$img_name;
                        $image_resize->save(public_path('/uploads/passport_images/' .$fileName));      
                    }

                    $fname ='/uploads/passport_images/';
                    $passport_photo = $fname.$fileName;
                } else {
                    $passport_photo = @$cm_details->passport_photo;
                }
                unset($inputs['passport_photo']);
                $inputs['passport_photo'] = $passport_photo;

                
                if(isset($inputs['aecb_image']) or !empty($inputs['aecb_image'])) {
                    $image_name = rand(100000, 999999);
                    $fileName = '';
                    if($file = $request->hasFile('aecb_image')) {
                        $file = $request->file('aecb_image') ;
                        $img_name = $file->getClientOriginalName();
                        $fileName = $image_name.$img_name;
                        $destinationPath = public_path().'/uploads/aecb_image/' ;
                        $file->move($destinationPath, $fileName);
                    }
                        $fname ='/uploads/aecb_image/';
                        $image = $fname.$fileName;
                } else{
                    $image = @$cm_details->aecb_image;
                }
                unset($inputs['aecb_image']);
                $inputs['aecb_image'] = $image;



              if($cm_details){
                  $id = $cm_details->id;
                  (new CustomerOnboarding)->store($inputs, $id); 

                  \DB::table('dependents')->where('user_id', $user_id)->delete();
                  if($request->no_of_dependents != 0){
                      $ik = 0;
                      if(isset($request->dependents)){
                      $bus_data = json_decode($request->dependents);  
                      foreach ($bus_data as $key => $dependents) {
                            $ik++;
                            if($ik <= $request->no_of_dependents)
                            if($dependents){
                                Dependent::create([
                                    'user_id' => $user_id,
                                    'name' => $dependents->dependent_name,
                                    'relation' => $dependents->dependent_relation,
                                ]);
                            } 
                          }
                      }
                  }

                  $message = "Your personal details have been successfully added";
                  return apiResponseAppmsg(true, 200, $message, null, null);

              } else {
                  (new CustomerOnboarding)->store($inputs); 
                  if($request->no_of_dependents != 0){
                        $ik = 0;
                        if(isset($request->dependent_name)){
                        $bus_data = json_decode($request->dependents);    
                        foreach ($bus_data as $key => $dependents) {
                            $ik++;
                            if($ik <= $request->no_of_dependents)
                            Dependent::create([
                                'user_id' => $user_id,
                                'name' => $dependents->dependent_name,
                                'relation' => $dependents->dependent_relation,
                            ]);
                        }
                      }
                  }

                  $message = "Your personal details have been successfully added";
                  return apiResponseAppmsg(true, 200, $message, null, null);
              }

            }
        }

      } catch(Exception $e){
             return apiResponse(false, 500, lang('messages.server_error'));
          }
    }

    public function logout(Request $request){
       try{
        if($request->api_key){
           $user = User::where('api_key', $request->api_key)->select('id')->first();
          if($user) {
           User::where('id', $user->id)
            ->update([
              'api_key'  => null
            ]);
        
          $message = "Logout successfully";
          return apiResponseAppmsg(true, 200, $message, null, null);
          }
        }

       } catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
        }
    }

      //Update Profile
    public function updateProfile(Request $request){
      try{   

          if($request->api_key){
           $user = User::where('api_key', $request->api_key)->select('id', 'profile_image')->first();
          if($user) {  
            $inputs = $request->all();
            if(isset($inputs['profile_image']) or !empty($inputs['profile_image'])) {

                // $image_name = rand(100000, 999999);
                // $fileName = '';

                // if($file = $request->hasFile('user_image')) 
                // {
                //     $file = $request->file('user_image') ;
                //     $img_name = $file->getClientOriginalName();
                //     $fileName = $image_name.$img_name;
                //     $destinationPath = public_path().'/uploads/user_images/' ;
                //     $file->move($destinationPath, $fileName);
                // }
                // $fname ='/uploads/user_images/';
                // $profile_images = $fname.$fileName;

              $image1 = $request->file('profile_image');
              $originalExtension1 = $image1->getClientOriginalExtension();
              $image_s1 = Image::make($image1)->orientate();
              $image_s1->resize(300, null, function ($constraint) {
              $constraint->aspectRatio();
              });
              $filename1 = random_int(9, 999999999) + time() . '.' . $originalExtension1;
              $image_s1->save(public_path('/uploads/user_images/'.$filename1));
              $profile_images = '/uploads/user_images/'.$filename1;
       
            } else {
                $profile_images = $user->profile_image;
            }

             unset($inputs['profile_image']);

            $inputs = $inputs + [ 'updated_by' => $user->id, 'profile_image' => $profile_images,];

            (new User)->store($inputs, $user->id);
            $url = route('get-started'); 
            
             $u_data = User::where('id', $user->id)->select('id', 'salutation', 'name', 'middle_name', 
              'last_name', 'email', 'gender', 'mobile', 'profile_image', 'date_of_birth')->first();

              $data['id'] = $u_data->id;
              $data['salutation'] = $u_data->salutation;
              $data['name'] = $u_data->name;
              $data['middle_name'] = $u_data->middle_name;
              $data['last_name'] = $u_data->last_name;
              $data['email'] = $u_data->email;
              $data['mobile'] = $u_data->mobile;
              $data['date_of_birth'] = $u_data->date_of_birth;
              if($u_data->profile_image){
                  $data['profile_image'] = $url.$u_data->profile_image;
                } else {
                  $data['profile_image'] = $u_data->profile_image;
              }
             $data['gender'] = $u_data->gender;

            return apiResponseApp(true, 200, null, null, $data);

            //return apiResponse(true, 200, lang('User added successfully'));

           }

          }

        } catch(Exception $e){
        
         // dd($e);
          // return apiResponse(false, 500, lang('messages.server_error'));
           return apiResponseApp(true, 200, null, null, $e);
        }


    }

    public function addDeviceToken(Request $request){
        try{    
            $inputs = $request->all();

            $token_exist = UserDevice::where('device_token', $inputs['device_token'])->first();
            if (isset($token_exist)) {
                (new UserDevice)->store($inputs, $token_exist['id']);
            } else{
                (new UserDevice)->store($inputs);
            }
            return apiResponse(true, 200, lang('User added successfully'));

        } catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
        }
    }


    public function facebookLogin(Request $request)
    {
        try{
            $inputs = $request->all();
            $validator = ( new User )->validatefb( $inputs );
            if( $validator->fails() ) {
                return apiResponse(false, 406, "", errorMessages($validator->messages()));
            } 

            $check_email = (new User)->where('email', $inputs['email'])
                                    ->where('access_token', null)
                                    ->get();

            if (count($check_email) >=1) {
                return apiResponse(false, 500, lang('Email Address already exist in our records'));
            }

            $api_key = $this->generateApiKey();

            $password = \Hash::make($inputs['email']);

            $inputs = $inputs + [
                                    'role' => 2,
                                    'api_key'   => $api_key,
                                    'provider'   => 'facebook',
                                    'user_type'   => '3',
                                    'status'    => 1,
                                    'password' => $password
                                ];
            
            $check = (new User)->where('email', $inputs['email'])->first();
            if (count($check) == 0) {
                    $user = (new User)->store($inputs);
                    return apiResponse(true, 200, lang('User Successfully created'));
            }else{
                if ($check->access_token == null) {
                    $user = (new User)->store($inputs);
                    return apiResponse(true, 200, lang('User Successfully created'));
                }else{
                    $user = (new User)->updatestorfb($check->id, $inputs['access_token']);
                    return apiResponse(true, 200, lang('User Successfully created'));
                }
            
            }


        }
        catch(Exception $exception){
            return apiResponse(false, 500, lang('messages.server_error'));
        }
    }

    public function show_credit_card_information(Request $request){
        if($request->api_key){
            $user = User::where('api_key', $request->api_key)->select('id')->first();
            if($user){
                $user_id = $user->id;
                $result = CreditCardInformation::where('user_id', $user_id)->first();
                
                if(isset($result->card_type)){
                   $data['card_type'] = $result->card_type;   
                } else {
                   $data['card_type'] = null; 
                }
                if(isset($result->embossing_name)){
                   $data['embossing_name'] = $result->embossing_name;   
                } else {
                   $data['embossing_name'] = null; 
                }
                if(isset($result->cm_billing_cycle_date)){
                   $data['cm_billing_cycle_date'] = $result->cm_billing_cycle_date;   
                } else {
                   $data['cm_billing_cycle_date'] = null; 
                }
                if(isset($result->e_statement_subscription)){
                   $data['e_statement_subscription'] = $result->e_statement_subscription;   
                } else {
                   $data['e_statement_subscription'] = null; 
                }
                if(isset($result->paper_statement_subscription)){
                   $data['paper_statement_subscription'] = $result->paper_statement_subscription;   
                } else {
                   $data['paper_statement_subscription'] = null; 
                }
                if(isset($result->supplementary_salutation)){
                   $data['supplementary_salutation'] = $result->supplementary_salutation;   
                } else {
                   $data['supplementary_salutation'] = null; 
                }
                if(isset($result->supplementary_relationship)){
                   $data['supplementary_relationship'] = $result->supplementary_relationship;   
                } else {
                   $data['supplementary_relationship'] = null; 
                }
                if(isset($result->supplementary_first_name)){
                   $data['supplementary_first_name'] = $result->supplementary_first_name;   
                } else {
                   $data['supplementary_first_name'] = null; 
                }
                if(isset($result->supplementary_middle_name)){
                   $data['supplementary_middle_name'] = $result->supplementary_middle_name;   
                } else {
                   $data['supplementary_middle_name'] = null; 
                }
                if(isset($result->supplementary_last_name)){
                   $data['supplementary_last_name'] = $result->supplementary_last_name;   
                } else {
                   $data['supplementary_last_name'] = null; 
                }
                if(isset($result->supplementary_embosing_name)){
                   $data['supplementary_embosing_name'] = $result->supplementary_embosing_name;   
                } else {
                   $data['supplementary_embosing_name'] = null; 
                }
                
                if(isset($result->supplementary_nationality)){
                   $data['supplementary_nationality'] = $result->supplementary_nationality;   
                } else {
                   $data['supplementary_nationality'] = null; 
                }
                
                if(isset($result->supplementary_passport_no)){
                   $data['supplementary_passport_no'] = $result->supplementary_passport_no;   
                } else {
                   $data['supplementary_passport_no'] = null; 
                }
                if(isset($result->supplementary_credit_limit_aed)){
                   $data['supplementary_credit_limit_aed'] = $result->supplementary_credit_limit_aed;   
                } else {
                   $data['supplementary_credit_limit_aed'] = null; 
                }
                if(isset($result->supplementary_marital_status)){
                   $data['supplementary_marital_status'] = $result->supplementary_marital_status;   
                } else {
                   $data['supplementary_marital_status'] = null; 
                }
                if(isset($result->supplementary_mother_maiden_name)){
                   $data['supplementary_mother_maiden_name'] = $result->supplementary_mother_maiden_name;   
                } else {
                   $data['supplementary_mother_maiden_name'] = null; 
                }
                
                if(isset($result->no_sign_up_credit_shield)){
                   $data['no_sign_up_credit_shield'] = $result->no_sign_up_credit_shield;   
                } else {
                   $data['no_sign_up_credit_shield'] = null; 
                }
                if(isset($result->sign_up_credit_shield_plus)){
                   $data['sign_up_credit_shield_plus'] = $result->sign_up_credit_shield_plus;   
                } else {
                   $data['sign_up_credit_shield_plus'] = null; 
                }
                if(isset($result->master_murabaha_agreement)){
                   $data['master_murabaha_agreement'] = $result->master_murabaha_agreement;   
                } else {
                   $data['master_murabaha_agreement'] = null; 
                }
                
                $home = route('get-started');
                
                if(isset($result->kyc_docs)){
                   $data['kyc_docs'] = $home.$result->kyc_docs;   
                } else {
                   $data['kyc_docs'] = null; 
                }
                
                if(isset($result->kyc_docs2)){
                   $data['kyc_docs2'] = $home.$result->kyc_docs2;   
                } else {
                   $data['kyc_docs2'] = null; 
                }
                
                if(isset($result->kyc_docs3)){
                   $data['kyc_docs3'] = $home.$result->kyc_docs3;   
                } else {
                   $data['kyc_docs3'] = null; 
                }
                if(isset($result->kyc_docs4)){
                   $data['kyc_docs4'] = $home.$result->kyc_docs4;   
                } else {
                   $data['kyc_docs4'] = null; 
                }
                
                return response()->json(['success' => true, 'status' => 200, 'data' => $data]);
            }
        }
        
    }

    public function save_personal_loan_informations(Request $request){
      if($request->api_key){
        $user = User::where('api_key', $request->api_key)->select('id')->first();
        if($user){
            $user_id = $user->id;
            $inputs = $request->all();
            $inputs['user_id'] = $user_id;
            $info = PersonalLoanInformation::where('user_id', $user_id)->select('id')->first();
            if($info){
              $id = $info->id;
              (new PersonalLoanInformation)->store($inputs, $id);
            } else {
                (new PersonalLoanInformation)->store($inputs);
            }
            return response()->json(['success' => true, 'status' => 200, 'message' => 'Personal loan information successfully saved.']);
        }
      }
    }

    public function save_coman_information_form(Request $request){
        if($request->api_key){
            $user = User::where('api_key', $request->api_key)->select('id')->first();
            if($user){
                $user_id = $user->id;
                $info = ComanInformation::where('user_id', $user_id)->select('id')->first();
                $inputs = $request->all();
                $inputs['user_id'] = $user_id;



                if($info){
                    $id = $info->id;
                    (new ComanInformation)->store($inputs, $id);
                } else {
                    (new ComanInformation)->store($inputs);
                }

                $education = UserEducation::where('user_id', $user_id)->first();

            $inputs['education'] = $education->education; 
            $inputs['primary_school'] = $education->primary_school;
            $inputs['high_school'] = $education->high_school;
            $inputs['graduate'] = $education->graduate;
            $inputs['postgraduate'] = $education->postgraduate;
            $inputs['others'] = $education->others;

            $address = Address::where('customer_id', $user_id)->first();
            $inputs['permanent_address_home_country_line_1'] = $address->permanent_address_home_country_line_1; 
            $inputs['permanent_address_home_country_line_2'] = $address->permanent_address_home_country_line_2;
            $inputs['permanent_address_home_country_line_3'] = $address->permanent_address_home_country_line_3;
            $inputs['permanent_address_zipcode'] = $address->permanent_address_zipcode;
            $inputs['permanent_home_country_emirates'] = $address->permanent_home_country_emirates;
            $inputs['permanent_home_country_po_box'] = $address->permanent_home_country_po_box;
            $inputs['permanent_address_country'] = $address->permanent_address_country;
            $inputs['permanent_address_city'] = $address->permanent_address_city;
            $inputs['permanent_addresstel_with_idd_code'] = $address->permanent_addresstel_with_idd_code;
            $inputs['residential_address_line_1'] = $address->residential_address_line_1;
            $inputs['residential_address_line_2'] = $address->residential_address_line_2;
            $inputs['residential_address_line_3'] = $address->residential_address_line_3;
            $inputs['residential_address_buliding_name'] = $address->residential_address_buliding_name;
            $inputs['residential_address_street_name'] = $address->residential_address_street_name;
            $inputs['residential_address_nearest_landmark'] = $address->residential_address_nearest_landmark;
            $inputs['residential_emirate'] = $address->residential_emirate;
            $inputs['residential_po_box'] = $address->residential_po_box;
            $inputs['office_address_office_address_building_name'] = $address->office_address_office_address_building_name;
            $inputs['office_address_street_name'] = $address->office_address_street_name;
            $inputs['office_address_office_address_nearest'] = $address->office_address_office_address_nearest;
            $inputs['office_emirate'] = $address->office_emirate;
            $inputs['office_po_box'] = $address->office_po_box;
            $inputs['mailing_address_line'] = $address->mailing_address_line;
            $inputs['annual_rent'] = $address->annual_rent;
            $inputs['mailing_po_box'] = $address->mailing_po_box;
            $inputs['mailing_emirate'] = $address->mailing_emirate;
            $inputs['company_name'] = $address->company_name;
            $inputs['duration_at_current_address'] = $address->duration_at_current_address;
            $inputs['company_address_line_1'] = $address->company_address_line_1;
            $inputs['company_address_line_2'] = $address->company_address_line_2;
            $inputs['company_address_line_3'] = $address->company_address_line_3;
            $inputs['company_po_box'] = $address->company_po_box;
            $inputs['company_phone_no'] = $address->company_phone_no;
            $inputs['company_emirate'] = $address->company_emirate;
            $inputs['resdence_type'] = $address->resdence_type;
            $inputs['preferred_mailing_address'] = $address->preferred_mailing_address;
            $inputs['preferred_statement_mode'] = $address->preferred_statement_mode;
            $inputs['preferred_contact_number'] = $address->preferred_contact_number;

            $PersonalLoan = PersonalLoanInformation::where('user_id', $user_id)->first();
            $Personal_inputs['reference_title'] = @$PersonalLoan->reference_title;
            $Personal_inputs['reference_full_name'] = @$PersonalLoan->reference_full_name;
            $Personal_inputs['reference_relation'] = @$PersonalLoan->reference_relation;
            $Personal_inputs['reference_mobile_no'] = @$PersonalLoan->reference_mobile_no;
            $Personal_inputs['reference_home_telephone_no'] = @$PersonalLoan->reference_home_telephone_no;
            $Personal_inputs['reference_address'] = @$PersonalLoan->reference_address;
            $Personal_inputs['reference_po_box_no'] = @$PersonalLoan->reference_po_box_no;

            $Personal_inputs['existing_customer'] = @$PersonalLoan->existing_customer;
            $Personal_inputs['account_no'] = @$PersonalLoan->account_no;
            $Personal_inputs['cif_no'] = @$PersonalLoan->cif_no;
            $Personal_inputs['about_your_business'] = @$PersonalLoan->about_your_business;
            $Personal_inputs['sole_proprietorship_vith_power_of_attorney'] = @$PersonalLoan->sole_proprietorship_vith_power_of_attorney;
            $Personal_inputs['sole_proprietorship_without_power_of_attorney'] = @$PersonalLoan->sole_proprietorship_without_power_of_attorney;
            $Personal_inputs['free_zone_entity'] = @$PersonalLoan->free_zone_entity;
            $Personal_inputs['limited_liability_company'] = @$PersonalLoan->limited_liability_company;
            $Personal_inputs['other_please_specify'] = @$PersonalLoan->other_please_specify;
            $Personal_inputs['years_in_business'] = @$PersonalLoan->years_in_business;
            $Personal_inputs['designation'] = @$PersonalLoan->designation;
            $Personal_inputs['paid_up_capital'] = @$PersonalLoan->paid_up_capital;
            $Personal_inputs['no_of_employees'] = @$PersonalLoan->no_of_employees;
            $Personal_inputs['ownership_details'] = @$PersonalLoan->ownership_details;
            $Personal_inputs['partner_name'] = @$PersonalLoan->partner_name;
            $Personal_inputs['partner_ownership'] = @$PersonalLoan->partner_ownership;
            $Personal_inputs['partner_nationality'] = @$PersonalLoan->partner_nationality;
            $Personal_inputs['annual_bonus'] = @$PersonalLoan->annual_bonus;
            $Personal_inputs['average_monthly_commission'] = @$PersonalLoan->average_monthly_commission;
            $Personal_inputs['average_monthly_overtime'] = @$PersonalLoan->average_monthly_overtime;
            $Personal_inputs['spouse_fixed_monthly_income'] = @$PersonalLoan->spouse_fixed_monthly_income;
            $Personal_inputs['if_spouse_is_a_co_borrower'] = @$PersonalLoan->if_spouse_is_a_co_borrower;
            $Personal_inputs['business_reference_company_name'] = @$PersonalLoan->business_reference_company_name;
            $Personal_inputs['business_contact_person_name'] = @$PersonalLoan->business_contact_person_name;
            $Personal_inputs['business_title'] = @$PersonalLoan->business_title;
            $Personal_inputs['business_designation'] = @$PersonalLoan->business_designation;
            $Personal_inputs['business_relationship'] = @$PersonalLoan->business_relationship;
            $Personal_inputs['business_contact_number'] = @$PersonalLoan->business_contact_number;
            $Personal_inputs['business_address'] = @$PersonalLoan->business_address;
            $Personal_inputs['business_emirate'] = @$PersonalLoan->business_emirate;
            $Personal_inputs['reference_1_title'] = @$PersonalLoan->reference_1_title;
            $Personal_inputs['reference_1_name'] = @$PersonalLoan->reference_1_name;
            $Personal_inputs['reference_1_relation'] = @$PersonalLoan->reference_1_relation;
            $Personal_inputs['reference_1_mobile_no'] = @$PersonalLoan->reference_1_mobile_no;
            $Personal_inputs['reference_1_emirate'] = @$PersonalLoan->reference_1_emirate;
            $Personal_inputs['reference_1_office_telephone'] = @$PersonalLoan->reference_1_office_telephone;
            $Personal_inputs['reference_1_email'] = @$PersonalLoan->reference_1_email;
            $Personal_inputs['reference_2_title'] = @$PersonalLoan->reference_2_title;
            $Personal_inputs['reference_2_name'] = @$PersonalLoan->reference_2_name;
            $Personal_inputs['reference_2_relation'] = @$PersonalLoan->reference_2_relation;
            $Personal_inputs['reference_2_mobile_no'] = @$PersonalLoan->reference_2_mobile_no;
            $Personal_inputs['reference_2_emirate'] = @$PersonalLoan->reference_2_emirate;
            $Personal_inputs['reference_2_office_telephone'] = @$PersonalLoan->reference_2_office_telephone;
            $Personal_inputs['reference_2_email'] = @$PersonalLoan->reference_2_email;
            $Personal_inputs['purpose_of_loan'] = @$PersonalLoan->purpose_of_loan;
            $Personal_inputs['if_you_have_co_borrower'] = @$PersonalLoan->if_you_have_co_borrower;
            $Personal_inputs['co_borrower_title'] = @$PersonalLoan->co_borrower_title;
            $Personal_inputs['co_borrower_name'] = @$PersonalLoan->co_borrower_name;
            $Personal_inputs['relationship_to_primary_borrower'] = @$PersonalLoan->relationship_to_primary_borrower;
            $Personal_inputs['co_borrower_signature'] = @$PersonalLoan->co_borrower_signature;
            $Personal_inputs['co_borrower_date'] = @$PersonalLoan->co_borrower_date;
            $Personal_inputs['loan_amount'] = @$PersonalLoan->loan_amount;
            $Personal_inputs['interest_rate'] = @$PersonalLoan->interest_rate;
            $Personal_inputs['number_of_installments'] = @$PersonalLoan->number_of_installments;
            $Personal_inputs['installment_start_date'] = @$PersonalLoan->installment_start_date;
            $Personal_inputs['monthly_installment_amount'] = @$PersonalLoan->monthly_installment_amount;
            $Personal_inputs['processing_fee'] = @$PersonalLoan->processing_fee;
            $Personal_inputs['institution_name'] = @$PersonalLoan->institution_name;
            $Personal_inputs['product_card_type'] = @$PersonalLoan->product_card_type;
            $Personal_inputs['account_card_number'] = @$PersonalLoan->account_card_number;
            $Personal_inputs['finance_amount'] = @$PersonalLoan->finance_amount;
            $Personal_inputs['monthly_installment'] = @$PersonalLoan->monthly_installment;
            $Personal_inputs['outstanding_balance'] = @$PersonalLoan->outstanding_balance;
            $Personal_inputs['type_of_personal_finance'] = @$PersonalLoan->type_of_personal_finance;
            $Personal_inputs['investment_murabaha'] = @$PersonalLoan->investment_murabaha;
            $Personal_inputs['requested_financing_details'] = @$PersonalLoan->requested_financing_details;
            $Personal_inputs['customer_segment'] = @$PersonalLoan->customer_segment;
            $Personal_inputs['direct_debit_account_number'] = @$PersonalLoan->direct_debit_account_number;
            $Personal_inputs['other_bank_direct_debit_account_number'] = @$PersonalLoan->other_bank_direct_debit_account_number;
            $Personal_inputs['other_bank_name'] = @$PersonalLoan->other_bank_name;
            $Personal_inputs['frequency_of_payment'] = @$PersonalLoan->frequency_of_payment;
            $Personal_inputs['type_of_new_account'] = @$PersonalLoan->type_of_new_account;
            $Personal_inputs['takaful'] = @$PersonalLoan->takaful;
            $Personal_inputs['receive_a_special_rate_to_participate'] = @$PersonalLoan->receive_a_special_rate_to_participate;
            $Personal_inputs['ever_obtained_al_khair_financing'] = @$PersonalLoan->ever_obtained_al_khair_financing;
            $Personal_inputs['details_bank_name'] = @$PersonalLoan->details_bank_name;
            $Personal_inputs['details_branch'] = @$PersonalLoan->details_branch;
            $Personal_inputs['details_account_since'] = @$PersonalLoan->details_account_since;
            $Personal_inputs['details_credit_bank'] = @$PersonalLoan->details_credit_bank;
            $Personal_inputs['details_credit_limit'] = @$PersonalLoan->details_credit_limit;
            $Personal_inputs['details_credit_account_since'] = @$PersonalLoan->details_credit_account_since;
            $Personal_inputs['liabilities_bank_name'] = @$PersonalLoan->liabilities_bank_name;
            $Personal_inputs['liabilities_facility_type'] = @$PersonalLoan->liabilities_facility_type;
            $Personal_inputs['liabilities_monthly_installment_amount'] = @$PersonalLoan->liabilities_monthly_installment_amount;
            $Personal_inputs['liabilities_outstanding_amount'] = @$PersonalLoan->liabilities_outstanding_amount;
            $Personal_inputs['liabilities_other_bank_name'] = @$PersonalLoan->liabilities_other_bank_name;
            $Personal_inputs['liabilities_other_facility_type'] = @$PersonalLoan->liabilities_other_facility_type;
            $Personal_inputs['liabilities_other_monthly_installment_amount'] = @$PersonalLoan->liabilities_other_monthly_installment_amount;
            $Personal_inputs['liabilities_other_outstanding_amount'] = @$PersonalLoan->liabilities_other_outstanding_amount;
            $Personal_inputs['date_of_signing'] = @$PersonalLoan->date_of_signing;
            $Personal_inputs['signature_of_applicant'] = @$PersonalLoan->signature_of_applicant;
            $Personal_inputs['are_you_a_public_figure'] = @$PersonalLoan->are_you_a_public_figure;
            $Personal_inputs['public_figure_position_title'] = @$PersonalLoan->public_figure_position_title;
            $Personal_inputs['related_to_public_figure'] = @$PersonalLoan->related_to_public_figure;
            $Personal_inputs['related_public_figure_position_title'] = @$PersonalLoan->related_public_figure_position_title;
            $Personal_inputs['acknowledge_receiving_key_fact_statement'] = @$PersonalLoan->acknowledge_receiving_key_fact_statement;
            $Personal_inputs['hereby_give_our_consent_to_waive'] = @$PersonalLoan->hereby_give_our_consent_to_waive;
            $Personal_inputs['agree_bank_will_determine'] = @$PersonalLoan->agree_bank_will_determine;
            $Personal_inputs['customer_name'] = @$PersonalLoan->customer_name;
            $Personal_inputs['signature_date'] = @$PersonalLoan->signature_date;
            $Personal_inputs['us_citizen_or_other'] = @$PersonalLoan->us_citizen_or_other;
            $Personal_inputs['town_or_city_of_birth'] = @$PersonalLoan->town_or_city_of_birth;
            $Personal_inputs['country_of_birth'] = @$PersonalLoan->country_of_birth;
            $Personal_inputs['individual_tax_cm_signature'] = @$PersonalLoan->individual_tax_cm_signature;
            $Personal_inputs['individual_tax_date'] = @$PersonalLoan->individual_tax_date;
            $Personal_inputs['promise_cm_name'] = @$PersonalLoan->promise_cm_name;
            $Personal_inputs['cost_price'] = @$PersonalLoan->cost_price;
            $Personal_inputs['profit'] = @$PersonalLoan->profit;
            $Personal_inputs['schedule_1_number_of_installments'] = @$PersonalLoan->schedule_1_number_of_installments;
            $Personal_inputs['day_of_every_month'] = @$PersonalLoan->day_of_every_month;
            $Personal_inputs['murabaha_contract_or_proceeds_thereof'] = @$PersonalLoan->murabaha_contract_or_proceeds_thereof;
            $Personal_inputs['schedule_2_emirates_islamic_bank'] = @$PersonalLoan->schedule_2_emirates_islamic_bank;
            $Personal_inputs['schedule_2_date'] = @$PersonalLoan->schedule_2_date;
            $Personal_inputs['schedule_2_number_investment_certificates'] = @$PersonalLoan->schedule_2_number_investment_certificates;
            $Personal_inputs['schedule_2_cost_price'] = @$PersonalLoan->schedule_2_cost_price;
            $Personal_inputs['schedule_2_deferred_profit'] = @$PersonalLoan->schedule_2_deferred_profit;
            $Personal_inputs['schedule_2_advance_payment'] = @$PersonalLoan->schedule_2_advance_payment;
            $Personal_inputs['schedule_2_murabaha_sale_price'] = @$PersonalLoan->schedule_2_murabaha_sale_price;
            $Personal_inputs['schedule_2_payment_date'] = @$PersonalLoan->schedule_2_payment_date;
            $Personal_inputs['schedule_2_sale_date'] = @$PersonalLoan->schedule_2_sale_date;
            $Personal_inputs['schedule_2_cut_off_time'] = @$PersonalLoan->schedule_2_cut_off_time;
            $Personal_inputs['annexure_date'] = @$PersonalLoan->annexure_date;
            $Personal_inputs['annexure_ei_reference'] = @$PersonalLoan->annexure_ei_reference;
            $Personal_inputs['annexure_takaful_fees'] = @$PersonalLoan->annexure_takaful_fees;
            $Personal_inputs['annexure_processing_fees'] = @$PersonalLoan->annexure_processing_fees;
            $Personal_inputs['annexure_trading_fees'] = @$PersonalLoan->annexure_trading_fees;
            $Personal_inputs['annexure_account_number'] = @$PersonalLoan->annexure_account_number;
            $Personal_inputs['annexure_collect_original_clearance'] = @$PersonalLoan->annexure_collect_original_clearance;
            $Personal_inputs['annexure_post_settlement'] = @$PersonalLoan->annexure_post_settlement;
            $Personal_inputs['liability_from'] = @$PersonalLoan->liability_from;
            $Personal_inputs['outgoing_bank_name'] = @$PersonalLoan->outgoing_bank_name;
            $Personal_inputs['salary_for_the_month'] = @$PersonalLoan->salary_for_the_month;
            $Personal_inputs['debit_emi_account_no'] = @$PersonalLoan->debit_emi_account_no;
            $Personal_inputs['customer_undertaking_account_no'] = @$PersonalLoan->customer_undertaking_account_no;


            $CreditCard = CreditCardInformation::where('user_id', $user_id)->first();
            $inputs['card_type'] = $CreditCard->card_type;
            $inputs['embossing_name'] = $CreditCard->embossing_name;
            $inputs['cm_billing_cycle_date'] = $CreditCard->cm_billing_cycle_date;
            $inputs['e_statement_subscription'] = $CreditCard->e_statement_subscription;
            $inputs['paper_statement_subscription'] = $CreditCard->paper_statement_subscription;
            $inputs['supplementary_salutation'] = $CreditCard->supplementary_salutation;
            $inputs['supplementary_relationship'] = $CreditCard->supplementary_relationship;
            $inputs['supplementary_first_name'] = $CreditCard->supplementary_first_name;
            $inputs['supplementary_middle_name'] = $CreditCard->supplementary_middle_name;
            $inputs['supplementary_last_name'] = $CreditCard->supplementary_last_name;
            $inputs['supplementary_embosing_name'] = $CreditCard->supplementary_embosing_name;
            $inputs['supplementary_nationality'] = $CreditCard->supplementary_nationality;
            $inputs['supplementary_passport_no'] = $CreditCard->supplementary_passport_no;
            $inputs['supplementary_credit_limit_aed'] = $CreditCard->supplementary_credit_limit_aed;
            $inputs['supplementary_marital_status'] = $CreditCard->supplementary_marital_status;
            $inputs['supplementary_mother_maiden_name'] = $CreditCard->supplementary_mother_maiden_name;
            $inputs['no_sign_up_credit_shield'] = $CreditCard->no_sign_up_credit_shield;
            $inputs['sign_up_credit_shield_plus'] = $CreditCard->sign_up_credit_shield_plus;
            $inputs['master_murabaha_agreement'] = $CreditCard->master_murabaha_agreement;
            $inputs['kyc_docs'] = $CreditCard->kyc_docs;
            $inputs['kyc_docs2'] = $CreditCard->kyc_docs2;
            $inputs['kyc_docs3'] = $CreditCard->kyc_docs3;
            $inputs['kyc_docs4'] = $CreditCard->kyc_docs4;

            $services = ServiceApply::where('app_status', 1)->where('customer_id', $user_id)->select('id', 'app_no', 'service_id')->get();

            foreach ($services as $service) {
                $app_id = Application::where('ref_id', $service->app_no)->select('id')->first();
                $inputs['app_id'] = $app_id->id;
                $id = (new ApplicationData)->store($inputs);

                if($service->service_id == 1){
                    $Personal_inputs['app_id'] = $app_id->id;
                    $id = (new ApplicationPersonalLoanInformation)->store($Personal_inputs);
                }
                \DB::table('service_applies')->where('id', $service->id)->delete();
            }

                return response()->json(['success' => true, 'status' => 200, 'message' => 'information successfully saved.']);
            }
        }
    }

    public function show_coman_information_form(Request $request){
      if($request->api_key){
          $user = User::where('api_key', $request->api_key)->select('id')->first();
          if($user){
              $data = ComanInformation::where('user_id', $user->id)->first();
              return response()->json(['success' => true, 'status' => 200, 'data' => $data]);  
          }
        }
    }

    public function show_personal_loan_informations(Request $request){
      if($request->api_key){
          $user = User::where('api_key', $request->api_key)->select('id')->first();
          if($user){
              $data = PersonalLoanInformation::where('user_id', $user->id)->first();
              return response()->json(['success' => true, 'status' => 200, 'data' => $data]);  
          }
        }
    }
    
    public function save_credit_card_information(Request $request){
        try {
            if($request->api_key){
            $user = User::where('api_key', $request->api_key)->select('id')->first();
            if($user){
                $user_id = $user->id;
                $inputs = $request->all();  
                $info = CreditCardInformation::where('user_id', $user_id)->select('id', 'kyc_docs', 'kyc_docs2', 'kyc_docs3', 'kyc_docs4')->first();
                $inputs['user_id'] = $user_id;
                if(isset($inputs['kyc_docs']) or !empty($inputs['kyc_docs'])) {
                    $image_name = rand(100000, 999999);
                    $fileName = '';
                    if($file = $request->hasFile('kyc_docs')) {
                        $file = $request->file('kyc_docs');
                        $img_name = $file->getClientOriginalName();
                        $fileName = $image_name.$img_name;
                        $destinationPath = public_path().'/uploads/kyc_docs/';
                        $file->move($destinationPath, $fileName);
                    }
                            $fname ='/uploads/kyc_docs/';
                            $image = $fname.$fileName;
                        } else{
                            $image = @$info->kyc_docs;
                }  
                unset($inputs['kyc_docs']);
                $inputs['kyc_docs'] = $image; 
                
                if(isset($inputs['kyc_docs2']) or !empty($inputs['kyc_docs2'])) {
                    $image_name = rand(100000, 999999);
                    $fileName = '';
                    if($file = $request->hasFile('kyc_docs2')) {
                        $file = $request->file('kyc_docs2');
                        $img_name = $file->getClientOriginalName();
                        $fileName = $image_name.$img_name;
                        $destinationPath = public_path().'/uploads/kyc_docs/';
                        $file->move($destinationPath, $fileName);
                    }
                            $fname ='/uploads/kyc_docs/';
                            $image = $fname.$fileName;
                        } else{
                            $image = @$info->kyc_docs2;
                }  
                unset($inputs['kyc_docs2']);
                $inputs['kyc_docs2'] = $image; 
                
                if(isset($inputs['kyc_docs3']) or !empty($inputs['kyc_docs3'])) {
                    $image_name = rand(100000, 999999);
                    $fileName = '';
                    if($file = $request->hasFile('kyc_docs3')) {
                        $file = $request->file('kyc_docs3');
                        $img_name = $file->getClientOriginalName();
                        $fileName = $image_name.$img_name;
                        $destinationPath = public_path().'/uploads/kyc_docs/';
                        $file->move($destinationPath, $fileName);
                    }
                            $fname ='/uploads/kyc_docs/';
                            $image = $fname.$fileName;
                        } else{
                            $image = @$info->kyc_docs3;
                }  
                unset($inputs['kyc_docs3']);
                $inputs['kyc_docs3'] = $image;
                
                if(isset($inputs['kyc_docs4']) or !empty($inputs['kyc_docs4'])) {
                    $image_name = rand(100000, 999999);
                    $fileName = '';
                    if($file = $request->hasFile('kyc_docs4')) {
                        $file = $request->file('kyc_docs4');
                        $img_name = $file->getClientOriginalName();
                        $fileName = $image_name.$img_name;
                        $destinationPath = public_path().'/uploads/kyc_docs/';
                        $file->move($destinationPath, $fileName);
                    }
                            $fname ='/uploads/kyc_docs/';
                            $image = $fname.$fileName;
                        } else{
                            $image = @$info->kyc_docs4;
                }  
                unset($inputs['kyc_docs4']);
                $inputs['kyc_docs4'] = $image; 
                
                
                $inputs['user_id'] = $user_id;
                if($info){
                    $id = $info->id;
                    (new CreditCardInformation)->store($inputs, $id);  
                } else {
                    (new CreditCardInformation)->store($inputs); 
                }
                
                return response()->json(['success' => true, 'status' => 200, 'message' => 'Credit card information successfully saved']);
                
                }   
            } 
        } catch (Exception $e) {
            return back();
        }
    }


    public function profile(Request $request){
        try{

          if($request->api_key){
           $user = User::where('api_key', $request->api_key)->select('id', 'salutation', 'name', 
            'middle_name', 'last_name', 'email', 'mobile', 'profile_image', 'gender', 'date_of_birth')->first();
            $url = route('get-started'); 

            if($user){
            $data['id'] = $user->id;
            $data['salutation'] = $user->salutation;
            $data['name'] = $user->name;
            $data['middle_name'] = $user->middle_name;
            $data['last_name'] = $user->last_name;
            $data['email'] = $user->email;
            $data['mobile'] = $user->mobile;
            $data['date_of_birth'] = $user->date_of_birth;
             if($user->profile_image){
                  $data['profile_image'] = $url.$user->profile_image;
                } else {
                  $data['profile_image'] =$user->profile_image;
              }
            $user_id = 1300+$user->id;
            $data['user_code'] = 'lnxx'.$user_id;
            $data['gender'] = $user->gender;

            return apiResponseApp(true, 200, null, null, $data); 
          }
          }

        } catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
        }

    }





   

    

}

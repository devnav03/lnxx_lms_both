<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\State;
use App\Models\City;
use App\Models\Country;
use App\Models\CustomerOnboarding;
use App\Models\OtherCmDetail;
use App\Models\CmSalariedDetail;
use App\Models\SelfEmpDetail;
use App\Models\Address;
use App\Models\ProductRequest;
use App\Models\UserEducation;
use App\Models\Service;
use App\Models\Company;
use App\Models\ServiceApply;
use App\Models\Application;
use App\Models\ApplicationProductRequest;
use App\Models\Bank;
use App\Models\ApplicationDependent;
use App\Models\ApplicationPersonalLoanPreferenceBank;
use App\Models\ApplicationCreditCardPreferenceBank;
use App\Models\ApplicationData;
use App\Models\ApplicationPersonalLoanInformation;
use League\Flysystem\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PDF;

class ApplicationController extends Controller {
   
    public function index() {
        return view('admin.applications.index');
    }

    public function create() {
        return view('admin.applications.create');
    }


    public function store( Request $request ){

        $request['unique_id'] = mt_rand(100000,999999);
        $inputs = $request->all(); 

        $validator = (new User)->validate($inputs);
        if ($validator->fails()) {
            return redirect()->route('customer.create')
            ->withInput()->withErrors($validator);
        }            
        
        try {

            $pwd = $inputs['password'];
            $password = \Hash::make($inputs['password']);
            unset($inputs['password']);
            $inputs = $inputs + ['password' => $password];
            // Generating API key

            $name = $request->first_name .' '. $request->last_name;
            $remember_token = $this->generateTokenKey();
            $inputs = $inputs + [
                                'remember_token'  => $remember_token,
                                'name'  => $name,
                                'created_by'  => authUserId()
                            ];

            $user_id = (new User)->store($inputs);  

          if($request->user_type == 2) {
            return view('admin.customer.index')
                ->with('success', lang('messages.created', lang('customer.customer')));
          } 
          if($request->user_type == 3) {
            return view('admin.customer.admin')
                ->with('success', lang('messages.created', lang('customer.customer')));
          }  
          
        }
        catch (Exception $exception) {
         //   dd($exception);
            return redirect()->route('customer.create')
                ->withInput()
                ->with('error', lang('messages.server_error'));
        }
    }


    public function update(Request $request, $id = null) {
        $result = User::find($id);
        $user_type = $result->user_type;

        if (!$result) {

            return redirect()->route('customer.index')
                ->with('error', lang('messages.invalid_id', string_manip(lang('customer.customer'))));
        }

        $inputs = $request->all();
        $validator = (new User)->validate_update($inputs, $id);
        if ($validator->fails()) {
            return redirect()->route('customer.edit',[$id])
            ->withInput()->withErrors($validator);
        } 

        try {
             
             $name = $request->first_name .' '. $request->last_name;
             $inputs = $inputs + [
                'name'  => $name,
                'updated_by'=> authUserId()
              ];
          
            (new User)->store($inputs, $id); 

        if($request->user_type == 2) {
          return redirect()->route('customer')
                ->with('success', lang('messages.updated', lang('customer.customer')));
        }

        if($request->user_type == 3) {
          return redirect()->route('admin_users')
                ->with('success', lang('messages.updated', lang('customer.customer')));
        }
      
        } catch (\Exception $exception) {

        //  dd($exception);

            return redirect()->route('customer.edit',[$id])
                ->with('error', lang('messages.server_error'));
 
        }
    }
    

    private function generateTokenKey() {
        return md5(uniqid(rand(), true));
    }

    public function edit($id = null)  {
        $result = Application::find($id);
        if (!$result) {
            abort(404);
        }

        $PersonalLoanlimit = "";
        $PersonalLoanPreference = [];
        $CardTypePreference = [];
        $Personalloanform = [];
   
        $country = Country::all();
        $countries = Country::all();
        $Application_Request = ApplicationProductRequest::where('application_id', $id)->first();

        $company = Company::where('status', 1)->select('id', 'name')->get();
        $banks = Bank::where('status', 1)->select('id', 'name')->get();

        $bank = Bank::where('id', $result->preference_bank_id)->select('id', 'name')->first();
        $service = Service::where('id', $result->service_id)->select('id', 'name')->first();

        $address_details = Address::where('customer_id', $id)->first();
        $UserEducation = UserEducation::where('user_id', $id)->first();
        $services = \DB::table('service_applies')
                    ->join('services', 'services.id', '=', 'service_applies.service_id')
                    ->select('service_applies.status', 'services.name', 'services.image')
                    ->where('service_applies.customer_id', $id)->get();
        $sel_services = ServiceApply::where('customer_id', $id)->pluck('service_id')->toArray();
        $dependents = ApplicationDependent::where('app_id', $id)->select('name', 'relation')->get();


        if($result->service_id == 1){
            $PersonalLoanlimit =  ApplicationPersonalLoanPreferenceBank::where('app_id', $result->id)->select('loan_limit', 'loan_emi')->first();
            $PersonalLoanPreference = \DB::table('application_personal_loan_preference_bank')
                    ->join('banks', 'banks.id', '=', 'application_personal_loan_preference_bank.bank_id')
                    ->select('banks.name', 'banks.id')
                    ->where('application_personal_loan_preference_bank.app_id', $id)->get();
            $Personalloanform = ApplicationPersonalLoanInformation::where('app_id', $id)->first();

        }
        if($result->service_id == 3){
            $PersonalLoanlimit =  ApplicationCreditCardPreferenceBank::where('app_id', $result->id)->select('loan_limit')->first();
            $PersonalLoanPreference = \DB::table('application_credit_card_preference_bank')
                    ->join('banks', 'banks.id', '=', 'application_credit_card_preference_bank.bank_id')
                    ->select('banks.name', 'banks.id')
                    ->where('application_credit_card_preference_bank.app_id', $id)->get();

            $CardTypePreference = \DB::table('application_card_type_preference')
                    ->join('card_type', 'card_type.id', '=', 'application_card_type_preference.type_id')
                    ->select('card_type.name', 'card_type.id')
                    ->where('application_card_type_preference.app_id', $id)->get();

        }

        $app_data = ApplicationData::where('app_id', $id)->first();

        return view('admin.applications.create', compact('result', 'country', 'UserEducation', 'address_details', 'countries', 'services', 'sel_services', 'company', 'banks', 'Application_Request', 'bank', 'service', 'dependents', 'PersonalLoanlimit', 'PersonalLoanPreference', 'CardTypePreference', 'app_data', 'Personalloanform'));
    }
    
    public function profile_pdf(Request $request){
       try {
          //  $data = [];

            $bank = Bank::where('id', $request->bank_id)->select('image')->first();
            $home = route('get-started');
            $data['bank_logo'] = $home.$bank->image;
           // $data['bank_logo'] = 'https://vztor.in/assets/frontend/images/lnxx-credit-cards-in-hands.png';
            $id = $request->id;
            $result = Application::find($id);
            if (!$result) {
                abort(404);
            }

            $PersonalLoanlimit = "";
            $PersonalLoanPreference = [];
            $CardTypePreference = [];
            $Personalloanform = [];
       
            $country = Country::all();
            $countries = Country::all();
            $Application_Request = ApplicationProductRequest::where('application_id', $id)->first();

            $company = Company::where('status', 1)->select('id', 'name')->get();
            $banks = Bank::where('status', 1)->select('id', 'name')->get();

            $bank = Bank::where('id', $result->preference_bank_id)->select('id', 'name')->first();
            $service = Service::where('id', $result->service_id)->select('id', 'name')->first();

            $address_details = Address::where('customer_id', $id)->first();
            $UserEducation = UserEducation::where('user_id', $id)->first();
            $services = \DB::table('service_applies')
                        ->join('services', 'services.id', '=', 'service_applies.service_id')
                        ->select('service_applies.status', 'services.name', 'services.image')
                        ->where('service_applies.customer_id', $id)->get();
            $sel_services = ServiceApply::where('customer_id', $id)->pluck('service_id')->toArray();
            $dependents = ApplicationDependent::where('app_id', $id)->select('name', 'relation')->get();

            if($result->service_id == 1){
                $PersonalLoanlimit =  ApplicationPersonalLoanPreferenceBank::where('app_id', $result->id)->select('loan_limit', 'loan_emi')->first();
                $PersonalLoanPreference = \DB::table('application_personal_loan_preference_bank')
                        ->join('banks', 'banks.id', '=', 'application_personal_loan_preference_bank.bank_id')
                        ->select('banks.name', 'banks.id')
                        ->where('application_personal_loan_preference_bank.app_id', $id)->get();
                $Personalloanform = ApplicationPersonalLoanInformation::where('app_id', $id)->first();
            }
            if($result->service_id == 3){
                $PersonalLoanlimit =  ApplicationCreditCardPreferenceBank::where('app_id', $result->id)->select('loan_limit')->first();

                $PersonalLoanPreference = \DB::table('application_credit_card_preference_bank')
                    ->join('banks', 'banks.id', '=', 'application_credit_card_preference_bank.bank_id')
                    ->select('banks.name', 'banks.id')
                    ->where('application_credit_card_preference_bank.app_id', $id)->get();


                $CardTypePreference = \DB::table('application_card_type_preference')
                ->join('card_type', 'card_type.id', '=', 'application_card_type_preference.type_id')
                ->select('card_type.name', 'card_type.id')
                ->where('application_card_type_preference.app_id', $id)->get();
            }

            $app_data = ApplicationData::where('app_id', $id)->first();

            $data['result'] = $result;
            $data['country'] = $country;
            $data['UserEducation'] = $UserEducation;
            $data['address_details'] = $address_details; 
            $data['countries'] = $countries;
            $data['services'] = $services;
            $data['sel_services'] = $sel_services;
            $data['company'] = $company;
            $data['banks'] = $banks;
            $data['Application_Request'] = $Application_Request;
            $data['bank'] = $bank;
            $data['service'] = $service;
            $data['dependents'] = $dependents;
            $data['PersonalLoanlimit'] = $PersonalLoanlimit;
            $data['PersonalLoanPreference'] = $PersonalLoanPreference;
            $data['CardTypePreference'] = $CardTypePreference;
            $data['app_data'] = $app_data;
            $data['Personalloanform'] = $Personalloanform;


            $pdf = \PDF::loadView('pdf.profile', $data);
            return $pdf->download('profile.pdf'); 

        } catch(\Exception $exception){
            //dd($exception);
            return back();
      }
    }


    public function applications_print($id = null){
        try{
        $result = Application::find($id);
        if (!$result) {
            abort(404);
        }
        $PersonalLoanlimit = "";
        $PersonalLoanPreference = [];
        $CardTypePreference = [];
        $Personalloanform = [];
        $country = Country::all();
        $countries = Country::all();
        $Application_Request = ApplicationProductRequest::where('application_id', $id)->first();
        $company = Company::where('status', 1)->select('id', 'name')->get();
        $banks = Bank::where('status', 1)->select('id', 'name')->get();
        $bank = Bank::where('id', $result->preference_bank_id)->select('id', 'name')->first();
        $service = Service::where('id', $result->service_id)->select('id', 'name')->first();
        $address_details = Address::where('customer_id', $id)->first();
        $UserEducation = UserEducation::where('user_id', $id)->first();
        $services = \DB::table('service_applies')
                    ->join('services', 'services.id', '=', 'service_applies.service_id')
                    ->select('service_applies.status', 'services.name', 'services.image')
                    ->where('service_applies.customer_id', $id)->get();
        $sel_services = ServiceApply::where('customer_id', $id)->pluck('service_id')->toArray();
        $dependents = ApplicationDependent::where('app_id', $id)->select('name', 'relation')->get();

        if($result->service_id == 1){
            $PersonalLoanlimit =  ApplicationPersonalLoanPreferenceBank::where('app_id', $result->id)->select('loan_limit', 'loan_emi')->first();
            $PersonalLoanPreference = \DB::table('application_personal_loan_preference_bank')
                    ->join('banks', 'banks.id', '=', 'application_personal_loan_preference_bank.bank_id')->select('banks.name', 'banks.id')->where('application_personal_loan_preference_bank.app_id', $id)->get();
            $Personalloanform = ApplicationPersonalLoanInformation::where('app_id', $id)->first();

        }
        if($result->service_id == 3){
            $PersonalLoanlimit =  ApplicationCreditCardPreferenceBank::where('app_id', $result->id)->select('loan_limit')->first();
            $PersonalLoanPreference = \DB::table('application_credit_card_preference_bank')
                ->join('banks', 'banks.id', '=', 'application_credit_card_preference_bank.bank_id')
                ->select('banks.name', 'banks.id')
                ->where('application_credit_card_preference_bank.app_id', $id)->get();
            $CardTypePreference = \DB::table('application_card_type_preference')
                ->join('card_type', 'card_type.id', '=', 'application_card_type_preference.type_id')
                ->select('card_type.name', 'card_type.id')
                ->where('application_card_type_preference.app_id', $id)->get();
        }

        $app_data = ApplicationData::where('app_id', $id)->first();
        $bank_lists = get_prefer_bank_personal_loan($result->service_id);

        return view('admin.applications.print', compact('result', 'country', 'UserEducation', 'address_details', 'countries', 'services', 'sel_services', 'company', 'banks', 'Application_Request', 'bank', 'service', 'dependents', 'PersonalLoanlimit', 'PersonalLoanPreference', 'CardTypePreference', 'app_data', 'Personalloanform', 'bank_lists'));

        } catch (Exception $e) {
            return back();
        }
    }


    public function drop($id) {
        if (!\Request::ajax()) {
            return lang('messages.server_error');
        }

        $result = (new Application)->find($id);
        if (!$result) {
            // use ajax return response not abort because ajaz request abort not works
            abort(401);
        }

        try {
            // get the unit w.r.t id
             $result = (new Application)->find($id);
             if($result->status == 1) {
                 $response = ['status' => 0, 'message' => lang('user.user_in_use')];
             }
             else {
                 (new Application)->tempDelete($id);
                 $response = ['status' => 1, 'message' => lang('messages.deleted', lang('user.user'))];
             }
        }
        catch (Exception $exception) {
            $response = ['status' => 0, 'message' => lang('messages.server_error')];
        }        
        // return json response
        return json_encode($response);
    }


 
    public function changePwd(Request $request) {
        try {
            $id=\Auth::user()->id;
            \DB::beginTransaction();
            /* FIND WHETHER THE USER EXISTS OR NOT */
            $user = User::find($id);
            if(!$user) {
                return apiResponse(false, 404, lang('messages.not_found', lang('user.user')));
            }
            $inputs = $request->all();
            $rules = [
                    'password' => 'required',
                    'new_password'=>'required|min:6'
                    ];
            $validator=\Validator::make($inputs, $rules);
            if ($validator->fails()) {
                return apiResponse(false, 406, "", errorMessages($validator->messages()));
            }
      
                if (!\Hash::check($inputs['password'], \Auth::user()->password) ){
                    return apiResponse(false, 406,lang('user.password_not_match'));
                }

                $password = \Hash::make($inputs['new_password']);
                unset($inputs['password']);
                $inputs = $inputs + ['password' => $password];
                
                (new User)->store($inputs, $id);
                \DB::commit();
                return apiResponse(true, 200, lang('messages.updated', lang('user.user')));
           
        }
        catch (Exception $exception) {
            \DB::rollBack();
            return apiResponse(false, 500, lang('messages.server_error'));
        }
    }

 
    public function Paginate(Request $request, $id, $pageNumber = null) {

        if (!\Request::isMethod('post') && !\Request::ajax()) { //
            return lang('messages.server_error');
        }

        $inputs = $request->all();
        $page = 1;
        if (isset($inputs['page']) && (int)$inputs['page'] > 0) {
            $page = $inputs['page'];
        }

        $perPage = 20;
        if (isset($inputs['perpage']) && (int)$inputs['perpage'] > 0) {
            $perPage = $inputs['perpage'];
        }

        $start = ($page - 1) * $perPage;
        if (isset($inputs['form-search']) && $inputs['form-search'] != '') {
            $inputs = array_filter($inputs);
            unset($inputs['_token']);

            $data = (new Application)->getApplication($inputs, $start, $perPage);
            $totalGameMaster = (new Application)->totalApplication($inputs);
            $total = $totalGameMaster->total;
        } else {
            $data = (new Application)->getApplication($inputs, $start, $perPage, $id);
            $totalGameMaster = (new Application)->totalApplication();
            $total = $totalGameMaster->total;
        }

        return view('admin.applications.load_data', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }


    public function Toggle($id = null) {
        if (!\Request::isMethod('post') && !\Request::ajax()) {
            return lang('messages.server_error');
        }
        try {
            $game = Application::find($id);
            //dd($game);

        } catch (\Exception $exception) {
            return lang('messages.invalid_id', string_manip(lang('Applications')));
        }
        $game->update(['status' => !$game->status]);
        $response = ['status' => 1, 'data' => (int)$game->status . '.gif'];
        return json_encode($response);
    }

    public function Action(Request $request) {
        $inputs = $request->all();
        if (!isset($inputs['tick']) || count($inputs['tick']) < 1) {
             return view('admin.applications.index')->with('error', lang('messages.atleast_one', string_manip(lang('customer.customer'))));
        }

        $ids = '';
        foreach ($inputs['tick'] as $key => $value) {
            $ids .= $value . ',';
        }

        $ids = rtrim($ids, ',');
        $status = 0;
        if (isset($inputs['active'])) {
            $status = 1;
        }

        Application::whereRaw('id IN (' . $ids . ')')->update(['status' => $status]);
        return redirect()->route('applications.index')
            ->with('success', 'Applications');
    }


    
    
}
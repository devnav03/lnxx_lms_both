<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Manager login
Route::get('/manager/lnxx', [App\Http\Controllers\Auth\ManagerController::class, 'getLogin'])->name('agent');
Route::post('/manager/login', [App\Http\Controllers\Auth\ManagerController::class, 'postLogin']);
Route::any('/manager/logout', [App\Http\Controllers\Auth\ManagerController::class, 'agentLogout'])->name('logout-agent');
Route::group(['middleware' => 'manager', 'after' => 'no-cache'], function () {
    Route::prefix('manager')->group(function () {
    Route::get('dashboard', ['as' => 'manager.dashboard', 'uses' => 'App\Http\Controllers\Manager\DashboardController@index']);
    Route::any('leads/add_lead', [App\Http\Controllers\LeadController::class, 'create'])->name('manager.leads.add_leads');
    Route::get('manager/lead/sample/sheet/download', 'App\Http\Controllers\UploadController@lead_sample_sheet_download')->name('manager.lead.sample.sheet.download');
    Route::post('manager/upload/lead', 'App\Http\Controllers\UploadController@manager_lead_upload')->name('manager-upload-lead');
    Route::resource('manager-lead','App\Http\Controllers\LeadController', [
        'names' => [
            'store'     => 'manager-lead.store',
            'update'    => 'manager-lead.update',
        ],
        'except' => ['show','destroy']
    ]);
    Route::any('leads/open-leads', [App\Http\Controllers\LeadController::class, 'lead_assign_leads'])->name('manager.leads.open_leads');
    Route::any('manager/open-lead/action', ['as' => 'manager.open.lead.action',
            'uses' => 'App\Http\Controllers\LeadController@assignleadAction']);
    Route::any('manager/open/lead/paginate/{page?}', ['as' => 'manager.open.lead.paginate',
            'uses' => 'App\Http\Controllers\LeadController@assignleadPaginate']);
    Route::any('admin-view-details', 'App\Http\Controllers\LeadController@assign_lead_view');
    Route::any('save-view-details', 'App\Http\Controllers\LeadController@save_view_details');
    Route::any('leads/closed-leads', [App\Http\Controllers\LeadController::class, 'lead_close_leads'])->name('manager.leads.closed_leads');
    Route::any('manager/close/lead/paginate/{page?}', ['as' => 'manager.close.lead.paginate',
            'uses' => 'App\Http\Controllers\LeadController@CloseleadPaginate']);
    Route::any('manager/close-lead/action', ['as' => 'manager.close.lead.action',
            'uses' => 'App\Http\Controllers\LeadController@CloseleadsAction']);
    Route::any('leads/lead_close_leads/download', 'App\Http\Controllers\LeadController@lead_close_leads_download');
    Route::get('manager-lead/page', 'App\Http\Controllers\LeadController@admin_lead_page')->name('manager-lead-tracking');
    Route::any('emp-lead/tracking-open', 'App\Http\Controllers\Employee\LeadController@admin_lead_open_tracking');
    Route::any('emp-lead/tracking-inprocess', 'App\Http\Controllers\Employee\LeadController@admin_lead_inprocess_tracking');
    Route::any('emp-lead/tracking-reminder', 'App\Http\Controllers\Employee\LeadController@admin_lead_reminder_tracking');
    Route::get('admin-lead/popup', 'App\Http\Controllers\LeadController@admin_lead_popup');
    Route::get('get-mail', 'App\Http\Controllers\LeadController@get_mail')->name('manager.get.mail');
    Route::any('send_in_close_status', 'App\Http\Controllers\LeadController@send_in_close_status');
    Route::get('follow_up_sub', [App\Http\Controllers\LeadController::class, 'follow_up_sub']);
    Route::any('admin-lead/case-detail', 'App\Http\Controllers\LeadController@case_detail');
    Route::any('leads/social', [App\Http\Controllers\LeadController::class, 'social'])->name('manager.leads.social');
    Route::any('manager/employees', [App\Http\Controllers\ManagerController::class, 'manager_employees'])->name('manager.employees');
    Route::any('employees/paginate/{page?}', ['as' => 'employees.paginate',
            'uses' => 'App\Http\Controllers\ManagerController@employeespaginate']);
    Route::any('employees/action', ['as' => 'employees.action',
            'uses' => 'App\Http\Controllers\ManagerController@employeesaction']);
    Route::any('admin-lead/mail-details', 'App\Http\Controllers\LeadController@mail_details');
});
});

// Agent Login
Route::any('leads/social/{u_id}', [App\Http\Controllers\Frontend\HomeController::class, 'social_form'])->name('social_form');
Route::any('email/otp/lead', [App\Http\Controllers\Frontend\HomeController::class, 'email_otp_lead']);
Route::any('mobile/otp/lead', [App\Http\Controllers\Frontend\HomeController::class, 'mobile_otp_lead']);
Route::any('leads/store-social/{u_id}', [App\Http\Controllers\Frontend\HomeController::class, 'social_store'])->name('social.lead.store');
Route::get('/agent/lnxx', [App\Http\Controllers\Auth\AgentController::class, 'getLogin'])->name('agent');
Route::post('/agent/login', [App\Http\Controllers\Auth\AgentController::class, 'postLogin']);
Route::any('/agent/logout', [App\Http\Controllers\Auth\AgentController::class, 'agentLogout'])->name('logout-agent');

Route::group(['middleware' => 'agent', 'after' => 'no-cache'], function () {
    Route::prefix('agent')->group(function () {

    Route::get('/dashboard', ['as' => 'agent.dashboard', 'uses' => 'App\Http\Controllers\Agent\DashboardController@index']);

    // Change Password Routes
        Route::any('my-account', ['as' => 'setting.manage-account-agent',
                'uses' => 'App\Http\Controllers\SettingController@myAccount']);
    // Change Password Routes

    Route::post('agent/upload/lead', 'App\Http\Controllers\UploadController@agent_lead_upload')->name('agent-upload-lead');
    Route::get('agent/lead/sample/sheet/download', 'App\Http\Controllers\UploadController@lead_sample_sheet_download')->name('agent.lead.sample.sheet.download');
    Route::resource('agent-lead','App\Http\Controllers\LeadController', [
        'names' => [
            'store'     => 'agent-lead.store',
            'update'    => 'agent-lead.update',
        ],
        'except' => ['show','destroy']
    ]);
    Route::any('leads/add_lead', [App\Http\Controllers\LeadController::class, 'create'])->name('agent.leads.add_leads');
    Route::any('leads/edit_lead/{id}', [App\Http\Controllers\Agent\LeadController::class, 'edit_leads'])->name('agent.leads.edit_leads');
    Route::any('leads/open-leads', [App\Http\Controllers\LeadController::class, 'lead_assign_leads'])->name('agent.leads.open_leads');
    Route::any('leads/closed-leads', [App\Http\Controllers\LeadController::class, 'lead_close_leads'])->name('agent.leads.closed_leads');
    Route::any('leads/social', [App\Http\Controllers\LeadController::class, 'social'])->name('agent.leads.social');
    

    Route::any('employeee/pending/paginate/{page?}', ['as' => 'employeee.pending.paginate',
    'uses' => 'App\Http\Controllers\Employee\LeadController@leadPendingPaginate']);

    Route::any('employeee/pending/action', ['as' => 'employeee.pending.action',
            'uses' => 'App\Http\Controllers\Employee\LeadController@leadsPendingAction']);
    
    Route::any('agent/open-lead/action', ['as' => 'agent.open.lead.action',
            'uses' => 'App\Http\Controllers\LeadController@assignleadAction']);
        
    Route::any('agent/close/lead/paginate/{page?}', ['as' => 'agent.close.lead.paginate',
            'uses' => 'App\Http\Controllers\LeadController@CloseleadPaginate']);
    Route::any('agent/close-lead/action', ['as' => 'agent.close.lead.action',
            'uses' => 'App\Http\Controllers\LeadController@CloseleadsAction']);
        
    Route::any('agent/open/lead/paginate/{page?}', ['as' => 'agent.open.lead.paginate',
            'uses' => 'App\Http\Controllers\LeadController@assignleadPaginate']);
    Route::get('send-status', [App\Http\Controllers\Agent\LeadController::class, 'send_status'])->name('agent.send_status');
    Route::get('runtime-note', [App\Http\Controllers\Agent\LeadController::class, 'runtime_note'])->name('agent.runtime-note');
    Route::get('runtime-date', [App\Http\Controllers\Agent\LeadController::class, 'runtime_date'])->name('agent.runtime-date');
    Route::any('agent-lead/tracking-open', 'App\Http\Controllers\Agent\LeadController@admin_lead_open_tracking');
    Route::any('agent-lead/tracking-reminder', 'App\Http\Controllers\LeadController@admin_lead_reminder_tracking');
    Route::any('agent-lead/tracking-inprocess', 'App\Http\Controllers\LeadController@admin_lead_inprocess_tracking');
    Route::get('agent-lead/page', 'App\Http\Controllers\LeadController@admin_lead_page')->name('agent-lead-tracking');
    Route::get('send-value', [App\Http\Controllers\CustomerController::class, 'send_value']);
    Route::any('send_in_close_status', 'App\Http\Controllers\LeadController@send_in_close_status');
    Route::get('get-mail', 'App\Http\Controllers\LeadController@get_mail')->name('agent.get.mail');
    Route::get('admin-lead/popup', 'App\Http\Controllers\LeadController@admin_lead_popup')->name('agent-lead-popup');
    Route::any('admin-view-details', 'App\Http\Controllers\LeadController@assign_lead_view');
    Route::any('save-view-details', 'App\Http\Controllers\LeadController@save_view_details');
    Route::any('leads/lead_close_leads/download', 'App\Http\Controllers\LeadController@lead_close_leads_download')->name('agent.leads.lead_close_leads.download');
    Route::any('admin-lead/case-detail', 'App\Http\Controllers\LeadController@case_detail');
    Route::get('follow_up_sub', [App\Http\Controllers\LeadController::class, 'follow_up_sub']);
    Route::any('admin-lead/mail-details', 'App\Http\Controllers\LeadController@mail_details');

    // Route::get('ajax-send', [App\Http\Controllers\Employee\LeadController::class, 'ajax_send'])->name('ajax_send');

});

});



// Employee login
Route::get('/employee/lnxx', [App\Http\Controllers\Auth\EmpController::class, 'getLogin'])->name('employee');
Route::post('/employee/login', [App\Http\Controllers\Auth\EmpController::class, 'postLogin']);
Route::any('/employee/logout', [App\Http\Controllers\Auth\EmpController::class, 'employeeLogout'])->name('logout-employee');

Route::group(['middleware' => 'emp', 'after' => 'no-cache'], function () {
        Route::prefix('employee')->group(function () {
        Route::get('dashboard', ['as' => 'employee.dashboard', 'uses' => 'App\Http\Controllers\Employee\DashboardController@index']);
        Route::post('emp/upload/lead', 'App\Http\Controllers\UploadController@emp_lead_upload')->name('emp-upload-lead');
        Route::get('emp/lead/sample/sheet/download', 'App\Http\Controllers\UploadController@lead_sample_sheet_download')->name('emp.lead.sample.sheet.download');

        Route::resource('emp-lead','App\Http\Controllers\LeadController', [
            'names' => [
                // 'index'     => 'emp-lead.index',
                // 'create'    => 'emp-lead.create',
                'store'     => 'emp-lead.store',
                'edit'      => 'emp-lead.edit',
                'update'    => 'emp-lead.update',
            ],
            'except' => ['show','destroy']
        ]);
        // Route::resource('emp-lead','App\Http\Controllers\LeadController', [
        //     'names' => [
        //         'create'     => 'emp-lead.create',
        //         'update'    => 'emp-lead.update',
        //     ],
        //     'except' => ['show','destroy']
        // ]);
        Route::any('leads/add_lead', [App\Http\Controllers\LeadController::class, 'create'])->name('leads.add_leads');
        Route::any('leads/edit_lead/{id}', [App\Http\Controllers\Employee\LeadController::class, 'edit_leads'])->name('leads.edit_leads');
        Route::any('leads/open-leads', [App\Http\Controllers\LeadController::class, 'lead_assign_leads'])->name('leads.open_leads');
        Route::any('leads/closed-leads', [App\Http\Controllers\LeadController::class, 'lead_close_leads'])->name('leads.closed_leads');
         Route::any('leads/social', [App\Http\Controllers\LeadController::class, 'social'])->name('employee.leads.social');
        Route::any('emp-lead/tracking-open', 'App\Http\Controllers\Employee\LeadController@admin_lead_open_tracking');
        Route::any('emp-lead/tracking-reminder', 'App\Http\Controllers\Employee\LeadController@admin_lead_reminder_tracking');
        Route::any('emp-lead/tracking-inprocess', 'App\Http\Controllers\Employee\LeadController@admin_lead_inprocess_tracking');
        Route::get('emp-lead/page', 'App\Http\Controllers\LeadController@admin_lead_page')->name('emp-lead-tracking');


        Route::any('employeee/pending/paginate/{page?}', ['as' => 'employeee.pending.paginate',
        'uses' => 'App\Http\Controllers\Employee\LeadController@leadPendingPaginate']);

        Route::any('employeee/pending/action', ['as' => 'employeee.pending.action',
                'uses' => 'App\Http\Controllers\Employee\LeadController@leadsPendingAction']);
        
        Route::any('emp/open-lead/action', ['as' => 'emp.open.lead.action',
                'uses' => 'App\Http\Controllers\LeadController@assignleadAction']);
            
        Route::any('emp/close/lead/paginate/{page?}', ['as' => 'emp.close.lead.paginate',
                'uses' => 'App\Http\Controllers\LeadController@closeleadPaginate']);
        Route::any('emp/close-lead/action', ['as' => 'emp.close.lead.action',
                'uses' => 'App\Http\Controllers\LeadController@closeleadAction']);
            
        Route::any('emp/open/lead/paginate/{page?}', ['as' => 'emp.open.lead.paginate',
                'uses' => 'App\Http\Controllers\LeadController@assignleadPaginate']);
        Route::get('emp-lead/popup', 'App\Http\Controllers\Employee\LeadController@admin_lead_popup')->name('emp-lead-popup');
        Route::any('admin-view-details', 'App\Http\Controllers\LeadController@assign_lead_view');
            Route::any('save-view-details', 'App\Http\Controllers\LeadController@save_view_details');

        Route::get('send-status', [App\Http\Controllers\Employee\LeadController::class, 'send_status'])->name('send_status');
        Route::get('runtime-note', [App\Http\Controllers\Employee\LeadController::class, 'runtime_note'])->name('runtime-note');
        Route::get('runtime-date', [App\Http\Controllers\Employee\LeadController::class, 'runtime_date'])->name('runtime-date');
        Route::any('leads/lead_close_leads/download', 'App\Http\Controllers\LeadController@lead_close_leads_download')->name('emp.leads.lead_close_leads.download');
        Route::get('send-value', [App\Http\Controllers\CustomerController::class, 'send_value']);
        Route::any('send_in_close_status', 'App\Http\Controllers\LeadController@send_in_close_status');
        Route::get('get-mail', 'App\Http\Controllers\LeadController@get_mail')->name('emp.get.mail');
        Route::get('admin-lead/popup', 'App\Http\Controllers\LeadController@admin_lead_popup')->name('emp-lead-popup');
        Route::get('follow_up_sub', [App\Http\Controllers\LeadController::class, 'follow_up_sub']);
        Route::any('admin-lead/case-detail', 'App\Http\Controllers\LeadController@case_detail');
        Route::any('admin-lead/mail-details', 'App\Http\Controllers\LeadController@mail_details');

});

});


Route::get('/admin/lnxx', [App\Http\Controllers\Auth\AuthController::class, 'getLogin'])->name('admin');
Route::post('/admin/login', [App\Http\Controllers\Auth\AuthController::class, 'postLogin']);
Route::any('/admin/logout', [App\Http\Controllers\Auth\AuthController::class, 'adminLogout'])->name('logout-admin');

Route::group(['middleware' => 'auth', 'after' => 'no-cache'], function () {

    Route::prefix('admin')->group(function () {

        Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'App\Http\Controllers\DashboardController@index']);
      
               // Customer route start
            Route::resource('customer','App\Http\Controllers\CustomerController', [
                'names' => [
                    // 'index'     => 'customer.index',
                    'create'    => 'customer.create',
                    'store'     => 'customer.store',
                    'edit'      => 'customer.edit',
                    'update'    => 'customer.update',
                ],
                'except' => ['show','destroy']
            ]);
            Route::get('customer', 'App\Http\Controllers\CustomerController@index')->name('customer');

            Route::any('customer/paginate/{page?}', ['as' => 'customer.paginate',
                'uses' => 'App\Http\Controllers\CustomerController@customerPaginate']);
            Route::any('customer/paginate-data-entry/{page?}', ['as' => 'customer.paginate-data-entry',
                'uses' => 'App\Http\Controllers\CustomerController@customerPaginate_data_entry']);
            Route::any('customer/action', ['as' => 'customer.action',
                'uses' => 'App\Http\Controllers\CustomerController@customerAction']);
            Route::any('customer/toggle/{id?}', ['as' => 'customer.toggle',
                'uses' => 'App\Http\Controllers\CustomerController@customerToggle']);
            Route::any('customer/drop/{id?}', ['as' => 'customer.drop',
                'uses' => 'App\Http\Controllers\CustomerController@drop']);
            Route::any('customer/data-entry', 'App\Http\Controllers\CustomerController@customerdataentry')->name('customer.data-entry');
            Route::any('customer/action-data-entry', ['as' => 'customer-data-entry.action',
                'uses' => 'CustomerController@customerAction_data_entry']);
            Route::any('customer/export-users', 'CustomerController@export_users')->name('customer.export-users');
            Route::any('export-category', 'CustomerController@export_category')->name('export-category');
            Route::any('admin-users', 'CustomerController@admin_users')->name('admin_users');
            Route::any('export-order', 'CustomerController@export_order')->name('export-order');
            Route::any('customer-record', 'CustomerController@customerRecord')->name('customer-record');
            // Customer route end   
            Route::post('upload/lead', 'App\Http\Controllers\UploadController@lead_upload')->name('upload-lead');
            Route::get('lead/sample/sheet/download', 'App\Http\Controllers\UploadController@lead_sample_sheet_download')->name('lead.sample.sheet.download');
            Route::any('admin-lead/case-detail', 'App\Http\Controllers\LeadController@case_detail');
            Route::any('admin-lead/tracking-open', 'App\Http\Controllers\LeadController@admin_lead_open_tracking');
            Route::any('admin-lead/tracking-reminder', 'App\Http\Controllers\LeadController@admin_lead_reminder_tracking');
            Route::any('admin-view-details', 'App\Http\Controllers\LeadController@assign_lead_view');
            Route::any('admin-all-view-details', 'App\Http\Controllers\LeadController@assign_all_lead_view');
            Route::any('save-view-details', 'App\Http\Controllers\LeadController@save_view_details');
            Route::any('show_popup', 'App\Http\Controllers\LeadController@show_popup'); 
            Route::any('send_in_close_status', 'App\Http\Controllers\LeadController@send_in_close_status');
            Route::any('leads/lead_close_leads/download', 'App\Http\Controllers\LeadController@lead_close_leads_download')->name('leads.lead_close_leads.download');
            Route::any('onboard/user/details', 'App\Http\Controllers\LeadController@onboard_user_details')->name('onboard.user.details');
            Route::any('admin-lead/tracking-inprocess', 'App\Http\Controllers\LeadController@admin_lead_inprocess_tracking');
            Route::get('admin-lead/page', 'App\Http\Controllers\LeadController@admin_lead_page')->name('admin-lead-tracking');
            Route::get('admin-lead/popup', 'App\Http\Controllers\LeadController@admin_lead_popup')->name('admin-lead-popup');
            Route::get('get-mail', 'App\Http\Controllers\LeadController@get_mail')->name('get.mail');
            Route::resource('lead','App\Http\Controllers\LeadController', [
                'names' => [
                    'index'     => 'lead.index',
                    'create'    => 'lead.create',
                    'store'     => 'lead.store',
                    'edit'      => 'lead.edit',
                    'update'    => 'lead.update',
                ],
                'except' => ['show','destroy']
            ]);
            Route::any('lead/paginate/{page?}', ['as' => 'lead.paginate',
                'uses' => 'App\Http\Controllers\LeadController@leadPaginate']);
            Route::any('lead/action', ['as' => 'lead.action',
                'uses' => 'App\Http\Controllers\LeadController@leadAction']);
            Route::any('assign/lead/paginate/{page?}', ['as' => 'assign.lead.paginate',
                'uses' => 'App\Http\Controllers\LeadController@assignleadPaginate']);
            Route::any('assign/lead/action', ['as' => 'assign.lead.action',
                'uses' => 'App\Http\Controllers\LeadController@assignleadAction']);
            Route::any('open/lead/paginate/{page?}', ['as' => 'open.lead.paginate',
                'uses' => 'App\Http\Controllers\LeadController@openleadPaginate']);
            Route::any('open/lead/action', ['as' => 'open.lead.action',
                'uses' => 'App\Http\Controllers\LeadController@openleadAction']);
            Route::any('auto/lead/paginate/{page?}', ['as' => 'auto.lead.paginate',
                'uses' => 'App\Http\Controllers\LeadController@autoleadPaginate']);
            Route::any('auto/lead/action', ['as' => 'auto.lead.action',
                'uses' => 'App\Http\Controllers\LeadController@autoleadAction']);
            Route::any('close/lead/paginate/{page?}', ['as' => 'close.lead.paginate',
                'uses' => 'App\Http\Controllers\LeadController@closeleadPaginate']);
            Route::any('close/lead/action', ['as' => 'close.lead.action',
                'uses' => 'App\Http\Controllers\LeadController@closeleadAction']);

            Route::any('leads/lead-assign-leads', [App\Http\Controllers\LeadController::class, 'lead_assign_leads'])->name('leads.lead_assign_leads');
            Route::any('leads/single_check_val', [App\Http\Controllers\LeadController::class, 'leads_single_check_val'])->name('leads.single_check_val');
            Route::any('leads/lead-assign-automatic-leads', [App\Http\Controllers\LeadController::class, 'lead_assign_automatic_leads'])->name('leads.lead_assign_automatic_leads');
            Route::any('leads/lead-open-leads', [App\Http\Controllers\LeadController::class, 'lead_open_leads'])->name('leads.lead_open_leads');
            Route::any('leads/lead-close-leads', [App\Http\Controllers\LeadController::class, 'lead_close_leads'])->name('leads.lead_close_leads');
            
            Route::any('multiple/check/val', [App\Http\Controllers\LeadController::class, 'multiple_check_val'])->name('leads.multiple_check_val');
            Route::get('/autocomplete-search', [TypeaheadController::class, 'autocompleteSearch']);
            
            // Change Password Routes
            Route::any('myaccount', ['as' => 'setting.manage-account',
                'uses' => 'App\Http\Controllers\SettingController@myAccount']);
            // Change Password Routes

            // Service Master route start
            Route::resource('services', 'App\Http\Controllers\ServiceController', [
                'names' => [
                    'index'     => 'services.index',
                    'create'    => 'services.create',
                    'store'     => 'services.store',
                    'edit'      => 'services.edit',
                    'update'    => 'services.update',
                ],
                'except' => ['show','destroy']
            ]);

            Route::any('services/paginate/{page?}', ['as' => 'services.paginate',
                'uses' => 'App\Http\Controllers\ServiceController@servicesPaginate']);
            Route::any('services/action', ['as' => 'services.action',
                'uses' => 'App\Http\Controllers\ServiceController@servicesAction']);
            Route::any('services/toggle/{id?}', ['as' => 'services.toggle',
                'uses' => 'App\Http\Controllers\ServiceController@servicesToggle']);
            Route::any('services/drop/{id?}', ['as' => 'services.drop',
                'uses' => 'services@drop']);
            // Service

            // Application Master route start
            Route::resource('applications', 'App\Http\Controllers\ApplicationController', [
                'names' => [
                    'index'     => 'applications.index',
                    'create'    => 'applications.create',
                    'store'     => 'applications.store',
                    'edit'      => 'applications.edit',
                    'update'    => 'applications.update',
                ],
                'except' => ['show','destroy']
            ]);

            Route::any('applications/paginate/{page?}', ['as' => 'applications.paginate',
                'uses' => 'App\Http\Controllers\ApplicationController@Paginate']);
            Route::any('applications/action', ['as' => 'applications.action',
                'uses' => 'App\Http\Controllers\ApplicationController@Action']);
            Route::any('applications/toggle/{id?}', ['as' => 'applications.toggle',
                'uses' => 'App\Http\Controllers\ApplicationController@Toggle']);
            Route::any('applications/drop/{id?}', ['as' => 'applications.drop',
                'uses' => 'applications@drop']);
            Route::any('applications/print/{id}', [App\Http\Controllers\ApplicationController::class, 'applications_print'])->name('applications-print');

            Route::any('applications/profile', [App\Http\Controllers\ApplicationController::class, 'profile_pdf'])->name('applications-profile');
            // Application


            // banks Master route start
            Route::resource('banks', 'App\Http\Controllers\BankController', [
                'names' => [
                    'index'     => 'banks.index',
                    'create'    => 'banks.create',
                    'store'     => 'banks.store',
                    'edit'      => 'banks.edit',
                    'update'    => 'banks.update',
                ],
                'except' => ['show','destroy']
            ]);
            Route::any('banks/paginate/{page?}', ['as' => 'banks.paginate',
                'uses' => 'App\Http\Controllers\BankController@servicesPaginate']);
            Route::any('banks/action', ['as' => 'banks.action',
                'uses' => 'App\Http\Controllers\BankController@servicesAction']);
            Route::any('banks/toggle/{id?}', ['as' => 'banks.toggle',
                'uses' => 'App\Http\Controllers\BankController@servicesToggle']);
            Route::any('banks/drop/{id?}', ['as' => 'banks.drop',
                'uses' => 'banks@drop']);
            // banks
           
            // Employess Master route start
            Route::resource('employee', 'App\Http\Controllers\EmpolyeeController', [
                'names' => [
                    'index'     => 'employee.index',
                    'create'    => 'employee.create',
                    'store'     => 'employee.store',
                    'edit'      => 'employee.edit',
                    'update'    => 'employee.update',
                ],
                'except' => ['show','destroy']
            ]);

            Route::any('employee/paginate/{page?}', ['as' => 'employee.paginate',
                'uses' => 'App\Http\Controllers\EmpolyeeController@empPaginate']);
            Route::any('employee/action', ['as' => 'employee.action',
                'uses' => 'App\Http\Controllers\EmpolyeeController@servicesAction']);
            Route::any('employee/toggle/{id?}', ['as' => 'employee.toggle',
                'uses' => 'App\Http\Controllers\EmpolyeeController@servicesToggle']);
            Route::any('employee/drop/{id?}', ['as' => 'employee.drop',
                'uses' => 'EmpolyeeController@drop']);
            

            // testimonials Master route start
            Route::resource('testimonials', 'App\Http\Controllers\TestimonialController', [
                'names' => [
                    'index'     => 'testimonials.index',
                    'create'    => 'testimonials.create',
                    'store'     => 'testimonials.store',
                    'edit'      => 'testimonials.edit',
                    'update'    => 'testimonials.update',
                ],
                'except' => ['show','destroy']
            ]);

            Route::any('testimonials/paginate/{page?}', ['as' => 'testimonials.paginate',
                'uses' => 'App\Http\Controllers\TestimonialController@servicesPaginate']);
            Route::any('testimonials/action', ['as' => 'testimonials.action',
                'uses' => 'App\Http\Controllers\TestimonialController@servicesAction']);
            Route::any('testimonials/toggle/{id?}', ['as' => 'testimonials.toggle',
                'uses' => 'App\Http\Controllers\TestimonialController@servicesToggle']);
            Route::any('testimonials/drop/{id?}', ['as' => 'testimonials.drop',
                'uses' => 'testimonials@drop']);
            // testimonials

            // Credit Card Engines Master route start
            Route::resource('credit-card-engines', 'App\Http\Controllers\CreditCardEnginesController', [
                'names' => [
                    'index'     => 'credit-card-engines.index',
                    'create'    => 'credit-card-engines.create',
                    'store'     => 'credit-card-engines.store',
                    'edit'      => 'credit-card-engines.edit',
                    'update'    => 'credit-card-engines.update',
                ],
                'except' => ['show','destroy']
            ]);

            Route::any('credit-card-engines/paginate/{page?}', ['as' => 'credit-card-engines.paginate',
                'uses' => 'App\Http\Controllers\CreditCardEnginesController@servicesPaginate']);
            Route::any('credit-card-engines/action', ['as' => 'credit-card-engines.action',
                'uses' => 'App\Http\Controllers\CreditCardEnginesController@servicesAction']);
            Route::any('credit-card-engines/toggle/{id?}', ['as' => 'credit-card-engines.toggle',
                'uses' => 'App\Http\Controllers\CreditCardEnginesController@servicesToggle']);
            Route::any('credit-card-engines/drop/{id?}', ['as' => 'credit-card-engines.drop',
                'uses' => 'credit-card-engines@drop']);
            // Credit Card Engines end

            // sliders Master route start
            Route::resource('sliders', 'App\Http\Controllers\SliderController', [
                'names' => [
                    'index'     => 'sliders.index',
                    'create'    => 'sliders.create',
                    'store'     => 'sliders.store',
                    'edit'      => 'sliders.edit',
                    'update'    => 'sliders.update',
                ],
                'except' => ['show','destroy']
            ]);

            Route::any('sliders/paginate/{page?}', ['as' => 'sliders.paginate',
                'uses' => 'App\Http\Controllers\SliderController@servicesPaginate']);
            Route::any('sliders/action', ['as' => 'sliders.action',
                'uses' => 'App\Http\Controllers\SliderController@servicesAction']);
            Route::any('sliders/toggle/{id?}', ['as' => 'sliders.toggle',
                'uses' => 'App\Http\Controllers\SliderController@servicesToggle']);
            Route::any('sliders/drop/{id?}', ['as' => 'sliders.drop',
                'uses' => 'sliders@drop']);
            // sliders
            

            // small sliders Master route start
            Route::resource('landing-sliders', 'App\Http\Controllers\SmallSliderController', [
                'names' => [
                    'index'     => 'landing-sliders.index',
                    'create'    => 'landing-sliders.create',
                    'store'     => 'landing-sliders.store',
                    'edit'      => 'landing-sliders.edit',
                    'update'    => 'landing-sliders.update',
                ],
                'except' => ['show','destroy']
            ]);

            Route::any('landing-sliders/paginate/{page?}', ['as' => 'landing-sliders.paginate',
                'uses' => 'App\Http\Controllers\SmallSliderController@servicesPaginate']);
            Route::any('landing-sliders/action', ['as' => 'landing-sliders.action',
                'uses' => 'App\Http\Controllers\SmallSliderController@servicesAction']);
            Route::any('landing-sliders/toggle/{id?}', ['as' => 'landing-sliders.toggle',
                'uses' => 'App\Http\Controllers\SmallSliderController@servicesToggle']);
            Route::any('landing-sliders/drop/{id?}', ['as' => 'landing-sliders.drop',
                'uses' => 'landing-sliders@drop']);
            // small sliders

            // Agent Requests route start
            Route::resource('agent-request', 'App\Http\Controllers\AgentRequestController', [
                'names' => [
                    'index'     => 'agent-request.index',
                    'create'    => 'agent-request.create',
                    'store'     => 'agent-request.store',
                    'edit'      => 'agent-request.edit',
                    'update'    => 'agent-request.update',
                ],
                'except' => ['show','destroy']
            ]);

            Route::any('agent-request/paginate/{page?}', ['as' => 'agent-request.paginate',
                'uses' => 'App\Http\Controllers\AgentRequestController@Paginate']);
            Route::any('agent-request/action', ['as' => 'agent-request.action',
                'uses' => 'App\Http\Controllers\AgentRequestController@Action']);
            Route::any('agent-request/toggle/{id?}', ['as' => 'agent-request.toggle',
                'uses' => 'App\Http\Controllers\AgentRequestController@Toggle']);
            Route::any('agent-request/drop/{id?}', ['as' => 'agent-request.drop',
                'uses' => 'agent-request@drop']);
            // Agent Requests

            // Card Type route start
            Route::resource('card-type', 'App\Http\Controllers\CardTypeController', [
                'names' => [
                    'index'     => 'card-type.index',
                    'create'    => 'card-type.create',
                    'store'     => 'card-type.store',
                    'edit'      => 'card-type.edit',
                    'update'    => 'card-type.update',
                ],
                'except' => ['show','destroy']
            ]);

            Route::any('card-type/paginate/{page?}', ['as' => 'card-type.paginate',
                'uses' => 'App\Http\Controllers\CardTypeController@Paginate']);
            Route::any('card-type/action', ['as' => 'card-type.action',
                'uses' => 'App\Http\Controllers\CardTypeController@Action']);
            Route::any('card-type/toggle/{id?}', ['as' => 'card-type.toggle',
                'uses' => 'App\Http\Controllers\CardTypeController@Toggle']);
            Route::any('card-type/drop/{id?}', ['as' => 'card-type.drop',
                'uses' => 'card-type@drop']);
            // Card Type end

            // Refers Master route start
            Route::resource('refers', 'App\Http\Controllers\ReferController', [
                'names' => [
                    'index'     => 'refers.index',
                    'create'    => 'refers.create',
                    'store'     => 'refers.store',
                    'edit'      => 'refers.edit',
                    'update'    => 'refers.update',
                ],
                'except' => ['show','destroy']
            ]);

            Route::any('refers/paginate/{page?}', ['as' => 'refers.paginate',
                'uses' => 'App\Http\Controllers\ReferController@Paginate']);
            Route::any('refers/action', ['as' => 'refers.action',
                'uses' => 'App\Http\Controllers\ReferController@Action']);
            Route::any('refers/toggle/{id?}', ['as' => 'refers.toggle',
                'uses' => 'App\Http\Controllers\ReferController@Toggle']);
            Route::any('refers/drop/{id?}', ['as' => 'refers.drop',
                'uses' => 'refers@drop']);
            // small refers


            // Contact route start
            Route::resource('contact-enquiry','App\Http\Controllers\ContactController', [
                'names' => [
                    'index'     => 'contact-enquiry.index',
                    'create'    => 'contact-enquiry.create',
                    'store'     => 'contact-enquiry.store',
                    'edit'      => 'contact-enquiry.edit',
                    'update'    => 'contact-enquiry.update',
                ],
                'except' => ['show','destroy']
            ]);

            Route::any('contact-enquiry/paginate/{page?}', ['as' => 'contact-enquiry.paginate',
                'uses' => 'App\Http\Controllers\ContactController@ContactPaginate']);
            Route::any('contact-enquiry/action', ['as' => 'contact-enquiry.action',
                'uses' => 'App\Http\Controllers\ContactController@ContactAction']);
            Route::any('contact-enquiry/toggle/{id?}', ['as' => 'contact-enquiry.toggle',
                'uses' => 'App\Http\Controllers\ContactController@ContactToggle']);
            Route::any('contact-enquiry/drop/{id?}', ['as' => 'contact-enquiry.drop',
                'uses' => 'App\Http\Controllers\ContactController@drop']);

            Route::any('export-enquiry', 'CustomerController@export_enquiry')->name('export-enquiry');
            // Contact route end


            // Blogs Master route start
            Route::resource('blogs', 'App\Http\Controllers\BlogController', [
                'names' => [
                    'index'     => 'blogs.index',
                    'create'    => 'blogs.create',
                    'store'     => 'blogs.store',
                    'edit'      => 'blogs.edit',
                    'update'    => 'blogs.update',
                ],
                'except' => ['show','destroy']
            ]);

            Route::any('blogs/paginate/{page?}', ['as' => 'blogs.paginate',
                'uses' => 'App\Http\Controllers\BlogController@Paginate']);
            Route::any('blogs/action', ['as' => 'blogs.action',
                'uses' => 'App\Http\Controllers\BlogController@Action']);
            Route::any('blogs/toggle/{id?}', ['as' => 'blogs.toggle',
                'uses' => 'App\Http\Controllers\BlogController@Toggle']);
            Route::any('blogs/drop/{id?}', ['as' => 'blogs.drop',
                'uses' => 'blogs@drop']);
            // Blogs

            // company Master route start
            Route::resource('company', 'App\Http\Controllers\CompanyController', [
                'names' => [
                    'index'     => 'company.index',
                    'create'    => 'company.create',
                    'store'     => 'company.store',
                    'edit'      => 'company.edit',
                    'update'    => 'company.update',
                ],
                'except' => ['show','destroy']
            ]);

            Route::any('company/paginate/{page?}', ['as' => 'company.paginate',
                'uses' => 'App\Http\Controllers\CompanyController@companyPaginate']);
            Route::any('company/action', ['as' => 'company.action',
                'uses' => 'App\Http\Controllers\CompanyController@companyAction']);
            Route::any('company/toggle/{id?}', ['as' => 'company.toggle',
                'uses' => 'App\Http\Controllers\CompanyController@companyToggle']);
            Route::any('company/drop/{id?}', ['as' => 'company.drop',
                'uses' => 'company@drop']);
            // company
            Route::get('send-value', [App\Http\Controllers\CustomerController::class, 'send_value']);
            Route::get('follow_up_sub', [App\Http\Controllers\LeadController::class, 'follow_up_sub']);
            Route::get('social_form_setting', [App\Http\Controllers\LeadController::class, 'social_form_setting']);
            Route::get('social_form_e_status', [App\Http\Controllers\LeadController::class, 'social_form_e_status']);
            Route::get('social_form_m_status', [App\Http\Controllers\LeadController::class, 'social_form_m_status']);
            Route::post('automatic_save_cat', [App\Http\Controllers\LeadController::class, 'automatic_save_cat']);
            Route::any('auto-distribution', [App\Http\Controllers\LeadController::class, 'auto_distribution']);
            Route::any('filter-action-distribution', [App\Http\Controllers\LeadController::class, 'filter_action_distribution']);
            Route::any('admin-lead/mail-details', 'App\Http\Controllers\LeadController@mail_details');
            Route::any('emp-agent/filter', 'App\Http\Controllers\EmpolyeeController@emp_agent_filter');
            Route::any('emp-agent/filter2', 'App\Http\Controllers\EmpolyeeController@emp_agent_filter2');
            Route::any('select-user-lead', 'App\Http\Controllers\LeadController@select_user_lead')->name('select-user-lead');
            Route::any('get-personal-details', 'App\Http\Controllers\LeadController@get_personal_details')->name('get.personal.details');

Route::any('personal-details/{id}', [App\Http\Controllers\OnboardController::class, 'personal_details'])->name('admin.personal-details');
Route::any('cm-details/{id}', [App\Http\Controllers\OnboardController::class, 'cm_details'])->name('admin.cm-details');
Route::any('product-requested/{id}', [App\Http\Controllers\OnboardController::class, 'product_requested'])->name('admin.product-requested');
Route::any('consent-approval/{id}', [App\Http\Controllers\OnboardController::class, 'consent_approval'])->name('admin.consent-approval');
Route::any('preference/{id}', [App\Http\Controllers\OnboardController::class, 'preference'])->name('admin.preference');
Route::any('save-preference/{id}', [App\Http\Controllers\OnboardController::class, 'save_preference'])->name('admin.save-preference');
Route::any('personal-loan-preference/{id}', [App\Http\Controllers\OnboardController::class, 'personal_loan_preference'])->name('admin.personal-loan-preference');
Route::any('save-personal-loan-preference/{id}', [App\Http\Controllers\OnboardController::class, 'save_personal_loan_preference'])->name('admin.save-personal-loan-preference');
Route::any('consent/{id}', [App\Http\Controllers\OnboardController::class, 'consent'])->name('admin.consent');
Route::any('record-video/{id}', [App\Http\Controllers\OnboardController::class, 'Record_Video'])->name('admin.record-video');

Route::any('thank-you/{id}', [App\Http\Controllers\OnboardController::class, 'ServiceApply'])->name('admin.thank-you');

Route::any('consent-form/{id}', [App\Http\Controllers\OnboardController::class, 'consent_form'])->name('admin.consent-form');
Route::any('view-save-personal/{id}', 'App\Http\Controllers\LeadController@view_save_personal')->name('view-save-personal');




});
});


Route::any('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('get-started');
Route::any('home', [App\Http\Controllers\Frontend\HomeController::class, 'home'])->name('home');
Route::any('sign-up', [App\Http\Controllers\Frontend\HomeController::class, 'sign_up'])->name('sign_up');
Route::any('register-email', [App\Http\Controllers\Frontend\HomeController::class, 'email_register'])->name('register-email');
Route::any('email-otp', [App\Http\Controllers\Frontend\HomeController::class, 'email_otp'])->name('email-otp');

Route::any('article/{url}', [App\Http\Controllers\Frontend\HomeController::class, 'article'])->name('article');

Route::any('enter-name', [App\Http\Controllers\Frontend\HomeController::class, 'enter_name'])->name('enter-name');
Route::any('user-register', [App\Http\Controllers\Frontend\HomeController::class, 'user_register'])->name('user-register');
Route::get('getState', [App\Http\Controllers\CategoryController::class, 'getState'])->name('getState');
Route::get('getCity', [App\Http\Controllers\CategoryController::class, 'getCity'])->name('getCity');
Route::get('otp-match', [App\Http\Controllers\Frontend\HomeController::class, 'otp_match'])->name('otp-match');
Route::get('email-otp-match', [App\Http\Controllers\Frontend\HomeController::class, 'email_otp_match'])->name('email-otp-match');
Route::get('login-otp-match', [App\Http\Controllers\Frontend\HomeController::class, 'login_otp_match'])->name('login-otp-match');

Route::any('sign-in', [App\Http\Controllers\Frontend\HomeController::class, 'sign_in'])->name('sign-in');
Route::any('enter-login-otp', [App\Http\Controllers\Frontend\HomeController::class, 'login_otp'])->name('enter-login-otp');
Route::any('log-in', [App\Http\Controllers\Frontend\HomeController::class, 'login'])->name('log-in');
Route::any('agent-menu', [App\Http\Controllers\Frontend\HomeController::class, 'agent_menu'])->name('agent-menu');
Route::any('customer-menu', [App\Http\Controllers\Frontend\HomeController::class, 'customer_menu'])->name('customer-menu');
Route::get('getSubcategory', [App\Http\Controllers\Frontend\HomeController::class, 'getSubcategory'])->name('getSubcategory');
Route::get('otp-sent', [App\Http\Controllers\Frontend\HomeController::class, 'otp_sent'])->name('otp-sent');
Route::get('email-check', [App\Http\Controllers\Frontend\HomeController::class, 'email_check'])->name('email-check');
Route::any('terms-and-conditions', [App\Http\Controllers\Frontend\HomeController::class, 'terms_conditions'])->name('terms-and-conditions');
Route::any('privacy-policy', [App\Http\Controllers\Frontend\HomeController::class, 'privacy_policy'])->name('privacy-policy');
Route::any('disclaimer', [App\Http\Controllers\Frontend\HomeController::class, 'disclaimer'])->name('disclaimer');
Route::any('community', [App\Http\Controllers\Frontend\HomeController::class, 'community'])->name('community');
Route::any('contact-us', [App\Http\Controllers\Frontend\HomeController::class, 'contact_us'])->name('contact-us');
Route::any('contact-enquiry', [App\Http\Controllers\Frontend\HomeController::class, 'contact_enquiry'])->name('contact-enquiry');
Route::group(['middleware' => 'user-auth', 'after' => 'no-cache'], function () {

Route::any('log-out', [App\Http\Controllers\Frontend\HomeController::class, 'logout'])->name('user-logout');
Route::any('my-profile', [App\Http\Controllers\Frontend\HomeController::class, 'profileShow'])->name('my-profile');
Route::any('dashboard', [App\Http\Controllers\Frontend\HomeController::class, 'dashboard'])->name('user-dashboard');
Route::any('personal-details', [App\Http\Controllers\Frontend\HomeController::class, 'personal_details'])->name('personal-details');
Route::any('profile-update', [App\Http\Controllers\Frontend\HomeController::class, 'update_profile'])->name('profile-update');
Route::any('cm-details', [App\Http\Controllers\Frontend\HomeController::class, 'cm_details'])->name('cm-details');
Route::any('education-detail', [App\Http\Controllers\Frontend\HomeController::class, 'education_detail'])->name('education-detail');
Route::any('save-education-details', [App\Http\Controllers\Frontend\HomeController::class, 'save_education_details'])->name('save-education-details');
Route::any('credit-card-information', [App\Http\Controllers\Frontend\HomeController::class, 'credit_card_information'])->name('credit-card-information');
Route::any('save-credit-card-information', [App\Http\Controllers\Frontend\HomeController::class, 'save_credit_card_information'])->name('save-credit-card-information');

Route::any('personal-loan-information', [App\Http\Controllers\Frontend\HomeController::class, 'personal_loan_information'])->name('personal-loan-information');

Route::any('all-relations', [App\Http\Controllers\Frontend\HomeController::class, 'all_relations'])->name('all-relations');

Route::any('save-personal-loan-information', [App\Http\Controllers\Frontend\HomeController::class, 'save_personal_loan_information'])->name('save-personal-loan-information');
Route::any('information-form', [App\Http\Controllers\Frontend\HomeController::class, 'information_form'])->name('information-form');
Route::any('save-information-form', [App\Http\Controllers\Frontend\HomeController::class, 'save_information_form'])->name('save-information-form');

Route::any('product-requested', [App\Http\Controllers\Frontend\HomeController::class, 'product_requested'])->name('product-requested');

Route::any('save-product-requested', [App\Http\Controllers\Frontend\HomeController::class, 'save_product_requested'])->name('save-products-requested');

Route::any('address-details', [App\Http\Controllers\Frontend\HomeController::class, 'address_details'])->name('address-details');
Route::any('select-services', [App\Http\Controllers\Frontend\HomeController::class, 'select_services'])->name('select-services');
Route::any('record-video', [App\Http\Controllers\Frontend\HomeController::class, 'Record_Video'])->name('record-video');
Route::any('consent-form', [App\Http\Controllers\Frontend\HomeController::class, 'consent_form'])->name('consent-form');
Route::any('consent-approval', [App\Http\Controllers\Frontend\HomeController::class, 'consent_approval'])->name('consent-approval');
Route::any('thank-you', [App\Http\Controllers\Frontend\HomeController::class, 'ServiceApply'])->name('thank-you');

Route::any('verify-emirates-id', [App\Http\Controllers\Frontend\HomeController::class, 'verify_emirates_id'])->name('verify-emirates-id');
Route::any('verify-emirates', [App\Http\Controllers\Frontend\HomeController::class, 'verify_emirates'])->name('verify-emirates');
Route::any('preference', [App\Http\Controllers\Frontend\HomeController::class, 'preference'])->name('preference');
Route::any('save-preference', [App\Http\Controllers\Frontend\HomeController::class, 'save_preference'])->name('save-preference');

Route::any('personal-loan-preference', [App\Http\Controllers\Frontend\HomeController::class, 'personal_loan_preference'])->name('personal-loan-preference');

Route::any('save-personal-loan-preference', [App\Http\Controllers\Frontend\HomeController::class, 'save_personal_loan_preference'])->name('save-personal-loan-preference');

Route::any('consent', [App\Http\Controllers\Frontend\HomeController::class, 'consent'])->name('consent');

Route::any('live_product_1', [App\Http\Controllers\Frontend\HomeController::class, 'live_product_1'])->name('live_product_1');

Route::get('check_product_code', [App\Http\Controllers\Frontend\HomeController::class, 'check_product_code'])->name('check_product_code');

Route::any('live_product_2', [App\Http\Controllers\Frontend\HomeController::class, 'live_product_2'])->name('live_product_2');

Route::get('check_product_code2', [App\Http\Controllers\Frontend\HomeController::class, 'check_product_code2'])->name('check_product_code2');

Route::any('refers', [App\Http\Controllers\Frontend\HomeController::class, 'refers'])->name('refers');
Route::any('congratulations', [App\Http\Controllers\Frontend\HomeController::class, 'congratulations'])->name('congratulations');

Route::any('applications-notification', [App\Http\Controllers\Frontend\HomeController::class, 'applications_notification'])->name('applications-notification');

});

Route::any('personal-loan-information-screen/{token}', [App\Http\Controllers\Frontend\HomeController::class, 'personal_loan_information_screen'])->name('personal-loan-information-screen');
Route::any('save-personal-loan-information-screen', [App\Http\Controllers\Frontend\HomeController::class, 'save_personal_loan_information_screen'])->name('save-personal-loan-information_screen');

Route::any('upload-emirates-id', [App\Http\Controllers\Frontend\HomeController::class, 'upload_emirates'])->name('upload-emirates-id');
Route::any('upload-profile-image', [App\Http\Controllers\Frontend\HomeController::class, 'upload_profile_image'])->name('upload-profile-image');

Route::any('emirates-id-verification', [App\Http\Controllers\Frontend\HomeController::class, 'emirates_id_verification'])->name('emirates-id-verification');

Route::any('save-profile-image', [App\Http\Controllers\Frontend\HomeController::class, 'save_profile_image'])->name('save-profile-image');

Route::any('agent-apply', [App\Http\Controllers\Frontend\HomeController::class, 'agent_apply'])->name('agent-apply');



Route::any('firebase-otp', [App\Http\Controllers\Frontend\HomeController::class, 'firebase_otp'])->name('firebase-otp');
Route::get('send_in_process_status', [App\Http\Controllers\LeadController::class, 'send_in_process_status'])->name('send_in_process_status');

Route::any('career', [App\Http\Controllers\Frontend\HomeController::class, 'career'])->name('career');

Route::any('lead-management-system/{email}/{time}/{mobile}', [App\Http\Controllers\Auth\AgentController::class, 'lead_management_system'])->name('lead-management-system');


Route::get('reset', function (){
    Artisan::call('optimize:clear');
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
});




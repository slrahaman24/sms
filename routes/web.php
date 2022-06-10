<?php

use Illuminate\Support\Facades\Auth;
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
Route::get('/clear', function () {
    $run = Artisan::call('config:clear');
    $run = Artisan::call('cache:clear');
    $run = Artisan::call('config:cache');
    $run = Artisan::call('view:clear');
    $run = Artisan::call('optimize:clear');
    return 'FINISHED';
});
// ********************************Login*********************************//
Auth::routes(['register' => false]);
Route::get('/', 'Auth\LoginController@showLoginForm');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout');
Route::group([  'middleware' => 'AuthChecking'], function () {

    Route::group([  'middleware' => 'PermissionCheck'], function () {
        Route::get('/id_card_generate','EmployeeController@id_card_generate');
       
        Route::get('/dashboard','DashboardController@dashboard');
        Route::get('/designation','DesignationController@designation');
        Route::get('/department_details','DepartmentController@department_details');
        Route::get('/employee_details','EmployeeController@employee_details');
        Route::get('/user_details','UserController@user_details');
        Route::get('/location','LocationController@location');
        Route::get('/shift_details','ShiftController@shift_details');
        Route::get('/employee_wise_shift_allocation','EmployeeWiseShiftController@employee_wise_shift_allocation');
        Route::get('/security_post_master','SecurityPostMasterController@security_post_master');
        Route::get('/web_user','WebUserController@web_user');
        Route::get('/user_type','UserTypeController@user_type');
       
});

// ********************************Designation*********************************//

Route::get('/add_designation','DesignationController@add_designation');
Route::post('/designation_save_update','DesignationController@designation_save_update');
Route::post('/list_designation','DesignationController@list_designation');
Route::post('/designation_edit','DesignationController@designation_edit');
Route::post('/designation_delete','DesignationController@designation_delete');

// ********************************Department*********************************//

Route::get('/add_department','DepartmentController@add_department');
Route::post('/department_save_update','DepartmentController@department_save_update');
Route::post('/list_department','DepartmentController@list_department');
Route::post('/department_edit','DepartmentController@department_edit');
Route::post('/department_delete','DepartmentController@department_delete');

// ********************************Employee*********************************//

Route::get('/add_employee','EmployeeController@add_employee');
Route::post('/get_all_designation','EmployeeController@get_all_designation');
Route::post('/get_all_department','EmployeeController@get_all_department');
Route::post('/personaldetails_save_update','EmployeeController@personaldetails_save_update');
Route::post('/get_personal_details','EmployeeController@get_personal_details');
Route::post('/contactdetails_save_update','EmployeeController@contactdetails_save_update');
Route::post('/get_contact_details','EmployeeController@get_contact_details');
Route::post('/workingdetails_save_update','EmployeeController@workingdetails_save_update');
Route::post('/list_employee','EmployeeController@list_employee');
Route::post('/list_of_employee_id_card','EmployeeController@list_of_employee_id_card');
Route::post('/id_card_emp_generate','EmployeeController@id_card_emp_generate');

Route::post('/employee_edit','EmployeeController@employee_edit');
Route::post('/get_working_details','EmployeeController@get_working_details');
Route::post('/employee_delete','EmployeeController@employee_delete');
Route::post('/view_employee_details','EmployeeController@view_employee_details');
Route::post('/salarydetails_save_update','EmployeeController@salarydetails_save_update');
Route::post('/get_salary_details','EmployeeController@get_salary_details');
Route::post('/get_all_location_security','EmployeeController@get_all_location_security');

// ********************************User*********************************//

Route::get('/add_user','UserController@add_user');
Route::post('/get_all_employee_name','UserController@get_all_employee_name');
Route::post('/user_save_update','UserController@user_save_update');
Route::post('/list_user','UserController@list_user');
Route::post('/active_deactive_user','UserController@active_deactive_user');
Route::post('/user_edit','UserController@user_edit');

// ********************************Standard Post Wise Security Allocation*********************************//
Route::post('/get_all_location','PostWiseSecurityAllocationController@get_all_location');

// ********************************Location*********************************//

Route::get('/add_location','LocationController@add_location');
Route::post('/location_save_update','LocationController@location_save_update');
Route::post('/list_of_location','LocationController@list_of_location');
Route::post('/location_edit','LocationController@location_edit');
Route::post('/location_delete','LocationController@location_delete');


// ********************************Security Post Master*********************************//

Route::get('/add_security_post','SecurityPostMasterController@add_security_post');
Route::post('/security_post_save','SecurityPostMasterController@security_post_save');
Route::post('/update_security_post','SecurityPostMasterController@update_security_post');
Route::post('/get_all_designation','SecurityPostMasterController@get_all_designation');
Route::post('/list_of_security_post','SecurityPostMasterController@list_of_security_post');
Route::post('/security_post_edit','SecurityPostMasterController@security_post_edit');
Route::post('/security_post_delete','SecurityPostMasterController@security_post_delete');

//***********************************Web User Details***************************//

Route::get('/add_web_user','WebUserController@add_web_user');
Route::post('/get_all_user_type','WebUserController@get_all_user_type');
Route::post('/web_user_save','WebUserController@web_user_save');
Route::post('/web_user_details','WebUserController@web_user_details');
Route::post('/web_user_edit','WebUserController@web_user_edit');
Route::post('/web_user_update','WebUserController@web_user_update');

//***********************************User Type***************************//

Route::get('/add_user_type','UserTypeController@add_user_type');
Route::post('/list_of_menu_submnu','UserTypeController@list_of_menu_submnu');
Route::post('/user_type_sv','UserTypeController@user_type_sv');
Route::post('/list_of_user_type','UserTypeController@list_of_user_type');
Route::post('/user_type_edit','UserTypeController@user_type_edit');
Route::post('/user_type_update','UserTypeController@user_type_update');

//******************************Shift*************************************** //

Route::get('/add_shift','ShiftController@add_shift');
Route::post('/shift_save_update','ShiftController@shift_save_update');
Route::post('/list_of_shift','ShiftController@list_of_shift');
Route::post('/shift_edit','ShiftController@shift_edit');
Route::post('/shift_delete','ShiftController@shift_delete');

//******************************Employee Wise Shift Allocation*************************************** //

Route::get('/add_employee_wise_shift_allocation','EmployeeWiseShiftController@add_employee_wise_shift_allocation');
Route::post('/get_employee_wise_shift','EmployeeWiseShiftController@get_employee_wise_shift');
Route::post('/employee_wise_shift_save_update','EmployeeWiseShiftController@employee_wise_shift_save_update');
Route::post('/search_designation_wise_employee','EmployeeWiseShiftController@search_designation_wise_employee');
Route::post('/list_of_employee_wise_shift','EmployeeWiseShiftController@list_of_employee_wise_shift');// 

 
});























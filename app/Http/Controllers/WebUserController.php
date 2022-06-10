<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tbl_user_type;
use App\tbl_mobile_user;
use DB;

class WebUserController extends Controller
{
    public function web_user()
    {
       return view('web_user');
    }
    public function add_web_user()
    {
        return view('web_user_entry');
    }

    public function get_all_user_type(Request $request)
    {  
        //  dd($request->all());
        $statusCode = 200;
        if (!$request->ajax()) {
        $statusCode = 400;
        $response = array('error' => 'Error occured in Ajax Call.');
        return response()->json($response, $statusCode);
        }
        try {
            $all_user_type = tbl_user_type::pluck('Type_name','code');
            // dd($all_user_type);
            $response = array(
                'options' => $all_user_type,
                'status' => 1
            );
        } catch (\Exception $e) {
            $response = array(
                'exception' => true,
                'exception_message' => $e->getMessage(),
            );
            $statusCode = 400;
        } finally {
            return response()->json($response, $statusCode);
        }
       
    }

    public function web_user_save(Request $request)
    {
    //    dd($request->all());
    $statusCode = 200;
    if (!$request->ajax()) {
        $statusCode = 400;
        $response = array('error' => 'Error occured in form submit.');
        return response()->json($response, $statusCode);
    }
    // $this->validate($request, [
    //     'user_name'=>"required|unique:tbl_mobile_user,name|regex: /^[A-Za-z\s]+$/i|max:40",
    //     'user_type'=>"required",
    //     'mobile_no'=>"required|unique:tbl_mobile_user,mobile_no|regex:/^[0-9]+$/|max:10",
    //     'user_id'=>"required|unique:tbl_mobile_user,user_id|min:4|max:15",
    //     'web_user_password'=> [
    //         'required',
    //         'min:6',
    //         'max:10',             
    //         'regex:/[a-z]/',     
    //         'regex:/[A-Z]/',     
    //         'regex:/[0-9]/',     
    //         'regex:/[@$!%*#?&]/',
    //     ],
    //     'confirm_password'=>"required|same:web_user_password",
    //  ],[
    //     'user_name.required' => 'User Name is Required',
    //     'user_name.unique' => "User Name already exists",
    //     'user_name.regex' => 'User Name can consist of alphabetical characters and spaces only',
    //     'user_type.required' => 'User Type is Required',
    //     'mobile_no.required' => 'Mobile No is Required',
    //      'mobile_no.unique' => "Mobile No already exists",
    //     'mobile_no.regex' => 'Mobile Number can consist of Numeric',
    //     'user_id.required' => 'User Id is Required',
    //     'user_id.unique' => 'User Id is already exists',
    //     'user_id.min' => 'User Id should contain Minimum 4 characters',
    //     'user_id.max' => 'User Id should contain Maximum 15 characters',
    //     'web_user_password.required' => 'Password is Required',
    //     'web_user_password.min' => 'The password should contain Minimum 6 characters',
    //     'web_user_password.max' => 'The password should contain Maximum 10 characters',
    //     'web_user_password.regex' => 'The password format is invalid',
    //     'confirm_password.required' => 'Confirm Password is Required',
    //     'confirm_password.same' => 'The password and its confirm are not the same',
    //     ]);
    try {
        $web_user = new tbl_mobile_user();
           $web_user->app_web_user = 2;
           $web_user->name = $request->user_name;

           $admin_exits = tbl_mobile_user::join('tbl_user_type','tbl_user_type.code','=','tbl_mobile_user.user_type')
            ->where('tbl_mobile_user.app_web_user', '=', 2)
            ->where('tbl_user_type.Type_name','=','Admin')
            ->where('tbl_mobile_user.user_type','=',$request->user_type)
            ->select('tbl_user_type.Type_name')->exists();
            // dd($admin_exits);
            if($admin_exits == true){
                $response = array(
                    'status' => 4   
                );
                return response()->json($response);
            }
           $web_user->user_type = $request->user_type;
           $web_user->mobile_no = $request->mobile_no;
           $web_user->email_address = $request->email_address;
           $web_user->user_id = $request->user_id;
           $pwd = bcrypt($request->web_user_password);
           $web_user->password = $pwd;
           if($web_user->save()){
               $response = array(
                   'status' => 1
               );
           }
           
        
    } catch (\Exception $e) {
        $response = array(
            'exception' => true,
            'exception_message' => $e->getMessage()
        );
        $statusCode = 400;
    } finally {
        return response()->json($response, $statusCode);
    }
        
    }

    public function web_user_details(Request $request)
    {
        // dd($request->all());
        // echo "hi";
        $statusCode = 200;
        if (!$request->ajax()) {
        $statusCode = 400;
        $response = array('error' => 'Error occured in Ajax Call.');
        return response()->json($response, $statusCode);
        }
        try {
            $draw = $request->draw;
            $offset = $request->start;
            $length = $request->length;
            $search = $request->search ["value"];
            $order = $request->order;
            $data = array();
            $all_web_user = tbl_mobile_user::join('tbl_user_type','tbl_user_type.code','=','tbl_mobile_user.user_type')
            ->where('tbl_mobile_user.app_web_user', '=', 2)
            ->select('tbl_mobile_user.code','tbl_mobile_user.name','tbl_mobile_user.mobile_no','tbl_mobile_user.user_type','tbl_user_type.Type_name','tbl_mobile_user.user_id')
            ->where(function($q) use ($search) {
                $q->orwhere('tbl_mobile_user.name', 'like', '%' . $search . '%');
                $q->orwhere('tbl_mobile_user.mobile_no', 'like', '%' . $search . '%');
                $q->orwhere('tbl_user_type.Type_name', 'like', '%' . $search . '%');
                $q->orwhere('tbl_mobile_user.user_id', 'like', '%' . $search . '%');
            });
            if($request->user_type !=''){
                $all_web_user = $all_web_user->where('tbl_mobile_user.user_type','=',$request->user_type);
            }
            $record = $all_web_user;
            $filtered_count = $all_web_user->count();
            $page_displayed = $record->offset($offset)->limit($length)->get();
            $count = $offset + 1;
         foreach ($page_displayed as $singledata) {
            $nestedData['id'] = $count;
            $nestedData['user_name'] = $singledata->name;
            $nestedData['user_type'] = $singledata->Type_name;
            $nestedData['mobile_no'] = $singledata->mobile_no;
            $nestedData['user_id'] = $singledata->user_id;
            $edit_code = $singledata->code;
            
            $nestedData['action'] = [
                'edit'=>$edit_code,
                'type_name' => $singledata->Type_name
            ];
            $count++;
            $data[] = $nestedData;
            }

            //print_r($data);die;
            $response = array(
                "draw" => $draw,
                "recordsTotal" => $filtered_count,
                "recordsFiltered" => $filtered_count,
                'record_details' => $data
            );
        }catch (\Exception $e) {
            $response = array(
                'exception' => true,
                'exception_message' => $e->getMessage(),
            );
            $statusCode = 400;
        } finally {
            return response()->json($response, $statusCode);
        }
    }

    public function web_user_edit(Request $request)
    {
        // echo "hi";
        try {
            $web_user_code = $request->web_user_cd;
            if($web_user_code!=0){
                $web_user_details = tbl_mobile_user::where('code', '=', $web_user_code)->select('code','name', 'user_type', 'email_address','mobile_no')->first();
            } else {
                $web_user_details = [];
            }
        } catch (\Exception $e) {
           $response = array(
               'exception' => true,
               'exception_message' => $e->getMessage()
           );
           $statusCode = 400;
        } finally {
            return view('web_user_entry')->with('web_user_details',$web_user_details);
        }
    }

    public function web_user_update(Request $request)
    {
        $statusCode = 200;
        if (!$request->ajax()) {
            $statusCode = 400;
            $response = array('error' => 'Error occured in form submit.');
            return response()->json($response, $statusCode);
        }
        $this->validate($request, [
            'user_type'=>"required",
            'mobile_no'=>"required|regex:/^[0-9]+$/|max:10",
            ],[
            'user_type.required' => 'User Type is Required',
            'mobile_no.required' => 'Mobile No is Required',
            'mobile_no.regex' => 'Mobile Number can consist of Numeric',
        ]);
    
        try {
             $web_user_code = $request->edit_cd;
             $admin_exits = tbl_mobile_user::join('tbl_user_type','tbl_user_type.code','=','tbl_mobile_user.user_type')
                ->where('tbl_mobile_user.app_web_user', '=', 2)
                ->where('tbl_user_type.Type_name','=','Admin')
                ->where('tbl_mobile_user.user_type','=',$request->user_type)
                ->select('tbl_user_type.Type_name')->exists();
                // dd($admin_exits);
                if($admin_exits == true){
                    $response = array(
                        'status' => 5
                    );
                    return response()->json($response, $statusCode);
                } else {
                    $web_user_update = DB::table('tbl_mobile_user')->where('code', $web_user_code)->update([
                        'app_web_user' => 2,
                        'email_address' => $request->email_address,
                        'user_type' => $request->user_type,
                        'mobile_no' => $request->mobile_no,
                    ]);
                        $response = array(
                            'status' => 2
                        );
                }
           
        } catch (\Exception $e) {
           $response = array(
               'exception' => true,
               'exception_message' => $e->getMessage(),
           );
           $statusCode = 400;
        } finally {
            return response()->json($response, $statusCode);
        }
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tbl_menus;
use App\tbl_submenus;
use App\tbl_user_type;
use App\tbl_user_wise_menu_submenu;
use DB;

class UserTypeController extends Controller
{
    public function user_type()
    {
       return view('user_type');
    }
    public function add_user_type()
    {
        return view('user_type_entry');
    }

    public function list_of_menu_submnu(Request $request)
    {
        $statusCode = 200;
        if (!$request->ajax()) {
        $statusCode = 400;
        $response = array('error' => 'Error occured in Ajax Call.');
        return response()->json($response, $statusCode);
            }
   
        try {
            $draw = $request->draw;
            //echo $draw;die;
            $offset = $request->start;
            //echo $offset;die;
            $length = $request->length;
           // echo $length;die;
            $search = $request->search ["value"];
            $order = $request->order;
            $data = array();
            $menu_details = tbl_menus::select('code', 'menu_name', 'menu_link','view','f_add','f_update','f_delete');
            $record = $menu_details;
            $filtered_count = $menu_details->count();
            //echo $filtered_count;die;
            $page_displayed = $record->offset($offset)->limit($length)->get();
            //dd($page_displayed);
            foreach ($page_displayed as $singledata) {
                $menu_name = $singledata->menu_name;
                $menu_cd = $singledata->code;
                $menu_view = $singledata->view;
                $menu_add = $singledata->f_add;
                $menu_update = $singledata->f_update;
                $menu_delete = $singledata->f_delete;
                $nestedData['menu_details'] = [
                    'menu_name'=>$menu_name, 
                    'menu_code'=>$menu_cd,
                    'mnu_view'=>$menu_view,
                    'mnu_add'=>$menu_add,
                    'mnu_update'=>$menu_update,
                    'mnu_delete'=>$menu_delete
                ];
                $sub_menu_details = tbl_submenus::join('tbl_menus', 'tbl_menus.code','=', 'tbl_submenus.menu_code')
                ->where('tbl_submenus.menu_code', $menu_cd)
                ->select('tbl_menus.code as mnu_cd','tbl_submenus.code as sub_mnu_cd','tbl_submenus.submenu_name', 'tbl_submenus.view','tbl_submenus.f_add','tbl_submenus.f_update', 'tbl_submenus.f_delete')->get();
                $arr = [];
                foreach ($sub_menu_details as $val) {
                    $sub_arr['mnu_cd'] = $val->mnu_cd;
                    $sub_arr['submenu_code'] = $val->sub_mnu_cd;
                    $sub_arr['submenu_name'] = $val->submenu_name;
                    $sub_arr['view'] = $val->view;
                    $sub_arr['add'] = $val->f_add;
                    $sub_arr['update'] = $val->f_update;
                    $sub_arr['delete'] = $val->f_delete;
                    $arr[] = $sub_arr;  
                }
                $nestedData['sub_menu_name'] = $arr;
                $data[] = $nestedData;
            }
            $response = array(
                "draw" => $draw,
                "recordsTotal" => $filtered_count,
                "recordsFiltered" => $filtered_count,
                'record_details' => $data
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

    public function user_type_sv(Request $request)
    {
        $statusCode = 200;
        if (!$request->ajax()) {
            $statusCode = 400;
            $response = array('error' => 'Error occured in form submit.');
            return response()->json($response, $statusCode);
        }
        $this->validate($request,[
            'user_type_name' => 'required|regex: /^[A-Za-z\s]+$/i|unique:tbl_user_type,Type_name'
        ],[
            'user_type_name.required' => "Type Name is Required",
            'user_type_name.unique' => "The user type name has already been taken",
            'user_type_name.regex' => "User Type can consist of alphabetical characters and spaces only"
        ]);
       //try {
            $user_type = new tbl_user_type();
            $user_type->Type_name = $request->user_type_name;
            $user_type->save();
            $user_type_code = $user_type->code;
           // echo $user_type_code;die;
            $menu_arr = json_decode($request->menu_arr);
            echo '<pre>';
            print_r( $menu_arr);
            die;
            //$sub_menu_code
            foreach ($menu_arr as $key => $menu) {
                 $sub_menu = $menu->sub_code;
                    foreach ($sub_menu as $key => $value) {
                       
                        $menu_details = new tbl_user_wise_menu_submenu();
                        $menu_details->user_code = $user_type_code;
                        $menu_details->menu_code = $menu->menu_code;
                        $menu_details->submenu_code = $value->sub_menu_code;
                        $menu_details->view = $value->view;
                        $menu_details->f_add = $value->add;
                        $menu_details->f_update = $value->update;
                        $menu_details->f_delete = $value->delete;
                      
                        if($menu_details->save()){
                            $response = array(
                                'status' => 1
                            );
                        }
                      
                    }
             }
       /*} catch (\Exception $e) {
           $response = array(
               'exception' => true,
               'exception_message' => $e->getMessage()
           );
           $statusCode = 400;
       } finally {
           return response()->json($response, $statusCode);
       }*/
    }

    public function list_of_user_type(Request $request)
    {   
        $statusCode = 200;
        if (!$request->ajax()) {
            $statusCode = 400;
            $response = array('error' => 'Error occured in form submit.');
            return response()->json($response, $statusCode);
        }
       try {
        $draw = $request->draw;
        $offset = $request->start;
        $length = $request->length;
        $search = $request->search["value"];
        $order = $request->order;
        $data = array();
        $user_type_details = tbl_user_type::select('code', 'Type_name')
        ->where(function($q) use ($search){
            $q->orwhere('Type_name', 'like', '%', $search, '%');
   
         });
        $record = $user_type_details;
        $filtered_count = $user_type_details->count();
        $page_displayed = $record->offset($offset)->limit($length)->get();
        $count = $offset + 1;
        foreach ($page_displayed as $key => $value) {
            $nestedData['id'] = $count;
            $nestedData['type_name'] = $value->Type_name;
            $type_name = $value->Type_name;
            $edit_code = $delete_code = $value->code;
            $nestedData['action'] = array(
                     'type_name' => $type_name,
                     'e' => $edit_code,
                    'd' => $delete_code
            );
            $count++;
            $data[] = $nestedData;
        }
        $response = array(
            "draw" => $draw,
            "recordsTotal" => $filtered_count,
            "recordsFiltered" => $filtered_count,
            'record_details' => $data
        );
    
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
    public function user_type_edit(Request $request)
    {
        $this->validate($request, [
            'user_type_cd' => 'required|integer',
                ], [        
            'user_type_cd.required' => 'User Type is required',
            'user_type_cd.integer' => 'User Type Code Accepted Only Integer',
        ]); 
        try {
            $user_type_code = $request->user_type_cd;
            if ($user_type_code!=0) {
                $user_type_data = tbl_user_type::where('code',$user_type_code)->select('code', 'Type_name')->first();
                $sub_menu = tbl_user_wise_menu_submenu::join('tbl_user_type','tbl_user_type.code','=','tbl_user_wise_menu_submenu.user_code')->where('tbl_user_type.code','=',$user_type_code)->select('menu_code','submenu_code','view','f_add','f_update','f_delete')->get();
            } else {
                $user_type_data = [];
             }
             
         } catch (\Exception $e) {
             $response = array(
                 'exception' => true,
                 'exception_message' => $e->getMessage()
             );
             $statusCode = 400;
         } finally {
             return view('user_type_entry')->with([
                 'user_type_data' => $user_type_data,
                 'sub_menu_data' => $sub_menu
                 ]);
                 
                 
         }
    }

    public function user_type_update(Request $request)
    {
        // dd($request->all());
        $statusCode = 200;
        if (!$request->ajax()) {
            $statusCode = 400;
            $response = array('error' => 'Error occured in form submit.');
            return response()->json($response, $statusCode);
        }
        $this->validate($request,[
            'user_type_name' => 'required|regex: /^[A-Za-z\s]+$/i'
                ],[
            'user_type_name.required' => "Type Name is Required",
            'user_type_name.regex' => "User Type can consist of alphabetical characters and spaces only"
         ]);
        try {
             $sub_user_type_cd = $request->editcd;
            //  echo $sub_user_type_cd;die;
            DB::table('tbl_user_type')->where('code', $sub_user_type_cd)->update([
                 'Type_name' => $request->user_type_name,
             ]);
         
            $user_wise_sub_menu = tbl_user_wise_menu_submenu::where('user_code','=',$sub_user_type_cd)->delete();
            $menu_arr = json_decode($request->menu_arr);
            foreach ($menu_arr as $key => $menu) {
             $sub_menu = $menu->sub_code;
                foreach ($sub_menu as $key => $value) {
                    $menu_details = new tbl_user_wise_menu_submenu();
                    $menu_details->user_code = $sub_user_type_cd;
                    $menu_details->menu_code = $menu->menu_code;
                    $menu_details->submenu_code = $value->sub_menu_code;
                    $menu_details->view = $value->view;
                    $menu_details->f_add = $value->add;
                    $menu_details->f_update = $value->update;
                    $menu_details->f_delete = $value->delete;
                    // $menu_details->save();
                    if($menu_details->save()){
                        $response = array(
                            'status' => 2
                        );
                    }
                    
                }
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

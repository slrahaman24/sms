<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\tbl_user_wise_menu_submenu;
use App\tbl_menus;
use App\tbl_submenus;
use Session;
use Illuminate\Support\Facades\Route;

class UserPermissionController extends Controller
{
    public static function get_user_permission()
    {
        $user_code = Auth::user()->user_type;
        // echo $user_code;die;
        $menu_arr = [];
        $sub_menu_arr = [];
        $user_wise_menu = tbl_user_wise_menu_submenu::join('tbl_menus','tbl_menus.code','=','tbl_user_wise_menu_submenu.menu_code')
                        ->where('tbl_user_wise_menu_submenu.user_code','=',$user_code)
                        ->orderby('tbl_menus.menu_order')
                        ->groupBy('tbl_user_wise_menu_submenu.menu_code')
                        ->select('tbl_menus.menu_name','tbl_menus.menu_icon','tbl_menus.menu_link','tbl_user_wise_menu_submenu.menu_code')
                        ->get();
        // dd($user_user_menu);
        foreach ($user_wise_menu as $user_menu) {
            $nestedData['menu_name'] = $user_menu->menu_name;
            $nestedData['menu_icon'] = $user_menu->menu_icon;
            $nestedData['menu_link'] = $user_menu->menu_link;
            unset($sub_menu_arr);
            $sub_menu_arr = [];

            $user_wise_sub_menu = tbl_user_wise_menu_submenu::join('tbl_submenus','tbl_submenus.code','=','tbl_user_wise_menu_submenu.submenu_code')
                                ->where('tbl_user_wise_menu_submenu.user_code','=',$user_code)
                                ->where('tbl_user_wise_menu_submenu.menu_code','=',$user_menu->menu_code)
                                ->orderby('tbl_submenus.submenu_order')
                                ->select('tbl_submenus.submenu_name','tbl_submenus.submenu_icon','tbl_submenus.submenu_link')
                                ->get();
            //   dd($user_wise_sub_menu);
            foreach ($user_wise_sub_menu as $sub_menu) {
                $sub_arr['submenu_name'] = $sub_menu->submenu_name;
                $sub_arr['submenu_icon'] = $sub_menu->submenu_icon;
                $sub_arr['submenu_link'] = $sub_menu->submenu_link;
                $sub_menu_arr[] = $sub_arr;
            }              
            $nestedData['sub_menu_arr'] = $sub_menu_arr;
            $menu_arr[] = $nestedData;
        }
        return $menu_arr;
    } 

        public static function get_menu_name(){

         $currentURL = Route::getFacadeRoot()->current()->uri();
         //echo $currentURL;die;

         $submenu_code = tbl_submenus::where('submenu_link',$currentURL)->select('menu_code')->get();
        //  echo  $submenu_code->count();die;
         if( $submenu_code->count() > 0){
            $menu_name = tbl_menus::where('code',$submenu_code[0]->menu_code)->select('menu_name')->first();

             session(['menu_name' =>$menu_name->menu_name]);
         }
         else{

            $check_in_menu = tbl_menus::where('menu_link',$currentURL)->get();

            if( $check_in_menu->count() > 0){
                 Session::forget('menu_name');

            }

            
         }



    }

   

}

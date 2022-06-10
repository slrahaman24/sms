<?php

namespace App\Http\Middleware;

 use Closure;
 use Illuminate\Support\Facades\Route;
 use App\tbl_submenus;
use App\tbl_menus;
use App\tbl_user_wise_menu_submenu;
use Auth;
use Session;

class PermissionCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        Session::forget('per_view');
        Session::forget('per_add');
        Session::forget('per_update');
        Session::forget('per_delete');
       // session()->flush();

       
        $currentURL = Route::getFacadeRoot()->current()->uri();
        $user_type = Auth::user()->user_type;

        $result_menu=tbl_menus::where('menu_link',$currentURL)->select('code')->get();

        if( $result_menu->count() > 0){

            $menu_code=$result_menu[0]->code;

            $permission=tbl_user_wise_menu_submenu::where('user_code',$user_type)->where('menu_code', $menu_code)->select('view','f_add','f_update','f_delete')->first();

            $view = $permission->view;
            $f_add = $permission->f_add;
            $f_update = $permission->f_update;
            $f_delete = $permission->f_delete;

            session(['per_view' => $view]);
            session(['per_add' => $f_add]);
            session(['per_update' => $f_update]);
            session(['per_delete' => $f_delete]);



           //  echo "<pre>";
           // print_r($permission);
           // echo "</pre>";



        }else{

            $result_submenu=tbl_submenus::where('submenu_link',$currentURL)->select('code','menu_code')->first();

           $menu_code=$result_submenu->menu_code;
           $submenu_code=$result_submenu->code;

           $permission=tbl_user_wise_menu_submenu::where('user_code',$user_type)->where('menu_code', $menu_code)->where('submenu_code', $submenu_code)->select('view','f_add','f_update','f_delete')->first();

            $view = $permission->view;
            $f_add = $permission->f_add;
            $f_update = $permission->f_update;
            $f_delete = $permission->f_delete;

            session(['per_view' => $view]);
            session(['per_add' => $f_add]);
            session(['per_update' => $f_update]);
            session(['per_delete' => $f_delete]);

           // echo "<pre>";
           // print_r($permission);
           // echo "</pre>";


        }


        return $next($request);
    }
}


             <!-- ========= slidebar menu  start here ========= -->

<style type="text/css" media="screen">
.svg-icon {
  width: 1em;
  height: 1em;
}

.svg-icon path,
.svg-icon polygon,
.svg-icon rect {
  fill: #4691f6;
}

.svg-icon circle {
  stroke: #4691f6;
  stroke-width: 1;
}
.side-menu__icon i{
    font-size: 25px;
}
.side-sub_menu__icon i{
   font-size: 18px;
}
</style>
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserPermissionController;
$currentURL = Route::getFacadeRoot()->current()->uri();

$user_wise_menu = UserPermissionController::get_user_permission();
$menu_name = UserPermissionController::get_menu_name();

?>
 <nav class="side-nav">
   <a href="dashboard" class="intro-x flex items-center pl-5 pt-4 router-link-exact-active router-link-active" aria-current="page"><span class="hidden xl:block text-white text-lg ml-3"> SRM</span></a>
   <div class="side-nav__devider my-6"></div>
 <ul class="accordion">

 <?php foreach ($user_wise_menu as $value) { 
         if($value['menu_link'] == '') {
    ?>
         <li>
            <?php

       //  echo session()->get('menu_name');

          if(session()->get('menu_name') == $value['menu_name']){ ?>
        <a content="Master" href="javascript:;" class="side-menu  side-menu--active">
         <?php }else{ ?>

        <a content="Master" href="javascript:;" class="side-menu">

         <?php } ?>
               <div class="side-menu__icon">
               <i class="{{$value['menu_icon']}}" aria-hidden="true"></i>
               </div>
               <div class="side-menu__title">
                  {{$value['menu_name']}}
                  <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="side-menu__sub-icon feather feather-chevron-down">
                     <polyline points="6 9 12 15 18 9"></polyline>
                  </svg>
                  <!-- <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="display:none; -ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><g fill="none" stroke="#626262" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 15l-6-6l-6 6"/></g></svg> -->
               </div>
            </a>
           <?php

       //  echo session()->get('menu_name');

          if(session()->get('menu_name') == $value['menu_name']){ ?>
                <ul style="display: block;">
                 <?php }else{ ?>

                 <ul>

         <?php } ?>
               <?php foreach ($value['sub_menu_arr'] as $sub_menu_details) { ?>
                  <li><a content="Side Menu" href="{{$sub_menu_details['submenu_link']}}" class="side-menu @if( $currentURL == $sub_menu_details["submenu_link"]) side-menu--active @endif">
                  <div class="side-sub_menu__icon">
                  <i class="{{$sub_menu_details['submenu_icon']}}" aria-hidden="true"></i>
                  </div><div class="side-menu__title"> {{$sub_menu_details['submenu_name']}} <!----></div></a><!----></li>   
              <?php } ?>
            </ul>

          </li>
    
     
 <?php } else { ?>
   <li>
    <a content="Dashboard" href="{{$value['menu_link']}}" class="side-menu  @if( $currentURL == $value["menu_link"]) side-menu--active @endif">
       <div class="side-menu__icon">
       <i class="{{$value['menu_icon']}}" aria-hidden="true"></i>
       </div>
       <div class="side-menu__title">
        {{$value['menu_name']}} <!---->
       </div>
    </a>
    <!---->
</li>

 <?php } } ?>
 </ul>
 </nav>         
               <!-- ========= slidebar menu  end here ========= --> 
               
              

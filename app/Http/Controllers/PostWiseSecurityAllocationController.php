<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use App\tbl_security_posts;
use App\tbl_shift;
use App\tbl_designation;
use App\tbl_standard_post_wise_designation_allocation;

class PostWiseSecurityAllocationController extends Controller
{
    public function Standerd_post_wise_security_allocation(){

        return view('standard_post_wise_security_allocation');

    }

    public function get_all_location(Request $request){

          $statusCode = 200;
          if (!$request->ajax()) {

            $statusCode = 400;
            $response = array('error' => 'Error occered in Json call.');
            return response()->json($response, $statusCode);
          }
          try {

            $locations = Location::pluck('location_name', 'code');

            $response = array(
              'options' => $locations, 'status' => 1
            );
          }
          catch (\Exception $e) {
            $response = array(
              'exception' => true,
              'exception_message' => $e->getMessage(),
            );
            $statusCode = 400;
          } finally {
            return response()->json($response, $statusCode);
          }

    }

     public function get_all_post(Request $request){

          $statusCode = 200;
          if (!$request->ajax()) {

            $statusCode = 400;
            $response = array('error' => 'Error occered in Json call.');
            return response()->json($response, $statusCode);
          }
          try {
            $location=$request->location;
            $posts = New tbl_security_posts();
              if($location!=''){
                $posts = $posts->where('location_code', $location);
              }
                $posts = $posts->pluck('post_name', 'code');
                $response = array(
                  'options' => $posts, 'status' => 1
                );
          }
          catch (\Exception $e) {
            $response = array(
              'exception' => true,
              'exception_message' => $e->getMessage(),
            );
            $statusCode = 400;
          } finally {
            return response()->json($response, $statusCode);
          }

    }


    public function search_post_wise_security(Request $request){
          $statusCode = 200;
          if (!$request->ajax()) {

            $statusCode = 400;
            $response = array('error' => 'Error occered in Json call.');
            return response()->json($response, $statusCode);
          }
          try {
            $location=$request->location;
            $post=$request->post;
            $shift=$request->shift;
            $result_post=tbl_security_posts::where('code', $post)->select('post_name','designation')->first();
            $post_name=$result_post->post_name;
            $des=$result_post->designation;
            $desarr= explode(",",$des);
            $designation=tbl_designation::wherein('code',$desarr)->select('designation')->get();
            $response = array(
              'post' => $post_name,
              'designation' => $designation, 
              'status' => 1
            );
          }
          catch (\Exception $e) {
            $response = array(
              'exception' => true,
              'exception_message' => $e->getMessage(),
            );
            $statusCode = 400;
          } finally {
            return response()->json($response, $statusCode);
          }

    }


    public function list_of_standard_wise_allocation(Request $request)
    {
      $statusCode = 200;
      if (!$request->ajax()) {
          $statusCode = 400;
          $response = array('error' => 'Error occured in form submit.');
          return response()->json($response, $statusCode);
      }

      try{
        $draw = $request->draw;
        $offset = $request->start;
        $length = $request->length;
        $search = $request->search ["value"];
        $order = $request->order;
        $data = array();
            $allStandardPostWiseData =  tbl_security_posts::join('tbl_post_location', 'tbl_security_posts.location_code', '=', 'tbl_post_location.code')
            ->select('tbl_security_posts.code', 'tbl_post_location.location_name', 'tbl_security_posts.post_name')
          ->where(function($q) use ($search) {
            $q->orwhere('post_name', 'like', '%' . $search . '%');
          });
          
          if($request->location !=''){
            $allStandardPostWiseData = $allStandardPostWiseData->where('tbl_security_posts.location_code', '=', $request->location);
          }

          if($request->post !=''){
            $allStandardPostWiseData = $allStandardPostWiseData->where('tbl_security_posts.code', '=', $request->post);
          }
        $record = $allStandardPostWiseData;
        for ($i = 0; $i < count($order); $i ++) {
        $record = $record->orderBy($request->columns [$order [$i] ['column']] ['data'], strtoupper($order [$i] ['dir']));
          }
        $filtered_count = $allStandardPostWiseData->count();
        $page_displayed = $record->offset($offset)->limit($length)->get();
        $count = $offset + 1;
        foreach ($page_displayed as $singledata) {
            $nestedData['id'] = $count;
            $nestedData['location_name'] = $singledata->location_name;
            $nestedData['post_name'] = $singledata->post_name;
            $edit_button = $singledata->code;
            $nestedData['edit'] = $edit_button;
            $allShift = tbl_shift::select('code', 'shift')->get();
            $tbl_shift = "<div>";
            $tbl_shift  .= "<table style='width: 200px;' class='table table-bordered table-striped'>";
            foreach ($allShift  as $shift) {
                $postWiseAllocation = tbl_standard_post_wise_designation_allocation::where('date_wise_sift_wise_code', $shift->code)
                ->where('post', $singledata->code)
                ->groupBy('location_code')
                ->count();
              $tbl_shift .= "<tr style='line-height: 0px;background-color: #e2e8f0;'>";
               $tbl_shift .= "<td  style='width: 110px;border: 0px;'>";
               $tbl_shift .= $shift->shift;
               $tbl_shift .= "</td>";
              if($postWiseAllocation == 0){
                $tbl_shift .="<td style='width: 1px;border: 0px;'><span style='color: #f03602;'>X</span></td>";
               }  else{
                $tbl_shift .="<td style='width: 1px;border: 0px;'><span style='color: #48a868;' >&#10003;</span></td>";
               }
 
              $tbl_shift .="<td style='width: 1px;'><button class='shift_wise' type='submit' id='edit_data' standard='{$singledata->code}' value='{$shift->code}' style='background-color: #4CAF50;  border: none;  color: #4CAF50;'>+</button></td>";
             // $tbl_shift .= "<br>";
              
               $tbl_shift .= "</tr>";
            }
            $tbl_shift .= "</table>";
            $tbl_shift .= "</div>";
            $nestedData['shift'] = $tbl_shift;
            $count++;
            $data[] = $nestedData;
        }
        $response = array(
            "draw" => $draw,
            "recordsTotal" => $filtered_count,
            "recordsFiltered" => $filtered_count,
            'record_details' => $data
        );
        }
        catch (\Exception $e) {
            $response = array(
                'exception' => true,
                'exception_message' => $e->getMessage(),
            );
            $statusCode = 400;
        }
        
        finally {
            return response()->json($response, $statusCode);
        }
    }

    public function post_wise_designation(Request $request)
    {

      try{
      $postWiseShift = tbl_shift::where('code', '=', $request->shift_code)->select('code' ,'shift')->first();
      $PostWiseDesignation =  tbl_security_posts::join('tbl_post_location', 'tbl_post_location.code','tbl_security_posts.location_code')
       ->where('tbl_security_posts.code', '=', $request->security_post_code)
       ->select('tbl_security_posts.designation', 'tbl_security_posts.post_name', 'tbl_post_location.location_name','tbl_security_posts.location_code', 'tbl_security_posts.code')->first();
      $arrStr = explode(",", $PostWiseDesignation->designation);
      //dd($arrStr);
      $dsgtion_nm = tbl_designation::whereIn('code', $arrStr)->select('code', 'designation')->get();
     // dd($dsgtion_nm);
     //dd($standard_post_dsg);
    //  $standard_post_dsg = DB::raw("SELECT tbl_standard_post_wise_designation_allocation.code AS allocation_code, tbl_designation.code AS designation_code,tbl_designation.designation,tbl_standard_post_wise_designation_allocation.no_of_security FROM tbl_standard_post_wise_designation_allocation INNER JOIN tbl_designation ON tbl_designation.code=tbl_standard_post_wise_designation_allocation.designation WHERE tbl_standard_post_wise_designation_allocation.date_wise_sift_wise_code=1 AND tbl_standard_post_wise_designation_allocation.post=1 ORDER BY tbl_designation.code");
    //  $standard = DB::select(DB::raw($standard_post_dsg));
    //  dd($standard);
    // dd($standard_post_dsg);
      $standard_post_dsg = tbl_standard_post_wise_designation_allocation::join('tbl_designation', 'tbl_designation.code', 'tbl_standard_post_wise_designation_allocation.designation')
          ->where('tbl_standard_post_wise_designation_allocation.date_wise_sift_wise_code', '=', $request->shift_code)
          ->where('tbl_standard_post_wise_designation_allocation.post','=',$request->security_post_code)
          ->select('tbl_standard_post_wise_designation_allocation.code as allocation_code', 'tbl_designation.code as designation_code', 'tbl_designation.designation', 'tbl_standard_post_wise_designation_allocation.no_of_security')
          ->orderBy('tbl_designation.code')
          ->get();
         
    
     // dd($standard_post_dsg);
      $dsg_cnt = $standard_post_dsg->count();
      }
        catch (\Exception $e) {
            $response = array(
                'exception' => true,
                'exception_message' => $e->getMessage(),
            );
            $statusCode = 400;
        }
        finally {
          return view('post_wise_designation')->with([
              'post_wise_designation' =>  $dsgtion_nm,
              'post_wise_shift' => $postWiseShift,
              'post_wise_name' => $PostWiseDesignation,
              'post_wise_worker' => $standard_post_dsg,
              'worker_count' => $dsg_cnt
             ]);
        }
      
    }

    public function post_wise_worker_save(Request $request)
    {
     
      $statusCode = 200;
      if (!$request->ajax()) {
          $statusCode = 400;
          $response = array('error' => 'Error occured in form submit.');
          return response()->json($response, $statusCode);
      }
      $this->validate($request,[
        'locate_cd' => "required",
        'post_cd' => "required",
        'shift_cd' => "required",
        'no_of_security' => "required"
      ],[
        'locate_cd.required'=> 'Location Code is required',
        'post_cd.required'=> 'Post Code is required',
        'shift_cd.required'=> 'Shift Code is required',
        'no_of_security.required'=> 'No. Of Security is required',
      ]);
        try{
          $no_designation = explode(",", $request->no_of_security);
    
          for ($i=0; $i < count($no_designation); $i++) { 
            $standardPostWiseDesignation=new tbl_standard_post_wise_designation_allocation();
            $desg = explode(":", $no_designation[$i]);
            $standardPostWiseDesignation->location_code=$request->locate_cd;
            $standardPostWiseDesignation->post=$request->post_cd;
            $standardPostWiseDesignation->date_wise_sift_wise_code=$request->shift_cd;    
            $standardPostWiseDesignation->designation=$desg[0];  
            $standardPostWiseDesignation->no_of_security=$desg[1]; 
            if($standardPostWiseDesignation->save()){
                $response = array(
                  'status' => 1,
                );
              }
            } 
        }
           catch(\Exception $e){
            $response = array(
                'exception' => true,
                'exception_message' => $e->getMessage(),
            );
            $statuscode=400;
         } 
         finally{
           return response()->json($response, $statusCode);
        }
      }

      public function post_wise_allocation_update(Request $request)
      {
       // dd($request->all());
        $statusCode = 200;
        if (!$request->ajax()) {
            $statusCode = 400;
            $response = array('error' => 'Error occured in form submit.');
            return response()->json($response, $statusCode);
        }

        try{
          $edit_security_allocation = explode(",", $request->no_of_security);
          //dd($edit_security_allocation);
          $security_cnt = count($edit_security_allocation);
          for ($i = 0; $i < $security_cnt; $i++) {
            $desg_up = explode(":", $edit_security_allocation[$i]);
           // dd($desg_up);
            $designation_name = $desg_up[0];
            $security_worker = $desg_up[1];
            $allocation_of_desg = $desg_up[2];
           // echo $designation_name;die;
            $result = tbl_standard_post_wise_designation_allocation::where('code', '=', $designation_name)->update(['no_of_security' => $security_worker]);
            if( $result ) {
              $response = array (
                'status' => 2,
              );
            }
          }
        } catch(\Exception $e){
          $response = array(
              'exception' => true,
              'exception_message' => $e->getMessage(),
          );
          $statuscode=400;
       } 
       finally{
         return response()->json($response, $statusCode);
      }
  }


}

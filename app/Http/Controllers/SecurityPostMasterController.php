<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tbl_security_posts;
use App\tbl_designation;
use App\tbl_location;


class SecurityPostMasterController extends Controller
{
    //
    public function security_post_master()
    {
        return view('security_post_master');
    }

    public function add_security_post()
    {
        return view('security_post_entry');
    }
    public function update_security_post(Request $request)
    {
        $statusCode = 200;
        if (!$request->ajax()) {
            $statusCode = 400;
            $response = array('error' => 'Error occured in form submit.');
            return response()->json($response, $statusCode);
        }
        $this->validate($request,[
            'designation_name'=>"required",
                ],[
            'designation_name.required' => 'Designation Name is Required',
            ]);
       
        try{
            $securityPostForm=tbl_security_posts::find($request->editcd);
            $securityPostForm->designation=$request->designation_name;
            $securityPostForm->save();
            $response = array(
                'status' => 2,
            );

           
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
    public function security_post_save(Request $request)
    {
        $statusCode = 200;
        if (!$request->ajax()) {
            $statusCode = 400;
            $response = array('error' => 'Error occured in form submit.');
            return response()->json($response, $statusCode);
        }

        // if (isset($request->editcd)) {
        //     $this->validate($request,[
        //         'security_post_name'=>"required|max:30",
        //         'location_name'=>'required|unique:tbl_security_posts,location_code,'.$request->editcd.',code',
        //         'designation_name'=>"required",
        //         'lat_coordianates'=>'required|max:100|regex:/^[0-9\/.]+$/i',
        //         'long_coordinates'=>'required|max:100|regex:/^[0-9\/.]+$/i',
               
    
        //            ],[
        //         'security_post_name.required' => 'Security Post Name is Required',
        //         'security_post_name.max' => 'Security Post Name must be greater than 30 characters',
        //         'location_name.required' => 'Location Name is Required',
        //         'location_name.unique' => 'Location Name is Already Exists',
        //         'designation_name.required' => 'Designation Name is Required',
        //         'lat_coordianates.required' => 'Latitute is Required',
        //         'lat_coordianates.max' => 'Must be between 1-100 characters.',
        //         'lat_coordianates.regex' => 'Latitude  value appears to be incorrect format',
        //         'long_coordinates.required' => 'Longitude is Required',
        //         'long_coordinates.max' => 'Must be between 1-100 characters.',
        //         'long_coordinates.regex' => 'Longitude  value appears to be incorrect format',
               
        //        ]);
        // } else {
            $this->validate($request,[
                'security_post_name'=>"required|max:30",
                'location_name'=>"required",
                //'designation_name'=>"required",
                'lat_coordianates'=>'nullable|max:100|regex:/^[0-9\/.]+$/i',
                'long_coordinates'=>'nullable|max:100|regex:/^[0-9\/.]+$/i',
               
    
                   ],[
                'security_post_name.required' => 'Security Post Name is Required',
                'security_post_name.max' => 'Security Post Name must be greater than 30 characters',
                'location_name.required' => 'Location Name is Required',
                'location_name.unique' => 'Location Name is Already Exists',
                //'designation_name.required' => 'Designation Name is Required',
                'lat_coordianates.required' => 'Latitute is Required',
                'lat_coordianates.max' => 'Must be between 1-100 characters.',
                'lat_coordianates.regex' => 'Latitude  value appears to be incorrect format',
                'long_coordinates.required' => 'Longitude is Required',
                'long_coordinates.max' => 'Must be between 1-100 characters.',
                'long_coordinates.regex' => 'Longitude  value appears to be incorrect format',
               
               ]);
       // }
        


       
       
        try{

            if(isset($request->editcd)){
                $securityPostForm=tbl_security_posts::find($request->editcd);
               }else{
                $post_details = tbl_security_posts::where('location_code','=',$request->location_name)
                                                    ->where('post_name','=',$request->security_post_name)
                                                    ->select('location_code')->exists();
                //dd($post_details);
                if($post_details == true){
                    $response = array(
                        'status' => 5,
                    );
                    return response()->json($response); 
                }
                $securityPostForm=new tbl_security_posts();
               }

             $securityPostForm->post_name=$request->security_post_name;
             $securityPostForm->location_code=$request->location_name;
             //$securityPostForm->designation=$request->designation_name;
             $securityPostForm->long_coordinates=$request->long_coordinates;
             $securityPostForm->lat_coordianates=$request->lat_coordianates;
           
               if( $securityPostForm->save()){
                if(isset($request->editcd)){
                    $response = array(
                        'status' => 2,
                    );
                    }else{
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

    public function get_all_designation(Request $request)
    {
        $statusCode = 200;
        if (!$request->ajax()) {

          $statusCode = 400;
          $response = array('error' => 'Error occered in Json call.');
          return response()->json($response, $statusCode);
        }
        try {

          $designation = tbl_designation::pluck('designation', 'code');

          $response = array(
            'options' => $designation, 'status' => 1
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

    public function list_of_security_post(Request $request)
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
            $allSecurityPost =  tbl_security_posts::join('tbl_post_location','tbl_post_location.code','tbl_security_posts.location_code')
            ->select('tbl_security_posts.*','tbl_post_location.location_name' )
                    ->where(function($q) use ($search) {
                        $q->orwhere('tbl_security_posts.post_name', 'like', '%' . $search . '%');
             });

            $record = $allSecurityPost;
            for ($i = 0; $i < count($order); $i ++) {
                $record = $record->orderBy($request->columns [$order [$i] ['column']] ['data'], strtoupper($order [$i] ['dir']));
            }
            $filtered_count = $allSecurityPost->count();
            $page_displayed = $record->offset($offset)->limit($length)->get();
            $count = $offset + 1;
            foreach ($page_displayed as $singledata) {
                $nestedData['id'] = $count;
                $nestedData['post_name'] = $singledata->post_name;
                $arrStr = explode(",", $singledata->designation);
                $edit_button = $delete_button =  $singledata->code;
                $nestedData['lat_coordianates'] = $singledata->lat_coordianates;
                $nestedData['long_coordinates'] = $singledata->long_coordinates;
                $nestedData['location_name'] = $singledata->location_name;

                //$nestedData['delete'] = $delete_button;
                $nestedData['action'] = array('e' => $edit_button, 'd' => $delete_button);
                $dsgtion_nm = tbl_designation::whereIn('code', $arrStr)->select('designation')->get();
               
                if($dsgtion_nm->count()>0){
                    $arr = [];
                    $designation_edit=$singledata->code.'/'.$singledata->designation;
                    $tbl_designation = "<a class='edit_btn_new1' title='Click To Edit' id='$designation_edit'><table style='width: 100%' class='table table-hover table-bordered table-striped'>";
                    foreach ($dsgtion_nm as $val) {
                        $tbl_designation .= "<tr style='text-align:center;'>";
                        $tbl_designation .= "<td style='padding: 3px'>";
                        $tbl_designation .= $val->designation;
                        $tbl_designation .= "<br>";
                        $tbl_designation .= "</td>";
                        $tbl_designation .= "</tr>";
                    }
                    $tbl_designation .= "</table></a>";
                    $nestedData['designation'] = $tbl_designation;
                    unset($arr);
                }else{
                    $nestedData['designation'] = '<button type="button"  class="btn btn-success  add-button btn_new1" id="'.$singledata->code.'" title="Click To Add"><i class="fa fa-plus"></i></button>';
                }
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

    public function security_post_edit(Request $request)
    {
        $security_post_code = $request->security_post_code;
    $this->validate($request, [
        'security_post_code' => 'required|integer',
            ], [        
        'security_post_code.required' => 'Security Post is required',
        'security_post_code.integer' => 'Security Post Code Accepted Only Integer',
    ]); 

    try{
        if($security_post_code!=0){
            $edit_data=tbl_security_posts::where('code','=',$security_post_code)->select('post_name', 'location_code', 'designation', 'code','lat_coordianates','long_coordinates')->first();  
            $designationExplode = explode(",",  $edit_data->designation);
        $multiDimention = array(
            'code' => $edit_data->code,
            'post_name'=> $edit_data->post_name,
            'location_code'=> $edit_data->location_code,
            'lat_coordianates'=> $edit_data->lat_coordianates,
            'long_coordinates'=> $edit_data->long_coordinates,
            'designation'=> $designationExplode
        );
        $postDetails = json_encode($multiDimention);
        }
      } catch (\Exception $e) {
            $response = array(
                'exception' => true,
                'exception_message' => $e->getMessage(),
            );
            $statusCode = 400;
        } finally {

           return  view('security_post_entry')->with('security_post_data', $postDetails);
        } 
    }

    public function security_post_delete(Request $request)
    {
        $statusCode = 200;
        if (!$request->ajax()) {
            $statusCode = 400;
            $response = array('error' => 'Error occured in form submit.');
            return response()->json($response, $statusCode);
        }
        $this->validate($request, [
            'dlt_code' => 'required|integer',
                ], [
            'dlt_code.required' => 'Delete Code is required',
            'dlt_code.integer' => 'Delete Code Accepted Only Integer',
        ]);
 
 
        try {
            $dlt_data = tbl_security_posts::where('code', '=', $request->dlt_code); 
            if (!empty($dlt_data)) {//Should be changed #30
                $dlt_data = $dlt_data->delete();
            }
            $response = array(
                'status' => 1 //Should be changed #32
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

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;

class LocationController extends Controller
{
    //
    public function location()
    {
        return view('location_details');
    }

    public function add_location(){

        return view('location_entry');
    }

    public function location_save_update(Request $request)
    {
        $statusCode = 200;
        if (!$request->ajax()) {
            $statusCode = 400;
            $response = array('error' => 'Error occured in form submit.');
            return response()->json($response, $statusCode);
        }
        if(isset($request->editcd)){
            $this->validate($request,[
                'location_name'=>'required||unique:tbl_post_location,location_name,'.$request->editcd.',code|max:50',
                   ],[
                'location_name.required' => 'Location Name is Required',
                // 'location_name.unique' => 'Location Name is Already Exists',
                'location_name.max' => 'The Location Name must be greater than 50 characters',
               ]);
        } else {
            $this->validate($request,[
            'location_name' => "required|unique:tbl_post_location,location_name|max:50",
                   ],[
                'location_name.required' => 'Location Name is Required',
                'location_name.unique' => 'Location Name is Already Exists',
                'location_name.max' => 'The Location Name must be greater than 50 characters',
               ]);
        }
        
        try{
            if(isset($request->editcd)){
                $location=Location::find($request->editcd);
               }else{
                $location=new Location();
               }
            $location->location_name=$request->location_name;
        if($location->save()){
            if(isset($request->editcd)){
                $response = array(
                    'status' => 2,
                );
                }else{
                    $response = array(
                        'status' => 1,
                    );
                }
           }else{
               $response = array(
                   'status' => 3,
               );
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

    public function list_of_location(Request $request)
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
            $allLocation =  Location::select('code','location_name')
                    ->where(function($q) use ($search) {
                        $q->orwhere('location_name', 'like', '%' . $search . '%');
                });
            $record = $allLocation;
            for ($i = 0; $i < count($order); $i ++) {
                $record = $record->orderBy($request->columns [$order [$i] ['column']] ['data'], strtoupper($order [$i] ['dir']));
            }
            $filtered_count = $allLocation->count();
            $page_displayed = $record->offset($offset)->limit($length)->get();
            $count = $offset + 1;
            foreach ($page_displayed as $singledata) {
                $nestedData['id'] = $count;
                $nestedData['location_name'] = $singledata->location_name;
                $edit_button = $delete_button =  $singledata->code;
                $nestedData['action'] = array('e' => $edit_button, 'd' => $delete_button);
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

    public function location_edit(Request $request)
    {
    $this->validate($request, [
        'location_code' => 'required|integer',
            ], [        
        'location_code.required' => 'Location is required',
        'location_code.integer' => 'Location Code Accepted Only Integer',
    ]); 
    try{
        $location_code = $request->location_code;
        if($location_code!=0){
          $edit_data=Location::where('code','=',$location_code)->first();  
        }else{
          $edit_data=array();
        }
    } catch (\Exception $e) {
            $response = array(
                'exception' => true,
                'exception_message' => $e->getMessage(),
            );
            $statusCode = 400;
        } finally {
           return  view('location_entry')->with('location_data',$edit_data);
        } 
    }

    public function location_delete(Request $request){

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
           $dlt_data = Location::where('code', '=', $request->dlt_code); 
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

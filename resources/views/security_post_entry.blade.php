<?php $title = 'Security Post Master';  ?>
@extends('layouts.master')
@section('content')
   <div class="top-bar">
         <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="">Application</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="breadcrumb__icon feather feather-chevron-right">
               <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
            <a href="" class="breadcrumb--active">Security Post Master</a>
         </div>
         <div class="intro-x relative mr-3 sm:mr-6">
        <a href="security_post_master"><button type="button" class="btn btn-info">
         <span class="glyphicon glyphicon-search"></span> List Of Security Post Master
        </button></a>
     </div>
    </div>

        <div class=" mt-8 card shadow-lg p-3  bg-white rounded h-75">
           <div class=" items-center h-20">
              <h1 class="text-lg font-medium truncate mr-5"><span id="add_update"> Add </span> Security Post Master</h1>
  
            </div>

            <div class="card-body"  >
            
                 {!! Form::open(['url' => '', 'name' => 'security_post_form', 'id' => 'security_post_form', 'method' => 'post' ,'class'=>'animate-form form-horizontal','role'=>'form']) !!}
                 {!! Form::hidden('code', '',['id'=>'edit_code']) !!}
                 <input type='text' name='test_arra' id='test_arra' value=''>
                 <div class="row form-group">
                    <div class="col-sm-4 text-right font-weight-bold" style="font-size: 20Px;">
                        {!! Form::label('location_name', ' Location:', ['class' =>'required']) !!}
                    </div>   
                    <div class="col-sm-6">
                    {!! Form::select('location',[''=>'Select Location'],null,['class' => 'form-control','id'=>'location_name']); !!}

                    </div>
                    
                </div> 
                   <div class="row form-group">
                    <div class="col-sm-4 text-right font-weight-bold" style="font-size: 20Px;">
                        {!! Form::label('security_post_name', ' Security Post Name:', ['class' =>'required']) !!}
                    </div>   
                    <div class="col-sm-6">
                        {!! Form::text('security_post_name', null, ['id'=>'security_post_name','class'=>'form-control','placeholder'=>'Enter Post Name','autocomplete'=>'off','maxLength'=>'30']) !!}
                    </div>
                    
                </div>      

                   

                 <!-- <div class="row form-group">
                    <div class="col-sm-4 text-right font-weight-bold" style="font-size: 20Px;">
                        {!! Form::label('designation_name', ' Designation Name:', ['class' =>'required']) !!}
                    </div>   
                    <div class="col-sm-6">
                         {!! Form::select('designation_name',[],null,['class' => 'form-control','id'=>'designation_name','multiple'=>'multiple']); !!}
                    </div>
                    
                </div>    -->

                 <div class="row form-group">
                    <div class="col-sm-4 text-right font-weight-bold" style="font-size: 20Px;">
                        {!! Form::label('lat_coordianates',' Latitute  :' ,['class'=>'']) !!}

                    </div>   
                    <div class="col-sm-6">
                        {!! Form::text('lat_coordianates',null,['class' => 'form-control','id'=>'lat_coordianates', 'placeholder' => 'Please Enter Latitute','autocomplete'=>'off']) !!}
                    </div>
                </div>   

                 <div class="row form-group">
                    <div class="col-sm-4 text-right font-weight-bold" style="font-size: 20Px;">
                        {!! Form::label('long_coordinates',' Longitute  :' ,['class'=>'']) !!}
                    </div>   
                    <div class="col-sm-6">
                        {!! Form::text('long_coordinates',null,['class' => 'form-control','id'=>'long_coordinates', 'placeholder' => 'Please Enter Longitute','autocomplete'=>'off']) !!}
                      </div>
                    
                </div> 
                  

                <div class="row form-group">
                <div class="col-sm-4 text-right font-weight-bold" style="font-size: 20Px;">
                        {!! Form::label('long_coordinates',' &nbsp;' ,['class'=>'']) !!}
                    </div>   
                    <div class="col-sm-6" >
                        <button id="save_update" type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
               
                   {!! Form::close() !!}             
             
            </div>
        
     </div>
<script>
 $(function () {
  <?php if (isset($security_post_data)) { ?>
// alert('<?php //echo $security_post_data ?>');
  var postDatadecode = JSON.parse('<?php echo $security_post_data ?>');
//   console.log(postDatadecode);
     $("#edit_code").val(postDatadecode.code);
     $("#security_post_name").val(postDatadecode.post_name);
     $("#lat_coordianates").val(postDatadecode.lat_coordianates);
     $("#long_coordinates").val(postDatadecode.long_coordinates);
     get_all_location(postDatadecode.location_code);
     get_all_designation(postDatadecode.designation);

     $("#save_update").html('Update');
    $("#add_update").html('Update');
    <?php } else{?>
    
        get_all_location('');
         get_all_designation('');
    <?php } ?>
         $('#designation_name').select2();
            $('#security_post_form').bootstrapValidator({

                        message: 'This value is not valid',
                        fields: {
                        security_post_name: {
                                        validators: {
                                            notEmpty: {
                                                message: 'Security Post Name is Required'
                                            }
                                        }
                                    },
                        
                        
                                    location: {
                                        validators: {
                                            notEmpty: {
                                                message: 'Location Name is Required'
                                            }
                                        }
                                    },
                                 
                                   /* designation_name: {
                                        validators: {
                                            notEmpty: {
                                                message: 'Designation Name is Required'
                                            }
                                        }
                                    },*/
                                    lat_coordianates: {
                                        message: 'The Latitute  is not valid',
                                        validators: {
                                            /*notEmpty: {
                                                message: 'Enter Latitute ',
                                            },*/
                                            stringLength: {
                                                min: 1,
                                                max: 100,
                                                message: 'Must be between 1-100 characters.'
                                            },
                                            regexp: {
                                                regexp:/^[-+]?[0-9]{1,7}(\.[0-9]+)?$/,
                                                message: 'Latitude  value appears to be incorrect format.'
                                            }
                                        }
                                    },
                                    long_coordinates: {
                                    message: 'The Longitude  is not valid',
                                    validators: {
                                        /*notEmpty: {
                                            message: 'Enter Longitude ',
                                        },*/
                                        stringLength: {
                                            min: 1,
                                            max: 100,
                                            message: 'Must be between 1-100 characters.'
                                        },
                                        regexp: {
                                            regexp:/^[-+]?[0-9]{1,7}(\.[0-9]+)?$/,
                                            message: 'Longitude  value appears to be incorrect format.'
                                        }
                                    }
                                },


                        }

                        }).on('success.form.bv', function (e) {
                            e.preventDefault();
                            save_security_post();               
                        }); 

      
            });

      function save_security_post(){
            var token = $("input[name='_token']").val();
             var security_post_name = $("#security_post_name").val();
            //  alert(security_post_name);
             var location_name = $("#location_name").val();
             //var designation_name = $("#designation_name").val();
             var long_coordinates = $("#long_coordinates").val();
             var lat_coordianates = $("#lat_coordianates").val();
            //  alert(designation_name);
             var editcd = $("#edit_code").val();

             var formData_save = new FormData();
                formData_save.append('_token', token);
                formData_save.append('security_post_name', security_post_name);
                // alert("hi");
                formData_save.append('location_name', location_name);
                formData_save.append('long_coordinates', long_coordinates);
                formData_save.append('lat_coordianates', lat_coordianates);
                // alert(location_name);
                //formData_save.append('designation_name', designation_name);
                
                formData_save.append('editcd', editcd);

                $('#loading').fadeIn();
                $.ajax({
                            type: "POST",
                            url: "security_post_save",
                            data: formData_save,
                            processData: false,
                            contentType: false,
                            async: false,
                            dataType: "json",
                            // alert("hi");
                            success: function (data) {
                                $('#loading').fadeOut();
                                if (data.status == 1) {
                    
                                         var msg = "<strong>SUCCESS: </strong>Security Post Saved Successfully";

                                            $.confirm({
                                            title: 'Success!',
                                            type: 'green',
                                            icon: 'fa fa-check',
                                            content: msg,
                                            boxWidth: '30%',
                                            useBootstrap: false,
                                            buttons: {
                                                ok: function () {
                                                    
                                                    $('#security_post_form').get(0).reset();
                                                    location.reload();
                                                    
                                                }

                                            }
                                        });
                    
                                  } else if(data.status == 2)
                                            {
                                                var msg = "<strong>SUCCESS: </strong>Security Post Updated Successfully";

                                                $.confirm({
                                                title: 'Success!',
                                                type: 'green',
                                                icon: 'fa fa-check',
                                                content: msg,
                                                boxWidth: '30%',
                                                useBootstrap: false,
                                                buttons: {
                                                    ok: function () {
                                                    
                                                        window.location.href = "security_post_master";
                                                    }

                                                }
                                            });

                                            }else if(data.status == 5)
                                            {
                                                var msg = "<strong>WARNING:: </strong>Location Wise Post Already Exists";

                                                $.confirm({
                                                title: 'Warning!!',
                                                type: 'orange',
                                                icon: 'fa fa-warning',
                                                content: msg,
                                                boxWidth: '30%',
                                                useBootstrap: false,
                                                buttons: {
                                                    ok: function () {
                                                    
                                                        $('#security_post_form').get(0).reset();
                                                        location.reload();
                                                    
                                                    }

                                                }
                                            });

                                            }

                                
                            },

                    //  alert("hi");

                    error: function (jqXHR, textStatus, errorThrown) {
                        $('#loading').fadeOut();
                        var msg = "";
                        if (jqXHR.status !== 422 && jqXHR.status !== 400) {
                            msg += "<strong>" + jqXHR.status + ": " + errorThrown + "</strong>";
                        } else {
                            if (jqXHR.responseJSON.hasOwnProperty('exception')) {
                                msg += "Exception: <strong>" + jqXHR.responseJSON.exception_message + "</strong>";
                            } else {
                                msg += "Error(s):<strong><ul>";
                                $.each(jqXHR.responseJSON['errors'], function (key, value) {
                                    msg += "<li>" + value + "</li>";
                                });
                                msg += "</ul></strong>";
                            }
                        }
                        $.alert({
                            title: 'Error!!',
                            type: 'red',
                            icon: 'fa fa-warning',
                            content: msg,
                            boxWidth: '30%',
                            useBootstrap: false,
                        });
                    }

                             });



      }
    

      function get_all_location(securityLocationcd){

               var token = $("input[name='_token']").val();
               $.ajax({
               type: "post",
               url: "get_all_location",
               data:{_token:token},
               dataType: 'json',
               success: function (data) {
            //    console.log(data.options);
                //   $('#location').html('<option value=""> Select Location </option>');
                  $.each(data.options, function (key, value) {
                  
                     $("#location_name").append('<option value=' + key + '>' + value + '</option>');
                    
                  });
                //   console.log(data.options);
                  if(securityLocationcd  !=''){
                    $("#location_name").val(securityLocationcd);

                  }
                 

               }
              
            });
         }

         
      function get_all_designation(securityDesignation){
        //   alert(securityDesignation);
            var token = $("input[name='_token']").val();
            $.ajax({
            type: "post",
            url: "get_all_designation",
            data:{_token:token},
            dataType: 'json',
            async: false,
            success: function (data) {
               
            //   $('#designation_name').html('<option value=""> Select Designation Name </option>');
            $.each(data.options, function (key, value) {
            
                $("#designation_name").append('<option value=' + key + '>' + value + '</option>');
            
            });
            //  console.log(data.options);
            // if(securityDesignation !=''){
            //     $("#designation_name").;
            // }
            // if(!empty(securityDesignation)){
               
            // }
            if(securityDesignation  !=''){

                $("#designation_name").val(securityDesignation);


                // $cnt = securityDesignation.length;
                // var jsonArr = JSON.parse(securityDesignation);
                // $("#designation_name").val(jsonArr);


                //  alert(securityDesignation);
               
            //   var strArr = securityDesignation.split(",");
            //   console.log(strArr);
            //   strArr.forEach(myFunction);

// function myFunction(item) {
//   sum += item;
            // $("#designation_name").val(strArr);
  
// }
                 

                  }
            }

            });
            }

  
    
   
      </script>     

@stop
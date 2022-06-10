<?php $title='Web-User' ?>
@extends('layouts.master')
@section('content')

<div class="top-bar">
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="">Application</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="breadcrumb__icon feather feather-chevron-right">
               <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
            <a href="" class="breadcrumb--active">Web User</a>
         </div>
          <div class="intro-x relative mr-3 sm:mr-6">
        <a href="web_user"><button type="button" class="btn btn-info">
         <span class="glyphicon glyphicon-search"></span>List Of Web User
        </button></a>
        </div>
 </div>

 <div class="mt-8 card shadow-lg p-3  bg-white rounded h-75">
                <div class=" items-center h-20">
                <h1 class="text-lg font-medium truncate mr-5"><span id="add_update"> Add </span>Web User</h1>
                </div>
                <div class="card-body" style="background-color: white ;" >
                {!! Form::open(['url' => '', 'name' => 'web_user_form', 'id' => 'web_user_form', 'method' => 'post' ,'class'=>'animate-form form-horizontal','role'=>'form']) !!}
                {!! Form::hidden('code', '', ['id'=>'edit_code']) !!}  

                    <div class="row form-group hide_div">
                          <div class="col-sm-4 text-right font-weight-bold" style="font-size: 17Px;">
                                {!! Form::label('user_name','Name:', ['class'=>'required']) !!}
                          </div>
                            
                            <div class="col-sm-6">
                                {!! Form::text('user_name',null,['class'=>'form-control','id'=>'user_name','maxlength'=>'40','placeholder'=>'Enter User Name','autocomplete'=>'off']) !!}
                            </div>
                    </div>
                    
                    <div class="row form-group">
                        <div class="col-sm-4 text-right font-weight-bold" style="font-size: 17Px;">
                            {!! Form::label('mobile_no','Mobile No:',['class'=>'required']) !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::text('mobile_no',null,['class'=>'form-control','id'=>'mobile_no','placeholder'=>'Enter Mobile No','maxlength'=>'10','pattern'=>'[0-9]']) !!}
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-4 text-right font-weight-bold" style="font-size: 17Px;">
                            {!! Form::label('email_address','Email Address:',['class'=>'']) !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::email('email_address',null,['class'=>'form-control','id'=>'email_address','placeholder'=>'Enter Email Address', 'autocomplete'=>'off']) !!}
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-4 text-right font-weight-bold" style="font-size: 17Px;">
                            {!! Form::label('user_type', 'User Type:', ['class'=>'required']) !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::select('user_type',[''=>''],null,['class'=>'form-control','id'=>'user_type']) !!}
                        </div>
                    </div>
                    <div class="row form-group hide_div">
                        <div class="col-sm-4 text-right font-weight-bold" style="font-size: 17Px;">
                            {!! Form::label('user_id','User Id:',['class'=>'required']) !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::text('user_id',null,['class'=>'form-control','id'=>'user_id','placeholder'=>'Enter User Id', 'autocomplete'=>'off','minlength'=>'4','maxlength'=>'15']) !!}
                        </div>
                    </div>
                   
                    <div class="row form-group hide_div">
                        <div class="col-sm-4 text-right font-weight-bold" style="font-size: 17Px;">
                            {!! Form::label('password','Password:',['class'=>'required']) !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::password('password',['class'=>'form-control','id'=>'password','placeholder'=>'Enter Password','maxlength'=>'10']) !!}
                        </div>
                    </div>
                    <div class="row form-group hide_div">
                        <div class="col-sm-4 text-right font-weight-bold" style="font-size: 17Px;">
                            {!! Form::label('confirm_password','Confirm Password:',['class'=>'required']) !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::password('confirm_password',['class'=>'form-control','id'=>'confirm_password','placeholder'=>'Enter Confirm Password','maxlength'=>'10']) !!}
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12" style="text-align: center;">
                            <button id="save_update" type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
 </div>
<style>
#save_update:hover{
    background-color: red;
}
</style>
<script>
    $(function(){
        get_all_user_type();
        var regExp = /[a-z]/i;
        $('#mobile_no').on('keydown keyup', function(e) {
            var value = String.fromCharCode(e.which) || e.key;
            if(regExp.test(value)) {
            e.preventDefault();
            return false;
            }
        });

        var web_user = {!! isset($web_user_details) ? json_encode($web_user_details) : "null" !!}
        // console.log(web_user);
        if(web_user!==null){
            $(".hide_div").hide();
            $("#edit_code").val(web_user.code);
            $("#email_address").val(web_user.email_address);
            get_all_user_type(web_user.user_type);
            $("#mobile_no").val(web_user.mobile_no);
            $("#save_update").html('Update');
        } else{
            get_all_user_type('');
        }
        $("#web_user_form").bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                            
                        },
                fields: {
                    user_name: {
                        validators: {
                            notEmpty: {
                                message: "User Name is Required"
                            },
                            regexp: {
                                regexp: /^[a-z\s]+$/i,
                                message: 'User Name can consist of alphabetical characters and spaces only'
                            }
                        }
                    },
                    user_type: {
                        validators: {
                            notEmpty: {
                                message: "User Type is Required"
                            }
                        }
                    },
                    mobile_no: {
                        validators: {
                            notEmpty: {
                                message: "Mobile Number is Required"
                            }
                        }
                    },
                    user_id: {
                        validators: {
                            notEmpty: {
                                message: "User Id is Required"
                            }
                        }
                    },
                   
                    password: {
                        validators: {
                            notEmpty: {
                                message: "Password is Required"
                            },
                            regexp: {
                                regexp: /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[$@!%?&]).{6,10}$/,
                                message: 'The password should contain Minimum 6 and Maximum 10 characters at least 1 Uppercase Alphabet, 1 Lowercase Alphabet, 1 Number and 1 Special Character'
                            }
                        }
                    },
                    confirm_password: {
                        validators: {
                            notEmpty: {
                                message: "Confirm Password is Required"
                            },
                            identical: {
                                field: 'password',
                                message: 'The password and its confirm are not the same'
                               }
                        }
                    }

                }
                
        }).on('success.form.bv', function(e) {
                e.preventDefault();
                if(web_user!==null){
                    web_user_update();
                } else {
                web_user_save();

                }
            });

            function web_user_save() {
                // alert("hi");
                var token = $("input[name='_token']").val();
                var user_name = $("#user_name").val();
                var user_type = $("#user_type").val();
                var mobile_no = $("#mobile_no").val();
                var email_address = $("#email_address").val();
                var user_id = $("#user_id").val();
                var web_user_password = $("#password").val();
                var confirm_password = $("#confirm_password").val();

                var f_sv = new FormData();
                    f_sv.append('_token', token);
                    f_sv.append('user_name', user_name);
                    f_sv.append('user_type', user_type);
                    f_sv.append('mobile_no', mobile_no);
                    f_sv.append('email_address', email_address);
                    f_sv.append('user_id', user_id);
                    f_sv.append('web_user_password', web_user_password);
                    f_sv.append('confirm_password', confirm_password);

                    $.ajax({
                    type: 'post',
                    url: 'web_user_save',
                    data: f_sv,
                    processData: false,
                    contentType: false,
                    success: function(data){
                        if (data.status == 1) {
                            var msg = "<strong>SUCCESS: </strong>Web User Saved Successfully";
                    $.confirm({
                        title: 'Success!',
                        type: 'green',
                        icon: 'fa fa-check',
                        content: msg,
                        boxWidth: '30%',
                        useBootstrap: false,
                        buttons: {
                            ok: function () {
                                $('#web_user_form').get(0).reset();
                                location.reload();
                            }
                        }
                    });
                
                }  else if(data.status == 4){
                    var msg = "<strong>WARNING:</strong>Web User Type is Already Exists";
                    $.confirm({
                        title: 'Warning!',
                        type: 'orange',
                        icon: 'fa fa-warning',
                        content: msg,
                        boxWidth: '30%',
                        useBootstrap: false,
                        buttons: {
                            ok: function () {
                              
                                
                            }

                        }
                    });
                }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        $(".se-pre-con").fadeOut("slow");
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
                            useBootstrap: false
                        });
                    }
                });
            }

            function web_user_update() {
                // alert("hi");   
                var token = $("input[name='_token']").val();
                var email_address = $("#email_address").val();
                var user_type = $("#user_type").val();
                var mobile_no = $("#mobile_no").val();
                var edit_cd = $("#edit_code").val();

                var f_update = new FormData();
                f_update.append('_token', token);
                f_update.append('email_address', email_address);
                f_update.append('user_type', user_type);
                f_update.append('mobile_no', mobile_no);
                f_update.append('edit_cd', edit_cd);
                $.ajax({
                    type: 'post',
                    url: 'web_user_update',
                    data: f_update,
                    processData: false,
                    contentType: false,
                    success: function(data){
                        if (data.status == 2) {
                            
                            var msg = "<strong>SUCCESS: </strong>Web User Updated Successfully";

                                $.confirm({
                                title: 'Success!',
                                type: 'green',
                                icon: 'fa fa-check',
                                content: msg,
                                boxWidth: '30%',
                                useBootstrap: false,
                                buttons: {
                                    ok: function () {
                                        
                                       window.location.href = "web_user";
                                        
                                    }

                                }
                            });
                        
                    }
                     else if(data.status == 5){
                    var msg = "<strong>WARNING:</strong>Web User Type is Already Exists";
                    $.confirm({
                        title: 'Warning!',
                        type: 'orange',
                        icon: 'fa fa-warning',
                        content: msg,
                        boxWidth: '30%',
                        useBootstrap: false,
                        buttons: {
                            ok: function () {
                              
                                
                            }

                        }
                    });
                }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        $(".se-pre-con").fadeOut("slow");
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
                        });
                    }
                });
            }

    });

    function get_all_user_type(user_type_cd) {
        $.ajax({
            type: "post",
            url: "get_all_user_type",
            data: {'_token':'{{csrf_token()}}'},
            dataType: "json",
            success: function(data){
                $("#user_type").html('<option value="">--Select--</option>');
                $.each(data.options, function(key, value) {
                    $("#user_type").append('<option value='+key+'>'+value+'</option>')
                });
                if(user_type_cd!=''){
                    $("#user_type").val(user_type_cd);
                }
            }
        });
    }
</script>
@stop
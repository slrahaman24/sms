<?php $title="User-Type" ?>
<script src="{{ 'https://code.jquery.com/jquery-3.5.1.js' }}"></script>
<script src="{{ 'https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js' }}"></script>
<link rel="stylesheet" href="{{ 'https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css' }}" />
@extends('layouts.master');
@section('content')
<div class="-intro-x breadcrumb mr-auto hidden sm:flex">
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
                <a href="">Application</a>
                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="breadcrumb__icon feather feather-chevron-right">
                <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
                <a href="" class="breadcrumb--active">User Type Entry</a>
            </div>
            <div class="intro-x relative mr-3 sm:mr-6">
            <a href="user_type"><button type="button" class="btn btn-info">
            <span class="glyphicon glyphicon-search"></span>List Of User Type
            </button></a>
        </div>
</div>

<div class=" mt-8 card shadow-lg p-3  bg-white rounded h-75">
            <div class=" items-center h-20">
                <h1 class="text-lg font-medium truncate mr-5"> Add User Type</h1>
            </div>

        <div class="card-body" style="background-color: white ;" >
        {!! Form::open(['url' => '', 'name' => 'user_type_form', 'id' => 'user_type_form', 'method' => 'post' ,'class'=>'animate-form form-horizontal','role'=>'form']) !!}
        {!! Form::hidden('code', '', ['id'=>'edit_code']) !!}  

            <div class="row form-group">
                <div class="col-sm-4 text-right font-weight-bold" style="font-size: 20Px;">
                    {!! Form::label('user_type','User Type:',['class'=>'required']) !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::text('user_type',null,['class'=>'form-control','id'=>'user_type','placeholder'=>'Enter User Type','autocomplete'=>'off','maxlength'=>'100']) !!}
                </div>
            </div>
            <div class="form-group">
                        <table id="tbl_of_mnu_submnu" class="display" style="width:100%">
                        <thead>
                                <tr>
                                    <th></th>
                                    <th>Menu</th>
                                     <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>  
                                
                            </tr> 
                        </thead> 
                        </table>
            </div>
            <div class="row form-group">
                <div class="col-sm-12" style="text-align: center">
                    <button id="save-update" type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
</div>
<style>
    td.details-control {
        background: url('images/details_open.png') no-repeat center center;
        cursor: pointer;
    }
    tr.shown td.details-control {
        background: url('images/details_close.png') no-repeat center center;
    }
</style>


<script>
    $(function() {
      
        var ct = 1;
        var user_type_all_data = {!! isset($user_type_data) ? json_encode($user_type_data) : "null" !!};
        // console.log(user_type_all_data);
        if(user_type_all_data !==null){
            $("#edit_code").val(user_type_all_data.code);
            $("#user_type").val(user_type_all_data.Type_name);
            $("#save-update").html("Update");
        }
        var sub_menu = {!! isset($sub_menu_data) ? json_encode($sub_menu_data) : "null"!!};
        // console.log(sub_menu);

       var table = $('#tbl_of_mnu_submnu').DataTable({
            "processing": true,
            "serverSide": true,
            "dom": "t",
            "ajax": {
                    type: 'post',
                    url: 'list_of_menu_submnu',
                    data: {'_token': '{{csrf_token()}}'},
                    dataSrc: "record_details",
                //    success:function(dataSrc){
                //        console.log(dataSrc);
                //    }
                },
                "columns": [
                
                {
                    "className":      'details-control',
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ''
                },
                { 
                    
                    "data": "menu_details",
                    "render": function (data, type, full, meta) {
                        // console.log(dataSrc);
                    var mnu_tbl ="";
                        mnu_tbl+='<td>'+data.menu_name+'</td>';
                        mnu_tbl+='<input type="hidden" id="menu_code'+ct+'" value='+data.menu_code+'>';
                        // mnu_tbl+='<td><label><input type="checkbox">View</label></td>';
                        ct++;
                        return mnu_tbl;
                    }
                },
                {
                "data": "menu_details",
                "render": function (data, type, full, meta) {
                    // console.log(data);
                    var sub_mnu_view ="";
                    if(data.mnu_view==1){
                       
                        sub_mnu_view+='<td><label><input style="margin-right: 6px;" type="checkbox" id="menu_view" checked>View</label></td>';
                    }
                    return sub_mnu_view;
                   
                }
            }
            ],
                "order": [[1, 'asc']]
        });

    $('#tbl_of_mnu_submnu tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
        if ( row.child.isShown() ) {
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
        if(sub_menu !==null){
            $.each(sub_menu, function(key,value) {
                var mnu_cd = value.menu_code;
                var mnu_cd_str = mnu_cd.toString();
                var sb_mnu_cd = value.submenu_code;
                var sb_cde_str = sb_mnu_cd.toString();
                var str_mn_sb = mnu_cd_str + sb_mnu_cd;
                if(value.view == 1){
                    $("#viewdetails"+str_mn_sb).prop("checked", true);
                }
            if(value.f_add == 1){
                    $("#adddetails"+str_mn_sb).prop("disabled", false);
                    $("#adddetails"+str_mn_sb).prop("checked", true);
                }
            if(value.f_update == 1){
                    $("#updatedetails"+str_mn_sb).prop("disabled", false);
                    $("#updatedetails"+str_mn_sb).prop("checked", true);
                }
            if(value.f_delete == 1){
                    $("#deletedetails"+str_mn_sb).prop("disabled", false);
                    $("#deletedetails"+str_mn_sb).prop("checked", true);
                }
            
            });
        }
    });
        $("#user_type_form").bootstrapValidator({
            message: 'This value is not valid',
                feedbackIcons: {
                            
                    },
                    fields: {
                        user_type: {
                            validators: {
                                notEmpty: {
                                    message: "Type Name is Required"
                                },
                                regexp: {
                                        regexp: /^[a-z\s]+$/i,
                                        message: 'User Type can consist of alphabetical characters and spaces only'
                                    }
                              
                            }
                        }
                    }
        }).on('success.form.bv', function(e) {
                e.preventDefault();
                if(sub_menu !==null){
                    user_type_update();
                } else {
                    user_type_save();
                }
            });
            function user_type_save() {
                var token = $("input[name='_token']").val();
                var user_type = $("#user_type").val();
                var menu_length=1;
                var mnu_arr = [];
                $.each(table.data(), function(key,value){
                    // console.log(table.data());
                    var menu_cd = $("#menu_code"+menu_length).val();
                    menu_length=menu_length+1;
                    var sub_arr = [];
                    $.each(value.sub_menu_name, function(key,value){
                                    var menu_code = value.mnu_cd;
                                    var menu_code_str = menu_code.toString();
                                    var sub_menu_code = value.submenu_code;
                                    var sub_code_str = sub_menu_code.toString();
                                    var str = menu_code_str + sub_code_str;
                                    var sub_menu_cd = $("#sub_menu_code"+str).val();
                                    var view_val = $("#viewdetails"+str).is(":checked") ? 1 : 0;
                                    var add_val = $("#adddetails"+str).is(":checked") ? 1 : 0;
                                    var update_val = $("#updatedetails"+str).is(":checked") ? 1 : 0;
                                    var delete_val = $("#deletedetails"+str).is(":checked") ? 1 : 0;
                                    sub_arr.push({
                                        'sub_menu_code': sub_menu_cd,
                                        'view': view_val,
                                        'add': add_val,
                                        'update': update_val,
                                        'delete': delete_val
                                    });
                                });
                                mnu_arr.push({
                                    'menu_code' : menu_cd,
                                    // 'menu_view' : menu_view,
                                    'sub_code': sub_arr,
                                });
                               console.log(mnu_arr);
                            });
                            $(".se-pre-con").fadeIn("slow");

                                var f_sv = new FormData();
                                f_sv.append('_token', token);
                                f_sv.append('user_type_name', user_type);
                                f_sv.append('menu_arr', JSON.stringify(mnu_arr));
                                $.ajax({
                                    type: "post",
                                    url: "user_type_sv",
                                    data: f_sv,
                                    processData: false,
                                    contentType: false,
                                    boxWidth: '30%',
                                    useBootstrap: false,
                                    success:function(data){
                                        if(data.status == 1){
                                            var msg = "<strong>SUCCESS: </strong>User Type Saved Successfully";
                                            $.confirm({
                                                title: 'Success!',
                                                type: 'green',
                                                icon: 'fa fa-check',
                                                content: msg,
                                                buttons: {
                                                    ok: function(){
                                                        $('#user_type_form').get(0).reset();
                                                        location.reload();
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
                                        useBootstrap: false,
                                    });
                                }
                                });

            }

            function user_type_update() {
                var token = $("input[name='_token']").val();
                    var user_type = $("#user_type").val();
                    var edit_code = $("#edit_code").val();
                    var menu=1;
                    var menu_array = [];
                        $.each(table.data(), function(key,value){
                            var menu_cd = $("#menu_code"+menu).val();
                                menu=menu+1;
                                var sub_array = [];
                                $.each(value.sub_menu_name, function(key,value){
                                    var menu_code = value.mnu_cd;
                                var menu_code_str = menu_code.toString();
                                var sub_menu_code = value.submenu_code;
                                var sub_code_str = sub_menu_code.toString();
                                var str = menu_code_str + sub_code_str;
                                    var sub_menu_cd = $("#sub_menu_code"+str).val();
                                    var view_val = $("#viewdetails"+str).is(":checked") ? 1 : 0;
                                    var add_val = $("#adddetails"+str).is(":checked") ? 1 : 0;
                                    var update_val = $("#updatedetails"+str).is(":checked") ? 1 : 0;
                                    var delete_val = $("#deletedetails"+str).is(":checked") ? 1 : 0;
                                    
                            sub_array.push({
                                'sub_menu_code': sub_menu_cd,
                                'view': view_val,
                                'add': add_val,
                                'update': update_val,
                                'delete': delete_val
                            });
                        
                        });
                    
                        menu_array.push({
                            'menu_code' : menu_cd,
                            'sub_code': sub_array,

                        });

                    });
                    var f_update = new FormData();
                    f_update.append('_token', token);
                    f_update.append('user_type_name', user_type);
                    f_update.append('editcd', edit_code);
                    f_update.append('menu_arr', JSON.stringify(menu_array));
                    $.ajax({
                        type: "post",
                        url: "user_type_update",
                        data: f_update,
                        processData: false,
                        contentType: false,
                        boxWidth: '30%',
                        useBootstrap: false,
                        success: function(data){
                            if (data.status == 2) {
                    
                                var msg = "<strong>SUCCESS: </strong>User Type Updated Successfully";

                                $.confirm({
                                title: 'Success!',
                                type: 'green',
                                icon: 'fa fa-check',
                                content: msg,
                                buttons: {
                                    ok: function () {
                                        window.location.href = "user_type";
                                    
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
                            useBootstrap: false,
                        });
                    }
                    });
            }
          
    });
   

    function format ( d ) {
        if(d.sub_menu_name !='') {
            var tbl = '<table cellpadding="5" cellspacing="0" border="0" style="width: 100%;padding-left:50px;">';
            tbl += '<tr style="background-color: #09091b8c;">';
            tbl += '<td style="color: white;">Sub Menu</td>';
            tbl += '<td style="padding-left: 27px; color: white;">View</td>';
            tbl += '<td style="padding-left: 27px; color: white;">Add</td>';
            tbl += '<td style="padding-left: 27px; color: white;">Update</td>';
            tbl += '<td style="padding-left: 27px; color: white;">Delete</td>';
            tbl += '</tr>';
        $.each(d.sub_menu_name, function(key, value) {
            tbl += '<tr style="background-color: #32365f1c;">';
            tbl += '<td>'+value.submenu_name+'</td>';
            tbl+='<input type="hidden" id="sub_menu_code'+value.mnu_cd+value.submenu_code+'" value='+value.submenu_code+'>';
            if(value.view == 1) {
                tbl += '<td><label><input style="margin-right: 7px;" type="checkbox" class="checkboxclass" id="viewdetails'+value.mnu_cd+value.submenu_code+'" value="" onclick="details_fun(this.id)">View</label></td>';
            } else {
                tbl +='<td></td>';
            }
            if(value.add == 1) {
            tbl += '<td><label><input style="margin-right: 7px;" type="checkbox" id="adddetails'+value.mnu_cd+value.submenu_code+'" disabled>Add</label></td>';
            } else {
                tbl +='<td></td>';
            }
            if(value.update == 1) {
            tbl += '<td><label><input style="margin-right: 7px;" type="checkbox" id="updatedetails'+value.mnu_cd+value.submenu_code+'" disabled>Update</label></td>';
            } else {
                tbl +='<td></td>';
            }
            if(value.delete == 1) {
            tbl += '<td><label><input style="margin-right: 7px;" type="checkbox" id="deletedetails'+value.mnu_cd+value.submenu_code+'" disabled>Delete</label></td>';
            } else {
                tbl +='<td></td>';
            }
            tbl += '</tr>';
        });
            tbl += '</table>';
            return tbl;
        }
}

function details_fun(id) {
    var num = id.match(/\d+/);
    var val_cheked = $('#'+id).prop("checked");
    if(val_cheked == true) {
        $("#adddetails"+num).prop( "disabled", false );
        $("#updatedetails"+num).prop( "disabled", false );
        $("#deletedetails"+num).prop( "disabled", false );
    } else {
        $("#adddetails"+num).prop( "disabled", true ); 
        $('#adddetails'+num).prop('checked', false); 
        $("#updatedetails"+num).prop( "disabled", true );
        $('#updatedetails'+num).prop('checked', false); 
        $("#deletedetails"+num).prop( "disabled", true );
        $('#deletedetails'+num).prop('checked', false); 
    }
 }
</script>
@stop
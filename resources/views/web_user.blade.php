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
        <a href="add_web_user"><button type="button" class="btn btn-info">
         <span class="glyphicon glyphicon-search"></span>Add Web User
        </button></a>
        </div>
 </div>
 <div class="mt-8 card shadow-lg p-3  bg-white rounded h-75">
            <div class=" items-center h-20">
              <h1 class="text-lg font-medium truncate mr-5"> List of Web User</h1>
            </div>
            <div class="card-body" style="background-color: white ;" >
            {!! Form::open(['url' => '', 'name' => 'search_user_type_form', 'id' => 'search_user_type_form', 'method' => 'post' ,'class'=>'animate-form form-horizontal','role'=>'form']) !!}

               <div class="row form-group">
                  <div class="font-weight-bold" style="font-size: 16Px;margin-left: 150px;">
                     {!! Form::label('user_type', 'User Type:', ['class'=>'']) !!}
                     </div>
                     <div class="col-sm-4">
                        {!! Form::select('user_type',[''=>''],null,['class'=>'form-control','id'=>'user_type']) !!}
                    </div>
                    <div class="col-sm-3">
                        <button id="save-update" type="submit" class="btn btn-success">Search</button>
                    </div>
                </div>
                   
               {!! Form::close() !!}
               <div class="datatbl table-responsive">
                  <table class="table table-striped table-bordered table-hover notice-types-table" id="web_user_table">
                     <thead>
                        <tr>
                           <th>Sl#</th>
                           <th>Name</th>                          
                           <th>Mobile No</th>
                           <th>User Type</th>
                           <th>User Id</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                  </table>
               </div>
            </div>
</div>

<script>
    $(function(){
        get_all_user_type();
        web_user_details();
        $("#search_user_type_form").bootstrapValidator({
         message: 'This value is not valid',
            feedbackIcons: {
                            
               },
               fields: {
                  user_type: {
                        validators: {
                            notEmpty: {
                                message: "User Type is Required"
                            }
                        }
                    }
               }
            }).on('success.form.bv', function(e) {
                e.preventDefault();
                web_user_details();
            });
    });
  

    function web_user_details() {
        // alert("hi");
        var user_type = $("#user_type").val();
        $("#web_user_table").dataTable().fnDestroy();
        $("#web_user_table").dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                type: "post",
                url: "web_user_details",
                data: {'user_type': user_type,'_token': '{{csrf_token()}}'},
                dataSrc: "record_details"
            },
            "dataType": 'json',
            "columnDefs": [
                  {className: "table-text", "targets": "_all"},
                        {
                            "targets": 0,
                            "data": "id",
                            "defaultContent": "",
                            "searchable": false,
                            "sortable": false,
                        },
                        {
                           "targets": 1,
                           "data": "user_name"
                        },
                        {
                           "targets": 2,
                           "data": "mobile_no"
                        },
                        {
                           "targets": 3,
                           "data": "user_type"
                        },
                        {
                           "targets": 4,
                           "data": "user_id"
                        },
                        {
                           "targets": -1,
                           "data": "action",
                           "searchable": false,
                           "sortable": false,
                           "render": function (data, type, full, meta) {
                              // console.log(data);
                                 var str_btn = "";
                                 if(data.type_name != "Admin"){
                                    str_btn+='<button type="submit" data-toggle="tooltip"  style="margin-left: 1px;font-size: 20px;" class="btn  btn-sm Small edit_data" id="' +data.edit+ '" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i> </button> &nbsp;';

                                 }

                                 return str_btn;
                           }
                        }
                  ],
                  "order": [[1, 'asc']]
        });
    }

    var table = $('#web_user_table').DataTable();
    table.on('draw.dt', function () {
      $(".edit_data").click(function() {
         // alert("hi");
         var web_user_cd = this.id;
         // alert(web_user_cd);
         var datas = {'web_user_cd': web_user_cd, '_token': $('input[name="_token"]').val()};
         redirectPost('{{url("web_user_edit")}}', datas);
      });
   });

    function get_all_user_type() {
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
            }
        }); 
    }
</script>
@stop
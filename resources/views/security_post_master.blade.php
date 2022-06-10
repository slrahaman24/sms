<?php $title = 'Security Post Master'; ?>
@extends('layouts.master')
@section('content')
<style>
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
 
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 15% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
</style>
   <div class="top-bar">
         <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="">Application</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="breadcrumb__icon feather feather-chevron-right">
               <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
            <a href="" class="breadcrumb--active">Security Post Master</a>
         </div>
          <div class="intro-x relative mr-3 sm:mr-6">
        <a href="add_security_post"><button type="button" class="btn btn-info">
         <span class="glyphicon glyphicon-search"></span>Add Security Post
        </button></a>
      
        

     </div>
        
    </div>

    <div class=" mt-8 card shadow-lg p-3  bg-white rounded h-75">
           <div class=" items-center h-20">
              <h1 class="text-lg font-medium truncate mr-5"> Security Post Details</h1>
            </div>

            <div class="card-body" style="background-color: white ;" >
            
            

            <div class="datatbl table-responsive">
                <table class="table table-striped table-bordered table-hover notice-types-table" id="tbl_securtiy_post">
                    <thead class="text-center">
                        <tr>
                            <th style="width: 5%;">SL#</th>
                            <th style="width: 10%;">Location</th>
                            <th style="width: 20%;">Post Name</th>
                            <th style="width: 30%;">Designation</th>
                            <th style="width: 10%;">Latitute</th>
                            <th style="width: 10%;">Longitute</th>
                            <th style="width: 15%;">Action</th>
                            
                        </tr>
                   </thead>
                    <tbody >
                    </tbody>
                </table> 
            </div>
       
                            
            <div id="myModal" class="modal" >
            
                <div class="modal-content" style="width:50%" >
                    <span class="close">&times;</span>
                    {!! Form::hidden('code', '',['id'=>'edit_code']) !!}
                    <h3 id='add_update'>Add Designation</h3><br>
                        {!! Form::select('designation_name',[],null,['class' => 'form-control designation_name','id'=>'designation_name','multiple'=>'multiple']); !!}
                        <br>
                        <button id="save_update" style="width:30%;margin: 0px auto;" type="submit" class="btn btn-primary">Save</button>
                    </div>

                </div>
                
            </div>
           
     </div>
     {{csrf_field()}}
    <script>
   $(function () { 
       
            
            $(".close").click(function() {
                $('#myModal').hide();
            });
            $('.designation_name').select2();

            security_post_details();

            $("#save_update").click(function() { 
                var edit_code=$('#edit_code').val();
                var designation_name = $("#designation_name").val();
                if(designation_name==''){
                    $.confirm({
                            title: 'Error!',
                            type: 'read',
                            icon: 'fa fa-check',
                            content: 'Select Designation.',
                            buttons: {
                                ok: function () {
                                    
                                }

                            }
                        });
                }else{
                    update_security_post();
                }
                
            });
            
    });
    
    function update_security_post(){
        var token = $("input[name='_token']").val();
        var designation_name = $("#designation_name").val();
        var editcd = $("#edit_code").val();
        var formData_save = new FormData();
            formData_save.append('_token', token);
            formData_save.append('designation_name', designation_name);
            formData_save.append('editcd', editcd);
            $('#loading').fadeIn();
            $.ajax({
                            type: "POST",
                            url: "update_security_post",
                            data: formData_save,
                            processData: false,
                            contentType: false,
                            async: false,
                            dataType: "json",
                            // alert("hi");
                            success: function (data) {
                                $('#loading').fadeOut();
                                
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
                                        $("#designation_name").val();
                                        $('#myModal').hide('');
                                        $("#edit_code").val('');
                                        security_post_details();
                                    }

                                }
                            });
  
                            },
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

    function security_post_details(){
      $("#tbl_securtiy_post").dataTable().fnDestroy();
      $('#tbl_securtiy_post').dataTable({
         "processing": true,
              "serverSide": true,
              "ajax": {
            url: "list_of_security_post",
            type: "post",
            data: {'_token': $('input[name="_token"]').val()},
            dataSrc: "record_details",
              },

              "dataType": 'json',
              "columnDefs":
                [
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
                        "data": "location_name",
                        
                    },
                    {
                        "targets": 2,
                        "data": "post_name",
                        
                    },

                    {
                     
                     "targets": 3,
                        "data": "designation",
                  },
                  {
                        "targets": 4,
                        "data": "lat_coordianates",
                        
                    },
                    {
                        "targets": 5,
                        "data": "long_coordinates",
                        
                    },
                    {
                            "targets": -1,
                            "data": 'action',
                            "searchable": false,
                            "sortable": false,
                            "render": function (data, type, full, meta) {
                                var str_btns = "";


                                str_btns += '<button type="button"  class="btn btn-info edit-button btn_new1" id="' + data.e + '" title="Edit"><i class="fa fa-edit"></i></button>&nbsp;';
                                str_btns += '<button type="button"  class="btn btn-danger  delete-button btn_new1" id="' + data.d + '" title="Delete"><i class="fa fa-trash"></i></button>';

                                return str_btns;
                            }
                        }
                  /*{
                    "targets": 2,
                   
                     "data": 'edit',
                    "searchable": false,
                      "sortable": false,
                       "render": function (data, type, full, meta) {
                         var str_btns = "";   
                         str_btns+='<button type="submit" data-toggle="tooltip"  style="margin-left: 1px;" class="btn btn-success btn-sm Small edit_data" id="' +data+ '" title="Edit"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> &nbsp;';
                        return str_btns;
                       }
                  },

                  {
                    "targets": 4,
                   
                     "data": 'delete',
                    "searchable": false,
                      "sortable": false,
                       "render": function (data, type, full, meta) {
                         var str_btns = "";   
                         str_btns+= '<button type="submit" data-toggle="tooltip" style="margin-left: 1px;" class="btn btn-danger btn-sm Small delete-button" id="' + data + '" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button';

                        return str_btns;
                       }
                  }*/


                  
                   
                   
                  

                    ],
                    "order": [[1, 'asc']]
            // });
      });
    }

    var table = $('#tbl_securtiy_post').DataTable();
    table.on('draw.dt', function (){
        $('#edit_code').val('');
        $("#save_update").html('Save');
        $("#add_update").html('Save Designation');

        $('.add-button').click(function (){
            $("#designation_name").html('');
            var post_code = this.id;
            var token = $("input[name='_token']").val();
            $.ajax({
                type: "post",
                url: "get_all_designation",
                data: {'_token':token},
                dataType: "json",
                success: function(data){
                    $('#edit_code').val(post_code);
                   $.each(data.options, function (key, value) {
                        $("#designation_name").append('<option value=' + key + '>' + value + '</option>');
                    });
                    $('#myModal').show();
               
                }
            });
        });
        $('.edit_btn_new1').click(function (){
            $('#designation_name').html('');
            $('#edit_code').val('');
            var post_code = this.id;
            //var result = $(post_code).text().split('/');
            var result = post_code.split("/");
            //alert(result[1]);
            //alert(result[0]);
            var token = $("input[name='_token']").val();
            $("#save_update").html('Update');
            $("#add_update").html('Update Designation');
            
            $.ajax({
                type: "post",
                url: "get_all_designation",
                data: {'_token':token},
                dataType: "json",
                success: function(data){
                    $('#edit_code').val(result[0]);
                   $.each(data.options, function (key, value) {
                        $("#designation_name").append('<option value=' + key + '>' + value + '</option>');
                    });
                    
                    if(result[1]  !=''){
                        var strArr = result[1].split(",");
                        $("#designation_name").val(strArr);
                    }
                    $('#myModal').show();
                }
            });
        });
      $('.edit-button').click(function (){
            // alert("hi");
            var security_post_code = this.id;
          
            // console.log(security_post_code);

            // alert(security_post_code);

            var datas = {'security_post_code': security_post_code, '_token': $('input[name="_token"]').val()};
                redirectPost('{{url("security_post_edit")}}', datas);

        });

        $('.delete-button').click(function () {

                var reply = confirm('Are you sure to delete the record?');
                if (!reply) {
                    return false;
                }
                var dlt_code = this.id;
                $.ajax({
                    type: 'post',
                    url: 'security_post_delete',
                    data: {'dlt_code': dlt_code, '_token': $('input[name="_token"]').val()},
                    dataType: 'json',
                    success: function (datam) {

                        if (datam.status == 1) {
                          security_post_details();
                            $.alert({
                                type: 'green',
                                icon: 'fa fa-check',
                                title: 'Success!!',
                                content: '<strong>SUCCESS:</strong> Security Post Deleted Successfully.'
                            });
                        } else {
                            $.alert({
                                type: 'red',
                                icon: 'fa fa-warning',
                                title: 'Error!!',
                                content: '<strong>UNSUCCESS:</strong> Failed to Delete Data.'
                            });
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                    
                        var msg = "<strong>Failed to Delete data.</strong><br/>";
                        if (jqXHR.status !== 422 && jqXHR.status !== 400) {
                            msg += "<strong>" + jqXHR.status + ": " + errorThrown + "</strong>";
                        } else {
                            if (jqXHR.responseJSON.hasOwnProperty('exception')) {
                                if (jqXHR.responseJSON.exception_code == 23000) {
                                    msg += "Data Already Used!! Cannot Be Deleted.";
                                }
                            } else {
                                msg += "Error(s):<strong><ul>";
                                $.each(jqXHR.responseJSON['errors'], function (key, value) {
                                    msg += "<li>" + value + "</li>";
                                });
                                msg += "</ul></strong>";
                            }
                        }
                        $.alert({
                            type: 'red',
                            icon: 'fa fa-warning',
                            title: 'Error!!',
                            content: msg
                        });

                    }
                    // alert('hi');
                });

            });



    });
    </script>
  
@stop
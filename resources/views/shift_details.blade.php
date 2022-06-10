<?php $title="Shift" ?>
@extends('layouts.master')
@section('content')
<div class="top-bar">
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
                <a href="">Application</a>
                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="breadcrumb__icon feather feather-chevron-right">
                <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
                <a href="" class="breadcrumb--active">Shift</a>
            </div>
              <?php if(session()->get('per_add') == 1){  ?>
            <div class="intro-x relative mr-3 sm:mr-6">
            <a href="add_shift"><button type="button" class="btn btn-info">
            <span class="glyphicon glyphicon-search"></span>Add Shift
            </button></a>
        </div>
         <?php }  ?>
            
    </div>
    <div class=" mt-8 card shadow-lg p-3  bg-white rounded h-75">
            <div class=" items-center h-20">
              <h1 class="text-lg font-medium truncate mr-5"> List of Shift</h1>
            </div>
        <div class="card-body" style="background-color: white ;" >
            <div class="datatbl table-responsive">
                <table class="table table-striped table-bordered table-hover notice-types-table" id="tbl_of_shift">
                <thead class="text-center">
                        <tr>
                            <th style="width: 10%;">SL#</th>
                            <th style="width: 20%;">Shift</th>
                            <th style="width: 25%;">Shift In Time</th>
                            <th style="width: 30%;">Shift Out Time</th>
                            <th style="width: 15%">Action</th>
                        </tr>
                   </thead>
                   <tbody>
                   </tbody>
                </table>
            </div>
        </div>
    </div>
    {{csrf_field()}}
<script>
    $(function () {
        shift_details();
    });
    function shift_details() {
        $("#tbl_of_shift").dataTable().fnDestroy();
        $("#tbl_of_shift").dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                type: "post",
                url: "list_of_shift",
                data: {'_token': $('input[name="_token"]').val()},
                dataSrc: "record_details",

            },
            "dataType": "json",
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
                    "data": "shift",
                },
                {
                    "targets": 2,
                    "data": "shift_in_time",
                },
                {
                    "targets": 3,
                    "data": "shift_out_time",
                },
                {
                    "targets": -1,
                    "data": "action",
                    "searchable": false,
                            "sortable": false,
                            "render": function (data, type, full, meta) {
                                var str_btns = "";

                                 <?php if(session()->get('per_update') == 1){  ?>
                                
                                str_btns+='<button type="submit" data-toggle="tooltip"  style="margin-left: 1px;" class="btn btn-success btn-sm Small edit_data" id="' +data.e+ '" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> &nbsp;';

                                 <?php }  ?>
                                 <?php if(session()->get('per_delete') == 1){  ?>

                                 str_btns+= '<button type="submit" data-toggle="tooltip" style="margin-left: 1px;" class="btn btn-danger btn-sm Small delete-button" id="' + data.d + '" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i> </button';

                                 <?php }  ?>

                                return str_btns;
                            }
                }
              
            ],
            "order": [[1, "asc"]]
        });
    }

    var table = $("#tbl_of_shift").DataTable();
    table.on('draw.dt', function(){
        $(".edit_data").click(function(){
            // alert("hi");
            var shift_cd = this.id;
            // alert(shift_cd);
            var datas = {'shift_cd': shift_cd, '_token': $('input[name="_token"]').val()};
            redirectPost('{{url("shift_edit")}}', datas);
        });
        $('.delete-button').click(function () {

        var reply = confirm('Are you sure to delete the record?');
        if (!reply) {
            return false;
        }
        var dlt_code = this.id;
        // alert(dlt_code);
        $.ajax({
            type: 'post',
            url: 'shift_delete',
            data: {'dlt_code': dlt_code, '_token': $('input[name="_token"]').val()},
            dataType: 'json',
            success: function (datam) {

                if (datam.status == 1) {
                    shift_details();
                    $.alert({
                        type: 'green',
                        icon: 'fa fa-check',
                        title: 'Success!!',
                        content: '<strong>SUCCESS:</strong> Shift Deleted Successfully.'
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
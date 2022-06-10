<?php $title='User Type'; ?>
@extends('layouts.master')
@section('content')
<div class="-intro-x breadcrumb mr-auto hidden sm:flex">
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
                <a href="">Application</a>
                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="breadcrumb__icon feather feather-chevron-right">
                <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
                <a href="" class="breadcrumb--active">User Type</a>
            </div>
            <div class="intro-x relative mr-3 sm:mr-6">
            <a href="add_user_type"><button type="button" class="btn btn-info">
            <span class="glyphicon glyphicon-search"></span>Add User Type
            </button></a>
        </div>
</div>
<div class=" mt-8 card shadow-lg p-3  bg-white rounded h-75">
            <div class=" items-center h-20">
              <h1 class="text-lg font-medium truncate mr-5"> List of User Type</h1>
            </div>
        <div class="card-body" style="background-color: white ;" >
                <div class="datatbl table-responsive">
                <table class="table table-striped table-bordered table-hover notice-types-table" id="user_type_details">
                    <thead>
                        <tr>
                            <th style="width: 10%;">Sl#</th>
                            <th style="width: 80%;">User Type</th>
                            <th style="width: 10%;">Action</th>
                        </tr>
                    </thead>
                </table>
                </div>
        </div>
</div>
{{csrf_field()}}
<script>
    $(function(){
        user_type_details();
    });
    function user_type_details() {
        $("#user_type_details").dataTable().fnDestroy();
        $("#user_type_details").dataTable({
            "processing": true,
            "serverSide": true,
            "dataType": "json",
            "ajax": {
                type: "post",
                url: "list_of_user_type",
                data: {'_token': '{{csrf_token()}}'},
                dataSrc: "record_details",
                // success:function (dataSrc) {
                //     console.log(dataSrc);
                // }
            },
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
                        "data": "type_name"
                    },
                    {
                        "targets": -1,
                        "data": "action",
                        "render": function(data, type, full, meta) {
                            //console.log(data);
                            var str_btn = "";
                            if(data.type_name == "Super Admin" || data.type_name == "Admin"){

                            } else {
                            str_btn+='<button type="submit" data-toggle="tooltip"  style="margin-left: 1px;font-size: 20px;" class="btn  btn-sm Small edit_data" id="' +data.e+ '" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i> </button> &nbsp;';
                           // str_btn+= '<button type="submit" data-toggle="tooltip" style="margin-left: 1px;font-size: 20px;" class="btn  btn-sm Small delete-button" id="' + data.d + '" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i> </button';
                            
                            }
                            return str_btn;
                        }
                    }

            ],
            "order": [[1, 'asc']]
        });
    }

    var table = $("#user_type_details").DataTable();
    table.on('draw.dt', function() {
        $(".edit_data").click(function() {
           var user_type_cd = this.id;
        //    alert(user_type_cd);
           var datas = {'user_type_cd': user_type_cd, '_token': $('input[name="_token"]').val()};
           redirectPost('{{url("user_type_edit")}}', datas);
        });
    });
</script>
@endsection
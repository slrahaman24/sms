<?php $title = 'Employee'; ?>
@extends('layouts.master')
@section('content')
<style>
     .equalDivide tr td { width:25%; }
</style>
   <div class="top-bar">
         <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="">Application</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="breadcrumb__icon feather feather-chevron-right">
               <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
            <a href="" class="breadcrumb--active">Security Personal ID Card Details</a>
         </div>
           <?php if(session()->get('per_add') == 1){  ?>
          <div class="intro-x relative mr-3 sm:mr-6">
       
        
     </div>
      <?php }  ?>
        
    </div>

        <div class=" mt-8 card shadow-lg p-3  bg-white rounded h-75">
           <div class=" items-center h-20">
              <h1 class="text-lg font-medium truncate mr-5"> Security Personal ID Card Details</h1>
            </div>

             <div class='row'>
                <!-- <div class="col-sm-4 form-group">
                {!! Form::label('emp_deparment','Department',['class'=>'font-weight-bold']) !!}
                {!! Form::select('emp_deparment',[''=>'Select Department'],null,['class' => 'form-control','id'=>'emp_deparment']); !!}
              </div>  -->
              <div class="col-sm-1">
              </div>
              <div class="col-sm-1 form-group">
                {!! Form::label('emp_designation','Designation',['class'=>'font-weight-bold required']) !!}
            </div>
                <div class="col-sm-4 form-group" style="margin-left: 20px;">
                {!! Form::select('emp_designation',[''=>'Select Designation'],null,['class' => 'form-control','id'=>'emp_designation']); !!}
              </div>
              <div class="col-sm-2 form-group " style="">
                {!! Form::button('Search',['class' => 'btn btn-primary' , 'id'=> 'search_employee']) !!}
              </div> 
              <div class="col-sm-2 form-group " style="">
                {!! Form::button('ID Card Generate',['class' => 'btn btn-primary' , 'id'=> 'id_generate']) !!}
              </div> 
               </div>
              

            <div class="card-body" style="background-color: white ;" >

           
            <div class="datatbl table-responsive">
                <table class="table table-striped table-bordered table-hover notice-types-table" id="tbl_employee">
                    <thead class="text-center">
                        <tr>
                            <th style="width: 3%;">SL#</th>
                            <th style="width: 5%;"><input type="checkbox" name="select-all" id="select-all" value="0" checked/></th>
                            <th style="width: 15%;">Name</th>
                            <th style="width: 10%;">Mobile No</th>
                            <th style="width: 10%;">Type</th>
                            <th style="width: 20%;">Designation</th>
                            <th style="width: 10%;">Profile Image</th>
                            <th style="width: 20%;">Address</th>
                        </tr>
                   </thead>
                    <tbody >
                    </tbody>
                </table> 
            </div> 
             
            </div>
        
     </div>
        {{csrf_field()}}
     <script type="text/javascript">
         
         $(function () { 
             employee_details();
             get_all_designation();
             get_all_department();

  $('#id_generate').on('click', function () {
    var selected = new Array();
    $("#tbl_employee input[type=checkbox]:checked").each(function () {
        if(this.value!=0){
          selected.push(this.value);
        }
    });
    if (selected.length > 0) {
        //alert(selected);
        var all_emp_array = selected;
        var datas = {'all_emp_array': all_emp_array, '_token': $('input[name="_token"]').val()};
        redirectPost('{{url("id_card_emp_generate")}}', datas);
        //redirectPost('{{url("salary_generate_pdf_report")}}', datas);
    }
        
  });
             
        });

         $("#search_employee").click(function(){

            employee_details();

         });
         

         $('#select-all').click(function(event) {   
            if(this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;                        
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;                       
                });
            }
        });
        
       function myFunction(){
           $('#select-all').prop('checked', false);
        }



       
         function employee_details(){

             var emp_deparment = $("#emp_deparment").val();
             var emp_designation = $("#emp_designation").val();
             
            $("#tbl_employee").dataTable().fnDestroy();
             var table =    $('#tbl_employee').dataTable({

                  "processing": true,
                  "serverSide": true,
                  "dom":'t',
                  "ajax": {
                url: "list_of_employee_id_card",
                type: "post",
                data: {emp_deparment:emp_deparment,emp_designation:emp_designation,'_token': $('input[name="_token"]').val()},
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
                            "data": "code",
                            "orderable": false,
                            "searchable": false,
                            "render": function (data, type, full, meta) {
                                        return '<input type="checkbox" value="'+data+'" class="source" value="'+data+'" onclick="myFunction()" checked>';
                                    }
                            
                        },
                      
                        {
                            "targets": 2,
                            "orderable": false,
                            "searchable": false,
                            "data": "emp_name",
                            
                        },
                        {
                            "targets": 3,
                            "orderable": false,
                            "searchable": false,
                            "data": "phno",
                            
                        },
                        {
                            "targets": 4,
                            "orderable": false,
                            "searchable": false,
                            "data": "emp_type",
                            
                        },
                        {
                            "targets": 5,
                            "orderable": false,
                            "searchable": false,
                            "data": "designation",
                            
                        },
                        {
                            "targets": 6,
                            "orderable": false,
                            "searchable": false,
                            "data": "profile_image",
                            
                        },
                       
                        {
                            "targets": 7,
                            "data": "c_address",
                            
                        },
                       

                        ],
                        "order": [[1, 'asc']]


         });



}

    var table = $('#tbl_employee').DataTable();
        table.on('draw.dt', function () {
            
            $('.edit_data').click(function () {
                var employee_code = this.id;
                var datas = {'employee_code': employee_code, '_token': $('input[name="_token"]').val()};
                redirectPost('{{url("employee_edit")}}', datas);
            });
             $('.delete-button').click(function () {

                var reply = confirm('Are you sure to delete the record?');
                if (!reply) {
                    return false;
                }
                var dlt_code = this.id;
                $('#loading').fadeIn();
                $.ajax({
                    type: 'post',
                    url: 'employee_delete',
                    data: {'dlt_code': dlt_code, '_token': $('input[name="_token"]').val()},
                    dataType: 'json',
                    success: function (datam) {
                        $('#loading').fadeOut();
                        if (datam.status == 1) {
                             employee_details();
                            $.alert({
                                type: 'green',
                                icon: 'fa fa-check',
                                title: 'Success!!',
                                content: '<strong>SUCCESS:</strong> Employee Deleted Successfully.',
                                boxWidth: '30%',
                                useBootstrap: false
                            });
                        } else {
                            $.alert({
                                type: 'red',
                                icon: 'fa fa-warning',
                                title: 'Error!!',
                                content: '<strong>UNSUCCESS:</strong> Failed to Delete Data.',
                                boxWidth: '30%',
                                useBootstrap: false
                            });
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        $('#loading').fadeOut();
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
                            content: msg,
                            boxWidth: '30%',
                            useBootstrap: false
                        });

                    }
                   
                });

            });

        $(".view_button").click(function() {
            var code = this.id;
            $.ajax({
                url: "view_employee_details",
                method: 'post',
                data: {
                    'code': code,
                    '_token': '{{csrf_token()}}',
                },
                success: function(data) {
                  // alert(data.p_date);
                    var str = "";
                     str += "<h5> Personal Details </h5>";
                     str += "<table class='table table-border table-sm equalDivide'>";
                     str += "<tr class='covid_view'><td class='covid_view'>Employee Name</td><td>" + data.empdlt.emp_name + "</td></tr>"
                     str += "<tr class='covid_view'><td class='covid_view'>Father's Name</td><td>" + data.empdlt.father_name + "</td></tr>"
                     str += "<tr class='covid_view'><td class='covid_view'>Mother's Name</td><td>" + data.empdlt.mother_name + "</td></tr>"
                     str += "<tr class='covid_view'><td class='covid_view'>Gender</td><td>" + data.empdlt.gender + "</td></tr>"
                     str += "<tr class='covid_view'><td class='covid_view'>Date of Birth</td><td>" + data.empdlt.dob + "</td></tr>"
                     str += "<tr class='covid_view'><td class='covid_view'>Blood Group</td><td>" + data.empdlt.blood_group + "</td></tr>"
                     str += "<tr class='covid_view'><td class='covid_view'>Merital Status</td><td>" + data.empdlt.marital_status + "</td></tr>"
                     if(data.empdlt.spouse_name != null){
                        str += "<tr class='covid_view'><td class='covid_view'>Spouse Name</td><td>" + data.empdlt.spouse_name + "</td></tr>"
                     }
                     if(data.empdlt.noofchildren != null){
                       str += "<tr class='covid_view'><td class='covid_view'>No of Children</td><td>" + data.empdlt.noofchildren + "</td></tr>"
                     }
                    str += "</table>";
                    str += "<h5> Contact Details </h5>";
                    str += "<table class='table table-border table-sm equalDivide'>";
                     var t1= data.empdlt.phno != null ? data.empdlt.phno :' ';
                     str += "<tr class='covid_view'><td class='covid_view'>Mobile Number</td><td>" + t1 + "</td></tr>"
                     var t2= data.empdlt.email != null ? data.empdlt.email :' ';
                     str += "<tr class='covid_view'><td class='covid_view'>Email ID</td><td>" + t2 + "</td></tr>"
                     var t3= data.empdlt.p_state != null ? data.empdlt.p_state :' ';
                     str += "<tr class='covid_view'><td class='covid_view'>Permanent State</td><td>" + t3 + "</td></tr>"
                     var t4= data.empdlt.p_dist != null ? data.empdlt.p_dist :' ';
                     str += "<tr class='covid_view'><td class='covid_view'>Permanent District</td><td>" + t4 + "</td></tr>"
                     var t5= data.empdlt.p_address != null ? data.empdlt.p_address :' ';
                     str += "<tr class='covid_view'><td class='covid_view'>Permanent Addtrss</td><td>" + t5 + "</td></tr>"
                     var t6= data.empdlt.p_pin != null ? data.empdlt.p_pin :' ';
                     str += "<tr class='covid_view'><td class='covid_view'>Permanent Pin</td><td>" + t6 + "</td></tr>"
                     var t7= data.empdlt.contact_person != null ? data.empdlt.contact_person :' ';
                     str += "<tr class='covid_view'><td class='covid_view'>Contact Person</td><td>" + t7 + "</td></tr>"
                     var t8= data.empdlt.relationship != null ? data.empdlt.relationship :' ';
                     str += "<tr class='covid_view'><td class='covid_view'>Relationship with Contact Person</td><td>" + t8 + "</td></tr>"
                     var t9= data.empdlt.emg_address != null ? data.empdlt.emg_address :' ';
                     str += "<tr class='covid_view'><td class='covid_view'>Emergency Address</td><td>" + t9 + "</td></tr>"
                     var t10= data.empdlt.emg_phno != null ? data.empdlt.emg_phno :' ';
                     str += "<tr class='covid_view'><td class='covid_view'>Emergency Mobile Number</td><td>" + t10 + "</td></tr>"



                    str += "</table>";

                    str += "<h5> Working Details </h5>";
                    str += "<table class='table table-border table-sm equalDivide'>";
                     var t11= data.empdlt.emp_type != null ? data.empdlt.emp_type :' ';
                     if(t11 == 1){
                         t11="Supervisor";
                     }else if(t11 == 2){
                        t11="Worker";
                     }
                     str += "<tr class='covid_view'><td class='covid_view'>Type</td><td>" + t11 + "</td></tr>"
                     var t12= data.empdlt.designation != null ? data.empdlt.designation :' ';
                     str += "<tr class='covid_view'><td class='covid_view'>Designation</td><td>" + t12 + "</td></tr>"
                     var t13= data.empdlt.department != null ? data.empdlt.department :' ';
                     str += "<tr class='covid_view'><td class='covid_view'>Department</td><td>" + t13 + "</td></tr>"
                     var t14= data.empdlt.joining_date != null ? data.empdlt.joining_date :' ';
                     str += "<tr class='covid_view'><td class='covid_view'>Joining Date</td><td>" + t14 + "</td></tr>"
                     var t15= data.empdlt.salary_per_day != null ? data.empdlt.salary_per_day :' ';
                     str += "<tr class='covid_view'><td class='covid_view'>Salary Per Day</td><td>" + t15 + "</td></tr>"

                    str += "</table>";
                     str += "<h5> Banking Details </h5>";

                     str += "<table class='table table-border table-sm equalDivide'>";
                     
                     var t16= data.empdlt.bank_name != null ? data.empdlt.bank_name :' ';
                     str += "<tr class='covid_view'><td class='covid_view'>Bank Name</td><td>" + t16 + "</td></tr>"
                     var t17= data.empdlt.branch_name != null ? data.empdlt.branch_name :' ';
                     str += "<tr class='covid_view'><td class='covid_view'>Branch Name</td><td>" + t17 + "</td></tr>"
                     var t18= data.empdlt.acc_no != null ? data.empdlt.acc_no :' ';
                     str += "<tr class='covid_view'><td class='covid_view'>Account No</td><td>" + t18 + "</td></tr>"
                     var t19= data.empdlt.ifsc_code != null ? data.empdlt.ifsc_code :' ';
                     str += "<tr class='covid_view'><td class='covid_view'>Salary Per Day</td><td>" + t19 + "</td></tr>"

                    str += "</table>";

                     str += "<h5> Salary Details </h5>";

                     str += "<table class='table table-border table-sm'>";
                       var i=0;
                       str+='<thead >';
                       str+='<tr>';
                       str+='<th style="width: 2%;">SL#</th>';
                       str+='<th style="width: 25%;">Allowance Type</th>';
                       str+='<th style="width: 25%;">Allowance Name</th>';
                       str+='<th style="width: 25%;">Salaty Type</th>';
                        str+='<th style="width: 23%;">Amount(Rs)</th>';
                       str+='</tr>';
                       str+='</thead>';
                        $.each(data.salary_details, function (key, value) {
                             
                                i=i+1;
                                str+='<tbody>';
                                str+='<tr>';
                                str+='<td>'+i+'</td>';
                                if(value.allowance_type == 1){
                                    var all_type= "ADDITION";
                                }else{
                                    var all_type= "DEDUCTION";
                                }
                                str+='<td>' + all_type + '</td>';
                                str+='<td>' + value.name_of_allowance + '</td>';

                                if(value.salary_type == 1){
                                    var sal_type= "Month Wise";
                                }else{
                                    var sal_type= "Day Wise";
                                }

                                str+='<td>' + sal_type +' </td>';
                                 str+='<td>' + value.amount +' </td>';
                               
                                str+='</tr>';
                                str+='</tbody>';
                    
                          
                             
                        });

                    str += "</table>";
                     


                    //var t1= data.case_state != null ? data.case_state :' ';
                  //  str += "<tr class='covid_view'><td class='covid_view'>Email</td><td>" + t1 + "</td></tr>"

                   // var t2= data.case_district != null ? data.case_district :' ';
                  //  str +="<tr class='covid_view'><td class='covid_view'>Case District</td><td>"+ t2 +"</td></tr>"

                    // if(data.case_district != null){
                    //     str += "<tr class='covid_view'><td class='covid_view'>Case District</td><td>" + data.case_district+ "</td></tr>"
                    // }else{
                    //     str += "<tr class='covid_view'><td class='covid_view'>Case District</td><td> </td></tr>"
                    // }
 
                    
                   
                    $.confirm({
                                    title: 'Employee Details',
                                    type: 'blue',
                                    content: str,
                                    boxHeight: '100%',
                                    boxWidth: '50%',
                                    useBootstrap: false,
                                    buttons:{
                                        OK:function(){

                                             }
                                    }


                                });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#loading').fadeOut();
                    var msg = "";
                    if (jqXHR.status !== 422 && jqXHR.status !== 400) {
                        msg += "<strong>" + jqXHR.status + ": " + errorThrown + "</strong>";
                    } else {
                        if (jqXHR.responseJSON.hasOwnProperty('exception')) {
                            if (jqXHR.responseJSON.exception_code == 23000) {
                                msg += "Some Sql Exception Occured";
                            } else {
                                msg += "Exception: <strong>" + jqXHR.responseJSON.exception_message + "</strong>";
                            }
                        } else {
                            msg += "Error(s):<strong><ul>";
                            $.each(jqXHR.responseJSON['errors'], function(key, value) {
                                msg += "<li>" + value + "</li>";
                            });
                            msg += "</ul></strong>";
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

                },
            });
        });

     });

  function  get_all_designation(){

            var token = $("input[name='_token']").val();
            $.ajax({
              type: "post",
              url: "get_all_designation",
              data:{_token:'{{csrf_token()}}'},
              dataType: 'json',
              success: function (data) {
              
                $('#emp_designation').html('<option value=""> Select Designation </option>');
                $.each(data.options, function (key, value) {
                
                    $("#emp_designation").append('<option value=' + key + '>' + value + '</option>');
                  
                });

              }


            });


         }

           function  get_all_department(){

            var token = $("input[name='_token']").val();
            $.ajax({
              type: "post",
              url: "get_all_department",
              data:{_token:'{{csrf_token()}}'},
              dataType: 'json',
              success: function (data) {
              
                $('#emp_deparment').html('<option value=""> Select Department </option>');
                $.each(data.options, function (key, value) {
                
                    $("#emp_deparment").append('<option value=' + key + '>' + value + '</option>');
                  
                });

              }

            });


         }

     </script>


                      
  
@stop
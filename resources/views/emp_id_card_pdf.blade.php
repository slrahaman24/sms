<html>
    <head>Employee ID Card</head>
<style>
 html {
    font-family: sans-serif;
    -webkit-text-size-adjust: 100%;
    -ms-text-size-adjust: 100%;
}
.CollegeName{
    text-align: center;
    font-size: 22px;
    font-family: Impact, fantasy;
    color: #0088cc;
    font-weight: normal;
    letter-spacing: 5px;
    margin-top: 7px;
}
.activities_box{
    width: 500px;
    border: 1px solid #cccccc;
    display: inline-block;
   /* padding: 4px 6px;*/
    margin-bottom: 8px;
    margin-right: 3px;
    font-size: 13.5px;
    line-height: 20px;
    color: #555555;
    background-color: #F0F0F0;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    vertical-align: middle;
}  
.activities_box .activebar{
    border: 1px solid #0088cc;
    height: 18px;
    background-color: #0088cc;
    color: #cccc00;
    font-style: italic;
    font-weight: bold;
    padding: 3px 4px;
    font-size: 16px;
    text-align: center;
}
.activities_box .activeTophead{
    height: 6px;
    background-color: #a6e1ec;
    color: #cccc00;
}
.activities_box .activehead{
    height: 132px;
    background-color: #F0F0F0;
    color: #fcff98;  
}
.activities_left_head{
    width: 95px;
    margin-top: 5px;
    display: inline-block;
}
.activities_right_head{
    width: 290px;
    display: inline-block;
    line-height: 16px;
    margin-top: 0px;
    margin-bottom: 1px;
}
.activities_left_head2{
    width: 95px;
    
    display: inline-block;
}

.qr-code {
      max-width: 90px;
    }

.activities_left_box{
   
    display: inline-block;
    padding-left: 9px;
    margin-top: 1px;
    margin-bottom: 3px;
   
}
.activities_left_box_text{
     width: 344px;
     font-size: 11.5px;
     line-height: 18px;
     font-weight: bold;
     text-transform: uppercase;
}
.activities_right_box{
    width: 143px;
    display: inline-block;
    margin-top: 1px;
}
.col_img{
    width: 80%;
    height: 70%;
    z-index: 1000;
    margin-left: 7%;
    margin-top: 5%;
    margin-bottom: 5%;
    position: inherit;  
    border: 1px solid #000;
    background: #000;
    padding: 1px;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
}
.icard_img {
    width: 65%;
    height: 60%;
    background: #000;
    margin-left: 10%;
    z-index: 1000;
    position: inherit;  
    border: 1px solid #000;
    padding: 1px;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
}
.icard_sig {
    width: 90%;
    height: 25%;
    background: #000;
    z-index: 1000;
    position: inherit;
    margin-top: 1px;
    border: 1px solid #000;
    padding: 1px;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
}
.icard_auth_sig{
     width: 142px;
    height: 50px;
    background: #000;
    z-index: 1000;
    position: inherit;
    margin-top: 1px;
    border: 1px solid #000;
    padding: 1px;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
}
.auth_sig{
   font-size: 14px;
   color: #0088cc;
   font-weight: bold;
}
.govts{
    margin-top: 2px;
    text-align: center;
    font-size: 11.5px;
    font-weight: bold;
    color: #0066cc;
}
.smsline{
    text-align: center;
    font-size: 16px;
    color: #000099;
    font-weight: bold;
    margin-top: -1px;
    letter-spacing: .5px;
}
.smsline1{
    text-align: center;
    font-size: 12px;
    color: #000066;
    font-weight: bold;
    margin-top: 0px;
}
.smsline2{
    text-align: center;
    font-size: 12px;
    color: #F0F0F0;
    font-weight: bold;
    margin-top: 6px;
    background-color: #ff0000;
    width: 44%;
    margin-left: 27%;
}
    </style>
  
  
  
    <body>
       
       <table width="100%">
         
       <?php
       
       if($filtered_count>0)
       {
         $i=0;
        foreach($table_data as $res)
        { 
            
            //echo $res->emp_name;die;


          if($i%2=="0")
          {
              echo "<tr>";
          }
          $i++;
         
          //$last_year=($res['AcademicYear']+1);
          //$last_ac=$last_year;
          $last_ac='';        ?>            
            <td width="50%">
                <div class="activities_box">
                  <div class="activeTophead"></div>
                    <div class="activehead" class="col-sm-12">
                            <div class="activities_left_head" style="margin-top:5px;" >
                                    @if(!empty($res->profile_image))
                                    <img src="{{'uploads/image/'.$res->profile_image}}" style="width:100px;hight:80px;"/></br>
                                    @else
                                    <img src="images/demo_profile.jpg" style="width:100px;hight:80px;"/></br>
                                    @endif
                            </div>
                            <div class="activities_right_head" >
                                <div class="CollegeName">S.R.M.</div>
                                <div class="govts">(BIRBHUM,WEST BENGAL)</div>
                                <div class="smsline2">IDENTITY CARD</div>
                                <div class="govts">2021</div>
                            </div>
                            <div class="activities_left_head2" >     
                                 <img src="https://chart.googleapis.com/chart?cht=qr&chl={{$res->emp_id}}&chs=160x160&chld=L|0" class="qr-code img-thumbnail img-responsive" />
                            </div>
                        <div style="clear: both"></div>
                    </div>
                    <div class="activities_left_box">
                     <div class="activities_left_box_text">
                     <span class="auth_sig">Name : </span>{{$res->emp_name}}<br>
                     <span class="auth_sig">Designation : </span>{{$res->designation}}<br>
                     <span class="auth_sig">Phone No : </span>{{$res->phno}}<br>
                     <span class="auth_sig">Address : </span>{{$res->c_address}}<br><br>
                    </div>
                    
                  </div>
                 
                  
                  <div style="clear: both"></div>
                </div>
            </td>
       <?php
          if($i%2=="0")
          {
              echo "</tr>";
          }        
        }        
      } ?>
             </tr>
             <td style="font-weight:bold; font-size:15px; text-align:center"> 
            
             </td>
            </tr>
      </table>        
    </body>
</html> 
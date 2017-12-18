<?php
session_start();
if(!isset($_SESSION['level']) || !isset($_SESSION['fname']) || !isset($_SESSION['lname']) || !isset($_SESSION['id']))
{
    die('กรุณา Login ใหม่');
}
require_once('../../application/class/person.php');
$prefixobj = new Person();
$prefix = $prefixobj->Get_All_Prefix();

require_once('../../application/class/manage_deadline.php');
$dlobj = new Deadline();
$dlspcl = $dlobj->Search_all(3);
$current = $dlobj->Get_Current_Semester();

require_once('../../application/class/course.php');
$courseobj = new Course();
$dept = $courseobj->Get_Dept_All();

 ?>

<html>
<header>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="description" content="">
 <meta name="author" content="">

 <!-- Bootstrap Core CSS -->
 <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 <!-- MetisMenu CSS -->
 <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
 <!-- Custom CSS -->
 <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
 <!-- Morris Charts CSS -->
 <link href="../vendor/morrisjs/morris.css" rel="stylesheet">
 <!-- Custom Fonts -->
 <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
 <script src="../vendor/jquery/jquery.min.js"></script>
 <!-- Bootstrap Core JavaScript -->
 <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
 <!-- Metis Menu Plugin JavaScript -->
 <script src="../vendor/metisMenu/metisMenu.min.js"></script>
 <!-- Custom Theme JavaScript -->
 <script src="../dist/js/sb-admin-2.js"></script>

 <script type="text/javascript" src="../dist/js/bootstrap-filestyle.min.js"></script>

 <link rel="stylesheet" href="../dist/css/scrollbar.css">
 <script src="../dist/js/sweetalert2.min.js"></script>
 <script src="../vendor/webshim/1.15.3/modernizr-custom.js"></script>
 <!-- polyfiller file to detect and load polyfills -->
 <script src="../vendor/webshim/1.15.3/js-webshim/minified/polyfiller.js"></script>
<!-- Include a polyfill for ES6 Promises (optional) for IE11 and Android browser -->
<script src="../vendor/webshim/1.15.3/core.js"></script>
 <link rel="stylesheet" href="../dist/css/sweetalert2.min.css">

 <link href="../dist/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
 <script src="../dist/js/moment.min.js"></script>
 <script src="../dist/js/bootstrap-datetimepicker.min.js"></script>


 <style>
 input[type=text],input[type=date],input[type=time]{
   font-weight:normal;
   height: 30px;
 }

 input[type=number]{
   height: 30px;
 }
.formlength{
  width: auto !important;
}
input[type=radio]{
  position: static!important;
  margin-left: 0px!important;
}
table { width: auto !important; }

.textareawidth{
  width: 70%;
  resize: none;
}


li {
    list-style-type: none;
}


 </style>

 <script>

 window.sumcheck = 0;
 function setdatepicker(){
   webshims.setOptions('forms-ext', {types: 'date'});
   webshims.polyfill('forms forms-ext');
}

function downloadfunc(){
  var link = $('#spanfile').text();
  window.open("../../files/cv/"+link);
}

 function searchname1() {

       var name_s = $("#search_1").val();
       $("#dtl1").html('');
       if(name_s.length > 1)
       {
         $.post("search_special_instructor.php", { name: name_s}, function(data) {
               data = JSON.parse( data );
               for(var i=0;i<data.length;i++)
               {
                   $("#dtl1").append('<option value="'+data[i]+'"></option>');
               }

             })
             .fail(function() {
                 alert("error");
             });
       }
}
 // Charecter fixed
 $(function() {//<-- wrapped here
   $('.numonly').on('input', function() {
     this.value = this.value.replace(/[^0-9.]/g, ''); //<-- replace all other than given set of values
   });
   $('.charonly').on('input', function() {
     this.value = this.value.replace(/[^a-zA-Zก-ฮๅภถุึคตจขชๆไำพะัีรนยบลฃฟหกดเ้่าสวงผปแอิืทมใฝ๑๒๓๔ู฿๕๖๗๘๙๐ฎฑธํ๊ณฯญฐฅฤฆฏโฌ็๋ษศซฉฮฺ์ฒฬฦ.]/g, ''); //<-- replace all other than given set of values
   });
 });

 function getinfo(temp) {
   //part1
   document.getElementById('department').value = temp["department"];


   document.getElementById('pre').value = temp['prefix'];
   var constring = temp['firstname'];
   var constring2 = temp['lastname'];
   document.getElementById('fname').value = constring;
   document.getElementById('lname').value = constring2;
   document.getElementById('position').value = temp['position'];
   document.getElementById('qualification').value = temp['qualification'];
   document.getElementById('workplace').value = temp['work_place'];
   document.getElementById('tel').value = temp['phone'];
   document.getElementById('subtel').value = temp['phone_sub'];
   document.getElementById('mobile').value = temp['phone_mobile'];
   document.getElementById('email').value = temp['email'];
   //var choice1 = temp['TEACHERDATA']['HISTORY'];
   if(temp['invited']=='1')
   {
     $('input[name="topic"][value="already"]').prop('checked', true);
   }else {
     $('input[name="topic"][value="yet"]').prop('checked', true);
   }

   if(document.querySelector("input[name='topic']:checked").value=="already")
     {
       $('#course').attr('readonly', true);
     }
     else {
       $('#course').attr('readonly', false);
     }


   //part2
   document.getElementById('course').value = temp['course_id'];

   document.getElementById('numstudent').value = temp['num_student'];
   var choice2 = temp['type_course'];
   $('input[name="type_course"][value=' + choice2 + ']').prop('checked', true);
   document.getElementById('reason').value = temp['reason'];
   document.getElementById('hour').value = temp['percent_hour'];
   //table

   for(var tr=1;tr<=temp['num_table'];tr++)
   {
     var table = $('#detailteaching').closest('table');
     if (table.find('input:text').length < 100) {
       var x = $("tr[name=addtr]:last").closest('tr').nextAll('tr');
       var rowCount = $('#detailteaching tr').length;
       $.each(x, function(i, val) {
         val.remove();
       });
       table.append('<tr class="warning" name="addtr" id="row' + tr + '"><td colspan="2"><div class="form-inline"><input type="text" class="form-control formlength" name="detail_topic' + tr + '" id="detail_topic' + tr +
         '" size="30" value="'+temp["lecture_detail"][tr-1]["topic_name"]+'"><br><center><input type="button" class="btn btn-outline btn-danger" name="delbtn' + tr + '" id="delbtn' + tr +
           '" value="ลบ" onclick="deleteRow(' + tr + ')"></center></div></td><td><input type="text" class="form-control formlength" name="dateteach' + tr + '" id="dateteach' + tr +
         '" value="'+temp["lecture_detail"][tr-1]["teaching_date"]+'"></td><td width="25%" style="text-align: center;"><div class="form-inline">' +
         '<select class="form-control formlength timeselected" onfocus="this.size=5;" onblur="this.size=1;" onchange="this.size=1; this.blur();" name="timebegin' + tr + '" id="timebegin' + tr + '">'+
         '<option value="00:00:00" selected="selected">00:00 น.</option><option value="00:15:00">00:15 น.</option>' +
         '<option value="00:30:00">00:30 น.</option><option value="00:45:00">00:45 น.</option>' +
         '<option value="01:00:00">01:00 น.</option><option value="01:15:00">01:15 น.</option>' +
         '<option value="01:30:00">01:30 น.</option><option value="01:45:00">01:45 น.</option>' +
         '<option value="02:00:00">02:00 น.</option><option value="02:15:00">02:15 น.</option>' +
         '<option value="02:30:00">02:30 น.</option><option value="02:45:00">02:45 น.</option>' +
         '<option value="03:00:00">03:00 น.</option><option value="03:15:00">03:15 น.</option>' +
         '<option value="03:30:00">03:30 น.</option><option value="03:45:00">03:45 น.</option>' +
         '<option value="04:00:00">04:00 น.</option><option value="04:15:00">04:15 น.</option>' +
         '<option value="04:30:00">04:30 น.</option><option value="04:45:00">04:45 น.</option>' +
         '<option value="05:00:00">05:00 น.</option><option value="05:15:00">05:15 น.</option>' +
         '<option value="05:30:00">05:30 น.</option><option value="05:45:00">05:45 น.</option>' +
         '<option value="06:00:00">06:00 น.</option><option value="06:15:00">06:15 น.</option>' +
         '<option value="06:30:00">06:30 น.</option><option value="06:45:00">06:45 น.</option>' +
         '<option value="07:00:00">07:00 น.</option><option value="07:15:00">07:15 น.</option>' +
         '<option value="07:30:00">07:30 น.</option><option value="07:45:00">07:45 น.</option>' +
         '<option value="08:00:00">08:00 น.</option><option value="08:15:00">08:15 น.</option>' +
         '<option value="08:30:00">08:30 น.</option><option value="08:45:00">08:45 น.</option>' +
         '<option value="09:00:00">09:00 น.</option><option value="09:15:00">09:15 น.</option>' +
         '<option value="09:30:00">09:30 น.</option><option value="09:45:00">09:45 น.</option>' +
         '<option value="10:00:00">10:00 น.</option><option value="10:15:00">10:15 น.</option>' +
         '<option value="10:30:00">10:30 น.</option><option value="10:45:00">10:45 น.</option>' +
         '<option value="11:00:00">11:00 น.</option><option value="11:15:00">11:15 น.</option>' +
         '<option value="11:30:00">11:30 น.</option><option value="11:45:00">11:45 น.</option>' +
         '<option value="12:00:00">12:00 น.</option><option value="12:15:00">12:15 น.</option>' +
         '<option value="12:30:00">12:30 น.</option><option value="12:45:00">12:45 น.</option>' +
         '<option value="13:00:00">13:00 น.</option><option value="13:15:00">13:15 น.</option>' +
         '<option value="13:30:00">13:30 น.</option><option value="13:45:00">13:45 น.</option>' +
         '<option value="14:00:00">14:00 น.</option><option value="14:15:00">14:15 น.</option>' +
         '<option value="14:30:00">14:30 น.</option><option value="14:45:00">14:45 น.</option>' +
         '<option value="15:00:00">15:00 น.</option><option value="15:15:00">15:15 น.</option>' +
         '<option value="15:30:00">15:30 น.</option><option value="15:45:00">15:45 น.</option>' +
         '<option value="16:00:00">16:00 น.</option><option value="16:15:00">16:15 น.</option>' +
         '<option value="16:30:00">16:30 น.</option><option value="16:45:00">16:45 น.</option>' +
         '<option value="17:00:00">17:00 น.</option><option value="17:15:00">17:15 น.</option>' +
         '<option value="17:30:00">17:30 น.</option><option value="17:45:00">17:45 น.</option>' +
         '<option value="18:00:00">18:00 น.</option><option value="18:15:00">18:15 น.</option>' +
         '<option value="18:30:00">18:30 น.</option><option value="18:45:00">18:45 น.</option>' +
         '<option value="19:00:00">19:00 น.</option><option value="19:15:00">19:15 น.</option>' +
         '<option value="19:30:00">19:30 น.</option><option value="19:45:00">19:45 น.</option>' +
         '<option value="20:00:00">20:00 น.</option><option value="20:15:00">20:15 น.</option>' +
         '<option value="20:30:00">20:30 น.</option><option value="20:45:00">20:45 น.</option>' +
         '<option value="21:00:00">21:00 น.</option><option value="21:15:00">21:15 น.</option>' +
         '<option value="21:30:00">21:30 น.</option><option value="21:45:00">21:45 น.</option>' +
         '<option value="22:00:00">22:00 น.</option><option value="22:15:00">22:15 น.</option>' +
         '<option value="22:30:00">22:30 น.</option><option value="22:45:00">22:45 น.</option>' +
         '<option value="23:00:00">23:00 น.</option><option value="23:15:00">23:15 น.</option>' +
         '<option value="23:30:00">23:30 น.</option><option value="23:45:00">23:45 น.</option>' +
         '<option value="24:00:00">24:00 น.</option><option value="24:15:00">24:15 น.</option>' +
         '<option value="24:30:00">24:30 น.</option><option value="24:45:00">24:45 น.</option></select>' +
         ' <br> ถึง <br> '+
         '<select class="form-control formlength timeselected2" onfocus="this.size=5;" onblur="this.size=1;" onchange="this.size=1; this.blur();" name="timeend'+ tr + '" id="timeend' + tr + '">'+
         '<option value="00:00:00">00:00 น.</option><option value="00:15:00">00:15 น.</option>' +
         '<option value="00:30:00">00:30 น.</option><option value="00:45:00">00:45 น.</option>' +
         '<option value="01:00:00">01:00 น.</option><option value="01:15:00">01:15 น.</option>' +
         '<option value="01:30:00">01:30 น.</option><option value="01:45:00">01:45 น.</option>' +
         '<option value="02:00:00">02:00 น.</option><option value="02:15:00">02:15 น.</option>' +
         '<option value="02:30:00">02:30 น.</option><option value="02:45:00">02:45 น.</option>' +
         '<option value="03:00:00">03:00 น.</option><option value="03:15:00">03:15 น.</option>' +
         '<option value="03:30:00">03:30 น.</option><option value="03:45:00">03:45 น.</option>' +
         '<option value="04:00:00">04:00 น.</option><option value="04:15:00">04:15 น.</option>' +
         '<option value="04:30:00">04:30 น.</option><option value="04:45:00">04:45 น.</option>' +
         '<option value="05:00:00">05:00 น.</option><option value="05:15:00">05:15 น.</option>' +
         '<option value="05:30:00">05:30 น.</option><option value="05:45:00">05:45 น.</option>' +
         '<option value="06:00:00">06:00 น.</option><option value="06:15:00">06:15 น.</option>' +
         '<option value="06:30:00">06:30 น.</option><option value="06:45:00">06:45 น.</option>' +
         '<option value="07:00:00">07:00 น.</option><option value="07:15:00">07:15 น.</option>' +
         '<option value="07:30:00">07:30 น.</option><option value="07:45:00">07:45 น.</option>' +
         '<option value="08:00:00">08:00 น.</option><option value="08:15:00">08:15 น.</option>' +
         '<option value="08:30:00">08:30 น.</option><option value="08:45:00">08:45 น.</option>' +
         '<option value="09:00:00">09:00 น.</option><option value="09:15:00">09:15 น.</option>' +
         '<option value="09:30:00">09:30 น.</option><option value="09:45:00">09:45 น.</option>' +
         '<option value="10:00:00">10:00 น.</option><option value="10:15:00">10:15 น.</option>' +
         '<option value="10:30:00">10:30 น.</option><option value="10:45:00">10:45 น.</option>' +
         '<option value="11:00:00">11:00 น.</option><option value="11:15:00">11:15 น.</option>' +
         '<option value="11:30:00">11:30 น.</option><option value="11:45:00">11:45 น.</option>' +
         '<option value="12:00:00">12:00 น.</option><option value="12:15:00">12:15 น.</option>' +
         '<option value="12:30:00">12:30 น.</option><option value="12:45:00">12:45 น.</option>' +
         '<option value="13:00:00">13:00 น.</option><option value="13:15:00">13:15 น.</option>' +
         '<option value="13:30:00">13:30 น.</option><option value="13:45:00">13:45 น.</option>' +
         '<option value="14:00:00">14:00 น.</option><option value="14:15:00">14:15 น.</option>' +
         '<option value="14:30:00">14:30 น.</option><option value="14:45:00">14:45 น.</option>' +
         '<option value="15:00:00">15:00 น.</option><option value="15:15:00">15:15 น.</option>' +
         '<option value="15:30:00">15:30 น.</option><option value="15:45:00">15:45 น.</option>' +
         '<option value="16:00:00">16:00 น.</option><option value="16:15:00">16:15 น.</option>' +
         '<option value="16:30:00">16:30 น.</option><option value="16:45:00">16:45 น.</option>' +
         '<option value="17:00:00">17:00 น.</option><option value="17:15:00">17:15 น.</option>' +
         '<option value="17:30:00">17:30 น.</option><option value="17:45:00">17:45 น.</option>' +
         '<option value="18:00:00">18:00 น.</option><option value="18:15:00">18:15 น.</option>' +
         '<option value="18:30:00">18:30 น.</option><option value="18:45:00">18:45 น.</option>' +
         '<option value="19:00:00">19:00 น.</option><option value="19:15:00">19:15 น.</option>' +
         '<option value="19:30:00">19:30 น.</option><option value="19:45:00">19:45 น.</option>' +
         '<option value="20:00:00">20:00 น.</option><option value="20:15:00">20:15 น.</option>' +
         '<option value="20:30:00">20:30 น.</option><option value="20:45:00">20:45 น.</option>' +
         '<option value="21:00:00">21:00 น.</option><option value="21:15:00">21:15 น.</option>' +
         '<option value="21:30:00">21:30 น.</option><option value="21:45:00">21:45 น.</option>' +
         '<option value="22:00:00">22:00 น.</option><option value="22:15:00">22:15 น.</option>' +
         '<option value="22:30:00">22:30 น.</option><option value="22:45:00">22:45 น.</option>' +
         '<option value="23:00:00">23:00 น.</option><option value="23:15:00">23:15 น.</option>' +
         '<option value="23:30:00">23:30 น.</option><option value="23:45:00">23:45 น.</option>' +
         '<option value="24:00:00">24:00 น.</option><option value="24:15:00">24:15 น.</option>' +
         '<option value="24:30:00">24:30 น.</option><option value="24:45:00">24:45 น.</option></select>' +
         '</div></td><td><input type="text" class="form-control formlength" id="room' + tr + '" value="'+temp["lecture_detail"][tr-1]["teaching_room"]+
          '"></td></tr>');
          $('#dateteach'+(rowCount - 1)).datetimepicker({
             format: 'YYYY-MM-DD'
          });
          $('#timebegin'+tr+'  option[value="'+temp["lecture_detail"][tr-1]["teaching_time_start"]+'"]').prop("selected", true);
          $('#timeend'+tr+'  option[value="'+temp["lecture_detail"][tr-1]["teaching_time_end"]+'"]').prop("selected", true);
       $.each(x, function(i, val) {
         table.append(val);
       });
     }
   }


   //part3

   var choice33 = temp['payment_method'];
   if(choice33 == 1)
   {
     $('input[name="paymethod"][value="1"]').prop('checked', true);
     $('#costhide').show();
   }
   else {
     $('input[name="paymethod"][value="0"]').prop('checked', true);
     $('#costhide').hide();
   }

   var choice3 = temp['level_teacher'];
   if(choice3 == "official")
   {
     choice3 = "pro";
   }
   else {
     choice3 = "norm";
   }
   $('input[name="levelteacher"][value=' + choice3 + ']').prop('checked', true);
   if(choice3=="pro")
   {
     document.getElementById('GOV_LEVEL').value = temp['level_descript'];
   }else {
     document.getElementById('NORM_LEVEL').value = temp['level_descript'];
   }

   var choice4 = temp['expense_lec_checked'];
   if(choice4==1)
   {
     $('#costspec1').prop('checked', true);
   }

   document.getElementById('choice1num').value = temp['expense_lec_number'];
   document.getElementById('choice1hour').value = temp['expense_lec_hour'];
   document.getElementById('choice1cost').value = temp['expense_lec_cost'];

   var choice44 = temp['expense_lab_checked'];
   if(choice44==1)
   {
     $('#costspec2').prop('checked', true);
   }

   document.getElementById('choice2num').value = temp['expense_lab_number'];
   document.getElementById('choice2hour').value = temp['expense_lab_hour'];
   document.getElementById('choice2cost').value = temp['expense_lab_cost'];


   if(temp['expense_plane_check'] == 1)
   {
     document.getElementById('transplane').checked = true;
     document.getElementById('AIR_DEPART').value = temp['expense_plane_depart'];
     document.getElementById('AIR_ARRIVE').value = temp['expense_plane_arrive'];
     document.getElementById('planecost').value = temp['expense_plane_cost'];
   }

   if(temp['expense_taxi_check'] == 1)
   {
     document.getElementById('transtaxi').checked = true;
     document.getElementById('TAXI_DEPART').value = temp['expense_taxi_depart'];
     document.getElementById('TAXI_ARRIVE').value = temp['expense_taxi_arrive'];
     document.getElementById('taxicost').value = temp['expense_taxi_cost'];
   }

   if(temp['expense_car_check'] == 1)
   {
     document.getElementById('transselfcar').checked = true;
     document.getElementById('SELF_DISTANCT').value = temp['expense_car_distance'];
     document.getElementById('selfunit').value = temp['expense_car_unit'];
     document.getElementById('selfcost').value = temp['expense_car_cost'];
   }

   var choice5 = temp['expense_hotel_choice'];
   if(choice5 == 1)
   {
     choice5 = "way1";
   }else if (choice5 == 2) {
     choice5 = "way2";
   }else{
     choice5 = "way3"
   }
   $('input[name="hotelchoice"][value=' + choice5 + ']').prop('checked', true);
   if(choice5=="way3")
   {
     document.getElementById('numnight').value = temp['expense_hotel_number'];
     document.getElementById('pernight').value = temp['expense_hotel_cost'];
   }else if (choice5=="way1") {
     document.getElementById('way1unit').value = temp['expense_hotel_per_night'];
     document.getElementById('numnight').value = temp['expense_hotel_number'];
     document.getElementById('pernight').value = temp['expense_hotel_cost'];
   }else {
     document.getElementById('way2unit').value = temp['expense_hotel_per_night'];
     document.getElementById('numnight').value = temp['expense_hotel_number'];
     document.getElementById('pernight').value = temp['expense_hotel_cost'];
   }
   document.getElementById('totalcost').value = temp['cost_total'];
   $('#callist').show();

   //cv
   if(temp['cv']!=false)
   {
     $('#submitbtn2').show();
     $('#submitbtn').hide();
     $('#spanfile').text(temp['cv']);
     $('#downloadfile').show();
   }else {
     $('#submitbtn2').hide();
     $('#submitbtn').show();
     $('#spanfile').text("");
     $('#downloadfile').hide();
   }


   //buttondiv
   if(temp['ACCESS'] == true)
   {
     $('#buttondiv').show();
   }else {
     $('#buttondiv').hide();
   }

 }

 function getinfo2(temp) {

   //part1
   document.getElementById('pre').value = temp['prefix'];
   var constring = temp['firstname'];
   var constring2 = temp['lastname'];
   document.getElementById('fname').value = constring;
   document.getElementById('lname').value = constring2;
   document.getElementById('position').value = temp['position'];
   document.getElementById('qualification').value = temp['qualification'];
   document.getElementById('workplace').value = temp['work_place'];
   document.getElementById('tel').value = temp['phone'];
   document.getElementById('subtel').value = temp['phone_sub'];
   document.getElementById('mobile').value = temp['phone_mobile'];
   document.getElementById('email').value = temp['email'];
   //var choice1 = temp['TEACHERDATA']['HISTORY'];
   if(temp['invited']=="1")
   {
     $('input[name="topic"][value="already"]').prop('checked', true);
   }else {
     $('input[name="topic"][value="yet"]').prop('checked', true);
   }
   if(document.querySelector("input[name='topic']:checked").value=="already")
     {
       $('#course').attr('readonly', true);
     }
     else {
       $('#course').attr('readonly', false);
     }

     if(temp['cv']!=false)
     {
       $('#submitbtn2').show();
       $('#submitbtn').hide();
       $('#spanfile').text(temp['cv']);
       $('#downloadfile').show();
     }else {
       $('#submitbtn2').hide();
       $('#submitbtn').show();
       $('#spanfile').text("");
       $('#downloadfile').hide();
     }
}

 function checksubject(btntype,type){

   if(btntype==1)
   {
     $('#dlhide,#search_1hide').hide();
     document.getElementById("form1").reset();
     var file_data = new FormData;
     var course_id = document.getElementById('id').value;
     JSON.stringify(course_id);
     JSON.stringify(type);
     file_data.append("course_id",course_id);
     file_data.append("type",type);
     var URL = '../../application/document/search_document.php';
     $.ajax({
                   url: URL,
                   dataType: 'text',
                   cache: false,
                   contentType: false,
                   processData: false,
                   data: file_data,
                   type: 'post',
                   success: function (result) {
                         try {
                           var temp = $.parseJSON(result);
                           var rowtr = ($('#detailteaching tr').length)-2
                           for (var i = 1; i <=rowtr; i++) {
                             var row = document.getElementById('row' + i);
                             row.parentNode.removeChild(row);
                           }

                           var course_id = document.getElementById('id').value;
                           //cleardatalist
                           var selectobject = document.getElementById('teachername');
                           var long = selectobject.length;
                           if(long!=0 && long!=null)
                           {
                             for (var i=0; i<=long; i++){
                               document.getElementsByName("teachername")[0].remove(0);
                             }
                           }

                           if(temp['ACCESS'] == true)
                           {
                             $('#buttondiv').show();
                             if(temp['DATA']!=false && temp['INFO']!=false)
                             {
                               $('#teachername').prop('disabled', false);
                               $('#subhead').prop('disabled', false);
                               $('#hiddenh5').hide();
                               $('#hiddenh5_found').show();
                               $('#hiddenh5_found').html("กระบวนวิชา "+temp['INFO'].course_name_th+" ("+temp['INFO'].course_id+")");
                               $('#notfound').hide();
                               $('#department').val(temp['INFO'].department);

                                  $('#numstudent').val(parseInt(temp['INFO'].num_student));
                               var course_id = document.getElementById('id').value;
                               document.getElementById('formdrpd').style.display = "";
                               //cleardatalist
                               var selectobject = document.getElementById('teachername');
                               var long = selectobject.length;
                               if(long!=0 && long!=null)
                               {
                                 for (var i=0; i<=long; i++){
                                   document.getElementsByName("teachername")[0].remove(0);
                                 }
                               }

                               for(var i=0;i<(Object.keys(temp['DATA']).length);i++)
                               {
                                 var opt = document.createElement('option');
                                 opt.value = temp['DATA'][i].id +"_"+ temp['DATA'][i].name + "_" + temp['INFO']['course_id'] +"_"+ temp['DATA'][i].semester + "_" + temp['DATA'][i].year;
                                 opt.innerHTML = "คุณ"+temp['DATA'][i].name;
                                 document.getElementById('teachername').appendChild(opt);
                               }
                               $('#department').val(temp['INFO'].department);

                               $('#numstudent').val(parseInt(temp['INFO'].num_student));
                             }else if(temp['DATA']==false && temp['INFO']!=false){
                               $('#hiddenh5_found').show();
                               $('#hiddenh5_found').html("กระบวนวิชา "+temp['INFO'].course_name_th+" ("+temp['INFO'].course_id+")");
                               $('#hiddenh5').hide();
                               $('#notfound').show();
                               $('#department').val(temp['INFO'].department);

                               $('#numstudent').val(parseInt(temp['INFO'].num_student));
                               var course_id = document.getElementById('id').value;
                               document.getElementById('formdrpd').style.display = "";
                               //cleardatalist
                               var selectobject = document.getElementById('teachername');
                               var long = selectobject.length;
                               if(long!=0 && long!=null)
                               {
                                 for (var i=0; i<=long; i++){
                                   document.getElementsByName("teachername")[0].remove(0);
                                 }
                               }
                               $('#teachername').prop('disabled', true);
                               $('#subhead').prop('disabled', true);


                             }
                             else if(temp['DATA']==false && $('#id').val()!="" && temp['INFO']==false){
                               $('#dlhide,#search_1hide').hide();
                               $('#hiddenh5_found').hide();
                               $('#hiddenh5').show();
                               $('#notfound').hide();
                               swal(
                                  '',
                                  'กระบวนวิชาที่ค้นหาไม่พบในระบบ <br> กรุณาติดต่อเจ้าหน้าที่ภาคที่สังกัด',
                                  'error'
                                )
                               document.getElementById('formdrpd').style.display = "none";
                               document.getElementById('id').value = "";
                              }else {
                                 if($('#id').val()=="" ||$('#id').val()==null )
                                 {
                                   $('#hiddenh5_found').hide();
                                   $('#hiddenh5').show();
                                   $('#notfound').hide();
                                   swal(
                                      '',
                                      'กรุณากรอกรหัสกระบวนวิชาให้ถูกต้อง',
                                      'error'
                                    )
                                    $('#dlhide,#search_1hide').hide();
                                    document.getElementById('formdrpd').style.display = "none";

                                 }
                               }
                           }else {
                             swal(
                                '',
                                'กระบวนวิชานี้ไม่อยู่ในความรับผิดชอบของท่าน',
                                'warning'
                              )
                             $('#notfound').hide();
                             $('#dlhide,#search_1hide').hide();
                             $('#formdrpd').hide();
                             $('#buttondiv').hide();

                           }



                         } catch (e) {
                              console.log('Error#542-decode error');
                              swal({
                                title: 'เกิดข้อผิดพลาด',
                                text: '',
                                type: 'error',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ok'
                              }).then(function () {

                              }, function (dismiss) {
                              // dismiss can be 'cancel', 'overlay',
                              // 'close', and 'timer'
                              if (dismiss === 'cancel') {

                              }
                            })
                         }




                   },
                   failure: function (result) {
                        alert(result);
                   },
                   error: function (xhr, status, p3, p4) {
                        var err = "Error " + " " + status + " " + p3 + " " + p4;
                        if (xhr.responseText && xhr.responseText[0] == "{")
                             err = JSON.parse(xhr.responseText).Message;
                        console.log(err);
                   }
        });
   }
   else if (btntype==2) {
     var rowtr = ($('#detailteaching tr').length)-2
     for (var i = 1; i <=rowtr; i++) {
       var row = document.getElementById('row' + i);
       row.parentNode.removeChild(row);
     }

     $('#dlhide,#search_1hide').show();
     var file_data = new FormData;
     var teachername_temp = document.getElementById('teachername').value;
     var stringspl = teachername_temp.split("_");
     var instructor_id = stringspl[0];
     var name = stringspl[1];
     var course_id = stringspl[2];
     var semester = stringspl[3];
     var year = stringspl[4];
     JSON.stringify(name);
     JSON.stringify(course_id);
     JSON.stringify(instructor_id);
     JSON.stringify(semester);
     JSON.stringify(year);
     JSON.stringify(type);
     file_data.append("name",name);
     file_data.append("course_id",course_id);
     file_data.append("instructor_id",instructor_id);
     file_data.append("semester",semester);
     file_data.append("year",year);
     file_data.append("type",type);
     //var URL = '../../application/test_data.php';
     var URL = '../../application/document/search_document.php';
     $.ajax({
                   url: URL,
                   dataType: 'text',
                   cache: false,
                   contentType: false,
                   processData: false,
                   data: file_data,
                   type: 'post',
                   beforeSend: function() {
                     swal({
                       title: 'กรุณารอสักครู่',
                       text: 'ระบบกำลังประมวลผล',
                       allowOutsideClick: false
                     })
                     swal.showLoading()
                   },
                   success: function (result) {
                     try {
                       var temp = $.parseJSON(result);
                       if(temp!=null)
                       {
                         swal.hideLoading()

                           swal(
                              'สำเร็จ!',
                              'ดึงข้อมูลสำเร็จ',
                              'success'
                            )
                          $('#dlhide,#search_1hide').show();
                           getinfo(temp);
                       }
                       else {
                         swal.hideLoading()
                         swal({
                           title: 'เกิดข้อผิดพลาด',
                           text: '',
                           type: 'error',
                           showCancelButton: false,
                           confirmButtonColor: '#3085d6',
                           cancelButtonColor: '#d33',
                           confirmButtonText: 'Ok'
                         }).then(function () {

                         }, function (dismiss) {
                         // dismiss can be 'cancel', 'overlay',
                         // 'close', and 'timer'
                         if (dismiss === 'cancel') {

                         }
                       })
                       }
                     } catch (e) {
                          console.log('Error#542-decode error');
                          swal.hideLoading()
                          swal({
                            title: 'เกิดข้อผิดพลาด-01',
                            text: '',
                            type: 'error',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                          }).then(function () {

                          }, function (dismiss) {
                          // dismiss can be 'cancel', 'overlay',
                          // 'close', and 'timer'
                          if (dismiss === 'cancel') {

                          }
                        })
                        }


                   },
                   failure: function (result) {
                        alert(result);
                   },
                   error: function (xhr, status, p3, p4) {
                        var err = "Error " + " " + status + " " + p3 + " " + p4;
                        if (xhr.responseText && xhr.responseText[0] == "{")
                             err = JSON.parse(xhr.responseText).Message;
                        console.log(err);
                   }
        });
   }else if(btntype==3) {
     var rowtr = ($('#detailteaching tr').length)-2
     for (var i = 1; i <=rowtr; i++) {
       var row = document.getElementById('row' + i);
       row.parentNode.removeChild(row);
     }
     var department = $('#department').val();
     var numstudent = $('#numstudent').val();
     document.getElementById("form1").reset();
     $('#department').val(department);
     $('#numstudent').val(numstudent);
     document.getElementById('course').value = $('#id').val();
     document.getElementById('formdrpd').style.display = "";

     $('#search_1hide').show();
     $('#dlhide').hide();
     $('#topic1')[0].checked = false;
     $('#topic2')[0].checked = true;
     $('#submitbtn2').hide();
     $('#submitbtn').show();
     $('#spanfile').text("");
     $('#downloadfile').hide();
   }else {
     $('#dlhide').hide();
     $('#search_1hide').show();
     var fname = $('#search_1').val();
     if(fname=="")
     {
       swal({
         title: '',
         text: 'กรุณากรอกชื่อและนามสกุลให้ถูกต้อง',
         type: 'warning',
         showCancelButton: false,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Ok'
       }).then(function () {
         $('#dlhide').hide();

       }, function (dismiss) {
       // dismiss can be 'cancel', 'overlay',
       // 'close', and 'timer'
       if (dismiss === 'cancel') {

       }
     })

   }else{

     var type = 3;
     var file_data = new FormData;
     var department = $('#department').val();
     var numstudent = $('#numstudent').val();
     var name = $('#search_1').val();
     var course_id = $('#id').val();
     document.getElementById("form1").reset();
     $('#department').val(department);
     $('#numstudent').val(numstudent);
     var splitor = name.split(' ');
     var fname = splitor[0];
     var lname = splitor[1];
     if(splitor.length>2)
     {
       lname += " "+splitor[2];
     }
     $('#course').val(course_id);
     $('#fname').val(fname);
     $('#lname').val(lname);
     JSON.stringify(fname);
     JSON.stringify(lname);
     JSON.stringify(type);
     file_data.append("type",type);
     file_data.append("fname",fname);
     file_data.append("lname",lname);
     var URL = '../../application/document/search_document.php';
     $.ajax({
                   url: URL,
                   dataType: 'text',
                   cache: false,
                   contentType: false,
                   processData: false,
                   data: file_data,
                   type: 'post',
                   beforeSend: function() {
                     swal({
                       title: 'กรุณารอสักครู่',
                       text: 'ระบบกำลังประมวลผล',
                       allowOutsideClick: false
                     })
                     swal.showLoading()
                   },
                   success: function (result) {
                     try {
                       var temp = $.parseJSON(result);
                       if(temp['status']!='error' && temp!=false)
                       {
                         swal.hideLoading()

                           swal(
                              'สำเร็จ!',
                              'ดึงข้อมูลสำเร็จ',
                              'success'
                            )
                            $('#dlhide,#search_1hide').show();
                           getinfo2(temp);
                       }
                       else {
                         swal.hideLoading()
                         swal({
                           title: 'ไม่พบรายชื่อในระบบ',
                           text: 'ท่านสามารถกรอกรายละเอียดตามแบบฟอร์มข้างล่าง',
                           type: 'warning',
                           showCancelButton: false,
                           confirmButtonColor: '#3085d6',
                           cancelButtonColor: '#d33',
                           confirmButtonText: 'Ok'
                         }).then(function () {
                            $('#dlhide,#search_1hide').show();
                            if(temp['invited']=="1")
                            {
                              $('input[name="topic"][value="already"]').prop('checked', true);
                            }else {
                              $('input[name="topic"][value="yet"]').prop('checked', true);
                            }
                            $('#course').attr('readonly', false);
                            $('#submitbtn2').hide();
                            $('#submitbtn').show();
                            $('#spanfile').text("");
                            $('#downloadfile').hide();
                         }, function (dismiss) {
                         // dismiss can be 'cancel', 'overlay',
                         // 'close', and 'timer'
                         if (dismiss === 'cancel') {

                         }
                       })
                       }
                     } catch (e) {
                          console.log('Error#542-decode error');
                          swal.hideLoading()
                          swal({
                            title: 'เกิดข้อผิดพลาด-01',
                            text: '',
                            type: 'error',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                          }).then(function () {

                          }, function (dismiss) {
                          // dismiss can be 'cancel', 'overlay',
                          // 'close', and 'timer'
                          if (dismiss === 'cancel') {

                          }
                        })
                        }


                   },
                   failure: function (result) {
                        alert(result);
                   },
                   error: function (xhr, status, p3, p4) {
                        var err = "Error " + " " + status + " " + p3 + " " + p4;
                        if (xhr.responseText && xhr.responseText[0] == "{")
                             err = JSON.parse(xhr.responseText).Message;
                        console.log(err);
                   }
        });
   }
 }
 }

 function submitfunc(casesubmit) {

   // pack table
   var topiclec0 = [];
   var date0 = [];
   var timebegin0 = [];
   var timeend0 = [];
   var room0 = [];

   var topiclec = {};
   var date = {};
   var timebegin = {};
   var timeend = {};
   var room = {};

   /*for(var i=1;i<=(($('#detailteaching tr').length)-2);i++)
   {
      topiclec0[i-1] = $('#detail_topic'+i).val();
      date0[i-1] = $('#dateteach'+i).val();
      timebegin0[i-1] = $('#timebegin'+i).val();
      timeend0[i-1] = $('#timeend'+i).val();
      room0[i-1] = $('#room'+i).val();
   }*/

   $("input[id^='detail_topic']").each(function(index, el) {
     topiclec0[index] = $(this).val();
   });

   $("input[id^='dateteach']").each(function(index, el) {
     date0[index] = $(this).val();
   });

   $(".timeselected option:selected").each(function (index, el) {
     timebegin0[index] = $(this).val();
   });

   $(".timeselected2 option:selected").each(function (index, el) {
     timeend0[index] = $(this).val();
   });

   $("input[id^='room']").each(function(index, el) {
     room0[index] = $(this).val();
   });

   topiclec = topiclec0;
   date = date0;
   timebegin = timebegin0;
   timeend = timeend0;
   room = room0;

   //type_teacher
   if(document.querySelector("input[name='type_course']:checked").value=="require")
   {
     type_course_choice = "require";
   }else {
     type_course_choice = "choose";
   }
  // levelteacher
  if(document.querySelector("input[name='levelteacher']:checked").value=="pro")
  {
      var lvchoice = "official";
      var lvteacher = document.getElementById('GOV_LEVEL').value;
  }
  else
  {
      var lvchoice = "equivalent";
      var lvteacher = document.getElementById('NORM_LEVEL').value;
  }

  //costspec
  if($('#costspec1').is(":checked"))
  {
    var costspecchoice1 = 1;
    if( document.getElementById('choice1num').value == '')
    {
      var num1 = "0";
    }
    else {
      var num1 = document.getElementById('choice1num').value;
    }

    if( document.getElementById('choice1hour').value == '')
    {
      var hour1 = "0";
    }
    else {
      var hour1 = document.getElementById('choice1hour').value;
    }

    if( document.getElementById('choice1cost').value == '')
    {
      var cost1 = "0.00";
    }
    else {
      var cost1 = document.getElementById('choice1cost').value;
    }
  }else {
    var num1 = "0";
    var hour1 = "0";
    var cost1 = "0.00";
    var costspecchoice1 = 0;
  }

  if($('#costspec2').is(":checked"))
  {
    var costspecchoice2 = 1;
    if( document.getElementById('choice2num').value == '')
    {
      var num2 = "0";
    }
    else {
      var num2 = document.getElementById('choice2num').value;
    }

    if( document.getElementById('choice2hour').value == '')
    {
      var hour2 = "0";
    }
    else {
      var hour2 = document.getElementById('choice2hour').value;
    }

    if( document.getElementById('choice2cost').value == '')
    {
      var cost2 = "0.00";
    }
    else {
      var cost2 = document.getElementById('choice2cost').value;
    }
  }else {
    var num2 = "0";
    var hour2 = "0";
    var cost2 = "0.00";
    var costspecchoice2 = 0;
  }

  //trans
  if(document.getElementById('transplane').checked == true)
  {
    var planecheck = 1;
  }
  else {
    var planecheck = 0;
  }

  if(document.getElementById('transtaxi').checked == true)
  {
    var taxicheck = 1;
  }
  else {
    var taxicheck = 0;
  }

  if(document.getElementById('transselfcar').checked == true)
  {
    var selfcarcheck = 1;
  }
  else {
    var selfcarcheck = 0;
  }

  if( document.getElementById('SELF_DISTANCT').value == '')
  {
    var selfdis = "0";
  }
  else {
    var selfdis = document.getElementById('SELF_DISTANCT').value;
  }

  if( document.getElementById('selfunit').value == '')
  {
    var selfunit = "0";
  }
  else {
    var selfunit = document.getElementById('selfunit').value;
  }

  if( document.getElementById('selfcost').value == '')
  {
    var selfcost = "0.00";
  }
  else {
    var selfcost = document.getElementById('selfcost').value;
  }

  // hotelunit
  if(document.querySelector("input[name='hotelchoice']:checked").value=="way1")
  {
    var hotelchoice = 1;
    if( document.getElementById('way1unit').value == '')
    {
      var hotelunit = "0";
    }
    else {
      var hotelunit = document.getElementById('way1unit').value;
    }
  }
  else if (document.querySelector("input[name='hotelchoice']:checked").value=="way2") {
    var hotelchoice = 2;
    if( document.getElementById('way2unit').value == '')
    {
      var hotelunit = "0";
    }
    else {
      var hotelunit = document.getElementById('way2unit').value;
    }
  }else {
    var hotelchoice = 3;
    var hotelunit = "0";

  }

  if( document.getElementById('numnight').value == '')
  {
    var numnight = "0";
  }
  else {
    var numnight = document.getElementById('numnight').value;
  }

  if( document.getElementById('pernight').value == '')
  {
    var pernight = "0.00";
  }
  else {
    var pernight = document.getElementById('pernight').value;
  }

  //split fname / lname
  var fname =  document.getElementById('fname').value;
  var lname = document.getElementById('lname').value;

  //NUMTABLE
  var rowtr = ($('#detailteaching tr').length)-2;

  //make fixed2
  var fixedcostplane = parseFloat(document.getElementById('planecost').value);
  var costplane = fixedcostplane.toFixed(2);
  var fixedcosttaxi = parseFloat(document.getElementById('taxicost').value);
  var costtaxi = fixedcosttaxi.toFixed(2);
  var fixedcosttotal = parseFloat(document.getElementById('totalcost').value);
  var costtotal = fixedcosttotal.toFixed(2);

  //HISTORY
  if(casesubmit=='1')
  {
    if(document.querySelector("input[name='topic']:checked").value == "already")
    {
      var historyteacher = 1;
    }else {
      var historyteacher = 0;
    }
  }else {
    var historyteacher = 0;
  }


  //split teachername
  var teachername_temp = document.getElementById('teachername').value;
  var stringspl = teachername_temp.split("_");
  var instructor_id = stringspl[0];

   var data = {
     'TEACHERDATA_DEPARTMENT' : document.getElementById('department').value,
     'TEACHERDATA_PREFIX' : document.getElementById('pre').value,
     'TEACHERDATA_FNAME' : fname,
     'TEACHERDATA_LNAME' : lname,
     'TEACHERDATA_POSITION' : document.getElementById('position').value,
     'TEACHERDATA_QUALIFICATION' : document.getElementById('qualification').value,
     'TEACHERDATA_WORKPLACE' : document.getElementById('workplace').value,
     'TEACHERDATA_TELEPHONE_NUMBER' : document.getElementById('tel').value,
     'TEACHERDATA_TELEPHONE_SUB' : document.getElementById('subtel').value,
     'TEACHERDATA_MOBILE' : document.getElementById('mobile').value,
     'TEACHERDATA_EMAIL' : document.getElementById('email').value,
     'TEACHERDATA_HISTORY' : historyteacher,
     'COURSEDATA_COURSE_ID' : document.getElementById('course').value,
     'COURSEDATA_NOSTUDENT' : document.getElementById('numstudent').value,
     'COURSEDATA_TYPE_COURSE' : type_course_choice,
     'COURSEDATA_REASON' : document.getElementById('reason').value,
     'COURSEDATA_DETAIL' : {
       'TOPICLEC' : topiclec,
       'DATE' : date,
       'TIME_BEGIN' : timebegin,
       'TIME_END' : timeend,
       'ROOM' : room
     },
     'INSTRUCTOR_ID' : instructor_id,
     'COURSEDATA_PERCENT_HOUR' : document.getElementById('hour').value,
     'PAYMENT_METHOD' : document.querySelector("input[name='paymethod']:checked").value,
     'PAYMENT_LVLTEACHER_CHOICE' : lvchoice,
     'PAYMENT_LVLTEACHER_DESCRIPT' : lvteacher,
     'PAYMENT_COSTSPEC_LEC_CHECKED' : costspecchoice1,
     'PAYMENT_COSTSPEC_LAB_CHECKED' : costspecchoice2,
     'PAYMENT_COSTSPEC_LEC_NUMBER' : num1,
     'PAYMENT_COSTSPEC_LEC_HOUR' : hour1,
     'PAYMENT_COSTSPEC_LEC_COST' : cost1,
     'PAYMENT_COSTSPEC_LAB_NUMBER' : num2,
     'PAYMENT_COSTSPEC_LAB_HOUR' : hour2,
     'PAYMENT_COSTSPEC_LAB_COST' : cost2,
     'PAYMENT_COSTTRANS_TRANSPLANE_CHECKED' : planecheck,
     'PAYMENT_COSTTRANS_TRANSPLANE_DEPART' : document.getElementById('AIR_DEPART').value,
     'PAYMENT_COSTTRANS_TRANSPLANE_ARRIVE' : document.getElementById('AIR_ARRIVE').value,
     'PAYMENT_COSTTRANS_TRANSPLANE_COST' : costplane,
     'PAYMENT_COSTTRANS_TRANSTAXI_CHECKED' : taxicheck,
     'PAYMENT_COSTTRANS_TRANSTAXI_DEPART' : document.getElementById('TAXI_DEPART').value,
     'PAYMENT_COSTTRANS_TRANSTAXI_ARRIVE' : document.getElementById('TAXI_ARRIVE').value,
     'PAYMENT_COSTTRANS_TRANSTAXI_COST' : costtaxi,
     'PAYMENT_COSTTRANS_TRANSSELFCAR_CHECKED' : selfcarcheck,
     'PAYMENT_COSTTRANS_TRANSSELFCAR_DISTANCE' : selfdis,
     'PAYMENT_COSTTRANS_TRANSSELFCAR_UNIT' : selfunit,
     'PAYMENT_COSTTRANS_TRANSSELFCAR_COST' : selfcost,
     'PAYMENT_COSTHOTEL_CHOICE' : hotelchoice,
     'PAYMENT_COSTHOTEL_PERNIGHT' : hotelunit,
     'PAYMENT_COSTHOTEL_NUMBER' : numnight,
     'PAYMENT_COSTHOTEL_COST' : pernight,
     'PAYMENT_TOTALCOST' : costtotal,
     'NUMTABLE' : rowtr,
     'SUBMIT_TYPE' : casesubmit,
     'USERID' : '<?php echo $_SESSION['id']; ?>',
     'DATE' : '<?php echo date('d'); ?>',
     'MONTH' : '<?php echo date('m'); ?>',
     'YEAR' : '<?php echo date('Y')+543; ?>'
   };

   if(casesubmit=='1')
   {
     senddata(JSON.stringify(data),getfile(),casesubmit);
   }
   else if(casesubmit=='2')
   {
     senddata(JSON.stringify(data),getfile(),casesubmit);
   }
 }

 function senddata(data,file_data,casesubmit)
 {

   //prompt("data", data);
    file_data.append("DATA",data);
    var URL = '../../application/pdf/generate_special_instructor.php';
    $.ajax({
                  url: URL,
                  dataType: 'text',
                  cache: false,
                  contentType: false,
                  processData: false,
                  data: file_data,
                  type: 'post',
                  beforeSend: function() {
                    swal({
                      title: 'กรุณารอสักครู่',
                      text: 'ระบบกำลังประมวลผล',
                      allowOutsideClick: false
                    })
                    swal.showLoading()
                  },
                  success: function (result) {
                        try {
                          var temp = $.parseJSON(result);
                          if(temp["status"]=='success')
                          {
                             swal.hideLoading()
                             swal({
                               title: 'สำเร็จ',
                               text: 'บันทึกข้อมูลสำเร็จ',
                               type: 'success',
                               showCancelButton: false,
                               confirmButtonColor: '#3085d6',
                               cancelButtonColor: '#d33',
                               confirmButtonText: 'Ok',
                               allowOutsideClick: false
                             }).then(function () {
                               window.location.reload();
                             }, function (dismiss) {
                             // dismiss can be 'cancel', 'overlay',
                             // 'close', and 'timer'
                             if (dismiss === 'cancel') {

                             }
                           })
                           if(casesubmit==1)
                          {window.open(temp["msg"], '_blank');}
                          }
                          else {
                            swal.hideLoading()
                            swal({
                              title: 'เกิดข้อผิดพลาด',
                              text: temp["msg"],
                              type: 'error',
                              showCancelButton: false,
                              confirmButtonColor: '#3085d6',
                              cancelButtonColor: '#d33',
                              confirmButtonText: 'Ok'
                            }).then(function () {

                            }, function (dismiss) {
                            // dismiss can be 'cancel', 'overlay',
                            // 'close', and 'timer'
                            if (dismiss === 'cancel') {

                            }
                          })
                            //alert(temp["msg"]);
                          }
                        } catch (e) {
                             console.log('Error#542-decode error');
                             swal.hideLoading()
                             swal({
                               title: 'เกิดข้อผิดพลาด',
                               text: temp["msg"],
                               type: 'error',
                               showCancelButton: false,
                               confirmButtonColor: '#3085d6',
                               cancelButtonColor: '#d33',
                               confirmButtonText: 'Ok'
                             }).then(function () {

                             }, function (dismiss) {
                             // dismiss can be 'cancel', 'overlay',
                             // 'close', and 'timer'
                             if (dismiss === 'cancel') {

                             }
                           })
                        }


                  },
                  failure: function (result) {
                       alert(result);
                  },
                  error: function (xhr, status, p3, p4) {
                       var err = "Error " + " " + status + " " + p3 + " " + p4;
                       if (xhr.responseText && xhr.responseText[0] == "{")
                            err = JSON.parse(xhr.responseText).Message;
                       console.log(err);
                  }
       });
 }

 function getfile()
 {
   var file_data = $('#cv').prop('files')[0];
   var form_data = new FormData();
   form_data.append('file', file_data);
   return form_data;
 }

 function deletedata()
 {
   if( document.getElementById('teachername').value!="" && document.getElementById('teachername').value!=undefined )
   {
     swal({
         title: 'แน่ใจหรือไม่',
         text: 'คุณต้องการลบข้อมูลใช่หรือไม่',
         type: 'question',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Ok',
         cancelButtonText: 'Cancel'
       }).then(function () {
         var file_data = new FormData;
         var course_id = $('#id').val();
         var teachername_temp = document.getElementById('teachername').value;
         var stringspl = teachername_temp.split('_');
         var instructor_id = stringspl[0];
         var name = stringspl[1];
         var semester = stringspl[3];
         var year = stringspl[4];
         var type = 'special';
         file_data.append("course_id",course_id);
         file_data.append("instructor_id",instructor_id);
         file_data.append("semester",semester);
         file_data.append("year",year);
         file_data.append("type",type);
         var URL = '../../application/document/delete.php';
         $.ajax({
                       url: URL,
                       dataType: 'text',
                       cache: false,
                       contentType: false,
                       processData: false,
                       data: file_data,
                       type: 'post',
                       beforeSend: function() {
                         swal({
                           title: 'กรุณารอสักครู่',
                           text: 'ระบบกำลังประมวลผล',
                           allowOutsideClick: false
                         })
                         swal.showLoading()
                       },
                       success: function (result) {
                             try {
                               var temp = $.parseJSON(result);
                               if(temp["status"]=='success')
                               {
                                  swal.hideLoading()
                                  swal({
                                    title: 'ลบข้อมูลสำเร็จ',
                                    text: temp["msg"],
                                    type: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Ok'
                                  }).then(function () {
                                    location.reload();
                                  }, function (dismiss) {
                                  // dismiss can be 'cancel', 'overlay',
                                  // 'close', and 'timer'
                                  if (dismiss === 'cancel') {

                                  }
                                })

                                 //alert(temp["msg"]);
                               }
                               else {
                                 swal.hideLoading()
                                 swal({
                                   title: 'เกิดข้อผิดพลาด',
                                   text: temp["msg"],
                                   type: 'error',
                                   showCancelButton: false,
                                   confirmButtonColor: '#3085d6',
                                   cancelButtonColor: '#d33',
                                   confirmButtonText: 'Ok'
                                 }).then(function () {

                                 }, function (dismiss) {
                                 // dismiss can be 'cancel', 'overlay',
                                 // 'close', and 'timer'
                                 if (dismiss === 'cancel') {

                                 }
                               })
                                 //alert(temp["msg"]);
                               }
                             } catch (e) {
                                  console.log('Error#542-decode error');
                                  swal.hideLoading()
                                  swal({
                                    title: 'เกิดข้อผิดพลาด',
                                    text: temp["msg"],
                                    type: 'error',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Ok'
                                  }).then(function () {

                                  }, function (dismiss) {
                                  // dismiss can be 'cancel', 'overlay',
                                  // 'close', and 'timer'
                                  if (dismiss === 'cancel') {

                                  }
                                })
                             }


                       },
                       failure: function (result) {
                            alert(result);
                       },
                       error: function (xhr, status, p3, p4) {
                            var err = "Error " + " " + status + " " + p3 + " " + p4;
                            if (xhr.responseText && xhr.responseText[0] == "{")
                                 err = JSON.parse(xhr.responseText).Message;
                            console.log(err);
                       }
            });
       }, function (dismiss) {
       // dismiss can be 'cancel', 'overlay',
       // 'close', and 'timer'
       if (dismiss === 'cancel') {

       }
     })

      }
      else {
        swal(
          '',
          'ไม่สามารถลบข้อมูลได้',
          'warning'
        )
      }
 }

 $(document).ready(function(){
   $('#dlhide,#search_1hide').hide();
   $('input[type=file]').change(function () {
     var val = $(this).val().toLowerCase();
     var regex = new RegExp("(.*?)\.(doc|docx|pdf)$");
     if (!(regex.test(val))) {
       $(this).val('');
       swal({
       type: "warning",
       text: "กรุณาเลือกไฟล์ที่มีนามสกุล .doc , .docx หรือ .pdf เท่านั้น",
       confirmButtonText: "ตกลง!",
     });
     }
   });
   //deadline
   <?php
     $flagspcl = 0;
     $dd = date('d');
     $mm = date('m');
     $yy = date('Y');
     $today = $yy.'-'.$mm.'-'.$dd;

     $count = sizeof($dlspcl);
     for ($x=0; $x < $count ; $x++) {
       $deadlinestart = $dlspcl[$x]['open_date'];
       $deadlineend = $dlspcl[$x]['last_date'];
       $checksem = $dlspcl[$x]['semester_num'];
       $checkyear = $dlspcl[$x]['year'];
       $cursem = $current['semester'];
       $curyear = $current['year'];

       if($checksem==$cursem && $checkyear==$curyear)
       {
           if($deadlinestart<=$today && $today<=$deadlineend)
           {
               $flagspcl = $flagspcl + 1;
           }
      }

     }

     if($flagspcl>0)
     {
       echo "$('#overtimemsg').hide();";

       if(isset($_POST['course_id']))
       {
         echo "$('#dlhide,#search_1hide').hide();
         document.getElementById('form1').reset();
         var file_data = new FormData;
         var course_id = '".$_POST['course_id']."';
         var type = 2;
         JSON.stringify(course_id);
         JSON.stringify(type);
         file_data.append('course_id',course_id);
         file_data.append('type',type);
         var URL = '../../application/document/search_document.php';
         $.ajax({
                       url: URL,
                       dataType: 'text',
                       cache: false,
                       contentType: false,
                       processData: false,
                       data: file_data,
                       type: 'post',
                       success: function (result) {
                             try {
                               var temp = $.parseJSON(result);
                               var rowtr = ($('#detailteaching tr').length)-2
                               for (var i = 1; i <=rowtr; i++) {
                                 var row = document.getElementById('row' + i);
                                 row.parentNode.removeChild(row);
                               }
                               document.getElementById('id').value = temp['INFO']['course_id'];
                               $('#department').val(temp['INFO'].department);

                               $('#numstudent').val(parseInt(temp['INFO'].num_student));
                               var course_id = document.getElementById('id').value;
                               //cleardatalist
                               var selectobject = document.getElementById('teachername');
                               var long = selectobject.length;
                               if(long!=0 && long!=null)
                               {
                                 for (var i=0; i<=long; i++){
                                   document.getElementsByName('teachername')[0].remove(0);
                                 }
                               }

                               if(temp['ACCESS'] == true)
                               {
                                 $('#buttondiv').show();
                                 if(temp['DATA']!=false && temp['INFO']!=false)
                                 {
                                   $('#teachername').prop('disabled', false);
                                   $('#subhead').prop('disabled', false);
                                   $('#hiddenh5').hide();
                                   $('#hiddenh5_found').show();
                                   $('#hiddenh5_found').html('กระบวนวิชา '+temp['INFO'].course_name_th+' ('+temp['INFO'].course_id+')');
                                   $('#notfound').hide();
                                   $('#department').val(temp['INFO'].department);

                                   $('#numstudent').val(parseInt(temp['INFO'].num_student));
                                   var course_id = document.getElementById('id').value;
                                   document.getElementById('formdrpd').style.display = '';
                                   //cleardatalist
                                   var selectobject = document.getElementById('teachername');
                                   var long = selectobject.length;
                                   if(long!=0 && long!=null)
                                   {
                                     for (var i=0; i<=long; i++){
                                       document.getElementsByName('teachername')[0].remove(0);
                                     }
                                   }

                                   for(var i=0;i<(Object.keys(temp['DATA']).length);i++)
                                   {
                                     var opt = document.createElement('option');
                                     opt.value = temp['DATA'][i].id +'_'+ temp['DATA'][i].name + '_' + temp['INFO']['course_id'] +'_'+ temp['DATA'][i].semester + '_' + temp['DATA'][i].year;
                                     opt.innerHTML = 'คุณ'+temp['DATA'][i].name;
                                     document.getElementById('teachername').appendChild(opt);
                                   }


                                   ";

                                   if(isset($_POST['instructor_id']))
                                {
                                   echo "$('#teachername').val('".$_POST['instructor_id']."_".$_POST['name']."_".$_POST['course_id']."_".$_POST['semester']."_".$_POST['year']."');

                                   var file_data = new FormData;
                                   var teachername_temp = document.getElementById('teachername').value;
                                   var stringspl = teachername_temp.split('_');
                                   var instructor_id = stringspl[0];
                                   var name = stringspl[1];
                                   var course_id = stringspl[2];
                                   var semester = stringspl[3];
                                   var year = stringspl[4];
                                   JSON.stringify(name);
                                   JSON.stringify(course_id);
                                   JSON.stringify(instructor_id);
                                   JSON.stringify(semester);
                                   JSON.stringify(year);
                                   JSON.stringify(type);
                                   file_data.append('name',name);
                                   file_data.append('course_id',course_id);
                                   file_data.append('instructor_id',instructor_id);
                                   file_data.append('semester',semester);
                                   file_data.append('year',year);
                                   file_data.append('type',type);
                                   //var URL = '../../application/test_data.php';
                                   var URL = '../../application/document/search_document.php';
                                   $.ajax({
                                                 url: URL,
                                                 dataType: 'text',
                                                 cache: false,
                                                 contentType: false,
                                                 processData: false,
                                                 data: file_data,
                                                 type: 'post',
                                                 success: function (result) {
                                                   try {
                                                     var temp = $.parseJSON(result);
                                                     if(temp!=null)
                                                     {
                                                        $('#dlhide,#search_1hide').show();
                                                         getinfo(temp);
                                                     }
                                                     else {
                                                       alert('Error');
                                                     }
                                                   } catch (e) {
                                                        console.log('Error#542-decode error');

                                                      }
                                                },
                                                failure: function (result) {
                                                     alert(result);
                                                },
                                                error: function (xhr, status, p3, p4) {
                                                     var err = 'Error ' + ' ' + status + ' ' + p3 + ' ' + p4;
                                                     if (xhr.responseText && xhr.responseText[0] == '{')
                                                          err = JSON.parse(xhr.responseText).Message;
                                                     console.log(err);
                                                }
                                      });";
                                    }

                                 echo "}else if(temp['DATA']==false && temp['INFO']!=false){
                                   $('#hiddenh5_found').show();
                                   $('#hiddenh5_found').html('กระบวนวิชา '+temp['INFO'].course_name_th+' ('+temp['INFO'].course_id+')');
                                   $('#hiddenh5').hide();
                                   $('#notfound').show();
                                   $('#department').val(temp['INFO'].department);
                                   $('#spanfile').text('');
                                   $('#downloadfile').hide();

                                   $('#numstudent').val(parseInt(temp['INFO'].num_student));
                                   var course_id = document.getElementById('id').value;
                                   document.getElementById('formdrpd').style.display = '';
                                   //cleardatalist
                                   var selectobject = document.getElementById('teachername');
                                   var long = selectobject.length;
                                   if(long!=0 && long!=null)
                                   {
                                     for (var i=0; i<=long; i++){
                                       document.getElementsByName('teachername')[0].remove(0);
                                     }
                                   }
                                   $('#teachername').prop('disabled', true);
                                   $('#subhead').prop('disabled', true);

                                 }
                               }
                             } catch (e) {
                                  console.log('Error#542-decode error');
                             }

                       },
                       failure: function (result) {
                            alert(result);
                       },
                       error: function (xhr, status, p3, p4) {
                            var err = 'Error ' + ' ' + status + ' ' + p3 + ' ' + p4;
                            if (xhr.responseText && xhr.responseText[0] == '{')
                                 err = JSON.parse(xhr.responseText).Message;
                            console.log(err);
                       }
            });";
       }
     }else {
         echo "$('#dlhide,#search_1hide').hide();
         $('#hiddenh5').hide();
         $('#formheader').hide();
         $('#overtimemsg').show();";
     }

    ?>


   // manage required form
   $("input[name='levelteacher']").change(function(){
     window.sumcheck = 0;
     if($(this).val()=="pro")
     {
         $("#NORM_LEVEL").val("");
     }
     else
     {
       $("#GOV_LEVEL").val("");
     }
     });

       $('#transplane').click(function(){
         window.sumcheck = 0;
          if (this.checked) {
              $("#AIR_DEPART").prop('required',true);
              $("#AIR_ARRIVE").prop('required',true);
              $("#planecost").prop('required',true);
              $("#planecost").val("0");
          }
          else
          {
            $("#AIR_DEPART").prop('required',false);
            $("#AIR_ARRIVE").prop('required',false);
            $("#planecost").prop('required',false);
            $("#AIR_DEPART").val("");
            $("#AIR_ARRIVE").val("");
            $("#planecost").val("0");
          }
      });

      $('#transtaxi').click(function(){
        window.sumcheck = 0;
         if (this.checked) {
             $("#TAXI_DEPART").prop('required',true);
             $("#TAXI_ARRIVE").prop('required',true);
             $("#taxicost").prop('required',true);
             $("#taxicost").val("0");
         }
         else
         {
           $("#TAXI_DEPART").prop('required',false);
           $("#TAXI_ARRIVE").prop('required',false);
           $("#taxicost").prop('required',false);
           $("#TAXI_DEPART").val("");
           $("#TAXI_ARRIVE").val("");
           $("#taxicost").val("0");
         }
     });

     $('#transselfcar').click(function(){
       window.sumcheck = 0;
        if (this.checked) {
            $("#SELF_DISTANCT").prop('required',true);
            $("#selfunit").val("4");
            $("#selfcost").val("0");
        }
        else
        {
          $("#SELF_DISTANCT").prop('required',false);
          $("#SELF_DISTANCT").val("0");
          $("#selfunit").val("0");
          $("#selfcost").val("0");

        }
    });

    // CALCULATE

    $('#choice1hour').keyup(function(){
      window.sumcheck = 0;
        var textone;
        var texttwo;
        textone = parseFloat($('#choice1hour').val());
        texttwo = parseFloat($('#choice1num').val());
        var result = textone*texttwo;
        $('#choice1cost').val(result.toFixed(2));
    });
    $('#choice1num').keyup(function(){
      window.sumcheck = 0;
        var textone;
        var texttwo;
        textone = parseFloat($('#choice1hour').val());
        texttwo = parseFloat($('#choice1num').val());
        var result = textone*texttwo;
        $('#choice1cost').val(result.toFixed(2));
    });

    $("#costspec1").change(function(){
      window.sumcheck = 0;
      if($('#costspec1').is(":checked"))
      {
        $('#choice1hour').val("0");
        $('#choice1cost').val("0");
        if($('input[name="levelteacher"]:checked').val()=="pro")
        {
          $('#choice1num').val("400");
        }
        else {
          $('#choice1num').val("800");
        }
        $('#choice1hour').keyup(function(){
          window.sumcheck = 0;
            var textone;
            var texttwo;
            textone = parseFloat($('#choice1hour').val());
            texttwo = parseFloat($('#choice1num').val());
            var result = textone*texttwo;
            $('#choice1cost').val(result.toFixed(2));
        });
        $('#choice1num').keyup(function(){
          window.sumcheck = 0;
            var textone;
            var texttwo;
            textone = parseFloat($('#choice1hour').val());
            texttwo = parseFloat($('#choice1num').val());
            var result = textone*texttwo;
            $('#choice1cost').val(result.toFixed(2));
        });
      }else {
        $('#choice1hour').val("0");
        $('#choice1cost').val("0");
        $('#choice1num').val("0");
      }


    });

    $('#choice2hour').keyup(function(){
      window.sumcheck = 0;
        var textone;
        var texttwo;
        textone = parseFloat($('#choice2hour').val());
        texttwo = parseFloat($('#choice2num').val());
        var result = textone*texttwo;
        $('#choice2cost').val(result.toFixed(2));
    });
    $('#choice2num').keyup(function(){
      window.sumcheck = 0;
        var textone;
        var texttwo;
        textone = parseFloat($('#choice2hour').val());
        texttwo = parseFloat($('#choice2num').val());
        var result = textone*texttwo;
        $('#choice2cost').val(result.toFixed(2));
    });

  $("#costspec2").change(function(){
    window.sumcheck = 0;
    if($('#costspec2').is(":checked"))
    {
      $('#choice2hour').val("0");
      $('#choice2cost').val("0");
      if($('input[name="levelteacher"]:checked').val()=="pro")
      {
        $('#choice2num').val("200");
      }
      else {
        $('#choice2num').val("400");
      }
      $('#choice2hour').keyup(function(){
        window.sumcheck = 0;
          var textone;
          var texttwo;
          textone = parseFloat($('#choice2hour').val());
          texttwo = parseFloat($('#choice2num').val());
          var result = textone*texttwo;
          $('#choice2cost').val(result.toFixed(2));
      });
      $('#choice2num').keyup(function(){
        window.sumcheck = 0;
          var textone;
          var texttwo;
          textone = parseFloat($('#choice2hour').val());
          texttwo = parseFloat($('#choice2num').val());
          var result = textone*texttwo;
          $('#choice2cost').val(result.toFixed(2));
      });
    }else {
      $('#choice2hour').val("0");
      $('#choice2cost').val("0");
      $('#choice2num').val("0");
    }
});


    $('#SELF_DISTANCT').keyup(function(){
      window.sumcheck = 0;
        var textone;
        var texttwo;
        textone = parseFloat($('#SELF_DISTANCT').val());
        texttwo = parseFloat($('#selfunit').val());
        var result = textone*texttwo ;
        $('#selfcost').val(result.toFixed(2));
    });

    $('#selfunit').keyup(function(){
      window.sumcheck = 0;
        var textone;
        var texttwo;
        textone = parseFloat($('#SELF_DISTANCT').val());
        texttwo = parseFloat($('#selfunit').val());
        var result = textone*texttwo ;
        $('#selfcost').val(result.toFixed(2));
    });

    $('#SELF_DISTANCT').val("0");
    $('#selfunit').val("0");
    $('#selfcost').val("0");

    if(document.querySelector("input[name='hotelchoice']:checked").value=="way3")
    {
      $('#numnight').prop('required',false);
      $('#numnight').val("0");
      $('#pernight').val("0");
      $('#way1unit').val("0");
      $('#way2unit').val("0 ");
    }

    $('#numnight').keyup(function(){
      window.sumcheck = 0;
      if($('#numnight').val()=='')
      {
        $('#pernight').val("0");
      }
      else {
        var textone;
        var texttwo;
        textone = parseFloat($('#numnight').val());
        if(document.querySelector("input[name='hotelchoice']:checked").value=="way1")
        {  texttwo = parseFloat($('#way1unit').val());}
        else if(document.querySelector("input[name='hotelchoice']:checked").value=="way2"){
          {  texttwo = parseFloat($('#way2unit').val());}
        }
        var result = textone*texttwo;
        $('#pernight').val(result.toFixed(2));
      }
    });

    $('#way1unit').keyup(function(){
      window.sumcheck = 0;
      if(document.querySelector("input[name='hotelchoice']:checked").value=="way1")
        {
          if($('#numnight').val()=='')
        {
          $('#pernight').val("0");
        }
        else {
          var textone;
          var texttwo;
          textone = parseFloat($('#numnight').val());
          texttwo = parseFloat($('#way1unit').val());
          var result = textone*texttwo;
          $('#pernight').val(result.toFixed(2));
        }
      }
    });

    $('#way2unit').keyup(function(){
      window.sumcheck = 0;
      if(document.querySelector("input[name='hotelchoice']:checked").value=="way2"){
      if($('#numnight').val()=='')
      {
        $('#pernight').val("0");
      }
      else {
        var textone;
        var texttwo;
        textone = parseFloat($('#numnight').val());
        texttwo = parseFloat($('#way2unit').val());
        var result = textone*texttwo;
        $('#pernight').val(result.toFixed(2));
      }
    }
    });

    $("input[name='hotelchoice']").change(function(){
      window.sumcheck = 0;
      if($(this).val()=="way1")
      {
        $('#numnight').val("0");
        $('#pernight').val("0");
        $('#way1unit').val("1500");
        $('#way2unit').val("0");
        $('#numnight').prop('required',true);
        $('#numnight').keyup(function(){
          if($('#numnight').val()=='')
          {
            $('#pernight').val("0");
          }
          else {
            var textone;
            var texttwo;
            textone = parseFloat($('#numnight').val());
            texttwo = parseFloat($('#way1unit').val());
            var result = textone*texttwo;
            $('#pernight').val(result.toFixed(2));
          }
        });
        $('#way1unit').keyup(function(){
          if($('#numnight').val()=='')
          {
            $('#pernight').val("0");
          }
          else {
            var textone;
            var texttwo;
            textone = parseFloat($('#numnight').val());
            texttwo = parseFloat($('#way1unit').val());
            var result = textone*texttwo;
            $('#pernight').val(result.toFixed(2));
          }

        });
      }
      else if($(this).val()=="way2")
      {
        $('#numnight').val("0");
        $('#pernight').val("0");
        $('#way2unit').val("800");
        $('#way1unit').val("0");
        $('#numnight').prop('required',true);
        $('#numnight').keyup(function(){
          if($('#numnight').val()=='')
          {
            $('#pernight').val("0");
          }
          else {
            var textone;
            var texttwo;
            textone = parseFloat($('#numnight').val());
            texttwo = parseFloat($('#way2unit').val());
            var result = textone*texttwo;
            $('#pernight').val(result.toFixed(2));
          }

        });
        $('#way2unit').keyup(function(){
          if($('#way2unit').val()=='')
          {
            $('#pernight').val("0");
          }else {
            var textone;
            var texttwo;
            textone = parseFloat($('#numnight').val());
            texttwo = parseFloat($('#way2unit').val());
            var result = textone*texttwo;
            $('#pernight').val(result.toFixed(2));
          }

        });
      }
      else {
        $('#numnight').prop('required',false);
        $('#numnight').val("0");
        $('#pernight').val("0");
        $('#way1unit').val("0");
        $('#way2unit').val("0");
      }

      });

      // callist

      $("#callist").hide();

      //paymethod

      $('#costhide').hide();

      $("input[name='paymethod']").change(function(){
        if($(this).val()=="1")
        {
          window.sumcheck = 0;
          $('#costhide').show();
        }else {
          $('#costhide').hide();
        }
        $('.resettext').val("");
        $('.resetvalue').val("0");
        $('.resetchecked').prop('checked', false);
        $("input[name='levelteacher'][value='pro']").prop("checked",true);
        $("input[name='hotelchoice'][value='way3']").prop("checked",true);

      });


      //Nan
      $('#choice1hour').keyup(function() {
        if($('#choice1hour').val()=='')
        {
          $('#choice1cost').val("0");

        }
      });

      $('#choice2hour').keyup(function() {
        if($('#choice2hour').val()=='')
        {
          $('#choice2cost').val("0");

        }
      });

      $('#SELF_DISTANCT').keyup(function() {
        if($('#SELF_DISTANCT').val()=='')
        {
          $('#selfcost').val("0");

        }
      });

      $('#selfunit').keyup(function() {
        if($('#selfunit').val()=='')
        {
          $('#selfcost').val("0");

        }
      });

      $('#numnight').keyup(function() {
        if($('#numnight').val()=='')
        {
          $('#pernight').val("0");

        }
      });

      $('#way2unit').keyup(function() {
        if($('#way2unit').val()=='')
        {
          $('#pernight').val("0");

        }
      });

      $('#way1unit').keyup(function() {
        if($('#way1unit').val()=='')
        {
          $('#pernight').val("0");

        }
      });

      $('.keyupcheck').keyup(function() {
        $('.keyupcheck').each(function() {
            window.sumcheck = 0;
        });
     });




      //submitfunction
      $( '#form1' ).submit( function( event ) {
        event.preventDefault();

        var fail = false;
        var fail_log = '';
        $( '#form1' ).find( 'select, textarea,input' ).each(function(){
            if( ! $( this ).prop( 'required' )){

            } else {
                if ( ! $( this ).val() ) {
                    fail = true;
                    name = $( this ).attr( 'name' );
                    fail_log += name + " is required \n";
                }

            }
        });

        if ( ! fail ) {
          if($('#hour').val()=='0')
          {
            swal(
              '',
              'กรุณากรอกจำนวนชั่วโมงของหัวข้อที่เชิญมาสอนให้ถูกต้อง',
              'warning'
            )
          }else {
            checkreq('1');
          }
        } else {
          swal(
            '',
            'กรุณากรอกข้อมูลให้ครบถ้วน',
            'error'
          )
          return false;
        }

        });


   $('#adddetail').click(function() {
     var table = $(this).closest('table');
     if (table.find('input:text').length < 100) {
       var x = $("tr[name=addtr]:last").closest('tr').nextAll('tr');
       var rowCount = $('#detailteaching tr').length;
       $.each(x, function(i, val) {
         val.remove();
       });

       table.append('<tr class="warning" name="addtr" id="row' + (rowCount - 1) + '"><td colspan="2"><div class="form-inline"><input type="text" class="form-control formlength" size="30" name="detail_topic' + (rowCount - 1) + '" id="detail_topic' + (rowCount - 1) +
         '" ><br><center><input type="button" class="btn btn-outline btn-danger" name="delbtn' + (rowCount - 1) + '" id="delbtn' + (rowCount - 1) +
           '" value="ลบ" onclick="deleteRow(' + (rowCount - 1) + ')"></center></div></td><td><input type="text" class="form-control formlength" name="dateteach' + (rowCount - 1) + '" id="dateteach' + (rowCount - 1) +
         '"></td><td width="25%" style="text-align: center;"><div class="form-inline">'+
         '<select class="form-control formlength timeselected" onfocus="this.size=5;" onblur="this.size=1;" onchange="this.size=1; this.blur();" name="timebegin' + (rowCount - 1) + '" id="timebegin' + (rowCount - 1) + '">'+
         '<option value="00:00:00" selected="selected">00:00 น.</option><option value="00:15:00">00:15 น.</option>' +
         '<option value="00:30:00">00:30 น.</option><option value="00:45:00">00:45 น.</option>' +
         '<option value="01:00:00">01:00 น.</option><option value="01:15:00">01:15 น.</option>' +
         '<option value="01:30:00">01:30 น.</option><option value="01:45:00">01:45 น.</option>' +
         '<option value="02:00:00">02:00 น.</option><option value="02:15:00">02:15 น.</option>' +
         '<option value="02:30:00">02:30 น.</option><option value="02:45:00">02:45 น.</option>' +
         '<option value="03:00:00">03:00 น.</option><option value="03:15:00">03:15 น.</option>' +
         '<option value="03:30:00">03:30 น.</option><option value="03:45:00">03:45 น.</option>' +
         '<option value="04:00:00">04:00 น.</option><option value="04:15:00">04:15 น.</option>' +
         '<option value="04:30:00">04:30 น.</option><option value="04:45:00">04:45 น.</option>' +
         '<option value="05:00:00">05:00 น.</option><option value="05:15:00">05:15 น.</option>' +
         '<option value="05:30:00">05:30 น.</option><option value="05:45:00">05:45 น.</option>' +
         '<option value="06:00:00">06:00 น.</option><option value="06:15:00">06:15 น.</option>' +
         '<option value="06:30:00">06:30 น.</option><option value="06:45:00">06:45 น.</option>' +
         '<option value="07:00:00">07:00 น.</option><option value="07:15:00">07:15 น.</option>' +
         '<option value="07:30:00">07:30 น.</option><option value="07:45:00">07:45 น.</option>' +
         '<option value="08:00:00">08:00 น.</option><option value="08:15:00">08:15 น.</option>' +
         '<option value="08:30:00">08:30 น.</option><option value="08:45:00">08:45 น.</option>' +
         '<option value="09:00:00">09:00 น.</option><option value="09:15:00">09:15 น.</option>' +
         '<option value="09:30:00">09:30 น.</option><option value="09:45:00">09:45 น.</option>' +
         '<option value="10:00:00">10:00 น.</option><option value="10:15:00">10:15 น.</option>' +
         '<option value="10:30:00">10:30 น.</option><option value="10:45:00">10:45 น.</option>' +
         '<option value="11:00:00">11:00 น.</option><option value="11:15:00">11:15 น.</option>' +
         '<option value="11:30:00">11:30 น.</option><option value="11:45:00">11:45 น.</option>' +
         '<option value="12:00:00">12:00 น.</option><option value="12:15:00">12:15 น.</option>' +
         '<option value="12:30:00">12:30 น.</option><option value="12:45:00">12:45 น.</option>' +
         '<option value="13:00:00">13:00 น.</option><option value="13:15:00">13:15 น.</option>' +
         '<option value="13:30:00">13:30 น.</option><option value="13:45:00">13:45 น.</option>' +
         '<option value="14:00:00">14:00 น.</option><option value="14:15:00">14:15 น.</option>' +
         '<option value="14:30:00">14:30 น.</option><option value="14:45:00">14:45 น.</option>' +
         '<option value="15:00:00">15:00 น.</option><option value="15:15:00">15:15 น.</option>' +
         '<option value="15:30:00">15:30 น.</option><option value="15:45:00">15:45 น.</option>' +
         '<option value="16:00:00">16:00 น.</option><option value="16:15:00">16:15 น.</option>' +
         '<option value="16:30:00">16:30 น.</option><option value="16:45:00">16:45 น.</option>' +
         '<option value="17:00:00">17:00 น.</option><option value="17:15:00">17:15 น.</option>' +
         '<option value="17:30:00">17:30 น.</option><option value="17:45:00">17:45 น.</option>' +
         '<option value="18:00:00">18:00 น.</option><option value="18:15:00">18:15 น.</option>' +
         '<option value="18:30:00">18:30 น.</option><option value="18:45:00">18:45 น.</option>' +
         '<option value="19:00:00">19:00 น.</option><option value="19:15:00">19:15 น.</option>' +
         '<option value="19:30:00">19:30 น.</option><option value="19:45:00">19:45 น.</option>' +
         '<option value="20:00:00">20:00 น.</option><option value="20:15:00">20:15 น.</option>' +
         '<option value="20:30:00">20:30 น.</option><option value="20:45:00">20:45 น.</option>' +
         '<option value="21:00:00">21:00 น.</option><option value="21:15:00">21:15 น.</option>' +
         '<option value="21:30:00">21:30 น.</option><option value="21:45:00">21:45 น.</option>' +
         '<option value="22:00:00">22:00 น.</option><option value="22:15:00">22:15 น.</option>' +
         '<option value="22:30:00">22:30 น.</option><option value="22:45:00">22:45 น.</option>' +
         '<option value="23:00:00">23:00 น.</option><option value="23:15:00">23:15 น.</option>' +
         '<option value="23:30:00">23:30 น.</option><option value="23:45:00">23:45 น.</option>' +
         '<option value="24:00:00">24:00 น.</option><option value="24:15:00">24:15 น.</option>' +
         '<option value="24:30:00">24:30 น.</option><option value="24:45:00">24:45 น.</option></select>' +
         ' <br> ถึง <br> '+
         '<select class="form-control formlength timeselected2" onfocus="this.size=5;" onblur="this.size=1;" onchange="this.size=1; this.blur();" name="timeend' + (rowCount - 1) + '" id="timeend' + (rowCount - 1) + '" >'+
         '<option value="00:00:00">00:00 น.</option><option value="00:15:00">00:15 น.</option>' +
         '<option value="00:30:00">00:30 น.</option><option value="00:45:00">00:45 น.</option>' +
         '<option value="01:00:00">01:00 น.</option><option value="01:15:00">01:15 น.</option>' +
         '<option value="01:30:00">01:30 น.</option><option value="01:45:00">01:45 น.</option>' +
         '<option value="02:00:00">02:00 น.</option><option value="02:15:00">02:15 น.</option>' +
         '<option value="02:30:00">02:30 น.</option><option value="02:45:00">02:45 น.</option>' +
         '<option value="03:00:00">03:00 น.</option><option value="03:15:00">03:15 น.</option>' +
         '<option value="03:30:00">03:30 น.</option><option value="03:45:00">03:45 น.</option>' +
         '<option value="04:00:00">04:00 น.</option><option value="04:15:00">04:15 น.</option>' +
         '<option value="04:30:00">04:30 น.</option><option value="04:45:00">04:45 น.</option>' +
         '<option value="05:00:00">05:00 น.</option><option value="05:15:00">05:15 น.</option>' +
         '<option value="05:30:00">05:30 น.</option><option value="05:45:00">05:45 น.</option>' +
         '<option value="06:00:00">06:00 น.</option><option value="06:15:00">06:15 น.</option>' +
         '<option value="06:30:00">06:30 น.</option><option value="06:45:00">06:45 น.</option>' +
         '<option value="07:00:00">07:00 น.</option><option value="07:15:00">07:15 น.</option>' +
         '<option value="07:30:00">07:30 น.</option><option value="07:45:00">07:45 น.</option>' +
         '<option value="08:00:00">08:00 น.</option><option value="08:15:00">08:15 น.</option>' +
         '<option value="08:30:00">08:30 น.</option><option value="08:45:00">08:45 น.</option>' +
         '<option value="09:00:00">09:00 น.</option><option value="09:15:00">09:15 น.</option>' +
         '<option value="09:30:00">09:30 น.</option><option value="09:45:00">09:45 น.</option>' +
         '<option value="10:00:00">10:00 น.</option><option value="10:15:00">10:15 น.</option>' +
         '<option value="10:30:00">10:30 น.</option><option value="10:45:00">10:45 น.</option>' +
         '<option value="11:00:00">11:00 น.</option><option value="11:15:00">11:15 น.</option>' +
         '<option value="11:30:00">11:30 น.</option><option value="11:45:00">11:45 น.</option>' +
         '<option value="12:00:00">12:00 น.</option><option value="12:15:00">12:15 น.</option>' +
         '<option value="12:30:00">12:30 น.</option><option value="12:45:00">12:45 น.</option>' +
         '<option value="13:00:00">13:00 น.</option><option value="13:15:00">13:15 น.</option>' +
         '<option value="13:30:00">13:30 น.</option><option value="13:45:00">13:45 น.</option>' +
         '<option value="14:00:00">14:00 น.</option><option value="14:15:00">14:15 น.</option>' +
         '<option value="14:30:00">14:30 น.</option><option value="14:45:00">14:45 น.</option>' +
         '<option value="15:00:00">15:00 น.</option><option value="15:15:00">15:15 น.</option>' +
         '<option value="15:30:00">15:30 น.</option><option value="15:45:00">15:45 น.</option>' +
         '<option value="16:00:00">16:00 น.</option><option value="16:15:00">16:15 น.</option>' +
         '<option value="16:30:00">16:30 น.</option><option value="16:45:00">16:45 น.</option>' +
         '<option value="17:00:00">17:00 น.</option><option value="17:15:00">17:15 น.</option>' +
         '<option value="17:30:00">17:30 น.</option><option value="17:45:00">17:45 น.</option>' +
         '<option value="18:00:00">18:00 น.</option><option value="18:15:00">18:15 น.</option>' +
         '<option value="18:30:00">18:30 น.</option><option value="18:45:00">18:45 น.</option>' +
         '<option value="19:00:00">19:00 น.</option><option value="19:15:00">19:15 น.</option>' +
         '<option value="19:30:00">19:30 น.</option><option value="19:45:00">19:45 น.</option>' +
         '<option value="20:00:00">20:00 น.</option><option value="20:15:00">20:15 น.</option>' +
         '<option value="20:30:00">20:30 น.</option><option value="20:45:00">20:45 น.</option>' +
         '<option value="21:00:00">21:00 น.</option><option value="21:15:00">21:15 น.</option>' +
         '<option value="21:30:00">21:30 น.</option><option value="21:45:00">21:45 น.</option>' +
         '<option value="22:00:00">22:00 น.</option><option value="22:15:00">22:15 น.</option>' +
         '<option value="22:30:00">22:30 น.</option><option value="22:45:00">22:45 น.</option>' +
         '<option value="23:00:00">23:00 น.</option><option value="23:15:00">23:15 น.</option>' +
         '<option value="23:30:00">23:30 น.</option><option value="23:45:00">23:45 น.</option>' +
         '<option value="24:00:00">24:00 น.</option><option value="24:15:00">24:15 น.</option>' +
         '<option value="24:30:00">24:30 น.</option><option value="24:45:00">24:45 น.</option></select>' +
         '</div></td><td><input type="text" class="form-control formlength" id="room' + (rowCount - 1) + '"</td></tr>');

         $('#dateteach'+(rowCount - 1)).datetimepicker({
            format: 'YYYY-MM-DD'
         });
       $.each(x, function(i, val) {
         table.append(val);
       });
     }
   });
 });

function deleteRow(r) {
 var i = r;

 var row = document.getElementById('row' + i);
 row.parentNode.removeChild(row);
}

function lastcal() {
  var temp1;
  var temp2;
  var temp3;
  var temp4;
  var temp5;
  var temp6;
  var totaltemp;

  document.getElementById("choice1cost").value==null||document.getElementById("choice1cost").value==0 ? temp1 = parseFloat("0") : temp1 = parseFloat(document.getElementById("choice1cost").value);
  document.getElementById("choice2cost").value==null||document.getElementById("choice2cost").value==0 ? temp2 = parseFloat("0") : temp2 = parseFloat(document.getElementById("choice2cost").value);
  document.getElementById("planecost").value==null||document.getElementById("planecost").value==0 ? temp3 = parseFloat("0") : temp3 = parseFloat(document.getElementById("planecost").value);
  document.getElementById("taxicost").value==null||document.getElementById("taxicost").value==0 ? temp4 = parseFloat("0") : temp4 = parseFloat(document.getElementById("taxicost").value);
  document.getElementById("selfcost").value==null||document.getElementById("selfcost").value==0 ? temp5 = parseFloat("0") : temp5 = parseFloat(document.getElementById("selfcost").value);
  document.getElementById("pernight").value==null||document.getElementById("pernight").value==0 ? temp6 = parseFloat("0") : temp6 = parseFloat(document.getElementById("pernight").value);

   totaltemp = temp1 + temp2 + temp3 + temp4 + temp5 + temp6;
   //alert(totaltemp);
   $("#totalcost").val(totaltemp);
   $("#callist").show();
   window.sumcheck = 1;
  }

  function checkreq(casesubmit) {

    if(casesubmit=='1'||casesubmit=='2')
    {

      if($("[required]").val()!=null && $("[required]").val()!="" && $("[required]").val()!= undefined && $("#hour").val()!=""&& $("#hour").val()!="0" && $("#hour").val()!="0.0" && $("#hour").val()!="0.00" && $("#hour").val()!="0.000")
      {
        if($('#costspec1').is(":checked"))
        {
          if($('#choice1num').val()!="0" && $('#choice1hour').val()!="0")
          {
            var check1 = "1";
          }else {
            var check1 ="0";
          }
        }else {
          var check1 = "1";
        }

        if($('#costspec2').is(":checked"))
        {
          if($('#choice2num').val()!="0" && $('#choice2hour').val()!="0")
          {
            var check2 = "1";
          }else {
            var check2 ="0";
          }
        }else {
          var check2 = "1";
        }

        if(document.querySelector("input[name='hotelchoice']:checked").value=="way1")
        {
          if($('#way1unit').val()!="0" && $('#numnight').val()!="0")
          {
            var hotel = "1";
          }else {
            var hotel = "0";
          }
        }else if (document.querySelector("input[name='hotelchoice']:checked").value=="way2") {
          if($('#way2unit').val()!="0" && $('#numnight').val()!="0")
          {
            var hotel = "1";
          }else {
            var hotel = "0";
          }
        }else {
          var hotel = "1";
        }

        if($('#transplane').is(":checked"))
        {
          if($('#AIR_DEPART').val()!="" && $('#AIR_ARRIVE').val()!="" && $('#planecost').val()!="0")
          {
            var plane = "1";
          }else {
            var plane ="0";
          }
        }else {
          var plane = "1";
        }

        if($('#transtaxi').is(":checked"))
        {
          if($('#TAXI_ARRIVE').val()!="" && $('#TAXI_ARRIVE').val()!="" && $('#taxicost').val()!="0")
          {
            var taxi = "1";
          }else {
            var taxi ="0";
          }
        }else {
          var taxi = "1";
        }

        if($('#transselfcar').is(":checked"))
        {
          if($('#SELF_DISTANCT').val()!="0" && $('#selfunit').val()!="0")
          {
            var self = "1";
          }else {
            var self ="0";
          }
        }else {
          var self = "1";
        }

        if((window.sumcheck==1 && (check1=="1" && check2 =="1") && hotel=="1" && plane=="1" && taxi=="1" && self=="1" ) && $("#hour").val()!=""&& $("#hour").val()!="0" && $("#hour").val()!="0.0" && $("#hour").val()!="0.00" && $("#hour").val()!="0.000" || document.querySelector("input[name='paymethod']:checked").value == "0" || casesubmit=='2' )
        {
            swal({
            title: 'แน่ใจหรือไม่',
            text: 'คุณต้องการยืนยันเพื่อส่งข้อมูลใช่หรือไม่',
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok',
            cancelButtonText: 'Cancel'
          }).then(function () {
            window.sumcheck = 0;
            submitfunc(casesubmit);
          }, function (dismiss) {
          // dismiss can be 'cancel', 'overlay',
          // 'close', and 'timer'
          if (dismiss === 'cancel') {

          }
            })
          }else if ($("#hour").val()=="" || $("#hour").val()=="0"  || $("#hour").val()=="0.0"  || $("#hour").val()=="0.00"  || $("#hour").val()=="0.000") {
            swal(
              '',
              'กรุณาระบุจำนวนชั่วโมงของหัวข้อที่เชิญมาสอนให้ถูกต้อง',
              'error'
            )
          }else if (check1=="0"||check2=="0") {
            swal(
              '',
              'กรุณากรอกค่าสอนพิเศษให้ถูกต้อง',
              'error'
            )
          }else if (hotel=="0") {
            swal(
              '',
              'กรุณากรอกค่าที่พักให้ถูกต้อง',
              'error'
            )
          }else if (plane=="0") {
            swal(
              '',
              'กรุณากรอกค่าพาหนะเดินทางด้วยเครื่องบินให้ถูกต้อง',
              'error'
            )
          }else if (taxi=="0") {
            swal(
              '',
              'กรุณากรอกค่าพาหนะเดินทางด้วยแท็กซี่ให้ถูกต้อง',
              'error'
            )
          }else if (self=="0") {
            swal(
              '',
              'กรุณากรอกค่าพาหนะเดินทางด้วยรถยนต์ส่วนตัวให้ถูกต้อง',
              'error'
            )
          }else {
            swal(
              '',
              'กรุณากดปุ่ม "คำนวณค่าใช้จ่ายทั้งหมด" ในหัวข้อที่ 3',
              'error'
            )
          }
      }else if ($("#hour").val()==""|| $("#hour").val()=="0" || $("#hour").val()=="0.0" || $("#hour").val()=="0.00" || $("#hour").val()=="0.000") {
        swal(
          '',
          'กรุณาระบุจำนวนชั่วโมงของหัวข้อที่เชิญมาสอนให้ถูกต้อง',
          'error'
        )
      }
      else {

        //alert('กรุณากรอกข้อมูลให้ครบถ้วน');
        swal(
          '',
          'กรุณากรอกข้อมูลให้ครบถ้วน',
          'error'
        )
        return false;
        }
    }
    else {

      if(document.querySelector("input[name='levelteacher']:checked").value=="pro")
      {
        if($('#GOV_LEVEL').val()!="")
        {
          var level = "1";
        }else {
          var level = "0";
        }
      }else {
        if($('#NORM_LEVEL').val()!="")
        {
          var level = "1";
        }else {
          var level = "0";
        }
      }

      if($('#costspec1').is(":checked"))
      {
        if($('#choice1num').val()!="0" && $('#choice1hour').val()!="0")
        {
          var check1 = "1";
        }else {
          var check1 ="0";
        }
      }else {
        var check1 = "1";
      }

      if($('#costspec2').is(":checked"))
      {
        if($('#choice2num').val()!="0" && $('#choice2hour').val()!="0")
        {
          var check2 = "1";
        }else {
          var check2 ="0";
        }
      }else {
        var check2 = "1";
      }

      if(document.querySelector("input[name='hotelchoice']:checked").value=="way1")
      {
        if($('#way1unit').val()!="0" && $('#numnight').val()!="0")
        {
          var hotel = "1";
        }else {
          var hotel = "0";
        }
      }else if (document.querySelector("input[name='hotelchoice']:checked").value=="way2") {
        if($('#way2unit').val()!="0" && $('#numnight').val()!="0")
        {
          var hotel = "1";
        }else {
          var hotel = "0";
        }
      }else {
        var hotel = "1";
      }

      if($('#transplane').is(":checked"))
      {
        if($('#AIR_DEPART').val()!="" && $('#AIR_ARRIVE').val()!="" && $('#planecost').val()!="0")
        {
          var plane = "1";
        }else {
          var plane ="0";
        }
      }else {
        var plane = "1";
      }

      if($('#transtaxi').is(":checked"))
      {
        if($('#TAXI_ARRIVE').val()!="" && $('#TAXI_ARRIVE').val()!="" && $('#taxicost').val()!="0")
        {
          var taxi = "1";
        }else {
          var taxi ="0";
        }
      }else {
        var taxi = "1";
      }

      if($('#transselfcar').is(":checked"))
      {
        if($('#SELF_DISTANCT').val()!="0" && $('#selfunit').val()!="0")
        {
          var self = "1";
        }else {
          var self ="0";
        }
      }else {
        var self = "1";
      }

      if($("#course").val()!="" && $("#numstudent").val()!="" && $("#reason").val()!="" && $("#hour").val()!=""&& $("#hour").val()!="0" && $("#hour").val()!="0.0" && $("#hour").val()!="0.00" && $("#hour").val()!="0.000" && (window.sumcheck==1 && (check1=="1" && check2 =="1") && hotel=="1" && plane=="1" && taxi=="1" && self=="1")  || document.querySelector("input[name='paymethod']:checked").value == "0" || casesubmit=='2')
      {
        swal({
        title: 'แน่ใจหรือไม่',
        text: 'คุณต้องการยืนยันเพื่อส่งข้อมูลใช่หรือไม่',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ok',
        cancelButtonText: 'Cancel'
      }).then(function () {
        submitfunc('1');
      }, function (dismiss) {
      // dismiss can be 'cancel', 'overlay',
      // 'close', and 'timer'
      if (dismiss === 'cancel') {

      }
        })
    }else if ($("#hour").val()==""|| $("#hour").val()=="0" || $("#hour").val()=="0.0" || $("#hour").val()=="0.00" || $("#hour").val()=="0.000") {
      swal(
        '',
        'กรุณาระบุจำนวนชั่วโมงของหัวข้อที่เชิญมาสอนให้ถูกต้อง',
        'error'
      )
    }else if (check1=="0"||check2=="0") {
      swal(
        '',
        'กรุณากรอกค่าสอนพิเศษให้ถูกต้อง',
        'error'
      )
    }else if (hotel=="0") {
      swal(
        '',
        'กรุณากรอกค่าที่พักให้ถูกต้อง',
        'error'
      )
    }else if (plane=="0") {
      swal(
        '',
        'กรุณากรอกค่าพาหนะเดินทางด้วยเครื่องบินให้ถูกต้อง',
        'error'
      )
    }else if (taxi=="0") {
      swal(
        '',
        'กรุณากรอกค่าพาหนะเดินทางด้วยแท็กซี่ให้ถูกต้อง',
        'error'
      )
    }else if (self=="0") {
      swal(
        '',
        'กรุณากรอกค่าพาหนะเดินทางด้วยรถยนต์ส่วนตัวให้ถูกต้อง',
        'error'
      )
    }else if(window.sumcheck==0){
      swal(
        '',
        'กรุณากดปุ่ม "คำนวณค่าใช้จ่ายทั้งหมด" ในหัวข้อที่ 3',
        'error'
      )
    }
      else {

        //alert('กรุณากรอกข้อมูลให้ครบถ้วน');
        swal(
          '',
          'กรุณากรอกข้อมูลให้ครบถ้วน',
          'error'
        )
        return false;
        }
    }
  }

  function confreset() {
      //confirm("ต้องการรีเซ็ตข้อมูลทั้งหมดหรือไม่");
      swal({
        title: 'แน่ใจหรือไม่',
        text: "ต้องการรีเซ็ตข้อมูลทั้งหมดหรือไม่",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      }).then(function () {
        document.getElementById("formheader").reset();
        document.getElementById("form1").reset();
        var rowtr = ($('#detailteaching tr').length)-2
        for (var i = 1; i <=rowtr; i++) {
          var row = document.getElementById('row' + i);
          row.parentNode.removeChild(row);
        }

        document.getElementById('formdrpd').style.display = "none";
        var selectobject = document.getElementById('teachername');
        var long = selectobject.length;
        if(long!=0 && long!=null)
        {
          for (var i=0; i<=long; i++){
            document.getElementsByName("teachername")[0].remove(0);
          }
        }

        swal(
          'เคลียร์!',
          'รีเซ็ตข้อมูลเรียบร้อยแล้ว',
          'success'
        )
      }, function (dismiss) {
      // dismiss can be 'cancel', 'overlay',
      // 'close', and 'timer'
      if (dismiss === 'cancel') {

      }
    })
  }



 </script>

</header>
<body class="mybox">

<div id="wrapper" style="padding-left: 30px; padding-right: 30px;">
  <div class="row">
    <center>
      <h3 class="page-header">การเชิญอาจารย์พิเศษ</h3>
      <h5 id="hiddenh5">กระบวนวิชาที่ต้องการเชิญอาจารย์พิเศษ</h5>
      <h5 id="hiddenh5_found"></h5>

      <div id="overtimemsg" class="alert alert-danger"><div class="glyphicon glyphicon-alert" style="color: red;font-size:18px;" ><b> ไม่สามารถกรอกแบบขออนุมัติเชิญอาจารย์พิเศษ <br><br> เนื่องจากช่วงเวลาที่ทำการยังไม่เปิดให้บริการหรือสิ้นสุดลง !</b></div><b style="color: red;font-size:16px;"> <p id="overtimemsg2"></p></b> </div>
      <form id="formheader" data-toggle="validator" role="form">
        <div id="formchecksj" class="form-inline" style="font-size:16px;">
                  <div class="form-group ">
                     <input type="text" class="form-control formlength numonly" id="id" name="id" size="7" placeholder="e.g. 204111" maxlength="6" pattern=".{6,6}" required >
                  </div>
                  <input type="hidden" name="type" value="1">
                 <button type="button" class="btn btn-outline btn-primary" onclick="checksubject(1,2);">ค้นหา</button>
         </div>
        <h5 id="notfound" style="color:#ff0000; display:none;">รายวิชานี้ยังไม่เคยเชิญอาจารย์พิเศษมาสอน กดปุ่มเพิ่มรายชื่อใหม่ เพื่อกรอกข้อมูล </h5>
    <div id="formdrpd" style="display: none;">
      <div class="form-inline">
        <div style="font-size:14px;">รายชื่ออาจารย์พิเศษที่เคยเชิญมาสอนในวิชานี้</div>
        <div class="form-group " style="font-size:16px;">
          <select class="form-control formlength required" id="teachername" name="teachername" style="width: 200px;" required >
          </select>
         </div>
         <input type="button" class="btn btn-outline btn-primary" name="subhead" id="subhead" value="ยืนยัน" onclick="checksubject(2,2);">
         <input type="button" class="btn btn-outline btn-success" name="subhead2" id="subhead2" value="เพิ่มรายชื่อใหม่" onclick="checksubject(3,2);">
       </div>
     </div>

         <div id="search_1hide" class="row form-inline" style="font-size:14px;">
           <div class="form-group" style="margin-top:10px;">
             เพิ่มเติม/ค้นหา รายชื่ออาจารย์พิเศษ
             <input type="text" class="form-control formlength" name="search_1" id="search_1" list="dtl1" placeholder="ชื่อ-นามสกุล" size="35" onkeydown="searchname1();" >
             <datalist id="dtl1">
             </datalist>
             <input type="button" class="btn btn-outline btn-primary" name="searchname" id="searchname" value="ยืนยันข้อมูล" onclick="checksubject(4,2);">
            </div>
          </div>
      </center>
      </form>

      <div id="dlhide" class="panel panel-default"><br>
      <form name="form1" id="form1" data-toggle="validator" role="form"  method="post">
      <div class="row form-inline" style="font-size:16px;">
        <center><div class="form-group">
      ภาควิชา
        <select class="form-control formlength required" id="department" style="width: auto;" id="select" required >
         <option value="0" selected="selected">--------------</option>
         <?php
          for ($i=0; $i <sizeof($dept) ; $i++) {
            echo "<option value=".$dept[$i]['code'].">".$dept[$i]['name']."</option>";
          }
          ?>
       </select>
        </div></center>
      </div>

    <ol>

      <li style="font-size: 14px;">
        <b>1. รายละเอียดของอาจารย์พิเศษ</b>
        <br>
        <div class="row">
          <ul>
          <div class="form-inline">
            <li>คำนำหน้า &nbsp;&nbsp;<div class="form-group">
              <select class="form-control formlength" name="pre" id="pre" required>
                <?php
                      echo '<option value="0">----</option>';
                    for($i=0;$i<count($prefix);$i++)
                    {
                      echo '<option value="'.$prefix[$i]["prefix"].'">'.$prefix[$i]["prefix"].'</option>';
                    }
                 ?>
              </select>
              </div>&nbsp;&nbsp;&nbsp;&nbsp;
              ชื่อ &nbsp;&nbsp;<div class="form-group"><input type="text" class="form-control formlength" id="fname" size="20" required ></div>&nbsp;
              นามสกุล &nbsp;&nbsp;<div class="form-group"><input type="text" class="form-control formlength" id="lname" size="20" required ></div>&nbsp;
          </div>

          <div class="form-inline">
            <li>ตำแหน่ง &nbsp;&nbsp;<div class="form-group"><input type="text" class="form-control formlength " id="position" size="35" required ></div></li>
          </div>
          <li>คุณวุฒิ/สาขาที่เชี่ยวชาญ &nbsp;&nbsp;</li>
              <div class="form-group"><textarea class="form-control textareawidth" name="qualification" id="qualification" rows="3"  required></textarea></div>

          <li>สถานที่ทำงาน / สถานที่ติดต่อ &nbsp;&nbsp;
              <div class="form-group"><textarea class="form-control textareawidth" name="workplace" id="workplace" rows="3" ></textarea></div>
          </li>

          <div class="form-inline">
            <li>โทรศัพท์ &nbsp;&nbsp;<div class="form-group"><input type="text" class="form-control formlength numonly" id="tel" size="20" maxlength="10"  ></div>
              &nbsp;ต่อ&nbsp;<input type="text" class="form-control formlength numonly" id="subtel" size="2" maxlength="5"></li>
        </div>
        <div class="form-inline">
          <li>โทรศัพท์มือถือ &nbsp;&nbsp;<div class="form-group"><input type="text" class="form-control formlength numonly" id="mobile" size="20" maxlength="10"  ></div>
            </li>
      </div>

        <div class="form-inline">
          <li>E-mail &nbsp;&nbsp;<div class="form-group"><input style="height: 30px;" type="email" class="form-control formlength" id="email" size="45"  ></div></li>
        </div>
        <div class="form-inline">
          <li>ประวัติการเชิญมาสอน <br>
              <div class="form-group">
                <div class="radio">
                <input type="radio" name="topic" id="topic1" value="already" required checked> &nbsp;เคยเชิญมาสอน
                &nbsp;<input type="radio" name="topic" id="topic2" value="yet"> &nbsp;ไม่เคยเชิญมาสอน
              </div>
            </div>
            </li>
        </div>
      </ul>
    </div>
      </li>
      <br>
      <li style="font-size: 14px;">
        <b>2. รายละเอียดกระบวนวิชา</b>
          <div class="row">
            <ul>
              <div class="form-inline">
                <li>รหัสกระบวนวิชาที่สอน &nbsp;<div class="form-group"><input type="text" class="form-control formlength numonly" name="course" id="course" size="6" maxlength="6" required readonly ></div></li>
              </div>
              <div class="form-inline">
                <li>จำนวนนักศึกษา &nbsp;<div class="form-group"><input type="text" class="form-control formlength numonly" name="numstudent" id="numstudent" size="6" maxlength="6"  required ></div> คน</li>
              </div>
              <div class="form-inline">
                <li>กระบวนวิชานี้เป็นวิชา &nbsp;<br />
                  <div class="form-group"><div class="radio">
                    <input type="radio" name="type_course" id="type_course" value="require" required checked> &nbsp;บังคับ
                    &nbsp;<input type="radio" name="type_course" id="type_course" value="choose"> &nbsp;เลือก
                  </div></div>
                </li>
              </div>
              </li>
                <div class="form-group"><li>เหตุผลและความจำเป็นในการเชิญอาจารย์พิเศษ  &nbsp;&nbsp;<br /><textarea class="form-control textareawidth" id="reason" rows="4"  required ></textarea></li></div>
                <li> รายละเอียดในการสอน <br>
                  <div class="col-md-12">
                  <div class="table-responsive">
                  <table id="detailteaching" style="overflow-x:auto" class="table table-bordered table-hover" style="font-size: 14px; ">
                    <tr align="center" class="success">
                      <th colspan="2" style="text-align: center;">หัวข้อบรรยายปฏิบัติการ</th>
                      <th style="text-align: center;">วัน/เดือน/ปี ที่สอน</th>
                      <th style="text-align: center;" width="25%">เวลา</th>
                      <th style="text-align: center;">ห้องเรียน</th>
                    </tr>
                    <tr name="addtr">
                      <td colspan="5" style="text-align: center;"><input type="button" class="btn btn-outline btn-success" name="addbtn" id="adddetail" value="เพิ่ม" required> </td>
                    </tr>
                  </table>
                </div>
                </div>
                </li>
                <div class="form-inline">
                  <div class="form-group"><li>จำนวนชั่วโมงของหัวข้อที่เชิญมาสอนคิดเป็นร้อยละ  &nbsp;<input type="text" class="form-control formlength numonly" name="" id="hour" size="3" maxlength="10" value="0" required > &nbsp;ของทั้งกระบวนวิชา</li></div>
                </div>
            </ul>
          </div>
      </li>
      <br>
      <li  style="font-size: 14px;;">
        <b>3. ค่าใช้จ่าย </b>
        <ul>
        <div class="form-inline">
          <div class="radio">
            <div class="form-group"><input type="radio" name="paymethod" id="paymethod1" value="0" checked>&nbsp;&nbsp;ไม่มีค่าใช้จ่าย </div>&nbsp;&nbsp;&nbsp;
            <div class="form-group"><input type="radio" name="paymethod" id="paymethod2" value="1">&nbsp;&nbsp;มีค่าใช้จ่าย</div>
          </div>
        </div>
          <div id="costhide">
          <div class="form-inline">
            <li>อาจารย์พิเศษเป็น &nbsp;</li>
            <div class="radio">
              <div class="form-group"><input type="radio"  name="levelteacher" id="levelteacher" value="pro" checked>&nbsp; ข้าราชการระดับ &nbsp;<input type="text" class="form-control formlength resettext" name="GOV_LEVEL" id="GOV_LEVEL"/></div>
              <br>
              <div class="form-group"><input type="radio"  name="levelteacher" id="levelteacher" value="norm">&nbsp; บุคคลเอกชนเทียบตำแหน่งระดับ &nbsp;<input type="text" class="form-control formlength resettext" name="NORM_LEVEL" id="NORM_LEVEL"/></div>
            </div>
          </div>
          <div class="form-inline">
            <li>ค่าสอนพิเศษ</li>
            <div class="checkbox">
              <div class="form-group">
                <input type="checkbox" class="resetchecked"  name="costspec" id="costspec1" value="choice1"> &nbsp;ปริญญาตรีบรรยาย <input type="text" class="form-control formlength numonly resetvalue keyupcheck nonzero1" name="choice1num" id="choice1num"  size="5" value="0"> ต่อชม.&nbsp;
              จำนวน&nbsp;&nbsp;<input type="text" class="form-control formlength numonly resetvalue keyupcheck nonzero1" id="choice1hour" size="5" data-minlength="1" min="0" max="99" value="0">&nbsp;&nbsp;ชั่วโมง&nbsp;&nbsp;เป็นเงิน&nbsp;&nbsp;
              <input type="text" class="form-control formlength numonly resetvalue" id="choice1cost" size="5" data-minlength="5" min="0" max="99999" value="0" READONLY>&nbsp;&nbsp;บาท
              </div><br>
              <div class="form-group"><input type="checkbox" class="resetchecked" name="costspec" id="costspec2" value="choice2">&nbsp; ปริญญาตรีปฏิบัติการ <input type="text" class="form-control formlength numonly resetvalue keyupcheck nonzero2" name="choice2num" id="choice2num" size="5" value="0"> ต่อชม.&nbsp;
              จำนวน&nbsp;&nbsp;<input type="text" class="form-control formlength numonly resetvalue keyupcheck nonzero2" id="choice2hour" size="5" data-minlength="1" min="0" max="99" value="0">&nbsp;&nbsp;ชั่วโมง&nbsp;&nbsp;เป็นเงิน&nbsp;&nbsp;
              <input type="text" class="form-control formlength numonly resetvalue" id="choice2cost" size="5" data-minlength="5" min="0" max="99999" value="0" READONLY>&nbsp;&nbsp;บาท
              </div>
            </div>
          </div>
          <div class="form-inline">
            <li>ค่าพาหนะเดินทาง </li>
            <div class="checkbox">
              <div class="form-group"><label><input type="checkbox" class="resetchecked"name="transchoice" id="transplane">&nbsp;&nbsp;เครื่องบิน ระหว่าง &nbsp;<input type="text" class="form-control formlength resettext" name="AIR_DEPART" id="AIR_DEPART" placeholder="ต้นทาง"/> - <input type="text" class="form-control formlength resettext" name="AIR_ARRIVE" id="AIR_ARRIVE" placeholder="ปลายทาง"/>  &nbsp;&nbsp;เป็นเงิน&nbsp;&nbsp;<input type="text" class="form-control formlength numonly resetvalue keyupcheck" name="planecost" id="planecost" size="5" value="0">&nbsp;&nbsp;บาท</label></div>
              <br>
              <div class="form-group"><label><input type="checkbox" class="resetchecked" name="transchoice" id="transtaxi">&nbsp;&nbsp;ค่า taxi &nbsp;<input type="text" class="form-control formlength resettext" name="TAXI_DEPART" id="TAXI_DEPART" placeholder="ต้นทาง"/> - <input type="text" class="form-control formlength resettext" name="TAXI_ARRIVE" id="TAXI_ARRIVE" placeholder="ปลายทาง"/> &nbsp;&nbsp;เป็นเงิน&nbsp;&nbsp;<input type="text" class="form-control formlength numonly resetvalue keyupcheck" name="taxicost" id="taxicost" size="5" value="0">&nbsp;&nbsp;บาท</label></div>
              <br>
              <div class="form-group"><label><input type="checkbox" class="resetchecked" name="transchoice" id="transselfcar">&nbsp;&nbsp;รถยนต์ส่วนตัว ระยะทางไป-กลับ ระยะทาง &nbsp;
                <input type="text" class="form-control formlength numonly resetvalue keyupcheck" name="SELF_DISTANCT" id="SELF_DISTANCT" size="5" data-minlength="1" min="0" max="9999" value="0"> &nbsp;กิโลเมตร  กิโลเมตรละ
                <input type="text" class="form-control formlength numonly resetvalue keyupcheck" name="selfunit" id="selfunit" size="4" value="0">
                 บาท &nbsp;&nbsp;เป็นเงิน&nbsp;&nbsp;
                <input type="text" class="form-control formlength numonly resetvalue" name="selfcost" id="selfcost" size="5" data-minlength="2" min="0" max="99999" value="0" READONLY >&nbsp;&nbsp;บาท</label></div>
              </div>
          </div>
          <div class="form-inline">
            <li>ค่าที่พัก</li>
            <div class="form-group"><div class="radio">
              <input type="radio" name="hotelchoice" id="hotelchoice" value="way3" required checked>&nbsp;&nbsp; ไม่เบิกค่าที่พัก&nbsp;&nbsp;<br>
              <input type="radio" name="hotelchoice" id="hotelchoice" value="way1" >&nbsp;&nbsp; เบิกได้เท่าจ่ายจริงไม่เกิน <input type="text" class="form-control formlength numonly resetvalue keyupcheck" name="way1unit" id="way1unit" size="4" value="0" > บาท/คน/คืน&nbsp;&nbsp;<br>
              <input type="radio" name="hotelchoice" id="hotelchoice" value="way2">&nbsp;&nbsp; เบิกในลักษณะเหมาจ่ายไม่เกิน <input type="text" class="form-control formlength numonly resetvalue keyupcheck" name="way2unit" id="way2unit" size="4" value="0" > บาท/คน/คืน &nbsp;&nbsp;
            </div></div>
            <br><div class="form-group">จำนวน&nbsp;&nbsp;<input type="text" class="form-control formlength numonly resetvalue keyupcheck" name="numnight" id="numnight" size="5" min="0" max="99999" value="0"  >&nbsp;&nbsp;คืน
            &nbsp;&nbsp;คิดเป็นเงิน&nbsp;&nbsp;<input type="text" class="form-control formlength numonly resetvalue" name="pernight" id="pernight" size="5" min="0" max="99999" value="0" READONLY  >&nbsp;&nbsp;บาท
          </div>
          </div>
          <br>
          <font color="red"><b> ** กรุณากดปุ่มสรุปค่าใช้จ่ายทั้งหมดทุกครั้งก่อนส่งข้อมูล **</b></font>
          <div class="form-inline">
            <input type="button" class="btn btn-outline btn-primary" name="calculatebtn" id="calculatebtn" value="คำนวณค่าใช้จ่ายทั้งหมด" onclick="lastcal();">
          </div>
          <br>
          <div class="form-inline">
            <li style="font-size: 16px;" id="callist"><b>สรุปค่าใช้จ่ายทั้งหมด</b>&nbsp;&nbsp;<input type="text" class="form-control formlength numonly resetvalue" name="totalcost" id="totalcost" size="10" value="0" READONLY >&nbsp;&nbsp;บาท</li>
            <br>
          </div>
        </div>
        </ul>
      </li>
      <li  style="font-size: 14px;" >
        <b>4. เลือกไฟล์ Curriculum Vitae (CV) เพื่ออัปโหลด : </b><br />
      <div id="cvdanger" class="col-md-10 form-inline form-group">
        <input type="file" class="filestyle" id="cv" name="cv" accept=".doc,.docx,.pdf" data-icon="false"><font color="red"></font>
        &nbsp;<span id="spanfile"></span>&nbsp;&nbsp;
        <input id="downloadfile" style="display:none; font-size: 14px;" class="btn btn-outline btn-primary" type="button" value="ดาวน์โหลดไฟล์ cv" onclick="downloadfunc();">
      </div>
      </li>
    </ol>
    <br>
    <br>
    <div id="buttondiv" align="center">
      <input type="button" style="font-size: 18px; display:none;" class="btn btn-outline btn-success" name="submitbtn2" id="submitbtn2" value="ยืนยันเพื่อส่งข้อมูล" onclick="checkreq('0')">
      <input type="submit" style="font-size: 18px;" class="btn btn-outline btn-success" name="submitbtn" id="submitbtn" value="ยืนยันเพื่อส่งข้อมูล">
      <input type="button" style="font-size: 18px;" class="btn btn-outline btn-warning" name="draftbtn" id="draftbtn" value="บันทึกข้อมูลชั่วคราว" onclick="checkreq('2');">
      <!-- <input type="button" style="font-size: 18px;" class="btn btn-outline btn-danger" name="resetbtn" id="resetbtn" onclick="confreset();" value="รีเซ็ตข้อมูล"> -->
      <input type="button" style="font-size: 18px;" class="btn btn-outline btn-danger" name="delbtn" id="delbtn" onclick="deletedata();" value="ลบข้อมูล">

    </div>
</form>
</div>
</div>
</body>
</html>

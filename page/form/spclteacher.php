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
 <link rel="stylesheet" href="../dist/css/sweetalert2.min.css">

 <!-- validator -->
 <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>


 <style>
 input[type=text],input[type=date],input[type=time]{
   height: 30px;
 }

 input[type=number]{
   height: 30px;
 }

 </style>

 <script>
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
   if(temp['TEACHERDATA']['DEPARTMENT']=="1")
   {
     document.getElementById('department').value = "ภาควิชาวิทยาศาสตร์เภสัชกรรม";
   }else {
     document.getElementById('department').value = "ภาควิชาบริบาลเภสัชกรรม";
   }

   document.getElementById('pre').value = temp['TEACHERDATA']['PREFIX'];
   var constring = temp['TEACHERDATA']['FNAME'];
   var constring2 = temp['TEACHERDATA']['LNAME'];
   document.getElementById('fname').value = constring;
   document.getElementById('lname').value = constring2;
   document.getElementById('position').value = temp['TEACHERDATA']['POSITION'];
   document.getElementById('qualification').value = temp['TEACHERDATA']['QUALIFICATION'];
   document.getElementById('workplace').value = temp['TEACHERDATA']['WORKPLACE'];
   document.getElementById('tel').value = temp['TEACHERDATA']['TELEPHONE']['NUMBER'];
   document.getElementById('subtel').value = temp['TEACHERDATA']['TELEPHONE']['SUB'];
   document.getElementById('mobile').value = temp['TEACHERDATA']['MOBILE'];
   document.getElementById('email').value = temp['TEACHERDATA']['EMAIL'];
   var choice1 = temp['TEACHERDATA']['HISTORY'];
   $('input[name="topic"][value=' + choice1 + ']').prop('checked', true);
   var topic = $("input[name='topic']").val();
   if(topic=="yet")
     {
       $('#cvlist').hide();
       $('input[name=cv]').prop('required', 'false');
     }
     else {
       $('#cvlist').show();
       $('input[name=cv]').prop('required', 'true');
     }


   //part2
   document.getElementById('course').value = temp['COURSEDATA']['COURSE_ID'];
   document.getElementById('numstudent').value = temp['COURSEDATA']['NOSTUDENT'];
   var choice2 = temp['COURSEDATA']['TYPE_COURSE'];
   $('input[name="type_course"][value=' + choice2 + ']').prop('checked', true);
   document.getElementById('reason').value = temp['COURSEDATA']['REASON'];
   document.getElementById('hour').value = temp['COURSEDATA']['HOUR'];
   //table
   for(var tr=1;tr<=temp['NUMTABLE'];tr++)
   {
     var table = $('#detailteaching').closest('table');
     if (table.find('input:text').length < 100) {
       var x = $("tr[name=addtr]:last").closest('tr').nextAll('tr');
       var rowCount = $('#detailteaching tr').length;
       $.each(x, function(i, val) {
         val.remove();
       });
       table.append('<tr class="warning" name="addtr" id="row' + tr + '"><td colspan="2"><div class="form-inline"><input type="button" class="btn btn-outline btn-danger" name="delbtn' + tr + '" id="delbtn' + tr +
         '" value="ลบ" onclick="deleteRow(' + tr + ')">&nbsp;&nbsp;<input type="text" class="form-control" name="detail_topic' + tr + '" id="detail_topic' + tr +
         '" size="30" value="'+temp['COURSEDATA']['DETAIL']['TOPICLEC'][tr-1]+'"></div></td><td><input type="date" class="form-control" name="dateteach' + tr + '" id="dateteach' + tr +
         '" size="2" value="'+temp['COURSEDATA']['DETAIL']['DATE'][tr-1]+'"></td><td width="25%" style="text-align: center;"><div class="form-inline"><input type="time" class="form-control" name="timebegin' + tr + '" id="timebegin' + tr + '" size="2" value="'+temp['COURSEDATA']['DETAIL']['TIME']['BEGIN'][tr-1]+'" >  ถึง  <input type="time" class="form-control" name="timeend'
          + tr + '" id="timeend' + tr + '" size="2" value="'+temp['COURSEDATA']['DETAIL']['TIME']['END'][tr-1]+'"></div></td><td><input type="text" class="form-control" id="room' + tr + '" value="'+temp['COURSEDATA']['DETAIL']['ROOM'][tr-1]+
          '"></td></tr>');
       $.each(x, function(i, val) {
         table.append(val);
       });
     }
   }

   //part3
   var choice3 = temp['PAYMENT']['LVLTEACHER']['CHOICE'];
   $('input[name="levelteacher"][value=' + choice3 + ']').prop('checked', true);
   if(choice3=="pro")
   {
     document.getElementById('GOV_LEVEL').value = temp['PAYMENT']['LVLTEACHER']['DESCRIPT'];
   }else {
     document.getElementById('NORM_LEVEL').value = temp['PAYMENT']['LVLTEACHER']['DESCRIPT'];
   }

   var choice4 = temp['PAYMENT']['COSTSPEC']['CHOICE'];
   $('input[name="costspec"][value=' + choice4 + ']').prop('checked', true);
   if(choice4=="choice1")
   {
     document.getElementById('choice1num').value = temp['PAYMENT']['COSTSPEC']['NUMBER'];
     document.getElementById('choice1hour').value = temp['PAYMENT']['COSTSPEC']['HOUR'];
     document.getElementById('choice1cost').value = temp['PAYMENT']['COSTSPEC']['COST'];
   }else {
     document.getElementById('choice2num').value = temp['PAYMENT']['COSTSPEC']['NUMBER'];
     document.getElementById('choice2hour').value = temp['PAYMENT']['COSTSPEC']['HOUR'];
     document.getElementById('choice2cost').value = temp['PAYMENT']['COSTSPEC']['COST'];
   }

   if(temp['PAYMENT']['COSTTRANS']['TRANSPLANE']['CHECKED'] == "true")
   {
     document.getElementById('transplane').checked = true;
     document.getElementById('AIR_DEPART').value = temp['PAYMENT']['COSTTRANS']['TRANSPLANE']['DEPART'];
     document.getElementById('AIR_ARRIVE').value = temp['PAYMENT']['COSTTRANS']['TRANSPLANE']['ARRIVE'];
     document.getElementById('planecost').value = temp['PAYMENT']['COSTTRANS']['TRANSPLANE']['COST'];
   }

   if(temp['PAYMENT']['COSTTRANS']['TRANSTAXI']['CHECKED'] == "true")
   {
     document.getElementById('transtaxi').checked = true;
     document.getElementById('TAXI_DEPART').value = temp['PAYMENT']['COSTTRANS']['TRANSTAXI']['DEPART'];
     document.getElementById('TAXI_ARRIVE').value = temp['PAYMENT']['COSTTRANS']['TRANSTAXI']['ARRIVE'];
     document.getElementById('taxicost').value = temp['PAYMENT']['COSTTRANS']['TRANSTAXI']['COST'];
   }

   if(temp['PAYMENT']['COSTTRANS']['TRANSSELFCAR']['CHECKED'] == "true")
   {
     document.getElementById('transselfcar').checked = true;
     document.getElementById('SELF_DISTANCT').value = temp['PAYMENT']['COSTTRANS']['TRANSSELFCAR']['DISTANCT'];
     document.getElementById('selfunit').value = temp['PAYMENT']['COSTTRANS']['TRANSSELFCAR']['UNIT'];
     document.getElementById('selfcost').value = temp['PAYMENT']['COSTTRANS']['TRANSSELFCAR']['COST'];
   }

   var choice5 = temp['PAYMENT']['COSTHOTEL']['CHOICE'];
   $('input[name="hotelchoice"][value=' + choice5 + ']').prop('checked', true);
   if(choice5=="way3")
   {
     document.getElementById('numnight').value = temp['PAYMENT']['COSTHOTEL']['NUMBER'];
     document.getElementById('pernight').value = temp['PAYMENT']['COSTHOTEL']['PERNIGHT'];
   }else if (choice5=="way1") {
     document.getElementById('way1unit').value = temp['PAYMENT']['COSTHOTEL']['UNIT'];
     document.getElementById('numnight').value = temp['PAYMENT']['COSTHOTEL']['NUMBER'];
     document.getElementById('pernight').value = temp['PAYMENT']['COSTHOTEL']['PERNIGHT'];
   }else {
     document.getElementById('way2unit').value = temp['PAYMENT']['COSTHOTEL']['UNIT'];
     document.getElementById('numnight').value = temp['PAYMENT']['COSTHOTEL']['NUMBER'];
     document.getElementById('pernight').value = temp['PAYMENT']['COSTHOTEL']['PERNIGHT'];
   }
   document.getElementById('totalcost').value = temp['PAYMENT']['TOTALCOST'];
   $('#callist').show();

 }

 function checksubject(btntype,type){
   if(btntype==1)
   {
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

                        var temp = $.parseJSON(result);
                        //console.log(Object.keys(temp).length);
                        if(temp['info']!=false && temp[0]!=null)
                        {
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
                          for(var i=0;i<(Object.keys(temp).length-1);i++)
                          {
                            var opt = document.createElement('option');
                            opt.value = temp[i].id +"_"+ course_id + "_" + temp[i].semester + "_" + temp[i].year +"_"+ temp[i].name;
                            opt.innerHTML = "คุณ"+temp[i].name+" ภาคการศึกษาที่ "+temp[i].semester+" ปีการศึกษา "+temp[i].year;
                            document.getElementById('teachername').appendChild(opt);
                          }
                        }
                        else if(temp['info']==false && temp[0]==null && $('#id').val()!=""){
                          swal(
                             '',
                             'กระบวนวิชาที่ค้นหาไม่พบในระบบ <br> กรุณาติดต่อเจ้าหน้าที่ภาคที่สังกัด',
                             'error'
                           )
                          //alert('กระบวนวิชาที่ค้นหาไม่พบในระบบ\nกรุณาติดต่อเจ้าหน้าที่ภาคที่สังกัด');
                          document.getElementById('id').value = "";
                         }
                         else if(temp['info']!=false && temp[0]==null){
                           swal(
                              '',
                              'ท่านยังไม่เคยกรอกรายละเอียดในวิชานี้ <br>สามารถกรอกรายละเอียดได้ดังแบบฟอร์มข้างล่าง',
                              'error'
                            )
                           //alert('ท่านยังไม่เคยกรอกรายละเอียดในวิชานี้\nสามารถกรอกรายละเอียดได้ดังแบบฟอร์มข้างล่าง');
                           document.getElementById('course').value = temp['info']['course_id'];
                          }
                          else {
                            if($('#id').val()=="" ||$('#id').val()==null )
                            {
                              swal(
                                 '',
                                 'กรุณากรอกรหัสกระบวนวิชาให้ถูกต้อง',
                                 'error'
                               )
                            }
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
     var file_data = new FormData;
     var teachername_temp = document.getElementById('teachername').value;
     var stringspl = teachername_temp.split("_");
     var instructor_id = stringspl[0];
     var course_id = stringspl[1];
     var semester = stringspl[2];
     var year = stringspl[3];
     var name = stringspl[4];
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
                   success: function (result) {
                     var temp = $.parseJSON(result);
                     if(temp!=null)
                     {
                       swal(
                          'สำเร็จ!',
                          'ดึงข้อมูลสำเร็จ',
                          'success'
                        )
                       getinfo(temp);
                     }
                     else {
                       alert('error');
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

 function submitfunc(casesubmit) {

   // pack table
   var topiclec = {};
   var date = {};
   var datebegin = {};
   var dateend = {};
   var room = {};
   var arrtopiclec = [];
   var arrdate = [];
   var arrtimebegin = [];
   var arrtimeend = [];
   var arrroom = [];

   for(var i=1;i<=(($('#detailteaching tr').length)-2);i++)
   {
      arrtopiclec[i-1] = document.getElementById('detail_topic'+i).value;
      arrdate[i-1] = document.getElementById('dateteach'+i).value;
      arrtimebegin[i-1] = document.getElementById('timebegin'+i).value;
      arrtimeend[i-1] = document.getElementById('timeend'+i).value;
      arrroom[i-1] = document.getElementById('room'+i).value;
   }

  topiclec = arrtopiclec;
  date = arrdate;
  timebegin = arrtimebegin;
  timeend = arrtimeend;
  room = arrroom;

  // levelteacher
  if(document.querySelector("input[name='levelteacher']:checked").value=="pro")
  {
      var lvteacher = document.getElementById('GOV_LEVEL').value;
  }
  else
  {
      var lvteacher = document.getElementById('NORM_LEVEL').value;
  }

  //costspec
  if(document.querySelector("input[name='costspec']:checked").value=="choice1")
  {
      var num = document.getElementById('choice1num').value;
      var hour = document.getElementById('choice1hour').value;
      var cost = document.getElementById('choice1cost').value;
  }
  else if(document.querySelector("input[name='costspec']:checked").value=="choice2")
  {
      var num = document.getElementById('choice2num').value;
      var hour = document.getElementById('choice2hour').value;
      var cost = document.getElementById('choice2cost').value;
  }

  //trans
  if(document.getElementById('transplane').checked == true)
  {
    var planecheck = "true";
  }
  else {
    var planecheck = "false";
  }

  if(document.getElementById('transtaxi').checked == true)
  {
    var taxicheck = "true";
  }
  else {
    var taxicheck = "false";
  }

  if(document.getElementById('transselfcar').checked == true)
  {
    var selfcarcheck = "true";
  }
  else {
    var selfcarcheck = "false";
  }

  // hotelunit
  if(document.querySelector("input[name='hotelchoice']:checked").value=="way1")
  {
    var hotelunit = document.getElementById('way1unit').value;
  }
  else if (document.querySelector("input[name='hotelchoice']:checked").value=="way2") {
    var hotelunit = document.getElementById('way2unit').value;
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

   var data = {
     'TEACHERDATA' : {
       'DEPARTMENT' : document.getElementById('department').value,
       'PREFIX' : document.getElementById('pre').value,
       'FNAME' : fname,
       'LNAME' : lname,
       'POSITION' : document.getElementById('position').value,
       'QUALIFICATION' : document.getElementById('qualification').value,
       'WORKPLACE' : document.getElementById('workplace').value,
       'TELEPHONE' : {
         'NUMBER' : document.getElementById('tel').value,
         'SUB' : document.getElementById('subtel').value
       },
       'MOBILE' : document.getElementById('mobile').value,
       'EMAIL' : document.getElementById('email').value,
       'HISTORY' : document.querySelector("input[name='topic']:checked").value
     },
     'COURSEDATA' : {
       'COURSE_ID' : document.getElementById('course').value,
       'NOSTUDENT' : document.getElementById('numstudent').value,
       'TYPE_COURSE' : document.querySelector("input[name='type_course']:checked").value,
       'REASON' : document.getElementById('reason').value,
       'DETAIL' : {
         'TOPICLEC' : topiclec,
         'DATE' : date,
         'TIME' : {
           'BEGIN' : timebegin,
           'END' : timeend
         },
         'ROOM' : room
       },
       'HOUR' : document.getElementById('hour').value
     },
     'PAYMENT' : {
       'LVLTEACHER' : {
         'CHOICE' : document.querySelector("input[name='levelteacher']:checked").value,
         'DESCRIPT' : lvteacher
       },
       'COSTSPEC' : {
         'CHOICE' : document.querySelector("input[name='costspec']:checked").value,
         'NUMBER' : num,
         'HOUR' : hour,
         'COST' : cost
       },
       'COSTTRANS' : {
         'TRANSPLANE' : {
           'CHECKED' : planecheck,
           'DEPART' : document.getElementById('AIR_DEPART').value,
           'ARRIVE' : document.getElementById('AIR_ARRIVE').value,
           'COST' : costplane
         },
         'TRANSTAXI' : {
           'CHECKED' : taxicheck,
           'DEPART' : document.getElementById('TAXI_DEPART').value,
           'ARRIVE' : document.getElementById('TAXI_ARRIVE').value,
           'COST' : costtaxi
         },
         'TRANSSELFCAR' : {
           'CHECKED' : selfcarcheck,
           'DISTANCT' : document.getElementById('SELF_DISTANCT').value,
           'UNIT' : document.getElementById('selfunit').value,
           'COST' : document.getElementById('selfcost').value
         }
       },
       'COSTHOTEL' : {
         'CHOICE' : document.querySelector("input[name='hotelchoice']:checked").value,
         'UNIT' : hotelunit,
         'NUMBER' : document.getElementById('numnight').value,
         'PERNIGHT' : document.getElementById('pernight').value
       },
       'TOTALCOST' : costtotal
    },
    'NUMTABLE' : rowtr,
    'SUBMIT_TYPE' : casesubmit,
    'USERID' : '<?php echo $_SESSION['id']; ?>',
    'DATE' : '<?php echo date('d'); ?>',
    'MONTH' : '<?php echo date('m'); ?>',
    'YEAR' : '<?php echo date('Y')+543; ?>'
   };

   if(casesubmit=='1')
   {
     senddata(JSON.stringify(data),getfile());
   }
   else if(casesubmit=='2')
   {
     senddata(JSON.stringify(data),getfile());
   }
 }

 function senddata(data,file_data)
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
                  success: function (result) {
                       var temp = $.parseJSON(result);
                       if(temp["status"]=='success')
                       {
                          swal({
                            title: 'สำเร็จ',
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

 $(document).ready(function(){

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

     }else {
         echo "$('#dlhide').hide();
         $('#formheader').hide();
         $('#overtimemsg').show();";
     }

    ?>


   // manage required form
   $("input[name='levelteacher']").change(function(){
     if($(this).val()=="pro")
     {
         $("#GOV_LEVEL").prop('required',true);
         $("#NORM_LEVEL").prop('required',false);
         $("#NORM_LEVEL").val("");
     }
     else
     {
       $("#GOV_LEVEL").prop('required',false);
       $("#NORM_LEVEL").prop('required',true);
       $("#GOV_LEVEL").val("");
     }
     });

       $('#transplane').click(function(){
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
        if (this.checked) {
            $("#SELF_DISTANCT").prop('required',true);
            $("#selfunit").val("5");
            $("#selfcost").val("0");
        }
        else
        {
          $("#SELF_DISTANCT").prop('required',false);
          $("#SELF_DISTANCT").val("");
          $("#selfunit").val("");
          $("#selfcost").val("0");

        }
    });

    // CALCULATE
    if(document.querySelector("input[name='costspec']:checked").value=="choice1")
    {
      $('#choice1hour').val("");
      $('#choice1cost').val("");
      $('#choice1num').val("400");
      $('#choice2hour').val("");
      $('#choice2cost').val("");
      $('#choice2num').val("");
      $('#choice1hour').keyup(function(){
          var textone;
          var texttwo;
          textone = parseFloat($('#choice1hour').val());
          texttwo = parseFloat($('#choice1num').val());
          var result = textone*texttwo;
          $('#choice1cost').val(result.toFixed(2));
      });
      $('#choice1num').keyup(function(){
          var textone;
          var texttwo;
          textone = parseFloat($('#choice1hour').val());
          texttwo = parseFloat($('#choice1num').val());
          var result = textone*texttwo;
          $('#choice1cost').val(result.toFixed(2));
      });
    }

    $("input[name='costspec']").change(function(){
      if($(this).val()=="choice1")
      {
        $('#choice1hour').val("");
        $('#choice1cost').val("");
        $('#choice1num').val("400");
        $('#choice2hour').val("");
        $('#choice2cost').val("");
        $('#choice2num').val("");
        $('#choice1hour').keyup(function(){
            var textone;
            var texttwo;
            textone = parseFloat($('#choice1hour').val());
            texttwo = parseFloat($('#choice1num').val());
            var result = textone*texttwo;
            $('#choice1cost').val(result.toFixed(2));
        });
        $('#choice1num').keyup(function(){
            var textone;
            var texttwo;
            textone = parseFloat($('#choice1hour').val());
            texttwo = parseFloat($('#choice1num').val());
            var result = textone*texttwo;
            $('#choice1cost').val(result.toFixed(2));
        });
      }
      else
      {
        $('#choice1hour').val("");
        $('#choice1cost').val("");
        $('#choice1num').val("");
        $('#choice2hour').val("");
        $('#choice2cost').val("");
        $('#choice2num').val("200");
        $('#choice2hour').keyup(function(){
            var textone;
            var texttwo;
            textone = parseFloat($('#choice2hour').val());
            texttwo = parseFloat($('#choice2num').val());
            var result = textone*texttwo;
            $('#choice2cost').val(result.toFixed(2));
        });
        $('#choice2num').keyup(function(){
            var textone;
            var texttwo;
            textone = parseFloat($('#choice2hour').val());
            texttwo = parseFloat($('#choice2num').val());
            var result = textone*texttwo;
            $('#choice2cost').val(result.toFixed(2));
        });
      }
      });


    $('#SELF_DISTANCT').keyup(function(){
        var textone;
        var texttwo;
        textone = parseFloat($('#SELF_DISTANCT').val());
        texttwo = parseFloat($('#selfunit').val());
        var result = textone*texttwo ;
        $('#selfcost').val(result.toFixed(2));
    });

    $('#selfunit').keyup(function(){
        var textone;
        var texttwo;
        textone = parseFloat($('#SELF_DISTANCT').val());
        texttwo = parseFloat($('#selfunit').val());
        var result = textone*texttwo ;
        $('#selfcost').val(result.toFixed(2));
    });

    if(document.querySelector("input[name='hotelchoice']:checked").value=="way3")
    {
      $('#numnight').prop('required',false);
      $('#numnight').val("0");
      $('#pernight').val("0");
      $('#way1unit').val("");
      $('#way2unit').val("");
    }

    $("input[name='hotelchoice']").change(function(){
      if($(this).val()=="way1")
      {
        $('#numnight').val("");
        $('#pernight').val("");
        $('#way1unit').val("1500");
        $('#way2unit').val("");
        $('#numnight').prop('required',true);
        $('#numnight').keyup(function(){
            var textone;
            var texttwo;
            textone = parseFloat($('#numnight').val());
            texttwo = parseFloat($('#way1unit').val());
            var result = textone*texttwo;
            $('#pernight').val(result.toFixed(2));
        });
        $('#way1unit').keyup(function(){
            var textone;
            var texttwo;
            textone = parseFloat($('#numnight').val());
            texttwo = parseFloat($('#way1unit').val());
            var result = textone*texttwo;
            $('#pernight').val(result.toFixed(2));
        });
      }
      else if($(this).val()=="way2")
      {
        $('#numnight').val("");
        $('#pernight').val("");
        $('#way2unit').val("800");
        $('#way1unit').val("");
        $('#numnight').prop('required',true);
        $('#numnight').keyup(function(){
            var textone;
            var texttwo;
            textone = parseFloat($('#numnight').val());
            texttwo = parseFloat($('#way2unit').val());
            var result = textone*texttwo;
            $('#pernight').val(result.toFixed(2));
        });
        $('#way2unit').keyup(function(){
            var textone;
            var texttwo;
            textone = parseFloat($('#numnight').val());
            texttwo = parseFloat($('#way2unit').val());
            var result = textone*texttwo;
            $('#pernight').val(result.toFixed(2));
        });
      }
      else {
        $('#numnight').prop('required',false);
        $('#numnight').val("0");
        $('#pernight').val("0");
        $('#way1unit').val("");
        $('#way2unit').val("");
      }

      });

      // callist

      $("#callist").hide();

      //cvlist
      $("input[name='topic']").change(function(){
        if($(this).val()=="yet")
        {
          $('#cvlist').hide();
          $('input[name=cv]').prop('required', 'false');
        }
        else {
          $('#cvlist').show();
          $('input[name=cv]').prop('required', 'true');
        }
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
          checkreq('1');
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
       table.append('<tr class="warning" name="addtr" id="row' + (rowCount - 1) + '"><td colspan="2"><div class="form-inline"><input type="button" class="btn btn-outline btn-danger" name="delbtn' + (rowCount - 1) + '" id="delbtn' + (rowCount - 1) +
         '" value="ลบ" onclick="deleteRow(' + (rowCount - 1) + ')">&nbsp;&nbsp;<input type="text" class="form-control" name="detail_topic' + (rowCount - 1) + '" id="detail_topic' + (rowCount - 1) +
         '" size="30"></div></td><td><input type="date" class="form-control" name="dateteach' + (rowCount - 1) + '" id="dateteach' + (rowCount - 1) +
         '" size="2"></td><td width="25%" style="text-align: center;"><div class="form-inline"><input type="time" class="form-control" name="timebegin' + (rowCount - 1) + '" id="timebegin' + (rowCount - 1) + '" size="2">  ถึง  <input type="time" class="form-control" name="timeend'
          + (rowCount - 1) + '" id="timeend' + (rowCount - 1) + '" size="2"></div></td><td><input type="text" class="form-control" id="room' + (rowCount - 1) + '"</td></tr>');
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

  }

  function checkreq(casesubmit) {
    if($("[required]").val()!=null && $("[required]").val()!="" && $("[required]").val()!= undefined)
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
      submitfunc(casesubmit);
    }, function (dismiss) {
    // dismiss can be 'cancel', 'overlay',
    // 'close', and 'timer'
    if (dismiss === 'cancel') {

    }
  })
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
      <h3 class="page-header">แบบขออนุมัติเชิญอาจารย์พิเศษ คณะเภสัชศาสตร์</h3>
      <div id="overtimemsg" class="alert alert-danger"><div class="glyphicon glyphicon-alert" style="color: red;font-size:18px;" ><b> สิ้นสุดเวลาในการกรอกแบบขออนุมัติเชิญอาจารย์พิเศษแล้ว !</b></div><b style="color: red;font-size:16px;"> <p id="overtimemsg2"></p></b> </div>
      <form id="formheader" data-toggle="validator" role="form">
        <div id="formchecksj" class="form-inline" style="font-size:16px;">
                  <div class="form-group ">
                    รหัสกระบวนวิชา
                     <input type="text" class="form-control numonly" id="id" name="id" size="7" placeholder="e.g. 204111" maxlength="6" pattern=".{6,6}" required >
                  </div>
                  <input type="hidden" name="type" value="1">
                 <button type="button" class="btn btn-outline btn-primary" onclick="checksubject(1,2);">ค้นหา</button>
         </div>

    <div id="formdrpd" style="display: none;">
      <div class="form-inline">
        <div class="form-group " style="font-size:16px;">
           ชื่อ-นามสกุลของอาจารย์พิเศษ
          <select class="form-control required" id="teachername" name="teachername" style="width: 400px;" required >
          </select>
         </div>
         <input type="button" class="btn btn-outline btn-primary" name="subhead" id="subhead" value="ยืนยัน" onclick="checksubject(2,2);">
       </div>
     </div>
         </form>
      </center>

      <div id="dlhide" class="panel panel-default"> <br>
      <form data-toggle="validator" role="form" name="form1" id="form1" method="post">
      <div class="row form-inline" style="font-size:16px;">
        <center><div class="form-group">
      ภาควิชา
        <select class="form-control required" id="department" style="width: auto;" id="select" required >
         <option value="">--------------</option>
         <option value="ภาควิชาวิทยาศาสตร์เภสัชกรรม">ภาควิชาวิทยาศาสตร์เภสัชกรรม</option>
         <option value="ภาควิชาบริบาลเภสัชกรรม">ภาควิชาบริบาลเภสัชกรรม</option>
      </select>
        </div></center>
      </div>




    <ol>

      <li style="font-size: 14px;">
        <b>รายละเอียดของอาจารย์พิเศษ</b>
        <br>
        <div class="row">
          <ul>
          <div class="form-inline">
            <li>คำนำหน้า &nbsp;&nbsp;<div class="form-group">
              <select class="form-control" name="pre" id="pre" required>
                <?php
                    for($i=0;$i<count($prefix);$i++)
                    {
                      echo '<option value="'.$prefix[$i]["prefix"].'">'.$prefix[$i]["prefix"].'</option>';
                    }
                 ?>
              </select>
              </div>&nbsp;&nbsp;&nbsp;&nbsp;
              ชื่อ &nbsp;&nbsp;<div class="form-group"><input type="text" class="form-control" id="fname" size="20" required ></div>&nbsp;
              นามสกุล &nbsp;&nbsp;<div class="form-group"><input type="text" class="form-control" id="lname" size="20" required ></div>&nbsp;
          </div>

          <div class="form-inline">
            <li>ตำแหน่ง &nbsp;&nbsp;<div class="form-group"><input type="text" class="form-control " id="position" size="35" required ></div></li>
          </div>

          <div class="form-inline">
            <li>คุณวุฒิ/สาขาที่เชี่ยวชาญ &nbsp;&nbsp;<br>
              <div class="form-group"><textarea class="form-control" name="qualification" id="qualification" rows="3" cols="60" required></textarea></div></li>
          </div>
          <br>
          <div class="form-inline">
            <li>สถานที่ทำงาน / สถานที่ติดต่อ &nbsp;&nbsp;<br />
              <div class="form-group"><textarea class="form-control" name="workplace" id="workplace" rows="3" cols="60"></textarea></div>
            </li>
          </div>
          <br>
          <div class="form-inline">
            <li>โทรศัพท์ &nbsp;&nbsp;<div class="form-group"><input type="text" class="form-control numonly" id="tel" size="20" maxlength="10" required ></div>
              &nbsp;ต่อ&nbsp;<input type="text" class="form-control numonly" id="subtel" size="2" maxlength="5"></li>
        </div>
        <div class="form-inline">
          <li>โทรศัพท์มือถือ &nbsp;&nbsp;<div class="form-group"><input type="text" class="form-control numonly" id="mobile" size="20" maxlength="10" required ></div>
            </li>
      </div>

        <div class="form-inline">
          <li>E-mail &nbsp;&nbsp;<div class="form-group"><input style="height: 25px;" type="email" class="form-control" id="email" size="45" required ></div></li>
        </div>
        <div class="form-inline">
          <li>ประวัติการเชิญมาสอน <br>
              <div class="form-group">
                <div class="radio">
                <input type="radio" name="topic" id="topic" value="yet" required checked> &nbsp;เคยเชิญมาสอน
                &nbsp;<input type="radio" name="topic" id="topic" value="already"> &nbsp;ไม่เคยเชิญมาสอน
              </div>
            </div>
            </li>
        </div>
      </ul>
    </div>
      </li>
      <br>
      <li style="font-size: 14px;">
        <b>รายละเอียดกระบวนวิชา</b>
          <div class="row">
            <ul>
              <div class="form-inline">
                <li>รหัสกระบวนวิชาที่สอน &nbsp;<div class="form-group"><input type="text" class="form-control numonly" name="" id="course" size="6" maxlength="6" required ></div></li>
              </div>
              <div class="form-inline">
                <li>จำนวนนักศึกษา &nbsp;<div class="form-group"><input type="text" class="form-control numonly" name="" id="numstudent" size="6" maxlength="6"  required ></div> คน</li>
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
              <div class="form-inline">
                <div class="form-group"><li>เหตุผลและความจำเป็นในการเชิญอาจารย์พิเศษ  &nbsp;&nbsp;<br /><textarea class="form-control" id="reason" rows="4" cols="70" required ></textarea></li></div>
              </div>
                <li> รายละเอียดในการสอน <br>
                  <div class="col-md-10">
                  <table id="detailteaching" class="table table-bordered table-hover" style="font-size: 14px; ">
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
                </li>
                <div class="form-inline">
                  <div class="form-group"><li>จำนวนชั่วโมงของหัวข้อที่เชิญมาสอนคิดเป็นร้อยละ  &nbsp;<input type="text" class="form-control numonly" name="" id="hour" size="3" maxlength="10" required > &nbsp;ของทั้งกระบวนวิชา</li></div>
                </div>
            </ul>
          </div>
      </li>
      <br>
      <li  style="font-size: 14px;;">
        <b>ค่าใช้จ่าย </b>
        <ul>
          <div class="form-inline">
            <li>อาจารย์พิเศษเป็น &nbsp;</li>
            <div class="radio">
              <div class="form-group"><input type="radio"  name="levelteacher" id="levelteacher" value="pro" checked>&nbsp;ข้าราชการระดับ &nbsp;<input type="text" class="form-control " name="GOV_LEVEL" id="GOV_LEVEL"/></div>
              <br>
              <div class="form-group"><input type="radio"  name="levelteacher" id="levelteacher" value="norm">&nbsp; บุคคลเอกชนเทียบตำแหน่งระดับ &nbsp;<input type="text" class="form-control " name="NORM_LEVEL" id="NORM_LEVEL"/></div>
            </div>
          </div>
          <div class="form-inline">
            <li>ค่าสอนพิเศษ</li>
            <div class="radio">
              <div class="form-group">
                <input type="radio"  name="costspec" id="costspec" value="choice1" required checked>&nbsp;ปริญญาตรีบรรยาย <input type="text" class="form-control numonly" name="choice1num" id="choice1num"  size="5" value="400"> ต่อชม.&nbsp;
              จำนวน&nbsp;&nbsp;<input type="text" class="form-control numonly" id="choice1hour" size="5" data-minlength="1" min="0" max="99" >&nbsp;&nbsp;ชั่วโมง&nbsp;&nbsp;เป็นเงิน&nbsp;&nbsp;<input type="text" class="form-control numonly" id="choice1cost" size="5" data-minlength="5" min="0" max="99999" READONLY>&nbsp;&nbsp;บาท
              </div><br>
              <div class="form-group"><input type="radio"  name="costspec" id="costspec" value="choice2">&nbsp; ปริญญาตรีปฏิบัติการ <input type="text" class="form-control numonly" name="choice2num" id="choice2num" size="5"> ต่อชม.&nbsp;
              จำนวน&nbsp;&nbsp;<input type="text" class="form-control numonly" id="choice2hour" size="5" data-minlength="1" min="0" max="99" >&nbsp;&nbsp;ชั่วโมง&nbsp;&nbsp;เป็นเงิน&nbsp;&nbsp;<input type="text" class="form-control numonly" id="choice2cost" size="5" data-minlength="5" min="0" max="99999" READONLY>&nbsp;&nbsp;บาท
              </div>
            </div>
          </div>
          <div class="form-inline">
            <li>ค่าพาหนะเดินทาง </li>
            <div class="checkbox">
              <div class="form-group"><label><input type="checkbox" name="transchoice" id="transplane">&nbsp;&nbsp;เครื่องบิน ระหว่าง &nbsp;<input type="text" class="form-control" name="AIR_DEPART" id="AIR_DEPART" placeholder="ต้นทาง"/> - <input type="text" class="form-control" name="AIR_ARRIVE" id="AIR_ARRIVE" placeholder="ปลายทาง"/>  &nbsp;&nbsp;เป็นเงิน&nbsp;&nbsp;<input type="text" class="form-control numonly" name="planecost" id="planecost" size="5" value="0">&nbsp;&nbsp;บาท</label></div>
              <br>
              <div class="form-group"><label><input type="checkbox" name="transchoice" id="transtaxi">&nbsp;&nbsp;ค่า taxi &nbsp;<input type="text" class="form-control" name="TAXI_DEPART" id="TAXI_DEPART" placeholder="ต้นทาง"/> - <input type="text" class="form-control" name="TAXI_ARRIVE" id="TAXI_ARRIVE" placeholder="ปลายทาง"/> &nbsp;&nbsp;เป็นเงิน&nbsp;&nbsp;<input type="text" class="form-control numonly" name="taxicost" id="taxicost" size="5" value="0">&nbsp;&nbsp;บาท</label></div>
              <br>
              <div class="form-group"><label><input type="checkbox" name="transchoice" id="transselfcar">&nbsp;&nbsp;รถยนต์ส่วนตัว ระยะทางไป-กลับ ระยะทาง &nbsp;
                <input type="text" class="form-control numonly" name="SELF_DISTANCT" id="SELF_DISTANCT" size="5" data-minlength="1" min="0" max="9999"> &nbsp;กิโลเมตร  กิโลเมตรละ
                <input type="text" class="form-control numonly" name="selfunit" id="selfunit" size="4">
                 บาท &nbsp;&nbsp;เป็นเงิน&nbsp;&nbsp;
                <input type="text" class="form-control numonly" name="selfcost" id="selfcost" size="5" data-minlength="2" min="0" max="99999" READONLY >&nbsp;&nbsp;บาท</label></div>
              </div>
          </div>
          <div class="form-inline">
            <li>ค่าที่พัก</li>
            <div class="form-group"><div class="radio">
              <input type="radio" name="hotelchoice" id="hotelchoice" value="way3" required checked>&nbsp;&nbsp; ไม่เบิกค่าที่พัก&nbsp;&nbsp;<br>
              <input type="radio" name="hotelchoice" id="hotelchoice" value="way1" >&nbsp;&nbsp; เบิกได้เท่าจ่ายจริงไม่เกิน <input type="text" class="form-control numonly" name="way1unit" id="way1unit" size="4" > บาท/คน/คืน&nbsp;&nbsp;<br>
              <input type="radio" name="hotelchoice" id="hotelchoice" value="way2">&nbsp;&nbsp; เบิกในลักษณะเหมาจ่ายไม่เกิน <input type="text" class="form-control numonly" name="way2unit" id="way2unit" size="4" > บาท/คน/คืน &nbsp;&nbsp;
            </div></div>
            <br><div class="form-group">จำนวน&nbsp;&nbsp;<input type="text" class="form-control numonly" name="numnight" id="numnight" size="5" min="0" max="99999"  >&nbsp;&nbsp;คืน
            &nbsp;&nbsp;คิดเป็นเงิน&nbsp;&nbsp;<input type="text" class="form-control numonly" name="pernight" id="pernight" size="5" min="0" max="99999" READONLY  >&nbsp;&nbsp;บาท
          </div>
          </div>
          <br>
          <div class="form-inline">
            <input type="button" class="btn btn-outline btn-default" name="calculatebtn" id="calculatebtn" value="คำนวณค่าใช้จ่ายทั้งหมด" onclick="lastcal();">
          </div>
          <br>
          <div class="form-inline">
            <li style="font-size: 16px;" id="callist"><b>สรุปค่าใช้จ่ายทั้งหมด</b>&nbsp;&nbsp;<input type="text" class="form-control numonly" name="totalcost" id="totalcost" size="10" value="0" READONLY >&nbsp;&nbsp;บาท</li>
            <br>
          </div>
        </ul>
      </li>
      <li  style="font-size: 14px;" >
        <b>เลือกไฟล์ Curriculum Vitae (CV) เพื่ออัพโหลด : </b><br />
      <div class="col-md-5 form-inline form-group">
        <input type="file" class="filestyle" id="cv" data-icon="false"><font color="red"><b id="cvlist"> ** จำเป็น</b></font>
      </div>
      </li>
    </ol>
    <br>
    <br>
    <div align="center">
      <input type="submit" style="font-size: 18px;" class="btn btn-outline btn-success" name="submitbtn" id="submitbtn" value="ยืนยันเพื่อส่งข้อมูล"> &nbsp;
      <input type="button" style="font-size: 18px;" class="btn btn-outline btn-warning" name="draftbtn" id="draftbtn" value="บันทึกข้อมูลชั่วคราว" onclick="checkreq('2');"> &nbsp;
      <input type="button" style="font-size: 18px;" class="btn btn-outline btn-danger" name="resetbtn" id="resetbtn" onclick="confreset();" value="รีเซ็ตข้อมูล">
    </div>
</form>
</div>
</div>
</body>
</html>

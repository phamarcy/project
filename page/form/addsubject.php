<?php
  session_start();
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

  <!-- validator -->
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>

  <link rel="stylesheet" href="../dist/css/scrollbar.css">
  <style>
  input[type=text],input[type=number]{
    height: 30px;
  }

  body {
    overflow-y: hidden;
  }

  .no-gutter > [class*="col-"]{
  }

  .floatrm {
    float: none !important;
  }
  </style>

<script id="contentScript">

function getinfo(temp) {
  // part1
  document.getElementById('COURSE_ID').value = temp['COURSE_ID'];
  document.getElementById('SECTION').value = temp['SECTION'];
  var choice1 = temp['NORORSPE'];
  $('input[name="NORORSPE"][value=' + choice1 + ']').prop('checked', true);
  document.getElementById('NAME_ENG_COURSE').value = temp['NAMEENG'];
  document.getElementById('NAME_TH_COURSE').value = temp['NAMETH'];
  document.getElementById('ENROLL').value = temp['STUDENT'];
  document.getElementById('TOTAL').value = temp['CREDIT']['TOTAL'];

  //part2
  var choice2 = temp['TYPE_TEACHING'];
  $('input[name="TYPE_TEACHING"][value=' + choice2 + ']').prop('checked', true);
  if($('input[name="TYPE_TEACHING"]:checked').val()=="OTH")
  {
    $("#TYPE_TEACHING_NAME").val(temp['TYPE_TEACHING_NAME']);
    $("#TYPE_TEACHING_NAME").prop('required',true);
    $("#TYPE_TEACHING_NAME").show();
  }

  //part6
  var choice3 = temp['CALCULATE']['TYPE'];
  $('input[name="CALCULATE"][value=' + choice3 + ']').prop('checked', true);
  document.getElementById('EXPLAINATION').value = temp['CALCULATE']['EXPLAINATION'];
  var choice4 = temp['EVALUATE'];
  $('input[name="EVALUATE_TYPE"][value=' + choice4 + ']').prop('checked', true);
  document.getElementById("CALOTHER").value = temp['CALCULATE']['OTHERGRADE'];

  //fucntion for disabled
  if($("input[name='EVALUATE_TYPE']:checked").val()=="SU")
  {
    $('.atof').val("");
    document.getElementById("CALCULATE_S_MIN").value = temp['CALCULATE']['S']['MIN'];
    document.getElementById("CALCULATE_U_MAX").value = temp['CALCULATE']['U']['MAX'];
    $('.atof').prop('disabled',true);
    $('.atof').prop('required',false);
    $('.stou').prop('required',true);
    $('.stou').prop('disabled',false);
  }
  else if($("input[name='EVALUATE_TYPE']:checked").val()=="AF")
  {
    document.getElementById("CALCULATE_A_MIN").value = temp['CALCULATE']['A']['MIN'];
    document.getElementById("CALCULATE_Bp_MIN").value = temp['CALCULATE']['B+']['MIN'];
    document.getElementById("CALCULATE_Bp_MAX").value = temp['CALCULATE']['B+']['MAX'];
    document.getElementById("CALCULATE_B_MIN").value = temp['CALCULATE']['B']['MIN'];
    document.getElementById("CALCULATE_B_MAX").value = temp['CALCULATE']['B']['MAX'];
    document.getElementById("CALCULATE_Cp_MIN").value = temp['CALCULATE']['C+']['MIN'];
    document.getElementById("CALCULATE_Cp_MAX").value = temp['CALCULATE']['C+']['MAX'];
    document.getElementById("CALCULATE_C_MIN").value = temp['CALCULATE']['C']['MIN'];
    document.getElementById("CALCULATE_C_MAX").value = temp['CALCULATE']['C']['MAX'];
    document.getElementById("CALCULATE_Dp_MIN").value = temp['CALCULATE']['D+']['MIN'];
    document.getElementById("CALCULATE_Dp_MAX").value = temp['CALCULATE']['D+']['MAX'];
    document.getElementById("CALCULATE_D_MIN").value = temp['CALCULATE']['D']['MIN'];
    document.getElementById("CALCULATE_D_MAX").value = temp['CALCULATE']['D']['MAX'];
    document.getElementById("CALCULATE_F_MAX").value = temp['CALCULATE']['F']['MAX'];

    $('.stou').val("");
    $('.atof').prop('disabled',false);
    $('.atof').prop('required',true);
    $('.stou').prop('disabled',true);
    $('.stou').prop('required',false);
  }

  if($("input[name='CALCULATE']:checked").val()=="GROUP")
  {

    $('.atof').val("");
    $('#EXPLAINATION').prop('required',true);
    $('#EXPLAINATION').prop('disabled',false);
    document.getElementById("CALCULATE_S_MIN").value = temp['CALCULATE']['S']['MIN'];
    document.getElementById("CALCULATE_U_MAX").value = temp['CALCULATE']['U']['MAX'];
    $('.atof').prop('disabled',true);
    $('.stou').prop('disabled',true);
    $('.atof').prop('required',false);
    $('.stou').prop('required',false);
    $('#EVALUATE1').prop('required',false);
    $('#EVALUATE2').prop('required',false);
    $('#EVALUATE1').prop('disabled',true);
    $('#EVALUATE2').prop('disabled',true);
    $('.opacity01').css("opacity","0.1");
  }
  else if ($("input[name='CALCULATE']:checked").val()=="CRITERIA")
  {
    document.getElementById("CALCULATE_A_MIN").value = temp['CALCULATE']['A']['MIN'];
    document.getElementById("CALCULATE_Bp_MIN").value = temp['CALCULATE']['B+']['MIN'];
    document.getElementById("CALCULATE_Bp_MAX").value = temp['CALCULATE']['B+']['MAX'];
    document.getElementById("CALCULATE_B_MIN").value = temp['CALCULATE']['B']['MIN'];
    document.getElementById("CALCULATE_B_MAX").value = temp['CALCULATE']['B']['MAX'];
    document.getElementById("CALCULATE_Cp_MIN").value = temp['CALCULATE']['C+']['MIN'];
    document.getElementById("CALCULATE_Cp_MAX").value = temp['CALCULATE']['C+']['MAX'];
    document.getElementById("CALCULATE_C_MIN").value = temp['CALCULATE']['C']['MIN'];
    document.getElementById("CALCULATE_C_MAX").value = temp['CALCULATE']['C']['MAX'];
    document.getElementById("CALCULATE_Dp_MIN").value = temp['CALCULATE']['D+']['MIN'];
    document.getElementById("CALCULATE_Dp_MAX").value = temp['CALCULATE']['D+']['MAX'];
    document.getElementById("CALCULATE_D_MIN").value = temp['CALCULATE']['D']['MIN'];
    document.getElementById("CALCULATE_D_MAX").value = temp['CALCULATE']['D']['MAX'];
    document.getElementById("CALCULATE_F_MAX").value = temp['CALCULATE']['F']['MAX'];
    $('.opacity01').css("opacity","1");
  }

  //part7
  var choice5 = temp['ABSENT'];
  $('input[name="ABSENT"][value=' + choice5 + ']').prop('checked', true);

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
                       console.log(temp);
                       if(temp['info']!=false)
                       {
                         document.getElementById('formdrpd').style.display = "";
                         for(var i=0;i<(Object.keys(temp).length - 1);i++)
                         {
                           var opt = document.createElement('option');
                           opt.value = temp[i].semester +"_"+ temp[i].year;
                           opt.innerHTML = "ภาคการศึกษาที่ " +temp[i].semester +" ปีการศึกษา "+ temp[i].year;
                           document.getElementById('semester').appendChild(opt);
                         }
                       }
                        else {
                          alert('ไม่พบกระบวนวิชาที่ค้นหา\nกรุณากรอกข้อมูลใหม่');
                          document.getElementById('id').value = "";
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
    var course_id = document.getElementById('id').value;
    var semester_temp = document.getElementById('semester').value;
    var stringspl = semester_temp.split("_");
    var semester = stringspl[0];
    var year = stringspl[1];
    JSON.stringify(course_id);
    JSON.stringify(semester);
    JSON.stringify(year);
    JSON.stringify(type);
    file_data.append("course_id",course_id);
    file_data.append("semester",semester);
    file_data.append("year",year);
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
                    console.log(temp);
                    if(temp!=null)
                    {
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

  var data = {
    'COURSE_ID': document.getElementById("COURSE_ID").value,
    'SECTION' : document.getElementById("SECTION").value,
    'NORORSPE' : document.querySelector("input[name='NORORSPE']:checked").value,
    'NAMETH' : document.getElementById("NAME_TH_COURSE").value,
    'NAMEENG' : document.getElementById("NAME_ENG_COURSE").value,
    'STUDENT' : document.getElementById("ENROLL").value,
    'CREDIT' : {
      'TOTAL' : document.getElementById("TOTAL").value
    },
    'TYPE_TEACHING' : document.querySelector("input[name='TYPE_TEACHING']:checked").value,
    'TYPE_TEACHING_NAME' : document.getElementById('TYPE_TEACHING_NAME').value,
    'EVALUATE' : document.querySelector("input[name='EVALUATE_TYPE']:checked").value,
    'CALCULATE' : {
      'TYPE' : document.querySelector("input[name='CALCULATE']:checked").value,
      'EXPLAINATION' : document.getElementById("EXPLAINATION").value,
      'A' : {
        'MIN' : document.getElementById("CALCULATE_A_MIN").value
      },
      'B+' : {
        'MIN' : document.getElementById("CALCULATE_Bp_MIN").value,
        'MAX' : document.getElementById("CALCULATE_Bp_MAX").value
      },
      'B' : {
        'MIN' : document.getElementById("CALCULATE_B_MIN").value,
        'MAX' : document.getElementById("CALCULATE_B_MAX").value
      },
      'C+' : {
        'MIN' : document.getElementById("CALCULATE_Cp_MIN").value,
        'MAX' : document.getElementById("CALCULATE_Cp_MAX").value
      },
      'C' : {
        'MIN' : document.getElementById("CALCULATE_C_MIN").value,
        'MAX' : document.getElementById("CALCULATE_C_MAX").value
      },
      'D+' : {
        'MIN' : document.getElementById("CALCULATE_Dp_MIN").value,
        'MAX' : document.getElementById("CALCULATE_Dp_MAX").value
      },
      'D' : {
        'MIN' : document.getElementById("CALCULATE_D_MIN").value,
        'MAX' : document.getElementById("CALCULATE_D_MAX").value
      },
      'F' : {
        'MAX' : document.getElementById("CALCULATE_F_MAX").value
      },
      'S' : {
        'MIN' : document.getElementById("CALCULATE_S_MIN").value
      },
      'U' : {
        'MAX' : document.getElementById("CALCULATE_U_MAX").value
      },
      'OTHERGRADE' : document.getElementById("CALOTHER").value
    },
    'ABSENT' : document.querySelector("input[name='ABSENT']:checked").value,
    'SUBMIT_TYPE' : casesubmit
  };

  //alert(JSON.stringify(data));
  if(casesubmit=='1')
  {
    senddata(JSON.stringify(data),getfile());
  }
  else if(casesubmit=='2')
  {
    senddata(JSON.stringify(data),getfile());
    //console.log(JSON.stringify(data));
  }

}
function senddata(data,file_data)
{

  //prompt("data", data);
   file_data.append("DATA",data);
   var URL = '../../application/pdf/course_evaluate.php';
   $.ajax({
                 url: URL,
                 dataType: 'text',
                 cache: false,
                 contentType: false,
                 processData: false,
                 data: file_data,
                 type: 'post',
                 success: function (result) {
                      console.log(result);
                      if(result=='save_success')
                      {
                        alert('บันทึกข้อมูลสำเร็จ');
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
  var file_data = $('#syllabus').prop('files')[0];
  var form_data = new FormData();
  form_data.append('file', file_data);
  return form_data;
}

// Charecter fixed
$(function() {//<-- wrapped here
  $('.numonly').on('input', function() {
    this.value = this.value.replace(/[^0-9.]/g, ''); //<-- replace all other than given set of values
  });
  $('.charonly').on('input', function() {
    this.value = this.value.replace(/[^a-zA-Zก-ฮๅภถุึคตจขชๆไำพะัีรนยบลฃฟหกดเ้่าสวงผปแอิืทมใฝ๑๒๓๔ู฿๕๖๗๘๙๐ฎฑธํ๊ณฯญฐฅฤฆฏโฌ็๋ษศซฉฮฺ์ฒฬฦ. ]/g, ''); //<-- replace all other than given set of values
  });
});

$(document).ready(function(){

  //radio
  $("input[name='EVALUATE_TYPE']").change(function(){
    if($(this).val()=="SU")
    {
      $('.atof').val("");
      $('.stou').val("");
      $('.atof').prop('disabled',true);
      $('.atof').prop('required',false);
      $('.stou').prop('required',true);
      $('.stou').prop('disabled',false);
    }
    else if($(this).val()=="AF")
    {
      $('#CALCULATE_A_MIN').val("80.0");
      $('#CALCULATE_Bp_MIN').val("75.0");
      $('#CALCULATE_B_MIN').val("70.0");
      $('#CALCULATE_Cp_MIN').val("65.0");
      $('#CALCULATE_C_MIN').val("60.0");
      $('#CALCULATE_Dp_MIN').val("55.0");
      $('#CALCULATE_D_MIN').val("50.0");
      $('#CALCULATE_F_MAX').val("49.9");
      $('#CALCULATE_Bp_MAX').val("79.9");
      $('#CALCULATE_B_MAX').val("74.9");
      $('#CALCULATE_Cp_MAX').val("69.9");
      $('#CALCULATE_C_MAX').val("64.9");
      $('#CALCULATE_Dp_MAX').val("59.9");
      $('#CALCULATE_D_MAX').val("54.9");
      $('.stou').val("");
      $('.atof').prop('disabled',false);
      $('.atof').prop('required',true);
      $('.stou').prop('disabled',true);
      $('.stou').prop('required',false);
    }
    });

    $("input[name='CALCULATE']").change(function(){
      if($(this).val()=="GROUP")
      {
        $('.atof').val("");
        $('.stou').val("");
        $('.atof').prop('disabled',true);
        $('.stou').prop('disabled',true);
        $('.atof').prop('required',false);
        $('.stou').prop('required',false);
        $('#EVALUATE1').prop('required',false);
        $('#EVALUATE2').prop('required',false);
        $('#EVALUATE1').prop('disabled',true);
        $('#EVALUATE2').prop('disabled',true);
        $('.opacity01').css("opacity","0.1");
      }
      else if ($(this).val()=="CRITERIA")
      {
        $('#CALCULATE_A_MIN').val("80.0");
        $('#CALCULATE_Bp_MIN').val("75.0");
        $('#CALCULATE_B_MIN').val("70.0");
        $('#CALCULATE_Cp_MIN').val("65.0");
        $('#CALCULATE_C_MIN').val("60.0");
        $('#CALCULATE_Dp_MIN').val("55.0");
        $('#CALCULATE_D_MIN').val("50.0");
        $('#CALCULATE_F_MAX').val("49.9");
        $('#CALCULATE_Bp_MAX').val("79.9");
        $('#CALCULATE_B_MAX').val("74.9");
        $('#CALCULATE_Cp_MAX').val("69.9");
        $('#CALCULATE_C_MAX').val("64.9");
        $('#CALCULATE_Dp_MAX').val("59.9");
        $('#CALCULATE_D_MAX').val("54.9");
        $('.atof').prop('disabled',true);
        $('.atof').prop('required',false);
        $('.stou').prop('required',true);
        $('.stou').prop('disabled',false);
        $('#EVALUATE1').prop('required',true);
        $('#EVALUATE2').prop('required',true);
        $('#EVALUATE1').prop('disabled',false);
        $('#EVALUATE2').prop('disabled',false);
        $('#EXPLAINATION').val("");
        $('.opacity01').css("opacity","1");
        document.getElementById("EVALUATE1").checked = false;
        document.getElementById("EVALUATE2").checked = false;
      }
    });



  $("#TYPE_TEACHING_NAME").hide();
  $("input[name='TYPE_TEACHING']").change(function(){
    if($(this).val()=="OTH")
    {
        $("#TYPE_TEACHING_NAME").prop('required',true);
        $("#TYPE_TEACHING_NAME").show();
    }
    else
    {
      $("#TYPE_TEACHING_NAME").prop('required',false);
      $("#TYPE_TEACHING_NAME").hide();
      $("#TYPE_TEACHING_NAME").val("");
    }

    });

});

function other_type() {
  if(document.querySelector("input[name='TYPE_TEACHING']:checked").value=="OTH")
  {
    document.getElementById("TYPE_TEACHING_NAME").style.display = "";
  }
  else {
    document.getElementById("TYPE_TEACHING_NAME").style.display = "none";
  }
}


function checkreq(casesubmit) {
  if($("[required]").val()!=null && $("[required]").val()!="")
  {
    submitfunc(casesubmit);
  }
  else {

    alert('กรุณากรอกข้อมูลให้ครบถ้วน');
    return false;
  }
}

function confreset() {
    confirm("ต้องการรีเซ็ตข้อมูลทั้งหมดหรือไม่");
}



</script>
</header>
<body class="mybox">
  <div id="wrapper" style="padding-left: 30px; padding-right: 30px;">
<div class="row">
  <center>
    <h3 class="page-header">แบบแจ้งวิธีการวัดผลและประเมินผลการศึกษา คณะเภสัชศาสตร์</h3>

    <form  data-toggle="validator" role="form">
      <div id="formchecksj" class="form-inline" style="font-size:16px;">
                <div class="form-group ">
                  รหัสกระบวนวิชา
                   <input type="text" class="form-control numonly" id="id" name="id" size="7" placeholder="e.g. 204111" maxlength="6" pattern=".{6,6}" required >
                </div>
                <input type="hidden" name="type" value="1">
               <button type="button" class="btn btn-outline btn-primary" onclick="checksubject(1,1);">ค้นหา</button>
       </div>

  <div id="formdrpd" style="display: none;">
    <div class="form-inline">
      <div class="form-group " style="font-size:16px;">
         ภาคการศึกษาและปีการศึกษา
        <select class="form-control required" id="semester" style="width: 300px;" required >
        </select>
       </div>
       <input type="button" class="btn btn-outline btn-primary" name="subhead" id="subhead" value="ยืนยัน" onclick="checksubject(2,1);">
     </div>
   </div>
       </form>


  </center>
</div>

<div class="panel panel-default">
<form data-toggle="validator" role="form" name="form1" id="form1" method="post">
    <ol>
      <br>
      <li style="font-size: 14px">
        <div class="form-inline">
          <div class="form-group">
          <b>รหัสกระบวนวิชา</b> &nbsp;<input style="width: 100px;" type="text" class="form-control numonly" name="COURSE_ID" id="COURSE_ID"   maxlength="6" required pattern=".{6,6}" >
          </div>
          <div class="form-group">
            &nbsp;จำนวนตอนที่ (ทั้งหมด) &nbsp;<input style="width: 70px;"type="text" class="form-control numonly" name="SECTION" id="SECTION" size="2" maxlength="2" required pattern=".{1,2}" >
          </div>
          <div class="form-group"><div class="radio">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="NORORSPE" id="NORORSPE1" value="NORMAL" checked>&nbsp;<b>ภาคปกติ</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="NORORSPE" id="NORORSPE2" value="SPECIAL">&nbsp;<b>ภาคพิเศษ</b>
          </div></div>
          <br>
          <div class="form-group">
          ชื่อกระบวนวิชาภาษาไทย &nbsp;<input style="width: 500px;" type="text" class="form-control" name="NAME_TH_COURSE" id="NAME_TH_COURSE"   maxlength="50" required >
          </div>
          <br>
          <div class="form-group">
          ชื่อกระบวนวิชาภาษาอังกฤษ &nbsp;<input style="width: 500px;" type="text" class="form-control" name="NAME_ENG_COURSE" id="NAME_ENG_COURSE"   maxlength="50" required >
          </div>
          <div class="row">
            <div class=" form-group">&nbsp;&nbsp;&nbsp;&nbsp;จำนวนหน่วยกิตทั้งหมด &nbsp;<input type="text" class="form-control" name="TOTAL" id="TOTAL" size="5" maxlength="10" required pattern=".{8,10}" >&nbsp; หน่วยกิต
            <div class=" form-group">&nbsp;&nbsp;&nbsp;&nbsp;จำนวนนักศึกษาที่ลงทะเบียนเรียน &nbsp;<input style="width: 70px" type="text" class="form-control numonly" name="ENROLL" id="ENROLL" size="2" maxlength="3" pattern=".{1,3}" required> &nbsp; คน </div>
            </div>
          </div>

        </div>
      </li>
      <br>
      <li style="font-size: 14px">
        <div class="form-inline">
          <b>ลักษณะการเรียนการสอน&nbsp;&nbsp;</b><br>
          <div class="form-group"><div class="radio">
            <input type="radio" name="TYPE_TEACHING" id="TYPE_TEACHING1" value="LEC" required> บรรยาย &nbsp;<br>
            <input type="radio" name="TYPE_TEACHING" id="TYPE_TEACHING2" value="LECLAB"> บรรยายและปฏิบัติการ&nbsp;<br>
            <input type="radio" name="TYPE_TEACHING" id="TYPE_TEACHING3" value="SPE"> โครงงานทางเภสัชกรรม&nbsp;<br>
            <input type="radio" name="TYPE_TEACHING" id="TYPE_TEACHING4" value="TRA"> ฝึกงาน &nbsp;<br>
            <input type="radio" name="TYPE_TEACHING" id="TYPE_TEACHING5" value="SEM"> สัมมนา &nbsp;<br>
            <input type="radio" name="TYPE_TEACHING" id="TYPE_TEACHING6" value="LAB"> ปฏิบัติการ &nbsp;<br>
            <input type="radio" name="TYPE_TEACHING" id="TYPE_TEACHING7" value="OTH" onchange="other_type()"> อื่นๆ &nbsp;
          </div>
        </div><br>
            <input type="text" class="form-control" name="TYPE_TEACHING_NAME" id="TYPE_TEACHING_NAME" placeholder="โปรดระบุ">

        </div>
      </li>

      <br>
          <li style="font-size: 14px;">
            <b>วิธีการตัดเกรด</b>
            <br>
            <div class="form-inline">
              <div class="form-group form-inline"><div class="radio">
              <input type="radio" name="CALCULATE" id="CALCULATE_TYPE1" value="GROUP" required> อิงกลุ่ม &nbsp;
              <input type="text" class="form-control" name="EXPLAINATION" id="EXPLAINATION" placeholder="โปรดระบุ">
              <br><input type="radio" name="CALCULATE" id="CALCULATE_TYPE2" value="CRITERIA" checked> อิงเกณฑ์ &nbsp;&nbsp;ได้กำหนดเกณฑ์ดังต่อไปนี้
            </div></div>
              <br><b class="opacity01">การประเมินผล</b><br>
              <div class="form-group opacity01"><div class="radio">
                <input type="radio" name="EVALUATE_TYPE" id="EVALUATE1" value="AF" required> ให้ลำดับขั้น A, B+ ,B, C+, C, D+, D, F <br>
                <input type="radio" name="EVALUATE_TYPE" id="EVALUATE2" value="SU"> ให้อักษร S หรือ U (ได้รับการอนุมัติจากมหาวิทยาลัยแล้ว)
              </div></div>

          </div>
            <br>
            <div class="row">
            <div class="col-md-10">
            <table class="table table-hover" style="font-size: 14px; ">
              <tr align="center">
                <th>เกรด</th>
                <th>คะแนนต่ำสุด</th>
                <th></th>
                <th>คะแนนสูงสุด</th>
                <th></th>
                <th>เกรด</th>
                <th>คะแนนต่ำสุด</th>
                <th></th>
                <th>คะแนนสูงสุด</th>
                <th></th>
              </tr>
              <tr align="center">
                <td>A</td>
                <td><input type="text" class="form-control numonly atof" name="CALCULATE_A_MIN" id="CALCULATE_A_MIN" maxlength="5" value="80.0"></td>
                <td>ถึง</td>
                <td><input type="text" class="form-control numonly" name="CALCULATE_A_MAX" id="CALCULATE_A_MAX" placeholder="100" disabled></td>
                <td></td>
                <td>D+</td>
                <td><input type="text" class="form-control numonly atof" name="CALCULATE_Dp_MIN" id="CALCULATE_Dp_MIN" maxlength="5" value="55.0"></td>
                <td>ถึง</td>
                <td><input type="text" class="form-control numonly atof" name="CALCULATE_Dp_MAX" id="CALCULATE_Dp_MAX" maxlength="5" value="59.9"></td>
                <td></td>
              </tr>
              <tr align="center">
                <td>B+</td>
                <td><input type="text" class="form-control numonly atof" name="CALCULATE_Bp_MIN" id="CALCULATE_Bp_MIN" maxlength="5" value="75.0"></td>
                <td>ถึง</td>
                <td><input type="text" class="form-control numonly atof" name="CALCULATE_Bp_MAX" id="CALCULATE_Bp_MAX" maxlength="5" value="79.9"></td>
                <td></td>
                <td>D</td>
                <td><input type="text" class="form-control numonly atof" name="CALCULATE_D_MIN" id="CALCULATE_D_MIN" maxlength="5" value="50.0"></td>
                <td>ถึง</td>
                <td><input type="text" class="form-control numonly atof" name="CALCULATE_D_MAX" id="CALCULATE_D_MAX" maxlength="5" value="54.9"></td>
                <td></td>
              </tr>
              <tr align="center">
                <td>B</td>
                <td><input type="text" class="form-control numonly atof" name="CALCULATE_B_MIN" id="CALCULATE_B_MIN" maxlength="5" value="70.0"></td>
                <td>ถึง</td>
                <td><input type="text" class="form-control numonly atof" name="CALCULATE_B_MAX" id="CALCULATE_B_MAX" maxlength="5" value="74.9"></td>
                <td></td>
                <td>F</td>
                <td><input type="text" class="form-control numonly" name="CALCULATE_F_MIN" id="CALCULATE_F_MIN" placeholder="0" disabled></td>
                <td>ถึง</td>
                <td><input type="text" class="form-control numonly atof" name="CALCULATE_F_MAX" id="CALCULATE_F_MAX" maxlength="5" value="49.9"></td>
                <td></td>
              </tr>
              <tr align="center">
                <td>C+</td>
                <td><input type="text" class="form-control numonly atof" name="CALCULATE_Cp_MIN" id="CALCULATE_Cp_MIN" maxlength="5" value="65.0"></td>
                <td>ถึง</td>
                <td><input type="text" class="form-control numonly atof" name="CALCULATE_Cp_MAX" id="CALCULATE_Cp_MAX" maxlength="5" value="69.9"></td>
                <td></td>
                <td>S</td>
                <td><input type="text" class="form-control numonly stou" name="CALCULATE_S_MIN" id="CALCULATE_S_MIN" maxlength="5" value=""></td>
                <td>ถึง</td>
                <td><input type="text" class="form-control numonly" name="CALCULATE_S_MAX" id="CALCULATE_S_MIN" placeholder="100" disabled></td>
                <td></td>
              </tr>
              <tr align="center">
                <td>C</td>
                <td><input type="text" class="form-control numonly atof" name="CALCULATE_C_MIN" id="CALCULATE_C_MIN" maxlength="5" value="60.0"></td>
                <td>ถึง</td>
                <td><input type="text" class="form-control numonly atof" name="CALCULATE_C_MAX" id="CALCULATE_C_MAX" maxlength="5" value="64.9"></td>
                <td></td>
                <td>U</td>
                <td><input type="text" class="form-control numonly" name="CALCULATE_U_MAX" id="CALCULATE_U_MIN" placeholder="0" disabled></td>
                <td>ถึง</td>
                <td><input type="text" class="form-control numonly stou" name="CALCULATE_U_MAX" id="CALCULATE_U_MAX" maxlength="5" value=""></td>
                <td></td>
              </tr>
            </table>
          </div>
        </div>
          <div class="form-inline">
            <b>อื่นๆ</b><br>
            <textarea class="form-control" name="CALOTHER" id="CALOTHER" rows="4" cols="125" ></textarea>
          </div>


          </li>

          <br>
          <li style="font-size: 14px;">
            <b>นักศึกษาที่ขาดสอบในการวัดผลครั้งสุดท้าย</b> &nbsp;&nbsp;โดยไม่ได้รับอนุญาตให้เลื่อนการสอบตามข้อบังคับฯ ของมหาวิทยาลัยเชียงใหม่ ว่าด้วยการศึกษาชั้นปริญญาตรี อาจารย์ผู้สอนจะประเมินดังนี้
            <br>
            <div class="form-inline"><div class="form-group"><div class="radio">
            <input type="radio" name="ABSENT" id="ABSENT1" value="F" required>&nbsp;ให้ลำดับขั้น F &nbsp;&nbsp; <br>
            <input type="radio" name="ABSENT" id="ABSENT2" value="U" >&nbsp;ให้อักษร U &nbsp;&nbsp;<br>
            <input type="radio" name="ABSENT" id="ABSENT3" value="CAL" >&nbsp;นำคะแนนทั้งหมดที่นักศึกษาได้รับก่อนการสอบไล่มาประเมิน &nbsp;&nbsp;<br>
          </div></div></div>
          </li>




    </ol>
    <br><br>
    <div align="center">
      <input type="button" style="font-size: 18px;" class="btn btn-outline btn-success" name="submitbtn" id="submitbtn" onclick="checkreq('1')" value="ยืนยันเพื่อส่งข้อมูล" > &nbsp;
      <input type="button" style="font-size: 18px;" class="btn btn-outline btn-warning" name="draftbtn" id="draftbtn" value="บันทึกข้อมูลชั่วคราว" onclick="checkreq('2')"> &nbsp;
      <input type="reset" style="font-size: 18px;" class="btn btn-outline btn-danger" name="resetbtn" id="resetbtn" onclick="confreset();" value="รีเซ็ตข้อมูล">
    </div>
</form>
</div>
</div>
</div>
</body>
</html>

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


function submitfunc(casesubmit) {

  var data = {
    'COURSE_ID': document.getElementById("COURSE_ID").value,
    'NAMETH' : document.getElementById("NAME_TH_COURSE").value,
    'NAMEENG' : document.getElementById("NAME_ENG_COURSE").value,
    'CREDIT' : {
      'TOTAL' : document.getElementById("TOTAL").value
    },
    /*'TYPE_TEACHING' : document.querySelector("input[name='TYPE_TEACHING']:checked").value,
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
    'ABSENT' : document.querySelector("input[name='ABSENT']:checked").value,*/
    'SUBMIT_TYPE' : casesubmit
  };

  //alert(JSON.stringify(data));
  if(casesubmit=='1')
  {
    senddata(JSON.stringify(data));
  }

}
function senddata(data)
{

  //prompt("data", data);
   file_data.append("DATA",data);
   var URL = '../../application/subject/add_course.php';
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
    <h3 class="page-header">เพิ่มกระบวนวิชา</h3>


  </center>
</div>

<div class="panel panel-default">
<form data-toggle="validator" role="form" name="form1" id="form1" method="post">
    <ol>
      <br>
      <li style="font-size: 14px">
        <div class="form-inline">
          <div class="form-group">
          <b>รหัสกระบวนวิชา</b> &nbsp;<input style="width: 100px;" type="text" class="form-control numonly" name="COURSE_ID" id="COURSE_ID"  placeholder="e.g. 204111"  maxlength="6" required pattern=".{6,6}" >
          </div>
          <!--<div class="form-group">
            &nbsp;จำนวนตอนที่ (ทั้งหมด) &nbsp;<input style="width: 70px;"type="text" class="form-control numonly" name="SECTION" id="SECTION" size="2" maxlength="2" required pattern=".{1,2}" >
          </div>
          <div class="form-group"><div class="radio">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="NORORSPE" id="NORORSPE1" value="NORMAL" checked>&nbsp;<b>ภาคปกติ</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="NORORSPE" id="NORORSPE2" value="SPECIAL">&nbsp;<b>ภาคพิเศษ</b>
          </div></div>-->
          <br>
          <div class="form-group">
          ชื่อกระบวนวิชาภาษาไทย &nbsp;<input style="width: 500px;" type="text" class="form-control" name="NAME_TH_COURSE" id="NAME_TH_COURSE"   maxlength="50" required placeholder="e.g. การเรียนรู้นอกห้องเรียนเพื่อเสริมสร้างประสบการณ์ชีวิต">
          </div>
          <br>
          <div class="form-group">
          ชื่อกระบวนวิชาภาษาอังกฤษ &nbsp;<input style="width: 500px;" type="text" class="form-control" name="NAME_ENG_COURSE" id="NAME_ENG_COURSE"   maxlength="50" required placeholder="e.g. Learning outside for experience">
          </div>
          <div class="row">
            <div class=" form-group">&nbsp;&nbsp;&nbsp;&nbsp;จำนวนหน่วยกิตทั้งหมด &nbsp;<input type="text" class="form-control" name="TOTAL" id="TOTAL" size="7" maxlength="10" required pattern=".{8,10}" placeholder="e.g. 3(3-0-6)" >&nbsp; หน่วยกิต
            </div>
          </div>

        </div>
      </li>
      <br>
      <!--<li style="font-size: 14px">
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
        </li>-->
    </ol>
    <div align="center">
      <input type="button" style="font-size: 18px;" class="btn btn-outline btn-success" name="submitbtn" id="submitbtn" onclick="checkreq('1')" value="ยืนยันเพื่อส่งข้อมูล" > &nbsp;
      <input type="reset" style="font-size: 18px;" class="btn btn-outline btn-danger" name="resetbtn" id="resetbtn" onclick="confreset();" value="รีเซ็ตข้อมูล">
    </div>
</form>
</div>
</div>
</div>
</body>
</html>

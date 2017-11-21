<?php
  session_start();
  require_once('../../application/class/person.php');
  require_once('../../application/class/course.php');
  require_once(__DIR__.'/../../application/class/manage_deadline.php');
  $deadline = new Deadline();
  $courseobj = new Course();
  $person = new Person();
  $semester= $deadline->Get_Current_Semester();
  $dept = $person->Get_Staff_Dep($_SESSION['id']);
  if($_SESSION['level'] == '3' || $_SESSION['level'] == '7')
  {
    $course = $courseobj->Get_All_Course('all');
  }
  else
  {
    $course = $courseobj->Get_All_Course($dept['code']);
  }
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
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>

  <link rel="stylesheet" href="../dist/css/scrollbar.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

  <script src="../dist/js/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="../dist/css/sweetalert2.min.css">

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

  .formlength{
    width: auto !important;
  }
  input[type=radio]{
    position: static!important;
    margin-left: 0px!important;
  }
  table { width: auto !important; }
  textarea {
    width: auto !important;
  }
  </style>

<script id="contentScript">

function delsubj() {
  swal({
    title: '',
    text: 'ท่านต้องการลบกระบวนวิชานี้ในระบบหรือไม่?',
    type: 'question',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ok',
    cancelButtonText: 'Cancel'
  }).then(function () {

    var deldata = {
      'COURSE_ID' : document.getElementById("COURSE_ID").value
    };

    var data = JSON.stringify(deldata);

    var type = 'delete';
    var file_data = new FormData;
    file_data.append("DATA",data);
    file_data.append("TYPE",type);
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

  }, function (dismiss) {
  // dismiss can be 'cancel', 'overlay',
  // 'close', and 'timer'
  if (dismiss === 'cancel') {

  }
})
}

function checksubject() {

  if($('#COURSE_ID').val()=="" ||$('#COURSE_ID').val()==null || $('#COURSE_ID').val().length != 6 )
  {
    $('#submitbtn').hide();
    swal(
       '',
       'กรุณากรอกรหัสกระบวนวิชาให้ถูกต้อง',
       'error'
     )
  }
  else {
  var file_data = new FormData;
  var course_id = document.getElementById('COURSE_ID').value;
  var submittype = '1';
  JSON.stringify(course_id);
  JSON.stringify(submittype);
  file_data.append("course_id",course_id);
  file_data.append("type",submittype);
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


                    if(!temp['INFO'].course_id){

                        swal({
                          title: 'กระบวนวิชาที่ค้นหาไม่พบในระบบ',
                          text: 'ท่านต้องการที่จะเพิ่มกระบวนวิชาใหม่หรือไม่?',
                          type: 'question',
                          showCancelButton: true,
                          confirmButtonColor: '#3085d6',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Ok',
                          cancelButtonText: 'Cancel',
                          allowOutsideClick: false
                        }).then(function () {
                          $('#typesubmit').val("add");
                          $('.dis').prop('disabled', false);
                          $('#deletebtn').prop('disabled', true);
                          document.getElementById('NAME_ENG_COURSE').value = '';
                          document.getElementById('NAME_TH_COURSE').value = '';
                          $('#submitbtn').show();

                        }, function (dismiss) {
                        // dismiss can be 'cancel', 'overlay',
                        // 'close', and 'timer'
                        if (dismiss === 'cancel') {
                          document.getElementById("form1").reset();
                          $('#deletebtn').hide();
                          $('#submitbtn').hide();
                          $('.dis').prop('disabled', true);

                        }
                      })
                     }
                     else if(temp['INFO']!=false){
                        swal(
                           'สำเร็จ',
                           'ดึงข้อมูลสำเร็จ <br>สามารถแก้ไขรายละเอียดได้ดังแบบฟอร์มข้างล่าง',
                           'success'
                         )

                        $('#submitbtn').show();
                        $('#deletebtn').show();
                        $('#typesubmit').val('edit');
                        $('.dis').prop('disabled', false);
                        $('#deletebtn').prop('disabled', false);
                        document.getElementById('COURSE_ID').value = temp['INFO']['course_id'];
                        document.getElementById('NAME_ENG_COURSE').value = temp['INFO']['course_name_en'];
                        document.getElementById('NAME_TH_COURSE').value = temp['INFO']['course_name_th'];
                        var stringor = temp['info']['credit'];
                        var splitor = stringor.split('(');
                        var hr_total = splitor[0];
                        var splitor2 = splitor[1].split('-');
                        var hr_lec = splitor2[0];
                        var hr_lab = splitor2[1];
                        var splitor3 = splitor2[2].split(')');
                        var hr_self = splitor3[0];
                        document.getElementById('TOTAL_1').value = hr_total;
                        document.getElementById('TOTAL_2').value = hr_lec;
                        document.getElementById('TOTAL_3').value = hr_lab;
                        document.getElementById('TOTAL_4').value = hr_self;
                      }
                    } catch (e) {
                         console.log('Error#542-decode error');
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

function submitfunc() {

  //typesubmit
  var typesubmit = document.getElementById('typesubmit').value;
  //CREDIT
  var total = document.getElementById("TOTAL_1").value;
  var lec = document.getElementById("TOTAL_2").value;
  var lab = document.getElementById("TOTAL_3").value;
  var self = document.getElementById("TOTAL_4").value;
  var data = {
    'COURSE_ID' : document.getElementById("COURSE_ID").value,
    'NAMETH' : document.getElementById("NAME_TH_COURSE").value,
    'NAMEENG' : document.getElementById("NAME_ENG_COURSE").value,
    'CREDIT' : total+"("+lec+"-"+lab+"-"+self+")",
    'SUBMIT_TYPE' : '1'
  };

  senddata(JSON.stringify(data),typesubmit);

}
function senddata(data,typesubmit)
{
   var file_data = new FormData;
   file_data.append("DATA",data);
   file_data.append("TYPE",typesubmit);
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


// Charecter fixed
$(function() {//<-- wrapped here
  $('.numonly').on('input', function() {
    this.value = this.value.replace(/[^0-9]/g, ''); //<-- replace all other than given set of values
  });
  $('.charonly').on('input', function() {
    this.value = this.value.replace(/[^a-zA-Zก-ฮๅภถุึคตจขชๆไำพะัีรนยบลฃฟหกดเ้่าสวงผปแอิืทมใฝ๑๒๓๔ู฿๕๖๗๘๙๐ฎฑธํ๊ณฯญฐฅฤฆฏโฌ็๋ษศซฉฮฺ์ฒฬฦ. ]/g, ''); //<-- replace all other than given set of values
  });
  $('.charthonly').on('input', function() {
    this.value = this.value.replace(/[^0-9ก-ฮๅภถุึคตจขชๆไำพะัีรนยบลฃฟหกดเ้่าสวงผปแอิืทมใฝ๑๒๓๔ู฿๕๖๗๘๙๐ฎฑธํ๊ณฯญฐฅฤฆฏโฌ็๋ษศซฉฮฺ์ฒฬฦ. ]/g, ''); //<-- replace all other than given set of values
  });
  $('.charengonly').on('input', function() {
    this.value = this.value.replace(/[^0-9a-zA-Z. ]/g, ''); //<-- replace all other than given set of values
  });
  $("input[name^='TOTAL_']").keyup(function(event){
        if(event.keyCode==8){
            if($(this).val().length==0){
                $(this).prev("input").focus();
            }
            return false;
        }
        if($(this).val().length==$(this).attr("maxLength")){
            $(this).next("input").focus();
        }
    });
});

$(document).ready(function(){


  //hide
  $('#submitbtn').hide();
  $('#deletebtn').hide();
  $('.dis').prop('disabled', true);

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

function confreset(casereset) {
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
      document.getElementById("form1").reset();
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
    <h3 class="page-header"><b>เพิ่มกระบวนวิชา</b></h3>


</div>

</center>

<div class="panel panel-default" id="panelbody">
<form data-toggle="validator" role="form" name="form1" id="form1" method="post" onsubmit="checkreq('1')">
    <ol>
      <br>
      <li style="font-size: 14px">
        <div class="form-inline">
          <div class="form-group">
          <b>รหัสกระบวนวิชา</b> &nbsp;<input style="width: 100px;" type="text" class="form-control formlength numonly" name="COURSE_ID" id="COURSE_ID"  placeholder="e.g. 204111"  maxlength="6" required pattern=".{6,6}" >
          &nbsp;<button type="button" class="btn btn-outline btn-primary" onclick="checksubject();">ค้นหา</button>

          </div>
          <br>
          <div class="form-group">
          ชื่อกระบวนวิชาภาษาไทย &nbsp;<input style="width: 500px;" type="text" class="form-control formlength dis charthonly" name="NAME_TH_COURSE" id="NAME_TH_COURSE"   required placeholder="e.g. การเรียนรู้นอกห้องเรียนเพื่อเสริมสร้างประสบการณ์ชีวิต">
          </div>
          <br>
          <div class="form-group">
          ชื่อกระบวนวิชาภาษาอังกฤษ &nbsp;<input style="width: 500px;" type="text" class="form-control formlength dis charengonly" name="NAME_ENG_COURSE" id="NAME_ENG_COURSE"   required placeholder="e.g. Learning outside for experience">
          </div>
          <div class="row">
            <div class=" form-group">&nbsp;&nbsp;&nbsp;&nbsp;จำนวนหน่วยกิตทั้งหมด &nbsp;
          <input class="form-control formlength dis numonly" name="TOTAL_1" type="text" id="TOTAL_1" size="1" maxlength="1" style="width:35px;" />(
          <input class="form-control formlength dis numonly" name="TOTAL_2" type="text" id="TOTAL_2" size="1" maxlength="1" style="width:35px;" />-
          <input class="form-control formlength dis numonly" name="TOTAL_3" type="text" id="TOTAL_3" size="1" maxlength="1" style="width:35px;" />-
          <input class="form-control formlength dis numonly" name="TOTAL_4" type="text" id="TOTAL_4" size="1" maxlength="1" style="width:35px;" />)&nbsp; หน่วยกิต
            </div>
          </div>
          <input type="hidden" id="typesubmit" name="typesubmit">
        </div>
      </li>
      <br>

    </ol>
    <div align="center">
      <input type="submit" style="font-size: 18px;" class="btn btn-outline btn-success" name="submitbtn" id="submitbtn" value="ยืนยันเพื่อส่งข้อมูล" > &nbsp;
      <!-- <input type="button" style="font-size: 18px;" class="btn btn-outline btn-danger" name="resetbtn" id="resetbtn" onclick="confreset();" value="รีเซ็ตข้อมูล"> -->
      &nbsp;&nbsp;<input type="button" style="font-size: 18px;" class="btn btn-outline btn-danger" name="deletebtn" id="deletebtn" onclick="delsubj();" value="ลบข้อมูลกระบวนวิชา" disabled>

    </div>


</form>
<div class="row">
<div class="col-md-1"></div>
<div class="col-md-10">
<table class="table table-bordered table-hover" align="center" style="font-size: 13px;">
  <tr class="success">
    <th>รหัสกระบวนวิชา</th>
    <th>ชื่อกระบวนวิชาภาษาไทย</th>
    <th>ชื่อกระบวนวิชาภาษาอังกฤษ</th>
    <th>จำนวนหน่วยกิตทั้งหมด(หน่วยกิต)</th>
  </tr>
  <?php
    for ($i=0; $i <sizeof($course) ; $i++) {
     echo "<tr>";
     echo "<td>".$course[$i]['id']."</td>";
     echo "<td>".$course[$i]['name']['en']."</td>";
     echo "<td>".$course[$i]['name']['th']."</td>";
     echo "<td>".$course[$i]['credit']."</td>";
    }
   ?>
</div>
</div>
</table>
</div>
</div>
</div>
</body>
</html>

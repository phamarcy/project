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
                      } catch (e) {
                           console.log('Error#542-decode error');
                      }

                    if(temp['INFO']==false){

                        swal({
                          title: 'กระบวนวิชาที่ค้นหาไม่พบในระบบ',
                          text: 'ท่านต้องการที่จะเพิ่มกระบวนวิชาใหม่หรือไม่?',
                          type: 'question',
                          showCancelButton: true,
                          confirmButtonColor: '#3085d6',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Ok',
                          cancelButtonText: 'Cancel'
                        }).then(function () {
                          $('#typesubmit').val("add");
                          $('#deletebtn').prop('disabled', true);
                          document.getElementById('NAME_ENG_COURSE').value = '';
                          document.getElementById('NAME_TH_COURSE').value = '';
                          document.getElementById('TOTAL').value = '';
                          $('#submitbtn').show();

                        }, function (dismiss) {
                        // dismiss can be 'cancel', 'overlay',
                        // 'close', and 'timer'
                        if (dismiss === 'cancel') {
                          document.getElementById('COURSE_ID').value = '';
                          $('#submitbtn').hide();

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
                        $('#typesubmit').val('edit');
                        $('#deletebtn').prop('disabled', false);
                        document.getElementById('COURSE_ID').value = temp['INFO']['course_id'];
                        document.getElementById('NAME_ENG_COURSE').value = temp['INFO']['course_name_en'];
                        document.getElementById('NAME_TH_COURSE').value = temp['INFO']['course_name_th'];
                        document.getElementById('TOTAL').value = temp['INFO']['credit']+"("+temp['INFO']['hr_lec']+"-"+temp['INFO']['hr_lab']+"-"+temp['INFO']['hr_self']+")";
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
  var splitor = document.getElementById("TOTAL").value;
  var total = splitor.charAt(0);
  var lec = splitor.charAt(2);
  var lab = splitor.charAt(4);
  var self = splitor.charAt(6);
  var data = {
    'COURSE_ID' : document.getElementById("COURSE_ID").value,
    'NAMETH' : document.getElementById("NAME_TH_COURSE").value,
    'NAMEENG' : document.getElementById("NAME_ENG_COURSE").value,
    'CREDIT' : {
      'TOTAL' : total,
      'LEC' : lec,
      'LAB' : lab,
      'SELF' : self
    },
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
    this.value = this.value.replace(/[^0-9.]/g, ''); //<-- replace all other than given set of values
  });
  $('.charonly').on('input', function() {
    this.value = this.value.replace(/[^a-zA-Zก-ฮๅภถุึคตจขชๆไำพะัีรนยบลฃฟหกดเ้่าสวงผปแอิืทมใฝ๑๒๓๔ู฿๕๖๗๘๙๐ฎฑธํ๊ณฯญฐฅฤฆฏโฌ็๋ษศซฉฮฺ์ฒฬฦ. ]/g, ''); //<-- replace all other than given set of values
  });
});

$(document).ready(function(){


  //hide
  $('#submitbtn').hide();
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
          <b>รหัสกระบวนวิชา</b> &nbsp;<input style="width: 100px;" type="text" class="form-control numonly" name="COURSE_ID" id="COURSE_ID"  placeholder="e.g. 204111"  maxlength="6" required pattern=".{6,6}" >
          &nbsp;<button type="button" class="btn btn-outline btn-primary" onclick="checksubject();">ค้นหา</button>

          </div>
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
          <input type="hidden" id="typesubmit" name="typesubmit">
        </div>
      </li>
      <br>

    </ol>
    <div align="center">
      <input type="submit" style="font-size: 18px;" class="btn btn-outline btn-success" name="submitbtn" id="submitbtn" value="ยืนยันเพื่อส่งข้อมูล" > &nbsp;
      <input type="button" style="font-size: 18px;" class="btn btn-outline btn-danger" name="resetbtn" id="resetbtn" onclick="confreset();" value="รีเซ็ตข้อมูล">
      &nbsp;&nbsp;<input type="button" style="font-size: 18px;" class="btn btn-outline btn-danger" name="deletebtn" id="deletebtn" onclick="delsubj();" value="ลบข้อมูลกระบวนวิชา" disabled>

    </div>
</form>
</div>
</div>
</div>
</body>
</html>

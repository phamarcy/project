<?php
  session_start();
  require_once('../../application/class/manage_deadline.php');
  $dlobj = new Deadline();
  $dleva = $dlobj->Search_all(1);
  $dlcor = $dlobj->Search_all(2);
  $current = $dlobj->Get_Current_Semester();

  if(!isset($_SESSION['level']) || !isset($_SESSION['fname']) || !isset($_SESSION['lname']) || !isset($_SESSION['id']))
  {
      die('กรุณา Login ใหม่');
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
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>

  <script src="../dist/js/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="../dist/css/sweetalert2.min.css">

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

// searchname
function searchname(no,type) {

  if(type=='subject')
  {
      var name_s = $("#TEACHERLEC_F"+no).val();
      $("#dtl"+no).html('');
      if(name_s.length > 3)
      {
        $.post("search_name.php", { name: name_s}, function(data) {
              data = JSON.parse( data );
              for(var i=0;i<data.length;i++)
              {
                  $("#dtl"+no).append('<option value="'+data[i]+'"></option>');
              }

            })
            .fail(function() {
                alert("error");
            });
      }
  }
  else if (type==511) {
    var name_s = $("#MIDEXCOM_LECF"+no).val();
    $("#dtmeh"+no).html('');
    if(name_s.length > 3)
    {
      $.post("search_name.php", { name: name_s}, function(data) {
            data = JSON.parse( data );
            for(var i=0;i<data.length;i++)
            {
                $("#dtmeh"+no).append('<option value="'+data[i]+'"></option>');
            }

          })
          .fail(function() {
              alert("error");
          });
    }
  }
  else if (type==512) {
    var name_s = $("#MIDEXCOM_LABF"+no).val();
    $("#dtehlab"+no).html('');
    if(name_s.length > 3)
    {
      $.post("search_name.php", { name: name_s}, function(data) {
            data = JSON.parse( data );
            for(var i=0;i<data.length;i++)
            {
                $("#dtehlab"+no).append('<option value="'+data[i]+'"></option>');
            }

          })
          .fail(function() {
              alert("error");
          });
    }
  }
  else if (type==521) {
    var name_s = $("#MIDEXCOM_LECF"+no+"_sec").val();
    $("#dtmehle"+no+"_sec").html('');
    if(name_s.length > 3)
    {
      $.post("search_name.php", { name: name_s}, function(data) {
            data = JSON.parse( data );
            for(var i=0;i<data.length;i++)
            {
                $("#dtmehle"+no+"_sec").append('<option value="'+data[i]+'"></option>');
            }

          })
          .fail(function() {
              alert("error");
          });
    }
  }
  else if (type==522) {
    var name_s = $("#MIDEXCOM_LABF"+no+"_sec").val();
    $("#dtehla"+no+"_sec").html('');
    if(name_s.length > 3)
    {
      $.post("search_name.php", { name: name_s}, function(data) {
            data = JSON.parse( data );
            for(var i=0;i<data.length;i++)
            {
                $("#dtehla"+no+"_sec").append('<option value="'+data[i]+'"></option>');
            }

          })
          .fail(function() {
              alert("error");
          });
    }
  }
  else if (type==531) {
    var name_s = $("#FINEXCOM_LECF"+no).val();
    $("#dtfmehle"+no).html('');
    if(name_s.length > 3)
    {
      $.post("search_name.php", { name: name_s}, function(data) {
            data = JSON.parse( data );
            for(var i=0;i<data.length;i++)
            {
                $("#dtfmehle"+no).append('<option value="'+data[i]+'"></option>');
            }

          })
          .fail(function() {
              alert("error");
          });
    }
  }
  else if (type==532) {
    var name_s = $("#FINEXCOM_LABF"+no).val();
    $("#dtfehla"+no).html('');
    if(name_s.length > 3)
    {
      $.post("search_name.php", { name: name_s}, function(data) {
            data = JSON.parse( data );
            for(var i=0;i<data.length;i++)
            {
                $("#dtfehla"+no).append('<option value="'+data[i]+'"></option>');
            }

          })
          .fail(function() {
              alert("error");
          });
    }
  }

  }

  function section_box() {
    var sec = document.getElementById("SECTION");
    var i;
    if (sec.value == 1) {
      for (i = 2; i <= 5; i++) {
        document.getElementById("secdiv" + i).style.display = "none";
        document.getElementById('secdiv' + i).classList.add('hide');
        document.getElementById("ENROLL" + i).style.display = "none";
        document.getElementById("ENROLL" + i).value = "";
        $('#ENROLL'+i).prop('required', false);
      }
    } else {

      for (i = 2; i <= 5; i++) {
        document.getElementById("secdiv" + i).style.display = "none";
        document.getElementById('secdiv' + i).classList.add('hide');
        document.getElementById('ENROLL' + i).style.display = "none";
        $('#ENROLL'+i).prop('required', false);
        if(i>sec.value)
        {
          document.getElementById("ENROLL" + i).value = "";
        }
      }

      for (i = 2; i <= sec.value; i++) {
        document.getElementById("secdiv" + i).style.display = "";
        document.getElementById('secdiv' + i).classList.remove('hide');
        document.getElementById('ENROLL' + i).style.display = "";
        $('#ENROLL'+i).prop('required', true);

      }
    }
  }

function midexam_hour_lec() {
  var lec = document.getElementById("mexholec");
  var i;
  if (lec.value == 0) {
    for (i = 1; i <= 10; i++) {
      document.getElementById("mehle" + i).style.display = "none";
      document.getElementById('mehlec' + i).classList.add('hide');
      document.getElementById("MIDEXCOM_LECF" + i).style.display = "none";
      document.getElementById("MIDEXCOM_LECF" + i).value = "";
    }
  } else {
    //document.getElementById("test1").innerHTML = lab.value;
    for (i = 1; i <= 10; i++) {
      document.getElementById("mehle" + i).style.display = "none";
      document.getElementById('mehlec' + i).classList.add('hide');
      document.getElementById('MIDEXCOM_LECF' + i).style.display = "none";
      if(i>lec.value)
      {
        document.getElementById("MIDEXCOM_LECF" + i).value = "";
      }
    }

    for (i = 1; i <= lec.value; i++) {
      document.getElementById("mehle" + i).style.display = "";
      document.getElementById('mehlec' + i).classList.remove('hide');
      document.getElementById('MIDEXCOM_LECF' + i).style.display = "";

    }
  }
}

function midexam_hour_lab() {
  var lab = document.getElementById("mexholac");
  var i;
  if (lab.value == 0) {
    for (i = 1; i <= 10; i++) {
      document.getElementById("ehla" + i).style.display = "none";
      document.getElementById('ehlab' + i).classList.add('hide');
      document.getElementById("MIDEXCOM_LABF" + i).style.display = "none";
      document.getElementById("MIDEXCOM_LABF" + i).value = "";
    }
  } else {
    //document.getElementById("test1").innerHTML = lab.value;
    for (i = 1; i <= 10; i++) {
      document.getElementById("ehla" + i).style.display = "none";
      document.getElementById('ehlab' + i).classList.add('hide');
      document.getElementById('MIDEXCOM_LABF' + i).style.display = "none";
      if(i>lab.value)
      {
        document.getElementById("MIDEXCOM_LABF" + i).value = "";
      }
    }

    for (i = 1; i <= lab.value; i++) {
      document.getElementById("ehla" + i).style.display = "";
      document.getElementById('ehlab' + i).classList.remove('hide');
      document.getElementById('MIDEXCOM_LABF' + i).style.display = "";

    }
  }
}

function midexam_hour_lec_sec() {
  var lec = document.getElementById("mexholec_sec");
  var i;
  if (lec.value == 0) {
    for (i = 1; i <= 10; i++) {
      document.getElementById("mehle" + i +"_sec").style.display = "none";
      document.getElementById('mehlec' + i +"_sec").classList.add('hide');
      document.getElementById("MIDEXCOM_LECF" + i +"_sec").style.display = "none";
      document.getElementById("MIDEXCOM_LECF" + i +"_sec").value = "";

    }
  } else {
    //document.getElementById("test1").innerHTML = lab.value;
    for (i = 1; i <= 10; i++) {
      document.getElementById("mehle" + i +"_sec").style.display = "none";
      document.getElementById('mehlec' + i +"_sec").classList.add('hide');
      document.getElementById('MIDEXCOM_LECF' + i +"_sec").style.display = "none";
      if(i>lec.value)
      {
        document.getElementById("MIDEXCOM_LECF" + i +"_sec").value = "";
      }
    }

    for (i = 1; i <= lec.value; i++) {
      document.getElementById("mehle" + i +"_sec").style.display = "";
      document.getElementById('mehlec' + i +"_sec").classList.remove('hide');
      document.getElementById('MIDEXCOM_LECF' + i +"_sec").style.display = "";

    }
  }
}

function midexam_hour_lab_sec() {
  var lab = document.getElementById("mexholac_sec");
  var i;
  if (lab.value == 0) {
    for (i = 1; i <= 10; i++) {
      document.getElementById("ehla" + i +"_sec").style.display = "none";
      document.getElementById('ehlab' + i +"_sec").classList.add('hide');
      document.getElementById("MIDEXCOM_LABF" + i +"_sec").style.display = "none";
      document.getElementById("MIDEXCOM_LABF" + i +"_sec").value = "";
    }
  } else {
    //document.getElementById("test1").innerHTML = lab.value;
    for (i = 1; i <= 10; i++) {
      document.getElementById("ehla" + i +"_sec").style.display = "none";
      document.getElementById('ehlab' + i +"_sec").classList.add('hide');
      document.getElementById('MIDEXCOM_LABF' + i +"_sec").style.display = "none";
      if(i>lab.value)
      {
        document.getElementById("MIDEXCOM_LABF" + i +"_sec").value = "";
      }
    }

    for (i = 1; i <= lab.value; i++) {
      document.getElementById("ehla" + i +"_sec").style.display = "";
      document.getElementById('ehlab' + i +"_sec").classList.remove('hide');
      document.getElementById('MIDEXCOM_LABF' + i +"_sec").style.display = "";

    }
  }
}

function finexam_hour_lec() {
  var lec = document.getElementById("fexholec");
  var i;
  if (lec.value == 0) {
    for (i = 1; i <= 10; i++) {
      document.getElementById("fmehle" + i).style.display = "none";
      document.getElementById('fmehlec' + i).classList.add('hide');
      document.getElementById("FINEXCOM_LECF" + i).style.display = "none";
      document.getElementById("FINEXCOM_LECF" + i).value = "";
    }
  } else {
    //document.getElementById("test1").innerHTML = lab.value;
    for (i = 1; i <= 10; i++) {
      document.getElementById("fmehle" + i).style.display = "none";
      document.getElementById('fmehlec' + i).classList.add('hide');
      document.getElementById('FINEXCOM_LECF' + i).style.display = "none";
      if(i>lec.value)
      {
        document.getElementById("FINEXCOM_LECF" + i).value = "";
      }

    }

    for (i = 1; i <= lec.value; i++) {
      document.getElementById("fmehle" + i).style.display = "";
      document.getElementById('fmehlec' + i).classList.remove('hide');
      document.getElementById('FINEXCOM_LECF' + i).style.display = "";

    }
  }
}

function finexam_hour_lab() {
  var lab = document.getElementById("fexholac");
  var i;
  if (lab.value == 0) {
    for (i = 1; i <= 10; i++) {
      document.getElementById("fehla" + i).style.display = "none";
      document.getElementById('fehlab' + i).classList.add('hide');
      document.getElementById("FINEXCOM_LABF" + i).style.display = "none";
      document.getElementById("FINEXCOM_LABF" + i).value = "";
    }
  } else {
    //document.getElementById("test1").innerHTML = lab.value;
    for (i = 1; i <= 10; i++) {
      document.getElementById("fehla" + i).style.display = "none";
      document.getElementById('fehlab' + i).classList.add('hide');
      document.getElementById('FINEXCOM_LABF' + i).style.display = "none";
      if(i>lab.value)
      {
        document.getElementById("FINEXCOM_LABF" + i).value = "";
      }

    }

    for (i = 1; i <= lab.value; i++) {
      document.getElementById("fehla" + i).style.display = "";
      document.getElementById('fehlab' + i).classList.remove('hide');
      document.getElementById('FINEXCOM_LABF' + i).style.display = "";

    }
  }
}

function getinfo(temp) {
  // part1
  document.getElementById('COURSE_ID').value = temp['COURSE_ID'];
  document.getElementById('SECTION').value = temp['SECTION'];
  var choice1 = temp['NORORSPE'];
  $('input[name="NORORSPE"][value=' + choice1 + ']').prop('checked', true);
  document.getElementById('NAME_ENG_COURSE').value = temp['NAMEENG'];
  document.getElementById('NAME_TH_COURSE').value = temp['NAMETH'];

  for (var i = 0; i <temp['SECTION']; i++) {
    document.getElementById("secdiv" + (i+1)).style.display = "";
    document.getElementById('secdiv' + (i+1)).classList.remove('hide');
    document.getElementById('ENROLL'+(i+1)).style.display = "";
    document.getElementById('ENROLL'+(i+1)).value = temp['STUDENT'][i];
  }
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

  //part3
  for(var i=0;i<=4;i++)
  {
    document.getElementById('TEACHERLEC_F'+(i+1)).value = temp['TEACHER'][i];
  }

  //part4
  document.getElementById('MEASURE_MIDLEC1').value = temp['MEASURE']['MID1']['LEC'];
  document.getElementById('MEASURE_MIDLAB1').value = temp['MEASURE']['MID1']['LAB'];
  document.getElementById('MEASURE_MIDLEC2').value = temp['MEASURE']['MID2']['LEC'];
  document.getElementById('MEASURE_MIDLAB2').value = temp['MEASURE']['MID2']['LAB'];
  document.getElementById('MEASURE_FINLEC').value = temp['MEASURE']['FINAL']['LEC'];
  document.getElementById('MEASURE_FINLAB').value = temp['MEASURE']['FINAL']['LAB'];
  document.getElementById('MEASURE_WORKLEC').value = temp['MEASURE']['WORK']['LEC'];
  document.getElementById('MEASURE_WORKLAB').value = temp['MEASURE']['WORK']['LAB'];
  document.getElementById('OTHER_MEA').value = temp['MEASURE']['OTHER']['OTH'];
  document.getElementById('MEASURE_OTHLEC').value = temp['MEASURE']['OTHER']['LEC'];
  document.getElementById('MEASURE_OTHLAB').value = temp['MEASURE']['OTHER']['LAB'];
  document.getElementById('MEASURE_TOTALLEC').value = temp['MEASURE']['TOTAL']['LEC'];
  document.getElementById('MEASURE_TOTALLAB').value = temp['MEASURE']['TOTAL']['LAB'];

  //part5
  document.getElementById('MIDEXAM_HOUR_LEC').value = temp['EXAM']['MID1']['HOUR']['LEC'];
  document.getElementById('MIDEXAM_HOUR_LAB').value = temp['EXAM']['MID1']['HOUR']['LAB'];
  document.getElementById('MIDEXAM_HOUR_LEC_SEC').value = temp['EXAM']['MID2']['HOUR']['LEC'];
  document.getElementById('MIDEXAM_HOUR_LAB_SEC').value = temp['EXAM']['MID2']['HOUR']['LAB'];
  document.getElementById('FINEXAM_HOUR_LEC').value = temp['EXAM']['FINAL']['HOUR']['LEC'];
  document.getElementById('FINEXAM_HOUR_LAB').value = temp['EXAM']['FINAL']['HOUR']['LAB'];
  document.getElementById('mexholec').value = temp['EXAM']['MID1']['NUMBER']['LEC'];
  document.getElementById('mexholac').value = temp['EXAM']['MID1']['NUMBER']['LAB'];
  document.getElementById('mexholec_sec').value = temp['EXAM']['MID2']['NUMBER']['LEC'];
  document.getElementById('mexholac_sec').value = temp['EXAM']['MID2']['NUMBER']['LAB'];
  document.getElementById('fexholec').value = temp['EXAM']['FINAL']['NUMBER']['LEC'];
  document.getElementById('fexholac').value = temp['EXAM']['FINAL']['NUMBER']['LAB'];
  document.getElementById('suggestion').value = temp['EXAM']['SUGGESTION'];

  for(var i=0;i<temp['EXAM']['MID1']['NUMBER']['LEC'];i++)
  {
    document.getElementById("mehle" + (i+1)).style.display = "";
    document.getElementById('mehlec' + (i+1)).classList.remove('hide');
    document.getElementById('MIDEXCOM_LECF'+(i+1)).style.display = "";
    document.getElementById('MIDEXCOM_LECF'+(i+1)).value = temp['EXAM']['MID1']['COMMITTEE']['LEC'][i];
  }
  for(var i=0;i<temp['EXAM']['MID1']['NUMBER']['LAB'];i++)
  {
    document.getElementById("ehla" + (i+1)).style.display = "";
    document.getElementById('ehlab' + (i+1)).classList.remove('hide');
    document.getElementById('MIDEXCOM_LABF' + (i+1)).style.display = "";
    document.getElementById('MIDEXCOM_LABF'+(i+1)).value = temp['EXAM']['MID1']['COMMITTEE']['LAB'][i];
  }
  for(var i=0;i<temp['EXAM']['MID2']['NUMBER']['LEC'];i++)
  {
    document.getElementById("mehle" + (i+1) +"_sec").style.display = "";
    document.getElementById('mehlec' + (i+1) +"_sec").classList.remove('hide');
    document.getElementById('MIDEXCOM_LECF' + (i+1) +"_sec").style.display = "";
    document.getElementById('MIDEXCOM_LECF'+(i+1)+'_sec').value = temp['EXAM']['MID2']['COMMITTEE']['LEC'][i];
  }
  for(var i=0;i<temp['EXAM']['MID2']['NUMBER']['LAB'];i++)
  {
    document.getElementById("ehla" + (i+1) +"_sec").style.display = "";
    document.getElementById('ehlab' + (i+1) +"_sec").classList.remove('hide');
    document.getElementById('MIDEXCOM_LABF' + (i+1) +"_sec").style.display = "";
    document.getElementById('MIDEXCOM_LABF'+(i+1)+'_sec').value = temp['EXAM']['MID2']['COMMITTEE']['LAB'][i];
  }
  for(var i=0;i<temp['EXAM']['FINAL']['NUMBER']['LEC'];i++)
  {
    document.getElementById("fmehle" + (i+1)).style.display = "";
    document.getElementById('fmehlec' + (i+1)).classList.remove('hide');
    document.getElementById('FINEXCOM_LECF' + (i+1)).style.display = "";
    document.getElementById('FINEXCOM_LECF'+(i+1)).value = temp['EXAM']['FINAL']['COMMITTEE']['LEC'][i];
  }
  for(var i=0;i<temp['EXAM']['FINAL']['NUMBER']['LAB'];i++)
  {
    document.getElementById("fehla" + (i+1)).style.display = "";
    document.getElementById('fehlab' + (i+1)).classList.remove('hide');
    document.getElementById('FINEXCOM_LABF' + (i+1)).style.display = "";
    document.getElementById('FINEXCOM_LABF'+(i+1)).value = temp['EXAM']['FINAL']['COMMITTEE']['LAB'][i];
  }

  //part6
  var choice3 = temp['CALCULATE']['TYPE'];
  $('input[name="CALCULATE"][value=' + choice3 + ']').prop('checked', true);
  document.getElementById('EXPLAINATION').value = temp['CALCULATE']['EXPLAINATION'];
  document.getElementById("CALOTHER").value = temp['CALCULATE']['OTHERGRADE'];

  //fucntion for disabled
  if($("input[name='CALCULATE']:checked").val()=="GROUP")
  {
    $('.atof').val("");
    $('#EXPLAINATION').prop('disabled',false);
    $('.atof').prop('disabled',true);
    $('.stou').prop('disabled',true);
    $('.atof').prop('required',false);
    $('.stou').prop('required',false);
    $('#CALOTHER').prop('disabled',true);
  }
  else if ($("input[name='CALCULATE']:checked").val()=="CRITERIA")
  {
    $('#EXPLAINATION').prop('disabled',true);
    $('#CALOTHER').prop('disabled',false);
    $('.stou').prop('disabled',true);
    $('.atof').prop('required',true);
    $('.atof').prop('disabled',false);
    $('.stou').prop('required',false);
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
  }else {
    $('.atof').val("");
    $('#EXPLAINATION').prop('disabled',true);
    $('#CALOTHER').prop('disabled',true);
    $('.atof').prop('disabled',true);
    $('.stou').prop('disabled',false);
    $('.atof').prop('required',false);
    $('.stou').prop('required',true);
    document.getElementById("CALCULATE_S_MIN").value = temp['CALCULATE']['S']['MIN'];
    document.getElementById("CALCULATE_U_MAX").value = temp['CALCULATE']['U']['MAX'];
  }

  //part7
  var choice5 = temp['ABSENT'];
  $('input[name="ABSENT"][value=' + choice5 + ']').prop('checked', true);

  //buttondiv
  if(temp['ACCESS'] == true)
  {
    $('#buttondiv').show();
  }else {
    $('#buttondiv').hide();
  }
}

function checksubject(btntype,type){

  if(btntype==1)
  {
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
                        } catch (e) {
                             console.log('Error#542-decode error');
                        }
                        
                       if(temp['info']!=false && temp[0]!=null)
                       {
                         document.getElementById('formdrpd').style.display = "";
                         //cleardatalist
                         var selectobject = document.getElementById('semester');
                         var long = selectobject.length;
                         if(long!=0 && long!=null)
                         {
                           for (var i=0; i<=long; i++){
                             document.getElementsByName("semester")[0].remove(0);
                           }
                         }

                         for(var i=0;i<(Object.keys(temp).length - 1);i++)
                         {
                           var opt = document.createElement('option');
                           opt.value = temp[i].semester +"_"+ temp[i].year;
                           opt.innerHTML = "ภาคการศึกษาที่ " +temp[i].semester +" ปีการศึกษา "+ temp[i].year;
                           document.getElementById('semester').appendChild(opt);
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
                          //alert('ท่านยังไม่เคยกรอกรายละเอียดในวิชานี้\nสามารถกรอกรายละเอียดได้ดังแบบฟอร์มข้างล่าง');
                          swal(
                             '',
                             'ท่านยังไม่เคยกรอกรายละเอียดในวิชานี้ <br>สามารถกรอกรายละเอียดได้ดังแบบฟอร์มข้างล่าง',
                             'error'
                           )
                          document.getElementById('COURSE_ID').value = temp['info']['course_id'];
                          document.getElementById('NAME_ENG_COURSE').value = temp['info']['course_name_en'];
                          document.getElementById('NAME_TH_COURSE').value = temp['info']['course_name_th'];
                          document.getElementById('TOTAL').value = temp['info']['credit']+"("+temp['info']['hr_lec']+"-"+temp['info']['hr_lab']+"-"+temp['info']['hr_self']+")";
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
                    try {
                      var temp = $.parseJSON(result);
                    } catch (e) {
                         console.log('Error#542-decode error');
                    }
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


  //alert(JSON.stringify(data));
  if(casesubmit=='1'||casesubmit=='2')
  {

      //Loop for pack TEACHER
      var teacher_lec = {};
      var tlec = [];

      for(var i=1;i<=5;i++)
      {
        tlec[i-1] = document.getElementById("TEACHERLEC_F"+i).value;
      }

      teacher_lec = tlec;

      //Loop for COMMITTEE
      var commidlec = {};
      var commidlab = {};
      var commidlec_sec = {};
      var commidlab_sec = {};
      var comfinlec = {};
      var comfinlab = {};
      var cmle = [];
      var cmla = [];
      var cmle_sec = [];
      var cmla_sec = [];
      var cfle = [];
      var cfla = [];

      for(var i=1;i<=document.getElementById("mexholec").value;i++)
      {
        cmle[i-1] = document.getElementById("MIDEXCOM_LECF"+i).value;
      }
      for(var i=1;i<=document.getElementById("mexholac").value;i++)
      {
        cmla[i-1] = document.getElementById("MIDEXCOM_LABF"+i).value;
      }
      for(var i=1;i<=document.getElementById("mexholec_sec").value;i++)
      {
        cmle_sec[i-1] = document.getElementById("MIDEXCOM_LECF"+i+"_sec").value;
      }
      for(var i=1;i<=document.getElementById("mexholac_sec").value;i++)
      {
        cmla_sec[i-1] = document.getElementById("MIDEXCOM_LABF"+i+"_sec").value;
      }
      for(var i=1;i<=document.getElementById("fexholec").value;i++)
      {
        cfle[i-1] = document.getElementById("FINEXCOM_LECF"+i).value;
      }
      for(var i=1;i<=document.getElementById("fexholac").value;i++)
      {
        cfla[i-1] = document.getElementById("FINEXCOM_LABF"+i).value;
      }

      commidlec = cmle;
      commidlab = cmla;
      commidlec_sec = cmle_sec;
      commidlab_sec = cmla_sec;
      comfinlec = cfle;
      comfinlab = cfla;

      //pack SECTION
      var sectionobj = {};
      var section = [];
      for(var i=1;i<=document.getElementById("SECTION").value;i++)
      {
        section[i-1] = document.getElementById('ENROLL'+i).value;
      }
      sectionobj = section;




      var data = {
        'COURSE_ID': document.getElementById("COURSE_ID").value,
        'SECTION' : document.getElementById("SECTION").value,
        'NORORSPE' : document.querySelector("input[name='NORORSPE']:checked").value,
        'NAMETH' : document.getElementById("NAME_TH_COURSE").value,
        'NAMEENG' : document.getElementById("NAME_ENG_COURSE").value,
        'STUDENT' : sectionobj,
        'CREDIT' : {
          'TOTAL' : document.getElementById("TOTAL").value
        },
        'TYPE_TEACHING' : document.querySelector("input[name='TYPE_TEACHING']:checked").value,
        'TYPE_TEACHING_NAME' : document.getElementById('TYPE_TEACHING_NAME').value,
        'TEACHER' : teacher_lec,
        'EXAM': {
          'MID1' : {
            'HOUR' : {
              'LEC' : document.getElementById("MIDEXAM_HOUR_LEC").value,
              'LAB' : document.getElementById("MIDEXAM_HOUR_LAB").value
            },
            'NUMBER' : {
              'LEC' : document.getElementById("mexholec").value,
              'LAB' : document.getElementById("mexholac").value
            },
            'COMMITTEE' : {
              'LEC' : commidlec,
              'LAB' : commidlab
            }
          },
          'MID2' : {
            'HOUR' : {
              'LEC' : document.getElementById("MIDEXAM_HOUR_LEC_SEC").value,
              'LAB' : document.getElementById("MIDEXAM_HOUR_LAB_SEC").value
            },
            'NUMBER' : {
              'LEC' : document.getElementById("mexholec_sec").value,
              'LAB' : document.getElementById("mexholac_sec").value
            },
            'COMMITTEE' : {
              'LEC' : commidlec_sec,
              'LAB' : commidlab_sec
            }
          },
          'FINAL' : {
            'HOUR' : {
              'LEC' : document.getElementById("FINEXAM_HOUR_LEC").value,
              'LAB' : document.getElementById("FINEXAM_HOUR_LAB").value
            },
            'NUMBER' : {
              'LEC' : document.getElementById("fexholec").value,
              'LAB' : document.getElementById("fexholac").value
            },
            'COMMITTEE' : {
              'LEC' : comfinlec,
              'LAB' : comfinlab
            }
          },
          'SUGGESTION' : document.getElementById("suggestion").value
        },
        'MEASURE' : {
          'MID1' : {
            'LEC' : document.getElementById("MEASURE_MIDLEC1").value,
            'LAB' : document.getElementById("MEASURE_MIDLAB1").value
          },
          'MID2' : {
            'LEC' : document.getElementById("MEASURE_MIDLEC2").value,
            'LAB' : document.getElementById("MEASURE_MIDLAB2").value
          },
          'FINAL' : {
            'LEC' : document.getElementById("MEASURE_FINLEC").value,
            'LAB' : document.getElementById("MEASURE_FINLAB").value
          },
          'WORK' : {
            'LEC' : document.getElementById("MEASURE_WORKLEC").value,
            'LAB' : document.getElementById("MEASURE_WORKLAB").value
          },
          'OTHER' : {
            'LEC' : document.getElementById("MEASURE_OTHLEC").value,
            'LAB' : document.getElementById("MEASURE_OTHLAB").value,
            'OTH' : document.getElementById("OTHER_MEA").value
          },
          'TOTAL' : {
            'LEC' : document.getElementById("MEASURE_TOTALLEC").value,
            'LAB' : document.getElementById("MEASURE_TOTALLAB").value
          }
        },
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
        'SUBMIT_TYPE' : casesubmit,
        'USERID' : '<?php echo $_SESSION['id']; ?>',
        'DATE' : '<?php echo date('d'); ?>',
        'MONTH' : '<?php echo date('m'); ?>',
        'YEAR' : '<?php echo date('Y')+543; ?>'
      };

    senddata(JSON.stringify(data),getfile('1'));
  }
  else if(casesubmit=='0')
  {
    var data = {
      'COURSE_ID' : document.getElementById('COURSE_ID_2'),
      'SUBMIT_TYPE' : casesubmit
    };
    senddata(JSON.stringify(data),getfile('0'));
  }

}
function senddata(data,file_data)
{
  //prompt("data", data);
   file_data.append("DATA",data);
   var URL = '../../application/pdf/generate_evaluate.php';
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

                   if(temp["status"]=='success')
                   {
                     swal({
                       title: 'สำเร็จ',
                       text: temp["msg"],
                       type: 'success',
                       showCancelButton: false,
                       confirmButtonColor: '#3085d6',
                       cancelButtonColor: '#d33',
                       timer: 2000,
                       confirmButtonText: 'Ok'
                     }).then(function () {
                       window.location.reload();
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

function getfile(typedl)
{
  if(typedl=='1')
  {
    var file_data = $('#syllabus').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    return form_data;
  }
  else {
    var file_data = $('#syllabus_2').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    return form_data;
  }

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

  //deadline
  <?php
    (int)$flagcor = 0;
    (int)$flageva = 0;
    $dd = date('d');
    $mm = date('m');
    $yy = date('Y');
    $yy = $yy;
    $today = $yy.'-'.$mm.'-'.$dd;

    $count = sizeof($dlcor);
    for ($x=0; $x < $count ; $x++) {
      $deadlinestartcor = $dlcor[$x]['open_date'];
      $deadlineendcor = $dlcor[$x]['last_date'];
      (int)$checksemcor =  $dlcor[$x]['semester_num'];
      (int)$checkyearcor =  $dlcor[$x]['year'];
      (int)$cursem =  $current['semester'];
      (int)$curyear =  $current['year'];

      if($checksemcor==$cursem && $checkyearcor==$curyear)
      {
          if($deadlinestartcor<=$today && $today<=$deadlineendcor)
          {
            $flagcor = $flagcor + 1;

          }
       }
    }

    $count2 = sizeof($dleva);
    for ($y=0; $y < $count2; $y++) {
      $deadlinestarteva = $dleva[$y]['open_date'];
      $deadlineendeva = $dleva[$y]['last_date'];
      (int)$checksemeva =  $dleva[$y]['semester_num'];
      (int)$checkyeareva =  $dleva[$y]['year'];
      (int)$cursem =  $current['semester'];
      (int)$curyear =  $current['year'];

      if($checksemeva==$cursem && $checkyeareva==$curyear)
      {
        if($deadlinestarteva<=$today && $today<=$deadlineendeva)
        {
          $flageva = $flageva + 1;
        }
      }
    }


    if($flageva>0 && $flagcor==0)
    { echo " $('#overtimemsg').hide();
      $('#bottomform').hide();
      $('#overtimemsg5').hide();
      $('#listcor').hide();
      $('#syllabus').prop('required', true);
      $('#syllabus_2').prop('required', false);
      $('#COURSE_ID_2').prop('required', false);";
    }else if ($flageva==0 && $flagcor>0) {
      echo "$('#overtimemsg3').hide();
      $('#overtimemsg5').hide();
      $('#dlhide').hide();
      $('#formheader').hide();
      $('#syllabus').prop('required', false);
      $('#syllabus_2').prop('required', true);
      $('#COURSE_ID_2').prop('required', true);";
    }else if ($flageva>0 && $flagcor>0) {
      echo "$('#overtimemsg').hide();
      $('#overtimemsg3').hide();
      $('#bottomform').hide();
      $('#overtimemsg5').hide();
      $('#syllabus').prop('required', true);
      $('#syllabus_2').prop('required', false);
      $('#COURSE_ID_2').prop('required', false);";
    }else if ($flageva==0 && $flagcor==0) {
      echo "$('#overtimemsg').hide();
      $('#overtimemsg3').hide();
      $('#dlhide').hide();
      $('#formheader').hide();
      $('#bottomform').hide();
      $('#syllabus').prop('required', false);
      $('#syllabus_2').prop('required', false);
      $('#COURSE_ID_2').prop('required', false);";
    }

   ?>


  //radio
    $("input[name='CALCULATE']").change(function(){
      if($(this).val()=="GROUP")
      {
        $('.atof').val("");
        $('.stou').val("");
        $('.atof').prop('disabled',true);
        $('.stou').prop('disabled',true);
        $('.atof').prop('required',false);
        $('.stou').prop('required',false);
        $('#EXPLAINATION').prop('disabled', false);
        $('#EXPLAINATION').prop('required', true);
        $('#EXPLAINATION').val("");
        $('#CALOTHER').prop('disabled', true);
        $('#CALOTHER').val("");
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
        $('.atof').prop('disabled',false);
        $('.atof').prop('required',true);
        $('.stou').val("");
        $('.stou').prop('required',false);
        $('.stou').prop('disabled',true);
        $('#EXPLAINATION').val("");
        $('#CALOTHER').prop('disabled', false);
        $('#CALOTHER').val("");
      }
      else {
        $('.atof').val("");
        $('.stou').val("");
        $('.atof').prop('disabled',true);
        $('.atof').prop('required',false);
        $('.stou').prop('required',true);
        $('.stou').prop('disabled',false);
        $('#CALOTHER').prop('disabled', true);
        $('#EXPLAINATION').val("");
        $('#CALOTHER').val("");
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

    $("#EXPLAINATION").prop('disabled',true);
    $("input[name='CALCULATE']").change(function(){
      if($(this).val()=="GROUP")
      {
          $("#EXPLAINATION").prop('required',true);
          $("#EXPLAINATION").prop('disabled',false);
          $("#explain").show();
      }
      else
      {
        $("#EXPLAINATION").prop('required',false);
        $("#EXPLAINATION").prop('disabled',true);
        $("#explain").hide();
      }

      });

  $('#calmea').click(function() {
    if($("#MEASURE_MIDLEC1").val()!=null && $("#MEASURE_MIDLEC1").val()!="")
    {
      var templec1 = parseFloat($('#MEASURE_MIDLEC1').val());
    }
    else {
      var templec1 = parseFloat('0');
    }

    if($("#MEASURE_MIDLEC2").val()!=null && $("#MEASURE_MIDLEC2").val()!="")
    {
      var templec2 = parseFloat($('#MEASURE_MIDLEC2').val());
    }
    else {
      var templec2 = parseFloat('0');
    }

    if($("#MEASURE_MIDLAB1").val()!=null && $("#MEASURE_MIDLAB1").val()!="")
    {
      var templab1 = parseFloat($('#MEASURE_MIDLAB1').val());
    }
    else {
      var templab1 = parseFloat('0');
    }

    if($("#MEASURE_MIDLAB2").val()!=null && $("#MEASURE_MIDLAB2").val()!="")
    {
      var templab2 = parseFloat($('#MEASURE_MIDLAB2').val());
    }
    else {
      var templab2 = parseFloat('0');
    }

    if($("#MEASURE_FINLEC").val()!=null && $("#MEASURE_FINLEC").val()!="")
    {
      var tempfinlec = parseFloat($('#MEASURE_FINLEC').val());
    }
    else {
      var tempfinlec = parseFloat('0');
    }

    if($("#MEASURE_FINLAB").val()!=null && $("#MEASURE_FINLAB").val()!="")
    {
      var tempfinlab = parseFloat($('#MEASURE_FINLAB').val());
    }
    else {
      var tempfinlab = parseFloat('0');
    }

    if($("#MEASURE_WORKLEC").val()!=null && $("#MEASURE_WORKLEC").val()!="")
    {
      var worklec = parseFloat($('#MEASURE_WORKLEC').val());
    }
    else {
      var worklec = parseFloat('0');
    }

    if($("#MEASURE_WORKLAB").val()!=null && $("#MEASURE_WORKLAB").val()!="")
    {
      var worklab = parseFloat($('#MEASURE_WORKLAB').val());
    }
    else {
      var worklab = parseFloat('0');
    }

    if($("#MEASURE_OTHLEC").val()!=null && $("#MEASURE_OTHLEC").val()!="")
    {
      var othlec = parseFloat($('#MEASURE_OTHLEC').val());
    }
    else {
      var othlec = parseFloat('0');
    }

    if($("#MEASURE_OTHLAB").val()!=null && $("#MEASURE_OTHLAB").val()!="")
    {
      var othlab = parseFloat($('#MEASURE_OTHLAB').val());
    }
    else {
      var othlab = parseFloat('0');
    }

    var totallec = parseFloat($('#MEASURE_TOTALLEC').val());
    var totallab = parseFloat($('#MEASURE_TOTALLAB').val());
    var callec = templec1 + templec2 + tempfinlec + worklec + othlec;
    var callab = templab1 + templab2 + tempfinlab + worklab + othlab;

    var summea = callec + callab;
    if(summea!=100)
    {
      swal(
        '',
        'คะแนนรวมของภาคบรรยายและภาคปฏิบัติต้องรวมกันได้ร้อยละ 100\nกรุณาตรวจสอบสัดส่วนการให้คะแนนใหม่อีกครั้ง',
        'error'
      )
      //alert('กรุณาตรวจสอบสัดส่วนการให้คะแนนใหม่อีกครั้ง\nคะแนนรวมของภาคบรรยายและภาคปฏิบัติต้องรวมกันได้ร้อยละ 100');
    }
    else {
      $('#MEASURE_TOTALLEC').val(callec);
      $('#MEASURE_TOTALLAB').val(callab);
    }
  });

  //submit
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

    $( '#form2' ).submit( function( event ) {
      event.preventDefault();

      var fail = false;
      var fail_log = '';
      $( '#form2' ).find( 'select, textarea,input' ).each(function(){
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
        checkreq2('0');
      } else {
        swal(
          '',
          'กรุณากรอกข้อมูลให้ครบถ้วน',
          'error'
        )
        return false;
      }

      });


  File: {
    required: true
}




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
  if(casesubmit=='1'||casesubmit=='2')
  {
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
  else {
    submitfunc(casesubmit);
  }

}

function checkreq2(casesubmit) {
  if($("#COURSE_ID_2").val()!=null && $("[COURSE_ID_2]").val()!="" && $("#syllabus_2").val()!=null && $("[syllabus_2]").val()!="")
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
    swal(
      '',
      'กรุณากรอกข้อมูลให้ครบถ้วน',
      'error'
    )
    //alert('กรุณากรอกข้อมูลให้ครบถ้วน');
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
      if(casereset=='1')
      {
        document.getElementById("formheader").reset();
        document.getElementById("form1").reset();
      }else {
        document.getElementById("formheader").reset();
        document.getElementById("form2").reset();
      }

      document.getElementById('formdrpd').style.display = "none";
      var selectobject = document.getElementById('semester');
      var long = selectobject.length;
      if(long!=0 && long!=null)
      {
        for (var i=0; i<=long; i++){
          document.getElementsByName("semester")[0].remove(0);
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
    <h3 class="page-header">แบบแจ้งวิธีการวัดผลและประเมินผลการศึกษา คณะเภสัชศาสตร์</h3>
    <div id="overtimemsg" class="alert alert-danger"><div class="glyphicon glyphicon-alert" style="color: red;font-size:18px;" ><b> สิ้นสุดเวลาในการกรอกแบบแจ้งวิธีการวัดผลและประเมินผลการศึกษา !</b></div><b style="color: red;font-size:16px;"> <p id="overtimemsg2"></p></b> </div>
    <div id="overtimemsg3" class="alert alert-danger"><div class="glyphicon glyphicon-alert" style="color: red;font-size:18px;" ><b> สิ้นสุดเวลาในการอัพโหลดไฟล์ Course Syllabus !</b></div><b style="color: red;font-size:16px;"> <p id="overtimemsg4"></p></b> </div>
    <div id="overtimemsg5" class="alert alert-danger"><div class="glyphicon glyphicon-alert" style="color: red;font-size:18px;" ><b> สิ้นสุดเวลาในการกรอกแบบแจ้งวิธีการวัดผลและประเมินผลการศึกษาและอัพโหลดไฟล์ Course Syllabus !</b></div><b style="color: red;font-size:16px;"> <p id="overtimemsg6"></p></b> </div>
    <form id="formheader" data-toggle="validator" role="form">
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
        <select class="form-control required" id="semester" name="semester" style="width: 300px;" required >
        </select>
       </div>
       <input type="button" class="btn btn-outline btn-primary" name="subhead" id="subhead" value="ยืนยัน" onclick="checksubject(2,1);">
     </div>
   </div>
       </form>


  </center>
</div>

<div id="dlhide" class="panel panel-default">
<form data-toggle="validator" role="form" name="form1" id="form1" method="post" >
    <ol>
      <br>
      <li style="font-size: 14px">
        <div class="form-inline">
          <div class="form-group">
          <b>รหัสกระบวนวิชา</b> &nbsp;<input style="width: 100px;" type="text" class="form-control numonly" name="COURSE_ID" id="COURSE_ID"   maxlength="6" required pattern=".{6,6}" >
          </div>
          <div class="form-group">
            &nbsp;จำนวนตอน (ทั้งหมด) &nbsp;
            <select class="form-control required" id="SECTION" name="SECTION" style="width: 70px;" required onchange="section_box()" >
              <option value="1" selected>1</option>
            <?php
            for($i=2;$i<=5;$i++)
            {
              echo '<option value="'.$i.'">'.$i.'</option>';
            }
             ?>
            </select>
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
            </div></div>
          </div>
          <div class="form-group"><div class="form-inline" id="secdiv1">นักศึกษาที่ลงทะเบียนเรียนในตอนที่ 1 จำนวน&nbsp;<input style="width: 70px;" type="text" class="form-control numonly" name="ENROLL1" id="ENROLL1" size="2" maxlength="3" pattern=".{1,3}" required>&nbsp;คน </div>
            <?php
                for ($i=2; $i<=5 ; $i++) {
                  echo '<div class="form-inline hide" style="display:none;" id="secdiv'.$i.'">นักศึกษาที่ลงทะเบียนเรียนในตอนที่ '.$i.' จำนวน&nbsp;<input style="width: 70px; display: none;" type="text" class="form-control numonly" name="ENROLL'.$i.'" id="ENROLL'.$i.'" size="2" maxlength="3" pattern=".{1,3}">&nbsp;คน </div>';
                }
             ?>
           </div>


      </li>
      <br>
      <li style="font-size: 14px">
        <div class="form-inline">
          <b>ลักษณะการเรียนการสอน&nbsp;&nbsp;</b><br>
          <div class="form-group"><div class="radio">
            <input type="radio" name="TYPE_TEACHING" id="TYPE_TEACHING1" value="LEC" required checked> บรรยาย &nbsp;<br>
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
      <li style="font-size: 14px">
        <div class="form-inline">
          <div id="text"><b>อาจารย์ผู้รับผิดชอบกระบวนวิชา</b>
          </div>
        </div>

        <div class="form-inline" id="ctlec1">
          <label id="li1">1. &nbsp;</label>
          <input type="text" class="form-control charonly" name="TEACHERLEC_F1" id="TEACHERLEC_F1" list="dtl1" placeholder="ชื่อ-นามสกุล" size="35" onkeydown="searchname(1,'subject');" >
          <datalist id="dtl1">
          </datalist>
        </div>

        <div class="form-inline" id="ctlec2">
          <label id="li2">2. &nbsp;</label>
          <input type="text" class="form-control charonly" name="TEACHERLEC_F2" id="TEACHERLEC_F2" list="dtl2" placeholder="ชื่อ-นามสกุล" size="35" onkeydown="searchname(2,'subject');" >
          <datalist id="dtl2">
          </datalist>
        </div>

        <div class="form-inline" id="ctlec3">
          <label id="li3">3. &nbsp;</label>
          <input type="text" class="form-control charonly" name="TEACHERLEC_F3" id="TEACHERLEC_F3" list="dtl3" placeholder="ชื่อ-นามสกุล" size="35" onkeydown="searchname(3,'subject');" >
          <datalist id="dtl3">
          </datalist>
        </div>
        <div class="form-inline" id="ctlec4">
          <label id="li4">4. &nbsp;</label>
          <input type="text" class="form-control charonly" name="TEACHERLEC_F4" id="TEACHERLEC_F4" list="dtl4" placeholder="ชื่อ-นามสกุล" size="35" onkeydown="searchname(4,'subject');" >
          <datalist id="dtl4">
          </datalist>
        </div>
        <div class="form-inline" id="ctlec5">
          <label id="li5">5. &nbsp;</label>
          <input type="text" class="form-control charonly" name="TEACHERLEC_F5" id="TEACHERLEC_F5" list="dtl5" placeholder="ชื่อ-นามสกุล" size="35" onkeydown="searchname(5,'subject');" >
          <datalist id="dtl5">
          </datalist>
        </div>
      </li>


        <br>

          <li style="font-size: 14px;">
            <b>การวัดผลการศึกษา</b> (สัดส่วนการให้คะแนนโปรดระบุเป็นร้อยละ)<br>
            <div class="row">
            <div class="col-md-10">
            <table id="meastable" class="table table-bordered table-hover" style="font-size: 14px;">
              <tr class="success">
                <th width="67%" colspan="2"> </th>
                <th style="text-align: center;">ภาคทฤษฏี</th>
                <th style="text-align: center;">ภาคปฏิบัติ </th>
              </tr>
              <tr>
                <td colspan="2">1. สอบกลางภาคฯครั้งที่ 1</td>
                <td><div class="form-group"><input type="text" class="form-control numonly" name="MEASURE_MIDLEC1" id="MEASURE_MIDLEC1" size="10" value="0"></div></td>
                <td><div class="form-group"><input type="text" class="form-control numonly" name="MEASURE_MIDLAB1" id="MEASURE_MIDLAB1" size="10" value="0"></div></td>
              </tr>
              <tr>
                <td colspan="2">2. สอบกลางภาคฯครั้งที่ 2</td>
                <td><div class="form-group"><input type="text" class="form-control numonly" name="MEASURE_MIDLEC2" id="MEASURE_MIDLEC2" size="10" value="0"></div></td>
                <td><div class="form-group"><input type="text" class="form-control numonly" name="MEASURE_MIDLAB2" id="MEASURE_MIDLAB2" size="10" value="0"></div></td>
              </tr>
              <tr>
                <td colspan="2">3. สอบไล่ </td>
                <td><div class="form-group"><input type="text" class="form-control numonly" name="MEASURE_FINLEC" id="MEASURE_FINLEC" size="10" value="0"></div></td>
                <td><div class="form-group"><input type="text" class="form-control numonly" name="MEASURE_FINLAB" id="MEASURE_FINLAB" size="10" value="0"></div></td>
              </tr>
              <tr>
                <td colspan="2">4. งานมอบหมาย </td>
                <td><div class="form-group"><input type="text" class="form-control numonly" name="MEASURE_WORKLEC" id="MEASURE_WORKLEC" size="10" value="0"></div></td>
                <td><div class="form-group"><input type="text" class="form-control numonly" name="MEASURE_WORKLAB" id="MEASURE_WORKLAB" size="10" value="0"></div></td>
              </tr>
              <tr name="addtr">

                <td colspan="2"><div class="form-group form-inline">5. อื่นๆ โปรดระบุ &nbsp;&nbsp;<input type="text" class="form-control" name="OTHER_MEA" id="OTHER_MEA" size="30"></div></td>
                <td><div class="form-group"><input type="text" class="form-control numonly" name="MEASURE_OTHLEC" id="MEASURE_OTHLEC" size="10" value="0"></div></td>
                <td><div class="form-group"><input type="text" class="form-control numonly" name="MEASURE_OTHLAB" id="MEASURE_OTHLAB" size="10" value="0"></div></td>
              </tr>
              <tr>
                <td colspan="2" align="right"><input type="button" class="btn btn-outline btn-warning" name="calmea" id="calmea" value="รวมคะแนน"></td>
                <td><div class="form-group"><input type="text" class="form-control numonly" name="MEASURE_TOTALLEC" id="MEASURE_TOTALLEC" size="10" value="0"></div></td>
                <td><div class="form-group"><input type="text" class="form-control numonly" name="MEASURE_TOTALLAB" id="MEASURE_TOTALLAB" size="10" value="0"></div></td>
              </tr>
            </table>
            </div>
          </div>
          </li>

          <li style="font-size: 14px">
            <div class="form-inline"><b> การสอบ โปรดระบุให้ชัดเจน และครบถ้วน เพื่อใช้เป็นข้อมูลการจัดตารางสอบ </b>(กรุณาระบุชื่ออาจารย์ที่ร่วมสอนในกระบวนวิชา และจำนวนกรรมการคุมสอบอาจระบุอย่างน้อย 3 คน) </div>

            <ul>
              <br>
              <li style="font-size: 14px">

                <b>สอบกลางภาคฯครั้งที่ 1</b>
                <ul>
                  <div class="form-inline">
                    <li style="font-size: 14px">
                      <div class="form-group">
                      จำนวนชั่วโมงการสอบ<b>บรรยาย</b>&nbsp;:&nbsp;<input type="text" style="width: 70px" class="form-control numonly" name="MIDEXAM_HOUR_LEC" id="MIDEXAM_HOUR_LEC" size="2" maxlength="3" >&nbsp; ชั่วโมง
                    </div>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวนกรรมการคุมสอบ&nbsp;
                      <select style="height: 28px;" name="mexholec" id="mexholec" class="form-control numonly" onchange="midexam_hour_lec()">
          <option value="0" selected>0</option>
          <?php
            for($i=1;$i<=10;$i++)
            {
              echo '<option value="'.$i.'">'.$i.'</option>';
            }
            ?>

        </select> &nbsp; คน

        <?php
            for ($i=1; $i<=10 ; $i++) {
              echo '<div class="form-inline hide" id="mehlec'.$i.'">
                <label id="mehle'.$i.'" style="display:none;">'.$i.'.&nbsp; </label>
                <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECF'.$i.'" id="MIDEXCOM_LECF'.$i.'" placeholder="ชื่อ" size="35" list="dtmeh'.$i.'" onkeydown="searchname('.$i.',511);">
                <datalist id="dtmeh'.$i.'">
                </datalist>
              </div>';
            }
         ?>

                      <div class="form-inline">
                        <li style="font-size: 14px">
                          <div class="form-group">
                          จำนวนชั่วโมงการสอบ<b>ปฏิบัติการ</b>&nbsp;:&nbsp;<input type="text" class="form-control numonly" name="MIDEXAM_HOUR_LAB" id="MIDEXAM_HOUR_LAB" size="2" >&nbsp; ชั่วโมง
                        </div>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวนกรรมการคุมสอบ&nbsp;
                          <select style="height: 28px;" name="mexholac" id="mexholac" class="form-control numonly" onchange="midexam_hour_lab()">
          <option value="0" selected>0</option>
          <?php
            for($i=1;$i<=10;$i++)
            {
              echo '<option value="'.$i.'">'.$i.'</option>';
            }
            ?>

         </select> &nbsp; คน

         <?php
             for ($i=1; $i<=10 ; $i++) {
               echo '<div class="form-inline hide" id="ehlab'.$i.'">
                 <label id="ehla'.$i.'" style="display:none;">'.$i.'.&nbsp; </label>
                 <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABF'.$i.'" id="MIDEXCOM_LABF'.$i.'" placeholder="ชื่อ" size="35" list="dtehlab'.$i.'" onkeydown="searchname('.$i.',512);">
                 <datalist id="dtehlab'.$i.'">
                 </datalist>
               </div>';
             }
          ?>

                        </li>
                      </div>
                </ul>
                </li>
              </li>

              <li style="font-size: 14px">

                <b>สอบกลางภาคฯครั้งที่ 2</b>
                <ul>
                  <div class="form-inline">
                    <li style="font-size: 14px">
                      <div class="form-group">
                      จำนวนชั่วโมงการสอบ<b>บรรยาย</b>&nbsp;:&nbsp;<input type="text" style="width: 70px" class="form-control numonly" name="MIDEXAM_HOUR_LEC_SEC" id="MIDEXAM_HOUR_LEC_SEC" size="2" maxlength="3" >&nbsp; ชั่วโมง
                    </div>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวนกรรมการคุมสอบ&nbsp;
                      <select style="height: 28px;" name="mexholec_sec" id="mexholec_sec" class="form-control numonly" onchange="midexam_hour_lec_sec()">
          <option value="0" selected>0</option>
          <?php
            for($i=1;$i<=10;$i++)
            {
              echo '<option value="'.$i.'">'.$i.'</option>';
            }
            ?>

        </select> &nbsp; คน

        <?php
            for ($i=1; $i<=10 ; $i++) {
              echo '<div class="form-inline hide" id="mehlec'.$i.'_sec">
                <label id="mehle'.$i.'_sec" style="display:none;">'.$i.'.&nbsp; </label>
                <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECF'.$i.'_sec" id="MIDEXCOM_LECF'.$i.'_sec" placeholder="ชื่อ" size="35" list="dtmehle'.$i.'_sec" onkeydown="searchname('.$i.',521);">
                <datalist id="dtmehle'.$i.'_sec">
                </datalist>
              </div>';
            }
         ?>

                      <div class="form-inline">
                        <li style="font-size: 14px">
                          <div class="form-group">
                          จำนวนชั่วโมงการสอบ<b>ปฏิบัติการ</b>&nbsp;:&nbsp;<input type="text" class="form-control numonly" name="MIDEXAM_HOUR_LAB_SEC" id="MIDEXAM_HOUR_LAB_SEC" size="2" >&nbsp; ชั่วโมง
                        </div>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวนกรรมการคุมสอบ&nbsp;
                          <select style="height: 28px;" name="mexholac_sec" id="mexholac_sec" class="form-control numonly" onchange="midexam_hour_lab_sec()">
          <option value="0" selected>0</option>
          <?php
            for($i=1;$i<=10;$i++)
            {
              echo '<option value="'.$i.'">'.$i.'</option>';
            }
            ?>

         </select> &nbsp; คน

         <?php
             for ($i=1; $i<=10 ; $i++) {
               echo '<div class="form-inline hide" id="ehlab'.$i.'_sec">
                 <label id="ehla'.$i.'_sec" style="display:none;">'.$i.'.&nbsp; </label>
                 <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABF'.$i.'_sec" id="MIDEXCOM_LABF'.$i.'_sec" placeholder="ชื่อ" size="35" list="dtehla'.$i.'_sec" onkeydown="searchname('.$i.',522);">
                 <datalist id="dtehla'.$i.'_sec">
                 </datalist>
               </div>';
             }
          ?>
                        </li>
                      </div>
                </ul>
                </li>
              </li>


                <!--0000000000000000000000000SPLIT000000000000000-->

                <li style="font-size: 14px">
                  <b>สอบไล่</b>
                  <ul>
                    <div class="form-inline">
                      <li style="font-size: 14px">
                        <div class="form-group">
                        จำนวนชั่วโมงการสอบ<b>บรรยาย</b>&nbsp;:&nbsp;<input  style="width: 70px"type="text" class="form-control numonly" name="FINEXAM_HOUR_LEC" id="FINEXAM_HOUR_LEC" size="2" maxlength="3" >&nbsp; ชั่วโมง
                        </div>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวนกรรมการคุมสอบ&nbsp;
                        <select style="height: 28px;" name="fexholec" id="fexholec" class="form-control numonly" onchange="finexam_hour_lec()">
          <option value="0" selected>0</option>
          <?php
            for($i=1;$i<=10;$i++)
            {
              echo '<option value="'.$i.'">'.$i.'</option>';
            }
            ?>

        </select> &nbsp; คน </div>

        <?php
            for ($i=1; $i<=10 ; $i++) {
              echo '<div class="form-inline hide" id="fmehlec'.$i.'">
                <label id="fmehle'.$i.'" style="display:none;">'.$i.'.&nbsp; </label>
                <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LECF'.$i.'" id="FINEXCOM_LECF'.$i.'" placeholder="ชื่อ" size="35" list="dtfmehle'.$i.'" onkeydown="searchname('.$i.',531);">
                <datalist id="dtfmehle'.$i.'">
                </datalist>
              </div>';
            }
         ?>


                        <div class="form-inline">
                          <li style="font-size: 14px">
                            <div class="form-group">
                            จำนวนชั่วโมงการสอบ<b>ปฏิบัติการ</b>&nbsp;:&nbsp;<input style="width: 70px" type="text" class="form-control numonly" name="FINEXAM_HOUR_LAB" id="FINEXAM_HOUR_LAB" size="2" maxlength="3" >&nbsp; ชั่วโมง
                          </div>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวนกรรมการคุมสอบ&nbsp;
                            <select style="height: 28px;" name="fexholac" id="fexholac" class="form-control numonly" onchange="finexam_hour_lab()">
          <option value="0" selected>0</option>
          <?php
            for($i=1;$i<=10;$i++)
            {
              echo '<option value="'.$i.'">'.$i.'</option>';
            }
            ?>

         </select> &nbsp; คน

         <?php
             for ($i=1; $i<=10 ; $i++) {
               echo '<div class="form-inline hide" id="fehlab'.$i.'">
                 <label id="fehla'.$i.'" style="display:none;">'.$i.'.&nbsp; </label>
                 <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LABF'.$i.'" id="FINEXCOM_LABF'.$i.'" placeholder="ชื่อ" size="35" list="dtfehla'.$i.'" onkeydown="searchname('.$i.',532);">
                 <datalist id="dtfehla'.$i.'">
                 </datalist>
               </div>';
             }
          ?>

                          </li>
                        </div>
                  </ul>
                  </li>
          </li>
          </ul>
          <div class="form-inline">
            หมายเหตุ
            <br> <textarea class="form-control" id="suggestion" rows="4" cols="125"></textarea>
          </div>
        </li>

          <br>
          <li style="font-size: 14px;">
            <b>วิธีการตัดเกรด</b>
            <br>
            <div class="form-inline">
              <div class="form-group form-inline"><div class="radio">
              <input type="radio" name="CALCULATE" id="CALCULATE_TYPE2" value="CRITERIA" checked> อิงเกณฑ์ &nbsp;&nbsp;ได้กำหนดเกณฑ์ดังต่อไปนี้
              <div style="margin-left:20px;">
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
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr align="center">
                  <td>C</td>
                  <td><input type="text" class="form-control numonly atof" name="CALCULATE_C_MIN" id="CALCULATE_C_MIN" maxlength="5" value="60.0"></td>
                  <td>ถึง</td>
                  <td><input type="text" class="form-control numonly atof" name="CALCULATE_C_MAX" id="CALCULATE_C_MAX" maxlength="5" value="64.9"></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </table>
            </div>
          </div>
          <div class="row" style="margin-left: 10px;">
            <b>อื่นๆ</b><br>
            <textarea class="form-control" name="CALOTHER" id="CALOTHER" rows="4" cols="125" ></textarea>
          </div>
        </div>
            <br>
              <input type="radio" name="CALCULATE" id="CALCULATE_TYPE1" value="GROUP" required> อิงกลุ่ม &nbsp;
              <div style="margin-left:35px;">
                <input type="text" class="form-control" name="EXPLAINATION" id="EXPLAINATION" placeholder="โปรดระบุ">
              </div>
              <br>
              <input type="radio" name="CALCULATE" id="CALCULATE_TYPE3" value="SU"> ให้อักษร S หรือ U
              <div style="margin-left:35px;">
              <div class="row">
              <div class="col-md-5">
              <table class="table table-hover" style="font-size: 14px; ">
                <tr align="center" style="text-align:center;">
                  <th>เกรด</th>
                  <th>คะแนนต่ำสุด</th>
                  <th></th>
                  <th>คะแนนสูงสุด</th>
                </tr>
                <tr align="center">
                  <td>S</td>
                  <td><input type="text" class="form-control numonly stou" name="CALCULATE_S_MIN" id="CALCULATE_S_MIN" maxlength="5" value=""></td>
                  <td>ถึง</td>
                  <td><input type="text" class="form-control numonly" name="CALCULATE_S_MAX" id="CALCULATE_S_MIN" placeholder="100" disabled></td>
                </tr>
                <tr align="center">
                  <td>U</td>
                  <td><input type="text" class="form-control numonly" name="CALCULATE_U_MAX" id="CALCULATE_U_MIN" placeholder="0" disabled></td>
                  <td>ถึง</td>
                  <td><input type="text" class="form-control numonly stou" name="CALCULATE_U_MAX" id="CALCULATE_U_MAX" maxlength="5" value=""></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div></div>
          </div>
          </li>
          <li style="font-size: 14px;">
            <b>นักศึกษาที่ขาดสอบในการวัดผลครั้งสุดท้าย</b> &nbsp;&nbsp;โดยไม่ได้รับอนุญาตให้เลื่อนการสอบตามข้อบังคับฯ ของมหาวิทยาลัยเชียงใหม่ ว่าด้วยการศึกษาชั้นปริญญาตรี อาจารย์ผู้สอนจะประเมินดังนี้
            <br>
            <div class="form-inline"><div class="form-group"><div class="radio">
            <input type="radio" name="ABSENT" id="ABSENT1" value="F" required checked>&nbsp;ให้ลำดับขั้น F &nbsp;&nbsp; <br>
            <input type="radio" name="ABSENT" id="ABSENT2" value="U" >&nbsp;ให้อักษร U &nbsp;&nbsp;<br>
            <input type="radio" name="ABSENT" id="ABSENT3" value="CAL" >&nbsp;นำคะแนนทั้งหมดที่นักศึกษาได้รับก่อนการสอบไล่มาประเมิน &nbsp;&nbsp;<br>
          </div></div></div>
          </li>

          <br>
          <li style="font-size: 14px;" id="listcor">
            <b>เลือกไฟล์ Course Syllabus (นามสกุลไฟล์ต้องเป็นไฟล์จากโปรแกรม Microsoft Word (.doc หรือ .docx) เท่านั้น) : </b><br />
          <div class="col-md-5 form-inline form-group">
            <input type="file" class="filestyle" id="syllabus" data-icon="false" accept=".doc,.docx" required><font color="red"><b> ** จำเป็น</b></font>
          </div>
          </li>



    </ol>
    <br><br>
    <div id="buttondiv" align="center">
      <input type="submit" style="font-size: 18px;" class="btn btn-outline btn-success" name="submitbtn" id="submitbtn"  value="ยืนยันเพื่อส่งข้อมูล" > &nbsp;
      <input type="button" style="font-size: 18px;" class="btn btn-outline btn-warning" name="draftbtn" id="draftbtn" value="บันทึกข้อมูลชั่วคราว" onclick="checkreq('2')"> &nbsp;
      <input type="button" style="font-size: 18px;" class="btn btn-outline btn-danger" name="resetbtn" id="resetbtn" onclick="confreset('1');" value="รีเซ็ตข้อมูล">
    </div>
</form>
</div>
</div>
</div>
  <div id="bottomform" class="panel panel-default">
    <br>
    <ol>
      <form data-toggle="validator" role="form" name="form2" id="form2">
      <li style="font-size: 14px;"><div class="form-inline form-group"><b>รหัสกระบวนวิชา : </b><input style="width: 100px;" type="text" class="form-control numonly" name="COURSE_ID_2" id="COURSE_ID_2"   maxlength="6" required pattern=".{6,6}" ></div></li>
      <li style="font-size: 14px;">
        <b>เลือกไฟล์ Course Syllabus (นามสกุลไฟล์ต้องเป็นไฟล์จากโปรแกรม Microsoft Word (.doc หรือ .docx) เท่านั้น) : </b><br />
        <div class="col-md-5 form-inline form-group">
          <input type="file" class="filestyle" id="syllabus_2" data-icon="false" accept=".doc,.docx" required><font color="red"><b> ** จำเป็น</b></font>
        </div>
      </li>
      <br><br>
      <div align="center">
        <input type="submit" style="font-size: 18px;" class="btn btn-outline btn-success" name="submitbtn2" id="submitbtn2" value="ยืนยันเพื่อส่งข้อมูล" > &nbsp;
        <input type="button" style="font-size: 18px;" class="btn btn-outline btn-danger" name="resetbtn2" id="resetbtn2" onclick="confreset('2');" value="รีเซ็ตข้อมูล">
      </div>
    </form>
    </ol>
  </div>
</body>
</html>

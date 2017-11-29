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

  <script src="../dist/js/sweetalert2.min.js"></script>

  <!-- polyfiller file to detect and load polyfills -->
  <script src="../vendor/webshim/1.15.3/js-webshim/minified/polyfiller.js"></script>
 <!-- Include a polyfill for ES6 Promises (optional) for IE11 and Android browser -->
 <script src="../vendor/webshim/1.15.3/core.js"></script>

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

  ol li {
      font-weight:bold;
  }
  li > * {
      font-weight:normal;
  }

  select{
    height:35px;
  }

  </style>

<script id="contentScript">

window.sumcheck = 0;

function downloadfunc(){
  var link = $('#spanfile').text();
  window.open("../../files/syllabus/"+link);
}

function downloadfunc2(){
  var link = $('#spanfile2').text();
  window.open("../../files/syllabus/"+link);
}
// searchname
function searchname(no,type) {

  if(type=='subject')
  {
      var name_s = $("#TEACHERLEC_F"+no).val();
      $("#dtl"+no).html('');
      if(name_s.length > 1)
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
    if(name_s.length > 1)
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
    if(name_s.length > 1)
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
    if(name_s.length > 1)
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
    if(name_s.length > 1)
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
    if(name_s.length > 1)
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
    if(name_s.length > 1)
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
  document.getElementById('SECTION').value = temp['num_section'];
  var choice1 = temp['noorspe'];
  $('input[name="NORORSPE"][value=' + choice1 + ']').prop('checked', true);

  for (var i = 0; i <temp['num_section']; i++) {
    document.getElementById("secdiv" + (i+1)).style.display = "";
    document.getElementById('secdiv' + (i+1)).classList.remove('hide');
    document.getElementById('ENROLL'+(i+1)).style.display = "";
    document.getElementById('ENROLL'+(i+1)).value = temp['student'][i];
  }

  //part2
  var choice2 = temp['type'];
  $('input[name="TYPE_TEACHING"][value=' + choice2 + ']').prop('checked', true);
  if($('input[name="TYPE_TEACHING"]:checked').val()=="OTH")
  {
    $("#TYPE_TEACHING_NAME").val(temp['type_other']);
    $("#TYPE_TEACHING_NAME").prop('required',true);
    $("#TYPE_TEACHING_NAME").show();
  }

  //part3
  for(var i=0;i<=4;i++)
  {
    if(temp['teacher'][i]!="" && temp['teacher'][i]!=undefined)
    {
      document.getElementById('TEACHERLEC_F'+(i+1)).value = temp['teacher'][i];
    }else {
      document.getElementById('TEACHERLEC_F'+(i+1)).value = "";
    }
  }
  if(temp['teacher_co']!="" && temp['teacher_co']!=undefined)
  {
    document.getElementById('tchco').value = temp['teacher_co'];
  }else {
    document.getElementById('tchco').value = "";
  }

  //part4
  document.getElementById('MEASURE_MIDLEC1').value = temp['mid1_lec'];
  document.getElementById('MEASURE_MIDLAB1').value = temp['mid1_lab'];
  document.getElementById('MEASURE_MIDLEC2').value = temp['mid2_lec'];
  document.getElementById('MEASURE_MIDLAB2').value = temp['mid2_lab'];
  document.getElementById('MEASURE_FINLEC').value = temp['final_lec'];
  document.getElementById('MEASURE_FINLAB').value = temp['final_lab'];
  document.getElementById('MEASURE_WORKLEC').value = temp['work_lec'];
  document.getElementById('MEASURE_WORKLAB').value = temp['work_lab'];
  document.getElementById('OTHER_MEA').value = temp['other_oth'];
  document.getElementById('MEASURE_OTHLEC').value = temp['other_lec'];
  document.getElementById('MEASURE_OTHLAB').value = temp['other_lab'];
  document.getElementById('MEASURE_TOTALLEC').value = temp['total_lec'];
  document.getElementById('MEASURE_TOTALLAB').value = temp['total_lab'];
  document.getElementById('psmeasure').value = temp['msg'];


  //part5
  document.getElementById('MIDEXAM_HOUR_LEC').value = temp['mid1_hour_lec'];
  document.getElementById('MIDEXAM_HOUR_LAB').value = temp['mid1_hour_lab'];
  document.getElementById('MIDEXAM_HOUR_LEC_SEC').value = temp['mid2_hour_lec'];
  document.getElementById('MIDEXAM_HOUR_LAB_SEC').value = temp['mid2_hour_lab'];
  document.getElementById('FINEXAM_HOUR_LEC').value = temp['final_hour_lec'];
  document.getElementById('FINEXAM_HOUR_LAB').value = temp['final_hour_lab'];
  document.getElementById('mexholec').value = temp['mid1_number_lec'];
  document.getElementById('mexholac').value = temp['mid1_number_lab'];
  document.getElementById('mexholec_sec').value = temp['mid2_number_lec'];
  document.getElementById('mexholac_sec').value = temp['mid2_number_lab'];
  document.getElementById('fexholec').value = temp['final_number_lec'];
  document.getElementById('fexholac').value = temp['final_number_lab'];
  document.getElementById('suggestion').value = temp['suggestion'];

  for(var i=0;i<temp['mid1_number_lec'];i++)
  {
    document.getElementById("mehle" + (i+1)).style.display = "";
    document.getElementById('mehlec' + (i+1)).classList.remove('hide');
    document.getElementById('MIDEXCOM_LECF'+(i+1)).style.display = "";
    if(temp['exam_mid1_committee_lec'].length!=0)
    {
      if(temp['exam_mid1_committee_lec'][i]=="" || temp['exam_mid1_committee_lec'][i]==undefined)
        document.getElementById('MIDEXCOM_LECF'+(i+1)).value = "";
      else
        document.getElementById('MIDEXCOM_LECF'+(i+1)).value = temp['exam_mid1_committee_lec'][i];
    }
  }
  for(var i=0;i<temp['mid1_number_lab'];i++)
  {
    document.getElementById("ehla" + (i+1)).style.display = "";
    document.getElementById('ehlab' + (i+1)).classList.remove('hide');
    document.getElementById('MIDEXCOM_LABF' + (i+1)).style.display = "";
    if(temp['exam_mid1_committee_lab'].length!=0)
    {
      if(temp['exam_mid1_committee_lab'][i]=="" || temp['exam_mid1_committee_lab'][i]==undefined)
        document.getElementById('MIDEXCOM_LABF'+(i+1)).value = "";
      else
        document.getElementById('MIDEXCOM_LABF'+(i+1)).value = temp['exam_mid1_committee_lab'][i];
    }

  }
  for(var i=0;i<temp['mid2_number_lec'];i++)
  {
    document.getElementById("mehle" + (i+1) +"_sec").style.display = "";
    document.getElementById('mehlec' + (i+1) +"_sec").classList.remove('hide');
    document.getElementById('MIDEXCOM_LECF' + (i+1) +"_sec").style.display = "";
    if(temp['exam_mid2_committee_lec'].length!=0)
    {
      if(temp['exam_mid2_committee_lec'][i]=="" || temp['exam_mid2_committee_lec'][i]==undefined)
        document.getElementById('MIDEXCOM_LECF'+(i+1)+'_sec').value = "";
      else
        document.getElementById('MIDEXCOM_LECF'+(i+1)+'_sec').value = temp['exam_mid2_committee_lec'][i];
    }

  }
  for(var i=0;i<temp['mid2_number_lab'];i++)
  {
    document.getElementById("ehla" + (i+1) +"_sec").style.display = "";
    document.getElementById('ehlab' + (i+1) +"_sec").classList.remove('hide');
    document.getElementById('MIDEXCOM_LABF' + (i+1) +"_sec").style.display = "";
    if(temp['exam_mid2_committee_lab'].length!=0)
    {
      if(temp['exam_mid2_committee_lab'][i]=="" || temp['exam_mid2_committee_lab'][i]==undefined)
        document.getElementById('MIDEXCOM_LABF'+(i+1)+'_sec').value = "";
      else
        document.getElementById('MIDEXCOM_LABF'+(i+1)+'_sec').value = temp['exam_mid2_committee_lab'][i];
    }

  }
  for(var i=0;i<temp['final_number_lec'];i++)
  {
    document.getElementById("fmehle" + (i+1)).style.display = "";
    document.getElementById('fmehlec' + (i+1)).classList.remove('hide');
    document.getElementById('FINEXCOM_LECF' + (i+1)).style.display = "";
    if(temp['exam_final_committee_lec'].length!=0)
    {
      if(temp['exam_final_committee_lec'][i]=="" || temp['exam_final_committee_lec'][i]==undefined)
        document.getElementById('FINEXCOM_LECF'+(i+1)).value = "";
      else
        document.getElementById('FINEXCOM_LECF'+(i+1)).value = temp['exam_final_committee_lec'][i];
    }

  }
  for(var i=0;i<temp['final_number_lab'];i++)
  {
    document.getElementById("fehla" + (i+1)).style.display = "";
    document.getElementById('fehlab' + (i+1)).classList.remove('hide');
    document.getElementById('FINEXCOM_LABF' + (i+1)).style.display = "";
    if(temp['exam_final_committee_lab'].length!=0)
    {
      if(temp['exam_final_committee_lab'][i]=="" || temp['exam_final_committee_lab'][i]==undefined)
        document.getElementById('FINEXCOM_LABF'+(i+1)).value = "";
      else
        document.getElementById('FINEXCOM_LABF'+(i+1)).value = temp['exam_final_committee_lab'][i];
    }

  }

  //part6
  var choice3 = temp['criterion_type'];
  $('input[name="CALCULATE"][value=' + choice3 + ']').prop('checked', true);
  document.getElementById('EXPLAINATION').value = temp['explaination'];

  //fucntion for disabled
  if($("input[name='CALCULATE']:checked").val()=="GROUP")
  {
    $('.atof').val("");
    $('#EXPLAINATION').prop('disabled',false);
    $('.atof').prop('disabled',true);
    $('.stou').prop('disabled',true);
    $('.atof').prop('required',false);
    $('.stou').prop('required',false);
  }
  else if ($("input[name='CALCULATE']:checked").val()=="CRITERIA")
  {
    $('#EXPLAINATION').prop('disabled',true);
    $('.stou').prop('disabled',true);
    $('.atof').prop('required',true);
    $('.atof').prop('disabled',false);
    $('.stou').prop('required',false);
    document.getElementById("CALCULATE_A_MIN").value = parseFloat(temp['A_min']).toFixed(1);
    document.getElementById("CALCULATE_Bp_MIN").value = parseFloat(temp['B+_min']).toFixed(1);
    document.getElementById("CALCULATE_Bp_MAX").value = parseFloat(temp['B+_max']).toFixed(1);
    document.getElementById("CALCULATE_B_MIN").value = parseFloat(temp['B_min']).toFixed(1);
    document.getElementById("CALCULATE_B_MAX").value = parseFloat(temp['B_max']).toFixed(1);
    document.getElementById("CALCULATE_Cp_MIN").value = parseFloat(temp['C+_min']).toFixed(1);
    document.getElementById("CALCULATE_Cp_MAX").value = parseFloat(temp['C+_max']).toFixed(1);
    document.getElementById("CALCULATE_C_MIN").value = parseFloat(temp['C_min']).toFixed(1);
    document.getElementById("CALCULATE_C_MAX").value = parseFloat(temp['C_max']).toFixed(1);
    document.getElementById("CALCULATE_Dp_MIN").value = parseFloat(temp['D+_min']).toFixed(1);
    document.getElementById("CALCULATE_Dp_MAX").value = parseFloat(temp['D+_max']).toFixed(1);
    document.getElementById("CALCULATE_D_MIN").value = parseFloat(temp['D_min']).toFixed(1);
    document.getElementById("CALCULATE_D_MAX").value = parseFloat(temp['D_max']).toFixed(1);
    document.getElementById("CALCULATE_F_MAX").value = parseFloat(temp['F_max']).toFixed(1);
  }else {
    $('.atof').val("");
    $('#EXPLAINATION').prop('disabled',true);
    $('.atof').prop('disabled',true);
    $('.stou').prop('disabled',false);
    $('.atof').prop('required',false);
    $('.stou').prop('required',true);
    document.getElementById("CALCULATE_S_MIN").value = parseFloat(temp['S_min']).toFixed(1);
    document.getElementById("CALCULATE_U_MAX").value = parseFloat(temp['U_max']).toFixed(1);
  }

  //part7
  var choice5 = temp['absent'];
  $('input[name="ABSENT"][value=' + choice5 + ']').prop('checked', true);

  //part8
  if(temp['syllabus']!=false)
  {
    $('#syllabus').prop('required', false);
    $('#reqq').hide();
    $('#spanfile').text(temp['syllabus']);
    $('#downloadfile').show();
  }
  else {
    $('#syllabus').prop('required', true);
    $('#reqq').show();
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

function checksubject(btntype,type){

  if(btntype==1)
  {
    document.getElementById("form1").reset();
    var file_data = new FormData;
    var course_id = String(document.getElementById('id').value);
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

                        //buttondiv
                        if(temp['ACCESS'] == true)
                        {
                          $('#buttondiv').show();
                          if(temp['INFO']!=false && temp['DATA']!=false)
                          {
                            document.getElementById('COURSE_ID').value = temp['INFO']['course_id'];
                            document.getElementById('NAME_ENG_COURSE').value = temp['INFO']['course_name_en'];
                            document.getElementById('NAME_TH_COURSE').value = temp['INFO']['course_name_th'];
                            document.getElementById('TOTAL').value = temp['INFO']['credit'];
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

                            for(var i=0;i<(Object.keys(temp['DATA']).length);i++)
                            {
                              var opt = document.createElement('option');
                              opt.value = temp['DATA'][i].semester +"_"+ temp['DATA'][i].year;
                              opt.innerHTML = "ภาคการศึกษาที่ " +temp['DATA'][i].semester +" ปีการศึกษา "+ temp['DATA'][i].year;
                              document.getElementById('semester').appendChild(opt);
                            }


                          }
                          else if(temp['INFO']==false && $('#id').val()!=""){
                            swal(
                               '',
                               'กระบวนวิชาที่ค้นหาไม่พบในระบบ <br> กรุณาติดต่อเจ้าหน้าที่ภาคที่สังกัด',
                               'error'
                             )
                             $('#dlhide').hide();
                            document.getElementById('id').value = "";
                            document.getElementById('formdrpd').style.display = "none";
                          }
                          else if(temp['INFO']!=false && temp['DATA']==false){
                             swal(
                                '',
                                'ท่านยังไม่เคยกรอกรายละเอียดในวิชานี้ <br>สามารถกรอกรายละเอียดได้ดังแบบฟอร์มข้างล่าง',
                                'info'
                              )
                              document.getElementById('formdrpd').style.display = "none";
                              $('#dlhide').show();
                             document.getElementById('COURSE_ID').value = temp['INFO']['course_id'];
                             document.getElementById('NAME_ENG_COURSE').value = temp['INFO']['course_name_en'];
                             document.getElementById('NAME_TH_COURSE').value = temp['INFO']['course_name_th'];
                             document.getElementById('TOTAL').value = temp['INFO']['credit'];
                           }
                           else {
                             if($('#id').val()=="" ||$('#id').val()==undefined )
                             {
                               $('#dlhide').hide();
                               document.getElementById('formdrpd').style.display = "none";
                               swal(
                                  '',
                                  'กรุณากรอกรหัสกระบวนวิชาให้ถูกต้อง',
                                  'error'
                                )
                             }
                           }
                        }else {
                          swal(
                             '',
                             'กระบวนวิชานี้ไม่อยู่ในความรับผิดชอบของท่าน',
                             'warning'
                           )
                           $('#dlhide').hide();
                           $('#formdrpd').hide();
                           $('#buttondiv').hide();
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
  else if (btntype==2) {
    var file_data = new FormData;
    var course_id = String(document.getElementById('id').value);
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
                      getinfo(temp);
                      $('#dlhide').show();

                    }
                    else {
                      swal.hideLoading()
                      alert('error');
                    }
                  } catch (e) {
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
  }else if(btntype==3)
  {
    $('#submitbtn2').hide();
    var file_data = new FormData;
    var course_id = String(document.getElementById('COURSE_ID_2').value);
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

                        //buttondiv
                        if(temp['ACCESS'] == true)
                        {
                          if(temp['INFO']!=false && temp['DATA']!=false)
                          {
                            document.getElementById('COURSE_ID_2').value = temp['INFO']['course_id'];
                            document.getElementById('formdrpd2').style.display = "";
                            //cleardatalist
                            var selectobject = document.getElementById('semester2');
                            var long = selectobject.length;
                            if(long!=0 && long!=null)
                            {
                              for (var i=0; i<=long; i++){
                                document.getElementsByName("semester2")[0].remove(0);
                              }
                            }

                            for(var i=0;i<(Object.keys(temp['DATA']).length);i++)
                            {
                              var opt = document.createElement('option');
                              opt.value = temp['DATA'][i].semester +"_"+ temp['DATA'][i].year;
                              opt.innerHTML = "ภาคการศึกษาที่ " +temp['DATA'][i].semester +" ปีการศึกษา "+ temp['DATA'][i].year;
                              document.getElementById('semester2').appendChild(opt);
                            }


                          }
                          else if(temp['INFO']==false && $('#COURSE_ID_2').val()!=""){
                            $('#submitbtn2').hide();
                            swal(
                               '',
                               'กระบวนวิชาที่ค้นหาไม่พบในระบบ <br> กรุณาติดต่อเจ้าหน้าที่ภาคที่สังกัด',
                               'error'
                             )
                            document.getElementById('COURSE_ID_2').value = "";
                            document.getElementById('formdrpd2').style.display = "none";
                          }
                          else if(temp['INFO']!=false && temp['DATA']==false){
                             swal(
                                '',
                                'ท่านยังไม่เคยอัพโหลด Cousr Syllabus ของวิชานี้ <br>สามารถอัพโหลดไฟล์ได้ดังแบบฟอร์มข้างล่าง',
                                'info'
                              )
                              $('#submitbtn2').show();
                              document.getElementById('formdrpd2').style.display = "none";
                             document.getElementById('COURSE_ID_2').value = temp['INFO']['course_id'];
                           }
                           else {
                             if($('#COURSE_ID_2').val()=="" ||$('#COURSE_ID_2').val()==undefined )
                             {
                               $('#submitbtn2').hide();
                               document.getElementById('formdrpd').style.display = "none";
                               swal(
                                  '',
                                  'กรุณากรอกรหัสกระบวนวิชาให้ถูกต้อง',
                                  'error'
                                )
                             }
                           }
                        }else {
                          swal(
                             '',
                             'กระบวนวิชานี้ไม่อยู่ในความรับผิดชอบของท่าน',
                             'warning'
                           )
                          $('#submitbtn2').hide();
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
  }else if (btntype==4) {
    var file_data = new FormData;
    var course_id = String(document.getElementById('COURSE_ID_2').value);
    var semester_temp = document.getElementById('semester2').value;
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
                         $('#submitbtn2').show();
                       if(temp['syllabus']!=false)
                       {
                         $('#syllabus_2').prop('required', false);
                         $('#reqq2').hide();
                         $('#spanfile2').text(temp['syllabus']);
                         $('#downloadfile2').show();
                       }
                       else {
                         $('#syllabus_2').prop('required', true);
                         $('#reqq2').show();
                         $('#spanfile2').text("");
                         $('#downloadfile2').hide();
                       }

                    }
                    else {
                      swal.hideLoading()
                      $('#submitbtn2').hide();
                      alert('error');
                    }
                  } catch (e) {
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
        if(document.getElementById('ENROLL'+i).value != "")
        {
          section[i-1] = document.getElementById('ENROLL'+i).value;
        }else {
          section[i-1] = "0";
        }
      }
      sectionobj = section;


      if(document.getElementById("CALCULATE_A_MIN").value=="")
      {
        var amin = "0.0";
      }else {
        var amin  = document.getElementById("CALCULATE_A_MIN").value;
      }
      if(document.getElementById("CALCULATE_Bp_MIN").value=="")
      {
        var bpmin = "0.0";
      }else {
        var bpmin = document.getElementById("CALCULATE_Bp_MIN").value;
      }
      if(document.getElementById("CALCULATE_B_MIN").value=="")
      {
        var bmin = "0.0";
      }else {
        var bmin = document.getElementById("CALCULATE_B_MIN").value;
      }
      if(document.getElementById("CALCULATE_Cp_MIN").value=="")
      {
        var cpmin = "0.0";
      }else {
        var cpmin = document.getElementById("CALCULATE_Cp_MIN").value;
      }
      if(document.getElementById("CALCULATE_C_MIN").value=="")
      {
        var cmin = "0.0";
      }else {
        var cmin = document.getElementById("CALCULATE_C_MIN").value;
      }
      if(document.getElementById("CALCULATE_Dp_MIN").value=="")
      {
        var dpmin = "0.0";
      }else {
        var dpmin = document.getElementById("CALCULATE_Dp_MIN").value;
      }
      if(document.getElementById("CALCULATE_D_MIN").value=="")
      {
        var dmin = "0.0";
      }else {
        var dmin = document.getElementById("CALCULATE_D_MIN").value;
      }
      if(document.getElementById("CALCULATE_S_MIN").value=="")
      {
        var smin = "0.0";
      }else {
        var smin = document.getElementById("CALCULATE_S_MIN").value;
      }
      //----------------

      if(document.getElementById("CALCULATE_Bp_MAX").value=="")
      {
        var bpmax = "0.0";
      }else {
        var bpmax = document.getElementById("CALCULATE_Bp_MAX").value;
      }
      if(document.getElementById("CALCULATE_B_MAX").value=="")
      {
        var bmax = "0.0";
      }else {
        var bmax = document.getElementById("CALCULATE_B_MAX").value;
      }
      if(document.getElementById("CALCULATE_Cp_MAX").value=="")
      {
        var cpmax = "0.0";
      }else {
        var cpmax = document.getElementById("CALCULATE_Cp_MAX").value;
      }
      if(document.getElementById("CALCULATE_C_MAX").value=="")
      {
        var cmax = "0.0";
      }else {
        var cmax = document.getElementById("CALCULATE_C_MAX").value;
      }
      if(document.getElementById("CALCULATE_Dp_MAX").value=="")
      {
        var dpmax = "0.0";
      }else {
        var dpmax = document.getElementById("CALCULATE_Dp_MAX").value;
      }
      if(document.getElementById("CALCULATE_D_MAX").value=="")
      {
        var dmax = "0.0";
      }else {
        var dmax = document.getElementById("CALCULATE_D_MAX").value;
      }
      if(document.getElementById("CALCULATE_F_MAX").value=="")
      {
        var fmax = "0.0";
      }else {
        var fmax = document.getElementById("CALCULATE_F_MAX").value;
      }
      if(document.getElementById("CALCULATE_U_MAX").value=="")
      {
        var umax = "100";
      }else {
        var umax = document.getElementById("CALCULATE_U_MAX").value;
      }
      //------

      if(document.getElementById("MIDEXAM_HOUR_LEC").value=="")
      {
        var h1 = "0";
      }else {
        var h1 = document.getElementById("MIDEXAM_HOUR_LEC").value;
      }

      if(document.getElementById("MIDEXAM_HOUR_LAB").value=="")
      {
        var h2 = "0";
      }else {
        var h2 = document.getElementById("MIDEXAM_HOUR_LAB").value;
      }

      if(document.getElementById("MIDEXAM_HOUR_LEC_SEC").value=="")
      {
        var h3 = "0";
      }else {
        var h3 = document.getElementById("MIDEXAM_HOUR_LEC_SEC").value;
      }

      if(document.getElementById("MIDEXAM_HOUR_LAB_SEC").value=="")
      {
        var h4 = "0";
      }else {
        var h4 = document.getElementById("MIDEXAM_HOUR_LAB_SEC").value;
      }

      if(document.getElementById("FINEXAM_HOUR_LEC").value=="")
      {
        var h5 = "0";
      }else {
        var h5 = document.getElementById("FINEXAM_HOUR_LEC").value;
      }

      if(document.getElementById("FINEXAM_HOUR_LAB").value=="")
      {
        var h6 = "0";
      }else {
        var h6 = document.getElementById("FINEXAM_HOUR_LAB").value;
      }

      if(document.getElementById("MEASURE_MIDLEC1").value=="")
      {
        var m1 = "0";
      }else {
        var m1  = document.getElementById("MEASURE_MIDLEC1").value;
      }
      if(document.getElementById("MEASURE_MIDLAB1").value=="")
      {
        var m2 = "0";
      }else {
        var m2  = document.getElementById("MEASURE_MIDLAB1").value;
      }
      if(document.getElementById("MEASURE_MIDLEC2").value=="")
      {
        var m3 = "0";
      }else {
        var m3  = document.getElementById("MEASURE_MIDLEC2").value;
      }
      if(document.getElementById("MEASURE_MIDLAB2").value=="")
      {
        var m4 = "0";
      }else {
        var m4  = document.getElementById("MEASURE_MIDLAB2").value;
      }
      if(document.getElementById("MEASURE_FINLEC").value=="")
      {
        var m5 = "0";
      }else {
        var m5  = document.getElementById("MEASURE_FINLEC").value;
      }
      if(document.getElementById("MEASURE_FINLAB").value=="")
      {
        var m6 = "0";
      }else {
        var m6  = document.getElementById("MEASURE_FINLAB").value;
      }
      if(document.getElementById("MEASURE_WORKLEC").value=="")
      {
        var m7 = "0";
      }else {
        var m7  = document.getElementById("MEASURE_WORKLEC").value;
      }
      if(document.getElementById("MEASURE_WORKLAB").value=="")
      {
        var m8 = "0";
      }else {
        var m8  = document.getElementById("MEASURE_WORKLAB").value;
      }
      if(document.getElementById("MEASURE_OTHLEC").value=="")
      {
        var m9 = "0";
      }else {
        var m9  = document.getElementById("MEASURE_OTHLEC").value;
      }
      if(document.getElementById("MEASURE_OTHLAB").value=="")
      {
        var m10 = "0";
      }else {
        var m10  = document.getElementById("MEASURE_OTHLAB").value;
      }
      if(document.getElementById("MEASURE_TOTALLEC").value=="")
      {
        var m11 = "0";
      }else {
        var m11  = document.getElementById("MEASURE_TOTALLEC").value;
      }
      if(document.getElementById("MEASURE_TOTALLAB").value=="")
      {
        var m12 = "0";
      }else {
        var m12  = document.getElementById("MEASURE_TOTALLAB").value;
      }



      var data = {
        'COURSE_ID': document.getElementById("COURSE_ID").value,
        'SECTION' : document.getElementById("SECTION").value,
        'NORORSPE' : document.querySelector("input[name='NORORSPE']:checked").value,
        'NAMETH' : document.getElementById("NAME_TH_COURSE").value,
        'NAMEENG' : document.getElementById("NAME_ENG_COURSE").value,
        'STUDENT' : sectionobj,
        'CREDIT_TOTAL' : document.getElementById("TOTAL").value,
        'TYPE_TEACHING' : document.querySelector("input[name='TYPE_TEACHING']:checked").value,
        'TYPE_TEACHING_NAME' : document.getElementById('TYPE_TEACHING_NAME').value,
        'TEACHER' : teacher_lec,
        'TEACHER-CO' : document.getElementById('tchco').value,
        'EXAM_MID1_HOUR_LEC' : h1,
        'EXAM_MID1_HOUR_LAB' : h2,
        'EXAM_MID1_NUMBER_LEC' : document.getElementById("mexholec").value,
        'EXAM_MID1_NUMBER_LAB' : document.getElementById("mexholac").value,
        'EXAM_MID1_COMMITTEE_LEC' : commidlec,
        'EXAM_MID1_COMMITTEE_LAB' : commidlab,
        'EXAM_MID2_HOUR_LEC' : h3,
        'EXAM_MID2_HOUR_LAB' : h4,
        'EXAM_MID2_NUMBER_LEC' : document.getElementById("mexholec_sec").value,
        'EXAM_MID2_NUMBER_LAB' : document.getElementById("mexholac_sec").value,
        'EXAM_MID2_COMMITTEE_LEC' : commidlec_sec,
        'EXAM_MID2_COMMITTEE_LAB' : commidlab_sec,
        'EXAM_FINAL_HOUR_LEC' : h5,
        'EXAM_FINAL_HOUR_LAB' : h6,
        'EXAM_FINAL_NUMBER_LEC' : document.getElementById("fexholec").value,
        'EXAM_FINAL_NUMBER_LAB' : document.getElementById("fexholac").value,
        'EXAM_FINAL_COMMITTEE_LEC' : comfinlec,
        'EXAM_FINAL_COMMITTEE_LAB' : comfinlab,
        'EXAM_SUGGESTION' : document.getElementById("suggestion").value,
        'MEASURE_MID1_LEC' : m1,
        'MEASURE_MID1_LAB' : m2,
        'MEASURE_MID2_LEC' : m3,
        'MEASURE_MID2_LAB' : m4,
        'MEASURE_FINAL_LEC' : m5,
        'MEASURE_FINAL_LAB' : m6,
        'MEASURE_WORK_LEC' : m7,
        'MEASURE_WORK_LAB' : m8,
        'MEASURE_OTHER_LEC' : m9,
        'MEASURE_OTHER_LAB' : m10,
        'MEASURE_OTHER_OTH' : document.getElementById("OTHER_MEA").value,
        'MEASURE_TOTAL_LEC' : m11,
        'MEASURE_TOTAL_LAB' : m12,
        'MEASURE_MSG' : document.getElementById("psmeasure").value,
        'CALCULATE_TYPE' : document.querySelector("input[name='CALCULATE']:checked").value,
        'CALCULATE_EXPLAINATION' : document.getElementById("EXPLAINATION").value,
        'CALCULATE_A_MAX' : "100.0",
        'CALCULATE_A_MIN' : amin,
        'CALCULATE_B+_MIN' : bpmin,
        'CALCULATE_B+_MAX' : bpmax,
        'CALCULATE_B_MIN' : bmin,
        'CALCULATE_B_MAX' : bmax,
        'CALCULATE_C+_MIN' : cpmin,
        'CALCULATE_C+_MAX' : cpmax,
        'CALCULATE_C_MIN' : cmin,
        'CALCULATE_C_MAX' : cmax,
        'CALCULATE_D+_MIN' : dpmin,
        'CALCULATE_D+_MAX' : dpmax,
        'CALCULATE_D_MIN' : dmin,
        'CALCULATE_D_MAX' : dmax,
        'CALCULATE_F_MAX' : fmax,
        'CALCULATE_F_MIN' : "0.0",
        'CALCULATE_S_MAX' : "100.0",
        'CALCULATE_S_MIN' : smin,
        'CALCULATE_U_MAX' : umax,
        'CALCULATE_U_MIN' : "0.0",
        'ABSENT' : document.querySelector("input[name='ABSENT']:checked").value,
        'SUBMIT_TYPE' : casesubmit,
        'USERID' : '<?php echo $_SESSION['id']; ?>',
        'DATE' : '<?php echo date('d'); ?>',
        'MONTH' : '<?php echo date('m'); ?>',
        'YEAR' : '<?php echo date('Y')+543; ?>'
      };

    senddata(JSON.stringify(data),getfile('1'),casesubmit);
  }
  else if(casesubmit=='0')
  {
    var data = {
      'COURSE_ID' : document.getElementById('COURSE_ID_2').value,
      'SUBMIT_TYPE' : casesubmit
    };
    senddata(JSON.stringify(data),getfile('0'),casesubmit);
  }

}
function senddata(data,file_data,casesubmit)
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

function deletedata()
{
  if( document.getElementById('semester').value!="" && document.getElementById('semester').value!=undefined )
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
          var teachername_temp = document.getElementById('semester').value;
          var stringspl = teachername_temp.split('_');
          var semester = stringspl[0];
          var year = stringspl[1];
          var type = 'evaluate';
          file_data.append("course_id",course_id);
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

  $('#dlhide').hide();

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
      $('#syllabus').prop('required', false);
      $('#syllabus_2').prop('required', false);
      $('#COURSE_ID_2').prop('required', false);";

      if(isset($_POST['course_id']))
    {
      echo "document.getElementById('form1').reset();
      var file_data = new FormData;
      var course_id = '".$_POST['course_id']."';
      var type = 1;
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
                            if(temp['ACCESS'] == true)
                            {
                              $('#buttondiv').show();
                              if(temp['INFO']!=false && temp['DATA']!=false)
                              {
                                document.getElementById('id').value = temp['INFO']['course_id'];
                                document.getElementById('COURSE_ID').value = temp['INFO']['course_id'];
                                document.getElementById('COURSE_ID_2').value = temp['INFO']['course_id'];
                                document.getElementById('NAME_ENG_COURSE').value = temp['INFO']['course_name_en'];
                                document.getElementById('NAME_TH_COURSE').value = temp['INFO']['course_name_th'];
                                document.getElementById('TOTAL').value = temp['INFO']['credit'];
                                document.getElementById('formdrpd').style.display = '';
                                //cleardatalist
                                var selectobject = document.getElementById('semester');
                                var long = selectobject.length;
                                if(long!=0 && long!=null)
                                {
                                  for (var i=0; i<=long; i++){
                                    document.getElementsByName('semester')[0].remove(0);
                                  }
                                }

                                for(var i=0;i<(Object.keys(temp['DATA']).length);i++)
                                {
                                  var opt = document.createElement('option');
                                  opt.value = temp['DATA'][i].semester +'_'+ temp['DATA'][i].year;
                                  opt.innerHTML = 'ภาคการศึกษาที่ ' +temp['DATA'][i].semester +' ปีการศึกษา '+ temp['DATA'][i].year;
                                  document.getElementById('semester').appendChild(opt);
                                }
                                var file_data = new FormData;
                                var course_id = String(temp['INFO']['course_id']);
                                var semester_temp = document.getElementById('semester').value;
                                var stringspl = semester_temp.split('_');
                                var semester = stringspl[0];
                                var year = stringspl[1];
                                var type = 1;
                                JSON.stringify(course_id);
                                JSON.stringify(semester);
                                JSON.stringify(year);
                                JSON.stringify(type);
                                file_data.append('course_id',course_id);
                                file_data.append('semester',semester);
                                file_data.append('year',year);
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

                                                if(temp!=null)
                                                {
                                                  getinfo(temp);
                                                  $('#dlhide').show();

                                                }
                                                else {
                                                  alert('error');
                                                }
                                              }  catch (e) {
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
                                   });

                              }
                              else if(temp['INFO']==false){
                                 $('#dlhide').hide();
                                document.getElementById('id').value = '';
                                document.getElementById('formdrpd').style.display = 'none';
                              }
                              else if(temp['INFO']!=false && temp['DATA']==false){
                                  document.getElementById('formdrpd').style.display = 'none';
                                  $('#dlhide').show();
                                  document.getElementById('id').value = temp['INFO']['course_id'];
                                 document.getElementById('COURSE_ID').value = temp['INFO']['course_id'];
                                 document.getElementById('NAME_ENG_COURSE').value = temp['INFO']['course_name_en'];
                                 document.getElementById('NAME_TH_COURSE').value = temp['INFO']['course_name_th'];
                                 document.getElementById('TOTAL').value = temp['INFO']['credit'];
                                 $('#syllabus').prop('required', true);
                                 $('#reqq').show();
                                 $('#spanfile').text('');
                                 $('#downloadfile').hide();
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

    }else if ($flageva==0 && $flagcor>0) {
      echo "$('#overtimemsg3').hide();
      $('#overtimemsg5').hide();
      $('#dlhide').hide();
      $('#formheader').hide();
      $('#syllabus').prop('required', false);
      $('#syllabus_2').prop('required', true);
      $('#COURSE_ID_2').prop('required', true);";

      if(isset($_POST['course_id']))
      {
        echo "$('#COURSE_ID_2').val('".$_POST['course_id']."');";
      }
    }else if ($flageva>0 && $flagcor>0) {
      echo "$('#overtimemsg').hide();
      $('#overtimemsg3').hide();
      $('#bottomform').hide();
      $('#overtimemsg5').hide();
      $('#syllabus').prop('required', true);
      $('#syllabus_2').prop('required', false);
      $('#COURSE_ID_2').prop('required', false);";

      if(isset($_POST['course_id']))
    {
      echo "document.getElementById('form1').reset();
      var file_data = new FormData;
      var course_id = '".$_POST['course_id']."';
      var type = 1;
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
                            if(temp['ACCESS'] == true)
                            {
                              $('#buttondiv').show();
                              if(temp['INFO']!=false && temp['DATA']!=false)
                              {
                                document.getElementById('id').value = temp['INFO']['course_id'];
                                document.getElementById('COURSE_ID').value = temp['INFO']['course_id'];
                                document.getElementById('COURSE_ID_2').value = temp['INFO']['course_id'];
                                document.getElementById('NAME_ENG_COURSE').value = temp['INFO']['course_name_en'];
                                document.getElementById('NAME_TH_COURSE').value = temp['INFO']['course_name_th'];
                                document.getElementById('TOTAL').value = temp['INFO']['credit'];
                                document.getElementById('formdrpd').style.display = '';
                                //cleardatalist
                                var selectobject = document.getElementById('semester');
                                var long = selectobject.length;
                                if(long!=0 && long!=null)
                                {
                                  for (var i=0; i<=long; i++){
                                    document.getElementsByName('semester')[0].remove(0);
                                  }
                                }

                                for(var i=0;i<(Object.keys(temp['DATA']).length);i++)
                                {
                                  var opt = document.createElement('option');
                                  opt.value = temp['DATA'][i].semester +'_'+ temp['DATA'][i].year;
                                  opt.innerHTML = 'ภาคการศึกษาที่ ' +temp['DATA'][i].semester +' ปีการศึกษา '+ temp['DATA'][i].year;
                                  document.getElementById('semester').appendChild(opt);
                                }
                                var file_data = new FormData;
                                var course_id = String(temp['INFO']['course_id']);
                                var semester_temp = document.getElementById('semester').value;
                                var stringspl = semester_temp.split('_');
                                var semester = stringspl[0];
                                var year = stringspl[1];
                                var type = 1;
                                JSON.stringify(course_id);
                                JSON.stringify(semester);
                                JSON.stringify(year);
                                JSON.stringify(type);
                                file_data.append('course_id',course_id);
                                file_data.append('semester',semester);
                                file_data.append('year',year);
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

                                                if(temp!=null)
                                                {
                                                  getinfo(temp);
                                                  $('#dlhide').show();

                                                }
                                                else {
                                                  alert('error');
                                                }
                                              }  catch (e) {
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
                                   });

                              }
                              else if(temp['INFO']==false){
                                 $('#dlhide').hide();
                                document.getElementById('id').value = '';
                                document.getElementById('formdrpd').style.display = 'none';
                              }
                              else if(temp['INFO']!=false && temp['DATA']==false){
                                 document.getElementById('formdrpd').style.display = 'none';
                                 $('#dlhide').show();
                                 document.getElementById('id').value = temp['INFO']['course_id'];
                                 document.getElementById('COURSE_ID').value = temp['INFO']['course_id'];
                                 document.getElementById('NAME_ENG_COURSE').value = temp['INFO']['course_name_en'];
                                 document.getElementById('NAME_TH_COURSE').value = temp['INFO']['course_name_th'];
                                 document.getElementById('TOTAL').value = temp['INFO']['credit'];
                                 $('#syllabus').prop('required', true);
                                 $('#reqq').show();
                                 $('#spanfile').text('');
                                 $('#downloadfile').hide();
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
      }
      else {
        $('.atof').val("");
        $('.stou').val("");
        $('.atof').prop('disabled',true);
        $('.atof').prop('required',false);
        $('.stou').prop('required',true);
        $('.stou').prop('disabled',false);
        $('#EXPLAINATION').val("");
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
      window.sumcheck = 0;
      swal(
        'คะแนนรวมปัจจุบัน : '+summea+'',
        'คะแนนรวมของภาคบรรยายและภาคปฏิบัติต้องรวมกันได้ร้อยละ 100 กรุณาตรวจสอบสัดส่วนการให้คะแนนใหม่อีกครั้ง',
        'error'
      )
      $('#MEASURE_TOTALLEC').val("");
      $('#MEASURE_TOTALLAB').val("");
    }
    else {

      window.sumcheck = 1;
      $('#MEASURE_TOTALLEC').val(callec);
      $('#MEASURE_TOTALLAB').val(callab);
    }
  });

  $('.keyupcheck').keyup(function() {
    $('.keyupcheck').each(function() {
        window.sumcheck = 0;
    });
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
      if(window.sumcheck==1 || casesubmit=='2')
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
      }
      else {
        swal(
          '',
          'กรุณากดปุ่ม "รวมคะแนน" ในหัวข้อที่ 4 และกรอกสัดส่วนคะแนนให้ถูกต้อง',
          'error'
        )
      }

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
  if($("#COURSE_ID_2").val()!=undefined && $("[COURSE_ID_2]").val()!="" && $("#syllabus_2").val()!=undefined && $("[syllabus_2]").val()!="")
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
    <div id="overtimemsg" class="alert alert-danger"><div class="glyphicon glyphicon-alert" style="color: red;font-size:18px;" ><b> ไม่สามารถกรอกแบบแจ้งวิธีการวัดผลและประเมินผลการศึกษา <br><br> เนื่องจากช่วงเวลาที่ทำการยังไม่เปิดให้บริการหรือสิ้นสุดลง !</b></div><b style="color: red;font-size:16px;"> <p id="overtimemsg2"></p></b> </div>
    <div id="overtimemsg3" class="alert alert-danger"><div class="glyphicon glyphicon-alert" style="color: red;font-size:18px;" ><b> ไม่สามารถอัปโหลดไฟล์ Course Syllabus <br><br> เนื่องจากช่วงเวลาที่ทำการยังไม่เปิดให้บริการหรือสิ้นสุดลง !</b></div><b style="color: red;font-size:16px;"> <p id="overtimemsg4"></p></b> </div>
    <div id="overtimemsg5" class="alert alert-danger"><div class="glyphicon glyphicon-alert" style="color: red;font-size:18px;" ><b> ไม่สามารถกรอกแบบแจ้งวิธีการวัดผลและประเมินผลการศึกษาและอัปโหลดไฟล์ Course Syllabus <br><br> เนื่องจากช่วงเวลาที่ทำการยังไม่เปิดให้บริการหรือสิ้นสุดลง !</b></div><b style="color: red;font-size:16px;"> <p id="overtimemsg6"></p></b> </div>
    <form id="formheader" data-toggle="validator" role="form">
      <div id="formchecksj" class="form-inline" style="font-size:16px;">
                <div class="form-group ">
                  รหัสกระบวนวิชา
                   <input type="text" class="form-control formlength numonly" id="id" name="id" size="7" placeholder="e.g. 204111" maxlength="6" pattern=".{6,6}" required >
                </div>
                <input type="hidden" name="type" value="1">
               <button type="button" class="btn btn-outline btn-primary" onclick="checksubject(1,1);">ค้นหา</button>
       </div>

  <div id="formdrpd" style="display: none;">
    <div class="form-inline">
      <div class="form-group " style="font-size:16px;">
         ดึงข้อมูลย้อนหลัง
        <select class="form-control formlength required" id="semester" name="semester" style="width: 300px; " required >
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
          <b>รหัสกระบวนวิชา</b> &nbsp;<input style="width: 100px;" type="text" class="form-control formlength numonly" name="COURSE_ID" id="COURSE_ID"   maxlength="6" required pattern=".{6,6}" readonly>
          </div>
          <div class="form-group">
            &nbsp;จำนวนตอน (ทั้งหมด) &nbsp;
            <select class="form-control formlength required" id="SECTION" name="SECTION" style="width: 70px;" required onchange="section_box()" >
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
          ชื่อกระบวนวิชาภาษาไทย &nbsp;<input style="width: 100%!important;" type="text" class="form-control formlength" name="NAME_TH_COURSE" id="NAME_TH_COURSE"   maxlength="50" required readonly>
          </div>
          <br>
          <div class="form-group">
          ชื่อกระบวนวิชาภาษาอังกฤษ &nbsp;<input style="width: 100%!important;" type="text" class="form-control formlength" name="NAME_ENG_COURSE" id="NAME_ENG_COURSE"   maxlength="50" required readonly>
          </div>
          <div class="row">
            <div class=" form-group">&nbsp;&nbsp;&nbsp;&nbsp;จำนวนหน่วยกิตทั้งหมด &nbsp;<input type="text" class="form-control formlength" name="TOTAL" id="TOTAL" size="5" maxlength="10" required pattern=".{8,10}" readonly>&nbsp; หน่วยกิต
            </div></div>
          </div>
          <div class="form-group"><div class="form-inline" id="secdiv1">นักศึกษาที่ลงทะเบียนเรียนในตอนที่ 1 จำนวน&nbsp;<input style="width: 70px;" type="text" class="form-control formlength numonly" name="ENROLL1" id="ENROLL1" size="2" maxlength="3" pattern=".{1,3}" required>&nbsp;คน </div>
            <?php
                for ($i=2; $i<=5 ; $i++) {
                  echo '<div class="form-inline hide" style="display:none;" id="secdiv'.$i.'">นักศึกษาที่ลงทะเบียนเรียนในตอนที่ '.$i.' จำนวน&nbsp;<input style="width: 70px; display: none;" type="text" class="form-control formlength numonly" name="ENROLL'.$i.'" id="ENROLL'.$i.'" size="2" maxlength="3" pattern=".{1,3}">&nbsp;คน </div>';
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
            <input type="text" class="form-control formlength" name="TYPE_TEACHING_NAME" id="TYPE_TEACHING_NAME" placeholder="โปรดระบุ">

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
          <input type="text" class="form-control formlength charonly" name="TEACHERLEC_F1" id="TEACHERLEC_F1" list="dtl1" placeholder="ชื่อ-นามสกุล" size="35" onkeydown="searchname(1,'subject');" >
          <datalist id="dtl1">
          </datalist>
        </div>

        <div class="form-inline" id="ctlec2">
          <label id="li2">2. &nbsp;</label>
          <input type="text" class="form-control formlength charonly" name="TEACHERLEC_F2" id="TEACHERLEC_F2" list="dtl2" placeholder="ชื่อ-นามสกุล" size="35" onkeydown="searchname(2,'subject');" >
          <datalist id="dtl2">
          </datalist>
        </div>

        <div class="form-inline" id="ctlec3">
          <label id="li3">3. &nbsp;</label>
          <input type="text" class="form-control formlength charonly" name="TEACHERLEC_F3" id="TEACHERLEC_F3" list="dtl3" placeholder="ชื่อ-นามสกุล" size="35" onkeydown="searchname(3,'subject');" >
          <datalist id="dtl3">
          </datalist>
        </div>
        <div class="form-inline" id="ctlec4">
          <label id="li4">4. &nbsp;</label>
          <input type="text" class="form-control formlength charonly" name="TEACHERLEC_F4" id="TEACHERLEC_F4" list="dtl4" placeholder="ชื่อ-นามสกุล" size="35" onkeydown="searchname(4,'subject');" >
          <datalist id="dtl4">
          </datalist>
        </div>
        <div class="form-inline" id="ctlec5">
          <label id="li5">5. &nbsp;</label>
          <input type="text" class="form-control formlength charonly" name="TEACHERLEC_F5" id="TEACHERLEC_F5" list="dtl5" placeholder="ชื่อ-นามสกุล" size="35" onkeydown="searchname(5,'subject');" >
          <datalist id="dtl5">
          </datalist>
        </div>
        <div class="form-inline">
          <div id="text"><b>อาจารย์ผู้ร่วมสอน</b>
          </div>
        </div>

          <textarea class="form-control textareawidth" id="tchco" rows="5"></textarea>



      </li>


        <br>

          <li style="font-size: 14px;">
            การวัดผลการศึกษา (สัดส่วนการให้คะแนนโปรดระบุเป็นร้อยละ)<br>
            <div class="row">
            <div class="col-md-10">
            <div class="table-responsive">
            <table id="meastable" class="table table-bordered table-hover" style="font-size: 14px;">
              <tr class="success">
                <th width="67%" colspan="2"> </th>
                <th style="text-align: center;">ภาคทฤษฏี</th>
                <th style="text-align: center;">ภาคปฏิบัติ </th>
              </tr>
              <tr>
                <td colspan="2">1. สอบกลางภาคครั้งที่ 1</td>
                <td><div class="form-group"><input type="text" class="form-control formlength numonly keyupcheck" name="MEASURE_MIDLEC1" id="MEASURE_MIDLEC1" size="10" value="0"></div></td>
                <td><div class="form-group"><input type="text" class="form-control formlength numonly keyupcheck" name="MEASURE_MIDLAB1" id="MEASURE_MIDLAB1" size="10" value="0"></div></td>
              </tr>
              <tr>
                <td colspan="2">2. สอบกลางภาคครั้งที่ 2</td>
                <td><div class="form-group"><input type="text" class="form-control formlength numonly keyupcheck" name="MEASURE_MIDLEC2" id="MEASURE_MIDLEC2" size="10" value="0"></div></td>
                <td><div class="form-group"><input type="text" class="form-control formlength numonly keyupcheck" name="MEASURE_MIDLAB2" id="MEASURE_MIDLAB2" size="10" value="0"></div></td>
              </tr>
              <tr>
                <td colspan="2">3. สอบไล่ </td>
                <td><div class="form-group"><input type="text" class="form-control formlength numonly keyupcheck" name="MEASURE_FINLEC" id="MEASURE_FINLEC" size="10" value="0"></div></td>
                <td><div class="form-group"><input type="text" class="form-control formlength numonly keyupcheck" name="MEASURE_FINLAB" id="MEASURE_FINLAB" size="10" value="0"></div></td>
              </tr>
              <tr>
                <td colspan="2">4. งานมอบหมาย </td>
                <td><div class="form-group"><input type="text" class="form-control formlength numonly keyupcheck" name="MEASURE_WORKLEC" id="MEASURE_WORKLEC" size="10" value="0"></div></td>
                <td><div class="form-group"><input type="text" class="form-control formlength numonly keyupcheck" name="MEASURE_WORKLAB" id="MEASURE_WORKLAB" size="10" value="0"></div></td>
              </tr>
              <tr name="addtr">

                <td colspan="2"><div class="form-group form-inline">5. อื่นๆ โปรดระบุ &nbsp;&nbsp;<input type="text" class="form-control formlength" name="OTHER_MEA" id="OTHER_MEA" size="30"></div></td>
                <td><div class="form-group"><input type="text" class="form-control formlength numonly keyupcheck" name="MEASURE_OTHLEC" id="MEASURE_OTHLEC" size="10" value="0"></div></td>
                <td><div class="form-group"><input type="text" class="form-control formlength numonly keyupcheck" name="MEASURE_OTHLAB" id="MEASURE_OTHLAB" size="10" value="0"></div></td>
              </tr>
              <tr>
                <td colspan="2" align="right"><input type="button" class="btn btn-outline btn-warning" name="calmea" id="calmea" value="รวมคะแนน"></td>
                <td><div class="form-group"><input type="text" class="form-control formlength numonly keyupcheck" name="MEASURE_TOTALLEC" id="MEASURE_TOTALLEC" size="10" value="0" readonly></div></td>
                <td><div class="form-group"><input type="text" class="form-control formlength numonly keyupcheck" name="MEASURE_TOTALLAB" id="MEASURE_TOTALLAB" size="10" value="0" readonly></div></td>
              </tr>
            </table>
          </div>
            </div>
          </div>
            หมายเหตุ
            <br> <textarea class="form-control textareawidth" id="psmeasure" rows="5"></textarea>

          </li>

          <br>
          <li style="font-size: 14px">
            <div class="form-inline"><b> การสอบ โปรดระบุให้ชัดเจน และครบถ้วน เพื่อใช้เป็นข้อมูลการจัดตารางสอบ </b>(กรุณาระบุชื่ออาจารย์ที่ร่วมสอนในกระบวนวิชา และจำนวนกรรมการคุมสอบอาจระบุอย่างน้อย 3 คน) </div>

            <ul>
              <br>
              <li style="font-size: 14px">

                <b>สอบกลางภาคครั้งที่ 1</b>
                <ul>
                  <div class="form-inline">
                    <li style="font-size: 14px">
                      <div class="form-group">
                      จำนวนชั่วโมงการสอบ<b>บรรยาย</b>&nbsp;:&nbsp;<input type="text" style="width: 70px" class="form-control formlength numonly" name="MIDEXAM_HOUR_LEC" id="MIDEXAM_HOUR_LEC" size="2" maxlength="3" >&nbsp; ชั่วโมง
                    </div>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวนกรรมการคุมสอบ&nbsp;
                      <select name="mexholec" id="mexholec" class="form-control formlength numonly" onchange="midexam_hour_lec()">
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
                <input type="text" style="display:none;" class="form-control formlength charonly" name="MIDEXCOM_LECF'.$i.'" id="MIDEXCOM_LECF'.$i.'" placeholder="ชื่อ" size="35" list="dtmeh'.$i.'" onkeydown="searchname('.$i.',511);">
                <datalist id="dtmeh'.$i.'">
                </datalist>
              </div>';
            }
         ?>

                      <div class="form-inline">
                        <li style="font-size: 14px">
                          <div class="form-group">
                          จำนวนชั่วโมงการสอบ<b>ปฏิบัติการ</b>&nbsp;:&nbsp;<input type="text" class="form-control formlength numonly" name="MIDEXAM_HOUR_LAB" id="MIDEXAM_HOUR_LAB" size="2" >&nbsp; ชั่วโมง
                        </div>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวนกรรมการคุมสอบ&nbsp;
                          <select  name="mexholac" id="mexholac" class="form-control formlength numonly" onchange="midexam_hour_lab()">
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
                 <input type="text" style="display:none;" class="form-control formlength charonly" name="MIDEXCOM_LABF'.$i.'" id="MIDEXCOM_LABF'.$i.'" placeholder="ชื่อ" size="35" list="dtehlab'.$i.'" onkeydown="searchname('.$i.',512);">
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

                <b>สอบกลางภาคครั้งที่ 2</b>
                <ul>
                  <div class="form-inline">
                    <li style="font-size: 14px">
                      <div class="form-group">
                      จำนวนชั่วโมงการสอบ<b>บรรยาย</b>&nbsp;:&nbsp;<input type="text" style="width: 70px" class="form-control formlength numonly" name="MIDEXAM_HOUR_LEC_SEC" id="MIDEXAM_HOUR_LEC_SEC" size="2" maxlength="3" >&nbsp; ชั่วโมง
                    </div>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวนกรรมการคุมสอบ&nbsp;
                      <select  name="mexholec_sec" id="mexholec_sec" class="form-control formlength numonly" onchange="midexam_hour_lec_sec()">
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
                <input type="text" style="display:none;" class="form-control formlength charonly" name="MIDEXCOM_LECF'.$i.'_sec" id="MIDEXCOM_LECF'.$i.'_sec" placeholder="ชื่อ" size="35" list="dtmehle'.$i.'_sec" onkeydown="searchname('.$i.',521);">
                <datalist id="dtmehle'.$i.'_sec">
                </datalist>
              </div>';
            }
         ?>

                      <div class="form-inline">
                        <li style="font-size: 14px">
                          <div class="form-group">
                          จำนวนชั่วโมงการสอบ<b>ปฏิบัติการ</b>&nbsp;:&nbsp;<input type="text" class="form-control formlength numonly" name="MIDEXAM_HOUR_LAB_SEC" id="MIDEXAM_HOUR_LAB_SEC" size="2" >&nbsp; ชั่วโมง
                        </div>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวนกรรมการคุมสอบ&nbsp;
                          <select  name="mexholac_sec" id="mexholac_sec" class="form-control formlength numonly" onchange="midexam_hour_lab_sec()">
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
                 <input type="text" style="display:none;" class="form-control formlength charonly" name="MIDEXCOM_LABF'.$i.'_sec" id="MIDEXCOM_LABF'.$i.'_sec" placeholder="ชื่อ" size="35" list="dtehla'.$i.'_sec" onkeydown="searchname('.$i.',522);">
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
                        จำนวนชั่วโมงการสอบ<b>บรรยาย</b>&nbsp;:&nbsp;<input  style="width: 70px"type="text" class="form-control formlength numonly" name="FINEXAM_HOUR_LEC" id="FINEXAM_HOUR_LEC" size="2" maxlength="3" >&nbsp; ชั่วโมง
                        </div>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวนกรรมการคุมสอบ&nbsp;
                        <select name="fexholec" id="fexholec" class="form-control formlength numonly" onchange="finexam_hour_lec()">
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
                <input type="text" style="display:none;" class="form-control formlength charonly" name="FINEXCOM_LECF'.$i.'" id="FINEXCOM_LECF'.$i.'" placeholder="ชื่อ" size="35" list="dtfmehle'.$i.'" onkeydown="searchname('.$i.',531);">
                <datalist id="dtfmehle'.$i.'">
                </datalist>
              </div>';
            }
         ?>


                        <div class="form-inline">
                          <li style="font-size: 14px">
                            <div class="form-group">
                            จำนวนชั่วโมงการสอบ<b>ปฏิบัติการ</b>&nbsp;:&nbsp;<input style="width: 70px" type="text" class="form-control formlength numonly" name="FINEXAM_HOUR_LAB" id="FINEXAM_HOUR_LAB" size="2" maxlength="3" >&nbsp; ชั่วโมง
                          </div>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวนกรรมการคุมสอบ&nbsp;
                            <select name="fexholac" id="fexholac" class="form-control formlength numonly" onchange="finexam_hour_lab()">
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
                 <input type="text" style="display:none;" class="form-control formlength charonly" name="FINEXCOM_LABF'.$i.'" id="FINEXCOM_LABF'.$i.'" placeholder="ชื่อ" size="35" list="dtfehla'.$i.'" onkeydown="searchname('.$i.',532);">
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
            หมายเหตุ
            <br> <textarea class="form-control textareawidth" id="suggestion" rows="5"></textarea>

        </li>

          <br>
          <li style="font-size: 14px;">
            วิธีการตัดเกรด
            <br>
            <div class="form-inline">
              <div class="radio">
              <input type="radio" name="CALCULATE" id="CALCULATE_TYPE2" value="CRITERIA" checked> อิงเกณฑ์ &nbsp;&nbsp;ได้กำหนดเกณฑ์ดังต่อไปนี้
              <div style="">
              <div class="">
              <div class="col-md-12">
              <div class="table-responsive">
              <table class="table table-hover" style="font-size: 14px; ">
                <tr align="center">
                  <th>เกรด</th>
                  <th>คะแนนต่ำสุด</th>
                  <th></th>
                  <th>คะแนนสูงสุด</th>
                </tr>
                <tr align="center">
                  <td>A</td>
                  <td><input type="text" class="form-control formlength numonly atof" name="CALCULATE_A_MIN" id="CALCULATE_A_MIN" maxlength="4" value="80.0"></td>
                  <td>ถึง</td>
                  <td><input type="text" class="form-control formlength numonly" name="CALCULATE_A_MAX" id="CALCULATE_A_MAX" placeholder="100" disabled></td>

                </tr>
                <tr align="center">
                  <td>B+</td>
                  <td><input type="text" class="form-control formlength numonly atof" name="CALCULATE_Bp_MIN" id="CALCULATE_Bp_MIN" maxlength="4" value="75.0"></td>
                  <td>ถึง</td>
                  <td><input type="text" class="form-control formlength numonly atof" name="CALCULATE_Bp_MAX" id="CALCULATE_Bp_MAX" maxlength="4" value="79.9"></td>

                </tr>
                <tr align="center">
                  <td>B</td>
                  <td><input type="text" class="form-control formlength numonly atof" name="CALCULATE_B_MIN" id="CALCULATE_B_MIN" maxlength="4" value="70.0"></td>
                  <td>ถึง</td>
                  <td><input type="text" class="form-control formlength numonly atof" name="CALCULATE_B_MAX" id="CALCULATE_B_MAX" maxlength="4" value="74.9"></td>


                </tr>
                <tr align="center">
                  <td>C+</td>
                  <td><input type="text" class="form-control formlength numonly atof" name="CALCULATE_Cp_MIN" id="CALCULATE_Cp_MIN" maxlength="4" value="65.0"></td>
                  <td>ถึง</td>
                  <td><input type="text" class="form-control formlength numonly atof" name="CALCULATE_Cp_MAX" id="CALCULATE_Cp_MAX" maxlength="4" value="69.9"></td>

                </tr>
                <tr align="center">
                  <td>C</td>
                  <td><input type="text" class="form-control formlength numonly atof" name="CALCULATE_C_MIN" id="CALCULATE_C_MIN" maxlength="4" value="60.0"></td>
                  <td>ถึง</td>
                  <td><input type="text" class="form-control formlength numonly atof" name="CALCULATE_C_MAX" id="CALCULATE_C_MAX" maxlength="4" value="64.9"></td>

                </tr>
                <tr align="center">
                  <td>D+</td>
                  <td><input type="text" class="form-control formlength numonly atof" name="CALCULATE_Dp_MIN" id="CALCULATE_Dp_MIN" maxlength="4" value="55.0"></td>
                  <td>ถึง</td>
                  <td><input type="text" class="form-control formlength numonly atof" name="CALCULATE_Dp_MAX" id="CALCULATE_Dp_MAX" maxlength="4" value="59.9"></td>
                </tr>
                <tr align="center">
                  <td>D</td>
                  <td><input type="text" class="form-control formlength numonly atof" name="CALCULATE_D_MIN" id="CALCULATE_D_MIN" maxlength="4" value="50.0"></td>
                  <td>ถึง</td>
                  <td><input type="text" class="form-control formlength numonly atof" name="CALCULATE_D_MAX" id="CALCULATE_D_MAX" maxlength="4" value="54.9"></td>

                </tr>
                <tr align="center">
                  <td>F</td>
                  <td><input type="text" class="form-control formlength numonly" name="CALCULATE_F_MIN" id="CALCULATE_F_MIN" placeholder="0" disabled></td>
                  <td>ถึง</td>
                  <td><input type="text" class="form-control formlength numonly atof" name="CALCULATE_F_MAX" id="CALCULATE_F_MAX" maxlength="4" value="49.9"></td>

                </tr>
              </table>
            </div>
            </div>
          </div>
        </div>
              <input type="radio" name="CALCULATE" id="CALCULATE_TYPE1" value="GROUP" required> อิงกลุ่ม &nbsp;
              <div class="form-inline">

                <textarea class="form-control" style="width: 95%; margin-left:15px;" name="EXPLAINATION" id="EXPLAINATION" rows="5" placeholder="โปรดระบุ" ></textarea>

              </div>
              <br>
              <input type="radio" name="CALCULATE" id="CALCULATE_TYPE3" value="SU"> ให้อักษร S หรือ U
              <div style="">
              <div class="">
              <div class="col-md-12">
              <div class="table-responsive">
              <table class="table table-hover" style="font-size: 14px; ">
                <tr align="center" style="text-align:center;">
                  <th>เกรด</th>
                  <th>คะแนนต่ำสุด</th>
                  <th></th>
                  <th>คะแนนสูงสุด</th>
                </tr>
                <tr align="center">
                  <td>S</td>
                  <td><input type="text" class="form-control formlength numonly stou" name="CALCULATE_S_MIN" id="CALCULATE_S_MIN" maxlength="5" value=""></td>
                  <td>ถึง</td>
                  <td><input type="text" class="form-control formlength numonly" name="CALCULATE_S_MAX" id="CALCULATE_S_MIN" placeholder="100" disabled></td>
                </tr>
                <tr align="center">
                  <td>U</td>
                  <td><input type="text" class="form-control formlength numonly" name="CALCULATE_U_MAX" id="CALCULATE_U_MIN" placeholder="0" disabled></td>
                  <td>ถึง</td>
                  <td><input type="text" class="form-control formlength numonly stou" name="CALCULATE_U_MAX" id="CALCULATE_U_MAX" maxlength="5" value=""></td>
                </tr>
              </table>
            </div>
            </div>
          </div>
        </div>
      </div>
          </div>
          </li>
          <li style="font-size: 14px;">
            นักศึกษาที่ขาดสอบในการวัดผลครั้งสุดท้าย &nbsp;&nbsp;โดยไม่ได้รับอนุญาตให้เลื่อนการสอบตามข้อบังคับ ของมหาวิทยาลัยเชียงใหม่ ว่าด้วยการศึกษาชั้นปริญญาตรี อาจารย์ผู้สอนจะประเมินดังนี้
            <br>
            <div class="form-inline"><div class="form-group"><div class="radio">
            <input type="radio" name="ABSENT" id="ABSENT1" value="F" required checked>&nbsp;ให้ลำดับขั้น F &nbsp;&nbsp; <br>
            <input type="radio" name="ABSENT" id="ABSENT2" value="U" >&nbsp;ให้อักษร U &nbsp;&nbsp;<br>
            <input type="radio" name="ABSENT" id="ABSENT3" value="CAL" >&nbsp;นำคะแนนทั้งหมดที่นักศึกษาได้รับก่อนการสอบไล่มาประเมิน &nbsp;&nbsp;<br>
          </div></div></div>
          </li>

          <br>
          <li style="font-size: 14px;" id="listcor">
            เลือกไฟล์ Course Syllabus (นามสกุลไฟล์ต้องเป็น .doc , .docx หรือ .pdf เท่านั้น) : <br />
          <div class="col-md-10 form-inline form-group">
            <input type="file" class="filestyle" id="syllabus" data-icon="false" accept=".doc,.docx,.pdf" required><font color="red" id="reqq"><b> ** จำเป็น</b></font>
            &nbsp;<span id="spanfile"></span>&nbsp;&nbsp;
            <input id="downloadfile" style="display:none; font-size: 14px;" class="btn btn-outline btn-primary" type="button" value="ดาวน์โหลดไฟล์ Syllabus" onclick="downloadfunc();">
          </div>
          </li>



    </ol>
    <br><br>
    <div id="buttondiv" align="center">
      <input type="submit" style="font-size: 18px;" class="btn btn-outline btn-success" name="submitbtn" id="submitbtn"  value="ยืนยันเพื่อส่งข้อมูล" > &nbsp;
      <input type="button" style="font-size: 18px;" class="btn btn-outline btn-warning" name="draftbtn" id="draftbtn" value="บันทึกข้อมูลชั่วคราว" onclick="checkreq('2')"> &nbsp;
      <!-- <input type="button" style="font-size: 18px;" class="btn btn-outline btn-danger" name="resetbtn" id="resetbtn" onclick="confreset('1');" value="รีเซ็ตข้อมูล"> -->
      <input type="button" style="font-size: 18px;" class="btn btn-outline btn-danger" name="delbtn" id="delbtn" onclick="deletedata();" value="ลบข้อมูล">
    </div>
</form>
</div>
</div>
</div>
  <div id="bottomform" class="panel panel-default">
    <br>
    <ol>
      <form data-toggle="validator" role="form" name="form2" id="form2">
        <font color="red" style="font-size:14px;">** กรุณากรอกรหัสวิชาและค้นหาเพื่ออัพโหลดไฟล์ Course Syllabus **</font>
      <li style="font-size: 14px;"><div class="form-inline form-group"><b>รหัสกระบวนวิชา : </b><input style="width: 100px;" type="text" class="form-control formlength numonly" name="COURSE_ID_2" id="COURSE_ID_2"   maxlength="6" required pattern=".{6,6}" > <input type="button" class="btn btn-outline btn-primary" value="ค้นหา" onclick="checksubject(3,1);"></div></li>
      <div id="formdrpd2" style="display: none;">
        <div class="form-inline">
          <div class="form-group " style="font-size:16px;">
             ดึงข้อมูลย้อนหลัง
            <select class="form-control formlength" id="semester2" name="semester2" style="width: 300px; " >
            </select>
           </div>
           <input type="button" class="btn btn-outline btn-primary" name="subhead2" id="subhead2" value="ยืนยัน" onclick="checksubject(4,1);">
         </div>
       </div>
      <li style="font-size: 14px;">
        <b>เลือกไฟล์ Course Syllabus (นามสกุลไฟล์ต้องเป็น .doc , .docx หรือ .pdf เท่านั้น) : </b><br />
        <div class="row">
        <div class="col-md-5 form-inline form-group">
          <input type="file" class="filestyle" id="syllabus_2" data-icon="false" accept=".doc,.docx,.pdf" required><font color="red" id="reqq2" ><b> ** จำเป็น</b></font>
          &nbsp;<span id="spanfile2"></span>&nbsp;&nbsp;
          <input id="downloadfile2" style="display:none; font-size: 14px;" class="btn btn-outline btn-primary" type="button" value="ดาวน์โหลดไฟล์ Syllabus" onclick="downloadfunc2();">
        </div>
      </div>
      </li>
      <br><br>
      <div align="center">
        <input type="submit" style="font-size: 18px; display:none;" class="btn btn-outline btn-success" name="submitbtn2" id="submitbtn2" value="ยืนยันเพื่อส่งข้อมูล" > &nbsp;
      </div>
    </form>
    </ol>
  </div>
</body>
</html>

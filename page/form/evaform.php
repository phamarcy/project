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
window.countmeabtn = 0;
window.countsa1btn = 0;
window.countsa2btn = 0;

function lecloop() {
  var lec = document.getElementById("leclist");
  var i;
  if (lec.value == 0) {
    for (i = 1; i <= 11; i++) {
      document.getElementById("li" + i).style.display = "none";
      document.getElementById('ctlec' + i).classList.add('hide');
      document.getElementById("TEACHERLEC_F" + i).style.display = "none";
      document.getElementById("TEACHERLEC_L" + i).style.display = "none";
      document.getElementById("TEACHERLEC_F" + i).value = "";
      document.getElementById("TEACHERLEC_L" + i).value = "";
    }
  } else {
    //document.getElementById("test1").innerHTML = lec.value;
    for (i = 1; i <= 11; i++) {
      document.getElementById("li" + i).style.display = "none";
      document.getElementById('ctlec' + i).classList.add('hide');
      document.getElementById('TEACHERLEC_F' + i).style.display = "none";
      document.getElementById("TEACHERLEC_L" + i).style.display = "none";
      if(i>lec.value)
      {
        document.getElementById("TEACHERLEC_F" + i).value = "";
        document.getElementById("TEACHERLEC_L" + i).value = "";
      }
    }

    for (i = 1; i <= lec.value; i++) {
      document.getElementById("li" + i).style.display = "";
      document.getElementById('ctlec' + i).classList.remove('hide');
      document.getElementById('TEACHERLEC_F' + i).style.display = "";
      document.getElementById("TEACHERLEC_L" + i).style.display = "";
    }
  }
}

function labloop() {
  var lab = document.getElementById("lablist");
  var i;
  if (lab.value == 0) {
    for (i = 1; i <= 11; i++) {
      document.getElementById("la" + i).style.display = "none";
      document.getElementById('ctlab' + i).classList.add('hide');
      document.getElementById("TEACHERLAB_F" + i).style.display = "none";
      document.getElementById('TEACHERLAB_L' + i).style.display = "none";
      document.getElementById("TEACHERLAB_F" + i).value = "";
      document.getElementById("TEACHERLAB_L" + i).value = "";
    }
  } else {
    //document.getElementById("test1").innerHTML = lab.value;
    for (i = 1; i <= 11; i++) {
      document.getElementById("la" + i).style.display = "none";
      document.getElementById('ctlab' + i).classList.add('hide');
      document.getElementById('TEACHERLAB_F' + i).style.display = "none";
      document.getElementById('TEACHERLAB_L' + i).style.display = "none";
      if(i>lab.value)
      {
        document.getElementById("TEACHERLAB_F" + i).value = "";
        document.getElementById("TEACHERLAB_L" + i).value = "";
      }

    }

    for (i = 1; i <= lab.value; i++) {
      document.getElementById("la" + i).style.display = "";
      document.getElementById('ctlab' + i).classList.remove('hide');
      document.getElementById('TEACHERLAB_F' + i).style.display = "";
      document.getElementById('TEACHERLAB_L' + i).style.display = "";

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
      document.getElementById('MIDEXCOM_LECL' + i).style.display = "none";
      document.getElementById("MIDEXCOM_LECF" + i).value = "";
      document.getElementById("MIDEXCOM_LECL" + i).value = "";
    }
  } else {
    //document.getElementById("test1").innerHTML = lab.value;
    for (i = 1; i <= 10; i++) {
      document.getElementById("mehle" + i).style.display = "none";
      document.getElementById('mehlec' + i).classList.add('hide');
      document.getElementById('MIDEXCOM_LECF' + i).style.display = "none";
      document.getElementById('MIDEXCOM_LECL' + i).style.display = "none";
      if(i>lec.value)
      {
        document.getElementById("MIDEXCOM_LECF" + i).value = "";
        document.getElementById("MIDEXCOM_LECL" + i).value = "";
      }
    }

    for (i = 1; i <= lec.value; i++) {
      document.getElementById("mehle" + i).style.display = "";
      document.getElementById('mehlec' + i).classList.remove('hide');
      document.getElementById('MIDEXCOM_LECF' + i).style.display = "";
      document.getElementById('MIDEXCOM_LECL' + i).style.display = "";

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
      document.getElementById('MIDEXCOM_LABL' + i).style.display = "none";
      document.getElementById("MIDEXCOM_LABF" + i).value = "";
      document.getElementById("MIDEXCOM_LABL" + i).value = "";
    }
  } else {
    //document.getElementById("test1").innerHTML = lab.value;
    for (i = 1; i <= 10; i++) {
      document.getElementById("ehla" + i).style.display = "none";
      document.getElementById('ehlab' + i).classList.add('hide');
      document.getElementById('MIDEXCOM_LABF' + i).style.display = "none";
      document.getElementById('MIDEXCOM_LABL' + i).style.display = "none";
      if(i>lab.value)
      {
        document.getElementById("MIDEXCOM_LABF" + i).value = "";
        document.getElementById("MIDEXCOM_LABL" + i).value = "";
      }
    }

    for (i = 1; i <= lab.value; i++) {
      document.getElementById("ehla" + i).style.display = "";
      document.getElementById('ehlab' + i).classList.remove('hide');
      document.getElementById('MIDEXCOM_LABF' + i).style.display = "";
      document.getElementById('MIDEXCOM_LABL' + i).style.display = "";

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
      document.getElementById('MIDEXCOM_LECL' + i +"_sec").style.display = "none";
      document.getElementById("MIDEXCOM_LECF" + i +"_sec").value = "";
      document.getElementById("MIDEXCOM_LECL" + i +"_sec").value = "";
    }
  } else {
    //document.getElementById("test1").innerHTML = lab.value;
    for (i = 1; i <= 10; i++) {
      document.getElementById("mehle" + i +"_sec").style.display = "none";
      document.getElementById('mehlec' + i +"_sec").classList.add('hide');
      document.getElementById('MIDEXCOM_LECF' + i +"_sec").style.display = "none";
      document.getElementById('MIDEXCOM_LECL' + i +"_sec").style.display = "none";
      if(i>lec.value)
      {
        document.getElementById("MIDEXCOM_LECF" + i +"_sec").value = "";
        document.getElementById("MIDEXCOM_LECL" + i +"_sec").value = "";
      }
    }

    for (i = 1; i <= lec.value; i++) {
      document.getElementById("mehle" + i +"_sec").style.display = "";
      document.getElementById('mehlec' + i +"_sec").classList.remove('hide');
      document.getElementById('MIDEXCOM_LECF' + i +"_sec").style.display = "";
      document.getElementById('MIDEXCOM_LECL' + i +"_sec").style.display = "";

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
      document.getElementById('MIDEXCOM_LABL' + i +"_sec").style.display = "none";
      document.getElementById("MIDEXCOM_LABF" + i +"_sec").value = "";
      document.getElementById("MIDEXCOM_LABL" + i +"_sec").value = "";
    }
  } else {
    //document.getElementById("test1").innerHTML = lab.value;
    for (i = 1; i <= 10; i++) {
      document.getElementById("ehla" + i +"_sec").style.display = "none";
      document.getElementById('ehlab' + i +"_sec").classList.add('hide');
      document.getElementById('MIDEXCOM_LABF' + i +"_sec").style.display = "none";
      document.getElementById('MIDEXCOM_LABL' + i +"_sec").style.display = "none";
      if(i>lab.value)
      {
        document.getElementById("MIDEXCOM_LABF" + i +"_sec").value = "";
        document.getElementById("MIDEXCOM_LABL" + i +"_sec").value = "";
      }
    }

    for (i = 1; i <= lab.value; i++) {
      document.getElementById("ehla" + i +"_sec").style.display = "";
      document.getElementById('ehlab' + i +"_sec").classList.remove('hide');
      document.getElementById('MIDEXCOM_LABF' + i +"_sec").style.display = "";
      document.getElementById('MIDEXCOM_LABL' + i +"_sec").style.display = "";

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
      document.getElementById('FINEXCOM_LECL' + i).style.display = "none";
      document.getElementById("FINEXCOM_LECF" + i).value = "";
      document.getElementById("FINEXCOM_LECL" + i).value = "";
    }
  } else {
    //document.getElementById("test1").innerHTML = lab.value;
    for (i = 1; i <= 10; i++) {
      document.getElementById("fmehle" + i).style.display = "none";
      document.getElementById('fmehlec' + i).classList.add('hide');
      document.getElementById('FINEXCOM_LECF' + i).style.display = "none";
      document.getElementById('FINEXCOM_LECL' + i).style.display = "none";
      if(i>lec.value)
      {
        document.getElementById("FINEXCOM_LECF" + i).value = "";
        document.getElementById("FINEXCOM_LECL" + i).value = "";
      }

    }

    for (i = 1; i <= lec.value; i++) {
      document.getElementById("fmehle" + i).style.display = "";
      document.getElementById('fmehlec' + i).classList.remove('hide');
      document.getElementById('FINEXCOM_LECF' + i).style.display = "";
      document.getElementById('FINEXCOM_LECL' + i).style.display = "";

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
      document.getElementById('FINEXCOM_LABL' + i).style.display = "none";
      document.getElementById("FINEXCOM_LABF" + i).value = "";
      document.getElementById("FINEXCOM_LABL" + i).value = "";
    }
  } else {
    //document.getElementById("test1").innerHTML = lab.value;
    for (i = 1; i <= 10; i++) {
      document.getElementById("fehla" + i).style.display = "none";
      document.getElementById('fehlab' + i).classList.add('hide');
      document.getElementById('FINEXCOM_LABF' + i).style.display = "none";
      document.getElementById('FINEXCOM_LABL' + i).style.display = "none";
      if(i>lab.value)
      {
        document.getElementById("FINEXCOM_LABF" + i).value = "";
        document.getElementById("FINEXCOM_LABL" + i).value = "";
      }

    }

    for (i = 1; i <= lab.value; i++) {
      document.getElementById("fehla" + i).style.display = "";
      document.getElementById('fehlab' + i).classList.remove('hide');
      document.getElementById('FINEXCOM_LABF' + i).style.display = "";
      document.getElementById('FINEXCOM_LABL' + i).style.display = "";

    }
  }
}

function checksubject(type){
  var file_data = new FormData;
  var id = document.getElementById('id').value;
  JSON.stringify(id);
  JSON.stringify(type);
  file_data.append("id",id);
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
                  if(result==true)
                  {
                     document.getElementById('formdrpd').style.display = "";
                     var temp = $.parseJSON(result);
                     console.log(temp[0]);
                     var selectsm = document.getElementById('semester');
                     var selecty = document.getElementById('year');
                     for (var i = 0; i < temp.length; i++) {
                        var opt = document.createElement('option');
                        opt.value = temp[i].semester;
                        opt.innerHTML = temp[i].semester;
                        selectsm.appendChild(opt);

                        var opt2 = document.createElement('option');
                        opt2.value = temp[i].year;
                        opt2.innerHTML = temp[i].year;
                        selecty.appendChild(opt2);
                     }
                  }
                  else {

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

function submitfunc(casesubmit) {

  //Loop for pack MEASURE
  var count = $('#meastable tr').length;
  var count2 = count-5;
  var cart2 = [];
  var cart3 = {};
  if(count2>0)
  {
    for(var i=1;i<=count2;i++)
    {
      if(document.getElementById("MEASURE_OTHERCOMMENT"+i) == null)
      {
        continue;
      }
      else {
        var cart = {
          'NAME' : document.getElementById("MEASURE_OTHERCOMMENT"+i).value,
          'LEC' : document.getElementById("MEASURE_OTHERLEC"+i).value,
          'LAB' : document.getElementById("MEASURE_OTHERLAB"+i).value
        };
        cart2.push(cart);
      }

    }
    cart3 = cart2;
  }
  /*if(count2>0)
  {
    for(var i=1;i<=count2;i++)
    {
      cart[i-1] =  document.getElementById("MEASURE_OTHERCOMMENT"+i).value;
      cart2[i-1] = document.getElementById("MEASURE_OTHERLEC"+i).value;
      cart3[i-1] = document.getElementById("MEASURE_OTHERLAB"+i).value;
    }

    comment = cart;
    lec = cart2;
    lab = cart3;
  }*/


  //Loop for pack TEACHER
  var teacher_lec = {};
  var teacher_lab = {};
  var tlec = [];
  var tlab = [];

  for(var i=1;i<=document.getElementById("leclist").value;i++)
  {
    tlec[i-1] = document.getElementById("TEACHERLEC_F"+i).value+" "+document.getElementById("TEACHERLEC_L"+i).value;
  }
  for(var i=1;i<=document.getElementById("lablist").value;i++)
  {
    tlab[i-1] = document.getElementById("TEACHERLAB_F"+i).value+" "+document.getElementById("TEACHERLAB_L"+i).value;
  }

  teacher_lec = tlec;
  teacher_lab = tlab;

  //Loop for COMMITTEE
  var commidlec = {};
  var commidlab = {};
  var comfinlec = {};
  var comfinlab = {};
  var cmle = [];
  var cmla = [];
  var cfle = [];
  var cfla = [];

  for(var i=1;i<=document.getElementById("mexholec").value;i++)
  {
    cmle[i-1] = document.getElementById("MIDEXCOM_LECF"+i).value+" "+document.getElementById("MIDEXCOM_LECL"+i).value;
  }
  for(var i=1;i<=document.getElementById("mexholac").value;i++)
  {
    cmla[i-1] = document.getElementById("MIDEXCOM_LABF"+i).value+" "+document.getElementById("MIDEXCOM_LABL"+i).value;
  }
  for(var i=1;i<=document.getElementById("fexholec").value;i++)
  {
    cfle[i-1] = document.getElementById("FINEXCOM_LECF"+i).value+" "+document.getElementById("FINEXCOM_LECL"+i).value;
  }
  for(var i=1;i<=document.getElementById("fexholac").value;i++)
  {
    cfla[i-1] = document.getElementById("FINEXCOM_LABF"+i).value+" "+document.getElementById("FINEXCOM_LABL"+i).value;
  }

  commidlec = cmle;
  commidlab = cmla;
  comfinlec = cfle;
  comfinlab = cfla;

  //Loop for SAMENA with TRAIN
  var carts2 = [];
  var carts3 = {};
  var cartt2 = [];
  var cartt3 = {};
  var countsa = $('#samenatable tr').length;
  var countsa2 = countsa-4;
  var counttr = $('#samenatable2 tr').length;
  var counttr2 = counttr-4;

  if(countsa2>0)
  {
    for(var i=0;i<countsa2;i++)
    {
      if(document.getElementById("SAMEMA_NAME"+i) == null)
      {
        continue;
      }
      else {
        var carts = {
          'NAME' : document.getElementById("SAMEMA_NAME"+i).value,
          'SCORE' : document.getElementById("SAMENA_SCORE"+i).value
        };
        carts2.push(carts);
      }

    }
    carts3 = carts2;

    /*for(var i=0;i<countsa2;i++)
    {
      sn[i] = document.getElementById("SAMEMA_NAME"+i).value;
      ss[i] = document.getElementById("SAMENA_SCORE"+i).value;
    }

    samina_name = sn;
    samina_score = ss;*/
  }

  if(counttr2>0)
  {
    for(var i=0;i<counttr2;i++)
    {
      if(document.getElementById("TRAIN_NAME"+i) == null)
      {
        continue;
      }
      else {
        var cartt = {
          'NAME' : document.getElementById("TRAIN_NAME"+i).value,
          'SCORE' : document.getElementById("TRAIN_SCORE"+i).value
        };
        cartt2.push(cartt);

      }

    }
    cartt3 = cartt2;

    /*for(var i=0;i<counttr2;i++)
    {
      tn[i] =  document.getElementById("TRAIN_NAME"+i).value;
      ts[i] = document.getElementById("TRAIN_SCORE"+i).value;
    }

    train_name = tn;
    train_score = ts;*/
  }

  var data = {
    'COURSE_ID': document.getElementById("COURSE_ID").value,
    'SECTION' : document.getElementById("SECTION").value,
    'NORORSPE' : document.querySelector("input[name='NORORSPE']:checked").value,
    'STUDENT' : document.getElementById("ENROLL").value,
    'CREDIT' : {
      'TOTAL' : document.getElementById("TOTAL").value,
      'LEC' : document.getElementById("LEC").value,
      'LAB' : document.getElementById("LAB").value,
      'SELF' : document.getElementById("SELF").value
    },
    'TYPE_TEACHING' : document.querySelector("input[name='TYPE_TEACHING']:checked").value,
    'TEACHER' : {
      'LEC' : teacher_lec,
      'LAB' : teacher_lab
    },
    'MIDEXAM_HOUR_LEC' : document.getElementById("MIDEXAM_HOUR_LEC").value,
    'EXAM': {
      'MID' : {
        'HOUR' : {
          'LEC' : document.getElementById("MIDEXAM_HOUR_LEC").value,
          'LAB' : document.getElementById("MIDEXAM_HOUR_LAB").value
        },
        'COMMITTEE' : {
          'LEC' : commidlec,
          'LAB' : commidlab
        }
      },
      'FINAL' : {
        'HOUR' : {
          'LEC' : document.getElementById("FINEXAM_HOUR_LEC").value,
          'LAB' : document.getElementById("FINEXAM_HOUR_LAB").value
        },
        'COMMITTEE' : {
          'LEC' : comfinlec,
          'LAB' : comfinlab
        }
      }
    },
    'MEASURE' : {
      'MID' : {
        'LEC' : document.getElementById("MEASURE_MIDLEC").value,
        'LAB' : document.getElementById("MEASURE_MIDLAB").value
      },
      'FINAL' : {
        'LEC' : document.getElementById("MEASURE_FINLEC").value,
        'LAB' : document.getElementById("MEASURE_FINLAB").value
      },
      'TOTAL' : {
        'LEC' : document.getElementById("MEASURE_TOTALLEC").value,
        'LAB' : document.getElementById("MEASURE_TOTALLAB").value
      },
      'OTHER' : cart3,
      'COMMENT' : document.getElementById("suggestion").value
    },
    'SEMINAR' : carts3,
    'TRAIN' : cartt3,
    'EVALUATE' : document.querySelector("input[name='EVALUATE_TYPE']:checked").value,
    'CALCULATE' : {
      'TYPE' : document.querySelector("input[name='CALCULATE']:checked").value,
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
        'MIN' : document.getElementById("CALCULATE_B_MIN").value
      },
      'U' : {
        'MAX' : document.getElementById("CALCULATE_U_MAX").value
      }
    },
    'ABSENT' : document.querySelector("input[name='ABSENT']:checked").value,
    'SUBMIT_TYPE' : casesubmit
  };

  //alert(JSON.stringify(data));
  senddata(JSON.stringify(data),getfile());
}
function senddata(data,file_data)
{

  //prompt("data", data);
   file_data.append("DATA",data);
   var URL = '../../application/test_data.php';
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
    this.value = this.value.replace(/[^a-zA-Zก-ฮๅภถุึคตจขชๆไำพะัีรนยบลฃฟหกดเ้่าสวงผปแอิืทมใฝ๑๒๓๔ู฿๕๖๗๘๙๐ฎฑธํ๊ณฯญฐฅฤฆฏโฌ็๋ษศซฉฮฺ์ฒฬฦ.]/g, ''); //<-- replace all other than given set of values
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
      alert('กรุณาตรวจสอบสัดส่วนการให้คะแนนใหม่อีกครั้ง\nคะแนนรวมของภาคบรรยายและภาคปฏิบัติต้องรวมกันได้ร้อยละ 100');
    }
    else {
      $('#MEASURE_TOTALLEC').val(callec);
      $('#MEASURE_TOTALLAB').val(callab);
    }
  });

});

function deleteRow(r) {
  var i = r;

  var row = document.getElementById('row' + i);
  row.parentNode.removeChild(row);
}


function deleteRow2(r) {
  var i = r;

  var row = document.getElementById('row2' + i);
  row.parentNode.removeChild(row);
}

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
    alert('บันทึกข้อมูลสำเร็จ');
    submitfunc(casesubmit);
  }
  else {

    alert('กรุณากรอกข้อมูลให้ครบถ้วน');
    return false;
  }
}

function checktran() {
  if($("#inputyear").val()!=null && $("#inputyear").val()!="" && $("#semester").val()!=null && $("#semester").val()!="" && $("#inputsubject").val()!=null && $("inputsubject").val()!="")
  {
    alert('ตรวจพบข้อมูล');
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
               <button type="button" class="btn btn-outline btn-primary" onclick="checksubject(1);">ค้นหา</button>
       </div>
    </form>

  <form id="formdrpd" data-toggle="validator" role="form" style="display: none;">
    <div class="form-inline">
      <div class="form-group " style="font-size:16px;">
         ภาคการศึกษา
        <select class="form-control required" id="semester" style="width: 70px;" required >
        </select>
       </div>
       <div class="form-group " style="font-size:16px;">
         ปีการศึกษา
         <select class="form-control required" id="year" style="width: 90px;" required >
         </select>
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
            &nbsp;ตอนที่ &nbsp;<input style="width: 70px;"type="text" class="form-control numonly" name="SECTION" id="SECTION" size="2" maxlength="2" required pattern=".{1,2}" >
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
            <div class=" form-group">&nbsp;&nbsp;&nbsp;&nbsp;จำนวนนักศึกษาที่ลงทะเบียนเรียน &nbsp;<input style="width: 70px" type="text" class="form-control numonly" name="ENROLL" id="ENROLL" size="2" maxlength="3" pattern=".{1,3}" required> &nbsp; คน </div>
            <div class=" form-group">&nbsp;&nbsp;&nbsp;&nbsp;จำนวนหน่วยกิตทั้งหมด &nbsp;<input type="text" class="form-control" name="TOTAL" id="TOTAL" size="5" maxlength="10" required pattern=".{8,10}" >&nbsp; หน่วยกิต</div>
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
      <li style="font-size: 14px">
        <div class="form-inline">
          <div id="text"><b>อาจารย์ผู้รับผิดชอบกระบวนวิชา</b>
          </div>
        </div>

        <div class="form-inline" id="ctlec1">
          <label id="li1">1. &nbsp;</label>
          <input type="text" class="form-control charonly" name="TEACHERLEC_F1" id="TEACHERLEC_F1" placeholder="ชื่อ" size="20" >
          <input type="text" class="form-control charonly" name="TEACHERLEC_L1" id="TEACHERLEC_L1" placeholder="นามสกุล" size="20" >
        </div>

        <div class="form-inline" id="ctlec2">
          <label id="li2">2. &nbsp;</label>
          <input type="text" class="form-control charonly" name="TEACHERLEC_F2" id="TEACHERLEC_F2" placeholder="ชื่อ" size="20" >
          <input type="text" class="form-control charonly" name="TEACHERLEC_L2" id="TEACHERLEC_L2" placeholder="นามสกุล" size="20" >
        </div>

        <div class="form-inline" id="ctlec3">
          <label id="li3">3. &nbsp;</label>
          <input type="text" class="form-control charonly" name="TEACHERLEC_F3" id="TEACHERLEC_F3" placeholder="ชื่อ" size="20" >
          <input type="text" class="form-control charonly" name="TEACHERLEC_L3" id="TEACHERLEC_L3" placeholder="นามสกุล" size="20" >
        </div>
        <div class="form-inline" id="ctlec4">
          <label id="li4">4. &nbsp;</label>
          <input type="text" class="form-control charonly" name="TEACHERLEC_F4" id="TEACHERLEC_F4" placeholder="ชื่อ" size="20" >
          <input type="text" class="form-control charonly" name="TEACHERLEC_L4" id="TEACHERLEC_L4" placeholder="นามสกุล" size="20" >
        </div>
        <div class="form-inline" id="ctlec5">
          <label id="li5">5. &nbsp;</label>
          <input type="text" class="form-control charonly" name="TEACHERLEC_F5" id="TEACHERLEC_F5" placeholder="ชื่อ" size="20" >
          <input type="text" class="form-control charonly" name="TEACHERLEC_L5" id="TEACHERLEC_L5" placeholder="นามสกุล" size="20" >
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
                <td><div class="form-group"><input type="text" class="form-control numonly" name="MEASURE_MIDLEC1" id="MEASURE_MIDLEC1" size="2"></div></td>
                <td><div class="form-group"><input type="text" class="form-control numonly" name="MEASURE_MIDLAB1" id="MEASURE_MIDLAB1" size="2"></div></td>
              </tr>
              <tr>
                <td colspan="2">2. สอบกลางภาคฯครั้งที่ 2</td>
                <td><div class="form-group"><input type="text" class="form-control numonly" name="MEASURE_MIDLEC2" id="MEASURE_MIDLEC2" size="2"></div></td>
                <td><div class="form-group"><input type="text" class="form-control numonly" name="MEASURE_MIDLAB2" id="MEASURE_MIDLAB2" size="2"></div></td>
              </tr>
              <tr>
                <td colspan="2">3. สอบไล่ </td>
                <td><div class="form-group"><input type="text" class="form-control numonly" name="MEASURE_FINLEC" id="MEASURE_FINLEC" size="2"></div></td>
                <td><div class="form-group"><input type="text" class="form-control numonly" name="MEASURE_FINLAB" id="MEASURE_FINLAB" size="2"></div></td>
              </tr>
              <tr>
                <td colspan="2">4. งานมอบหมาย </td>
                <td><div class="form-group"><input type="text" class="form-control numonly" name="MEASURE_WORKLEC" id="MEASURE_WORKLEC" size="2"></div></td>
                <td><div class="form-group"><input type="text" class="form-control numonly" name="MEASURE_WORKLAB" id="MEASURE_WORKLAB" size="2"></div></td>
              </tr>
              <tr name="addtr">

                <td colspan="2"><div class="form-group form-inline">5. อื่นๆ โปรดระบุ &nbsp;&nbsp;<input type="text" class="form-control" name="OTHER_MEA" id="OTHER_MEA" size="30"></div></td>
                <td><div class="form-group"><input type="text" class="form-control numonly" name="MEASURE_OTHLEC" id="MEASURE_OTHLEC" size="2"></div></td>
                <td><div class="form-group"><input type="text" class="form-control numonly" name="MEASURE_OTHLAB" id="MEASURE_OTHLAB" size="2"></div></td>
              </tr>
              <tr>
                <td colspan="2" align="right"><input type="button" class="btn btn-outline btn-warning" name="calmea" id="calmea" value="รวมคะแนน"></td>
                <td><div class="form-group"><input type="text" class="form-control numonly" name="MEASURE_TOTALLEC" id="MEASURE_TOTALLEC" size="2"></div></td>
                <td><div class="form-group"><input type="text" class="form-control numonly" name="MEASURE_TOTALLAB" id="MEASURE_TOTALLAB" size="2"></div></td>
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


                      <div class="form-inline hide" id="mehlec1">
                        <label id="mehle1" style="display:none;">1.&nbsp; </label>
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECF1" id="MIDEXCOM_LECF1" placeholder="ชื่อ" size="20" >
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECL1" id="MIDEXCOM_LECL1" placeholder="นามสกุล" size="20" >
                      </div>

                      <div class="form-inline hide" id="mehlec2">
                        <label id="mehle2" style="display:none;">2.&nbsp; </label>
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECF2" id="MIDEXCOM_LECF2" placeholder="ชื่อ" size="20" >
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECL2" id="MIDEXCOM_LECL2" placeholder="นามสกุล" size="20" >
                      </div>

                      <div class="form-inline hide" id="mehlec3">
                        <label id="mehle3" style="display:none;">3.&nbsp; </label>
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECF3" id="MIDEXCOM_LECF3" placeholder="ชื่อ" size="20" >
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECL3" id="MIDEXCOM_LECL3" placeholder="นามสกุล" size="20" >
                      </div>

                      <div class="form-inline hide" id="mehlec4">
                        <label id="mehle4" style="display:none;">4.&nbsp; </label>
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECF4" id="MIDEXCOM_LECF4" placeholder="ชื่อ" size="20" >
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECL4" id="MIDEXCOM_LECL4" placeholder="นามสกุล" size="20" >
                      </div>

                      <div class="form-inline hide" id="mehlec5">
                        <label id="mehle5" style="display:none;">5.&nbsp; </label>
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECF5" id="MIDEXCOM_LECF5" placeholder="ชื่อ" size="20" >
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECL5" id="MIDEXCOM_LECL5" placeholder="นามสกุล" size="20" >
                      </div>

                      <div class="form-inline hide" id="mehlec6">
                        <label id="mehle6" style="display:none;">1.&nbsp; </label>
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECF6" id="MIDEXCOM_LECF6" placeholder="ชื่อ" size="20" >
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECL6" id="MIDEXCOM_LECL6" placeholder="นามสกุล" size="20" >
                      </div>

                      <div class="form-inline hide" id="mehlec7">
                        <label id="mehle7" style="display:none;">7.&nbsp; </label>
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECF7" id="MIDEXCOM_LECF7" placeholder="ชื่อ" size="20" >
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECL7" id="MIDEXCOM_LECL7" placeholder="นามสกุล" size="20" >
                      </div>

                      <div class="form-inline hide" id="mehlec8">
                        <label id="mehle8" style="display:none;">8.&nbsp; </label>
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECF8" id="MIDEXCOM_LECF8" placeholder="ชื่อ" size="20" >
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECL8" id="MIDEXCOM_LECL8" placeholder="นามสกุล" size="20" >
                      </div>

                      <div class="form-inline hide" id="mehlec9">
                        <label id="mehle9" style="display:none;">9.&nbsp; </label>
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECF9" id="MIDEXCOM_LECF9" placeholder="ชื่อ" size="20" >
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECL9" id="MIDEXCOM_LECL9" placeholder="นามสกุล" size="20" >
                      </div>

                      <div class="form-inline hide" id="mehlec10">
                        <label id="mehle10" style="display:none;">10.&nbsp; </label>
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECF10" id="MIDEXCOM_LECF10" placeholder="ชื่อ" size="20" >
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECL10" id="MIDEXCOM_LECL10" placeholder="นามสกุล" size="20" >
                      </div>


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


                          <div class="form-inline hide" id="ehlab1">
                            <label id="ehla1" style="display:none;">1.&nbsp; </label>
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABF1" id="MIDEXCOM_LABF1" placeholder="ชื่อ" size="20">
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABL1" id="MIDEXCOM_LABL1" placeholder="นามสกุล" size="20">
                          </div>

                          <div class="form-inline hide" id="ehlab2">
                            <label id="ehla2" style="display:none;">2.&nbsp; </label>
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABF2" id="MIDEXCOM_LABF2" placeholder="ชื่อ" size="20">
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABL2" id="MIDEXCOM_LABL2" placeholder="นามสกุล" size="20">
                          </div>

                          <div class="form-inline hide" id="ehlab3">
                            <label id="ehla3" style="display:none;">3.&nbsp; </label>
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABF3" id="MIDEXCOM_LABF3" placeholder="ชื่อ" size="20">
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABL3" id="MIDEXCOM_LABL3" placeholder="นามสกุล" size="20">
                          </div>

                          <div class="form-inline hide" id="ehlab4">
                            <label id="ehla4" style="display:none;">4.&nbsp; </label>
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABF4" id="MIDEXCOM_LABF4" placeholder="ชื่อ" size="20">
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABL4" id="MIDEXCOM_LABL4" placeholder="นามสกุล" size="20">
                          </div>

                          <div class="form-inline hide" id="ehlab5">
                            <label id="ehla5" style="display:none;">5.&nbsp; </label>
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABF5" id="MIDEXCOM_LABF5" placeholder="ชื่อ" size="20">
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABL5" id="MIDEXCOM_LABL5" placeholder="นามสกุล" size="20">
                          </div>

                          <div class="form-inline hide" id="ehlab6">
                            <label id="ehla6" style="display:none;">6.&nbsp; </label>
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABF6" id="MIDEXCOM_LABF6" placeholder="ชื่อ" size="20">
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABL6" id="MIDEXCOM_LABL6" placeholder="นามสกุล" size="20">
                          </div>

                          <div class="form-inline hide" id="ehlab7">
                            <label id="ehla7" style="display:none;">7.&nbsp; </label>
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABF7" id="MIDEXCOM_LABF7" placeholder="ชื่อ" size="20">
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABL7" id="MIDEXCOM_LABL7" placeholder="นามสกุล" size="20">
                          </div>

                          <div class="form-inline hide" id="ehlab8">
                            <label id="ehla8" style="display:none;">8.&nbsp; </label>
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABF8" id="MIDEXCOM_LABF8" placeholder="ชื่อ" size="20">
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABL8" id="MIDEXCOM_LABL8" placeholder="นามสกุล" size="20">
                          </div>

                          <div class="form-inline hide" id="ehlab9">
                            <label id="ehla9" style="display:none;">9.&nbsp; </label>
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABF9" id="MIDEXCOM_LABF9" placeholder="ชื่อ" size="20">
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABL9" id="MIDEXCOM_LABL9" placeholder="นามสกุล" size="20">
                          </div>

                          <div class="form-inline hide" id="ehlab10">
                            <label id="ehla10" style="display:none;">10.&nbsp; </label>
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABF10" id="MIDEXCOM_LABF10" placeholder="ชื่อ" size="20">
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABL10" id="MIDEXCOM_LABL10" placeholder="นามสกุล" size="20">
                          </div>
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


                      <div class="form-inline hide" id="mehlec1_sec">
                        <label id="mehle1_sec" style="display:none;">1.&nbsp; </label>
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECF1_sec" id="MIDEXCOM_LECF1_sec" placeholder="ชื่อ" size="20" >
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECL1_sec" id="MIDEXCOM_LECL1_sec" placeholder="นามสกุล" size="20" >
                      </div>

                      <div class="form-inline hide" id="mehlec2_sec">
                        <label id="mehle2_sec" style="display:none;">2.&nbsp; </label>
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECF2_sec" id="MIDEXCOM_LECF2_sec" placeholder="ชื่อ" size="20" >
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECL2_sec" id="MIDEXCOM_LECL2_sec" placeholder="นามสกุล" size="20" >
                      </div>

                      <div class="form-inline hide" id="mehlec3_sec">
                        <label id="mehle3_sec" style="display:none;">3.&nbsp; </label>
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECF3_sec" id="MIDEXCOM_LECF3_sec" placeholder="ชื่อ" size="20" >
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECL3_sec" id="MIDEXCOM_LECL3_sec" placeholder="นามสกุล" size="20" >
                      </div>

                      <div class="form-inline hide" id="mehlec4_sec">
                        <label id="mehle4_sec" style="display:none;">4.&nbsp; </label>
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECF4_sec" id="MIDEXCOM_LECF4_sec" placeholder="ชื่อ" size="20" >
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECL4_sec" id="MIDEXCOM_LECL4_sec" placeholder="นามสกุล" size="20" >
                      </div>

                      <div class="form-inline hide" id="mehlec5_sec">
                        <label id="mehle5_sec" style="display:none;">5.&nbsp; </label>
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECF5_sec" id="MIDEXCOM_LECF5_sec" placeholder="ชื่อ" size="20" >
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECL5_sec" id="MIDEXCOM_LECL5_sec" placeholder="นามสกุล" size="20" >
                      </div>

                      <div class="form-inline hide" id="mehlec6_sec">
                        <label id="mehle6_sec" style="display:none;">1.&nbsp; </label>
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECF6_sec" id="MIDEXCOM_LECF6_sec" placeholder="ชื่อ" size="20" >
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECL6_sec" id="MIDEXCOM_LECL6_sec" placeholder="นามสกุล" size="20" >
                      </div>

                      <div class="form-inline hide" id="mehlec7_sec">
                        <label id="mehle7_sec" style="display:none;">7.&nbsp; </label>
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECF7_sec" id="MIDEXCOM_LECF7_sec" placeholder="ชื่อ" size="20" >
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECL7_sec" id="MIDEXCOM_LECL7_sec" placeholder="นามสกุล" size="20" >
                      </div>

                      <div class="form-inline hide" id="mehlec8_sec">
                        <label id="mehle8_sec" style="display:none;">8.&nbsp; </label>
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECF8_sec" id="MIDEXCOM_LECF8_sec" placeholder="ชื่อ" size="20" >
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECL8_sec" id="MIDEXCOM_LECL8_sec" placeholder="นามสกุล" size="20" >
                      </div>

                      <div class="form-inline hide" id="mehlec9_sec">
                        <label id="mehle9_sec" style="display:none;">9.&nbsp; </label>
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECF9_sec" id="MIDEXCOM_LECF9_sec" placeholder="ชื่อ" size="20" >
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECL9_sec" id="MIDEXCOM_LECL9_sec" placeholder="นามสกุล" size="20" >
                      </div>

                      <div class="form-inline hide" id="mehlec10_sec">
                        <label id="mehle10_sec" style="display:none;">10.&nbsp; </label>
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECF10_sec" id="MIDEXCOM_LECF10_sec" placeholder="ชื่อ" size="20" >
                        <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LECL10_sec" id="MIDEXCOM_LECL10_sec" placeholder="นามสกุล" size="20" >
                      </div>


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


                          <div class="form-inline hide" id="ehlab1_sec">
                            <label id="ehla1_sec" style="display:none;">1.&nbsp; </label>
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABF1_sec" id="MIDEXCOM_LABF1_sec" placeholder="ชื่อ" size="20">
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABL1_sec" id="MIDEXCOM_LABL1_sec" placeholder="นามสกุล" size="20">
                          </div>

                          <div class="form-inline hide" id="ehlab2_sec">
                            <label id="ehla2_sec" style="display:none;">2.&nbsp; </label>
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABF2_sec" id="MIDEXCOM_LABF2_sec" placeholder="ชื่อ" size="20">
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABL2_sec" id="MIDEXCOM_LABL2_sec" placeholder="นามสกุล" size="20">
                          </div>

                          <div class="form-inline hide" id="ehlab3_sec">
                            <label id="ehla3_sec" style="display:none;">3.&nbsp; </label>
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABF3_sec" id="MIDEXCOM_LABF3_sec" placeholder="ชื่อ" size="20">
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABL3_sec" id="MIDEXCOM_LABL3_sec" placeholder="นามสกุล" size="20">
                          </div>

                          <div class="form-inline hide" id="ehlab4_sec">
                            <label id="ehla4_sec" style="display:none;">4.&nbsp; </label>
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABF4_sec" id="MIDEXCOM_LABF4_sec" placeholder="ชื่อ" size="20">
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABL4_sec" id="MIDEXCOM_LABL4_sec" placeholder="นามสกุล" size="20">
                          </div>

                          <div class="form-inline hide" id="ehlab5_sec">
                            <label id="ehla5_sec" style="display:none;">5.&nbsp; </label>
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABF5_sec" id="MIDEXCOM_LABF5_sec" placeholder="ชื่อ" size="20">
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABL5_sec" id="MIDEXCOM_LABL5_sec" placeholder="นามสกุล" size="20">
                          </div>

                          <div class="form-inline hide" id="ehlab6_sec">
                            <label id="ehla6_sec" style="display:none;">6.&nbsp; </label>
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABF6_sec" id="MIDEXCOM_LABF6_sec" placeholder="ชื่อ" size="20">
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABL6_sec" id="MIDEXCOM_LABL6_sec" placeholder="นามสกุล" size="20">
                          </div>

                          <div class="form-inline hide" id="ehlab7_sec">
                            <label id="ehla7_sec" style="display:none;">7.&nbsp; </label>
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABF7_sec" id="MIDEXCOM_LABF7_sec" placeholder="ชื่อ" size="20">
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABL7_sec" id="MIDEXCOM_LABL7_sec" placeholder="นามสกุล" size="20">
                          </div>

                          <div class="form-inline hide" id="ehlab8_sec">
                            <label id="ehla8_sec" style="display:none;">8.&nbsp; </label>
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABF8_sec" id="MIDEXCOM_LABF8_sec" placeholder="ชื่อ" size="20">
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABL8_sec" id="MIDEXCOM_LABL8_sec" placeholder="นามสกุล" size="20">
                          </div>

                          <div class="form-inline hide" id="ehlab9_sec">
                            <label id="ehla9_sec" style="display:none;">9.&nbsp; </label>
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABF9_sec" id="MIDEXCOM_LABF9_sec" placeholder="ชื่อ" size="20">
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABL9_sec" id="MIDEXCOM_LABL9_sec" placeholder="นามสกุล" size="20">
                          </div>

                          <div class="form-inline hide" id="ehlab10_sec">
                            <label id="ehla10_sec" style="display:none;">10.&nbsp; </label>
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABF10_sec" id="MIDEXCOM_LABF10_sec" placeholder="ชื่อ" size="20">
                            <input type="text" style="display:none;" class="form-control charonly" name="MIDEXCOM_LABL10_sec" id="MIDEXCOM_LABL10_sec" placeholder="นามสกุล" size="20">
                          </div>
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


                        <div class="form-inline hide" id="fmehlec1">
                          <label id="fmehle1" style="display:none;">1.&nbsp; </label>
                          <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LECF1" id="FINEXCOM_LECF1" placeholder="ชื่อ" size="20" >
                          <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LECL1" id="FINEXCOM_LECL1" placeholder="นามสกุล" size="20" >
                        </div>

                        <div class="form-inline hide" id="fmehlec2">
                          <label id="fmehle2" style="display:none;">2.&nbsp; </label>
                          <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LECF2" id="FINEXCOM_LECF2" placeholder="ชื่อ" size="20" >
                          <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LECL2" id="FINEXCOM_LECL2" placeholder="นามสกุล" size="20" >
                        </div>

                        <div class="form-inline hide" id="fmehlec3">
                          <label id="fmehle3" style="display:none;">3.&nbsp; </label>
                          <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LECF3" id="FINEXCOM_LECF3" placeholder="ชื่อ" size="20" >
                          <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LECL3" id="FINEXCOM_LECL3" placeholder="นามสกุล" size="20" >
                        </div>

                        <div class="form-inline hide" id="fmehlec4">
                          <label id="fmehle4" style="display:none;">4.&nbsp; </label>
                          <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LECF4" id="FINEXCOM_LECF4" placeholder="ชื่อ" size="20" >
                          <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LECL4" id="FINEXCOM_LECL4" placeholder="นามสกุล" size="20" >
                        </div>

                        <div class="form-inline hide" id="fmehlec5">
                          <label id="fmehle5" style="display:none;">5.&nbsp; </label>
                          <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LECF5" id="FINEXCOM_LECF5" placeholder="ชื่อ" size="20" >
                          <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LECL5" id="FINEXCOM_LECL5" placeholder="นามสกุล" size="20" >
                        </div>

                        <div class="form-inline hide" id="fmehlec6">
                          <label id="fmehle6" style="display:none;">6.&nbsp; </label>
                          <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LECF6" id="FINEXCOM_LECF6" placeholder="ชื่อ" size="20" >
                          <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LECL6" id="FINEXCOM_LECL6" placeholder="นามสกุล" size="20" >
                        </div>

                        <div class="form-inline hide" id="fmehlec7">
                          <label id="fmehle7" style="display:none;">7.&nbsp; </label>
                          <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LECF7" id="FINEXCOM_LECF7" placeholder="ชื่อ" size="20" >
                          <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LECL7" id="FINEXCOM_LECL7" placeholder="นามสกุล" size="20" >
                        </div>

                        <div class="form-inline hide" id="fmehlec8">
                          <label id="fmehle8" style="display:none;">8.&nbsp; </label>
                          <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LECF8" id="FINEXCOM_LECF8" placeholder="ชื่อ" size="20" >
                          <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LECL8" id="FINEXCOM_LECL8" placeholder="นามสกุล" size="20" >
                        </div>

                        <div class="form-inline hide" id="fmehlec9">
                          <label id="fmehle9" style="display:none;">9.&nbsp; </label>
                          <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LECF9" id="FINEXCOM_LECF9" placeholder="ชื่อ" size="20" >
                          <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LECL9" id="FINEXCOM_LECL9" placeholder="นามสกุล" size="20" >
                        </div>

                        <div class="form-inline hide" id="fmehlec10">
                          <label id="fmehle10" style="display:none;">10.&nbsp; </label>
                          <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LECF10" id="FINEXCOM_LECF10" placeholder="ชื่อ" size="20" >
                          <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LECL10" id="FINEXCOM_LECL10" placeholder="นามสกุล" size="20" >
                        </div>



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


                            <div class="form-inline hide" id="fehlab1">
                              <label id="fehla1" style="display:none;">1.&nbsp; </label>
                              <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LABF1" id="FINEXCOM_LABF1" placeholder="ชื่อ" size="20" >
                              <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LABL1" id="FINEXCOM_LABL1" placeholder="นามสกุล" size="20" >
                            </div>

                            <div class="form-inline hide" id="fehlab2">
                              <label id="fehla2" style="display:none;">2.&nbsp; </label>
                              <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LABF2" id="FINEXCOM_LABF2" placeholder="ชื่อ" size="20" >
                              <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LABL2" id="FINEXCOM_LABL2" placeholder="นามสกุล" size="20" >
                            </div>

                            <div class="form-inline hide" id="fehlab3">
                              <label id="fehla3" style="display:none;">3.&nbsp; </label>
                              <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LABF3" id="FINEXCOM_LABF3" placeholder="ชื่อ" size="20" >
                              <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LABL3" id="FINEXCOM_LABL3" placeholder="นามสกุล" size="20" >
                            </div>

                            <div class="form-inline hide" id="fehlab4">
                              <label id="fehla4" style="display:none;">4.&nbsp; </label>
                              <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LABF4" id="FINEXCOM_LABF4" placeholder="ชื่อ" size="20" >
                              <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LABL4" id="FINEXCOM_LABL4" placeholder="นามสกุล" size="20" >
                            </div>

                            <div class="form-inline hide" id="fehlab5">
                              <label id="fehla5" style="display:none;">5.&nbsp; </label>
                              <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LABF5" id="FINEXCOM_LABF5" placeholder="ชื่อ" size="20" >
                              <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LABL5" id="FINEXCOM_LABL5" placeholder="นามสกุล" size="20" >
                            </div>

                            <div class="form-inline hide" id="fehlab6">
                              <label id="fehla6" style="display:none;">6.&nbsp; </label>
                              <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LABF6" id="FINEXCOM_LABF6" placeholder="ชื่อ" size="20" >
                              <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LABL6" id="FINEXCOM_LABL6" placeholder="นามสกุล" size="20" >
                            </div>

                            <div class="form-inline hide" id="fehlab7">
                              <label id="fehla7" style="display:none;">7.&nbsp; </label>
                              <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LABF7" id="FINEXCOM_LABF7" placeholder="ชื่อ" size="20" >
                              <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LABL7" id="FINEXCOM_LABL7" placeholder="นามสกุล" size="20" >
                            </div>

                            <div class="form-inline hide" id="fehlab8">
                              <label id="fehla8" style="display:none;">8.&nbsp; </label>
                              <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LABF8" id="FINEXCOM_LABF8" placeholder="ชื่อ" size="20" >
                              <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LABL8" id="FINEXCOM_LABL8" placeholder="นามสกุล" size="20" >
                            </div>

                            <div class="form-inline hide" id="fehlab9">
                              <label id="fehla9" style="display:none;">9.&nbsp; </label>
                              <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LABF9" id="FINEXCOM_LABF9" placeholder="ชื่อ" size="20" >
                              <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LABL9" id="FINEXCOM_LABL9" placeholder="นามสกุล" size="20" >
                            </div>

                            <div class="form-inline hide" id="fehlab10">
                              <label id="fehla10" style="display:none;">10.&nbsp; </label>
                              <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LABF10" id="FINEXCOM_LABF10" placeholder="ชื่อ" size="20" >
                              <input type="text" style="display:none;" class="form-control charonly" name="FINEXCOM_LABL10" id="FINEXCOM_LABL10" placeholder="นามสกุล" size="20" >
                            </div>
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

          <br>
          <li style="font-size: 14px;">
            <b>เลือกไฟล์ Course Syllabus (นามสกุลไฟล์ต้องเป็นไฟล์จากโปรแกรม Microsoft Word (.doc หรือ .docx) เท่านั้น) : </b><br />
          <div class="col-md-3 form-group">
            <input type="file" class="filestyle" id="syllabus" data-icon="false" accept=".doc,.docx" required>
          </div>
          </li>



    </ol>
    <br><br>
    <div align="center">
      <input type="submit" style="font-size: 18px;" class="btn btn-outline btn-success" name="submitbtn" id="submitbtn" onclick="checkreq('1')" value="ยืนยันเพื่อส่งข้อมูล" > &nbsp;
      <input type="button" style="font-size: 18px;" class="btn btn-outline btn-warning" name="draftbtn" id="draftbtn" value="บันทึกข้อมูลชั่วคราว" onclick="checkreq('2')"> &nbsp;
      <input type="reset" style="font-size: 18px;" class="btn btn-outline btn-danger" name="resetbtn" id="resetbtn" onclick="confreset();" value="รีเซ็ตข้อมูล">
    </div>
</form>
</div>
</div>
</div>
</body>
</html>

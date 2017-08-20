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

 $(document).ready(function(){

   // manage required form
   $("#GOV_LEVEL").prop('required',true);
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
          }
          else
          {
            $("#AIR_DEPART").prop('required',false);
            $("#AIR_ARRIVE").prop('required',false);
            $("#planecost").prop('required',false);
            $("#AIR_DEPART").val("");
            $("#AIR_ARRIVE").val("");
            $("#planecost").val("");
          }
      });

      $('#transtaxi').click(function(){
         if (this.checked) {
             $("#TAXI_DEPART").prop('required',true);
             $("#TAXI_ARRIVE").prop('required',true);
             $("#taxicost").prop('required',true);
         }
         else
         {
           $("#TAXI_DEPART").prop('required',false);
           $("#TAXI_ARRIVE").prop('required',false);
           $("#taxicost").prop('required',false);
           $("#TAXI_DEPART").val("");
           $("#TAXI_ARRIVE").val("");
           $("#taxicost").val("");
         }
     });

     $('#transselfcar').click(function(){
        if (this.checked) {
            $("#SELF_DISTANCT").prop('required',true);
        }
        else
        {
          $("#SELF_DISTANCT").prop('required',false);
          $("#SELF_DISTANCT").val("");
        }
    });

    // CALCULATE

    $("input[name='costspec']").change(function(){
      if($(this).val()=="choice1")
      {
        $('#choice1hour').val("");
        $('#choice1cost').val("");
        $('#choice2hour').val("");
        $('#choice2cost').val("");
        $('#choice1hour').keyup(function(){
            var textone;
            var texttwo;
            textone = parseFloat($('#choice1hour').val());
            var result = textone*400;
            $('#choice1cost').val(result.toFixed(2));
        });
      }
      else
      {
        $('#choice1hour').val("");
        $('#choice1cost').val("");
        $('#choice2hour').val("");
        $('#choice2cost').val("");
        $('#choice2hour').keyup(function(){
            var textone;
            var texttwo;
            textone = parseFloat($('#choice2hour').val());
            var result = textone*200;
            $('#choice2cost').val(result.toFixed(2));
        });
      }
      });





    $('#SELF_DISTANCT').keyup(function(){
        var textone;
        var texttwo;
        textone = parseFloat($('#SELF_DISTANCT').val());
        var result = textone*5.00 ;
        $('#selfcost').val(result.toFixed(2));
    });


    $("input[name='hotelchoice']").change(function(){
      if($(this).val()=="way1")
      {
        $('#numnight').val("");
        $('#pernight').val("");
        $('#numnight').prop('required',true);
        $('#numnight').keyup(function(){
            var textone;
            var texttwo;
            textone = parseFloat($('#numnight').val());
            var result = textone*1500;
            $('#pernight').val(result.toFixed(2));
        });
      }
      else if($(this).val()=="way2")
      {
        $('#numnight').val("");
        $('#pernight').val("");
        $('#numnight').prop('required',true);
        $('#numnight').keyup(function(){
            var textone;
            var texttwo;
            textone = parseFloat($('#numnight').val());
            var result = textone*800;
            $('#pernight').val(result.toFixed(2));
        });
      }
      else {
        $('#numnight').prop('required',false);
      }

      });

      // callist

      $("#callist").hide();


   $('#adddetail').click(function() {
     var table = $(this).closest('table');
     if (table.find('input:text').length < 100) {
       $('#delbtn').removeAttr("disabled");
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

  function checkreq() {
    if($("[required]").val()!=null && $("[required]").val()!="")
    {
      alert('บันทึกข้อมูลสำเร็จ');
      submitfunc();
    }
    else {
      alert('กรุณากรอกข้อมูลให้ครบถ้วน');
      return false;
    }
  }

  function checktran() {
    if($("#inputfname").val()!=null && $("#inputfname").val()!="" &&
      $("#inputlname").val()!=null && $("#inputlname").val()!="" &&
      $("#inputyear").val()!=null && $("#inputyear").val()!="" &&
      $("#semester").val()!=null && $("#semester").val()!="" &&
      $("#inputsubject").val()!=null && $("inputsubject").val()!="")
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

  function confreset() {
      confirm("ต้องการรีเซ็ตข้อมูลทั้งหมดหรือไม่");
  }

 </script>

</header>
<body class="mybox">
<div id="wrapper" style="padding-left: 30px; padding-right: 30px;">
  <div class="row">
    <center>
      <h3 class="page-header">แบบขออนุมัติเชิญอาจารย์พิเศษ คณะเภสัชศาสตร์</h3>
      <form data-toggle="validator" role="form">
        <div class="form-inline" style="font-size:16px;">
                  <div class="form-group">
                    ชื่อ
                     <input type="text" class="form-control charonly" id="inputfname" size="10" placeholder="e.g. สมชาย" maxlength="70"  required >
                  </div>
                  <div class="form-group">
                    นามสกุล
                     <input type="text" class="form-control charonly" id="inputlname" size="10" placeholder="e.g. ชื่นเสมอ" maxlength="70"  required >
                  </div>
                  <div class="form-group">
                    รหัสกระบวนวิชา
                     <input type="text" class="form-control numonly" id="inputsubject" size="7" placeholder="e.g. 204111" maxlength="6"  required >
                  </div>
                 <div class="form-group">
                    ภาคการศึกษา
                     <select class="form-control required" id="semester" style="width: 70px;" id="select" required >
                        <option value="">--</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                     </select>
                 </div>
                 <div class="form-group">
                   ปีการศึกษา
                   <input type="text" class="form-control numonly" id="inputyear" size="7" placeholder="e.g. 2560" maxlength="4" required >
                 </div>
                <button type="submit" class="btn btn-outline btn-primary" onclick="checktran();">ค้นหา</button>
         </div>
         </div>
      </form>
      </center>

      <div class="panel panel-default"> <br>
      <form action="" data-toggle="validator" role="form" name="form1" method="post">
      <div class="row form-inline" style="font-size:16px;">
        <center><div class="form-group">
      ภาควิชา
        <select class="form-control required" id="department" style="width: auto;" id="select" required >
         <option value="">--------------</option>
         <option value="1">ภาควิชาวิทยาศาสตร์เภสัชกรรม</option>
         <option value="2">ภาควิชาบริบาลเภสัชกรรม</option>
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
            <li>คำนำหน้า &nbsp;&nbsp;<div class="form-group"><input type="text" class="form-control" id="pre" size="6" required ></div>&nbsp;&nbsp;&nbsp;&nbsp;
              ชื่อ &nbsp;&nbsp;<div class="form-group"><input type="text" class="form-control charonly" id="fname" size="20" required ></div>&nbsp;&nbsp;&nbsp;&nbsp;
            นามสกุล &nbsp;&nbsp;<div class="form-group"><input type="text" class="form-control charonly" id="lname" size="20" required ></div></li>
          </div>

          <div class="form-inline">
            <li>ตำแหน่ง &nbsp;&nbsp;<div class="form-group"><input type="text" class="form-control " id="position" size="35" required ></div></li>
          </div>

          <div class="form-inline">
            <li>คุณวุฒิ/สาขาที่เชี่ยวชาญ &nbsp;&nbsp;<div class="form-group"><input type="text" class="form-control " id="qualification" size="35" required ></div></li>
          </div>
          <br>
          <div class="form-inline">
            <li>สถานที่ทำงาน &nbsp;&nbsp;<br />
              <div class="form-group"><textarea class="form-control" name="workplace" id="workplace" rows="3" cols="60"></textarea></div>
            </li>
          </div>
          <br>
          <div class="form-inline">
            <li>สถานที่ติดต่อ <br>
              <div class="form-group">บ้านเลขที &nbsp;&nbsp;<input type="text" class="form-control" id="contnumber" size="5" maxlength="15" required></div>&nbsp;
              <div class="form-group">ชื่อหมู่บ้าน &nbsp;&nbsp;<input type="text" class="form-control" id="contsubad" size="20" maxlength="100" required></div>&nbsp;
              <div class="form-group">หมู่ที่ &nbsp;&nbsp;<input type="text" class="form-control" id="contsubadnum" size="5" maxlength="3" required></div>&nbsp; <br>
              <div class="form-group">ถนน &nbsp;&nbsp;<input type="text" class="form-control" id="controad" size="20" maxlength="100" required></div>&nbsp;
              <div class="form-group">ซอย &nbsp;&nbsp;<input type="text" class="form-control" id="contsoi" size="20" maxlength="100" ></div>&nbsp; <br>
              <div class="form-group">ตึก/อาคาร &nbsp;&nbsp;<input type="text" class="form-control" id="contbuild" size="20" maxlength="100" ></div>&nbsp;
              <div class="form-group">ชั้น &nbsp;&nbsp;<input type="text" class="form-control" id="contfloor" size="20" maxlength="3" ></div>&nbsp; <br>
              <div class="form-group">ตำบล &nbsp;&nbsp;<input type="text" class="form-control" id="contdistrict1" size="20" maxlength="100" required></div>&nbsp;
              <div class="form-group">อำเภอ &nbsp;&nbsp;<input type="text" class="form-control" id="contdistrict2" size="20" maxlength="100" required></div>&nbsp;<br>
              <div class="form-group">จังหวัด &nbsp;&nbsp;<input type="text" class="form-control" id="contprovince" size="20" maxlength="100" required></div>&nbsp;
              <div class="form-group">รหัสไปรษณีย์ &nbsp;&nbsp;<input type="text" class="form-control" id="contcode" size="6" maxlength="5" required></div>
            </li>
          </div>
          <br>
          <div class="form-inline">
            <li>โทรศัพท์ &nbsp;&nbsp;<div class="form-group"><input type="text" class="form-control numonly" id="tel" size="20" maxlength="10" required ></div>
              &nbsp;ต่อ&nbsp;<input type="text" class="form-control numonly" id="subtel" size="2" maxlength="5"></li>
        </div>

        <div class="form-inline">
          <li>E-mail &nbsp;&nbsp;<div class="form-group"><input style="height: 25px;" type="email" class="form-control" id="qualification" size="45" required ></div></li>
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
                    <input type="radio" name="type_course" id="type_course" value="require" required> &nbsp;บังคับ
                    &nbsp;<input type="radio" name="type_course" id="type_course" value="choose"> &nbsp;เลือก
                    &nbsp;<input type="radio" name="type_course" id="type_course" value="new"> &nbsp;เปิดใหม่
                    &nbsp;<input type="radio" name="type_course" id="type_course" value="old"> &nbsp;เปิดอยู่แล้ว
                  </div></div>
                </li>
              </div>
              <div class="form-inline">
                <li>หัวข้อที่เชิญมาสอน <br>
                    <div class="form-group">
                      <div class="radio">
                      <input type="radio" name="topic" id="topic" value="yet" required> &nbsp;อาจารย์พิเศษยังไม่เคยสอน
                      &nbsp;<input type="radio" name="topic" id="topic" value="already"> &nbsp;อาจารย์พิเศษเคยสอนมาแล้ว
                    </div>
                  </div>
                  </li>
                </li>
              </div>

              <div class="form-inline">
                <li><div class="form-group">จำนวนชั่วโมงของหัวข้อที่เชิญมาสอนคิดเป็นร้อยละ  &nbsp;<input type="text" class="form-control numonly" name="" id="hour" size="3" maxlength="10" required > &nbsp;ของทั้งกระบวนวิชา</div></li>
              </div>
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
            </ul>
          </div>
      </li>
      <li  style="font-size: 14px;;">
        <b>ค่าใช้จ่าย </b>
        <ul>
          <div class="form-inline">
            <li>อาจารย์พิเศษเป็น &nbsp;</li>
            <div class="radio">
              <div class="form-group"><input type="radio"  name="levelteacher" id="levelteacher" value="pro" required>&nbsp;ข้าราชการระดับ &nbsp;<input type="text" class="form-control " name="GOV_LEVEL" id="GOV_LEVEL"/></div>
              <br>
              <div class="form-group"><input type="radio"  name="levelteacher" id="levelteacher" value="norm">&nbsp; บุคคลเอกชนเทียบตำแหน่งระดับ &nbsp;<input type="text" class="form-control " name="NORM_LEVEL" id="NORM_LEVEL"/></div>
            </div>
          </div>
          <div class="form-inline">
            <li>ค่าสอนพิเศษ</li>
            <div class="radio">
              <div class="form-group">
                <input type="radio"  name="costspec" id="costspec" value="choice1" required>&nbsp;ปริญญาตรีบรรยาย 400/ชม.&nbsp;&nbsp;
              จำนวน&nbsp;&nbsp;<input type="number" class="form-control numonly" id="choice1hour" size="5" data-minlength="1" min="0" max="99" >&nbsp;&nbsp;ชั่วโมง&nbsp;&nbsp;เป็นเงิน&nbsp;&nbsp;<input type="text" class="form-control numonly" id="choice1cost" size="5" data-minlength="5" min="0" max="99999" READONLY>&nbsp;&nbsp;บาท
              </div><br>
              <div class="form-group"><input type="radio"  name="costspec" id="costspec" value="choice2">&nbsp; ปริญญาตรีปฏิบัติการ 200/ชม.&nbsp;&nbsp;
              จำนวน&nbsp;&nbsp;<input type="number" class="form-control numonly" id="choice2hour" size="5" data-minlength="1" min="0" max="99" >&nbsp;&nbsp;ชั่วโมง&nbsp;&nbsp;เป็นเงิน&nbsp;&nbsp;<input type="text" class="form-control numonly" id="choice2cost" size="5" data-minlength="5" min="0" max="99999" READONLY>&nbsp;&nbsp;บาท
              </div>
            </div>
          </div>
          <div class="form-inline">
            <li>ค่าพาหนะเดินทาง </li>
            <div class="checkbox">
              <div class="form-group"><label><input type="checkbox" name="transplane" id="transplane">&nbsp;&nbsp;เครื่องบิน ระหว่าง &nbsp;<input type="text" class="form-control" name="AIR_DEPART" id="AIR_DEPART" placeholder="ต้นทาง"/> - <input type="text" class="form-control" name="AIR_ARRIVE" id="AIR_ARRIVE" placeholder="ปลายทาง"/>  &nbsp;&nbsp;เป็นเงิน&nbsp;&nbsp;<input type="text" class="form-control numonly" name="planecost" id="planecost" size="5" data-minlength="2" min="0" max="99999" >&nbsp;&nbsp;บาท</label></div>
              <br>
              <div class="form-group"><label><input type="checkbox" name="transtaxi" id="transtaxi">&nbsp;&nbsp;ค่า taxi &nbsp;<input type="text" class="form-control" name="TAXI_DEPART" id="TAXI_DEPART" placeholder="ต้นทาง"/> - <input type="text" class="form-control" name="TAXI_ARRIVE" id="TAXI_ARRIVE" placeholder="ปลายทาง"/> &nbsp;&nbsp;เป็นเงิน&nbsp;&nbsp;<input type="text" class="form-control numonly" name="taxicost" id="taxicost" size="5" data-minlength="2" min="0" max="99999" >&nbsp;&nbsp;บาท</label></div>
              <br>
              <div class="form-group"><label><input type="checkbox" name="transselfcar" id="transselfcar">&nbsp;&nbsp;รถยนต์ส่วนตัว ระยะทางไป-กลับ ระยะทาง &nbsp;
                <input type="text" class="form-control numonly" name="SELF_DISTANCT" id="SELF_DISTANCT" size="5" data-minlength="1" min="0" max="9999"> &nbsp;กิโลเมตร  กิโลเมตรละ 5 บาท &nbsp;&nbsp;เป็นเงิน&nbsp;&nbsp;
                <input type="text" class="form-control numonly" name="selfcost" id="selfcost" size="5" data-minlength="2" min="0" max="99999" READONLY >&nbsp;&nbsp;บาท</label></div>
              </div>
          </div>
          <div class="form-inline">
            <li>ค่าที่พัก</li>
            <div class="form-group"><div class="radio">
              <input type="radio" name="hotelchoice" id="hotelchoice" value="way3" required>&nbsp;&nbsp; ไม่เบิกค่าที่พัก&nbsp;&nbsp;<br>
              <input type="radio" name="hotelchoice" id="hotelchoice" value="way1" >&nbsp;&nbsp; เบิกได้เท่าจ่ายจริงไม่เกิน 1,500 บาท/คน/คืน&nbsp;&nbsp;<br>
              <input type="radio" name="hotelchoice" id="hotelchoice" value="way2">&nbsp;&nbsp; เบิกในลักษณะเหมาจ่ายไม่เกิน 800 บาท/คน/คืน &nbsp;&nbsp;
            </div></div>
            <br><div class="form-group">จำนวน&nbsp;&nbsp;<input type="number" class="form-control numonly" name="numnight" id="numnight" size="5" min="0" max="99999"  >&nbsp;&nbsp;คืน
            &nbsp;&nbsp;คิดเป็นเงิน&nbsp;&nbsp;<input type="text" class="form-control numonly" name="pernight" id="pernight" size="5" min="0" max="99999" READONLY  >&nbsp;&nbsp;บาท
          </div>
          </div>
          <br>
          <div class="form-inline">
            <input type="button" class="btn btn-outline btn-default" name="calculatebtn" id="calculatebtn" value="คำนวณค่าใช้จ่ายทั้งหมด" onclick="lastcal();">
          </div>
          <br>
          <div class="form-inline">
            <li style="font-size: 16px;" id="callist"><b>สรุปค่าใช้จ่ายทั้งหมด</b>&nbsp;&nbsp;<input type="text" class="form-control numonly" name="totalcost" id="totalcost" size="10" data-minlength="5" min="0" max="99999" READONLY >&nbsp;&nbsp;บาท</li>

          </div>
        </ul>
      </li>
    </ol>
    <br>
    <br>
    <div align="center">
      <input type="submit" style="font-size: 18px;" class="btn btn-outline btn-success" name="submitbtn" id="submitbtn" value="ยืนยันเพื่อส่งข้อมูล" onclick="checkreq();"> &nbsp;
      <input type="button" style="font-size: 18px;" class="btn btn-outline btn-warning" name="draftbtn" id="draftbtn" value="บันทึกข้อมูลชั่วคราว"> &nbsp;
      <input type="reset" style="font-size: 18px;" class="btn btn-outline btn-danger" name="resetbtn" id="resetbtn" onclick="confreset();" value="รีเซ็ตข้อมูล">
    </div>
</form>
</div>
</div>
</body>
</html>

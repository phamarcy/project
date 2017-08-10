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

 <style>
 input[type=text],input[type=date],input[type=time]{
   height: 25px;
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

     $("#choice1hour").prop('required',true);
     $("#choice1cost").prop('required',true);
     $("input[name='costspec']").change(function(){
       if($(this).val()=="choice1")
       {
           $("#choice1hour").prop('required',true);
           $("#choice1cost").prop('required',true);
           $("#choice2hour").prop('required',false);
           $("#choice2cost").prop('required',false);
       }
       else
       {
         $("#choice1hour").prop('required',false);
         $("#choice1cost").prop('required',false);
         $("#choice2hour").prop('required',true);
         $("#choice2cost").prop('required',true);
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
            $("#selfcost").prop('required',true);
        }
        else
        {
          $("#SELF_DISTANCT").prop('required',false);
          $("#selfcost").prop('required',false);
          $("#SELF_DISTANCT").val("");
          $("#selfcost").val("");
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
        $('#numnight').keyup(function(){
            var textone;
            var texttwo;
            textone = parseFloat($('#numnight').val());
            var result = textone*1500;
            $('#pernight').val(result.toFixed(2));
        });
      }
      else
      {
        $('#numnight').val("");
        $('#pernight').val("");
        $('#numnight').keyup(function(){
            var textone;
            var texttwo;
            textone = parseFloat($('#numnight').val());
            var result = textone*800;
            $('#pernight').val(result.toFixed(2));
        });
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
       table.append('<tr class="warning" name="addtr" id="row' + (rowCount - 1) + '"><td colspan="2"><div class="form-inline"><input type="button" class="btn btn-danger" name="delbtn' + (rowCount - 1) + '" id="delbtn' + (rowCount - 1) +
         '" value="ลบ" onclick="deleteRow(' + (rowCount - 1) + ')">&nbsp;&nbsp;<input type="text" class="form-control" name="detail_topic' + (rowCount - 1) + '" id="detail_topic' + (rowCount - 1) +
         '" size="50"></div></td><td><input type="date" class="form-control" name="dateteach' + (rowCount - 1) + '" id="dateteach' + (rowCount - 1) +
         '" size="2"></td><td style="text-align: center;"><div class="form-inline"><input type="time" class="form-control" name="timebegin' + (rowCount - 1) + '" id="timebegin' + (rowCount - 1) + '" size="2"><br> ถึง <br /><input type="time" class="form-control" name="timeend'
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
 </script>

</header>
<body class="mybox">
<div id="wrapper" style="padding-left: 30px; padding-right: 30px;">
  <div class="row">
    <center>
      <h3 class="page-header">แบบขออนุมัติเชิญอาจารย์พิเศษ คณะเภสัชศาสตร์</h3>
      <form >
        <div class="form-inline" style="font-size:16px;">
                  <div class="form-group">
                    <h style="font-size: 14px;">รหัสกระบวนวิชา
                     <input type="text" class="form-control numonly" id="inputyear" size="7" placeholder="e.g. 204111" maxlength="6"  required oninvalid="this.setCustomValidity('กรุณากรอกรหัสกระบวนวิชา')" oninput="setCustomValidity('')">
                  </div>
                 <div class="form-group">
                    ภาคการศึกษา
                     <select class="form-control required" id="semester" style="width: 70px;" id="select" required oninvalid="this.setCustomValidity('กรุณากรอกภาคการศึกษาให้ถูกต้อง')">
                        <option value="">--</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                     </select>
                 </div>
                 <div class="form-group">
                   ปีการศึกษา</h>
                   <input type="text" class="form-control numonly" id="inputyear" size="7" placeholder="e.g. 2560" maxlength="4" required oninvalid="this.setCustomValidity('กรุณากรอกปีการศึกษาให้ถูกต้อง')" oninput="setCustomValidity('')">
                 </div>
                <button type="submit" class="btn btn-outline btn-primary">ค้นหา</button>
         </div>
      </form>

      <form action="" name="form1" method="post">
      <div class="row form-inline" style="font-size:16px;">
      ภาควิชา <input type="text" class="form-control charonly" size="25" name="department" id="department" required oninvalid="this.setCustomValidity('กรุณาระบุภาควิชาให้ถูกต้อง')" oninput="setCustomValidity('')">
      </div>
    </center>
  </div>


    <ol>

      <li style="font-size: 14px;">
        <b>รายละเอียดของอาจารย์พิเศษ</b>
        <br>
        <div class="row">
          <ul>
          <div class="form-inline">
            <li>ชื่อ &nbsp;&nbsp;<input type="text" class="form-control charonly" id="fname" size="20" required oninvalid="this.setCustomValidity('กรุณากรอกชื่อ')" oninput="setCustomValidity('')">&nbsp;&nbsp;&nbsp;&nbsp;
            นามสกุล &nbsp;&nbsp;<input type="text" class="form-control charonly" id="lname" size="20" required oninvalid="this.setCustomValidity('กรุณากรอกนามสกุล')" oninput="setCustomValidity('')"></li>
          </div>

          <div class="form-inline">
            <li>ตำแหน่ง &nbsp;&nbsp;<input type="text" class="form-control charonly" id="position" size="35" required oninvalid="this.setCustomValidity('กรุณากรอกตำแหน่ง')" oninput="setCustomValidity('')"></li>
          </div>

          <div class="form-inline">
            <li>คุณวุฒิ/สาขาที่เชี่ยวชาญ &nbsp;&nbsp;<input type="text" class="form-control charonly" id="qualification" size="35" required oninvalid="this.setCustomValidity('กรุณากรอกคุณวุฒิหรือสาขาที่เชี่ยวชาญ')" oninput="setCustomValidity('')"></li>
          </div>

          <div class="form-inline">
            <li>สถานที่ทำงาน &nbsp;&nbsp;<br /><textarea class="form-control" id="workplace" rows="4" cols="70"  required oninvalid="this.setCustomValidity('กรุณากรอกสถานที่ทำงาน')" oninput="setCustomValidity('')"></textarea></li>
          </div>

          <div class="form-inline">
            <li>สถานที่ติดต่อ  &nbsp;&nbsp;<br /><textarea class="form-control" id="contactplace" rows="4" cols="70" required oninvalid="this.setCustomValidity('กรุณากรอกสถานที่ติดต่อ')" oninput="setCustomValidity('')"></textarea></li>
          </div>

          <div class="form-inline">
            <li>โทรศัพท์ &nbsp;&nbsp;<input type="text" class="form-control numonly" id="tel" size="20" maxlength="10" required oninvalid="this.setCustomValidity('กรุณากรอกหมายเลขโทรศัพท์')" oninput="setCustomValidity('')">
              &nbsp;ต่อ&nbsp;<input type="text" class="form-control numonly" id="subtel" size="2" maxlength="2"></li>
        </div>

        <div class="form-inline">
          <li>E-mail &nbsp;&nbsp;<input style="height: 25px;" type="email" class="form-control" id="qualification" size="45" required oninvalid="this.setCustomValidity('กรุณากรอกอีเมล์ให้ถูกต้อง')" oninput="setCustomValidity('')"></li>
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
                <li>รหัสกระบวนวิชาที่สอน &nbsp;<input type="text" class="form-control numonly" name="" id="course" size="6" maxlength="6" required oninvalid="this.setCustomValidity('กรุณากรอกรหัสกระบวนวิชา')" oninput="setCustomValidity('')"></li>
              </div>
              <div class="form-inline">
                <li>จำนวนนักศึกษา &nbsp;<input type="text" class="form-control numonly" name="" id="numstudent" size="6" maxlength="6"  required oninvalid="this.setCustomValidity('กรุณาระบุจำนวนนักศึกษา')" oninput="setCustomValidity('')"> คน</li>
              </div>
              <div class="form-inline">
                <li>กระบวนวิชานี้เป็นวิชา &nbsp;<br />
                  <div class="radio">
                    <input type="radio" name="type_course" id="type_course" value="require" required> &nbsp;บังคับ
                    &nbsp;<input type="radio" name="type_course" id="type_course" value="choose"> &nbsp;เลือก
                    &nbsp;<input type="radio" name="type_course" id="type_course" value="new"> &nbsp;เปิดใหม่
                    &nbsp;<input type="radio" name="type_course" id="type_course" value="old"> &nbsp;เปิดอยู่แล้ว
                  </div>
                </li>
              </div>
              <div class="form-inline">
                <li>หัวข้อที่เชิญมาสอน <br>
                    <div class="radio">
                      <input type="radio" name="topic" id="topic" value="yet" required> &nbsp;อาจารย์พิเศษยังไม่เคยสอน
                      &nbsp;<input type="radio" name="topic" id="topic" value="already"> &nbsp;อาจารย์พิเศษเคยสอนมาแล้ว
                    </div>
                  </li>
                </li>
              </div>
              <div class="form-inline">
                <li>จำนวนชั่วโมงของหัวข้อที่เชิญมาสอนคิดเป็นร้อยละ  &nbsp;<input type="number" class="form-control numonly" name="" id="hour" size="3" data-minlength="3" min="0" max="100" required oninvalid="this.setCustomValidity('กรุณากรอกจำนวนชั่วโมงให้ถูกต้อง')" oninput="setCustomValidity('')"> &nbsp;ของทั้งกระบวนวิชา</li>
              </div>
              <div class="form-inline">
                <li>เหตุผลและความจำเป็นในการเชิญอาจารย์พิเศษ  &nbsp;&nbsp;<br /><textarea class="form-control" id="reason" rows="4" cols="70" required oninvalid="this.setCustomValidity('กรุณาระบุเหตุผลในการเชิญอาจารย์พิเศษ')" oninput="setCustomValidity('')"></textarea></li>
              </div>
                <li> รายละเอียดในการสอน <br>
                  <div class="col-md-10">
                  <table id="detailteaching" class="table table-bordered table-hover" style="font-size: 14px; ">
                    <tr align="center" class="success">
                      <th colspan="2" style="text-align: center;">หัวข้อบรรยายปฏิบัติการ</th>
                      <th style="text-align: center;">วัน/เดือน/ปี ที่สอน</th>
                      <th style="text-align: center;">เวลา</th>
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
              <input type="radio"  name="levelteacher" id="levelteacher" value="pro" required>&nbsp;ข้าราชการระดับ &nbsp;<input type="text" class="form-control charonly" name="GOV_LEVEL" id="GOV_LEVEL"/>
              <br>
              <input type="radio"  name="levelteacher" id="levelteacher" value="norm">&nbsp; บุคคลเอกชนเทียบตำแหน่งระดับ &nbsp;<input type="text" class="form-control charonly" name="NORM_LEVEL" id="NORM_LEVEL"/>
            </div>
          </div>
          <div class="form-inline">
            <li>ค่าสอนพิเศษ</li>
            <div class="radio">
              <input type="radio"  name="costspec" id="costspec" value="choice1" required>&nbsp;ปริญญาตรีบรรยาย 400/ชม.&nbsp;&nbsp;
              จำนวน&nbsp;&nbsp;<input type="number" class="form-control numonly" id="choice1hour" size="5" data-minlength="2" min="0" max="99" >&nbsp;&nbsp;ชั่วโมง&nbsp;&nbsp;เป็นเงิน&nbsp;&nbsp;<input type="text" class="form-control numonly" id="choice1cost" size="5" data-minlength="5" min="0" max="99999">&nbsp;&nbsp;บาท
              <br>
              <input type="radio"  name="costspec" id="costspec" value="choice2">&nbsp; ปริญญาตรีปฏิบัติการ 200/ชม.&nbsp;&nbsp;
              จำนวน&nbsp;&nbsp;<input type="number" class="form-control numonly" id="choice2hour" size="5" data-minlength="2" min="0" max="99" >&nbsp;&nbsp;ชั่วโมง&nbsp;&nbsp;เป็นเงิน&nbsp;&nbsp;<input type="text" class="form-control numonly" id="choice2cost" size="5" data-minlength="5" min="0" max="99999">&nbsp;&nbsp;บาท
            </div>
          </div>
          <div class="form-inline">
            <li>ค่าพาหนะเดินทาง </li>
            <div class="checkbox">
              <label><input type="checkbox" name="transplane" id="transplane">&nbsp;&nbsp;เครื่องบิน ระหว่าง &nbsp;<input type="text" class="form-control" name="AIR_DEPART" id="AIR_DEPART" placeholder="ต้นทาง"/> - <input type="text" class="form-control" name="AIR_ARRIVE" id="AIR_ARRIVE" placeholder="ปลายทาง"/>  &nbsp;&nbsp;เป็นเงิน&nbsp;&nbsp;<input type="text" class="form-control numonly" name="planecost" id="planecost" size="5" data-minlength="2" min="0" max="99999">&nbsp;&nbsp;บาท</label>
              <br>
              <label><input type="checkbox" name="transtaxi" id="transtaxi">&nbsp;&nbsp;ค่า taxi &nbsp;<input type="text" class="form-control" name="TAXI_DEPART" id="TAXI_DEPART" placeholder="ต้นทาง"/> - <input type="text" class="form-control" name="TAXI_ARRIVE" id="TAXI_ARRIVE" placeholder="ปลายทาง"/> &nbsp;&nbsp;เป็นเงิน&nbsp;&nbsp;<input type="text" class="form-control numonly" name="taxicost" id="taxicost" size="5" data-minlength="2" min="0" max="99999">&nbsp;&nbsp;บาท</label>
              <br>
              <label><input type="checkbox" name="transselfcar" id="transselfcar">&nbsp;&nbsp;รถยนต์ส่วนตัว ระยะทางไป-กลับ ระยะทาง &nbsp;
                <input type="text" class="form-control numonly" name="SELF_DISTANCT" id="SELF_DISTANCT" size="5" data-minlength="2" min="0" max="9999"> &nbsp;กิโลเมตร  กิโลเมตรละ 5 บาท &nbsp;&nbsp;เป็นเงิน&nbsp;&nbsp;
                <input type="text" class="form-control numonly" name="selfcost" id="selfcost" size="5" data-minlength="2" min="0" max="99999">&nbsp;&nbsp;บาท</label>
              </div>
          </div>
          <div class="form-inline">
            <li>ค่าที่พัก</li>
            <div class="radio">
              <input type="radio" name="hotelchoice" id="hotelchoice" value="way1" required>&nbsp;&nbsp; เบิกได้เท่าจ่ายจริงไม่เกิน 1,500 บาท/คน/คืน&nbsp;&nbsp;<br>
              <input type="radio" name="hotelchoice" id="hotelchoice" value="way2">&nbsp;&nbsp; เบิกในลักษณะเหมาจ่ายไม่เกิน 800 บาท/คน/คืน &nbsp;&nbsp;
            </div>
            <br>จำนวน&nbsp;&nbsp;<input type="number" class="form-control numonly" name="numnight" id="numnight" size="5" min="0" max="99999" required  oninvalid="this.setCustomValidity('กรุณาระบุจำนวนให้ถูกต้อง')" oninput="setCustomValidity('')">&nbsp;&nbsp;คืน
            &nbsp;&nbsp;คิดเป็นเงิน&nbsp;&nbsp;<input type="text" class="form-control numonly" name="pernight" id="pernight" size="5" min="0" max="99999" required oninvalid="this.setCustomValidity('กรุณาระบุจำนวนให้ถูกต้อง')" oninput="setCustomValidity('')">&nbsp;&nbsp;บาท

          </div>
          <br>
          <div class="form-inline">
            <input type="button" class="btn btn-outline btn-default" name="calculatebtn" id="calculatebtn" value="คำนวณค่าใช้จ่ายทั้งหมด" onclick="lastcal();">
          </div>
          <br>
          <div class="form-inline">
            <li style="font-size: 16px;" id="callist"><b>สรุปค่าใช้จ่ายทั้งหมด</b>&nbsp;&nbsp;<input type="text" class="form-control numonly" name="totalcost" id="totalcost" size="10" data-minlength="5" min="0" max="99999" onclick="lastcal();" required oninvalid="this.setCustomValidity('กรุณาระบุจำนวนให้ถูกต้อง')" oninput="setCustomValidity('')">&nbsp;&nbsp;บาท</li>

          </div>
        </ul>
      </li>
    </ol>
    <br>
    <br>
    <div align="center">
      <input type="submit" style="font-size: 18px;" class="btn btn-outline btn-success" name="submitbtn" id="submitbtn" value="ยืนยันเพื่อส่งข้อมูล"> &nbsp;
      <input type="button" style="font-size: 18px;" class="btn btn-outline btn-warning" name="draftbtn" id="draftbtn" value="บันทึกข้อมูลชั่วคราว"> &nbsp;
      <input type="button" style="font-size: 18px;" class="btn btn-outline btn-danger" name="resetbtn" id="resetbtn" value="รีเซ็ตข้อมูล">
    </div>
</form>
</div>
</body>
</html>

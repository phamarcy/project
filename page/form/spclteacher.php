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
 </style>

 <script>
 $(document).ready(function(){
   $('#adddetail').click(function() {
     var table = $(this).closest('table');
     if (table.find('input:text').length < 100) {
       $('#delbtn').removeAttr("disabled");
       var x = $(this).closest('tr').nextAll('tr');
       var rowCount = $('#detailteaching tr').length;
       $.each(x, function(i, val) {
         val.remove();
       });
       table.append('<tr class="warning" id="row' + (rowCount - 1) + '"><td colspan="2"><div class="form-inline"><input type="button" class="btn btn-danger" name="delbtn' + (rowCount - 1) + '" id="delbtn' + (rowCount - 1) +
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
 </script>

</header>
<body class="mybox">
<div id="wrapper" style="padding-left: 30px">
  <div class="row">
    <center>
      <h2 class="page-header">แบบขออนุมัติเชิญอาจารย์พิเศษ คณะเภสัชศาสตร์<br /><h3>ภาคการศึกษาที่ 2 ปีการศึกษา 2560</h3></h2>
    </center>
  </div>

  <form action="" name="form1" method="post">
    <ol>
      <br>
      <li style="font-size: 16px">
        <b>รายละเอียดของอาจารย์พิเศษ</b>
        <br>
        <div class="row">
          <ul>
          <div class="form-inline">
            <li>ชื่อ &nbsp;&nbsp;<input type="text" class="form-control" id="fname" size="20">&nbsp;&nbsp;&nbsp;&nbsp;
            นามสกุล &nbsp;&nbsp;<input type="text" class="form-control" id="lname" size="20"></li>
          </div>

          <div class="form-inline">
            <li>ตำแหน่ง &nbsp;&nbsp;<input type="text" class="form-control" id="position" size="35"></li>
          </div>

          <div class="form-inline">
            <li>คุณวุฒิ/สาขาที่เชี่ยวชาญ &nbsp;&nbsp;<input type="text" class="form-control" id="qualification" size="35"></li>
          </div>

          <div class="form-inline">
            <li>สถานที่ทำงาน &nbsp;&nbsp;<br /><textarea class="form-control" id="workplace" rows="4" cols="70"></textarea></li>
          </div>

          <div class="form-inline">
            <li>สถานที่ติดต่อ  &nbsp;&nbsp;<br /><textarea class="form-control" id="contactplace" rows="4" cols="70"></textarea></li>
          </div>

          <div class="form-inline">
            <li>โทรศัพท์ &nbsp;&nbsp;<input type="text" class="form-control" id="tel" size="20">
              &nbsp;ต่อ&nbsp;<input type="text" class="form-control" id="subtel" size="2"></li>
        </div>

        <div class="form-inline">
          <li>E-mail &nbsp;&nbsp;<input style="height: 25px;" type="email" class="form-control" id="qualification" size="45"></li>
        </div>
      </ul>
    </div>
      </li>
      <br>
      <li style="font-size: 16px">
        <b>รายละเอียดกระบวนวิชา</b>
          <div class="row">
            <ul>
              <div class="form-inline">
                <li>กระบวนวิชาที่สอน &nbsp;<input type="text" class="form-control" name="" id="course" size="20"></li>
              </div>
              <div class="form-inline">
                <li>กระบวนวิชานี้เป็นวิชา &nbsp;<br />
                  <div class="radio">
                    <input type="radio" name="type_course" id="type_course" value="require" checked> &nbsp;บังคับ
                    &nbsp;<input type="radio" name="type_course" id="type_course" value="choose"> &nbsp;เลือก
                    &nbsp;<input type="radio" name="type_course" id="type_course" value="new"> &nbsp;เปิดใหม่
                    &nbsp;<input type="radio" name="type_course" id="type_course" value="old"> &nbsp;เปิดอยู่แล้ว
                  </div>
                </li>
              </div>
              <div class="form-inline">
                <li>หัวข้อที่เชิญมาสอน <br>
                    <div class="radio">
                      <input type="radio" name="topic" id="topic" value="yet" checked> &nbsp;อาจารย์พิเศษยังไม่เคยสอน
                      &nbsp;<input type="radio" name="topic" id="topic" value="already"> &nbsp;อาจารย์พิเศษเคยสอนมาแล้ว
                    </div>
                  </li>
                </li>
              </div>
              <div class="form-inline">
                <li>จำนวนชั่วโมงของหัวข้อที่เชิญมาสอนคิดเป็นร้อยละ  &nbsp;<input type="text" class="form-control" name="" id="hour" size="3"> &nbsp;ของทั้งกระบวนวิชา</li>
              </div>
              <div class="form-inline">
                <li>เหตุผลและความจำเป็นในการเชิญอาจารย์พิเศษ  &nbsp;&nbsp;<br /><textarea class="form-control" id="reason" rows="4" cols="70"></textarea></li>
              </div>
                <li> รายละเอียดในการสอน <br>
                  <div class="col-md-10">
                  <table id="detailteaching" class="table table-bordered table-hover" style="font-size: 17px; ">
                    <tr align="center" class="success">
                      <th colspan="2" style="text-align: center;">หัวข้อบรรยายปฏิบัติการ</th>
                      <th style="text-align: center;">วัน/เดือน/ปี ที่สอน</th>
                      <th style="text-align: center;">เวลา</th>
                      <th style="text-align: center;">ห้องเรียน</th>
                    </tr>
                    <tr>
                      <td colspan="5" style="text-align: center;"><input type="button" class="btn btn-success" name="addbtn" id="adddetail" value="เพิ่ม"> </td>
                    </tr>
                  </table>
                </div>
                </li>
            </ul>
          </div>
      </li>
    </ol>
</div>
</body>
</html>

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

  <link rel="stylesheet" href="../dist/css/scrollbar.css">

<script id="contentScript">

</script>
<style>
#statcf {
  color : #0e9d14;
}

#statn {
  color : #ec2c2c;
}

#statwt {
  color : #acb500;
}

#statal {
  color : #da9001;
}
</style>
</header>
<body class="mybox">
  <div id="wrapper" style="padding-left: 30px; padding-right: 30px;">
<div class="row">
  <center>
    <h3 class="page-header">ตรวจสอบสถานะการอนุมัติกระบวนวิชา</h3>
        <form data-toggle="validator" role="form">
          <div class="form-inline" style="font-size:14px;">
                   <div class="form-group">
                      <label id="semester" class="control-label">ปีการศึกษา</label>
                       <select class="form-control required" id="semester" style="width: 70px;"  required>
                          <option value="">--</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                       </select>
                   </div>
                   <div class="form-group">
                     <label for="inputyear" class="control-label">ปีการศึกษา</label>
                     <input type="number" class="form-control" id="inputyear" style="width: 150px;" placeholder="e.g. 2560"  data-minlength="4"  max="9999" required>
                   </div>
                  <button type="submit" class="btn btn-outline btn-primary">ค้นหา</button>
           </div>
        </form>
  </center>
</div>

<br>

<div class="container">
<div class="panel-group" id="accordion0">

  <div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
        <i class="fa fa-search fa-fw"></i><b> รายชื่อกระบวนวิชา</b> ภาคการศึกษาที่ 1 ปีการศึกษา 2560</a>
      </h3>
    </div>
    <div id="collapse1" class="panel-collapse collapse in">
      <div class="panel-body" style="font-size:14px;">
        <!-- 1 -->
        <div class="panel-group" id="accordion1">
        <div class="panel panel-success">
          <div class="panel-heading">
            <h3 class="panel-title">
              <a data-toggle="collapse" href="#collapse2">
              <li><b><u>รหัสกระบวนวิชา</u></b> : 204111 <b>ตอนที่</b> 1 <b>ภาคปกติ</b></a></li>
              <br>&nbsp;&nbsp;&nbsp; สถานะการอนุมัติ : <b id="statcf">อนุมัติ <i class="fa fa-check fa-fw"></i></b>
            </h3>
          </div>
          <div id="collapse2" class="panel-collapse collapse">
            <div class="panel-body" style="font-size:14px;">

              <div class="panel-group">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">
                    <a data-toggle="collapse" href="#collapse3">
                     <i class="fa fa-file-o fa-fw"></i><b> แบบแจ้งวิธีการวัดผลและประเมินผลการศึกษา </b><i class="fa fa-long-arrow-right fa-fw"></i> สถานะการอนุมัติ : <b id="statcf">อนุมัติ <i class="fa fa-check fa-fw"></i></b></a>
                  </h3>
                </div>
                <div id="collapse3" class="panel-collapse collapse">
                  <div class="panel-body" style="font-size:14px;">ไม่มีคอมเมนท์</div>
                </div>
              </div>
            </div>

            <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">
                  <a data-toggle="collapse" href="#collapse4">
                  <i class="fa fa-file-o fa-fw"></i><b>  แบบขออนุมัติเชิญอาจารย์พิเศษ </b><i class="fa fa-long-arrow-right fa-fw"></i> สถานะการอนุมัติ : <b id="statcf">อนุมัติ <i class="fa fa-check fa-fw"></i></b></a>
                </h3>
              </div>
              <div id="collapse4" class="panel-collapse collapse">
                <div class="panel-body" style="font-size:14px;">ไม่มีคอมเมนท์</div>
              </div>
            </div>
          </div>

          <div class="panel-group">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">
                <a data-toggle="collapse" href="#collapse5">
                  <i class="fa fa-file-o fa-fw"></i><b> Course Syllabus </b><i class="fa fa-long-arrow-right fa-fw"></i> สถานะการอนุมัติ : <b id="statcf">อนุมัติ <i class="fa fa-check fa-fw"></i></b></a>
              </h3>
            </div>
            <div id="collapse5" class="panel-collapse collapse">
              <div class="panel-body" style="font-size:14px;">ไม่มีคอมเมนท์</div>
            </div>
          </div>
        </div>

            </div>
          </div>
        </div>
      </div>

      <!-- 2 -->
      <div class="panel-group" id="accordion2">
      <div class="panel panel-warning">
        <div class="panel-heading">
          <h3 class="panel-title">
            <a data-toggle="collapse" href="#collapse6">
            <li><b><u>รหัสกระบวนวิชา</u></b> : 204111 <b>ตอนที่</b> 2 <b>ภาคปกติ</b></a></li>
            <br>&nbsp;&nbsp;&nbsp; สถานะการอนุมัติ : <b id="statwt">รอการพิจารนา <i class="fa fa-clock-o fa-fw"></i></b>
          </h3>
        </div>
        <div id="collapse6" class="panel-collapse collapse">
          <div class="panel-body" style="font-size:14px;">

            <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">
                  <a data-toggle="collapse" href="#collapse7">
                   <i class="fa fa-file-o fa-fw"></i><b> แบบแจ้งวิธีการวัดผลและประเมินผลการศึกษา </b><i class="fa fa-long-arrow-right fa-fw"></i> สถานะการอนุมัติ : <b id="statwt">รอการพิจารนา <i class="fa fa-clock-o fa-fw"></i></b></a>
                </h3>
              </div>
              <div id="collapse7" class="panel-collapse collapse">
                <div class="panel-body" style="font-size:14px;">ไม่มีคอมเมนท์</div>
              </div>
            </div>
          </div>

          <div class="panel-group">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">
                <a data-toggle="collapse" href="#collapse8">
                <i class="fa fa-file-o fa-fw"></i><b>  แบบขออนุมัติเชิญอาจารย์พิเศษ </b><i class="fa fa-long-arrow-right fa-fw"></i> สถานะการอนุมัติ : <b id="statcf">อนุมัติ <i class="fa fa-check fa-fw"></i></b></a>
              </h3>
            </div>
            <div id="collapse8" class="panel-collapse collapse">
              <div class="panel-body" style="font-size:14px;">ไม่มีคอมเมนท์</div>
            </div>
          </div>
        </div>

          </div>
        </div>
      </div>
    </div>

    <!-- 3 -->
    <div class="panel-group" id="accordion3">
    <div class="panel panel-danger">
      <div class="panel-heading">
        <h3 class="panel-title">
          <a data-toggle="collapse" href="#collapse9">
          <li><b><u>รหัสกระบวนวิชา</u></b> : 204111 <b>ตอนที่</b> 3 <b>ภาคพิเศษ</b></a></li>
          <br>&nbsp;&nbsp;&nbsp; สถานะการอนุมัติ : <b id="statn">ไม่ผ่านการอนุมัติ <i class="fa fa-times fa-fw"></i></b>
        </h3>
      </div>
      <div id="collapse9" class="panel-collapse collapse">
        <div class="panel-body" style="font-size:14px;">

          <div class="panel-group">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">
                <a data-toggle="collapse" href="#collapse10">
                 <i class="fa fa-file-o fa-fw"></i><b> แบบแจ้งวิธีการวัดผลและประเมินผลการศึกษา </b><i class="fa fa-long-arrow-right fa-fw"></i> สถานะการอนุมัติ : <b id="statcf">อนุมัติ <i class="fa fa-check fa-fw"></i></b></a>
              </h3>
            </div>
            <div id="collapse10" class="panel-collapse collapse">
              <div class="panel-body" style="font-size:14px;">ไม่มีคอมเมนท์</div>
            </div>
          </div>
        </div>

        <div class="panel-group">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">
              <a data-toggle="collapse" href="#collapse11">
              <i class="fa fa-file-o fa-fw"></i><b>  แบบขออนุมัติเชิญอาจารย์พิเศษ </b><i class="fa fa-long-arrow-right fa-fw"></i> สถานะการอนุมัติ : <b id="statn">ไม่ผ่านการอนุมัติ <i class="fa fa-check fa-fw"></i></b></a>
            </h3>
          </div>
          <div id="collapse11" class="panel-collapse collapse">

              <?php if($_SESSION['level']==6){ ?>
                <div class="panel-body" style="font-size:14px;">กรุณากรอกชื่อวันและเวลาที่แน่นอนสำหรับการหยุดสอน
                  <br><br>
                <button class="btn btn-outline btn-danger" name="editeva" id="editeva" >แก้ไข</button>
              <?php   } ?>

            </div>
          </div>
        </div>
      </div>

        </div>
      </div>
    </div>
    </div>

    <!-- 4 -->
    <div class="panel-group" id="accordion4">
    <div class="panel panel-warning">
      <div class="panel-heading">
        <h3 class="panel-title">
          <a data-toggle="collapse" href="#collapse12">
          <li><b><u>รหัสกระบวนวิชา</u></b> : 001101 <b>ตอนที่</b> 1 <b>ภาคปกติ</b></a></li>
          <br>&nbsp;&nbsp;&nbsp; สถานะการอนุมัติ : <b id="statal">ภาควิชาเห็นชอบ รอคณะบดีอนุมัติ <i class="fa fa-user fa-fw"></i></b>
        </h3>
      </div>
      <div id="collapse12" class="panel-collapse collapse">
        <div class="panel-body" style="font-size:14px;">

          <div class="panel-group">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">
                <a data-toggle="collapse" href="#collapse13">
                 <i class="fa fa-file-o fa-fw"></i><b> แบบแจ้งวิธีการวัดผลและประเมินผลการศึกษา </b><i class="fa fa-long-arrow-right fa-fw"></i> สถานะการอนุมัติ : <b id="statcf">อนุมัติ <i class="fa fa-check fa-fw"></i></b></a>
              </h3>
            </div>
            <div id="collapse13" class="panel-collapse collapse">
              <div class="panel-body" style="font-size:14px;">ไม่มีคอมเมนท์</div>
            </div>
          </div>
        </div>

        <div class="panel-group">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">
              <a data-toggle="collapse" href="#collapse14">
              <i class="fa fa-file-o fa-fw"></i><b>  แบบขออนุมัติเชิญอาจารย์พิเศษ </b><i class="fa fa-long-arrow-right fa-fw"></i> สถานะการอนุมัติ : <b id="statal">ภาควิชาเห็นชอบ รอคณะบดีอนุมัติ <i class="fa fa-user fa-fw"></i></b></a>
            </h3>
          </div>
          <div id="collapse14" class="panel-collapse collapse">
            <div class="panel-body" style="font-size:14px;">ไม่มีคอมเมนท์
            </div>
          </div>
        </div>
      </div>

        </div>
      </div>
    </div>
    </div>
      </div>
    </div>
  </div>



</div>
</div>
</div>
</body>
</html>

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
    <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../dist/css/bootstrap_file_field.css" rel="stylesheet" type="text/css" >

    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="../js/function.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>

<style >
/*div[class="row"] {
  border: 1px dotted rgba(0, 0, 0, 0.5);
}

div[class^="col-"] {
  background-color: rgba(255, 0, 0, 0.2);
}*/

</style>

</header>


<body class="mybox">
    <div id="wrapper" style="padding-left: 30px; padding-right: 30px;">
      <div class="container">
        <div class="row">
            <center>
              <h3 class="page-header">อัปโหลดไฟล์การตัดเกรด และรายละเอียดคะแนนแต่ละส่วน</h3>
            </center>
        </div>
      <br>
      <div class="panel panel-default">
          <div class="panel-heading">
            <h5 class="panel-title">
                <b>ภาคการศึกษาที่ 2 ปีการศึกษา 2560</b>
            </h5>
          </div>
          <!-- .panel-heading -->
          <div class="panel-body">
            <center>
              <p class="text-danger">*หมายเหตุ ไฟล์ที่ต้องการอัปโหลดต้องเป็นไฟล์ Excel ที่มีนามสกุล .xls หรือ .xlsx </p>

                <form role="form" data-toggle="validator">
                    <div class="form-group">
                      <div class="form-inline">
                        <label >เลือกไฟล์</label>
                        <input type="file" class="form-control" name="fileName" data-required-error="กรุณาเลือกไฟล์" accept=".xls,.xlsx" onchange="validate_fileupload(this);" required>
                        <button type="submit" name="button" class="btn btn-primary btn-outline" onclick="return valid_form();">อัปโหลด</button>
                      </div>
                      <div class="help-block with-errors "  for="semester" style="font-size:12px;"></div>
                    </div>

                </form>

            </center>
          </div>
      </div>
    </div>
</div>
<script type="text/javascript" src="../dist/js/bootstrap_file_field.js"></script>

</body>

</html>

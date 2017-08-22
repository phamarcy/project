<?php
session_start();
require_once(__DIR__."/../../application/class/manage_deadline.php");
require_once(__DIR__."/../../application/class/course.php");
$deadline = new Deadline;
$grade = new Course;
$semeter= $deadline->Get_Current_Semester();
$showgrade=$grade->Get_Grade($_SESSION['id']);
var_dump($showgrade);
$grade->Close_connection();

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

    <style>

    a[disabled="disabled"] {
     <?php if ($_SESSION['level'] == 2 or $_SESSION['level'] == 3) { ?>
       pointer-events: none;
     <?php  } ?>
    }
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
    .fileUpload {
      position: relative;
      overflow: hidden;
      margin-top: -3px;
    }
    .fileUpload input.upload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }
    </style>

</header>


<body class="mybox">
    <div id="wrapper" style="padding-left: 30px; padding-right: 30px;">
      <div class="container">
        <div class="row">
            <center>
              <h3 class="page-header">อัพโหลดไฟล์เกรด</h3>
            </center>
        </div>
      <br>
      <div class="panel panel-default">
          <div class="panel-heading">
            <h5 class="panel-title">
                <b>ภาคการศึกษาที่ <?php echo $semeter["semester"]; ?> ปีการศึกษา <?php echo $semeter["year"]; ?></b>
            </h5>
          </div>
          <!-- .panel-heading -->
          <div class="panel-body">
              <div class="alert alert-warning pull-left">
                  *หมายเหตุ ไฟล์ที่ต้องการอัปโหลดต้องเป็นไฟล์ Excel ที่มีนามสกุล .xls หรือ .xlsx เท่านั้น
              </div>

              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>รหัสวิชา</th>
                    <th>วิชา</th>
                    <th>ไฟล์</th>
                    <th>สถานะ</th>
                    <th>อัปโหลด</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($showgrade as $value):
                    switch ($value['status']) {
                      case 0:
                      $status='<b id="statn">ยังไม่ได้อัปโหลด</b>';
                        break;
                      case 1:
                      $status='<b id="statcf">อัปโหลดแล้ว</b>';
                        break;
                    }
                  ?>
                          <tr>
                            <td><?php echo $value["course_id"]; ?></td>
                            <td><?php echo $value['course_name']; ?></td>
                            <td>
                            <?php if (isset($value['url'])): ?>
                                <a href="<?php echo $value['url']; ?>" target="_blank"><i type="button" class="fa fa-file-excel-o fa-2x" ></i></a>
                            <?php endif; ?>
                            </td>
                            <td><?php echo $status ?></td>
                            <td>
                              <div class="fileUpload btn btn-primary">
                                <span>Upload</span>
                                <input type="file" class="upload" />
                              </div>
                            </td>
                          </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
          </div>
      </div>
    </div>
</div>
<script type="text/javascript">
$("form#data").submit(function(){
    //var file = document.forms['data']['filexcel'].files[0];
    var formData = new FormData(this);

    $.ajax({
        url: '../../application/test_data.php',
        type: 'POST',
        data: formData,
        async: false,
        success: function (data) {
            console.log(data);
        },
        cache: false,
        contentType: false,
        processData: false
    });

    return false;
});
</script>
</body>

</html>

<?php
session_start();
if(!isset($_SESSION['level']) || !isset($_SESSION['fname']) || !isset($_SESSION['lname']) || !isset($_SESSION['id']))
{
    die('กรุณา Login ใหม่');
}
require_once(__DIR__."/../../application/class/manage_deadline.php");
require_once(__DIR__."/../../application/class/course.php");
$deadline = new Deadline;
$grade = new Course;
$semester= $deadline->Get_Current_Semester();
$showgrade=$grade->Get_Grade($_SESSION['id'],$semester['id']);
$grade->Close_connection();

//close
$grade->Close_connection();
$deadline->Close_connection();

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
    <script src="../dist/js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="../dist/css/sweetalert2.min.css">
    <style>
    i:hover {
      font-size: 30px;
      font-weight: bold;
      color: red;
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


    </style>

</header>


<body class="mybox" >
    <div  style="padding-left: 30px; padding-right: 30px;">
      <div class="container">
        <div class="row">
            <center>
              <h3 class="page-header">อัปโหลดไฟล์เกรด</h3>
            </center>
        </div>
      <br>
      <div class="panel panel-default">
          <div class="panel-heading">
            <h5 class="panel-title">
                <b>ภาคการศึกษาที่ <?php echo $semester["semester"]; ?> ปีการศึกษา <?php echo $semester["year"]; ?></b>
            </h5>
          </div>
          <!-- .panel-heading -->
          <div class="panel-body" >
              <div class="alert alert-warning pull-left">
                  *หมายเหตุ ไฟล์ที่ต้องการอัปโหลดต้องเป็นไฟล์ Excel ที่มีนามสกุล .xls หรือ .xlsx เท่านั้น
              </div>
              <table class="table table-striped" style="font-size:14px;">
                <thead>
                  <tr>
                    <th>รหัสวิชา</th>
                    <th>วิชา</th>
                    <th>ไฟล์</th>
                    <th>สถานะ</th>
                    <th>เลือกไฟล์</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (is_array($showgrade) || is_object($showgrade)): ?>
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
                            <form id="data" method="post">
                              <td><?php echo $value["course_id"]; ?></td>
                              <td><?php echo $value['course_name']; ?></td>
                              <td>
                              <?php if (isset($value['url'])): ?>
                                  <a href="../../files<?php echo $value['url']; ?>" target="_blank"><i type="button" class="fa fa-file-excel-o fa-2x" ></i></a>
                              <?php endif; ?>
                              </td>
                              <td><?php echo $status ?></td>
                              <td style="width:20px;">
                                <input name="file"  id="grade_<?php echo $value["course_id"] ?>" type="file" accept=".xls, .xlsx, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                                <input name="course_id" value="<?php echo $value["course_id"] ?>" type="hidden" />
                              </td>
                              <td><button type="button" name="button" class="btn btn-primary" onclick="uploadFile(<?php echo $value["course_id"]; ?>)">อัปโหลด</button></td>
                            </form>
                          </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
              </table>
          </div>
      </div>
    </div>
</div>
<script type="text/javascript">

function uploadFile(course){
  var text = "grade_"+course;
  var checkfile = document.getElementById(text).value;
  if (!checkfile) {
    swal({
      type:"warning",
      text: "กรุณาเลือกไฟล์",
      confirmButtonText: "ตกลง!",
    });
    return false;
  }else {
      var fileexcel = document.getElementById(text).files[0];
      var formData = new FormData();
      formData.append('file', fileexcel);
      formData.append('course_id', course);

      console.log(formData);
      $.ajax({
          url: '../../application/document/upload_grade.php',
          type: 'POST',
          processData: false,
          contentType: false,
          data:formData,
          success: function (data) {
            var msg=JSON.parse(data)
            swal({
              type:msg.status,
              text: msg.msg,
              timer: 2000,
              confirmButtonText: "Ok!",
            }, function(){
              window.location.reload();
            });
            setTimeout(function() {
              window.location.reload();
            },2000);

          }
      });

  }
}

</script>
</body>

</html>

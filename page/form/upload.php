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
$_SESSION['semester']='false'; 
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
    <script src="../dist/js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="../dist/css/sweetalert2.min.css">
    <script type="text/javascript" src="../dist/js/validator.min.js"></script>
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
<form id="search-panel" method="post" action="#" data-toggle="validator" role="form">
            <h3 class="page-header"><center>อัปโหลดไฟล์เกรด</center></h3>
            <center> <div class="fa fa-exclamation-circle" style="color: #ec2c2c;font-size:16px;"></div><b style="color: #ec2c2c;font-size:16px;"> กรุณาเลือกภาคและปีการศึกษาที่ต้องการอัปโหลดไฟล์เกรด </b>
          </center>  
          <br>
            <div class="form-inline">
                <center>

                     
               
                    <h style="font-size : 14px">ภาคการศึกษาที่
                        <div class="form-group">
                            <select class="form-control" name="semester" style="width: 100px;" required>
                                <option value="">--</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                          </div>

                        <div class="form-group">
                            ปีการศึกษา
                          <input type="text" class="form-control numonly" placeholder="e.g. 2560" style="width: 100px;" pattern=".{4,4}" name="year" required > &nbsp;
                        </div>
                        <?php  if($_SESSION['level'] == '3' || $_SESSION['level'] == '6'){ ?>
                          ภาควิชา
                          <select class="form-control" name="department">
                            <?php
                             for ($i=0; $i <count($dept) ; $i++) {
                               echo "<option value=".$dept[$i]['code'].">".$dept[$i]['name']."</option>";
                             }
                             ?>
                          </select>
                        <?php  } ?>
                        <button type="submit" class="btn btn-outline btn-primary">ค้นหา</button>
                    </h>
                </center>
            </div>
      </form>
<?php


$value=false;
if (isset($_POST['semester'])  && isset($_POST['year'])) {
  $semester= $deadline->Search_Semester_id($_POST['semester'],$_POST['year']);
  $showgrade=$grade->Get_Grade($_SESSION['id'],$semester);
  if (!$semester || !$showgrade) {
    echo  "
    <script>
      swal('ไม่พบข้อมูล');
    </script>
    ";
    return false;
  }else {
    if ($semester) {
      $_SESSION['semester']=$semester;
      $_SESSION['term']=$deadline->Search_Semester_Term($semester);
      $_SESSION['grade']=$showgrade;
    }
   
  }

}
if (isset($_SESSION['term']) && isset($_SESSION['grade']))

{ ?>
  <div  style="padding-left: 30px; padding-right: 30px;">
 
      <br>
      <div class="panel panel-default">
          <div class="panel-heading">
            <h5 class="panel-title">
                <b>ภาคการศึกษาที่ <?php echo $_SESSION['term']["semester"]; ?> ปีการศึกษา <?php echo $_SESSION['term']["year"]; ?></b>
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
                  <?php if (is_array($_SESSION['grade']) || is_object($_SESSION['grade'])): ?>
                        <?php foreach ($_SESSION['grade'] as $value):
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
                                  <a href="../../files<?php echo $value['url']; ?>" target="_blank" class="btn btn-sm btn-success" role="button">ดาวน์โหลดไฟล์</a>
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
<?php } ?>
    
    
<script type="text/javascript">
 $(document).ready(function () {
    $('input[type=file]').change(function () {
      var val = $(this).val().toLowerCase();
      var regex = new RegExp("(.*?)\.(xlsx|xls)$");
      if (!(regex.test(val))) {
        $(this).val('');
        swal({
        type: "warning",
        text: "กรุณาเลือกไฟล์ Excel ที่มีนามสกุล .xlsx , .xls",
        confirmButtonText: "ตกลง!",
      });
      }
    });
  });
function uploadFile(course){
  var text = "grade_"+course;
  var checkfile = document.getElementById(text).value;
  var semester = <?php echo $_SESSION['semester'] ?>;
  if (semester=='false') {
    return false;
  }
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
      formData.append('semester',semester);
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

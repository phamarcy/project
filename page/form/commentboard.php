<?php
session_start();
if(!isset($_SESSION['level']) || !isset($_SESSION['fname']) || !isset($_SESSION['lname']) || !isset($_SESSION['id']))
{
    die('กรุณา Login ใหม่');
}
require_once(__DIR__."/../../application/class/person.php");
require_once(__DIR__.'/../../application/class/manage_deadline.php');
require_once(__DIR__."/../../application/class/course.php");
require_once(__DIR__."/../../application/class/approval.php");
$person = new Person();
$deadline = new Deadline();
$course = new course();
$approval = new approval($_SESSION['level']);
$deadline_approve =$deadline->Get_Current_Deadline($_SESSION['level']);
$semeter= $deadline->Get_Current_Semester();
$department =$person->Get_Staff_Dep($_SESSION['id']);
$dep_js=$department['code'];
$assessor=$person->Search_Assessor($department['code']);
$list_course= $course->Get_Dept_Course($department['code'],$semeter['id']);
$data_forapproval=$approval->Get_Approval_data($_SESSION['id']);
$check_permission=$person->Check_Grant($_SESSION['id']);

if ($_SESSION['level']==4 || $_SESSION['level'] ==5 ) {
  $type_deadline = 4;
}else {
  $type_deadline = 5;
}
$current_semester = $deadline->Search_all_current($type_deadline);

//close db
//$person->Close_connection();
$deadline->Close_connection();
$course->Close_connection();
$approval->Close_connection();

$now = strtotime(date("Y-m-d"));
$start = strtotime($current_semester[0]['open_date']);
$end = strtotime($current_semester[0]['last_date']);




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
    <link rel="stylesheet" href="../dist/css/scrollbar.css">

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="../js/function.js"></script>
    <script src="../dist/js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="../dist/css/sweetalert2.min.css">
    <style >
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


  <body class="mybox">

    <div id="wrapper" style="padding-left: 30px; padding-right: 30px;">
      <div class="container">
    
        <div class="row">
          <center>
          <?php $approve_text="";
             if ($_SESSION['level']==6 || $_SESSION['admission']==1):
            $approve_text="อนุมัติ";
            ?>
            <h3 class="page-header">อนุมัติกระบวนวิชา</h3>
            <?php else:
            $approve_text="เห็นชอบ";?>
            <h3 class="page-header">ประเมินกระบวนวิชา</h3>
            <?php endif; ?>
          <?php  
          if ($now>$end) {
            echo  '<div class="alert alert-danger"><div class="glyphicon glyphicon-alert" style="color: red;font-size:18px;" ><b> สิ้นสุดเวลาในการ'.$approve_text.'<!DOCTYPE html></b></div><b style="color: red;font-size:16px;"></b> </div>';
            exit();
          }elseif ($now<$start) {
            echo  '<div class="alert alert-warning"><div class="glyphicon glyphicon-alert" style="color: red;font-size:18px;" ><b> ยังไม่ถึงเวลาในการ'.$approve_text.'<!DOCTYPE html></b></div><b style="color: red;font-size:16px;"></b> </div>';
            exit();
          }
           ?>
          </center>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h5 class="panel-title" style="font-size:14px">
              <b>ภาคการศึกษาที่ <?php echo $semeter['semester'] ?> ปีการศึกษา <?php echo $semeter['year'] ?></b>
          </h5>
          </div>
          <!-- .panel-heading -->
          <div class="panel-body">
          <?php
          if($_SESSION['level'] == 4 || $_SESSION['level'] == 5  || $_SESSION['level'] == 2 || $_SESSION['level'] == 3) {  ?>
              <?php if (isset($deadline_form['evaluate'])): ?>
                <div class="glyphicon glyphicon-alert" style="color: red;font-size:16px;"></div><b style="color: red;font-size:16px;"> วันสุดท้ายสำหรับประเมินกระบวนวิชา <?php echo $deadline_form['evaluate']['day'].' '.$deadline_form['evaluate']['month'].' '.$deadline_form['evaluate']['year']."<br>"; ?> </b>
              <?php endif; ?>
          <?php }
          if($_SESSION['level'] == 6  || $_SESSION['level'] == 2 || $_SESSION['level'] == 3)
          { ?>
            <?php if (isset($deadline_form['approve'])): ?>
              <div class="glyphicon glyphicon-alert" style="color: red;font-size:16px;"></div><b style="color: red;font-size:16px;"> วันสุดท้ายสำหรับอนุมัติกระบวนวิชา <?php echo $deadline_form['approve']['day'].' '.$deadline_form['approve']['month'].' '.$deadline_form['approve']['year']."<br>"; ?> </b>
            <?php endif; ?>
              <?php	} ?>
           
           
          </div>
          <!-- .panel-body -->
        </div>
      </div>
    </div>
    </div>
    <script type="text/javascript">
    function approve_course(course,type){
      var id = "<?php echo $_SESSION['id'] ?>";
      var text ="comment_"+course;
      var comment = document.getElementById(text).value;
      swal({
        title: 'แน่ใจหรือไม่',
        text: 'คุณต้องการยืนยันเพื่อส่งข้อมูลใช่หรือไม่',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ตกลง',
        cancelButtonText: 'ยกเลิก'
      }).then(function () {
        $.ajax({
            url: '../../application/approval/approve.php',
            type: 'POST',
            data:
            {
              course_id:course,
              status:type,
              teacher:id,
              comment:comment
            },
            beforeSend: function() {
             swal({
                     title: 'กรุณารอสักครู่',
                     text: 'ระบบกำลังประมวลผล',
                     allowOutsideClick: false
                   })
             swal.showLoading();
            },
            success:function(data){
              swal.hideLoading();
              try {
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
                }, 1000);
              } catch (e) {
                swal({
                  type:"error",
                  text: "ผิดพลาด ! กรุณาติดต่อผู้ดูแลระบบ",
                  timer: 2000,
                  confirmButtonText: "Ok!",
                });
              }
            }
        });
      }, function (dismiss) {
      if (dismiss === 'cancel') {}
    })

    }
    function approve_sp(course,teacherSp,type){

      var id = "<?php echo $_SESSION['id'] ?>";
      var text ="comment_sp_"+teacherSp;
      var comment = document.getElementById(text).value;
      swal({
        title: 'แน่ใจหรือไม่',
        text: 'คุณต้องการยืนยันเพื่อส่งข้อมูลใช่หรือไม่',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ตกลง',
        cancelButtonText: 'ยกเลิก'
      }).then(function () {
        $.ajax({
            url: '../../application/approval/approve.php',
            type: 'POST',
            data:
            {
              course_id:course,
              status:type,
              teacher:id,
              teachersp:teacherSp,
              comment:comment
            },
            beforeSend: function() {
              swal({
                title: 'กรุณารอสักครู่',
                text: 'ระบบกำลังประมวลผล',
                allowOutsideClick: false
              })
             swal.showLoading();
            },
            success:function(data){
              swal.hideLoading();
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
              }, 1000);
            }
        });
      }, function (dismiss) {
      if (dismiss === 'cancel') {}
    })



    }

    </script>
  </body>

  </html>

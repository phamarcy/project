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
if (isset($_SESSION['edithome'])) {
  if ($_SESSION['edithome']==1) {
    $_SESSION['level']=6;
  }
}
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

$data_forapproval=$approval->Get_Approval_Evaluate($_SESSION['id']);


$data_forapprovalsp=$approval->Get_Approval_Special($_SESSION['id']);
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

    <script type="text/javascript" src="../vendor/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="../js/function.js"></script>
    <script src="../vendor/core/core.js"></script>

    <script src="../dist/js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="../dist/css/sweetalert2.min.css">
    <style>
      i:hover {
        font-size: 30px;
        font-weight: bold;
        color: red;
      }

      #statcf {
        color: #0e9d14;
      }

      #statn {
        color: #ec2c2c;
      }

      #statwt {
        color: #acb500;
      }

      #statal {
        color: #da9001;
      }
      .spec{
			margin-top: -23px;
      }
      .forminline{
        display:inline-block;
        margin:0;
      }
      .pull-right {
        margin-top: 0px;
      }
      .eva{
        margin-top: 0px;
      }
      .checkbox{
        display:inline-block;
        margin-top:5px;
      }

      @media only screen and (max-width: 500px) {
        .textarea{
          margin-top: 0px;
        }
      }
    </style>
  </header>


  <body class="mybox">

    <div id="wrapper" style="padding-left: 30px; padding-right: 30px;">
      <div class="container">
        <div class="row">
          <center>
            <h3 class="page-header">อนุมัติกระบวนวิชา</h3>

            <?php
          if ($now>$end) {
            echo  '<div class="alert alert-danger"><div class="glyphicon glyphicon-alert" style="color: red;font-size:18px;" ><b> สิ้นสุดเวลาในการอนุมัติ<!DOCTYPE html></b></div><b style="color: red;font-size:16px;"></b> </div>';
            exit();
          }elseif ($now<$start) {
            echo  '<div class="alert alert-warning"><div class="glyphicon glyphicon-alert" style="color: red;font-size:18px;" ><b> ยังไม่ถึงเวลาในการอนุมัติ<!DOCTYPE html></b></div><b style="color: red;font-size:16px;"></b> </div>';
            exit();
          }
           ?>
          </center>

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
                <?php } ?>
                <div class="container col-md-12">
                <ul class="nav nav-tabs" id="myTab" style="font-size:14px">
                  <li class="active"><a data-toggle="tab" data-target="#subject" >กระบวนวิชา</a></li>
                  <li><a data-toggle="tab" data-target="#sp" >อาจารย์พิเศษ</a></li>
                </ul>
                  <div class="tab-content col-md-12">
                    <div id="subject" class="tab-pane fade in active">
                      <br>
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="pull-right">
                        <label style="font-size:14px"><input type="checkbox" name="checkedAll" id="checkedAll" >ทั้งหมด</label>
                        </div>
                      </div>
                      <hr>
                      <div class="col-md-12 ">
                        <?php
                        foreach ($data_forapproval as $key => $eva) { ?>
                          <div class="panel-group">
                            <div class="panel panel-default">
                              <div class="panel-heading clearfix">
                                <h5 class="panel-title pull-left" style="font-size:14px;padding-top:8px;">
                                  <a data-toggle="collapse" href="#collapse<?php echo $eva['id']?>">
                                    <?php echo $eva['id']."  ".$eva['name']; ?>
                                  </a>
                                </h5>
                                <div class="btn-group pull-right eva">
                                  <div class="forminline">
                                  <?php if (isset($eva['syllabus']) ): ?>
                                    <a href="../../files<?php echo $eva['syllabus'] ?>" target="_blank" TITLE="คลิ็ก ! เพื่ดเปิดPDF"><button type="button" class="btn btn-default btn-sm" >ดาวน์โหลดหลักสูตร</button></a>
                                    <?php endif; ?>
                                    <?php if (isset($eva['evaluate'])): ?>
                                    <a href="<?php echo $eva['evaluate'] ?>" target="_blank" TITLE="คลิ็ก ! เพื่ดเปิดPDF"><button type="button" class="btn btn-default btn-sm" >ดาวน์โหลดแบบแจ้ง</button></a>
                                    <?php endif; ?>

                                    <a type="button" class="btn  btn-success btn-sm" data-toggle="collapse" href="#collapse<?php echo $eva['id'] ?>">อนุมัติ</a>
                                      <input type="checkbox" name="coursecheck" id="checkedAll" class="checkSingle" value="<?php echo $eva['id']?>"></input>
                                  </div>
                                </div>

                              </div>
                              <div id="collapse<?php echo $eva['id']?>" class="panel-collapse collapse " style="font-size:14px">
                                <div class="panel-body">
                                <?php  if ($eva['status']==0) { ?>
                                  <form id="approve_course" method="post">

                                    <div class="form-group ">
                                      <label for="">ข้อเสนอแนะ</label>
                                      <textarea class="form-control" name="name" rows="8" cols="40" id="comment_<?php echo $eva['id'] ?>"></textarea>
                                    </div>
                                    <div class="form-group">
                                      <button type="button" class="btn  btn-success " onclick="approve_course('<?php echo $eva['id'] ?>','approve')">อนุมัติ</button>&nbsp;
                                      <button type="button" class="btn  btn-danger " onclick="approve_course('<?php echo $eva['id'] ?>','edit')">มีการแก้ไข</button>
                                    </div>
                                  </form>
                                  <?php }?>
                                  <table class="table " style="font-size:14px">
                                    <thead>
                                      <?php if ($_SESSION['level'] > 1  || $_SESSION['admission']==1): ?>
                                      <th style="width:300px">คณะกรรมการ</th>
                                      <?php endif; ?>
                                      <th>ข้อเสนอแนะ</th>
                                      <th>วัน/เวลา</th>
                                    </thead>
                                    <tbody>
                                      <?php foreach ($eva['comment'] as $key => $commenteva) { ?>
                                        <tr>
                                            <td>
                                              <?php echo $commenteva['name']; ?>
                                            </td>
                                            <td>
                                              <?php if ($commenteva['comment']==null) {
                                                echo "-";
                                              }else {
                                                echo $commenteva['comment'];
                                              } ?>
                                            </td>
                                            <td>
                                              <?php echo $commenteva['date']; ?>
                                            </td>
                                        </tr>
                                      <?php } ?>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>

                          </div>
                          <?php
                        }
                        ?>
                        <div class="pull-right">
                          <button type="button" class="btn btn-success  " onclick="get_selectall()">ยืนยัน</button>
                        </div>
                      </div>
                      <!-- col 12-->

                    </div>
                    <div id="sp" class="tab-pane fade">
                      <br>
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="pull-right">
                          <label style="font-size:14px"><input type="checkbox" name="checkedAllsp" id="checkedAllsp" >ทั้งหมด</label>
                        </div>
                      </div>
                      <hr>

                      <div class="col-md-12 ">
                        <?php foreach ($data_forapprovalsp as $keysp => $sp) {  ?>
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h5 class="panel-title" style="font-size:14px">
                              <?php echo $sp['id']." ".$sp['name'] ?>
                            </h5>

                          </div>
                          <div class="panel-body">
                            <?php foreach ($sp['instructor'] as $keycom => $spcomment) { ?>
                            <div class="panel-group">
                              <div class="panel panel-default">
                                <div class="panel-heading clearfix">
                                  <h5 class="panel-title pull-left" style="font-size:14px;padding-top:8px;">
                                    <a data-toggle="collapse" href="#collapsesp<?php echo $sp['id'].$spcomment['id'] ?>">
                                      <?php echo $spcomment['name'] ?>
                                    </a>


                                  </h5>
                                  <div class="btn-group pull-right eva">
                                    <div class="forminline">
                                    <?php if (isset($spcomment['pdf']) ): ?>
                                    <a href="<?php echo $spcomment['pdf'] ?>" target="_blank" TITLE="คลิ็ก ! เพื่ดเปิดPDF"><button type="button" class="btn btn-default btn-sm" >ดาวน์โหลดแบบเชิญอาจารย์พิเศษ</button></a>
                                  <?php endif; ?>
                                  <?php if (isset($spcomment['cv']) ): ?>
                                    <a href="../../files<?php echo $spcomment['cv'] ?>" target="_blank" TITLE="คลิ็ก ! เพื่ดเปิดPDF"><button type="button" class="btn btn-default btn-sm" >ดาวน์โหลด CV</button></a>
                                  <?php endif; ?>
                                    <a type="button" class="btn  btn-success btn-sm" data-toggle="collapse" href="#collapsesp<?php echo $sp['id'].$spcomment['id'] ?>">อนุมัติ</a>&nbsp;
                                    <input type="checkbox" name="coursechecksp" id="checkedAllsp" class="checkSinglesp" value="<?php echo $sp['id']?>,<?php echo $spcomment['id']?>"></input>

                                    </div>
                                  </div>
                                </div>
                                <div id="collapsesp<?php echo $sp['id'].$spcomment['id'] ?>" class="panel-collapse collapse " style="font-size:14px">
                                  <div class="panel-body">
                                    <?php  if ($spcomment['status']==0) { ?>
                                    <form id="approve_course" method="post">
                                      <div class="form-group ">
                                        <label for="">ข้อเสนอแนะ</label>
                                        <textarea class="form-control" name="name" rows="8" cols="40" id="comment_sp_<?php echo $sp['id'].$spcomment['id'] ?>"></textarea>
                                      </div>
                                      <div class="form-group">
                                        <button type="button" class="btn  btn-success " onclick="approve_sp('<?php echo $sp['id'] ?>','<?php echo $spcomment['id'] ?>','<?php echo $sp['id'].$spcomment['id'] ?>','approve_sp')">อนุมัติ</button>&nbsp;
                                        <button type="button" class="btn  btn-danger " onclick="approve_sp('<?php echo $sp['id'] ?>','<?php echo $spcomment['id'] ?>','<?php echo $sp['id'].$spcomment['id'] ?>','edit_sp')">มีการแก้ไข</button>
                                      </div>

                                    </form>
                                    <?php
                                    }?>
                                    <table class="table " style="font-size:14px">
                                      <thead>
                                        <?php if ($_SESSION['level'] > 1  || $_SESSION['admission']==1): ?>
                                        <th style="width:300px">คณะกรรมการ</th>
                                        <?php endif; ?>
                                        <th>ข้อเสนอแนะ</th>
                                        <th>วัน/เวลา</th>
                                      </thead>
                                      <tbody>
                                      <?php foreach ($spcomment['comment'] as $key => $commentsp) { ?>
                                        <tr>
                                            <td>
                                              <?php echo $commentsp['name']; ?>
                                            </td>
                                            <td>
                                              <?php if ($commentsp['comment']==null) {
                                                echo "-";
                                              }else {
                                                echo $commentsp['comment'];
                                              } ?>
                                            </td>
                                            <td>
                                              <?php echo $commentsp['date']; ?>
                                            </td>
                                        </tr>
                                      <?php } ?>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <?php }  ?>
                          </div>
                        </div>
                        <?php } ?>
                        <div class="pull-right">
                          <button type="button" class="btn btn-success  " onclick="get_selectallsp()">ยืนยัน</button>
                        </div>
                      </div>
                      <!--col 12-->
                    </div>
                  </div>
                </div>



            </div>
            <!-- .panel-body -->
          </div>
        </div>
      </div>
    </div>
    </div>
    <script type="text/javascript">
      $(function() {
      var lastTab = localStorage.getItem('lastTab');
      $('.container, .tab-content').removeClass('hidden');
      if (lastTab) {
        $('[data-target="' + lastTab + '"]').tab('show');
      }
      $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        localStorage.setItem('lastTab', $(this).data('target'));
      });
    });
      $(document).ready(function() {
        $("#checkedAll").change(function(){
          if(this.checked){
            $(".checkSingle").each(function(){
              this.checked=true;
            })
          }else{
            $(".checkSingle").each(function(){
              this.checked=false;
            })
          }
        });

        $(".checkSingle").click(function () {
          if ($(this).is(":checked")){
            var isAllChecked = 0;
            $(".checkSingle").each(function(){
              if(!this.checked)
                 isAllChecked = 1;
            })
            if(isAllChecked == 0){ $("#checkedAll").prop("checked", true); }
          }else {
            $("#checkedAll").prop("checked", false);
          }
        });
      });

      $(document).ready(function() {
        $("#checkedAllsp").change(function(){
          if(this.checked){
            $(".checkSinglesp").each(function(){
              this.checked=true;
            })
          }else{
            $(".checkSinglesp").each(function(){
              this.checked=false;
            })
          }
        });

        $(".checkSinglesp").click(function () {
          if ($(this).is(":checked")){
            var isAllChecked = 0;
            $(".checkSinglesp").each(function(){
              if(!this.checked)
                 isAllChecked = 1;
            })
            if(isAllChecked == 0){ $("#checkedAllsp").prop("checked", true); }
          }else {
            $("#checkedAllsp").prop("checked", false);
          }
        });
      });

      function get_selectall() {
        var course = [];
        $.each($("input[name='coursecheck']:checked"), function(){
            course.push($(this).val());
        });

        if (course.length==0) {
         swal({
          title: 'ผิดพลาด',
          text: 'กรุณาเลือกวิชา',
          type: 'error',

        })
        return;
        }

        swal({
          title: 'แน่ใจหรือไม่',
          text: 'คุณต้องการทั้งหมดใช่หรือไม่',
          type: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'ตกลง',
          cancelButtonText: 'ยกเลิก'
        }).then(function () {
          swal({
                title: 'กรุณารอสักครู่',
                text: 'ระบบกำลังประมวลผล',
                allowOutsideClick: false
              })
          swal.showLoading();
          var async_request=[];
          var responses=[];
          var comment="-";
          var type ="approve" ;
          var id = "<?php echo $_SESSION['id'] ?>";

          for(i in course)
          {
              async_request.push( $.ajax({
                url: '../../application/approval/approve.php',
                type: 'POST',
                async: true,
                data: {
                  course_id: course[i],
                  status: type,
                  teacher: id,
                  comment: comment
                },
                success: function (data) {
                  try {
                    var msg = JSON.parse(data)

                    responses.push(data);
                  } catch (e) {
                    console.log(data);
                    swal({
                      type: "error",
                      text: "ผิดพลาด ! กรุณาติดต่อผู้ดูแลระบบ",
                      timer: 2000,
                      confirmButtonText: "Ok!",
                    });
                  }
                }
              }));
          }

          $.when.apply(null, async_request).done( function(){
            swal.hideLoading();
            try {
                var msg = JSON.parse(responses[0])
                swal({
                  type: msg.status,
                  text: msg.msg,
                  timer: 2000,
                  confirmButtonText: "Ok!",
                }, function () {
                  window.location.reload();
                });
                setTimeout(function () {
                  window.location.reload();
                }, 2000);
              } catch (e) {
                swal({
                  type: "error",
                  text: "ผิดพลาด ! กรุณาติดต่อผู้ดูแลระบบ",
                  timer: 2000,
                  confirmButtonText: "Ok!",
                });
                console.log(responses);
              }
          });

        }, function (dismiss) {
          if (dismiss === 'cancel') {}
        })
      }

      function get_selectallsp() {

        var course = [];
        var tempcourseAndName=[];
        var purecourse=[];
        var purenamesp=[];
        $.each($("input[name='coursechecksp']:checked"), function(){
            course.push($(this).val());
        });

        for (var i=0; i < course.length ; i++) {
          tempcourseAndName[i]=course[i].split(",");
          purecourse.push(tempcourseAndName[i][0]);
          purenamesp.push(tempcourseAndName[i][1]);
        }

        if (course.length==0) {
         swal({
          title: 'ผิดพลาด',
          text: 'กรุณาเลือกอาจารย์พิเศษ',
          type: 'error',

        })
        return;
        }

        swal({
          title: 'แน่ใจหรือไม่',
          text: 'คุณต้องการยืนยันข้อมูลที่เลือกใช่หรือไม่',
          type: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'ตกลง',
          cancelButtonText: 'ยกเลิก'
        }).then(function () {
          swal({
                title: 'กรุณารอสักครู่',
                text: 'ระบบกำลังประมวลผล',
                allowOutsideClick: false
              })
          swal.showLoading();
          var async_request=[];
          var responses=[];
          var comment="-";
          var type ="approve_sp" ;
          var id = "<?php echo $_SESSION['id'] ?>";

          for(i in purecourse)
          {
              async_request.push( $.ajax({
                url: '../../application/approval/approve.php',
                type: 'POST',
                async: true,
                data: {
                  course_id: purecourse[i],
                  status: type,
                  teacher: id,
                  teachersp:purenamesp[i],
                  comment: comment
                },
                success: function (data) {
                  try {
                    var msg = JSON.parse(data)

                    responses.push(data);
                  } catch (e) {
                    swal({
                        type: "error",
                        text: "ผิดพลาด ! กรุณาติดต่อผู้ดูแลระบบ",
                        timer: 2000,
                        confirmButtonText: "Ok!",
                      });
                    console.log(data);
                  }
                }
              }));
          }

          $.when.apply(null, async_request).done( function(){
            swal.hideLoading();
            try {
                var msg = JSON.parse(responses[0])
                swal({
                  type: msg.status,
                  text: msg.msg,
                  timer: 2000,
                  confirmButtonText: "Ok!",
                }, function () {
                  window.location.reload();
                });
                setTimeout(function () {
                  window.location.reload();
                }, 1500);
              } catch (e) {
                console.log(responses);
                swal({
                  type: "error",
                  text: "ผิดพลาด ! กรุณาติดต่อผู้ดูแลระบบ",
                  timer: 2000,
                  confirmButtonText: "Ok!",
                });
              }

          });

        }, function (dismiss) {
          if (dismiss === 'cancel') {}
        })
      }

      function approve_course(course, type) {
        var id = "<?php echo $_SESSION['id'] ?>";
        var text = "comment_" + course;
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
            async: true,
            data: {
              course_id: course,
              status: type,
              teacher: id,
              comment: comment
            },
            beforeSend: function () {
              swal({
                title: 'กรุณารอสักครู่',
                text: 'ระบบกำลังประมวลผล',
                allowOutsideClick: false
              })
              swal.showLoading();
            },
            success: function (data) {
              swal.hideLoading();
              try {
                var msg = JSON.parse(data)
                swal({
                  type: msg.status,
                  text: msg.msg,
                  timer: 2000,
                  confirmButtonText: "Ok!",
                }, function () {
                  window.location.reload();
                });
                setTimeout(function () {
                  window.location.reload();
                }, 1500);
              } catch (e) {
                swal({
                  type: "error",
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

      function approve_sp(course, teacherSp,textarea, type) {

        var id = "<?php echo $_SESSION['id'] ?>";
        var text = "comment_sp_" + textarea;
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
            data: {
              course_id: course,
              status: type,
              teacher: id,
              teachersp: teacherSp,
              comment: comment
            },
            beforeSend: function () {
              swal({
                title: 'กรุณารอสักครู่',
                text: 'ระบบกำลังประมวลผล',
                allowOutsideClick: false
              })
              swal.showLoading();
            },
            success: function (data) {
              swal.hideLoading();
              var msg = JSON.parse(data)
              swal({
                type: msg.status,
                text: msg.msg,
                timer: 2000,
                confirmButtonText: "Ok!",
              }, function () {
                window.location.reload();
              });
              setTimeout(function () {
                window.location.reload();
              }, 1500);
            }
          });
        }, function (dismiss) {
          if (dismiss === 'cancel') {}
        })



      }
    </script>
  </body>

  </html>

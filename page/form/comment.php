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
$semeter= $deadline->Get_Current_Semester();
$department =$person->Get_Staff_Dep($_SESSION['id']);
$dep_js=$department['code'];
$assessor=$person->Search_Assessor($department['code']);
$list_course= $course->Get_Dept_Course($department['code'],$semeter['id']);
$history=$course->Get_History($department['code']);
$data_forapproval=$approval->Get_Approval_data($_SESSION['id']);
echo "<pre>";
print_r($data_forapproval);
echo "</pre>";
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
             if ($_SESSION['level']==6):
            $approve_text="อนุมัติ";
            ?>
            <h3 class="page-header">อนุมัติกระบวนวิชา</h3>
            <?php else:
            $approve_text="เห็นชอบ";?>
            <h3 class="page-header">ประเมินกระบวนวิชา</h3>
            <?php endif; ?>
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

            <div class="table-responsive">
              <table class="table " style="font-size:14px;">
                <thead>
                  <tr>
                    <th>ลำดับ</th>
                    <th>รหัสวิชา</th>
                    <th>ชื่อวิชา</th>
                    <th style="text-align:center;">Course</th>
                    <th style="text-align:center;">Evaluate</th>
                    <th style="text-align:center;">สถานะการ<?php echo $approve_text ?></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <?php if (is_array($data_forapproval) || is_object($data_forapproval)): ?>
                <?php foreach ($data_forapproval as $key => $value): ?>
                  <tr>
                    <td><?php echo $key+1 ?></td>
                    <td><?php echo $value['id'] ?></td>
                    <td><?php echo $value['name'] ?></td>
                    <td style="text-align:center;">
                      <?php if (isset($value['syllabus']) ): ?>
                          <a href="<?php echo $value['syllabus'] ?>" target="_blank" TITLE="คลิ็ก ! เพื่ดเปิดPDF"><i type="button" class="fa fa-file-pdf-o fa-2x " ></i></a>
                      <?php endif; ?>
                    </td>
                    <td style="text-align:center;">
                      <?php if (isset($value['evaluate']) ): ?>
                          <a href="../../file/<?php echo $value['evaluate'] ?>" target="_blank" TITLE="คลิ็ก ! เพื่ดเปิดPDF"><i type="button" class="fa fa-file-pdf-o fa-2x " ></i></a>
                      <?php endif; ?>

                    </td>
                    <td align="center"><?php if($value['status']==0){echo '<i id="statn" class="fa fa-user-times fa-2x" aria-hidden="true"></i>';}else{echo '<i id="statcf" class="fa fa-check-circle fa-2x" aria-hidden="true"></i>';}?></td>
                    <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#<?php echo $value['id'] ?>" class="accordion-toggle">ดูข้อมูล</button></td>
                  </tr>
                  <tr class="hiddenRow">
                    <td colspan="12">
                      <div class="accordian-body collapse" id="<?php echo $value['id'] ?>">
                        <div class="panel panel-success">
                          <div class="panel-heading" style="font-size:14px;">
                            <b>ข้อเสนอแนะคณะกรรมการ</b>
                          </div>
                          <div class="panel-body">
                            <div class="panel-group" id="comment<?php echo $value['id'] ?>">
                              <div class="panel panel-default">
                                <div class="panel-heading" >
                                  <div class="panel-title" style="font-size:14px">
                                      <a data-toggle="collapse" data-parent="#comment<?php echo $value['id'] ?>" href="#comment<?php echo $value['id'] ?>-2"><b>แบบแจ้งวิธีการวัดผลและประเมินผลการศึกษา</b></a>

                                  </div>
                                </div>
                                <div id="comment<?php echo $value['id'] ?>-2" class="panel-collapse collapse">
                                  <div class="panel-body">
                                    <form id="approve_course" action="index.html" method="post">
                                      <div class="form-group ">
                                        <label for="">ข้อเสนอแนะ</label>
                                        <textarea class="form-control" name="name" rows="8" cols="40" id="comment_<?php echo $value['id'] ?>"></textarea>
                                      </div>
                                      <div class="form-group">
                                        <button type="button" class="btn btn-outline btn-success " onclick="approve_course(<?php echo $value['id'] ?>,'approve')"><?php echo $approve_text; ?></button> &nbsp;
                                        <button type="button" class="btn btn-outline btn-danger " onclick="approve_course(<?php echo $value['id'] ?>,'edit')">มีการแก้ไข</button>
                                      </div>
                                    </form>

                                    <table class="table " style="font-size:14px">
                                      <thead>
                                        <?php if ($_SESSION['level'] > 1 ): ?>
                                        <th style="width:230px">คณะกรรมการ</th>
                                        <?php endif; ?>
                                        <th>ข้อเสนอแนะ</th>
                                      </thead>
                                      <tbody>
                                        <?php foreach ($value['comment'] as $keycomment => $valuecomment): ?>
                                          <tr>
                                            <?php if ($_SESSION['level'] > 1 ): ?>
                                            <td style="width:230px"><?php echo $valuecomment['name'] ?></td>
                                            <?php endif; ?>
                                            <td><?php if (($valuecomment['comment'])!="") {
                                              echo $valuecomment['comment'];
                                            }else {
                                              echo "-";
                                            } ?></td>
                                          </tr>
                                        <?php endforeach; ?>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                              <?php if (isset($value['special'])): ?>

                                <div class="panel panel-default">
                                  <div class="panel-heading ">
                                    <div class="panel-title" style="font-size:14px">
                                        <a data-toggle="collapse" data-parent="#commentsp<?php echo $value['id'] ?>" href="#commentsp<?php echo $value['id'] ?>"><b>แบบเชิญอาจารย์พิเศษ</b></a>
                                    </div>
                                  </div>

                                  <div id="commentsp<?php echo $value['id'] ?>" class="panel-collapse collapse">
                                    <div class="panel-body">
                                      <div class="panel-group" id="teachersp<?php echo $value['id'] ?>">
                                        <?php foreach ($value['special']as $keysp => $valuesp): ?>
                                        <div class="panel panel-default">
                                          <div class="panel-heading" >
                                            <div class="panel-title" style="font-size:14px">
                                                <a data-toggle="collapse" data-parent="#teachersp<?php echo $value['id'] ?>" href="#teachersp<?php echo $value['id']."-".$keysp ?>"><?php echo $valuesp['name'] ?></a>
                                                <a href="" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a> &nbsp;
                                            </div>
                                          </div>
                                          <div id="teachersp<?php echo $value['id']."-".$keysp ?>" class="panel-collapse collapse">
                                            <div class="panel-body">
                                              <div class="form-group ">
                                                <label for="">ข้อเสนอแนะ</label>
                                                <textarea class="form-control" name="name" rows="8" cols="40" id="comment_sp_<?php echo $valuesp['id'] ?>"></textarea>
                                              </div>
                                              <div class="form-group">
                                                <button type="button" class="btn btn-outline btn-success " onclick="approve_sp(<?php echo $value['id'] ?>,'<?php echo $valuesp['id'] ?>','approve_sp')"><?php echo $approve_text; ?></button> &nbsp;
                                                <button type="button" class="btn btn-outline btn-danger " onclick="approve_sp(<?php echo $value['id'] ?>,'<?php echo $valuesp['id'] ?>','edit_sp')">มีการแก้ไข</button>
                                              </div>
                                              <table class="table " style="font-size:14px">
                                                <thead>
                                                  <?php if ($_SESSION['level'] > 1 ): ?>
                                                  <th style="width:230px">คณะกรรมการ</th>
                                                  <?php endif; ?>
                                                  <th>ข้อเสนอแนะ</th>
                                                </thead>
                                                <tbody>
                                                  <?php foreach ($valuesp['comment'] as $keycom => $valuecom): ?>
                                                    <tr>
                                                      <?php if ($_SESSION['level'] > 1 ): ?>
                                                      <td style="width:230px"><?php echo $valuecom['name'] ?></td>
                                                      <?php endif; ?>
                                                      <td><?php if (($valuecom['comment'])!="") {
                                                        echo $valuecom['comment'];
                                                      }else {
                                                        echo "-";
                                                      } ?></td>
                                                    </tr>
                                                  <?php endforeach; ?>


                                                </tbody>
                                              </table>
                                            </div>
                                          </div>
                                        </div>
                                        <?php endforeach; ?>

                                      </div>
                                    </div>
                                  </div>
                                </div>

                              <?php endif; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
              </table>

            </div>
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
          success:function(data){
            console.log(data);
          }
      });

    }
    function approve_sp(course,teacherSp,type){

      var id = "<?php echo $_SESSION['id'] ?>";
      var text ="comment_sp_"+teacherSp;
      var comment = document.getElementById(text).value;

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
          success:function(data){
            console.log(data);
          }
      });

    }

    </script>
  </body>

  </html>

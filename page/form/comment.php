<?php
session_start();
if(!isset($_SESSION['level']) || !isset($_SESSION['fname']) || !isset($_SESSION['lname']) || !isset($_SESSION['id']))
{
    die('กรุณา Login ใหม่');
}
require_once(__DIR__."/../../application/class/person.php");
require_once(__DIR__.'/../../application/class/manage_deadline.php');
require_once(__DIR__."/../../application/class/course.php");
$person = new Person();
$deadline = new Deadline();
$course = new course();

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


    <!--ใช้ตัวนี้-->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
    <style >
    i:hover {
      font-size: 30px;
      font-weight: bold;
      color: red;
    }
    </style>
  </header>


  <body class="mybox">
    <script type="text/javascript">
    function approve_course(course,type){
      var teacher = <?php echo $teacher_id ?>

      $.ajax({
          url: '../../approval/approve.php',
          data:{type:type,teacher_id:}
          type: 'POST',
          success:function(data){
            console.log(data);
          }
      });

    }
    function approve_sp(course,teacherSp,type){

      $.ajax({
          url: '../../approval/approve.php',
          type: 'POST',
          success:function(data){

          }
      });

    }
    $("#data").submit(function(){
        var file = document.forms['data']['file'].files[0];

        $.ajax({
            url: '../../approve/approve.php',
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
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
              }, 3000);

            }
        });

        return false;
    });
    </script>
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
              <b>ภาคการศึกษาที่ 2 ปีการศึกษา 2560</b>
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
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>202141</td>
                    <td>BIOLOGY FOR PHARMACY STUDENTS</td>
                    <td style="text-align:center;">
                      <a href="../../application/pdf/view.php?course=462452&info=syllabus" target="_blank" TITLE="คลิ็ก ! เพื่ดเปิดPDF"><i type="button" class="fa fa-file-pdf-o fa-2x " ></i></a>
                    </td>
                    <td style="text-align:center;">
                      <a href="../../application/pdf/view.php?course=462452&type=draft&info=evaluate" target="_blank" TITLE="คลิ็ก ! เพื่ดเปิดPDF"><i type="button" class="fa fa-file-pdf-o fa-2x " ></i></a>
                    </td>
                    <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#202141" class="accordion-toggle">ดูข้อมูล</button></td>
                  </tr>
                  <tr class="hiddenRow">
                    <td colspan="12">
                      <div class="accordian-body collapse" id="202141">
                        <div class="panel panel-success">
                          <div class="panel-heading" style="font-size:14px;">
                            <b>ข้อเสนอแนะคณะกรรมการ</b>
                          </div>
                          <div class="panel-body">
                            <div class="panel-group" id="comment202141">
                              <div class="panel panel-default">
                                <div class="panel-heading" >
                                  <div class="panel-title" style="font-size:14px">
                                      <a data-toggle="collapse" data-parent="#comment202141" href="#comment202141-2"><b>แบบแจ้งวิธีการวัดผลและประเมินผลการศึกษา</b></a>

                                  </div>
                                </div>
                                <div id="comment202141-2" class="panel-collapse collapse">
                                  <div class="panel-body">
                                    <div class="form-group ">
                                      <label for="">ข้อเสนอแนะ</label>
                                      <textarea class="form-control" name="name" rows="8" cols="40"></textarea>
                                    </div>

                                    <div class="form-group">
                                      <button type="button" class="btn btn-outline btn-success " onclick="approve_course(,'approve')"><?php echo $approve_text; ?></button> &nbsp;
                                      <button type="button" class="btn btn-outline btn-danger " onclick="approve_course(,'edit')">มีการแก้ไข</button>
                                    </div>
                                    <table class="table " style="font-size:14px">
                                      <thead>
                                        <?php if ($_SESSION['level'] > 4 ): ?>
                                        <th style="width:230px">คณะกรรมการ</th>
                                        <?php endif; ?>
                                        <th>ข้อเสนอแนะ</th>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <?php if ($_SESSION['level'] > 4 ): ?>
                                          <td style="width:230px">ศ.อรรคพล ธรรมฉันธะ</td>
                                          <?php endif; ?>
                                          <td>วิธีตัดเกรดในส่วนของการอิงเกณฑ์นั้นยังไม่ชัดเจน</td>
                                        </tr>
                                        <tr>
                                          <?php if ($_SESSION['level'] > 4 ): ?>
                                          <td style="width:230px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                          <?php endif; ?>
                                          <td>ควรเพิ่มอาจารย์ปฏิบัติการ</td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                              <div class="panel panel-default">
                                <div class="panel-heading ">
                                  <div class="panel-title" style="font-size:14px">
                                      <a data-toggle="collapse" data-parent="#comment202141" href="#comment202141-3"><b>แบบเชิญอาจารย์พิเศษ</b></a>
                                  </div>
                                </div>
                                <div id="comment202141-3" class="panel-collapse collapse">
                                  <div class="panel-body">
                                    <div class="panel-group" id="teachersp202141">
                                      <div class="panel panel-default">
                                        <div class="panel-heading" >
                                          <div class="panel-title" style="font-size:14px">
                                              <a data-toggle="collapse" data-parent="#teachersp202141" href="#teachersp202141-1">ดร.พจมาน ชำนาญกิจ</a>
                                              <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a> &nbsp;

                                          </div>
                                        </div>
                                        <div id="teachersp202141-1" class="panel-collapse collapse">
                                          <div class="panel-body">
                                            <div class="form-group ">
                                              <label for="">ข้อเสนอแนะ</label>
                                              <textarea class="form-control" name="name" rows="8" cols="40"></textarea>
                                            </div>

                                            <div class="form-group">
                                              <button type="button" class="btn btn-outline btn-success " onclick="approve_sp(,,'edit')"><?php echo $approve_text; ?></button> &nbsp;
                                              <button type="button" class="btn btn-outline btn-danger " onclick="approve_sp(,,'edit')">มีการแก้ไข</button>
                                            </div>
                                            <table class="table " style="font-size:14px">
                                              <thead>
                                                <?php if ($_SESSION['level'] > 4 ): ?>
                                                <th style="width:230px">คณะกรรมการ</th>
                                                <?php endif; ?>
                                                <th>ข้อเสนอแนะ</th>
                                              </thead>
                                              <tbody>
                                                <tr>
                                                  <?php if ($_SESSION['level'] > 4 ): ?>
                                                  <td style="width:230px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                  <?php endif; ?>
                                                  <td>อาจารย์ไม่ยังไม่เหมาะกับวิชา</td>
                                                </tr>
                                                <tr>
                                                  <?php if ($_SESSION['level'] > 4 ): ?>
                                                  <td style="width:230px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                  <?php endif; ?>
                                                  <td>อาจารย์เคยมีประสบการณ์</td>
                                                </tr>
                                              </tbody>
                                            </table>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="panel panel-default">
                                        <div class="panel-heading" >
                                          <div class="panel-title" style="font-size:14px">
                                                                  <a data-toggle="collapse" data-parent="#teachersp202141" href="#teachersp202141-2">ผศ.ดร.พนมพร จินดาสมุทร์</a>
                                                                  <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank"><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a> &nbsp;

                                                              </div>
                                        </div>
                                        <div id="teachersp202141-2" class="panel-collapse collapse">
                                          <div class="panel-body">
                                            <div class="form-group ">
                                              <label for="">ข้อเสนอแนะ</label>
                                              <textarea class="form-control" name="name" rows="8" cols="40"></textarea>


                                            </div>

                                            <div class="form-group">
                                              <button type="button" class="btn btn-outline btn-success "><?php echo $approve_text; ?></button> &nbsp;
                                              <button type="button" class="btn btn-outline btn-danger ">มีการแก้ไข</button>
                                            </div>
                                            <table class="table " style="font-size:14px">
                                              <thead>
                                                <?php if ($_SESSION['level'] > 4 ): ?>
                                                <th style="width:230px">คณะกรรมการ</th>
                                                <?php endif; ?>
                                                <th>ข้อเสนอแนะ</th>
                                              </thead>
                                              <tbody>
                                                <tr>
                                                  <?php if ($_SESSION['level'] > 4 ): ?>
                                                  <td style="width:230px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                  <?php endif; ?>
                                                  <td>อาจารย์ท่านนี้เหมาะสมกับวิชานี้</td>
                                                </tr>
                                                <tr>
                                                  <?php if ($_SESSION['level'] > 4 ): ?>
                                                  <td style="width:230px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                  <?php endif; ?>
                                                  <td>อาจารย์ท่านนี้เป็นผู้มีประสบการณ์</td>
                                                </tr>
                                              </tbody>
                                            </table>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="panel panel-default">
                                        <div class="panel-heading" >
                                          <div class="panel-title" style="font-size:14px">
                                              <a data-toggle="collapse" data-parent="#teachersp202141" href="#teachersp202141-3">อ.พรพิมล ศิวินา</a>
                                              <a href="../../application/pdf/view.php?id=0000001&type=draft&info=special" target="_blank" ><i type="button" class="fa fa-file-pdf-o fa-2x" ></i></a> &nbsp;
                                          </div>
                                        </div>
                                        <div id="teachersp202141-3" class="panel-collapse collapse">
                                          <div class="panel-body">
                                            <div class="form-group ">
                                              <label for="">ข้อเสนอแนะ</label>
                                              <textarea class="form-control" name="name" rows="8" cols="40"></textarea>


                                            </div>
                                            <table class="table " style="font-size:14px">
                                              <thead>
                                                <?php if ($_SESSION['level'] > 4 ): ?>
                                                <th style="width:230px">คณะกรรมการ</th>
                                                <?php endif; ?>
                                                <th>ข้อเสนอแนะ</th>
                                              </thead>
                                              <tbody>
                                                <tr>
                                                  <?php if ($_SESSION['level'] > 4 ): ?>
                                                  <td style="width:230px">ศ.อรรคพล ธรรมฉันธะ</td>
                                                  <?php endif; ?>
                                                  <td>อาจารย์ท่านนี้ยังไม่มีประสบการณ์</td>
                                                </tr>
                                                <tr>
                                                  <?php if ($_SESSION['level'] > 4 ): ?>
                                                  <td style="width:230px">ดร.ชูศักดิ์ ธรรมฉันธะ</td>
                                                  <?php endif; ?>
                                                  <td>ควรทดลองให้อาจารย์มาสอนก่อน</td>
                                                </tr>
                                              </tbody>
                                            </table>
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
                    </td>
                  </tr>
                </tbody>
              </table>

            </div>
          </div>
          <!-- .panel-body -->
        </div>
      </div>
    </div>
    </div>

  </body>

  </html>

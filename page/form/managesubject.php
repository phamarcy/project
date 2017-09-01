<?php
session_start();
require_once(__DIR__."/../../application/class/person.php");
require_once(__DIR__.'/../../application/class/manage_deadline.php');
require_once(__DIR__."/../../application/class/course.php");
$person = new Person();
$deadline = new Deadline;
$course = new course;
$semeter= $deadline->Get_Current_Semester();
$department =$person->Get_Staff_Dep($_SESSION['id']);
$dep_js=$department['code'];
$assessor=$person->Search_Assessor($department['code']);
$list_course= $course->Get_Dept_Course($department['code'],$semeter['id']);
$history=$course->Get_History();
echo "<pre>";
print_r($history);
echo "</pre>";
 ?>
<html>
  <head>
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
    <link rel="stylesheet" href="../dist/css/scrollbar.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

    <script src="../vendor/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    <script type="text/javascript" src="../dist/js/bootstrap-filestyle.min.js"></script>
    <script type="text/javascript" src="../js/function.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="../dist/js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="../dist/css/sweetalert2.min.css">

    <title></title>
    <style>
    .panel-heading {
      margin-top: 0px;
      margin-bottom: 0px;
    }

    </style>
  </head>
  <body>

  <h3 class="page-header" style="margin-bottom: 0px;"><center><b>จัดการกระบวนวิชา</b></center></h3>
    <div class="container" style="margin-top:30px">
      <div class="panel panel-default">
        <div class="panel-heading">
          <b>ภาคเรียนที่ <?php echo $semeter['semester'];?> &nbsp;ปีการศึกษา <?php echo $semeter['year']." ";?><?php echo $department['name'] ?></b>
        </div>
        <div class="panel-body">
        <div class="row">
              <div class="col-md-12">
                <div class="panel panel-default">
                  <div class="panel-heading">
                      <b>คณะกรรมการผู้รับผิดชอบ</b>
                  </div>
                  <div class="panel-body">
                    <div class="form-group">
                      <div class="row">
                          <div class="col-md-6">
                            <table class="table" style="font-size:14px;"s>
                                <thead>
                                  <th>ลำดับ</th>
                                  <th>ชุดคณะกรรมการ</th>
                                  <th style="text-align:center;">รายชื่อคณะกรรมการ</th>
                                  <th></th>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>1</td>
                                    <td>คณะกรรมการชุดที่ 1</td>
                                    <td style="text-align:center;"><button type="button" name="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#set1" class="accordion-toggle">รายชื่อ</button></td>
                                  </tr>
                                  <tr class="hiddenRow">

                                    <td colspan="6">
                                      <div class="accordian-body collapse" id="set1">
                                        <div class="panel panel-info">
                                          <div class="panel-heading" style="font-size:14px;">
                                              คณะกรรมการชุดที่ 1
                                          </div>
                                          <div class="panel-body" style="font-size:14px;">
                                        <div class="form-group">
                                          <form  id="data"  method="post" data-toggle="validator" role="form" >

                                              <label for="">เพิ่มคณะกรรมการ</label>
                                              <div class="form-inline">
                                                <input type="text" class="form-control " name="teacher" id="TEACHERLEC_1" list="dtl1" placeholder="ชื่อ-นามสกุล" size="35" onkeydown="searchname(1,'committee');" required>
                                                <input type="hidden" name="group" value="1">
                                                <input type="hidden" name="type" value="add">
                                                <input type="hidden" name="department" value="<?php echo $department['code']  ?>">
                                                <button type="submit" name="submit" class="btn btn-outline btn-primary">เพิ่ม</button>
                                              </div>
                                              <datalist id="dtl1"></datalist>
                                         </form>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                          <table class="table" style="font-size:14px">
                                            <thead>
                                              <th>ลำดับ</th>
                                              <th>ชื่อ-นามสกุล</th>
                                              <th></th>
                                            </thead>
                                            <tbody>

                                                  <?php foreach ($assessor[0]['assessor'] as $key_assessor => $assessor_name): ?>
                                                    <form id='data'  method="post">
                                                      <input type="hidden" name="teacher"  id="name_assessor" value="<?php echo $assessor_name ?>">
                                                      <input type="hidden" name="type" id="remove_assessor"  value="remove">
                                                      <input type="hidden" name="group" value="1">
                                                      <input type="hidden" name="department" value="<?php echo $department['code']  ?>">
                                                    <tr>
                                                        <td><?php echo $key_assessor+1; ?></td>
                                                        <td><?php echo $assessor_name ?></td>
                                                        <td><button type="submit" name="button" class="btn btn-outline btn-danger" value='delete'>ลบ</button></td>
                                                    </tr>
                                                    </form>
                                                  <?php endforeach; ?>

                                            </tbody>
                                          </table>
                                        </div>

                                        </div>
                                      </div>
                                      </td>
                                  </tr>
                                </tbody>
                            </table>
                          </div>
                          <div class="col-md-6">
                            <table class="table" style="font-size:14px;">
                                <thead>
                                  <th>ลำดับ</th>
                                  <th>ชุดคณะกรรมการ</th>
                                  <th style="text-align:center;">รายชื่อคณะกรรมการ</th>
                                  <th></th>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>1</td>
                                    <td>คณะกรรมการชุดที่ 2</td>
                                    <td style="text-align:center;"><button type="button" name="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#set2" class="accordion-toggle">รายชื่อ</button></td>
                                  </tr>
                                  <tr class="hiddenRow">

                                    <td colspan="6">
                                      <div class="accordian-body collapse" id="set2">
                                        <div class="panel panel-info">
                                          <div class="panel-heading">
                                              คณะกรรมการชุดที่ 2
                                          </div>
                                          <div class="panel-body">
                                        <div class="form-group">
                                          <div class="form-inline">

                                            <form id="data"  method="post">
                                                <label for="">เพิ่มคณะกรรมการ</label>
                                                <div class="form-inline">
                                                  <input type="text" class="form-control " name="teacher" id="TEACHERLEC_2" list="dtl2" placeholder="ชื่อ-นามสกุล" size="35" onkeydown="searchname(2,'committee');" >
                                                  <input type="hidden" name="group" value="2">
                                                  <input type="hidden" name="type" value="add">
                                                  <input type="hidden" name="department" value="<?php echo $department['code']  ?>">
                                                  <button type="submit" name="button" class="btn btn-outline btn-primary">เพิ่ม</button>
                                                </div>

                                                <datalist id="dtl2"></datalist>
                                           </form>
                                          </div>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                          <table class="table" style="font-size:14px;">
                                            <thead>
                                              <th>ลำดับ</th>
                                              <th>ชื่อ-นามสกุล</th>
                                              <th></th>
                                            </thead>
                                            <tbody>

                                                  <?php foreach ($assessor[1]['assessor'] as $key_assessor => $assessor_name): ?>
                                                    <form id='data'  method="post">
                                                      <input type="hidden" name="teacher"  id="name_assessor" value="<?php echo $assessor_name ?>">
                                                      <input type="hidden" name="type" id="remove_assessor"  value="remove">
                                                      <input type="hidden" name="group" value="2">
                                                      <input type="hidden" name="department" value="<?php echo $department['code']  ?>">
                                                    <tr>
                                                        <td><?php echo $key_assessor+1; ?></td>
                                                        <td><?php echo $assessor_name ?></td>
                                                        <td><button type="submit" name="button" class="btn btn-outline btn-danger" value='delete'>ลบ</button></td>
                                                    </tr>
                                                    </form>
                                                  <?php endforeach; ?>

                                            </tbody>
                                          </table>
                                        </div>

                                        </div>
                                      </div>
                                      </td>
                                  </tr>
                                </tbody>
                            </table>
                          </div>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <b>ข้อมูลกระบวนวิชาในสังกัดย้อนหลัง</b>
                        </div>
                        <div class="panel-body">
                          <div class="form-inline">
                            <center>
                              <form id="history">
                                <?php foreach ($history as $key => $value): ?>
                                  <button type="submit" name="semester_history" class="btn btn-outline btn-primary " id="semester_history<?php echo $key ?> "  onclick="submitForm('<?php echo $value['id']?>')"><b><?php echo $value['semester'].'/'.$value['year'] ?></b></button>
                                <?php endforeach; ?>
                              </form>
                            </center>
                          </div>
                        </div>
                      </div>
                    </div>
              </div>
              </div>
          </div>
          <!--<?php if (isset($old_course)): ?>
            <div class="panel panel-default">
              <div class="panel-heading">
                <b>กระบวนวิชาที่สังกัดในภาควิชา (ย้อนหลัง) 1/2559</b>
              </div>
              <div class="panel-body">
                <center>
                <button type="button" class="btn btn-outline btn-primary btn-lg " id="submit"  name="submit">นำไปใช้</button>
                </center>
                <hr>
                <table class="table table-hover" style="font-size:14px">
                  <col width="130">
                  <col width="80">
                  <thead>
                      <tr>
                          <th width="10%">รหัสวิชา</th>
                          <th width="65%">ชื่อวิชา</th>
                          <th width="5%"></th>
                          <th width="5%"></th>
                      </tr>
                  </thead>
                  <tbody style="font-size:14px">
                      <tr>
                          <td>464402</td>
                          <td>INTEGRATION IN PHARMACY</td>
                          <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#464402" class="accordion-toggle">ผู้รับผิดชอบ</button></td>
                          <td><button type="button" class="btn btn-outline btn-danger" id="delete"  name="delete" >ลบ</button></td>
                      </tr>
                      <tr class="hiddenRow">
                        <td colspan="12">
                          <div class="accordian-body collapse" id="464402">
                            <div class="panel panel-success">
                              <div class="panel-heading">
                                <b>รายชื่ออาจารย์ผู้รับผิดชอบ</b>
                              </div>
                              <div class="panel-body">
                                        <div class="panel-group" id="464402">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <div class="panel-title" style="font-size:14px;">
                                                        <a data-toggle="collapse" data-parent="#464402" href="#listname464402-1">อาจารย์ผู้สอน</a>
                                                    </div>
                                                </div>
                                                <div id="listname464402-1" class="panel-collapse collapse">
                                                    <div class="panel-body">

                                                      <table class="table" style="font-size:14px;">
                                                        <thead>
                                                          <th>ลำดับ</th>
                                                          <th>ชื่อ-นามสกุล</th>
                                                          <th></th>
                                                        </thead>
                                                        <tbody>
                                                          <tr>
                                                            <td>1</td>
                                                            <td>รศ.ดร. ภก.วิรัตน์   นิวัฒนนันท์</td>
                                                            <td><button type="button" class="btn btn-outline btn-danger" id="delete"  name="delete" >ลบ</button></td>
                                                          </tr>
                                                        </tbody>
                                                      </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <div class="panel-title" style="font-size:14px;">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#listname464402-2">คณะกรรมการ</a>
                                                    </div>
                                                </div>
                                                <div id="listname464402-2" class="panel-collapse collapse">
                                                    <div class="panel-body">

                                                      <table class="table" style="font-size:14px;">
                                                        <thead>
                                                          <th>ลำดับ</th>
                                                          <th>ชื่อ-นามสกุล</th>
                                                          <th></th>
                                                        </thead>
                                                        <tbody>
                                                          <tr>
                                                            <td>1</td>
                                                            <td>คณะกรรมการชุดที่ 1</td>
                                                            <td><button type="button" class="btn btn-outline btn-danger" id="delete"  name="delete" >ลบ</button></td>
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
                        </td>
                      </tr>
                      <tr>
                          <td>464403</td>
                          <td>PATIENT INTERVIEW AND DRUG DISPENSING</td>
                          <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#464403" class="accordion-toggle">ผู้รับผิดชอบ</button></td>
                          <td><button type="button" class="btn btn-outline btn-danger" id="delete"  name="delete" >ลบ</button></td>
                      </tr>
                      <tr class="hiddenRow">
                        <td colspan="12">
                          <div class="accordian-body collapse" id="464403">
                            <div class="panel panel-success">
                              <div class="panel-heading">
                                <b>รายชื่ออาจารย์ผู้รับผิดชอบ</b>
                              </div>
                              <div class="panel-body">
                                        <div class="panel-group" id="464403">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <div class="panel-title" style="font-size:14px;">
                                                        <a data-toggle="collapse" data-parent="#464403" href="#listname464403-1">อาจารย์ผู้สอน</a>
                                                    </div>
                                                </div>
                                                <div id="listname464403-1" class="panel-collapse collapse">
                                                    <div class="panel-body">

                                                      <table class="table" style="font-size:14px;">
                                                        <thead>
                                                          <th>ลำดับ</th>
                                                          <th>ชื่อ-นามสกุล</th>
                                                          <th></th>
                                                        </thead>
                                                        <tbody>
                                                          <tr>
                                                            <td>1</td>
                                                            <td>ผศ.ดร. ภก.สกนธ์   สุภากุล</td>
                                                            <td><button type="button" class="btn btn-outline btn-danger" id="delete"  name="delete" >ลบ</button></td>
                                                          </tr>
                                                        </tbody>
                                                      </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <div class="panel-title" style="font-size:14px;">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#listname464403-2">คณะกรรมการ</a>
                                                    </div>
                                                </div>
                                                <div id="listname464403-2" class="panel-collapse collapse">
                                                    <div class="panel-body">

                                                      <table class="table" style="font-size:14px;">
                                                        <thead>
                                                          <th>ลำดับ</th>
                                                          <th>ชื่อ-นามสกุล</th>
                                                          <th></th>
                                                        </thead>
                                                        <tbody>
                                                          <tr>
                                                            <td>1</td>
                                                            <td>คณะกรรมการชุดที่ 1</td>
                                                            <td><button type="button" class="btn btn-outline btn-danger" id="delete"  name="delete" >ลบ</button></td>
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
                        </td>
                      </tr>
                      <tr>
                          <td>464441</td>
                          <td>PHARMACOEPIDEMIOLOGY 1</td>
                          <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#464441" class="accordion-toggle">ผู้รับผิดชอบ</button></td>
                          <td><button type="button" class="btn btn-outline btn-danger" id="delete"  name="delete" >ลบ</button></td>
                      </tr>
                      <tr class="hiddenRow">
                        <td colspan="12">
                          <div class="accordian-body collapse" id="464441">
                            <div class="panel panel-success">
                              <div class="panel-heading">
                                <b>รายชื่ออาจารย์ผู้รับผิดชอบ</b>
                              </div>
                              <div class="panel-body">
                                        <div class="panel-group" id="464441">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <div class="panel-title" style="font-size:14px;">
                                                        <a data-toggle="collapse" data-parent="#464441" href="#listname464441-1">อาจารย์ผู้สอน</a>
                                                    </div>
                                                </div>
                                                <div id="listname464441-1" class="panel-collapse collapse">
                                                    <div class="panel-body">

                                                      <table class="table" style="font-size:14px;">
                                                        <thead>
                                                          <th>ลำดับ</th>
                                                          <th>ชื่อ-นามสกุล</th>
                                                          <th></th>
                                                        </thead>
                                                        <tbody>
                                                          <tr>
                                                            <td>1</td>
                                                            <td>รศ.ดร. ภญ.หทัยกาญจน์   เชาวนพูนผล</td>
                                                            <td><button type="button" class="btn btn-outline btn-danger" id="delete"  name="delete" >ลบ</button></td>
                                                          </tr>
                                                        </tbody>
                                                      </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <div class="panel-title" style="font-size:14px;">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#listname464441-2">คณะกรรมการ</a>
                                                    </div>
                                                </div>
                                                <div id="listname464441-2" class="panel-collapse collapse">
                                                    <div class="panel-body">

                                                      <table class="table" style="font-size:14px;">
                                                        <thead>
                                                          <th>ลำดับ</th>
                                                          <th>ชื่อ-นามสกุล</th>
                                                          <th></th>
                                                        </thead>
                                                        <tbody>
                                                          <tr>
                                                            <td>1</td>
                                                            <td>คณะกรรมการชุดที่ 1</td>
                                                            <td><button type="button" class="btn btn-outline btn-danger" id="delete"  name="delete" >ลบ</button></td>
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
                        </td>
                      </tr>
                      <tr>
                          <td>463545</td>
                          <td>INSTRUMENTS FOR EXTRACTION AND PHARMACEUTICAL ANALYSIS</td>
                          <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#463545" class="accordion-toggle">ผู้รับผิดชอบ</button></td>
                          <td><button type="button" class="btn btn-outline btn-danger" id="delete"  name="delete" >ลบ</button></td>
                      </tr>
                      <tr class="hiddenRow">
                        <td colspan="12">
                          <div class="accordian-body collapse" id="463545">
                            <div class="panel panel-success">
                              <div class="panel-heading">
                                <b>รายชื่ออาจารย์ผู้รับผิดชอบ</b>
                              </div>
                              <div class="panel-body">
                                        <div class="panel-group" id="463545">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <div class="panel-title" style="font-size:14px;">
                                                        <a data-toggle="collapse" data-parent="#463545" href="#listname463545-1">อาจารย์ผู้สอน</a>
                                                    </div>
                                                </div>
                                                <div id="listname463545-1" class="panel-collapse collapse">
                                                    <div class="panel-body">

                                                      <table class="table" style="font-size:14px;">
                                                        <thead>
                                                          <th>ลำดับ</th>
                                                          <th>ชื่อ-นามสกุล</th>
                                                          <th></th>
                                                        </thead>
                                                        <tbody>
                                                          <tr>
                                                            <td>1</td>
                                                            <td>รศ.ดร. ภญ.หทัยกาญจน์   เชาวนพูนผล</td>
                                                            <td><button type="button" class="btn btn-outline btn-danger" id="delete"  name="delete" >ลบ</button></td>
                                                          </tr>
                                                        </tbody>
                                                      </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <div class="panel-title" style="font-size:14px;">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#listname463545-2">คณะกรรมการ</a>
                                                    </div>
                                                </div>
                                                <div id="listname463545-2" class="panel-collapse collapse">
                                                    <div class="panel-body">

                                                      <table class="table" style="font-size:14px;">
                                                        <thead>
                                                          <th>ลำดับ</th>
                                                          <th>ชื่อ-นามสกุล</th>
                                                          <th></th>
                                                        </thead>
                                                        <tbody>
                                                          <tr>
                                                            <td>1</td>
                                                            <td>คณะกรรมการชุดที่ 1</td>
                                                            <td><button type="button" class="btn btn-outline btn-danger" id="delete"  name="delete" >ลบ</button></td>
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
                        </td>
                      </tr>
                  </tbody>
              </table>
            </div>
            </div>
          <?php endif; ?>-->

          <div class="panel panel-info">
            <div class="panel-heading">
            <b>กระบวนวิชาใน 2/2557</b>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-10">
                    <form id="course" method="post">
                      <div class="form-inline">
                        <div class="form-group">
                          <label for="">วิชา</label>
                          <select class="form-control" name="course" id="search_course_id">
                            <?php foreach ($course->Get_All_Course() as $value_course): ?>
                              <option value="<?php echo $value_course['id'] ?>"><?php echo $value_course['id']." ".$value_course['name']['en']; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <input type="hidden" name="dep_id" value="<?php echo $department['code']  ?>">
                        <input type="hidden" name="semester_id" id="semester_id" value="<?php echo $semeter['id'] ?>">
                        <input type="hidden" name="type" id="type" value="add">
                        <button type="submit" class="btn btn-outline btn-primary " id="submit"  name="submit">เลือก</button>
                      </div>
                    </form>
                </div>
              </div>

              <hr>
              <table class="table table-hover" style="font-size:14px">
                <thead>
                    <tr>
                        <th width="10%">รหัสวิชา</th>
                        <th width="65%">ชื่อวิชา</th>
                        <th width="5%"></th>
                        <th width="10%"></th>
                    </tr>
                </thead>
                <tbody>
                  <?php foreach ($list_course as $key => $value): ?>
                    <form id="course" method="post">
                      <tr>
                          <td><?php echo $value['id'] ?></td>
                          <td><?php echo $value['name'] ?></td>
                          <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#<?php echo $value['id'] ?>" class="accordion-toggle">เพิ่มผู้รับผิดชอบ</button></td>
                          <td><button type="submit" class="btn btn-outline btn-danger" id="delete"  name="delete" >ลบ</button></td>
                          <input type="hidden" name="dep_id" value="<?php echo $department['code']  ?>">
                          <input type="hidden" name="course"  value="<?php echo $value['id'] ?>">
                          <input type="hidden" name="semester_id"  value="<?php echo $semeter['id'] ?>">
                          <input type="hidden" name="type" value="remove">
                      </tr>
                    </form>
                    <tr class="hiddenRow">
                      <td colspan="12">
                        <div class="accordian-body collapse" id="<?php echo $value['id'] ?>">
                          <div class="panel panel-success">
                            <div class="panel-heading">
                              <b><b>รายชื่ออาจารย์ผู้รับผิดชอบ</b></b>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">

                                          <label for="">เพิ่มผู้รับผิดชอบ</label>
                                          <div class="form-inline">
                                            <form id="staff"  method="post">
                                              <input type="text" name="teacher" class="form-control " name="teacher" id="TEACHERLEC_<?php echo $value['id'] ?>" list="dtl<?php echo $value['id'] ?>" placeholder="ชื่อ-นามสกุล" size="35" onkeydown="searchname(<?php echo $value['id'] ?>,'responsible');" >
                                              <input type="hidden" name="type" value="add_teacher">
                                              <input type="hidden" name="course" value="<?php echo $value['id'] ?>">
                                              <input type="hidden" name="semester_id" value="<?php echo $semeter['id'] ?>">
                                              <button type="submit" name="button" class="btn btn-outline btn-primary">เพิ่ม</button>
                                            </form>
                                          </div>

                                          <datalist id="dtl<?php echo $value['id'] ?>"></datalist>
                                          <table class="table" style="font-size:14px;">
                                            <thead>
                                              <th>ลำดับ</th>
                                              <th>ชื่อ-นามสกุล</th>
                                              <th></th>
                                            </thead>
                                            <tbody>
                                              <form id="staff" method="post">
                                              <?php if ($value['teacher']!=NULL): ?>
                                                <tr>
                                                  <td>1</td>
                                                  <td><?php echo $value['teacher'] ?></td>
                                                  <input type="hidden" name="type" value="remove_teacher">
                                                  <input type="hidden" name="course" value="<?php echo $value['id'] ?>">
                                                  <input type="hidden" name="semester_id" value="<?php echo $semeter['id'] ?>">
                                                  <input type="hidden" name="teacher" value="<?php echo $value['teacher'] ?>">
                                                  <td><button type="submit" class="btn btn-outline btn-danger" id="delete"  name="delete" >ลบ</button></td>
                                                </tr>
                                              <?php endif; ?>
                                              </form>
                                            </tbody>
                                          </table>
                                     </form>
                                    </div>
                                  </div>
                                  <div class="col-md-6">

                                      <label for="">เพิ่มชุดคณะกรรมการ</label>
                                      <div class="form-inline">
                                          <form id="staff"  method="post">
                                            <input type="hidden" name="type" value="add_assessor">
                                            <input type="hidden" name="course" value="<?php echo $value['id'] ?>">
                                            <input type="hidden" name="dep_id" value="<?php echo $department['code']  ?>">
                                            <input type="hidden" name="semester_id" value="<?php echo $semeter['id'] ?>">

                                            <select class="form-control" name="group">
                                              <option value="1">คณะกรรมการชุดที่ 1</option>
                                              <option value="2">คณะกรรมการชุดที่ 2</option>
                                            </select>
                                            <button type="submit" name="button" class="btn btn-outline btn-primary">เพิ่ม</button>
                                          </form>
                                      </div>
                                      <table class="table" >
                                        <thead>
                                          <th>ลำดับ</th>
                                          <th>ชื่อ-นามสกุล</th>
                                          <th></th>
                                        </thead>
                                        <tbody>
                                          <form id="staff" method="post">
                                            <?php if ($value['teacher']!=NULL): ?>

                                            <tr>
                                              <td>1</td>
                                              <td>
                                                <?php if ($value['teacher']==1):echo "คณะกรรมการชุดที่ 1"; ?>
                                                <?php else: echo "คณะกรรมการชุดที่ 2";  ?>
                                                <?php endif; ?>
                                              </td>
                                              <td><button type="submit" class="btn btn-outline btn-danger" id="delete"  name="delete" >ลบ</button></td>
                                              <input type="hidden" name="type" value="remove_assessor">
                                              <input type="hidden" name="course" value="<?php echo $value['id'] ?>">
                                              <input type="hidden" name="dep_id" value="<?php echo $department['code']  ?>">
                                              <input type="hidden" name="semester_id" value="<?php echo $semeter['id'] ?>">
                                            </tr>
                                            <?php endif; ?>
                                          </form>
                                        </tbody>
                                      </table>

                                  </div>
                                </div>
                            </div>
                          </div>
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

    </div>
<script type="text/javascript">
$("form#data").submit(function(){
    //var file = document.forms['data']['filexcel'].files[0];
    var formData = new FormData(this);
    console.log(formData);
    $.ajax({
        url: '../../application/subject/group.php',
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
$("form#course").submit(function(){
    //var file = document.forms['data']['filexcel'].files[0];
    var formData = new FormData(this);
    console.log(formData);
    $.ajax({
        url: '../../application/subject/responsible_course_department.php',
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
$("form#staff").submit(function(){
    //var file = document.forms['data']['filexcel'].files[0];
    var formData = new FormData(this);
    console.log(formData);
    $.ajax({
        url: '../../application/subject/responsible_staff.php',
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
            timer: 5000,
            confirmButtonText: "Ok!",
          }, function(){
            window.location.reload();
          });


        }
    });
    return false;
});
$("form#remove").submit(function(){
    //var file = document.forms['data']['filexcel'].files[0];
    var formData = new FormData(this);
    console.log(formData);
    $.ajax({
        url: '../../application/subject/responsible_course_department.php',
        type: 'POST',
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
          var msg=JSON.parse(data)
          console.log(msg);
          alert(msg.msg);
          window.location.reload(false);
        }
    });
    return false;
});
function submitForm(num){

  var data = new FormData;
  var dep_id =<?php echo $dep_js ?>;

  JSON.stringify(num);
  JSON.stringify(dep_id);
  data.append("semester_id",num);
  data.append("department_id",dep_id);
  console.log(data);
    $.ajax({
        url: '../../application/subject/responsible_history.php',
        type: 'POST',
        data: data,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
          alert(data);
        }
    });
    return false;
}

    function searchname(no,type) {
      var name_s = $("#TEACHERLEC_"+no).val();
        $("#dtl"+no).html('');
        if(name_s.length > 3)
        {
          $.post("search_name.php", { name: name_s}, function(data) {
                data = JSON.parse( data );
                for(var i=0;i<data.length;i++)
                {
                    $("#dtl"+no).append('<option value="'+data[i]+'"></option>');
                }

              })
              .fail(function() {
                  alert("error");
              });
        }
      }
$('select').select2();
</script>
  </body>
</html>

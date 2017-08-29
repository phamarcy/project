<?php
session_start();
require_once(__DIR__."/../../application/class/person.php");
require_once(__DIR__.'/../../application/class/manage_deadline.php');
$person = new Person();
$deadline = new Deadline;
$semeter= $deadline->Get_Current_Semester();
$department =$person->Get_Staff_Dep($_SESSION['id']);
$assessor=$person->Search_Assessor($department['code']);
/*echo "<pre>";
print_r($assessor);
echo "</pre>";*/
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
    <script src="../vendor/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <script type="text/javascript" src="../dist/js/bootstrap-filestyle.min.js"></script>

    <link rel="stylesheet" href="../dist/css/scrollbar.css">

    <title></title>
    <style>
    .panel-heading {
      margin-top: 0px;
      margin-bottom: 0px;
    }

    </style>
    <script type="text/javascript">
    $(document).ready(function(){
      $("#submit").click(function(){
        var course_id = $("#course_id").val();
        if($.isNumeric($('#course_id').val()))
        {
          if(course_id.length == 6)
          {
              $("#course_id").css("border-color","rgb(204, 204, 204)");
              $("#warning").css("color","green").html('บันทึกกระบวนวิชา 462533	HEALTH BEHAVIORS AND PHARMACEUTICAL CARE สำเร็จ').fadeIn().delay(1500).fadeOut();
              $("#course_id").val('');
          }
          else
          {
              $("#course_id").css("border-color","red");
              show_warning('<div class="glyphicon glyphicon-alert" style="color: red;"></div> กรุณากรอกข้อมูลให้ถูกต้อง');
          }

        }
        else
        {
            $("#course_id").css("border-color","red");
          show_warning('<div class="glyphicon glyphicon-alert" style="color: red;"></div> กรุณากรอกข้อมูลให้ถูกต้อง');
        }
      });
      function show_warning(text)
      {
        $("#warning").css("color","red").html(text).fadeIn();
      }
    });

    function searchname(no,type) {
      var name_s = $("#TEACHERLEC_F"+no).val();
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



    </script>
  </head>
  <body>
  <h3 class="page-header" style="margin-bottom: 0px;"><center><b>จัดการกระบวนวิชา</b></center></h3>
    <div class="container" style="margin-top:30px">
      <div class="panel panel-default">
        <div class="panel-heading">
          ภาคเรียนที่ <?php echo $semeter['semester'];?> &nbsp;ปีการศึกษา <?php echo $semeter['year']." ";?><?php echo $department['name'] ?>
        </div>
        <div class="panel-body">
        <div class="row">
              <div class="col-md-12">
                <div class="panel panel-default">
                  <div class="panel-heading">
                      คณะกรรมการผู้รับผิดชอบ
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
                                          <form id="data"  method="post">
                                              <label for="">เพิ่มคณะกรรมการ</label>
                                              <div class="form-inline">
                                                <input type="text" class="form-control charonly" name="teacher" id="TEACHERLEC_F1" list="dtl1" placeholder="ชื่อ-นามสกุล" size="35" onkeydown="searchname(1,'committee');" >
                                                <input type="hidden" name="group" value="1">
                                                <input type="hidden" name="type" value="add">
                                                <input type="hidden" name="department" value="<?php echo $department['code']  ?>">
                                                <button type="submit" name="button" class="btn btn-outline btn-primary">เพิ่ม</button>
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
                                                    <form id='delete'  method="post">
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
                                                  <input type="text" class="form-control charonly" name="teacher" id="TEACHERLEC_F1" list="dtl1" placeholder="ชื่อ-นามสกุล" size="35" onkeydown="searchname(1,'committee');" >
                                                  <input type="hidden" name="group" value="2">
                                                  <input type="hidden" name="type" value="add">
                                                  <input type="hidden" name="department" value="<?php echo $department['code']  ?>">
                                                  <button type="submit" name="button" class="btn btn-outline btn-primary">เพิ่ม</button>
                                                </div>
                                                <datalist id="dtl1"></datalist>
                                           </form>
                                          </div>
                                          <datalist id="dtl2"></datalist>
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
                                                    <form id='delete'  method="post">
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
                          ข้อมูลกระบวนวิชาในสังกัดย้อนหลัง
                        </div>
                        <div class="panel-body">
                          <div class="form-inline">
                            <center>
                              <form>
                                <button type="button" class="btn btn-outline btn-primary " id="semester"  name="submit"><b>1/2557</b></button>
                                <button type="button" class="btn btn-outline btn-primary " id="semester"  name="submit"><b>1/2558</b></button>
                                <button type="button" class="btn btn-outline btn-primary " id="semester"  name="submit"><b>1/2559</b></button>
                                <div id="warning"></div>
                              </form>
                            </center>
                          </div>
                        </div>
                      </div>
                    </div>
              </div>
              </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              กระบวนวิชาที่สังกัดในภาควิชา (ย้อนหลัง) 1/2559
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
                <tbody>
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
                              รายชื่ออาจารย์ผู้รับผิดชอบ
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
                                  <!-- .panel-body -->
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
                              รายชื่ออาจารย์ผู้รับผิดชอบ
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
                                  <!-- .panel-body -->
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
                              รายชื่ออาจารย์ผู้รับผิดชอบ
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
                                  <!-- .panel-body -->
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
                              รายชื่ออาจารย์ผู้รับผิดชอบ
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
                                  <!-- .panel-body -->
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

          <div class="panel panel-info">
            <div class="panel-heading">
            กระบวนวิชาใน 2/2557
            </div>
            <div class="panel-body">
              <center>
              <button type="button" class="btn btn-outline btn-primary btn-lg " id="submit"  name="submit">บันทึก</button>
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
                        <th width="10%"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>462533</td>
                        <td>HEALTH BEHAVIORS AND PHARMACEUTICAL CARE</td>
                        <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#462533" class="accordion-toggle">เพิ่มผู้รับผิดชอบ</button></td>
                        <td><button type="button" class="btn btn-outline btn-danger" id="delete"  name="delete" >ลบ</button></td>
                    </tr>
                    <tr class="hiddenRow">
                      <td colspan="12">
                        <div class="accordian-body collapse" id="462533">
                          <div class="panel panel-success">
                            <div class="panel-heading">
                              รายชื่ออาจารย์ผู้รับผิดชอบ
                            </div>
                            <div class="panel-body">
                                      <div class="panel-group" id="462533">
                                          <div class="panel panel-default">
                                              <div class="panel-heading">
                                                  <div class="panel-title" style="font-size:14px;">
                                                      <a data-toggle="collapse" data-parent="#462533" href="#collapseOne">อาจารย์ผู้สอน</a>
                                                  </div>
                                              </div>
                                              <div id="collapseOne" class="panel-collapse collapse">
                                                  <div class="panel-body">
                                                    <div class="col-md-5">
                                                      <div class="form-group">

                                                        <form class="" action="" method="post">
                                                          <label for="">เพิ่มผู้รับผิดชอบ</label>
                                                          <div class="form-group">
                                                            <div class="form-inline">
                                                              <input type="text" class="form-control charonly" name="teacher1" id="teacher1" list="teacher_list1" placeholder="ชื่อ-นามสกุล" size="35" onkeydown="searchname();" >
                                                              <button type="button" name="button" class="btn btn-outline btn-primary">เพิ่ม</button>
                                                            </div>
                                                            <datalist id="teacher_list1"></datalist>

                                                          </div>
                                                        </form>
                                                      </div>
                                                    </div>
                                                    <table class="table" style="font-size:14px;">
                                                      <thead>
                                                        <th>ลำดับ</th>
                                                        <th>ชื่อ-นามสกุล</th>
                                                        <th></th>
                                                      </thead>
                                                      <tbody>
                                                        <tr>
                                                          <td>1</td>
                                                          <td>อ.ดร.ภญ.ดรุณี หงษ์วิเศษ </td>
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
                                                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">คณะกรรมการ</a>
                                                  </div>
                                              </div>
                                              <div id="collapseTwo" class="panel-collapse collapse">
                                                  <div class="panel-body">
                                                    <div class="col-md-5">
                                                      <div class="form-group">
                                                        <form class="" action="" method="post">
                                                          <label for="">เพิ่มชุดคณะกรรมการ</label>
                                                          <div class="form-inline">
                                                            <input type="text" name="teacher" value="" class="form-control">
                                                            <button type="button" name="button" class="btn btn-outline btn-primary">เพิ่ม</button>
                                                          </div>
                                                        </form>
                                                      </div>
                                                    </div>
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
                                  <!-- .panel-body -->
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                        <td>461525</td>
                        <td>BASIC KNOWLEDGE OF THAI TRADITIONAL MEDICINEE</td>
                        <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#461525" class="accordion-toggle">เพิ่มผู้รับผิดชอบ</button></td>
                        <td><button type="button" class="btn btn-outline btn-danger" id="delete"  name="delete" >ลบ</button></td>
                    </tr>
                    <tr class="hiddenRow">
                      <td colspan="12">
                        <div class="accordian-body collapse" id="461525">
                          <div class="panel panel-success">
                            <div class="panel-heading">
                              รายชื่ออาจารย์ผู้รับผิดชอบ
                            </div>
                            <div class="panel-body">
                                      <div class="panel-group" id="461525">
                                          <div class="panel panel-default">
                                              <div class="panel-heading">
                                                  <div class="panel-title" style="font-size:14px;">
                                                      <a data-toggle="collapse" data-parent="#461525" href="#listname461525-1">อาจารย์ผู้สอน</a>
                                                  </div>
                                              </div>
                                              <div id="listname461525-1" class="panel-collapse collapse">
                                                  <div class="panel-body">
                                                    <div class="col-md-5">
                                                      <div class="form-group">
                                                        <form class="" action="" method="post">
                                                          <label for="">เพิ่มผู้รับผิดชอบ</label>
                                                          <div class="form-inline">
                                                            <input type="text" name="teacher" value="" class="form-control">
                                                            <button type="button" name="button" class="btn btn-outline btn-primary">เพิ่ม</button>
                                                          </div>
                                                        </form>
                                                      </div>
                                                    </div>
                                                    <table class="table" style="font-size:14px;">
                                                      <thead>
                                                        <th>ลำดับ</th>
                                                        <th>ชื่อ-นามสกุล</th>
                                                        <th></th>
                                                      </thead>
                                                      <tbody>
                                                        <tr>
                                                          <td>1</td>
                                                          <td>ผศ.ดร. ภญ.นันทวรรณ   กิติกรรณากรณ์</td>
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
                                                      <a data-toggle="collapse" data-parent="#accordion" href="#listname461525-2">คณะกรรมการ</a>
                                                  </div>
                                              </div>
                                              <div id="listname461525-2" class="panel-collapse collapse">
                                                  <div class="panel-body">
                                                    <div class="col-md-5">
                                                      <div class="form-group">
                                                        <form class="" action="" method="post">
                                                          <label for="">เพิ่มชุดคณะกรรมการ</label>
                                                          <div class="form-inline">
                                                            <input type="text" name="teacher" value="" class="form-control">
                                                            <button type="button" name="button" class="btn btn-outline btn-primary">เพิ่ม</button>
                                                          </div>
                                                        </form>
                                                      </div>
                                                    </div>
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
                                  <!-- .panel-body -->
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                        <td>461532</td>
                        <td>DRUG SYNTHESIS</td>
                        <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#461532" class="accordion-toggle">เพิ่มผู้รับผิดชอบ</button></td>
                        <td><button type="button" class="btn btn-outline btn-danger" id="delete"  name="delete" >ลบ</button></td>
                    </tr>
                    <tr class="hiddenRow">
                      <td colspan="12">
                        <div class="accordian-body collapse" id="461532">
                          <div class="panel panel-success">
                            <div class="panel-heading">
                              รายชื่ออาจารย์ผู้รับผิดชอบ
                            </div>
                            <div class="panel-body">
                                      <div class="panel-group" id="461532">
                                          <div class="panel panel-default">
                                              <div class="panel-heading">
                                                  <div class="panel-title" style="font-size:14px;">
                                                      <a data-toggle="collapse" data-parent="#461532" href="#listname461532-1">อาจารย์ผู้สอน</a>
                                                  </div>
                                              </div>
                                              <div id="listname461532-1" class="panel-collapse collapse">
                                                  <div class="panel-body">
                                                    <div class="col-md-5">
                                                      <div class="form-group">
                                                        <form class="" action="" method="post">
                                                          <label for="">เพิ่มผู้รับผิดชอบ</label>
                                                          <div class="form-inline">
                                                            <input type="text" name="teacher" value="" class="form-control">
                                                            <button type="button" name="button" class="btn btn-outline btn-primary">เพิ่ม</button>
                                                          </div>
                                                        </form>
                                                      </div>
                                                    </div>
                                                    <table class="table" style="font-size:14px;">
                                                      <thead>
                                                        <th>ลำดับ</th>
                                                        <th>ชื่อ-นามสกุล</th>
                                                        <th></th>
                                                      </thead>
                                                      <tbody>
                                                        <tr>
                                                          <td>1</td>
                                                          <td>รศ.ดร.ภญ.สุพร จารุมณี</td>
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
                                                      <a data-toggle="collapse" data-parent="#accordion" href="#listname461532-2">คณะกรรมการ</a>
                                                  </div>
                                              </div>
                                              <div id="listname461532-2" class="panel-collapse collapse">
                                                  <div class="panel-body">
                                                    <div class="col-md-5">
                                                      <div class="form-group">
                                                        <form class="" action="" method="post">
                                                          <label for="">เพิ่มชุดคณะกรรมการ</label>
                                                          <div class="form-inline">
                                                            <input type="text" name="teacher" value="" class="form-control">
                                                            <button type="button" name="button" class="btn btn-outline btn-primary">เพิ่ม</button>
                                                          </div>
                                                        </form>
                                                      </div>
                                                    </div>
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
                                  <!-- .panel-body -->
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
          console.log(msg);
          alert(msg.msg);
          window.location.reload(false);
        }
    });
    return false;
});
$("form#delete").submit(function(){
    //var file = document.forms['data']['filexcel'].files[0];
    var file_data = new FormData(this);
    $.ajax({
        url: '../../application/subject/group.php',
        type: 'post',
        data: file_data,
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


</script>
  </body>
</html>

<?php
session_start();
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

    </script>
  </head>
  <body>
  <h3 class="page-header" style="margin-bottom: 0px;"><center><b>จัดการกระบวนวิชา</b></center></h3>
    <div class="container" style="margin-top:30px">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h5><b>ภาคการศึกษาที่ 1 ปีการศึกษา 2560 ภาควิชาบริบาลเภสัชกรรม</b></h5>
        </div>
        <div class="panel-body">
          <div class="row">
              <div class="col-md-6">
                <div class="panel panel-default">
                  <div class="panel-heading">
                      <b>เพิ่มกระบวนวิชา</b>
                  </div>
                  <div class="panel-body">

                    <form>
                      <div class="form-group">
                          <div class="form-inline">
                          <div class="form-group">
                            <label for="">รหัสวิชา</label>
                            <input class="form-control" id="course_id" placeholder="e.g. 452111" style="width: 120px;">
                          </div>
                          <div class="form-group">
                            <label for="">หน่วยกิต</label>
                            <input class="form-control" id="course_id" placeholder="e.g. 3(3-0-6)" style="width: 150px;">
                          </div>
                        </div>
                     </div>
                      <div class="form-group">
                        <label for="">ชื่อวิชาภาษาอังกฤษ</label>
                        <input class="form-control" id="course_name" placeholder="e.g. TOXICOLOGY" >
                      </div>
                      <div class="form-group">
                        <label for="">ชื่อวิชาภาษาไทย</label>
                        <input class="form-control" id="course_name" placeholder="e.g. พิษวิทยา" >
                      </div>
                      <button type="button" class="btn btn-outline btn-primary" id="submit"  name="submit">เพิ่ม</button>
                      <div id="warning"></div>

                    </form>
                    <form >

                    </form>

                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="panel panel-default">
                  <div class="panel-heading">
                      <b>ข้อมูลกระบวนวิชาในสังกัดย้อนหลัง</b>
                  </div>
                  <div class="panel-body">
                    <div class="form-inline">
                      <center>
                        <form>
                          <button type="button" class="btn btn-outline btn-primary " id="submit"  name="submit"><b>1/2557</b></button>
                          <button type="button" class="btn btn-outline btn-primary " id="submit"  name="submit"><b>1/2558</b></button>
                          <button type="button" class="btn btn-outline btn-primary " id="submit"  name="submit"><b>1/2559</b></button>
                          <div id="warning"></div>
                        </form>
                      </center>
                    </div>
                  </div>
                </div>
              </div>
          </div>
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
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>464402</td>
                        <td>INTEGRATION IN PHARMACY</td>
                        <td><button type="button" class="btn btn-outline btn-danger" id="delete"  name="delete" >ลบ</button></td>
                    </tr>
                    <tr>
                        <td>464403</td>
                        <td>PATIENT INTERVIEW AND DRUG DISPENSING</td>
                        <td><button type="button" class="btn btn-outline btn-danger" id="delete"  name="delete" >ลบ</button></td>
                    </tr>
                    <tr>
                        <td>464441</td>
                        <td>PHARMACOEPIDEMIOLOGY 1</td>
                        <td><button type="button" class="btn btn-outline btn-danger" id="delete"  name="delete" >ลบ</button></td>
                    </tr>
                    <tr>
                        <td>464441</td>
                        <td>PHARMACOEPIDEMIOLOGY 1</td>
                        <td><button type="button" class="btn btn-outline btn-danger" id="delete"  name="delete" >ลบ</button></td>
                    </tr>
                </tbody>
            </table>
          </div>
          </div>

          <div class="panel panel-info">
            <div class="panel-heading">
              <b>กระบวนวิชาใน 2/2557</b>
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
                        <td><button type="button" class="btn btn-outline btn-danger" id="delete"  name="delete" >ลบ</button></td>
                        <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#203151" class="accordion-toggle">เพิ่มอาจารย์</button></td>
                    </tr>
                    <tr class="hiddenRow">
                      <td colspan="12">
                        <div class="accordian-body collapse" id="203151">
                          <div class="panel panel-success">
                            <div class="panel-heading">
                              <b>รายชื่ออาจารย์ผู้รับผิดชอบ</b>
                            </div>
                            <div class="panel-body">
                                      <div class="panel-group" id="462533">
                                          <div class="panel panel-default">
                                              <div class="panel-heading">
                                                  <h4 class="panel-title">
                                                      <a data-toggle="collapse" data-parent="#462533" href="#collapseOne">อาจารย์ผู้สอน</a>
                                                  </h4>
                                              </div>
                                              <div id="collapseOne" class="panel-collapse collapse">
                                                  <div class="panel-body">
                                                    <div class="col-md-5">
                                                      <div class="form-group">
                                                        <form class="" action="" method="post">
                                                          <label for="">เพิ่มอาจารย์ผู้สอน</label>
                                                          <div class="form-inline">
                                                            <input type="text" name="teacher" value="" class="form-control">
                                                            <button type="button" name="button" class="btn btn-outline btn-primary">เพิ่ม</button>
                                                          </div>
                                                        </form>
                                                      </div>
                                                    </div>
                                                    <table class="table">
                                                      <thead>
                                                        <th>ลำดับ</th>
                                                        <th>ชื่อ-นามสกุล</th>
                                                        <th>ลบ</th>
                                                      </thead>
                                                      <tbody>
                                                        <tr>
                                                          <td>1</td>
                                                          <td>รศ.ดร. ภก.วิรัตน์   นิวัฒนนันท์</td>
                                                          <td><button type="button" class="btn btn-outline btn-danger" id="delete"  name="delete" >ลบ</button></td>
                                                        </tr>
                                                        <tr>
                                                          <td>2</td>
                                                          <td>ผศ.ดร. ภก.ทรงวุฒิ   ยศวิมลวัฒน์</td>
                                                          <td><button type="button" class="btn btn-outline btn-danger" id="delete"  name="delete" >ลบ</button></td>
                                                        </tr>
                                                        <tr>
                                                          <td>3</td>
                                                          <td>รศ.ดร. ภญ.ศิริวิภา   ปิยะมงคล</td>
                                                          <td><button type="button" class="btn btn-outline btn-danger" id="delete"  name="delete" >ลบ</button></td>
                                                        </tr>
                                                      </tbody>
                                                    </table>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="panel panel-default">
                                              <div class="panel-heading">
                                                  <h4 class="panel-title">
                                                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">คณะกรรมการ</a>
                                                  </h4>
                                              </div>
                                              <div id="collapseTwo" class="panel-collapse collapse">
                                                  <div class="panel-body">
                                                    <div class="col-md-5">
                                                      <div class="form-group">
                                                        <form class="" action="" method="post">
                                                          <label for="">เพิ่มคณะกรรมการ</label>
                                                          <div class="form-inline">
                                                            <input type="text" name="teacher" value="" class="form-control">
                                                            <button type="button" name="button" class="btn btn-outline btn-primary">เพิ่ม</button>
                                                          </div>
                                                        </form>
                                                      </div>
                                                    </div>
                                                    <table class="table">
                                                      <thead>
                                                        <th>ลำดับ</th>
                                                        <th>ชื่อ-นามสกุล</th>
                                                      </thead>
                                                      <tbody>
                                                        <tr>
                                                          <td>1</td>
                                                          <td>รศ.ดร. ภก.วิรัตน์   นิวัฒนนันท์</td>
                                                        </tr>
                                                        <tr>
                                                          <td>2</td>
                                                          <td>ผศ.ดร. ภก.ทรงวุฒิ   ยศวิมลวัฒน์</td>
                                                        </tr>
                                                        <tr>
                                                          <td>3</td>
                                                          <td>รศ.ดร. ภญ.ศิริวิภา   ปิยะมงคล</td>
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
                        <td><button type="button" class="btn btn-outline btn-danger" id="delete"  name="delete" >ลบ</button></td>
                        <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#202141" class="accordion-toggle">เพิ่มอาจารย์</button></td>
                    </tr>
                    <tr>
                        <td>461532</td>
                        <td>DRUG SYNTHESIS</td>
                        <td><button type="button" class="btn btn-outline btn-danger" id="delete"  name="delete" >ลบ</button></td>
                        <td><button type="button" class="btn btn-outline btn-primary" data-toggle="collapse" data-target="#202141" class="accordion-toggle">เพิ่มอาจารย์</button></td>
                    </tr>
                </tbody>
            </table>
          </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

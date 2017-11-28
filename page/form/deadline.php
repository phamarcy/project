<?php
session_start();
if(!isset($_SESSION['level']) || !isset($_SESSION['fname']) || !isset($_SESSION['lname']) || !isset($_SESSION['id']))
{
    die('กรุณา Login ใหม่');
}
require_once(__DIR__.'/../../application/class/manage_deadline.php');
$deadline = new Deadline();
if(!isset($_POST['tab']))
{
  $_POST['tab'] = 'course';
}
?>
<html>
<header>
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
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <script type="text/javascript" src="../dist/js/bootstrap-filestyle.min.js"></script>

    <link rel="stylesheet" href="../dist/css/scrollbar.css">
    <script src="../dist/js/sweetalert2.min.js"></script>
        <!-- cdn for modernizr, if you haven't included it already -->
    <script src="../vendor/webshim/1.15.3/modernizr-custom.js"></script>
    <!-- polyfiller file to detect and load polyfills -->
    <script src="../vendor/webshim/1.15.3/js-webshim/minified/polyfiller.js"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11 and Android browser -->
  <script src="../vendor/webshim/1.15.3/core.js"></script>
  <link href="../dist/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
  <script src="../dist/js/moment.min.js"></script>
  <script src="../dist/js/bootstrap-datetimepicker.min.js"></script>
    <link rel="stylesheet" href="../dist/css/sweetalert2.min.css">
</header>
<style>
.form-control {
    height: 30px;
}
</style>
<script type="text/javascript">

//lock,unlock all input
function lock(object,type)
{
  $(object).find("#year").prop('disabled', type);
  $(object).find("#semester").prop('disabled', type);
  $(object).find("#opendate").prop('disabled', type);
  $(object).find("#lastdate").prop('disabled', type);
  $(object).find("button[name=submit]").prop('disabled',type);
  $(object).find("#edit").prop('disabled',!type);
}

function reset_object(object)
{
  $(object).find("input[id]").each(function(index, node)
  {
        $(this).css("border-color","rgb(204, 204, 204)");
  });
  $(object).find("#warning").html("");
}
function reset_date(object)
{
    $(object).find("#opendate").css("border-color","rgb(204, 204, 204)");
    $(object).find("#lastdate").css("border-color","rgb(204, 204, 204)");
}
$(document).ready(function() {

});



function Load_Page(tab) {
    var form = document.createElement("form");
    var element1 = document.createElement("input");

    form.method = "POST";
    form.action = "#";

    var type = tab.split("_");
    type = type[1];
    element1.value=type;
    element1.name="tab";
    form.appendChild(element1);

    document.body.appendChild(form);

    form.submit();
}

//submit data to database
$(document).on('click', "#submitbtn_course,#submitbtn_syllabus,#submitbtn_special,#submitbtn_approve,#submitbtn_evaluate,#submitbtn_grade", function() {
  var button_object = $(this)
  var id = $(button_object).attr('id');
    swal({
  text: "ต้องการบันทึกหรือไม่ ?",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'ใช่',
  cancelButtonText: 'ไม่'
}).then(function () {
    var type = id.split("_");
    type = type[1];
    var button = $(this);
    var formData = {};
    var error = 0;
    url = "../../application/deadline/update_deadline.php?query=add&type="+type;
    var form = $(button_object).parent();
    var last_date = $(button_object).parent().find("#lastdate").val();
    var first_date = $(button_object).parent().find("#opendate").val();
    if(last_date =='' || first_date == '')
    {
        error = 1;
    }

    $(form).find("input[id]").each(function(index, node)
    {
        if(node.value == '')
        {
          error = 1;
          $(this).css("border-color","red");
        }else
        {
          $(this).css("border-color","rgb(204, 204, 204)");
          formData[node.id] = node.value;
        }
    });
    if(error == 0)
    {
    formData['semester'] = $(form).find('#semester').val();
    $(form).find("#warning").html("<img src='../../application/picture/loading_icon.gif' height='60'> ");
    $.post(url, { 'DATA': formData }).done(function(data) {
        $(form).find("#warning").html("");
        try {
          var result = JSON.parse(data);
          if (typeof result.success === 'undefined' || result.success === null ) {
            swal({
              type:'error',
              text: result.error,
              timer: 1000,
              confirmButtonText: "Ok!",
            });
          }
          else {
            swal({
              type:'success',
              text: result.success,
              timer: 2000,
              confirmButtonText: "Ok!",
            }, function(){
              Load_Page(id);
            });
            setTimeout(function() {
                Load_Page(id);
            }, 1000);
          }
        } catch (e) {
          swal(
              '',
              'ไม่สามารถเพิ่มข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ',
              'error'
            )
          console.log(e);
        } finally {

        }
    }).fail(function() {
      $(form).find("#warning").html("");
      swal(
          '',
          "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ กรุณาติดต่อเจ้าหน้าที่",
          'error'
        )
      });

    }
    else
    {
        $(form).find("#warning").html('<div class="glyphicon glyphicon-alert" style="color: red;"> <b>กรุณากรอกข้อมูลให้ถูกต้องและครบถ้วน</b></div>');
    }
}, function (dismiss) {

})

});

//delete data boxes
$(document).on('click', "#delete", function() {
    var object = $(this).parent().parent();
    $(object).fadeOut(300, function() { $(this).remove(); });
});


</script>

<body id="mainbody">
    <h3 class="page-header" style="margin-bottom: 0px;"><center>กำหนดช่วงเวลา</center></h3>
    <div class="panel-body" style="padding-top: 0px;">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li <?php echo ($_POST['tab'] == 'course')? 'class="active"' : '' ?>><a href="#course" data-toggle="tab">การกรอกข้อมูลวิธีการวัดผลและประเมินผล</a>
            </li>
            <li <?php echo ($_POST['tab'] == 'syllabus')? 'class="active"' : '' ?>><a href="#syllabus" data-toggle="tab">การอัปโหลดไฟล์ course syllabus</a>
            </li>
            <li <?php echo ($_POST['tab'] == 'special')? 'class="active"' : '' ?>><a href="#special" data-toggle="tab">การกรอกข้อมูลอาจารย์พิเศษ</a>
            </li>
            <li <?php echo ($_POST['tab'] == 'evaluate')? 'class="active"' : '' ?>><a href="#evaluate" data-toggle="tab">การประเมินกระบวนวิชา</a>
            </li>
            <li <?php echo ($_POST['tab'] == 'approve')? 'class="active"' : '' ?>><a href="#approve" data-toggle="tab">การพิจารณาเห็นชอบกระบวนวิชา</a>
            </li>
            <li <?php echo ($_POST['tab'] == 'grade')? 'class="active"' : '' ?>><a href="#grade" data-toggle="tab">การอัปโหลดไฟล์เกรด</a>
            </li>
        </ul>
        <!-- loading tab -->
        <div id="loading"></div>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade  <?php echo ($_POST['tab'] == 'course')? ' in active' : '' ?>" id="course">
                <div class="container">
                    <div class="panel panel-default" style="margin-top: 20px;">
                        <div class="panel-heading">
                            <div class="form-inline">
                                <h5 style="font-size : 16px;margin-bottom: 0px;margin-top: 0px;">กรอกข้อมูลวิธีการวัดผลและประเมินผล
                                 </h5>
                            </div>
                        </div>
                            <div class="panel-body" id="body_course">
                                <div class="well" style="position: relative;" id="group_course">
                                  <br>
                                    <form>
                                        <div class="form-inline">
                                            <h style="width: 100px;  ">ภาคการศึกษาที่ </h>
                                            <div class="form-group">
                                                <select class="form-control" id="semester" style="width: 70px; ">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                </select>
                                            </div>
                                            ปีการศึกษา
                                            <input class="form-control" id="year" name="year" placeholder="e.g. 2560" style="width: 100px;">
                                        </div>
                                        <br>
                                        <div class="form-inline">
                                            วันเปิดการกรอกข้อมูลวิธีการวัดผลและประเมินผล <input style="width:160px" class="form-control" type="text" id="opendate"> <br><br>
                                            วันสุดท้ายของการกรอกข้อมูลวิธีการวัดผลและประเมินผล <input style="width:160px" class="form-control"  type="text" id="lastdate"> <div id="warning"></div>
                                        </div>
                                        <br>
                                        <!-- <button type="button" class="btn btn-outline btn-default" style="position: absolute; right: 80px; bottom: 10px;" id="edit" disabled>แก้ไข</button> -->
                                        <button type="button" class="btn btn-outline btn-default" style="position: absolute; right: 10px; bottom: 10px;" id="submitbtn_course"  name="submit">บันทึก</button>
                                        <button type="button" class="btn btn-outline btn-default" id="delete" style="position: absolute; right: 10px; top: 10px;" disabled>X</button>
                                    </form>
                                </div>

                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th width="20%">ภาคการศึกษา</th>
                                            <th width="20%">ปีการศึกษา</th>
                                            <th>วันเริ่มต้น</th>
                                            <th>วันสุดท้าย</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        $result = $deadline->Search_all('1');
                                        if($result)
                                        {
                                          for($i=0;$i<count($result);$i++)
                                          {
                                            $opendate = date( 'd/m/Y', strtotime($result[$i]['open_date']));
                                            $lastdata = date( 'd/m/Y', strtotime($result[$i]['last_date']));
                                            echo '<tr>
                                                  <td>'.($i+1).'</td>
                                                  <td>'.$result[$i]['semester_num'].'</td>
                                                  <td>'.$result[$i]['year'].'</td>
                                                  <td>'.$opendate.'</td>
                                                  <td>'.$lastdata.'</td>
                                                  </tr>';
                                          }
                                        }
                                       ?>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade <?php echo ($_POST['tab'] == 'syllabus')? ' in active' : '' ?>" id="syllabus">
                <div class="container">
                    <div class="panel panel-default" style="margin-top: 20px;">
                        <div class="panel-heading">
                            <div class="form-inline">
                                <h5 style="font-size : 16px;margin-bottom: 0px;margin-top: 0px;">อัปโหลดไฟล์ course syllabus
                                 </h5>
                            </div>
                        </div>
                            <div class="panel-body" id="body_syllabus">
                                <div class="well" style="position: relative;" id="group_syllabus">
                                    <br>
                                    <form>
                                        <div class="form-inline">
                                            <h style="width: 100px;  ">ภาคการศึกษาที่ </h>
                                            <div class="form-group">
                                                <select class="form-control" id="semester" style="width: 70px; ">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                </select>
                                            </div>
                                            ปีการศึกษา
                                            <input class="form-control" id="year" name="year" placeholder="e.g. 2560" style="width: 100px;">
                                        </div>
                                        <br>
                                        <div class="form-inline">
                                            วันเปิดการอัปโหลดไฟล์ course syllabus <input style="width:160px" class="form-control" type="text" id="opendate"> <br><br>
                                            วันสุดท้ายของการอัปโหลดไฟล์ course syllabus <input style="width:160px" class="form-control" type="text" id="lastdate"> <div id="warning"></div>
                                        </div>
                                        <br>
                                        <!-- <button type="button" class="btn btn-outline btn-default" style="position: absolute; right: 80px; bottom: 10px;" id="edit" disabled>แก้ไข</button> -->
                                        <button type="button" class="btn btn-outline btn-default" style="position: absolute; right: 10px; bottom: 10px;" id="submitbtn_syllabus"  name="submit">บันทึก</button>
                                        <button type="button" class="btn btn-outline btn-default" id="delete" style="position: absolute; right: 10px; top: 10px;" disabled>X</button>
                                    </form>
                                </div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th width="20%">ภาคการศึกษา</th>
                                            <th width="20%">ปีการศึกษา</th>
                                            <th>วันเริ่มต้น</th>
                                            <th>วันสุดท้าย</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        $result = $deadline->Search_all('2');
                                        if($result)
                                        {
                                          for($i=0;$i<count($result);$i++)
                                          {
                                            $opendate = date( 'd/m/Y', strtotime($result[$i]['open_date']));
                                            $lastdata = date( 'd/m/Y', strtotime($result[$i]['last_date']));
                                            echo '<tr>
                                                  <td>'.($i+1).'</td>
                                                  <td>'.$result[$i]['semester_num'].'</td>
                                                  <td>'.$result[$i]['year'].'</td>
                                                  <td>'.$opendate.'</td>
                                                  <td>'.$lastdata.'</td>
                                                  </tr>';
                                          }
                                        }
                                       ?>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade <?php echo ($_POST['tab'] == 'special')? ' in active' : '' ?>" id="special">
                <div class="container">
                    <div class="panel panel-default" style="margin-top: 20px;">
                        <div class="panel-heading">
                            <div class="form-inline">
                                <h5 style="font-size : 16px;margin-bottom: 0px;margin-top: 0px;">กรอกข้อมูลอาจารย์พิเศษ
                                 </h5>
                            </div>
                        </div>
                            <div class="panel-body" id="body_special">
                                <div class="well" style="position: relative;" id="group_special">
                                  <br>
                                    <form>
                                        <div class="form-inline">
                                            <h style="width: 100px;  ">ภาคการศึกษาที่ </h>
                                            <div class="form-group">
                                                <select class="form-control" id="semester" style="width: 70px; ">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                </select>
                                            </div>
                                            ปีการศึกษา
                                            <input class="form-control" id="year" name="year" placeholder="e.g. 2560" style="width: 100px;">
                                        </div>
                                        <br>
                                        <div class="form-inline">
                                            วันเปิดการกรอกข้อมูลอาจารย์พิเศษ <input class="form-control" style="width:160px" type="text" id="opendate"> <br><br>
                                            วันสุดท้ายของการกรอกข้อมูลอาจารย์พิเศษ <input class="form-control" style="width:160px" type="text" id="lastdate"> <div id="warning"></div>
                                        </div>
                                        <br>
                                        <!-- <button type="button" class="btn btn-outline btn-default" style="position: absolute; right: 80px; bottom: 10px;" id="edit" disabled>แก้ไข</button> -->
                                        <button type="button" class="btn btn-outline btn-default" style="position: absolute; right: 10px; bottom: 10px;" id="submitbtn_special"  name="submit">บันทึก</button>
                                        <button type="button" class="btn btn-outline btn-default" id="delete" style="position: absolute; right: 10px; top: 10px;" disabled>X</button>
                                    </form>
                                </div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th width="20%">ภาคการศึกษา</th>
                                            <th width="20%">ปีการศึกษา</th>
                                            <th>วันเริ่มต้น</th>
                                            <th>วันสุดท้าย</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        $result = $deadline->Search_all('3');
                                        if($result)
                                        {
                                          for($i=0;$i<count($result);$i++)
                                          {
                                            $opendate = date( 'd/m/Y', strtotime($result[$i]['open_date']));
                                            $lastdata = date( 'd/m/Y', strtotime($result[$i]['last_date']));
                                            echo '<tr>
                                                  <td>'.($i+1).'</td>
                                                  <td>'.$result[$i]['semester_num'].'</td>
                                                  <td>'.$result[$i]['year'].'</td>
                                                  <td>'.$opendate.'</td>
                                                  <td>'.$lastdata.'</td>
                                                  </tr>';
                                          }
                                        }
                                       ?>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade <?php echo ($_POST['tab'] == 'approve')? ' in active' : '' ?>" id="approve">
                <div class="container">
                    <div class="panel panel-default" style="margin-top: 20px;">
                        <div class="panel-heading">
                            <div class="form-inline">
                                <h5 style="font-size : 16px;margin-bottom: 0px;margin-top: 0px;">พิจารณาเห็นชอบกระบวนวิชา
                                 </h5>
                            </div>
                        </div>
                            <div class="panel-body" id="body_approve">
                                <div class="well" style="position: relative;" id="group_approve">
                                    <br>
                                    <form>
                                        <div class="form-inline">
                                            <h style="width: 100px;">ภาคการศึกษาที่ </h>
                                            <div class="form-group">
                                                <select class="form-control" id="semester" style="width: 70px; ">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                </select>
                                            </div>
                                            ปีการศึกษา
                                            <input class="form-control" id="year" name="year" placeholder="e.g. 2560" style="width: 100px;">
                                        </div>
                                        <br>
                                        <div class="form-inline">
                                            วันเปิดการพิจารณาเห็นชอบกระบวนวิชา <input class="form-control" style="width:160px" type="text" id="opendate"> <br><br>
                                            วันสุดท้ายของการพิจารณาเห็นชอบกระบวนวิชา <input class="form-control" style="width:160px" type="text" id="lastdate">
                                            <div id="warning"></div>
                                        </div>
                                        <br>
                                        <!-- <button type="button" class="btn btn-outline btn-default" style="position: absolute; right: 80px; bottom: 10px;" id="edit" disabled>แก้ไข</button> -->
                                        <button type="button" class="btn btn-outline btn-default" style="position: absolute; right: 10px; bottom: 10px;" id="submitbtn_approve" name="submit">บันทึก</button>
                                        <button type="button" class="btn btn-outline btn-default" id="delete" style="position: absolute; right: 10px; top: 10px;" disabled>X</button>
                                    </form>
                                </div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th width="20%">ภาคการศึกษา</th>
                                            <th width="20%">ปีการศึกษา</th>
                                            <th>วันเริ่มต้น</th>
                                            <th>วันสุดท้าย</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        $result = $deadline->Search_all('5');
                                        if($result)
                                        {
                                          for($i=0;$i<count($result);$i++)
                                          {
                                            $opendate = date( 'd/m/Y', strtotime($result[$i]['open_date']));
                                            $lastdata = date( 'd/m/Y', strtotime($result[$i]['last_date']));
                                            echo '<tr>
                                                  <td>'.($i+1).'</td>
                                                  <td>'.$result[$i]['semester_num'].'</td>
                                                  <td>'.$result[$i]['year'].'</td>
                                                  <td>'.$opendate.'</td>
                                                  <td>'.$lastdata.'</td>
                                                  </tr>';
                                          }
                                        }
                                       ?>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade <?php echo ($_POST['tab'] == 'evaluate')? ' in active' : '' ?>" id="evaluate">
                <div class="container">
                    <div class="panel panel-default" style="margin-top: 20px;">
                        <div class="panel-heading">
                            <div class="form-inline">
                                <h5 style="font-size : 16px;margin-bottom: 0px;margin-top: 0px;">ประเมินกระบวนวิชา
                                 </h5>
                            </div>
                        </div>
                            <div class="panel-body" id="body_evaluate">
                                <div class="well" style="position: relative;" id="group_evaluate">
                                    <br>
                                    <form>
                                        <div class="form-inline">
                                            <h style="width: 100px;">ภาคการศึกษาที่ </h>
                                            <div class="form-group">
                                                <select class="form-control" id="semester" style="width: 70px; ">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                </select>
                                            </div>
                                            ปีการศึกษา
                                            <input class="form-control" id="year" name="year" placeholder="e.g. 2560" style="width: 100px;">
                                        </div>
                                        <br>
                                        <div class="form-inline">
                                            วันเปิดการประเมินกระบวนวิชา <input class="form-control" style="width:160px" type="text" id="opendate"> <br><br>
                                            วันสุดท้ายของการประเมินกระบวนวิชา <input class="form-control" style="width:160px" type="text" id="lastdate">
                                            <div id="warning"></div>
                                        </div>
                                        <br>
                                        <!-- <button type="button" class="btn btn-outline btn-default" style="position: absolute; right: 80px; bottom: 10px;" id="edit" disabled>แก้ไข</button> -->
                                        <button type="button" class="btn btn-outline btn-default" style="position: absolute; right: 10px; bottom: 10px;" id="submitbtn_evaluate" name="submit">บันทึก</button>
                                        <button type="button" class="btn btn-outline btn-default" id="delete" style="position: absolute; right: 10px; top: 10px;" disabled>X</button>
                                    </form>
                                </div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th width="20%">ภาคการศึกษา</th>
                                            <th width="20%">ปีการศึกษา</th>
                                            <th>วันเริ่มต้น</th>
                                            <th>วันสุดท้าย</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        $result = $deadline->Search_all('4');
                                        if($result)
                                        {
                                          for($i=0;$i<count($result);$i++)
                                          {
                                            $opendate = date( 'd/m/Y', strtotime($result[$i]['open_date']));
                                            $lastdata = date( 'd/m/Y', strtotime($result[$i]['last_date']));
                                            echo '<tr>
                                                  <td>'.($i+1).'</td>
                                                  <td>'.$result[$i]['semester_num'].'</td>
                                                  <td>'.$result[$i]['year'].'</td>
                                                  <td>'.$opendate.'</td>
                                                  <td>'.$lastdata.'</td>
                                                  </tr>';
                                          }
                                        }
                                       ?>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade <?php echo ($_POST['tab'] == 'evaluate')? ' in active' : '' ?>" id="evaluate">
                <div class="container">
                    <div class="panel panel-default" style="margin-top: 20px;">
                        <div class="panel-heading">
                            <div class="form-inline">
                                <h5 style="font-size : 16px;margin-bottom: 0px;margin-top: 0px;">ประเมินกระบวนวิชา
                                 </h5>
                            </div>
                        </div>
                            <div class="panel-body" id="body_evaluate">
                                <div class="well" style="position: relative;" id="group_evaluate">
                                    <br>
                                    <form>
                                        <div class="form-inline">
                                            <h style="width: 100px;">ภาคการศึกษาที่ </h>
                                            <div class="form-group">
                                                <select class="form-control" id="semester" style="width: 70px; ">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                </select>
                                            </div>
                                            ปีการศึกษา
                                            <input class="form-control" id="year" name="year" placeholder="e.g. 2560" style="width: 100px;">
                                        </div>
                                        <br>
                                        <div class="form-inline">
                                            วันเปิดการประเมินกระบวนวิชา <input class="form-control" style="width:160px" type="text" id="opendate"> <br><br>
                                            วันสุดท้ายของการประเมินกระบวนวิชา <input class="form-control" style="width:160px" type="text" id="lastdate">
                                            <div id="warning"></div>
                                        </div>
                                        <br>
                                        <!-- <button type="button" class="btn btn-outline btn-default" style="position: absolute; right: 80px; bottom: 10px;" id="edit" disabled>แก้ไข</button> -->
                                        <button type="button" class="btn btn-outline btn-default" style="position: absolute; right: 10px; bottom: 10px;" id="submitbtn_evaluate" name="submit">บันทึก</button>
                                        <button type="button" class="btn btn-outline btn-default" id="delete" style="position: absolute; right: 10px; top: 10px;" disabled>X</button>
                                    </form>
                                </div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th width="20%">ภาคการศึกษา</th>
                                            <th width="20%">ปีการศึกษา</th>
                                            <th>วันเริ่มต้น</th>
                                            <th>วันสุดท้าย</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        $result = $deadline->Search_all('4');
                                        if($result)
                                        {
                                          for($i=0;$i<count($result);$i++)
                                          {
                                            $opendate = date( 'd/m/Y', strtotime($result[$i]['open_date']));
                                            $lastdata = date( 'd/m/Y', strtotime($result[$i]['last_date']));
                                            echo '<tr>
                                                  <td>'.($i+1).'</td>
                                                  <td>'.$result[$i]['semester_num'].'</td>
                                                  <td>'.$result[$i]['year'].'</td>
                                                  <td>'.$opendate.'</td>
                                                  <td>'.$lastdata.'</td>
                                                  </tr>';
                                          }
                                        }
                                       ?>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade <?php echo ($_POST['tab'] == 'grade')? ' in active' : '' ?>" id="grade">
                <div class="container">
                    <div class="panel panel-default" style="margin-top: 20px;">
                        <div class="panel-heading">
                            <div class="form-inline">
                                <h5 style="font-size : 16px;margin-bottom: 0px;margin-top: 0px;">อัปโหลดไฟล์เกรด
                                 </h5>
                            </div>
                        </div>
                            <div class="panel-body" id="body_grade">
                                <div class="well" style="position: relative;" id="group_grade">
                                    <br>
                                    <form>
                                        <div class="form-inline">
                                            <h style="width: 100px;">ภาคการศึกษาที่ </h>
                                            <div class="form-group">
                                                <select class="form-control" id="semester" style="width: 70px; ">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                </select>
                                            </div>
                                            ปีการศึกษา
                                            <input class="form-control" id="year" name="year" placeholder="e.g. 2560" style="width: 100px;">
                                        </div>
                                        <br>
                                        <div class="form-inline">
                                            วันเปิดการอัปโหลดไฟล์เกรด <input class="form-control" style="width:160px" type="text" id="opendate"> <br><br>
                                            วันสุดท้ายของการอัปโหลดไฟล์เกรด <input class="form-control" style="width:160px" type="text" id="lastdate">
                                            <div id="warning"></div>
                                        </div>
                                        <br>
                                        <!-- <button type="button" class="btn btn-outline btn-default" style="position: absolute; right: 80px; bottom: 10px;" id="edit" disabled>แก้ไข</button> -->
                                        <button type="button" class="btn btn-outline btn-default" style="position: absolute; right: 10px; bottom: 10px;" id="submitbtn_grade" name="submit">บันทึก</button>
                                        <button type="button" class="btn btn-outline btn-default" id="delete" style="position: absolute; right: 10px; top: 10px;" disabled>X</button>
                                    </form>
                                </div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th width="20%">ภาคการศึกษา</th>
                                            <th width="20%">ปีการศึกษา</th>
                                            <th>วันเริ่มต้น</th>
                                            <th>วันสุดท้าย</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        $result = $deadline->Search_all('6');
                                        if($result)
                                        {
                                          for($i=0;$i<count($result);$i++)
                                          {
                                            $opendate = date( 'd/m/Y', strtotime($result[$i]['open_date']));
                                            $lastdata = date( 'd/m/Y', strtotime($result[$i]['last_date']));
                                            echo '<tr>
                                                  <td>'.($i+1).'</td>
                                                  <td>'.$result[$i]['semester_num'].'</td>
                                                  <td>'.$result[$i]['year'].'</td>
                                                  <td>'.$opendate.'</td>
                                                  <td>'.$lastdata.'</td>
                                                  </tr>';
                                          }
                                        }
                                       ?>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
        $(function () {
            $('[id="opendate"]').each(function( index ) {
            $(this).datetimepicker({format: 'YYYY-MM-DD'});
          });
            $('[id="lastdate"]').each(function( index ) {
            $(this).datetimepicker({format: 'YYYY-MM-DD'});
          });
        });
        </script>
</body>
</html>

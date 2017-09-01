<?php
session_start();
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
    <script src="../vendor/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <script type="text/javascript" src="../dist/js/bootstrap-filestyle.min.js"></script>

    <link rel="stylesheet" href="../dist/css/scrollbar.css">
    <script src="../dist/js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="../dist/css/sweetalert2.min.css">
</header>
<style>
.form-control {
    height: 30px;
}
</style>
<script type="text/javascript">

//show loading gif
function loaddataAll()
{
    $('#loading').html("<center><img src='../../application/picture/loading_icon.gif'></center>");
    $(".container").hide();
    loaddata('course');
    loaddata('syllabus');
    loaddata('special');
    loaddata('evaluate');
    loaddata('approve');
}

//get deadline data
function loaddata(type) {

    url = "../../application/deadline/update_deadline.php?type="+type+"&query=search";
    var data;
    var object;
    $.getJSON(url, function(result) {
    }).done(function(result) {
        if (typeof result.data === 'undefined' || result.data === null ) {
            if(typeof result.error === 'undefined' || result.error === null)
            {
              $("#loading").html('<div class="alert alert-danger">Error : Loding failed </div>');
            }
            else
            {
              $("#loading").html('<div class="alert alert-danger">Error : ' + result.error + '</div>');
            }
        } else {
            render(result.data,type);
        }
      }).fail(function() {
          $("#loading").html('<div class="alert alert-danger">Error : Cannot load data, please contact admin</div>');
        });
}

// render data boxes
function render(data,type) {
    var count = data.length;
    for (var i = 0; i < count; i++) {
        object = document.getElementById("group_"+type).cloneNode(true);
        $(object).find("#year").val(data[i].year);
        $(object).find("#semester").val(data[i].semester_num);
        $(object).find("#opendate").val(data[i].open_date);
        $(object).find("#lastdate").val(data[i].last_date);
        $(object).find("#delete").prop('disabled', false);
        lock(object,true);
        $(object).appendTo("#body_"+type);
    }
    $("#loading").html("");
    $(".container").fadeIn();
}

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

//validate is date data correct?
function checkdate(date_before,date_after)
{
    if(date_after.getTime() > date_before.getTime())
    {
      return 1;
    }
    else if (date_after.getTime() < date_before.getTime())
    {
      return -1;
    }
    else
    {
      return 0;
    }
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
  //add more data button
    $("#addbtn_course, #addbtn_syllabus, #addbtn_special, #addbtn_evaluate, #addbtn_approve").click(function() {
        var id = $(this).attr('id');
        var type = id.split("_");
        type = type[1];
        var i = 0;
        var object = document.getElementById("group_"+type);
        var object_clone = $(object).clone();
        reset_object(object_clone);
        $(object_clone).find("#delete").prop('disabled', false);
        lock(object_clone,false);
        $(object_clone).find("input").val("").end().prependTo("#body_"+type);
    });

});

//check is last_date greater than first_date
$(document).on('change', '#lastdate', function() {
    var last_date = new Date($(this).val());
    var first_date = $(this).parent().find("#opendate").val();
    if(first_date != null)
    {
        first_date = new Date($(this).parent().find("#opendate").val());
        var result = checkdate(first_date,last_date);
        if(result != 1)
        {
          $(this).parent().find("#warning").html('วันที่ไม่ถูกต้อง');
          $(this).parent().find("#warning").css("color","red");
        }
        else
        {
          //reset_date($(this).parent());
          $(this).parent().find("#warning").html('');
        }
    }
});

//check if date is correct
$(document).on('change', '#opendate', function() {
    var last_date = $(this).parent().find("#lastdate").val();
    var first_date = new Date($(this).val());
    if(last_date != '')
    {
        last_date = new Date($(this).parent().find("#lastdate").val());
        var result = checkdate(first_date,last_date);
        if(result != 1)
        {
          $(this).parent().find("#warning").html('วันที่ไม่ถูกต้อง');
          $(this).parent().find("#warning").css("color","red");
        }
        else
        {
          //reset_date($(this).parent());
          $(this).parent().find("#warning").html('');
        }
    }
});

//submit data to database
$(document).on('click', "#submitbtn_course,#submitbtn_syllabus,#submitbtn_special,#submitbtn_approve, #submitbtn_evaluate", function() {
  var button_object = $(this)
  var id = $(button_object).attr('id');
    swal({
  title: 'บันทึกข้อมูล',
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
    if(last_date !='' && first_date != '')
    {
        first_date = new Date(first_date);
        last_date = new Date(last_date);
        var date_check = checkdate(first_date,last_date);
        if(date_check != 1)
        {
            error = 1;
        }
    }
    else
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
        console.log(data);
        var result = JSON.parse(data);
        if (typeof result.success === 'undefined' || result.success === null ) {
          swal(
              'Error',
                result.error,
              'error'
            )
            // alert(result.error);
        }
        else {
          swal(
            'Success',
            result.success,
            'success'
          )
          // alert(result.success);
          reset_object(form);
          lock(form,true);
        }
    }).fail(function() {
      $(form).find("#warning").html("");
      swal(
          'Error',
          "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ กรุณาติดต่อเจ้าหน้าที่",
          'error'
        )
      // alert("ไม่สามารถเชื่อมต่อฐานข้อมูลได้ กรุณาติดต่อเจ้าหน้าที่");

      });

    }
    else
    {
        $(form).find("#warning").html('<div class="glyphicon glyphicon-alert" style="color: red;"> <b>กรุณากรอกข้อมูลให้ถูกต้องและครบถ้วน</b></div>');
    }
}, function (dismiss) {
  // dismiss can be 'cancel', 'overlay',
  // 'close', and 'timer'

})

});

//delete data boxes
$(document).on('click', "#delete", function() {
    var object = $(this).parent().parent();
    $(object).fadeOut(300, function() { $(this).remove(); });
});

//edit data
$(document).on('click', "#edit", function() {
    var object = $(this).parent();
    lock(object,false);
});
</script>

<body onload="loaddataAll()" id="mainbody">
    <h3 class="page-header" style="margin-bottom: 0px;"><center>กำหนดช่วงเวลา</center></h3>
    <div class="panel-body" style="padding-top: 0px;">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#course" data-toggle="tab">กำหนดช่วงเวลาในการกรอกข้อมูลวิธีการวัดผลและประเมินผล</a>
            </li>
            <li><a href="#syllabus" data-toggle="tab">กำหนดช่วงเวลาในการอัพโหลดไฟล์ course syllabus</a>
            </li>
            <li><a href="#special" data-toggle="tab">กำหนดช่วงเวลาในการกรอกข้อมูลอาจารพิเศษ</a>
            </li>
            <li><a href="#evaluate" data-toggle="tab">กำหนดเวลาประเมินกระบวนวิชา</a>
            </li>
            <li><a href="#approve" data-toggle="tab">กำหนดเวลาอนุมัติกระบวนวิชา</a>
            </li>
        </ul>
        <!-- loading tab -->
        <div id="loading"></div>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade in active" id="course">
                <div class="container">
                    <div class="panel panel-default" style="margin-top: 20px;">
                        <div class="panel-heading">
                            <div class="form-inline">
                                <h5 style="font-size : 16px;margin-bottom: 0px;margin-top: 0px;">กำหนดเวลากรอกข้อมูลวิธีการวัดผลและประเมินผล
                                    <button type="button" class="btn btn-default" id="addbtn_course">เพิ่ม</button>
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
                                            วันเปิดการกรอกข้อมูลวิธีการวัดผลและประเมินผล <input class="form-control" type="date" id="opendate"> <br><br>
                                            วันสุดท้ายของการกรอกข้อมูลวิธีการวัดผลและประเมินผล <input class="form-control" type="date" id="lastdate"> <div id="warning"></div>
                                        </div>
                                        <br>
                                        <button type="button" class="btn btn-outline btn-default" style="position: absolute; right: 80px; bottom: 10px;" id="edit" disabled>แก้ไข</button>
                                        <button type="button" class="btn btn-outline btn-default" style="position: absolute; right: 10px; bottom: 10px;" id="submitbtn_course"  name="submit">บันทึก</button>
                                        <button type="button" class="btn btn-outline btn-default" id="delete" style="position: absolute; right: 10px; top: 10px;" disabled>X</button>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="syllabus">
                <div class="container">
                    <div class="panel panel-default" style="margin-top: 20px;">
                        <div class="panel-heading">
                            <div class="form-inline">
                                <h5 style="font-size : 16px;margin-bottom: 0px;margin-top: 0px;">กำหนดช่วงเวลาในการอัพโหลดไฟล์ course syllabus
                                    <button type="button" class="btn btn-default" id="addbtn_syllabus">เพิ่ม</button>
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
                                            วันเปิดการอัพโหลดไฟล์ course syllabus <input class="form-control" type="date" id="opendate"> <br><br>
                                            วันสุดท้ายของการอัพโหลดไฟล์ course syllabus <input class="form-control" type="date" id="lastdate"> <div id="warning"></div>
                                        </div>
                                        <br>
                                        <button type="button" class="btn btn-outline btn-default" style="position: absolute; right: 80px; bottom: 10px;" id="edit" disabled>แก้ไข</button>
                                        <button type="button" class="btn btn-outline btn-default" style="position: absolute; right: 10px; bottom: 10px;" id="submitbtn_syllabus"  name="submit">บันทึก</button>
                                        <button type="button" class="btn btn-outline btn-default" id="delete" style="position: absolute; right: 10px; top: 10px;" disabled>X</button>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="special">
                <div class="container">
                    <div class="panel panel-default" style="margin-top: 20px;">
                        <div class="panel-heading">
                            <div class="form-inline">
                                <h5 style="font-size : 16px;margin-bottom: 0px;margin-top: 0px;">กำหนดช่วงเวลาในการกรอกข้อมูลอาจารพิเศษ
                                    <button type="button" class="btn btn-default" id="addbtn_special">เพิ่ม</button>
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
                                            วันเปิดการกรอกข้อมูลอาจารพิเศษ <input class="form-control" type="date" id="opendate"> <br><br>
                                            วันสุดท้ายของการกรอกข้อมูลอาจารพิเศษ <input class="form-control" type="date" id="lastdate"> <div id="warning"></div>
                                        </div>
                                        <br>
                                        <button type="button" class="btn btn-outline btn-default" style="position: absolute; right: 80px; bottom: 10px;" id="edit" disabled>แก้ไข</button>
                                        <button type="button" class="btn btn-outline btn-default" style="position: absolute; right: 10px; bottom: 10px;" id="submitbtn_special"  name="submit">บันทึก</button>
                                        <button type="button" class="btn btn-outline btn-default" id="delete" style="position: absolute; right: 10px; top: 10px;" disabled>X</button>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="approve">
                <div class="container">
                    <div class="panel panel-default" style="margin-top: 20px;">
                        <div class="panel-heading">
                            <div class="form-inline">
                                <h5 style="font-size : 16px;margin-bottom: 0px;margin-top: 0px;">กำหนดเวลาอนุมัติกระบวนวิชา
                                    <button type="button" class="btn btn-default" id="addbtn_approve">เพิ่ม</button>
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
                                            วันเปิดการอนุมัติกระบวนวิชา <input class="form-control" type="date" id="opendate"> <br><br>
                                            วันสุดท้ายของการอนุมัติกระบวนวิชา <input class="form-control" type="date" id="lastdate">
                                            <div id="warning"></div>
                                        </div>
                                        <br>
                                        <button type="button" class="btn btn-outline btn-default" style="position: absolute; right: 80px; bottom: 10px;" id="edit" disabled>แก้ไข</button>
                                        <button type="button" class="btn btn-outline btn-default" style="position: absolute; right: 10px; bottom: 10px;" id="submitbtn_approve" name="submit">บันทึก</button>
                                        <button type="button" class="btn btn-outline btn-default" id="delete" style="position: absolute; right: 10px; top: 10px;" disabled>X</button>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="evaluate">
                <div class="container">
                    <div class="panel panel-default" style="margin-top: 20px;">
                        <div class="panel-heading">
                            <div class="form-inline">
                                <h5 style="font-size : 16px;margin-bottom: 0px;margin-top: 0px;">กำหนดเวลาประเมินกระบวนวิชา
                                    <button type="button" class="btn btn-default" id="addbtn_evaluate">เพิ่ม</button>
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
                                            วันเปิดการประเมินกระบวนวิชา <input class="form-control" type="date" id="opendate"> <br><br>
                                            วันสุดท้ายของการประเมินกระบวนวิชา <input class="form-control" type="date" id="lastdate">
                                            <div id="warning"></div>
                                        </div>
                                        <br>
                                        <button type="button" class="btn btn-outline btn-default" style="position: absolute; right: 80px; bottom: 10px;" id="edit" disabled>แก้ไข</button>
                                        <button type="button" class="btn btn-outline btn-default" style="position: absolute; right: 10px; bottom: 10px;" id="submitbtn_evaluate" name="submit">บันทึก</button>
                                        <button type="button" class="btn btn-outline btn-default" id="delete" style="position: absolute; right: 10px; top: 10px;" disabled>X</button>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>

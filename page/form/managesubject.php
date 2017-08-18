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
              $("#warning").css("color","green").html('บันทึกสำเร็จ').delay(1500).fadeOut();
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
          <div class="panel panel-warning">
            <div class="panel-heading">
                <b>เพิ่มกระบวนวิชา</b>
            </div>
            <div class="panel-body">
              <div class="form-inline">
              <form>
                <input class="form-control" id="course_id" placeholder="e.g. 452111" style="width: 100px;">
                <button type="button" class="btn btn-outline btn-primary" id="submit"  name="submit">เพิ่ม</button>
                <div id="warning"></div>
              </form>
              </div>
            </div>
          </div>
          <div class="panel panel-info">
            <div class="panel-heading">
              <b>กระบวนวิชาที่สังกัดในภาควิชา</b>
            </div>
            <div class="panel-body">
              <table class="table table-hover" style="font-size:14px">
                <col width="130">
                <col width="80">
                <thead>
                    <tr>
                        <th width="20%">รหัสวิชา</th>
                        <th width="60%">ชื่อวิชา</th>
                        <th width="20%"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>462533</td>
                        <td>HEALTH BEHAVIORS AND PHARMACEUTICAL CARE</td>
                        <td><button type="button" class="btn btn-outline btn-danger" id="delete"  name="delete" >ลบ</button></td>
                    </tr>
                    <tr>
                        <td>461525</td>
                        <td>BASIC KNOWLEDGE OF THAI TRADITIONAL MEDICINEE</td>
                        <td><button type="button" class="btn btn-outline btn-danger" id="delete"  name="delete" >ลบ</button></td>
                    </tr>
                    <tr>
                        <td>461532</td>
                        <td>DRUG SYNTHESIS</td>
                        <td><button type="button" class="btn btn-outline btn-danger" id="delete"  name="delete" >ลบ</button></td>
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

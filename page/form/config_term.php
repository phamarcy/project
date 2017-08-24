<!DOCTYPE html>
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
    <script>
    $(document).ready(function(){

    });

    $(document).on("click","#change-data",function(){
      var form = $(this).parent();
      $("input").prop("disabled",false);
      $("select").prop("disabled",false);
    });

    $(document).on("click","#submitbtn",function(){
      var form = $(this).parent();
      var config_name = $(form).attr("id");
      var formData = {};
      var error = 0;
      var loading_pic = '../../application/picture/loading_icon.gif';
      var url = '../../application/admin/update_config.php';
      formData['config_type'] = config_name;
      $(form).find("#warning").hide();
      $(form).find("input").each(function(index, node)
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
      $(form).find("select").each(function(index, node)
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
      if(error == 1)
      {
        $(form).find("#warning").css("color","red").html("กรุณากรอกข้อมูลให้ครบถ้วน").fadeIn();
      }
      else
      {
        $(form).find("#loading").attr("src",loading_pic);
        $.post(url, { 'DATA': formData }).done(function(data) {
            $(form).find("#loading").attr("src",'');
            $(form).find("#warning").html("");
            console.log(data);
            try {
                var result = JSON.parse(data);
                if (typeof result.success === 'undefined' || result.success === null ) {
                  if (typeof result.error === 'undefined' || result.error === null ) {
                    $(form).find("#warning").css("color","red").html("ไม่สามารถส่งข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ").fadeIn().delay(1500).fadeOut();
                  }else {
                    $(form).find("#warning").css("color","red").html(result.error).fadeIn().delay(1500).fadeOut();
                  }
                }
                else {
                  $("input").prop("disabled",true);
                  $("select").prop("disabled",true);
                $(form).find("#warning").css("color","green").html(result.success).fadeIn().delay(1500).fadeOut();
                }
            } catch (e) {
              $(form).find("#warning").css("color","red").html("ไม่สามารถส่งข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ").fadeIn().delay(1500).fadeOut();
            }
        }).fail(function() {
          $(form).find("#warning").html("");
          alert("ไม่สามารถเชื่อมต่อฐานข้อมูลได้ กรุณาติดต่อเจ้าหน้าที่");
          });
      }

    });
    </script>
  </head>
  <body>
    <div class="container " style="margin-top: 20px;">
      <div class="well" >
        <div class="panel panel-warning">
            <div class="panel-heading">
                  กำหนดภาคการศึกษาปัจจุบัน
            </div>
            <div class="panel-body" style="position: relative;">
              <form id="manage_semester">
                  <div class="form-inline">
                      <h style="width: 100px;  ">ภาคการศึกษาที่ </h>
                      <div class="form-group">
                          <select class="form-control" id="semester" style="width: 70px;" disabled>
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                          </select>
                      </div>
                      ปีการศึกษา
                      <input class="form-control" id="year" name="year" placeholder="e.g. 2560" style="width: 100px;" value="2560" disabled>
                      <button type="button" class="btn btn-outline btn-default" id="change-data">เปลี่ยน</button>
                    <img id="loading" src="" height="35px"/>
                  </div>
                  <br>
                <div id="warning"></div>
                  <button type="button" class="btn btn-outline btn-default" style="position: absolute; right: 10px; bottom: 10px;" id="submitbtn"  name="submit">บันทึก</button>
              </form>
            </div>
        </div>
      </div>
    </div>

  </body>
</html>

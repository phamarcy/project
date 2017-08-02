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
</header>
<style>
.form-control {
    height: 30px;
}
</style>
<script type="text/javascript">
function loaddataAll()
{
    $('#loading').html("<center><img src='../../application/picture/loading_icon.gif'></center>");
    $(".container").hide();
    loaddata('course');
    loaddata('approve');
}
function loaddata(type) {

    url = "../../application/deadline/update_deadline.php?type="+type+"&query=search";
    var data;
    var object;
    $.getJSON(url, function(result) {
        if (typeof result.data === 'undefined' || result.data === null) {
            $("#loading").html('<div class="alert alert-danger">Error : ' + result.error + '</div>');
        } else {

            render(result.data,type);
        }

    });
}

function render(data,type) {
    var count = data.length;
    for (var i = 0; i < count; i++) {
        object = document.getElementById("group_"+type).cloneNode(true);
        $(object).find("#year").val(data[i].year);
        $(object).find("#semester").val(data[i].semester);
        $(object).find("#opendate").val(data[i].opendate);
        $(object).find("#lastdate").val(data[i].lastdate);
        $(object).find("#submitbtn_"+type).prop('disabled', true);
        $(object).find("#delete").prop('disabled', false);
        $(object).appendTo("#body_"+type);
    }
    $("#loading").html("");
    $(".container").fadeIn();

}
$(document).ready(function() {
    $("#addbtn_approve").click(function() {
        var i = 0;
        var object = document.getElementById("group_approve");
        var object_clone = $(object).clone();
        $(object_clone).find("#delete").prop('disabled', false);
        $(object_clone).find("input").val("").end().prependTo("#body_approve");
    });
    $("#addbtn_course").click(function() {
        var i = 0;
        var object = document.getElementById("group_course");
        var object_clone = $(object).clone();
        $(object_clone).find("#delete").prop('disabled', false);
        $(object_clone).find("input").val("").end().prependTo("#body_course");
    });
});
$(document).on('click', "#submitbtn_course", function() {
    url = "../../application/deadline/update_deadline.php?query=add&type=course";
    var form = $(this).parent();
    var formData = {};
    $(form).find("input[id]").each(function(index, node) {
        formData[node.id] = node.value;
    });
    $.post(url, { 'DATA': formData }).done(function(data) {
        alert(data);
    });
});
$(document).on('click', "#submitbtn_approve", function() {
    url = "../../application/deadline/update_deadline.php?query=add&type=approve";
    var form = $(this).parent();
    var formData = {};
    $(form).find("input[id]").each(function(index, node) {
        formData[node.id] = node.value;
    });
    $.post(url, { 'DATA': formData }).done(function(data) {
        alert(data);
    });
});
$(document).on('click', "#delete", function() {
    var object = $(this).parent().parent();
    $(object).fadeOut(300, function() { $(this).remove(); });
});
</script>

<body onload="loaddataAll()">
    <h3 class="page-header" style="margin-bottom: 0px;"><center>กำหนดช่วงเวลา</center></h3>
    <div class="panel-body" style="padding-top: 0px;">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#home" data-toggle="tab">กรอกข้อมูลกระบวนวิชา</a>
            </li>
            <li><a href="#profile" data-toggle="tab">อนุมัติกระบวนวิชา</a>
            </li>
        </ul>
        <!-- loading tab -->
        <div id="loading"></div>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade in active" id="home">
                <div class="container">
                    <div class="panel panel-default" style="margin-top: 20px;">
                        <div class="panel-heading">
                            <div class="form-inline">
                                <h5 style="font-size : 16px">กำหนดเวลากรอกข้อมูลรายละเอียดกระบวนวิชา
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
                                            <input class="form-control" id="year" placeholder="Ex. 2560" style="width: 100px;">
                                        </div>
                                        <br>
                                        <div class="form-inline">
                                            วันเปิดการกรอกข้อมูลกระบวนวิชา <input class="form-control" type="date" id="opendate"> <br><br>
                                            วันสุดท้ายของการกรอกข้อมูลกระบวนวิชา <input class="form-control" type="date" id="lastdate">
                                        </div>
                                        <button type="button" class="btn btn-outline btn-default" style="position: absolute; right: 10px; bottom: 10px;" id="submitbtn_course">บันทึก</button>
                                        <button type="button" class="btn btn-outline btn-default" id="delete" style="position: absolute; right: 10px; top: 10px;" disabled>X</button>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="profile">
                <div class="container">
                    <div class="panel panel-default" style="margin-top: 20px;">
                        <div class="panel-heading">
                            <div class="form-inline">
                                <h5 style="font-size : 16px">กำหนดเวลาอนุมัติกระบวนวิชา
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
                                            <input class="form-control" id="year" placeholder="Ex. 2560" style="width: 100px;">
                                        </div>
                                        <br>
                                        <div class="form-inline">
                                            วันเปิดการอนุมัติกระบวนวิชา <input class="form-control" type="date" id="opendate"> <br><br>
                                            วันสุดท้ายของการอนุมัติกระบวนวิชา <input class="form-control" type="date" id="lastdate">
                                        </div>
                                        <button type="button" class="btn btn-outline btn-default" style="position: absolute; right: 10px; bottom: 10px;" id="submitbtn_approve">บันทึก</button>
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